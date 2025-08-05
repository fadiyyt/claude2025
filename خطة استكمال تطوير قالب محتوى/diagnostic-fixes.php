<?php
/**
 * ملف التشخيص والإصلاحات الفورية
 * Diagnostic and Quick Fixes File
 * 
 * ضع هذا الملف في مجلد القالب الرئيسي واستدعه من functions.php
 * 
 * @package Muhtawaa
 * @version 2.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة التشخيص والإصلاحات
 */
class MuhtawaaDiagnostics {
    
    /**
     * تشغيل التشخيص
     */
    public static function run() {
        // إضافة صفحة التشخيص
        add_action('admin_menu', array(__CLASS__, 'add_diagnostic_page'));
        
        // إصلاحات فورية
        add_action('init', array(__CLASS__, 'immediate_fixes'));
        
        // إضافة أنماط طوارئ
        add_action('wp_head', array(__CLASS__, 'emergency_styles'), 1);
        
        // التحقق من تحميل الملفات
        add_action('wp_footer', array(__CLASS__, 'check_loaded_files'));
    }
    
    /**
     * إضافة صفحة التشخيص
     */
    public static function add_diagnostic_page() {
        add_submenu_page(
            'themes.php',
            'تشخيص قالب محتوى',
            'تشخيص القالب',
            'manage_options',
            'muhtawaa-diagnostics',
            array(__CLASS__, 'render_diagnostic_page')
        );
    }
    
    /**
     * عرض صفحة التشخيص
     */
    public static function render_diagnostic_page() {
        ?>
        <div class="wrap">
            <h1>تشخيص قالب محتوى</h1>
            
            <div class="notice notice-info">
                <p>هذه الصفحة تعرض حالة جميع مكونات القالب والمشاكل المحتملة.</p>
            </div>
            
            <?php self::check_theme_files(); ?>
            <?php self::check_theme_settings(); ?>
            <?php self::check_database_tables(); ?>
            <?php self::check_loaded_assets(); ?>
            
            <div style="margin-top: 30px;">
                <h2>إصلاحات سريعة</h2>
                <p>
                    <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=muhtawaa-diagnostics&action=fix-all'), 'muhtawaa_fix_all'); ?>" 
                       class="button button-primary">
                        تشغيل جميع الإصلاحات
                    </a>
                    <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=muhtawaa-diagnostics&action=reset-css'), 'muhtawaa_reset_css'); ?>" 
                       class="button">
                        إعادة تعيين CSS
                    </a>
                    <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=muhtawaa-diagnostics&action=clear-cache'), 'muhtawaa_clear_cache'); ?>" 
                       class="button">
                        مسح الذاكرة المؤقتة
                    </a>
                </p>
            </div>
        </div>
        <?php
        
        // تنفيذ الإصلاحات
        if (isset($_GET['action']) && wp_verify_nonce($_GET['_wpnonce'], 'muhtawaa_' . $_GET['action'])) {
            self::execute_fix($_GET['action']);
        }
    }
    
