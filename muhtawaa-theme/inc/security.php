<?php
/**
 * نظام الأمان والحماية
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة الأمان والحماية
 */
class MuhtawaaSecurity {
    
    /**
     * تهيئة ميزات الأمان
     */
    public static function init_security_features() {
        // حماية الملفات الحساسة
        add_action('init', array(__CLASS__, 'protect_sensitive_files'));
        
        // حماية من هجمات XSS
        add_action('init', array(__CLASS__, 'prevent_xss_attacks'));
        
        // حماية من هجمات CSRF
        add_action('init', array(__CLASS__, 'prevent_csrf_attacks'));
        
        // حماية من هجمات SQL Injection
        add_action('init', array(__CLASS__, 'prevent_sql_injection'));
        
        // إزالة معلومات النسخة
        add_action('init', array(__CLASS__, 'hide_wp_version'));
        
        // تعطيل XML-RPC
        add_filter('xmlrpc_enabled', '__return_false');
        
        // حماية wp-config.php
        add_action('init', array(__CLASS__, 'protect_wp_config'));
        
        // تسجيل محاولات تسجيل الدخول المفشلة
        add_action('wp_login_failed', array(__CLASS__, 'log_failed_login'));
        add_action('wp_login', array(__CLASS__, 'log_successful_login'), 10, 2);
        
        // حماية من التصفح للمجلدات
        add_action('init', array(__CLASS__, 'disable_directory_browsing'));
        
        // فلترة المحتوى المدخل
        add_action('init', array(__CLASS__, 'sanitize_inputs'));
        
        // حماية من رفع الملفات الضارة
        add_filter('wp_check_filetype_and_ext', array(__CLASS__, 'secure_file_upload'), 10, 4);
        
        // إضافة رؤوس الأمان
        add_action('send_headers', array(__CLASS__, 'add_security_headers'));
        
        // حماية من محاولات الاختراق الشائعة
        add_action('init', array(__CLASS__, 'block_malicious_requests'));
        
        // تشفير البيانات الحساسة
        add_filter('muhtawaa_encrypt_data', array(__CLASS__, 'encrypt_sensitive_data'));
        add_filter('muhtawaa_decrypt_data', array(__CLASS__, 'decrypt_sensitive_data'));
    }
    
    /**
     * حماية الملفات الحساسة
     */
    public static function protect_sensitive_files() {
        // قائمة بالملفات والمجلدات المحظورة
        $blocked_files = array(
            'wp-config.php',
            'error_log',
            '.htaccess',
            'readme.html',
            'license.txt',
            '/wp-admin/',
            '/wp-includes/',
        );
        
        foreach ($blocked_files as $file) {
            if (strpos($_SERVER['REQUEST_URI'], $file) !== false && !is_user_logged_in()) {
                wp_die(__('غير مسموح بالوصول لهذا الملف', 'muhtawaa'), 403);
            }
        }
    }
    
    /**
     * منع هجمات XSS
     */
    public static function prevent_xss_attacks() {
        // تنظيف جميع المدخلات
        if (!is_admin()) {
            $_GET = array_map('self::clean_input', $_GET);
            $_POST = array_map('self::clean_input', $_POST);
            $_REQUEST = array_map('self::clean_input', $_REQUEST);
        }
        
        // فلترة المحتوى
        add_filter('the_content', 'wp_kses_post');
        add_filter('the_excerpt', 'wp_kses_post');
        add_filter('comment_text', 'wp_kses_post');
    }
    
    /**
     * منع هجمات CSRF
     */
    public static function prevent_csrf_attacks() {
        // إضافة nonce للنماذج
        add_action('wp_head', function() {
            if (!is_admin()) {
                echo '<meta name="csrf-token" content="' . wp_create_nonce('muhtawaa_csrf') . '">';
            }
        });
        
        // التحقق من CSRF في طلبات AJAX
        add_action('wp_ajax_nopriv_muhtawaa_action', array(__CLASS__, 'verify_csrf_token'));
        add_action('wp_ajax_muhtawaa_action', array(__CLASS__, 'verify_csrf_token'));
    }
    
