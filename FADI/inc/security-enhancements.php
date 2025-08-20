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
        add_action('wp_head', array($this, 'add_security_headers'));
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
        
        // إخفاء معلومات الخادم
        if (!headers_sent()) {
            header_remove('X-Powered-By');
            header_remove('Server');
        }
        
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
        // منع الوصول لملفات التكوين الحساسة
        add_action('wp_head', array($this, 'add_htaccess_security_rules'));
        
        // تشفير قاعدة البيانات
        if (!defined('DB_CHARSET')) {
            define('DB_CHARSET', 'utf8mb4');
        }
        
        // تحديد مفاتيح الأمان
        $this->ensure_security_keys();
    }
    
    /**
     * إضافة قوانين الأمان في .htaccess
     */
    public function add_htaccess_security_rules() {
        $htaccess_content = '
# FADI Security Rules
<Files "wp-config.php">
    Order deny,allow
    Deny from all
</Files>

<Files ".htaccess">
    Order deny,allow
    Deny from all
</Files>

# منع الوصول للملفات الحساسة
<FilesMatch "^(wp-config\.php|\.htaccess|readme\.html|license\.txt)$">
    Order deny,allow
    Deny from all
</FilesMatch>

# حماية ضد الحقن
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
    RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
    RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2}) [OR]
    RewriteCond %{QUERY_STRING} \.\./\.\./\.\./\.\./etc/passwd [OR]
    RewriteCond %{QUERY_STRING} (javascript:|vbscript:|onload=) [NC,OR]
    RewriteCond %{QUERY_STRING} (<|%3C)([^s]*s)+cript.*(>|%3E) [NC,OR]
    RewriteCond %{QUERY_STRING} (\<|%3C).*embed.*(\>|%3E) [NC]
    RewriteRule ^(.*)$ - [F,L]
