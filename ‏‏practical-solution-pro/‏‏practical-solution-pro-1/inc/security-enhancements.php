<?php
/**
 * Security Enhancements for Practical Solutions Pro
 * تحسينات الأمان لقالب الحلول العملية الاحترافي
 * الإصدار: 2.2.2 (محسن)
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Security_Enhancements {
    
    private $max_login_attempts = 5;
    private $lockout_duration = 3600; // ساعة واحدة
    
    public function __construct() {
        add_action('init', [$this, 'init_security_measures']);
        add_action('wp_login_failed', [$this, 'log_failed_login']);
        add_filter('authenticate', [$this, 'limit_login_attempts'], 30, 3);
        add_action('wp_ajax_nopriv_ps_search', [$this, 'verify_ajax_nonce']);
        add_action('wp_ajax_ps_search', [$this, 'verify_ajax_nonce']);
        add_action('template_redirect', [$this, 'prevent_user_enumeration']);
        add_action('wp_login', [$this, 'clear_login_attempts'], 10, 2);
    }
    
    /**
     * تطبيق إجراءات الأمان الأساسية
     */
    public function init_security_measures() {
        // منع التنفيذ المباشر لملفات PHP
        if (!defined('ABSPATH')) {
            http_response_code(403);
            exit('Direct access forbidden.');
        }
        
        // إزالة معلومات الإصدار
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // إخفاء أخطاء تسجيل الدخول
        add_filter('login_errors', function() {
            return __('معلومات تسجيل دخول غير صحيحة.', 'practical-solutions');
        });
        
        // حماية من XML-RPC attacks
        add_filter('xmlrpc_enabled', '__return_false');
        
        // إزالة معلومات إضافية من head
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
        
        // حماية wp-config.php
        add_action('init', [$this, 'protect_wp_config']);
    }
    
    /**
     * منع user enumeration المحسن
     */
    public function prevent_user_enumeration() {
        // منع الوصول المباشر لصفحات المؤلفين عبر author parameter
        if (!is_admin() && isset($_GET['author'])) {
            wp_redirect(home_url('/'), 301);
            exit;
        }
        
        // منع REST API من كشف معلومات المستخدمين
        if (!current_user_can('manage_options')) {
            add_filter('rest_authentication_errors', function($access) {
                if (is_wp_error($access)) {
                    return $access;
                }
                
                global $wp;
                if (strpos($wp->request, 'wp/v2/users') !== false) {
                    return new WP_Error(
                        'rest_cannot_access',
                        __('غير مصرح بالوصول', 'practical-solutions'),
                        ['status' => 401]
                    );
                }
                
                return $access;
            });
        }
    }
    
    /**
     * تسجيل محاولات تسجيل الدخول الفاشلة
     */
    public function log_failed_login($username) {
        $ip = $this->get_user_ip();
        $attempt_key = 'ps_login_attempts_' . md5($ip);
        $attempts = get_transient($attempt_key) ?: 0;
        $attempts++;
        
        set_transient($attempt_key, $attempts, $this->lockout_duration);
        
        // تسجيل مفصل للمحاولات المشبوهة
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : 'Unknown';
        $log_entry = [
            'username' => sanitize_user($username),
            'ip' => $ip,
            'user_agent' => $user_agent,
            'attempt' => $attempts,
            'timestamp' => current_time('mysql'),
            'referer' => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : ''
        ];
        
        error_log('PS Security - Failed login: ' . wp_json_encode($log_entry));
        
        // إنذار للمدير عند تجاوز عدد معين من المحاولات
        if ($attempts >= 3) {
            $this->notify_admin_suspicious_activity($log_entry);
        }
    }
    
    /**
     * تحديد محاولات تسجيل الدخول
     */
    public function limit_login_attempts($user, $username, $password) {
        if (empty($username) || empty($password)) {
            return $user;
        }
        
        $ip = $this->get_user_ip();
        $attempt_key = 'ps_login_attempts_' . md5($ip);
        $attempts = get_transient($attempt_key) ?: 0;
        
        if ($attempts >= $this->max_login_attempts) {
            $remaining_time = get_option('_transient_timeout_' . $attempt_key) - time();
            $remaining_minutes = ceil($remaining_time / 60);
            
            return new WP_Error(
                'too_many_attempts',
                sprintf(
                    __('تم تجاوز العدد المسموح من محاولات تسجيل الدخول. حاول مرة أخرى بعد %d دقيقة.', 'practical-solutions'),
                    $remaining_minutes
                )
            );
        }
        
        return $user;
    }
    
    /**
     * مسح محاولات تسجيل الدخول عند النجاح
     */
    public function clear_login_attempts($user_login, $user) {
        $ip = $this->get_user_ip();
        $attempt_key = 'ps_login_attempts_' . md5($ip);
        delete_transient($attempt_key);
    }
    
    /**
     * التحقق من nonce في طلبات AJAX
     */
    public function verify_ajax_nonce() {
        $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
        
        if (!wp_verify_nonce($nonce, 'ps_nonce')) {
            wp_send_json_error([
                'message' => __('غير مصرح', 'practical-solutions'),
                'code' => 'invalid_nonce'
            ]);
        }
    }
    
    /**
     * حماية ملف wp-config.php
     */
    public function protect_wp_config() {
        if (strpos($_SERVER['REQUEST_URI'], 'wp-config.php') !== false) {
            http_response_code(403);
            exit('Access Denied');
        }
    }
    
    /**
     * إشعار المدير بالنشاط المشبوه
     */
    private function notify_admin_suspicious_activity($log_entry) {
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');
        
        $subject = sprintf(__('[%s] نشاط مشبوه - محاولات تسجيل دخول متعددة', 'practical-solutions'), $site_name);
        
        $message = sprintf(
            __("تم رصد محاولات متعددة لتسجيل الدخول من العنوان: %s\n\nالتفاصيل:\n- اسم المستخدم: %s\n- عدد المحاولات: %d\n- المتصفح: %s\n- الوقت: %s\n\nيرجى مراجعة سجلات الأمان.", 'practical-solutions'),
            $log_entry['ip'],
            $log_entry['username'],
            $log_entry['attempt'],
            $log_entry['user_agent'],
            $log_entry['timestamp']
        );
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * الحصول على IP الحقيقي للمستخدم
     */
    private function get_user_ip() {
        $ip_keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 
                   'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) && !empty($_SERVER[$key])) {
                $ip = sanitize_text_field($_SERVER[$key]);
                // للـ IPs المتعددة، أخذ الأول
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        
        return isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '0.0.0.0';
    }
    
    /**
     * تنظيف وتطهير البيانات المدخلة المحسن
     */
    public static function sanitize_input($input, $type = 'text') {
        if (is_array($input)) {
            return array_map(function($item) use ($type) {
                return self::sanitize_input($item, $type);
            }, $input);
        }
        
        switch ($type) {
            case 'email':
                return sanitize_email($input);
            case 'url':
                return esc_url_raw($input);
            case 'textarea':
                return sanitize_textarea_field($input);
            case 'html':
                return wp_kses_post($input);
            case 'int':
                return intval($input);
            case 'float':
                return floatval($input);
            case 'boolean':
                return filter_var($input, FILTER_VALIDATE_BOOLEAN);
            case 'slug':
                return sanitize_title($input);
            case 'filename':
                return sanitize_file_name($input);
            default:
                return sanitize_text_field($input);
        }
    }
    
    /**
     * تشفير البيانات الحساسة المحسن
     */
    public static function encrypt_data($data, $key = null) {
        if (!extension_loaded('openssl')) {
            return base64_encode($data);
        }
        
        $key = $key ?: wp_salt('AUTH_KEY');
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', hash('sha256', $key), 0, $iv);
        
        if ($encrypted === false) {
            return base64_encode($data);
        }
        
        return base64_encode($iv . $encrypted);
    }
    
    /**
     * فك تشفير البيانات المحسن
     */
    public static function decrypt_data($encrypted_data, $key = null) {
        if (!extension_loaded('openssl')) {
            return base64_decode($encrypted_data);
        }
        
        $data = base64_decode($encrypted_data);
        if ($data === false) {
            return $encrypted_data;
        }
        
        $key = $key ?: wp_salt('AUTH_KEY');
        $iv = substr($data, 0, 16);
        $encrypted = substr($data, 16);
        
        $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', hash('sha256', $key), 0, $iv);
        
        return $decrypted !== false ? $decrypted : $encrypted_data;
    }
    
    /**
     * فحص الملفات المرفوعة
     */
    public function scan_uploaded_file($file) {
        if (!isset($file['tmp_name']) || !file_exists($file['tmp_name'])) {
            return $file;
        }
        
        // فحص أنواع الملفات المسموحة
        $allowed_mimes = [
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif' => 'image/gif',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        $file_type = wp_check_filetype($file['name'], $allowed_mimes);
        
        if (!$file_type['type']) {
            $file['error'] = __('نوع الملف غير مسموح', 'practical-solutions');
            return $file;
        }
        
        // فحص محتوى الملف للتأكد من سلامته
        $file_content = file_get_contents($file['tmp_name']);
        if (strpos($file_content, '<?php') !== false || strpos($file_content, '<script') !== false) {
            $file['error'] = __('محتوى الملف غير آمن', 'practical-solutions');
        }
        
        return $file;
    }
}

// تشغيل النظام
new PS_Security_Enhancements();