    /**
     * منع هجمات SQL Injection
     */
    public static function prevent_sql_injection() {
        // فلترة مدخلات قاعدة البيانات
        add_filter('query_vars', array(__CLASS__, 'sanitize_query_vars'));
        
        // استخدام prepared statements فقط
        add_action('pre_get_posts', array(__CLASS__, 'validate_query_parameters'));
    }
    
    /**
     * إخفاء معلومات نسخة ووردبريس
     */
    public static function hide_wp_version() {
        // إزالة meta generator
        remove_action('wp_head', 'wp_generator');
        
        // إزالة النسخة من CSS و JS
        add_filter('style_loader_src', array(__CLASS__, 'remove_version_from_assets'), 9999);
        add_filter('script_loader_src', array(__CLASS__, 'remove_version_from_assets'), 9999);
        
        // إزالة النسخة من RSS
        add_filter('the_generator', '__return_empty_string');
    }
    
    /**
     * حماية ملف wp-config.php
     */
    public static function protect_wp_config() {
        if (strpos($_SERVER['REQUEST_URI'], 'wp-config.php') !== false) {
            header('HTTP/1.0 404 Not Found');
            exit;
        }
    }
    
    /**
     * تسجيل محاولات تسجيل الدخول المفشلة
     */
    public static function log_failed_login($username) {
        $ip = self::get_user_ip();
        $user_agent = sanitize_text_field($_SERVER['HTTP_USER_AGENT']);
        
        $log_data = array(
            'timestamp' => current_time('mysql'),
            'ip' => $ip,
            'username' => sanitize_text_field($username),
            'user_agent' => $user_agent,
            'type' => 'failed_login'
        );
        
        self::write_security_log($log_data);
        
        // حظر IP بعد عدة محاولات فاشلة
        self::check_failed_login_attempts($ip);
    }
    
    /**
     * تسجيل عمليات تسجيل الدخول الناجحة
     */
    public static function log_successful_login($user_login, $user) {
        $ip = self::get_user_ip();
        $user_agent = sanitize_text_field($_SERVER['HTTP_USER_AGENT']);
        
        $log_data = array(
            'timestamp' => current_time('mysql'),
            'ip' => $ip,
            'username' => $user_login,
            'user_id' => $user->ID,
            'user_agent' => $user_agent,
            'type' => 'successful_login'
        );
        
        self::write_security_log($log_data);
    }
    
    /**
     * تعطيل تصفح المجلدات
     */
    public static function disable_directory_browsing() {
        // إنشاء ملف index.php فارغ في المجلدات الحساسة
        $directories = array(
            THEME_PATH . '/inc/',
            THEME_PATH . '/assets/',
            WP_CONTENT_DIR . '/uploads/',
        );
        
        foreach ($directories as $dir) {
            $index_file = $dir . 'index.php';
            if (!file_exists($index_file)) {
                file_put_contents($index_file, '<?php // Silence is golden');
            }
        }
    }
    
    /**
     * تنظيف المدخلات
     */
    private static function clean_input($input) {
        if (is_array($input)) {
            return array_map(array(__CLASS__, 'clean_input'), $input);
        } else {
            return sanitize_text_field(stripslashes($input));
        }
    }
    
