<?php
/**
 * Practical Solutions Pro - Enhanced and Refactored Functions
 * قالب الحلول العملية الاحترافي - الوظائف المحسنة والمُعاد هيكلتها
 * المسار: /functions.php
 * الإصدار: 2.2.2 (محسن)
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// 1. تعريف الثوابت الأساسية (Core Constants)
// =============================================================================
define('PS_THEME_VERSION', '2.2.2');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());
define('PS_CACHE_DURATION', 3600);
define('PS_DEBUG', defined('WP_DEBUG') && WP_DEBUG);

// =============================================================================
// 2. تحميل ملفات النظام الأساسية (Core System Files)
// =============================================================================
$ps_core_includes = [
    'inc/theme-admin-panel.php',      
    'inc/customizer-settings.php',    
    'inc/block-patterns.php',         
    'inc/unified-search-system.php',  
    'inc/ai-openrouter-system.php',   
    'inc/rating-system.php',          
    'inc/advanced-analytics.php',
    'inc/security-enhancements.php',  
    'inc/performance-optimizer.php',  
];

foreach ($ps_core_includes as $file) {
    $filepath = PS_THEME_DIR . '/' . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}

// =============================================================================
// 3. إعدادات القالب الأساسية (Theme Setup)
// =============================================================================
if (!function_exists('ps_theme_setup')) {
    function ps_theme_setup() {
        // دعم ميزات ووردبريس الحديثة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('responsive-embeds');
        add_theme_support('html5', [
            'search-form', 'comment-form', 'comment-list', 
            'gallery', 'caption', 'style', 'script'
        ]);
        add_theme_support('custom-logo', [
            'height' => 100, 
            'width' => 400, 
            'flex-height' => true, 
            'flex-width' => true
        ]);
        
        // دعم ميزات قوالب الكتل (Block Theme Features)
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_theme_support('custom-spacing');
        add_theme_support('custom-line-height');
        add_theme_support('appearance-tools');
        add_theme_support('border');
        add_theme_support('link-color');

        // دعم الترجمة
        load_theme_textdomain('practical-solutions', PS_THEME_DIR . '/languages');

        // تسجيل قوائم التنقل
        register_nav_menus([
            'primary' => __('القائمة الرئيسية', 'practical-solutions'),
            'footer'  => __('قائمة التذييل', 'practical-solutions'),
            'social'  => __('وسائل التواصل الاجتماعي', 'practical-solutions'),
        ]);

        // تسجيل أحجام الصور المخصصة
        add_image_size('ps-card', 400, 300, true);
        add_image_size('ps-featured', 800, 600, true);
        add_image_size('ps-hero', 1600, 900, true);
        add_image_size('ps-thumbnail', 150, 150, true);
    }
}
add_action('after_setup_theme', 'ps_theme_setup');

// =============================================================================
// 4. تحميل الملفات المحسن (Optimized Assets Loading)
// =============================================================================
function ps_enqueue_scripts() {
    // CSS الرئيسي - ملف واحد مدمج ومضغوط مسبقاً
    wp_enqueue_style(
        'ps-main-style',
        PS_THEME_URI . '/dist/css/main.min.css',
        [],
        PS_THEME_VERSION
    );
    
    // JavaScript الرئيسي - ملف واحد مدمج ومضغوط مسبقاً
    wp_enqueue_script(
        'ps-main-script',
        PS_THEME_URI . '/dist/js/main.min.js',
        ['jquery'],
        PS_THEME_VERSION,
        true
    );
    
    // البيانات المحلية للجافا سكريبت
    wp_localize_script('ps-main-script', 'psAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ps_nonce'),
        'loading' => __('جاري التحميل...', 'practical-solutions'),
        'error' => __('حدث خطأ، حاول مرة أخرى', 'practical-solutions'),
        'voice_not_supported' => __('البحث الصوتي غير مدعوم في متصفحك', 'practical-solutions'),
        'is_rtl' => is_rtl(),
        'home_url' => home_url('/'),
    ]);
    
    // تحميل شرطي لملفات إضافية حسب الحاجة
    if (is_singular('post')) {
        wp_add_inline_script('ps-main-script', 'window.psFeatures = window.psFeatures || {}; window.psFeatures.ratingEnabled = true;');
    }
    
    if (is_search()) {
        wp_add_inline_script('ps-main-script', 'window.psFeatures = window.psFeatures || {}; window.psFeatures.enhancedSearch = true;');
    }
}
add_action('wp_enqueue_scripts', 'ps_enqueue_scripts');

// =============================================================================
// 5. تحسين الخطوط والأداء (Font & Performance Optimization)
// =============================================================================
function ps_optimize_fonts() {
    // Preconnect لخطوط Google
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    
    // تحميل الخطوط مع font-display: swap وتحسين التحميل
    $font_url = 'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap';
    echo '<link href="' . esc_url($font_url) . '" rel="stylesheet" media="print" onload="this.media=\'all\'">';
    echo '<noscript><link href="' . esc_url($font_url) . '" rel="stylesheet"></noscript>';
}
add_action('wp_head', 'ps_optimize_fonts', 1);

// =============================================================================
// 6. تحسينات الأمان (Security Enhancements)
// =============================================================================
function ps_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    }
}
add_action('send_headers', 'ps_security_headers');

// إزالة معلومات الإصدار الحساسة
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// إزالة feed links غير الضرورية
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);

// =============================================================================
// 7. تحسين الصور المتقدم (Advanced Image Optimization)
// =============================================================================
function ps_optimize_images($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if (!$html) return $html;
    
    // إضافة loading="lazy" للصور
    if (strpos($html, 'loading=') === false) {
        $html = str_replace('<img', '<img loading="lazy"', $html);
    }
    
    // إضافة decoding="async"
    if (strpos($html, 'decoding=') === false) {
        $html = str_replace('<img', '<img decoding="async"', $html);
    }
    
    // إضافة srcset للصور المتجاوبة
    if (!strpos($html, 'srcset=')) {
        $attachment_id = get_post_thumbnail_id($post_id);
        if ($attachment_id) {
            $srcset = wp_get_attachment_image_srcset($attachment_id, $size);
            if ($srcset) {
                $html = str_replace('<img', '<img srcset="' . esc_attr($srcset) . '"', $html);
            }
        }
    }
    
    return $html;
}
add_filter('post_thumbnail_html', 'ps_optimize_images', 10, 5);

// تحسين جودة الصور المرفوعة
add_filter('jpeg_quality', function() { return 85; });
add_filter('wp_editor_set_quality', function() { return 85; });

// =============================================================================
// 8. تحسين التخزين المؤقت (Cache Optimization)
// =============================================================================
function ps_setup_caching() {
    if (!is_admin() && !is_user_logged_in()) {
        $cache_duration = PS_CACHE_DURATION;
        header("Cache-Control: public, max-age={$cache_duration}");
        header("Expires: " . gmdate('D, d M Y H:i:s', time() + $cache_duration) . ' GMT');
        header("Last-Modified: " . gmdate('D, d M Y H:i:s', get_the_modified_time('U')) . ' GMT');
    }
}
add_action('template_redirect', 'ps_setup_caching');

// =============================================================================
// 9. تنظيف وتحسين WordPress (WordPress Cleanup)
// =============================================================================
function ps_cleanup_wordpress() {
    // إزالة الروابط غير الضرورية من head
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    
    // إزالة REST API links للمستخدمين غير المصرح لهم
    if (!current_user_can('manage_options')) {
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
    }
    
    // تنظيف query_vars غير الضرورية
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'ps_cleanup_wordpress');

// =============================================================================
// 10. تحسين قاعدة البيانات المحسن (Enhanced Database Optimization)
// =============================================================================
function ps_optimize_database() {
    if (!wp_next_scheduled('ps_weekly_cleanup')) {
        wp_schedule_event(time(), 'weekly', 'ps_weekly_cleanup');
    }
}
add_action('wp', 'ps_optimize_database');

function ps_weekly_database_cleanup() {
    global $wpdb;
    
    // حذف التعليقات المحذوفة نهائياً
    $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_approved = 'trash'");
    
    // تنظيف المراجعات بطريقة آمنة باستخدام WordPress API
    $old_revisions = get_posts([
        'post_type' => 'revision',
        'post_status' => 'any',
        'numberposts' => -1,
        'date_query' => [
            [
                'before' => '30 days ago'
            ]
        ],
        'fields' => 'ids'
    ]);
    
    foreach ($old_revisions as $revision_id) {
        wp_delete_post_revision($revision_id);
    }
    
    // تنظيف spam comments
    $spam_comments = get_comments([
        'status' => 'spam',
        'date_query' => [
            [
                'before' => '7 days ago'
            ]
        ],
        'fields' => 'ids'
    ]);
    
    foreach ($spam_comments as $comment_id) {
        wp_delete_comment($comment_id, true);
    }
    
    // تحسين الجداول
    $tables = [$wpdb->posts, $wpdb->postmeta, $wpdb->comments, $wpdb->commentmeta, $wpdb->options];
    foreach ($tables as $table) {
        $wpdb->query("OPTIMIZE TABLE {$table}");
    }
    
    // تنظيف transients منتهية الصلاحية
    delete_expired_transients();
}
add_action('ps_weekly_cleanup', 'ps_weekly_database_cleanup');

// =============================================================================
// 11. تحسين العرض للجوال المتقدم (Advanced Mobile Optimization)
// =============================================================================
function ps_mobile_optimizations() {
    if (wp_is_mobile()) {
        // تقليل جودة الصور للجوال
        add_filter('wp_calculate_image_srcset_meta', function($image_meta) {
            // تقليل عدد أحجام الصور للجوال
            if (isset($image_meta['sizes']) && count($image_meta['sizes']) > 3) {
                $image_meta['sizes'] = array_slice($image_meta['sizes'], 0, 3, true);
            }
            return $image_meta;
        });
        
        // إزالة بعض الميزات غير الضرورية للجوال
        add_action('wp_enqueue_scripts', function() {
            wp_dequeue_script('wp-embed');
            wp_dequeue_script('comment-reply');
        }, 100);
        
        // تأخير تحميل بعض المحتوى
        add_filter('wp_lazy_loading_enabled', '__return_true');
    }
}
add_action('init', 'ps_mobile_optimizations');

// =============================================================================
// 12. تحسين Heartbeat API (Heartbeat Optimization)
// =============================================================================
function ps_optimize_heartbeat($settings) {
    // تقليل معدل Heartbeat حسب الصفحة
    global $pagenow;
    
    if ($pagenow === 'post.php' || $pagenow === 'post-new.php') {
        $settings['interval'] = 30; // للتحرير
    } else {
        $settings['interval'] = 60; // للصفحات الأخرى
    }
    
    return $settings;
}
add_filter('heartbeat_settings', 'ps_optimize_heartbeat');

// إيقاف heartbeat في الواجهة الأمامية
add_action('init', function() {
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
});

// =============================================================================
// 13. تحسين الخلاصات (Feed Optimization)
// =============================================================================
function ps_optimize_feeds() {
    // تحديد عدد المقالات في الخلاصة
    add_filter('pre_option_posts_per_rss', function() {
        return 10;
    });
    
    // إضافة الصورة المميزة للخلاصة
    add_filter('the_excerpt_rss', function($excerpt) {
        global $post;
        if (has_post_thumbnail($post->ID)) {
            $thumbnail = get_the_post_thumbnail($post->ID, 'medium');
            $excerpt = '<div class="rss-thumbnail">' . $thumbnail . '</div>' . $excerpt;
        }
        return $excerpt;
    });
    
    // تحسين محتوى الخلاصة
    add_filter('the_content_feed', function($content) {
        // إزالة الـ shortcodes من الخلاصة
        $content = strip_shortcodes($content);
        // تنظيف HTML
        $content = wp_strip_all_tags($content, '<p><br><strong><em><a><ul><ol><li>');
        return $content;
    });
}
add_action('init', 'ps_optimize_feeds');

// =============================================================================
// 14. إعدادات PWA المحسنة (Enhanced PWA Settings)
// =============================================================================
function ps_add_pwa_meta() {
    ?>
    <meta name="theme-color" content="#007cba">
    <meta name="msapplication-TileColor" content="#007cba">
    <meta name="msapplication-TileImage" content="<?php echo PS_THEME_URI; ?>/assets/images/icon-144.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
    <link rel="apple-touch-icon" href="<?php echo PS_THEME_URI; ?>/assets/images/icon-192.png">
    <link rel="manifest" href="<?php echo PS_THEME_URI; ?>/manifest.json">
    <?php
}
add_action('wp_head', 'ps_add_pwa_meta');

// تسجيل Service Worker
function ps_register_service_worker() {
    if (!is_admin()) {
        ?>
        <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('<?php echo PS_THEME_URI; ?>/sw.js')
                    .then(function(registration) {
                        console.log('SW registered: ', registration);
                    })
                    .catch(function(registrationError) {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
        </script>
        <?php
    }
}
add_action('wp_footer', 'ps_register_service_worker');

// =============================================================================
// 15. تحسين البحث في الموقع (Enhanced Search Optimization)
// =============================================================================
function ps_enhance_search($query) {
    if (!is_admin() && $query->is_main_query() && is_search()) {
        // تحسين ترتيب نتائج البحث
        $query->set('orderby', 'relevance');
        $query->set('order', 'DESC');
        
        // إضافة البحث في الـ metadata
        $meta_query = [
            'relation' => 'OR',
            [
                'key' => '_ps_search_keywords',
                'value' => get_search_query(),
                'compare' => 'LIKE'
            ],
            [
                'key' => '_yoast_wpseo_metadesc',
                'value' => get_search_query(),
                'compare' => 'LIKE'
            ]
        ];
        
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'ps_enhance_search');

// =============================================================================
// 16. إدارة الأخطاء والتنبيهات المحسنة (Enhanced Error Handling)
// =============================================================================
function ps_error_handler($errno, $errstr, $errfile, $errline) {
    if (PS_DEBUG) {
        $error_message = "PS Theme Error [{$errno}]: {$errstr} in {$errfile} on line {$errline}";
        error_log($error_message);
        
        // إرسال إشعار للمدير في حالة الأخطاء الحرجة
        if ($errno === E_ERROR || $errno === E_PARSE) {
            wp_mail(
                get_option('admin_email'),
                'خطأ حرج في القالب',
                $error_message
            );
        }
    }
    return false;
}

if (PS_DEBUG) {
    set_error_handler('ps_error_handler');
}

// =============================================================================
// 17. النسخ الاحتياطي التلقائي المحسن (Enhanced Auto Backup)
// =============================================================================
function ps_auto_backup_settings() {
    $settings = [
        'general' => get_option('ps_general_settings', []),
        'social' => get_option('ps_social_settings', []),
        'seo' => get_option('ps_seo_settings', []),
        'advanced' => get_option('ps_advanced_settings', []),
        'customizer' => get_option('theme_mods_' . get_option('stylesheet'), [])
    ];
    
    $backup_data = wp_json_encode($settings, JSON_UNESCAPED_UNICODE);
    $backup_key = 'ps_settings_backup_' . date('Y_m_d');
    
    // ضغط البيانات إذا كانت كبيرة
    if (strlen($backup_data) > 1024) {
        $backup_data = gzcompress($backup_data, 9);
    }
    
    update_option($backup_key, $backup_data);
    
    // إدارة النسخ الاحتياطية
    $backup_list = get_option('ps_backup_list', []);
    $backup_list[] = $backup_key;
    
    // الاحتفاظ بـ 10 نسخ احتياطية
    if (count($backup_list) > 10) {
        $old_backup = array_shift($backup_list);
        delete_option($old_backup);
    }
    
    update_option('ps_backup_list', $backup_list);
}

// جدولة النسخ الاحتياطي
if (!wp_next_scheduled('ps_daily_backup')) {
    wp_schedule_event(time(), 'daily', 'ps_daily_backup');
}
add_action('ps_daily_backup', 'ps_auto_backup_settings');

// =============================================================================
// 18. إحصائيات الأداء المحسنة (Enhanced Performance Statistics)
// =============================================================================
function ps_track_performance() {
    if (PS_DEBUG && current_user_can('manage_options')) {
        $memory_usage = memory_get_peak_usage(true);
        $execution_time = timer_stop(0, 3);
        $queries = get_num_queries();
        $included_files = count(get_included_files());
        
        $stats = [
            'memory' => size_format($memory_usage),
            'time' => $execution_time . 's',
            'queries' => $queries,
            'files' => $included_files,
            'timestamp' => current_time('mysql')
        ];
        
        // حفظ الإحصائيات للمراجعة
        $daily_stats = get_option('ps_daily_stats_' . date('Y_m_d'), []);
        $daily_stats[] = $stats;
        update_option('ps_daily_stats_' . date('Y_m_d'), $daily_stats);
        
        // عرض الإحصائيات في console للمطورين
        ?>
        <script>
        console.group('🚀 PS Theme Performance Stats');
        console.log('Memory: <?php echo $stats['memory']; ?>');
        console.log('Time: <?php echo $stats['time']; ?>');
        console.log('Queries: <?php echo $stats['queries']; ?>');
        console.log('Files: <?php echo $stats['files']; ?>');
        console.groupEnd();
        </script>
        <?php
    }
}
add_action('wp_footer', 'ps_track_performance');

// =============================================================================
// 19. تنظيف الملفات المؤقتة المحسن (Enhanced Temporary Files Cleanup)
// =============================================================================
function ps_cleanup_temp_files() {
    $upload_dir = wp_upload_dir();
    $temp_dirs = [
        $upload_dir['basedir'] . '/ps-temp/',
        $upload_dir['basedir'] . '/ps-cache/',
        WP_CONTENT_DIR . '/cache/ps-cache/'
    ];
    
    foreach ($temp_dirs as $temp_dir) {
        if (is_dir($temp_dir)) {
            $files = glob($temp_dir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    $file_age = time() - filemtime($file);
                    // حذف الملفات الأقدم من 24 ساعة
                    if ($file_age > 86400) {
                        unlink($file);
                    }
                }
            }
        }
    }
    
    // تنظيف ملفات التخزين المؤقت منتهية الصلاحية
    wp_cache_flush();
}
add_action('ps_weekly_cleanup', 'ps_cleanup_temp_files');

// =============================================================================
// 20. تحسينات متنوعة (Miscellaneous Optimizations)
// =============================================================================

// تحسين رفع الملفات
function ps_optimize_uploads($file) {
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'pdf', 'doc', 'docx'];
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (!in_array($file_ext, $allowed_types)) {
        $file['error'] = __('نوع الملف غير مسموح', 'practical-solutions');
    }
    
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'ps_optimize_uploads');

// تحسين عرض التعليقات
function ps_optimize_comments($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_single()) {
            // تحديد عدد التعليقات لكل صفحة
            $query->set('number', 10);
        }
    }
}
add_action('pre_get_comments', 'ps_optimize_comments');

// إضافة معلومات التقنية للـ HTML
function ps_add_tech_info() {
    echo "\n<!-- Practical Solutions Pro v" . PS_THEME_VERSION . " -->\n";
    echo "<!-- WordPress " . get_bloginfo('version') . " | PHP " . PHP_VERSION . " -->\n";
}
add_action('wp_head', 'ps_add_tech_info', 99);

// =============================================================================
// 21. إنهاء التحميل وتأكيد الجاهزية
// =============================================================================
if (!defined('PS_THEME_LOADED')) {
    define('PS_THEME_LOADED', true);
}

// Hook للتأكد من اكتمال التحميل
do_action('ps_theme_fully_loaded');

// تسجيل وقت تحميل القالب للإحصائيات
if (PS_DEBUG) {
    $load_time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
    error_log("PS Theme loaded in: " . round($load_time * 1000, 2) . "ms");
}