</IfModule>
';
        
        // سيتم كتابة هذا في ملف .htaccess عند التفعيل
        update_option('fadi_htaccess_rules', $htaccess_content);
    }
    
    /**
     * التأكد من وجود مفاتيح الأمان
     */
    private function ensure_security_keys() {
        $keys = array(
            'AUTH_KEY',
            'SECURE_AUTH_KEY',
            'LOGGED_IN_KEY',
            'NONCE_KEY',
            'AUTH_SALT',
            'SECURE_AUTH_SALT',
            'LOGGED_IN_SALT',
            'NONCE_SALT'
        );
        
        foreach ($keys as $key) {
            if (!defined($key) || constant($key) === '') {
                // تحذير للمطور لتحديد المفاتيح
                error_log("FADI Security Warning: {$key} غير محدد");
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
        
        if (!defined('DISALLOW_FILE_MODS')) {
            define('DISALLOW_FILE_MODS', true);
        }
    }
    
    /**
     * تأمين الجلسات
     */
    private function secure_sessions() {
        // تحديد مدة انتهاء الجلسة
        add_filter('auth_cookie_expiration', array($this, 'set_session_timeout'));
        
        // تجديد الجلسة عند تغيير الصلاحيات
        add_action('set_user_role', array($this, 'regenerate_session'));
        
        // فرض تسجيل الخروج عند عدم النشاط
        add_action('init', array($this, 'check_session_timeout'));
    }
    
    /**
     * تحديد مهلة انتهاء الجلسة
     */
    public function set_session_timeout($expiration) {
        $timeout = get_theme_mod('fadi_session_timeout', 60) * MINUTE_IN_SECONDS;
        return min($expiration, $timeout);
    }
    
    /**
     * تجديد الجلسة
     */
    public function regenerate_session($user_id) {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }
    
    /**
     * فحص انتهاء الجلسة
     */
    public function check_session_timeout() {
        if (is_user_logged_in()) {
            $last_activity = get_user_meta(get_current_user_id(), 'fadi_last_activity', true);
            $timeout = get_theme_mod('fadi_session_timeout', 60) * MINUTE_IN_SECONDS;
            
            if ($last_activity && (time() - $last_activity) > $timeout) {
                wp_logout();
                wp_redirect(home_url('/'));
                exit;
            }
            
            // تحديث آخر نشاط
            update_user_meta(get_current_user_id(), 'fadi_last_activity', time());
        }
    }
    
    /**
     * فرض استخدام HTTPS
     */
    private function force_ssl() {
        if (!is_ssl() && !is_admin()) {
            add_action('template_redirect', array($this, 'redirect_to_ssl'));
        }
        
        // تحديد HTTPS للكوكيز
        add_filter('secure_auth_cookie', '__return_true');
        add_filter('secure_logged_in_cookie', '__return_true');
    }
    
    /**
     * إعادة التوجيه إلى HTTPS
     */
    public function redirect_to_ssl() {
        if (!is_ssl()) {
            $redirect_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            wp_redirect($redirect_url, 301);
            exit;
        }
    }
    
    /**
     * منع XSS
     */
    private function prevent_xss() {
        // تنظيف المدخلات
        add_action('init', array($this, 'sanitize_global_inputs'));
        
        // إضافة Content Security Policy
        add_action('wp_head', array($this, 'add_csp_header'));
    }
    
    /**
     * تنظيف المدخلات العامة
     */
    public function sanitize_global_inputs() {
        $_GET = array_map('strip_tags', $_GET);
        $_POST = array_map('strip_tags', $_POST);
        $_COOKIE = array_map('strip_tags', $_COOKIE);
        $_REQUEST = array_map('strip_tags', $_REQUEST);
    }
    
    /**
     * إضافة Content Security Policy
     */
    public function add_csp_header() {
        $csp = "default-src 'self'; ";
        $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com https://cdnjs.cloudflare.com; ";
        $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
        $csp .= "font-src 'self' https://fonts.gstatic.com; ";
        $csp .= "img-src 'self' data: https:; ";
        $csp .= "connect-src 'self';";
        
        header("Content-Security-Policy: " . $csp);
    }
    
    /**
     * منع CSRF
     */
    private function prevent_csrf() {
        // إضافة nonce لجميع النماذج
        add_action('wp_footer', array($this, 'add_csrf_protection'));
        
        // فحص nonce في الطلبات
        add_action('init', array($this, 'verify_csrf_token'));
    }
    
    /**
     * إضافة حماية CSRF
     */
    public function add_csrf_protection() {
        if (is_user_logged_in()) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var forms = document.querySelectorAll("form");
                forms.forEach(function(form) {
                    if (!form.querySelector("input[name=\'_wpnonce\']")) {
                        var nonce = document.createElement("input");
                        nonce.type = "hidden";
                        nonce.name = "_wpnonce";
                        nonce.value = "' . wp_create_nonce('fadi_csrf') . '";
                        form.appendChild(nonce);
                    }
                });
            });
            </script>';
        }
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
     * إضافة Headers الأمان
     */
    public function add_security_headers() {
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
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        );
        
        update_option('fadi_failed_logins', $attempts);
        
        // تسجيل في ملف اللوج
        if (get_theme_mod('fadi_log_activities', true)) {
            error_log("FADI Security: Failed login attempt for '{$username}' from {$ip}");
        }
    }
    
    /**
     * تسجيل تسجيل الدخول الناجح
     */
    public function log_successful_login($user_login, $user) {
        $ip = $this->get_client_ip();
        
        // مسح محاولات الدخول الفاشلة للـ IP
        $attempts = get_option('fadi_failed_logins', array());
        if (isset($attempts[$ip])) {
            unset($attempts[$ip]);
            update_option('fadi_failed_logins', $attempts);
        }
        
        // تسجيل النشاط
        if (get_theme_mod('fadi_log_activities', true)) {
            error_log("FADI Security: Successful login for '{$user_login}' from {$ip}");
        }
        
        // تحديث آخر تسجيل دخول
        update_user_meta($user->ID, 'fadi_last_login', current_time('timestamp'));
        update_user_meta($user->ID, 'fadi_last_login_ip', $ip);
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
                return (current_time('timestamp') - $attempt['time']) < (15 * MINUTE_IN_SECONDS);
            });
            
            if (count($recent_attempts) >= 5) {
                return new WP_Error('too_many_attempts', __('تم تجاوز عدد محاولات تسجيل الدخول المسموح. حاول مرة أخرى بعد 15 دقيقة.', 'fadi'));
            }
        }
        
        return $user;
    }
    
    /**
     * رسالة خطأ عامة لتسجيل الدخول
     */
    public function generic_login_error($error) {
        return __('خطأ في بيانات تسجيل الدخول', 'fadi');
    }
    
    /**
     * الحصول على IP العميل
     */
    private function get_client_ip() {
        $ip_keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
        
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
        
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
    
    /**
     * تنظيف السجلات القديمة
     */
    public function cleanup_old_logs() {
        $attempts = get_option('fadi_failed_logins', array());
        $cutoff_time = current_time('timestamp') - (7 * DAY_IN_SECONDS);
        
        foreach ($attempts as $ip => $attempts_list) {
            $attempts[$ip] = array_filter($attempts_list, function($attempt) use ($cutoff_time) {
                return $attempt['time'] > $cutoff_time;
            });
            
            if (empty($attempts[$ip])) {
                unset($attempts[$ip]);
            }
        }
        
        update_option('fadi_failed_logins', $attempts);
    }
}

// تهيئة تحسينات الأمان
new FADI_Security_Enhancements();

/**
 * إضافة Cron Job لتنظيف السجلات
 */
function fadi_schedule_security_cleanup() {
    if (!wp_next_scheduled('fadi_security_cleanup')) {
        wp_schedule_event(time(), 'daily', 'fadi_security_cleanup');
    }
}
add_action('wp', 'fadi_schedule_security_cleanup');

/**
 * تنفيذ تنظيف السجلات
 */
function fadi_run_security_cleanup() {
    $security = new FADI_Security_Enhancements();
    $security->cleanup_old_logs();
}
add_action('fadi_security_cleanup', 'fadi_run_security_cleanup');

/**
 * إضافة تبويب الأمان في لوحة الإدارة
 */
