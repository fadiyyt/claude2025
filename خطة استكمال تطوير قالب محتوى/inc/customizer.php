<?php
/**
 * إعدادات تخصيص القالب
 * 
 * @package Muhtawaa
 * @since 2.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة إعدادات التخصيص
 */
class MuhtawaaCustomizer {
    
    /**
     * تهيئة إعدادات التخصيص
     */
    public static function init() {
        add_action('customize_register', array(__CLASS__, 'register_customizer_settings'));
        add_action('customize_preview_init', array(__CLASS__, 'customizer_preview_js'));
        add_action('customize_controls_enqueue_scripts', array(__CLASS__, 'customizer_controls_js'));
        add_action('wp_head', array(__CLASS__, 'customizer_css'));
    }
    
    /**
     * تسجيل إعدادات التخصيص
     */
    public static function register_customizer_settings($wp_customize) {
        // إضافة لوحة القالب الرئيسية
        $wp_customize->add_panel('muhtawaa_theme_options', array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'title' => __('إعدادات قالب محتوى', 'muhtawaa'),
            'description' => __('جميع إعدادات وخيارات قالب محتوى', 'muhtawaa'),
        ));
        
        // 1. إعدادات الهوية والشعار
        self::add_identity_settings($wp_customize);
        
        // 2. إعدادات الألوان
        self::add_colors_settings($wp_customize);
        
        // 3. إعدادات الخطوط
        self::add_typography_settings($wp_customize);
        
        // 4. إعدادات التخطيط
        self::add_layout_settings($wp_customize);
        
        // 5. إعدادات الرأس
        self::add_header_settings($wp_customize);
        
        // 6. إعدادات التذييل
        self::add_footer_settings($wp_customize);
        
        // 7. إعدادات المدونة
        self::add_blog_settings($wp_customize);
        
        // 8. إعدادات الحلول
        self::add_solutions_settings($wp_customize);
        
        // 9. إعدادات الأداء
        self::add_performance_settings($wp_customize);
        
