<?php
/**
 * Theme Name: محتوى - الحلول اليومية المطور
 * Functions and definitions - النسخة المُنظمة والمحسنة
 * 
 * @package Muhtawaa
 * @version 2.0
 * @author فريق محتوى
 * @since 1.0.0
 */

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ثوابت القالب الأساسية
if (!defined('THEME_VERSION'))         define('THEME_VERSION', '2.0.1');
if (!defined('THEME_PATH'))            define('THEME_PATH', get_template_directory());
if (!defined('THEME_URL'))             define('THEME_URL', get_template_directory_uri());
if (!defined('THEME_ASSETS_URL'))      define('THEME_ASSETS_URL', THEME_URL . '/assets');
if (!defined('THEME_INC_PATH'))        define('THEME_INC_PATH', THEME_PATH . '/inc');
if (!defined('THEME_LANGUAGES_PATH'))  define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');
if (!defined('THEME_MIN_WP_VERSION'))  define('THEME_MIN_WP_VERSION', '5.0');
if (!defined('THEME_MIN_PHP_VERSION')) define('THEME_MIN_PHP_VERSION', '7.4');

/**
 * فئة إدارة القالب الرئيسية
 * تتولى تنسيق وإدارة جميع مكونات القالب
 */
if (!class_exists('MuhtawaaTheme')) {
    class MuhtawaaTheme {
        
        /**
         * مثيل واحد من الفئة (Singleton Pattern)
         */
        private static $instance = null;
        
        /**
         * الحصول على المثيل الوحيد من الفئة
         */
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        
        /**
         * منشئ الفئة - إعداد الخطافات الأساسية
         */
        private function __construct() {
            // التحقق من متطلبات النظام
            add_action('admin_init', array($this, 'check_requirements'));
            
            // تحميل ملفات النظام
            $this->load_required_files();
            
            // إعداد الخطافات الأساسية
            add_action('after_setup_theme', array($this, 'theme_setup'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
            add_action('widgets_init', array($this, 'widgets_init'));
            add_action('init', array($this, 'init'));
            
            // خطافات التحسين والأمان
            add_action('wp_head', array($this, 'add_meta_tags'));
            add_action('wp_head', array($this, 'add_schema_markup'));
            
            // إزالة الميزات غير المطلوبة
            add_action('init', array($this, 'cleanup_wordpress'));
        }
        
        /**
         * التحقق من متطلبات النظام
         */
        public function check_requirements() {
            global $wp_version;
            
            // التحقق من إصدار ووردبريس
            if (version_compare($wp_version, THEME_MIN_WP_VERSION, '<')) {
                add_action('admin_notices', function() {
                    printf(
                        '<div class="notice notice-error"><p>%s <strong>%s</strong> %s <strong>%s</strong></p></div>',
                        __('قالب محتوى يتطلب ووردبريس إصدار', 'muhtawaa'),
                        THEME_MIN_WP_VERSION,
                        __('أو أحدث. إصدارك الحالي:', 'muhtawaa'),
                        $GLOBALS['wp_version']
                    );
                });
            }
            
            // التحقق من إصدار PHP
            if (version_compare(PHP_VERSION, THEME_MIN_PHP_VERSION, '<')) {
                add_action('admin_notices', function() {
                    printf(
                        '<div class="notice notice-error"><p>%s <strong>%s</strong> %s <strong>%s</strong></p></div>',
                        __('قالب محتوى يتطلب PHP إصدار', 'muhtawaa'),
                        THEME_MIN_PHP_VERSION,
                        __('أو أحدث. إصدارك الحالي:', 'muhtawaa'),
                        PHP_VERSION
                    );
                });
            }
        }
        
        /**
         * تحميل جميع الملفات المطلوبة
         */
        private function load_required_files() {
            $required_files = array(
                'theme-setup.php',          // إعدادات القالب الأساسية
                'enqueue-scripts.php',      // تحميل CSS و JS
                'widgets.php',              // إعدادات الويدجت
                'customizer.php',           // إعدادات التخصيص
                'ajax-functions.php',       // وظائف AJAX
                'security.php',             // الحماية والأمان
                'performance.php',          // تحسين الأداء
                'seo.php',                  // تحسين محركات البحث
                'notifications.php',        // نظام الإشعارات
                'maintenance.php',          // الصيانة التلقائية
                'import-export.php',        // الاستيراد والتصدير
                'smart-recommendations.php', // التوصيات الذكية
                'advanced-search.php',      // البحث المتقدم
                'comments-rating.php',      // التعليقات والتقييم
                'custom-widgets.php',       // الويدجت المخصصة
                'admin-dashboard.php',      // لوحة الإدارة
                'helper-functions.php',     // الوظائف المساعدة
            );
            
            foreach ($required_files as $file) {
                $file_path = THEME_INC_PATH . '/' . $file;
                
                if (file_exists($file_path)) {
                    require_once $file_path;
                } else {
                    // تسجيل خطأ إذا لم يتم العثور على الملف
                    error_log("Muhtawaa Theme: Missing required file - {$file}");
                    
                    // إظهار تنبيه في لوحة الإدارة
                    if (is_admin()) {
                        add_action('admin_notices', function() use ($file) {
                            printf(
                                '<div class="notice notice-warning"><p>%s: <code>%s</code></p></div>',
                                __('ملف مطلوب مفقود في قالب محتوى', 'muhtawaa'),
                                $file
                            );
                        });
                    }
                }
            }
        }
        
        /**
         * إعداد القالب الأساسي
         */
        public function theme_setup() {
            // تحميل ملف اللغة
            load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
            
            // إعداد الميزات الأساسية في ملف منفصل
            if (class_exists('MuhtawaaThemeSetup')) {
                MuhtawaaThemeSetup::setup_theme_features();
            }
        }
        
        /**
         * تحميل ملفات CSS و JavaScript
         */
        public function enqueue_scripts() {
            // تحميل الملفات في ملف منفصل
            if (class_exists('MuhtawaaEnqueueScripts')) {
                MuhtawaaEnqueueScripts::enqueue_styles();
                MuhtawaaEnqueueScripts::enqueue_scripts();
            }
        }
        
        /**
         * تسجيل مناطق الويدجت
         */
        public function widgets_init() {
            // تسجيل الويدجت في ملف منفصل
            if (class_exists('MuhtawaaWidgets')) {
                MuhtawaaWidgets::register_sidebars();
            }
        }
        
        /**
         * التهيئة الأولية
         */
        public function init() {
            // إعدادات إضافية عند التهيئة
            if (class_exists('MuhtawaaSecurity')) {
                MuhtawaaSecurity::init_security_features();
            }
            
            if (class_exists('MuhtawaaPerformance')) {
                MuhtawaaPerformance::init_performance_optimizations();
            }
        }
        
        /**
         * إضافة علامات Meta للـ SEO
         */
        public function add_meta_tags() {
            if (class_exists('MuhtawaaSEO')) {
                MuhtawaaSEO::add_meta_tags();
            }
        }
        
        /**
         * إضافة Schema Markup
         */
        public function add_schema_markup() {
            if (class_exists('MuhtawaaSEO')) {
                MuhtawaaSEO::add_schema_markup();
            }
        }
        
        /**
         * تنظيف ووردبريس من الميزات غير المطلوبة
         */
        public function cleanup_wordpress() {
            if (class_exists('MuhtawaaPerformance')) {
                MuhtawaaPerformance::cleanup_wordpress();
            }
        }
        
        /**
         * تفعيل القالب
         */
        public static function activate() {
            // إنشاء الجداول المطلوبة
            self::create_custom_tables();
            
            // إعداد الخيارات الافتراضية
            self::set_default_options();
            
            // مسح التخزين المؤقت
            wp_cache_flush();
            
            // تحديث قواعد الرابط
            flush_rewrite_rules();
        }
        
        /**
         * إلغاء تفعيل القالب
         */
        public static function deactivate() {
            // تنظيف التخزين المؤقت
            wp_cache_flush();
            
            // إعادة تعيين قواعد الرابط
            flush_rewrite_rules();
        }
        
        /**
         * إنشاء الجداول المخصصة
         */
        private static function create_custom_tables() {
            global $wpdb;
            
            $charset_collate = $wpdb->get_charset_collate();
            
            // جدول إحصائيات الحلول
            $table_name = $wpdb->prefix . 'muhtawaa_stats';
            
            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                post_id bigint(20) NOT NULL,
                views int(11) DEFAULT 0,
                likes int(11) DEFAULT 0,
                shares int(11) DEFAULT 0,
                rating decimal(3,2) DEFAULT 0.00,
                last_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                UNIQUE KEY post_id (post_id)
            ) $charset_collate;";
            
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            
            // جدول التوصيات
            $recommendations_table = $wpdb->prefix . 'muhtawaa_recommendations';
            
            $sql2 = "CREATE TABLE $recommendations_table (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                user_id bigint(20) NOT NULL,
                post_id bigint(20) NOT NULL,
                recommended_post_id bigint(20) NOT NULL,
                score decimal(5,2) DEFAULT 0.00,
                created_at datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                KEY user_id (user_id),
                KEY post_id (post_id)
            ) $charset_collate;";
            
            dbDelta($sql2);
        }
        
        /**
         * تعيين الخيارات الافتراضية
         */
        private static function set_default_options() {
            $default_options = array(
                'muhtawaa_enable_notifications' => 1,
                'muhtawaa_enable_recommendations' => 1,
                'muhtawaa_enable_advanced_search' => 1,
                'muhtawaa_enable_maintenance' => 1,
                'muhtawaa_theme_version' => THEME_VERSION,
            );
            
            foreach ($default_options as $option => $value) {
                if (get_option($option) === false) {
                    add_option($option, $value);
                }
            }
        }
    }

    // تهيئة القالب
    add_action('after_setup_theme', function() {
        MuhtawaaTheme::getInstance();
    });

    // خطافات التفعيل وإلغاء التفعيل
    add_action('after_switch_theme', array('MuhtawaaTheme', 'activate'));
    add_action('switch_theme', array('MuhtawaaTheme', 'deactivate'));
}

/**
 * وظائف مساعدة عامة
 */

// التحقق من وجود الوظائف لتجنب التعارض
if (!function_exists('muhtawaa_get_theme_version')) {
    /**
     * الحصول على إصدار القالب
     */
    function muhtawaa_get_theme_version() {
        return THEME_VERSION;
    }
}

if (!function_exists('muhtawaa_is_development')) {
    /**
     * التحقق من وضع التطوير
     */
    function muhtawaa_is_development() {
        return defined('WP_DEBUG') && WP_DEBUG;
    }
}

if (!function_exists('muhtawaa_log')) {
    /**
     * تسجيل الأحداث والأخطاء
     */
    function muhtawaa_log($message, $type = 'info') {
        if (muhtawaa_is_development()) {
            error_log("[Muhtawaa {$type}] " . $message);
        }
    }
}

// نهاية الملف