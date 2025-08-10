<?php
/**
 * Theme Customizer
 * إعدادات مخصص القالب
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * إضافة إعدادات المخصص
 * 
 * @param WP_Customize_Manager $wp_customize مدير المخصص
 * @since 1.0.0
 */
function practical_solutions_customize_register($wp_customize) {
    
    // ===========================================
    // قسم الألوان
    // ===========================================
    $wp_customize->add_section('practical_solutions_colors', array(
        'title'       => esc_html__('ألوان القالب', 'practical-solutions'),
        'description' => esc_html__('تخصيص ألوان القالب الأساسية', 'practical-solutions'),
        'priority'    => 40,
    ));

    // اللون الأساسي
    $wp_customize->add_setting('practical_solutions_primary_color', array(
        'default'           => '#007cba',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'practical_solutions_primary_color', array(
        'label'       => esc_html__('اللون الأساسي', 'practical-solutions'),
        'description' => esc_html__('اللون الرئيسي المستخدم في الروابط والأزرار', 'practical-solutions'),
        'section'     => 'practical_solutions_colors',
        'settings'    => 'practical_solutions_primary_color',
    )));

    // اللون الثانوي
    $wp_customize->add_setting('practical_solutions_secondary_color', array(
        'default'           => '#f0f4f8',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'practical_solutions_secondary_color', array(
        'label'       => esc_html__('اللون الثانوي', 'practical-solutions'),
        'description' => esc_html__('لون الخلفيات الثانوية والحدود', 'practical-solutions'),
        'section'     => 'practical_solutions_colors',
        'settings'    => 'practical_solutions_secondary_color',
    )));

    // لون التمييز
    $wp_customize->add_setting('practical_solutions_accent_color', array(
        'default'           => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'practical_solutions_accent_color', array(
        'label'       => esc_html__('لون التمييز', 'practical-solutions'),
        'description' => esc_html__('لون للتنبيهات والعناصر المميزة', 'practical-solutions'),
        'section'     => 'practical_solutions_colors',
        'settings'    => 'practical_solutions_accent_color',
    )));

    // ===========================================
    // قسم الطباعة
    // ===========================================
    $wp_customize->add_section('practical_solutions_typography', array(
        'title'       => esc_html__('الطباعة والخطوط', 'practical-solutions'),
        'description' => esc_html__('تخصيص خطوط وأحجام النصوص', 'practical-solutions'),
        'priority'    => 45,
    ));

    // خط النص الأساسي
    $wp_customize->add_setting('practical_solutions_body_font', array(
        'default'           => 'Noto Sans Arabic',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_body_font', array(
        'type'        => 'select',
        'label'       => esc_html__('خط النص الأساسي', 'practical-solutions'),
        'description' => esc_html__('الخط المستخدم في النصوص العادية', 'practical-solutions'),
        'section'     => 'practical_solutions_typography',
        'choices'     => array(
            'Noto Sans Arabic' => 'Noto Sans Arabic',
            'Cairo'            => 'Cairo',
            'Amiri'            => 'Amiri',
            'Tajawal'          => 'Tajawal',
            'Lato'             => 'Lato',
            'Open Sans'        => 'Open Sans',
            'Roboto'           => 'Roboto',
        ),
    ));

    // خط العناوين
    $wp_customize->add_setting('practical_solutions_heading_font', array(
        'default'           => 'Noto Sans Arabic',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_heading_font', array(
        'type'        => 'select',
        'label'       => esc_html__('خط العناوين', 'practical-solutions'),
        'description' => esc_html__('الخط المستخدم في العناوين', 'practical-solutions'),
        'section'     => 'practical_solutions_typography',
        'choices'     => array(
            'Noto Sans Arabic' => 'Noto Sans Arabic',
            'Cairo'            => 'Cairo',
            'Amiri'            => 'Amiri',
            'Tajawal'          => 'Tajawal',
            'Lato'             => 'Lato',
            'Open Sans'        => 'Open Sans',
            'Roboto'           => 'Roboto',
        ),
    ));

    // حجم الخط الأساسي
    $wp_customize->add_setting('practical_solutions_base_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_base_font_size', array(
        'type'        => 'range',
        'label'       => esc_html__('حجم الخط الأساسي (px)', 'practical-solutions'),
        'description' => esc_html__('حجم الخط الافتراضي للنصوص', 'practical-solutions'),
        'section'     => 'practical_solutions_typography',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ));

    // ===========================================
    // قسم التخطيط
    // ===========================================
    $wp_customize->add_section('practical_solutions_layout', array(
        'title'       => esc_html__('التخطيط والتصميم', 'practical-solutions'),
        'description' => esc_html__('إعدادات تخطيط الصفحة والمحتوى', 'practical-solutions'),
        'priority'    => 50,
    ));

    // عرض الحاوية
    $wp_customize->add_setting('practical_solutions_container_width', array(
        'default'           => '1200',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_container_width', array(
        'type'        => 'range',
        'label'       => esc_html__('عرض الحاوية (px)', 'practical-solutions'),
        'description' => esc_html__('الحد الأقصى لعرض المحتوى', 'practical-solutions'),
        'section'     => 'practical_solutions_layout',
        'input_attrs' => array(
            'min'  => 960,
            'max'  => 1400,
            'step' => 20,
        ),
    ));

    // تفعيل الشريط الجانبي
    $wp_customize->add_setting('practical_solutions_enable_sidebar', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_enable_sidebar', array(
        'type'        => 'checkbox',
        'label'       => esc_html__('تفعيل الشريط الجانبي', 'practical-solutions'),
        'description' => esc_html__('إظهار الشريط الجانبي في صفحات المقالات', 'practical-solutions'),
        'section'     => 'practical_solutions_layout',
    ));

    // نمط التخطيط
    $wp_customize->add_setting('practical_solutions_layout_style', array(
        'default'           => 'boxed',
        'sanitize_callback' => 'practical_solutions_sanitize_layout_style',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_layout_style', array(
        'type'        => 'radio',
        'label'       => esc_html__('نمط التخطيط', 'practical-solutions'),
        'description' => esc_html__('اختيار نمط عرض المحتوى', 'practical-solutions'),
        'section'     => 'practical_solutions_layout',
        'choices'     => array(
            'boxed'     => esc_html__('محدود (Boxed)', 'practical-solutions'),
            'full-width' => esc_html__('العرض الكامل', 'practical-solutions'),
        ),
    ));

    // ===========================================
    // قسم الرأس والتذييل
    // ===========================================
    $wp_customize->add_section('practical_solutions_header_footer', array(
        'title'       => esc_html__('الرأس والتذييل', 'practical-solutions'),
        'description' => esc_html__('إعدادات رأس وتذييل الصفحة', 'practical-solutions'),
        'priority'    => 55,
    ));

    // إظهار مربع البحث في الرأس
    $wp_customize->add_setting('practical_solutions_header_search', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_header_search', array(
        'type'        => 'checkbox',
        'label'       => esc_html__('إظهار مربع البحث في الرأس', 'practical-solutions'),
        'description' => esc_html__('عرض شريط البحث المتقدم في رأس الصفحة', 'practical-solutions'),
        'section'     => 'practical_solutions_header_footer',
    ));

    // تفعيل البحث الصوتي
    $wp_customize->add_setting('practical_solutions_voice_search', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_voice_search', array(
        'type'        => 'checkbox',
        'label'       => esc_html__('تفعيل البحث الصوتي', 'practical-solutions'),
        'description' => esc_html__('إضافة ميزة البحث بالصوت', 'practical-solutions'),
        'section'     => 'practical_solutions_header_footer',
    ));

    // نص حقوق النشر
    $wp_customize->add_setting('practical_solutions_copyright_text', array(
        'default'           => '© 2025 الحلول العملية. جميع الحقوق محفوظة.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('practical_solutions_copyright_text', array(
        'type'        => 'textarea',
        'label'       => esc_html__('نص حقوق النشر', 'practical-solutions'),
        'description' => esc_html__('النص المعروض في تذييل الصفحة', 'practical-solutions'),
        'section'     => 'practical_solutions_header_footer',
    ));

    // ===========================================
    // قسم الشبكات الاجتماعية
    // ===========================================
    $wp_customize->add_section('practical_solutions_social', array(
        'title'       => esc_html__('الشبكات الاجتماعية', 'practical-solutions'),
        'description' => esc_html__('روابط وسائل التواصل الاجتماعي', 'practical-solutions'),
        'priority'    => 60,
    ));

    // روابط وسائل التواصل
    $social_networks = array(
        'facebook'  => esc_html__('فيسبوك', 'practical-solutions'),
        'twitter'   => esc_html__('تويتر', 'practical-solutions'),
        'instagram' => esc_html__('إنستغرام', 'practical-solutions'),
        'youtube'   => esc_html__('يوتيوب', 'practical-solutions'),
        'linkedin'  => esc_html__('لينكد إن', 'practical-solutions'),
        'telegram'  => esc_html__('تيليغرام', 'practical-solutions'),
        'whatsapp'  => esc_html__('واتساب', 'practical-solutions'),
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("practical_solutions_social_{$network}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ));

        $wp_customize->add_control("practical_solutions_social_{$network}", array(
            'type'        => 'url',
            'label'       => $label,
            'description' => sprintf(esc_html__('رابط صفحة %s', 'practical-solutions'), $label),
            'section'     => 'practical_solutions_social',
        ));
    }

    // ===========================================
    // قسم الأداء والتحسين
    // ===========================================
    $wp_customize->add_section('practical_solutions_performance', array(
        'title'       => esc_html__('الأداء والتحسين', 'practical-solutions'),
        'description' => esc_html__('إعدادات تحسين الأداء والسرعة', 'practical-solutions'),
        'priority'    => 65,
    ));

    // تفعيل التحميل الكسول
    $wp_customize->add_setting('practical_solutions_lazy_loading', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_lazy_loading', array(
        'type'        => 'checkbox',
        'label'       => esc_html__('تفعيل التحميل الكسول', 'practical-solutions'),
        'description' => esc_html__('تحميل الصور عند الحاجة لتحسين السرعة', 'practical-solutions'),
        'section'     => 'practical_solutions_performance',
    ));

    // ضغط CSS
    $wp_customize->add_setting('practical_solutions_minify_css', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_minify_css', array(
        'type'        => 'checkbox',
        'label'       => esc_html__('ضغط ملفات CSS', 'practical-solutions'),
        'description' => esc_html__('تقليل حجم ملفات الأنماط', 'practical-solutions'),
        'section'     => 'practical_solutions_performance',
    ));

    // إزالة عناصر غير ضرورية
    $wp_customize->add_setting('practical_solutions_clean_head', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_clean_head', array(
        'type'        => 'checkbox',
        'label'       => esc_html__('تنظيف رأس الصفحة', 'practical-solutions'),
        'description' => esc_html__('إزالة عناصر غير ضرورية من head', 'practical-solutions'),
        'section'     => 'practical_solutions_performance',
    ));
}
add_action('customize_register', 'practical_solutions_customize_register');

