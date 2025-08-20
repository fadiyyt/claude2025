<?php
/**
 * تحسينات الأمان للقالب
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة تحسينات الأمان
 */
class FADI_Security_Enhancements {
    
    public function __construct() {
        add_action('init', array($this, 'init_security_measures'));
        add_action('wp_login_failed', array($this, 'log_failed_login'));
        add_action('wp_login', array($this, 'log_successful_login'), 10, 2);
        add_filter('authenticate', array($this, 'limit_login_attempts'), 30, 3);
        add_action('send_headers', array($this, 'add_security_headers')); // تغيير من wp_head إلى send_headers
        add_filter('login_errors', array($this, 'generic_login_error'));
    }
    
    /**
     * تهيئة إجراءات الأمان
     */
    public function init_security_measures() {
        // إخفاء معلومات النظام
        $this->hide_system_info();
        
        // تحسين أمان ملفات التكوين
        $this->secure_config_files();
        
        // تعطيل محرر الملفات
        $this->disable_file_editing();
        
        // تحسين أمان الجلسات
        $this->secure_sessions();
        
        // تفعيل HTTPS
        $this->force_ssl();
        
        // حماية ضد XSS
        $this->prevent_xss();
        
        // حماية ضد CSRF
        $this->prevent_csrf();
    }
    
    /**
     * إخفاء معلومات النظام
     */
    private function hide_system_info() {
        // إخفاء إصدار ووردبريس
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // تعطيل XML-RPC
        add_filter('xmlrpc_enabled', '__return_false');
        remove_action('wp_head', 'rsd_link');
        
        // تعطيل REST API للمستخدمين غير المصرح لهم
        add_filter('rest_authentication_errors', array($this, 'restrict_rest_api'));
        
        // إخفاء معلومات المستخدمين
        add_filter('oembed_response_data', array($this, 'remove_oembed_author_info'));
    }
    
    /**
     * تقييد الوصول لـ REST API
     */
    public function restrict_rest_api($access) {
        if (!is_user_logged_in()) {
            return new WP_Error('rest_not_logged_in', __('الوصول غير مصرح به', 'fadi'), array('status' => 401));
        }
        return $access;
    }
    
    /**
     * إزالة معلومات المؤلف من oEmbed
     */
    public function remove_oembed_author_info($data) {
        unset($data['author_name']);
        unset($data['author_url']);
        return $data;
    }
    
    /**
     * تأمين ملفات التكوين
     */
    private function secure_config_files() {
        // منع الوصول المباشر لملفات PHP الحساسة
        $sensitive_files = array(
            '.htaccess',
            'wp-config.php',
            'wp-config-sample.php',
            'readme.html',
            'license.txt'
        );
        
        foreach ($sensitive_files as $file) {
            if (file_exists(ABSPATH . $file) && is_readable(ABSPATH . $file)) {
                @chmod(ABSPATH . $file, 0644);
            }
        }
    }
    
