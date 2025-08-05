<?php
/**
 * إصلاح شامل لجميع مشاكل القالب
 * Complete Fix for All Theme Issues
 * 
 * أضف هذا الكود في بداية functions.php
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// ========================================
// 1. إصلاح مشكلة المسارات والترميز
// ========================================
if (!function_exists('muhtawaa_fix_url_encoding')) {
    function muhtawaa_fix_url_encoding($url) {
        // فك ترميز URL
        $url = urldecode($url);
        // إعادة ترميز بشكل صحيح
        $parts = explode('/', $url);
        $parts = array_map('rawurlencode', $parts);
        $url = implode('/', $parts);
        // استبدال %20 بـ -
        $url = str_replace('%20', '-', $url);
        return $url;
    }
}

// تطبيق الإصلاح على جميع URLs الخاصة بالقالب
add_filter('theme_file_uri', 'muhtawaa_fix_url_encoding', 10, 1);
add_filter('theme_file_path', function($path) {
    return str_replace('\\', '/', $path);
}, 10, 1);

// ========================================
// 2. إنشاء الملفات المفقودة تلقائياً
// ========================================
add_action('after_setup_theme', function() {
    // إنشاء page.php إذا كان مفقوداً
    $page_php = get_template_directory() . '/page.php';
    if (!file_exists($page_php)) {
        $page_content = '<?php
/**
 * قالب الصفحة
 * Page Template
 * 
 * @package Muhtawaa
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail("full"); ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            "before" => \'<div class="page-links">\' . esc_html__("الصفحات:", "muhtawaa"),
                            "after"  => "</div>",
                        ));
                        ?>
                    </div>

                    <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer">
                        <?php
                        edit_post_link(
                            sprintf(
                                wp_kses(
                                    __("تحرير <span class=\"screen-reader-text\">%s</span>", "muhtawaa"),
                                    array(
                                        "span" => array(
                                            "class" => array(),
                                        ),
                                    )
                                ),
                                get_the_title()
                            ),
                            \'<span class="edit-link">\',
                            "</span>"
                        );
                        ?>
                    </footer>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
        </div>
    </main>
</div>

<?php
get_sidebar();
get_footer();';
        
        file_put_contents($page_php, $page_content);
    }
    
    // إنشاء مجلدات assets إذا كانت مفقودة
    $dirs = array(
        get_template_directory() . '/assets',
        get_template_directory() . '/assets/css',
        get_template_directory() . '/assets/js',
        get_template_directory() . '/assets/images',
    );
    
    foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
            wp_mkdir_p($dir);
        }
    }
});

// ========================================
// 3. تحميل CSS بطريقة بديلة
// ========================================
add_action('wp_enqueue_scripts', function() {
    // إلغاء تسجيل الأنماط السابقة
    wp_deregister_style('muhtawaa-main');
    wp_deregister_style('muhtawaa-responsive');
    
    // محاولة تحميل CSS من مسار مطلق
    $theme_dir = get_template_directory();
    $theme_url = get_template_directory_uri();
    
    // تحميل main.css
    $main_css_path = $theme_dir . '/assets/css/main.css';
    if (file_exists($main_css_path)) {
        // قراءة محتوى الملف وإضافته inline
        $main_css_content = file_get_contents($main_css_path);
        wp_add_inline_style('muhtawaa-style', $main_css_content);
    }
    
    // تحميل responsive.css
    $responsive_css_path = $theme_dir . '/assets/css/responsive.css';
    if (file_exists($responsive_css_path)) {
        $responsive_css_content = file_get_contents($responsive_css_path);
        wp_add_inline_style('muhtawaa-style', $responsive_css_content);
    }
}, 20);

// ========================================
// 4. إنشاء جداول قاعدة البيانات المفقودة
// ========================================
add_action('after_switch_theme', function() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    
    // جدول الإشعارات
    $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
    $sql1 = "CREATE TABLE IF NOT EXISTS $notifications_table (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        title varchar(255) NOT NULL,
        message text NOT NULL,
        type varchar(50) DEFAULT 'info',
        is_read tinyint(1) DEFAULT 0,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id),
        KEY is_read (is_read)
    ) $charset_collate;";
    
    // جدول سجل الصيانة
    $maintenance_log_table = $wpdb->prefix . 'muhtawaa_maintenance_log';
    $sql2 = "CREATE TABLE IF NOT EXISTS $maintenance_log_table (
        id int(11) NOT NULL AUTO_INCREMENT,
        task_name varchar(100) NOT NULL,
        status varchar(50) NOT NULL,
        start_time datetime NOT NULL,
        end_time datetime DEFAULT NULL,
        duration int(11) DEFAULT NULL,
        details text,
        error_message text,
        user_id bigint(20) DEFAULT NULL,
        memory_usage varchar(50) DEFAULT NULL,
        cpu_usage varchar(50) DEFAULT NULL,
        PRIMARY KEY (id),
        KEY task_name (task_name),
        KEY status (status),
        KEY start_time (start_time)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql1);
    dbDelta($sql2);
});

// تشغيل إنشاء الجداول مرة واحدة
if (get_option('muhtawaa_db_version') != '2.0') {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    
    // نفس كود إنشاء الجداول أعلاه
    $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
    $sql1 = "CREATE TABLE IF NOT EXISTS $notifications_table (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        title varchar(255) NOT NULL,
        message text NOT NULL,
        type varchar(50) DEFAULT 'info',
        is_read tinyint(1) DEFAULT 0,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    $maintenance_log_table = $wpdb->prefix . 'muhtawaa_maintenance_log';
    $sql2 = "CREATE TABLE IF NOT EXISTS $maintenance_log_table (
        id int(11) NOT NULL AUTO_INCREMENT,
        task_name varchar(100) NOT NULL,
        status varchar(50) NOT NULL,
        start_time datetime NOT NULL,
        end_time datetime DEFAULT NULL,
        duration int(11) DEFAULT NULL,
        details text,
        error_message text,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql1);
    dbDelta($sql2);
    
    update_option('muhtawaa_db_version', '2.0');
}

// ========================================
// 5. CSS احتياطي في حالة فشل التحميل
// ========================================
add_action('wp_head', function() {
    ?>
    <style id="muhtawaa-fallback-css">
        /* CSS احتياطي أساسي */
        <?php if (!wp_style_is('muhtawaa-main', 'done')): ?>
        /* إدراج CSS الأساسي هنا */
        body {
            font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 0;
            background: #f7f8fa;
            color: #2d3748;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* الهيدر */
        .site-header {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* القائمة */
        .main-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 30px;
        }
        
        .main-menu a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .main-menu a:hover,
        .current-menu-item a {
            color: #667eea;
        }
        
        /* المحتوى */
        .site-content {
            padding: 40px 0;
            min-height: 500px;
        }
        
        .content-area {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 40px;
        }
        
        @media (max-width: 768px) {
            .content-area {
                grid-template-columns: 1fr;
            }
        }
        
        /* المقالات */
        .post, .page {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .entry-title {
            font-size: 2rem;
            margin: 0 0 20px;
            color: #1a202c;
        }
        
        .entry-title a {
            color: inherit;
            text-decoration: none;
        }
        
        .entry-title a:hover {
            color: #667eea;
        }
        
        /* الشريط الجانبي */
        .widget-area {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .widget {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .widget-title {
            font-size: 1.25rem;
            margin: 0 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        /* التذييل */
        .site-footer {
            background: #2d3748;
            color: #fff;
            padding: 50px 0 30px;
            margin-top: 60px;
        }
        
        /* الأزرار */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        /* إصلاحات إضافية */
        img {
            max-width: 100%;
            height: auto;
        }
        
        a {
            color: #667eea;
        }
        
        /* إخفاء العناصر المعطلة */
        .broken-widget {
            display: none !important;
        }
        <?php endif; ?>
    </style>
    <?php
}, 5);

// ========================================
// 6. تسجيل رسالة تنبيه للمطور
// ========================================
add_action('admin_notices', function() {
    if (!current_user_can('manage_options')) return;
    
    $theme_dir_name = basename(get_template_directory());
    if (preg_match('/[^\x00-\x7F]/', $theme_dir_name) || strpos($theme_dir_name, ' ') !== false) {
        ?>
        <div class="notice notice-error">
            <p><strong>تنبيه مهم:</strong> اسم مجلد القالب يحتوي على أحرف عربية أو مسافات مما يسبب مشاكل في تحميل الملفات.</p>
            <p>الاسم الحالي: <code><?php echo esc_html($theme_dir_name); ?></code></p>
            <p>يُنصح بتغيير اسم المجلد إلى: <code>muhtawaa-theme</code></p>
        </div>
        <?php
    }
});

// ========================================
// 7. دالة مساعدة لتصحيح مسارات الملفات
// ========================================
if (!function_exists('muhtawaa_get_asset_url')) {
    function muhtawaa_get_asset_url($file) {
        // محاولة الحصول على المسار الصحيح
        $theme_url = get_template_directory_uri();
        $asset_url = $theme_url . '/assets/' . $file;
        
        // تصحيح الترميز
        $asset_url = str_replace(' ', '%20', $asset_url);
        
        return esc_url($asset_url);
    }
}

// ========================================
// 8. تحميل الملفات باستخدام المسارات المصححة
// ========================================
add_action('wp_enqueue_scripts', function() {
    // استخدام الدالة المساعدة لتحميل الملفات
    if (file_exists(get_template_directory() . '/assets/js/main.js')) {
        wp_enqueue_script(
            'muhtawaa-main-js',
            muhtawaa_get_asset_url('js/main.js'),
            array('jquery'),
            THEME_VERSION,
            true
        );
    }
}, 25);

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ========================================
// 1. تعريف الثوابت الأساسية أولاً
// ========================================
if (!defined('THEME_VERSION'))         define('THEME_VERSION', '2.0.2');
if (!defined('THEME_PATH'))            define('THEME_PATH', get_template_directory());
if (!defined('THEME_URL'))             define('THEME_URL', get_template_directory_uri());
if (!defined('THEME_ASSETS_URL'))      define('THEME_ASSETS_URL', THEME_URL . '/assets');
if (!defined('THEME_INC_PATH'))        define('THEME_INC_PATH', THEME_PATH . '/inc');
if (!defined('THEME_LANGUAGES_PATH'))  define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');
if (!defined('THEME_MIN_WP_VERSION'))  define('THEME_MIN_WP_VERSION', '5.0');
if (!defined('THEME_MIN_PHP_VERSION')) define('THEME_MIN_PHP_VERSION', '7.0');

// ========================================
// 2. تحميل ملف التشخيص والإصلاحات
// ========================================
$diagnostic_file = THEME_PATH . '/diagnostic-fixes.php';
if (file_exists($diagnostic_file)) {
    require_once $diagnostic_file;
}

// ========================================
// 3. إعداد القالب الأساسي
// ========================================
function muhtawaa_theme_setup() {
    // دعم المزايا الأساسية
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('custom-logo');
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // تسجيل القوائم
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'muhtawaa'),
        'footer' => __('قائمة التذييل', 'muhtawaa'),
        'mobile' => __('قائمة الموبايل', 'muhtawaa'),
    ));
    
    // تحميل ملفات اللغة
    load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
}
add_action('after_setup_theme', 'muhtawaa_theme_setup');

