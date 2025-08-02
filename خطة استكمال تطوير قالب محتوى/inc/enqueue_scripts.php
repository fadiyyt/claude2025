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
 * فئة تحميل الملفات والنصوص
 */
class MuhtawaaEnqueueScripts {
    
    /**
     * تحميل ملفات CSS
     */
    public static function enqueue_styles() {
        // الملف الأساسي لـ WordPress
        wp_enqueue_style(
            'muhtawaa-style',
            get_stylesheet_uri(),
            array(),
            THEME_VERSION
        );
        
        // ملف CSS الرئيسي
        wp_enqueue_style(
            'muhtawaa-main',
            THEME_ASSETS_URL . '/css/main.css',
            array('muhtawaa-style'),
            THEME_VERSION
        );
        
        // ملف CSS المكونات
        wp_enqueue_style(
            'muhtawaa-components',
            THEME_ASSETS_URL . '/css/components.css',
            array('muhtawaa-main'),
            THEME_VERSION
        );
        
        // ملف CSS التجاوب
        wp_enqueue_style(
            'muhtawaa-responsive',
            THEME_ASSETS_URL . '/css/responsive.css',
            array('muhtawaa-components'),
            THEME_VERSION,
            'screen'
        );
        
        // ملف CSS للحركات
        wp_enqueue_style(
            'muhtawaa-animations',
            THEME_ASSETS_URL . '/css/animations.css',
            array('muhtawaa-main'),
            THEME_VERSION
        );
        
        // ملف CSS المخصص (آخر ملف للتخصيصات)
        wp_enqueue_style(
            'muhtawaa-custom',
            THEME_ASSETS_URL . '/css/custom.css',
            array('muhtawaa-responsive', 'muhtawaa-animations'),
            THEME_VERSION
        );
        
        // Font Awesome
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
            array(),
            '6.4.0'
        );
        
        // Google Fonts للعربية
        wp_enqueue_style(
            'google-fonts-cairo',
            'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap',
            array(),
            THEME_VERSION
        );
        
        // خط إضافي للعناوين
        wp_enqueue_style(
            'google-fonts-amiri',
            'https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap',
            array(),
            THEME_VERSION
        );
        
        // CSS للطباعة
        wp_enqueue_style(
            'muhtawaa-print',
            THEME_ASSETS_URL . '/css/print.css',
            array(),
            THEME_VERSION,
            'print'
        );
        
        // CSS مخصص للإدارة
        if (is_admin()) {
            wp_enqueue_style(
                'muhtawaa-admin',
                THEME_ASSETS_URL . '/css/admin.css',
                array(),
                THEME_VERSION
            );
        }
        
        // CSS مخصص للتسجيل
        if (is_page_template('page-login.php') || is_page_template('page-register.php')) {
            wp_enqueue_style(
                'muhtawaa-auth',
                THEME_ASSETS_URL . '/css/auth.css',
                array('muhtawaa-main'),
                THEME_VERSION
            );
        }
        
