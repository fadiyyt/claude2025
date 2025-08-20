<?php
/**
 * إعدادات المخصص للقالب
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * إضافة الإعدادات المخصصة للقالب
 */
function fadi_customize_register($wp_customize) {
    
    // قسم الألوان والتصميم
    $wp_customize->add_section('fadi_colors', array(
        'title' => __('ألوان القالب', 'fadi'),
        'priority' => 30,
        'description' => __('تخصيص ألوان القالب الرئيسية', 'fadi'),
    ));
    
    // اللون الأساسي
    $wp_customize->add_setting('fadi_primary_color', array(
        'default' => '#667eea',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fadi_primary_color', array(
        'label' => __('اللون الأساسي', 'fadi'),
        'section' => 'fadi_colors',
        'settings' => 'fadi_primary_color',
    )));
    
    // اللون الثانوي
    $wp_customize->add_setting('fadi_secondary_color', array(
        'default' => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fadi_secondary_color', array(
        'label' => __('اللون الثانوي', 'fadi'),
        'section' => 'fadi_colors',
        'settings' => 'fadi_secondary_color',
    )));
    
    // لون الخلفية
    $wp_customize->add_setting('fadi_background_color', array(
        'default' => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fadi_background_color', array(
        'label' => __('لون الخلفية', 'fadi'),
        'section' => 'fadi_colors',
        'settings' => 'fadi_background_color',
    )));
    
    // قسم الخطوط
    $wp_customize->add_section('fadi_typography', array(
        'title' => __('الخطوط', 'fadi'),
        'priority' => 35,
        'description' => __('تخصيص خطوط القالب', 'fadi'),
    ));
    
    // الخط الأساسي
    $wp_customize->add_setting('fadi_primary_font', array(
        'default' => 'Tajawal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_primary_font', array(
        'label' => __('الخط الأساسي', 'fadi'),
        'section' => 'fadi_typography',
        'type' => 'select',
        'choices' => array(
            'Tajawal' => 'Tajawal',
            'Cairo' => 'Cairo',
            'Amiri' => 'Amiri',
            'Noto Sans Arabic' => 'Noto Sans Arabic',
            'IBM Plex Sans Arabic' => 'IBM Plex Sans Arabic',
        ),
    ));
    
    // حجم الخط
    $wp_customize->add_setting('fadi_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_font_size', array(
        'label' => __('حجم الخط الأساسي (px)', 'fadi'),
        'section' => 'fadi_typography',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 12,
            'max' => 24,
            'step' => 1,
        ),
    ));
    
    // قسم إعدادات لوحة التحكم
    $wp_customize->add_section('fadi_dashboard', array(
        'title' => __('إعدادات لوحة التحكم', 'fadi'),
        'priority' => 40,
        'description' => __('تخصيص واجهة لوحة التحكم', 'fadi'),
    ));
    
    // عرض الإحصائيات
    $wp_customize->add_setting('fadi_show_stats', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_show_stats', array(
        'label' => __('عرض الإحصائيات السريعة', 'fadi'),
        'section' => 'fadi_dashboard',
        'type' => 'checkbox',
    ));
    
    // عدد العناصر في الصفحة
    $wp_customize->add_setting('fadi_items_per_page', array(
        'default' => '10',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_items_per_page', array(
        'label' => __('عدد العناصر في الصفحة', 'fadi'),
        'section' => 'fadi_dashboard',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 5,
            'max' => 50,
            'step' => 5,
        ),
    ));
    
    // قسم الأمان
    $wp_customize->add_section('fadi_security', array(
        'title' => __('إعدادات الأمان', 'fadi'),
        'priority' => 45,
        'description' => __('تخصيص إعدادات الأمان للقالب', 'fadi'),
    ));
    
    // تسجيل الأنشطة
    $wp_customize->add_setting('fadi_log_activities', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_log_activities', array(
        'label' => __('تسجيل الأنشطة', 'fadi'),
        'description' => __('تسجيل أنشطة المستخدمين في النظام', 'fadi'),
        'section' => 'fadi_security',
        'type' => 'checkbox',
    ));
    
    // مهلة انتهاء الجلسة (بالدقائق)
    $wp_customize->add_setting('fadi_session_timeout', array(
        'default' => '60',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_session_timeout', array(
        'label' => __('مهلة انتهاء الجلسة (دقيقة)', 'fadi'),
        'section' => 'fadi_security',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 15,
            'max' => 480,
            'step' => 15,
        ),
    ));
    
    // قسم النسخ الاحتياطي
    $wp_customize->add_section('fadi_backup', array(
        'title' => __('النسخ الاحتياطي', 'fadi'),
        'priority' => 50,
        'description' => __('إعدادات النسخ الاحتياطي التلقائي', 'fadi'),
    ));
    
    // تفعيل النسخ الاحتياطي التلقائي
    $wp_customize->add_setting('fadi_auto_backup', array(
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_auto_backup', array(
        'label' => __('تفعيل النسخ الاحتياطي التلقائي', 'fadi'),
        'section' => 'fadi_backup',
        'type' => 'checkbox',
    ));
    
    // تكرار النسخ الاحتياطي
    $wp_customize->add_setting('fadi_backup_frequency', array(
        'default' => 'weekly',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('fadi_backup_frequency', array(
        'label' => __('تكرار النسخ الاحتياطي', 'fadi'),
        'section' => 'fadi_backup',
        'type' => 'select',
        'choices' => array(
            'daily' => __('يومياً', 'fadi'),
            'weekly' => __('أسبوعياً', 'fadi'),
            'monthly' => __('شهرياً', 'fadi'),
        ),
    ));
}
add_action('customize_register', 'fadi_customize_register');

/**
 * إضافة CSS مخصص بناءً على إعدادات المخصص
 */
function fadi_customizer_css() {
    $primary_color = get_theme_mod('fadi_primary_color', '#667eea');
    $secondary_color = get_theme_mod('fadi_secondary_color', '#6c757d');
    $background_color = get_theme_mod('fadi_background_color', '#f8f9fa');
    $primary_font = get_theme_mod('fadi_primary_font', 'Tajawal');
    $font_size = get_theme_mod('fadi_font_size', '16');
    
    ?>
    <style type="text/css">
        :root {
            --fadi-primary-color: <?php echo esc_attr($primary_color); ?>;
            --fadi-secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --fadi-background-color: <?php echo esc_attr($background_color); ?>;
            --fadi-primary-font: '<?php echo esc_attr($primary_font); ?>', Arial, sans-serif;
            --fadi-font-size: <?php echo esc_attr($font_size); ?>px;
        }
        
        body {
            font-family: var(--fadi-primary-font);
            font-size: var(--fadi-font-size);
            background-color: var(--fadi-background-color);
        }
        
        .btn, .wp-block-button__link,
        .dashboard-card, .btn-login {
            background-color: var(--fadi-primary-color) !important;
        }
        
        .btn-secondary, .btn.btn-secondary {
            background-color: var(--fadi-secondary-color) !important;
        }
        
        .site-header {
            background: linear-gradient(135deg, var(--fadi-primary-color) 0%, var(--fadi-secondary-color) 100%);
        }
        
        .dashboard-card {
            border-right-color: var(--fadi-primary-color);
        }
        
        .card-icon, a {
            color: var(--fadi-primary-color);
        }
        
        .quick-nav-btn .wp-block-button__link {
            background-color: var(--fadi-primary-color) !important;
        }
        
        .quick-nav-btn .wp-block-button__link:hover {
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
    </style>
    <?php
}
add_action('wp_head', 'fadi_customizer_css');

/**
 * إضافة JavaScript للمعاينة المباشرة
 */
function fadi_customizer_preview_js() {
    wp_enqueue_script('fadi-customizer-preview', get_template_directory_uri() . '/src/js/customizer-preview.js', array('customize-preview'), '1.0', true);
}
add_action('customize_preview_init', 'fadi_customizer_preview_js');

/**
 * تطبيق الخط المحدد
 */
function fadi_load_custom_font() {
    $primary_font = get_theme_mod('fadi_primary_font', 'Tajawal');
    
    $google_fonts = array(
        'Tajawal' => 'Tajawal:wght@300;400;500;700',
        'Cairo' => 'Cairo:wght@300;400;500;700',
        'Amiri' => 'Amiri:wght@400;700',
        'Noto Sans Arabic' => 'Noto+Sans+Arabic:wght@300;400;500;700',
        'IBM Plex Sans Arabic' => 'IBM+Plex+Sans+Arabic:wght@300;400;500;700',
    );
    
    if (isset($google_fonts[$primary_font])) {
        wp_enqueue_style('fadi-custom-font', 'https://fonts.googleapis.com/css2?family=' . $google_fonts[$primary_font] . '&display=swap', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'fadi_load_custom_font');

/**
 * حفظ الإعدادات في قاعدة البيانات
 */
function fadi_save_customizer_settings() {
    // تحديث آخر موعد تعديل الإعدادات
    update_option('fadi_last_customizer_update', current_time('Y-m-d H:i:s'));
    
    // مسح ذاكرة التخزين المؤقت عند تغيير الإعدادات
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
    }
}
add_action('customize_save_after', 'fadi_save_customizer_settings');

/**
 * إضافة قسم التحديثات في المخصص
 */
function fadi_add_update_section($wp_customize) {
    $wp_customize->add_section('fadi_updates', array(
        'title' => __('تحديثات القالب', 'fadi'),
        'priority' => 55,
        'description' => __('معلومات عن تحديثات القالب', 'fadi'),
    ));
    
    // إشعار آخر تحديث
    $wp_customize->add_setting('fadi_last_update_info', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fadi_last_update_info', array(
        'label' => __('آخر تحديث', 'fadi'),
        'section' => 'fadi_updates',
        'type' => 'textarea',
        'description' => sprintf(__('آخر تحديث للقالب كان في: %s', 'fadi'), get_option('fadi_last_customizer_update', __('غير محدد', 'fadi'))),
    )));
}
add_action('customize_register', 'fadi_add_update_section', 20);