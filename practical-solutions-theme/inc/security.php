<?php
/**
 * Security Functions
 * وظائف الأمان والحماية
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * تحسين أمان رأس الصفحة
 * 
 * @since 1.0.0
 */
function practical_solutions_security_headers() {
    if (!is_admin()) {
        // منع clickjacking
        header('X-Frame-Options: SAMEORIGIN');
        
        // منع MIME type sniffing
        header('X-Content-Type-Options: nosniff');
        
        // تفعيل XSS protection
        header('X-XSS-Protection: 1; mode=block');
        
        // إزالة معلومات الخادم
        header_remove('X-Powered-By');
        header_remove('Server');
        
        // تحسين الأمان للمتصفحات الحديثة
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        // Content Security Policy أساسي
        $csp = "default-src 'self'; ";
        $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com https://fonts.gstatic.com; ";
        $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
        $csp .= "font-src 'self' https://fonts.gstatic.com data:; ";
        $csp .= "img-src 'self' data: https:; ";
        $csp .= "connect-src 'self'; ";
        $csp .= "frame-ancestors 'self';";
        
        header("Content-Security-Policy: {$csp}");
    }
}
add_action('send_headers', 'practical_solutions_security_headers');

/**
 * إزالة معلومات النسخة من ووردبريس
 * 
 * @since 1.0.0
 */
function practical_solutions_remove_version_info() {
    // إزالة نسخة ووردبريس من head
    remove_action('wp_head', 'wp_generator');
    
    // إزالة نسخة ووردبريس من RSS
    add_filter('the_generator', '__return_empty_string');
    
    // إزالة نسخة ووردبريس من CSS و JS
    add_filter('style_loader_src', 'practical_solutions_remove_version_from_src', 15);
    add_filter('script_loader_src', 'practical_solutions_remove_version_from_src', 15);
}
add_action('init', 'practical_solutions_remove_version_info');

/**
 * إزالة معاملات النسخة من الملفات
 * 
 * @param string $src رابط الملف
 * @return string الرابط بدون معاملات النسخة
 * @since 1.0.0
 */
