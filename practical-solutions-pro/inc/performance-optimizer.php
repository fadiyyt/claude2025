<?php
/**
 * Performance Optimizer - Enhanced Version
 * محسن الأداء المتقدم
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Performance_Optimizer {
    
    private $cache_dir;
    private $options;
    
    public function __construct() {
        $this->cache_dir = WP_CONTENT_DIR . '/cache/ps-cache/';
        $this->options = get_option('ps_performance_settings', []);
        
        add_action('init', [$this, 'init_optimizer']);
        add_action('wp_enqueue_scripts', [$this, 'optimize_assets']);
        add_action('wp_head', [$this, 'add_performance_hints'], 1);
        add_action('wp_footer', [$this, 'optimize_footer'], 99);
        add_filter('wp_get_attachment_image_attributes', [$this, 'add_lazy_loading'], 10, 3);
        add_action('wp_ajax_ps_clear_cache', [$this, 'clear_cache_ajax']);
        add_action('wp_ajax_ps_optimize_images', [$this, 'optimize_images_ajax']);
        
        // تحسينات تلقائية
        $this->setup_automatic_optimizations();
    }
    
    public function init_optimizer() {
        // إنشاء مجلد الكاش إذا لم يكن موجوداً
        if (!file_exists($this->cache_dir)) {
            wp_mkdir_p($this->cache_dir);
        }
        
        // تحسينات قاعدة البيانات
        if ($this->is_enabled('database_optimization')) {
            add_action('wp_scheduled_delete', [$this, 'cleanup_database']);
        }
        
        // ضغط HTML
        if ($this->is_enabled('html_minification')) {
            add_action('wp_loaded', [$this, 'start_html_compression']);
        }
    }
    
    public function optimize_assets() {
        // إزالة Emoji scripts غير الضرورية
        if ($this->is_enabled('remove_emoji')) {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
        }
        
        // إزالة jQuery Migrate
        if ($this->is_enabled('remove_jquery_migrate')) {
            add_action('wp_default_scripts', [$this, 'remove_jquery_migrate']);
        }
        
        // تأجيل JavaScript غير الحرج
        if ($this->is_enabled('defer_js')) {
            add_filter('script_loader_tag', [$this, 'defer_non_critical_js'], 10, 3);
        }
        
        // دمج وضغط CSS
        if ($this->is_enabled('combine_css')) {
            add_action('wp_print_styles', [$this, 'combine_css_files'], 100);
        }
    }
    
    public function add_performance_hints() {
        // DNS Prefetch للخدمات الخارجية
        echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
        echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
        
        // Preconnect للموارد المهمة
        echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
        
        // Preload للخطوط المهمة
        if ($this->is_enabled('preload_fonts')) {
            echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
        }
        
        // Critical CSS inline
        if ($this->is_enabled('critical_css')) {
            $this->output_critical_css();
        }
    }
    
    public function add_lazy_loading($attr, $attachment, $size) {
        if (!is_admin() && !is_feed()) {
            $attr['loading'] = 'lazy';
            $attr['decoding'] = 'async';
            
            // إضافة srcset محسن
            if ($this->is_enabled('responsive_images')) {
                $srcset = wp_get_attachment_image_srcset($attachment->ID, $size);
                if ($srcset) {
                    $attr['srcset'] = $srcset;
                    $attr['sizes'] = '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw';
                }
            }
        }
        return $attr;
    }
    
    public function optimize_footer() {
        if ($this->is_enabled('optimize_footer')) {
            // تأجيل تحميل ودجات غير مهمة
            echo '<script>
            window.addEventListener("load", function() {
                // تحميل ودجات التواصل الاجتماعي
                if (typeof loadSocialWidgets === "function") {
                    setTimeout(loadSocialWidgets, 2000);
                }
            });
            </script>';
        }
    }
    
    public function defer_non_critical_js($tag, $handle, $src) {
        // قائمة السكريبتات التي يجب تأجيلها
        $defer_scripts = [
            'ps-search',
            'ps-rating',
            'comment-reply',
            'wp-embed'
        ];
        
        // السكريبتات الحرجة التي لا يجب تأجيلها
        $critical_scripts = [
            'jquery-core',
            'ps-main'
        ];
        
        if (in_array($handle, $critical_scripts)) {
            return $tag;
        }
        
        if (in_array($handle, $defer_scripts) || strpos($handle, 'social') !== false) {
            return str_replace('<script ', '<script defer ', $tag);
        }
        
        return $tag;
    }
    
    public function remove_jquery_migrate($scripts) {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $script = $scripts->registered['jquery'];
            if ($script->deps) {
                $script->deps = array_diff($script->deps, ['jquery-migrate']);
            }
        }
    }
    
    public function combine_css_files() {
        if (!$this->is_enabled('combine_css') || is_admin()) {
            return;
        }
        
        global $wp_styles;
        
        $css_handles = [];
        $combined_css = '';
        
        foreach ($wp_styles->queue as $handle) {
            if (isset($wp_styles->registered[$handle])) {
                $style = $wp_styles->registered[$handle];
                
                // تجاهل الملفات الخارجية
                if (strpos($style->src, home_url()) === 0) {
                    $css_handles[] = $handle;
                    $file_path = str_replace(home_url(), ABSPATH, $style->src);
                    
                    if (file_exists($file_path)) {
                        $combined_css .= file_get_contents($file_path) . "\n";
                    }
                }
            }
        }
        
        if (!empty($combined_css)) {
            $cache_file = $this->cache_dir . 'combined-' . md5($combined_css) . '.css';
            
            if (!file_exists($cache_file)) {
                $minified_css = $this->minify_css($combined_css);
                file_put_contents($cache_file, $minified_css);
            }
            
            // إزالة الملفات الأصلية من القائمة
            foreach ($css_handles as $handle) {
                wp_dequeue_style($handle);
            }
            
            // إضافة الملف المدمج
            wp_enqueue_style('ps-combined', str_replace(ABSPATH, home_url() . '/', $cache_file), [], filemtime($cache_file));
        }
    }
    
    public function start_html_compression() {
        if (!is_admin() && $this->is_enabled('html_minification')) {
            ob_start([$this, 'compress_html']);
        }
    }
    
    public function compress_html($html) {
        // إزالة التعليقات HTML (عدا IE conditionals)
        $html = preg_replace('/<!--(?![\s\S]*(?:<!|-->))[\s\S]*?-->/', '', $html);
        
        // إزالة المسافات الزائدة
        $html = preg_replace('/\s+/', ' ', $html);
        
        // إزالة المسافات حول علامات HTML
        $html = preg_replace('/>\s+</', '><', $html);
        
        // إزالة المسافات في بداية ونهاية الصفحة
        $html = trim($html);
        
        return $html;
    }
    
    private function minify_css($css) {
        // إزالة التعليقات
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        
        // إزالة المسافات الزائدة
        $css = str_replace(["\r\n", "\r", "\n", "\t"], '', $css);
        $css = preg_replace('/\s+/', ' ', $css);
        
        // إزالة المسافات حول الأقواس والفواصل
        $css = str_replace([' {', '{ ', ' }', '} ', '; ', ' ;', ': ', ' :', ', ', ' ,'], ['{', '{', '}', '}', ';', ';', ':', ':', ',', ','], $css);
        
        return trim($css);
    }
    
    public function optimize_images() {
        if (!$this->is_enabled('image_optimization')) {
            return;
        }
        
        // تحسين جودة JPEG
        add_filter('wp_editor_set_quality', function($quality, $mime_type) {
            if ($mime_type === 'image/jpeg') {
                return 85;
            }
            return $quality;
        }, 10, 2);
        
        // تحويل تلقائي إلى WebP
        if (function_exists('imagewebp')) {
            add_filter('wp_generate_attachment_metadata', [$this, 'generate_webp_versions'], 10, 2);
        }
    }
    
    public function generate_webp_versions($metadata, $attachment_id) {
        if (!isset($metadata['file'])) {
            return $metadata;
        }
        
        $upload_dir = wp_upload_dir();
        $original_file = $upload_dir['basedir'] . '/' . $metadata['file'];
        
        if (file_exists($original_file)) {
            $this->convert_to_webp($original_file);
            
            // تحويل الأحجام المختلفة
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
    
    private function convert_to_webp($file_path) {
        $path_info = pathinfo($file_path);
        $webp_path = $path_info['dirname'] . '/' . $path_info['filename'] . '.webp';
        
        $extension = strtolower($path_info['extension']);
        
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($file_path);
                break;
            case 'png':
                $image = imagecreatefrompng($file_path);
                break;
            default:
                return false;
        }
        
        if ($image) {
            $result = imagewebp($image, $webp_path, 80);
            imagedestroy($image);
            return $result;
        }
        
        return false;
    }
    
    public function cleanup_database() {
        global $wpdb;
        
        if (!$this->is_enabled('database_optimization')) {
            return;
        }
        
        // حذف المراجعات القديمة (أكثر من 30 يوم)
        $wpdb->query("
            DELETE FROM {$wpdb->posts} 
            WHERE post_type = 'revision' 
            AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");
        
        // حذف التعليقات المرفوضة
        $wpdb->query("
            DELETE FROM {$wpdb->comments} 
            WHERE comment_approved = 'spam' 
            OR comment_approved = 'trash'
        ");
        
        // حذف البيانات الوسيطة اليتيمة
        $wpdb->query("
            DELETE pm FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID
            WHERE p.ID IS NULL
        ");
        
        // تحسين الجداول
        $tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE {$table[0]}");
        }
    }
    
    private function output_critical_css() {
        $critical_css = '
        body { font-family: Cairo, sans-serif; margin: 0; padding: 0; }
        .wp-block-site-logo img { max-width: 200px; height: auto; }
        .wp-block-navigation { list-style: none; display: flex; }
        .wp-block-heading { margin: 0 0 1rem; }
        .wp-block-paragraph { margin: 0 0 1rem; line-height: 1.6; }
        .wp-block-button__link { display: inline-block; padding: 0.75rem 1.5rem; text-decoration: none; }
        ';
        
        echo '<style id="ps-critical-css">' . $critical_css . '</style>' . "\n";
    }
    
    public function clear_cache() {
        if (!file_exists($this->cache_dir)) {
            return true;
        }
        
        $files = glob($this->cache_dir . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        
        // مسح كاش WordPress
        wp_cache_flush();
        
        return true;
    }
    
    public function clear_cache_ajax() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('غير مسموح', 'practical-solutions'));
        }
        
        $result = $this->clear_cache();
        
        if ($result) {
            wp_send_json_success(__('تم مسح الكاش بنجاح', 'practical-solutions'));
        } else {
            wp_send_json_error(__('فشل في مسح الكاش', 'practical-solutions'));
        }
    }
    
    public function optimize_images_ajax() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('غير مسموح', 'practical-solutions'));
        }
        
        $optimized_count = $this->bulk_optimize_images();
        
        wp_send_json_success([
            'message' => sprintf(__('تم تحسين %d صورة', 'practical-solutions'), $optimized_count),
            'count' => $optimized_count
        ]);
    }
    
    private function bulk_optimize_images($limit = 50) {
        $attachments = get_posts([
            'post_type' => 'attachment',
            'post_mime_type' => ['image/jpeg', 'image/png'],
            'posts_per_page' => $limit,
            'meta_query' => [
                [
                    'key' => '_ps_optimized',
                    'compare' => 'NOT EXISTS'
                ]
            ]
        ]);
        
        $optimized = 0;
        
        foreach ($attachments as $attachment) {
            $file_path = get_attached_file($attachment->ID);
            
            if ($file_path && file_exists($file_path)) {
                if ($this->convert_to_webp($file_path)) {
                    update_post_meta($attachment->ID, '_ps_optimized', time());
                    $optimized++;
                }
            }
        }
        
        return $optimized;
    }
    
    private function setup_automatic_optimizations() {
        // جدولة تنظيف تلقائي أسبوعي
        if (!wp_next_scheduled('ps_weekly_cleanup')) {
            wp_schedule_event(time(), 'weekly', 'ps_weekly_cleanup');
        }
        add_action('ps_weekly_cleanup', [$this, 'cleanup_database']);
        
        // جدولة تحسين الصور التلقائي
        if (!wp_next_scheduled('ps_daily_image_optimization')) {
            wp_schedule_event(time(), 'daily', 'ps_daily_image_optimization');
        }
        add_action('ps_daily_image_optimization', [$this, 'bulk_optimize_images']);
    }
    
    private function is_enabled($option) {
        return isset($this->options[$option]) && $this->options[$option];
    }
}

// تشغيل محسن الأداء
new PS_Performance_Optimizer();
?>