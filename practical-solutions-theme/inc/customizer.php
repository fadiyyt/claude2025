<?php
/**
 * Customizer Functions
 * وظائف مخصص المظهر
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * إضافة إعدادات مخصص المظهر
 * 
 * @param WP_Customize_Manager $wp_customize مدير المخصص
 * @since 1.0.0
 */
function practical_solutions_customize_register($wp_customize) {
    
    // ==============================
    // قسم الإعدادات العامة
    // ==============================
    $wp_customize->add_section('practical_solutions_general', array(
        'title'       => __('الإعدادات العامة', 'practical-solutions'),
        'description' => __('إعدادات عامة للموقع', 'practical-solutions'),
        'priority'    => 30,
    ));

    // تفعيل البحث الصوتي
    $wp_customize->add_setting('practical_solutions_voice_search', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_voice_search', array(
        'label'       => __('تفعيل البحث الصوتي', 'practical-solutions'),
        'description' => __('السماح للمستخدمين بالبحث باستخدام الصوت', 'practical-solutions'),
        'section'     => 'practical_solutions_general',
        'type'        => 'checkbox',
    ));

    // تفعيل الوضع المظلم
    $wp_customize->add_setting('practical_solutions_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_dark_mode', array(
        'label'       => __('تفعيل الوضع المظلم', 'practical-solutions'),
        'description' => __('تفعيل خيار الوضع المظلم للمستخدمين', 'practical-solutions'),
        'section'     => 'practical_solutions_general',
        'type'        => 'checkbox',
    ));

    // ==============================
    // قسم الصفحة الرئيسية
    // ==============================
    $wp_customize->add_section('practical_solutions_homepage', array(
        'title'       => __('الصفحة الرئيسية', 'practical-solutions'),
        'description' => __('إعدادات الصفحة الرئيسية', 'practical-solutions'),
        'priority'    => 35,
    ));

    // نص الترحيب الرئيسي
    $wp_customize->add_setting('practical_solutions_hero_title', array(
        'default'           => __('حلول عملية لمشاكلك اليومية', 'practical-solutions'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_hero_title', array(
        'label'       => __('العنوان الرئيسي', 'practical-solutions'),
        'description' => __('النص الرئيسي في قسم البطل', 'practical-solutions'),
        'section'     => 'practical_solutions_homepage',
        'type'        => 'text',
    ));

    // نص الوصف
    $wp_customize->add_setting('practical_solutions_hero_description', array(
        'default'           => __('اكتشف نصائح وحلول ذكية لتسهيل حياتك في المنزل والمطبخ وكل مكان', 'practical-solutions'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_hero_description', array(
        'label'       => __('نص الوصف', 'practical-solutions'),
        'description' => __('النص الوصفي في قسم البطل', 'practical-solutions'),
        'section'     => 'practical_solutions_homepage',
        'type'        => 'textarea',
    ));

    // صورة الخلفية
    $wp_customize->add_setting('practical_solutions_hero_background', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'practical_solutions_hero_background', array(
        'label'       => __('صورة الخلفية', 'practical-solutions'),
        'description' => __('صورة خلفية قسم البطل الرئيسي', 'practical-solutions'),
        'section'     => 'practical_solutions_homepage',
    )));

    // ==============================
    // قسم وسائل التواصل الاجتماعي
    // ==============================
    $wp_customize->add_section('practical_solutions_social', array(
        'title'       => __('وسائل التواصل الاجتماعي', 'practical-solutions'),
        'description' => __('روابط وسائل التواصل الاجتماعي', 'practical-solutions'),
        'priority'    => 40,
    ));

    // الشبكات الاجتماعية
    $social_networks = array(
        'facebook'  => __('فيسبوك', 'practical-solutions'),
        'twitter'   => __('تويتر', 'practical-solutions'),
        'instagram' => __('إنستغرام', 'practical-solutions'),
        'youtube'   => __('يوتيوب', 'practical-solutions'),
        'linkedin'  => __('لينكدإن', 'practical-solutions'),
        'telegram'  => __('تليجرام', 'practical-solutions'),
        'whatsapp'  => __('واتساب', 'practical-solutions'),
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("practical_solutions_social_{$network}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));

        $wp_customize->add_control("practical_solutions_social_{$network}", array(
            'label'   => sprintf(__('رابط %s', 'practical-solutions'), $label),
            'section' => 'practical_solutions_social',
            'type'    => 'url',
        ));
    }

    // ==============================
    // قسم التذييل
    // ==============================
    $wp_customize->add_section('practical_solutions_footer', array(
        'title'       => __('التذييل', 'practical-solutions'),
        'description' => __('إعدادات تذييل الموقع', 'practical-solutions'),
        'priority'    => 45,
    ));

    // نص حقوق النشر
    $wp_customize->add_setting('practical_solutions_copyright', array(
        'default'           => sprintf(__('© %s - جميع الحقوق محفوظة', 'practical-solutions'), date('Y')),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_copyright', array(
        'label'       => __('نص حقوق النشر', 'practical-solutions'),
        'description' => __('النص الذي يظهر في أسفل الموقع', 'practical-solutions'),
        'section'     => 'practical_solutions_footer',
        'type'        => 'textarea',
    ));

    // إظهار روابط وسائل التواصل في التذييل
    $wp_customize->add_setting('practical_solutions_footer_social', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_footer_social', array(
        'label'       => __('إظهار وسائل التواصل في التذييل', 'practical-solutions'),
        'description' => __('عرض أيقونات وسائل التواصل الاجتماعي في التذييل', 'practical-solutions'),
        'section'     => 'practical_solutions_footer',
        'type'        => 'checkbox',
    ));

    // ==============================
    // قسم الألوان المخصصة
    // ==============================
    $wp_customize->add_section('practical_solutions_colors', array(
        'title'       => __('الألوان المخصصة', 'practical-solutions'),
        'description' => __('تخصيص ألوان القالب', 'practical-solutions'),
        'priority'    => 50,
    ));

    // اللون الأساسي المخصص
    $wp_customize->add_setting('practical_solutions_primary_color', array(
        'default'           => '#007cba',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'practical_solutions_primary_color', array(
        'label'       => __('اللون الأساسي', 'practical-solutions'),
        'description' => __('اللون الأساسي للموقع', 'practical-solutions'),
        'section'     => 'practical_solutions_colors',
    )));

    // لون التمييز المخصص
    $wp_customize->add_setting('practical_solutions_accent_color', array(
        'default'           => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'practical_solutions_accent_color', array(
        'label'       => __('لون التمييز', 'practical-solutions'),
        'description' => __('لون التمييز للعناصر المهمة', 'practical-solutions'),
        'section'     => 'practical_solutions_colors',
    )));

    // ==============================
    // قسم الأداء
    // ==============================
    $wp_customize->add_section('practical_solutions_performance', array(
        'title'       => __('الأداء', 'practical-solutions'),
        'description' => __('إعدادات تحسين الأداء', 'practical-solutions'),
        'priority'    => 55,
    ));

    // تفعيل التحميل الكسول
    $wp_customize->add_setting('practical_solutions_lazy_loading', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_lazy_loading', array(
        'label'       => __('تفعيل التحميل الكسول', 'practical-solutions'),
        'description' => __('تحميل الصور عند الحاجة لتحسين الأداء', 'practical-solutions'),
        'section'     => 'practical_solutions_performance',
        'type'        => 'checkbox',
    ));

    // ضغط الصور
    $wp_customize->add_setting('practical_solutions_image_compression', array(
        'default'           => 85,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('practical_solutions_image_compression', array(
        'label'       => __('جودة ضغط الصور', 'practical-solutions'),
        'description' => __('جودة ضغط الصور (1-100)', 'practical-solutions'),
        'section'     => 'practical_solutions_performance',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 100,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'practical_solutions_customize_register');

/**
 * إضافة CSS مخصص للمعاينة المباشرة
 * 
 * @since 1.0.0
 */
function practical_solutions_customizer_css() {
    $primary_color = get_theme_mod('practical_solutions_primary_color', '#007cba');
    $accent_color = get_theme_mod('practical_solutions_accent_color', '#e74c3c');
    
    ?>
    <style type="text/css">
        :root {
            --wp--preset--color--primary: <?php echo esc_html($primary_color); ?>;
            --wp--preset--color--accent: <?php echo esc_html($accent_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'practical_solutions_customizer_css');

/**
 * إضافة JavaScript للمعاينة المباشرة
 * 
 * @since 1.0.0
 */
function practical_solutions_customize_preview_js() {
    wp_enqueue_script(
        'practical-solutions-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('customize-preview'),
        PRACTICAL_SOLUTIONS_VERSION,
        true
    );
}
add_action('customize_preview_init', 'practical_solutions_customize_preview_js');

/**
 * وظائف مساعدة للحصول على إعدادات المخصص
 */

/**
 * الحصول على روابط وسائل التواصل الاجتماعي
 * 
 * @return array روابط وسائل التواصل
 * @since 1.0.0
 */
function practical_solutions_get_social_links() {
    $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'telegram', 'whatsapp');
    $social_links = array();
    
    foreach ($social_networks as $network) {
        $link = get_theme_mod("practical_solutions_social_{$network}", '');
        if (!empty($link)) {
            $social_links[$network] = esc_url($link);
        }
    }
    
    return $social_links;
}

/**
 * التحقق من تفعيل البحث الصوتي
 * 
 * @return bool
 * @since 1.0.0
 */
function practical_solutions_is_voice_search_enabled() {
    return get_theme_mod('practical_solutions_voice_search', true);
}

/**
 * التحقق من تفعيل الوضع المظلم
 * 
 * @return bool
 * @since 1.0.0
 */
function practical_solutions_is_dark_mode_enabled() {
    return get_theme_mod('practical_solutions_dark_mode', false);
}