<?php
/**
 * Theme Setup Functions
 * وظائف إعداد القالب الأساسية
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * إعداد القالب الأساسي
 * تشغيل الإعدادات الأساسية للقالب
 * 
 * @since 1.0.0
 */
function practical_solutions_theme_setup() {
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
    
    // دعم HTML5
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
    
    // دعم الألوان والخلفيات المخصصة
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
        'aside', 
        'gallery', 
        'link', 
        'image', 
        'quote', 
        'status', 
        'video', 
        'audio', 
        'chat'
    ));

    // تحديد أحجام الصور المخصصة
    add_image_size('practical-solutions-featured', 800, 450, true);
    add_image_size('practical-solutions-thumbnail', 400, 300, true);
    add_image_size('practical-solutions-medium', 600, 400, true);
    add_image_size('practical-solutions-large', 1200, 800, true);
    add_image_size('practical-solutions-hero', 1920, 1080, true);

    // دعم الترجمة
    load_theme_textdomain('practical-solutions', get_template_directory() . '/languages');

    // إعداد محتوى العرض الافتراضي
    $GLOBALS['content_width'] = 800;
}
add_action('after_setup_theme', 'practical_solutions_theme_setup');

/**
 * تسجيل مناطق القوائم
 * 
 * @since 1.0.0
 */
function practical_solutions_register_nav_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('القائمة الرئيسية', 'practical-solutions'),
        'footer'  => esc_html__('قائمة التذييل', 'practical-solutions'),
        'social'  => esc_html__('قائمة وسائل التواصل', 'practical-solutions'),
        'mobile'  => esc_html__('القائمة المحمولة', 'practical-solutions'),
    ));
}
add_action('init', 'practical_solutions_register_nav_menus');

/**
 * تسجيل مناطق الودجت
 * 
 * @since 1.0.0
 */
