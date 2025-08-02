<?php
/**
 * نظام تحسين الأداء
 * 
 * @package Muhtawaa
 * @since 2.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة تحسين الأداء
 */
class MuhtawaaPerformance {
    
    /**
     * تهيئة تحسينات الأداء
     */
    public static function init_performance_optimizations() {
        // تحسين قاعدة البيانات
        add_action('init', array(__CLASS__, 'optimize_database_queries'));
        
        // ضغط HTML
        add_action('wp_loaded', array(__CLASS__, 'enable_output_compression'));
        
        // تحسين الصور
        add_filter('wp_image_editors', array(__CLASS__, 'optimize_image_quality'));
        add_filter('jpeg_quality', array(__CLASS__, 'set_jpeg_quality'));
        
        // تحسين CSS و JavaScript
        add_action('wp_enqueue_scripts', array(__CLASS__, 'optimize_assets'), 999);
        
        // تقليل طلبات HTTP
        add_action('wp_head', array(__CLASS__, 'combine_css_files'));
        add_action('wp_footer', array(__CLASS__, 'combine_js_files'));
        
        // تحسين الخطوط
        add_action('wp_head', array(__CLASS__, 'optimize_font_loading'));
        
        // تحسين التخزين المؤقت
        add_action('init', array(__CLASS__, 'setup_caching'));
        
        // تنظيف ووردبريس
        add_action('init', array(__CLASS__, 'cleanup_wordpress'));
        
        // تحسين RSS
        add_action('init', array(__CLASS__, 'optimize_feeds'));
        
        // تحسين Heartbeat API
        add_action('init', array(__CLASS__, 'optimize_heartbeat'));
        
        // تأجيل تحميل JavaScript
        add_filter('script_loader_tag', array(__CLASS__, 'defer_non_critical_js'), 10, 2);
        
        // Lazy Loading للصور
        add_filter('wp_get_attachment_image_attributes', array(__CLASS__, 'add_lazy_loading'), 10, 2);
        
        // ضغط وتحسين قاعدة البيانات
        add_action('wp_scheduled_delete', array(__CLASS__, 'clean_database'));
        
        // تحسين الاستعلامات
        add_action('pre_get_posts', array(__CLASS__, 'optimize_queries'));
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public static function optimize_database_queries() {
        // تقليل استعلامات المراجعات
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', 3);
        }
        
        // تقليل فترة حفظ المراجعات التلقائية
        if (!defined('AUTOSAVE_INTERVAL')) {
            define('AUTOSAVE_INTERVAL', 300); // 5 دقائق
        }
        
        // تحسين استعلامات التعليقات
        add_filter('wp_count_comments', array(__CLASS__, 'optimize_comment_counting'), 10, 2);
        
        // تحسين استعلامات المرفقات
        add_filter('posts_clauses', array(__CLASS__, 'optimize_attachment_queries'), 10, 2);
    }
    
    /**
     * تفعيل ضغط المخرجات
     */
    public static function enable_output_compression() {
        if (!is_admin() && !defined('DOING_AJAX')) {
            // ضغط HTML
            ob_start(array(__CLASS__, 'compress_html_output'));
            
            // ضغط Gzip إذا كان متاحاً
            if (!ob_get_level() && extension_loaded('zlib') && !headers_sent()) {
                ini_set('zlib.output_compression', 1);
                ini_set('zlib.output_compression_level', 6);
            }
        }
    }
    
    /**
     * ضغط HTML
     */
    public static function compress_html_output($html) {
        // إزالة المسافات حول الرموز
        $css = str_replace(array('; ', ' {', '{ ', ' }', '} ', ': ', ' :', ', ', ' ,'), array(';', '{', '{', '}', '}', ':', ':', ',', ','), $css);
        
        return trim($css);
    }
    
    /**
     * ضغط JavaScript
     */
    private static function minify_js($js) {
        // إزالة التعليقات
        $js = preg_replace('!/\*.*?\*/!s', '', $js);
        $js = preg_replace('/\/\/.*$/m', '', $js);
        
        // إزالة المسافات الزائدة مع الحفاظ على الوظائف
        $js = preg_replace('/\s+/', ' ', $js);
        $js = str_replace(array(' = ', ' + ', ' - ', ' * ', ' / ', ' < ', ' > ', ' == ', ' != '), array('=', '+', '-', '*', '/', '<', '>', '==', '!='), $js);
        
        return trim($js);
    }
    
