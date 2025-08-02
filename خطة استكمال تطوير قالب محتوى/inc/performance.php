<?php
/**
 * تحسين الأداء والسرعة
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
     * الخيارات الافتراضية
     */
    private static $default_options = array(
        'enable_cache' => true,
        'cache_expiry' => 3600,
        'enable_compression' => true,
        'enable_lazy_loading' => true,
        'optimize_images' => true,
        'minify_html' => false,
        'minify_css' => false,
        'minify_js' => false,
        'combine_css' => false,
        'combine_js' => false,
        'defer_js' => true,
        'async_css' => true,
        'remove_query_strings' => true,
        'disable_emojis' => true,
        'disable_embeds' => true,
        'limit_post_revisions' => 5,
        'autosave_interval' => 120,
        'optimize_database' => true,
        'cleanup_interval' => 'weekly',
    );
    
    /**
     * تهيئة تحسينات الأداء
     */
    public static function init_performance_optimizations() {
        // تحسينات عامة
        add_action('init', array(__CLASS__, 'general_optimizations'));
        
        // تحسين الصور
        add_filter('wp_handle_upload', array(__CLASS__, 'optimize_uploaded_images'));
        add_filter('wp_get_attachment_image_attributes', array(__CLASS__, 'add_lazy_loading_to_images'), 10, 3);
        
        // ضغط HTML
        if (get_theme_mod('muhtawaa_minify_html', false) && !is_admin()) {
            add_action('template_redirect', array(__CLASS__, 'start_html_compression'));
        }
        
        // تحسين قاعدة البيانات
        if (get_theme_mod('muhtawaa_optimize_db', true)) {
            add_action('muhtawaa_daily_cleanup', array(__CLASS__, 'optimize_database'));
            if (!wp_next_scheduled('muhtawaa_daily_cleanup')) {
                wp_schedule_event(time(), 'daily', 'muhtawaa_daily_cleanup');
            }
        }
        
        // تحسين WordPress
        self::optimize_wordpress();
        
        // تحسين WooCommerce
        if (class_exists('WooCommerce')) {
            self::optimize_woocommerce();
        }
        
        // إضافة رؤوس الأداء
        add_action('send_headers', array(__CLASS__, 'add_performance_headers'));
        
        // تنظيف قاعدة البيانات
        add_action('admin_menu', array(__CLASS__, 'add_performance_menu'));
        
        // AJAX للتحسين اليدوي
        add_action('wp_ajax_muhtawaa_optimize_performance', array(__CLASS__, 'ajax_optimize_performance'));
    }
    
    /**
     * تحسينات عامة
     */
    public static function general_optimizations() {
        // تعطيل الرموز التعبيرية
        if (get_theme_mod('muhtawaa_disable_emojis', true)) {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_filter('the_content_feed', 'wp_staticize_emoji');
            remove_filter('comment_text_rss', 'wp_staticize_emoji');
            remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
            add_filter('tiny_mce_plugins', function($plugins) {
                return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
            });
        }
        
        // تعطيل oEmbed
        if (get_theme_mod('muhtawaa_disable_embeds', true)) {
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('wp_head', 'wp_oembed_add_host_js');
            add_filter('embed_oembed_discover', '__return_false');
            remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
            remove_action('wp_head', 'rest_output_link_wp_head');
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('template_redirect', 'rest_output_link_header', 11);
        }
        
        // إزالة إصدار WordPress
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // إزالة روابط RSS
        if (!get_theme_mod('muhtawaa_enable_rss', true)) {
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'feed_links_extra', 3);
        }
        
        // إزالة روابط غير ضرورية
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        
        // تحديد عدد المراجعات
        $revisions = get_theme_mod('muhtawaa_limit_post_revisions', 5);
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', $revisions);
        }
        
        // تحديد فترة الحفظ التلقائي
        $autosave = get_theme_mod('muhtawaa_autosave_interval', 120);
        if (!defined('AUTOSAVE_INTERVAL')) {
            define('AUTOSAVE_INTERVAL', $autosave);
        }
        
        // تعطيل Heartbeat API في بعض الصفحات
        add_action('init', function() {
            global $pagenow;
            if ($pagenow != 'post.php' && $pagenow != 'post-new.php') {
                wp_deregister_script('heartbeat');
            }
        });
    }
    
    /**
     * تحسين WordPress
     */
    private static function optimize_wordpress() {
        // تحسين jQuery
        if (!is_admin()) {
            add_action('wp_enqueue_scripts', function() {
                if (!is_admin()) {
                    wp_deregister_script('jquery');
                    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true);
                    wp_enqueue_script('jquery');
                }
            });
        }
        
        // إزالة سلاسل الاستعلام من الموارد الثابتة
        if (get_theme_mod('muhtawaa_remove_query_strings', true)) {
            add_filter('script_loader_src', array(__CLASS__, 'remove_query_strings'), 15, 1);
            add_filter('style_loader_src', array(__CLASS__, 'remove_query_strings'), 15, 1);
        }
        
        // DNS Prefetching
        add_action('wp_head', function() {
            echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
            echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
            echo '<link rel="dns-prefetch" href="//ajax.googleapis.com">' . "\n";
            echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">' . "\n";
            echo '<link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
        }, 0);
        
        // Preconnect
        add_filter('wp_resource_hints', function($hints, $relation_type) {
            if ('preconnect' === $relation_type) {
                $hints[] = 'https://fonts.gstatic.com';
                $hints[] = 'https://fonts.googleapis.com';
                $hints[] = 'https://cdnjs.cloudflare.com';
            }
            return $hints;
        }, 10, 2);
    }
    
    /**
     * تحسين WooCommerce
     */
    private static function optimize_woocommerce() {
        // تعطيل أنماط وسكريبتات WooCommerce غير الضرورية
        add_action('wp_enqueue_scripts', function() {
            if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page()) {
                wp_dequeue_style('woocommerce-general');
                wp_dequeue_style('woocommerce-layout');
                wp_dequeue_style('woocommerce-smallscreen');
                wp_dequeue_script('wc-cart-fragments');
                wp_dequeue_script('woocommerce');
                wp_dequeue_script('wc-add-to-cart');
            }
        }, 100);
        
        // تعطيل أجزاء السلة في الصفحات غير التجارية
        add_action('wp_enqueue_scripts', function() {
            if (!is_woocommerce() && !is_cart()) {
                wp_dequeue_script('wc-cart-fragments');
            }
        }, 11);
    }
    
    /**
     * إزالة سلاسل الاستعلام
     */
    public static function remove_query_strings($src) {
        if (strpos($src, '?ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
    
    /**
     * تحسين الصور المرفوعة
     */
    public static function optimize_uploaded_images($upload) {
        if (!get_theme_mod('muhtawaa_optimize_images', true)) {
            return $upload;
        }
        
        $file_path = $upload['file'];
        $file_type = $upload['type'];
        
        // تحسين صور JPEG
        if ($file_type == 'image/jpeg' || $file_type == 'image/jpg') {
            $image = imagecreatefromjpeg($file_path);
            imagejpeg($image, $file_path, 85); // ضغط بجودة 85%
            imagedestroy($image);
        }
        
        // تحسين صور PNG
        elseif ($file_type == 'image/png') {
            $image = imagecreatefrompng($file_path);
            imagepng($image, $file_path, 7); // مستوى ضغط 7
            imagedestroy($image);
        }
        
        return $upload;
    }
    
    /**
     * إضافة التحميل الكسول للصور
     */
    public static function add_lazy_loading_to_images($attributes, $attachment, $size) {
        if (!get_theme_mod('muhtawaa_enable_lazy_loading', true)) {
            return $attributes;
        }
        
        if (!is_admin() && !is_feed()) {
            $attributes['loading'] = 'lazy';
            $attributes['decoding'] = 'async';
            
            // إضافة placeholder
            if (empty($attributes['data-src'])) {
                $attributes['data-src'] = $attributes['src'];
                $attributes['src'] = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMSIgaGVpZ2h0PSIxIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PC9zdmc+';
                $attributes['class'] = (isset($attributes['class']) ? $attributes['class'] . ' ' : '') . 'lazyload';
            }
        }
        
        return $attributes;
    }
    
    /**
     * بدء ضغط HTML
     */
    public static function start_html_compression() {
        ob_start(array(__CLASS__, 'compress_html'));
    }
    
    /**
     * ضغط HTML
     */
    public static function compress_html($html) {
        // إزالة التعليقات
        $html = preg_replace('/<!--(?!<!)[^\[>].*?-->/s', '', $html);
        
        // إزالة المسافات الزائدة
        $html = preg_replace('/\s+/', ' ', $html);
        
        // إزالة المسافات بين العلامات
        $html = preg_replace('/>\s+</', '><', $html);
        
        // إزالة المسافات حول = في الخصائص
        $html = preg_replace('/\s*=\s*/', '=', $html);
        
        return trim($html);
    }
    
    /**
     * تحسين قاعدة البيانات
     */
    public static function optimize_database() {
        global $wpdb;
        
        // تنظيف المراجعات القديمة
        $wpdb->query("DELETE FROM $wpdb->posts WHERE post_type = 'revision'");
        
        // تنظيف المسودات التلقائية
        $wpdb->query("DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft'");
        
        // تنظيف التعليقات المزعجة
        $wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'spam'");
        
        // تنظيف التعليقات المحذوفة
        $wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'trash'");
        
        // تنظيف البيانات الوصفية اليتيمة
        $wpdb->query("DELETE pm FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL");
        $wpdb->query("DELETE cm FROM $wpdb->commentmeta cm LEFT JOIN $wpdb->comments wc ON wc.comment_ID = cm.comment_id WHERE wc.comment_ID IS NULL");
        
        // تنظيف الخيارات العابرة المنتهية
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%' AND option_value < " . time());
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%' AND option_name NOT IN (SELECT CONCAT('_transient_', SUBSTRING(option_name, 19)) FROM (SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%' AND option_value >= " . time() . ") AS t)");
        
        // تحسين الجداول
        $tables = $wpdb->get_results("SHOW TABLES");
        foreach ($tables as $table) {
            foreach ($table as $table_name) {
                $wpdb->query("OPTIMIZE TABLE $table_name");
            }
        }
        
        // تسجيل آخر تنظيف
        update_option('muhtawaa_last_db_optimization', current_time('mysql'));
    }
    
    /**
     * إضافة رؤوس الأداء
     */
    public static function add_performance_headers() {
        if (!is_admin()) {
            // Browser Caching
            header('Cache-Control: max-age=31536000, public');
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
            
            // GZIP Compression
            if (get_theme_mod('muhtawaa_enable_compression', true)) {
                if (!in_array('ob_gzhandler', ob_list_handlers())) {
                    ob_start('ob_gzhandler');
                }
            }
            
            // Security Headers
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: no-referrer-when-downgrade');
            
            // Performance Headers
            header('Connection: keep-alive');
            header('Keep-Alive: timeout=5, max=100');
        }
    }
    
    /**
     * إضافة قائمة الأداء في لوحة التحكم
     */
    public static function add_performance_menu() {
        add_submenu_page(
            'themes.php',
            __('أداء القالب', 'muhtawaa'),
            __('أداء القالب', 'muhtawaa'),
            'manage_options',
            'muhtawaa-performance',
            array(__CLASS__, 'performance_page')
        );
    }
    
    /**
     * صفحة الأداء
     */
    public static function performance_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('أداء قالب محتوى', 'muhtawaa'); ?></h1>
            
            <div class="muhtawaa-performance-dashboard">
                <!-- إحصائيات الأداء -->
                <div class="performance-stats">
                    <h2><?php _e('إحصائيات الأداء', 'muhtawaa'); ?></h2>
                    <?php self::display_performance_stats(); ?>
                </div>
                
                <!-- أدوات التحسين -->
                <div class="performance-tools">
                    <h2><?php _e('أدوات التحسين', 'muhtawaa'); ?></h2>
                    
                    <div class="tool-buttons">
                        <button class="button button-primary" id="optimize-database">
                            <?php _e('تحسين قاعدة البيانات', 'muhtawaa'); ?>
                        </button>
                        
                        <button class="button" id="clear-cache">
                            <?php _e('مسح التخزين المؤقت', 'muhtawaa'); ?>
                        </button>
                        
                        <button class="button" id="optimize-images">
                            <?php _e('تحسين الصور', 'muhtawaa'); ?>
                        </button>
                        
                        <button class="button" id="minify-assets">
                            <?php _e('ضغط الملفات', 'muhtawaa'); ?>
                        </button>
                    </div>
                    
                    <div id="optimization-results"></div>
                </div>
                
                <!-- تقرير الأداء -->
                <div class="performance-report">
                    <h2><?php _e('تقرير الأداء', 'muhtawaa'); ?></h2>
                    <?php self::generate_performance_report(); ?>
                </div>
            </div>
            
            <script>
            jQuery(document).ready(function($) {
                $('#optimize-database').click(function() {
                    performOptimization('database');
                });
                
                $('#clear-cache').click(function() {
                    performOptimization('cache');
                });
                
                $('#optimize-images').click(function() {
                    performOptimization('images');
                });
                
                $('#minify-assets').click(function() {
                    performOptimization('assets');
                });
                
                function performOptimization(type) {
                    $('#optimization-results').html('<p><?php _e('جاري التحسين...', 'muhtawaa'); ?></p>');
                    
                    $.post(ajaxurl, {
                        action: 'muhtawaa_optimize_performance',
                        type: type,
                        nonce: '<?php echo wp_create_nonce('muhtawaa_performance'); ?>'
                    }, function(response) {
                        if (response.success) {
                            $('#optimization-results').html('<div class="notice notice-success"><p>' + response.data.message + '</p></div>');
                        } else {
                            $('#optimization-results').html('<div class="notice notice-error"><p>' + response.data.message + '</p></div>');
                        }
                    });
                }
            });
            </script>
            
            <style>
            .muhtawaa-performance-dashboard {
                margin-top: 20px;
            }
            
            .performance-stats,
            .performance-tools,
            .performance-report {
                background: #fff;
                border: 1px solid #ccd0d4;
                border-radius: 4px;
                padding: 20px;
                margin-bottom: 20px;
            }
            
            .tool-buttons {
                margin: 20px 0;
            }
            
            .tool-buttons .button {
                margin-right: 10px;
                margin-bottom: 10px;
            }
            
            .stat-box {
                display: inline-block;
                background: #f1f1f1;
                padding: 15px;
                margin: 10px 10px 10px 0;
                border-radius: 4px;
                min-width: 150px;
                text-align: center;
            }
            
            .stat-box .stat-value {
                font-size: 24px;
                font-weight: bold;
                color: #0073aa;
            }
            
            .stat-box .stat-label {
                font-size: 14px;
                color: #666;
            }
            </style>
        </div>
        <?php
    }
    
    /**
     * عرض إحصائيات الأداء
     */
    private static function display_performance_stats() {
        global $wpdb;
        
        // حجم قاعدة البيانات
        $db_size = $wpdb->get_var("SELECT SUM(data_length + index_length) / 1024 / 1024 FROM information_schema.tables WHERE table_schema = '" . DB_NAME . "'");
        
        // عدد المراجعات
        $revisions = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'revision'");
        
        // عدد المسودات التلقائية
        $auto_drafts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'auto-draft'");
        
        // عدد التعليقات المزعجة
        $spam_comments = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = 'spam'");
        
        // عدد الخيارات العابرة
        $transients = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->options WHERE option_name LIKE '_transient_%'");
        
        ?>
        <div class="performance-stats-grid">
            <div class="stat-box">
                <div class="stat-value"><?php echo number_format($db_size, 2); ?> MB</div>
                <div class="stat-label"><?php _e('حجم قاعدة البيانات', 'muhtawaa'); ?></div>
            </div>
            
            <div class="stat-box">
                <div class="stat-value"><?php echo number_format($revisions); ?></div>
                <div class="stat-label"><?php _e('مراجعات المقالات', 'muhtawaa'); ?></div>
            </div>
            
            <div class="stat-box">
                <div class="stat-value"><?php echo number_format($auto_drafts); ?></div>
                <div class="stat-label"><?php _e('مسودات تلقائية', 'muhtawaa'); ?></div>
            </div>
            
            <div class="stat-box">
                <div class="stat-value"><?php echo number_format($spam_comments); ?></div>
                <div class="stat-label"><?php _e('تعليقات مزعجة', 'muhtawaa'); ?></div>
            </div>
            
            <div class="stat-box">
                <div class="stat-value"><?php echo number_format($transients); ?></div>
                <div class="stat-label"><?php _e('خيارات عابرة', 'muhtawaa'); ?></div>
            </div>
        </div>
        
        <?php
        $last_optimization = get_option('muhtawaa_last_db_optimization');
        if ($last_optimization) {
            echo '<p>' . sprintf(__('آخر تحسين: %s', 'muhtawaa'), date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($last_optimization))) . '</p>';
        }
    }
    
    /**
     * توليد تقرير الأداء
     */
    private static function generate_performance_report() {
        $report = array();
        
        // فحص الإعدادات
        $settings = array(
            'lazy_loading' => get_theme_mod('muhtawaa_enable_lazy_loading', true),
            'minify_html' => get_theme_mod('muhtawaa_minify_html', false),
            'disable_emojis' => get_theme_mod('muhtawaa_disable_emojis', true),
            'optimize_db' => get_theme_mod('muhtawaa_optimize_db', true),
        );
        
        ?>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('الميزة', 'muhtawaa'); ?></th>
                    <th><?php _e('الحالة', 'muhtawaa'); ?></th>
                    <th><?php _e('التوصية', 'muhtawaa'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php _e('التحميل الكسول للصور', 'muhtawaa'); ?></td>
                    <td><?php echo $settings['lazy_loading'] ? '<span style="color:green;">✓ ' . __('مفعل', 'muhtawaa') . '</span>' : '<span style="color:red;">✗ ' . __('معطل', 'muhtawaa') . '</span>'; ?></td>
                    <td><?php echo !$settings['lazy_loading'] ? __('يُنصح بتفعيل هذه الميزة لتحسين سرعة التحميل', 'muhtawaa') : __('ممتاز!', 'muhtawaa'); ?></td>
                </tr>
                
                <tr>
                    <td><?php _e('ضغط HTML', 'muhtawaa'); ?></td>
                    <td><?php echo $settings['minify_html'] ? '<span style="color:green;">✓ ' . __('مفعل', 'muhtawaa') . '</span>' : '<span style="color:orange;">✗ ' . __('معطل', 'muhtawaa') . '</span>'; ?></td>
                    <td><?php echo !$settings['minify_html'] ? __('يمكن تفعيل هذه الميزة لتقليل حجم الصفحات', 'muhtawaa') : __('ممتاز!', 'muhtawaa'); ?></td>
                </tr>
                
                <tr>
                    <td><?php _e('تعطيل الرموز التعبيرية', 'muhtawaa'); ?></td>
                    <td><?php echo $settings['disable_emojis'] ? '<span style="color:green;">✓ ' . __('مفعل', 'muhtawaa') . '</span>' : '<span style="color:orange;">✗ ' . __('معطل', 'muhtawaa') . '</span>'; ?></td>
                    <td><?php echo !$settings['disable_emojis'] ? __('تعطيل الرموز التعبيرية يحسن الأداء', 'muhtawaa') : __('ممتاز!', 'muhtawaa'); ?></td>
                </tr>
                
                <tr>
                    <td><?php _e('تحسين قاعدة البيانات التلقائي', 'muhtawaa'); ?></td>
                    <td><?php echo $settings['optimize_db'] ? '<span style="color:green;">✓ ' . __('مفعل', 'muhtawaa') . '</span>' : '<span style="color:red;">✗ ' . __('معطل', 'muhtawaa') . '</span>'; ?></td>
                    <td><?php echo !$settings['optimize_db'] ? __('يُنصح بتفعيل التحسين التلقائي', 'muhtawaa') : __('ممتاز!', 'muhtawaa'); ?></td>
                </tr>
            </tbody>
        </table>
        <?php
    }
    
    /**
     * معالج AJAX للتحسين
     */
    public static function ajax_optimize_performance() {
        check_ajax_referer('muhtawaa_performance', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die(__('ليس لديك صلاحية لتنفيذ هذا الإجراء', 'muhtawaa'));
        }
        
        $type = sanitize_text_field($_POST['type']);
        $result = array();
        
        switch ($type) {
            case 'database':
                self::optimize_database();
                $result = array(
                    'success' => true,
                    'data' => array(
                        'message' => __('تم تحسين قاعدة البيانات بنجاح', 'muhtawaa'),
                    ),
                );
                break;
                
            case 'cache':
                self::clear_all_cache();
                $result = array(
                    'success' => true,
                    'data' => array(
                        'message' => __('تم مسح التخزين المؤقت بنجاح', 'muhtawaa'),
                    ),
                );
                break;
                
            case 'images':
                $optimized = self::bulk_optimize_images();
                $result = array(
                    'success' => true,
                    'data' => array(
                        'message' => sprintf(__('تم تحسين %d صورة', 'muhtawaa'), $optimized),
                    ),
                );
                break;
                
            case 'assets':
                self::minify_theme_assets();
                $result = array(
                    'success' => true,
                    'data' => array(
                        'message' => __('تم ضغط ملفات CSS و JavaScript', 'muhtawaa'),
                    ),
                );
                break;
                
            default:
                $result = array(
                    'success' => false,
                    'data' => array(
                        'message' => __('نوع التحسين غير صحيح', 'muhtawaa'),
                    ),
                );
        }
        
        wp_send_json($result);
    }
    
    /**
     * مسح جميع أنواع التخزين المؤقت
     */
    private static function clear_all_cache() {
        global $wpdb;
        
        // مسح التخزين المؤقت للخيارات العابرة
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%'");
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_site_transient_%'");
        
        // مسح object cache
        wp_cache_flush();
        
        // مسح rewrite rules
        flush_rewrite_rules();
        
        // مسح ملفات التخزين المؤقت إن وجدت
        $cache_dir = WP_CONTENT_DIR . '/cache/';
        if (is_dir($cache_dir)) {
            self::delete_directory($cache_dir);
        }
        
        // إشارة لإضافات التخزين المؤقت الأخرى
        do_action('muhtawaa_clear_cache');
    }
    
    /**
     * حذف مجلد بالكامل
     */
    private static function delete_directory($dir) {
        if (!is_dir($dir)) {
            return;
        }
        
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                self::delete_directory($path);
            } else {
                unlink($path);
            }
        }
        
        rmdir($dir);
    }
    
    /**
     * تحسين الصور بشكل جماعي
     */
    private static function bulk_optimize_images() {
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => array('image/jpeg', 'image/jpg', 'image/png'),
            'post_status' => 'inherit',
            'posts_per_page' => 100,
            'meta_query' => array(
                array(
                    'key' => '_muhtawaa_optimized',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
        
        $attachments = get_posts($args);
        $optimized = 0;
        
        foreach ($attachments as $attachment) {
            $file_path = get_attached_file($attachment->ID);
            
            if (file_exists($file_path)) {
                $file_type = $attachment->post_mime_type;
                
                // تحسين الصورة
                if ($file_type == 'image/jpeg' || $file_type == 'image/jpg') {
                    $image = @imagecreatefromjpeg($file_path);
                    if ($image) {
                        imagejpeg($image, $file_path, 85);
                        imagedestroy($image);
                        $optimized++;
                    }
                } elseif ($file_type == 'image/png') {
                    $image = @imagecreatefrompng($file_path);
                    if ($image) {
                        imagepng($image, $file_path, 7);
                        imagedestroy($image);
                        $optimized++;
                    }
                }
                
                // وضع علامة على الصورة كمحسنة
                update_post_meta($attachment->ID, '_muhtawaa_optimized', true);
            }
        }
        
        return $optimized;
    }
    
    /**
     * ضغط ملفات القالب
     */
    private static function minify_theme_assets() {
        $css_dir = THEME_PATH . '/assets/css/';
        $js_dir = THEME_PATH . '/assets/js/';
        
        // ضغط ملفات CSS
        $css_files = glob($css_dir . '*.css');
        foreach ($css_files as $file) {
            if (strpos($file, '.min.css') === false) {
                $content = file_get_contents($file);
                $minified = self::minify_css($content);
                $min_file = str_replace('.css', '.min.css', $file);
                file_put_contents($min_file, $minified);
            }
        }
        
        // ضغط ملفات JavaScript
        $js_files = glob($js_dir . '*.js');
        foreach ($js_files as $file) {
            if (strpos($file, '.min.js') === false) {
                $content = file_get_contents($file);
                $minified = self::minify_js($content);
                $min_file = str_replace('.js', '.min.js', $file);
                file_put_contents($min_file, $minified);
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
        $css = str_replace(array("\r\n", "\r", "\n", "\t"), '', $css);
        $css = preg_replace('/\s+/', ' ', $css);
        
        // إزالة المسافات حول الرموز
        $css = preg_replace('/\s*([{}:;,])\s*/', '$1', $css);
        
        // إزالة آخر فاصلة منقوطة
        $css = str_replace(';}', '}', $css);
        
        return trim($css);
    }
    
    /**
     * ضغط JavaScript
     */
    private static function minify_js($js) {
        // إزالة التعليقات المتعددة الأسطر
        $js = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $js);
        
        // إزالة التعليقات أحادية السطر
        $js = preg_replace('/\/\/.*$/m', '', $js);
        
        // إزالة المسافات الزائدة
        $js = preg_replace('/\s+/', ' ', $js);
        
        // إزالة المسافات حول الرموز
        $js = preg_replace('/\s*([{}:;,=\(\)])\s*/', '$1', $js);
        
        return trim($js);
    }
    
    /**
     * مراقب الأداء
     */
    public static function performance_monitor() {
        if (!is_admin() && current_user_can('manage_options') && isset($_GET['performance_monitor'])) {
            $start_time = microtime(true);
            $start_memory = memory_get_usage();
            
            add_action('wp_footer', function() use ($start_time, $start_memory) {
                $end_time = microtime(true);
                $end_memory = memory_get_usage();
                
                $execution_time = ($end_time - $start_time) * 1000; // بالميلي ثانية
                $memory_usage = ($end_memory - $start_memory) / 1024 / 1024; // بالميجابايت
                $peak_memory = memory_get_peak_usage() / 1024 / 1024;
                
                global $wpdb;
                $queries = $wpdb->num_queries;
                
                ?>
                <div id="muhtawaa-performance-monitor" style="position:fixed;bottom:0;left:0;background:#222;color:#fff;padding:10px;font-size:12px;z-index:99999;">
                    <strong>أداء الصفحة:</strong>
                    وقت التحميل: <?php echo number_format($execution_time, 2); ?>ms |
                    الذاكرة المستخدمة: <?php echo number_format($memory_usage, 2); ?>MB |
                    أقصى ذاكرة: <?php echo number_format($peak_memory, 2); ?>MB |
                    استعلامات: <?php echo $queries; ?>
                    <button onclick="this.parentElement.style.display='none'" style="margin-left:10px;cursor:pointer;">×</button>
                </div>
                <?php
            }, 999);
        }
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public static function optimize_queries() {
        // تحسين استعلامات المقالات
        add_filter('posts_request', function($sql, $query) {
            if (!is_admin() && $query->is_main_query()) {
                // إضافة فهرس للاستعلامات المتكررة
                if ($query->is_home() || $query->is_archive()) {
                    $sql = str_replace('SQL_CALC_FOUND_ROWS', '', $sql);
                }
            }
            return $sql;
        }, 10, 2);
        
        // تقليل استعلامات التصنيفات
        add_filter('widget_categories_args', function($args) {
            $args['hide_empty'] = 1;
            $args['number'] = 20;
            return $args;
        });
        
        // تحسين استعلامات التعليقات
        add_filter('comments_template_query_args', function($args) {
            $args['number'] = 50;
            $args['status'] = 'approve';
            return $args;
        });
    }
    
    /**
     * نظام التخزين المؤقت المدمج
     */
    public static function cache_system() {
        // التخزين المؤقت للاستعلامات
        add_filter('posts_results', function($posts, $query) {
            if (!is_admin() && $query->is_main_query()) {
                $cache_key = 'muhtawaa_query_' . md5(serialize($query->query_vars));
                $cached = get_transient($cache_key);
                
                if ($cached === false) {
                    set_transient($cache_key, $posts, HOUR_IN_SECONDS);
                }
            }
            return $posts;
        }, 10, 2);
        
        // التخزين المؤقت للويدجت
        add_filter('widget_display_callback', function($instance, $widget, $args) {
            $cache_key = 'muhtawaa_widget_' . $widget->id;
            $cached = get_transient($cache_key);
            
            if ($cached === false) {
                ob_start();
                $widget->widget($args, $instance);
                $output = ob_get_clean();
                set_transient($cache_key, $output, HOUR_IN_SECONDS);
                echo $output;
                return false;
            } else {
                echo $cached;
                return false;
            }
        }, 10, 3);
    }
    
    /**
     * Critical CSS
     */
    public static function inline_critical_css() {
        if (!is_admin()) {
            add_action('wp_head', function() {
                $critical_css = '
                /* Critical CSS للأداء الأولي */
                body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif}
                .container{max-width:1200px;margin:0 auto;padding:0 20px}
                header{background:#fff;box-shadow:0 2px 4px rgba(0,0,0,.1)}
                nav{display:flex;align-items:center;justify-content:space-between;padding:1rem 0}
                main{min-height:80vh;padding:2rem 0}
                footer{background:#333;color:#fff;padding:2rem 0;margin-top:4rem}
                ';
                
                echo '<style id="muhtawaa-critical-css">' . self::minify_css($critical_css) . '</style>';
            }, 1);
        }
    }
    
    /**
     * WebP Support
     */
    public static function enable_webp_support() {
        // دعم رفع WebP
        add_filter('upload_mimes', function($mimes) {
            $mimes['webp'] = 'image/webp';
            return $mimes;
        });
        
        // عرض WebP في المكتبة
        add_filter('wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
            $filetype = wp_check_filetype($filename, $mimes);
            
            if (in_array($filetype['ext'], ['webp'])) {
                $data['ext'] = $filetype['ext'];
                $data['type'] = $filetype['type'];
            }
            
            return $data;
        }, 10, 4);
    }
    
    /**
     * تنظيف ووردبريس من الميزات غير المطلوبة
     */
    public static function cleanup_wordpress() {
        // إزالة روابط غير ضرورية من الهيدر
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        // أضف أي تنظيفات أخرى تحتاجها هنا
    }
}

// تهيئة تحسينات الأداء
add_action('init', array('MuhtawaaPerformance', 'performance_monitor'));
add_action('init', array('MuhtawaaPerformance', 'optimize_queries'));
add_action('init', array('MuhtawaaPerformance', 'cache_system'));
add_action('init', array('MuhtawaaPerformance', 'inline_critical_css'));
add_action('init', array('MuhtawaaPerformance', 'enable_webp_support'));