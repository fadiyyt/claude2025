<?php
/**
 * Theme Name: محتوى - الحلول اليومية المطور
 * Functions and definitions - النسخة المُحدثة مع الإصلاحات
 * 
 * @package Muhtawaa
 * @version 2.0.2
 */

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ========================================
// 1. تعريف الثوابت الأساسية أولاً
// ========================================
if (!defined('THEME_VERSION'))         define('THEME_VERSION', '2.0.2');
if (!defined('THEME_PATH'))            define('THEME_PATH', get_template_directory());
if (!defined('THEME_URL'))             define('THEME_URL', get_template_directory_uri());
if (!defined('THEME_ASSETS_URL'))      define('THEME_ASSETS_URL', THEME_URL . '/assets');
if (!defined('THEME_INC_PATH'))        define('THEME_INC_PATH', THEME_PATH . '/inc');
if (!defined('THEME_LANGUAGES_PATH'))  define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');
if (!defined('THEME_MIN_WP_VERSION'))  define('THEME_MIN_WP_VERSION', '5.0');
if (!defined('THEME_MIN_PHP_VERSION')) define('THEME_MIN_PHP_VERSION', '7.0');

// ========================================
// 2. تحميل ملف التشخيص والإصلاحات
// ========================================
$diagnostic_file = THEME_PATH . '/diagnostic-fixes.php';
if (file_exists($diagnostic_file)) {
    require_once $diagnostic_file;
}

// ========================================
// 3. إعداد القالب الأساسي
// ========================================
function muhtawaa_theme_setup() {
    // دعم المزايا الأساسية
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('custom-logo');
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // تسجيل القوائم
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'muhtawaa'),
        'footer' => __('قائمة التذييل', 'muhtawaa'),
        'mobile' => __('قائمة الموبايل', 'muhtawaa'),
    ));
    
    // تحميل ملفات اللغة
    load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
}
add_action('after_setup_theme', 'muhtawaa_theme_setup');

// ========================================
// 4. تحميل ملفات CSS و JavaScript (مُبسط)
// ========================================
function muhtawaa_enqueue_assets() {
    // إزالة جميع الأنماط والسكريبتات السابقة أولاً
    // wp_dequeue_style('muhtawaa-style');
    // wp_dequeue_style('muhtawaa-main');
    
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );
    
    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // الملف الأساسي
    wp_enqueue_style(
        'muhtawaa-style',
        get_stylesheet_uri(),
        array(),
        THEME_VERSION . '.' . time() // إضافة timestamp للتطوير
    );
    
    // ملف CSS الرئيسي
    $main_css = THEME_PATH . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'muhtawaa-main',
            THEME_ASSETS_URL . '/css/main.css',
            array('muhtawaa-style'),
            THEME_VERSION . '.' . time()
        );
    }
    
    // ملف CSS التجاوب
    $responsive_css = THEME_PATH . '/assets/css/responsive.css';
    if (file_exists($responsive_css)) {
        wp_enqueue_style(
            'muhtawaa-responsive',
            THEME_ASSETS_URL . '/css/responsive.css',
            array('muhtawaa-main'),
            THEME_VERSION . '.' . time()
        );
    }
    
    // jQuery
    wp_enqueue_script('jquery');
    
    // ملف JavaScript الرئيسي
    $main_js = THEME_PATH . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script(
            'muhtawaa-main',
            THEME_ASSETS_URL . '/js/main.js',
            array('jquery'),
            THEME_VERSION . '.' . time(),
            true
        );
        
        // بيانات JavaScript
        wp_localize_script('muhtawaa-main', 'muhtawaa_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_ajax_nonce'),
            'site_url' => home_url(),
            'theme_url' => THEME_URL,
        ));
    }
    
    // تعليقات
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'muhtawaa_enqueue_assets', 999);

// ========================================
// 5. تحميل الملفات المطلوبة
// ========================================
function muhtawaa_load_includes() {
    $includes = array(
        'enqueue-scripts.php',
        'theme-setup.php',
        'widgets.php',
        'customizer.php',
        'helper-functions.php',
        'admin-dashboard.php',
        'security.php',
        'performance.php',
        'seo.php',
        'notifications.php',
        'maintenance.php',
        'import-export.php',
        'smart-recommendations.php',
        'advanced-search.php',
        'comments-rating.php',
        'custom-widgets.php',
        'ajax-functions.php',
    );
    
    foreach ($includes as $file) {
        $filepath = THEME_INC_PATH . '/' . $file;
        if (file_exists($filepath)) {
            require_once $filepath;
        } else {
            // سجل خطأ إذا كان الملف مفقود
            if (WP_DEBUG) {
                error_log('ملف مفقود في قالب محتوى: ' . $filepath);
            }
        }
    }
}
add_action('after_setup_theme', 'muhtawaa_load_includes', 5);