    /**
     * ضمان وجود مجلد التخزين المؤقت
     */
    private static function ensure_cache_directory() {
        $cache_dir = WP_CONTENT_DIR . '/cache';
        
        if (!file_exists($cache_dir)) {
            wp_mkdir_p($cache_dir);
            
            // إنشاء ملف .htaccess لحماية المجلد
            $htaccess_content = "Options -Indexes\n";
            $htaccess_content .= "<FilesMatch \"\.(css|js)$\">\n";
            $htaccess_content .= "    ExpiresActive On\n";
            $htaccess_content .= "    ExpiresDefault \"access plus 1 year\"\n";
            $htaccess_content .= "</FilesMatch>\n";
            
            file_put_contents($cache_dir . '/.htaccess', $htaccess_content);
        }
    }
    
    /**
     * تحسين تحميل الخطوط
     */
    public static function optimize_font_loading() {
        // إضافة font-display: swap
        echo '<style>
        @font-face {
            font-family: "Cairo";
            font-display: swap;
        }
        </style>';
        
        // Preload الخطوط المهمة
        echo '<link rel="preload" href="https://fonts.gstatic.com/s/cairo/v28/SLXgc1nY6HkvalIhTp2mxdt0UX8.woff2" as="font" type="font/woff2" crossorigin>';
    }
    
    /**
     * إعداد التخزين المؤقت
     */
    public static function setup_caching() {
        // تفعيل Object Cache إذا كان متاحاً
        if (function_exists('wp_cache_init')) {
            wp_cache_init();
        }
        
        // إعداد cache headers
        if (!is_admin()) {
            add_action('send_headers', array(__CLASS__, 'set_cache_headers'));
        }
        
        // تخزين مؤقت للاستعلامات المعقدة
        add_filter('posts_results', array(__CLASS__, 'cache_query_results'), 10, 2);
    }
    
    /**
     * تعيين رؤوس التخزين المؤقت
     */
    public static function set_cache_headers() {
        if (!is_user_logged_in() && !is_admin()) {
            $expires = 3600; // ساعة واحدة
            
            if (is_front_page()) {
                $expires = 1800; // 30 دقيقة للصفحة الرئيسية
            } elseif (is_single() || is_page()) {
                $expires = 7200; // ساعتين للمقالات والصفحات
            }
            
            header('Cache-Control: public, max-age=' . $expires);
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', get_the_modified_time('U')) . ' GMT');
        }
    }
    
    /**
     * تخزين نتائج الاستعلامات مؤقتاً
     */
    public static function cache_query_results($posts, $query) {
        if (!$query->is_main_query() || is_admin()) {
            return $posts;
        }
        
        $cache_key = 'muhtawaa_query_' . md5(serialize($query->query_vars));
        $cached_posts = wp_cache_get($cache_key, 'muhtawaa_queries');
        
        if (false === $cached_posts) {
            wp_cache_set($cache_key, $posts, 'muhtawaa_queries', 3600);
        }
        
        return $posts;
    }
    
    /**
     * تنظيف ووردبريس
     */
    public static function cleanup_wordpress() {
        // إزالة الميزات غير المطلوبة
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        remove_action('wp_head', 'feed_links_extra', 3);
        
        // إزالة emoji scripts
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
        
        // تعطيل REST API للمستخدمين غير المصرح لهم
        if (!is_user_logged_in()) {
            remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
            remove_action('wp_head', 'rest_output_link_wp_head');
            remove_action('template_redirect', 'rest_output_link_header', 11);
        }
        
        // تنظيف dashboard
        if (is_admin()) {
            remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
            remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
            remove_meta_box('dashboard_primary', 'dashboard', 'side');
            remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
            remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
            remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
        }
    }
    
    /**
     * تحسين الخلاصات (RSS)
     */
    public static function optimize_feeds() {
        // تقليل عدد المقالات في RSS
        add_filter('posts_limit', function($limit) {
            if (is_feed()) {
                return 'LIMIT 0, 10';
            }
            return $limit;
        });
        
        // إضافة صور مميزة للخلاصات
        add_filter('the_excerpt_rss', array(__CLASS__, 'add_featured_image_to_feed'));
        add_filter('the_content_feed', array(__CLASS__, 'add_featured_image_to_feed'));
    }
    
    /**
     * إضافة الصورة المميزة للخلاصة
     */
    public static function add_featured_image_to_feed($content) {
        global $post;
        
        if (has_post_thumbnail($post->ID)) {
            $content = get_the_post_thumbnail($post->ID, 'medium') . $content;
        }
        
        return $content;
    }
    