/**
 * تنظيف وتحقق نمط التخطيط
 * 
 * @param string $input القيمة المدخلة
 * @return string القيمة المنظفة
 * @since 1.0.0
 */
function practical_solutions_sanitize_layout_style($input) {
    $valid_styles = array('boxed', 'full-width');
    return in_array($input, $valid_styles) ? $input : 'boxed';
}

/**
 * إضافة JavaScript للمعاينة المباشرة
 * 
 * @since 1.0.0
 */
function practical_solutions_customize_preview_js() {
    wp_enqueue_script(
        'practical-solutions-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('customize-preview', 'jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('customize_preview_init', 'practical_solutions_customize_preview_js');

/**
 * إضافة CSS وJS لوحة المخصص
 * 
 * @since 1.0.0
 */
function practical_solutions_customize_controls_scripts() {
    wp_enqueue_style(
        'practical-solutions-customizer-controls',
        get_template_directory_uri() . '/assets/css/customizer-controls.css',
        array(),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'practical-solutions-customizer-controls',
        get_template_directory_uri() . '/assets/js/customizer-controls.js',
        array('customize-controls', 'jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'practical_solutions_customize_controls_scripts');

/**
 * إضافة CSS مخصص للمخصص
 * 
 * @since 1.0.0
 */
function practical_solutions_customizer_css() {
    ?>
    <style type="text/css">
        .customize-control-description {
            font-style: normal;
            font-size: 12px;
            color: #666;
            line-height: 1.4;
            margin-top: 5px;
        }
        
        .customize-section-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        
        .practical-solutions-customizer-info {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin: 10px 0;
        }
        
        .practical-solutions-customizer-info h4 {
            margin: 0 0 10px 0;
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }
        
        .practical-solutions-customizer-info p {
            margin: 0;
            font-size: 12px;
            color: #666;
            line-height: 1.5;
        }
        
        .customize-control-range input[type="range"] {
            width: 100%;
            margin: 10px 0;
        }
        
        .customize-control-range .range-value {
            display: inline-block;
            background: #007cba;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
            margin-right: 10px;
        }
    </style>
    <?php
}
add_action('customize_controls_print_styles', 'practical_solutions_customizer_css');

/**
 * إضافة كلاس مخصص لأقسام المخصص
 * 
 * @param WP_Customize_Manager $wp_customize مدير المخصص
 * @since 1.0.0
 */
function practical_solutions_customize_sections_styling($wp_customize) {
    // إضافة معلومات عن القالب
    $wp_customize->add_section('practical_solutions_info', array(
        'title'       => esc_html__('معلومات القالب', 'practical-solutions'),
        'description' => '<div class="practical-solutions-customizer-info">
                            <h4>' . esc_html__('قالب الحلول العملية', 'practical-solutions') . '</h4>
                            <p>' . esc_html__('قالب ووردبريس عصري يركز على تقديم الحلول العملية للمشاكل اليومية. يدعم تقنية Full Site Editing والبحث الصوتي المتقدم.', 'practical-solutions') . '</p>
                            <p><strong>' . esc_html__('الإصدار:', 'practical-solutions') . '</strong> ' . wp_get_theme()->get('Version') . '</p>
                          </div>',
        'priority'    => 35,
    ));
}
add_action('customize_register', 'practical_solutions_customize_sections_styling', 15);

/**
 * تطبيق الإعدادات المخصصة على الموقع
 * 
 * @since 1.0.0
 */
function practical_solutions_apply_customizer_settings() {
    // تطبيق إعدادات الأداء
    if (get_theme_mod('practical_solutions_clean_head', true)) {
        add_action('init', 'practical_solutions_cleanup_head');
    }
    
    // تطبيق إعدادات التحميل الكسول
    if (get_theme_mod('practical_solutions_lazy_loading', true)) {
        add_filter('wp_get_attachment_image_attributes', 'practical_solutions_add_lazy_loading');
    }
}
add_action('init', 'practical_solutions_apply_customizer_settings');

/**
 * إضافة lazy loading للصور
 * 
 * @param array $attr خصائص الصورة
 * @return array الخصائص المحدثة
 * @since 1.0.0
 */
function practical_solutions_add_lazy_loading($attr) {
    if (!is_admin() && !wp_is_json_request()) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