// ========================================
// 6. تسجيل مناطق الويدجت (مُبسط)
// ========================================
function muhtawaa_widgets_init() {
    // الشريط الجانبي الرئيسي
    register_sidebar(array(
        'name'          => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
        'id'            => 'main-sidebar',
        'description'   => __('يظهر في معظم صفحات الموقع', 'muhtawaa'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // مناطق التذييل
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'muhtawaa_widgets_init');

// ========================================
// 7. دوال مساعدة أساسية
// ========================================

// وقت القراءة
if (!function_exists('muhtawaa_reading_time')) {
    function muhtawaa_reading_time($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);
        
        if ($reading_time == 1) {
            return __('دقيقة واحدة', 'muhtawaa');
        } elseif ($reading_time == 2) {
            return __('دقيقتان', 'muhtawaa');
        } elseif ($reading_time <= 10) {
            return sprintf(__('%d دقائق', 'muhtawaa'), $reading_time);
        } else {
            return sprintf(__('%d دقيقة', 'muhtawaa'), $reading_time);
        }
    }
}

// عدد المشاهدات
if (!function_exists('muhtawaa_get_post_views')) {
    function muhtawaa_get_post_views($post_id) {
        $views = get_post_meta($post_id, '_muhtawaa_views', true);
        return $views ? number_format_i18n($views) : '0';
    }
}

// المقالات ذات الصلة
if (!function_exists('muhtawaa_get_related_posts')) {
    function muhtawaa_get_related_posts($post_id, $count = 3) {
        $categories = wp_get_post_categories($post_id);
        
        $args = array(
            'post__not_in' => array($post_id),
            'posts_per_page' => $count,
            'category__in' => $categories,
            'orderby' => 'rand',
        );
        
        return new WP_Query($args);
    }
}

// ========================================
// 8. إصلاحات سريعة
// ========================================

// إصلاح مشكلة عدم ظهور القوائم
add_filter('wp_nav_menu_args', function($args) {
    if (empty($args['fallback_cb'])) {
        $args['fallback_cb'] = function() {
            echo '<ul class="main-menu">';
            wp_list_pages(array(
                'title_li' => '',
                'depth' => 1,
                'number' => 5,
            ));
            echo '</ul>';
        };
    }
    return $args;
});

// إضافة CSS إضافي للإصلاحات السريعة
add_action('wp_head', function() {
    ?>
    <style id="muhtawaa-quick-fixes">
        /* إصلاحات سريعة */
        body { margin: 0; padding: 0; }
        .site-header { position: relative; z-index: 100; }
        .site-content { position: relative; z-index: 1; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        img { max-width: 100%; height: auto; }
        
        /* إصلاح القائمة */
        .main-navigation ul { list-style: none; padding: 0; margin: 0; }
        .main-navigation li { display: inline-block; margin: 0 10px; }
        .main-navigation a { text-decoration: none; color: inherit; }
        
        /* إصلاح التخطيط */
        .content-area { display: flex; flex-wrap: wrap; gap: 30px; }
        .content-area.full-width { display: block; }
        .site-main { flex: 1; min-width: 0; }
        .widget-area { flex: 0 0 300px; }
        
        /* إصلاح الويدجت */
        .widget { margin-bottom: 30px; }
        .widget ul { list-style: none; padding: 0; }
        .widget li { padding: 5px 0; }
        
        /* إصلاح الصور البارزة */
        .post-thumbnail img { width: 100%; height: auto; display: block; }
        
        /* التجاوب الأساسي */
        @media (max-width: 768px) {
            .content-area { flex-direction: column; }
            .widget-area { flex: 1 1 100%; }
            .main-navigation li { display: block; margin: 5px 0; }
        }
    </style>
    <?php
}, 999);

// ========================================
// 9. رسائل التنبيه للمطور
// ========================================
if (WP_DEBUG && current_user_can('manage_options')) {
    add_action('admin_notices', function() {
        $missing_files = array();
        
        // فحص الملفات المهمة
        $check_files = array(
            'assets/css/main.css',
            'assets/js/main.js',
            'single.php',
            'page.php',
            'sidebar.php',
            'comments.php',
        );
        
        foreach ($check_files as $file) {
            if (!file_exists(THEME_PATH . '/' . $file)) {
                $missing_files[] = $file;
            }
        }
        
        if (!empty($missing_files)) {
            echo '<div class="notice notice-warning">';
            echo '<p><strong>قالب محتوى:</strong> الملفات التالية مفقودة:</p>';
            echo '<ul>';
            foreach ($missing_files as $file) {
                echo '<li><code>' . $file . '</code></li>';
            }
            echo '</ul>';
            echo '<p><a href="' . admin_url('themes.php?page=muhtawaa-diagnostics') . '" class="button">تشغيل أداة التشخيص</a></p>';
            echo '</div>';
        }
    });
}

// ========================================
// 10. تفعيل القالب - إعدادات أولية
// ========================================
add_action('after_switch_theme', function() {
    // إنشاء الصفحات الأساسية
    $pages = array(
        'من نحن' => 'about',
        'اتصل بنا' => 'contact',
        'سياسة الخصوصية' => 'privacy',
        'شروط الاستخدام' => 'terms',
    );
    
    foreach ($pages as $title => $slug) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_name' => $slug,
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_content' => 'محتوى الصفحة هنا...',
            ));
        }
    }
    
    // إعداد الصفحة الرئيسية
    $homepage = get_page_by_path('home');
    if (!$homepage) {
        $homepage_id = wp_insert_post(array(
            'post_title' => 'الرئيسية',
            'post_name' => 'home',
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => '',
        ));
        
        update_option('page_on_front', $homepage_id);
        update_option('show_on_front', 'page');
    }
    
    // حفظ الروابط الدائمة
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
});