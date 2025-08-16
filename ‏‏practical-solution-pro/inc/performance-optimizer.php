<?php
/**
 * Performance Optimizer for Practical Solutions Pro
 * محسن الأداء لقالب الحلول العملية الاحترافي
 * الإصدار: 2.2.2 (محسن - بدون دمج ديناميكي)
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Performance_Optimizer {
    
    private $cache_enabled = true;
    private $compression_enabled = true;
    
    public function __construct() {
        add_action('init', [$this, 'init_optimizations']);
        add_action('wp_enqueue_scripts', [$this, 'optimize_scripts'], 100);
        add_filter('style_loader_tag', [$this, 'add_async_css'], 10, 2);
        add_filter('script_loader_tag', [$this, 'add_defer_attribute'], 10, 2);
        add_action('wp_head', [$this, 'add_preload_hints'], 1);
        add_action('wp_footer', [$this, 'add_resource_hints'], 1);
    }
    
    /**
     * تطبيق التحسينات الأساسية
     */
    public function init_optimizations() {
        // تفعيل gzip compression إذا لم يكن مفعلاً
        if (!ob_get_level() && $this->compression_enabled) {
            ob_start([$this, 'compress_output']);
        }
        
        // تحسين إعدادات PHP
        if (function_exists('ini_set')) {
            ini_set('memory_limit', '256M');
            ini_set('max_execution_time', 120);
            ini_set('max_input_vars', 3000);
        }
        
        // إزالة query strings من الملفات الثابتة
        add_filter('style_loader_src', [$this, 'remove_query_strings'], 10, 1);
        add_filter('script_loader_src', [$this, 'remove_query_strings'], 10, 1);
        
        // تحسين قاعدة البيانات تلقائياً
        add_action('wp_loaded', [$this, 'optimize_database_queries']);
    }
    
    /**
     * ضغط الإخراج النهائي
     */
    public function compress_output($output) {
        if (strlen($output) > 2048 && function_exists('gzencode') && !headers_sent()) {
            $accept_encoding = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
            
            if (strpos($accept_encoding, 'gzip') !== false) {
                $compressed = gzencode($output, 9);
                if ($compressed !== false) {
                    header('Content-Encoding: gzip');
                    header('Vary: Accept-Encoding');
                    header('Content-Length: ' . strlen($compressed));
                    return $compressed;
                }
            }
        }
        return $output;
    }
    
    /**
     * تحسين تحميل الملفات (بدون دمج ديناميكي)
     */
    public function optimize_scripts() {
        // إزالة الملفات غير الضرورية
        wp_dequeue_script('wp-embed');
        wp_dequeue_style('wp-block-library-theme');
        
        // إزالة CSS و JS غير مستخدمة حسب الصفحة
        if (!is_admin_bar_showing()) {
            wp_dequeue_style('admin-bar');
            wp_dequeue_script('admin-bar');
        }
        
        if (!is_singular() || !comments_open()) {
            wp_dequeue_script('comment-reply');
        }
        
        // تحسين تحميل emoji styles
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
    }
    
    /**
     * إضافة preload hints للموارد المهمة
     */
    public function add_preload_hints() {
        // preload للخطوط المهمة
        ?>
        <link rel="preload" href="<?php echo PS_THEME_URI; ?>/dist/css/main.min.css" as="style">
        <link rel="preload" href="<?php echo PS_THEME_URI; ?>/dist/js/main.min.js" as="script">
        <?php
        
        // preload للصورة المميزة في المقالات
        if (is_singular() && has_post_thumbnail()) {
            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            if ($featured_image) {
                echo '<link rel="preload" href="' . esc_url($featured_image[0]) . '" as="image">';
            }
        }
    }
    
    /**
     * إضافة resource hints للتحسين
     */
    public function add_resource_hints() {
        ?>
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <?php
    }
    
    /**
     * إضافة async للـ CSS غير الحرجة
     */
    public function add_async_css($tag, $handle) {
        // تطبيق async فقط على ملفات القالب
        if (strpos($handle, 'ps-') === 0 && strpos($handle, 'main') === false) {
            return str_replace('<link ', '<link rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" ', $tag);
        }
        return $tag;
    }
    
    /**
     * إضافة defer للجافا سكريبت غير الحرجة
     */
    public function add_defer_attribute($tag, $handle) {
        $defer_scripts = ['ps-rating-system', 'ps-analytics'];
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        // إضافة async للملفات غير الحرجة
        $async_scripts = ['google-analytics', 'gtag'];
        if (in_array($handle, $async_scripts)) {
            return str_replace(' src', ' async src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إزالة query strings
     */
    public function remove_query_strings($src) {
        if (strpos($src, '?ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public function optimize_database_queries() {
        // تقليل عدد المراجعات المحفوظة
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', 3);
        }
        
        // تحسين autosave interval
        if (!defined('AUTOSAVE_INTERVAL')) {
            define('AUTOSAVE_INTERVAL', 300); // 5 دقائق
        }
        
        // تفعيل object cache إذا كان متاحاً
        if (function_exists('wp_cache_add_global_groups')) {
            wp_cache_add_global_groups(['posts', 'comments', 'options']);
        }
    }
    
    /**
     * تحسين قاعدة البيانات المجدول
     */
    public function optimize_database() {
        global $wpdb;
        
        // تحسين الجداول الرئيسية
        $tables = [$wpdb->posts, $wpdb->postmeta, $wpdb->comments, $wpdb->commentmeta, $wpdb->options];
        
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE {$table}");
        }
        
        // حذف البيانات غير الضرورية بطريقة آمنة
        $this->cleanup_database_safely();
        
        // تحديث إحصائيات قاعدة البيانات
        $wpdb->query("ANALYZE TABLE {$wpdb->posts}");
        $wpdb->query("ANALYZE TABLE {$wpdb->options}");
    }
    
    /**
     * تنظيف قاعدة البيانات بطريقة آمنة
     */
    private function cleanup_database_safely() {
        global $wpdb;
        
        // حذف transients منتهية الصلاحية فقط
        $expired_transients = $wpdb->get_col(
            "SELECT option_name FROM {$wpdb->options} 
             WHERE option_name LIKE '_transient_timeout_%' 
             AND option_value < UNIX_TIMESTAMP()"
        );
        
        foreach ($expired_transients as $transient) {
            $key = str_replace('_transient_timeout_', '', $transient);
            delete_transient($key);
        }
        
        // حذف orphaned meta data
        $wpdb->query(
            "DELETE pm FROM {$wpdb->postmeta} pm 
             LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id 
             WHERE p.ID IS NULL"
        );
        
        $wpdb->query(
            "DELETE cm FROM {$wpdb->commentmeta} cm 
             LEFT JOIN {$wpdb->comments} c ON c.comment_ID = cm.comment_id 
             WHERE c.comment_ID IS NULL"
        );
    }
    
    /**
     * تنظيف التخزين المؤقت المتقدم
     */
    public function clear_cache() {
        // مسح WordPress cache
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
        
        // مسح object cache
        if (function_exists('wp_cache_delete_multiple')) {
            $cache_groups = ['posts', 'comments', 'options', 'post_meta', 'comment_meta'];
            foreach ($cache_groups as $group) {
                wp_cache_flush_group($group);
            }
        }
        
        // مسح ملفات التخزين المؤقت المخصصة
        $cache_dirs = [
            WP_CONTENT_DIR . '/cache/ps-cache/',
            WP_CONTENT_DIR . '/uploads/ps-temp/'
        ];
        
        foreach ($cache_dirs as $cache_dir) {
            if (is_dir($cache_dir)) {
                $this->delete_directory_contents($cache_dir);
            }
        }
    }
    
    /**
     * حذف محتويات مجلد
     */
    private function delete_directory_contents($dir) {
        if (!is_dir($dir)) return;
        
        $files = glob($dir . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->delete_directory_contents($file);
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }
    
    /**
     * تحسين الصور تلقائياً
     */
    public function optimize_images() {
        // تحسين جودة الصور المرفوعة
        add_filter('wp_editor_set_quality', function($quality, $mime_type) {
            switch ($mime_type) {
                case 'image/jpeg':
                    return 85;
                case 'image/png':
                    return 90;
                case 'image/webp':
                    return 80;
                default:
                    return $quality;
            }
        }, 10, 2);
        
        // تفعيل WebP إذا كان مدعوماً
        if (function_exists('imagewebp')) {
            add_filter('wp_generate_attachment_metadata', [$this, 'generate_webp_images'], 10, 2);
        }
    }
    
    /**
     * إنشاء صور WebP
     */
    public function generate_webp_images($metadata, $attachment_id) {
        if (!isset($metadata['file'])) return $metadata;
        
        $upload_dir = wp_upload_dir();
        $original_file = $upload_dir['basedir'] . '/' . $metadata['file'];
        
        if (file_exists($original_file)) {
            $this->convert_to_webp($original_file);
            
            // تحويل الأحجام المختلفة أيضاً
            if (isset($metadata['sizes'])) {
                foreach ($metadata['sizes'] as $size) {
                    $size_file = dirname($original_file) . '/' . $size['file'];
                    if (file_exists($size_file)) {
                        $this->convert_to_webp($size_file);
                    }
                }
            }
        }
        
        return $metadata;
    }
    
    /**
     * تحويل صورة إلى WebP
     */
    private function convert_to_webp($file_path) {
        $path_info = pathinfo($file_path);
        $webp_path = $path_info['dirname'] . '/' . $path_info['filename'] . '.webp';
        
        $image_type = wp_check_filetype($file_path)['type'];
        
        switch ($image_type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file_path);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file_path);
                break;
            default:
                return false;
        }
        
        if ($image) {
            imagewebp($image, $webp_path, 80);
            imagedestroy($image);
            return true;
        }
        
        return false;
    }
    
    /**
     * مراقبة الأداء
     */
    public function monitor_performance() {
        if (PS_DEBUG) {
            $memory_usage = memory_get_peak_usage(true);
            $query_count = get_num_queries();
            $load_time = timer_stop(0, 3);
            
            $performance_data = [
                'memory' => $memory_usage,
                'queries' => $query_count,
                'load_time' => $load_time,
                'timestamp' => time()
            ];
            
            // حفظ بيانات الأداء للمراجعة
            $daily_performance = get_option('ps_performance_' . date('Y_m_d'), []);
            $daily_performance[] = $performance_data;
            
            // الاحتفاظ بآخر 100 قراءة فقط
            if (count($daily_performance) > 100) {
                $daily_performance = array_slice($daily_performance, -100);
            }
            
            update_option('ps_performance_' . date('Y_m_d'), $daily_performance);
        }
    }
}

// تشغيل المحسن
new PS_Performance_Optimizer();