        // إضافة متغيرات CSS مخصصة
        $custom_css = self::get_custom_css_variables();
        wp_add_inline_style('muhtawaa-main', $custom_css);
    }
    
    /**
     * تحميل ملفات JavaScript
     */
    public static function enqueue_scripts() {
        // jQuery (مدمج مع ووردبريس)
        wp_enqueue_script('jquery');
        
        // JavaScript الرئيسي
        wp_enqueue_script(
            'muhtawaa-main',
            THEME_ASSETS_URL . '/js/main.js',
            array('jquery'),
            THEME_VERSION,
            true
        );
        
        // JavaScript للميزات المتقدمة
        wp_enqueue_script(
            'muhtawaa-enhanced',
            THEME_ASSETS_URL . '/js/enhanced.js',
            array('muhtawaa-main'),
            THEME_VERSION,
            true
        );
        
        // JavaScript للبحث المتقدم
        wp_enqueue_script(
            'muhtawaa-search',
            THEME_ASSETS_URL . '/js/search.js',
            array('muhtawaa-main'),
            THEME_VERSION,
            true
        );
        
        // JavaScript للإشعارات
        wp_enqueue_script(
            'muhtawaa-notifications',
            THEME_ASSETS_URL . '/js/notifications.js',
            array('muhtawaa-main'),
            THEME_VERSION,
            true
        );
        
        // JavaScript للحركات
        wp_enqueue_script(
            'muhtawaa-animations',
            THEME_ASSETS_URL . '/js/animations.js',
            array('muhtawaa-main'),
            THEME_VERSION,
            true
        );
        
        // JavaScript لـ AJAX
        wp_enqueue_script(
            'muhtawaa-ajax',
            THEME_ASSETS_URL . '/js/ajax.js',
            array('muhtawaa-main'),
            THEME_VERSION,
            true
        );
        
        // JavaScript للجوال
        wp_enqueue_script(
            'muhtawaa-mobile',
            THEME_ASSETS_URL . '/js/mobile.js',
            array('muhtawaa-main'),
            THEME_VERSION,
            true
        );
        
        // JavaScript للتعليقات (فقط في صفحات المقالات)
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        
        // JavaScript مخصص للإدارة
        if (is_admin()) {
            wp_enqueue_script(
                'muhtawaa-admin',
                THEME_ASSETS_URL . '/js/admin.js',
                array('jquery'),
                THEME_VERSION,
                true
            );
        }
        
        // تمرير البيانات لـ JavaScript
        self::localize_scripts();
        
        // إضافة JavaScript مخصص مباشر
        $custom_js = self::get_custom_javascript();
        if (!empty($custom_js)) {
            wp_add_inline_script('muhtawaa-main', $custom_js);
        }
    }
    
    /**
     * تمرير البيانات لـ JavaScript
     */
    private static function localize_scripts() {
        // البيانات الأساسية
        wp_localize_script('muhtawaa-main', 'muhtawaaData', array(
            'ajaxurl'        => admin_url('admin-ajax.php'),
            'nonce'          => wp_create_nonce('muhtawaa_nonce'),
            'homeUrl'        => home_url('/'),
            'themeUrl'       => THEME_URL,
            'assetsUrl'      => THEME_ASSETS_URL,
            'postId'         => get_the_ID() ? get_the_ID() : 0,
            'userId'         => get_current_user_id(),
            'isRTL'          => is_rtl(),
            'locale'         => get_locale(),
            'isAdmin'        => is_admin(),
            'isMobile'       => wp_is_mobile(),
            'themeVersion'   => THEME_VERSION,
        ));
        
        // نصوص قابلة للترجمة
        wp_localize_script('muhtawaa-main', 'muhtawaaStrings', array(
            'loading'           => __('جاري التحميل...', 'muhtawaa'),
            'loadMore'          => __('عرض المزيد', 'muhtawaa'),
            'noResults'         => __('لا توجد نتائج', 'muhtawaa'),
            'searchPlaceholder' => __('ابحث عن الحلول...', 'muhtawaa'),
            'error'             => __('حدث خطأ، يرجى المحاولة مرة أخرى', 'muhtawaa'),
            'success'           => __('تمت العملية بنجاح', 'muhtawaa'),
            'confirm'           => __('هل أنت متأكد؟', 'muhtawaa'),
            'cancel'            => __('إلغاء', 'muhtawaa'),
            'ok'                => __('موافق', 'muhtawaa'),
            'close'             => __('إغلاق', 'muhtawaa'),
            'save'              => __('حفظ', 'muhtawaa'),
            'share'             => __('مشاركة', 'muhtawaa'),
            'like'              => __('إعجاب', 'muhtawaa'),
            'bookmark'          => __('حفظ للمفضلة', 'muhtawaa'),
            'rating'            => __('تقييم', 'muhtawaa'),
            'comment'           => __('تعليق', 'muhtawaa'),
        ));
        
        // إعدادات البحث
        wp_localize_script('muhtawaa-search', 'muhtawaaSearch', array(
            'enableLiveSearch'    => get_theme_mod('muhtawaa_enable_live_search', true),
            'searchDelay'         => get_theme_mod('muhtawaa_search_delay', 300),
            'minSearchLength'     => get_theme_mod('muhtawaa_min_search_length', 3),
            'maxResults'          => get_theme_mod('muhtawaa_max_search_results', 10),
            'searchInContent'     => get_theme_mod('muhtawaa_search_in_content', true),
            'searchInExcerpt'     => get_theme_mod('muhtawaa_search_in_excerpt', true),
            'searchInTags'        => get_theme_mod('muhtawaa_search_in_tags', true),
        ));
        
        // إعدادات الإشعارات
        wp_localize_script('muhtawaa-notifications', 'muhtawaaNotifications', array(
            'enableNotifications' => get_theme_mod('muhtawaa_enable_notifications', true),
            'notificationDuration' => get_theme_mod('muhtawaa_notification_duration', 5000),
            'notificationPosition' => get_theme_mod('muhtawaa_notification_position', 'top-right'),
            'enableSound'         => get_theme_mod('muhtawaa_enable_notification_sound', false),
        ));
    }
    
    /**
     * الحصول على متغيرات CSS المخصصة
     */
    private static function get_custom_css_variables() {
        $primary_color = get_theme_mod('muhtawaa_primary_color', '#667eea');
        $secondary_color = get_theme_mod('muhtawaa_secondary_color', '#764ba2');
        $accent_color = get_theme_mod('muhtawaa_accent_color', '#48bb78');
        $text_color = get_theme_mod('muhtawaa_text_color', '#2d3748');
        $bg_color = get_theme_mod('muhtawaa_bg_color', '#ffffff');
        
        $font_family = get_theme_mod('muhtawaa_font_family', 'Cairo');
        $font_size = get_theme_mod('muhtawaa_font_size', '16');
        $line_height = get_theme_mod('muhtawaa_line_height', '1.6');
        
        $container_width = get_theme_mod('muhtawaa_container_width', '1200');
        $border_radius = get_theme_mod('muhtawaa_border_radius', '8');
        
        return "
        :root {
            --muhtawaa-primary-color: {$primary_color};
            --muhtawaa-secondary-color: {$secondary_color};
            --muhtawaa-accent-color: {$accent_color};
            --muhtawaa-text-color: {$text_color};
            --muhtawaa-bg-color: {$bg_color};
            --muhtawaa-font-family: '{$font_family}', sans-serif;
            --muhtawaa-font-size: {$font_size}px;
            --muhtawaa-line-height: {$line_height};
            --muhtawaa-container-width: {$container_width}px;
            --muhtawaa-border-radius: {$border_radius}px;
        }
        ";
    }
    
    /**
     * الحصول على JavaScript المخصص
     */
    private static function get_custom_javascript() {
        $enable_smooth_scroll = get_theme_mod('muhtawaa_enable_smooth_scroll', true);
        $enable_back_to_top = get_theme_mod('muhtawaa_enable_back_to_top', true);
        $enable_lazy_loading = get_theme_mod('muhtawaa_enable_lazy_loading', true);
        
        $js = '';
        
        if ($enable_smooth_scroll) {
            $js .= "
            // Smooth scrolling
            document.documentElement.style.scrollBehavior = 'smooth';
            ";
        }
        
        if ($enable_back_to_top) {
            $js .= "
            // Back to top button
            window.addEventListener('scroll', function() {
                const backToTop = document.querySelector('.back-to-top');
                if (backToTop) {
                    if (window.pageYOffset > 300) {
                        backToTop.classList.add('show');
                    } else {
                        backToTop.classList.remove('show');
                    }
                }
            });
            ";
        }
        
        if ($enable_lazy_loading) {
            $js .= "
            // Lazy loading for images
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                
                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
            ";
        }
        
        return $js;
    }
    
    /**
     * إضافة preload للموارد المهمة
     */
    public static function add_preload_resources() {
        // Preload الخطوط المهمة
        echo '<link rel="preload" href="' . THEME_ASSETS_URL . '/fonts/cairo-regular.woff2" as="font" type="font/woff2" crossorigin>';
        echo '<link rel="preload" href="' . THEME_ASSETS_URL . '/fonts/cairo-bold.woff2" as="font" type="font/woff2" crossorigin>';
        
        // Preload CSS الحرجة
        echo '<link rel="preload" href="' . THEME_ASSETS_URL . '/css/critical.css" as="style">';
        
        // Preload JavaScript المهم
        echo '<link rel="preload" href="' . THEME_ASSETS_URL . '/js/main.js" as="script">';
    }
    
    /**
     * إضافة DNS prefetch
     */
    public static function add_dns_prefetch() {
        echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
        echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">';
        echo '<link rel="dns-prefetch" href="//www.google-analytics.com">';
    }
}

// إضافة preload و DNS prefetch
add_action('wp_head', array('MuhtawaaEnqueueScripts', 'add_preload_resources'), 1);
add_action('wp_head', array('MuhtawaaEnqueueScripts', 'add_dns_prefetch'), 1);