function fadi_add_security_admin_page() {
    add_submenu_page(
        'fadi-dashboard',
        __('سجلات الأمان', 'fadi'),
        __('سجلات الأمان', 'fadi'),
        'manage_options',
        'fadi-security-logs',
        'fadi_security_logs_page'
    );
}
add_action('admin_menu', 'fadi_add_security_admin_page');

/**
 * صفحة سجلات الأمان
 */
function fadi_security_logs_page() {
    $failed_logins = get_option('fadi_failed_logins', array());
    ?>
    <div class="wrap">
        <h1><?php _e('سجلات الأمان', 'fadi'); ?></h1>
        
        <div class="fadi-security-stats">
            <h2><?php _e('إحصائيات الأمان', 'fadi'); ?></h2>
            <div class="fadi-stats-grid">
                <div class="fadi-stat-item">
                    <strong><?php echo count($failed_logins); ?></strong>
                    <span><?php _e('عناوين IP مشبوهة', 'fadi'); ?></span>
                </div>
                <div class="fadi-stat-item">
                    <strong><?php 
                    $total_attempts = 0;
                    foreach ($failed_logins as $ip_attempts) {
                        $total_attempts += count($ip_attempts);
                    }
                    echo $total_attempts;
                    ?></strong>
                    <span><?php _e('محاولات دخول فاشلة', 'fadi'); ?></span>
                </div>
            </div>
        </div>
        
        <?php if (!empty($failed_logins)): ?>
        <div class="fadi-security-logs">
            <h2><?php _e('محاولات تسجيل الدخول الفاشلة', 'fadi'); ?></h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php _e('عنوان IP', 'fadi'); ?></th>
                        <th><?php _e('اسم المستخدم', 'fadi'); ?></th>
                        <th><?php _e('الوقت', 'fadi'); ?></th>
                        <th><?php _e('متصفح المستخدم', 'fadi'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($failed_logins as $ip => $attempts): ?>
                        <?php foreach ($attempts as $attempt): ?>
                        <tr>
                            <td><strong><?php echo esc_html($ip); ?></strong></td>
                            <td><?php echo esc_html($attempt['username']); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', $attempt['time']); ?></td>
                            <td><?php echo esc_html(substr($attempt['user_agent'], 0, 50) . '...'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="notice notice-success">
            <p><?php _e('لا توجد محاولات دخول فاشلة مسجلة', 'fadi'); ?></p>
        </div>
        <?php endif; ?>
        
        <div class="fadi-security-actions">
            <h2><?php _e('إجراءات الأمان', 'fadi'); ?></h2>
            <p>
                <a href="?page=fadi-security-logs&action=clear_logs" class="button" onclick="return confirm('هل أنت متأكد من مسح جميع السجلات؟')"><?php _e('مسح جميع السجلات', 'fadi'); ?></a>
                <a href="?page=fadi-security-logs&action=export_logs" class="button button-primary"><?php _e('تصدير السجلات', 'fadi'); ?></a>
            </p>
        </div>
    </div>
    
    <style>
    .fadi-stats-grid {
        display: flex;
        gap: 20px;
        margin: 20px 0;
    }
    .fadi-stat-item {
        background: white;
        padding: 20px;
        border-radius: 5px;
        border-left: 4px solid #dc3545;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        text-align: center;
        min-width: 150px;
    }
    .fadi-stat-item strong {
        display: block;
        font-size: 2rem;
        color: #dc3545;
    }
    .fadi-security-logs {
        margin: 30px 0;
    }
    .fadi-security-actions {
        margin: 30px 0;
        padding: 20px;
        background: white;
        border-radius: 5px;
        border-left: 4px solid #28a745;
    }
    </style>
    
    <?php
    // معالجة الإجراءات
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'clear_logs':
                delete_option('fadi_failed_logins');
                echo '<div class="notice notice-success"><p>' . __('تم مسح جميع السجلات بنجاح', 'fadi') . '</p></div>';
                break;
            case 'export_logs':
                $filename = 'fadi-security-logs-' . date('Y-m-d') . '.json';
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                echo json_encode($failed_logins, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                exit;
                break;
        }
    }
}

/**
 * تنبيهات الأمان في لوحة التحكم
 */
function fadi_security_dashboard_widget() {
    $failed_logins = get_option('fadi_failed_logins', array());
    $recent_attempts = 0;
    
    foreach ($failed_logins as $ip_attempts) {
        foreach ($ip_attempts as $attempt) {
            if ((current_time('timestamp') - $attempt['time']) < (24 * HOUR_IN_SECONDS)) {
                $recent_attempts++;
            }
        }
    }
    
    if ($recent_attempts > 0) {
        echo '<div class="notice notice-warning"><p>';
        printf(__('تنبيه أمني: تم رصد %d محاولة دخول فاشلة خلال آخر 24 ساعة.', 'fadi'), $recent_attempts);
        echo ' <a href="admin.php?page=fadi-security-logs">' . __('مراجعة السجلات', 'fadi') . '</a>';
        echo '</p></div>';
    }
}
add_action('admin_notices', 'fadi_security_dashboard_widget');