// ========================================
// 4. تحميل ملفات CSS و JavaScript (مُبسط)
// ========================================
function muhtawaa_enqueue_assets() {
    // إزالة جميع الأنماط والسكريبتات السابقة أولاً
    // wp_dequeue_style('muhtawaa-style');
    // wp_dequeue_style('muhtawaa-main');
    
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap',
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
    
    // الملف الأساسي
    wp_enqueue_style(
        'muhtawaa-style',
        get_stylesheet_uri(),
        array(),
        THEME_VERSION . '.' . time() // إضافة timestamp للتطوير
    );
    
    // ملف CSS الرئيسي
    $main_css = THEME_PATH . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'muhtawaa-main',
            THEME_ASSETS_URL . '/css/main.css',
            array('muhtawaa-style'),
            THEME_VERSION . '.' . time()
        );
    }
    
    // ملف CSS التجاوب
    $responsive_css = THEME_PATH . '/assets/css/responsive.css';
    if (file_exists($responsive_css)) {
        wp_enqueue_style(
            'muhtawaa-responsive',
            THEME_ASSETS_URL . '/css/responsive.css',
            array('muhtawaa-main'),
            THEME_VERSION . '.' . time()
        );
    }
    
    // jQuery
    wp_enqueue_script('jquery');
    
    // ملف JavaScript الرئيسي
    $main_js = THEME_PATH . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script(
            'muhtawaa-main',
            THEME_ASSETS_URL . '/js/main.js',
            array('jquery'),
            THEME_VERSION . '.' . time(),
            true
        );
        
        // بيانات JavaScript
        wp_localize_script('muhtawaa-main', 'muhtawaa_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_ajax_nonce'),
            'site_url' => home_url(),
            'theme_url' => THEME_URL,
        ));
    }
    
    // تعليقات
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'muhtawaa_enqueue_assets', 999);