function practical_solutions_remove_version_from_src($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

/**
 * تحسين أمان تسجيل الدخول
 * 
 * @since 1.0.0
 */
function practical_solutions_login_security() {
    // منع عرض أخطاء تسجيل الدخول التفصيلية
    add_filter('authenticate', function($user, $username, $password) {
        if (is_wp_error($user)) {
            $error_codes = $user->get_error_codes();
            
            if (in_array('invalid_username', $error_codes) || in_array('incorrect_password', $error_codes)) {
                $user = new WP_Error('login_failed', esc_html__('اسم المستخدم أو كلمة المرور غير صحيحة.', 'practical-solutions'));
            }
        }
        return $user;
    }, 30, 3);
    
    // تحديد محاولات تسجيل الدخول
    add_action('wp_login_failed', 'practical_solutions_log_failed_login');
    add_action('wp_login', 'practical_solutions_log_successful_login', 10, 2);
}
add_action('init', 'practical_solutions_login_security');

/**
 * تسجيل محاولات تسجيل الدخول الفاشلة
 * 
 * @param string $username اسم المستخدم
 * @since 1.0.0
 */
function practical_solutions_log_failed_login($username) {
    $ip = practical_solutions_get_user_ip();
    $attempts = get_option('ps_failed_logins', array());
    
    $key = $ip . '_' . $username;
    $now = time();
    
    if (!isset($attempts[$key])) {
        $attempts[$key] = array();
    }
    
    $attempts[$key][] = $now;
    
    // الاحتفاظ بآخر 10 محاولات فقط
    $attempts[$key] = array_slice($attempts[$key], -10);
    
    // تنظيف المحاولات القديمة (أكثر من 24 ساعة)
    foreach ($attempts as $attempt_key => $attempt_times) {
        $attempts[$attempt_key] = array_filter($attempt_times, function($time) use ($now) {
            return ($now - $time) < 86400; // 24 ساعة
        });
        
        if (empty($attempts[$attempt_key])) {
            unset($attempts[$attempt_key]);
        }
    }
    
    update_option('ps_failed_logins', $attempts);
    
    // حظر IP إذا تجاوز 5 محاولات في ساعة واحدة
    $recent_attempts = array_filter($attempts[$key], function($time) use ($now) {
        return ($now - $time) < 3600; // ساعة واحدة
    });
    
    if (count($recent_attempts) >= 5) {
        practical_solutions_block_ip($ip, 'too_many_login_attempts');
    }
}

/**
 * تسجيل محاولات تسجيل الدخول الناجحة
 * 
 * @param string $user_login اسم المستخدم
 * @param WP_User $user بيانات المستخدم
 * @since 1.0.0
 */
function practical_solutions_log_successful_login($user_login, $user) {
    $ip = practical_solutions_get_user_ip();
    
    // تنظيف محاولات الفشل للمستخدم الناجح
    $attempts = get_option('ps_failed_logins', array());
    $key = $ip . '_' . $user_login;
    
    if (isset($attempts[$key])) {
        unset($attempts[$key]);
        update_option('ps_failed_logins', $attempts);
    }
    
    // تسجيل آخر تسجيل دخول
    update_user_meta($user->ID, '_ps_last_login', time());
    update_user_meta($user->ID, '_ps_last_login_ip', $ip);
}

/**
 * حظر عناوين IP المشبوهة
 * 
 * @param string $ip عنوان IP
 * @param string $reason سبب الحظر
 * @since 1.0.0
 */
function practical_solutions_block_ip($ip, $reason) {
    $blocked_ips = get_option('ps_blocked_ips', array());
    
    $blocked_ips[$ip] = array(
        'blocked_at' => time(),
        'reason'     => $reason,
        'expires'    => time() + 3600 // حظر لمدة ساعة
    );
    
    update_option('ps_blocked_ips', $blocked_ips);
    
    // تسجيل الحدث
    error_log("Practical Solutions: IP {$ip} blocked for {$reason}");
}

/**
 * فحص IP المحظورة
 * 
 * @since 1.0.0
 */
function practical_solutions_check_blocked_ips() {
    if (is_admin()) {
        return; // لا نحظر في لوحة التحكم
    }
    
    $ip = practical_solutions_get_user_ip();
    $blocked_ips = get_option('ps_blocked_ips', array());
    
    if (isset($blocked_ips[$ip])) {
        $block_info = $blocked_ips[$ip];
        
        // التحقق من انتهاء مدة الحظر
        if (time() > $block_info['expires']) {
            unset($blocked_ips[$ip]);
            update_option('ps_blocked_ips', $blocked_ips);
            return;
        }
        
        // عرض صفحة الحظر
        practical_solutions_show_blocked_page($block_info);
    }
}
add_action('init', 'practical_solutions_check_blocked_ips');

/**
 * عرض صفحة الحظر
 * 
 * @param array $block_info معلومات الحظر
 * @since 1.0.0
 */
function practical_solutions_show_blocked_page($block_info) {
    http_response_code(429);
    
    $time_left = $block_info['expires'] - time();
    $minutes_left = ceil($time_left / 60);
    
    echo '<!DOCTYPE html>';
    echo '<html dir="rtl" lang="ar">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>' . esc_html__('تم حظر الوصول', 'practical-solutions') . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f5f5f5; }
        .blocked-container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .blocked-icon { font-size: 48px; color: #e74c3c; margin-bottom: 20px; }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        p { color: #666; line-height: 1.6; margin-bottom: 15px; }
        .time-left { color: #e74c3c; font-weight: bold; }
    </style>';
    echo '</head>';
    echo '<body>';
    echo '<div class="blocked-container">';
    echo '<div class="blocked-icon">🚫</div>';
    echo '<h1>' . esc_html__('تم حظر الوصول مؤقتاً', 'practical-solutions') . '</h1>';
    echo '<p>' . esc_html__('تم حظر عنوان IP الخاص بك مؤقتاً بسبب نشاط مشبوه.', 'practical-solutions') . '</p>';
    echo '<p>' . sprintf(esc_html__('مدة الحظر المتبقية: %d دقيقة', 'practical-solutions'), $minutes_left) . '</p>';
    echo '<p class="time-left">' . esc_html__('إذا كنت تعتقد أن هذا خطأ، يرجى الاتصال بمدير الموقع.', 'practical-solutions') . '</p>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    exit;
}

/**
 * الحصول على عنوان IP الحقيقي للمستخدم
 * 
 * @return string عنوان IP
 * @since 1.0.0
 */
function practical_solutions_get_user_ip() {
    $ip_headers = array(
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_REAL_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    );
    
    foreach ($ip_headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ip = $_SERVER[$header];
            
            // التعامل مع عدة IPs مفصولة بفواصل
            if (strpos($ip, ',') !== false) {
                $ip = trim(explode(',', $ip)[0]);
            }
            
            // التحقق من صحة IP
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;
            }
        }
    }
    
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
}

