<?php
/**
 * Theme Setup Functions
 * وظائف إعداد القالب الأساسية
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * تسجيل الـ Sidebars
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_widgets_init')) {
    function practical_solutions_widgets_init() {
        // الشريط الجانبي الرئيسي
        register_sidebar(array(
            'name'          => __('الشريط الجانبي الرئيسي', 'practical-solutions'),
            'id'            => 'sidebar-1',
            'description'   => __('الشريط الجانبي الذي يظهر في المقالات والصفحات', 'practical-solutions'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));

        // شريط جانبي للتذييل
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name'          => sprintf(__('تذييل الموقع %d', 'practical-solutions'), $i),
                'id'            => 'footer-' . $i,
                'description'   => sprintf(__('منطقة الودجات رقم %d في تذييل الموقع', 'practical-solutions'), $i),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget-title">',
                'after_title'   => '</h4>',
            ));
        }
    }
}
add_action('widgets_init', 'practical_solutions_widgets_init');

/**
 * إضافة خيارات إضافية للمحرر
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_editor_setup')) {
    function practical_solutions_editor_setup() {
        // إضافة أنماط محرر مخصصة
        add_editor_style('assets/css/editor-style.css');
        
        // دعم الخطوط العربية في المحرر
        add_action('admin_init', 'practical_solutions_add_editor_fonts');
    }
}
add_action('after_setup_theme', 'practical_solutions_editor_setup');

/**
 * إضافة الخطوط للمحرر
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_add_editor_fonts')) {
    function practical_solutions_add_editor_fonts() {
        add_editor_style('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap');
    }
}

/**
 * تخصيص المحرر للغة العربية
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_editor_arabic_setup')) {
    function practical_solutions_editor_arabic_setup() {
        // إضافة دعم RTL للمحرر
        add_action('admin_head', function() {
            echo '<style>
                .block-editor-writing-flow {
                    direction: rtl;
                }
                .wp-block {
                    text-align: right;
                }
                .block-editor-block-list__layout .wp-block[data-align="left"] {
                    text-align: left;
                }
                .block-editor-block-list__layout .wp-block[data-align="center"] {
                    text-align: center;
                }
                .block-editor-block-list__layout .wp-block[data-align="right"] {
                    text-align: right;
                }
            </style>';
        });
    }
}
add_action('enqueue_block_editor_assets', 'practical_solutions_editor_arabic_setup');

/**
 * تحسين SEO الأساسي
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_basic_seo')) {
    function practical_solutions_basic_seo() {
        // إضافة meta description تلقائياً إذا لم توجد
        if (!has_action('wp_head', 'wp_no_robots') && is_singular()) {
            add_action('wp_head', function() {
                if (!get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)) {
                    $excerpt = get_the_excerpt();
                    if ($excerpt) {
                        echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags($excerpt)) . '">' . "\n";
                    }
                }
            });
        }
        
        // إضافة Open Graph الأساسي
        add_action('wp_head', 'practical_solutions_add_basic_og_tags');
    }
}
add_action('wp_head', 'practical_solutions_basic_seo', 1);

/**
 * إضافة Open Graph tags أساسية
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_add_basic_og_tags')) {
    function practical_solutions_add_basic_og_tags() {
        if (is_singular()) {
            global $post;
            
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
            echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
            
            if (has_post_thumbnail()) {
                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                echo '<meta property="og:image" content="' . esc_url($thumbnail[0]) . '">' . "\n";
            }
            
            $excerpt = get_the_excerpt();
            if ($excerpt) {
                echo '<meta property="og:description" content="' . esc_attr(wp_strip_all_tags($excerpt)) . '">' . "\n";
            }
        }
    }
}

/**
 * تحسين الأمان الأساسي
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_basic_security')) {
    function practical_solutions_basic_security() {
        // إخفاء إصدار ووردبريس
        remove_action('wp_head', 'wp_generator');
        
        // منع تعداد المستخدمين
        add_action('init', function() {
            if (isset($_GET['author']) && is_numeric($_GET['author'])) {
                wp_redirect(home_url('/404'));
                exit;
            }
        });
        
        // إضافة security headers
        add_action('send_headers', function() {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
        });
    }
}
add_action('init', 'practical_solutions_basic_security');

/**
 * تحسين الأداء الأساسي
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_basic_performance')) {
    function practical_solutions_basic_performance() {
        // تفعيل التحميل الكسول للصور
        add_filter('wp_lazy_loading_enabled', '__return_true');
        
        // تحسين الاستعلامات
        add_action('pre_get_posts', function($query) {
            if (!is_admin() && $query->is_main_query()) {
                if (is_home()) {
                    $query->set('posts_per_page', 12);
                }
            }
        });
        
        // إزالة الاستعلامات غير الضرورية
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
    }
}
add_action('init', 'practical_solutions_basic_performance');

/**
 * تخصيص شاشة تسجيل الدخول
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_custom_login')) {
    function practical_solutions_custom_login() {
        add_action('login_enqueue_scripts', function() {
            echo '<style>
                body.login {
                    direction: rtl;
                    font-family: "Noto Sans Arabic", Arial, sans-serif;
                }
                .login h1 a {
                    background-image: url(' . get_template_directory_uri() . '/assets/images/logo.png);
                    background-size: contain;
                    width: 200px;
                    height: 80px;
                }
                .login form {
                    border-radius: 8px;
                }
                .login input[type="text"],
                .login input[type="password"] {
                    direction: rtl;
                    text-align: right;
                }
            </style>';
        });
        
        // تغيير رابط الشعار
        add_filter('login_headerurl', function() {
            return home_url();
        });
        
        // تغيير نص الشعار
        add_filter('login_headertext', function() {
            return get_bloginfo('name');
        });
    }
}
add_action('init', 'practical_solutions_custom_login');

/**
 * تحسينات للوحة التحكم
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_admin_improvements')) {
    function practical_solutions_admin_improvements() {
        // إضافة خطوط عربية للوحة التحكم
        add_action('admin_enqueue_scripts', function() {
            wp_enqueue_style('practical-solutions-admin-fonts', 
                'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');
            
            wp_add_inline_style('practical-solutions-admin-fonts', '
                body, .wp-admin, .wp-admin input, .wp-admin textarea, .wp-admin select {
                    font-family: "Noto Sans Arabic", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                }
            ');
        });
        
        // إضافة معلومات في footer الإدارة
        add_filter('admin_footer_text', function() {
            return sprintf(
                __('مدعوم بواسطة %s | قالب الحلول العملية', 'practical-solutions'),
                '<a href="https://wordpress.org/">ووردبريس</a>'
            );
        });
    }
}
add_action('admin_init', 'practical_solutions_admin_improvements');

/**
 * إضافة دعم الألوان المخصصة للمحرر
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_editor_color_palette')) {
    function practical_solutions_editor_color_palette() {
        add_theme_support('editor-color-palette', array(
            array(
                'name'  => __('الأساسي', 'practical-solutions'),
                'slug'  => 'primary',
                'color' => '#007cba',
            ),
            array(
                'name'  => __('الثانوي', 'practical-solutions'),
                'slug'  => 'secondary',
                'color' => '#34495e',
            ),
            array(
                'name'  => __('التمييز', 'practical-solutions'),
                'slug'  => 'accent',
                'color' => '#e74c3c',
            ),
            array(
                'name'  => __('النجاح', 'practical-solutions'),
                'slug'  => 'success',
                'color' => '#27ae60',
            ),
            array(
                'name'  => __('التحذير', 'practical-solutions'),
                'slug'  => 'warning',
                'color' => '#f39c12',
            ),
            array(
                'name'  => __('المعلومات', 'practical-solutions'),
                'slug'  => 'info',
                'color' => '#3498db',
            ),
        ));
    }
}
add_action('after_setup_theme', 'practical_solutions_editor_color_palette');

/**
 * إضافة معلومات القالب في الـ footer للزوار
 * 
 * @since 1.0.0
 */
if (!function_exists('practical_solutions_theme_credits')) {
    function practical_solutions_theme_credits() {
        if (!is_admin()) {
            echo '<!-- Theme: Practical Solutions v' . PRACTICAL_SOLUTIONS_VERSION . ' -->' . "\n";
        }
    }
}
add_action('wp_footer', 'practical_solutions_theme_credits', 999);