function practical_solutions_widgets_init() {
    // الشريط الجانبي الرئيسي
    register_sidebar(array(
        'name'          => esc_html__('الشريط الجانبي الرئيسي', 'practical-solutions'),
        'id'            => 'sidebar-primary',
        'description'   => esc_html__('الشريط الجانبي للمقالات والصفحات', 'practical-solutions'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // مناطق التذييل
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('منطقة التذييل %d', 'practical-solutions'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('العمود رقم %d في تذييل الصفحة', 'practical-solutions'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }

    // منطقة الشريط الجانبي للمتجر (إذا كان WooCommerce مفعل)
    if (class_exists('WooCommerce')) {
        register_sidebar(array(
            'name'          => esc_html__('شريط جانبي للمتجر', 'practical-solutions'),
            'id'            => 'shop-sidebar',
            'description'   => esc_html__('الشريط الجانبي لصفحات المتجر', 'practical-solutions'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'practical_solutions_widgets_init');

/**
 * تسجيل أنواع المحتوى المخصصة
 * 
 * @since 1.0.0
 */
function practical_solutions_register_post_types() {
    // نوع محتوى الحلول
    $solution_labels = array(
        'name'                  => esc_html__('الحلول', 'practical-solutions'),
        'singular_name'         => esc_html__('حل', 'practical-solutions'),
        'menu_name'             => esc_html__('الحلول', 'practical-solutions'),
        'name_admin_bar'        => esc_html__('حل', 'practical-solutions'),
        'archives'              => esc_html__('أرشيف الحلول', 'practical-solutions'),
        'attributes'            => esc_html__('خصائص الحل', 'practical-solutions'),
        'parent_item_colon'     => esc_html__('الحل الرئيسي:', 'practical-solutions'),
        'all_items'             => esc_html__('جميع الحلول', 'practical-solutions'),
        'add_new_item'          => esc_html__('إضافة حل جديد', 'practical-solutions'),
        'add_new'               => esc_html__('إضافة جديد', 'practical-solutions'),
        'new_item'              => esc_html__('حل جديد', 'practical-solutions'),
        'edit_item'             => esc_html__('تحرير الحل', 'practical-solutions'),
        'update_item'           => esc_html__('تحديث الحل', 'practical-solutions'),
        'view_item'             => esc_html__('عرض الحل', 'practical-solutions'),
        'view_items'            => esc_html__('عرض الحلول', 'practical-solutions'),
        'search_items'          => esc_html__('البحث في الحلول', 'practical-solutions'),
        'not_found'             => esc_html__('لم يتم العثور على حلول', 'practical-solutions'),
        'not_found_in_trash'    => esc_html__('لا توجد حلول في المهملات', 'practical-solutions'),
        'featured_image'        => esc_html__('صورة الحل المميزة', 'practical-solutions'),
        'set_featured_image'    => esc_html__('تحديد صورة الحل المميزة', 'practical-solutions'),
        'remove_featured_image' => esc_html__('إزالة صورة الحل المميزة', 'practical-solutions'),
        'use_featured_image'    => esc_html__('استخدام كصورة مميزة', 'practical-solutions'),
        'insert_into_item'      => esc_html__('إدراج في الحل', 'practical-solutions'),
        'uploaded_to_this_item' => esc_html__('مرفوع لهذا الحل', 'practical-solutions'),
        'items_list'            => esc_html__('قائمة الحلول', 'practical-solutions'),
        'items_list_navigation' => esc_html__('التنقل في قائمة الحلول', 'practical-solutions'),
        'filter_items_list'     => esc_html__('فلترة قائمة الحلول', 'practical-solutions'),
    );

    $solution_args = array(
        'label'                 => esc_html__('حل', 'practical-solutions'),
        'description'           => esc_html__('الحلول العملية للمشاكل اليومية', 'practical-solutions'),
        'labels'                => $solution_labels,
        'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes'),
        'taxonomies'            => array('solution_category', 'difficulty_level'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-lightbulb',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'solutions',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'solutions',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'rewrite'               => array(
            'slug'       => 'solution',
            'with_front' => false,
        ),
    );

    register_post_type('solution', $solution_args);

    // نوع محتوى النصائح السريعة
    $tip_labels = array(
        'name'                  => esc_html__('النصائح', 'practical-solutions'),
        'singular_name'         => esc_html__('نصيحة', 'practical-solutions'),
        'menu_name'             => esc_html__('النصائح', 'practical-solutions'),
        'name_admin_bar'        => esc_html__('نصيحة', 'practical-solutions'),
        'archives'              => esc_html__('أرشيف النصائح', 'practical-solutions'),
        'attributes'            => esc_html__('خصائص النصيحة', 'practical-solutions'),
        'parent_item_colon'     => esc_html__('النصيحة الرئيسية:', 'practical-solutions'),
        'all_items'             => esc_html__('جميع النصائح', 'practical-solutions'),
        'add_new_item'          => esc_html__('إضافة نصيحة جديدة', 'practical-solutions'),
        'add_new'               => esc_html__('إضافة جديد', 'practical-solutions'),
        'new_item'              => esc_html__('نصيحة جديدة', 'practical-solutions'),
        'edit_item'             => esc_html__('تحرير النصيحة', 'practical-solutions'),
        'update_item'           => esc_html__('تحديث النصيحة', 'practical-solutions'),
        'view_item'             => esc_html__('عرض النصيحة', 'practical-solutions'),
        'view_items'            => esc_html__('عرض النصائح', 'practical-solutions'),
        'search_items'          => esc_html__('البحث في النصائح', 'practical-solutions'),
        'not_found'             => esc_html__('لم يتم العثور على نصائح', 'practical-solutions'),
        'not_found_in_trash'    => esc_html__('لا توجد نصائح في المهملات', 'practical-solutions'),
        'featured_image'        => esc_html__('صورة النصيحة المميزة', 'practical-solutions'),
        'set_featured_image'    => esc_html__('تحديد صورة النصيحة المميزة', 'practical-solutions'),
        'remove_featured_image' => esc_html__('إزالة صورة النصيحة المميزة', 'practical-solutions'),
        'use_featured_image'    => esc_html__('استخدام كصورة مميزة', 'practical-solutions'),
        'insert_into_item'      => esc_html__('إدراج في النصيحة', 'practical-solutions'),
        'uploaded_to_this_item' => esc_html__('مرفوع لهذه النصيحة', 'practical-solutions'),
        'items_list'            => esc_html__('قائمة النصائح', 'practical-solutions'),
        'items_list_navigation' => esc_html__('التنقل في قائمة النصائح', 'practical-solutions'),
        'filter_items_list'     => esc_html__('فلترة قائمة النصائح', 'practical-solutions'),
    );

    $tip_args = array(
        'label'                 => esc_html__('نصيحة', 'practical-solutions'),
        'description'           => esc_html__('نصائح سريعة ومفيدة للحياة اليومية', 'practical-solutions'),
        'labels'                => $tip_labels,
        'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
        'taxonomies'            => array('tip_category', 'difficulty_level'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-star-filled',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'tips',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'tips',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'rewrite'               => array(
            'slug'       => 'tip',
            'with_front' => false,
        ),
    );

    register_post_type('tip', $tip_args);
}
add_action('init', 'practical_solutions_register_post_types');

/**
 * تسجيل التصنيفات المخصصة
 * 
 * @since 1.0.0
 */
function practical_solutions_register_taxonomies() {
    // تصنيف الحلول
    $solution_category_labels = array(
        'name'                       => esc_html__('تصنيفات الحلول', 'practical-solutions'),
        'singular_name'              => esc_html__('تصنيف حل', 'practical-solutions'),
        'menu_name'                  => esc_html__('تصنيفات الحلول', 'practical-solutions'),
        'all_items'                  => esc_html__('جميع التصنيفات', 'practical-solutions'),
        'parent_item'                => esc_html__('التصنيف الرئيسي', 'practical-solutions'),
        'parent_item_colon'          => esc_html__('التصنيف الرئيسي:', 'practical-solutions'),
        'new_item_name'              => esc_html__('اسم التصنيف الجديد', 'practical-solutions'),
        'add_new_item'               => esc_html__('إضافة تصنيف جديد', 'practical-solutions'),
        'edit_item'                  => esc_html__('تحرير التصنيف', 'practical-solutions'),
        'update_item'                => esc_html__('تحديث التصنيف', 'practical-solutions'),
        'view_item'                  => esc_html__('عرض التصنيف', 'practical-solutions'),
        'separate_items_with_commas' => esc_html__('فصل التصنيفات بفواصل', 'practical-solutions'),
        'add_or_remove_items'        => esc_html__('إضافة أو حذف تصنيفات', 'practical-solutions'),
        'choose_from_most_used'      => esc_html__('اختيار من الأكثر استخداماً', 'practical-solutions'),
        'popular_items'              => esc_html__('التصنيفات الشائعة', 'practical-solutions'),
        'search_items'               => esc_html__('البحث في التصنيفات', 'practical-solutions'),
        'not_found'                  => esc_html__('لم يتم العثور على تصنيفات', 'practical-solutions'),
        'no_terms'                   => esc_html__('لا توجد تصنيفات', 'practical-solutions'),
        'items_list'                 => esc_html__('قائمة التصنيفات', 'practical-solutions'),
        'items_list_navigation'      => esc_html__('التنقل في قائمة التصنيفات', 'practical-solutions'),
    );

    $solution_category_args = array(
        'labels'                => $solution_category_labels,
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        'show_tagcloud'         => true,
        'show_in_rest'          => true,
        'rest_base'             => 'solution-categories',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'rewrite'               => array(
            'slug'         => 'solution-category',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy('solution_category', array('solution'), $solution_category_args);

    // تصنيف النصائح
    $tip_category_labels = array(
        'name'                       => esc_html__('تصنيفات النصائح', 'practical-solutions'),
        'singular_name'              => esc_html__('تصنيف نصيحة', 'practical-solutions'),
        'menu_name'                  => esc_html__('تصنيفات النصائح', 'practical-solutions'),
        'all_items'                  => esc_html__('جميع التصنيفات', 'practical-solutions'),
        'parent_item'                => esc_html__('التصنيف الرئيسي', 'practical-solutions'),
        'parent_item_colon'          => esc_html__('التصنيف الرئيسي:', 'practical-solutions'),
        'new_item_name'              => esc_html__('اسم التصنيف الجديد', 'practical-solutions'),
        'add_new_item'               => esc_html__('إضافة تصنيف جديد', 'practical-solutions'),
        'edit_item'                  => esc_html__('تحرير التصنيف', 'practical-solutions'),
        'update_item'                => esc_html__('تحديث التصنيف', 'practical-solutions'),
        'view_item'                  => esc_html__('عرض التصنيف', 'practical-solutions'),
        'separate_items_with_commas' => esc_html__('فصل التصنيفات بفواصل', 'practical-solutions'),
        'add_or_remove_items'        => esc_html__('إضافة أو حذف تصنيفات', 'practical-solutions'),
        'choose_from_most_used'      => esc_html__('اختيار من الأكثر استخداماً', 'practical-solutions'),
        'popular_items'              => esc_html__('التصنيفات الشائعة', 'practical-solutions'),
        'search_items'               => esc_html__('البحث في التصنيفات', 'practical-solutions'),
        'not_found'                  => esc_html__('لم يتم العثور على تصنيفات', 'practical-solutions'),
        'no_terms'                   => esc_html__('لا توجد تصنيفات', 'practical-solutions'),
        'items_list'                 => esc_html__('قائمة التصنيفات', 'practical-solutions'),
        'items_list_navigation'      => esc_html__('التنقل في قائمة التصنيفات', 'practical-solutions'),
    );

    $tip_category_args = array(
        'labels'                => $tip_category_labels,
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        'show_tagcloud'         => true,
        'show_in_rest'          => true,
        'rest_base'             => 'tip-categories',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'rewrite'               => array(
            'slug'         => 'tip-category',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy('tip_category', array('tip'), $tip_category_args);

    // تصنيف مستوى الصعوبة
    $difficulty_labels = array(
        'name'                       => esc_html__('مستويات الصعوبة', 'practical-solutions'),
        'singular_name'              => esc_html__('مستوى صعوبة', 'practical-solutions'),
        'menu_name'                  => esc_html__('مستويات الصعوبة', 'practical-solutions'),
        'all_items'                  => esc_html__('جميع المستويات', 'practical-solutions'),
        'new_item_name'              => esc_html__('اسم المستوى الجديد', 'practical-solutions'),
        'add_new_item'               => esc_html__('إضافة مستوى جديد', 'practical-solutions'),
        'edit_item'                  => esc_html__('تحرير المستوى', 'practical-solutions'),
        'update_item'                => esc_html__('تحديث المستوى', 'practical-solutions'),
        'view_item'                  => esc_html__('عرض المستوى', 'practical-solutions'),
        'separate_items_with_commas' => esc_html__('فصل المستويات بفواصل', 'practical-solutions'),
        'add_or_remove_items'        => esc_html__('إضافة أو حذف مستويات', 'practical-solutions'),
        'choose_from_most_used'      => esc_html__('اختيار من الأكثر استخداماً', 'practical-solutions'),
        'popular_items'              => esc_html__('المستويات الشائعة', 'practical-solutions'),
        'search_items'               => esc_html__('البحث في المستويات', 'practical-solutions'),
        'not_found'                  => esc_html__('لم يتم العثور على مستويات', 'practical-solutions'),
        'no_terms'                   => esc_html__('لا توجد مستويات', 'practical-solutions'),
        'items_list'                 => esc_html__('قائمة المستويات', 'practical-solutions'),
        'items_list_navigation'      => esc_html__('التنقل في قائمة المستويات', 'practical-solutions'),
    );

    $difficulty_args = array(
        'labels'                => $difficulty_labels,
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        'show_tagcloud'         => true,
        'show_in_rest'          => true,
        'rest_base'             => 'difficulty-levels',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'rewrite'               => array(
            'slug'       => 'difficulty',
            'with_front' => false,
        ),
    );

    register_taxonomy('difficulty_level', array('solution', 'tip'), $difficulty_args);
}
add_action('init', 'practical_solutions_register_taxonomies');

/**
 * إضافة دعم WebP للصور
 * 
 * @param array $mimes الأنواع المسموحة حالياً
 * @return array الأنواع المسموحة مع WebP
 * @since 1.0.0
 */
function practical_solutions_add_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'practical_solutions_add_webp_support');

/**
 * تحسين عملية البحث
 * إضافة أنواع المحتوى المخصصة لنتائج البحث
 * 
 * @param WP_Query $query استعلام ووردبريس
 * @since 1.0.0
 */
function practical_solutions_extend_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'page', 'solution', 'tip'));
    }
}
add_action('pre_get_posts', 'practical_solutions_extend_search');

/**
 * تنظيف head HTML
 * إزالة عناصر غير ضرورية من head
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
    
    // إزالة Emoji scripts إذا لم تكن مطلوبة
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // إزالة عناصر غير ضرورية أخرى
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('init', 'practical_solutions_cleanup_head');
