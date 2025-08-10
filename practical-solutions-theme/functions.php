<?php
/**
 * Practical Solutions Theme Functions
 * قالب الحلول العملية - الوظائف الرئيسية
 * 
 * @package Practical_Solutions
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
 * تضمين الملفات المطلوبة
 */
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/theme-setup.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/enqueue-scripts.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/customizer.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/ajax-handlers.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/search-functions.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/performance.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/security.php';
require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/seo-functions.php';

/**
 * إعداد القالب الأساسي
 * 
 * @since 1.0.0
 */
function practical_solutions_setup() {
    // دعم ميزات ووردبريس الأساسية
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
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
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    
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

    // دعم الترجمة
    load_theme_textdomain('practical-solutions', get_template_directory() . '/languages');

    // إعداد محتوى العرض الافتراضي
    $GLOBALS['content_width'] = 800;
}
add_action('after_setup_theme', 'practical_solutions_setup');

/**
 * تسجيل Sidebars والمناطق القابلة للتخصيص
 * 
 * @since 1.0.0
 */
function practical_solutions_widgets_init() {
    register_sidebar(array(
        'name'          => __('الشريط الجانبي الرئيسي', 'practical-solutions'),
        'id'            => 'sidebar-primary',
        'description'   => __('الشريط الجانبي للمقالات والصفحات', 'practical-solutions'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('منطقة التذييل 1', 'practical-solutions'),
        'id'            => 'footer-1',
        'description'   => __('العمود الأول في تذييل الصفحة', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('منطقة التذييل 2', 'practical-solutions'),
        'id'            => 'footer-2',
        'description'   => __('العمود الثاني في تذييل الصفحة', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('منطقة التذييل 3', 'practical-solutions'),
        'id'            => 'footer-3',
        'description'   => __('العمود الثالث في تذييل الصفحة', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'practical_solutions_widgets_init');

/**
 * تحميل الأنماط والسكربتات
 * 
 * @since 1.0.0
 */
function practical_solutions_enqueue_scripts() {
    // تحميل الأنماط الرئيسية
    wp_enqueue_style(
        'practical-solutions-style',
        get_stylesheet_uri(),
        array(),
        PRACTICAL_SOLUTIONS_VERSION
    );

    // تحميل أنماط RTL
    wp_style_add_data('practical-solutions-style', 'rtl', 'replace');

    // تحميل الخطوط
    wp_enqueue_style(
        'practical-solutions-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // تحميل JavaScript الرئيسي
    wp_enqueue_script(
        'practical-solutions-main',
        PRACTICAL_SOLUTIONS_THEME_URI . '/assets/js/main.min.js',
        array('jquery'),
        PRACTICAL_SOLUTIONS_VERSION,
        true
    );

    // تمرير البيانات إلى JavaScript
    wp_localize_script('practical-solutions-main', 'practicalSolutions', array(
        'ajaxUrl'    => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('practical_solutions_nonce'),
        'homeUrl'    => home_url('/'),
        'themeUrl'   => PRACTICAL_SOLUTIONS_THEME_URI,
        'isRTL'      => is_rtl(),
        'language'   => get_locale(),
        'strings'    => array(
            'search_placeholder' => __('ابحث عن الحلول...', 'practical-solutions'),
            'voice_search_start' => __('اضغط للبحث الصوتي', 'practical-solutions'),
            'voice_search_stop'  => __('اضغط لإيقاف التسجيل', 'practical-solutions'),
            'no_results'         => __('لا توجد نتائج', 'practical-solutions'),
            'loading'           => __('جاري التحميل...', 'practical-solutions'),
            'error_occurred'    => __('حدث خطأ، يرجى المحاولة مرة أخرى', 'practical-solutions'),
        )
    ));

    // تحميل أنماط للمحرر
    if (is_admin()) {
        add_editor_style('assets/css/editor-style.css');
    }

    // تحميل سكربت التعليقات للصفحات المناسبة
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_scripts');

/**
 * إضافة أنماط مخصصة للمحرر
 * 
 * @since 1.0.0
 */
function practical_solutions_editor_styles() {
    wp_enqueue_style(
        'practical-solutions-editor',
        PRACTICAL_SOLUTIONS_THEME_URI . '/assets/css/editor-style.css',
        array(),
        PRACTICAL_SOLUTIONS_VERSION
    );
}
add_action('enqueue_block_editor_assets', 'practical_solutions_editor_styles');

/**
 * تسجيل Block Patterns مخصصة
 * 
 * @since 1.0.0
 */
function practical_solutions_register_block_patterns() {
    // تسجيل فئة أنماط خاصة بالقالب
    register_block_pattern_category('practical-solutions', array(
        'label' => __('الحلول العملية', 'practical-solutions'),
    ));

    // تحميل ملفات الأنماط
    $pattern_files = glob(PRACTICAL_SOLUTIONS_THEME_DIR . '/patterns/*.php');
    
    foreach ($pattern_files as $pattern_file) {
        $pattern_slug = 'practical-solutions/' . basename($pattern_file, '.php');
        
        // تحقق من وجود الملف وتضمينه
        if (file_exists($pattern_file)) {
            ob_start();
            include $pattern_file;
            $pattern_content = ob_get_clean();
            
            // استخراج بيانات النمط من تعليقات الملف
            $pattern_data = get_file_data($pattern_file, array(
                'title'       => 'Title',
                'slug'        => 'Slug',
                'description' => 'Description',
                'categories'  => 'Categories',
                'keywords'    => 'Keywords',
            ));
            
            if (!empty($pattern_data['title']) && !empty($pattern_content)) {
                register_block_pattern($pattern_slug, array(
                    'title'       => $pattern_data['title'],
                    'description' => $pattern_data['description'] ?: '',
                    'content'     => $pattern_content,
                    'categories'  => $pattern_data['categories'] ? 
                                   explode(',', $pattern_data['categories']) : 
                                   array('practical-solutions'),
                    'keywords'    => $pattern_data['keywords'] ? 
                                   explode(',', $pattern_data['keywords']) : 
                                   array(),
                ));
            }
        }
    }
}
add_action('init', 'practical_solutions_register_block_patterns');

/**
 * تسجيل Custom Post Types
 * 
 * @since 1.0.0
 */
function practical_solutions_register_post_types() {
    // نوع محتوى للحلول
    register_post_type('solution', array(
        'labels' => array(
            'name'          => __('الحلول', 'practical-solutions'),
            'singular_name' => __('حل', 'practical-solutions'),
            'add_new'       => __('إضافة حل جديد', 'practical-solutions'),
            'add_new_item'  => __('إضافة حل جديد', 'practical-solutions'),
            'edit_item'     => __('تحرير الحل', 'practical-solutions'),
            'new_item'      => __('حل جديد', 'practical-solutions'),
            'view_item'     => __('عرض الحل', 'practical-solutions'),
            'search_items'  => __('البحث في الحلول', 'practical-solutions'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'solutions'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-lightbulb',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'template'           => array(
            array('core/paragraph', array(
                'placeholder' => __('اكتب وصف الحل هنا...', 'practical-solutions')
            ))
        ),
    ));

    // نوع محتوى للنصائح السريعة
    register_post_type('tip', array(
        'labels' => array(
            'name'          => __('النصائح', 'practical-solutions'),
            'singular_name' => __('نصيحة', 'practical-solutions'),
            'add_new'       => __('إضافة نصيحة جديدة', 'practical-solutions'),
            'add_new_item'  => __('إضافة نصيحة جديدة', 'practical-solutions'),
            'edit_item'     => __('تحرير النصيحة', 'practical-solutions'),
            'new_item'      => __('نصيحة جديدة', 'practical-solutions'),
            'view_item'     => __('عرض النصيحة', 'practical-solutions'),
            'search_items'  => __('البحث في النصائح', 'practical-solutions'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tips'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
    ));
}
add_action('init', 'practical_solutions_register_post_types');

/**
 * تسجيل Custom Taxonomies
 * 
 * @since 1.0.0
 */
function practical_solutions_register_taxonomies() {
    // تصنيف مجالات الحلول
    register_taxonomy('solution_category', array('solution'), array(
        'labels' => array(
            'name'          => __('مجالات الحلول', 'practical-solutions'),
            'singular_name' => __('مجال', 'practical-solutions'),
            'search_items'  => __('البحث في المجالات', 'practical-solutions'),
            'all_items'     => __('جميع المجالات', 'practical-solutions'),
            'edit_item'     => __('تحرير المجال', 'practical-solutions'),
            'update_item'   => __('تحديث المجال', 'practical-solutions'),
            'add_new_item'  => __('إضافة مجال جديد', 'practical-solutions'),
            'new_item_name' => __('اسم المجال الجديد', 'practical-solutions'),
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'          => true,
        'show_in_rest'     => true,
        'show_admin_column' => true,
        'rewrite'          => array('slug' => 'solution-category'),
    ));

    // تصنيف مستوى الصعوبة
    register_taxonomy('difficulty_level', array('solution', 'tip'), array(
        'labels' => array(
            'name'          => __('مستوى الصعوبة', 'practical-solutions'),
            'singular_name' => __('مستوى', 'practical-solutions'),
            'search_items'  => __('البحث في المستويات', 'practical-solutions'),
            'all_items'     => __('جميع المستويات', 'practical-solutions'),
            'edit_item'     => __('تحرير المستوى', 'practical-solutions'),
            'update_item'   => __('تحديث المستوى', 'practical-solutions'),
            'add_new_item'  => __('إضافة مستوى جديد', 'practical-solutions'),
            'new_item_name' => __('اسم المستوى الجديد', 'practical-solutions'),
        ),
        'public'            => true,
        'hierarchical'      => false,
        'show_ui'          => true,
        'show_in_rest'     => true,
        'show_admin_column' => true,
        'rewrite'          => array('slug' => 'difficulty'),
    ));
}
add_action('init', 'practical_solutions_register_taxonomies');

/**
 * إضافة دعم للكتل المخصصة
 * 
 * @since 1.0.0
 */
function practical_solutions_register_custom_blocks() {
    // مجلد الكتل المخصصة
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
add_action('init', 'practical_solutions_register_custom_blocks');

/**
 * إضافة دعم WebP للصور
 * 
 * @since 1.0.0
 */
function practical_solutions_add_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'practical_solutions_add_webp_support');

/**
 * تحسين عملية البحث
 * 
 * @param WP_Query $query
 * @since 1.0.0
 */
function practical_solutions_extend_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'page', 'solution', 'tip'));
    }
}
add_action('pre_get_posts', 'practical_solutions_extend_search');

/**
 * إضافة فئات أنماط مخصصة للكتل
 * 
 * @since 1.0.0
 */
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
add_action('init', 'practical_solutions_register_block_styles');

/**
 * تخصيص طول المقتطف
 * 
 * @param int $length
 * @return int
 * @since 1.0.0
 */
function practical_solutions_excerpt_length($length) {
    if (is_admin()) {
        return $length;
    }
    return 30;
}
add_filter('excerpt_length', 'practical_solutions_excerpt_length');

/**
 * تخصيص نهاية المقتطف
 * 
 * @param string $more
 * @return string
 * @since 1.0.0
 */
function practical_solutions_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '...';
}
add_filter('excerpt_more', 'practical_solutions_excerpt_more');

/**
 * إضافة معرف فريد لكل صفحة في الـ body class
 * 
 * @param array $classes
 * @return array
 * @since 1.0.0
 */
function practical_solutions_body_classes($classes) {
    // إضافة كلاس اللغة
    $classes[] = 'lang-' . get_locale();
    
    // إضافة كلاس نوع الجهاز (يمكن استخدام JavaScript لتحديده)
    $classes[] = 'device-desktop'; // افتراضي
    
    // إضافة كلاس للصفحة الحالية
    if (is_front_page()) {
        $classes[] = 'is-homepage';
    }
    
    if (is_blog_page()) {
        $classes[] = 'is-blog';
    }
    
    // إضافة كلاس إذا كان البحث الصوتي مدعوم
    $classes[] = 'voice-search-supported';
    
    return $classes;
}
add_filter('body_class', 'practical_solutions_body_classes');

/**
 * تحسين HTML المخرج للقوائم
 * 
 * @param string $nav_menu
 * @return string
 * @since 1.0.0
 */
function practical_solutions_nav_menu_css_class($classes, $item, $args) {
    // إضافة كلاسات إضافية حسب نوع الرابط
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'is-active';
    }
    
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'has-dropdown';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'practical_solutions_nav_menu_css_class', 10, 3);

/**
 * تحديث آخر تعديل للموقع عند إضافة محتوى جديد
 * 
 * @since 1.0.0
 */
function practical_solutions_update_last_modified() {
    update_option('practical_solutions_last_modified', current_time('mysql'));
}
add_action('save_post', 'practical_solutions_update_last_modified');
add_action('comment_post', 'practical_solutions_update_last_modified');

/**
 * إضافة بيانات منظمة (Schema.org) للصفحات
 * 
 * @since 1.0.0
 */
function practical_solutions_add_schema_markup() {
    if (is_singular(array('post', 'solution', 'tip'))) {
        global $post;
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'Article',
            'headline' => get_the_title(),
            'author'   => array(
                '@type' => 'Person',
                'name'  => get_the_author(),
            ),
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'description'   => get_the_excerpt(),
        );
        
        if (has_post_thumbnail()) {
            $schema['image'] = get_the_post_thumbnail_url($post->ID, 'large');
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'practical_solutions_add_schema_markup');

/**
 * تنظيف وتحسين header HTML
 * 
 * @since 1.0.0
 */
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
add_action('init', 'practical_solutions_cleanup_head');

/**
 * إضافة معلومات إضافية لـ wp_head
 * 
 * @since 1.0.0
 */
function practical_solutions_add_head_meta() {
    echo '<meta name="theme-color" content="#007cba">' . "\n";
    echo '<meta name="msapplication-TileColor" content="#007cba">' . "\n";
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">' . "\n";
    
    // إضافة DNS prefetch للموارد الخارجية
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
    
    // إضافة معلومات PWA أساسية
    echo '<link rel="manifest" href="' . PRACTICAL_SOLUTIONS_THEME_URI . '/manifest.json">' . "\n";
}
add_action('wp_head', 'practical_solutions_add_head_meta', 1);

// تحميل ملفات إضافية حسب الحاجة
if (is_admin()) {
    require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/admin-functions.php';
}

if (class_exists('WooCommerce')) {
    require_once PRACTICAL_SOLUTIONS_THEME_DIR . '/inc/woocommerce-support.php';
}