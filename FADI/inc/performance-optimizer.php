<?php
/**
 * محسن الأداء للقالب
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تحسينات الأداء الأساسية
 */
class FADI_Performance_Optimizer {
    
    public function __construct() {
        add_action('init', array($this, 'init_optimizations'));
        add_action('wp_enqueue_scripts', array($this, 'optimize_scripts_styles'));
        add_action('wp_head', array($this, 'add_dns_prefetch'), 1);
        add_filter('script_loader_tag', array($this, 'add_async_defer_attributes'), 10, 2);
        add_action('wp_footer', array($this, 'inline_critical_css'));
    }
    
    /**
     * تهيئة التحسينات الأساسية
     */
    public function init_optimizations() {
        // إزالة المولدات والروابط غير الضرورية
        $this->remove_unnecessary_headers();
        
        // تحسين قاعدة البيانات
        $this->optimize_database_queries();
        
        // تحسين الصور
        $this->optimize_images();
        
        // تفعيل الضغط
        $this->enable_gzip_compression();
    }
    
    /**
     * إزالة الهيدر غير الضرورية
     */
    private function remove_unnecessary_headers() {
        // إزالة مولد ووردبريس
        remove_action('wp_head', 'wp_generator');
        
        // إزالة روابط RSS
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        
        // إزالة roابط RSD
        remove_action('wp_head', 'rsd_link');
        
        // إزالة رابط Windows Live Writer
        remove_action('wp_head', 'wlwmanifest_link');
        
        // إزالة الرابط المختصر
        remove_action('wp_head', 'wp_shortlink_wp_head');
        
        // إزالة الرابط السابق والتالي
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        
        // تعطيل Emoji
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        
        // تعطيل oEmbed
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
    }
    
    /**
     * تحسين الاستعلامات
     */
    private function optimize_database_queries() {
        // تعطيل المراجعات المفرطة
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', 3);
        }
        
        // تحسين استعلامات الصور
        add_filter('posts_clauses', array($this, 'optimize_image_queries'), 10, 2);
        
        // تحسين استعلامات التصنيفات
        add_action('init', array($this, 'optimize_taxonomy_queries'));
    }
    
    /**
     * تحسين استعلامات الصور
     */
    public function optimize_image_queries($clauses, $query) {
        if (is_admin() || !$query->is_main_query()) {
            return $clauses;
        }
        
        if ($query->is_attachment()) {
            $clauses['where'] .= " AND post_mime_type LIKE 'image/%'";
        }
        
        return $clauses;
    }
    
    /**
     * تحسين استعلامات التصنيفات
     */
    public function optimize_taxonomy_queries() {
        // تخزين مؤقت للتصنيفات
        add_filter('get_terms', array($this, 'cache_terms'), 10, 3);
    }
    
    /**
     * تخزين مؤقت للتصنيفات
     */
    public function cache_terms($terms, $taxonomies, $args) {
        $cache_key = 'fadi_terms_' . md5(serialize($args));
        $cached_terms = get_transient($cache_key);
        
        if ($cached_terms === false) {
            set_transient($cache_key, $terms, HOUR_IN_SECONDS);
        }
        
        return $terms;
    }
    
    /**
     * تحسين الصور
     */
    private function optimize_images() {
        // إضافة lazy loading للصور
        add_filter('wp_get_attachment_image_attributes', array($this, 'add_lazy_loading'), 10, 3);
        
        // تحسين أحجام الصور
        add_action('after_setup_theme', array($this, 'optimize_image_sizes'));
        
        // ضغط الصور
        add_filter('jpeg_quality', array($this, 'set_jpeg_quality'));
    }
    
    /**
     * إضافة lazy loading للصور
     */
    public function add_lazy_loading($attr, $attachment, $size) {
        if (!is_admin()) {
            $attr['loading'] = 'lazy';
            $attr['decoding'] = 'async';
        }
        return $attr;
    }
    
    /**
     * تحسين أحجام الصور
     */
    public function optimize_image_sizes() {
        // إضافة أحجام محددة للقالب
        add_image_size('fadi-card', 300, 200, true);
        add_image_size('fadi-hero', 1200, 600, true);
        add_image_size('fadi-thumbnail', 150, 150, true);
    }
    
    /**
     * تحديد جودة JPEG
     */
    public function set_jpeg_quality($quality) {
        return 85; // جودة محسنة للسرعة والوضوح
    }
    
    /**
     * تفعيل ضغط GZIP
     */
    private function enable_gzip_compression() {
        if (!ob_get_level()) {
            ob_start('ob_gzhandler');
        }
    }
    
    /**
     * تحسين الـ CSS والـ JavaScript
     */
    public function optimize_scripts_styles() {
        if (!is_admin()) {
            // إزالة Block Library CSS إذا لم تكن مستخدمة
            if (!has_blocks()) {
                wp_dequeue_style('wp-block-library');
                wp_dequeue_style('wp-block-library-theme');
                wp_dequeue_style('wc-block-style');
            }
            
            // تأخير jQuery للفوتر
            if (!is_customize_preview()) {
                wp_scripts()->add_data('jquery', 'group', 1);
                wp_scripts()->add_data('jquery-core', 'group', 1);
                wp_scripts()->add_data('jquery-migrate', 'group', 1);
            }
            
            // تحسين خطوط Google
            $this->optimize_google_fonts();
        }
    }
    
    /**
     * تحسين خطوط Google
     */
    private function optimize_google_fonts() {
        // دمج طلبات خطوط Google
        add_filter('style_loader_src', array($this, 'combine_google_fonts'), 10, 2);
    }
    
    /**
     * دمج خطوط Google
     */
    public function combine_google_fonts($src, $handle) {
        if (strpos($src, 'fonts.googleapis.com') !== false) {
            // إضافة display=swap لتحسين الأداء
            if (strpos($src, 'display=swap') === false) {
                $src = add_query_arg('display', 'swap', $src);
            }
        }
        return $src;
    }
    
    /**
     * إضافة DNS prefetch
     */
    public function add_dns_prefetch() {
        echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
        echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    }
    
    /**
     * إضافة async/defer للـ JavaScript
     */
    public function add_async_defer_attributes($tag, $handle) {
        // قائمة الملفات التي تحتاج async
        $async_scripts = array('fadi-main');
        
        // قائمة الملفات التي تحتاج defer
        $defer_scripts = array('wp-embed', 'comment-reply');
        
        if (in_array($handle, $async_scripts)) {
            return str_replace('<script ', '<script async ', $tag);
        }
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace('<script ', '<script defer ', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إضافة CSS حرج مضمن
     */
    public function inline_critical_css() {
        if (is_front_page() || is_page('dashboard')) {
            ?>
            <style id="fadi-critical-css">
            /* CSS حرج للتحميل السريع */
            body { font-family: 'Tajawal', Arial, sans-serif; direction: rtl; }
            .site-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .login-form { max-width: 400px; margin: 50px auto; background: white; padding: 40px; border-radius: 10px; }
            .dashboard-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); }
            </style>
            <?php
        }
    }
    
    /**
     * تحسين قاعدة البيانات
     */
    public function optimize_database() {
        // تنظيف المراجعات القديمة
        $this->cleanup_revisions();
        
        // تنظيف التعليقات المرفوضة
        $this->cleanup_spam_comments();
        
        // تحسين الجداول
        $this->optimize_database_tables();
    }
    
    /**
     * تنظيف المراجعات القديمة
     */
    private function cleanup_revisions() {
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = 'revision' AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)");
    }
    
    /**
     * تنظيف التعليقات المرفوضة
     */
    private function cleanup_spam_comments() {
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_approved = 'spam' AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)");
    }
    
    /**
     * تحسين جداول قاعدة البيانات
     */
    private function optimize_database_tables() {
        global $wpdb;
        $tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE {$table[0]}");
        }
    }
}

