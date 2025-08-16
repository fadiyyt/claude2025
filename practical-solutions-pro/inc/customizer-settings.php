<?php
/**
 * Customizer Settings - Enhanced Version
 * إعدادات التخصيص المحسنة
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Customizer_Settings {
    
    public function __construct() {
        add_action('customize_register', [$this, 'register_customizer_settings']);
        add_action('wp_head', [$this, 'output_custom_css']);
    }
    
    public function register_customizer_settings($wp_customize) {
        
        // =================================================================
        // قسم الألوان والتصميم
        // =================================================================
        $wp_customize->add_section('ps_colors_section', [
            'title' => __('الألوان والتصميم', 'practical-solutions'),
            'description' => __('تخصيص ألوان وتصميم الموقع', 'practical-solutions'),
            'priority' => 30,
        ]);
        
        // اللون الأساسي
        $wp_customize->add_setting('ps_primary_color', [
            'default' => '#2563eb',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_primary_color', [
            'label' => __('اللون الأساسي', 'practical-solutions'),
            'section' => 'ps_colors_section',
            'settings' => 'ps_primary_color',
        ]));
        
        // لون التأكيد
        $wp_customize->add_setting('ps_accent_color', [
            'default' => '#f59e0b',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_accent_color', [
            'label' => __('لون التأكيد', 'practical-solutions'),
            'section' => 'ps_colors_section',
            'settings' => 'ps_accent_color',
        ]));
        
        // لون النص
        $wp_customize->add_setting('ps_text_color', [
            'default' => '#1f2937',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_text_color', [
            'label' => __('لون النص', 'practical-solutions'),
            'section' => 'ps_colors_section',
            'settings' => 'ps_text_color',
        ]));
        
        // =================================================================
        // قسم الخطوط والطباعة
        // =================================================================
        $wp_customize->add_section('ps_typography_section', [
            'title' => __('الخطوط والطباعة', 'practical-solutions'),
            'description' => __('تخصيص خطوط الموقع والنصوص', 'practical-solutions'),
            'priority' => 35,
        ]);
        
        // خط العناوين
        $wp_customize->add_setting('ps_heading_font', [
            'default' => 'Cairo',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_heading_font', [
            'label' => __('خط العناوين', 'practical-solutions'),
            'section' => 'ps_typography_section',
            'type' => 'select',
            'choices' => [
                'Cairo' => 'Cairo',
                'Almarai' => 'Almarai',
                'Amiri' => 'Amiri',
                'Scheherazade' => 'Scheherazade New'
            ]
        ]);
        
        // خط المحتوى
        $wp_customize->add_setting('ps_body_font', [
            'default' => 'Cairo',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_body_font', [
            'label' => __('خط المحتوى', 'practical-solutions'),
            'section' => 'ps_typography_section',
            'type' => 'select',
            'choices' => [
                'Cairo' => 'Cairo',
                'Almarai' => 'Almarai',
                'Amiri' => 'Amiri',
                'Tajawal' => 'Tajawal'
            ]
        ]);
        
        // حجم الخط الأساسي
        $wp_customize->add_setting('ps_font_size', [
            'default' => '16',
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_font_size', [
            'label' => __('حجم الخط الأساسي (px)', 'practical-solutions'),
            'section' => 'ps_typography_section',
            'type' => 'range',
            'input_attrs' => [
                'min' => 14,
                'max' => 20,
                'step' => 1
            ]
        ]);
        
        // =================================================================
        // قسم الهيدر والشعار
        // =================================================================
        $wp_customize->add_section('ps_header_section', [
            'title' => __('الهيدر والشعار', 'practical-solutions'),
            'description' => __('تخصيص رأس الصفحة والشعار', 'practical-solutions'),
            'priority' => 40,
        ]);
        
        // عرض الشعار
        $wp_customize->add_setting('ps_logo_width', [
            'default' => '200',
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_logo_width', [
            'label' => __('عرض الشعار (px)', 'practical-solutions'),
            'section' => 'ps_header_section',
            'type' => 'range',
            'input_attrs' => [
                'min' => 100,
                'max' => 400,
                'step' => 10
            ]
        ]);
        
        // لون خلفية الهيدر
        $wp_customize->add_setting('ps_header_bg_color', [
            'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_header_bg_color', [
            'label' => __('لون خلفية الهيدر', 'practical-solutions'),
            'section' => 'ps_header_section',
            'settings' => 'ps_header_bg_color',
        ]));
        
        // شفافية الهيدر
        $wp_customize->add_setting('ps_header_transparent', [
            'default' => false,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_header_transparent', [
            'label' => __('هيدر شفاف', 'practical-solutions'),
            'section' => 'ps_header_section',
            'type' => 'checkbox'
        ]);
        
        // =================================================================
        // قسم التذييل
        // =================================================================
        $wp_customize->add_section('ps_footer_section', [
            'title' => __('التذييل', 'practical-solutions'),
            'description' => __('تخصيص تذييل الصفحة', 'practical-solutions'),
            'priority' => 45,
        ]);
        
        // نص حقوق الطبع
        $wp_customize->add_setting('ps_copyright_text', [
            'default' => sprintf(__('© %s جميع الحقوق محفوظة', 'practical-solutions'), date('Y')),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_copyright_text', [
            'label' => __('نص حقوق الطبع', 'practical-solutions'),
            'section' => 'ps_footer_section',
            'type' => 'text'
        ]);
        
        // لون خلفية التذييل
        $wp_customize->add_setting('ps_footer_bg_color', [
            'default' => '#1f2937',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ps_footer_bg_color', [
            'label' => __('لون خلفية التذييل', 'practical-solutions'),
            'section' => 'ps_footer_section',
            'settings' => 'ps_footer_bg_color',
        ]));
        
        // =================================================================
        // قسم المحتوى العربي
        // =================================================================
        $wp_customize->add_section('ps_arabic_section', [
            'title' => __('المحتوى العربي', 'practical-solutions'),
            'description' => __('إعدادات خاصة بالمحتوى العربي', 'practical-solutions'),
            'priority' => 50,
        ]);
        
        // تفعيل تحسينات RTL
        $wp_customize->add_setting('ps_enhanced_rtl', [
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport' => 'refresh'
        ]);
        
        $wp_customize->add_control('ps_enhanced_rtl', [
            'label' => __('تفعيل تحسينات RTL المتقدمة', 'practical-solutions'),
            'section' => 'ps_arabic_section',
            'type' => 'checkbox'
        ]);
        
        // تحسين العرض للأرقام العربية
        $wp_customize->add_setting('ps_arabic_numerals', [
            'default' => false,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport' => 'postMessage'
        ]);
        
        $wp_customize->add_control('ps_arabic_numerals', [
            'label' => __('استخدام الأرقام العربية', 'practical-solutions'),
            'section' => 'ps_arabic_section',
            'type' => 'checkbox'
        ]);
        
        // =================================================================
        // قسم الأداء
        // =================================================================
        $wp_customize->add_section('ps_performance_section', [
            'title' => __('الأداء والتحسين', 'practical-solutions'),
            'description' => __('إعدادات تحسين أداء الموقع', 'practical-solutions'),
            'priority' => 55,
        ]);
        
        // تفعيل Lazy Loading
        $wp_customize->add_setting('ps_lazy_loading', [
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport' => 'refresh'
        ]);
        
        $wp_customize->add_control('ps_lazy_loading', [
            'label' => __('تفعيل التحميل البطيء للصور', 'practical-solutions'),
            'section' => 'ps_performance_section',
            'type' => 'checkbox'
        ]);
        
        // ضغط CSS
        $wp_customize->add_setting('ps_minify_css', [
            'default' => false,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport' => 'refresh'
        ]);
        
        $wp_customize->add_control('ps_minify_css', [
            'label' => __('ضغط ملفات CSS', 'practical-solutions'),
            'section' => 'ps_performance_section',
            'type' => 'checkbox'
        ]);
    }
    
    public function output_custom_css() {
        $primary_color = get_theme_mod('ps_primary_color', '#2563eb');
        $accent_color = get_theme_mod('ps_accent_color', '#f59e0b');
        $text_color = get_theme_mod('ps_text_color', '#1f2937');
        $heading_font = get_theme_mod('ps_heading_font', 'Cairo');
        $body_font = get_theme_mod('ps_body_font', 'Cairo');
        $font_size = get_theme_mod('ps_font_size', '16');
        $logo_width = get_theme_mod('ps_logo_width', '200');
        $header_bg_color = get_theme_mod('ps_header_bg_color', '#ffffff');
        $footer_bg_color = get_theme_mod('ps_footer_bg_color', '#1f2937');
        $header_transparent = get_theme_mod('ps_header_transparent', false);
        $arabic_numerals = get_theme_mod('ps_arabic_numerals', false);
        
        ?>
        <style type="text/css" id="ps-customizer-css">
        /* الألوان المخصصة */
        :root {
            --ps-primary-color: <?php echo esc_attr($primary_color); ?>;
            --ps-accent-color: <?php echo esc_attr($accent_color); ?>;
            --ps-text-color: <?php echo esc_attr($text_color); ?>;
            --ps-header-bg: <?php echo esc_attr($header_bg_color); ?>;
            --ps-footer-bg: <?php echo esc_attr($footer_bg_color); ?>;
        }
        
        /* الخطوط المخصصة */
        body {
            font-family: '<?php echo esc_attr($body_font); ?>', sans-serif;
            font-size: <?php echo esc_attr($font_size); ?>px;
            color: var(--ps-text-color);
        }
        
        h1, h2, h3, h4, h5, h6,
        .wp-block-heading {
            font-family: '<?php echo esc_attr($heading_font); ?>', sans-serif;
        }
        
        /* الشعار */
        .custom-logo {
            width: <?php echo esc_attr($logo_width); ?>px;
            height: auto;
        }
        
        /* الهيدر */
        .wp-block-template-part[data-slug="header"] {
            background-color: var(--ps-header-bg);
            <?php if ($header_transparent): ?>
            background-color: transparent;
            backdrop-filter: blur(10px);
            <?php endif; ?>
        }
        
        /* التذييل */
        .wp-block-template-part[data-slug="footer"] {
            background-color: var(--ps-footer-bg);
        }
        
        /* الألوان الأساسية */
        .wp-block-button__link,
        .is-style-ps-primary-button .wp-block-button__link {
            background-color: var(--ps-primary-color);
            border-color: var(--ps-primary-color);
        }
        
        .is-style-ps-outline-button .wp-block-button__link {
            color: var(--ps-primary-color);
            border-color: var(--ps-primary-color);
        }
        
        .has-primary-color {
            color: var(--ps-primary-color);
        }
        
        .has-accent-color {
            color: var(--ps-accent-color);
        }
        
        /* الروابط */
        a {
            color: var(--ps-primary-color);
        }
        
        a:hover {
            color: var(--ps-accent-color);
        }
        
        /* تحسينات RTL */
        [dir="rtl"] .wp-block-navigation ul {
            text-align: right;
        }
        
        [dir="rtl"] .wp-block-columns {
            direction: rtl;
        }
        
        <?php if ($arabic_numerals): ?>
        /* الأرقام العربية */
        .entry-date,
        .comment-metadata,
        .wp-block-post-date {
            font-variant-numeric: arabic-text;
        }
        <?php endif; ?>
        
        /* تحسينات الأداء */
        <?php if (get_theme_mod('ps_lazy_loading', true)): ?>
        img[loading="lazy"] {
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        img[loading="lazy"].loaded {
            opacity: 1;
        }
        <?php endif; ?>
        </style>
        <?php
    }
}

// تشغيل إعدادات التخصيص
new PS_Customizer_Settings();
?>