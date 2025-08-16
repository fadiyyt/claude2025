<?php
/**
 * Security Enhancements - Advanced Version
 * تحسينات الأمان المتقدمة
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Security_Enhancements {
    
    private $options;
    private $failed_attempts = [];
    
    public function __construct() {
        $this->options = get_option('ps_security_settings', []);
        
        add_action('init', [$this, 'init_security']);
        add_action('wp_login_failed', [$this, 'log_failed_login']);
        add_action('wp_login', [$this, 'log_successful_login'], 10, 2);
        add_filter('authenticate', [$this, 'check_login_attempts'], 30, 3);
        add_action('init', [$this, 'add_security_headers']);
        add_action('admin_init', [$this, 'admin_security_checks']);
        
        // حماية ملفات النظام
        add_action('template_redirect', [$this, 'protect_system_files']);
        
        // حماية من هجمات XSS و CSRF
        add_action('wp_loaded', [$this, 'setup_csrf_protection']);
        
        // مراقبة تغييرات الملفات
        if ($this->is_enabled('file_monitoring')) {
            add_action('ps_daily_security_check', [$this, 'check_file_integrity']);
        }
    }
    
    public function init_security() {
        // إخفاء رقم إصدار WordPress
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // إخفاء أخطاء تسجيل الدخول
        add_filter('login_errors', [$this, 'generic_login_error']);
        
        // منع enumeration للمستخدمين
        if ($this->is_enabled('prevent_user_enumeration')) {
            add_action('template_redirect', [$this, 'prevent_user_enumeration']);
        }
        
        // تعطيل XML-RPC إذا لم يكن مطلوباً
        if ($this->is_enabled('disable_xmlrpc')) {
            add_filter('xmlrpc_enabled', '__return_false');
        }
        
        // حماية wp-config.php
        $this->protect_wp_config();
        
        // جدولة فحص أمني يومي
        if (!wp_next_scheduled('ps_daily_security_check')) {
            wp_schedule_event(time(), 'daily', 'ps_daily_security_check');
        }
    }
    
    public function log_failed_login($username) {
        $ip = $this->get_real_ip();
        $attempts = get_option('ps_failed_logins', []);
        
        if (!isset($attempts[$ip])) {
            $attempts[$ip] = [];
        }
        
        $attempts[$ip][] = [
            'username' => sanitize_user($username),
            'time' => current_time('timestamp'),
            'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? '')
        ];
        
        // الاحتفاظ بآخر 10 محاولات لكل IP
        if (count($attempts[$ip]) > 10) {
            $attempts[$ip] = array_slice($attempts[$ip], -10);
        }
        
        update_option('ps_failed_logins', $attempts);
        
        // إرسال تنبيه للمدير بعد 5 محاولات فاشلة
        if (count($attempts[$ip]) >= 5) {
            $this->send_security_alert('Multiple failed login attempts', [
                'IP' => $ip,
                'Username' => $username,
                'Attempts' => count($attempts[$ip])
            ]);
        }
    }
    
    public function log_successful_login($user_login, $user) {
        $ip = $this->get_real_ip();
        
        // مسح محاولات تسجيل الدخول الفاشلة للـ IP
        $attempts = get_option('ps_failed_logins', []);
        if (isset($attempts[$ip])) {
            unset($attempts[$ip]);
            update_option('ps_failed_logins', $attempts);
        }
        
        // تسجيل تسجيل الدخول الناجح
        $successful_logins = get_option('ps_successful_logins', []);
        $successful_logins[] = [
            'user_id' => $user->ID,
            'username' => $user_login,
            'ip' => $ip,
            'time' => current_time('timestamp'),
            'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? '')
        ];
        
        // الاحتفاظ بآخر 50 تسجيل دخول ناجح
        if (count($successful_logins) > 50) {
            $successful_logins = array_slice($successful_logins, -50);
        }
        
        update_option('ps_successful_logins', $successful_logins);
    }
    
    public function check_login_attempts($user, $username, $password) {
        if (empty($username) || empty($password)) {
            return $user;
        }
        
        $ip = $this->get_real_ip();
        $attempts = get_option('ps_failed_logins', []);
        
        if (isset($attempts[$ip])) {
            $recent_attempts = array_filter($attempts[$ip], function($attempt) {
                return (current_time('timestamp') - $attempt['time']) < 3600; // آخر ساعة
            });
            
            if (count($recent_attempts) >= 5) {
                return new WP_Error('too_many_attempts', 
                    __('تم تجاوز عدد محاولات تسجيل الدخول المسموح. يرجى المحاولة بعد ساعة.', 'practical-solutions')
                );
            }
        }
        
        return $user;
    }
    
    public function generic_login_error($error) {
        return __('اسم المستخدم أو كلمة المرور غير صحيحة.', 'practical-solutions');
    }
    
    public function prevent_user_enumeration() {
        if (is_admin() || current_user_can('administrator')) {
            return;
        }
        
        // منع ?author=1
        if (isset($_GET['author']) || preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
            wp_redirect(home_url(), 301);
            exit;
        }
        
        // منع REST API user enumeration
        add_filter('rest_endpoints', function($endpoints) {
            if (isset($endpoints['/wp/v2/users'])) {
                unset($endpoints['/wp/v2/users']);
            }
            if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
                unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
            }
            return $endpoints;
        });
    }
    
    public function add_security_headers() {
        if (!is_admin()) {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
            
            if (is_ssl()) {
                header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
            }
        }
    }
    
    public function protect_system_files() {
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';
        
        // حماية ملفات النظام الحساسة
        $protected_files = [
            'wp-config.php',
            '.htaccess',
            'error_log',
            'debug.log',
            'wp-config-sample.php'
        ];
        
        foreach ($protected_files as $file) {
            if (strpos($request_uri, $file) !== false) {
                status_header(404);
                nocache_headers();
                include(get_404_template());
                exit;
            }
        }
        
        // حماية مجلدات النظام
        $protected_dirs = [
            '/wp-admin/',
            '/wp-includes/',
            '/wp-content/themes/',
            '/wp-content/plugins/'
        ];
        
        foreach ($protected_dirs as $dir) {
            if (strpos($request_uri, $dir) !== false && 
                (strpos($request_uri, '.php') === false || 
                 preg_match('/\.(txt|log|sql|md)$/i', $request_uri))) {
                status_header(403);
                exit(__('الوصول مرفوض', 'practical-solutions'));
            }
        }
    }
    
    public function setup_csrf_protection() {
        // إضافة nonce للنماذج
        add_action('wp_footer', function() {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var forms = document.querySelectorAll("form[method=post]");
                forms.forEach(function(form) {
                    if (!form.querySelector("input[name*=nonce]")) {
                        var nonce = document.createElement("input");
                        nonce.type = "hidden";
                        nonce.name = "ps_security_nonce";
                        nonce.value = "' . wp_create_nonce('ps_security_action') . '";
                        form.appendChild(nonce);
                    }
                });
            });
            </script>';
        });
        
        // التحقق من CSRF للطلبات POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !is_admin()) {
            $this->verify_csrf_token();
        }
    }
    
    private function verify_csrf_token() {
        $excluded_actions = [
            'wp-login.php',
            'wp-comments-post.php'
        ];
        
        $script_name = basename($_SERVER['SCRIPT_NAME']);
        
        if (in_array($script_name, $excluded_actions)) {
            return;
        }
        
        if (!isset($_POST['ps_security_nonce']) || 
            !wp_verify_nonce($_POST['ps_security_nonce'], 'ps_security_action')) {
            
            wp_die(__('رمز الأمان غير صحيح. يرجى تحديث الصفحة والمحاولة مرة أخرى.', 'practical-solutions'));
        }
    }
    
    public function protect_wp_config() {
        $wp_config_path = ABSPATH . 'wp-config.php';
        
        if (file_exists($wp_config_path)) {
            $permissions = fileperms($wp_config_path) & 0777;
            
            // التأكد من أن الصلاحيات ليست 777 أو 666
            if ($permissions === 0777 || $permissions === 0666) {
                chmod($wp_config_path, 0644);
            }
        }
    }
    
    public function admin_security_checks() {
        if (!current_user_can('administrator')) {
            return;
        }
        
        // فحص كلمات مرور ضعيفة
        $this->check_weak_passwords();
        
        // فحص المستخدمين المشبوهين
        $this->check_suspicious_users();
        
        // فحص الإضافات المعطلة أو القديمة
        $this->check_plugins_security();
    }
    
    private function check_weak_passwords() {
        $weak_passwords = ['admin', 'password', '123456', 'wordpress'];
        $users = get_users(['role' => 'administrator']);
        
        foreach ($users as $user) {
            foreach ($weak_passwords as $weak_pass) {
                if (wp_check_password($weak_pass, $user->user_pass, $user->ID)) {
                    add_action('admin_notices', function() use ($user) {
                        echo '<div class="notice notice-error"><p>';
                        echo sprintf(__('تحذير: المستخدم "%s" يستخدم كلمة مرور ضعيفة!', 'practical-solutions'), $user->user_login);
                        echo '</p></div>';
                    });
                    break;
                }
            }
        }
    }
    
    private function check_suspicious_users() {
        $suspicious_usernames = ['admin', 'administrator', 'root', 'test', 'demo'];
        
        foreach ($suspicious_usernames as $username) {
            $user = get_user_by('login', $username);
            if ($user && in_array('administrator', $user->roles)) {
                add_action('admin_notices', function() use ($username) {
                    echo '<div class="notice notice-warning"><p>';
                    echo sprintf(__('تحذير: يوجد مستخدم مدير باسم مشبوه "%s". يُنصح بتغيير اسم المستخدم.', 'practical-solutions'), $username);
                    echo '</p></div>';
                });
            }
        }
    }
    
    private function check_plugins_security() {
        $plugins = get_plugins();
        $active_plugins = get_option('active_plugins', []);
        
        foreach ($plugins as $plugin_file => $plugin_data) {
            if (!in_array($plugin_file, $active_plugins)) {
                continue;
            }
            
            // فحص الإضافات القديمة
            $wp_version = get_bloginfo('version');
            if (isset($plugin_data['RequiresWP']) && 
                version_compare($plugin_data['RequiresWP'], $wp_version, '>')) {
                
                add_action('admin_notices', function() use ($plugin_data) {
                    echo '<div class="notice notice-warning"><p>';
                    echo sprintf(__('تحذير: الإضافة "%s" قد تكون غير متوافقة مع إصدار WordPress الحالي.', 'practical-solutions'), $plugin_data['Name']);
                    echo '</p></div>';
                });
            }
        }
    }
    
    public function check_file_integrity() {
        $core_files = [
            ABSPATH . 'wp-config.php',
            ABSPATH . 'wp-load.php',
            ABSPATH . 'wp-blog-header.php'
        ];
        
        $stored_hashes = get_option('ps_file_hashes', []);
        $current_hashes = [];
        $modified_files = [];
        
        foreach ($core_files as $file) {
            if (file_exists($file)) {
                $current_hash = md5_file($file);
                $current_hashes[$file] = $current_hash;
                
                if (isset($stored_hashes[$file]) && 
                    $stored_hashes[$file] !== $current_hash) {
                    $modified_files[] = $file;
                }
            }
        }
        
        if (!empty($modified_files)) {
            $this->send_security_alert('Core files modified', [
                'files' => $modified_files,
                'time' => current_time('mysql')
            ]);
        }
        
        update_option('ps_file_hashes', $current_hashes);
    }
    
    private function send_security_alert($type, $data) {
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');
        
        $subject = sprintf(__('[%s] تنبيه أمني: %s', 'practical-solutions'), $site_name, $type);
        
        $message = __('تم رصد نشاط أمني مشبوه على موقعك:', 'practical-solutions') . "\n\n";
        $message .= __('نوع التنبيه:', 'practical-solutions') . ' ' . $type . "\n";
        $message .= __('الوقت:', 'practical-solutions') . ' ' . current_time('mysql') . "\n\n";
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $message .= $key . ": \n" . implode("\n", $value) . "\n\n";
            } else {
                $message .= $key . ': ' . $value . "\n";
            }
        }
        
        $message .= "\n" . __('يرجى مراجعة موقعك والتأكد من أمانه.', 'practical-solutions');
        
        wp_mail($admin_email, $subject, $message);
    }
    
    private function get_real_ip() {
        $ip_keys = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];
        
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
        
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
    
    private function is_enabled($option) {
        return isset($this->options[$option]) && $this->options[$option];
    }
}

// تشغيل تحسينات الأمان
new PS_Security_Enhancements();