// ========================================
// 5. تحميل الملفات المطلوبة
// ========================================
function muhtawaa_load_includes() {
    $includes = array(
        'enqueue-scripts.php',
        'theme-setup.php',
        'widgets.php',
        'customizer.php',
        'helper-functions.php',
        'admin-dashboard.php',
        'security.php',
        'performance.php',
        'seo.php',
        'notifications.php',
        'maintenance.php',
        'import-export.php',
        'smart-recommendations.php',
        'advanced-search.php',
        'comments-rating.php',
        'custom-widgets.php',
        'ajax-functions.php',
    );
    
    foreach ($includes as $file) {
        $filepath = THEME_INC_PATH . '/' . $file;
        if (file_exists($filepath)) {
            require_once $filepath;
        } else {
            // سجل خطأ إذا كان الملف مفقود
            if (WP_DEBUG) {
                error_log('ملف مفقود في قالب محتوى: ' . $filepath);
            }
        }
    }
}
add_action('after_setup_theme', 'muhtawaa_load_includes', 5);

// ========================================
// 6. تسجيل مناطق الويدجت (مُبسط)
// ========================================
function muhtawaa_widgets_init() {
    // الشريط الجانبي الرئيسي
    register_sidebar(array(
        'name'          => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
        'id'            => 'main-sidebar',
        'description'   => __('يظهر في معظم صفحات الموقع', 'muhtawaa'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // مناطق التذييل
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'muhtawaa_widgets_init');

// ========================================
// 7. دوال مساعدة أساسية
// ========================================

// وقت القراءة
if (!function_exists('muhtawaa_reading_time')) {
    function muhtawaa_reading_time($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);
        
        if ($reading_time == 1) {
            return __('دقيقة واحدة', 'muhtawaa');
        } elseif ($reading_time == 2) {
            return __('دقيقتان', 'muhtawaa');
        } elseif ($reading_time <= 10) {
            return sprintf(__('%d دقائق', 'muhtawaa'), $reading_time);
        } else {
            return sprintf(__('%d دقيقة', 'muhtawaa'), $reading_time);
        }
    }
}

// عدد المشاهدات
if (!function_exists('muhtawaa_get_post_views')) {
    function muhtawaa_get_post_views($post_id) {
        $views = get_post_meta($post_id, '_muhtawaa_views', true);
        return $views ? number_format_i18n($views) : '0';
    }
}

// المقالات ذات الصلة
if (!function_exists('muhtawaa_get_related_posts')) {
    function muhtawaa_get_related_posts($post_id, $count = 3) {
        $categories = wp_get_post_categories($post_id);
        
        $args = array(
            'post__not_in' => array($post_id),
            'posts_per_page' => $count,
            'category__in' => $categories,
            'orderby' => 'rand',
        );
        
        return new WP_Query($args);
    }
}

// ========================================
// 8. إصلاحات سريعة
// ========================================

// إصلاح مشكلة عدم ظهور القوائم
add_filter('wp_nav_menu_args', function($args) {
    if (empty($args['fallback_cb'])) {
        $args['fallback_cb'] = function() {
            echo '<ul class="main-menu">';
            wp_list_pages(array(
                'title_li' => '',
                'depth' => 1,
                'number' => 5,
            ));
            echo '</ul>';
        };
    }
    return $args;
});

// إضافة CSS إضافي للإصلاحات السريعة
add_action('wp_head', function() {
    ?>
    <style id="muhtawaa-quick-fixes">
        /* إصلاحات سريعة */
        body { margin: 0; padding: 0; }
        .site-header { position: relative; z-index: 100; }
        .site-content { position: relative; z-index: 1; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        img { max-width: 100%; height: auto; }
        
        /* إصلاح القائمة */
        .main-navigation ul { list-style: none; padding: 0; margin: 0; }
        .main-navigation li { display: inline-block; margin: 0 10px; }
        .main-navigation a { text-decoration: none; color: inherit; }
        
        /* إصلاح التخطيط */
        .content-area { display: flex; flex-wrap: wrap; gap: 30px; }
        .content-area.full-width { display: block; }
        .site-main { flex: 1; min-width: 0; }
        .widget-area { flex: 0 0 300px; }
        
        /* إصلاح الويدجت */
        .widget { margin-bottom: 30px; }
        .widget ul { list-style: none; padding: 0; }
        .widget li { padding: 5px 0; }
        
        /* إصلاح الصور البارزة */
        .post-thumbnail img { width: 100%; height: auto; display: block; }
        
        /* التجاوب الأساسي */
        @media (max-width: 768px) {
            .content-area { flex-direction: column; }
            .widget-area { flex: 1 1 100%; }
            .main-navigation li { display: block; margin: 5px 0; }
        }
    </style>
    <?php
}, 999);

// ========================================
// 9. رسائل التنبيه للمطور
// ========================================
if (WP_DEBUG && current_user_can('manage_options')) {
    add_action('admin_notices', function() {
        $missing_files = array();
        
        // فحص الملفات المهمة
        $check_files = array(
            'assets/css/main.css',
            'assets/js/main.js',
            'single.php',
            'page.php',
            'sidebar.php',
            'comments.php',
        );
        
        foreach ($check_files as $file) {
            if (!file_exists(THEME_PATH . '/' . $file)) {
                $missing_files[] = $file;
            }
        }
        
        if (!empty($missing_files)) {
            echo '<div class="notice notice-warning">';
            echo '<p><strong>قالب محتوى:</strong> الملفات التالية مفقودة:</p>';
            echo '<ul>';
            foreach ($missing_files as $file) {
                echo '<li><code>' . $file . '</code></li>';
            }
            echo '</ul>';
            echo '<p><a href="' . admin_url('themes.php?page=muhtawaa-diagnostics') . '" class="button">تشغيل أداة التشخيص</a></p>';
            echo '</div>';
        }
    });
}

// ========================================
// 10. تفعيل القالب - إعدادات أولية
// ========================================
add_action('after_switch_theme', function() {
    // إنشاء الصفحات الأساسية
    $pages = array(
        'من نحن' => 'about',
        'اتصل بنا' => 'contact',
        'سياسة الخصوصية' => 'privacy',
        'شروط الاستخدام' => 'terms',
    );
    
    foreach ($pages as $title => $slug) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_name' => $slug,
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_content' => 'محتوى الصفحة هنا...',
            ));
        }
    }
    
    // إعداد الصفحة الرئيسية
    $homepage = get_page_by_path('home');
    if (!$homepage) {
        $homepage_id = wp_insert_post(array(
            'post_title' => 'الرئيسية',
            'post_name' => 'home',
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => '',
        ));
        
        update_option('page_on_front', $homepage_id);
        update_option('show_on_front', 'page');
    }
    
    // حفظ الروابط الدائمة
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
});