/**
 * حماية من هجمات XML-RPC
 * 
 * @since 1.0.0
 */
function practical_solutions_secure_xmlrpc() {
    // تعطيل XML-RPC إذا لم يكن مطلوب
    if (get_theme_mod('practical_solutions_disable_xmlrpc', true)) {
        add_filter('xmlrpc_enabled', '__return_false');
        
        // إزالة RSD link
        remove_action('wp_head', 'rsd_link');
        
        // إزالة Windows Live Writer link
        remove_action('wp_head', 'wlwmanifest_link');
    }
    
    // حماية XML-RPC من الهجمات
    add_filter('xmlrpc_methods', function($methods) {
        // إزالة طرق خطيرة
        unset($methods['pingback.ping']);
        unset($methods['pingback.extensions.getPingbacks']);
        unset($methods['system.multicall']);
        unset($methods['system.listMethods']);
        
        return $methods;
    });
}
add_action('init', 'practical_solutions_secure_xmlrpc');

/**
 * حماية ملفات الإعدادات الحساسة
 * 
 * @since 1.0.0
 */
function practical_solutions_protect_sensitive_files() {
    // قائمة الملفات الحساسة
    $sensitive_files = array(
        'wp-config.php',
        '.htaccess',
        'error_log',
        'debug.log',
        'readme.html',
        'wp-config-sample.php'
    );
    
    foreach ($sensitive_files as $file) {
        if (strpos($_SERVER['REQUEST_URI'], $file) !== false) {
            http_response_code(404);
            exit;
        }
    }
}
add_action('init', 'practical_solutions_protect_sensitive_files');

/**
 * منع تصفح الدلائل
 * 
 * @since 1.0.0
 */
function practical_solutions_prevent_directory_browsing() {
    // التحقق من وجود index.php في مجلدات المظاهر
    $directories = array(
        get_template_directory() . '/inc',
        get_template_directory() . '/assets',
        get_template_directory() . '/assets/js',
        get_template_directory() . '/assets/css',
        get_template_directory() . '/assets/images',
        get_template_directory() . '/languages'
    );
    
    foreach ($directories as $dir) {
        $index_file = $dir . '/index.php';
        if (!file_exists($index_file) && is_dir($dir)) {
            file_put_contents($index_file, '<?php // Silence is golden');
        }
    }
}
add_action('after_switch_theme', 'practical_solutions_prevent_directory_browsing');

/**
 * تحسين أمان التعليقات
 * 
 * @since 1.0.0
 */
