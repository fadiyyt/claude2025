<?php
/**
 * Customizer Settings
 * إعدادات المخصص
 */

if (!defined('ABSPATH')) {
    exit;
}

class PracticalSolutionsCustomizer {
    
    public function __construct() {
        add_action('customize_register', array($this, 'register_customizer_settings'));
        add_action('wp_head', array($this, 'output_custom_css'));
    }
    
    /**
     * تسجيل إعدادات المخصص
     */
    public function register_customizer_settings($wp_customize) {
        
        // قسم الألوان المخصصة
        $wp_customize->add_section('ps_colors_section', array(
            'title'       => __('ألوان القالب', 'practical-solutions'),
            'description' => __('تخصيص ألوان القالب الأساسية', 'practical-solutions'),
            'priority'    => 30
        ));
        
        // اللون الأساسي
        $wp_customize->add_setting('ps_primary_color', array(
            'default'           => '#007cba',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_primary_color', array(
            'label'       => __('اللون الأساسي', 'practical-solutions'),
            'section'     => 'ps_colors_section',
            'description' => __('اللون الأساسي للأزرار والروابط', 'practical-solutions')
        )));
        
        // اللون الثانوي
        $wp_customize->add_setting('ps_secondary_color', array(
            'default'           => '#f0f4f8',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_secondary_color', array(
            'label'       => __('اللون الثانوي', 'practical-solutions'),
            'section'     => 'ps_colors_section',
            'description' => __('لون الخلفيات الثانوية', 'practical-solutions')
        )));
        
        // لون التمييز
        $wp_customize->add_setting('ps_accent_color', array(
            'default'           => '#e74c3c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_accent_color', array(
            'label'       => __('لون التمييز', 'practical-solutions'),
            'section'     => 'ps_colors_section',
            'description' => __('لون للتنبيهات والعناصر المميزة', 'practical-solutions')
        )));
        
        // قسم الخطوط
        $wp_customize->add_section('ps_typography_section', array(
            'title'       => __('الخطوط والطباعة', 'practical-solutions'),
            'description' => __('تخصيص إعدادات الخطوط', 'practical-solutions'),
            'priority'    => 35
        ));
        
        // حجم الخط الأساسي
        $wp_customize->add_setting('ps_base_font_size', array(
            'default'           => '18',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_base_font_size', array(
            'label'       => __('حجم الخط الأساسي (px)', 'practical-solutions'),
            'section'     => 'ps_typography_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 14,
                'max'  => 24,
                'step' => 1
            )
        ));
        
        // ارتفاع السطر
        $wp_customize->add_setting('ps_line_height', array(
            'default'           => '1.6',
            'sanitize_callback' => array($this, 'sanitize_float'),
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_line_height', array(
            'label'       => __('ارتفاع السطر', 'practical-solutions'),
            'section'     => 'ps_typography_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1.2,
                'max'  => 2.0,
                'step' => 0.1
            )
        ));
        
        // قسم التخطيط
        $wp_customize->add_section('ps_layout_section', array(
            'title'       => __('التخطيط والمساحات', 'practical-solutions'),
            'description' => __('تخصيص عرض المحتوى والمساحات', 'practical-solutions'),
            'priority'    => 40
        ));
        
        // عرض المحتوى
        $wp_customize->add_setting('ps_content_width', array(
            'default'           => '800',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_content_width', array(
            'label'       => __('عرض المحتوى (px)', 'practical-solutions'),
            'section'     => 'ps_layout_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 600,
                'max'  => 1000,
                'step' => 10
            )
        ));
        
        // العرض الواسع
        $wp_customize->add_setting('ps_wide_width', array(
            'default'           => '1200',
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control('ps_wide_width', array(
            'label'       => __('العرض الواسع (px)', 'practical-solutions'),
            'section'     => 'ps_layout_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1000,
                'max'  => 1400,
                'step' => 10
            )
        ));
        
        // قسم الرأس
        $wp_customize->add_section('ps_header_section', array(
            'title'       => __('رأس الموقع', 'practical-solutions'),
            'description' => __('تخصيص إعدادات رأس الموقع', 'practical-solutions'),
            'priority'    => 45
        ));
        
        // إظهار البحث في الرأس
        $wp_customize->add_setting('ps_header_search', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_header_search', array(
            'label'   => __('إظهار البحث في الرأس', 'practical-solutions'),
            'section' => 'ps_header_section',
            'type'    => 'checkbox'
        ));
        
        // لون خلفية الرأس
        $wp_customize->add_setting('ps_header_bg_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_header_bg_color', array(
            'label'   => __('لون خلفية الرأس', 'practical-solutions'),
            'section' => 'ps_header_section'
        )));
        
        // قسم التذييل
        $wp_customize->add_section('ps_footer_section', array(
            'title'       => __('تذييل الموقع', 'practical-solutions'),
            'description' => __('تخصيص إعدادات تذييل الموقع', 'practical-solutions'),
            'priority'    => 50
        ));
        
        // نص حقوق الطبع
        $wp_customize->add_setting('ps_copyright_text', array(
            'default'           => '© 2025 الحلول العملية. جميع الحقوق محفوظة.',
            'sanitize_callback' => 'wp_kses_post'
        ));
        
        $wp_customize->add_control('ps_copyright_text', array(
            'label'   => __('نص حقوق الطبع', 'practical-solutions'),
            'section' => 'ps_footer_section',
            'type'    => 'textarea'
        ));
        
        // إظهار الإحصائيات
        $wp_customize->add_setting('ps_footer_stats', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_footer_stats', array(
            'label'   => __('إظهار إحصائيات الموقع', 'practical-solutions'),
            'section' => 'ps_footer_section',
            'type'    => 'checkbox'
        ));
        
        // قسم الميزات المتقدمة
        $wp_customize->add_section('ps_advanced_section', array(
            'title'       => __('الميزات المتقدمة', 'practical-solutions'),
            'description' => __('إعدادات الميزات المتقدمة للقالب', 'practical-solutions'),
            'priority'    => 55
        ));
        
        // تفعيل الوضع المظلم
        $wp_customize->add_setting('ps_dark_mode_toggle', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_dark_mode_toggle', array(
            'label'       => __('إظهار زر الوضع المظلم', 'practical-solutions'),
            'description' => __('السماح للمستخدمين بالتبديل بين الوضع الفاتح والمظلم', 'practical-solutions'),
            'section'     => 'ps_advanced_section',
            'type'        => 'checkbox'
        ));
        
        // تفعيل البحث الصوتي
        $wp_customize->add_setting('ps_voice_search', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_voice_search', array(
            'label'       => __('تفعيل البحث الصوتي', 'practical-solutions'),
            'description' => __('السماح للمستخدمين بالبحث باستخدام الصوت', 'practical-solutions'),
            'section'     => 'ps_advanced_section',
            'type'        => 'checkbox'
        ));
        
        // تفعيل الرسوم المتحركة
        $wp_customize->add_setting('ps_animations', array(
            'default'           => true,
            'sanitize_callback' => array($this, 'sanitize_checkbox')
        ));
        
        $wp_customize->add_control('ps_animations', array(
            'label'       => __('تفعيل الرسوم المتحركة', 'practical-solutions'),
            'description' => __('إضافة حركات وتأثيرات بصرية للموقع', 'practical-solutions'),
            'section'     => 'ps_advanced_section',
            'type'        => 'checkbox'
        ));
        
        // إضافة JS للمعاينة المباشرة
        $wp_customize->get_setting('ps_primary_color')->transport = 'postMessage';
        $wp_customize->get_setting('ps_secondary_color')->transport = 'postMessage';
        $wp_customize->get_setting('ps_accent_color')->transport = 'postMessage';
        $wp_customize->get_setting('ps_base_font_size')->transport = 'postMessage';
        $wp_customize->get_setting('ps_line_height')->transport = 'postMessage';
    }
    
    /**
     * إخراج CSS مخصص
     */
    public function output_custom_css() {
        $primary_color = get_theme_mod('ps_primary_color', '#007cba');
        $secondary_color = get_theme_mod('ps_secondary_color', '#f0f4f8');
        $accent_color = get_theme_mod('ps_accent_color', '#e74c3c');
        $base_font_size = get_theme_mod('ps_base_font_size', 18);
        $line_height = get_theme_mod('ps_line_height', 1.6);
        $content_width = get_theme_mod('ps_content_width', 800);
        $wide_width = get_theme_mod('ps_wide_width', 1200);
        $header_bg_color = get_theme_mod('ps_header_bg_color', '#ffffff');
        
        ?>
        <style type="text/css" id="ps-customizer-css">
            :root {
                --wp--preset--color--primary: <?php echo esc_html($primary_color); ?>;
                --wp--preset--color--secondary: <?php echo esc_html($secondary_color); ?>;
                --wp--preset--color--accent: <?php echo esc_html($accent_color); ?>;
                --ps-color-primary: <?php echo esc_html($primary_color); ?>;
                --ps-color-secondary: <?php echo esc_html($secondary_color); ?>;
                --ps-color-accent: <?php echo esc_html($accent_color); ?>;
                --ps-font-size-base: <?php echo esc_html($base_font_size); ?>px;
                --ps-line-height-base: <?php echo esc_html($line_height); ?>;
            }
            
            body {
                font-size: var(--ps-font-size-base);
                line-height: var(--ps-line-height-base);
            }
            
            .wp-block-group.alignwide {
                max-width: <?php echo esc_html($wide_width); ?>px;
            }
            
            .wp-block[data-align="wide"] {
                max-width: <?php echo esc_html($wide_width); ?>px;
            }
            
            .ps-site-header {
                background-color: <?php echo esc_html($header_bg_color); ?>;
            }
            
            /* تحديث الألوان في جميع العناصر */
            .wp-block-button.is-style-ps-primary-button .wp-block-button__link,
            .ps-search-btn,
            .ps-theme-toggle {
                background-color: var(--ps-color-primary);
            }
            
            .wp-block-button.is-style-ps-outline-button .wp-block-button__link {
                border-color: var(--ps-color-primary);
                color: var(--ps-color-primary);
            }
            
            .wp-block-group.is-style-ps-feature-box {
                background-color: var(--ps-color-secondary);
            }
            
            .ps-notification.error {
                background-color: var(--ps-color-accent);
            }
        </style>
        <?php
    }
    
    /**
     * تنظيف checkbox
     */
    public function sanitize_checkbox($checked) {
        return ((isset($checked) && true == $checked) ? true : false);
    }
    
    /**
     * تنظيف float
     */
    public function sanitize_float($input) {
        return floatval($input);
    }
}

// تهيئة الكلاس
new PracticalSolutionsCustomizer();

// إضافة JS للمعاينة المباشرة
function ps_customizer_live_preview() {
    wp_enqueue_script(
        'ps-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('jquery', 'customize-preview'),
        PS_THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'ps_customizer_live_preview');