<?php
/**
 * Practical Solutions Pro - Functions (Fixed & Enhanced)
 * قالب الحلول العملية الاحترافي - الوظائف المصححة والمحسنة
 * الإصدار: 2.2.3 (مصحح)
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// 1. تعريف الثوابت الأساسية
// =============================================================================
define('PS_THEME_VERSION', '2.2.3');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());
define('PS_DIST_URI', PS_THEME_URI . '/dist');
define('PS_CACHE_DURATION', 3600);
define('PS_DEBUG', defined('WP_DEBUG') && WP_DEBUG);

// =============================================================================
// 2. تحميل ملفات النظام الأساسية (فقط الموجودة)
// =============================================================================
$ps_core_includes = [
    'inc/theme-admin-panel.php',      
    'inc/customizer-settings.php',    
    'inc/block-patterns.php',         
    'inc/unified-search-system.php',  
    'inc/rating-system.php',          
    'inc/performance-optimizer.php',
    'inc/security-enhancements.php'
];

foreach ($ps_core_includes as $file) {
    $filepath = PS_THEME_DIR . '/' . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        if (PS_DEBUG) {
            error_log("PS Theme: Missing file - {$file}");
        }
    }
}

// =============================================================================
// 3. إعدادات القالب الأساسية
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
        
        // دعم ميزات قوالب الكتل
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
        
        // تسجيل مناطق القوائم
        register_nav_menus([
            'primary' => __('القائمة الرئيسية', 'practical-solutions'),
            'footer' => __('قائمة التذييل', 'practical-solutions'),
            'social' => __('الروابط الاجتماعية', 'practical-solutions')
        ]);
        
        // إضافة أحجام صور مخصصة
        add_image_size('ps-featured', 800, 450, true);
        add_image_size('ps-thumbnail', 300, 200, true);
        add_image_size('ps-card', 400, 250, true);
    }
}
add_action('after_setup_theme', 'ps_theme_setup');

// =============================================================================
// 4. تحميل الأصول (CSS & JS) - مصحح
// =============================================================================
function ps_enqueue_assets() {
    // CSS
    $css_file = PS_DIST_URI . '/css/main.min.css';
    if (file_exists(PS_THEME_DIR . '/dist/css/main.min.css')) {
        wp_enqueue_style('ps-main-style', $css_file, [], PS_THEME_VERSION);
    } else {
        // fallback للتطوير
        wp_enqueue_style('ps-main-style', PS_THEME_URI . '/src/scss/main.scss', [], PS_THEME_VERSION);
    }
    
    // JavaScript
    $js_file = PS_DIST_URI . '/js/main.min.js';
    if (file_exists(PS_THEME_DIR . '/dist/js/main.min.js')) {
        wp_enqueue_script('ps-main-script', $js_file, ['jquery'], PS_THEME_VERSION, true);
    } else {
        // fallback للتطوير
        wp_enqueue_script('ps-main-script', PS_THEME_URI . '/assets/js/unified.js', ['jquery'], PS_THEME_VERSION, true);
    }
    
    // إعدادات JavaScript
    wp_localize_script('ps-main-script', 'psAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ps_nonce'),
        'home_url' => home_url('/'),
        'theme_url' => PS_THEME_URI,
        'is_rtl' => is_rtl(),
        'lang' => get_locale(),
        'debug' => PS_DEBUG
    ]);
    
    // تحميل أنماط المحرر
    add_editor_style($css_file);
}
add_action('wp_enqueue_scripts', 'ps_enqueue_assets');

// =============================================================================
// 5. Ajax Endpoints للميزات التفاعلية
// =============================================================================
function ps_ajax_search() {
    check_ajax_referer('ps_nonce', 'nonce');
    
    $query = sanitize_text_field($_POST['query'] ?? '');
    $results = [];
    
    if (strlen($query) >= 2) {
        $search_query = new WP_Query([
            's' => $query,
            'posts_per_page' => 5,
            'post_status' => 'publish'
        ]);
        
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $results[] = [
                'title' => get_the_title(),
                'url' => get_permalink(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 15),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'ps-thumbnail')
            ];
        }
        wp_reset_postdata();
    }
    
    wp_send_json_success($results);
}
add_action('wp_ajax_ps_search', 'ps_ajax_search');
add_action('wp_ajax_nopriv_ps_search', 'ps_ajax_search');

function ps_ajax_save_rating() {
    check_ajax_referer('ps_nonce', 'nonce');
    
    $post_id = intval($_POST['post_id'] ?? 0);
    $rating = intval($_POST['rating'] ?? 0);
    
    if (!$post_id || $rating < 1 || $rating > 5) {
        wp_send_json_error('بيانات غير صحيحة');
    }
    
    // حفظ التقييم
    $ratings = get_post_meta($post_id, '_ps_ratings', true) ?: [];
    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    if (!isset($ratings[$user_ip])) {
        $ratings[$user_ip] = $rating;
        update_post_meta($post_id, '_ps_ratings', $ratings);
        
        // حساب المتوسط
        $average = array_sum($ratings) / count($ratings);
        update_post_meta($post_id, '_ps_rating_average', round($average, 1));
        update_post_meta($post_id, '_ps_rating_count', count($ratings));
        
        wp_send_json_success([
            'average' => round($average, 1),
            'count' => count($ratings)
        ]);
    } else {
        wp_send_json_error('تم التقييم مسبقاً');
    }
}
add_action('wp_ajax_ps_save_rating', 'ps_ajax_save_rating');
add_action('wp_ajax_nopriv_ps_save_rating', 'ps_ajax_save_rating');

function ps_ajax_save_bookmark() {
    check_ajax_referer('ps_nonce', 'nonce');
    
    $post_id = intval($_POST['post_id'] ?? 0);
    if (!$post_id) {
        wp_send_json_error('معرف المقال غير صحيح');
    }
    
    // حفظ في localStorage من جانب JavaScript
    wp_send_json_success([
        'post_id' => $post_id,
        'title' => get_the_title($post_id),
        'url' => get_permalink($post_id)
    ]);
}
add_action('wp_ajax_ps_save_bookmark', 'ps_ajax_save_bookmark');
add_action('wp_ajax_nopriv_ps_save_bookmark', 'ps_ajax_save_bookmark');

// =============================================================================
// 6. إعدادات PWA المحسنة
// =============================================================================
function ps_add_pwa_meta() {
    ?>
    <meta name="theme-color" content="#007cba">
    <meta name="msapplication-TileColor" content="#007cba">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
    <link rel="manifest" href="<?php echo PS_THEME_URI; ?>/manifest.json">
    <?php
    
    // إضافة أيقونات متعددة الأحجام
    $icon_sizes = [16, 32, 57, 72, 96, 114, 120, 144, 152, 180, 192, 384, 512];
    foreach ($icon_sizes as $size) {
        $icon_path = PS_DIST_URI . "/images/icon-{$size}.png";
        if (file_exists(PS_THEME_DIR . "/dist/images/icon-{$size}.png")) {
            echo "<link rel=\"icon\" type=\"image/png\" sizes=\"{$size}x{$size}\" href=\"{$icon_path}\">\n";
            if ($size >= 57) {
                echo "<link rel=\"apple-touch-icon\" sizes=\"{$size}x{$size}\" href=\"{$icon_path}\">\n";
            }
        }
    }
}
add_action('wp_head', 'ps_add_pwa_meta');

// تسجيل Service Worker المصحح
function ps_register_service_worker() {
    if (!is_admin()) {
        ?>
        <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('<?php echo PS_THEME_URI; ?>/sw.js')
                    .then(function(registration) {
                        if (psAjax.debug) console.log('SW registered: ', registration);
                    })
                    .catch(function(registrationError) {
                        if (psAjax.debug) console.log('SW registration failed: ', registrationError);
                    });
            });
        }
        </script>
        <?php
    }
}
add_action('wp_footer', 'ps_register_service_worker');

// =============================================================================
// 7. تحسينات الأداء
// =============================================================================
function ps_optimize_performance() {
    // تأجيل تحميل JavaScript غير الضروري
    add_filter('script_loader_tag', function($tag, $handle, $src) {
        if (!is_admin() && !in_array($handle, ['jquery-core', 'ps-main-script'])) {
            return str_replace(' src', ' defer src', $tag);
        }
        return $tag;
    }, 10, 3);
    
    // إزالة scripts غير الضرورية
    add_action('wp_enqueue_scripts', function() {
        if (!is_admin()) {
            wp_deregister_script('wp-embed');
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
        }
    }, 100);
    
    // ضغط HTML
    if (!PS_DEBUG) {
        add_action('get_header', function() {
            ob_start(function($buffer) {
                return preg_replace('/\s+/', ' ', $buffer);
            });
        });
    }
}
add_action('init', 'ps_optimize_performance');

// =============================================================================
// 8. دوال مساعدة
// =============================================================================
if (!function_exists('ps_get_post_rating')) {
    function ps_get_post_rating($post_id = null) {
        if (!$post_id) $post_id = get_the_ID();
        
        $average = get_post_meta($post_id, '_ps_rating_average', true);
        $count = get_post_meta($post_id, '_ps_rating_count', true);
        
        return [
            'average' => floatval($average ?: 0),
            'count' => intval($count ?: 0)
        ];
    }
}

if (!function_exists('ps_display_rating_stars')) {
    function ps_display_rating_stars($rating, $size = 'medium') {
        $size_class = 'ps-stars-' . $size;
        $full_stars = floor($rating);
        $half_star = ($rating - $full_stars) >= 0.5;
        
        $output = '<div class="ps-rating-stars ' . esc_attr($size_class) . '">';
        
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $full_stars) {
                $output .= '<span class="ps-star full">★</span>';
            } elseif ($i == $full_stars + 1 && $half_star) {
                $output .= '<span class="ps-star half">☆</span>';
            } else {
                $output .= '<span class="ps-star empty">☆</span>';
            }
        }
        
        $output .= '</div>';
        return $output;
    }
}

// =============================================================================
// 9. تفعيل الميزات حسب الحاجة
// =============================================================================
function ps_conditional_features() {
    // تفعيل ميزات حسب الصفحة
    global $wp_query;
    
    $features = [
        'search' => !is_admin(),
        'rating' => is_single(),
        'bookmarks' => !is_admin(),
        'dark_mode' => true,
        'scroll_top' => !is_admin()
    ];
    
    wp_localize_script('ps-main-script', 'psFeatures', $features);
}
add_action('wp_enqueue_scripts', 'ps_conditional_features', 20);
?>