function practical_solutions_secure_comments() {
    // منع إرسال تعليقات من scripts
    add_action('pre_comment_on_post', function($comment_post_ID) {
        if (!isset($_POST['comment']) || empty($_POST['comment'])) {
            wp_die(esc_html__('التعليق مطلوب.', 'practical-solutions'));
        }
        
        // فحص السبام البسيط
        $comment_content = $_POST['comment'];
        $spam_patterns = array(
            '/\[url=.*?\]/i',
            '/\[link=.*?\]/i',
            '/http[s]?:\/\/.*?\.ru/i',
            '/\b(cialis|viagra|casino|poker)\b/i'
        );
        
        foreach ($spam_patterns as $pattern) {
            if (preg_match($pattern, $comment_content)) {
                wp_die(esc_html__('تم رفض التعليق كسبام.', 'practical-solutions'));
            }
        }
    });
    
    // إضافة معرف فريد للتعليقات
    add_filter('comment_form_default_fields', function($fields) {
        $fields['ps_token'] = '<input type="hidden" name="ps_comment_token" value="' . wp_create_nonce('ps_comment_' . get_the_ID()) . '" />';
        return $fields;
    });
    
    // التحقق من المعرف الفريد
    add_action('pre_comment_on_post', function($comment_post_ID) {
        if (!wp_verify_nonce($_POST['ps_comment_token'], 'ps_comment_' . $comment_post_ID)) {
            wp_die(esc_html__('فشل التحقق من الأمان.', 'practical-solutions'));
        }
    });
}
add_action('init', 'practical_solutions_secure_comments');

/**
 * حماية من هجمات البحث المتقدمة
 * 
 * @since 1.0.0
 */
function practical_solutions_secure_search() {
    // فحص استعلامات البحث المشبوهة
    if (isset($_GET['s'])) {
        $search_query = $_GET['s'];
        
        // فحص SQL injection
        $sql_patterns = array(
            '/union.*select/i',
            '/select.*from/i',
            '/insert.*into/i',
            '/delete.*from/i',
            '/update.*set/i',
            '/drop.*table/i'
        );
        
        foreach ($sql_patterns as $pattern) {
            if (preg_match($pattern, $search_query)) {
                wp_die(esc_html__('استعلام بحث غير صالح.', 'practical-solutions'));
            }
        }
        
        // فحص XSS
        if (preg_match('/<script|javascript:|on\w+=/i', $search_query)) {
            wp_die(esc_html__('استعلام بحث غير صالح.', 'practical-solutions'));
        }
        
        // تحديد طول البحث
        if (strlen($search_query) > 200) {
            wp_die(esc_html__('استعلام البحث طويل جداً.', 'practical-solutions'));
        }
    }
}
add_action('init', 'practical_solutions_secure_search');

/**
 * حماية AJAX endpoints
 * 
 * @since 1.0.0
 */
function practical_solutions_secure_ajax() {
    // التحقق من rate limiting لطلبات AJAX
    add_action('wp_ajax_practical_solutions_live_search', function() {
        $ip = practical_solutions_get_user_ip();
        $ajax_requests = get_transient('ps_ajax_requests_' . md5($ip));
        
        if ($ajax_requests === false) {
            $ajax_requests = 1;
        } else {
            $ajax_requests++;
        }
        
        // الحد الأقصى 50 طلب في الدقيقة
        if ($ajax_requests > 50) {
            wp_die(esc_html__('تم تجاوز الحد المسموح من الطلبات.', 'practical-solutions'));
        }
        
        set_transient('ps_ajax_requests_' . md5($ip), $ajax_requests, 60);
    }, 1);
    
    // نفس الحماية للمستخدمين غير المسجلين
    add_action('wp_ajax_nopriv_practical_solutions_live_search', function() {
        $ip = practical_solutions_get_user_ip();
        $ajax_requests = get_transient('ps_ajax_requests_' . md5($ip));
        
        if ($ajax_requests === false) {
            $ajax_requests = 1;
        } else {
            $ajax_requests++;
        }
        
        if ($ajax_requests > 30) { // حد أقل للمستخدمين غير المسجلين
            wp_die(esc_html__('تم تجاوز الحد المسموح من الطلبات.', 'practical-solutions'));
        }
        
        set_transient('ps_ajax_requests_' . md5($ip), $ajax_requests, 60);
    }, 1);
}
add_action('init', 'practical_solutions_secure_ajax');

/**
 * تنظيف بيانات الأمان القديمة
 * 
 * @since 1.0.0
 */
