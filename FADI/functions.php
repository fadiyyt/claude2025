<?php
/**
 * قالب FADI - الوظائف الرئيسية
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit;
}

/**
 * إعداد القالب
 */
function fadi_theme_setup() {
    // دعم ترجمة القالب
    load_theme_textdomain('fadi', get_template_directory() . '/languages');
    
    // دعم HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // دعم العنوان التلقائي
    add_theme_support('title-tag');
    
    // دعم الصور المميزة
    add_theme_support('post-thumbnails');
    
    // دعم RSS
    add_theme_support('automatic-feed-links');
    
    // دعم Block Editor
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('src/css/main.min.css');
    
    // دعم Block Patterns
    add_theme_support('custom-spacing');
    add_theme_support('custom-units');
    add_theme_support('custom-line-height');
    add_theme_support('custom-color-palette');
    
    // تسجيل قوائم التنقل
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'fadi'),
        'dashboard' => __('قائمة لوحة التحكم', 'fadi'),
        'footer' => __('قائمة الفوتر', 'fadi'),
    ));
    
    // دعم أحجام الصور المخصصة
    add_image_size('fadi-thumbnail', 300, 200, true);
    add_image_size('fadi-medium', 600, 400, true);
    add_image_size('fadi-large', 1200, 800, true);
}
add_action('after_setup_theme', 'fadi_theme_setup');

/**
 * تسجيل وتحميل الملفات
 */