        // 10. إعدادات متقدمة
        self::add_advanced_settings($wp_customize);
    }
    
    /**
     * إعدادات الهوية والشعار
     */
    private static function add_identity_settings($wp_customize) {
        // تحسين قسم الهوية الافتراضي
        $wp_customize->get_section('title_tagline')->panel = 'muhtawaa_theme_options';
        $wp_customize->get_section('title_tagline')->priority = 10;
        
        // شعار الموقع للأجهزة المختلفة
        $wp_customize->add_setting('muhtawaa_mobile_logo', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'muhtawaa_mobile_logo', array(
            'label' => __('شعار الجوال', 'muhtawaa'),
            'description' => __('شعار مخصص للأجهزة المحمولة (اختياري)', 'muhtawaa'),
            'section' => 'title_tagline',
            'priority' => 9,
        )));
        
        // Favicon
        $wp_customize->add_setting('muhtawaa_favicon', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'muhtawaa_favicon', array(
            'label' => __('أيقونة الموقع (Favicon)', 'muhtawaa'),
            'description' => __('16x16 أو 32x32 بكسل', 'muhtawaa'),
            'section' => 'title_tagline',
            'priority' => 10,
        )));
    }
    
    /**
     * إعدادات الألوان
     */
    private static function add_colors_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_colors', array(
            'title' => __('الألوان', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 20,
        ));
        
        // الألوان الأساسية
        $colors = array(
            'primary_color' => array(
                'default' => '#667eea',
                'label' => __('اللون الأساسي', 'muhtawaa'),
            ),
            'secondary_color' => array(
                'default' => '#764ba2',
                'label' => __('اللون الثانوي', 'muhtawaa'),
            ),
            'accent_color' => array(
                'default' => '#48bb78',
                'label' => __('لون التمييز', 'muhtawaa'),
            ),
            'text_color' => array(
                'default' => '#2d3748',
                'label' => __('لون النص', 'muhtawaa'),
            ),
            'heading_color' => array(
                'default' => '#1a202c',
                'label' => __('لون العناوين', 'muhtawaa'),
            ),
            'link_color' => array(
                'default' => '#667eea',
                'label' => __('لون الروابط', 'muhtawaa'),
            ),
            'link_hover_color' => array(
                'default' => '#5a67d8',
                'label' => __('لون الروابط عند التمرير', 'muhtawaa'),
            ),
            'bg_color' => array(
                'default' => '#ffffff',
                'label' => __('لون الخلفية', 'muhtawaa'),
            ),
            'header_bg' => array(
                'default' => '#ffffff',
                'label' => __('لون خلفية الرأس', 'muhtawaa'),
            ),
            'footer_bg' => array(
                'default' => '#2d3748',
                'label' => __('لون خلفية التذييل', 'muhtawaa'),
            ),
        );
        
        foreach ($colors as $color => $args) {
            $wp_customize->add_setting('muhtawaa_' . $color, array(
                'default' => $args['default'],
                'sanitize_callback' => 'sanitize_hex_color',
                'transport' => 'postMessage',
            ));
            
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_' . $color, array(
                'label' => $args['label'],
                'section' => 'muhtawaa_colors',
            )));
        }
        
        // تفعيل/تعطيل التدرجات اللونية
        $wp_customize->add_setting('muhtawaa_enable_gradients', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_gradients', array(
            'label' => __('تفعيل التدرجات اللونية', 'muhtawaa'),
            'section' => 'muhtawaa_colors',
            'type' => 'checkbox',
        ));
    }
    
    /**
     * إعدادات الخطوط
     */
    private static function add_typography_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_typography', array(
            'title' => __('الخطوط', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 30,
        ));
        
        // خط الموقع الأساسي
        $wp_customize->add_setting('muhtawaa_font_family', array(
            'default' => 'Cairo',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('muhtawaa_font_family', array(
            'label' => __('الخط الأساسي', 'muhtawaa'),
            'section' => 'muhtawaa_typography',
            'type' => 'select',
            'choices' => array(
                'Cairo' => 'Cairo',
                'Tajawal' => 'Tajawal',
                'Amiri' => 'Amiri',
                'Almarai' => 'Almarai',
                'Changa' => 'Changa',
                'El Messiri' => 'El Messiri',
                'Harmattan' => 'Harmattan',
                'Jomhuria' => 'Jomhuria',
                'Lalezar' => 'Lalezar',
                'Lateef' => 'Lateef',
                'Mada' => 'Mada',
                'Markazi Text' => 'Markazi Text',
                'Mirza' => 'Mirza',
                'Rakkas' => 'Rakkas',
                'Reem Kufi' => 'Reem Kufi',
                'Scheherazade' => 'Scheherazade',
            ),
        ));
        
        // خط العناوين
        $wp_customize->add_setting('muhtawaa_heading_font', array(
            'default' => 'Cairo',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('muhtawaa_heading_font', array(
            'label' => __('خط العناوين', 'muhtawaa'),
            'section' => 'muhtawaa_typography',
            'type' => 'select',
            'choices' => array(
                'Cairo' => 'Cairo',
                'Tajawal' => 'Tajawal',
                'Amiri' => 'Amiri',
                'Almarai' => 'Almarai',
                'El Messiri' => 'El Messiri',
                'Lalezar' => 'Lalezar',
                'Rakkas' => 'Rakkas',
            ),
        ));
        
        // أحجام الخطوط
        $font_sizes = array(
            'font_size' => array(
                'label' => __('حجم الخط الأساسي', 'muhtawaa'),
                'default' => 16,
                'min' => 12,
                'max' => 24,
            ),
            'h1_size' => array(
                'label' => __('حجم H1', 'muhtawaa'),
                'default' => 36,
                'min' => 24,
                'max' => 60,
            ),
            'h2_size' => array(
                'label' => __('حجم H2', 'muhtawaa'),
                'default' => 30,
                'min' => 20,
                'max' => 48,
            ),
            'h3_size' => array(
                'label' => __('حجم H3', 'muhtawaa'),
                'default' => 24,
                'min' => 18,
                'max' => 36,
            ),
        );
        
        foreach ($font_sizes as $size => $args) {
            $wp_customize->add_setting('muhtawaa_' . $size, array(
                'default' => $args['default'],
                'sanitize_callback' => 'absint',
                'transport' => 'postMessage',
            ));
            
            $wp_customize->add_control('muhtawaa_' . $size, array(
                'label' => $args['label'],
                'section' => 'muhtawaa_typography',
                'type' => 'range',
                'input_attrs' => array(
                    'min' => $args['min'],
                    'max' => $args['max'],
                    'step' => 1,
                ),
            ));
        }
        
        // ارتفاع السطر
        $wp_customize->add_setting('muhtawaa_line_height', array(
            'default' => '1.6',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('muhtawaa_line_height', array(
            'label' => __('ارتفاع السطر', 'muhtawaa'),
            'section' => 'muhtawaa_typography',
            'type' => 'select',
            'choices' => array(
                '1.2' => __('مضغوط', 'muhtawaa'),
                '1.4' => __('ضيق', 'muhtawaa'),
                '1.6' => __('عادي', 'muhtawaa'),
                '1.8' => __('مريح', 'muhtawaa'),
                '2.0' => __('واسع', 'muhtawaa'),
            ),
        ));
    }
    
    /**
     * إعدادات التخطيط
     */
    private static function add_layout_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_layout', array(
            'title' => __('التخطيط', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 40,
        ));
        
        // عرض الحاوية
        $wp_customize->add_setting('muhtawaa_container_width', array(
            'default' => '1200',
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('muhtawaa_container_width', array(
            'label' => __('عرض الحاوية (بكسل)', 'muhtawaa'),
            'section' => 'muhtawaa_layout',
            'type' => 'range',
            'input_attrs' => array(
                'min' => 960,
                'max' => 1920,
                'step' => 10,
            ),
        ));
        
        // تخطيط الموقع
        $wp_customize->add_setting('muhtawaa_site_layout', array(
            'default' => 'wide',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_site_layout', array(
            'label' => __('تخطيط الموقع', 'muhtawaa'),
            'section' => 'muhtawaa_layout',
            'type' => 'radio',
            'choices' => array(
                'wide' => __('عريض', 'muhtawaa'),
                'boxed' => __('محاط', 'muhtawaa'),
                'framed' => __('مؤطر', 'muhtawaa'),
            ),
        ));
        
        // موضع الشريط الجانبي
        $wp_customize->add_setting('muhtawaa_sidebar_position', array(
            'default' => 'right',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_sidebar_position', array(
            'label' => __('موضع الشريط الجانبي', 'muhtawaa'),
            'section' => 'muhtawaa_layout',
            'type' => 'radio',
            'choices' => array(
                'right' => __('يمين', 'muhtawaa'),
                'left' => __('يسار', 'muhtawaa'),
                'none' => __('بدون شريط جانبي', 'muhtawaa'),
            ),
        ));
        
        // عرض الشريط الجانبي
        $wp_customize->add_setting('muhtawaa_sidebar_width', array(
            'default' => '30',
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_sidebar_width', array(
            'label' => __('عرض الشريط الجانبي (%)', 'muhtawaa'),
            'section' => 'muhtawaa_layout',
            'type' => 'range',
            'input_attrs' => array(
                'min' => 20,
                'max' => 40,
                'step' => 1,
            ),
        ));
        
        // زوايا مستديرة
        $wp_customize->add_setting('muhtawaa_border_radius', array(
            'default' => '8',
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage',
        ));
        
        $wp_customize->add_control('muhtawaa_border_radius', array(
            'label' => __('استدارة الزوايا (بكسل)', 'muhtawaa'),
            'section' => 'muhtawaa_layout',
            'type' => 'range',
            'input_attrs' => array(
                'min' => 0,
                'max' => 30,
                'step' => 1,
            ),
        ));
    }
    
    /**
     * إعدادات الرأس
     */
    private static function add_header_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_header', array(
            'title' => __('الرأس', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 50,
        ));
        
        // نمط الرأس
        $wp_customize->add_setting('muhtawaa_header_style', array(
            'default' => 'style1',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_header_style', array(
            'label' => __('نمط الرأس', 'muhtawaa'),
            'section' => 'muhtawaa_header',
            'type' => 'radio',
            'choices' => array(
                'style1' => __('النمط الأول - كلاسيكي', 'muhtawaa'),
                'style2' => __('النمط الثاني - عصري', 'muhtawaa'),
                'style3' => __('النمط الثالث - بسيط', 'muhtawaa'),
                'style4' => __('النمط الرابع - مركزي', 'muhtawaa'),
            ),
        ));
        
        // رأس ثابت
        $wp_customize->add_setting('muhtawaa_sticky_header', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_sticky_header', array(
            'label' => __('رأس ثابت عند التمرير', 'muhtawaa'),
            'section' => 'muhtawaa_header',
            'type' => 'checkbox',
        ));
        
        // شريط علوي
        $wp_customize->add_setting('muhtawaa_top_bar', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_top_bar', array(
            'label' => __('إظهار الشريط العلوي', 'muhtawaa'),
            'section' => 'muhtawaa_header',
            'type' => 'checkbox',
        ));
        
        // معلومات الاتصال
        $wp_customize->add_setting('muhtawaa_header_phone', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_header_phone', array(
            'label' => __('رقم الهاتف', 'muhtawaa'),
            'section' => 'muhtawaa_header',
            'type' => 'text',
        ));
        
        $wp_customize->add_setting('muhtawaa_header_email', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_email',
        ));
        
        $wp_customize->add_control('muhtawaa_header_email', array(
            'label' => __('البريد الإلكتروني', 'muhtawaa'),
            'section' => 'muhtawaa_header',
            'type' => 'email',
        ));
        
        // أيقونات التواصل الاجتماعي
        $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'whatsapp');
        
        foreach ($social_networks as $network) {
            $wp_customize->add_setting('muhtawaa_' . $network . '_url', array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            
            $wp_customize->add_control('muhtawaa_' . $network . '_url', array(
                'label' => sprintf(__('رابط %s', 'muhtawaa'), ucfirst($network)),
                'section' => 'muhtawaa_header',
                'type' => 'url',
            ));
        }
    }
    
    /**
     * إعدادات التذييل
     */
    private static function add_footer_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_footer', array(
            'title' => __('التذييل', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 60,
        ));
        
        // نمط التذييل
        $wp_customize->add_setting('muhtawaa_footer_style', array(
            'default' => 'style1',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_style', array(
            'label' => __('نمط التذييل', 'muhtawaa'),
            'section' => 'muhtawaa_footer',
            'type' => 'radio',
            'choices' => array(
                'style1' => __('النمط الأول - 4 أعمدة', 'muhtawaa'),
                'style2' => __('النمط الثاني - 3 أعمدة', 'muhtawaa'),
                'style3' => __('النمط الثالث - مركزي', 'muhtawaa'),
            ),
        ));
        
        // نص حقوق النشر
        $wp_customize->add_setting('muhtawaa_copyright_text', array(
            'default' => sprintf(__('جميع الحقوق محفوظة &copy; %s %s', 'muhtawaa'), date('Y'), get_bloginfo('name')),
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('muhtawaa_copyright_text', array(
            'label' => __('نص حقوق النشر', 'muhtawaa'),
            'section' => 'muhtawaa_footer',
            'type' => 'textarea',
        ));
        
        // شعار التذييل
        $wp_customize->add_setting('muhtawaa_footer_logo', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'muhtawaa_footer_logo', array(
            'label' => __('شعار التذييل', 'muhtawaa'),
            'section' => 'muhtawaa_footer',
        )));
        
        // نص عن الموقع
        $wp_customize->add_setting('muhtawaa_footer_about', array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_about', array(
            'label' => __('نص عن الموقع', 'muhtawaa'),
            'section' => 'muhtawaa_footer',
            'type' => 'textarea',
        ));
        
        // زر العودة للأعلى
        $wp_customize->add_setting('muhtawaa_enable_back_to_top', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_back_to_top', array(
            'label' => __('إظهار زر العودة للأعلى', 'muhtawaa'),
            'section' => 'muhtawaa_footer',
            'type' => 'checkbox',
        ));
    }
    
    /**
     * إعدادات المدونة
     */
    private static function add_blog_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_blog', array(
            'title' => __('المدونة', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 70,
        ));
        
        // تخطيط المدونة
        $wp_customize->add_setting('muhtawaa_blog_layout', array(
            'default' => 'grid',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_blog_layout', array(
            'label' => __('تخطيط المدونة', 'muhtawaa'),
            'section' => 'muhtawaa_blog',
            'type' => 'radio',
            'choices' => array(
                'grid' => __('شبكة', 'muhtawaa'),
                'list' => __('قائمة', 'muhtawaa'),
                'masonry' => __('بناء', 'muhtawaa'),
                'classic' => __('كلاسيكي', 'muhtawaa'),
            ),
        ));
        
        // عدد الأعمدة
        $wp_customize->add_setting('muhtawaa_blog_columns', array(
            'default' => '3',
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_blog_columns', array(
            'label' => __('عدد الأعمدة', 'muhtawaa'),
            'section' => 'muhtawaa_blog',
            'type' => 'select',
            'choices' => array(
                '2' => __('عمودين', 'muhtawaa'),
                '3' => __('3 أعمدة', 'muhtawaa'),
                '4' => __('4 أعمدة', 'muhtawaa'),
            ),
            'active_callback' => function() {
                return get_theme_mod('muhtawaa_blog_layout', 'grid') === 'grid';
            },
        ));
        
        // طول المقتطف
        $wp_customize->add_setting('muhtawaa_excerpt_length', array(
            'default' => 25,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_excerpt_length', array(
            'label' => __('طول المقتطف (كلمة)', 'muhtawaa'),
            'section' => 'muhtawaa_blog',
            'type' => 'number',
            'input_attrs' => array(
                'min' => 10,
                'max' => 100,
                'step' => 5,
            ),
        ));
        
        // إظهار/إخفاء عناصر المقال
        $blog_elements = array(
            'show_author' => __('إظهار الكاتب', 'muhtawaa'),
            'show_date' => __('إظهار التاريخ', 'muhtawaa'),
            'show_categories' => __('إظهار التصنيفات', 'muhtawaa'),
            'show_tags' => __('إظهار الوسوم', 'muhtawaa'),
            'show_comments' => __('إظهار عدد التعليقات', 'muhtawaa'),
            'show_thumbnail' => __('إظهار الصورة المميزة', 'muhtawaa'),
            'show_read_more' => __('إظهار زر اقرأ المزيد', 'muhtawaa'),
        );
        
        foreach ($blog_elements as $element => $label) {
            $wp_customize->add_setting('muhtawaa_' . $element, array(
                'default' => true,
                'sanitize_callback' => 'absint',
            ));
            
            $wp_customize->add_control('muhtawaa_' . $element, array(
                'label' => $label,
                'section' => 'muhtawaa_blog',
                'type' => 'checkbox',
            ));
        }
        
        // نمط التصفح
        $wp_customize->add_setting('muhtawaa_pagination_style', array(
            'default' => 'numbers',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_pagination_style', array(
            'label' => __('نمط التصفح', 'muhtawaa'),
            'section' => 'muhtawaa_blog',
            'type' => 'radio',
            'choices' => array(
                'numbers' => __('أرقام الصفحات', 'muhtawaa'),
                'load_more' => __('تحميل المزيد', 'muhtawaa'),
                'infinite' => __('تحميل لا نهائي', 'muhtawaa'),
                'classic' => __('التالي/السابق', 'muhtawaa'),
            ),
        ));
    }
    
    /**
     * إعدادات الحلول
     */
    private static function add_solutions_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_solutions', array(
            'title' => __('الحلول', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 80,
        ));
        
        // عنوان صفحة الحلول
        $wp_customize->add_setting('muhtawaa_solutions_title', array(
            'default' => __('الحلول اليومية', 'muhtawaa'),
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_solutions_title', array(
            'label' => __('عنوان صفحة الحلول', 'muhtawaa'),
            'section' => 'muhtawaa_solutions',
            'type' => 'text',
        ));
        
        // وصف صفحة الحلول
        $wp_customize->add_setting('muhtawaa_solutions_description', array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('muhtawaa_solutions_description', array(
            'label' => __('وصف صفحة الحلول', 'muhtawaa'),
            'section' => 'muhtawaa_solutions',
            'type' => 'textarea',
        ));
        
        // عدد الحلول في الصفحة
        $wp_customize->add_setting('muhtawaa_solutions_per_page', array(
            'default' => 12,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_solutions_per_page', array(
            'label' => __('عدد الحلول في الصفحة', 'muhtawaa'),
            'section' => 'muhtawaa_solutions',
            'type' => 'number',
            'input_attrs' => array(
                'min' => 6,
                'max' => 30,
                'step' => 3,
            ),
        ));
        
        // تخطيط الحلول
        $wp_customize->add_setting('muhtawaa_solutions_layout', array(
            'default' => 'grid',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_solutions_layout', array(
            'label' => __('تخطيط الحلول', 'muhtawaa'),
            'section' => 'muhtawaa_solutions',
            'type' => 'radio',
            'choices' => array(
                'grid' => __('شبكة', 'muhtawaa'),
                'list' => __('قائمة', 'muhtawaa'),
                'cards' => __('بطاقات', 'muhtawaa'),
            ),
        ));
        
        // تفعيل التصفية
        $wp_customize->add_setting('muhtawaa_enable_solutions_filter', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_solutions_filter', array(
            'label' => __('تفعيل التصفية', 'muhtawaa'),
            'section' => 'muhtawaa_solutions',
            'type' => 'checkbox',
        ));
        
        // تفعيل البحث
        $wp_customize->add_setting('muhtawaa_enable_solutions_search', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_solutions_search', array(
            'label' => __('تفعيل البحث', 'muhtawaa'),
            'section' => 'muhtawaa_solutions',
            'type' => 'checkbox',
        ));
    }
    
    /**
     * إعدادات الأداء
     */
    private static function add_performance_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_performance', array(
            'title' => __('الأداء', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 90,
        ));
        
        // تحميل كسول للصور
        $wp_customize->add_setting('muhtawaa_enable_lazy_loading', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_lazy_loading', array(
            'label' => __('تفعيل التحميل الكسول للصور', 'muhtawaa'),
            'section' => 'muhtawaa_performance',
            'type' => 'checkbox',
        ));
        
        // ضغط HTML
        $wp_customize->add_setting('muhtawaa_minify_html', array(
            'default' => false,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_minify_html', array(
            'label' => __('ضغط HTML', 'muhtawaa'),
            'section' => 'muhtawaa_performance',
            'type' => 'checkbox',
        ));
        
        // دمج CSS
        $wp_customize->add_setting('muhtawaa_combine_css', array(
            'default' => false,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_combine_css', array(
            'label' => __('دمج ملفات CSS', 'muhtawaa'),
            'section' => 'muhtawaa_performance',
            'type' => 'checkbox',
        ));
        
        // دمج JavaScript
        $wp_customize->add_setting('muhtawaa_combine_js', array(
            'default' => false,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_combine_js', array(
            'label' => __('دمج ملفات JavaScript', 'muhtawaa'),
            'section' => 'muhtawaa_performance',
            'type' => 'checkbox',
        ));
        
        // تعطيل الرموز التعبيرية
        $wp_customize->add_setting('muhtawaa_disable_emojis', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_disable_emojis', array(
            'label' => __('تعطيل الرموز التعبيرية', 'muhtawaa'),
            'section' => 'muhtawaa_performance',
            'type' => 'checkbox',
        ));
        
        // تحسين قاعدة البيانات
        $wp_customize->add_setting('muhtawaa_optimize_db', array(
            'default' => true,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_optimize_db', array(
            'label' => __('تحسين قاعدة البيانات تلقائياً', 'muhtawaa'),
            'section' => 'muhtawaa_performance',
            'type' => 'checkbox',
        ));
    }
    
    /**
     * إعدادات متقدمة
     */
    private static function add_advanced_settings($wp_customize) {
        $wp_customize->add_section('muhtawaa_advanced', array(
            'title' => __('إعدادات متقدمة', 'muhtawaa'),
            'panel' => 'muhtawaa_theme_options',
            'priority' => 100,
        ));
        
        // كود CSS مخصص
        $wp_customize->add_setting('muhtawaa_custom_css', array(
            'default' => '',
            'sanitize_callback' => 'wp_strip_all_tags',
        ));
        
        $wp_customize->add_control('muhtawaa_custom_css', array(
            'label' => __('كود CSS مخصص', 'muhtawaa'),
            'section' => 'muhtawaa_advanced',
            'type' => 'textarea',
            'description' => __('أضف كود CSS مخصص هنا', 'muhtawaa'),
        ));
        
        // كود JavaScript مخصص
        $wp_customize->add_setting('muhtawaa_custom_js', array(
            'default' => '',
            'sanitize_callback' => 'wp_strip_all_tags',
        ));
        
        $wp_customize->add_control('muhtawaa_custom_js', array(
            'label' => __('كود JavaScript مخصص', 'muhtawaa'),
            'section' => 'muhtawaa_advanced',
            'type' => 'textarea',
            'description' => __('أضف كود JavaScript مخصص هنا', 'muhtawaa'),
        ));
        
        // كود في الرأس
        $wp_customize->add_setting('muhtawaa_head_code', array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('muhtawaa_head_code', array(
            'label' => __('كود في رأس الصفحة', 'muhtawaa'),
            'section' => 'muhtawaa_advanced',
            'type' => 'textarea',
            'description' => __('سيتم إضافة هذا الكود قبل </head>', 'muhtawaa'),
        ));
        
        // كود في التذييل
        $wp_customize->add_setting('muhtawaa_footer_code', array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_code', array(
            'label' => __('كود في تذييل الصفحة', 'muhtawaa'),
            'section' => 'muhtawaa_advanced',
            'type' => 'textarea',
            'description' => __('سيتم إضافة هذا الكود قبل </body>', 'muhtawaa'),
        ));
        
        // تفعيل وضع الصيانة
        $wp_customize->add_setting('muhtawaa_maintenance_mode', array(
            'default' => false,
            'sanitize_callback' => 'absint',
        ));
        
        $wp_customize->add_control('muhtawaa_maintenance_mode', array(
            'label' => __('تفعيل وضع الصيانة', 'muhtawaa'),
            'section' => 'muhtawaa_advanced',
            'type' => 'checkbox',
            'description' => __('سيتمكن المدراء فقط من رؤية الموقع', 'muhtawaa'),
        ));
        
        // رسالة الصيانة
        $wp_customize->add_setting('muhtawaa_maintenance_message', array(
            'default' => __('الموقع تحت الصيانة، سنعود قريباً!', 'muhtawaa'),
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('muhtawaa_maintenance_message', array(
            'label' => __('رسالة الصيانة', 'muhtawaa'),
            'section' => 'muhtawaa_advanced',
            'type' => 'textarea',
            'active_callback' => function() {
                return get_theme_mod('muhtawaa_maintenance_mode', false);
            },
        ));
    }
    
    /**
     * JavaScript للمعاينة المباشرة
     */
    public static function customizer_preview_js() {
        wp_enqueue_script(
            'muhtawaa-customizer-preview',
            THEME_ASSETS_URL . '/js/customizer-preview.js',
            array('customize-preview', 'jquery'),
            THEME_VERSION,
            true
        );
    }
    
    /**
     * JavaScript لواجهة التحكم
     */
    public static function customizer_controls_js() {
        wp_enqueue_script(
            'muhtawaa-customizer-controls',
            THEME_ASSETS_URL . '/js/customizer-controls.js',
            array('customize-controls', 'jquery'),
            THEME_VERSION,
            true
        );
        
        wp_localize_script('muhtawaa-customizer-controls', 'muhtawaaCustomizer', array(
            'confirmReset' => __('هل أنت متأكد من إعادة تعيين جميع الإعدادات؟', 'muhtawaa'),
            'resetSuccess' => __('تم إعادة تعيين الإعدادات بنجاح', 'muhtawaa'),
        ));
    }
    
    /**
     * إضافة CSS المخصص
     */
    public static function customizer_css() {
        $custom_css = get_theme_mod('muhtawaa_custom_css', '');
        
        if (!empty($custom_css)) {
            echo '<style type="text/css" id="muhtawaa-custom-css">' . wp_strip_all_tags($custom_css) . '</style>';
        }
        
        // إضافة الكود في الرأس
        $head_code = get_theme_mod('muhtawaa_head_code', '');
        if (!empty($head_code)) {
            echo $head_code;
        }
    }
    
    /**
     * تصدير/استيراد الإعدادات
     */
    public static function export_settings() {
        $theme_mods = get_theme_mods();
        $export_data = array(
            'theme' => get_option('stylesheet'),
            'mods' => $theme_mods,
            'options' => array(),
        );
        
        return base64_encode(serialize($export_data));
    }
    
    public static function import_settings($import_data) {
        try {
            $data = unserialize(base64_decode($import_data));
            
            if (!is_array($data) || !isset($data['mods'])) {
                return false;
            }
            
            // استيراد theme mods
            foreach ($data['mods'] as $key => $value) {
                set_theme_mod($key, $value);
            }
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

// تهيئة الفئة
MuhtawaaCustomizer::init();