    /**
     * تحسين Heartbeat API
     */
    public static function optimize_heartbeat() {
        // تقليل تكرار Heartbeat
        add_filter('heartbeat_settings', function($settings) {
            $settings['interval'] = 60; // كل دقيقة بدلاً من 15 ثانية
            return $settings;
        });
        
        // تعطيل Heartbeat في الصفحات غير الضرورية
        add_action('wp_enqueue_scripts', function() {
            if (!is_admin() && !is_user_logged_in()) {
                wp_deregister_script('heartbeat');
            }
        });
    }
    
    /**
     * تأجيل JavaScript غير الحرجة
     */
    public static function defer_non_critical_js($tag, $handle) {
        // قائمة بـ scripts يجب عدم تأجيلها
        $critical_scripts = array('jquery', 'muhtawaa-main');
        
        if (!in_array($handle, $critical_scripts) && !is_admin()) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إضافة Lazy Loading للصور
     */
    public static function add_lazy_loading($attr, $attachment) {
        if (!is_admin() && !wp_is_mobile()) {
            $attr['loading'] = 'lazy';
            $attr['data-src'] = $attr['src'];
            $attr['src'] = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 1"%3E%3C/svg%3E';
            $attr['class'] = (isset($attr['class']) ? $attr['class'] . ' ' : '') . 'lazy';
        }
        
        return $attr;
    }
    
    /**
     * تنظيف قاعدة البيانات
     */
    public static function clean_database() {
        global $wpdb;
        
        // حذف المراجعات القديمة (أكثر من 30 يوم)
        $wpdb->query("
            DELETE FROM {$wpdb->posts} 
            WHERE post_type = 'revision' 
            AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");
        
        // حذف التعليقات المرفوضة والسبام القديمة
        $wpdb->query("
            DELETE FROM {$wpdb->comments} 
            WHERE comment_approved IN ('spam', 'trash') 
            AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");
        
        // حذف البيانات المؤقتة المنتهية الصلاحية
        $wpdb->query("
            DELETE FROM {$wpdb->options} 
            WHERE option_name LIKE '_transient_%' 
            OR option_name LIKE '_site_transient_%'
        ");
        
        // حذف postmeta اليتيمة
        $wpdb->query("
            DELETE pm FROM {$wpdb->postmeta} pm 
            LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
            WHERE p.ID IS NULL
        ");
        
        // تحسين الجداول
        $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
        $wpdb->query("OPTIMIZE TABLE {$wpdb->postmeta}");
        $wpdb->query("OPTIMIZE TABLE {$wpdb->comments}");
        $wpdb->query("OPTIMIZE TABLE {$wpdb->commentmeta}");
        $wpdb->query("OPTIMIZE TABLE {$wpdb->options}");
        
        // تسجيل عملية التنظيف
        muhtawaa_log('Database cleanup completed successfully');
    }
    
    /**
     * تحسين الاستعلامات
     */
    public static function optimize_queries($query) {
        if (!is_admin() && $query->is_main_query()) {
            // تقليل عدد المقالات في الصفحة الرئيسية
            if ($query->is_home()) {
                $query->set('posts_per_page', 8);
            }
            
            // تحسين استعلامات الأرشيف
            if ($query->is_archive()) {
                $query->set('posts_per_page', 12);
                $query->set('no_found_rows', true); // تقليل استعلام COUNT
            }
            
            // إزالة الحقول غير المطلوبة
            $query->set('update_post_term_cache', false);
            $query->set('update_post_meta_cache', false);
        }
    }
    
    /**
     * تحسين عدد التعليقات
     */
    public static function optimize_comment_counting($stats, $post_id) {
        if ($post_id > 0) {
            $cache_key = "comments_count_{$post_id}";
            $cached_count = wp_cache_get($cache_key, 'muhtawaa_comments');
            
            if (false !== $cached_count) {
                return $cached_count;
            }
        }
        
        // تخزين النتيجة مؤقتاً لمدة ساعة
        wp_cache_set($cache_key, $stats, 'muhtawaa_comments', 3600);
        
        return $stats;
    }
    
    /**
     * تحسين استعلامات المرفقات
     */
    public static function optimize_attachment_queries($clauses, $query) {
        if (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] === 'attachment') {
            // إضافة فهرس لتحسين الأداء
            global $wpdb;
            
            $index_exists = $wpdb->get_var("
                SHOW INDEX FROM {$wpdb->posts} 
                WHERE Column_name = 'post_type' 
                AND Table = '{$wpdb->posts}'
            ");
            
            if (!$index_exists) {
                $wpdb->query("ALTER TABLE {$wpdb->posts} ADD INDEX post_type_status (post_type, post_status)");
            }
        }
        
        return $clauses;
    }
    
    /**
     * تنظيف ملفات التخزين المؤقت القديمة
     */
    public static function clean_cache_files() {
        $cache_dir = WP_CONTENT_DIR . '/cache';
        
        if (is_dir($cache_dir)) {
            $files = glob($cache_dir . '/*');
            
            foreach ($files as $file) {
                if (is_file($file) && (time() - filemtime($file)) > (24 * 3600)) { // ملفات أقدم من 24 ساعة
                    unlink($file);
                }
            }
        }
    }
    
    /**
     * مراقبة أداء الاستعلامات
     */
    public static function monitor_slow_queries() {
        if (defined('SAVEQUERIES') && SAVEQUERIES) {
            global $wpdb;
            
            foreach ($wpdb->queries as $query) {
                if ($query[1] > 0.1) { // الاستعلامات التي تستغرق أكثر من 0.1 ثانية
                    muhtawaa_log("Slow query detected: {$query[0]} - Time: {$query[1]}s", 'warning');
                }
            }
        }
    }
    
    /**
     * تقرير الأداء اليومي
     */
    public static function generate_performance_report() {
        $report = array(
            'date' => date('Y-m-d'),
            'total_queries' => 0,
            'slow_queries' => 0,
            'cache_hits' => wp_cache_get_stats()['hits'] ?? 0,
            'cache_misses' => wp_cache_get_stats()['misses'] ?? 0,
            'memory_usage' => memory_get_peak_usage(true),
            'load_time' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']
        );
        
        // حفظ التقرير
        $reports = get_option('muhtawaa_performance_reports', array());
        $reports[date('Y-m-d')] = $report;
        
        // الاحتفاظ بتقارير آخر 30 يوم فقط
        if (count($reports) > 30) {
            $reports = array_slice($reports, -30, 30, true);
        }
        
        update_option('muhtawaa_performance_reports', $reports);
    }
}

// تنظيف ملفات التخزين المؤقت يومياً
if (!wp_next_scheduled('muhtawaa_clean_cache')) {
    wp_schedule_event(time(), 'daily', 'muhtawaa_clean_cache');
}
add_action('muhtawaa_clean_cache', array('MuhtawaaPerformance', 'clean_cache_files'));

// تنظيف قاعدة البيانات أسبوعياً
if (!wp_next_scheduled('muhtawaa_clean_database')) {
    wp_schedule_event(time(), 'weekly', 'muhtawaa_clean_database');
}
add_action('muhtawaa_clean_database', array('MuhtawaaPerformance', 'clean_database'));

// تقرير الأداء اليومي
if (!wp_next_scheduled('muhtawaa_performance_report')) {
    wp_schedule_event(time(), 'daily', 'muhtawaa_performance_report');
}
add_action('muhtawaa_performance_report', array('MuhtawaaPerformance', 'generate_performance_report'));

// مراقبة الاستعلامات البطيئة في وضع التطوير
if (muhtawaa_is_development()) {
    add_action('shutdown', array('MuhtawaaPerformance', 'monitor_slow_queries'));
} // المسافات الزائدة والتعليقات
        $html = preg_replace('/<!--(?!<!)[^\[>].*?-->/', '', $html);
        $html = preg_replace('/\s+/', ' ', $html);
        
        return trim($html);
    }
    
} // المسافات الزائدة والتعليقات
     * تحسين جودة الصور
     */
    public static function optimize_image_quality($editors) {
        // استخدام ImageMagick إذا كان متاحاً
        if (extension_loaded('imagick')) {
            array_unshift($editors, 'WP_Image_Editor_Imagick');
        }
        
        return $editors;
    }
    
    /**
     * تعيين جودة JPEG
     */
    public static function set_jpeg_quality($quality) {
        return 85; // توازن بين الجودة وحجم الملف
    }
    
    /**
     * تحسين ملفات CSS و JS
     */
    public static function optimize_assets() {
        // إزالة CSS غير المستخدمة
        self::remove_unused_css();
        
        // إزالة JS غير المستخدمة
        self::remove_unused_js();
        
        // تحسين ترتيب التحميل
        self::optimize_loading_order();
    }
    
    /**
     * إزالة CSS غير المستخدمة
     */
    private static function remove_unused_css() {
        if (!is_admin()) {
            // إزالة CSS الافتراضية لووردبريس
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-block-style');
            
            // إزالة CSS الإضافات غير المطلوبة في صفحات معينة
            if (!is_single() && !is_page()) {
                wp_dequeue_style('contact-form-7');
            }
        }
    }
    
    /**
     * إزالة JavaScript غير المستخدمة
     */
    private static function remove_unused_js() {
        if (!is_admin()) {
            // إزالة jQuery Migrate
            wp_deregister_script('jquery-migrate');
            
            // إزالة Embed script إذا لم نكن نستخدمه
            if (!is_single()) {
                wp_deregister_script('wp-embed');
            }
            
            // إزالة scripts غير مطلوبة
            wp_dequeue_script('wp-embed');
            wp_dequeue_script('jquery-migrate');
        }
    }
    
    /**
     * تحسين ترتيب التحميل
     */
    private static function optimize_loading_order() {
        // تحميل CSS الحرجة مباشرة
        add_action('wp_head', function() {
            echo '<style id="critical-css">';
            echo self::get_critical_css();
            echo '</style>';
        }, 1);
        
        // تأجيل CSS غير الحرجة
        add_action('wp_footer', function() {
            echo "<script>
                function loadCSS(href) {
                    var link = document.createElement('link');
                    link.rel = 'stylesheet';
                    link.href = href;
                    document.head.appendChild(link);
                }
            </script>";
        });
    }
    
    /**
     * الحصول على CSS الحرجة
     */
    private static function get_critical_css() {
        return "
        body{font-family:'Cairo',sans-serif;margin:0;padding:0}
        .container{max-width:1200px;margin:0 auto;padding:0 20px}
        .header{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:1rem 0}
        .nav{display:flex;justify-content:space-between;align-items:center}
        ";
    }
    
    /**
     * دمج ملفات CSS
     */
    public static function combine_css_files() {
        global $wp_styles;
        
        if (!is_admin() && !empty($wp_styles->queue)) {
            $combined_css = '';
            $handles_to_remove = array();
            
            foreach ($wp_styles->queue as $handle) {
                if (isset($wp_styles->registered[$handle])) {
                    $style = $wp_styles->registered[$handle];
                    
                    // دمج ملفات CSS المحلية فقط
                    if (strpos($style->src, home_url()) !== false && strpos($style->src, '.css') !== false) {
                        $css_file = str_replace(home_url(), ABSPATH, $style->src);
                        
                        if (file_exists($css_file)) {
                            $combined_css .= file_get_contents($css_file) . "\n";
                            $handles_to_remove[] = $handle;
                        }
                    }
                }
            }
            
            if (!empty($combined_css)) {
                // ضغط CSS
                $combined_css = self::minify_css($combined_css);
                
                // حفظ الملف المدموج
                $combined_file = WP_CONTENT_DIR . '/cache/combined-styles.css';
                self::ensure_cache_directory();
                file_put_contents($combined_file, $combined_css);
                
                // إزالة الملفات الأصلية وإضافة المدموج
                foreach ($handles_to_remove as $handle) {
                    wp_dequeue_style($handle);
                }
                
                wp_enqueue_style('muhtawaa-combined', content_url('/cache/combined-styles.css'), array(), filemtime($combined_file));
            }
        }
    }
    
    /**
     * دمج ملفات JavaScript
     */
    public static function combine_js_files() {
        global $wp_scripts;
        
        if (!is_admin() && !empty($wp_scripts->queue)) {
            $combined_js = '';
            $handles_to_remove = array();
            
            foreach ($wp_scripts->queue as $handle) {
                if (isset($wp_scripts->registered[$handle]) && $handle !== 'jquery') {
                    $script = $wp_scripts->registered[$handle];
                    
                    // دمج ملفات JS المحلية فقط
                    if (strpos($script->src, home_url()) !== false && strpos($script->src, '.js') !== false) {
                        $js_file = str_replace(home_url(), ABSPATH, $script->src);
                        
                        if (file_exists($js_file)) {
                            $combined_js .= file_get_contents($js_file) . ";\n";
                            $handles_to_remove[] = $handle;
                        }
                    }
                }
            }
            
            if (!empty($combined_js)) {
                // ضغط JavaScript
                $combined_js = self::minify_js($combined_js);
                
                // حفظ الملف المدموج
                $combined_file = WP_CONTENT_DIR . '/cache/combined-scripts.js';
                self::ensure_cache_directory();
                file_put_contents($combined_file, $combined_js);
                
                // إزالة الملفات الأصلية وإضافة المدموج
                foreach ($handles_to_remove as $handle) {
                    wp_dequeue_script($handle);
                }
                
                wp_enqueue_script('muhtawaa-combined', content_url('/cache/combined-scripts.js'), array('jquery'), filemtime($combined_file), true);
            }
        }
    }
    
    /**
     * ضغط CSS
     */
    private static function minify_css($css) {
        // إزالة التعليقات
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        
        // إزالة المسافات الزائدة
        $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
        
        // إزال}
