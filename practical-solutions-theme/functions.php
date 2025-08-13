<?php
/**
 * Practical Solutions Theme Functions
 * قالب الحلول العملية - الوظائف الرئيسية
 * * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 * @link https://your-website.com
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * تعريف الثوابت الأساسية للقالب
 */
define('PRACTICAL_SOLUTIONS_VERSION', '1.0.0');
define('PRACTICAL_SOLUTIONS_THEME_DIR', get_template_directory());
define('PRACTICAL_SOLUTIONS_THEME_URI', get_template_directory_uri());
define('PRACTICAL_SOLUTIONS_THEME_NAME', 'practical-solutions');

/**
 * تضمين الملفات المطلوبة - مع فحص وجود الملفات
 */

// الملفات الأساسية (مطلوبة)
$required_files = array(
    '/inc/theme_setup.php',
    '/inc/enqueue_scripts.php',
);

foreach ($required_files as $file) {
    $file_path = PRACTICAL_SOLUTIONS_THEME_DIR . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    } else {
        // إضافة إشعار للمطور في حال عدم وجود الملف
        add_action('admin_notices', function() use ($file) {
            echo '<div class="notice notice-error"><p>';
            printf(__('ملف مطلوب مفقود: %s', 'practical-solutions'), $file);
            echo '</p></div>';
        });
    }
}

// الملفات الاختيارية
$optional_files = array(
    '/inc/customizer.php',
    '/inc/ajax_handlers.php',
    '/inc/search_functions.php',
    '/inc/performance.php',
    '/inc/security.php',
    '/inc/seo_functions.php',
);

foreach ($optional_files as $file) {
    $file_path = PRACTICAL_SOLUTIONS_THEME_DIR . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}

/**
 * إعداد القالب الأساسي
 * * @since 1.0.0
 */
if (!function_exists('practical_solutions_setup')) {
    function practical_solutions_setup() {
        // دعم ميزات ووردبريس الأساسية
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
        ));
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ));

        // دعم ميزات Block Editor
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        
        // دعم Full Site Editing
        add_theme_support('block-templates');
        add_theme_support('block-template-parts');
        
        // دعم الألوان المخصصة
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ));
        add_theme_support('custom-header', array(
            'default-image'      => '',
            'random-default'     => false,
            'width'              => 1200,
            'height'             => 400,
            'flex-height'        => true,
            'flex-width'         => true,
            'default-text-color' => '2c3e50',
            'header-text'        => true,
            'uploads'            => true,
        ));
        
        // دعم تنسيقات المقالات
        add_theme_support('post-formats', array(
            'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
        ));

        // تسجيل قوائم التنقل
        register_nav_menus(array(
            'primary' => __('القائمة الرئيسية', 'practical-solutions'),
            'footer'  => __('قائمة التذييل', 'practical-solutions'),
            'social'  => __('قائمة وسائل التواصل', 'practical-solutions'),
        ));

        // تحديد أحجام الصور المخصصة
        add_image_size('practical-solutions-featured', 800, 450, true);
        add_image_size('practical-solutions-thumbnail', 400, 300, true);
        add_image_size('practical-solutions-medium', 600, 400, true);
        add_image_size('practical-solutions-large', 1200, 800, true);
        add_image_size('practical-solutions-hero', 1920, 1080, true);

        // دعم الترجمة
        load_theme_textdomain('practical-solutions', get_template_directory() . '/languages');
    }
}
add_action('after_setup_theme', 'practical_solutions_setup');

/**
 * تسجيل الكتل المخصصة
 * * @since 1.0.0
 */
if (!function_exists('practical_solutions_register_custom_blocks')) {
    function practical_solutions_register_custom_blocks() {
        $blocks_dir = PRACTICAL_SOLUTIONS_THEME_DIR . '/blocks';
        
        if (is_dir($blocks_dir)) {
            $block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);
            
            foreach ($block_folders as $block_folder) {
                $block_json = $block_folder . '/block.json';
                
                if (file_exists($block_json)) {
                    register_block_type($block_folder);
                }
            }
        }
    }
}
add_action('init', 'practical_solutions_register_custom_blocks');

/**
 * إضافة دعم WebP للصور
 * * @since 1.0.0
 */