    /**
     * تعطيل محرر الملفات
     */
    private function disable_file_editing() {
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', true);
        }
    }
    
    /**
     * تأمين الجلسات
     */
    private function secure_sessions() {
        if (!session_id()) {
            session_start();
        }
        
        // تجديد معرف الجلسة
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
        }
    }
    
    /**
     * فرض استخدام HTTPS
     */
    private function force_ssl() {
        if (!is_ssl() && !is_admin()) {
            add_action('template_redirect', function() {
                if (!headers_sent()) {
                    wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301);
                    exit();
                }
            });
        }
    }
    
    /**
     * منع XSS
     */
    private function prevent_xss() {
        // تنظيف البيانات المرسلة
        add_filter('pre_comment_content', 'wp_strip_all_tags');
        
        // حماية إضافية للنماذج
        add_action('wp_head', array($this, 'add_csrf_meta'));
    }
    
    /**
     * إضافة meta tag لـ CSRF
     */
    public function add_csrf_meta() {
        if (is_user_logged_in()) {
            echo '<meta name="csrf-token" content="' . wp_create_nonce('fadi_csrf') . '">' . "\n";
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                const forms = document.querySelectorAll("form");
                forms.forEach(function(form) {
                    if (!form.querySelector("input[name=\'_wpnonce\']")) {
                        const nonce = document.createElement("input");
                        nonce.type = "hidden";
                        nonce.name = "_wpnonce";
                        nonce.value = "' . wp_create_nonce('fadi_csrf') . '";
                        form.appendChild(nonce);
                    }
                });
            });
            </script>' . "\n";
        }
    }
    
    /**
     * منع CSRF
     */
    private function prevent_csrf() {
        add_action('wp_loaded', array($this, 'verify_csrf_token'));
    }
    
    /**
     * فحص رمز CSRF
     */
    public function verify_csrf_token() {
        if ($_POST && is_user_logged_in()) {
            if (!wp_verify_nonce($_POST['_wpnonce'] ?? '', 'fadi_csrf')) {
                wp_die(__('فشل التحقق الأمني', 'fadi'));
            }
        }
    }
    
    /**
     * إضافة Headers الأمان - تم إصلاح المشكلة
     */
    public function add_security_headers() {
        // فحص إذا كانت الهيدرز لم ترسل بعد
        if (!headers_sent()) {
            // منع تضمين الموقع في frame
            header('X-Frame-Options: SAMEORIGIN');
            
            // منع تحديد نوع المحتوى
            header('X-Content-Type-Options: nosniff');
            
            // تفعيل حماية XSS
            header('X-XSS-Protection: 1; mode=block');
            
            // إخفاء معلومات الخادم
            header('Server: FADI/1.0');
            
            // سياسة الإحالة
            header('Referrer-Policy: strict-origin-when-cross-origin');
            
            // أمان النقل
            if (is_ssl()) {
                header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
            }
            
            // إزالة headers غير الضرورية
            header_remove('X-Powered-By');
        }
    }
    
    /**
     * تسجيل محاولات تسجيل الدخول الفاشلة
     */
    public function log_failed_login($username) {
        $ip = $this->get_client_ip();
        $attempts = get_option('fadi_failed_logins', array());
        
        if (!isset($attempts[$ip])) {
            $attempts[$ip] = array();
        }
        
        $attempts[$ip][] = array(
            'username' => $username,
            'time' => current_time('timestamp'),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'غير معروف'
        );
        
        // الاحتفاظ بآخر 10 محاولات فقط
        if (count($attempts[$ip]) > 10) {
            $attempts[$ip] = array_slice($attempts[$ip], -10);
        }
        
        update_option('fadi_failed_logins', $attempts);
    }
    
    /**
     * تسجيل عمليات تسجيل الدخول الناجحة
     */
    public function log_successful_login($user_login, $user) {
        $ip = $this->get_client_ip();
        
        // إزالة محاولات الدخول الفاشلة للـ IP عند النجاح
        $attempts = get_option('fadi_failed_logins', array());
        if (isset($attempts[$ip])) {
            unset($attempts[$ip]);
            update_option('fadi_failed_logins', $attempts);
        }
        
        // تسجيل الدخول الناجح
        $successful_logins = get_option('fadi_successful_logins', array());
        $successful_logins[] = array(
            'username' => $user_login,
            'ip' => $ip,
            'time' => current_time('timestamp'),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'غير معروف'
        );
        
        // الاحتفاظ بآخر 50 تسجيل دخول ناجح
        if (count($successful_logins) > 50) {
            $successful_logins = array_slice($successful_logins, -50);
        }
        
        update_option('fadi_successful_logins', $successful_logins);
    }
    
    /**
     * تحديد محاولات تسجيل الدخول
     */
    public function limit_login_attempts($user, $username, $password) {
        if (empty($username) || empty($password)) {
            return $user;
        }
        
        $ip = $this->get_client_ip();
        $attempts = get_option('fadi_failed_logins', array());
        
        if (isset($attempts[$ip])) {
            $recent_attempts = array_filter($attempts[$ip], function($attempt) {
                return ($attempt['time'] > (current_time('timestamp') - 3600)); // آخر ساعة
            });
            
            if (count($recent_attempts) >= 5) {
                return new WP_Error('too_many_attempts', __('تم تجاوز الحد الأقصى لمحاولات تسجيل الدخول. حاول مرة أخرى لاحقاً.', 'fadi'));
            }
        }
        
        return $user;
    }
    
    /**
     * رسالة خطأ عامة لتسجيل الدخول
     */
    public function generic_login_error() {
        return __('خطأ في بيانات تسجيل الدخول', 'fadi');
    }
    
    /**
     * الحصول على IP العميل
     */
    private function get_client_ip() {
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                $ip = $_SERVER[$key];
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
}

// تهيئة فئة الأمان
new FADI_Security_Enhancements();