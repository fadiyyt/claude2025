<?php
/**
 * إعدادات القالب الأساسية
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة إعدادات القالب الأساسية
 */
class MuhtawaaThemeSetup {
    
    /**
     * إعداد ميزات القالب
     */
    public static function setup_theme_features() {
        // دعم اللغة العربية
        load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
        
        // دعم ميزات ووردبريس الأساسية
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        
        // دعم HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets'
        ));
        
        // دعم التخصيص التفاعلي
        add_theme_support('customize-selective-refresh-widgets');
        
        // دعم الشعار المخصص
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array('site-title', 'site-description'),
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
        
        // دعم الخلفية المخصصة
        add_theme_support('custom-background', array(
            'default-color' => 'f8f9fa',
            'default-image' => '',
        ));
        
        // دعم الهيدر المخصص
        add_theme_support('custom-header', array(
            'default-text-color' => 'ffffff',
            'width'              => 1200,
            'height'             => 300,
            'flex-height'        => true,
            'flex-width'         => true,
        ));
        
        // دعم محرر المحتوى المحسن
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('dark-editor-style');
        add_theme_support('disable-custom-colors');
        add_theme_support('disable-custom-font-sizes');
        add_theme_support('editor-color-palette', self::get_color_palette());
        add_theme_support('editor-font-sizes', self::get_font_sizes());
        
        // دعم WooCommerce (اختياري)
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        
        // تسجيل القوائم
        register_nav_menus(array(
            'main-menu'   => __('القائمة الرئيسية', 'muhtawaa'),
            'footer-menu' => __('قائمة التذييل', 'muhtawaa'),
            'mobile-menu' => __('قائمة الجوال', 'muhtawaa'),
            'social-menu' => __('قائمة وسائل التواصل', 'muhtawaa'),
            'quick-links' => __('الروابط السريعة', 'muhtawaa'),
        ));
        
        // أحجام الصور المخصصة
        self::add_custom_image_sizes();
        
        // إعداد محرر المحتوى
        add_editor_style('assets/css/editor.css');
        
        // إعداد RSS المحسن
        add_theme_support('automatic-feed-links');
        
        // دعم خرائط الموقع XML
        add_theme_support('automatic-feed-links');
        
        // إعداد Content Width
        if (!isset($content_width)) {
            $content_width = 800;
        }
    }
    
    /**
     * إضافة أحجام الصور المخصصة
     */
    private static function add_custom_image_sizes() {
        // أحجام الحلول
        add_image_size('solution-thumbnail', 400, 300, true);
        add_image_size('solution-medium', 600, 400, true);
        add_image_size('solution-large', 800, 600, true);
        add_image_size('solution-featured', 1200, 600, true);
        add_image_size('solution-hero', 1600, 800, true);
        
        // أحجام الفئات
        add_image_size('category-icon', 150, 150, true);
        add_image_size('category-banner', 800, 300, true);
        
        // أحجام المؤلفين
        add_image_size('author-avatar', 100, 100, true);
        add_image_size('author-profile', 300, 300, true);
        
        // أحجام الشبكة
        add_image_size('grid-small', 300, 200, true);
        add_image_size('grid-medium', 500, 350, true);
        add_image_size('grid-large', 700, 500, true);
        
        // أحجام الجوال
        add_image_size('mobile-thumb', 250, 180, true);
        add_image_size('mobile-featured', 400, 250, true);
    }
    
    /**
     * لوحة ألوان المحرر
     */
    private static function get_color_palette() {
        return array(
            array(
                'name'  => __('الأزرق الأساسي', 'muhtawaa'),
                'slug'  => 'primary-blue',
                'color' => '#667eea',
            ),
            array(
                'name'  => __('البنفسجي الثانوي', 'muhtawaa'),
                'slug'  => 'secondary-purple',
                'color' => '#764ba2',
            ),
            array(
                'name'  => __('الأخضر المميز', 'muhtawaa'),
                'slug'  => 'accent-green',
                'color' => '#48bb78',
            ),
            array(
                'name'  => __('البرتقالي التحذيري', 'muhtawaa'),
                'slug'  => 'warning-orange',
                'color' => '#ed8936',
            ),
            array(
                'name'  => __('الأحمر الخطر', 'muhtawaa'),
                'slug'  => 'danger-red',
                'color' => '#f56565',
            ),
            array(
                'name'  => __('النص الداكن', 'muhtawaa'),
                'slug'  => 'text-dark',
                'color' => '#2d3748',
            ),
            array(
                'name'  => __('النص المتوسط', 'muhtawaa'),
                'slug'  => 'text-medium',
                'color' => '#4a5568',
            ),
            array(
                'name'  => __('النص الفاتح', 'muhtawaa'),
                'slug'  => 'text-light',
                'color' => '#718096',
            ),
            array(
                'name'  => __('الخلفية البيضاء', 'muhtawaa'),
                'slug'  => 'background-white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => __('الخلفية الرمادية الفاتحة', 'muhtawaa'),
                'slug'  => 'background-light-gray',
                'color' => '#f7fafc',
            ),
        );
    }
    
    /**
     * أحجام الخطوط للمحرر
     */
    private static function get_font_sizes() {
        return array(
            array(
                'name' => __('صغير جداً', 'muhtawaa'),
                'size' => 12,
                'slug' => 'extra-small'
            ),
            array(
                'name' => __('صغير', 'muhtawaa'),
                'size' => 14,
                'slug' => 'small'
            ),
            array(
                'name' => __('متوسط', 'muhtawaa'),
                'size' => 16,
                'slug' => 'medium'
            ),
            array(
                'name' => __('كبير', 'muhtawaa'),
                'size' => 18,
                'slug' => 'large'
            ),
            array(
                'name' => __('كبير جداً', 'muhtawaa'),
                'size' => 24,
                'slug' => 'extra-large'
            ),
            array(
                'name' => __('عملاق', 'muhtawaa'),
                'size' => 32,
                'slug' => 'huge'
            ),
        );
    }
    
    /**
     * إضافة أسماء أحجام الصور المخصصة
     */
    public static function custom_image_sizes_names($sizes) {
        return array_merge($sizes, array(
            'solution-thumbnail' => __('مصغر الحل', 'muhtawaa'),
            'solution-medium'    => __('حل متوسط', 'muhtawaa'),
            'solution-large'     => __('حل كبير', 'muhtawaa'),
            'solution-featured'  => __('حل مميز', 'muhtawaa'),
            'solution-hero'      => __('حل رئيسي', 'muhtawaa'),
            'category-icon'      => __('أيقونة الفئة', 'muhtawaa'),
            'category-banner'    => __('بانر الفئة', 'muhtawaa'),
            'author-avatar'      => __('صورة المؤلف الصغيرة', 'muhtawaa'),
            'author-profile'     => __('صورة المؤلف الكبيرة', 'muhtawaa'),
            'grid-small'         => __('شبكة صغيرة', 'muhtawaa'),
            'grid-medium'        => __('شبكة متوسطة', 'muhtawaa'),
            'grid-large'         => __('شبكة كبيرة', 'muhtawaa'),
            'mobile-thumb'       => __('مصغر الجوال', 'muhtawaa'),
            'mobile-featured'    => __('مميز الجوال', 'muhtawaa'),
        ));
    }
}

// إضافة أسماء أحجام الصور المخصصة
add_filter('image_size_names_choose', array('MuhtawaaThemeSetup', 'custom_image_sizes_names'));