function practical_solutions_cleanup_security_data() {
    // تنظيف IPs المحظورة المنتهية الصلاحية
    $blocked_ips = get_option('ps_blocked_ips', array());
    $now = time();
    
    foreach ($blocked_ips as $ip => $info) {
        if ($now > $info['expires']) {
            unset($blocked_ips[$ip]);
        }
    }
    
    update_option('ps_blocked_ips', $blocked_ips);
    
    // تنظيف محاولات تسجيل الدخول القديمة
    $failed_logins = get_option('ps_failed_logins', array());
    
    foreach ($failed_logins as $key => $attempts) {
        $failed_logins[$key] = array_filter($attempts, function($time) use ($now) {
            return ($now - $time) < 86400; // 24 ساعة
        });
        
        if (empty($failed_logins[$key])) {
            unset($failed_logins[$key]);
        }
    }
    
    update_option('ps_failed_logins', $failed_logins);
}

// جدولة تنظيف بيانات الأمان
if (!wp_next_scheduled('practical_solutions_security_cleanup')) {
    wp_schedule_event(time(), 'daily', 'practical_solutions_security_cleanup');
}
add_action('practical_solutions_security_cleanup', 'practical_solutions_cleanup_security_data');

/**
 * إضافة صفحة إعدادات الأمان في لوحة التحكم
 * 
 * @since 1.0.0
 */
function practical_solutions_add_security_page() {
    if (current_user_can('manage_options')) {
        add_theme_page(
            esc_html__('إعدادات الأمان', 'practical-solutions'),
            esc_html__('الأمان', 'practical-solutions'),
            'manage_options',
            'practical-solutions-security',
            'practical_solutions_security_page_content'
        );
    }
}
add_action('admin_menu', 'practical_solutions_add_security_page');

/**
 * محتوى صفحة إعدادات الأمان
 * 
 * @since 1.0.0
 */
function practical_solutions_security_page_content() {
    $blocked_ips = get_option('ps_blocked_ips', array());
    $failed_logins = get_option('ps_failed_logins', array());
    
    echo '<div class="wrap">';
    echo '<h1>' . esc_html__('إعدادات الأمان - قالب الحلول العملية', 'practical-solutions') . '</h1>';
    
    echo '<h2>' . esc_html__('عناوين IP المحظورة', 'practical-solutions') . '</h2>';
    if (!empty($blocked_ips)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>IP</th><th>السبب</th><th>تاريخ الحظر</th><th>انتهاء الحظر</th></tr></thead>';
        echo '<tbody>';
        
        foreach ($blocked_ips as $ip => $info) {
            echo '<tr>';
            echo '<td>' . esc_html($ip) . '</td>';
            echo '<td>' . esc_html($info['reason']) . '</td>';
            echo '<td>' . date('Y-m-d H:i:s', $info['blocked_at']) . '</td>';
            echo '<td>' . date('Y-m-d H:i:s', $info['expires']) . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
    } else {
        echo '<p>' . esc_html__('لا توجد عناوين IP محظورة حالياً.', 'practical-solutions') . '</p>';
    }
    
    echo '<h2>' . esc_html__('محاولات تسجيل الدخول الفاشلة', 'practical-solutions') . '</h2>';
    if (!empty($failed_logins)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>IP + المستخدم</th><th>عدد المحاولات</th><th>آخر محاولة</th></tr></thead>';
        echo '<tbody>';
        
        foreach ($failed_logins as $key => $attempts) {
            if (!empty($attempts)) {
                echo '<tr>';
                echo '<td>' . esc_html($key) . '</td>';
                echo '<td>' . count($attempts) . '</td>';
                echo '<td>' . date('Y-m-d H:i:s', max($attempts)) . '</td>';
                echo '</tr>';
            }
        }
        
        echo '</tbody></table>';
    } else {
        echo '<p>' . esc_html__('لا توجد محاولات فاشلة مسجلة.', 'practical-solutions') . '</p>';
    }
    
    echo '</div>';
}
