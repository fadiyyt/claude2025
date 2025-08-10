<?php
/**
 * Enqueue Scripts and Styles
 * تحميل الملفات والأنماط
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * تحميل الأنماط والسكربتات للواجهة الأمامية
 * 
 * @since 1.0.0
 */
function practical_solutions_enqueue_scripts() {
    // إصدار القالب
    $theme_version = wp_get_theme()->get('Version');
    
    // تحميل الأنماط الرئيسية
    wp_enqueue_style(
        'practical-solutions-style',
        get_stylesheet_uri(),
        array(),
        $theme_version
    );

    // دعم RTL
    wp_style_add_data('practical-solutions-style', 'rtl', 'replace');

    // تحميل الخطوط من Google Fonts
    wp_enqueue_style(
        'practical-solutions-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );

    // تحميل CSS إضافي للمحرر
    if (file_exists(get_template_directory() . '/assets/css/custom.css')) {
        wp_enqueue_style(
            'practical-solutions-custom',
            get_template_directory_uri() . '/assets/css/custom.css',
            array('practical-solutions-style'),
            $theme_version
        );
    }

    // تحميل JavaScript الرئيسي
    if (file_exists(get_template_directory() . '/assets/js/main.min.js')) {
        wp_enqueue_script(
            'practical-solutions-main',
            get_template_directory_uri() . '/assets/js/main.min.js',
            array('jquery'),
            $theme_version,
            true
        );
    } elseif (file_exists(get_template_directory() . '/assets/js/main.js')) {
        wp_enqueue_script(
            'practical-solutions-main',
            get_template_directory_uri() . '/assets/js/main.js',
            array('jquery'),
            $theme_version,
            true
        );
    }

    // تمرير البيانات إلى JavaScript
    if (wp_script_is('practical-solutions-main', 'registered')) {
        wp_localize_script('practical-solutions-main', 'practicalSolutions', array(
            'ajaxUrl'    => admin_url('admin-ajax.php'),
            'nonce'      => wp_create_nonce('practical_solutions_nonce'),
            'homeUrl'    => home_url('/'),
            'themeUrl'   => get_template_directory_uri(),
            'isRTL'      => is_rtl(),
            'language'   => get_locale(),
            'strings'    => array(
                'search_placeholder' => esc_html__('ابحث عن الحلول...', 'practical-solutions'),
                'voice_search_start' => esc_html__('اضغط للبحث الصوتي', 'practical-solutions'),
                'voice_search_stop'  => esc_html__('اضغط لإيقاف التسجيل', 'practical-solutions'),
                'no_results'         => esc_html__('لا توجد نتائج', 'practical-solutions'),
                'loading'           => esc_html__('جاري التحميل...', 'practical-solutions'),
                'error_occurred'    => esc_html__('حدث خطأ، يرجى المحاولة مرة أخرى', 'practical-solutions'),
                'search_minimum'    => esc_html__('أدخل حرفين على الأقل للبحث', 'practical-solutions'),
                'voice_not_supported' => esc_html__('البحث الصوتي غير مدعوم في متصفحك', 'practical-solutions'),
                'permission_denied'  => esc_html__('تم رفض إذن الميكروفون', 'practical-solutions'),
                'network_error'     => esc_html__('خطأ في الشبكة، تحقق من اتصالك', 'practical-solutions'),
                'back_to_top'       => esc_html__('العودة لأعلى', 'practical-solutions'),
                'menu_toggle'       => esc_html__('تبديل القائمة', 'practical-solutions'),
                'close_menu'        => esc_html__('إغلاق القائمة', 'practical-solutions'),
            )
        ));
    }

    // تحميل سكربت التعليقات للصفحات المناسبة
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // إضافة CSS متغيرات مخصصة
    $custom_css = practical_solutions_get_custom_css();
    if (!empty($custom_css)) {
        wp_add_inline_style('practical-solutions-style', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_enqueue_scripts');

/**
 * تحميل أنماط وسكربتات المحرر
 * 
 * @since 1.0.0
 */
function practical_solutions_editor_assets() {
    // تحميل أنماط المحرر
    if (file_exists(get_template_directory() . '/assets/css/editor-style.css')) {
        wp_enqueue_style(
            'practical-solutions-editor',
            get_template_directory_uri() . '/assets/css/editor-style.css',
            array(),
            wp_get_theme()->get('Version')
        );
    }

    // تحميل خطوط للمحرر
    wp_enqueue_style(
        'practical-solutions-editor-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );

    // تحميل سكربت المحرر إذا كان موجوداً
    if (file_exists(get_template_directory() . '/assets/js/editor.js')) {
        wp_enqueue_script(
            'practical-solutions-editor',
            get_template_directory_uri() . '/assets/js/editor.js',
            array('wp-blocks', 'wp-element', 'wp-editor'),
            wp_get_theme()->get('Version'),
            true
        );
    }
}
add_action('enqueue_block_editor_assets', 'practical_solutions_editor_assets');

/**
 * تحميل أنماط لمعاينة المحرر فقط
 * 
 * @since 1.0.0
 */
function practical_solutions_add_editor_styles() {
    // إضافة الأنماط للمحرر الكلاسيكي
    if (file_exists(get_template_directory() . '/assets/css/editor-style.css')) {
        add_editor_style('assets/css/editor-style.css');
    }
    
    // إضافة خطوط للمحرر الكلاسيكي
    add_editor_style('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap');
}
add_action('admin_init', 'practical_solutions_add_editor_styles');

/**
 * تحميل سكربتات لوحة التحكم
 * 
 * @param string $hook_suffix المعرف الحالي للصفحة
 * @since 1.0.0
 */
function practical_solutions_admin_scripts($hook_suffix) {
    // تحميل سكربتات مخصصة لصفحات معينة
    $allowed_pages = array(
        'post.php',
        'post-new.php',
        'edit.php',
        'appearance_page_themes.php',
        'customize.php'
    );

    if (in_array($hook_suffix, $allowed_pages) || strpos($hook_suffix, 'practical-solutions') !== false) {
        // تحميل CSS للوحة التحكم
        if (file_exists(get_template_directory() . '/assets/css/admin.css')) {
            wp_enqueue_style(
                'practical-solutions-admin',
                get_template_directory_uri() . '/assets/css/admin.css',
                array(),
                wp_get_theme()->get('Version')
            );
        }

        // تحميل JavaScript للوحة التحكم
        if (file_exists(get_template_directory() . '/assets/js/admin.js')) {
            wp_enqueue_script(
                'practical-solutions-admin',
                get_template_directory_uri() . '/assets/js/admin.js',
                array('jquery'),
                wp_get_theme()->get('Version'),
                true
            );

            // تمرير بيانات للجافا سكربت في لوحة التحكم
            wp_localize_script('practical-solutions-admin', 'practicalSolutionsAdmin', array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('practical_solutions_admin_nonce'),
                'strings' => array(
                    'confirm_delete' => esc_html__('هل أنت متأكد من الحذف؟', 'practical-solutions'),
                    'save_success'   => esc_html__('تم الحفظ بنجاح', 'practical-solutions'),
                    'save_error'     => esc_html__('حدث خطأ أثناء الحفظ', 'practical-solutions'),
                )
            ));
        }
    }
}
add_action('admin_enqueue_scripts', 'practical_solutions_admin_scripts');

/**
 * تحميل أنماط تسجيل الدخول
 * 
 * @since 1.0.0
 */
function practical_solutions_login_styles() {
    if (file_exists(get_template_directory() . '/assets/css/login.css')) {
        wp_enqueue_style(
            'practical-solutions-login',
            get_template_directory_uri() . '/assets/css/login.css',
            array(),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('login_enqueue_scripts', 'practical_solutions_login_styles');

/**
 * إنشاء CSS مخصص من إعدادات القالب
 * 
 * @return string CSS مخصص
 * @since 1.0.0
 */
function practical_solutions_get_custom_css() {
    $css = '';
    
    // الحصول على الألوان المخصصة من Customizer
    $primary_color = get_theme_mod('practical_solutions_primary_color', '#007cba');
    $secondary_color = get_theme_mod('practical_solutions_secondary_color', '#f0f4f8');
    $accent_color = get_theme_mod('practical_solutions_accent_color', '#e74c3c');
    
    // الحصول على الخطوط المخصصة
    $body_font = get_theme_mod('practical_solutions_body_font', 'Noto Sans Arabic');
    $heading_font = get_theme_mod('practical_solutions_heading_font', 'Noto Sans Arabic');
    
    // إنشاء CSS للألوان
    if ($primary_color !== '#007cba') {
        $css .= "
        :root {
            --wp--preset--color--primary: {$primary_color};
        }
        .has-primary-color {
            color: {$primary_color} !important;
        }
        .has-primary-background-color {
            background-color: {$primary_color} !important;
        }";
    }

    if ($secondary_color !== '#f0f4f8') {
        $css .= "
        :root {
            --wp--preset--color--secondary: {$secondary_color};
        }
        .has-secondary-color {
            color: {$secondary_color} !important;
        }
        .has-secondary-background-color {
            background-color: {$secondary_color} !important;
        }";
    }

    if ($accent_color !== '#e74c3c') {
        $css .= "
        :root {
            --wp--preset--color--accent: {$accent_color};
        }
        .has-accent-color {
            color: {$accent_color} !important;
        }
        .has-accent-background-color {
            background-color: {$accent_color} !important;
        }";
    }

    // إنشاء CSS للخطوط
    if ($body_font !== 'Noto Sans Arabic') {
        $css .= "
        body, .wp-block-paragraph, .wp-block-list {
            font-family: '{$body_font}', sans-serif;
        }";
    }

    if ($heading_font !== 'Noto Sans Arabic') {
        $css .= "
        h1, h2, h3, h4, h5, h6, .wp-block-heading {
            font-family: '{$heading_font}', sans-serif;
        }";
    }

    // إضافة CSS للتخطيط المخصص
    $container_width = get_theme_mod('practical_solutions_container_width', '1200');
    if ($container_width !== '1200') {
        $css .= "
        .wp-block-group.has-global-padding {
            max-width: {$container_width}px;
        }";
    }

    return $css;
}

/**
 * إضافة preload للموارد المهمة
 * 
 * @since 1.0.0
 */
function practical_solutions_resource_hints($urls, $relation_type) {
    if (wp_style_is('practical-solutions-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'practical_solutions_resource_hints', 10, 2);

/**
 * إضافة خصائص إضافية لـ wp_head
 * 
 * @since 1.0.0
 */
function practical_solutions_head_extras() {
    echo '<meta name="theme-color" content="' . esc_attr(get_theme_mod('practical_solutions_primary_color', '#007cba')) . '">' . "\n";
    echo '<meta name="msapplication-TileColor" content="' . esc_attr(get_theme_mod('practical_solutions_primary_color', '#007cba')) . '">' . "\n";
    
    // إضافة DNS prefetch للموارد الخارجية
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
    
    // إضافة معلومات PWA أساسية إذا كان manifest موجود
    if (file_exists(get_template_directory() . '/manifest.json')) {
        echo '<link rel="manifest" href="' . esc_url(get_template_directory_uri() . '/manifest.json') . '">' . "\n";
    }
    
    // إضافة viewport محسن
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">' . "\n";
}
add_action('wp_head', 'practical_solutions_head_extras', 1);

/**
 * تحسين تحميل الموارد
 * إضافة defer و async حسب الحاجة
 * 
 * @param string $tag العلامة الحالية
 * @param string $handle معرف السكربت
 * @param string $src مصدر السكربت
 * @return string العلامة المحسنة
 * @since 1.0.0
 */
function practical_solutions_script_loader_tag($tag, $handle, $src) {
    // قائمة السكربتات التي يجب تأجيلها
    $defer_scripts = array(
        'practical-solutions-main',
        'practical-solutions-admin'
    );

    // قائمة السكربتات التي يجب تحميلها async
    $async_scripts = array(
        'google-analytics',
        'gtag'
    );

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'practical_solutions_script_loader_tag', 10, 3);

/**
 * تحميل أنماط الطباعة
 * 
 * @since 1.0.0
 */
function practical_solutions_print_styles() {
    if (file_exists(get_template_directory() . '/assets/css/print.css')) {
        wp_enqueue_style(
            'practical-solutions-print',
            get_template_directory_uri() . '/assets/css/print.css',
            array(),
            wp_get_theme()->get('Version'),
            'print'
        );
    }
}
add_action('wp_enqueue_scripts', 'practical_solutions_print_styles');
