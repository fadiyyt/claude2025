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
    
    // تسجيل قوائم التنقل
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'fadi'),
        'dashboard' => __('قائمة لوحة التحكم', 'fadi'),
    ));
}
add_action('after_setup_theme', 'fadi_theme_setup');

/**
 * تسجيل وتحميل الملفات
 */
function fadi_scripts() {
    // تحميل الخطوط العربية
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap', array(), '1.0');
    
    // الملف الرئيسي للتصميم
    wp_enqueue_style('fadi-style', get_stylesheet_uri(), array(), '1.0');
    
    // الملف المصغر للتصميم
    if (file_exists(get_template_directory() . '/src/css/main.min.css')) {
        wp_enqueue_style('fadi-main', get_template_directory_uri() . '/src/css/main.min.css', array(), '1.0');
    }
    
    // JavaScript الرئيسي
    if (file_exists(get_template_directory() . '/src/js/main.min.js')) {
        wp_enqueue_script('fadi-main', get_template_directory_uri() . '/src/js/main.min.js', array('jquery'), '1.0', true);
    }
    
    // إضافة متغيرات Ajax
    wp_localize_script('fadi-main', 'fadi_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fadi_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'fadi_scripts');

/**
 * إعداد الأمان
 */
function fadi_security_setup() {
    // إخفاء إصدار ووردبريس
    remove_action('wp_head', 'wp_generator');
    
    // تعطيل XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    // إخفاء معلومات تسجيل الدخول
    add_filter('login_errors', function() {
        return __('خطأ في بيانات تسجيل الدخول', 'fadi');
    });
}
add_action('init', 'fadi_security_setup');

/**
 * نظام تسجيل الدخول المخصص
 */
function fadi_custom_login() {
    if (isset($_POST['fadi_login'])) {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];
        
        if (!wp_verify_nonce($_POST['login_nonce'], 'fadi_login_nonce')) {
            wp_die(__('خطأ في التحقق الأمني', 'fadi'));
        }
        
        $user = wp_authenticate($username, $password);
        
        if (is_wp_error($user)) {
            set_transient('fadi_login_error', $user->get_error_message(), 60);
            wp_redirect(home_url('/'));
            exit;
        }
        
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        wp_redirect(home_url('/dashboard/'));
        exit;
    }
}
add_action('init', 'fadi_custom_login');

/**
 * إنشاء صفحة لوحة التحكم
 */
function fadi_create_dashboard_page() {
    // التحقق من وجود الصفحة
    $dashboard_page = get_page_by_path('dashboard');
    
    if (!$dashboard_page) {
        wp_insert_post(array(
            'post_title' => __('لوحة التحكم', 'fadi'),
            'post_name' => 'dashboard',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
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
    }
    
    wp_send_json($result);
}
add_action('wp_ajax_fadi_quick_task', 'fadi_ajax_quick_task');

/**
 * إضافة لوحة إدارة مخصصة
 */
function fadi_admin_menu() {
    add_menu_page(
        __('إعدادات FADI', 'fadi'),
        __('FADI', 'fadi'),
        'manage_options',
        'fadi-settings',
        'fadi_admin_page',
        'dashicons-admin-tools',
        30
    );
}
add_action('admin_menu', 'fadi_admin_menu');

/**
 * صفحة الإدارة
 */
function fadi_admin_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('إعدادات قالب FADI', 'fadi'); ?></h1>
        <div class="card">
            <h2><?php _e('معلومات القالب', 'fadi'); ?></h2>
            <p><?php _e('قالب FADI مخصص للوحة تحكم شخصية لأتمتة وتنظيم المهام اليومية', 'fadi'); ?></p>
            <p><strong><?php _e('الإصدار:', 'fadi'); ?></strong> 1.0</p>
            <p><strong><?php _e('حالة القالب:', 'fadi'); ?></strong> <?php _e('نشط ويعمل بشكل صحيح', 'fadi'); ?></p>
        </div>
    </div>
    <?php
}

/**
 * تخصيص شريط الإدارة
 */
function fadi_customize_admin_bar($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    $wp_admin_bar->add_node(array(
        'id' => 'fadi-dashboard',
        'title' => __('لوحة التحكم', 'fadi'),
        'href' => home_url('/dashboard/'),
        'meta' => array('class' => 'fadi-admin-link')
    ));
}
add_action('admin_bar_menu', 'fadi_customize_admin_bar', 100);

/**
 * إضافة قوائم مخصصة
 */
function fadi_custom_post_types() {
    // نوع المحتوى: عروض الأسعار
    register_post_type('quote', array(
        'labels' => array(
            'name' => __('عروض الأسعار', 'fadi'),
            'singular_name' => __('عرض سعر', 'fadi'),
            'add_new' => __('إضافة عرض جديد', 'fadi'),
            'add_new_item' => __('إضافة عرض سعر جديد', 'fadi'),
            'edit_item' => __('تعديل عرض السعر', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-settings',
        'supports' => array('title', 'editor', 'custom-fields'),
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
    ));
    
    // نوع المحتوى: الموردين
    register_post_type('supplier', array(
        'labels' => array(
            'name' => __('الموردين', 'fadi'),
            'singular_name' => __('مورد', 'fadi'),
            'add_new' => __('إضافة مورد جديد', 'fadi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'fadi-settings',
        'supports' => array('title', 'editor', 'custom-fields'),
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_options',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'edit_post' => 'manage_options',
            'delete_post' => 'manage_options',
            'read_post' => 'manage_options',
        ),
    ));
}
add_action('init', 'fadi_custom_post_types');

/**
 * تحسين الأداء
 */
function fadi_performance_optimizations() {
    // تعطيل Emoji
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // تنظيف wp_head
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // تعطيل Gutenberg CSS للمزج غير المستخدمة
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'fadi_performance_optimizations', 100);

// تضمين الملفات الإضافية
require_once get_template_directory() . '/inc/theme-admin-panel.php';
require_once get_template_directory() . '/inc/customizer-settings.php';
require_once get_template_directory() . '/inc/performance-optimizer.php';
require_once get_template_directory() . '/inc/security-enhancements.php';