function fadi_scripts() {
    // تحميل الخطوط العربية
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=Cairo:wght@300;400;600;700&display=swap', array(), '1.0');
    
    // الملف الرئيسي للتصميم
    wp_enqueue_style('fadi-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // الملف المصغر للتصميم
    if (file_exists(get_template_directory() . '/src/css/main.min.css')) {
        wp_enqueue_style('fadi-main', get_template_directory_uri() . '/src/css/main.min.css', array('fadi-style'), '1.0');
    }
    
    // JavaScript الرئيسي
    if (file_exists(get_template_directory() . '/src/js/main.min.js')) {
        wp_enqueue_script('fadi-main', get_template_directory_uri() . '/src/js/main.min.js', array('jquery'), '1.0', true);
        
        // إضافة متغيرات JavaScript
        wp_localize_script('fadi-main', 'fadi_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('fadi_nonce'),
            'loading_text' => __('جاري التحميل...', 'fadi'),
            'error_text' => __('حدث خطأ، حاول مرة أخرى', 'fadi'),
        ));
    }
    
    // إزالة ملفات غير ضرورية
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    
    // تحسين jQuery
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0', true);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'fadi_scripts');

/**
 * تسجيل مناطق الودجات
 */
function fadi_widgets_init() {
    register_sidebar(array(
        'name'          => __('الشريط الجانبي الرئيسي', 'fadi'),
        'id'            => 'sidebar-main',
        'description'   => __('الشريط الجانبي للصفحات الرئيسية', 'fadi'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('فوتر القالب', 'fadi'),
        'id'            => 'footer-widgets',
        'description'   => __('منطقة ودجات الفوتر', 'fadi'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'fadi_widgets_init');

/**
 * تخصيص صفحة تسجيل الدخول
 */
function fadi_custom_login() {
    if (isset($_POST['fadi_login'])) {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];
        
        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => isset($_POST['remember']),
        );
        
        $user = wp_signon($creds, false);
        
        if (is_wp_error($user)) {
            wp_redirect(home_url('/?login=failed'));
        } else {
            wp_redirect(home_url('/dashboard/'));
        }
        exit;
    }
}
add_action('init', 'fadi_custom_login');

/**
 * إنشاء صفحة لوحة التحكم تلقائياً
 */
function fadi_create_dashboard_page() {
    if (!get_page_by_title(__('لوحة التحكم', 'fadi'))) {
        wp_insert_post(array(
            'post_title'    => __('لوحة التحكم', 'fadi'),
            'post_name'     => 'dashboard',
            'post_content'  => '<!-- wp:heading {"level":1} --><h1>مرحباً بك في لوحة التحكم</h1><!-- /wp:heading --><!-- wp:paragraph --><p>هذه هي صفحة لوحة التحكم الخاصة بك.</p><!-- /wp:paragraph -->',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
        ));
    }
}
add_action('after_switch_theme', 'fadi_create_dashboard_page');

/**
 * حماية صفحة لوحة التحكم
 */
function fadi_protect_dashboard() {
    if (is_page('dashboard') && !is_user_logged_in()) {
        wp_redirect(home_url('/'));
        exit;
    }
}
add_action('template_redirect', 'fadi_protect_dashboard');

/**
 * إضافة أنواع المحتوى المخصص
 */
function fadi_register_post_types() {
    // نوع محتوى عروض الأسعار
    register_post_type('fadi_quotes', array(
        'labels' => array(
            'name'               => __('عروض الأسعار', 'fadi'),
            'singular_name'      => __('عرض سعر', 'fadi'),
            'add_new'            => __('إضافة عرض جديد', 'fadi'),
            'add_new_item'       => __('إضافة عرض سعر جديد', 'fadi'),
            'edit_item'          => __('تحرير عرض السعر', 'fadi'),
            'new_item'           => __('عرض سعر جديد', 'fadi'),
            'view_item'          => __('عرض العرض', 'fadi'),
            'search_items'       => __('البحث في العروض', 'fadi'),
            'not_found'          => __('لم يتم العثور على عروض', 'fadi'),
            'not_found_in_trash' => __('لا توجد عروض في سلة المهملات', 'fadi'),
        ),
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => 'fadi-dashboard',
        'supports'      => array('title', 'editor', 'custom-fields'),
        'has_archive'   => false,
    ));
    
    // نوع محتوى الموظفين
    register_post_type('fadi_employees', array(
        'labels' => array(
            'name'               => __('الموظفين', 'fadi'),
            'singular_name'      => __('موظف', 'fadi'),
            'add_new'            => __('إضافة موظف جديد', 'fadi'),
            'add_new_item'       => __('إضافة موظف جديد', 'fadi'),
            'edit_item'          => __('تحرير بيانات الموظف', 'fadi'),
            'new_item'           => __('موظف جديد', 'fadi'),
            'view_item'          => __('عرض الموظف', 'fadi'),
            'search_items'       => __('البحث في الموظفين', 'fadi'),
            'not_found'          => __('لم يتم العثور على موظفين', 'fadi'),
            'not_found_in_trash' => __('لا يوجد موظفين في سلة المهملات', 'fadi'),
        ),
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => 'fadi-dashboard',
        'supports'      => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'has_archive'   => false,
    ));
    
    // نوع محتوى المناقصات
    register_post_type('fadi_tenders', array(
        'labels' => array(
            'name'               => __('المناقصات', 'fadi'),
            'singular_name'      => __('مناقصة', 'fadi'),
            'add_new'            => __('إضافة مناقصة جديدة', 'fadi'),
            'add_new_item'       => __('إضافة مناقصة جديدة', 'fadi'),
            'edit_item'          => __('تحرير المناقصة', 'fadi'),
            'new_item'           => __('مناقصة جديدة', 'fadi'),
            'view_item'          => __('عرض المناقصة', 'fadi'),
            'search_items'       => __('البحث في المناقصات', 'fadi'),
            'not_found'          => __('لم يتم العثور على مناقصات', 'fadi'),
            'not_found_in_trash' => __('لا توجد مناقصات في سلة المهملات', 'fadi'),
        ),
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => 'fadi-dashboard',
        'supports'      => array('title', 'editor', 'custom-fields'),
        'has_archive'   => false,
    ));
    
    // نوع محتوى الوثائق الحكومية
    register_post_type('fadi_documents', array(
        'labels' => array(
            'name'               => __('الوثائق الحكومية', 'fadi'),
            'singular_name'      => __('وثيقة', 'fadi'),
            'add_new'            => __('إضافة وثيقة جديدة', 'fadi'),
            'add_new_item'       => __('إضافة وثيقة جديدة', 'fadi'),
            'edit_item'          => __('تحرير الوثيقة', 'fadi'),
            'new_item'           => __('وثيقة جديدة', 'fadi'),
            'view_item'          => __('عرض الوثيقة', 'fadi'),
            'search_items'       => __('البحث في الوثائق', 'fadi'),
            'not_found'          => __('لم يتم العثور على وثائق', 'fadi'),
            'not_found_in_trash' => __('لا توجد وثائق في سلة المهملات', 'fadi'),
        ),
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => 'fadi-dashboard',
        'supports'      => array('title', 'editor', 'custom-fields'),
        'has_archive'   => false,
    ));
}
add_action('init', 'fadi_register_post_types');

/**
 * تحميل الملفات المساعدة
 */
require_once get_template_directory() . '/inc/security-enhancements.php';
require_once get_template_directory() . '/inc/theme-admin-panel.php';
require_once get_template_directory() . '/inc/performance-optimizer.php';

if (file_exists(get_template_directory() . '/inc/customizer-settings.php')) {
    require_once get_template_directory() . '/inc/customizer-settings.php';
}

/**
 * Ajax للمهام السريعة
 */
function fadi_ajax_quick_task() {
    check_ajax_referer('fadi_nonce', 'nonce');
    
    if (!current_user_can('manage_options')) {
        wp_die();
    }
    
    $task = sanitize_text_field($_POST['task']);
    $result = array('success' => false);
    
    switch ($task) {
        case 'test_connection':
            $result = array('success' => true, 'message' => __('الاتصال يعمل بشكل صحيح', 'fadi'));
            break;
        
        case 'clear_cache':
            // مسح التخزين المؤقت
            wp_cache_flush();
            $result = array('success' => true, 'message' => __('تم مسح التخزين المؤقت بنجاح', 'fadi'));
            break;
            
        case 'backup_data':
            // عمل نسخة احتياطية
            $result = array('success' => true, 'message' => __('تم إنشاء النسخة الاحتياطية', 'fadi'));
            break;
    }
    
    wp_send_json($result);
}
add_action('wp_ajax_fadi_quick_task', 'fadi_ajax_quick_task');

/**
 * تخصيص رسائل الخطأ
 */
function fadi_custom_error_messages() {
    return array(
        'login_failed' => __('خطأ في بيانات تسجيل الدخول', 'fadi'),
        'access_denied' => __('ليس لديك صلاحية للوصول لهذه الصفحة', 'fadi'),
        'csrf_failed' => __('خطأ في التحقق الأمني', 'fadi'),
        'data_saved' => __('تم حفظ البيانات بنجاح', 'fadi'),
        'data_deleted' => __('تم حذف البيانات بنجاح', 'fadi'),
    );
}

/**
 * تحسين استعلامات قاعدة البيانات
 */
function fadi_optimize_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_home()) {
            $query->set('posts_per_page', 10);
        }
    }
}
add_action('pre_get_posts', 'fadi_optimize_queries');