    /**
     * التحقق من رمز CSRF
     */
    public static function verify_csrf_token() {
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_csrf')) {
            wp_die(__('رمز الأمان غير صحيح', 'muhtawaa'), 403);
        }
    }
    
    /**
     * تنظيف متغيرات الاستعلام
     */
    public static function sanitize_query_vars($vars) {
        return array_map('sanitize_text_field', $vars);
    }
    
    /**
     * التحقق من معاملات الاستعلام
     */
    public static function validate_query_parameters($query) {
        // منع استعلامات SQL المشبوهة
        $suspicious_patterns = array(
            'union',
            'select',
            'insert',
            'update',
            'delete',
            'drop',
            'create',
            'alter',
            '--',
            ';'
        );
        
        $query_string = strtolower($_SERVER['QUERY_STRING']);
        
        foreach ($suspicious_patterns as $pattern) {
            if (strpos($query_string, $pattern) !== false) {
                wp_die(__('طلب مشبوه مرفوض', 'muhtawaa'), 403);
            }
        }
    }
    
    /**
     * إزالة النسخة من ملفات CSS و JS
     */
    public static function remove_version_from_assets($src) {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
    
    /**
     * الحصول على عنوان IP الحقيقي للمستخدم
     */
    private static function get_user_ip() {
        $ip_keys = array(
            'HTTP_CF_CONNECTING_IP',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    
    /**
     * كتابة سجل الأمان
     */
    private static function write_security_log($data) {
        $log_file = WP_CONTENT_DIR . '/muhtawaa-security.log';
        $log_entry = date('Y-m-d H:i:s') . ' - ' . json_encode($data) . PHP_EOL;
        
        // التأكد من حجم الملف
        if (file_exists($log_file) && filesize($log_file) > 5 * 1024 * 1024) { // 5MB
            self::rotate_log_file($log_file);
        }
        
        file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * تدوير ملف السجل
     */
    private static function rotate_log_file($log_file) {
        $backup_file = $log_file . '.' . date('Y-m-d-H-i-s') . '.bak';
        rename($log_file, $backup_file);
        
        // حذف النسخ الاحتياطية القديمة (أكثر من 30 يوم)
        $old_backups = glob($log_file . '.*.bak');
        foreach ($old_backups as $backup) {
            if (filemtime($backup) < (time() - 30 * 24 * 60 * 60)) {
                unlink($backup);
            }
        }
    }
    
    /**
     * فحص محاولات تسجيل الدخول المفشلة
     */
    private static function check_failed_login_attempts($ip) {
        $attempts = get_transient('muhtawaa_failed_login_' . md5($ip));
        
        if (!$attempts) {
            $attempts = 1;
        } else {
            $attempts++;
        }
        
        set_transient('muhtawaa_failed_login_' . md5($ip), $attempts, HOUR_IN_SECONDS);
        
        // حظر IP بعد 5 محاولات فاشلة
        if ($attempts >= 5) {
            self::block_ip($ip);
        }
    }
    
    /**
     * حظر عنوان IP
     */
    private static function block_ip($ip) {
        $blocked_ips = get_option('muhtawaa_blocked_ips', array());
        
        if (!in_array($ip, $blocked_ips)) {
            $blocked_ips[] = $ip;
            update_option('muhtawaa_blocked_ips', $blocked_ips);
        }
        
        // تسجيل عملية الحظر
        $log_data = array(
            'timestamp' => current_time('mysql'),
            'ip' => $ip,
            'type' => 'ip_blocked',
            'reason' => 'multiple_failed_logins'
        );
        
        self::write_security_log($log_data);
    }
    
    /**
     * فحص IP المحظورة
     */
    public static function check_blocked_ips() {
        $user_ip = self::get_user_ip();
        $blocked_ips = get_option('muhtawaa_blocked_ips', array());
        
        if (in_array($user_ip, $blocked_ips)) {
            wp_die(__('عنوان IP الخاص بك محظور', 'muhtawaa'), 403);
        }
    }
    
    /**
     * حماية رفع الملفات
     */
    public static function secure_file_upload($file, $filename, $mimes, $real_mime) {
        // قائمة بالملفات المحظورة
        $dangerous_extensions = array(
            'php', 'php3', 'php4', 'php5', 'phtml', 'exe', 'bat', 'com', 'cmd', 'scr',
            'pif', 'jar', 'vb', 'vbs', 'ws', 'wsf', 'wsc', 'wsh', 'asp', 'aspx',
            'cer', 'csr', 'jsp', 'drv', 'sys', 'ade', 'adp', 'app', 'asa', 'ashx',
            'bas', 'cdx', 'chtm', 'class', 'cpl', 'crt', 'csh', 'fxp', 'hlp',
            'hta', 'ins', 'isp', 'jse', 'lnk', 'mdz', 'msc', 'msi', 'msp', 'mst',
            'ops', 'pcd', 'prg', 'reg', 'scf', 'sct', 'shb', 'shs', 'url', 'vbe',
            'wsc', 'wsf', 'wsh'
        );
        
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($extension), $dangerous_extensions)) {
            $file['error'] = __('نوع الملف غير مسموح به لأسباب أمنية', 'muhtawaa');
        }
        
        // فحص محتوى الملف للكود الضار
        if (isset($_FILES['async-upload']['tmp_name'])) {
            $file_content = file_get_contents($_FILES['async-upload']['tmp_name']);
            
            $malicious_patterns = array(
                '<?php',
                '<?=',
                '<script',
                'eval(',
                'base64_decode(',
                'exec(',
                'system(',
                'shell_exec(',
                'passthru(',
                'file_get_contents(',
                'file_put_contents(',
                'fwrite(',
                'fopen('
            );
            
            foreach ($malicious_patterns as $pattern) {
                if (stripos($file_content, $pattern) !== false) {
                    $file['error'] = __('الملف يحتوي على كود ضار', 'muhtawaa');
                    break;
                }
            }
        }
        
        return $file;
    }
    
    /**
     * إضافة رؤوس الأمان
     */
    public static function add_security_headers() {
        // منع تضمين الموقع في إطارات أخرى
        header('X-Frame-Options: SAMEORIGIN');
        
        // منع MIME type sniffing
        header('X-Content-Type-Options: nosniff');
        
        // تفعيل XSS Protection
        header('X-XSS-Protection: 1; mode=block');
        
        // Referrer Policy
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        // Content Security Policy
        if (!is_admin()) {
            $csp = "default-src 'self'; " .
                   "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://fonts.googleapis.com; " .
                   "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; " .
                   "img-src 'self' data: https:; " .
                   "font-src 'self' https://fonts.gstatic.com; " .
                   "connect-src 'self';";
            
            header('Content-Security-Policy: ' . $csp);
        }
        
        // Feature Policy
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    }
    
    /**
     * حظر الطلبات الضارة
     */
    public static function block_malicious_requests() {
        $request_uri = $_SERVER['REQUEST_URI'];
        $query_string = $_SERVER['QUERY_STRING'];
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        
        // أنماط الطلبات المشبوهة
        $malicious_patterns = array(
            'wp-config.php',
            'passwd',
            '/etc/',
            'proc/self/environ',
            'mosConfig_',
            'javascript:',
            'base64_',
            '..%2F',
            '..%252F',
            '..%c0%af',
            '..%c1%9c',
            'union.*select',
            'concat.*\(',
            'group.*by',
            'script.*>',
            '<.*iframe',
            'eval.*\('
        );
        
        $full_request = strtolower($request_uri . ' ' . $query_string . ' ' . $user_agent);
        
        foreach ($malicious_patterns as $pattern) {
            if (preg_match('/' . $pattern . '/i', $full_request)) {
                // تسجيل الطلب المشبوه
                $log_data = array(
                    'timestamp' => current_time('mysql'),
                    'ip' => self::get_user_ip(),
                    'request_uri' => $request_uri,
                    'user_agent' => $user_agent,
                    'pattern_matched' => $pattern,
                    'type' => 'malicious_request_blocked'
                );
                
                self::write_security_log($log_data);
                
                wp_die(__('طلب مشبوه مرفوض', 'muhtawaa'), 403);
            }
        }
    }
    
    /**
     * تشفير البيانات الحساسة
     */
    public static function encrypt_sensitive_data($data) {
        if (!function_exists('openssl_encrypt')) {
            return $data; // إرجاع البيانات كما هي إذا لم يكن التشفير متاحاً
        }
        
        $key = self::get_encryption_key();
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        
        return base64_encode($iv . $encrypted);
    }
    
    /**
     * فك تشفير البيانات
     */
    public static function decrypt_sensitive_data($encrypted_data) {
        if (!function_exists('openssl_decrypt')) {
            return $encrypted_data;
        }
        
        $data = base64_decode($encrypted_data);
        $iv = substr($data, 0, 16);
        $encrypted = substr($data, 16);
        $key = self::get_encryption_key();
        
        return openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);
    }
    
    /**
     * الحصول على مفتاح التشفير
     */
    private static function get_encryption_key() {
        $key = get_option('muhtawaa_encryption_key');
        
        if (!$key) {
            $key = wp_generate_password(32, false);
            update_option('muhtawaa_encryption_key', $key);
        }
        
        return $key;
    }
    
    /**
     * تنظيف المدخلات من الجلسة
     */
    public static function sanitize_inputs() {
        // تنظيف متغيرات الجلسة
        if (isset($_SESSION)) {
            $_SESSION = array_map('sanitize_text_field', $_SESSION);
        }
        
        // تنظيف الكوكيز
        if (isset($_COOKIE)) {
            $_COOKIE = array_map('sanitize_text_field', $_COOKIE);
        }
    }
    
    /**
     * إنشاء تقرير أمان يومي
     */
    public static function generate_daily_security_report() {
        $log_file = WP_CONTENT_DIR . '/muhtawaa-security.log';
        
        if (!file_exists($log_file)) {
            return;
        }
        
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $logs = file($log_file, FILE_IGNORE_NEW_LINES);
        $daily_logs = array();
        
        foreach ($logs as $log) {
            if (strpos($log, $yesterday) === 0) {
                $daily_logs[] = $log;
            }
        }
        
        if (!empty($daily_logs)) {
            $report = array(
                'date' => $yesterday,
                'total_events' => count($daily_logs),
                'failed_logins' => 0,
                'blocked_ips' => 0,
                'malicious_requests' => 0
            );
            
            foreach ($daily_logs as $log) {
                if (strpos($log, 'failed_login') !== false) {
                    $report['failed_logins']++;
                } elseif (strpos($log, 'ip_blocked') !== false) {
                    $report['blocked_ips']++;
                } elseif (strpos($log, 'malicious_request') !== false) {
                    $report['malicious_requests']++;
                }
            }
            
            // إرسال التقرير بالإيميل للمشرف
            self::send_security_report_email($report);
        }
    }
    
    /**
     * إرسال تقرير الأمان بالإيميل
     */
    private static function send_security_report_email($report) {
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');
        
        $subject = sprintf(__('تقرير الأمان اليومي - %s', 'muhtawaa'), $site_name);
        
        $message = sprintf(
            __('تقرير الأمان ليوم %s:%s', 'muhtawaa'),
            $report['date'],
            PHP_EOL . PHP_EOL
        );
        
        $message .= sprintf(__('إجمالي الأحداث: %d', 'muhtawaa'), $report['total_events']) . PHP_EOL;
        $message .= sprintf(__('محاولات تسجيل دخول فاشلة: %d', 'muhtawaa'), $report['failed_logins']) . PHP_EOL;
        $message .= sprintf(__('عناوين IP محظورة: %d', 'muhtawaa'), $report['blocked_ips']) . PHP_EOL;
        $message .= sprintf(__('طلبات ضارة محظورة: %d', 'muhtawaa'), $report['malicious_requests']) . PHP_EOL;
        
        wp_mail($admin_email, $subject, $message);
    }
}

// تفعيل فحص IP المحظورة في بداية كل طلب
add_action('init', array('MuhtawaaSecurity', 'check_blocked_ips'), 1);

// إنشاء تقرير أمان يومي
if (!wp_next_scheduled('muhtawaa_daily_security_report')) {
    wp_schedule_event(time(), 'daily', 'muhtawaa_daily_security_report');
}
add_action('muhtawaa_daily_security_report', array('MuhtawaaSecurity', 'generate_daily_security_report'));