    /**
     * فحص ملفات القالب
     */
    private static function check_theme_files() {
        echo '<h2>فحص الملفات</h2>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>الملف</th><th>الحالة</th><th>الحجم</th></tr></thead>';
        echo '<tbody>';
        
        $required_files = array(
            'style.css' => 'ملف الأنماط الرئيسي',
            'functions.php' => 'ملف الوظائف',
            'index.php' => 'ملف العرض الرئيسي',
            'header.php' => 'رأس الموقع',
            'footer.php' => 'تذييل الموقع',
            'single.php' => 'قالب المقالة',
            'page.php' => 'قالب الصفحة',
            'sidebar.php' => 'الشريط الجانبي',
            'comments.php' => 'التعليقات',
            'archive.php' => 'الأرشيف',
            'search.php' => 'البحث',
            '404.php' => 'صفحة الخطأ',
            'front-page.php' => 'الصفحة الرئيسية',
            'assets/css/main.css' => 'CSS الرئيسي',
            'assets/css/responsive.css' => 'CSS التجاوب',
            'assets/js/main.js' => 'JavaScript الرئيسي',
            'assets/js/admin.js' => 'JavaScript الإدارة',
        );
        
        foreach ($required_files as $file => $description) {
            $file_path = get_template_directory() . '/' . $file;
            $exists = file_exists($file_path);
            $size = $exists ? filesize($file_path) : 0;
            
            echo '<tr>';
            echo '<td>' . $description . ' <code>' . $file . '</code></td>';
            echo '<td>' . ($exists ? '<span style="color:green;">✓ موجود</span>' : '<span style="color:red;">✗ مفقود</span>') . '</td>';
            echo '<td>' . ($exists ? size_format($size) : '-') . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
    }
    
    /**
     * فحص الإعدادات
     */
    private static function check_theme_settings() {
        echo '<h2>فحص الإعدادات</h2>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>الإعداد</th><th>القيمة</th><th>الحالة</th></tr></thead>';
        echo '<tbody>';
        
        // فحص الثوابت
        $constants = array(
            'THEME_VERSION' => 'إصدار القالب',
            'THEME_PATH' => 'مسار القالب',
            'THEME_URL' => 'رابط القالب',
            'THEME_ASSETS_URL' => 'رابط الأصول',
        );
        
        foreach ($constants as $constant => $description) {
            $defined = defined($constant);
            $value = $defined ? constant($constant) : 'غير محدد';
            
            echo '<tr>';
            echo '<td>' . $description . ' <code>' . $constant . '</code></td>';
            echo '<td>' . esc_html($value) . '</td>';
            echo '<td>' . ($defined ? '<span style="color:green;">✓</span>' : '<span style="color:red;">✗</span>') . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
    }
    
    /**
     * فحص جداول قاعدة البيانات
     */
    private static function check_database_tables() {
        global $wpdb;
        
        echo '<h2>فحص قاعدة البيانات</h2>';
        echo '<table class="widefat">';
        echo '<thead><tr><th>الجدول</th><th>الحالة</th><th>عدد السجلات</th></tr></thead>';
        echo '<tbody>';
        
        $tables = array(
            'muhtawaa_notifications' => 'الإشعارات',
            'muhtawaa_ratings' => 'التقييمات',
            'muhtawaa_maintenance_log' => 'سجل الصيانة',
        );
        
        foreach ($tables as $table => $description) {
            $table_name = $wpdb->prefix . $table;
            $exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name;
            $count = $exists ? $wpdb->get_var("SELECT COUNT(*) FROM $table_name") : 0;
            
            echo '<tr>';
            echo '<td>' . $description . ' <code>' . $table_name . '</code></td>';
            echo '<td>' . ($exists ? '<span style="color:green;">✓ موجود</span>' : '<span style="color:orange;">⚠ غير موجود</span>') . '</td>';
            echo '<td>' . ($exists ? $count : '-') . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
    }
    
    /**
     * فحص الأصول المحملة
     */
    private static function check_loaded_assets() {
        echo '<h2>الأصول المحملة</h2>';
        echo '<div id="loaded-assets-check">';
        echo '<p>جاري فحص الأصول المحملة...</p>';
        echo '</div>';
        
        ?>
        <script>
        jQuery(document).ready(function($) {
            var loadedStyles = [];
            var loadedScripts = [];
            
            // فحص CSS
            $('link[rel="stylesheet"]').each(function() {
                loadedStyles.push({
                    href: $(this).attr('href'),
                    id: $(this).attr('id')
                });
            });
            
            // فحص JavaScript
            $('script[src]').each(function() {
                loadedScripts.push({
                    src: $(this).attr('src'),
                    id: $(this).attr('id')
                });
            });
            
            var html = '<h3>ملفات CSS المحملة (' + loadedStyles.length + ')</h3>';
            html += '<ul>';
            loadedStyles.forEach(function(style) {
                html += '<li>' + (style.id || 'بدون معرف') + ': <code>' + style.href + '</code></li>';
            });
            html += '</ul>';
            
            html += '<h3>ملفات JavaScript المحملة (' + loadedScripts.length + ')</h3>';
            html += '<ul>';
            loadedScripts.forEach(function(script) {
                html += '<li>' + (script.id || 'بدون معرف') + ': <code>' + script.src + '</code></li>';
            });
            html += '</ul>';
            
            $('#loaded-assets-check').html(html);
        });
        </script>
        <?php
    }
    
    /**
     * تنفيذ الإصلاحات
     */
    private static function execute_fix($action) {
        switch ($action) {
            case 'fix-all':
                self::fix_all_issues();
                break;
            case 'reset-css':
                self::reset_css_files();
                break;
            case 'clear-cache':
                self::clear_all_cache();
                break;
        }
        
        echo '<div class="notice notice-success"><p>تم تنفيذ الإصلاح بنجاح!</p></div>';
    }
    
    /**
     * إصلاح جميع المشاكل
     */
    private static function fix_all_issues() {
        // إنشاء المجلدات المفقودة
        $dirs = array(
            get_template_directory() . '/assets',
            get_template_directory() . '/assets/css',
            get_template_directory() . '/assets/js',
            get_template_directory() . '/assets/images',
            get_template_directory() . '/inc',
            get_template_directory() . '/template-parts',
        );
        
        foreach ($dirs as $dir) {
            if (!file_exists($dir)) {
                wp_mkdir_p($dir);
            }
        }
        
        // إنشاء الملفات المفقودة
        self::create_missing_files();
        
        // مسح الذاكرة المؤقتة
        self::clear_all_cache();
        
        // إعادة حفظ الروابط الدائمة
        flush_rewrite_rules();
    }
    
    /**
     * إنشاء الملفات المفقودة
     */
    private static function create_missing_files() {
        // إنشاء page.php إذا كان مفقوداً
        $page_php = get_template_directory() . '/page.php';
        if (!file_exists($page_php)) {
            $content = '<?php
/**
 * قالب الصفحة
 * @package Muhtawaa
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>';
            
            file_put_contents($page_php, $content);
        }
        
        // إنشاء 404.php إذا كان مفقوداً
        $error_php = get_template_directory() . '/404.php';
        if (!file_exists($error_php)) {
            $content = '<?php
/**
 * صفحة الخطأ 404
 * @package Muhtawaa
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="error-404 not-found">
                <h1 class="page-title">404</h1>
                <p>عذراً، الصفحة التي تبحث عنها غير موجودة.</p>
                <a href="<?php echo esc_url(home_url("/")); ?>" class="btn btn-primary">العودة للرئيسية</a>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>';
            
            file_put_contents($error_php, $content);
        }
    }
    
    /**
     * إعادة تعيين ملفات CSS
     */
    private static function reset_css_files() {
        // حذف ملفات CSS المؤقتة
        $cache_files = glob(get_template_directory() . '/assets/css/*.cache');
        foreach ($cache_files as $file) {
            unlink($file);
        }
        
        // تحديث إصدار القالب لإجبار إعادة التحميل
        set_theme_mod('muhtawaa_css_version', time());
    }
    
    /**
     * مسح جميع الذاكرة المؤقتة
     */
    private static function clear_all_cache() {
        // مسح ذاكرة WordPress المؤقتة
        wp_cache_flush();
        
        // مسح transients
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_site_transient_%'");
        
        // مسح ذاكرة Object Cache
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
    }
    
    /**
     * إصلاحات فورية
     */
    public static function immediate_fixes() {
        // التأكد من تعريف الثوابت
        if (!defined('THEME_VERSION')) {
            define('THEME_VERSION', '2.0.1');
        }
        if (!defined('THEME_PATH')) {
            define('THEME_PATH', get_template_directory());
        }
        if (!defined('THEME_URL')) {
            define('THEME_URL', get_template_directory_uri());
        }
        if (!defined('THEME_ASSETS_URL')) {
            define('THEME_ASSETS_URL', THEME_URL . '/assets');
        }
        
        // إضافة دعم المزايا الأساسية
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
        
        // تسجيل القوائم
        register_nav_menus(array(
            'primary' => __('القائمة الرئيسية', 'muhtawaa'),
            'footer' => __('قائمة التذييل', 'muhtawaa'),
        ));
    }
    
    /**
     * أنماط الطوارئ
     */
    public static function emergency_styles() {
        ?>
        <style id="muhtawaa-emergency-styles">
            /* أنماط طوارئ أساسية */
            body {
                font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif !important;
                direction: rtl !important;
                text-align: right !important;
                margin: 0;
                padding: 0;
                background: #f5f5f5;
                color: #333;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 15px;
            }
            
            /* الهيدر */
            .site-header {
                background: #fff;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                padding: 20px 0;
            }
            
            .site-title {
                margin: 0;
                font-size: 28px;
            }
            
            .site-title a {
                color: #333;
                text-decoration: none;
            }
            
            /* القائمة */
            .main-menu {
                list-style: none;
                padding: 0;
                margin: 20px 0;
                display: flex;
                gap: 20px;
            }
            
            .main-menu a {
                color: #333;
                text-decoration: none;
                padding: 5px 10px;
            }
            
            .main-menu a:hover {
                color: #667eea;
            }
            
            /* المحتوى */
            .site-content {
                padding: 40px 0;
                background: #fff;
                min-height: 400px;
            }
            
            .entry-title {
                font-size: 32px;
                margin-bottom: 20px;
                color: #333;
            }
            
            .entry-content {
                line-height: 1.8;
                font-size: 16px;
            }
            
            /* المقالات */
            .post {
                background: #fff;
                padding: 30px;
                margin-bottom: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }
            
            /* الأزرار */
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background: #667eea;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: all 0.3s;
            }
            
            .btn:hover {
                background: #5a67d8;
                color: #fff;
            }
            
            /* التذييل */
            .site-footer {
                background: #2d3748;
                color: #fff;
                padding: 40px 0;
                margin-top: 40px;
            }
            
            /* إصلاحات إضافية */
            img {
                max-width: 100%;
                height: auto;
            }
            
            a {
                color: #667eea;
            }
            
            /* إخفاء العناصر المعطلة مؤقتاً */
            .broken-widget,
            .error-widget {
                display: none !important;
            }
        </style>
        <?php
    }
    
    /**
     * فحص الملفات المحملة
     */
    public static function check_loaded_files() {
        if (current_user_can('manage_options') && isset($_GET['debug'])) {
            ?>
            <div style="position: fixed; bottom: 20px; right: 20px; background: #fff; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 300px; z-index: 9999;">
                <h4>معلومات التحميل</h4>
                <p>القالب النشط: <?php echo get_template(); ?></p>
                <p>مسار القالب: <?php echo get_template_directory(); ?></p>
                <p>رابط القالب: <?php echo get_template_directory_uri(); ?></p>
                <p>ملفات CSS المحملة: <span id="css-count">0</span></p>
                <p>ملفات JS المحملة: <span id="js-count">0</span></p>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('css-count').textContent = document.querySelectorAll('link[rel="stylesheet"]').length;
                document.getElementById('js-count').textContent = document.querySelectorAll('script[src]').length;
            });
            </script>
            <?php
        }
    }
}

// تشغيل التشخيص
MuhtawaaDiagnostics::run();