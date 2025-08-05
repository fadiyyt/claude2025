<?php
/**
 * تحميل ملفات CSS و JavaScript
 * 
 * @package Muhtawaa
 * @since 2.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تحميل ملفات CSS
 */
function muhtawaa_enqueue_styles() {
    // الملف الأساسي لـ WordPress
    wp_enqueue_style(
        'muhtawaa-style',
        get_stylesheet_uri(),
        array(),
        THEME_VERSION
    );
    
    // Google Fonts
    wp_enqueue_style(
        'google-fonts-cairo',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );
    
    wp_enqueue_style(
        'google-fonts-amiri',
        'https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap',
        array(),
        null
    );
    
    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // ملف CSS الرئيسي
    wp_enqueue_style(
        'muhtawaa-main',
        THEME_ASSETS_URL . '/css/main.css',
        array('muhtawaa-style'),
        THEME_VERSION
    );
    
    // ملف CSS المكونات (إذا كان موجودًا)
    if (file_exists(THEME_PATH . '/assets/css/components.css')) {
        wp_enqueue_style(
            'muhtawaa-components',
            THEME_ASSETS_URL . '/css/components.css',
            array('muhtawaa-main'),
            THEME_VERSION
        );
    }
    
    // ملف CSS التجاوب
    wp_enqueue_style(
        'muhtawaa-responsive',
        THEME_ASSETS_URL . '/css/responsive.css',
        array('muhtawaa-main'),
        THEME_VERSION,
        'screen'
    );
    
    // ملف CSS للحركات (إذا كان موجودًا)
    if (file_exists(THEME_PATH . '/assets/css/animations.css')) {
        wp_enqueue_style(
            'muhtawaa-animations',
            THEME_ASSETS_URL . '/css/animations.css',
            array('muhtawaa-main'),
            THEME_VERSION
        );
    }
    
    // ملف CSS المخصص (إذا كان موجودًا)
    if (file_exists(THEME_PATH . '/assets/css/custom.css')) {
        wp_enqueue_style(
            'muhtawaa-custom',
            THEME_ASSETS_URL . '/css/custom.css',
            array('muhtawaa-main', 'muhtawaa-responsive'),
            THEME_VERSION
        );
    }
    
    // CSS للطباعة
    if (file_exists(THEME_PATH . '/assets/css/print.css')) {
        wp_enqueue_style(
            'muhtawaa-print',
            THEME_ASSETS_URL . '/css/print.css',
            array(),
            THEME_VERSION,
            'print'
        );
    }
    
    // إضافة CSS مخصص من إعدادات التخصيص
    $custom_css = get_theme_mod('muhtawaa_custom_css');
    if (!empty($custom_css)) {
        wp_add_inline_style('muhtawaa-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'muhtawaa_enqueue_styles');

/**
 * تحميل ملفات JavaScript
 */
function muhtawaa_enqueue_scripts() {
    // jQuery (مُحمل تلقائياً من WordPress)
    
    // ملف JavaScript الرئيسي
    wp_enqueue_script(
        'muhtawaa-main',
        THEME_ASSETS_URL . '/js/main.js',
        array('jquery'),
        THEME_VERSION,
        true
    );
    
    // بيانات للـ JavaScript
    wp_localize_script('muhtawaa-main', 'muhtawaa_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('muhtawaa_ajax_nonce'),
        'post_id' => is_singular() ? get_the_ID() : 0,
        'is_rtl' => is_rtl(),
        'is_logged_in' => is_user_logged_in(),
        'notifications_enabled' => get_theme_mod('muhtawaa_notifications_enabled', true),
        'strings' => array(
            'loading' => __('جاري التحميل...', 'muhtawaa'),
            'error' => __('حدث خطأ ما!', 'muhtawaa'),
            'success' => __('تمت العملية بنجاح!', 'muhtawaa'),
            'copied' => __('تم نسخ الرابط!', 'muhtawaa'),
            'share' => __('شارك', 'muhtawaa'),
            'search_placeholder' => __('ابحث...', 'muhtawaa'),
            'no_results' => __('لا توجد نتائج', 'muhtawaa'),
            'load_more' => __('تحميل المزيد', 'muhtawaa'),
            'reply' => __('رد', 'muhtawaa'),
            'cancel' => __('إلغاء', 'muhtawaa'),
            'confirm' => __('تأكيد', 'muhtawaa'),
        )
    ));
    
    // تحميل سكريبت التعليقات إذا لزم الأمر
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // مكتبات إضافية حسب الحاجة
    if (is_page_template('templates/contact.php')) {
        // Google reCAPTCHA للنماذج
        if (get_theme_mod('muhtawaa_recaptcha_site_key')) {
            wp_enqueue_script(
                'google-recaptcha',
                'https://www.google.com/recaptcha/api.js',
                array(),
                null,
                true
            );
        }
    }
    
    // Smooth Scroll Polyfill للمتصفحات القديمة
    wp_enqueue_script(
        'smooth-scroll-polyfill',
        'https://cdn.jsdelivr.net/npm/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js',
        array(),
        '0.4.4',
        true
    );
    
    // إضافة سكريبت مُضمن للتهيئة السريعة
    wp_add_inline_script('muhtawaa-main', '
        // تفعيل Smooth Scroll Polyfill
        if (typeof smoothscroll !== "undefined") {
            smoothscroll.polyfill();
        }
        
        // إضافة فئة no-js/js
        document.documentElement.className = document.documentElement.className.replace("no-js", "js");
        
        // كشف دعم WebP
        function checkWebPSupport(callback) {
            var webP = new Image();
            webP.onload = webP.onerror = function () {
                callback(webP.height == 2);
            };
            webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
        }
        
        checkWebPSupport(function(support) {
            if (support) {
                document.documentElement.classList.add("webp");
            } else {
                document.documentElement.classList.add("no-webp");
            }
        });
    ', 'before');
}
add_action('wp_enqueue_scripts', 'muhtawaa_enqueue_scripts');

/**
 * تحميل أنماط وسكريبتات لوحة التحكم
 */
function muhtawaa_admin_enqueue_scripts($hook) {
    // تحميل على صفحات القالب فقط
    if (strpos($hook, 'muhtawaa') === false && $hook !== 'index.php') {
        return;
    }
    
    // CSS للإدارة
    wp_enqueue_style(
        'muhtawaa-admin',
        THEME_ASSETS_URL . '/css/admin.css',
        array(),
        THEME_VERSION
    );
    
    // JavaScript للإدارة
    wp_enqueue_script(
        'muhtawaa-admin',
        THEME_ASSETS_URL . '/js/admin.js',
        array('jquery', 'wp-util'),
        THEME_VERSION,
        true
    );
    
    // Chart.js للإحصائيات
    if ($hook === 'index.php' || strpos($hook, 'muhtawaa-dashboard') !== false) {
        wp_enqueue_script(
            'chart-js',
            'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js',
            array(),
            '3.9.1',
            true
        );
    }
    
    // بيانات للإدارة
    wp_localize_script('muhtawaa-admin', 'muhtawaa_admin', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('muhtawaa_admin_nonce'),
        'strings' => array(
            'loading' => __('جاري التحميل...', 'muhtawaa'),
            'success' => __('تمت العملية بنجاح!', 'muhtawaa'),
            'error' => __('حدث خطأ ما!', 'muhtawaa'),
            'confirm' => __('هل أنت متأكد؟', 'muhtawaa'),
            'cancel' => __('إلغاء', 'muhtawaa'),
            'save' => __('حفظ', 'muhtawaa'),
            'saved' => __('تم الحفظ', 'muhtawaa'),
            'unsaved_changes' => __('لديك تغييرات غير محفوظة. هل تريد المتابعة؟', 'muhtawaa'),
        )
    ));
    
    // Media Uploader
    if ($hook === 'widgets.php' || strpos($hook, 'muhtawaa') !== false) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'muhtawaa_admin_enqueue_scripts');

/**
 * تحميل أنماط المحرر (Gutenberg)
 */
function muhtawaa_editor_styles() {
    // أنماط المحرر
    add_editor_style(array(
        'assets/css/editor-style.css',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap',
    ));
}
add_action('after_setup_theme', 'muhtawaa_editor_styles');

/**
 * تحسين أداء التحميل
 */
function muhtawaa_optimize_scripts($tag, $handle, $src) {
    // إضافة async للسكريبتات غير الحرجة
    $async_scripts = array(
        'google-recaptcha',
        'smooth-scroll-polyfill',
    );
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    // إضافة defer للسكريبتات الأخرى
    $defer_scripts = array(
        'muhtawaa-main',
        'comment-reply',
    );
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'muhtawaa_optimize_scripts', 10, 3);

/**
 * تحسين تحميل الأنماط
 */
function muhtawaa_optimize_styles($html, $handle, $href, $media) {
    // تحميل Font Awesome بشكل غير متزامن
    if ($handle === 'font-awesome') {
        $html = str_replace("rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html);
        $html .= "<noscript><link rel='stylesheet' href='" . $href . "'></noscript>";
    }
    
    return $html;
}
add_filter('style_loader_tag', 'muhtawaa_optimize_styles', 10, 4);

/**
 * إضافة preconnect للموارد الخارجية
 */
function muhtawaa_resource_hints($urls, $relation_type) {
    if ($relation_type === 'preconnect') {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
        );
    }
    
    return $urls;
}
add_filter('wp_resource_hints', 'muhtawaa_resource_hints', 10, 2);