// تهيئة محسن الأداء
new FADI_Performance_Optimizer();

/**
 * إضافة Cron Job لتحسين قاعدة البيانات
 */
function fadi_schedule_database_optimization() {
    if (!wp_next_scheduled('fadi_optimize_database')) {
        wp_schedule_event(time(), 'weekly', 'fadi_optimize_database');
    }
}
add_action('wp', 'fadi_schedule_database_optimization');

/**
 * تنفيذ تحسين قاعدة البيانات
 */
function fadi_run_database_optimization() {
    $optimizer = new FADI_Performance_Optimizer();
    $optimizer->optimize_database();
}
add_action('fadi_optimize_database', 'fadi_run_database_optimization');

/**
 * إضافة معلومات الأداء في الفوتر للمطورين
 */
function fadi_add_performance_info() {
    if (is_user_logged_in() && current_user_can('manage_options') && WP_DEBUG) {
        $queries = get_num_queries();
        $memory = size_format(memory_get_peak_usage(true));
        $time = timer_stop(0, 3);
        
        echo "<!-- FADI Performance: {$queries} queries | {$memory} memory | {$time}s load time -->";
    }
}
add_action('wp_footer', 'fadi_add_performance_info');

/**
 * تحسين الـ Heartbeat API
 */
function fadi_optimize_heartbeat($settings) {
    // تقليل تكرار Heartbeat
    $settings['interval'] = 60; // 60 ثانية بدلاً من 15
    return $settings;
}
add_filter('heartbeat_settings', 'fadi_optimize_heartbeat');

/**
 * تعطيل Heartbeat في صفحات غير مهمة
 */
function fadi_disable_heartbeat() {
    global $pagenow;
    
    // تعطيل في الواجهة الأمامية
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
    
    // تعطيل في صفحات تحرير المقالات إلا إذا كان هناك أكثر من مستخدم
    if ($pagenow === 'post.php' || $pagenow === 'post-new.php') {
        $user_count = count_users();
        if ($user_count['total_users'] <= 1) {
            wp_deregister_script('heartbeat');
        }
    }
}
add_action('init', 'fadi_disable_heartbeat', 1);