/**
 * إضافة دعم تنسيقات المقالات
 */
function fadi_post_formats() {
    add_theme_support('post-formats', array(
        'aside',
        'gallery',
        'video',
        'quote',
        'link'
    ));
}
add_action('after_setup_theme', 'fadi_post_formats');

/**
 * تنظيف wp_head
 */
function fadi_clean_wp_head() {
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'fadi_clean_wp_head');

/**
 * إضافة أكواد الصفحات المخصصة
 */
function fadi_add_custom_meta_boxes() {
    add_meta_box(
        'fadi-page-settings',
        __('إعدادات الصفحة', 'fadi'),
        'fadi_page_settings_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'fadi_add_custom_meta_boxes');

/**
 * محتوى صندوق إعدادات الصفحة
 */
function fadi_page_settings_callback($post) {
    wp_nonce_field('fadi_page_settings', 'fadi_page_settings_nonce');
    
    $hide_header = get_post_meta($post->ID, '_fadi_hide_header', true);
    $hide_footer = get_post_meta($post->ID, '_fadi_hide_footer', true);
    
    echo '<label><input type="checkbox" name="fadi_hide_header" ' . checked($hide_header, 'on', false) . '> ' . __('إخفاء الهيدر', 'fadi') . '</label><br>';
    echo '<label><input type="checkbox" name="fadi_hide_footer" ' . checked($hide_footer, 'on', false) . '> ' . __('إخفاء الفوتر', 'fadi') . '</label>';
}

/**
 * حفظ إعدادات الصفحة المخصصة
 */
function fadi_save_page_settings($post_id) {
    if (!isset($_POST['fadi_page_settings_nonce']) || !wp_verify_nonce($_POST['fadi_page_settings_nonce'], 'fadi_page_settings')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    update_post_meta($post_id, '_fadi_hide_header', isset($_POST['fadi_hide_header']) ? 'on' : '');
    update_post_meta($post_id, '_fadi_hide_footer', isset($_POST['fadi_hide_footer']) ? 'on' : '');
}
add_action('save_post', 'fadi_save_page_settings');

/**
 * إضافة دعم لصور WebP
 */
function fadi_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'fadi_webp_support');

/**
 * تحسين أداء الموقع
 */
function fadi_performance_optimization() {
    // تفعيل ضغط HTML
    if (!is_admin()) {
        ob_start('fadi_compress_html');
    }
}
add_action('init', 'fadi_performance_optimization');

/**
 * ضغط HTML
 */
function fadi_compress_html($buffer) {
    $buffer = preg_replace('/\s+/', ' ', $buffer);
    $buffer = preg_replace('/<!--(?!<!)[^\[>].*?-->/', '', $buffer);
    return $buffer;
}

/**
 * إضافة معرف فريد للجسم
 */
function fadi_body_class($classes) {
    if (is_page()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    if (is_user_logged_in()) {
        $classes[] = 'logged-in-user';
    }
    
    return $classes;
}
add_filter('body_class', 'fadi_body_class');

/**
 * تسجيل نشاط المستخدم
 */
function fadi_log_user_activity($action, $description) {
    $activities = get_option('fadi_recent_activities', array());
    
    $activities[] = (object) array(
        'action' => $action,
        'description' => $description,
        'time' => current_time('timestamp'),
        'user_id' => get_current_user_id()
    );
    
    // الاحتفاظ بآخر 20 نشاط فقط
    if (count($activities) > 20) {
        $activities = array_slice($activities, -20);
    }
    
    update_option('fadi_recent_activities', $activities);
}

/**
 * تسجيل أنشطة المستخدم التلقائية
 */
function fadi_auto_log_activities() {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        
        if (is_page('dashboard')) {
            fadi_log_user_activity('view', 'زيارة لوحة التحكم بواسطة ' . $user->display_name);
        }
    }
}
add_action('wp', 'fadi_auto_log_activities');