if (!function_exists('practical_solutions_add_webp_support')) {
    function practical_solutions_add_webp_support($mimes) {
        $mimes['webp'] = 'image/webp';
        return $mimes;
    }
}
add_filter('upload_mimes', 'practical_solutions_add_webp_support');

/**
 * تحسين عملية البحث
 * * @param WP_Query $query
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_extend_search')) {
    function practical_solutions_extend_search($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            $query->set('post_type', array('post', 'page'));
        }
    }
}
add_action('pre_get_posts', 'practical_solutions_extend_search');

/**
 * إضافة فئات أنماط مخصصة للكتل
 * * @since 1.0.0
 */
if (!function_exists('practical_solutions_register_block_styles')) {
    function practical_solutions_register_block_styles() {
        // أنماط مخصصة لكتلة المجموعة
        register_block_style('core/group', array(
            'name'  => 'card',
            'label' => __('بطاقة', 'practical-solutions'),
        ));

        register_block_style('core/group', array(
            'name'  => 'shadow',
            'label' => __('مع ظل', 'practical-solutions'),
        ));

        // أنماط مخصصة لكتلة الأزرار
        register_block_style('core/button', array(
            'name'  => 'rounded',
            'label' => __('دائري', 'practical-solutions'),
        ));

        register_block_style('core/button', array(
            'name'  => 'outline',
            'label' => __('محدد', 'practical-solutions'),
        ));
    }
}
add_action('init', 'practical_solutions_register_block_styles');

/**
 * تخصيص طول المقتطف
 * * @param int $length
 * @return int
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_excerpt_length')) {
    function practical_solutions_excerpt_length($length) {
        if (is_admin()) {
            return $length;
        }
        return 30;
    }
}
add_filter('excerpt_length', 'practical_solutions_excerpt_length');

/**
 * تخصيص نهاية المقتطف
 * * @param string $more
 * @return string
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_excerpt_more')) {
    function practical_solutions_excerpt_more($more) {
        if (is_admin()) {
            return $more;
        }
        return '...';
    }
}
add_filter('excerpt_more', 'practical_solutions_excerpt_more');

/**
 * إضافة معرف فريد لكل صفحة في الـ body class
 * * @param array $classes
 * @return array
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_body_classes')) {
    function practical_solutions_body_classes($classes) {
        // إضافة كلاس اللغة
        $classes[] = 'lang-' . str_replace('_', '-', get_locale());
        
        // إضافة كلاس نوع الصفحة
        if (is_front_page()) {
            $classes[] = 'home-page';
        } elseif (is_single()) {
            $classes[] = 'single-post';
        } elseif (is_page()) {
            $classes[] = 'single-page';
        } elseif (is_archive()) {
            $classes[] = 'archive-page';
        } elseif (is_search()) {
            $classes[] = 'search-page';
        }
        
        return $classes;
    }
}
add_filter('body_class', 'practical_solutions_body_classes');

/**
 * تنظيف وتحسين header HTML
 * * @since 1.0.0
 */
if (!function_exists('practical_solutions_cleanup_head')) {
    function practical_solutions_cleanup_head() {
        // إزالة روابط غير ضرورية
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'adjacent_posts_rel_link');
        
        // إزالة Emoji scripts
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('init', 'practical_solutions_cleanup_head');

/**
 * إضافة معلومات إضافية لـ wp_head
 * * @since 1.0.0
 */
if (!function_exists('practical_solutions_add_head_meta')) {
    function practical_solutions_add_head_meta() {
        echo '<meta name="theme-color" content="#007cba">' . "\n";
        echo '<meta name="msapplication-TileColor" content="#007cba">' . "\n";
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">' . "\n";
        
        // إضافة DNS prefetch للموارد الخارجية
        echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
        echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
    }
}
add_action('wp_head', 'practical_solutions_add_head_meta', 1);

// تحميل ملفات إضافية حسب الحاجة
if (is_admin()) {
    $admin_file = PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/admin-functions.php';
    if (file_exists($admin_file)) {
        require_once $admin_file;
    }
}

if (class_exists('WooCommerce')) {
    $woo_file = PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/woocommerce-support.php';
    if (file_exists($woo_file)) {
        require_once $woo_file;
    }
}