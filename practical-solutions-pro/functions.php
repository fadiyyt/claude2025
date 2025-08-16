<?php
/**
 * Practical Solutions Pro - Enhanced Functions (FIXED VERSION)
 * قالب الحلول العملية الاحترافي - الوظائف المُصححة والمحسنة
 * الإصدار: 2.3.0 (مُصحح ومحسن)
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// 1. تعريف الثوابت الأساسية (Core Constants)
// =============================================================================
define('PS_THEME_VERSION', '2.3.0');
define('PS_THEME_DIR', get_template_directory());
define('PS_THEME_URI', get_template_directory_uri());
define('PS_DIST_URI', PS_THEME_URI . '/dist');
define('PS_CACHE_DURATION', 3600);
define('PS_DEBUG', defined('WP_DEBUG') && WP_DEBUG);

// =============================================================================
// 2. تحميل ملفات النظام الأساسية (Core System Files) - بدون ai-openrouter
// =============================================================================
$ps_core_includes = [
    'inc/security-enhancements.php',
    'inc/theme-admin-panel.php',      
    'inc/customizer-settings.php',    
    'inc/block-patterns.php',         
    'inc/unified-search-system.php',  
    'inc/rating-system.php',          
    'inc/performance-optimizer.php'
];

foreach ($ps_core_includes as $file) {
    $filepath = PS_THEME_DIR . '/' . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        if (PS_DEBUG) {
            error_log("PS Theme: Missing file - {$file}");
        }
    }
}

// =============================================================================
// 3. إعدادات القالب الأساسية (Theme Setup)
// =============================================================================
if (!function_exists('ps_theme_setup')) {
    function ps_theme_setup() {
        // دعم ميزات ووردبريس الحديثة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('responsive-embeds');
        add_theme_support('html5', [
            'search-form', 'comment-form', 'comment-list', 
            'gallery', 'caption', 'style', 'script'
        ]);
        add_theme_support('custom-logo', [
            'height' => 100, 
            'width' => 400, 
            'flex-height' => true, 
            'flex-width' => true
        ]);
        
        // دعم ميزات قوالب الكتل (Block Theme Features)
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_theme_support('custom-spacing');
        add_theme_support('custom-line-height');
        add_theme_support('appearance-tools');
        add_theme_support('border');
        add_theme_support('link-color');
        
        // دعم قوالب الكتل
        add_theme_support('block-templates');
        add_theme_support('block-template-parts');

        // دعم الترجمة
        load_theme_textdomain('practical-solutions', PS_THEME_DIR . '/languages');
        
        // إعداد أحجام الصور المحسنة
        add_image_size('ps-thumbnail', 400, 300, true);
        add_image_size('ps-medium', 800, 600, true);
        add_image_size('ps-large', 1200, 800, true);
        add_image_size('ps-hero', 1600, 900, true);
        
        // تسجيل القوائم
        register_nav_menus([
            'primary' => __('القائمة الرئيسية', 'practical-solutions'),
            'footer' => __('قائمة التذييل', 'practical-solutions'),
            'mobile' => __('قائمة الأجهزة المحمولة', 'practical-solutions')
        ]);
    }
}
add_action('after_setup_theme', 'ps_theme_setup');

// =============================================================================
// 4. تحميل الأنماط والسكريبتات (Enqueue Assets)
// =============================================================================
function ps_enqueue_assets() {
    // CSS الرئيسي
    wp_enqueue_style('ps-style', get_stylesheet_uri(), [], PS_THEME_VERSION);
    
    // CSS المجمع (إذا كان موجود)
    if (file_exists(PS_THEME_DIR . '/dist/css/main.min.css')) {
        wp_enqueue_style('ps-main', PS_DIST_URI . '/css/main.min.css', [], PS_THEME_VERSION);
    }
    
    // دعم RTL
    if (is_rtl()) {
        wp_enqueue_style('ps-rtl', PS_THEME_URI . '/rtl.css', ['ps-style'], PS_THEME_VERSION);
    }
    
    // JavaScript الرئيسي
    if (file_exists(PS_THEME_DIR . '/dist/js/main.min.js')) {
        wp_enqueue_script('ps-main', PS_DIST_URI . '/js/main.min.js', ['jquery'], PS_THEME_VERSION, true);
    }
    
    // إعدادات JavaScript
    wp_localize_script('ps-main', 'psAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ps_nonce'),
        'strings' => [
            'loading' => __('جاري التحميل...', 'practical-solutions'),
            'error' => __('حدث خطأ، يرجى المحاولة مرة أخرى', 'practical-solutions'),
            'success' => __('تم بنجاح', 'practical-solutions')
        ]
    ]);
    
    // إضافة خطوط عربية محسنة
    wp_enqueue_style('ps-google-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Almarai:wght@300;400;700;800&display=swap', [], null);
}
add_action('wp_enqueue_scripts', 'ps_enqueue_assets');

// =============================================================================
// 5. إعداد الودجات (Widget Areas)
// =============================================================================
function ps_register_widget_areas() {
    register_sidebar([
        'name' => __('الشريط الجانبي الرئيسي', 'practical-solutions'),
        'id' => 'primary-sidebar',
        'description' => __('الشريط الجانبي للصفحات الداخلية', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
    
    register_sidebar([
        'name' => __('تذييل الصفحة - العمود 1', 'practical-solutions'),
        'id' => 'footer-1',
        'description' => __('العمود الأول في تذييل الصفحة', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ]);
    
    register_sidebar([
        'name' => __('تذييل الصفحة - العمود 2', 'practical-solutions'),
        'id' => 'footer-2',
        'description' => __('العمود الثاني في تذييل الصفحة', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ]);
    
    register_sidebar([
        'name' => __('تذييل الصفحة - العمود 3', 'practical-solutions'),
        'id' => 'footer-3',
        'description' => __('العمود الثالث في تذييل الصفحة', 'practical-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ]);
}
add_action('widgets_init', 'ps_register_widget_areas');

// =============================================================================
// 6. تحسينات الأداء (Performance Optimizations)
// =============================================================================
// تأجيل تحميل JavaScript غير الحرج
function ps_defer_non_critical_js($tag, $handle, $src) {
    $defer_scripts = ['ps-main'];
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace('<script ', '<script defer ', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'ps_defer_non_critical_js', 10, 3);

// تحسين تحميل الصور
function ps_add_image_attributes($attr, $attachment, $size) {
    if (!is_admin()) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'ps_add_image_attributes', 10, 3);

// إضافة preload للخطوط المهمة
function ps_add_font_preload() {
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap"></noscript>' . "\n";
}
add_action('wp_head', 'ps_add_font_preload', 1);

// =============================================================================
// 7. تحسينات SEO (SEO Enhancements)
// =============================================================================
// إضافة البيانات المهيكلة الأساسية
function ps_add_structured_data() {
    if (is_singular('post')) {
        global $post;
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => [
                '@type' => 'Person',
                'name' => get_the_author()
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'url' => home_url()
            ]
        ];
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $schema['image'] = $image[0];
        }
        
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'ps_add_structured_data');

// تحسين meta tags
function ps_improve_meta_tags() {
    if (is_singular()) {
        global $post;
        
        // وصف محسن
        if (is_single() && !has_excerpt()) {
            $description = wp_trim_words(strip_tags($post->post_content), 25, '...');
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
        
        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(get_the_excerpt() ?: wp_trim_words(strip_tags($post->post_content), 25, '...')) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'ps_improve_meta_tags');

// =============================================================================
// 8. وظائف مساعدة (Helper Functions)
// =============================================================================
// إنشاء breadcrumbs
function ps_breadcrumbs() {
    if (!is_front_page()) {
        echo '<nav class="ps-breadcrumbs" aria-label="' . __('مسار التنقل', 'practical-solutions') . '">';
        echo '<ol class="breadcrumb-list">';
        echo '<li><a href="' . home_url() . '">' . __('الرئيسية', 'practical-solutions') . '</a></li>';
        
        if (is_category() || is_single()) {
            if (is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                    echo '<li class="current">' . get_the_title() . '</li>';
                }
            } else {
                echo '<li class="current">' . single_cat_title('', false) . '</li>';
            }
        } elseif (is_page()) {
            echo '<li class="current">' . get_the_title() . '</li>';
        } elseif (is_archive()) {
            echo '<li class="current">' . get_the_archive_title() . '</li>';
        } elseif (is_search()) {
            echo '<li class="current">' . sprintf(__('نتائج البحث عن: %s', 'practical-solutions'), get_search_query()) . '</li>';
        } elseif (is_404()) {
            echo '<li class="current">' . __('الصفحة غير موجودة', 'practical-solutions') . '</li>';
        }
        
        echo '</ol>';
        echo '</nav>';
    }
}

// shortcode للـ breadcrumbs
function ps_breadcrumbs_shortcode() {
    ob_start();
    ps_breadcrumbs();
    return ob_get_clean();
}
add_shortcode('ps_breadcrumbs', 'ps_breadcrumbs_shortcode');

// تحسين وقت القراءة
function ps_reading_time($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 كلمة في الدقيقة
    
    return sprintf(_n('دقيقة واحدة', '%s دقائق', $reading_time, 'practical-solutions'), $reading_time);
}

// =============================================================================
// 9. تحسينات الأمان (Security Enhancements)
// =============================================================================
// إخفاء رقم إصدار WordPress
remove_action('wp_head', 'wp_generator');

// منع enumeration للمستخدمين
function ps_block_user_enumeration() {
    if (is_admin() || current_user_can('administrator')) {
        return;
    }
    
    if (isset($_GET['author']) || preg_match('/\?author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
add_action('template_redirect', 'ps_block_user_enumeration');

// تحسين حماية wp-login.php
function ps_limit_login_attempts() {
    $attempts = get_option('ps_login_attempts', []);
    $ip = $_SERVER['REMOTE_ADDR'];
    $current_time = time();
    
    // تنظيف المحاولات القديمة (أكثر من ساعة)
    foreach ($attempts as $attempt_ip => $data) {
        if ($current_time - $data['time'] > 3600) {
            unset($attempts[$attempt_ip]);
        }
    }
    
    // فحص المحاولات الحالية
    if (isset($attempts[$ip]) && $attempts[$ip]['count'] >= 5) {
        wp_die(__('تم تجاوز عدد محاولات تسجيل الدخول المسموح. يرجى المحاولة بعد ساعة.', 'practical-solutions'));
    }
}

// تسجيل محاولات تسجيل الدخول الفاشلة
function ps_record_failed_login($username) {
    $attempts = get_option('ps_login_attempts', []);
    $ip = $_SERVER['REMOTE_ADDR'];
    $current_time = time();
    
    if (!isset($attempts[$ip])) {
        $attempts[$ip] = ['count' => 0, 'time' => $current_time];
    }
    
    $attempts[$ip]['count']++;
    $attempts[$ip]['time'] = $current_time;
    
    update_option('ps_login_attempts', $attempts);
}
add_action('wp_login_failed', 'ps_record_failed_login');

// =============================================================================
// 10. تحسينات خاصة بالمحتوى العربي (Arabic Content Enhancements)
// =============================================================================
// تحسين عرض التواريخ بالعربية
function ps_arabic_date($date) {
    $english_months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    
    $arabic_months = [
        'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
    ];
    
    return str_replace($english_months, $arabic_months, $date);
}

// تحسين البحث للنصوص العربية
function ps_improve_arabic_search($search, $wp_query) {
    if (!$wp_query->is_search() || is_admin()) {
        return $search;
    }
    
    global $wpdb;
    $search_term = $wp_query->query_vars['s'];
    
    if (!empty($search_term)) {
        // إضافة بحث مرن للكلمات العربية
        $search_term = trim($search_term);
        $search_words = explode(' ', $search_term);
        
        $search_conditions = [];
        foreach ($search_words as $word) {
            if (strlen($word) > 2) {
                $word = $wpdb->esc_like($word);
                $search_conditions[] = "({$wpdb->posts}.post_title LIKE '%{$word}%' OR {$wpdb->posts}.post_content LIKE '%{$word}%')";
            }
        }
        
        if (!empty($search_conditions)) {
            $search = ' AND (' . implode(' OR ', $search_conditions) . ') ';
        }
    }
    
    return $search;
}
add_filter('posts_search', 'ps_improve_arabic_search', 10, 2);

// =============================================================================
// 11. إنهاء التحميل وتأكيد الجاهزية
// =============================================================================
if (!defined('PS_THEME_LOADED')) {
    define('PS_THEME_LOADED', true);
}

// Hook للتأكد من اكتمال التحميل
do_action('ps_theme_fully_loaded');

// تسجيل وقت تحميل القالب للإحصائيات (في وضع التطوير فقط)
if (PS_DEBUG) {
    $load_time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
    error_log("PS Theme loaded successfully in: " . round($load_time * 1000, 2) . "ms");
}

// إضافة معلومات التقنية في HTML head
function ps_add_theme_info() {
    echo "\n<!-- Practical Solutions Pro v" . PS_THEME_VERSION . " (Fixed & Enhanced) -->\n";
    echo "<!-- WordPress " . get_bloginfo('version') . " | PHP " . PHP_VERSION . " -->\n";
    echo "<!-- RTL Support: Enabled | Performance: Optimized -->\n";
}
add_action('wp_head', 'ps_add_theme_info', 99);