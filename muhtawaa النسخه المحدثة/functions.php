<?php
/**
 * Theme Name: محتوى - الحلول اليومية
 * Functions and definitions - النسخة المطورة والمحسنة
 * 
 * @package Muhtawaa
 * @version 2.0
 */

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ثوابت القالب المطورة
define('THEME_VERSION', '2.0');
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_ASSETS_URL', THEME_URL . '/assets');
define('THEME_INC_PATH', THEME_PATH . '/inc');
define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');

// فئة إدارة القالب الرئيسية
class MuhtawaaTheme {
    
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('init', array($this, 'init_features'));
        add_action('customize_register', array($this, 'customize_register'));
        add_action('wp_head', array($this, 'add_meta_tags'));
        
        // تحميل ملفات النظام
        $this->load_includes();
        
        // إعداد نظام الصيانة التلقائية
        $this->setup_maintenance_system();
        
        // إعداد نظام الإشعارات المحسن
        $this->setup_notification_system();
    }
    
    /**
     * إعداد القالب الأساسي
     */
    public function setup() {
        // دعم اللغة العربية
        load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
        
        // دعم ميزات ووردبريس المتقدمة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 
            'gallery', 'caption', 'script', 'style'
        ));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', array(
            'height' => 100, 'width' => 300,
            'flex-height' => true, 'flex-width' => true,
        ));
        add_theme_support('post-formats', array(
            'aside', 'gallery', 'link', 'image', 'quote', 
            'status', 'video', 'audio', 'chat'
        ));
        add_theme_support('custom-background');
        add_theme_support('custom-header');
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        
        // تسجيل القوائم المحسنة
        register_nav_menus(array(
            'main-menu' => __('القائمة الرئيسية', 'muhtawaa'),
            'footer-menu' => __('قائمة التذييل', 'muhtawaa'),
            'mobile-menu' => __('قائمة الجوال', 'muhtawaa'),
            'social-menu' => __('قائمة وسائل التواصل', 'muhtawaa'),
        ));
        
        // أحجام الصور المخصصة المحسنة
        add_image_size('solution-thumbnail', 400, 300, true);
        add_image_size('solution-large', 800, 600, true);
        add_image_size('solution-featured', 1200, 600, true);
        add_image_size('category-icon', 150, 150, true);
        add_image_size('author-avatar', 100, 100, true);
        
        // إعداد RSS محسن
        add_theme_support('automatic-feed-links');
        
        // إعداد محرر المحتوى
        add_editor_style('assets/css/editor.css');
    }
    
    /**
     * تحميل ملفات CSS و JavaScript المحسنة
     */
    public function enqueue_scripts() {
        // ملفات CSS المحسنة
        wp_enqueue_style('muhtawaa-style', get_stylesheet_uri(), array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-main', THEME_ASSETS_URL . '/css/main.css', array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-custom', THEME_ASSETS_URL . '/css/custom.css', array('muhtawaa-main'), THEME_VERSION);
        
        // Font Awesome محسن
        wp_enqueue_style('font-awesome', 
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', 
            array(), '6.4.0'
        );
        
        // Google Fonts للعربية
        wp_enqueue_style('google-fonts', 
            'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap',
            array(), THEME_VERSION
        );
        
        // jQuery مع fallback
        wp_enqueue_script('jquery');
        
        // ملفات JavaScript المحسنة
        wp_enqueue_script('muhtawaa-main', 
            THEME_ASSETS_URL . '/js/main.js', 
            array('jquery'), THEME_VERSION, true
        );
        
        wp_enqueue_script('muhtawaa-enhanced', 
            THEME_ASSETS_URL . '/js/enhanced.js', 
            array('muhtawaa-main'), THEME_VERSION, true
        );
        
        // متغيرات JavaScript محسنة
        wp_localize_script('muhtawaa-main', 'muhtawaaAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_nonce'),
            'postId' => get_the_ID() ?: 0,
            'homeUrl' => home_url(),
            'themeUrl' => THEME_URL,
            'currentUserId' => get_current_user_id(),
            'isAdmin' => current_user_can('manage_options'),
            'locale' => get_locale(),
            'strings' => array(
                'loading' => __('جاري التحميل...', 'muhtawaa'),
                'error' => __('حدث خطأ', 'muhtawaa'),
                'success' => __('تم بنجاح', 'muhtawaa'),
                'confirm' => __('هل أنت متأكد؟', 'muhtawaa'),
                'noResults' => __('لا توجد نتائج', 'muhtawaa'),
                'loadMore' => __('تحميل المزيد', 'muhtawaa'),
                'searchPlaceholder' => __('ابحث عن حل...', 'muhtawaa'),
            ),
            'settings' => $this->get_theme_settings(),
        ));
        
        // تحميل ملف التعليقات إذا لزم الأمر
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        
        // Lazy loading للصور
        wp_enqueue_script('muhtawaa-lazyload', 
            THEME_ASSETS_URL . '/js/lazyload.js', 
            array(), THEME_VERSION, true
        );
    }
    
    /**
     * تسجيل مناطق الودجات المحسنة
     */
    public function widgets_init() {
        // الشريط الجانبي الرئيسي
        register_sidebar(array(
            'name' => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
            'id' => 'sidebar-main',
            'description' => __('الشريط الجانبي للصفحات الفردية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // شريط جانبي للصفحة الرئيسية
        register_sidebar(array(
            'name' => __('شريط الصفحة الرئيسية', 'muhtawaa'),
            'id' => 'sidebar-home',
            'description' => __('شريط جانبي خاص بالصفحة الرئيسية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // مناطق تذييل الموقع
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name' => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
                'id' => "footer-{$i}",
                'description' => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ));
        }
        
        // منطقة ما قبل المحتوى
        register_sidebar(array(
            'name' => __('ما قبل المحتوى', 'muhtawaa'),
            'id' => 'before-content',
            'description' => __('تظهر قبل محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="pre-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // منطقة ما بعد المحتوى
        register_sidebar(array(
            'name' => __('ما بعد المحتوى', 'muhtawaa'),
            'id' => 'after-content',
            'description' => __('تظهر بعد محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="post-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
    
    /**
     * تحميل ملفات النظام المطلوبة
     */
    private function load_includes() {
        $includes = array(
            'ajax-functions.php',
            'theme-settings.php',
            'customizer.php',
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
            'admin-dashboard.php',
        );
        
        foreach ($includes as $file) {
            $file_path = THEME_INC_PATH . '/' . $file;
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }
    }
    
    /**
     * تهيئة ميزات القالب المحسنة
     */
    public function init_features() {
        // إنشاء التصنيفات المخصصة
        $this->create_custom_taxonomies();
        
        // إنشاء أنواع المحتوى المخصصة
        $this->create_custom_post_types();
        
        // إنشاء الجداول المطلوبة
        $this->create_database_tables();
        
        // إعداد نظام البحث المحسن
        add_action('pre_get_posts', array($this, 'enhance_search'));
        
        // إعداد نظام التوصيات الذكية
        add_action('wp_footer', array($this, 'load_smart_recommendations'));
        
        // تحسين الأمان
        $this->enhance_security();
        
        // تحسين الأداء
        $this->enhance_performance();
    }
    
    /**
     * إنشاء التصنيفات المخصصة المحسنة
     */
    private function create_custom_taxonomies() {
        // تصنيف فئات الحلول
        register_taxonomy('solution_category', 'post', array(
            'labels' => array(
                'name' => __('فئات الحلول', 'muhtawaa'),
                'singular_name' => __('فئة الحلول', 'muhtawaa'),
                'menu_name' => __('فئات الحلول', 'muhtawaa'),
                'all_items' => __('جميع الفئات', 'muhtawaa'),
                'edit_item' => __('تعديل الفئة', 'muhtawaa'),
                'view_item' => __('مشاهدة الفئة', 'muhtawaa'),
                'update_item' => __('تحديث الفئة', 'muhtawaa'),
                'add_new_item' => __('إضافة فئة جديدة', 'muhtawaa'),
                'new_item_name' => __('اسم الفئة الجديدة', 'muhtawaa'),
                'search_items' => __('البحث في الفئات', 'muhtawaa'),
                'not_found' => __('لم يتم العثور على فئات', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'solutions'),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
            'meta_box_cb' => 'post_categories_meta_box',
        ));
        
        // تصنيف مستوى الصعوبة
        register_taxonomy('difficulty_level', 'post', array(
            'labels' => array(
                'name' => __('مستويات الصعوبة', 'muhtawaa'),
                'singular_name' => __('مستوى الصعوبة', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
        
        // تصنيف الكلمات المفتاحية للحلول
        register_taxonomy('solution_tags', 'post', array(
            'labels' => array(
                'name' => __('كلمات مفتاحية للحلول', 'muhtawaa'),
                'singular_name' => __('كلمة مفتاحية', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
    }
    
    /**
     * إنشاء أنواع المحتوى المخصصة
     */
    private function create_custom_post_types() {
        // نوع محتوى للتوصيات
        register_post_type('recommendation', array(
            'labels' => array(
                'name' => __('التوصيات', 'muhtawaa'),
                'singular_name' => __('توصية', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-lightbulb',
        ));
        
        // نوع محتوى للإشعارات
        register_post_type('notification', array(
            'labels' => array(
                'name' => __('الإشعارات', 'muhtawaa'),
                'singular_name' => __('إشعار', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor'),
            'menu_icon' => 'dashicons-bell',
        ));
    }
    
    /**
     * إنشاء الجداول المطلوبة
     */
    private function create_database_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // جدول الإحصائيات المحسن
        $stats_table = $wpdb->prefix . 'muhtawaa_stats';
        $sql_stats = "CREATE TABLE IF NOT EXISTS $stats_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) DEFAULT 0,
            action_type varchar(50) NOT NULL,
            action_value text,
            user_ip varchar(45),
            user_agent text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            KEY user_id (user_id),
            KEY action_type (action_type),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول المشتركين المحسن
        $subscribers_table = $wpdb->prefix . 'muhtawaa_subscribers';
        $sql_subscribers = "CREATE TABLE IF NOT EXISTS $subscribers_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            email varchar(100) NOT NULL,
            name varchar(100),
            preferences text,
            status varchar(20) DEFAULT 'active',
            source varchar(50) DEFAULT 'website',
            confirmation_token varchar(255),
            confirmed_at datetime,
            last_email_sent datetime,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY email (email),
            KEY status (status),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول البحثات المحسن
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            search_term varchar(255) NOT NULL,
            results_count int(11) DEFAULT 0,
            clicked_result_id bigint(20) DEFAULT 0,
            user_id bigint(20) DEFAULT 0,
            user_ip varchar(45),
            user_agent text,
            source varchar(50) DEFAULT 'website',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY search_term (search_term),
            KEY user_id (user_id),
            KEY created_at (created_at),
            FULLTEXT KEY search_term_fulltext (search_term)
        ) $charset_collate;";
        
        // جدول التوصيات الذكية
        $recommendations_table = $wpdb->prefix . 'muhtawaa_recommendations';
        $sql_recommendations = "CREATE TABLE IF NOT EXISTS $recommendations_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) DEFAULT 0,
            post_id bigint(20) NOT NULL,
            recommended_post_id bigint(20) NOT NULL,
            recommendation_type varchar(50) NOT NULL,
            score decimal(5,2) DEFAULT 0.00,
            shown_count int(11) DEFAULT 0,
            clicked_count int(11) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY post_id (post_id),
            KEY recommended_post_id (recommended_post_id),
            KEY recommendation_type (recommendation_type)
        ) $charset_collate;";
        
        // جدول إعدادات القالب
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $sql_settings = "CREATE TABLE IF NOT EXISTS $settings_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            setting_key varchar(100) NOT NULL,
            setting_value longtext,
            setting_type varchar(50) DEFAULT 'string',
            autoload varchar(20) DEFAULT 'yes',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY setting_key (setting_key),
            KEY autoload (autoload)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_stats);
        dbDelta($sql_subscribers);
        dbDelta($sql_searches);
        dbDelta($sql_recommendations);
        dbDelta($sql_settings);
        
        // إدراج الإعدادات الافتراضية
        $this->insert_default_settings();
    }
    
    /**
     * إدراج الإعدادات الافتراضية
     */
    private function insert_default_settings() {
        $default_settings = array(
            'theme_color_primary' => '#667eea',
            'theme_color_secondary' => '#764ba2',
            'enable_smart_recommendations' => 'yes',
            'enable_advanced_search' => 'yes',
            'enable_rating_system' => 'yes',
            'maintenance_mode' => 'no',
            'notification_email' => get_option('admin_email'),
            'max_recommendations' => '5',
            'search_suggestions_count' => '8',
            'auto_backup_enabled' => 'yes',
            'auto_backup_frequency' => 'weekly',
        );
        
        foreach ($default_settings as $key => $value) {
            $this->update_theme_setting($key, $value);
        }
    }
    
    /**
     * تحسين نظام البحث
     */
    public function enhance_search($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            // البحث في العنوان والمحتوى والحقول المخصصة
            $search_term = $query->get('s');
            
            if (!empty($search_term)) {
                // إضافة البحث في الحقول المخصصة
                $meta_query = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_solution_materials',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_solution_description',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                );
                
                $query->set('meta_query', $meta_query);
                
                // البحث في التصنيفات أيضاً
                $tax_query = array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'solution_category',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                    array(
                        'taxonomy' => 'solution_tags',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                );
                
                $query->set('tax_query', $tax_query);
                
                // تسجيل البحث للإحصائيات
                $this->log_search($search_term, $query->found_posts);
            }
        }
        
        return $query;
    }
    
    /**
     * تسجيل البحث في قاعدة البيانات
     */
    private function log_search($search_term, $results_count = 0) {
        global $wpdb;
        
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        
        $wpdb->insert(
            $searches_table,
            array(
                'search_term' => sanitize_text_field($search_term),
                'results_count' => intval($results_count),
                'user_id' => get_current_user_id(),
                'user_ip' => $this->get_user_ip(),
                'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%d', '%s', '%s', '%s')
        );
    }
    
    /**
     * الحصول على عنوان IP المستخدم
     */
    private function get_user_ip() {
        $ip_keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    }
    
    /**
     * إعداد نظام الصيانة التلقائية
     */
    private function setup_maintenance_system() {
        // جدولة تنظيف قاعدة البيانات
        if (!wp_next_scheduled('muhtawaa_daily_maintenance')) {
            wp_schedule_event(time(), 'daily', 'muhtawaa_daily_maintenance');
        }
        
        add_action('muhtawaa_daily_maintenance', array($this, 'daily_maintenance'));
        
        // جدولة النسخ الاحتياطية
        if (!wp_next_scheduled('muhtawaa_weekly_backup')) {
            wp_schedule_event(time(), 'weekly', 'muhtawaa_weekly_backup');
        }
        
        add_action('muhtawaa_weekly_backup', array($this, 'create_backup'));
    }
    
    /**
     * الصيانة اليومية
     */
    public function daily_maintenance() {
        global $wpdb;
        
        // تنظيف البيانات القديمة (أكثر من 6 أشهر)
        $six_months_ago = date('Y-m-d H:i:s', strtotime('-6 months'));
        
        // حذف الإحصائيات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_stats WHERE created_at < %s",
            $six_months_ago
        ));
        
        // حذف البحثات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < %s",
            $six_months_ago
        ));
        
        // تنظيف transients منتهية الصلاحية
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%' AND option_name NOT IN (SELECT CONCAT('_transient_', SUBSTRING(option_name, 19)) FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%')");
        
        // تحسين الجداول
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE $table");
        }
        
        // إرسال تقرير الصيانة
        $this->send_maintenance_report();
    }
    
    /**
     * إنشاء نسخة احتياطية
     */
    public function create_backup() {
        if ($this->get_theme_setting('auto_backup_enabled') !== 'yes') {
            return;
        }
        
        global $wpdb;
        
        $backup_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
        if (!file_exists($backup_dir)) {
            wp_mkdir_p($backup_dir);
        }
        
        $backup_file = $backup_dir . 'backup-' . date('Y-m-d-H-i-s') . '.sql';
        
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        $sql_dump = "-- Muhtawaa Theme Backup\n";
        $sql_dump .= "-- Created: " . date('Y-m-d H:i:s') . "\n\n";
        
        foreach ($tables as $table) {
            $result = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
            
            if (!empty($result)) {
                $sql_dump .= "-- Table: $table\n";
                $sql_dump .= "TRUNCATE TABLE $table;\n";
                
                foreach ($result as $row) {
                    $values = array();
                    foreach ($row as $value) {
                        $values[] = "'" . $wpdb->_escape($value) . "'";
                    }
                    $sql_dump .= "INSERT INTO $table VALUES (" . implode(',', $values) . ");\n";
                }
                $sql_dump .= "\n";
            }
        }
        
        file_put_contents($backup_file, $sql_dump);
        
        // حذف النسخ القديمة (أكثر من شهر)
        $this->cleanup_old_backups($backup_dir);
        
        return $backup_file;
    }
    
    /**
     * تنظيف النسخ الاحتياطية القديمة
     */
    private function cleanup_old_backups($backup_dir) {
        $files = glob($backup_dir . 'backup-*.sql');
        $one_month_ago = time() - (30 * 24 * 60 * 60);
        
        foreach ($files as $file) {
            if (filemtime($file) < $one_month_ago) {
                unlink($file);
            }
        }
    }
    
    /**
     * إرسال تقرير الصيانة
     */
    private function send_maintenance_report() {
        $admin_email = $this->get_theme_setting('notification_email');
        if (!$admin_email) return;
        
        global $wpdb;
        
        // إحصائيات سريعة
        $stats = array(
            'total_posts' => wp_count_posts()->publish,
            'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
            'searches_today' => $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
                date('Y-m-d')
            )),
            'top_search' => $wpdb->get_var("SELECT search_term FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY search_term ORDER BY COUNT(*) DESC LIMIT 1")
        );
        
        $subject = 'تقرير الصيانة اليومية - ' . get_bloginfo('name');
        $message = "تقرير الصيانة اليومية لموقع " . get_bloginfo('name') . "\n\n";
        $message .= "إجمالي المقالات: " . $stats['total_posts'] . "\n";
        $message .= "إجمالي المشتركين: " . $stats['total_subscribers'] . "\n";
        $message .= "البحثات اليوم: " . $stats['searches_today'] . "\n";
        $message .= "أشهر بحث هذا الأسبوع: " . ($stats['top_search'] ?: 'لا يوجد') . "\n\n";
        $message .= "تم تنفيذ الصيانة بنجاح في: " . date('Y-m-d H:i:s');
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * إعداد نظام الإشعارات المحسن
     */
    private function setup_notification_system() {
        // تحميل نظام الإشعارات
        add_action('wp_ajax_dismiss_notification', array($this, 'dismiss_notification'));
        add_action('wp_ajax_nopriv_dismiss_notification', array($this, 'dismiss_notification'));
        
        // إضافة إشعارات في لوحة التحكم
        add_action('admin_notices', array($this, 'show_admin_notifications'));
        
        // إشعارات المستخدمين في الواجهة الأمامية
        add_action('wp_footer', array($this, 'show_frontend_notifications'));
    }
    
    /**
     * إظهار الإشعارات في لوحة التحكم
     */
    public function show_admin_notifications() {
        if (!current_user_can('manage_options')) return;
        
        // فحص التحديثات المطلوبة
        $this->check_theme_updates();
        
        // فحص مشاكل الأداء
        $this->check_performance_issues();
        
        // فحص مشاكل الأمان
        $this->check_security_issues();
    }
    
    /**
     * فحص تحديثات القالب
     */
    private function check_theme_updates() {
        $last_check = get_option('muhtawaa_last_update_check', 0);
        $current_time = time();
        
        // فحص مرة واحدة يومياً
        if (($current_time - $last_check) > DAY_IN_SECONDS) {
            // هنا يمكن إضافة منطق فحص التحديثات من خادم خارجي
            update_option('muhtawaa_last_update_check', $current_time);
        }
    }
    
    /**
     * فحص مشاكل الأداء
     */
    private function check_performance_issues() {
        global $wpdb;
        
        // فحص حجم قاعدة البيانات
        $db_size = $wpdb->get_var("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS 'DB Size in MB' FROM information_schema.tables WHERE table_schema='{$wpdb->dbname}'");
        
        if ($db_size > 500) { // أكثر من 500 ميجا
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>تحذير:</strong> حجم قاعدة البيانات كبير (' . $db_size . ' ميجا). يُنصح بتنظيف البيانات القديمة.</p>
            </div>';
        }
        
        // فحص عدد المراجعات
        $revisions_count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'revision'");
        
        if ($revisions_count > 1000) {
            echo '<div class="notice notice-info is-dismissible">
                <p><strong>تحسين:</strong> يوجد ' . $revisions_count . ' مراجعة. يمكن حذف القديمة منها لتحسين الأداء.</p>
            </div>';
        }
    }
    
    /**
     * فحص مشاكل الأمان
     */
    private function check_security_issues() {
        // فحص إعدادات الأمان الأساسية
        if (get_option('users_can_register')) {
            echo '<div class="notice notice-error is-dismissible">
                <p><strong>تحذير أمني:</strong> التسجيل مفتوح للجميع. يُنصح بإغلاقه إذا لم يكن ضرورياً.</p>
            </div>';
        }
        
        // فحص قوة كلمات المرور
        $weak_users = get_users(array(
            'meta_query' => array(
                array(
                    'key' => 'wp_user_level',
                    'value' => '10',
                    'compare' => '='
                )
            )
        ));
        
        foreach ($weak_users as $user) {
            if (strlen($user->user_pass) < 12) {
                echo '<div class="notice notice-warning is-dismissible">
                    <p><strong>تحذير أمني:</strong> يُنصح المديرين باستخدام كلمات مرور قوية (12 حرف على الأقل).</p>
                </div>';
                break;
            }
        }
    }
    
    /**
     * إظهار الإشعارات في الواجهة الأمامية
     */
    public function show_frontend_notifications() {
        if (is_admin()) return;
        
        $notifications = $this->get_active_notifications();
        
        if (!empty($notifications)) {
            echo '<div id="muhtawaa-notifications">';
            foreach ($notifications as $notification) {
                echo '<div class="muhtawaa-notification notification-' . $notification['type'] . '" data-id="' . $notification['id'] . '">';
                echo '<span class="notification-message">' . $notification['message'] . '</span>';
                echo '<button class="notification-close" data-id="' . $notification['id'] . '">&times;</button>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
    
    /**
     * الحصول على الإشعارات النشطة
     */
    private function get_active_notifications() {
        // يمكن تخصيص هذه الدالة لجلب الإشعارات من قاعدة البيانات
        $notifications = array();
        
        // إشعار ترحيب للزوار الجدد
        if (!isset($_COOKIE['muhtawaa_visited'])) {
            $notifications[] = array(
                'id' => 'welcome',
                'type' => 'info',
                'message' => 'مرحباً بك في موقع محتوى! اكتشف آلاف الحلول العملية للمشاكل اليومية.'
            );
        }
        
        // إشعار النشرة البريدية
        if (!isset($_COOKIE['muhtawaa_newsletter_prompted'])) {
            $notifications[] = array(
                'id' => 'newsletter',
                'type' => 'success',
                'message' => 'اشترك في نشرتنا البريدية واحصل على حل عملي جديد كل يوم! 📧'
            );
        }
        
        return $notifications;
    }
    
    /**
     * رفض الإشعار
     */
    public function dismiss_notification() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_die('غير مصرح');
        }
        
        $notification_id = sanitize_text_field($_POST['notification_id'] ?? '');
        
        if ($notification_id) {
            // حفظ في الكوكيز لمدة شهر
            setcookie('muhtawaa_notification_' . $notification_id . '_dismissed', '1', time() + (30 * DAY_IN_SECONDS), '/');
            wp_send_json_success('تم رفض الإشعار');
        }
        
        wp_send_json_error('معرف الإشعار مطلوب');
    }
    
    /**
     * تحميل التوصيات الذكية
     */
    public function load_smart_recommendations() {
        if (!is_single() || !$this->get_theme_setting('enable_smart_recommendations')) {
            return;
        }
        
        $post_id = get_the_ID();
        $recommendations = $this->get_smart_recommendations($post_id);
        
        if (!empty($recommendations)) {
            echo '<div id="smart-recommendations" style="display: none;">';
            echo json_encode($recommendations);
            echo '</div>';
        }
    }
    
    /**
     * الحصول على التوصيات الذكية
     */
    private function get_smart_recommendations($post_id) {
        global $wpdb;
        
        $cache_key = "smart_recommendations_$post_id";
        $recommendations = wp_cache_get($cache_key);
        
        if ($recommendations === false) {
            // خوارزمية التوصيات الذكية
            $current_post = get_post($post_id);
            $categories = wp_get_post_categories($post_id);
            $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
            
            $recommended_posts = array();
            
            // 1. مقالات من نفس الفئة
            if (!empty($categories)) {
                $category_posts = get_posts(array(
                    'category__in' => $categories,
                    'post__not_in' => array($post_id),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));
                
                foreach ($category_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'category',
                        'score' => 0.8
                    );
                }
            }
            
            // 2. مقالات بنفس الكلمات المفتاحية
            if (!empty($tags) && count($recommended_posts) < 5) {
                $tag_posts = get_posts(array(
                    'tag__in' => $tags,
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 2,
                    'orderby' => 'rand'
                ));
                
                foreach ($tag_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'tags',
                        'score' => 0.6
                    );
                }
            }
            
            // 3. المقالات الأكثر شعبية
            if (count($recommended_posts) < 5) {
                $popular_posts = get_posts(array(
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 3,
                    'meta_key' => '_total_views',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ));
                
                foreach ($popular_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'popular',
                        'score' => 0.4
                    );
                }
            }
            
            // ترتيب حسب النقاط
            usort($recommended_posts, function($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            
            $recommendations = array_slice($recommended_posts, 0, 5);
            
            // حفظ في الكاش لمدة ساعة
            wp_cache_set($cache_key, $recommendations, '', HOUR_IN_SECONDS);
        }
        
        return $recommendations;
    }
    
    /**
     * تحسين الأمان
     */
    private function enhance_security() {
        // إخفاء إصدار ووردبريس
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // منع تعداد المستخدمين
        add_action('wp', function() {
            if (is_author() && !is_user_logged_in()) {
                wp_redirect(home_url());
                exit;
            }
        });
        
        // حماية ملف wp-config
        add_action('init', function() {
            if (strpos($_SERVER['REQUEST_URI'], 'wp-config.php') !== false) {
                wp_die('Access denied');
            }
        });
        
        // إضافة headers أمنية
        add_action('send_headers', function() {
            header('X-Frame-Options: SAMEORIGIN');
            header('X-Content-Type-Options: nosniff');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
        });
        
        // تحديد محاولات تسجيل الدخول
        add_action('wp_login_failed', array($this, 'handle_failed_login'));
        add_filter('authenticate', array($this, 'check_login_attempts'), 30, 3);
    }
    
    /**
     * معالجة فشل تسجيل الدخول
     */
    public function handle_failed_login($username) {
        $ip = $this->get_user_ip();
        $attempts = get_transient("login_attempts_$ip") ?: 0;
        $attempts++;
        
        set_transient("login_attempts_$ip", $attempts, 15 * MINUTE_IN_SECONDS);
        
        if ($attempts >= 5) {
            set_transient("login_blocked_$ip", true, HOUR_IN_SECONDS);
        }
    }
    
    /**
     * فحص محاولات تسجيل الدخول
     */
    public function check_login_attempts($user, $username, $password) {
        $ip = $this->get_user_ip();
        
        if (get_transient("login_blocked_$ip")) {
            return new WP_Error('login_blocked', 'تم حظر عنوان IP الخاص بك مؤقتاً بسبب المحاولات المتكررة.');
        }
        
        return $user;
    }
    
    /**
     * تحسين الأداء
     */
    private function enhance_performance() {
        // ضغط الـ HTML
        if (!is_admin()) {
            ob_start(array($this, 'compress_html'));
        }
        
        // تحسين قاعدة البيانات
        add_action('wp_footer', array($this, 'optimize_database_queries'));
        
        // تأجيل تحميل JavaScript غير الأساسي
        add_filter('script_loader_tag', array($this, 'defer_non_critical_scripts'), 10, 2);
        
        // تحسين الصور
        add_filter('wp_get_attachment_image_attributes', array($this, 'add_lazy_loading'), 10, 2);
        
        // تمكين Gzip
        if (!ob_get_level()) {
            ob_start('ob_gzhandler');
        }
    }
    
    /**
     * ضغط HTML
     */
    public function compress_html($html) {
        // إزالة المسافات الزائدة والتعليقات
        $html = preg_replace('/<!--(.*)-->/Uis', '', $html);
        $html = preg_replace('/\>[^\S ]+/s', '>', $html);
        $html = preg_replace('/[^\S ]+\</s', '<', $html);
        $html = preg_replace('/(\s)+/s', '\\1', $html);
        
        return $html;
    }
    
    /**
     * تأجيل السكريبت غير الأساسية
     */
    public function defer_non_critical_scripts($tag, $handle) {
        $defer_scripts = array('muhtawaa-enhanced', 'muhtawaa-lazyload');
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إضافة lazy loading للصور
     */
    public function add_lazy_loading($attr, $attachment) {
        if (!is_admin()) {
            $attr['loading'] = 'lazy';
        }
        
        return $attr;
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public function optimize_database_queries() {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $queries_count = get_num_queries();
            $memory_usage = size_format(memory_get_peak_usage(true));
            
            echo "<!-- WordPress Queries: $queries_count | Memory: $memory_usage -->";
        }
    }
    
    /**
     * إعداد المخصص (Customizer)
     */
    public function customize_register($wp_customize) {
        // قسم إعدادات القالب
        $wp_customize->add_section('muhtawaa_theme_settings', array(
            'title' => __('إعدادات القالب', 'muhtawaa'),
            'priority' => 30,
        ));
        
        // الألوان الأساسية
        $wp_customize->add_setting('muhtawaa_primary_color', array(
            'default' => '#667eea',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_primary_color', array(
            'label' => __('اللون الأساسي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        $wp_customize->add_setting('muhtawaa_secondary_color', array(
            'default' => '#764ba2',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_secondary_color', array(
            'label' => __('اللون الثانوي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        // إعدادات التوصيات
        $wp_customize->add_setting('muhtawaa_enable_recommendations', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_recommendations', array(
            'label' => __('تمكين التوصيات الذكية', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // إعدادات البحث المتقدم
        $wp_customize->add_setting('muhtawaa_enable_advanced_search', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_advanced_search', array(
            'label' => __('تمكين البحث المتقدم', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // نص تذييل مخصص
        $wp_customize->add_setting('muhtawaa_footer_text', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_text', array(
            'label' => __('نص التذييل المخصص', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'text',
        ));
        
        // روابط وسائل التواصل
        $social_networks = array(
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر', 
            'instagram' => 'انستغرام',
            'youtube' => 'يوتيوب',
            'linkedin' => 'لينكد إن',
            'telegram' => 'تليجرام'
        );
        
        foreach ($social_networks as $network => $label) {
            $wp_customize->add_setting("muhtawaa_social_$network", array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            
            $wp_customize->add_control("muhtawaa_social_$network", array(
                'label' => $label,
                'section' => 'muhtawaa_theme_settings',
                'type' => 'url',
            ));
        }
    }
    
    /**
     * إضافة meta tags محسنة
     */
    public function add_meta_tags() {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        echo '<meta name="theme-color" content="' . get_theme_mod('muhtawaa_primary_color', '#667eea') . '">' . "\n";
        
        if (is_singular()) {
            $description = wp_trim_words(get_the_excerpt(), 25);
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
            
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
            }
        }
    }
    
    /**
     * دوال مساعدة لإدارة إعدادات القالب
     */
    public function get_theme_setting($key, $default = '') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $value = $wpdb->get_var($wpdb->prepare(
            "SELECT setting_value FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        return $value !== null ? $value : $default;
    }
    
    public function update_theme_setting($key, $value, $type = 'string') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        
        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        if ($existing) {
            $wpdb->update(
                $settings_table,
                array(
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'updated_at' => current_time('mysql')
                ),
                array('setting_key' => $key),
                array('%s', '%s', '%s'),
                array('%s')
            );
        } else {
            $wpdb->insert(
                $settings_table,
                array(
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'created_at' => current_time('mysql')
                ),
                array('%s', '%s', '%s', '%s')
            );
        }
    }
    
    public function get_theme_settings() {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $results = $wpdb->get_results("SELECT setting_key, setting_value FROM $settings_table WHERE autoload = 'yes'", ARRAY_A);
        
        $settings = array();
        foreach ($results as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        
        return $settings;
    }
}

// تهيئة القالب
MuhtawaaTheme::getInstance();

// دوال مساعدة عامة
if (!function_exists('muhtawaa_get_category_icon')) {
    function muhtawaa_get_category_icon($category_name) {
        $icons = array(
            'المنزل والتنظيف' => '🏠',
            'المطبخ والطبخ' => '🍳',
            'توفير المال' => '💰',
            'السيارات' => '🚗',
            'التكنولوجيا' => '📱',
            'الطقس والمناخ' => '🌡️',
            'الصحة والجمال' => '💄',
            'الحديقة والزراعة' => '🌱',
            'الأطفال والعائلة' => '👶',
            'التعليم والدراسة' => '📚'
        );
        
        return isset($icons[$category_name]) ? $icons[$category_name] : '💡';
    }
}

if (!function_exists('muhtawaa_get_difficulty_color')) {
    function muhtawaa_get_difficulty_color($difficulty) {
        $colors = array(
            'سهل جداً' => '#4caf50',
            'سهل' => '#8bc34a',
            'متوسط' => '#ff9800',
            'صعب' => '#f44336',
            'خبير' => '#9c27b0'
        );
        
        return isset($colors[$difficulty]) ? $colors[$difficulty] : '#666';
    }
}

if (!function_exists('muhtawaa_get_social_links')) {
    function muhtawaa_get_social_links() {
        $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'telegram');
        $links = array();
        
        foreach ($social_networks as $network) {
            $url = get_theme_mod("muhtawaa_social_$network", '');
            if (!empty($url)) {
                $links[$network] = $url;
            }
        }
        
        return $links;
    }
}

if (!function_exists('muhtawaa_breadcrumbs')) {
    function muhtawaa_breadcrumbs() {
        if (is_front_page()) return;
        
        echo '<nav class="breadcrumbs" role="navigation" aria-label="مسار التنقل">';
        echo '<div class="container">';
        echo '<ol class="breadcrumb-list">';
        echo '<li><a href="' . home_url() . '">🏠 الرئيسية</a></li>';
        
        if (is_category() || is_single()) {
            if (is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                }
                echo '<li><span>' . get_the_title() . '</span></li>';
            } elseif (is_category()) {
                echo '<li><span>' . single_cat_title('', false) . '</span></li>';
            }
        } elseif (is_page()) {
            $ancestors = get_post_ancestors(get_the_ID());
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
            echo '<li><span>' . get_the_title() . '</span></li>';
        } elseif (is_search()) {
            echo '<li><span>نتائج البحث عن: "' . get_search_query() . '"</span></li>';
        } elseif (is_tag()) {
            echo '<li><span>كلمة مفتاحية: ' . single_tag_title('', false) . '</span></li>';
        } elseif (is_archive()) {
            echo '<li><span>' . get_the_archive_title() . '</span></li>';
        }
        
        echo '</ol>';
        echo '</div>';
        echo '</nav>';
    }
}

// إضافة حقول مخصصة للمقالات
add_action('add_meta_boxes', 'muhtawaa_add_solution_meta_boxes');
function muhtawaa_add_solution_meta_boxes() {
    add_meta_box(
        'solution_details',
        __('تفاصيل الحل المحسنة', 'muhtawaa'),
        'muhtawaa_solution_details_callback',
        'post',
        'normal',
        'high'
    );
    
    add_meta_box(
        'solution_seo',
        __('تحسين محركات البحث', 'muhtawaa'),
        'muhtawaa_solution_seo_callback',
        'post',
        'side',
        'default'
    );
}

function muhtawaa_solution_details_callback($post) {
    wp_nonce_field('muhtawaa_save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, '_solution_difficulty', true);
    $time_needed = get_post_meta($post->ID, '_solution_time', true);
    $materials = get_post_meta($post->ID, '_solution_materials', true);
    $cost = get_post_meta($post->ID, '_solution_cost', true);
    $tools = get_post_meta($post->ID, '_solution_tools', true);
    $safety_notes = get_post_meta($post->ID, '_solution_safety', true);
    $season = get_post_meta($post->ID, '_solution_season', true);
    $target_audience = get_post_meta($post->ID, '_solution_audience', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="solution_difficulty">مستوى الصعوبة</label></th>
            <td>
                <select name="solution_difficulty" id="solution_difficulty" style="width: 200px;">
                    <option value="">اختر المستوى</option>
                    <option value="سهل جداً" <?php selected($difficulty, 'سهل جداً'); ?>>سهل جداً ⭐</option>
                    <option value="سهل" <?php selected($difficulty, 'سهل'); ?>>سهل ⭐⭐</option>
                    <option value="متوسط" <?php selected($difficulty, 'متوسط'); ?>>متوسط ⭐⭐⭐</option>
                    <option value="صعب" <?php selected($difficulty, 'صعب'); ?>>صعب ⭐⭐⭐⭐</option>
                    <option value="خبير" <?php selected($difficulty, 'خبير'); ?>>خبير ⭐⭐⭐⭐⭐</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_time">الوقت المطلوب</label></th>
            <td><input type="text" name="solution_time" id="solution_time" value="<?php echo esc_attr($time_needed); ?>" placeholder="مثال: 5 دقائق، ساعة واحدة" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_cost">التكلفة التقريبية</label></th>
            <td><input type="text" name="solution_cost" id="solution_cost" value="<?php echo esc_attr($cost); ?>" placeholder="مثال: مجاني، 10 ريال، أقل من 50 ريال" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_season">الموسم المناسب</label></th>
            <td>
                <select name="solution_season" id="solution_season" style="width: 200px;">
                    <option value="">طوال السنة</option>
                    <option value="الصيف" <?php selected($season, 'الصيف'); ?>>الصيف ☀️</option>
                    <option value="الشتاء" <?php selected($season, 'الشتاء'); ?>>الشتاء ❄️</option>
                    <option value="الربيع" <?php selected($season, 'الربيع'); ?>>الربيع 🌸</option>
                    <option value="الخريف" <?php selected($season, 'الخريف'); ?>>الخريف 🍂</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_audience">الفئة المستهدفة</label></th>
            <td>
                <select name="solution_audience" id="solution_audience" style="width: 200px;">
                    <option value="">الجميع</option>
                    <option value="المبتدئين" <?php selected($target_audience, 'المبتدئين'); ?>>المبتدئين</option>
                    <option value="الأمهات" <?php selected($target_audience, 'الأمهات'); ?>>الأمهات</option>
                    <option value="الآباء" <?php selected($target_audience, 'الآباء'); ?>>الآباء</option>
                    <option value="الطلاب" <?php selected($target_audience, 'الطلاب'); ?>>الطلاب</option>
                    <option value="كبار السن" <?php selected($target_audience, 'كبار السن'); ?>>كبار السن</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_materials">المواد المطلوبة</label></th>
            <td>
                <textarea name="solution_materials" id="solution_materials" rows="4" cols="60" placeholder="اذكر المواد المطلوبة، كل مادة في سطر جديد"><?php echo esc_textarea($materials); ?></textarea>
                <p class="description">مثال: ملح، خل أبيض، ليمونة، قطعة قماش</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_tools">الأدوات المطلوبة</label></th>
            <td>
                <textarea name="solution_tools" id="solution_tools" rows="3" cols="60" placeholder="اذكر الأدوات المطلوبة، كل أداة في سطر جديد"><?php echo esc_textarea($tools); ?></textarea>
                <p class="description">مثال: مكنسة كهربائية، مفك براغي، وعاء خلط</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_safety">ملاحظات السلامة</label></th>
            <td>
                <textarea name="solution_safety" id="solution_safety" rows="3" cols="60" placeholder="ملاحظات مهمة للسلامة (اختياري)"><?php echo esc_textarea($safety_notes); ?></textarea>
                <p class="description">مثال: استخدم القفازات، تأكد من إغلاق الكهرباء، احذر من الأسطح الساخنة</p>
            </td>
        </tr>
    </table>
    
    <style>
    .form-table th {
        width: 150px;
        vertical-align: top;
        padding-top: 10px;
    }
    
    .form-table td {
        padding: 8px 10px;
    }
    
    .form-table input[type="text"],
    .form-table select,
    .form-table textarea {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px;
    }
    
    .form-table textarea {
        font-family: inherit;
    }
    
    .form-table .description {
        font-style: italic;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_solution_seo_callback($post) {
    $focus_keyword = get_post_meta($post->ID, '_focus_keyword', true);
    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    $social_title = get_post_meta($post->ID, '_social_title', true);
    $social_description = get_post_meta($post->ID, '_social_description', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="focus_keyword">الكلمة المفتاحية الرئيسية</label></th>
            <td><input type="text" name="focus_keyword" id="focus_keyword" value="<?php echo esc_attr($focus_keyword); ?>" style="width: 100%;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="meta_description">وصف meta</label></th>
            <td>
                <textarea name="meta_description" id="meta_description" rows="3" style="width: 100%;" maxlength="160" placeholder="وصف مختصر للمقال (160 حرف كحد أقصى)"><?php echo esc_textarea($meta_description); ?></textarea>
                <p class="description"><span id="meta-count">0</span>/160 حرف</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_title">عنوان وسائل التواصل</label></th>
            <td><input type="text" name="social_title" id="social_title" value="<?php echo esc_attr($social_title); ?>" style="width: 100%;" placeholder="عنوان مخصص للمشاركة على وسائل التواصل" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_description">وصف وسائل التواصل</label></th>
            <td>
                <textarea name="social_description" id="social_description" rows="3" style="width: 100%;" placeholder="وصف مخصص للمشاركة على وسائل التواصل"><?php echo esc_textarea($social_description); ?></textarea>
            </td>
        </tr>
    </table>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const metaDescription = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        
        function updateMetaCount() {
            const count = metaDescription.value.length;
            metaCount.textContent = count;
            metaCount.style.color = count > 160 ? 'red' : (count > 140 ? 'orange' : 'green');
        }
        
        metaDescription.addEventListener('input', updateMetaCount);
        updateMetaCount(); // تحديث أولي
    });
    </script>
    <?php
}

// حفظ البيانات المخصصة المحسنة
add_action('save_post', 'muhtawaa_save_solution_details');
function muhtawaa_save_solution_details($post_id) {
    if (!isset($_POST['solution_details_nonce']) || !wp_verify_nonce($_POST['solution_details_nonce'], 'muhtawaa_save_solution_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'solution_difficulty', 'solution_time', 'solution_cost',
        'solution_materials', 'solution_tools', 'solution_safety',
        'solution_season', 'solution_audience',
        'focus_keyword', 'meta_description', 'social_title', 'social_description'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            
            if (in_array($field, array('solution_materials', 'solution_tools', 'solution_safety', 'meta_description', 'social_description'))) {
                $value = sanitize_textarea_field($value);
            } else {
                $value = sanitize_text_field($value);
            }
            
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
    
    // تحديث تاريخ آخر تعديل للحل
    update_post_meta($post_id, '_solution_last_updated', current_time('mysql'));
}

// نظام الاستيراد والتصدير
class MuhtawaaImportExport {
    
    public static function export_solutions($format = 'json') {
        if (!current_user_can('manage_options')) {
            wp_die('غير مصرح');
        }
        
        $solutions = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ));
        
        $export_data = array();
        
        foreach ($solutions as $solution) {
            $meta_data = get_post_meta($solution->ID);
            $categories = wp_get_post_categories($solution->ID, array('fields' => 'names'));
            $tags = wp_get_post_tags($solution->ID, array('fields' => 'names'));
            
            $export_data[] = array(
                'title' => $solution->post_title,
                'content' => $solution->post_content,
                'excerpt' => $solution->post_excerpt,
                'date' => $solution->post_date,
                'categories' => $categories,
                'tags' => $tags,
                'meta' => array(
                    'difficulty' => $meta_data['_solution_difficulty'][0] ?? '',
                    'time' => $meta_data['_solution_time'][0] ?? '',
                    'cost' => $meta_data['_solution_cost'][0] ?? '',
                    'materials' => $meta_data['_solution_materials'][0] ?? '',
                    'tools' => $meta_data['_solution_tools'][0] ?? '',
                    'safety' => $meta_data['_solution_safety'][0] ?? '',
                    'season' => $meta_data['_solution_season'][0] ?? '',
                    'audience' => $meta_data['_solution_audience'][0] ?? '',
                )
            );
        }
        
        if ($format === 'json') {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.json"');
            echo json_encode($export_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } elseif ($format === 'csv') {
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.csv"');
            
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM
            
            // Headers
            fputcsv($output, array('العنوان', 'المحتوى', 'الملخص', 'التاريخ', 'الفئات', 'الكلمات المفتاحية', 'الصعوبة', 'الوقت', 'التكلفة'));
            
            foreach ($export_data as $row) {
                fputcsv($output, array(
                    $row['title'],
                    strip_tags($row['content']),
                    $row['excerpt'],
                    $row['date'],
                    implode(', ', $row['categories']),
                    implode(', ', $row['tags']),
                    $row['meta']['difficulty'],
                    $row['meta']['time'],
                    $row['meta']['cost']
                ));
            }
            
            fclose($output);
        }
        
        exit;
    }
    
    public static function import_solutions($file_path) {
        if (!current_user_can('manage_options')) {
            return new WP_Error('permission_denied', 'غير مصرح');
        }
        
        if (!file_exists($file_path)) {
            return new WP_Error('file_not_found', 'الملف غير موجود');
        }
        
        $file_content = file_get_contents($file_path);
        $data = json_decode($file_content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('invalid_json', 'ملف JSON غير صحيح');
        }
        
        $imported_count = 0;
        $errors = array();
        
        foreach ($data as $solution_data) {
            $post_data = array(
                'post_title' => sanitize_text_field($solution_data['title']),
                'post_content' => wp_kses_post($solution_data['content']),
                'post_excerpt' => sanitize_textarea_field($solution_data['excerpt']),
                'post_status' => 'draft', // استيراد كمسودة للمراجعة
                'post_type' => 'post'
            );
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                $errors[] = 'فشل في استيراد: ' . $solution_data['title'];
                continue;
            }
            
            // إضافة الفئات
            if (!empty($solution_data['categories'])) {
                wp_set_post_categories($post_id, $solution_data['categories']);
            }
            
            // إضافة الكلمات المفتاحية
            if (!empty($solution_data['tags'])) {
                wp_set_post_tags($post_id, implode(', ', $solution_data['tags']));
            }
            
            // إضافة البيانات المخصصة
            if (!empty($solution_data['meta'])) {
                foreach ($solution_data['meta'] as $key => $value) {
                    update_post_meta($post_id, '_solution_' . $key, sanitize_text_field($value));
                }
            }
            
            $imported_count++;
        }
        
        return array(
            'imported' => $imported_count,
            'errors' => $errors
        );
    }
}

// إضافة صفحة إدارة في لوحة التحكم
add_action('admin_menu', 'muhtawaa_admin_menu');
function muhtawaa_admin_menu() {
    add_menu_page(
        __('إدارة محتوى', 'muhtawaa'),
        __('محتوى', 'muhtawaa'),
        'manage_options',
        'muhtawaa-admin',
        'muhtawaa_admin_page',
        'dashicons-lightbulb',
        30
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('إعدادات القالب', 'muhtawaa'),
        __('الإعدادات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-settings',
        'muhtawaa_settings_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الإحصائيات', 'muhtawaa'),
        __('الإحصائيات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-stats',
        'muhtawaa_stats_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الاستيراد والتصدير', 'muhtawaa'),
        __('استيراد/تصدير', 'muhtawaa'),
        'manage_options',
        'muhtawaa-import-export',
        'muhtawaa_import_export_page'
    );
}

function muhtawaa_admin_page() {
    ?>
    <div class="wrap">
        <h1>لوحة تحكم قالب محتوى</h1>
        
        <div class="muhtawaa-dashboard">
            <div class="dashboard-widgets">
                <?php muhtawaa_dashboard_stats_widget(); ?>
                <?php muhtawaa_dashboard_recent_activity(); ?>
                <?php muhtawaa_dashboard_quick_actions(); ?>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-dashboard {
        margin-top: 20px;
    }
    
    .dashboard-widgets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .dashboard-widget {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .dashboard-widget h3 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 15px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }
    
    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #667eea;
        display: block;
    }
    
    .stat-label {
        font-size: 0.9em;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_dashboard_stats_widget() {
    global $wpdb;
    
    $stats = array(
        'total_posts' => wp_count_posts()->publish,
        'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'")
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>📊 الإحصائيات العامة</h3>
        <div class="stat-grid">
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_posts']); ?></span>
                <span class="stat-label">حل منشور</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_subscribers']); ?></span>
                <span class="stat-label">مشترك</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['searches_today']); ?></span>
                <span class="stat-label">بحث اليوم</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></span>
                <span class="stat-label">إجمالي المشاهدات</span>
            </div>
        </div>
    </div>
    <?php
}

function muhtawaa_dashboard_recent_activity() {
    global $wpdb;
    
    $recent_searches = $wpdb->get_results(
        "SELECT search_term, COUNT(*) as count 
         FROM {$wpdb->prefix}muhtawaa_searches 
         WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
         GROUP BY search_term 
         ORDER BY count DESC 
         LIMIT 5"
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>🔍 أشهر البحثات هذا الأسبوع</h3>
        <?php if (!empty($recent_searches)): ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($recent_searches as $search): ?>
                    <li style="display: fle
					x; justify-content: space-between; padding:
					<li style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee;">
                        <span><?php echo esc_html($search->search_term); ?></span>
                        <span style="background: #667eea; color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.8em;">
                            <?php echo $search->count; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: #666; text-align: center; margin: 20px 0;">لا توجد بحثات هذا الأسبوع</p>
        <?php endif; ?>
    </div>
    <?php
}

function muhtawaa_dashboard_quick_actions() {
    ?>
    <div class="dashboard-widget">
        <h3>⚡ إجراءات سريعة</h3>
        <div style="display: grid; gap: 10px;">
            <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-primary" style="text-align: center;">
                ➕ إضافة حل جديد
            </a>
            <a href="<?php echo admin_url('edit-tags.php?taxonomy=solution_category'); ?>" class="button" style="text-align: center;">
                🗂️ إدارة الفئات
            </a>
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-stats'); ?>" class="button" style="text-align: center;">
                📈 عرض الإحصائيات التفصيلية
            </a>
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-import-export'); ?>" class="button" style="text-align: center;">
                📤 استيراد/تصدير البيانات
            </a>
        </div>
        
        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
            <h4>🔧 صيانة سريعة</h4>
            <button onclick="performMaintenance()" class="button" style="width: 100%;">
                تشغيل الصيانة الآن
            </button>
            <button onclick="createBackup()" class="button" style="width: 100%; margin-top: 5px;">
                إنشاء نسخة احتياطية
            </button>
        </div>
    </div>
    
    <script>
    function performMaintenance() {
        if (confirm('هل تريد تشغيل الصيانة الآن؟ قد يستغرق هذا بضع دقائق.')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_maintenance',
                nonce: '<?php echo wp_create_nonce('muhtawaa_maintenance'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تمت الصيانة بنجاح!');
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    
    function createBackup() {
        if (confirm('هل تريد إنشاء نسخة احتياطية؟')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_backup',
                nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تم إنشاء النسخة الاحتياطية بنجاح!');
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    </script>
    <?php
}

// صفحة الإعدادات
function muhtawaa_settings_page() {
    if (isset($_POST['submit'])) {
        $theme = MuhtawaaTheme::getInstance();
        
        $settings = array(
            'theme_color_primary' => sanitize_hex_color($_POST['primary_color']),
            'theme_color_secondary' => sanitize_hex_color($_POST['secondary_color']),
            'enable_smart_recommendations' => isset($_POST['enable_recommendations']) ? 'yes' : 'no',
            'enable_advanced_search' => isset($_POST['enable_search']) ? 'yes' : 'no',
            'enable_rating_system' => isset($_POST['enable_rating']) ? 'yes' : 'no',
            'notification_email' => sanitize_email($_POST['notification_email']),
            'max_recommendations' => intval($_POST['max_recommendations']),
            'search_suggestions_count' => intval($_POST['search_suggestions']),
            'auto_backup_enabled' => isset($_POST['auto_backup']) ? 'yes' : 'no',
            'auto_backup_frequency' => sanitize_text_field($_POST['backup_frequency']),
        );
        
        foreach ($settings as $key => $value) {
            $theme->update_theme_setting($key, $value);
        }
        
        echo '<div class="notice notice-success"><p>تم حفظ الإعدادات بنجاح!</p></div>';
    }
    
    $theme = MuhtawaaTheme::getInstance();
    ?>
    
    <div class="wrap">
        <h1>إعدادات قالب محتوى</h1>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">اللون الأساسي</th>
                    <td>
                        <input type="color" name="primary_color" value="<?php echo esc_attr($theme->get_theme_setting('theme_color_primary', '#667eea')); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">اللون الثانوي</th>
                    <td>
                        <input type="color" name="secondary_color" value="<?php echo esc_attr($theme->get_theme_setting('theme_color_secondary', '#764ba2')); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">التوصيات الذكية</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_recommendations" <?php checked($theme->get_theme_setting('enable_smart_recommendations'), 'yes'); ?> />
                            تمكين نظام التوصيات الذكية
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">البحث المتقدم</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_search" <?php checked($theme->get_theme_setting('enable_advanced_search'), 'yes'); ?> />
                            تمكين البحث المتقدم في الحقول المخصصة
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">نظام التقييم</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_rating" <?php checked($theme->get_theme_setting('enable_rating_system'), 'yes'); ?> />
                            تمكين نظام تقييم الحلول
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">بريد الإشعارات</th>
                    <td>
                        <input type="email" name="notification_email" value="<?php echo esc_attr($theme->get_theme_setting('notification_email', get_option('admin_email'))); ?>" class="regular-text" />
                        <p class="description">البريد الذي ستُرسل إليه إشعارات النظام</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">عدد التوصيات</th>
                    <td>
                        <input type="number" name="max_recommendations" value="<?php echo esc_attr($theme->get_theme_setting('max_recommendations', '5')); ?>" min="3" max="10" />
                        <p class="description">الحد الأقصى لعدد التوصيات المعروضة</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">اقتراحات البحث</th>
                    <td>
                        <input type="number" name="search_suggestions" value="<?php echo esc_attr($theme->get_theme_setting('search_suggestions_count', '8')); ?>" min="5" max="15" />
                        <p class="description">عدد اقتراحات البحث المعروضة</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">النسخ الاحتياطية التلقائية</th>
                    <td>
                        <label>
                            <input type="checkbox" name="auto_backup" <?php checked($theme->get_theme_setting('auto_backup_enabled'), 'yes'); ?> />
                            تمكين النسخ الاحتياطية التلقائية
                        </label>
                        <br><br>
                        <select name="backup_frequency">
                            <option value="daily" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'daily'); ?>>يومياً</option>
                            <option value="weekly" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'weekly'); ?>>أسبوعياً</option>
                            <option value="monthly" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'monthly'); ?>>شهرياً</option>
                        </select>
                    </td>
                </tr>
            </table>
            
            <?php submit_button('حفظ الإعدادات'); ?>
        </form>
    </div>
    <?php
}

// صفحة الإحصائيات
function muhtawaa_stats_page() {
    global $wpdb;
    
    // الحصول على الإحصائيات
    $stats = array(
        'posts' => wp_count_posts()->publish,
        'categories' => wp_count_terms('solution_category'),
        'subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'searches_week' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)"),
    );
    
    // أشهر الحلول
    $top_solutions = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm.meta_value as views
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_total_views'
        WHERE p.post_status = 'publish' AND p.post_type = 'post'
        ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
        LIMIT 10
    ");
    
    // أشهر البحثات
    $top_searches = $wpdb->get_results("
        SELECT search_term, COUNT(*) as count
        FROM {$wpdb->prefix}muhtawaa_searches
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY search_term
        ORDER BY count DESC
        LIMIT 10
    ");
    ?>
    
    <div class="wrap">
        <h1>إحصائيات مفصلة</h1>
        
        <div class="muhtawaa-stats-dashboard">
            <!-- إحصائيات عامة -->
            <div class="stats-section">
                <h2>📊 الإحصائيات العامة</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['posts']); ?></div>
                        <div class="stat-label">حل منشور</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['categories']); ?></div>
                        <div class="stat-label">فئة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['subscribers']); ?></div>
                        <div class="stat-label">مشترك</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></div>
                        <div class="stat-label">إجمالي المشاهدات</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['searches_today']); ?></div>
                        <div class="stat-label">بحث اليوم</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['searches_week']); ?></div>
                        <div class="stat-label">بحث هذا الأسبوع</div>
                    </div>
                </div>
            </div>
            
            <!-- أشهر الحلول -->
            <div class="stats-section">
                <h2>🔥 أشهر الحلول</h2>
                <div class="top-list">
                    <?php if (!empty($top_solutions)): ?>
                        <?php foreach ($top_solutions as $index => $solution): ?>
                            <div class="top-item">
                                <span class="rank">#<?php echo $index + 1; ?></span>
                                <span class="title">
                                    <a href="<?php echo get_edit_post_link($solution->ID); ?>" target="_blank">
                                        <?php echo esc_html($solution->post_title); ?>
                                    </a>
                                </span>
                                <span class="count"><?php echo number_format($solution->views ?: 0); ?> مشاهدة</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>لا توجد بيانات مشاهدات بعد</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- أشهر البحثات -->
            <div class="stats-section">
                <h2>🔍 أشهر البحثات (آخر 30 يوم)</h2>
                <div class="top-list">
                    <?php if (!empty($top_searches)): ?>
                        <?php foreach ($top_searches as $index => $search): ?>
                            <div class="top-item">
                                <span class="rank">#<?php echo $index + 1; ?></span>
                                <span class="title"><?php echo esc_html($search->search_term); ?></span>
                                <span class="count"><?php echo number_format($search->count); ?> مرة</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>لا توجد بحثات مسجلة</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-stats-dashboard {
        margin-top: 20px;
    }
    
    .stats-section {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .stats-section h2 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .stat-card {
        text-align: center;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .stat-number {
        font-size: 2.5em;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 1.1em;
        opacity: 0.9;
    }
    
    .top-list {
        margin-top: 20px;
    }
    
    .top-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #eee;
        transition: background 0.3s;
    }
    
    .top-item:hover {
        background: #f8f9fa;
    }
    
    .top-item .rank {
        font-weight: bold;
        color: #667eea;
        width: 40px;
        flex-shrink: 0;
    }
    
    .top-item .title {
        flex: 1;
        margin: 0 15px;
    }
    
    .top-item .title a {
        text-decoration: none;
        color: #333;
    }
    
    .top-item .title a:hover {
        color: #667eea;
    }
    
    .top-item .count {
        font-weight: bold;
        color: #48bb78;
        background: #f0fff4;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }
    </style>
    <?php
}

// صفحة الاستيراد والتصدير
function muhtawaa_import_export_page() {
    if (isset($_POST['export_solutions'])) {
        $format = sanitize_text_field($_POST['export_format']);
        
    }
    
    if (isset($_POST['import_solutions']) && isset($_FILES['import_file'])) {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $_FILES['import_file']['name'];
        
        if (move_uploaded_file($_FILES['import_file']['tmp_name'], $file_path)) {
            $result = 
            
            if (is_wp_error($result)) {
                echo '<div class="notice notice-error"><p>خطأ: ' . $result->get_error_message() . '</p></div>';
            } else {
                echo '<div class="notice notice-success"><p>تم استيراد ' . $result['imported'] . ' حل بنجاح!</p></div>';
                if (!empty($result['errors'])) {
                    echo '<div class="notice notice-warning"><p>الأخطاء: ' . implode(', ', $result['errors']) . '</p></div>';
                }
            }
            
            unlink($file_path); // حذف الملف المؤقت
        }
    }
    ?>
    
    <div class="wrap">
        <h1>الاستيراد والتصدير</h1>
        
        <div class="muhtawaa-import-export">
            <!-- تصدير البيانات -->
            <div class="export-section">
                <h2>📤 تصدير الحلول</h2>
                <p>يمكنك تصدير جميع الحلول المنشورة مع بياناتها المخصصة.</p>
                
                <form method="post" style="margin-top: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">تنسيق التصدير</th>
                            <td>
                                <label>
                                    <input type="radio" name="export_format" value="json" checked />
                                    JSON (موصى به للاستيراد لاحقاً)
                                </label>
                                <br>
                                <label>
                                    
                                    CSV (لفتح في Excel أو Google Sheets)
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" name="export_solutions" class="button button-primary" value="تصدير الحلول" />
                    </p>
                </form>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- استيراد البيانات -->
            <div class="import-section">
                <h2>📥 استيراد الحلول</h2>
                <p>يمكنك استيراد حلول من ملف JSON. سيتم استيراد الحلول كمسودات للمراجعة.</p>
                
                <div class="import-instructions" style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0;">
                    <h4>تعليمات الاستيراد:</h4>
                    <ul>
                        <li>يجب أن يكون الملف بصيغة JSON</li>
                        <li>سيتم استيراد الحلول كمسودات</li>
                        <li>ستحتاج لمراجعة وموافقة على كل حل</li>
                        <li>تأكد من صحة البيانات قبل الاستيراد</li>
                    </ul>
                </div>
                
                <form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">ملف JSON</th>
                            <td>
                                <input type="file" name="import_file" accept=".json" required />
                                <p class="description">اختر ملف JSON يحتوي على بيانات الحلول</p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" name="import_solutions" class="button button-primary" value="استيراد الحلول" 
                               onclick="return confirm('هل أنت متأكد من استيراد البيانات؟ سيتم إنشاء مقالات جديدة.')" />
                    </p>
                </form>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- النسخ الاحتياطية -->
            <div class="backup-section">
                <h2>💾 النسخ الاحتياطية</h2>
                <p>يمكنك إنشاء وإدارة النسخ الاحتياطية لبيانات القالب.</p>
                
                <div style="margin: 20px 0;">
                    <button onclick="createManualBackup()" class="button button-secondary">
                        إنشاء نسخة احتياطية الآن
                    </button>
                    
                    <button onclick="listBackups()" class="button" style="margin-right: 10px;">
                        عرض النسخ الاحتياطية
                    </button>
                </div>
                
                <div id="backup-list" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-import-export {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 30px;
        margin-top: 20px;
    }
    
    .export-section h2,
    .import-section h2,
    .backup-section h2 {
        color: #667eea;
        margin-bottom: 15px;
    }
    
    .import-instructions {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 15px;
        margin: 20px 0;
    }
    
    .import-instructions h4 {
        margin-top: 0;
        color: #856404;
    }
    
    .import-instructions ul {
        margin-bottom: 0;
        color: #856404;
    }
    </style>
    
    <script>
    function createManualBackup() {
        if (confirm('هل تريد إنشاء نسخة احتياطية؟')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_backup',
                nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تم إنشاء النسخة الاحتياطية بنجاح!');
                    listBackups();
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    
    function listBackups() {
        jQuery.post(ajaxurl, {
            action: 'muhtawaa_list_backups',
            nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
        }, function(response) {
            if (response.success) {
                jQuery('#backup-list').html(response.data);
            } else {
                jQuery('#backup-list').html('<p>لا توجد نسخ احتياطية</p>');
            }
        });
    }
    </script>
    <?php
}

// إجراءات AJAX للصيانة والنسخ الاحتياطية
add_action('wp_ajax_muhtawaa_manual_maintenance', 'muhtawaa_handle_manual_maintenance');
function muhtawaa_handle_manual_maintenance() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_maintenance') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $theme = MuhtawaaTheme::getInstance();
    $theme->daily_maintenance();
    
    wp_send_json_success('تمت الصيانة بنجاح');
}

add_action('wp_ajax_muhtawaa_manual_backup', 'muhtawaa_handle_manual_backup');
function muhtawaa_handle_manual_backup() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_backup') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $theme = MuhtawaaTheme::getInstance();
    $backup_file = $theme->create_backup();
    
    if ($backup_file) {
        wp_send_json_success('تم إنشاء النسخة الاحتياطية: ' . basename($backup_file));
    } else {
        wp_send_json_error('فشل في إنشاء النسخة الاحتياطية');
    }
}

add_action('wp_ajax_muhtawaa_list_backups', 'muhtawaa_handle_list_backups');
function muhtawaa_handle_list_backups() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_backup') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $upload_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
    
    if (!file_exists($upload_dir)) {
        wp_send_json_success('<p>لا توجد نسخ احتياطية</p>');
        return;
    }
    
    $backups = glob($upload_dir . 'backup-*.sql');
    
    if (empty($backups)) {
        wp_send_json_success('<p>لا توجد نسخ احتياطية</p>');
        return;
    }
    
    usort($backups, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });
    
    $html = '<h4>النسخ الاحتياطية المتاحة:</h4><ul>';
    
    foreach ($backups as $backup) {
        $filename = basename($backup);
        $size = size_format(filesize($backup));
        $date = date('Y-m-d H:i:s', filemtime($backup));
        
        $html .= "<li style='margin-bottom: 10px; padding: 10px; background: #f9f9f9; border-<?php
/**
 * Theme Name: محتوى - الحلول اليومية
 * Functions and definitions - النسخة المطورة والمحسنة
 * 
 * @package Muhtawaa
 * @version 2.0
 */

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ثوابت القالب المطورة
define('THEME_VERSION', '2.0');
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_ASSETS_URL', THEME_URL . '/assets');
define('THEME_INC_PATH', THEME_PATH . '/inc');
define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');

// فئة إدارة القالب الرئيسية
class MuhtawaaTheme {
    
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('init', array($this, 'init_features'));
        add_action('customize_register', array($this, 'customize_register'));
        add_action('wp_head', array($this, 'add_meta_tags'));
        
        // تحميل ملفات النظام
        $this->load_includes();
        
        // إعداد نظام الصيانة التلقائية
        $this->setup_maintenance_system();
        
        // إعداد نظام الإشعارات المحسن
        $this->setup_notification_system();
    }
    
    /**
     * إعداد القالب الأساسي
     */
    public function setup() {
        // دعم اللغة العربية
        load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
        
        // دعم ميزات ووردبريس المتقدمة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 
            'gallery', 'caption', 'script', 'style'
        ));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', array(
            'height' => 100, 'width' => 300,
            'flex-height' => true, 'flex-width' => true,
        ));
        add_theme_support('post-formats', array(
            'aside', 'gallery', 'link', 'image', 'quote', 
            'status', 'video', 'audio', 'chat'
        ));
        add_theme_support('custom-background');
        add_theme_support('custom-header');
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        
        // تسجيل القوائم المحسنة
        register_nav_menus(array(
            'main-menu' => __('القائمة الرئيسية', 'muhtawaa'),
            'footer-menu' => __('قائمة التذييل', 'muhtawaa'),
            'mobile-menu' => __('قائمة الجوال', 'muhtawaa'),
            'social-menu' => __('قائمة وسائل التواصل', 'muhtawaa'),
        ));
        
        // أحجام الصور المخصصة المحسنة
        add_image_size('solution-thumbnail', 400, 300, true);
        add_image_size('solution-large', 800, 600, true);
        add_image_size('solution-featured', 1200, 600, true);
        add_image_size('category-icon', 150, 150, true);
        add_image_size('author-avatar', 100, 100, true);
        
        // إعداد RSS محسن
        add_theme_support('automatic-feed-links');
        
        // إعداد محرر المحتوى
        add_editor_style('assets/css/editor.css');
    }
    
    /**
     * تحميل ملفات CSS و JavaScript المحسنة
     */
    public function enqueue_scripts() {
        // ملفات CSS المحسنة
        wp_enqueue_style('muhtawaa-style', get_stylesheet_uri(), array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-main', THEME_ASSETS_URL . '/css/main.css', array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-custom', THEME_ASSETS_URL . '/css/custom.css', array('muhtawaa-main'), THEME_VERSION);
        
        // Font Awesome محسن
        wp_enqueue_style('font-awesome', 
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', 
            array(), '6.4.0'
        );
        
        // Google Fonts للعربية
        wp_enqueue_style('google-fonts', 
            'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap',
            array(), THEME_VERSION
        );
        
        // jQuery مع fallback
        wp_enqueue_script('jquery');
        
        // ملفات JavaScript المحسنة
        wp_enqueue_script('muhtawaa-main', 
            THEME_ASSETS_URL . '/js/main.js', 
            array('jquery'), THEME_VERSION, true
        );
        
        wp_enqueue_script('muhtawaa-enhanced', 
            THEME_ASSETS_URL . '/js/enhanced.js', 
            array('muhtawaa-main'), THEME_VERSION, true
        );
        
        // متغيرات JavaScript محسنة
        wp_localize_script('muhtawaa-main', 'muhtawaaAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_nonce'),
            'postId' => get_the_ID() ?: 0,
            'homeUrl' => home_url(),
            'themeUrl' => THEME_URL,
            'currentUserId' => get_current_user_id(),
            'isAdmin' => current_user_can('manage_options'),
            'locale' => get_locale(),
            'strings' => array(
                'loading' => __('جاري التحميل...', 'muhtawaa'),
                'error' => __('حدث خطأ', 'muhtawaa'),
                'success' => __('تم بنجاح', 'muhtawaa'),
                'confirm' => __('هل أنت متأكد؟', 'muhtawaa'),
                'noResults' => __('لا توجد نتائج', 'muhtawaa'),
                'loadMore' => __('تحميل المزيد', 'muhtawaa'),
                'searchPlaceholder' => __('ابحث عن حل...', 'muhtawaa'),
            ),
            'settings' => $this->get_theme_settings(),
        ));
        
        // تحميل ملف التعليقات إذا لزم الأمر
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        
        // Lazy loading للصور
        wp_enqueue_script('muhtawaa-lazyload', 
            THEME_ASSETS_URL . '/js/lazyload.js', 
            array(), THEME_VERSION, true
        );
    }
    
    /**
     * تسجيل مناطق الودجات المحسنة
     */
    public function widgets_init() {
        // الشريط الجانبي الرئيسي
        register_sidebar(array(
            'name' => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
            'id' => 'sidebar-main',
            'description' => __('الشريط الجانبي للصفحات الفردية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // شريط جانبي للصفحة الرئيسية
        register_sidebar(array(
            'name' => __('شريط الصفحة الرئيسية', 'muhtawaa'),
            'id' => 'sidebar-home',
            'description' => __('شريط جانبي خاص بالصفحة الرئيسية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // مناطق تذييل الموقع
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name' => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
                'id' => "footer-{$i}",
                'description' => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ));
        }
        
        // منطقة ما قبل المحتوى
        register_sidebar(array(
            'name' => __('ما قبل المحتوى', 'muhtawaa'),
            'id' => 'before-content',
            'description' => __('تظهر قبل محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="pre-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // منطقة ما بعد المحتوى
        register_sidebar(array(
            'name' => __('ما بعد المحتوى', 'muhtawaa'),
            'id' => 'after-content',
            'description' => __('تظهر بعد محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="post-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
    
    /**
     * تحميل ملفات النظام المطلوبة
     */
    private function load_includes() {
        $includes = array(
            'ajax-functions.php',
            'theme-settings.php',
            'customizer.php',
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
            'admin-dashboard.php',
        );
        
        foreach ($includes as $file) {
            $file_path = THEME_INC_PATH . '/' . $file;
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }
    }
    
    /**
     * تهيئة ميزات القالب المحسنة
     */
    public function init_features() {
        // إنشاء التصنيفات المخصصة
        $this->create_custom_taxonomies();
        
        // إنشاء أنواع المحتوى المخصصة
        $this->create_custom_post_types();
        
        // إنشاء الجداول المطلوبة
        $this->create_database_tables();
        
        // إعداد نظام البحث المحسن
        add_action('pre_get_posts', array($this, 'enhance_search'));
        
        // إعداد نظام التوصيات الذكية
        add_action('wp_footer', array($this, 'load_smart_recommendations'));
        
        // تحسين الأمان
        $this->enhance_security();
        
        // تحسين الأداء
        $this->enhance_performance();
    }
    
    /**
     * إنشاء التصنيفات المخصصة المحسنة
     */
    private function create_custom_taxonomies() {
        // تصنيف فئات الحلول
        register_taxonomy('solution_category', 'post', array(
            'labels' => array(
                'name' => __('فئات الحلول', 'muhtawaa'),
                'singular_name' => __('فئة الحلول', 'muhtawaa'),
                'menu_name' => __('فئات الحلول', 'muhtawaa'),
                'all_items' => __('جميع الفئات', 'muhtawaa'),
                'edit_item' => __('تعديل الفئة', 'muhtawaa'),
                'view_item' => __('مشاهدة الفئة', 'muhtawaa'),
                'update_item' => __('تحديث الفئة', 'muhtawaa'),
                'add_new_item' => __('إضافة فئة جديدة', 'muhtawaa'),
                'new_item_name' => __('اسم الفئة الجديدة', 'muhtawaa'),
                'search_items' => __('البحث في الفئات', 'muhtawaa'),
                'not_found' => __('لم يتم العثور على فئات', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'solutions'),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
            'meta_box_cb' => 'post_categories_meta_box',
        ));
        
        // تصنيف مستوى الصعوبة
        register_taxonomy('difficulty_level', 'post', array(
            'labels' => array(
                'name' => __('مستويات الصعوبة', 'muhtawaa'),
                'singular_name' => __('مستوى الصعوبة', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
        
        // تصنيف الكلمات المفتاحية للحلول
        register_taxonomy('solution_tags', 'post', array(
            'labels' => array(
                'name' => __('كلمات مفتاحية للحلول', 'muhtawaa'),
                'singular_name' => __('كلمة مفتاحية', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
    }
    
    /**
     * إنشاء أنواع المحتوى المخصصة
     */
    private function create_custom_post_types() {
        // نوع محتوى للتوصيات
        register_post_type('recommendation', array(
            'labels' => array(
                'name' => __('التوصيات', 'muhtawaa'),
                'singular_name' => __('توصية', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-lightbulb',
        ));
        
        // نوع محتوى للإشعارات
        register_post_type('notification', array(
            'labels' => array(
                'name' => __('الإشعارات', 'muhtawaa'),
                'singular_name' => __('إشعار', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor'),
            'menu_icon' => 'dashicons-bell',
        ));
    }
    
    /**
     * إنشاء الجداول المطلوبة
     */
    private function create_database_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // جدول الإحصائيات المحسن
        $stats_table = $wpdb->prefix . 'muhtawaa_stats';
        $sql_stats = "CREATE TABLE IF NOT EXISTS $stats_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) DEFAULT 0,
            action_type varchar(50) NOT NULL,
            action_value text,
            user_ip varchar(45),
            user_agent text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            KEY user_id (user_id),
            KEY action_type (action_type),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول المشتركين المحسن
        $subscribers_table = $wpdb->prefix . 'muhtawaa_subscribers';
        $sql_subscribers = "CREATE TABLE IF NOT EXISTS $subscribers_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            email varchar(100) NOT NULL,
            name varchar(100),
            preferences text,
            status varchar(20) DEFAULT 'active',
            source varchar(50) DEFAULT 'website',
            confirmation_token varchar(255),
            confirmed_at datetime,
            last_email_sent datetime,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY email (email),
            KEY status (status),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول البحثات المحسن
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            search_term varchar(255) NOT NULL,
            results_count int(11) DEFAULT 0,
            clicked_result_id bigint(20) DEFAULT 0,
            user_id bigint(20) DEFAULT 0,
            user_ip varchar(45),
            user_agent text,
            source varchar(50) DEFAULT 'website',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY search_term (search_term),
            KEY user_id (user_id),
            KEY created_at (created_at),
            FULLTEXT KEY search_term_fulltext (search_term)
        ) $charset_collate;";
        
        // جدول التوصيات الذكية
        $recommendations_table = $wpdb->prefix . 'muhtawaa_recommendations';
        $sql_recommendations = "CREATE TABLE IF NOT EXISTS $recommendations_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) DEFAULT 0,
            post_id bigint(20) NOT NULL,
            recommended_post_id bigint(20) NOT NULL,
            recommendation_type varchar(50) NOT NULL,
            score decimal(5,2) DEFAULT 0.00,
            shown_count int(11) DEFAULT 0,
            clicked_count int(11) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY post_id (post_id),
            KEY recommended_post_id (recommended_post_id),
            KEY recommendation_type (recommendation_type)
        ) $charset_collate;";
        
        // جدول إعدادات القالب
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $sql_settings = "CREATE TABLE IF NOT EXISTS $settings_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            setting_key varchar(100) NOT NULL,
            setting_value longtext,
            setting_type varchar(50) DEFAULT 'string',
            autoload varchar(20) DEFAULT 'yes',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY setting_key (setting_key),
            KEY autoload (autoload)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_stats);
        dbDelta($sql_subscribers);
        dbDelta($sql_searches);
        dbDelta($sql_recommendations);
        dbDelta($sql_settings);
        
        // إدراج الإعدادات الافتراضية
        $this->insert_default_settings();
    }
    
    /**
     * إدراج الإعدادات الافتراضية
     */
    private function insert_default_settings() {
        $default_settings = array(
            'theme_color_primary' => '#667eea',
            'theme_color_secondary' => '#764ba2',
            'enable_smart_recommendations' => 'yes',
            'enable_advanced_search' => 'yes',
            'enable_rating_system' => 'yes',
            'maintenance_mode' => 'no',
            'notification_email' => get_option('admin_email'),
            'max_recommendations' => '5',
            'search_suggestions_count' => '8',
            'auto_backup_enabled' => 'yes',
            'auto_backup_frequency' => 'weekly',
        );
        
        foreach ($default_settings as $key => $value) {
            $this->update_theme_setting($key, $value);
        }
    }
    
    /**
     * تحسين نظام البحث
     */
    public function enhance_search($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            // البحث في العنوان والمحتوى والحقول المخصصة
            $search_term = $query->get('s');
            
            if (!empty($search_term)) {
                // إضافة البحث في الحقول المخصصة
                $meta_query = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_solution_materials',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_solution_description',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                );
                
                $query->set('meta_query', $meta_query);
                
                // البحث في التصنيفات أيضاً
                $tax_query = array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'solution_category',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                    array(
                        'taxonomy' => 'solution_tags',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                );
                
                $query->set('tax_query', $tax_query);
                
                // تسجيل البحث للإحصائيات
                $this->log_search($search_term, $query->found_posts);
            }
        }
        
        return $query;
    }
    
    /**
     * تسجيل البحث في قاعدة البيانات
     */
    private function log_search($search_term, $results_count = 0) {
        global $wpdb;
        
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        
        $wpdb->insert(
            $searches_table,
            array(
                'search_term' => sanitize_text_field($search_term),
                'results_count' => intval($results_count),
                'user_id' => get_current_user_id(),
                'user_ip' => $this->get_user_ip(),
                'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%d', '%s', '%s', '%s')
        );
    }
    
    /**
     * الحصول على عنوان IP المستخدم
     */
    private function get_user_ip() {
        $ip_keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    }
    
    /**
     * إعداد نظام الصيانة التلقائية
     */
    private function setup_maintenance_system() {
        // جدولة تنظيف قاعدة البيانات
        if (!wp_next_scheduled('muhtawaa_daily_maintenance')) {
            wp_schedule_event(time(), 'daily', 'muhtawaa_daily_maintenance');
        }
        
        add_action('muhtawaa_daily_maintenance', array($this, 'daily_maintenance'));
        
        // جدولة النسخ الاحتياطية
        if (!wp_next_scheduled('muhtawaa_weekly_backup')) {
            wp_schedule_event(time(), 'weekly', 'muhtawaa_weekly_backup');
        }
        
        add_action('muhtawaa_weekly_backup', array($this, 'create_backup'));
    }
    
    /**
     * الصيانة اليومية
     */
    public function daily_maintenance() {
        global $wpdb;
        
        // تنظيف البيانات القديمة (أكثر من 6 أشهر)
        $six_months_ago = date('Y-m-d H:i:s', strtotime('-6 months'));
        
        // حذف الإحصائيات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_stats WHERE created_at < %s",
            $six_months_ago
        ));
        
        // حذف البحثات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < %s",
            $six_months_ago
        ));
        
        // تنظيف transients منتهية الصلاحية
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%' AND option_name NOT IN (SELECT CONCAT('_transient_', SUBSTRING(option_name, 19)) FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%')");
        
        // تحسين الجداول
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE $table");
        }
        
        // إرسال تقرير الصيانة
        $this->send_maintenance_report();
    }
    
    /**
     * إنشاء نسخة احتياطية
     */
    public function create_backup() {
        if ($this->get_theme_setting('auto_backup_enabled') !== 'yes') {
            return;
        }
        
        global $wpdb;
        
        $backup_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
        if (!file_exists($backup_dir)) {
            wp_mkdir_p($backup_dir);
        }
        
        $backup_file = $backup_dir . 'backup-' . date('Y-m-d-H-i-s') . '.sql';
        
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        $sql_dump = "-- Muhtawaa Theme Backup\n";
        $sql_dump .= "-- Created: " . date('Y-m-d H:i:s') . "\n\n";
        
        foreach ($tables as $table) {
            $result = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
            
            if (!empty($result)) {
                $sql_dump .= "-- Table: $table\n";
                $sql_dump .= "TRUNCATE TABLE $table;\n";
                
                foreach ($result as $row) {
                    $values = array();
                    foreach ($row as $value) {
                        $values[] = "'" . $wpdb->_escape($value) . "'";
                    }
                    $sql_dump .= "INSERT INTO $table VALUES (" . implode(',', $values) . ");\n";
                }
                $sql_dump .= "\n";
            }
        }
        
        file_put_contents($backup_file, $sql_dump);
        
        // حذف النسخ القديمة (أكثر من شهر)
        $this->cleanup_old_backups($backup_dir);
        
        return $backup_file;
    }
    
    /**
     * تنظيف النسخ الاحتياطية القديمة
     */
    private function cleanup_old_backups($backup_dir) {
        $files = glob($backup_dir . 'backup-*.sql');
        $one_month_ago = time() - (30 * 24 * 60 * 60);
        
        foreach ($files as $file) {
            if (filemtime($file) < $one_month_ago) {
                unlink($file);
            }
        }
    }
    
    /**
     * إرسال تقرير الصيانة
     */
    private function send_maintenance_report() {
        $admin_email = $this->get_theme_setting('notification_email');
        if (!$admin_email) return;
        
        global $wpdb;
        
        // إحصائيات سريعة
        $stats = array(
            'total_posts' => wp_count_posts()->publish,
            'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
            'searches_today' => $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
                date('Y-m-d')
            )),
            'top_search' => $wpdb->get_var("SELECT search_term FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY search_term ORDER BY COUNT(*) DESC LIMIT 1")
        );
        
        $subject = 'تقرير الصيانة اليومية - ' . get_bloginfo('name');
        $message = "تقرير الصيانة اليومية لموقع " . get_bloginfo('name') . "\n\n";
        $message .= "إجمالي المقالات: " . $stats['total_posts'] . "\n";
        $message .= "إجمالي المشتركين: " . $stats['total_subscribers'] . "\n";
        $message .= "البحثات اليوم: " . $stats['searches_today'] . "\n";
        $message .= "أشهر بحث هذا الأسبوع: " . ($stats['top_search'] ?: 'لا يوجد') . "\n\n";
        $message .= "تم تنفيذ الصيانة بنجاح في: " . date('Y-m-d H:i:s');
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * إعداد نظام الإشعارات المحسن
     */
    private function setup_notification_system() {
        // تحميل نظام الإشعارات
        add_action('wp_ajax_dismiss_notification', array($this, 'dismiss_notification'));
        add_action('wp_ajax_nopriv_dismiss_notification', array($this, 'dismiss_notification'));
        
        // إضافة إشعارات في لوحة التحكم
        add_action('admin_notices', array($this, 'show_admin_notifications'));
        
        // إشعارات المستخدمين في الواجهة الأمامية
        add_action('wp_footer', array($this, 'show_frontend_notifications'));
    }
    
    /**
     * إظهار الإشعارات في لوحة التحكم
     */
    public function show_admin_notifications() {
        if (!current_user_can('manage_options')) return;
        
        // فحص التحديثات المطلوبة
        $this->check_theme_updates();
        
        // فحص مشاكل الأداء
        $this->check_performance_issues();
        
        // فحص مشاكل الأمان
        $this->check_security_issues();
    }
    
    /**
     * فحص تحديثات القالب
     */
    private function check_theme_updates() {
        $last_check = get_option('muhtawaa_last_update_check', 0);
        $current_time = time();
        
        // فحص مرة واحدة يومياً
        if (($current_time - $last_check) > DAY_IN_SECONDS) {
            // هنا يمكن إضافة منطق فحص التحديثات من خادم خارجي
            update_option('muhtawaa_last_update_check', $current_time);
        }
    }
    
    /**
     * فحص مشاكل الأداء
     */
    private function check_performance_issues() {
        global $wpdb;
        
        // فحص حجم قاعدة البيانات
        $db_size = $wpdb->get_var("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS 'DB Size in MB' FROM information_schema.tables WHERE table_schema='{$wpdb->dbname}'");
        
        if ($db_size > 500) { // أكثر من 500 ميجا
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>تحذير:</strong> حجم قاعدة البيانات كبير (' . $db_size . ' ميجا). يُنصح بتنظيف البيانات القديمة.</p>
            </div>';
        }
        
        // فحص عدد المراجعات
        $revisions_count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'revision'");
        
        if ($revisions_count > 1000) {
            echo '<div class="notice notice-info is-dismissible">
                <p><strong>تحسين:</strong> يوجد ' . $revisions_count . ' مراجعة. يمكن حذف القديمة منها لتحسين الأداء.</p>
            </div>';
        }
    }
    
    /**
     * فحص مشاكل الأمان
     */
    private function check_security_issues() {
        // فحص إعدادات الأمان الأساسية
        if (get_option('users_can_register')) {
            echo '<div class="notice notice-error is-dismissible">
                <p><strong>تحذير أمني:</strong> التسجيل مفتوح للجميع. يُنصح بإغلاقه إذا لم يكن ضرورياً.</p>
            </div>';
        }
        
        // فحص قوة كلمات المرور
        $weak_users = get_users(array(
            'meta_query' => array(
                array(
                    'key' => 'wp_user_level',
                    'value' => '10',
                    'compare' => '='
                )
            )
        ));
        
        foreach ($weak_users as $user) {
            if (strlen($user->user_pass) < 12) {
                echo '<div class="notice notice-warning is-dismissible">
                    <p><strong>تحذير أمني:</strong> يُنصح المديرين باستخدام كلمات مرور قوية (12 حرف على الأقل).</p>
                </div>';
                break;
            }
        }
    }
    
    /**
     * إظهار الإشعارات في الواجهة الأمامية
     */
    public function show_frontend_notifications() {
        if (is_admin()) return;
        
        $notifications = $this->get_active_notifications();
        
        if (!empty($notifications)) {
            echo '<div id="muhtawaa-notifications">';
            foreach ($notifications as $notification) {
                echo '<div class="muhtawaa-notification notification-' . $notification['type'] . '" data-id="' . $notification['id'] . '">';
                echo '<span class="notification-message">' . $notification['message'] . '</span>';
                echo '<button class="notification-close" data-id="' . $notification['id'] . '">&times;</button>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
    
    /**
     * الحصول على الإشعارات النشطة
     */
    private function get_active_notifications() {
        // يمكن تخصيص هذه الدالة لجلب الإشعارات من قاعدة البيانات
        $notifications = array();
        
        // إشعار ترحيب للزوار الجدد
        if (!isset($_COOKIE['muhtawaa_visited'])) {
            $notifications[] = array(
                'id' => 'welcome',
                'type' => 'info',
                'message' => 'مرحباً بك في موقع محتوى! اكتشف آلاف الحلول العملية للمشاكل اليومية.'
            );
        }
        
        // إشعار النشرة البريدية
        if (!isset($_COOKIE['muhtawaa_newsletter_prompted'])) {
            $notifications[] = array(
                'id' => 'newsletter',
                'type' => 'success',
                'message' => 'اشترك في نشرتنا البريدية واحصل على حل عملي جديد كل يوم! 📧'
            );
        }
        
        return $notifications;
    }
    
    /**
     * رفض الإشعار
     */
    public function dismiss_notification() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_die('غير مصرح');
        }
        
        $notification_id = sanitize_text_field($_POST['notification_id'] ?? '');
        
        if ($notification_id) {
            // حفظ في الكوكيز لمدة شهر
            setcookie('muhtawaa_notification_' . $notification_id . '_dismissed', '1', time() + (30 * DAY_IN_SECONDS), '/');
            wp_send_json_success('تم رفض الإشعار');
        }
        
        wp_send_json_error('معرف الإشعار مطلوب');
    }
    
    /**
     * تحميل التوصيات الذكية
     */
    public function load_smart_recommendations() {
        if (!is_single() || !$this->get_theme_setting('enable_smart_recommendations')) {
            return;
        }
        
        $post_id = get_the_ID();
        $recommendations = $this->get_smart_recommendations($post_id);
        
        if (!empty($recommendations)) {
            echo '<div id="smart-recommendations" style="display: none;">';
            echo json_encode($recommendations);
            echo '</div>';
        }
    }
    
    /**
     * الحصول على التوصيات الذكية
     */
    private function get_smart_recommendations($post_id) {
        global $wpdb;
        
        $cache_key = "smart_recommendations_$post_id";
        $recommendations = wp_cache_get($cache_key);
        
        if ($recommendations === false) {
            // خوارزمية التوصيات الذكية
            $current_post = get_post($post_id);
            $categories = wp_get_post_categories($post_id);
            $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
            
            $recommended_posts = array();
            
            // 1. مقالات من نفس الفئة
            if (!empty($categories)) {
                $category_posts = get_posts(array(
                    'category__in' => $categories,
                    'post__not_in' => array($post_id),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));
                
                foreach ($category_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'category',
                        'score' => 0.8
                    );
                }
            }
            
            // 2. مقالات بنفس الكلمات المفتاحية
            if (!empty($tags) && count($recommended_posts) < 5) {
                $tag_posts = get_posts(array(
                    'tag__in' => $tags,
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 2,
                    'orderby' => 'rand'
                ));
                
                foreach ($tag_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'tags',
                        'score' => 0.6
                    );
                }
            }
            
            // 3. المقالات الأكثر شعبية
            if (count($recommended_posts) < 5) {
                $popular_posts = get_posts(array(
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 3,
                    'meta_key' => '_total_views',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ));
                
                foreach ($popular_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'popular',
                        'score' => 0.4
                    );
                }
            }
            
            // ترتيب حسب النقاط
            usort($recommended_posts, function($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            
            $recommendations = array_slice($recommended_posts, 0, 5);
            
            // حفظ في الكاش لمدة ساعة
            wp_cache_set($cache_key, $recommendations, '', HOUR_IN_SECONDS);
        }
        
        return $recommendations;
    }
    
    /**
     * تحسين الأمان
     */
    private function enhance_security() {
        // إخفاء إصدار ووردبريس
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // منع تعداد المستخدمين
        add_action('wp', function() {
            if (is_author() && !is_user_logged_in()) {
                wp_redirect(home_url());
                exit;
            }
        });
        
        // حماية ملف wp-config
        add_action('init', function() {
            if (strpos($_SERVER['REQUEST_URI'], 'wp-config.php') !== false) {
                wp_die('Access denied');
            }
        });
        
        // إضافة headers أمنية
        add_action('send_headers', function() {
            header('X-Frame-Options: SAMEORIGIN');
            header('X-Content-Type-Options: nosniff');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
        });
        
        // تحديد محاولات تسجيل الدخول
        add_action('wp_login_failed', array($this, 'handle_failed_login'));
        add_filter('authenticate', array($this, 'check_login_attempts'), 30, 3);
    }
    
    /**
     * معالجة فشل تسجيل الدخول
     */
    public function handle_failed_login($username) {
        $ip = $this->get_user_ip();
        $attempts = get_transient("login_attempts_$ip") ?: 0;
        $attempts++;
        
        set_transient("login_attempts_$ip", $attempts, 15 * MINUTE_IN_SECONDS);
        
        if ($attempts >= 5) {
            set_transient("login_blocked_$ip", true, HOUR_IN_SECONDS);
        }
    }
    
    /**
     * فحص محاولات تسجيل الدخول
     */
    public function check_login_attempts($user, $username, $password) {
        $ip = $this->get_user_ip();
        
        if (get_transient("login_blocked_$ip")) {
            return new WP_Error('login_blocked', 'تم حظر عنوان IP الخاص بك مؤقتاً بسبب المحاولات المتكررة.');
        }
        
        return $user;
    }
    
    /**
     * تحسين الأداء
     */
    private function enhance_performance() {
        // ضغط الـ HTML
        if (!is_admin()) {
            ob_start(array($this, 'compress_html'));
        }
        
        // تحسين قاعدة البيانات
        add_action('wp_footer', array($this, 'optimize_database_queries'));
        
        // تأجيل تحميل JavaScript غير الأساسي
        add_filter('script_loader_tag', array($this, 'defer_non_critical_scripts'), 10, 2);
        
        // تحسين الصور
        add_filter('wp_get_attachment_image_attributes', array($this, 'add_lazy_loading'), 10, 2);
        
        // تمكين Gzip
        if (!ob_get_level()) {
            ob_start('ob_gzhandler');
        }
    }
    
    /**
     * ضغط HTML
     */
    public function compress_html($html) {
        // إزالة المسافات الزائدة والتعليقات
        $html = preg_replace('/<!--(.*)-->/Uis', '', $html);
        $html = preg_replace('/\>[^\S ]+/s', '>', $html);
        $html = preg_replace('/[^\S ]+\</s', '<', $html);
        $html = preg_replace('/(\s)+/s', '\\1', $html);
        
        return $html;
    }
    
    /**
     * تأجيل السكريبت غير الأساسية
     */
    public function defer_non_critical_scripts($tag, $handle) {
        $defer_scripts = array('muhtawaa-enhanced', 'muhtawaa-lazyload');
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إضافة lazy loading للصور
     */
    public function add_lazy_loading($attr, $attachment) {
        if (!is_admin()) {
            $attr['loading'] = 'lazy';
        }
        
        return $attr;
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public function optimize_database_queries() {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $queries_count = get_num_queries();
            $memory_usage = size_format(memory_get_peak_usage(true));
            
            echo "<!-- WordPress Queries: $queries_count | Memory: $memory_usage -->";
        }
    }
    
    /**
     * إعداد المخصص (Customizer)
     */
    public function customize_register($wp_customize) {
        // قسم إعدادات القالب
        $wp_customize->add_section('muhtawaa_theme_settings', array(
            'title' => __('إعدادات القالب', 'muhtawaa'),
            'priority' => 30,
        ));
        
        // الألوان الأساسية
        $wp_customize->add_setting('muhtawaa_primary_color', array(
            'default' => '#667eea',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_primary_color', array(
            'label' => __('اللون الأساسي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        $wp_customize->add_setting('muhtawaa_secondary_color', array(
            'default' => '#764ba2',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_secondary_color', array(
            'label' => __('اللون الثانوي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        // إعدادات التوصيات
        $wp_customize->add_setting('muhtawaa_enable_recommendations', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_recommendations', array(
            'label' => __('تمكين التوصيات الذكية', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // إعدادات البحث المتقدم
        $wp_customize->add_setting('muhtawaa_enable_advanced_search', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_advanced_search', array(
            'label' => __('تمكين البحث المتقدم', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // نص تذييل مخصص
        $wp_customize->add_setting('muhtawaa_footer_text', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_text', array(
            'label' => __('نص التذييل المخصص', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'text',
        ));
        
        // روابط وسائل التواصل
        $social_networks = array(
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر', 
            'instagram' => 'انستغرام',
            'youtube' => 'يوتيوب',
            'linkedin' => 'لينكد إن',
            'telegram' => 'تليجرام'
        );
        
        foreach ($social_networks as $network => $label) {
            $wp_customize->add_setting("muhtawaa_social_$network", array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            
            $wp_customize->add_control("muhtawaa_social_$network", array(
                'label' => $label,
                'section' => 'muhtawaa_theme_settings',
                'type' => 'url',
            ));
        }
    }
    
    /**
     * إضافة meta tags محسنة
     */
    public function add_meta_tags() {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        echo '<meta name="theme-color" content="' . get_theme_mod('muhtawaa_primary_color', '#667eea') . '">' . "\n";
        
        if (is_singular()) {
            $description = wp_trim_words(get_the_excerpt(), 25);
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
            
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
            }
        }
    }
    
    /**
     * دوال مساعدة لإدارة إعدادات القالب
     */
    public function get_theme_setting($key, $default = '') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $value = $wpdb->get_var($wpdb->prepare(
            "SELECT setting_value FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        return $value !== null ? $value : $default;
    }
    
    public function update_theme_setting($key, $value, $type = 'string') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        
        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        if ($existing) {
            $wpdb->update(
                $settings_table,
                array(
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'updated_at' => current_time('mysql')
                ),
                array('setting_key' => $key),
                array('%s', '%s', '%s'),
                array('%s')
            );
        } else {
            $wpdb->insert(
                $settings_table,
                array(
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'created_at' => current_time('mysql')
                ),
                array('%s', '%s', '%s', '%s')
            );
        }
    }
    
    public function get_theme_settings() {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $results = $wpdb->get_results("SELECT setting_key, setting_value FROM $settings_table WHERE autoload = 'yes'", ARRAY_A);
        
        $settings = array();
        foreach ($results as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        
        return $settings;
    }
}

// تهيئة القالب
MuhtawaaTheme::getInstance();

// دوال مساعدة عامة
if (!function_exists('muhtawaa_get_category_icon')) {
    function muhtawaa_get_category_icon($category_name) {
        $icons = array(
            'المنزل والتنظيف' => '🏠',
            'المطبخ والطبخ' => '🍳',
            'توفير المال' => '💰',
            'السيارات' => '🚗',
            'التكنولوجيا' => '📱',
            'الطقس والمناخ' => '🌡️',
            'الصحة والجمال' => '💄',
            'الحديقة والزراعة' => '🌱',
            'الأطفال والعائلة' => '👶',
            'التعليم والدراسة' => '📚'
        );
        
        return isset($icons[$category_name]) ? $icons[$category_name] : '💡';
    }
}

if (!function_exists('muhtawaa_get_difficulty_color')) {
    function muhtawaa_get_difficulty_color($difficulty) {
        $colors = array(
            'سهل جداً' => '#4caf50',
            'سهل' => '#8bc34a',
            'متوسط' => '#ff9800',
            'صعب' => '#f44336',
            'خبير' => '#9c27b0'
        );
        
        return isset($colors[$difficulty]) ? $colors[$difficulty] : '#666';
    }
}

if (!function_exists('muhtawaa_get_social_links')) {
    function muhtawaa_get_social_links() {
        $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'telegram');
        $links = array();
        
        foreach ($social_networks as $network) {
            $url = get_theme_mod("muhtawaa_social_$network", '');
            if (!empty($url)) {
                $links[$network] = $url;
            }
        }
        
        return $links;
    }
}

if (!function_exists('muhtawaa_breadcrumbs')) {
    function muhtawaa_breadcrumbs() {
        if (is_front_page()) return;
        
        echo '<nav class="breadcrumbs" role="navigation" aria-label="مسار التنقل">';
        echo '<div class="container">';
        echo '<ol class="breadcrumb-list">';
        echo '<li><a href="' . home_url() . '">🏠 الرئيسية</a></li>';
        
        if (is_category() || is_single()) {
            if (is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                }
                echo '<li><span>' . get_the_title() . '</span></li>';
            } elseif (is_category()) {
                echo '<li><span>' . single_cat_title('', false) . '</span></li>';
            }
        } elseif (is_page()) {
            $ancestors = get_post_ancestors(get_the_ID());
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
            echo '<li><span>' . get_the_title() . '</span></li>';
        } elseif (is_search()) {
            echo '<li><span>نتائج البحث عن: "' . get_search_query() . '"</span></li>';
        } elseif (is_tag()) {
            echo '<li><span>كلمة مفتاحية: ' . single_tag_title('', false) . '</span></li>';
        } elseif (is_archive()) {
            echo '<li><span>' . get_the_archive_title() . '</span></li>';
        }
        
        echo '</ol>';
        echo '</div>';
        echo '</nav>';
    }
}

// إضافة حقول مخصصة للمقالات
add_action('add_meta_boxes', 'muhtawaa_add_solution_meta_boxes');
function muhtawaa_add_solution_meta_boxes() {
    add_meta_box(
        'solution_details',
        __('تفاصيل الحل المحسنة', 'muhtawaa'),
        'muhtawaa_solution_details_callback',
        'post',
        'normal',
        'high'
    );
    
    add_meta_box(
        'solution_seo',
        __('تحسين محركات البحث', 'muhtawaa'),
        'muhtawaa_solution_seo_callback',
        'post',
        'side',
        'default'
    );
}

function muhtawaa_solution_details_callback($post) {
    wp_nonce_field('muhtawaa_save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, '_solution_difficulty', true);
    $time_needed = get_post_meta($post->ID, '_solution_time', true);
    $materials = get_post_meta($post->ID, '_solution_materials', true);
    $cost = get_post_meta($post->ID, '_solution_cost', true);
    $tools = get_post_meta($post->ID, '_solution_tools', true);
    $safety_notes = get_post_meta($post->ID, '_solution_safety', true);
    $season = get_post_meta($post->ID, '_solution_season', true);
    $target_audience = get_post_meta($post->ID, '_solution_audience', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="solution_difficulty">مستوى الصعوبة</label></th>
            <td>
                <select name="solution_difficulty" id="solution_difficulty" style="width: 200px;">
                    <option value="">اختر المستوى</option>
                    <option value="سهل جداً" <?php selected($difficulty, 'سهل جداً'); ?>>سهل جداً ⭐</option>
                    <option value="سهل" <?php selected($difficulty, 'سهل'); ?>>سهل ⭐⭐</option>
                    <option value="متوسط" <?php selected($difficulty, 'متوسط'); ?>>متوسط ⭐⭐⭐</option>
                    <option value="صعب" <?php selected($difficulty, 'صعب'); ?>>صعب ⭐⭐⭐⭐</option>
                    <option value="خبير" <?php selected($difficulty, 'خبير'); ?>>خبير ⭐⭐⭐⭐⭐</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_time">الوقت المطلوب</label></th>
            <td><input type="text" name="solution_time" id="solution_time" value="<?php echo esc_attr($time_needed); ?>" placeholder="مثال: 5 دقائق، ساعة واحدة" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_cost">التكلفة التقريبية</label></th>
            <td><input type="text" name="solution_cost" id="solution_cost" value="<?php echo esc_attr($cost); ?>" placeholder="مثال: مجاني، 10 ريال، أقل من 50 ريال" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_season">الموسم المناسب</label></th>
            <td>
                <select name="solution_season" id="solution_season" style="width: 200px;">
                    <option value="">طوال السنة</option>
                    <option value="الصيف" <?php selected($season, 'الصيف'); ?>>الصيف ☀️</option>
                    <option value="الشتاء" <?php selected($season, 'الشتاء'); ?>>الشتاء ❄️</option>
                    <option value="الربيع" <?php selected($season, 'الربيع'); ?>>الربيع 🌸</option>
                    <option value="الخريف" <?php selected($season, 'الخريف'); ?>>الخريف 🍂</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_audience">الفئة المستهدفة</label></th>
            <td>
                <select name="solution_audience" id="solution_audience" style="width: 200px;">
                    <option value="">الجميع</option>
                    <option value="المبتدئين" <?php selected($target_audience, 'المبتدئين'); ?>>المبتدئين</option>
                    <option value="الأمهات" <?php selected($target_audience, 'الأمهات'); ?>>الأمهات</option>
                    <option value="الآباء" <?php selected($target_audience, 'الآباء'); ?>>الآباء</option>
                    <option value="الطلاب" <?php selected($target_audience, 'الطلاب'); ?>>الطلاب</option>
                    <option value="كبار السن" <?php selected($target_audience, 'كبار السن'); ?>>كبار السن</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_materials">المواد المطلوبة</label></th>
            <td>
                <textarea name="solution_materials" id="solution_materials" rows="4" cols="60" placeholder="اذكر المواد المطلوبة، كل مادة في سطر جديد"><?php echo esc_textarea($materials); ?></textarea>
                <p class="description">مثال: ملح، خل أبيض، ليمونة، قطعة قماش</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_tools">الأدوات المطلوبة</label></th>
            <td>
                <textarea name="solution_tools" id="solution_tools" rows="3" cols="60" placeholder="اذكر الأدوات المطلوبة، كل أداة في سطر جديد"><?php echo esc_textarea($tools); ?></textarea>
                <p class="description">مثال: مكنسة كهربائية، مفك براغي، وعاء خلط</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_safety">ملاحظات السلامة</label></th>
            <td>
                <textarea name="solution_safety" id="solution_safety" rows="3" cols="60" placeholder="ملاحظات مهمة للسلامة (اختياري)"><?php echo esc_textarea($safety_notes); ?></textarea>
                <p class="description">مثال: استخدم القفازات، تأكد من إغلاق الكهرباء، احذر من الأسطح الساخنة</p>
            </td>
        </tr>
    </table>
    
    <style>
    .form-table th {
        width: 150px;
        vertical-align: top;
        padding-top: 10px;
    }
    
    .form-table td {
        padding: 8px 10px;
    }
    
    .form-table input[type="text"],
    .form-table select,
    .form-table textarea {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px;
    }
    
    .form-table textarea {
        font-family: inherit;
    }
    
    .form-table .description {
        font-style: italic;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_solution_seo_callback($post) {
    $focus_keyword = get_post_meta($post->ID, '_focus_keyword', true);
    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    $social_title = get_post_meta($post->ID, '_social_title', true);
    $social_description = get_post_meta($post->ID, '_social_description', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="focus_keyword">الكلمة المفتاحية الرئيسية</label></th>
            <td><input type="text" name="focus_keyword" id="focus_keyword" value="<?php echo esc_attr($focus_keyword); ?>" style="width: 100%;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="meta_description">وصف meta</label></th>
            <td>
                <textarea name="meta_description" id="meta_description" rows="3" style="width: 100%;" maxlength="160" placeholder="وصف مختصر للمقال (160 حرف كحد أقصى)"><?php echo esc_textarea($meta_description); ?></textarea>
                <p class="description"><span id="meta-count">0</span>/160 حرف</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_title">عنوان وسائل التواصل</label></th>
            <td><input type="text" name="social_title" id="social_title" value="<?php echo esc_attr($social_title); ?>" style="width: 100%;" placeholder="عنوان مخصص للمشاركة على وسائل التواصل" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_description">وصف وسائل التواصل</label></th>
            <td>
                <textarea name="social_description" id="social_description" rows="3" style="width: 100%;" placeholder="وصف مخصص للمشاركة على وسائل التواصل"><?php echo esc_textarea($social_description); ?></textarea>
            </td>
        </tr>
    </table>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const metaDescription = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        
        function updateMetaCount() {
            const count = metaDescription.value.length;
            metaCount.textContent = count;
            metaCount.style.color = count > 160 ? 'red' : (count > 140 ? 'orange' : 'green');
        }
        
        metaDescription.addEventListener('input', updateMetaCount);
        updateMetaCount(); // تحديث أولي
    });
    </script>
    <?php
}

// حفظ البيانات المخصصة المحسنة
add_action('save_post', 'muhtawaa_save_solution_details');
function muhtawaa_save_solution_details($post_id) {
    if (!isset($_POST['solution_details_nonce']) || !wp_verify_nonce($_POST['solution_details_nonce'], 'muhtawaa_save_solution_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'solution_difficulty', 'solution_time', 'solution_cost',
        'solution_materials', 'solution_tools', 'solution_safety',
        'solution_season', 'solution_audience',
        'focus_keyword', 'meta_description', 'social_title', 'social_description'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            
            if (in_array($field, array('solution_materials', 'solution_tools', 'solution_safety', 'meta_description', 'social_description'))) {
                $value = sanitize_textarea_field($value);
            } else {
                $value = sanitize_text_field($value);
            }
            
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
    
    // تحديث تاريخ آخر تعديل للحل
    update_post_meta($post_id, '_solution_last_updated', current_time('mysql'));
}

// نظام الاستيراد والتصدير
class MuhtawaaImportExport {
    
    public static function export_solutions($format = 'json') {
        if (!current_user_can('manage_options')) {
            wp_die('غير مصرح');
        }
        
        $solutions = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ));
        
        $export_data = array();
        
        foreach ($solutions as $solution) {
            $meta_data = get_post_meta($solution->ID);
            $categories = wp_get_post_categories($solution->ID, array('fields' => 'names'));
            $tags = wp_get_post_tags($solution->ID, array('fields' => 'names'));
            
            $export_data[] = array(
                'title' => $solution->post_title,
                'content' => $solution->post_content,
                'excerpt' => $solution->post_excerpt,
                'date' => $solution->post_date,
                'categories' => $categories,
                'tags' => $tags,
                'meta' => array(
                    'difficulty' => $meta_data['_solution_difficulty'][0] ?? '',
                    'time' => $meta_data['_solution_time'][0] ?? '',
                    'cost' => $meta_data['_solution_cost'][0] ?? '',
                    'materials' => $meta_data['_solution_materials'][0] ?? '',
                    'tools' => $meta_data['_solution_tools'][0] ?? '',
                    'safety' => $meta_data['_solution_safety'][0] ?? '',
                    'season' => $meta_data['_solution_season'][0] ?? '',
                    'audience' => $meta_data['_solution_audience'][0] ?? '',
                )
            );
        }
        
        if ($format === 'json') {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.json"');
            echo json_encode($export_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } elseif ($format === 'csv') {
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.csv"');
            
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM
            
            // Headers
            fputcsv($output, array('العنوان', 'المحتوى', 'الملخص', 'التاريخ', 'الفئات', 'الكلمات المفتاحية', 'الصعوبة', 'الوقت', 'التكلفة'));
            
            foreach ($export_data as $row) {
                fputcsv($output, array(
                    $row['title'],
                    strip_tags($row['content']),
                    $row['excerpt'],
                    $row['date'],
                    implode(', ', $row['categories']),
                    implode(', ', $row['tags']),
                    $row['meta']['difficulty'],
                    $row['meta']['time'],
                    $row['meta']['cost']
                ));
            }
            
            fclose($output);
        }
        
        exit;
    }
    
    public static function import_solutions($file_path) {
        if (!current_user_can('manage_options')) {
            return new WP_Error('permission_denied', 'غير مصرح');
        }
        
        if (!file_exists($file_path)) {
            return new WP_Error('file_not_found', 'الملف غير موجود');
        }
        
        $file_content = file_get_contents($file_path);
        $data = json_decode($file_content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('invalid_json', 'ملف JSON غير صحيح');
        }
        
        $imported_count = 0;
        $errors = array();
        
        foreach ($data as $solution_data) {
            $post_data = array(
                'post_title' => sanitize_text_field($solution_data['title']),
                'post_content' => wp_kses_post($solution_data['content']),
                'post_excerpt' => sanitize_textarea_field($solution_data['excerpt']),
                'post_status' => 'draft', // استيراد كمسودة للمراجعة
                'post_type' => 'post'
            );
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                $errors[] = 'فشل في استيراد: ' . $solution_data['title'];
                continue;
            }
            
            // إضافة الفئات
            if (!empty($solution_data['categories'])) {
                wp_set_post_categories($post_id, $solution_data['categories']);
            }
            
            // إضافة الكلمات المفتاحية
            if (!empty($solution_data['tags'])) {
                wp_set_post_tags($post_id, implode(', ', $solution_data['tags']));
            }
            
            // إضافة البيانات المخصصة
            if (!empty($solution_data['meta'])) {
                foreach ($solution_data['meta'] as $key => $value) {
                    update_post_meta($post_id, '_solution_' . $key, sanitize_text_field($value));
                }
            }
            
            $imported_count++;
        }
        
        return array(
            'imported' => $imported_count,
            'errors' => $errors
        );
    }
}

// إضافة صفحة إدارة في لوحة التحكم
add_action('admin_menu', 'muhtawaa_admin_menu');
function muhtawaa_admin_menu() {
    add_menu_page(
        __('إدارة محتوى', 'muhtawaa'),
        __('محتوى', 'muhtawaa'),
        'manage_options',
        'muhtawaa-admin',
        'muhtawaa_admin_page',
        'dashicons-lightbulb',
        30
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('إعدادات القالب', 'muhtawaa'),
        __('الإعدادات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-settings',
        'muhtawaa_settings_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الإحصائيات', 'muhtawaa'),
        __('الإحصائيات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-stats',
        'muhtawaa_stats_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الاستيراد والتصدير', 'muhtawaa'),
        __('استيراد/تصدير', 'muhtawaa'),
        'manage_options',
        'muhtawaa-import-export',
        'muhtawaa_import_export_page'
    );
}

function muhtawaa_admin_page() {
    ?>
    <div class="wrap">
        <h1>لوحة تحكم قالب محتوى</h1>
        
        <div class="muhtawaa-dashboard">
            <div class="dashboard-widgets">
                <?php muhtawaa_dashboard_stats_widget(); ?>
                <?php muhtawaa_dashboard_recent_activity(); ?>
                <?php muhtawaa_dashboard_quick_actions(); ?>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-dashboard {
        margin-top: 20px;
    }
    
    .dashboard-widgets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .dashboard-widget {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .dashboard-widget h3 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 15px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }
    
    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #667eea;
        display: block;
    }
    
    .stat-label {
        font-size: 0.9em;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_dashboard_stats_widget() {
    global $wpdb;
    
    $stats = array(
        'total_posts' => wp_count_posts()->publish,
        'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'")
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>📊 الإحصائيات العامة</h3>
        <div class="stat-grid">
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_posts']); ?></span>
                <span class="stat-label">حل منشور</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_subscribers']); ?></span>
                <span class="stat-label">مشترك</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['searches_today']); ?></span>
                <span class="stat-label">بحث اليوم</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></span>
                <span class="stat-label">إجمالي المشاهدات</span>
            </div>
        </div>
    </div>
    <?php
}

function muhtawaa_dashboard_recent_activity() {
    global $wpdb;
    
    $recent_searches = $wpdb->get_results(
        "SELECT search_term, COUNT(*) as count 
         FROM {$wpdb->prefix}muhtawaa_searches 
         WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
         GROUP BY search_term 
         ORDER BY count DESC 
         LIMIT 5"
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>🔍 أشهر البحثات هذا الأسبوع</h3>
        <?php if (!empty($recent_searches)): ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($recent_searches as $search): ?>
                    <li style="display: flex; justify-content: space-between; padding:
					$html .= "<li style='margin-bottom: 10px; padding: 10px; background: #f9f9f9; border-radius: 5px;'>";
        $html .= "<strong>$filename</strong><br>";
        $html .= "<small>التاريخ: $date | الحجم: $size</small><br>";
        $html .= "<a href='#' onclick='downloadBackup(\"$filename\")' class='button button-small' style='margin-top: 5px;'>تحميل</a>";
        $html .= "</li>";
    }
    
    $html .= '</ul>';
    
    wp_send_json_success($html);
}

// تحسين عرض الحقول المخصصة في قائمة المقالات
add_filter('manage_posts_columns', 'muhtawaa_add_admin_columns');
function muhtawaa_add_admin_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        
        if ($key === 'title') {
            $new_columns['solution_difficulty'] = 'الصعوبة';
            $new_columns['solution_stats'] = 'الإحصائيات';
            $new_columns['solution_meta'] = 'معلومات إضافية';
        }
    }
    
    return $new_columns;
}

add_action('manage_posts_custom_column', 'muhtawaa_show_admin_columns', 10, 2);
function muhtawaa_show_admin_columns($column, $post_id) {
    switch ($column) {
        case 'solution_difficulty':
            $difficulty = get_post_meta($post_id, '_solution_difficulty', true);
            if ($difficulty) {
                $color = muhtawaa_get_difficulty_color($difficulty);
                echo "<span style='background: $color; color: white; padding: 3px 8px; border-radius: 12px; font-size: 11px; font-weight: bold;'>$difficulty</span>";
            } else {
                echo '<span style="color: #999;">غير محدد</span>';
            }
            break;
            
        case 'solution_stats':
            $views = get_post_meta($post_id, '_total_views', true) ?: 0;
            $helpful = get_post_meta($post_id, '_helpful_count', true) ?: 0;
            $not_helpful = get_post_meta($post_id, '_not_helpful_count', true) ?: 0;
            $total_ratings = $helpful + $not_helpful;
            
            echo "<div style='font-size: 11px;'>";
            echo "<div>👀 " . number_format($views) . " مشاهدة</div>";
            
            if ($total_ratings > 0) {
                $percentage = round(($helpful / $total_ratings) * 100);
                $color = $percentage >= 70 ? 'green' : ($percentage >= 50 ? 'orange' : 'red');
                echo "<div style='color: $color;'>👍 $helpful | 👎 $not_helpful ($percentage%)</div>";
            } else {
                echo "<div style='color: #999;'>لا توجد تقييمات</div>";
            }
            echo "</div>";
            break;
            
        case 'solution_meta':
            $time = get_post_meta($post_id, '_solution_time', true);
            $cost = get_post_meta($post_id, '_solution_cost', true);
            $season = get_post_meta($post_id, '_solution_season', true);
            
            echo "<div style='font-size: 11px;'>";
            if ($time) echo "<div>⏱️ $time</div>";
            if ($cost) echo "<div>💰 $cost</div>";
            if ($season) echo "<div>🗓️ $season</div>";
            echo "</div>";
            break;
    }
}

// إضافة فلاتر سريعة في لوحة التحكم
add_action('restrict_manage_posts', 'muhtawaa_add_admin_filters');
function muhtawaa_add_admin_filters() {
    global $typenow;
    
    if ($typenow === 'post') {
        // فلتر الصعوبة
        $selected_difficulty = isset($_GET['difficulty_filter']) ? $_GET['difficulty_filter'] : '';
        echo '<select name="difficulty_filter">';
        echo '<option value="">جميع مستويات الصعوبة</option>';
        $difficulties = array('سهل جداً', 'سهل', 'متوسط', 'صعب', 'خبير');
        foreach ($difficulties as $difficulty) {
            printf('<option value="%s"%s>%s</option>', 
                $difficulty, 
                selected($selected_difficulty, $difficulty, false), 
                $difficulty
            );
        }
        echo '</select>';
        
        // فلتر الموسم
        $selected_season = isset($_GET['season_filter']) ? $_GET['season_filter'] : '';
        echo '<select name="season_filter">';
        echo '<option value="">جميع المواسم</option>';
        $seasons = array('الصيف', 'الشتاء', 'الربيع', 'الخريف');
        foreach ($seasons as $season) {
            printf('<option value="%s"%s>%s</option>', 
                $season, 
                selected($selected_season, $season, false), 
                $season
            );
        }
        echo '</select>';
    }
}

add_filter('parse_query', 'muhtawaa_handle_admin_filters');
function muhtawaa_handle_admin_filters($query) {
    global $pagenow;
    
    if ($pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'post') {
        $meta_query = array();
        
        if (!empty($_GET['difficulty_filter'])) {
            $meta_query[] = array(
                'key' => '_solution_difficulty',
                'value' => sanitize_text_field($_GET['difficulty_filter']),
                'compare' => '='
            );
        }
        
        if (!empty($_GET['season_filter'])) {
            $meta_query[] = array(
                'key' => '_solution_season',
                'value' => sanitize_text_field($_GET['season_filter']),
                'compare' => '='
            );
        }
        
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
    }
}

// تحسين أداء قاعدة البيانات
add_action('init', 'muhtawaa_optimize_database_queries');
function muhtawaa_optimize_database_queries() {
    // تمكين object caching للاستعلامات المتكررة
    add_filter('posts_pre_query', 'muhtawaa_cache_popular_queries', 10, 2);
}

function muhtawaa_cache_popular_queries($posts, $query) {
    // كاش للاستعلامات الشائعة مثل الصفحة الرئيسية
    if ($query->is_home() && $query->is_main_query()) {
        $cache_key = 'muhtawaa_home_posts';
        $cached_posts = wp_cache_get($cache_key);
        
        if ($cached_posts !== false) {
            return $cached_posts;
        }
        
        // إذا لم توجد في الكاش، دع الاستعلام يتم عادياً
        add_action('the_posts', function($posts) use ($cache_key) {
            wp_cache_set($cache_key, $posts, '', 15 * MINUTE_IN_SECONDS);
            return $posts;
        });
    }
    
    return $posts;
}

// تحسين السيو والبحث
add_action('wp_head', 'muhtawaa_add_structured_data');
function muhtawaa_add_structured_data() {
    if (is_single() && get_post_type() === 'post') {
        $post_id = get_the_ID();
        $difficulty = get_post_meta($post_id, '_solution_difficulty', true);
        $time = get_post_meta($post_id, '_solution_time', true);
        $materials = get_post_meta($post_id, '_solution_materials', true);
        $tools = get_post_meta($post_id, '_solution_tools', true);
        $cost = get_post_meta($post_id, '_solution_cost', true);
        
        $schema = array(
            "@context" => "https://schema.org/",
            "@type" => "HowTo",
            "name" => get_the_title(),
            "description" => get_the_excerpt(),
            "image" => get_the_post_thumbnail_url($post_id, 'large'),
            "totalTime" => $time,
            "estimatedCost" => array(
                "@type" => "MonetaryAmount",
                "currency" => "SAR",
                "value" => $cost
            ),
            "supply" => array(),
            "tool" => array(),
            "step" => array(),
            "author" => array(
                "@type" => "Organization",
                "name" => get_bloginfo('name'),
                "url" => home_url()
            ),
            "publisher" => array(
                "@type" => "Organization",
                "name" => get_bloginfo('name'),
                "url" => home_url(),
                "logo" => array(
                    "@type" => "ImageObject",
                    "url" => get_custom_logo() ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : ''
                )
            ),
            "datePublished" => get_the_date('c'),
            "dateModified" => get_the_modified_date('c'),
        );
        
        // إضافة المواد
        if ($materials) {
            $materials_array = explode("\n", $materials);
            foreach ($materials_array as $material) {
                $material = trim($material);
                if (!empty($material)) {
                    $schema['supply'][] = array(
                        "@type" => "HowToSupply",
                        "name" => $material
                    );
                }
            }
        }
        
        // إضافة الأدوات
        if ($tools) {
            $tools_array = explode("\n", $tools);
            foreach ($tools_array as $tool) {
                $tool = trim($tool);
                if (!empty($tool)) {
                    $schema['tool'][] = array(
                        "@type" => "HowToTool",
                        "name" => $tool
                    );
                }
            }
        }
        
        // إضافة الخطوات من المحتوى
        $content = get_the_content();
        $steps = explode("\n\n", strip_tags($content));
        $step_number = 1;
        
        foreach ($steps as $step) {
            $step = trim($step);
            if (!empty($step) && strlen($step) > 50) {
                $schema['step'][] = array(
                    "@type" => "HowToStep",
                    "name" => "الخطوة " . $step_number,
                    "text" => $step,
                    "position" => $step_number
                );
                $step_number++;
            }
        }
        
        echo '<script type="application/ld+json">';
        echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo '</script>' . "\n";
    }
}

// نظام التنبيهات والإشعارات المحسن
class MuhtawaaNotificationSystem {
    
    public static function send_notification($type, $title, $message, $user_id = null) {
        global $wpdb;
        
        $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
        
        // إنشاء الجدول إذا لم يكن موجوداً
        $wpdb->query("CREATE TABLE IF NOT EXISTS $notifications_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) DEFAULT 0,
            type varchar(50) NOT NULL,
            title varchar(255) NOT NULL,
            message text NOT NULL,
            is_read tinyint(1) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY type (type),
            KEY is_read (is_read)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        $wpdb->insert(
            $notifications_table,
            array(
                'user_id' => $user_id ?: 0,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'created_at' => current_time('mysql')
            ),
            array('%d', '%s', '%s', '%s', '%s')
        );
        
        // إرسال بريد إلكتروني للمديرين
        if (in_array($type, array('error', 'security', 'maintenance'))) {
            $admin_email = get_option('admin_email');
            wp_mail($admin_email, "[$type] $title", $message);
        }
    }
    
    public static function get_user_notifications($user_id, $unread_only = false) {
        global $wpdb;
        
        $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
        $where = "user_id = %d";
        $params = array($user_id);
        
        if ($unread_only) {
            $where .= " AND is_read = 0";
        }
        
        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $notifications_table WHERE $where ORDER BY created_at DESC LIMIT 20",
            ...$params
        ));
    }
    
    public static function mark_as_read($notification_id, $user_id) {
        global $wpdb;
        
        $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
        
        $wpdb->update(
            $notifications_table,
            array('is_read' => 1),
            array(
                'id' => $notification_id,
                'user_id' => $user_id
            ),
            array('%d'),
            array('%d', '%d')
        );
    }
}

// تحسين نظام التخزين المؤقت
add_action('init', 'muhtawaa_setup_caching');
function muhtawaa_setup_caching() {
    // تنظيف الكاش عند تحديث المقالات
    add_action('save_post', 'muhtawaa_clear_related_cache');
    add_action('delete_post', 'muhtawaa_clear_related_cache');
    
    // تنظيف كاش الفئات عند التحديث
    add_action('created_term', 'muhtawaa_clear_category_cache');
    add_action('edited_term', 'muhtawaa_clear_category_cache');
    add_action('delete_term', 'muhtawaa_clear_category_cache');
}

function muhtawaa_clear_related_cache($post_id) {
    if (get_post_type($post_id) === 'post') {
        // تنظيف كاش الصفحة الرئيسية
        wp_cache_delete('muhtawaa_home_posts');
        
        // تنظيف كاش التوصيات
        wp_cache_delete("smart_recommendations_$post_id");
        
        // تنظيف كاش الفئات المرتبطة
        $categories = wp_get_post_categories($post_id);
        foreach ($categories as $cat_id) {
            wp_cache_delete("category_posts_$cat_id");
        }
    }
}

function muhtawaa_clear_category_cache($term_id) {
    wp_cache_delete("category_posts_$term_id");
    wp_cache_delete('muhtawaa_categories_list');
}

// تحسين نظام البحث المتقدم
class MuhtawaaAdvancedSearch {
    
    public static function init() {
        add_action('wp_ajax_advanced_search', array(__CLASS__, 'handle_ajax_search'));
        add_action('wp_ajax_nopriv_advanced_search', array(__CLASS__, 'handle_ajax_search'));
        
        add_action('wp_ajax_search_suggestions', array(__CLASS__, 'get_search_suggestions'));
        add_action('wp_ajax_nopriv_search_suggestions', array(__CLASS__, 'get_search_suggestions'));
    }
    
    public static function handle_ajax_search() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        $search_term = sanitize_text_field($_POST['search_term'] ?? '');
        $category = sanitize_text_field($_POST['category'] ?? '');
        $difficulty = sanitize_text_field($_POST['difficulty'] ?? '');
        $season = sanitize_text_field($_POST['season'] ?? '');
        
        if (empty($search_term)) {
            wp_send_json_error('مصطلح البحث مطلوب');
        }
        
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            's' => $search_term,
            'posts_per_page' => 10,
            'meta_query' => array(),
            'tax_query' => array()
        );
        
        // إضافة فلتر الصعوبة
        if (!empty($difficulty)) {
            $args['meta_query'][] = array(
                'key' => '_solution_difficulty',
                'value' => $difficulty,
                'compare' => '='
            );
        }
        
        // إضافة فلتر الموسم
        if (!empty($season)) {
            $args['meta_query'][] = array(
                'key' => '_solution_season',
                'value' => $season,
                'compare' => '='
            );
        }
        
        // إضافة فلتر الفئة
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'solution_category',
                'field' => 'slug',
                'terms' => $category
            );
        }
        
        // البحث في الحقول المخصصة أيضاً
        add_filter('posts_search', array(__CLASS__, 'extend_search_to_meta'), 10, 2);
        
        $query = new WP_Query($args);
        
        remove_filter('posts_search', array(__CLASS__, 'extend_search_to_meta'), 10);
        
        $results = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                $categories = get_the_category();
                $category_name = !empty($categories) ? $categories[0]->name : '';
                
                $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
                $time = get_post_meta(get_the_ID(), '_solution_time', true);
                
                $results[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'excerpt' => wp_trim_words(get_the_excerpt(), 20),
                    'url' => get_permalink(),
                    'category' => $category_name,
                    'difficulty' => $difficulty,
                    'time' => $time,
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
                );
            }
            wp_reset_postdata();
        }
        
        // تسجيل البحث للإحصائيات
        self::log_search($search_term, count($results), $category, $difficulty, $season);
        
        wp_send_json_success(array(
            'results' => $results,
            'total' => $query->found_posts
        ));
    }
    
    public static function extend_search_to_meta($search, $query) {
        global $wpdb;
        
        if (!is_main_query() || !$query->is_search()) {
            return $search;
        }
        
        $search_term = $query->get('s');
        if (empty($search_term)) {
            return $search;
        }
        
        // البحث في الحقول المخصصة
        $meta_search = $wpdb->prepare("
            OR EXISTS (
                SELECT 1 FROM {$wpdb->postmeta} 
                WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                AND {$wpdb->postmeta}.meta_key IN ('_solution_materials', '_solution_tools', '_focus_keyword')
                AND {$wpdb->postmeta}.meta_value LIKE %s
            )",
            '%' . $wpdb->esc_like($search_term) . '%'
        );
        
        $search = preg_replace('/\)\s*$/', ') ' . $meta_search . ')', $search);
        
        return $search;
    }
    
    public static function get_search_suggestions() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        global $wpdb;
        
        $cache_key = 'muhtawaa_search_suggestions';
        $suggestions = wp_cache_get($cache_key);
        
        if ($suggestions === false) {
            // أشهر البحثات
            $popular_searches = $wpdb->get_results("
                SELECT search_term, COUNT(*) as count
                FROM {$wpdb->prefix}muhtawaa_searches
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                GROUP BY search_term
                ORDER BY count DESC
                LIMIT 8
            ", ARRAY_A);
            
            $suggestions = array();
            foreach ($popular_searches as $search) {
                $suggestions[] = $search['search_term'];
            }
            
            // إضافة اقتراحات افتراضية إذا لم توجد بحثات كافية
            if (count($suggestions) < 8) {
                $default_suggestions = array(
                    'تنظيف المنزل', 'توفير الكهرباء', 'حلول المطبخ',
                    'إزالة البقع', 'صيانة السيارة', 'حلول سريعة',
                    'توفير المال', 'تنظيف الفرن'
                );
                
                $suggestions = array_merge($suggestions, array_slice($default_suggestions, 0, 8 - count($suggestions)));
            }
            
            wp_cache_set($cache_key, $suggestions, '', HOUR_IN_SECONDS);
        }
        
        wp_send_json_success($suggestions);
    }
    
    private static function log_search($term, $results_count, $category = '', $difficulty = '', $season = '') {
        global $wpdb;
        
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        
        $filters = array();
        if (!empty($category)) $filters['category'] = $category;
        if (!empty($difficulty)) $filters['difficulty'] = $difficulty;
        if (!empty($season)) $filters['season'] = $season;
        
        $wpdb->insert(
            $searches_table,
            array(
                'search_term' => $term,
                'results_count' => $results_count,
                'user_id' => get_current_user_id(),
                'user_ip' => $_SERVER['REMOTE_ADDR'] ?? '',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                'source' => 'advanced_search',
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%d', '%s', '%s', '%s', '%s')
        );
    }
}

// تهيئة البحث المتقدم
MuhtawaaAdvancedSearch::init();

// إضافة دعم للتخصيص المتقدم
add_action('customize_register', 'muhtawaa_advanced_customizer');
function muhtawaa_advanced_customizer($wp_customize) {
    // قسم التخطيط
    $wp_customize->add_section('muhtawaa_layout', array(
        'title' => __('التخطيط والعرض', 'muhtawaa'),
        'priority' => 35,
    ));
    
    // عدد المقالات في الصفحة الرئيسية
    $wp_customize->add_setting('muhtawaa_posts_per_page', array(
        'default' => 6,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('muhtawaa_posts_per_page', array(
        'label' => __('عدد المقالات في الصفحة', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 12,
            'step' => 3,
        ),
    ));
    
    // نمط عرض الشبكة
    $wp_customize->add_setting('muhtawaa_grid_style', array(
        'default' => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('muhtawaa_grid_style', array(
        'label' => __('نمط عرض المقالات', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'select',
        'choices' => array(
            'grid' => 'شبكة (Grid)',
            'masonry' => 'مختلط الأحجام (Masonry)',
            'list' => 'قائمة (List)',
        ),
    ));
    
    // إظهار/إخفاء العناصر
    $wp_customize->add_setting('muhtawaa_show_breadcrumbs', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('muhtawaa_show_breadcrumbs', array(
        'label' => __('إظهار مسار التنقل', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting('muhtawaa_show_reading_time', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('muhtawaa_show_reading_time', array(
        'label' => __('إظهار وقت القراءة المتوقع', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'checkbox',
    ));
}

// دالة حساب وقت القراءة
function muhtawaa_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 كلمة في الدقيقة (متوسط للعربية)
    
    if ($reading_time === 1) {
        return 'دقيقة واحدة';
    } elseif ($reading_time < 3) {
        return $reading_time . ' دقيقتان';
    } elseif ($reading_time < 11) {
        return $reading_time . ' دقائق';
    } else {
        return $reading_time . ' دقيقة';
    }
}

// تحديث وقت القراءة تلقائياً عند حفظ المقال
add_action('save_post', 'muhtawaa_update_reading_time');
function muhtawaa_update_reading_time($post_id) {
    if (get_post_type($post_id) === 'post') {
        $reading_time = muhtawaa_reading_time($post_id);
        update_post_meta($post_id, '_reading_time', $reading_time);
    }
}

// دالة إنشاء الفئات الافتراضية مع أيقونات
function muhtawaa_create_default_categories_with_icons() {
    $categories = array(
        array(
            'name' => 'المنزل والتنظيف',
            'description' => 'حلول عملية للتنظيف والترتيب المنزلي',
            'icon' => '🏠',
            'color' => '#4CAF50'
        ),
        array(
            'name' => 'المطبخ والطبخ',
            'description' => 'نصائح وحيل للمطبخ والطبخ',
            'icon' => '🍳',
            'color' => '#FF9800'
        ),
        array(
            'name' => 'توفير المال',
            'description' => 'طرق ذكية لتوفير المال في الحياة اليومية',
            'icon' => '💰',
            'color' => '#2196F3'
        ),
        array(
            'name' => 'السيارات',
            'description' => 'نصائح صيانة وحلول لمشاكل السيارات',
            'icon' => '🚗',
            'color' => '#9C27B0'
        ),
        array(
            'name' =>                    <li style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee;">
                        <span><?php echo esc_html($search->search_term); ?></span>
                        <span style="background: #667eea; color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.8em;">
                            <?php echo $search->count; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: #666; text-align: center; margin: 20px 0;">لا توجد بحثات هذا الأسبوع</p>
        <?php endif; ?>
    </div>
    <?php
}

function muhtawaa_dashboard_quick_actions() {
    ?>
    <div class="dashboard-widget">
        <h3>⚡ إجراءات سريعة</h3>
        <div style="display: grid; gap: 10px;">
            <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-primary" style="text-align: center;">
                ➕ إضافة حل جديد
            </a>
            <a href="<?php echo admin_url('edit-tags.php?taxonomy=solution_category'); ?>" class="button" style="text-align: center;">
                🗂️ إدارة الفئات
            </a>
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-stats'); ?>" class="button" style="text-align: center;">
                📈 عرض الإحصائيات التفصيلية
            </a>
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-import-export'); ?>" class="button" style="text-align: center;">
                📤 استيراد/تصدير البيانات
            </a>
        </div>
        
        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
            <h4>🔧 صيانة سريعة</h4>
            <button onclick="performMaintenance()" class="button" style="width: 100%;">
                تشغيل الصيانة الآن
            </button>
            <button onclick="createBackup()" class="button" style="width: 100%; margin-top: 5px;">
                إنشاء نسخة احتياطية
            </button>
        </div>
    </div>
    
    <script>
    function performMaintenance() {
        if (confirm('هل تريد تشغيل الصيانة الآن؟ قد يستغرق هذا بضع دقائق.')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_maintenance',
                nonce: '<?php echo wp_create_nonce('muhtawaa_maintenance'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تمت الصيانة بنجاح!');
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    
    function createBackup() {
        if (confirm('هل تريد إنشاء نسخة احتياطية؟')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_backup',
                nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تم إنشاء النسخة الاحتياطية بنجاح!');
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    </script>
    <?php
}

// صفحة الإعدادات
function muhtawaa_settings_page() {
    if (isset($_POST['submit'])) {
        $theme = MuhtawaaTheme::getInstance();
        
        $settings = array(
            'theme_color_primary' => sanitize_hex_color($_POST['primary_color']),
            'theme_color_secondary' => sanitize_hex_color($_POST['secondary_color']),
            'enable_smart_recommendations' => isset($_POST['enable_recommendations']) ? 'yes' : 'no',
            'enable_advanced_search' => isset($_POST['enable_search']) ? 'yes' : 'no',
            'enable_rating_system' => isset($_POST['enable_rating']) ? 'yes' : 'no',
            'notification_email' => sanitize_email($_POST['notification_email']),
            'max_recommendations' => intval($_POST['max_recommendations']),
            'search_suggestions_count' => intval($_POST['search_suggestions']),
            'auto_backup_enabled' => isset($_POST['auto_backup']) ? 'yes' : 'no',
            'auto_backup_frequency' => sanitize_text_field($_POST['backup_frequency']),
        );
        
        foreach ($settings as $key => $value) {
            $theme->update_theme_setting($key, $value);
        }
        
        echo '<div class="notice notice-success"><p>تم حفظ الإعدادات بنجاح!</p></div>';
    }
    
    $theme = MuhtawaaTheme::getInstance();
    ?>
    
    <div class="wrap">
        <h1>إعدادات قالب محتوى</h1>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">اللون الأساسي</th>
                    <td>
                        <input type="color" name="primary_color" value="<?php echo esc_attr($theme->get_theme_setting('theme_color_primary', '#667eea')); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">اللون الثانوي</th>
                    <td>
                        <input type="color" name="secondary_color" value="<?php echo esc_attr($theme->get_theme_setting('theme_color_secondary', '#764ba2')); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">التوصيات الذكية</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_recommendations" <?php checked($theme->get_theme_setting('enable_smart_recommendations'), 'yes'); ?> />
                            تمكين نظام التوصيات الذكية
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">البحث المتقدم</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_search" <?php checked($theme->get_theme_setting('enable_advanced_search'), 'yes'); ?> />
                            تمكين البحث المتقدم في الحقول المخصصة
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">نظام التقييم</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_rating" <?php checked($theme->get_theme_setting('enable_rating_system'), 'yes'); ?> />
                            تمكين نظام تقييم الحلول
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">بريد الإشعارات</th>
                    <td>
                        <input type="email" name="notification_email" value="<?php echo esc_attr($theme->get_theme_setting('notification_email', get_option('admin_email'))); ?>" class="regular-text" />
                        <p class="description">البريد الذي ستُرسل إليه إشعارات النظام</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">عدد التوصيات</th>
                    <td>
                        <input type="number" name="max_recommendations" value="<?php echo esc_attr($theme->get_theme_setting('max_recommendations', '5')); ?>" min="3" max="10" />
                        <p class="description">الحد الأقصى لعدد التوصيات المعروضة</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">اقتراحات البحث</th>
                    <td>
                        <input type="number" name="search_suggestions" value="<?php echo esc_attr($theme->get_theme_setting('search_suggestions_count', '8')); ?>" min="5" max="15" />
                        <p class="description">عدد اقتراحات البحث المعروضة</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">النسخ الاحتياطية التلقائية</th>
                    <td>
                        <label>
                            <input type="checkbox" name="auto_backup" <?php checked($theme->get_theme_setting('auto_backup_enabled'), 'yes'); ?> />
                            تمكين النسخ الاحتياطية التلقائية
                        </label>
                        <br><br>
                        <select name="backup_frequency">
                            <option value="daily" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'daily'); ?>>يومياً</option>
                            <option value="weekly" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'weekly'); ?>>أسبوعياً</option>
                            <option value="monthly" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'monthly'); ?>>شهرياً</option>
                        </select>
                    </td>
                </tr>
            </table>
            
            <?php submit_button('حفظ الإعدادات'); ?>
        </form>
    </div>
    <?php
}

// صفحة الإحصائيات
function muhtawaa_stats_page() {
    global $wpdb;
    
    // الحصول على الإحصائيات
    $stats = array(
        'posts' => wp_count_posts()->publish,
        'categories' => wp_count_terms('solution_category'),
        'subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'searches_week' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)"),
    );
    
    // أشهر الحلول
    $top_solutions = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm.meta_value as views
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_total_views'
        WHERE p.post_status = 'publish' AND p.post_type = 'post'
        ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
        LIMIT 10
    ");
    
    // أشهر البحثات
    $top_searches = $wpdb->get_results("
        SELECT search_term, COUNT(*) as count
        FROM {$wpdb->prefix}muhtawaa_searches
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY search_term
        ORDER BY count DESC
        LIMIT 10
    ");
    ?>
    
    <div class="wrap">
        <h1>إحصائيات مفصلة</h1>
        
        <div class="muhtawaa-stats-dashboard">
            <!-- إحصائيات عامة -->
            <div class="stats-section">
                <h2>📊 الإحصائيات العامة</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['posts']); ?></div>
                        <div class="stat-label">حل منشور</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['categories']); ?></div>
                        <div class="stat-label">فئة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['subscribers']); ?></div>
                        <div class="stat-label">مشترك</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></div>
                        <div class="stat-label">إجمالي المشاهدات</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['searches_today']); ?></div>
                        <div class="stat-label">بحث اليوم</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['searches_week']); ?></div>
                        <div class="stat-label">بحث هذا الأسبوع</div>
                    </div>
                </div>
            </div>
            
            <!-- أشهر الحلول -->
            <div class="stats-section">
                <h2>🔥 أشهر الحلول</h2>
                <div class="top-list">
                    <?php if (!empty($top_solutions)): ?>
                        <?php foreach ($top_solutions as $index => $solution): ?>
                            <div class="top-item">
                                <span class="rank">#<?php echo $index + 1; ?></span>
                                <span class="title">
                                    <a href="<?php echo get_edit_post_link($solution->ID); ?>" target="_blank">
                                        <?php echo esc_html($solution->post_title); ?>
                                    </a>
                                </span>
                                <span class="count"><?php echo number_format($solution->views ?: 0); ?> مشاهدة</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>لا توجد بيانات مشاهدات بعد</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- أشهر البحثات -->
            <div class="stats-section">
                <h2>🔍 أشهر البحثات (آخر 30 يوم)</h2>
                <div class="top-list">
                    <?php if (!empty($top_searches)): ?>
                        <?php foreach ($top_searches as $index => $search): ?>
                            <div class="top-item">
                                <span class="rank">#<?php echo $index + 1; ?></span>
                                <span class="title"><?php echo esc_html($search->search_term); ?></span>
                                <span class="count"><?php echo number_format($search->count); ?> مرة</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>لا توجد بحثات مسجلة</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-stats-dashboard {
        margin-top: 20px;
    }
    
    .stats-section {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .stats-section h2 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .stat-card {
        text-align: center;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .stat-number {
        font-size: 2.5em;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 1.1em;
        opacity: 0.9;
    }
    
    .top-list {
        margin-top: 20px;
    }
    
    .top-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #eee;
        transition: background 0.3s;
    }
    
    .top-item:hover {
        background: #f8f9fa;
    }
    
    .top-item .rank {
        font-weight: bold;
        color: #667eea;
        width: 40px;
        flex-shrink: 0;
    }
    
    .top-item .title {
        flex: 1;
        margin: 0 15px;
    }
    
    .top-item .title a {
        text-decoration: none;
        color: #333;
    }
    
    .top-item .title a:hover {
        color: #667eea;
    }
    
    .top-item .count {
        font-weight: bold;
        color: #48bb78;
        background: #f0fff4;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }
    </style>
    <?php
}

// صفحة الاستيراد والتصدير
function muhtawaa_import_export_page() {
    if (isset($_POST['export_solutions'])) {
        $format = sanitize_text_field($_POST['export_format']);
        
    }
    
    if (isset($_POST['import_solutions']) && isset($_FILES['import_file'])) {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $_FILES['import_file']['name'];
        
        if (move_uploaded_file($_FILES['import_file']['tmp_name'], $file_path)) {
            $result = 
            
            if (is_wp_error($result)) {
                echo '<div class="notice notice-error"><p>خطأ: ' . $result->get_error_message() . '</p></div>';
            } else {
                echo '<div class="notice notice-success"><p>تم استيراد ' . $result['imported'] . ' حل بنجاح!</p></div>';
                if (!empty($result['errors'])) {
                    echo '<div class="notice notice-warning"><p>الأخطاء: ' . implode(', ', $result['errors']) . '</p></div>';
                }
            }
            
            unlink($file_path); // حذف الملف المؤقت
        }
    }
    ?>
    
    <div class="wrap">
        <h1>الاستيراد والتصدير</h1>
        
        <div class="muhtawaa-import-export">
            <!-- تصدير البيانات -->
            <div class="export-section">
                <h2>📤 تصدير الحلول</h2>
                <p>يمكنك تصدير جميع الحلول المنشورة مع بياناتها المخصصة.</p>
                
                <form method="post" style="margin-top: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">تنسيق التصدير</th>
                            <td>
                                <label>
                                    <input type="radio" name="export_format" value="json" checked />
                                    JSON (موصى به للاستيراد لاحقاً)
                                </label>
                                <br>
                                <label>
                                    
                                    CSV (لفتح في Excel أو Google Sheets)
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" name="export_solutions" class="button button-primary" value="تصدير الحلول" />
                    </p>
                </form>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- استيراد البيانات -->
            <div class="import-section">
                <h2>📥 استيراد الحلول</h2>
                <p>يمكنك استيراد حلول من ملف JSON. سيتم استيراد الحلول كمسودات للمراجعة.</p>
                
                <div class="import-instructions" style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0;">
                    <h4>تعليمات الاستيراد:</h4>
                    <ul>
                        <li>يجب أن يكون الملف بصيغة JSON</li>
                        <li>سيتم استيراد الحلول كمسودات</li>
                        <li>ستحتاج لمراجعة وموافقة على كل حل</li>
                        <li>تأكد من صحة البيانات قبل الاستيراد</li>
                    </ul>
                </div>
                
                <form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">ملف JSON</th>
                            <td>
                                <input type="file" name="import_file" accept=".json" required />
                                <p class="description">اختر ملف JSON يحتوي على بيانات الحلول</p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" name="import_solutions" class="button button-primary" value="استيراد الحلول" 
                               onclick="return confirm('هل أنت متأكد من استيراد البيانات؟ سيتم إنشاء مقالات جديدة.')" />
                    </p>
                </form>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- النسخ الاحتياطية -->
            <div class="backup-section">
                <h2>💾 النسخ الاحتياطية</h2>
                <p>يمكنك إنشاء وإدارة النسخ الاحتياطية لبيانات القالب.</p>
                
                <div style="margin: 20px 0;">
                    <button onclick="createManualBackup()" class="button button-secondary">
                        إنشاء نسخة احتياطية الآن
                    </button>
                    
                    <button onclick="listBackups()" class="button" style="margin-right: 10px;">
                        عرض النسخ الاحتياطية
                    </button>
                </div>
                
                <div id="backup-list" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-import-export {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 30px;
        margin-top: 20px;
    }
    
    .export-section h2,
    .import-section h2,
    .backup-section h2 {
        color: #667eea;
        margin-bottom: 15px;
    }
    
    .import-instructions {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 15px;
        margin: 20px 0;
    }
    
    .import-instructions h4 {
        margin-top: 0;
        color: #856404;
    }
    
    .import-instructions ul {
        margin-bottom: 0;
        color: #856404;
    }
    </style>
    
    <script>
    function createManualBackup() {
        if (confirm('هل تريد إنشاء نسخة احتياطية؟')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_backup',
                nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تم إنشاء النسخة الاحتياطية بنجاح!');
                    listBackups();
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    
    function listBackups() {
        jQuery.post(ajaxurl, {
            action: 'muhtawaa_list_backups',
            nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
        }, function(response) {
            if (response.success) {
                jQuery('#backup-list').html(response.data);
            } else {
                jQuery('#backup-list').html('<p>لا توجد نسخ احتياطية</p>');
            }
        });
    }
    </script>
    <?php
}

// إجراءات AJAX للصيانة والنسخ الاحتياطية
add_action('wp_ajax_muhtawaa_manual_maintenance', 'muhtawaa_handle_manual_maintenance');
function muhtawaa_handle_manual_maintenance() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_maintenance') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $theme = MuhtawaaTheme::getInstance();
    $theme->daily_maintenance();
    
    wp_send_json_success('تمت الصيانة بنجاح');
}

add_action('wp_ajax_muhtawaa_manual_backup', 'muhtawaa_handle_manual_backup');
function muhtawaa_handle_manual_backup() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_backup') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $theme = MuhtawaaTheme::getInstance();
    $backup_file = $theme->create_backup();
    
    if ($backup_file) {
        wp_send_json_success('تم إنشاء النسخة الاحتياطية: ' . basename($backup_file));
    } else {
        wp_send_json_error('فشل في إنشاء النسخة الاحتياطية');
    }
}

add_action('wp_ajax_muhtawaa_list_backups', 'muhtawaa_handle_list_backups');
function muhtawaa_handle_list_backups() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_backup') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $upload_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
    
    if (!file_exists($upload_dir)) {
        wp_send_json_success('<p>لا توجد نسخ احتياطية</p>');
        return;
    }
    
    $backups = glob($upload_dir . 'backup-*.sql');
    
    if (empty($backups)) {
        wp_send_json_success('<p>لا توجد نسخ احتياطية</p>');
        return;
    }
    
    usort($backups, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });
    
    $html = '<h4>النسخ الاحتياطية المتاحة:</h4><ul>';
    
    foreach ($backups as $backup) {
        $filename = basename($backup);
        $size = size_format(filesize($backup));
        $date = date('Y-m-d H:i:s', filemtime($backup));
        
        $html .= "<li style='margin-bottom: 10px; padding: 10px; background: #f9f9f9; border-<?php
/**
 * Theme Name: محتوى - الحلول اليومية
 * Functions and definitions - النسخة المطورة والمحسنة
 * 
 * @package Muhtawaa
 * @version 2.0
 */

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ثوابت القالب المطورة
define('THEME_VERSION', '2.0');
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_ASSETS_URL', THEME_URL . '/assets');
define('THEME_INC_PATH', THEME_PATH . '/inc');
define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');

// فئة إدارة القالب الرئيسية
class MuhtawaaTheme {
    
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('init', array($this, 'init_features'));
        add_action('customize_register', array($this, 'customize_register'));
        add_action('wp_head', array($this, 'add_meta_tags'));
        
        // تحميل ملفات النظام
        $this->load_includes();
        
        // إعداد نظام الصيانة التلقائية
        $this->setup_maintenance_system();
        
        // إعداد نظام الإشعارات المحسن
        $this->setup_notification_system();
    }
    
    /**
     * إعداد القالب الأساسي
     */
    public function setup() {
        // دعم اللغة العربية
        load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
        
        // دعم ميزات ووردبريس المتقدمة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 
            'gallery', 'caption', 'script', 'style'
        ));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', array(
            'height' => 100, 'width' => 300,
            'flex-height' => true, 'flex-width' => true,
        ));
        add_theme_support('post-formats', array(
            'aside', 'gallery', 'link', 'image', 'quote', 
            'status', 'video', 'audio', 'chat'
        ));
        add_theme_support('custom-background');
        add_theme_support('custom-header');
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        
        // تسجيل القوائم المحسنة
        register_nav_menus(array(
            'main-menu' => __('القائمة الرئيسية', 'muhtawaa'),
            'footer-menu' => __('قائمة التذييل', 'muhtawaa'),
            'mobile-menu' => __('قائمة الجوال', 'muhtawaa'),
            'social-menu' => __('قائمة وسائل التواصل', 'muhtawaa'),
        ));
        
        // أحجام الصور المخصصة المحسنة
        add_image_size('solution-thumbnail', 400, 300, true);
        add_image_size('solution-large', 800, 600, true);
        add_image_size('solution-featured', 1200, 600, true);
        add_image_size('category-icon', 150, 150, true);
        add_image_size('author-avatar', 100, 100, true);
        
        // إعداد RSS محسن
        add_theme_support('automatic-feed-links');
        
        // إعداد محرر المحتوى
        add_editor_style('assets/css/editor.css');
    }
    
    /**
     * تحميل ملفات CSS و JavaScript المحسنة
     */
    public function enqueue_scripts() {
        // ملفات CSS المحسنة
        wp_enqueue_style('muhtawaa-style', get_stylesheet_uri(), array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-main', THEME_ASSETS_URL . '/css/main.css', array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-custom', THEME_ASSETS_URL . '/css/custom.css', array('muhtawaa-main'), THEME_VERSION);
        
        // Font Awesome محسن
        wp_enqueue_style('font-awesome', 
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', 
            array(), '6.4.0'
        );
        
        // Google Fonts للعربية
        wp_enqueue_style('google-fonts', 
            'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap',
            array(), THEME_VERSION
        );
        
        // jQuery مع fallback
        wp_enqueue_script('jquery');
        
        // ملفات JavaScript المحسنة
        wp_enqueue_script('muhtawaa-main', 
            THEME_ASSETS_URL . '/js/main.js', 
            array('jquery'), THEME_VERSION, true
        );
        
        wp_enqueue_script('muhtawaa-enhanced', 
            THEME_ASSETS_URL . '/js/enhanced.js', 
            array('muhtawaa-main'), THEME_VERSION, true
        );
        
        // متغيرات JavaScript محسنة
        wp_localize_script('muhtawaa-main', 'muhtawaaAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_nonce'),
            'postId' => get_the_ID() ?: 0,
            'homeUrl' => home_url(),
            'themeUrl' => THEME_URL,
            'currentUserId' => get_current_user_id(),
            'isAdmin' => current_user_can('manage_options'),
            'locale' => get_locale(),
            'strings' => array(
                'loading' => __('جاري التحميل...', 'muhtawaa'),
                'error' => __('حدث خطأ', 'muhtawaa'),
                'success' => __('تم بنجاح', 'muhtawaa'),
                'confirm' => __('هل أنت متأكد؟', 'muhtawaa'),
                'noResults' => __('لا توجد نتائج', 'muhtawaa'),
                'loadMore' => __('تحميل المزيد', 'muhtawaa'),
                'searchPlaceholder' => __('ابحث عن حل...', 'muhtawaa'),
            ),
            'settings' => $this->get_theme_settings(),
        ));
        
        // تحميل ملف التعليقات إذا لزم الأمر
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        
        // Lazy loading للصور
        wp_enqueue_script('muhtawaa-lazyload', 
            THEME_ASSETS_URL . '/js/lazyload.js', 
            array(), THEME_VERSION, true
        );
    }
    
    /**
     * تسجيل مناطق الودجات المحسنة
     */
    public function widgets_init() {
        // الشريط الجانبي الرئيسي
        register_sidebar(array(
            'name' => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
            'id' => 'sidebar-main',
            'description' => __('الشريط الجانبي للصفحات الفردية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // شريط جانبي للصفحة الرئيسية
        register_sidebar(array(
            'name' => __('شريط الصفحة الرئيسية', 'muhtawaa'),
            'id' => 'sidebar-home',
            'description' => __('شريط جانبي خاص بالصفحة الرئيسية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // مناطق تذييل الموقع
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name' => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
                'id' => "footer-{$i}",
                'description' => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ));
        }
        
        // منطقة ما قبل المحتوى
        register_sidebar(array(
            'name' => __('ما قبل المحتوى', 'muhtawaa'),
            'id' => 'before-content',
            'description' => __('تظهر قبل محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="pre-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // منطقة ما بعد المحتوى
        register_sidebar(array(
            'name' => __('ما بعد المحتوى', 'muhtawaa'),
            'id' => 'after-content',
            'description' => __('تظهر بعد محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="post-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
    
    /**
     * تحميل ملفات النظام المطلوبة
     */
    private function load_includes() {
        $includes = array(
            'ajax-functions.php',
            'theme-settings.php',
            'customizer.php',
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
            'admin-dashboard.php',
        );
        
        foreach ($includes as $file) {
            $file_path = THEME_INC_PATH . '/' . $file;
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }
    }
    
    /**
     * تهيئة ميزات القالب المحسنة
     */
    public function init_features() {
        // إنشاء التصنيفات المخصصة
        $this->create_custom_taxonomies();
        
        // إنشاء أنواع المحتوى المخصصة
        $this->create_custom_post_types();
        
        // إنشاء الجداول المطلوبة
        $this->create_database_tables();
        
        // إعداد نظام البحث المحسن
        add_action('pre_get_posts', array($this, 'enhance_search'));
        
        // إعداد نظام التوصيات الذكية
        add_action('wp_footer', array($this, 'load_smart_recommendations'));
        
        // تحسين الأمان
        $this->enhance_security();
        
        // تحسين الأداء
        $this->enhance_performance();
    }
    
    /**
     * إنشاء التصنيفات المخصصة المحسنة
     */
    private function create_custom_taxonomies() {
        // تصنيف فئات الحلول
        register_taxonomy('solution_category', 'post', array(
            'labels' => array(
                'name' => __('فئات الحلول', 'muhtawaa'),
                'singular_name' => __('فئة الحلول', 'muhtawaa'),
                'menu_name' => __('فئات الحلول', 'muhtawaa'),
                'all_items' => __('جميع الفئات', 'muhtawaa'),
                'edit_item' => __('تعديل الفئة', 'muhtawaa'),
                'view_item' => __('مشاهدة الفئة', 'muhtawaa'),
                'update_item' => __('تحديث الفئة', 'muhtawaa'),
                'add_new_item' => __('إضافة فئة جديدة', 'muhtawaa'),
                'new_item_name' => __('اسم الفئة الجديدة', 'muhtawaa'),
                'search_items' => __('البحث في الفئات', 'muhtawaa'),
                'not_found' => __('لم يتم العثور على فئات', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'solutions'),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
            'meta_box_cb' => 'post_categories_meta_box',
        ));
        
        // تصنيف مستوى الصعوبة
        register_taxonomy('difficulty_level', 'post', array(
            'labels' => array(
                'name' => __('مستويات الصعوبة', 'muhtawaa'),
                'singular_name' => __('مستوى الصعوبة', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
        
        // تصنيف الكلمات المفتاحية للحلول
        register_taxonomy('solution_tags', 'post', array(
            'labels' => array(
                'name' => __('كلمات مفتاحية للحلول', 'muhtawaa'),
                'singular_name' => __('كلمة مفتاحية', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
    }
    
    /**
     * إنشاء أنواع المحتوى المخصصة
     */
    private function create_custom_post_types() {
        // نوع محتوى للتوصيات
        register_post_type('recommendation', array(
            'labels' => array(
                'name' => __('التوصيات', 'muhtawaa'),
                'singular_name' => __('توصية', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-lightbulb',
        ));
        
        // نوع محتوى للإشعارات
        register_post_type('notification', array(
            'labels' => array(
                'name' => __('الإشعارات', 'muhtawaa'),
                'singular_name' => __('إشعار', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor'),
            'menu_icon' => 'dashicons-bell',
        ));
    }
    
    /**
     * إنشاء الجداول المطلوبة
     */
    private function create_database_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // جدول الإحصائيات المحسن
        $stats_table = $wpdb->prefix . 'muhtawaa_stats';
        $sql_stats = "CREATE TABLE IF NOT EXISTS $stats_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) DEFAULT 0,
            action_type varchar(50) NOT NULL,
            action_value text,
            user_ip varchar(45),
            user_agent text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            KEY user_id (user_id),
            KEY action_type (action_type),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول المشتركين المحسن
        $subscribers_table = $wpdb->prefix . 'muhtawaa_subscribers';
        $sql_subscribers = "CREATE TABLE IF NOT EXISTS $subscribers_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            email varchar(100) NOT NULL,
            name varchar(100),
            preferences text,
            status varchar(20) DEFAULT 'active',
            source varchar(50) DEFAULT 'website',
            confirmation_token varchar(255),
            confirmed_at datetime,
            last_email_sent datetime,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY email (email),
            KEY status (status),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول البحثات المحسن
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            search_term varchar(255) NOT NULL,
            results_count int(11) DEFAULT 0,
            clicked_result_id bigint(20) DEFAULT 0,
            user_id bigint(20) DEFAULT 0,
            user_ip varchar(45),
            user_agent text,
            source varchar(50) DEFAULT 'website',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY search_term (search_term),
            KEY user_id (user_id),
            KEY created_at (created_at),
            FULLTEXT KEY search_term_fulltext (search_term)
        ) $charset_collate;";
        
        // جدول التوصيات الذكية
        $recommendations_table = $wpdb->prefix . 'muhtawaa_recommendations';
        $sql_recommendations = "CREATE TABLE IF NOT EXISTS $recommendations_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) DEFAULT 0,
            post_id bigint(20) NOT NULL,
            recommended_post_id bigint(20) NOT NULL,
            recommendation_type varchar(50) NOT NULL,
            score decimal(5,2) DEFAULT 0.00,
            shown_count int(11) DEFAULT 0,
            clicked_count int(11) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY post_id (post_id),
            KEY recommended_post_id (recommended_post_id),
            KEY recommendation_type (recommendation_type)
        ) $charset_collate;";
        
        // جدول إعدادات القالب
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $sql_settings = "CREATE TABLE IF NOT EXISTS $settings_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            setting_key varchar(100) NOT NULL,
            setting_value longtext,
            setting_type varchar(50) DEFAULT 'string',
            autoload varchar(20) DEFAULT 'yes',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY setting_key (setting_key),
            KEY autoload (autoload)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_stats);
        dbDelta($sql_subscribers);
        dbDelta($sql_searches);
        dbDelta($sql_recommendations);
        dbDelta($sql_settings);
        
        // إدراج الإعدادات الافتراضية
        $this->insert_default_settings();
    }
    
    /**
     * إدراج الإعدادات الافتراضية
     */
    private function insert_default_settings() {
        $default_settings = array(
            'theme_color_primary' => '#667eea',
            'theme_color_secondary' => '#764ba2',
            'enable_smart_recommendations' => 'yes',
            'enable_advanced_search' => 'yes',
            'enable_rating_system' => 'yes',
            'maintenance_mode' => 'no',
            'notification_email' => get_option('admin_email'),
            'max_recommendations' => '5',
            'search_suggestions_count' => '8',
            'auto_backup_enabled' => 'yes',
            'auto_backup_frequency' => 'weekly',
        );
        
        foreach ($default_settings as $key => $value) {
            $this->update_theme_setting($key, $value);
        }
    }
    
    /**
     * تحسين نظام البحث
     */
    public function enhance_search($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            // البحث في العنوان والمحتوى والحقول المخصصة
            $search_term = $query->get('s');
            
            if (!empty($search_term)) {
                // إضافة البحث في الحقول المخصصة
                $meta_query = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_solution_materials',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_solution_description',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                );
                
                $query->set('meta_query', $meta_query);
                
                // البحث في التصنيفات أيضاً
                $tax_query = array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'solution_category',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                    array(
                        'taxonomy' => 'solution_tags',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                );
                
                $query->set('tax_query', $tax_query);
                
                // تسجيل البحث للإحصائيات
                $this->log_search($search_term, $query->found_posts);
            }
        }
        
        return $query;
    }
    
    /**
     * تسجيل البحث في قاعدة البيانات
     */
    private function log_search($search_term, $results_count = 0) {
        global $wpdb;
        
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        
        $wpdb->insert(
            $searches_table,
            array(
                'search_term' => sanitize_text_field($search_term),
                'results_count' => intval($results_count),
                'user_id' => get_current_user_id(),
                'user_ip' => $this->get_user_ip(),
                'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%d', '%s', '%s', '%s')
        );
    }
    
    /**
     * الحصول على عنوان IP المستخدم
     */
    private function get_user_ip() {
        $ip_keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    }
    
    /**
     * إعداد نظام الصيانة التلقائية
     */
    private function setup_maintenance_system() {
        // جدولة تنظيف قاعدة البيانات
        if (!wp_next_scheduled('muhtawaa_daily_maintenance')) {
            wp_schedule_event(time(), 'daily', 'muhtawaa_daily_maintenance');
        }
        
        add_action('muhtawaa_daily_maintenance', array($this, 'daily_maintenance'));
        
        // جدولة النسخ الاحتياطية
        if (!wp_next_scheduled('muhtawaa_weekly_backup')) {
            wp_schedule_event(time(), 'weekly', 'muhtawaa_weekly_backup');
        }
        
        add_action('muhtawaa_weekly_backup', array($this, 'create_backup'));
    }
    
    /**
     * الصيانة اليومية
     */
    public function daily_maintenance() {
        global $wpdb;
        
        // تنظيف البيانات القديمة (أكثر من 6 أشهر)
        $six_months_ago = date('Y-m-d H:i:s', strtotime('-6 months'));
        
        // حذف الإحصائيات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_stats WHERE created_at < %s",
            $six_months_ago
        ));
        
        // حذف البحثات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < %s",
            $six_months_ago
        ));
        
        // تنظيف transients منتهية الصلاحية
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%' AND option_name NOT IN (SELECT CONCAT('_transient_', SUBSTRING(option_name, 19)) FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%')");
        
        // تحسين الجداول
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE $table");
        }
        
        // إرسال تقرير الصيانة
        $this->send_maintenance_report();
    }
    
    /**
     * إنشاء نسخة احتياطية
     */
    public function create_backup() {
        if ($this->get_theme_setting('auto_backup_enabled') !== 'yes') {
            return;
        }
        
        global $wpdb;
        
        $backup_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
        if (!file_exists($backup_dir)) {
            wp_mkdir_p($backup_dir);
        }
        
        $backup_file = $backup_dir . 'backup-' . date('Y-m-d-H-i-s') . '.sql';
        
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        $sql_dump = "-- Muhtawaa Theme Backup\n";
        $sql_dump .= "-- Created: " . date('Y-m-d H:i:s') . "\n\n";
        
        foreach ($tables as $table) {
            $result = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
            
            if (!empty($result)) {
                $sql_dump .= "-- Table: $table\n";
                $sql_dump .= "TRUNCATE TABLE $table;\n";
                
                foreach ($result as $row) {
                    $values = array();
                    foreach ($row as $value) {
                        $values[] = "'" . $wpdb->_escape($value) . "'";
                    }
                    $sql_dump .= "INSERT INTO $table VALUES (" . implode(',', $values) . ");\n";
                }
                $sql_dump .= "\n";
            }
        }
        
        file_put_contents($backup_file, $sql_dump);
        
        // حذف النسخ القديمة (أكثر من شهر)
        $this->cleanup_old_backups($backup_dir);
        
        return $backup_file;
    }
    
    /**
     * تنظيف النسخ الاحتياطية القديمة
     */
    private function cleanup_old_backups($backup_dir) {
        $files = glob($backup_dir . 'backup-*.sql');
        $one_month_ago = time() - (30 * 24 * 60 * 60);
        
        foreach ($files as $file) {
            if (filemtime($file) < $one_month_ago) {
                unlink($file);
            }
        }
    }
    
    /**
     * إرسال تقرير الصيانة
     */
    private function send_maintenance_report() {
        $admin_email = $this->get_theme_setting('notification_email');
        if (!$admin_email) return;
        
        global $wpdb;
        
        // إحصائيات سريعة
        $stats = array(
            'total_posts' => wp_count_posts()->publish,
            'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
            'searches_today' => $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
                date('Y-m-d')
            )),
            'top_search' => $wpdb->get_var("SELECT search_term FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY search_term ORDER BY COUNT(*) DESC LIMIT 1")
        );
        
        $subject = 'تقرير الصيانة اليومية - ' . get_bloginfo('name');
        $message = "تقرير الصيانة اليومية لموقع " . get_bloginfo('name') . "\n\n";
        $message .= "إجمالي المقالات: " . $stats['total_posts'] . "\n";
        $message .= "إجمالي المشتركين: " . $stats['total_subscribers'] . "\n";
        $message .= "البحثات اليوم: " . $stats['searches_today'] . "\n";
        $message .= "أشهر بحث هذا الأسبوع: " . ($stats['top_search'] ?: 'لا يوجد') . "\n\n";
        $message .= "تم تنفيذ الصيانة بنجاح في: " . date('Y-m-d H:i:s');
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * إعداد نظام الإشعارات المحسن
     */
    private function setup_notification_system() {
        // تحميل نظام الإشعارات
        add_action('wp_ajax_dismiss_notification', array($this, 'dismiss_notification'));
        add_action('wp_ajax_nopriv_dismiss_notification', array($this, 'dismiss_notification'));
        
        // إضافة إشعارات في لوحة التحكم
        add_action('admin_notices', array($this, 'show_admin_notifications'));
        
        // إشعارات المستخدمين في الواجهة الأمامية
        add_action('wp_footer', array($this, 'show_frontend_notifications'));
    }
    
    /**
     * إظهار الإشعارات في لوحة التحكم
     */
    public function show_admin_notifications() {
        if (!current_user_can('manage_options')) return;
        
        // فحص التحديثات المطلوبة
        $this->check_theme_updates();
        
        // فحص مشاكل الأداء
        $this->check_performance_issues();
        
        // فحص مشاكل الأمان
        $this->check_security_issues();
    }
    
    /**
     * فحص تحديثات القالب
     */
    private function check_theme_updates() {
        $last_check = get_option('muhtawaa_last_update_check', 0);
        $current_time = time();
        
        // فحص مرة واحدة يومياً
        if (($current_time - $last_check) > DAY_IN_SECONDS) {
            // هنا يمكن إضافة منطق فحص التحديثات من خادم خارجي
            update_option('muhtawaa_last_update_check', $current_time);
        }
    }
    
    /**
     * فحص مشاكل الأداء
     */
    private function check_performance_issues() {
        global $wpdb;
        
        // فحص حجم قاعدة البيانات
        $db_size = $wpdb->get_var("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS 'DB Size in MB' FROM information_schema.tables WHERE table_schema='{$wpdb->dbname}'");
        
        if ($db_size > 500) { // أكثر من 500 ميجا
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>تحذير:</strong> حجم قاعدة البيانات كبير (' . $db_size . ' ميجا). يُنصح بتنظيف البيانات القديمة.</p>
            </div>';
        }
        
        // فحص عدد المراجعات
        $revisions_count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'revision'");
        
        if ($revisions_count > 1000) {
            echo '<div class="notice notice-info is-dismissible">
                <p><strong>تحسين:</strong> يوجد ' . $revisions_count . ' مراجعة. يمكن حذف القديمة منها لتحسين الأداء.</p>
            </div>';
        }
    }
    
    /**
     * فحص مشاكل الأمان
     */
    private function check_security_issues() {
        // فحص إعدادات الأمان الأساسية
        if (get_option('users_can_register')) {
            echo '<div class="notice notice-error is-dismissible">
                <p><strong>تحذير أمني:</strong> التسجيل مفتوح للجميع. يُنصح بإغلاقه إذا لم يكن ضرورياً.</p>
            </div>';
        }
        
        // فحص قوة كلمات المرور
        $weak_users = get_users(array(
            'meta_query' => array(
                array(
                    'key' => 'wp_user_level',
                    'value' => '10',
                    'compare' => '='
                )
            )
        ));
        
        foreach ($weak_users as $user) {
            if (strlen($user->user_pass) < 12) {
                echo '<div class="notice notice-warning is-dismissible">
                    <p><strong>تحذير أمني:</strong> يُنصح المديرين باستخدام كلمات مرور قوية (12 حرف على الأقل).</p>
                </div>';
                break;
            }
        }
    }
    
    /**
     * إظهار الإشعارات في الواجهة الأمامية
     */
    public function show_frontend_notifications() {
        if (is_admin()) return;
        
        $notifications = $this->get_active_notifications();
        
        if (!empty($notifications)) {
            echo '<div id="muhtawaa-notifications">';
            foreach ($notifications as $notification) {
                echo '<div class="muhtawaa-notification notification-' . $notification['type'] . '" data-id="' . $notification['id'] . '">';
                echo '<span class="notification-message">' . $notification['message'] . '</span>';
                echo '<button class="notification-close" data-id="' . $notification['id'] . '">&times;</button>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
    
    /**
     * الحصول على الإشعارات النشطة
     */
    private function get_active_notifications() {
        // يمكن تخصيص هذه الدالة لجلب الإشعارات من قاعدة البيانات
        $notifications = array();
        
        // إشعار ترحيب للزوار الجدد
        if (!isset($_COOKIE['muhtawaa_visited'])) {
            $notifications[] = array(
                'id' => 'welcome',
                'type' => 'info',
                'message' => 'مرحباً بك في موقع محتوى! اكتشف آلاف الحلول العملية للمشاكل اليومية.'
            );
        }
        
        // إشعار النشرة البريدية
        if (!isset($_COOKIE['muhtawaa_newsletter_prompted'])) {
            $notifications[] = array(
                'id' => 'newsletter',
                'type' => 'success',
                'message' => 'اشترك في نشرتنا البريدية واحصل على حل عملي جديد كل يوم! 📧'
            );
        }
        
        return $notifications;
    }
    
    /**
     * رفض الإشعار
     */
    public function dismiss_notification() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_die('غير مصرح');
        }
        
        $notification_id = sanitize_text_field($_POST['notification_id'] ?? '');
        
        if ($notification_id) {
            // حفظ في الكوكيز لمدة شهر
            setcookie('muhtawaa_notification_' . $notification_id . '_dismissed', '1', time() + (30 * DAY_IN_SECONDS), '/');
            wp_send_json_success('تم رفض الإشعار');
        }
        
        wp_send_json_error('معرف الإشعار مطلوب');
    }
    
    /**
     * تحميل التوصيات الذكية
     */
    public function load_smart_recommendations() {
        if (!is_single() || !$this->get_theme_setting('enable_smart_recommendations')) {
            return;
        }
        
        $post_id = get_the_ID();
        $recommendations = $this->get_smart_recommendations($post_id);
        
        if (!empty($recommendations)) {
            echo '<div id="smart-recommendations" style="display: none;">';
            echo json_encode($recommendations);
            echo '</div>';
        }
    }
    
    /**
     * الحصول على التوصيات الذكية
     */
    private function get_smart_recommendations($post_id) {
        global $wpdb;
        
        $cache_key = "smart_recommendations_$post_id";
        $recommendations = wp_cache_get($cache_key);
        
        if ($recommendations === false) {
            // خوارزمية التوصيات الذكية
            $current_post = get_post($post_id);
            $categories = wp_get_post_categories($post_id);
            $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
            
            $recommended_posts = array();
            
            // 1. مقالات من نفس الفئة
            if (!empty($categories)) {
                $category_posts = get_posts(array(
                    'category__in' => $categories,
                    'post__not_in' => array($post_id),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));
                
                foreach ($category_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'category',
                        'score' => 0.8
                    );
                }
            }
            
            // 2. مقالات بنفس الكلمات المفتاحية
            if (!empty($tags) && count($recommended_posts) < 5) {
                $tag_posts = get_posts(array(
                    'tag__in' => $tags,
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 2,
                    'orderby' => 'rand'
                ));
                
                foreach ($tag_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'tags',
                        'score' => 0.6
                    );
                }
            }
            
            // 3. المقالات الأكثر شعبية
            if (count($recommended_posts) < 5) {
                $popular_posts = get_posts(array(
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 3,
                    'meta_key' => '_total_views',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ));
                
                foreach ($popular_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'popular',
                        'score' => 0.4
                    );
                }
            }
            
            // ترتيب حسب النقاط
            usort($recommended_posts, function($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            
            $recommendations = array_slice($recommended_posts, 0, 5);
            
            // حفظ في الكاش لمدة ساعة
            wp_cache_set($cache_key, $recommendations, '', HOUR_IN_SECONDS);
        }
        
        return $recommendations;
    }
    
    /**
     * تحسين الأمان
     */
    private function enhance_security() {
        // إخفاء إصدار ووردبريس
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // منع تعداد المستخدمين
        add_action('wp', function() {
            if (is_author() && !is_user_logged_in()) {
                wp_redirect(home_url());
                exit;
            }
        });
        
        // حماية ملف wp-config
        add_action('init', function() {
            if (strpos($_SERVER['REQUEST_URI'], 'wp-config.php') !== false) {
                wp_die('Access denied');
            }
        });
        
        // إضافة headers أمنية
        add_action('send_headers', function() {
            header('X-Frame-Options: SAMEORIGIN');
            header('X-Content-Type-Options: nosniff');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
        });
        
        // تحديد محاولات تسجيل الدخول
        add_action('wp_login_failed', array($this, 'handle_failed_login'));
        add_filter('authenticate', array($this, 'check_login_attempts'), 30, 3);
    }
    
    /**
     * معالجة فشل تسجيل الدخول
     */
    public function handle_failed_login($username) {
        $ip = $this->get_user_ip();
        $attempts = get_transient("login_attempts_$ip") ?: 0;
        $attempts++;
        
        set_transient("login_attempts_$ip", $attempts, 15 * MINUTE_IN_SECONDS);
        
        if ($attempts >= 5) {
            set_transient("login_blocked_$ip", true, HOUR_IN_SECONDS);
        }
    }
    
    /**
     * فحص محاولات تسجيل الدخول
     */
    public function check_login_attempts($user, $username, $password) {
        $ip = $this->get_user_ip();
        
        if (get_transient("login_blocked_$ip")) {
            return new WP_Error('login_blocked', 'تم حظر عنوان IP الخاص بك مؤقتاً بسبب المحاولات المتكررة.');
        }
        
        return $user;
    }
    
    /**
     * تحسين الأداء
     */
    private function enhance_performance() {
        // ضغط الـ HTML
        if (!is_admin()) {
            ob_start(array($this, 'compress_html'));
        }
        
        // تحسين قاعدة البيانات
        add_action('wp_footer', array($this, 'optimize_database_queries'));
        
        // تأجيل تحميل JavaScript غير الأساسي
        add_filter('script_loader_tag', array($this, 'defer_non_critical_scripts'), 10, 2);
        
        // تحسين الصور
        add_filter('wp_get_attachment_image_attributes', array($this, 'add_lazy_loading'), 10, 2);
        
        // تمكين Gzip
        if (!ob_get_level()) {
            ob_start('ob_gzhandler');
        }
    }
    
    /**
     * ضغط HTML
     */
    public function compress_html($html) {
        // إزالة المسافات الزائدة والتعليقات
        $html = preg_replace('/<!--(.*)-->/Uis', '', $html);
        $html = preg_replace('/\>[^\S ]+/s', '>', $html);
        $html = preg_replace('/[^\S ]+\</s', '<', $html);
        $html = preg_replace('/(\s)+/s', '\\1', $html);
        
        return $html;
    }
    
    /**
     * تأجيل السكريبت غير الأساسية
     */
    public function defer_non_critical_scripts($tag, $handle) {
        $defer_scripts = array('muhtawaa-enhanced', 'muhtawaa-lazyload');
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إضافة lazy loading للصور
     */
    public function add_lazy_loading($attr, $attachment) {
        if (!is_admin()) {
            $attr['loading'] = 'lazy';
        }
        
        return $attr;
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public function optimize_database_queries() {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $queries_count = get_num_queries();
            $memory_usage = size_format(memory_get_peak_usage(true));
            
            echo "<!-- WordPress Queries: $queries_count | Memory: $memory_usage -->";
        }
    }
    
    /**
     * إعداد المخصص (Customizer)
     */
    public function customize_register($wp_customize) {
        // قسم إعدادات القالب
        $wp_customize->add_section('muhtawaa_theme_settings', array(
            'title' => __('إعدادات القالب', 'muhtawaa'),
            'priority' => 30,
        ));
        
        // الألوان الأساسية
        $wp_customize->add_setting('muhtawaa_primary_color', array(
            'default' => '#667eea',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_primary_color', array(
            'label' => __('اللون الأساسي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        $wp_customize->add_setting('muhtawaa_secondary_color', array(
            'default' => '#764ba2',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_secondary_color', array(
            'label' => __('اللون الثانوي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        // إعدادات التوصيات
        $wp_customize->add_setting('muhtawaa_enable_recommendations', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_recommendations', array(
            'label' => __('تمكين التوصيات الذكية', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // إعدادات البحث المتقدم
        $wp_customize->add_setting('muhtawaa_enable_advanced_search', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_advanced_search', array(
            'label' => __('تمكين البحث المتقدم', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // نص تذييل مخصص
        $wp_customize->add_setting('muhtawaa_footer_text', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_text', array(
            'label' => __('نص التذييل المخصص', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'text',
        ));
        
        // روابط وسائل التواصل
        $social_networks = array(
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر', 
            'instagram' => 'انستغرام',
            'youtube' => 'يوتيوب',
            'linkedin' => 'لينكد إن',
            'telegram' => 'تليجرام'
        );
        
        foreach ($social_networks as $network => $label) {
            $wp_customize->add_setting("muhtawaa_social_$network", array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            
            $wp_customize->add_control("muhtawaa_social_$network", array(
                'label' => $label,
                'section' => 'muhtawaa_theme_settings',
                'type' => 'url',
            ));
        }
    }
    
    /**
     * إضافة meta tags محسنة
     */
    public function add_meta_tags() {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        echo '<meta name="theme-color" content="' . get_theme_mod('muhtawaa_primary_color', '#667eea') . '">' . "\n";
        
        if (is_singular()) {
            $description = wp_trim_words(get_the_excerpt(), 25);
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
            
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
            }
        }
    }
    
    /**
     * دوال مساعدة لإدارة إعدادات القالب
     */
    public function get_theme_setting($key, $default = '') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $value = $wpdb->get_var($wpdb->prepare(
            "SELECT setting_value FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        return $value !== null ? $value : $default;
    }
    
    public function update_theme_setting($key, $value, $type = 'string') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        
        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        if ($existing) {
            $wpdb->update(
                $settings_table,
                array(
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'updated_at' => current_time('mysql')
                ),
                array('setting_key' => $key),
                array('%s', '%s', '%s'),
                array('%s')
            );
        } else {
            $wpdb->insert(
                $settings_table,
                array(
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'created_at' => current_time('mysql')
                ),
                array('%s', '%s', '%s', '%s')
            );
        }
    }
    
    public function get_theme_settings() {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $results = $wpdb->get_results("SELECT setting_key, setting_value FROM $settings_table WHERE autoload = 'yes'", ARRAY_A);
        
        $settings = array();
        foreach ($results as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        
        return $settings;
    }
}

// تهيئة القالب
MuhtawaaTheme::getInstance();

// دوال مساعدة عامة
if (!function_exists('muhtawaa_get_category_icon')) {
    function muhtawaa_get_category_icon($category_name) {
        $icons = array(
            'المنزل والتنظيف' => '🏠',
            'المطبخ والطبخ' => '🍳',
            'توفير المال' => '💰',
            'السيارات' => '🚗',
            'التكنولوجيا' => '📱',
            'الطقس والمناخ' => '🌡️',
            'الصحة والجمال' => '💄',
            'الحديقة والزراعة' => '🌱',
            'الأطفال والعائلة' => '👶',
            'التعليم والدراسة' => '📚'
        );
        
        return isset($icons[$category_name]) ? $icons[$category_name] : '💡';
    }
}

if (!function_exists('muhtawaa_get_difficulty_color')) {
    function muhtawaa_get_difficulty_color($difficulty) {
        $colors = array(
            'سهل جداً' => '#4caf50',
            'سهل' => '#8bc34a',
            'متوسط' => '#ff9800',
            'صعب' => '#f44336',
            'خبير' => '#9c27b0'
        );
        
        return isset($colors[$difficulty]) ? $colors[$difficulty] : '#666';
    }
}

if (!function_exists('muhtawaa_get_social_links')) {
    function muhtawaa_get_social_links() {
        $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'telegram');
        $links = array();
        
        foreach ($social_networks as $network) {
            $url = get_theme_mod("muhtawaa_social_$network", '');
            if (!empty($url)) {
                $links[$network] = $url;
            }
        }
        
        return $links;
    }
}

if (!function_exists('muhtawaa_breadcrumbs')) {
    function muhtawaa_breadcrumbs() {
        if (is_front_page()) return;
        
        echo '<nav class="breadcrumbs" role="navigation" aria-label="مسار التنقل">';
        echo '<div class="container">';
        echo '<ol class="breadcrumb-list">';
        echo '<li><a href="' . home_url() . '">🏠 الرئيسية</a></li>';
        
        if (is_category() || is_single()) {
            if (is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                }
                echo '<li><span>' . get_the_title() . '</span></li>';
            } elseif (is_category()) {
                echo '<li><span>' . single_cat_title('', false) . '</span></li>';
            }
        } elseif (is_page()) {
            $ancestors = get_post_ancestors(get_the_ID());
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
            echo '<li><span>' . get_the_title() . '</span></li>';
        } elseif (is_search()) {
            echo '<li><span>نتائج البحث عن: "' . get_search_query() . '"</span></li>';
        } elseif (is_tag()) {
            echo '<li><span>كلمة مفتاحية: ' . single_tag_title('', false) . '</span></li>';
        } elseif (is_archive()) {
            echo '<li><span>' . get_the_archive_title() . '</span></li>';
        }
        
        echo '</ol>';
        echo '</div>';
        echo '</nav>';
    }
}

// إضافة حقول مخصصة للمقالات
add_action('add_meta_boxes', 'muhtawaa_add_solution_meta_boxes');
function muhtawaa_add_solution_meta_boxes() {
    add_meta_box(
        'solution_details',
        __('تفاصيل الحل المحسنة', 'muhtawaa'),
        'muhtawaa_solution_details_callback',
        'post',
        'normal',
        'high'
    );
    
    add_meta_box(
        'solution_seo',
        __('تحسين محركات البحث', 'muhtawaa'),
        'muhtawaa_solution_seo_callback',
        'post',
        'side',
        'default'
    );
}

function muhtawaa_solution_details_callback($post) {
    wp_nonce_field('muhtawaa_save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, '_solution_difficulty', true);
    $time_needed = get_post_meta($post->ID, '_solution_time', true);
    $materials = get_post_meta($post->ID, '_solution_materials', true);
    $cost = get_post_meta($post->ID, '_solution_cost', true);
    $tools = get_post_meta($post->ID, '_solution_tools', true);
    $safety_notes = get_post_meta($post->ID, '_solution_safety', true);
    $season = get_post_meta($post->ID, '_solution_season', true);
    $target_audience = get_post_meta($post->ID, '_solution_audience', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="solution_difficulty">مستوى الصعوبة</label></th>
            <td>
                <select name="solution_difficulty" id="solution_difficulty" style="width: 200px;">
                    <option value="">اختر المستوى</option>
                    <option value="سهل جداً" <?php selected($difficulty, 'سهل جداً'); ?>>سهل جداً ⭐</option>
                    <option value="سهل" <?php selected($difficulty, 'سهل'); ?>>سهل ⭐⭐</option>
                    <option value="متوسط" <?php selected($difficulty, 'متوسط'); ?>>متوسط ⭐⭐⭐</option>
                    <option value="صعب" <?php selected($difficulty, 'صعب'); ?>>صعب ⭐⭐⭐⭐</option>
                    <option value="خبير" <?php selected($difficulty, 'خبير'); ?>>خبير ⭐⭐⭐⭐⭐</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_time">الوقت المطلوب</label></th>
            <td><input type="text" name="solution_time" id="solution_time" value="<?php echo esc_attr($time_needed); ?>" placeholder="مثال: 5 دقائق، ساعة واحدة" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_cost">التكلفة التقريبية</label></th>
            <td><input type="text" name="solution_cost" id="solution_cost" value="<?php echo esc_attr($cost); ?>" placeholder="مثال: مجاني، 10 ريال، أقل من 50 ريال" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_season">الموسم المناسب</label></th>
            <td>
                <select name="solution_season" id="solution_season" style="width: 200px;">
                    <option value="">طوال السنة</option>
                    <option value="الصيف" <?php selected($season, 'الصيف'); ?>>الصيف ☀️</option>
                    <option value="الشتاء" <?php selected($season, 'الشتاء'); ?>>الشتاء ❄️</option>
                    <option value="الربيع" <?php selected($season, 'الربيع'); ?>>الربيع 🌸</option>
                    <option value="الخريف" <?php selected($season, 'الخريف'); ?>>الخريف 🍂</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_audience">الفئة المستهدفة</label></th>
            <td>
                <select name="solution_audience" id="solution_audience" style="width: 200px;">
                    <option value="">الجميع</option>
                    <option value="المبتدئين" <?php selected($target_audience, 'المبتدئين'); ?>>المبتدئين</option>
                    <option value="الأمهات" <?php selected($target_audience, 'الأمهات'); ?>>الأمهات</option>
                    <option value="الآباء" <?php selected($target_audience, 'الآباء'); ?>>الآباء</option>
                    <option value="الطلاب" <?php selected($target_audience, 'الطلاب'); ?>>الطلاب</option>
                    <option value="كبار السن" <?php selected($target_audience, 'كبار السن'); ?>>كبار السن</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_materials">المواد المطلوبة</label></th>
            <td>
                <textarea name="solution_materials" id="solution_materials" rows="4" cols="60" placeholder="اذكر المواد المطلوبة، كل مادة في سطر جديد"><?php echo esc_textarea($materials); ?></textarea>
                <p class="description">مثال: ملح، خل أبيض، ليمونة، قطعة قماش</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_tools">الأدوات المطلوبة</label></th>
            <td>
                <textarea name="solution_tools" id="solution_tools" rows="3" cols="60" placeholder="اذكر الأدوات المطلوبة، كل أداة في سطر جديد"><?php echo esc_textarea($tools); ?></textarea>
                <p class="description">مثال: مكنسة كهربائية، مفك براغي، وعاء خلط</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_safety">ملاحظات السلامة</label></th>
            <td>
                <textarea name="solution_safety" id="solution_safety" rows="3" cols="60" placeholder="ملاحظات مهمة للسلامة (اختياري)"><?php echo esc_textarea($safety_notes); ?></textarea>
                <p class="description">مثال: استخدم القفازات، تأكد من إغلاق الكهرباء، احذر من الأسطح الساخنة</p>
            </td>
        </tr>
    </table>
    
    <style>
    .form-table th {
        width: 150px;
        vertical-align: top;
        padding-top: 10px;
    }
    
    .form-table td {
        padding: 8px 10px;
    }
    
    .form-table input[type="text"],
    .form-table select,
    .form-table textarea {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px;
    }
    
    .form-table textarea {
        font-family: inherit;
    }
    
    .form-table .description {
        font-style: italic;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_solution_seo_callback($post) {
    $focus_keyword = get_post_meta($post->ID, '_focus_keyword', true);
    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    $social_title = get_post_meta($post->ID, '_social_title', true);
    $social_description = get_post_meta($post->ID, '_social_description', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="focus_keyword">الكلمة المفتاحية الرئيسية</label></th>
            <td><input type="text" name="focus_keyword" id="focus_keyword" value="<?php echo esc_attr($focus_keyword); ?>" style="width: 100%;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="meta_description">وصف meta</label></th>
            <td>
                <textarea name="meta_description" id="meta_description" rows="3" style="width: 100%;" maxlength="160" placeholder="وصف مختصر للمقال (160 حرف كحد أقصى)"><?php echo esc_textarea($meta_description); ?></textarea>
                <p class="description"><span id="meta-count">0</span>/160 حرف</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_title">عنوان وسائل التواصل</label></th>
            <td><input type="text" name="social_title" id="social_title" value="<?php echo esc_attr($social_title); ?>" style="width: 100%;" placeholder="عنوان مخصص للمشاركة على وسائل التواصل" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_description">وصف وسائل التواصل</label></th>
            <td>
                <textarea name="social_description" id="social_description" rows="3" style="width: 100%;" placeholder="وصف مخصص للمشاركة على وسائل التواصل"><?php echo esc_textarea($social_description); ?></textarea>
            </td>
        </tr>
    </table>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const metaDescription = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        
        function updateMetaCount() {
            const count = metaDescription.value.length;
            metaCount.textContent = count;
            metaCount.style.color = count > 160 ? 'red' : (count > 140 ? 'orange' : 'green');
        }
        
        metaDescription.addEventListener('input', updateMetaCount);
        updateMetaCount(); // تحديث أولي
    });
    </script>
    <?php
}

// حفظ البيانات المخصصة المحسنة
add_action('save_post', 'muhtawaa_save_solution_details');
function muhtawaa_save_solution_details($post_id) {
    if (!isset($_POST['solution_details_nonce']) || !wp_verify_nonce($_POST['solution_details_nonce'], 'muhtawaa_save_solution_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'solution_difficulty', 'solution_time', 'solution_cost',
        'solution_materials', 'solution_tools', 'solution_safety',
        'solution_season', 'solution_audience',
        'focus_keyword', 'meta_description', 'social_title', 'social_description'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            
            if (in_array($field, array('solution_materials', 'solution_tools', 'solution_safety', 'meta_description', 'social_description'))) {
                $value = sanitize_textarea_field($value);
            } else {
                $value = sanitize_text_field($value);
            }
            
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
    
    // تحديث تاريخ آخر تعديل للحل
    update_post_meta($post_id, '_solution_last_updated', current_time('mysql'));
}

// نظام الاستيراد والتصدير
class MuhtawaaImportExport {
    
    public static function export_solutions($format = 'json') {
        if (!current_user_can('manage_options')) {
            wp_die('غير مصرح');
        }
        
        $solutions = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ));
        
        $export_data = array();
        
        foreach ($solutions as $solution) {
            $meta_data = get_post_meta($solution->ID);
            $categories = wp_get_post_categories($solution->ID, array('fields' => 'names'));
            $tags = wp_get_post_tags($solution->ID, array('fields' => 'names'));
            
            $export_data[] = array(
                'title' => $solution->post_title,
                'content' => $solution->post_content,
                'excerpt' => $solution->post_excerpt,
                'date' => $solution->post_date,
                'categories' => $categories,
                'tags' => $tags,
                'meta' => array(
                    'difficulty' => $meta_data['_solution_difficulty'][0] ?? '',
                    'time' => $meta_data['_solution_time'][0] ?? '',
                    'cost' => $meta_data['_solution_cost'][0] ?? '',
                    'materials' => $meta_data['_solution_materials'][0] ?? '',
                    'tools' => $meta_data['_solution_tools'][0] ?? '',
                    'safety' => $meta_data['_solution_safety'][0] ?? '',
                    'season' => $meta_data['_solution_season'][0] ?? '',
                    'audience' => $meta_data['_solution_audience'][0] ?? '',
                )
            );
        }
        
        if ($format === 'json') {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.json"');
            echo json_encode($export_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } elseif ($format === 'csv') {
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.csv"');
            
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM
            
            // Headers
            fputcsv($output, array('العنوان', 'المحتوى', 'الملخص', 'التاريخ', 'الفئات', 'الكلمات المفتاحية', 'الصعوبة', 'الوقت', 'التكلفة'));
            
            foreach ($export_data as $row) {
                fputcsv($output, array(
                    $row['title'],
                    strip_tags($row['content']),
                    $row['excerpt'],
                    $row['date'],
                    implode(', ', $row['categories']),
                    implode(', ', $row['tags']),
                    $row['meta']['difficulty'],
                    $row['meta']['time'],
                    $row['meta']['cost']
                ));
            }
            
            fclose($output);
        }
        
        exit;
    }
    
    public static function import_solutions($file_path) {
        if (!current_user_can('manage_options')) {
            return new WP_Error('permission_denied', 'غير مصرح');
        }
        
        if (!file_exists($file_path)) {
            return new WP_Error('file_not_found', 'الملف غير موجود');
        }
        
        $file_content = file_get_contents($file_path);
        $data = json_decode($file_content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('invalid_json', 'ملف JSON غير صحيح');
        }
        
        $imported_count = 0;
        $errors = array();
        
        foreach ($data as $solution_data) {
            $post_data = array(
                'post_title' => sanitize_text_field($solution_data['title']),
                'post_content' => wp_kses_post($solution_data['content']),
                'post_excerpt' => sanitize_textarea_field($solution_data['excerpt']),
                'post_status' => 'draft', // استيراد كمسودة للمراجعة
                'post_type' => 'post'
            );
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                $errors[] = 'فشل في استيراد: ' . $solution_data['title'];
                continue;
            }
            
            // إضافة الفئات
            if (!empty($solution_data['categories'])) {
                wp_set_post_categories($post_id, $solution_data['categories']);
            }
            
            // إضافة الكلمات المفتاحية
            if (!empty($solution_data['tags'])) {
                wp_set_post_tags($post_id, implode(', ', $solution_data['tags']));
            }
            
            // إضافة البيانات المخصصة
            if (!empty($solution_data['meta'])) {
                foreach ($solution_data['meta'] as $key => $value) {
                    update_post_meta($post_id, '_solution_' . $key, sanitize_text_field($value));
                }
            }
            
            $imported_count++;
        }
        
        return array(
            'imported' => $imported_count,
            'errors' => $errors
        );
    }
}

// إضافة صفحة إدارة في لوحة التحكم
add_action('admin_menu', 'muhtawaa_admin_menu');
function muhtawaa_admin_menu() {
    add_menu_page(
        __('إدارة محتوى', 'muhtawaa'),
        __('محتوى', 'muhtawaa'),
        'manage_options',
        'muhtawaa-admin',
        'muhtawaa_admin_page',
        'dashicons-lightbulb',
        30
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('إعدادات القالب', 'muhtawaa'),
        __('الإعدادات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-settings',
        'muhtawaa_settings_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الإحصائيات', 'muhtawaa'),
        __('الإحصائيات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-stats',
        'muhtawaa_stats_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الاستيراد والتصدير', 'muhtawaa'),
        __('استيراد/تصدير', 'muhtawaa'),
        'manage_options',
        'muhtawaa-import-export',
        'muhtawaa_import_export_page'
    );
}

function muhtawaa_admin_page() {
    ?>
    <div class="wrap">
        <h1>لوحة تحكم قالب محتوى</h1>
        
        <div class="muhtawaa-dashboard">
            <div class="dashboard-widgets">
                <?php muhtawaa_dashboard_stats_widget(); ?>
                <?php muhtawaa_dashboard_recent_activity(); ?>
                <?php muhtawaa_dashboard_quick_actions(); ?>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-dashboard {
        margin-top: 20px;
    }
    
    .dashboard-widgets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .dashboard-widget {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .dashboard-widget h3 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 15px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }
    
    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #667eea;
        display: block;
    }
    
    .stat-label {
        font-size: 0.9em;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_dashboard_stats_widget() {
    global $wpdb;
    
    $stats = array(
        'total_posts' => wp_count_posts()->publish,
        'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'")
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>📊 الإحصائيات العامة</h3>
        <div class="stat-grid">
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_posts']); ?></span>
                <span class="stat-label">حل منشور</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_subscribers']); ?></span>
                <span class="stat-label">مشترك</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['searches_today']); ?></span>
                <span class="stat-label">بحث اليوم</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></span>
                <span class="stat-label">إجمالي المشاهدات</span>
            </div>
        </div>
    </div>
    <?php
}

function muhtawaa_dashboard_recent_activity() {
    global $wpdb;
    
    $recent_searches = $wpdb->get_results(
        "SELECT search_term, COUNT(*) as count 
         FROM {$wpdb->prefix}muhtawaa_searches 
         WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
         GROUP BY search_term 
         ORDER BY count DESC 
         LIMIT 5"
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>🔍 أشهر البحثات هذا الأسبوع</h3>
        <?php if (!empty($recent_searches)): ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($recent_searches as $search): ?>
                    <li style="display: flex; justify-content: space-between; padding:
					array(
            'name' => 'التكنولوجيا',
            'description' => 'حلول للمشاكل التقنية والأجهزة الذكية',
            'icon' => '📱',
            'color' => '#607D8B'
        ),
        array(
            'name' => 'الطقس والمناخ',
            'description' => 'حلول للتعامل مع الطقس الحار والبارد',
            'icon' => '🌡️',
            'color' => '#FF5722'
        ),
        array(
            'name' => 'الصحة والجمال',
            'description' => 'نصائح طبيعية للصحة والعناية الشخصية',
            'icon' => '💄',
            'color' => '#E91E63'
        ),
        array(
            'name' => 'الحديقة والزراعة',
            'description' => 'حلول للزراعة المنزلية والعناية بالنباتات',
            'icon' => '🌱',
            'color' => '#8BC34A'
        ),
        array(
            'name' => 'الأطفال والعائلة',
            'description' => 'حلول عملية للتعامل مع الأطفال والحياة العائلية',
            'icon' => '👶',
            'color' => '#FFC107'
        ),
        array(
            'name' => 'التعليم والدراسة',
            'description' => 'نصائح وحيل للدراسة والتعلم الفعال',
            'icon' => '📚',
            'color' => '#3F51B5'
        )
    );
    
    foreach ($categories as $category) {
        if (!term_exists($category['name'], 'solution_category')) {
            $term = wp_insert_term(
                $category['name'],
                'solution_category',
                array(
                    'description' => $category['description'],
                    'slug' => sanitize_title($category['name'])
                )
            );
            
            if (!is_wp_error($term)) {
                // حفظ الأيقونة واللون كـ term meta
                update_term_meta($term['term_id'], 'category_icon', $category['icon']);
                update_term_meta($term['term_id'], 'category_color', $category['color']);
            }
        }
    }
}

// تشغيل إنشاء الفئات عند تفعيل القالب
add_action('after_switch_theme', 'muhtawaa_create_default_categories_with_icons');

// تحسين دالة الحصول على أيقونة الفئة
function muhtawaa_get_category_icon_enhanced($category_name_or_id) {
    // إذا كان معرف رقمي، احصل على البيانات من term meta
    if (is_numeric($category_name_or_id)) {
        $icon = get_term_meta($category_name_or_id, 'category_icon', true);
        if ($icon) {
            return $icon;
        }
        
        // إذا لم توجد، احصل على الاسم واستخدم الطريقة القديمة
        $term = get_term($category_name_or_id, 'solution_category');
        if ($term && !is_wp_error($term)) {
            $category_name_or_id = $term->name;
        }
    }
    
    // الطريقة القديمة للتوافق مع الخلف
    return muhtawaa_get_category_icon($category_name_or_id);
}

// نظام الإشعارات المحسن للمستخدمين
class MuhtawaaUserNotifications {
    
    public static function init() {
        add_action('wp_ajax_get_user_notifications', array(__CLASS__, 'get_notifications'));
        add_action('wp_ajax_mark_notification_read', array(__CLASS__, 'mark_as_read'));
        add_action('wp_footer', array(__CLASS__, 'render_notification_center'));
    }
    
    public static function get_notifications() {
        if (!is_user_logged_in()) {
            wp_send_json_error('يجب تسجيل الدخول');
        }
        
        $user_id = get_current_user_id();
        $notifications = MuhtawaaNotificationSystem::get_user_notifications($user_id);
        
        wp_send_json_success($notifications);
    }
    
    public static function mark_as_read() {
        if (!is_user_logged_in()) {
            wp_send_json_error('يجب تسجيل الدخول');
        }
        
        $notification_id = intval($_POST['notification_id'] ?? 0);
        $user_id = get_current_user_id();
        
        if ($notification_id) {
            MuhtawaaNotificationSystem::mark_as_read($notification_id, $user_id);
            wp_send_json_success('تم تحديد الإشعار كمقروء');
        }
        
        wp_send_json_error('معرف الإشعار مطلوب');
    }
    
    public static function render_notification_center() {
        if (!is_user_logged_in()) {
            return;
        }
        ?>
        
        <div id="muhtawaa-notification-center" class="notification-center">
            <button class="notification-toggle" aria-label="الإشعارات">
                <i class="fas fa-bell"></i>
                <span class="notification-count" style="display: none;"></span>
            </button>
            
            <div class="notification-dropdown" style="display: none;">
                <div class="notification-header">
                    <h4>الإشعارات</h4>
                    <button class="mark-all-read">تحديد الكل كمقروء</button>
                </div>
                <div class="notification-list">
                    <!-- سيتم ملؤها بواسطة JavaScript -->
                </div>
            </div>
        </div>
        
        <style>
        .notification-center {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        
        .notification-toggle {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .notification-toggle:hover {
            background: #5a6fd8;
            transform: scale(1.1);
        }
        
        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 4px 6px;
            font-size: 10px;
            font-weight: bold;
            min-width: 18px;
            text-align: center;
        }
        
        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            margin-top: 10px;
        }
        
        .notification-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .notification-header h4 {
            margin: 0;
            color: #333;
        }
        
        .mark-all-read {
            background: none;
            border: none;
            color: #667eea;
            cursor: pointer;
            font-size: 12px;
        }
        
        .notification-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .notification-item:hover {
            background: #f8f9fa;
        }
        
        .notification-item.unread {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
        }
        
        .notification-title {
            font-weight: bold;
            color: #333;
            font-size: 13px;
            margin-bottom: 4px;
        }
        
        .notification-message {
            color: #666;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .notification-time {
            color: #999;
            font-size: 11px;
            margin-top: 5px;
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationCenter = document.getElementById('muhtawaa-notification-center');
            const toggle = notificationCenter.querySelector('.notification-toggle');
            const dropdown = notificationCenter.querySelector('.notification-dropdown');
            const notificationList = notificationCenter.querySelector('.notification-list');
            const notificationCount = notificationCenter.querySelector('.notification-count');
            const markAllRead = notificationCenter.querySelector('.mark-all-read');
            
            let isOpen = false;
            
            // تحميل الإشعارات
            function loadNotifications() {
                fetch(muhtawaaAjax.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=get_user_notifications&nonce=' + muhtawaaAjax.nonce
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderNotifications(data.data);
                    }
                })
                .catch(console.error);
            }
            
            // عرض الإشعارات
            function renderNotifications(notifications) {
                const unreadCount = notifications.filter(n => !n.is_read).length;
                
                if (unreadCount > 0) {
                    notificationCount.textContent = unreadCount;
                    notificationCount.style.display = 'block';
                } else {
                    notificationCount.style.display = 'none';
                }
                
                if (notifications.length === 0) {
                    notificationList.innerHTML = '<div style="padding: 20px; text-align: center; color: #999;">لا توجد إشعارات</div>';
                    return;
                }
                
                notificationList.innerHTML = '';
                
                notifications.forEach(notification => {
                    const item = document.createElement('div');
                    item.className = 'notification-item' + (!notification.is_read ? ' unread' : '');
                    item.dataset.id = notification.id;
                    
                    const timeAgo = getTimeAgo(notification.created_at);
                    
                    item.innerHTML = `
                        <div class="notification-title">${notification.title}</div>
                        <div class="notification-message">${notification.message}</div>
                        <div class="notification-time">${timeAgo}</div>
                    `;
                    
                    item.addEventListener('click', () => {
                        if (!notification.is_read) {
                            markAsRead(notification.id);
                            item.classList.remove('unread');
                        }
                    });
                    
                    notificationList.appendChild(item);
                });
            }
            
            // تحديد كمقروء
            function markAsRead(notificationId) {
                fetch(muhtawaaAjax.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=mark_notification_read&notification_id=${notificationId}&nonce=${muhtawaaAjax.nonce}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateNotificationCount();
                    }
                });
            }
            
            // تحديث عداد الإشعارات
            function updateNotificationCount() {
                const unreadItems = notificationList.querySelectorAll('.notification-item.unread');
                const count = unreadItems.length;
                
                if (count > 0) {
                    notificationCount.textContent = count;
                    notificationCount.style.display = 'block';
                } else {
                    notificationCount.style.display = 'none';
                }
            }
            
            // حساب الوقت المنقضي
            function getTimeAgo(dateString) {
                const now = new Date();
                const date = new Date(dateString);
                const diffInSeconds = Math.floor((now - date) / 1000);
                
                if (diffInSeconds < 60) {
                    return 'الآن';
                } else if (diffInSeconds < 3600) {
                    const minutes = Math.floor(diffInSeconds / 60);
                    return `منذ ${minutes} دقيقة`;
                } else if (diffInSeconds < 86400) {
                    const hours = Math.floor(diffInSeconds / 3600);
                    return `منذ ${hours} ساعة`;
                } else {
                    const days = Math.floor(diffInSeconds / 86400);
                    return `منذ ${days} يوم`;
                }
            }
            
            // أحداث النقر
            toggle.addEventListener('click', function() {
                isOpen = !isOpen;
                dropdown.style.display = isOpen ? 'block' : 'none';
                
                if (isOpen) {
                    loadNotifications();
                }
            });
            
            // إغلاق عند النقر خارج النافذة
            document.addEventListener('click', function(e) {
                if (!notificationCenter.contains(e.target)) {
                    dropdown.style.display = 'none';
                    isOpen = false;
                }
            });
            
            // تحديد الكل كمقروء
            markAllRead.addEventListener('click', function() {
                const unreadItems = notificationList.querySelectorAll('.notification-item.unread');
                unreadItems.forEach(item => {
                    const id = item.dataset.id;
                    markAsRead(id);
                    item.classList.remove('unread');
                });
                updateNotificationCount();
            });
            
            // تحميل أولي
            loadNotifications();
            
            // تحديث دوري كل 30 ثانية
            setInterval(loadNotifications, 30000);
        });
        </script>
        <?php
    }
}

// تهيئة نظام إشعارات المستخدمين
MuhtawaaUserNotifications::init();

// نظام إحصائيات متقدم
class MuhtawaaAdvancedStats {
    
    public static function track_user_action($action, $post_id = 0, $additional_data = array()) {
        global $wpdb;
        
        $stats_table = $wpdb->prefix . 'muhtawaa_stats';
        
        $wpdb->insert(
            $stats_table,
            array(
                'post_id' => $post_id,
                'user_id' => get_current_user_id(),
                'action_type' => $action,
                'action_value' => json_encode($additional_data),
                'user_ip' => $_SERVER['REMOTE_ADDR'] ?? '',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                'created_at' => current_time('mysql')
            ),
            array('%d', '%d', '%s', '%s', '%s', '%s', '%s')
        );
    }
    
    public static function get_popular_content($days = 30, $limit = 10) {
        global $wpdb;
        
        return $wpdb->get_results($wpdb->prepare("
            SELECT 
                p.ID,
                p.post_title,
                COUNT(s.id) as interactions,
                SUM(CASE WHEN s.action_type = 'view' THEN 1 ELSE 0 END) as views,
                SUM(CASE WHEN s.action_type = 'helpful' THEN 1 ELSE 0 END) as helpful_votes,
                SUM(CASE WHEN s.action_type = 'share' THEN 1 ELSE 0 END) as shares
            FROM {$wpdb->posts} p
            LEFT JOIN {$wpdb->prefix}muhtawaa_stats s ON p.ID = s.post_id
            WHERE p.post_type = 'post' 
            AND p.post_status = 'publish'
            AND s.created_at >= DATE_SUB(NOW(), INTERVAL %d DAY)
            GROUP BY p.ID
            ORDER BY interactions DESC
            LIMIT %d
        ", $days, $limit));
    }
    
    public static function get_user_engagement_stats($days = 7) {
        global $wpdb;
        
        return $wpdb->get_results($wpdb->prepare("
            SELECT 
                DATE(created_at) as date,
                COUNT(DISTINCT user_ip) as unique_visitors,
                COUNT(id) as total_actions,
                COUNT(CASE WHEN action_type = 'view' THEN 1 END) as page_views,
                COUNT(CASE WHEN action_type = 'search' THEN 1 END) as searches
            FROM {$wpdb->prefix}muhtawaa_stats
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL %d DAY)
            GROUP BY DATE(created_at)
            ORDER BY date DESC
        ", $days));
    }
}

// تتبع تفاعلات المستخدمين
add_action('wp_footer', 'muhtawaa_track_page_view');
function muhtawaa_track_page_view() {
    if (is_single() && get_post_type() === 'post') {
        $post_id = get_the_ID();
        ?>
        <script>
        // تتبع مشاهدة الصفحة
        MuhtawaaAdvancedStats.track_user_action('view', <?php echo $post_id; ?>);
        
        // تتبع مدة القراءة
        let startTime = Date.now();
        let hasScrolled = false;
        
        window.addEventListener('scroll', function() {
            if (!hasScrolled) {
                hasScrolled = true;
                MuhtawaaAdvancedStats.track_user_action('scroll_start', <?php echo $post_id; ?>);
            }
        });
        
        window.addEventListener('beforeunload', function() {
            const readingTime = Math.round((Date.now() - startTime) / 1000);
            if (readingTime > 10) { // أكثر من 10 ثوان
                navigator.sendBeacon(muhtawaaAjax.ajaxurl, new URLSearchParams({
                    action: 'track_reading_time',
                    post_id: <?php echo $post_id; ?>,
                    reading_time: readingTime,
                    nonce: muhtawaaAjax.nonce
                }));
            }
        });
        </script>
        <?php
    }
}

// معالج AJAX لتتبع وقت القراءة
add_action('wp_ajax_track_reading_time', 'muhtawaa_handle_reading_time');
add_action('wp_ajax_nopriv_track_reading_time', 'muhtawaa_handle_reading_time');
function muhtawaa_handle_reading_time() {
    $post_id = intval($_POST['post_id'] ?? 0);
    $reading_time = intval($_POST['reading_time'] ?? 0);
    
    if ($post_id && $reading_time > 0) {
        MuhtawaaAdvancedStats::track_user_action('reading_time', $post_id, array(
            'duration' => $reading_time
        ));
        
        // تحديث متوسط وقت القراءة للمقال
        $current_avg = get_post_meta($post_id, '_avg_reading_time', true) ?: 0;
        $sessions = get_post_meta($post_id, '_reading_sessions', true) ?: 0;
        
        $new_avg = (($current_avg * $sessions) + $reading_time) / ($sessions + 1);
        
        update_post_meta($post_id, '_avg_reading_time', round($new_avg));
        update_post_meta($post_id, '_reading_sessions', $sessions + 1);
    }
    
    wp_send_json_success();
}

// تحسين نظام التعليقات والتقييمات
add_filter('comment_form_fields', 'muhtawaa_add_rating_to_comments');
function muhtawaa_add_rating_to_comments($fields) {
    if (get_post_type() === 'post') {
        $rating_field = '<div class="comment-rating-field">
            <label for="comment_rating">تقييمك للحل:</label>
            <div class="star-rating">
                <input type="radio" name="comment_rating" value="5" id="star5"><label for="star5">⭐⭐⭐⭐⭐</label>
                <input type="radio" name="comment_rating" value="4" id="star4"><label for="star4">⭐⭐⭐⭐</label>
                <input type="radio" name="comment_rating" value="3" id="star3"><label for="star3">⭐⭐⭐</label>
                <input type="radio" name="comment_rating" value="2" id="star2"><label for="star2">⭐⭐</label>
                <input type="radio" name="comment_rating" value="1" id="star1"><label for="star1">⭐</label>
            </div>
        </div>';
        
        $fields['rating'] = $rating_field;
    }
    
    return $fields;
}

// حفظ التقييم مع التعليق
add_action('comment_post', 'muhtawaa_save_comment_rating');
function muhtawaa_save_comment_rating($comment_id) {
    if (isset($_POST['comment_rating']) && !empty($_POST['comment_rating'])) {
        $rating = intval($_POST['comment_rating']);
        if ($rating >= 1 && $rating <= 5) {
            update_comment_meta($comment_id, 'comment_rating', $rating);
            
            // تحديث متوسط التقييم للمقال
            $post_id = get_comment($comment_id)->comment_post_ID;
            muhtawaa_update_post_rating($post_id);
        }
    }
}

// تحديث متوسط التقييم للمقال
function muhtawaa_update_post_rating($post_id) {
    global $wpdb;
    
    $average = $wpdb->get_var($wpdb->prepare("
        SELECT AVG(CAST(meta_value AS DECIMAL(2,1)))
        FROM {$wpdb->commentmeta} cm
        INNER JOIN {$wpdb->comments} c ON cm.comment_id = c.comment_ID
        WHERE c.comment_post_ID = %d 
        AND cm.meta_key = 'comment_rating'
        AND c.comment_approved = '1'
    ", $post_id));
    
    $count = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*)
        FROM {$wpdb->commentmeta} cm
        INNER JOIN {$wpdb->comments} c ON cm.comment_id = c.comment_ID
        WHERE c.comment_post_ID = %d 
        AND cm.meta_key = 'comment_rating'
        AND c.comment_approved = '1'
    ", $post_id));
    
    if ($average) {
        update_post_meta($post_id, '_average_rating', round($average, 1));
        update_post_meta($post_id, '_rating_count', $count);
    }
}

// عرض التقييم مع التعليقات
add_filter('comment_text', 'muhtawaa_display_comment_rating');
function muhtawaa_display_comment_rating($comment_text) {
    $rating = get_comment_meta(get_comment_ID(), 'comment_rating', true);
    
    if ($rating) {
        $stars = str_repeat('⭐', $rating);
        $comment_text = '<div class="comment-rating">' . $stars . ' (' . $rating . '/5)</div>' . $comment_text;
    }
    
    return $comment_text;
}

// إضافة ودجت مخصص للإحصائيات في لوحة التحكم
add_action('wp_dashboard_setup', 'muhtawaa_add_advanced_dashboard_widgets');
function muhtawaa_add_advanced_dashboard_widgets() {
    wp_add_dashboard_widget(
        'muhtawaa_engagement_widget',
        '📈 إحصائيات التفاعل - آخر 7 أيام',
        'muhtawaa_engagement_dashboard_widget'
    );
    
    wp_add_dashboard_widget(
        'muhtawaa_popular_content_widget',
        '🔥 المحتوى الأكثر شعبية',
        'muhtawaa_popular_content_dashboard_widget'
    );
}

function muhtawaa_engagement_dashboard_widget() {
    $stats = MuhtawaaAdvancedStats::get_user_engagement_stats(7);
    
    if (empty($stats)) {
        echo '<p>لا توجد بيانات تفاعل حتى الآن.</p>';
        return;
    }
    
    echo '<div class="engagement-chart">';
    echo '<canvas id="engagementChart" width="400" height="200"></canvas>';
    echo '</div>';
    
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Chart !== "undefined") {
            const ctx = document.getElementById("engagementChart").getContext("2d");
            const data = ' . json_encode(array_reverse($stats)) . ';
            
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: data.map(d => d.date),
                    datasets: [
                        {
                            label: "زوار فريدون",
                            data: data.map(d => parseInt(d.unique_visitors)),
                            borderColor: "#667eea",
                            backgroundColor: "rgba(102, 126, 234, 0.1)"
                        },
                        {
                            label: "مشاهدات الصفحات",
                            data: data.map(d => parseInt(d.page_views)),
                            borderColor: "#48bb78",
                            backgroundColor: "rgba(72, 187, 120, 0.1)"
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
    </script>';
}

function muhtawaa_popular_content_dashboard_widget() {
    $popular_content = MuhtawaaAdvancedStats::get_popular_content(30, 5);
    
    if (empty($popular_content)) {
        echo '<p>لا توجد بيانات شعبية حتى الآن.</p>';
        return;
    }
    
    echo '<div class="popular-content-list">';
    foreach ($popular_content as $content) {
        echo '<div class="popular-item" style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">';
        echo '<div>';
        echo '<strong><a href="' . get_edit_post_link($content->ID) . '">' . esc_html($content->post_title) . '</a></strong><br>';
        echo '<small>مشاهدات: ' . $content->views . ' | مشاركات: ' . $content->shares . '</small>';
        echo '</div>';
        echo '<div class="engagement-score" style="background: #667eea; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px;">';
        echo $content->interactions . ' تفاعل';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}

// إضافة Chart.js للوحة التحكم
add_action('admin_enqueue_scripts', 'muhtawaa_admin_dashboard_scripts');
function muhtawaa_admin_dashboard_scripts($hook) {
    if ($hook === 'index.php') {
        wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '3.9.1', true);
    }
}

// تنظيف عند إلغاء تفعيل القالب
add_action('switch_theme', 'muhtawaa_cleanup_on_deactivation');
function muhtawaa_cleanup_on_deactivation() {
    // إلغاء المهام المجدولة
    wp_clear_scheduled_hook('muhtawaa_daily_maintenance');
    wp_clear_scheduled_hook('muhtawaa_weekly_backup');
    
    // تنظيف الكاش
    wp_cache_flush();
    
    // إشعار المدير
    MuhtawaaNotificationSystem::send_notification(
        'info',
        'تم إلغاء تفعيل قالب محتوى',
        'تم إلغاء تفعيل قالب محتوى وتنظيف البيانات المؤقتة.',
        1
    );
}

// إضافة إعدادات سريعة في شريط الإدارة
add_        $html .= "<li style='margin-bottom: 10px; padding: 10px; background: #f9f9f9; border-radius: 5px;'>";
        $html .= "<strong>$filename</strong><br>";
        $html .= "<small>التاريخ: $date | الحجم: $size</small><br>";
        $html .= "<a href='#' onclick='downloadBackup(\"$filename\")' class='button button-small' style='margin-top: 5px;'>تحميل</a>";
        $html .= "</li>";
    }
    
    $html .= '</ul>';
    
    wp_send_json_success($html);
}

// تحسين عرض الحقول المخصصة في قائمة المقالات
add_filter('manage_posts_columns', 'muhtawaa_add_admin_columns');
function muhtawaa_add_admin_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        
        if ($key === 'title') {
            $new_columns['solution_difficulty'] = 'الصعوبة';
            $new_columns['solution_stats'] = 'الإحصائيات';
            $new_columns['solution_meta'] = 'معلومات إضافية';
        }
    }
    
    return $new_columns;
}

add_action('manage_posts_custom_column', 'muhtawaa_show_admin_columns', 10, 2);
function muhtawaa_show_admin_columns($column, $post_id) {
    switch ($column) {
        case 'solution_difficulty':
            $difficulty = get_post_meta($post_id, '_solution_difficulty', true);
            if ($difficulty) {
                $color = muhtawaa_get_difficulty_color($difficulty);
                echo "<span style='background: $color; color: white; padding: 3px 8px; border-radius: 12px; font-size: 11px; font-weight: bold;'>$difficulty</span>";
            } else {
                echo '<span style="color: #999;">غير محدد</span>';
            }
            break;
            
        case 'solution_stats':
            $views = get_post_meta($post_id, '_total_views', true) ?: 0;
            $helpful = get_post_meta($post_id, '_helpful_count', true) ?: 0;
            $not_helpful = get_post_meta($post_id, '_not_helpful_count', true) ?: 0;
            $total_ratings = $helpful + $not_helpful;
            
            echo "<div style='font-size: 11px;'>";
            echo "<div>👀 " . number_format($views) . " مشاهدة</div>";
            
            if ($total_ratings > 0) {
                $percentage = round(($helpful / $total_ratings) * 100);
                $color = $percentage >= 70 ? 'green' : ($percentage >= 50 ? 'orange' : 'red');
                echo "<div style='color: $color;'>👍 $helpful | 👎 $not_helpful ($percentage%)</div>";
            } else {
                echo "<div style='color: #999;'>لا توجد تقييمات</div>";
            }
            echo "</div>";
            break;
            
        case 'solution_meta':
            $time = get_post_meta($post_id, '_solution_time', true);
            $cost = get_post_meta($post_id, '_solution_cost', true);
            $season = get_post_meta($post_id, '_solution_season', true);
            
            echo "<div style='font-size: 11px;'>";
            if ($time) echo "<div>⏱️ $time</div>";
            if ($cost) echo "<div>💰 $cost</div>";
            if ($season) echo "<div>🗓️ $season</div>";
            echo "</div>";
            break;
    }
}

// إضافة فلاتر سريعة في لوحة التحكم
add_action('restrict_manage_posts', 'muhtawaa_add_admin_filters');
function muhtawaa_add_admin_filters() {
    global $typenow;
    
    if ($typenow === 'post') {
        // فلتر الصعوبة
        $selected_difficulty = isset($_GET['difficulty_filter']) ? $_GET['difficulty_filter'] : '';
        echo '<select name="difficulty_filter">';
        echo '<option value="">جميع مستويات الصعوبة</option>';
        $difficulties = array('سهل جداً', 'سهل', 'متوسط', 'صعب', 'خبير');
        foreach ($difficulties as $difficulty) {
            printf('<option value="%s"%s>%s</option>', 
                $difficulty, 
                selected($selected_difficulty, $difficulty, false), 
                $difficulty
            );
        }
        echo '</select>';
        
        // فلتر الموسم
        $selected_season = isset($_GET['season_filter']) ? $_GET['season_filter'] : '';
        echo '<select name="season_filter">';
        echo '<option value="">جميع المواسم</option>';
        $seasons = array('الصيف', 'الشتاء', 'الربيع', 'الخريف');
        foreach ($seasons as $season) {
            printf('<option value="%s"%s>%s</option>', 
                $season, 
                selected($selected_season, $season, false), 
                $season
            );
        }
        echo '</select>';
    }
}

add_filter('parse_query', 'muhtawaa_handle_admin_filters');
function muhtawaa_handle_admin_filters($query) {
    global $pagenow;
    
    if ($pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'post') {
        $meta_query = array();
        
        if (!empty($_GET['difficulty_filter'])) {
            $meta_query[] = array(
                'key' => '_solution_difficulty',
                'value' => sanitize_text_field($_GET['difficulty_filter']),
                'compare' => '='
            );
        }
        
        if (!empty($_GET['season_filter'])) {
            $meta_query[] = array(
                'key' => '_solution_season',
                'value' => sanitize_text_field($_GET['season_filter']),
                'compare' => '='
            );
        }
        
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
    }
}

// تحسين أداء قاعدة البيانات
add_action('init', 'muhtawaa_optimize_database_queries');
function muhtawaa_optimize_database_queries() {
    // تمكين object caching للاستعلامات المتكررة
    add_filter('posts_pre_query', 'muhtawaa_cache_popular_queries', 10, 2);
}

function muhtawaa_cache_popular_queries($posts, $query) {
    // كاش للاستعلامات الشائعة مثل الصفحة الرئيسية
    if ($query->is_home() && $query->is_main_query()) {
        $cache_key = 'muhtawaa_home_posts';
        $cached_posts = wp_cache_get($cache_key);
        
        if ($cached_posts !== false) {
            return $cached_posts;
        }
        
        // إذا لم توجد في الكاش، دع الاستعلام يتم عادياً
        add_action('the_posts', function($posts) use ($cache_key) {
            wp_cache_set($cache_key, $posts, '', 15 * MINUTE_IN_SECONDS);
            return $posts;
        });
    }
    
    return $posts;
}

// تحسين السيو والبحث
add_action('wp_head', 'muhtawaa_add_structured_data');
function muhtawaa_add_structured_data() {
    if (is_single() && get_post_type() === 'post') {
        $post_id = get_the_ID();
        $difficulty = get_post_meta($post_id, '_solution_difficulty', true);
        $time = get_post_meta($post_id, '_solution_time', true);
        $materials = get_post_meta($post_id, '_solution_materials', true);
        $tools = get_post_meta($post_id, '_solution_tools', true);
        $cost = get_post_meta($post_id, '_solution_cost', true);
        
        $schema = array(
            "@context" => "https://schema.org/",
            "@type" => "HowTo",
            "name" => get_the_title(),
            "description" => get_the_excerpt(),
            "image" => get_the_post_thumbnail_url($post_id, 'large'),
            "totalTime" => $time,
            "estimatedCost" => array(
                "@type" => "MonetaryAmount",
                "currency" => "SAR",
                "value" => $cost
            ),
            "supply" => array(),
            "tool" => array(),
            "step" => array(),
            "author" => array(
                "@type" => "Organization",
                "name" => get_bloginfo('name'),
                "url" => home_url()
            ),
            "publisher" => array(
                "@type" => "Organization",
                "name" => get_bloginfo('name'),
                "url" => home_url(),
                "logo" => array(
                    "@type" => "ImageObject",
                    "url" => get_custom_logo() ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : ''
                )
            ),
            "datePublished" => get_the_date('c'),
            "dateModified" => get_the_modified_date('c'),
        );
        
        // إضافة المواد
        if ($materials) {
            $materials_array = explode("\n", $materials);
            foreach ($materials_array as $material) {
                $material = trim($material);
                if (!empty($material)) {
                    $schema['supply'][] = array(
                        "@type" => "HowToSupply",
                        "name" => $material
                    );
                }
            }
        }
        
        // إضافة الأدوات
        if ($tools) {
            $tools_array = explode("\n", $tools);
            foreach ($tools_array as $tool) {
                $tool = trim($tool);
                if (!empty($tool)) {
                    $schema['tool'][] = array(
                        "@type" => "HowToTool",
                        "name" => $tool
                    );
                }
            }
        }
        
        // إضافة الخطوات من المحتوى
        $content = get_the_content();
        $steps = explode("\n\n", strip_tags($content));
        $step_number = 1;
        
        foreach ($steps as $step) {
            $step = trim($step);
            if (!empty($step) && strlen($step) > 50) {
                $schema['step'][] = array(
                    "@type" => "HowToStep",
                    "name" => "الخطوة " . $step_number,
                    "text" => $step,
                    "position" => $step_number
                );
                $step_number++;
            }
        }
        
        echo '<script type="application/ld+json">';
        echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo '</script>' . "\n";
    }
}

// نظام التنبيهات والإشعارات المحسن
class MuhtawaaNotificationSystem {
    
    public static function send_notification($type, $title, $message, $user_id = null) {
        global $wpdb;
        
        $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
        
        // إنشاء الجدول إذا لم يكن موجوداً
        $wpdb->query("CREATE TABLE IF NOT EXISTS $notifications_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) DEFAULT 0,
            type varchar(50) NOT NULL,
            title varchar(255) NOT NULL,
            message text NOT NULL,
            is_read tinyint(1) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY type (type),
            KEY is_read (is_read)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        $wpdb->insert(
            $notifications_table,
            array(
                'user_id' => $user_id ?: 0,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'created_at' => current_time('mysql')
            ),
            array('%d', '%s', '%s', '%s', '%s')
        );
        
        // إرسال بريد إلكتروني للمديرين
        if (in_array($type, array('error', 'security', 'maintenance'))) {
            $admin_email = get_option('admin_email');
            wp_mail($admin_email, "[$type] $title", $message);
        }
    }
    
    public static function get_user_notifications($user_id, $unread_only = false) {
        global $wpdb;
        
        $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
        $where = "user_id = %d";
        $params = array($user_id);
        
        if ($unread_only) {
            $where .= " AND is_read = 0";
        }
        
        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $notifications_table WHERE $where ORDER BY created_at DESC LIMIT 20",
            ...$params
        ));
    }
    
    public static function mark_as_read($notification_id, $user_id) {
        global $wpdb;
        
        $notifications_table = $wpdb->prefix . 'muhtawaa_notifications';
        
        $wpdb->update(
            $notifications_table,
            array('is_read' => 1),
            array(
                'id' => $notification_id,
                'user_id' => $user_id
            ),
            array('%d'),
            array('%d', '%d')
        );
    }
}

// تحسين نظام التخزين المؤقت
add_action('init', 'muhtawaa_setup_caching');
function muhtawaa_setup_caching() {
    // تنظيف الكاش عند تحديث المقالات
    add_action('save_post', 'muhtawaa_clear_related_cache');
    add_action('delete_post', 'muhtawaa_clear_related_cache');
    
    // تنظيف كاش الفئات عند التحديث
    add_action('created_term', 'muhtawaa_clear_category_cache');
    add_action('edited_term', 'muhtawaa_clear_category_cache');
    add_action('delete_term', 'muhtawaa_clear_category_cache');
}

function muhtawaa_clear_related_cache($post_id) {
    if (get_post_type($post_id) === 'post') {
        // تنظيف كاش الصفحة الرئيسية
        wp_cache_delete('muhtawaa_home_posts');
        
        // تنظيف كاش التوصيات
        wp_cache_delete("smart_recommendations_$post_id");
        
        // تنظيف كاش الفئات المرتبطة
        $categories = wp_get_post_categories($post_id);
        foreach ($categories as $cat_id) {
            wp_cache_delete("category_posts_$cat_id");
        }
    }
}

function muhtawaa_clear_category_cache($term_id) {
    wp_cache_delete("category_posts_$term_id");
    wp_cache_delete('muhtawaa_categories_list');
}

// تحسين نظام البحث المتقدم
class MuhtawaaAdvancedSearch {
    
    public static function init() {
        add_action('wp_ajax_advanced_search', array(__CLASS__, 'handle_ajax_search'));
        add_action('wp_ajax_nopriv_advanced_search', array(__CLASS__, 'handle_ajax_search'));
        
        add_action('wp_ajax_search_suggestions', array(__CLASS__, 'get_search_suggestions'));
        add_action('wp_ajax_nopriv_search_suggestions', array(__CLASS__, 'get_search_suggestions'));
    }
    
    public static function handle_ajax_search() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        $search_term = sanitize_text_field($_POST['search_term'] ?? '');
        $category = sanitize_text_field($_POST['category'] ?? '');
        $difficulty = sanitize_text_field($_POST['difficulty'] ?? '');
        $season = sanitize_text_field($_POST['season'] ?? '');
        
        if (empty($search_term)) {
            wp_send_json_error('مصطلح البحث مطلوب');
        }
        
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            's' => $search_term,
            'posts_per_page' => 10,
            'meta_query' => array(),
            'tax_query' => array()
        );
        
        // إضافة فلتر الصعوبة
        if (!empty($difficulty)) {
            $args['meta_query'][] = array(
                'key' => '_solution_difficulty',
                'value' => $difficulty,
                'compare' => '='
            );
        }
        
        // إضافة فلتر الموسم
        if (!empty($season)) {
            $args['meta_query'][] = array(
                'key' => '_solution_season',
                'value' => $season,
                'compare' => '='
            );
        }
        
        // إضافة فلتر الفئة
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'solution_category',
                'field' => 'slug',
                'terms' => $category
            );
        }
        
        // البحث في الحقول المخصصة أيضاً
        add_filter('posts_search', array(__CLASS__, 'extend_search_to_meta'), 10, 2);
        
        $query = new WP_Query($args);
        
        remove_filter('posts_search', array(__CLASS__, 'extend_search_to_meta'), 10);
        
        $results = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                $categories = get_the_category();
                $category_name = !empty($categories) ? $categories[0]->name : '';
                
                $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
                $time = get_post_meta(get_the_ID(), '_solution_time', true);
                
                $results[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'excerpt' => wp_trim_words(get_the_excerpt(), 20),
                    'url' => get_permalink(),
                    'category' => $category_name,
                    'difficulty' => $difficulty,
                    'time' => $time,
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
                );
            }
            wp_reset_postdata();
        }
        
        // تسجيل البحث للإحصائيات
        self::log_search($search_term, count($results), $category, $difficulty, $season);
        
        wp_send_json_success(array(
            'results' => $results,
            'total' => $query->found_posts
        ));
    }
    
    public static function extend_search_to_meta($search, $query) {
        global $wpdb;
        
        if (!is_main_query() || !$query->is_search()) {
            return $search;
        }
        
        $search_term = $query->get('s');
        if (empty($search_term)) {
            return $search;
        }
        
        // البحث في الحقول المخصصة
        $meta_search = $wpdb->prepare("
            OR EXISTS (
                SELECT 1 FROM {$wpdb->postmeta} 
                WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                AND {$wpdb->postmeta}.meta_key IN ('_solution_materials', '_solution_tools', '_focus_keyword')
                AND {$wpdb->postmeta}.meta_value LIKE %s
            )",
            '%' . $wpdb->esc_like($search_term) . '%'
        );
        
        $search = preg_replace('/\)\s*$/', ') ' . $meta_search . ')', $search);
        
        return $search;
    }
    
    public static function get_search_suggestions() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_send_json_error('غير مصرح');
        }
        
        global $wpdb;
        
        $cache_key = 'muhtawaa_search_suggestions';
        $suggestions = wp_cache_get($cache_key);
        
        if ($suggestions === false) {
            // أشهر البحثات
            $popular_searches = $wpdb->get_results("
                SELECT search_term, COUNT(*) as count
                FROM {$wpdb->prefix}muhtawaa_searches
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                GROUP BY search_term
                ORDER BY count DESC
                LIMIT 8
            ", ARRAY_A);
            
            $suggestions = array();
            foreach ($popular_searches as $search) {
                $suggestions[] = $search['search_term'];
            }
            
            // إضافة اقتراحات افتراضية إذا لم توجد بحثات كافية
            if (count($suggestions) < 8) {
                $default_suggestions = array(
                    'تنظيف المنزل', 'توفير الكهرباء', 'حلول المطبخ',
                    'إزالة البقع', 'صيانة السيارة', 'حلول سريعة',
                    'توفير المال', 'تنظيف الفرن'
                );
                
                $suggestions = array_merge($suggestions, array_slice($default_suggestions, 0, 8 - count($suggestions)));
            }
            
            wp_cache_set($cache_key, $suggestions, '', HOUR_IN_SECONDS);
        }
        
        wp_send_json_success($suggestions);
    }
    
    private static function log_search($term, $results_count, $category = '', $difficulty = '', $season = '') {
        global $wpdb;
        
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        
        $filters = array();
        if (!empty($category)) $filters['category'] = $category;
        if (!empty($difficulty)) $filters['difficulty'] = $difficulty;
        if (!empty($season)) $filters['season'] = $season;
        
        $wpdb->insert(
            $searches_table,
            array(
                'search_term' => $term,
                'results_count' => $results_count,
                'user_id' => get_current_user_id(),
                'user_ip' => $_SERVER['REMOTE_ADDR'] ?? '',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                'source' => 'advanced_search',
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%d', '%s', '%s', '%s', '%s')
        );
    }
}

// تهيئة البحث المتقدم
MuhtawaaAdvancedSearch::init();

// إضافة دعم للتخصيص المتقدم
add_action('customize_register', 'muhtawaa_advanced_customizer');
function muhtawaa_advanced_customizer($wp_customize) {
    // قسم التخطيط
    $wp_customize->add_section('muhtawaa_layout', array(
        'title' => __('التخطيط والعرض', 'muhtawaa'),
        'priority' => 35,
    ));
    
    // عدد المقالات في الصفحة الرئيسية
    $wp_customize->add_setting('muhtawaa_posts_per_page', array(
        'default' => 6,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('muhtawaa_posts_per_page', array(
        'label' => __('عدد المقالات في الصفحة', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 12,
            'step' => 3,
        ),
    ));
    
    // نمط عرض الشبكة
    $wp_customize->add_setting('muhtawaa_grid_style', array(
        'default' => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('muhtawaa_grid_style', array(
        'label' => __('نمط عرض المقالات', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'select',
        'choices' => array(
            'grid' => 'شبكة (Grid)',
            'masonry' => 'مختلط الأحجام (Masonry)',
            'list' => 'قائمة (List)',
        ),
    ));
    
    // إظهار/إخفاء العناصر
    $wp_customize->add_setting('muhtawaa_show_breadcrumbs', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('muhtawaa_show_breadcrumbs', array(
        'label' => __('إظهار مسار التنقل', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting('muhtawaa_show_reading_time', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('muhtawaa_show_reading_time', array(
        'label' => __('إظهار وقت القراءة المتوقع', 'muhtawaa'),
        'section' => 'muhtawaa_layout',
        'type' => 'checkbox',
    ));
}

// دالة حساب وقت القراءة
function muhtawaa_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 كلمة في الدقيقة (متوسط للعربية)
    
    if ($reading_time === 1) {
        return 'دقيقة واحدة';
    } elseif ($reading_time < 3) {
        return $reading_time . ' دقيقتان';
    } elseif ($reading_time < 11) {
        return $reading_time . ' دقائق';
    } else {
        return $reading_time . ' دقيقة';
    }
}

// تحديث وقت القراءة تلقائياً عند حفظ المقال
add_action('save_post', 'muhtawaa_update_reading_time');
function muhtawaa_update_reading_time($post_id) {
    if (get_post_type($post_id) === 'post') {
        $reading_time = muhtawaa_reading_time($post_id);
        update_post_meta($post_id, '_reading_time', $reading_time);
    }
}

// دالة إنشاء الفئات الافتراضية مع أيقونات
function muhtawaa_create_default_categories_with_icons() {
    $categories = array(
        array(
            'name' => 'المنزل والتنظيف',
            'description' => 'حلول عملية للتنظيف والترتيب المنزلي',
            'icon' => '🏠',
            'color' => '#4CAF50'
        ),
        array(
            'name' => 'المطبخ والطبخ',
            'description' => 'نصائح وحيل للمطبخ والطبخ',
            'icon' => '🍳',
            'color' => '#FF9800'
        ),
        array(
            'name' => 'توفير المال',
            'description' => 'طرق ذكية لتوفير المال في الحياة اليومية',
            'icon' => '💰',
            'color' => '#2196F3'
        ),
        array(
            'name' => 'السيارات',
            'description' => 'نصائح صيانة وحلول لمشاكل السيارات',
            'icon' => '🚗',
            'color' => '#9C27B0'
        ),
        array(
            'name' =>                    <li style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee;">
                        <span><?php echo esc_html($search->search_term); ?></span>
                        <span style="background: #667eea; color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.8em;">
                            <?php echo $search->count; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: #666; text-align: center; margin: 20px 0;">لا توجد بحثات هذا الأسبوع</p>
        <?php endif; ?>
    </div>
    <?php
}

function muhtawaa_dashboard_quick_actions() {
    ?>
    <div class="dashboard-widget">
        <h3>⚡ إجراءات سريعة</h3>
        <div style="display: grid; gap: 10px;">
            <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-primary" style="text-align: center;">
                ➕ إضافة حل جديد
            </a>
            <a href="<?php echo admin_url('edit-tags.php?taxonomy=solution_category'); ?>" class="button" style="text-align: center;">
                🗂️ إدارة الفئات
            </a>
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-stats'); ?>" class="button" style="text-align: center;">
                📈 عرض الإحصائيات التفصيلية
            </a>
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-import-export'); ?>" class="button" style="text-align: center;">
                📤 استيراد/تصدير البيانات
            </a>
        </div>
        
        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
            <h4>🔧 صيانة سريعة</h4>
            <button onclick="performMaintenance()" class="button" style="width: 100%;">
                تشغيل الصيانة الآن
            </button>
            <button onclick="createBackup()" class="button" style="width: 100%; margin-top: 5px;">
                إنشاء نسخة احتياطية
            </button>
        </div>
    </div>
    
    <script>
    function performMaintenance() {
        if (confirm('هل تريد تشغيل الصيانة الآن؟ قد يستغرق هذا بضع دقائق.')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_maintenance',
                nonce: '<?php echo wp_create_nonce('muhtawaa_maintenance'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تمت الصيانة بنجاح!');
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    
    function createBackup() {
        if (confirm('هل تريد إنشاء نسخة احتياطية؟')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_backup',
                nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تم إنشاء النسخة الاحتياطية بنجاح!');
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    </script>
    <?php
}

// صفحة الإعدادات
function muhtawaa_settings_page() {
    if (isset($_POST['submit'])) {
        $theme = MuhtawaaTheme::getInstance();
        
        $settings = array(
            'theme_color_primary' => sanitize_hex_color($_POST['primary_color']),
            'theme_color_secondary' => sanitize_hex_color($_POST['secondary_color']),
            'enable_smart_recommendations' => isset($_POST['enable_recommendations']) ? 'yes' : 'no',
            'enable_advanced_search' => isset($_POST['enable_search']) ? 'yes' : 'no',
            'enable_rating_system' => isset($_POST['enable_rating']) ? 'yes' : 'no',
            'notification_email' => sanitize_email($_POST['notification_email']),
            'max_recommendations' => intval($_POST['max_recommendations']),
            'search_suggestions_count' => intval($_POST['search_suggestions']),
            'auto_backup_enabled' => isset($_POST['auto_backup']) ? 'yes' : 'no',
            'auto_backup_frequency' => sanitize_text_field($_POST['backup_frequency']),
        );
        
        foreach ($settings as $key => $value) {
            $theme->update_theme_setting($key, $value);
        }
        
        echo '<div class="notice notice-success"><p>تم حفظ الإعدادات بنجاح!</p></div>';
    }
    
    $theme = MuhtawaaTheme::getInstance();
    ?>
    
    <div class="wrap">
        <h1>إعدادات قالب محتوى</h1>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">اللون الأساسي</th>
                    <td>
                        <input type="color" name="primary_color" value="<?php echo esc_attr($theme->get_theme_setting('theme_color_primary', '#667eea')); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">اللون الثانوي</th>
                    <td>
                        <input type="color" name="secondary_color" value="<?php echo esc_attr($theme->get_theme_setting('theme_color_secondary', '#764ba2')); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">التوصيات الذكية</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_recommendations" <?php checked($theme->get_theme_setting('enable_smart_recommendations'), 'yes'); ?> />
                            تمكين نظام التوصيات الذكية
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">البحث المتقدم</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_search" <?php checked($theme->get_theme_setting('enable_advanced_search'), 'yes'); ?> />
                            تمكين البحث المتقدم في الحقول المخصصة
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">نظام التقييم</th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_rating" <?php checked($theme->get_theme_setting('enable_rating_system'), 'yes'); ?> />
                            تمكين نظام تقييم الحلول
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">بريد الإشعارات</th>
                    <td>
                        <input type="email" name="notification_email" value="<?php echo esc_attr($theme->get_theme_setting('notification_email', get_option('admin_email'))); ?>" class="regular-text" />
                        <p class="description">البريد الذي ستُرسل إليه إشعارات النظام</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">عدد التوصيات</th>
                    <td>
                        <input type="number" name="max_recommendations" value="<?php echo esc_attr($theme->get_theme_setting('max_recommendations', '5')); ?>" min="3" max="10" />
                        <p class="description">الحد الأقصى لعدد التوصيات المعروضة</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">اقتراحات البحث</th>
                    <td>
                        <input type="number" name="search_suggestions" value="<?php echo esc_attr($theme->get_theme_setting('search_suggestions_count', '8')); ?>" min="5" max="15" />
                        <p class="description">عدد اقتراحات البحث المعروضة</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">النسخ الاحتياطية التلقائية</th>
                    <td>
                        <label>
                            <input type="checkbox" name="auto_backup" <?php checked($theme->get_theme_setting('auto_backup_enabled'), 'yes'); ?> />
                            تمكين النسخ الاحتياطية التلقائية
                        </label>
                        <br><br>
                        <select name="backup_frequency">
                            <option value="daily" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'daily'); ?>>يومياً</option>
                            <option value="weekly" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'weekly'); ?>>أسبوعياً</option>
                            <option value="monthly" <?php selected($theme->get_theme_setting('auto_backup_frequency'), 'monthly'); ?>>شهرياً</option>
                        </select>
                    </td>
                </tr>
            </table>
            
            <?php submit_button('حفظ الإعدادات'); ?>
        </form>
    </div>
    <?php
}

// صفحة الإحصائيات
function muhtawaa_stats_page() {
    global $wpdb;
    
    // الحصول على الإحصائيات
    $stats = array(
        'posts' => wp_count_posts()->publish,
        'categories' => wp_count_terms('solution_category'),
        'subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'searches_week' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)"),
    );
    
    // أشهر الحلول
    $top_solutions = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm.meta_value as views
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_total_views'
        WHERE p.post_status = 'publish' AND p.post_type = 'post'
        ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
        LIMIT 10
    ");
    
    // أشهر البحثات
    $top_searches = $wpdb->get_results("
        SELECT search_term, COUNT(*) as count
        FROM {$wpdb->prefix}muhtawaa_searches
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY search_term
        ORDER BY count DESC
        LIMIT 10
    ");
    ?>
    
    <div class="wrap">
        <h1>إحصائيات مفصلة</h1>
        
        <div class="muhtawaa-stats-dashboard">
            <!-- إحصائيات عامة -->
            <div class="stats-section">
                <h2>📊 الإحصائيات العامة</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['posts']); ?></div>
                        <div class="stat-label">حل منشور</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['categories']); ?></div>
                        <div class="stat-label">فئة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['subscribers']); ?></div>
                        <div class="stat-label">مشترك</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></div>
                        <div class="stat-label">إجمالي المشاهدات</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['searches_today']); ?></div>
                        <div class="stat-label">بحث اليوم</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo number_format($stats['searches_week']); ?></div>
                        <div class="stat-label">بحث هذا الأسبوع</div>
                    </div>
                </div>
            </div>
            
            <!-- أشهر الحلول -->
            <div class="stats-section">
                <h2>🔥 أشهر الحلول</h2>
                <div class="top-list">
                    <?php if (!empty($top_solutions)): ?>
                        <?php foreach ($top_solutions as $index => $solution): ?>
                            <div class="top-item">
                                <span class="rank">#<?php echo $index + 1; ?></span>
                                <span class="title">
                                    <a href="<?php echo get_edit_post_link($solution->ID); ?>" target="_blank">
                                        <?php echo esc_html($solution->post_title); ?>
                                    </a>
                                </span>
                                <span class="count"><?php echo number_format($solution->views ?: 0); ?> مشاهدة</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>لا توجد بيانات مشاهدات بعد</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- أشهر البحثات -->
            <div class="stats-section">
                <h2>🔍 أشهر البحثات (آخر 30 يوم)</h2>
                <div class="top-list">
                    <?php if (!empty($top_searches)): ?>
                        <?php foreach ($top_searches as $index => $search): ?>
                            <div class="top-item">
                                <span class="rank">#<?php echo $index + 1; ?></span>
                                <span class="title"><?php echo esc_html($search->search_term); ?></span>
                                <span class="count"><?php echo number_format($search->count); ?> مرة</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>لا توجد بحثات مسجلة</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-stats-dashboard {
        margin-top: 20px;
    }
    
    .stats-section {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .stats-section h2 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .stat-card {
        text-align: center;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .stat-number {
        font-size: 2.5em;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 1.1em;
        opacity: 0.9;
    }
    
    .top-list {
        margin-top: 20px;
    }
    
    .top-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #eee;
        transition: background 0.3s;
    }
    
    .top-item:hover {
        background: #f8f9fa;
    }
    
    .top-item .rank {
        font-weight: bold;
        color: #667eea;
        width: 40px;
        flex-shrink: 0;
    }
    
    .top-item .title {
        flex: 1;
        margin: 0 15px;
    }
    
    .top-item .title a {
        text-decoration: none;
        color: #333;
    }
    
    .top-item .title a:hover {
        color: #667eea;
    }
    
    .top-item .count {
        font-weight: bold;
        color: #48bb78;
        background: #f0fff4;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }
    </style>
    <?php
}

// صفحة الاستيراد والتصدير
function muhtawaa_import_export_page() {
    if (isset($_POST['export_solutions'])) {
        $format = sanitize_text_field($_POST['export_format']);
        
    }
    
    if (isset($_POST['import_solutions']) && isset($_FILES['import_file'])) {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $_FILES['import_file']['name'];
        
        if (move_uploaded_file($_FILES['import_file']['tmp_name'], $file_path)) {
            $result = 
            
            if (is_wp_error($result)) {
                echo '<div class="notice notice-error"><p>خطأ: ' . $result->get_error_message() . '</p></div>';
            } else {
                echo '<div class="notice notice-success"><p>تم استيراد ' . $result['imported'] . ' حل بنجاح!</p></div>';
                if (!empty($result['errors'])) {
                    echo '<div class="notice notice-warning"><p>الأخطاء: ' . implode(', ', $result['errors']) . '</p></div>';
                }
            }
            
            unlink($file_path); // حذف الملف المؤقت
        }
    }
    ?>
    
    <div class="wrap">
        <h1>الاستيراد والتصدير</h1>
        
        <div class="muhtawaa-import-export">
            <!-- تصدير البيانات -->
            <div class="export-section">
                <h2>📤 تصدير الحلول</h2>
                <p>يمكنك تصدير جميع الحلول المنشورة مع بياناتها المخصصة.</p>
                
                <form method="post" style="margin-top: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">تنسيق التصدير</th>
                            <td>
                                <label>
                                    <input type="radio" name="export_format" value="json" checked />
                                    JSON (موصى به للاستيراد لاحقاً)
                                </label>
                                <br>
                                <label>
                                    
                                    CSV (لفتح في Excel أو Google Sheets)
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" name="export_solutions" class="button button-primary" value="تصدير الحلول" />
                    </p>
                </form>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- استيراد البيانات -->
            <div class="import-section">
                <h2>📥 استيراد الحلول</h2>
                <p>يمكنك استيراد حلول من ملف JSON. سيتم استيراد الحلول كمسودات للمراجعة.</p>
                
                <div class="import-instructions" style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0;">
                    <h4>تعليمات الاستيراد:</h4>
                    <ul>
                        <li>يجب أن يكون الملف بصيغة JSON</li>
                        <li>سيتم استيراد الحلول كمسودات</li>
                        <li>ستحتاج لمراجعة وموافقة على كل حل</li>
                        <li>تأكد من صحة البيانات قبل الاستيراد</li>
                    </ul>
                </div>
                
                <form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row">ملف JSON</th>
                            <td>
                                <input type="file" name="import_file" accept=".json" required />
                                <p class="description">اختر ملف JSON يحتوي على بيانات الحلول</p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" name="import_solutions" class="button button-primary" value="استيراد الحلول" 
                               onclick="return confirm('هل أنت متأكد من استيراد البيانات؟ سيتم إنشاء مقالات جديدة.')" />
                    </p>
                </form>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- النسخ الاحتياطية -->
            <div class="backup-section">
                <h2>💾 النسخ الاحتياطية</h2>
                <p>يمكنك إنشاء وإدارة النسخ الاحتياطية لبيانات القالب.</p>
                
                <div style="margin: 20px 0;">
                    <button onclick="createManualBackup()" class="button button-secondary">
                        إنشاء نسخة احتياطية الآن
                    </button>
                    
                    <button onclick="listBackups()" class="button" style="margin-right: 10px;">
                        عرض النسخ الاحتياطية
                    </button>
                </div>
                
                <div id="backup-list" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-import-export {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 30px;
        margin-top: 20px;
    }
    
    .export-section h2,
    .import-section h2,
    .backup-section h2 {
        color: #667eea;
        margin-bottom: 15px;
    }
    
    .import-instructions {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 15px;
        margin: 20px 0;
    }
    
    .import-instructions h4 {
        margin-top: 0;
        color: #856404;
    }
    
    .import-instructions ul {
        margin-bottom: 0;
        color: #856404;
    }
    </style>
    
    <script>
    function createManualBackup() {
        if (confirm('هل تريد إنشاء نسخة احتياطية؟')) {
            jQuery.post(ajaxurl, {
                action: 'muhtawaa_manual_backup',
                nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
            }, function(response) {
                if (response.success) {
                    alert('تم إنشاء النسخة الاحتياطية بنجاح!');
                    listBackups();
                } else {
                    alert('حدث خطأ: ' + response.data);
                }
            });
        }
    }
    
    function listBackups() {
        jQuery.post(ajaxurl, {
            action: 'muhtawaa_list_backups',
            nonce: '<?php echo wp_create_nonce('muhtawaa_backup'); ?>'
        }, function(response) {
            if (response.success) {
                jQuery('#backup-list').html(response.data);
            } else {
                jQuery('#backup-list').html('<p>لا توجد نسخ احتياطية</p>');
            }
        });
    }
    </script>
    <?php
}

// إجراءات AJAX للصيانة والنسخ الاحتياطية
add_action('wp_ajax_muhtawaa_manual_maintenance', 'muhtawaa_handle_manual_maintenance');
function muhtawaa_handle_manual_maintenance() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_maintenance') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $theme = MuhtawaaTheme::getInstance();
    $theme->daily_maintenance();
    
    wp_send_json_success('تمت الصيانة بنجاح');
}

add_action('wp_ajax_muhtawaa_manual_backup', 'muhtawaa_handle_manual_backup');
function muhtawaa_handle_manual_backup() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_backup') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $theme = MuhtawaaTheme::getInstance();
    $backup_file = $theme->create_backup();
    
    if ($backup_file) {
        wp_send_json_success('تم إنشاء النسخة الاحتياطية: ' . basename($backup_file));
    } else {
        wp_send_json_error('فشل في إنشاء النسخة الاحتياطية');
    }
}

add_action('wp_ajax_muhtawaa_list_backups', 'muhtawaa_handle_list_backups');
function muhtawaa_handle_list_backups() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_backup') || !current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    $upload_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
    
    if (!file_exists($upload_dir)) {
        wp_send_json_success('<p>لا توجد نسخ احتياطية</p>');
        return;
    }
    
    $backups = glob($upload_dir . 'backup-*.sql');
    
    if (empty($backups)) {
        wp_send_json_success('<p>لا توجد نسخ احتياطية</p>');
        return;
    }
    
    usort($backups, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });
    
    $html = '<h4>النسخ الاحتياطية المتاحة:</h4><ul>';
    
    foreach ($backups as $backup) {
        $filename = basename($backup);
        $size = size_format(filesize($backup));
        $date = date('Y-m-d H:i:s', filemtime($backup));
        
        $html .= "<li style='margin-bottom: 10px; padding: 10px; background: #f9f9f9; border-<?php
/**
 * Theme Name: محتوى - الحلول اليومية
 * Functions and definitions - النسخة المطورة والمحسنة
 * 
 * @package Muhtawaa
 * @version 2.0
 */

// منع الوصول المباشر للملفات
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

// ثوابت القالب المطورة
define('THEME_VERSION', '2.0');
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_ASSETS_URL', THEME_URL . '/assets');
define('THEME_INC_PATH', THEME_PATH . '/inc');
define('THEME_LANGUAGES_PATH', THEME_PATH . '/languages');

// فئة إدارة القالب الرئيسية
class MuhtawaaTheme {
    
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('init', array($this, 'init_features'));
        add_action('customize_register', array($this, 'customize_register'));
        add_action('wp_head', array($this, 'add_meta_tags'));
        
        // تحميل ملفات النظام
        $this->load_includes();
        
        // إعداد نظام الصيانة التلقائية
        $this->setup_maintenance_system();
        
        // إعداد نظام الإشعارات المحسن
        $this->setup_notification_system();
    }
    
    /**
     * إعداد القالب الأساسي
     */
    public function setup() {
        // دعم اللغة العربية
        load_theme_textdomain('muhtawaa', THEME_LANGUAGES_PATH);
        
        // دعم ميزات ووردبريس المتقدمة
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 
            'gallery', 'caption', 'script', 'style'
        ));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', array(
            'height' => 100, 'width' => 300,
            'flex-height' => true, 'flex-width' => true,
        ));
        add_theme_support('post-formats', array(
            'aside', 'gallery', 'link', 'image', 'quote', 
            'status', 'video', 'audio', 'chat'
        ));
        add_theme_support('custom-background');
        add_theme_support('custom-header');
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        
        // تسجيل القوائم المحسنة
        register_nav_menus(array(
            'main-menu' => __('القائمة الرئيسية', 'muhtawaa'),
            'footer-menu' => __('قائمة التذييل', 'muhtawaa'),
            'mobile-menu' => __('قائمة الجوال', 'muhtawaa'),
            'social-menu' => __('قائمة وسائل التواصل', 'muhtawaa'),
        ));
        
        // أحجام الصور المخصصة المحسنة
        add_image_size('solution-thumbnail', 400, 300, true);
        add_image_size('solution-large', 800, 600, true);
        add_image_size('solution-featured', 1200, 600, true);
        add_image_size('category-icon', 150, 150, true);
        add_image_size('author-avatar', 100, 100, true);
        
        // إعداد RSS محسن
        add_theme_support('automatic-feed-links');
        
        // إعداد محرر المحتوى
        add_editor_style('assets/css/editor.css');
    }
    
    /**
     * تحميل ملفات CSS و JavaScript المحسنة
     */
    public function enqueue_scripts() {
        // ملفات CSS المحسنة
        wp_enqueue_style('muhtawaa-style', get_stylesheet_uri(), array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-main', THEME_ASSETS_URL . '/css/main.css', array(), THEME_VERSION);
        wp_enqueue_style('muhtawaa-custom', THEME_ASSETS_URL . '/css/custom.css', array('muhtawaa-main'), THEME_VERSION);
        
        // Font Awesome محسن
        wp_enqueue_style('font-awesome', 
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', 
            array(), '6.4.0'
        );
        
        // Google Fonts للعربية
        wp_enqueue_style('google-fonts', 
            'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap',
            array(), THEME_VERSION
        );
        
        // jQuery مع fallback
        wp_enqueue_script('jquery');
        
        // ملفات JavaScript المحسنة
        wp_enqueue_script('muhtawaa-main', 
            THEME_ASSETS_URL . '/js/main.js', 
            array('jquery'), THEME_VERSION, true
        );
        
        wp_enqueue_script('muhtawaa-enhanced', 
            THEME_ASSETS_URL . '/js/enhanced.js', 
            array('muhtawaa-main'), THEME_VERSION, true
        );
        
        // متغيرات JavaScript محسنة
        wp_localize_script('muhtawaa-main', 'muhtawaaAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_nonce'),
            'postId' => get_the_ID() ?: 0,
            'homeUrl' => home_url(),
            'themeUrl' => THEME_URL,
            'currentUserId' => get_current_user_id(),
            'isAdmin' => current_user_can('manage_options'),
            'locale' => get_locale(),
            'strings' => array(
                'loading' => __('جاري التحميل...', 'muhtawaa'),
                'error' => __('حدث خطأ', 'muhtawaa'),
                'success' => __('تم بنجاح', 'muhtawaa'),
                'confirm' => __('هل أنت متأكد؟', 'muhtawaa'),
                'noResults' => __('لا توجد نتائج', 'muhtawaa'),
                'loadMore' => __('تحميل المزيد', 'muhtawaa'),
                'searchPlaceholder' => __('ابحث عن حل...', 'muhtawaa'),
            ),
            'settings' => $this->get_theme_settings(),
        ));
        
        // تحميل ملف التعليقات إذا لزم الأمر
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        
        // Lazy loading للصور
        wp_enqueue_script('muhtawaa-lazyload', 
            THEME_ASSETS_URL . '/js/lazyload.js', 
            array(), THEME_VERSION, true
        );
    }
    
    /**
     * تسجيل مناطق الودجات المحسنة
     */
    public function widgets_init() {
        // الشريط الجانبي الرئيسي
        register_sidebar(array(
            'name' => __('الشريط الجانبي الرئيسي', 'muhtawaa'),
            'id' => 'sidebar-main',
            'description' => __('الشريط الجانبي للصفحات الفردية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // شريط جانبي للصفحة الرئيسية
        register_sidebar(array(
            'name' => __('شريط الصفحة الرئيسية', 'muhtawaa'),
            'id' => 'sidebar-home',
            'description' => __('شريط جانبي خاص بالصفحة الرئيسية', 'muhtawaa'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // مناطق تذييل الموقع
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name' => sprintf(__('تذييل الموقع %d', 'muhtawaa'), $i),
                'id' => "footer-{$i}",
                'description' => sprintf(__('العمود %d في تذييل الموقع', 'muhtawaa'), $i),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ));
        }
        
        // منطقة ما قبل المحتوى
        register_sidebar(array(
            'name' => __('ما قبل المحتوى', 'muhtawaa'),
            'id' => 'before-content',
            'description' => __('تظهر قبل محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="pre-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        
        // منطقة ما بعد المحتوى
        register_sidebar(array(
            'name' => __('ما بعد المحتوى', 'muhtawaa'),
            'id' => 'after-content',
            'description' => __('تظهر بعد محتوى الصفحات', 'muhtawaa'),
            'before_widget' => '<div id="%1$s" class="post-content-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
    
    /**
     * تحميل ملفات النظام المطلوبة
     */
    private function load_includes() {
        $includes = array(
            'ajax-functions.php',
            'theme-settings.php',
            'customizer.php',
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
            'admin-dashboard.php',
        );
        
        foreach ($includes as $file) {
            $file_path = THEME_INC_PATH . '/' . $file;
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }
    }
    
    /**
     * تهيئة ميزات القالب المحسنة
     */
    public function init_features() {
        // إنشاء التصنيفات المخصصة
        $this->create_custom_taxonomies();
        
        // إنشاء أنواع المحتوى المخصصة
        $this->create_custom_post_types();
        
        // إنشاء الجداول المطلوبة
        $this->create_database_tables();
        
        // إعداد نظام البحث المحسن
        add_action('pre_get_posts', array($this, 'enhance_search'));
        
        // إعداد نظام التوصيات الذكية
        add_action('wp_footer', array($this, 'load_smart_recommendations'));
        
        // تحسين الأمان
        $this->enhance_security();
        
        // تحسين الأداء
        $this->enhance_performance();
    }
    
    /**
     * إنشاء التصنيفات المخصصة المحسنة
     */
    private function create_custom_taxonomies() {
        // تصنيف فئات الحلول
        register_taxonomy('solution_category', 'post', array(
            'labels' => array(
                'name' => __('فئات الحلول', 'muhtawaa'),
                'singular_name' => __('فئة الحلول', 'muhtawaa'),
                'menu_name' => __('فئات الحلول', 'muhtawaa'),
                'all_items' => __('جميع الفئات', 'muhtawaa'),
                'edit_item' => __('تعديل الفئة', 'muhtawaa'),
                'view_item' => __('مشاهدة الفئة', 'muhtawaa'),
                'update_item' => __('تحديث الفئة', 'muhtawaa'),
                'add_new_item' => __('إضافة فئة جديدة', 'muhtawaa'),
                'new_item_name' => __('اسم الفئة الجديدة', 'muhtawaa'),
                'search_items' => __('البحث في الفئات', 'muhtawaa'),
                'not_found' => __('لم يتم العثور على فئات', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'solutions'),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
            'meta_box_cb' => 'post_categories_meta_box',
        ));
        
        // تصنيف مستوى الصعوبة
        register_taxonomy('difficulty_level', 'post', array(
            'labels' => array(
                'name' => __('مستويات الصعوبة', 'muhtawaa'),
                'singular_name' => __('مستوى الصعوبة', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
        
        // تصنيف الكلمات المفتاحية للحلول
        register_taxonomy('solution_tags', 'post', array(
            'labels' => array(
                'name' => __('كلمات مفتاحية للحلول', 'muhtawaa'),
                'singular_name' => __('كلمة مفتاحية', 'muhtawaa'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ));
    }
    
    /**
     * إنشاء أنواع المحتوى المخصصة
     */
    private function create_custom_post_types() {
        // نوع محتوى للتوصيات
        register_post_type('recommendation', array(
            'labels' => array(
                'name' => __('التوصيات', 'muhtawaa'),
                'singular_name' => __('توصية', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-lightbulb',
        ));
        
        // نوع محتوى للإشعارات
        register_post_type('notification', array(
            'labels' => array(
                'name' => __('الإشعارات', 'muhtawaa'),
                'singular_name' => __('إشعار', 'muhtawaa'),
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor'),
            'menu_icon' => 'dashicons-bell',
        ));
    }
    
    /**
     * إنشاء الجداول المطلوبة
     */
    private function create_database_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // جدول الإحصائيات المحسن
        $stats_table = $wpdb->prefix . 'muhtawaa_stats';
        $sql_stats = "CREATE TABLE IF NOT EXISTS $stats_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) DEFAULT 0,
            action_type varchar(50) NOT NULL,
            action_value text,
            user_ip varchar(45),
            user_agent text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            KEY user_id (user_id),
            KEY action_type (action_type),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول المشتركين المحسن
        $subscribers_table = $wpdb->prefix . 'muhtawaa_subscribers';
        $sql_subscribers = "CREATE TABLE IF NOT EXISTS $subscribers_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            email varchar(100) NOT NULL,
            name varchar(100),
            preferences text,
            status varchar(20) DEFAULT 'active',
            source varchar(50) DEFAULT 'website',
            confirmation_token varchar(255),
            confirmed_at datetime,
            last_email_sent datetime,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY email (email),
            KEY status (status),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        // جدول البحثات المحسن
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            search_term varchar(255) NOT NULL,
            results_count int(11) DEFAULT 0,
            clicked_result_id bigint(20) DEFAULT 0,
            user_id bigint(20) DEFAULT 0,
            user_ip varchar(45),
            user_agent text,
            source varchar(50) DEFAULT 'website',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY search_term (search_term),
            KEY user_id (user_id),
            KEY created_at (created_at),
            FULLTEXT KEY search_term_fulltext (search_term)
        ) $charset_collate;";
        
        // جدول التوصيات الذكية
        $recommendations_table = $wpdb->prefix . 'muhtawaa_recommendations';
        $sql_recommendations = "CREATE TABLE IF NOT EXISTS $recommendations_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) DEFAULT 0,
            post_id bigint(20) NOT NULL,
            recommended_post_id bigint(20) NOT NULL,
            recommendation_type varchar(50) NOT NULL,
            score decimal(5,2) DEFAULT 0.00,
            shown_count int(11) DEFAULT 0,
            clicked_count int(11) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY post_id (post_id),
            KEY recommended_post_id (recommended_post_id),
            KEY recommendation_type (recommendation_type)
        ) $charset_collate;";
        
        // جدول إعدادات القالب
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $sql_settings = "CREATE TABLE IF NOT EXISTS $settings_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            setting_key varchar(100) NOT NULL,
            setting_value longtext,
            setting_type varchar(50) DEFAULT 'string',
            autoload varchar(20) DEFAULT 'yes',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY setting_key (setting_key),
            KEY autoload (autoload)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_stats);
        dbDelta($sql_subscribers);
        dbDelta($sql_searches);
        dbDelta($sql_recommendations);
        dbDelta($sql_settings);
        
        // إدراج الإعدادات الافتراضية
        $this->insert_default_settings();
    }
    
    /**
     * إدراج الإعدادات الافتراضية
     */
    private function insert_default_settings() {
        $default_settings = array(
            'theme_color_primary' => '#667eea',
            'theme_color_secondary' => '#764ba2',
            'enable_smart_recommendations' => 'yes',
            'enable_advanced_search' => 'yes',
            'enable_rating_system' => 'yes',
            'maintenance_mode' => 'no',
            'notification_email' => get_option('admin_email'),
            'max_recommendations' => '5',
            'search_suggestions_count' => '8',
            'auto_backup_enabled' => 'yes',
            'auto_backup_frequency' => 'weekly',
        );
        
        foreach ($default_settings as $key => $value) {
            $this->update_theme_setting($key, $value);
        }
    }
    
    /**
     * تحسين نظام البحث
     */
    public function enhance_search($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            // البحث في العنوان والمحتوى والحقول المخصصة
            $search_term = $query->get('s');
            
            if (!empty($search_term)) {
                // إضافة البحث في الحقول المخصصة
                $meta_query = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_solution_materials',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_solution_description',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                );
                
                $query->set('meta_query', $meta_query);
                
                // البحث في التصنيفات أيضاً
                $tax_query = array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'solution_category',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                    array(
                        'taxonomy' => 'solution_tags',
                        'field' => 'name',
                        'terms' => $search_term,
                        'operator' => 'LIKE'
                    ),
                );
                
                $query->set('tax_query', $tax_query);
                
                // تسجيل البحث للإحصائيات
                $this->log_search($search_term, $query->found_posts);
            }
        }
        
        return $query;
    }
    
    /**
     * تسجيل البحث في قاعدة البيانات
     */
    private function log_search($search_term, $results_count = 0) {
        global $wpdb;
        
        $searches_table = $wpdb->prefix . 'muhtawaa_searches';
        
        $wpdb->insert(
            $searches_table,
            array(
                'search_term' => sanitize_text_field($search_term),
                'results_count' => intval($results_count),
                'user_id' => get_current_user_id(),
                'user_ip' => $this->get_user_ip(),
                'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%d', '%s', '%s', '%s')
        );
    }
    
    /**
     * الحصول على عنوان IP المستخدم
     */
    private function get_user_ip() {
        $ip_keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    }
    
    /**
     * إعداد نظام الصيانة التلقائية
     */
    private function setup_maintenance_system() {
        // جدولة تنظيف قاعدة البيانات
        if (!wp_next_scheduled('muhtawaa_daily_maintenance')) {
            wp_schedule_event(time(), 'daily', 'muhtawaa_daily_maintenance');
        }
        
        add_action('muhtawaa_daily_maintenance', array($this, 'daily_maintenance'));
        
        // جدولة النسخ الاحتياطية
        if (!wp_next_scheduled('muhtawaa_weekly_backup')) {
            wp_schedule_event(time(), 'weekly', 'muhtawaa_weekly_backup');
        }
        
        add_action('muhtawaa_weekly_backup', array($this, 'create_backup'));
    }
    
    /**
     * الصيانة اليومية
     */
    public function daily_maintenance() {
        global $wpdb;
        
        // تنظيف البيانات القديمة (أكثر من 6 أشهر)
        $six_months_ago = date('Y-m-d H:i:s', strtotime('-6 months'));
        
        // حذف الإحصائيات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_stats WHERE created_at < %s",
            $six_months_ago
        ));
        
        // حذف البحثات القديمة
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < %s",
            $six_months_ago
        ));
        
        // تنظيف transients منتهية الصلاحية
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%' AND option_name NOT IN (SELECT CONCAT('_transient_', SUBSTRING(option_name, 19)) FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%')");
        
        // تحسين الجداول
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE $table");
        }
        
        // إرسال تقرير الصيانة
        $this->send_maintenance_report();
    }
    
    /**
     * إنشاء نسخة احتياطية
     */
    public function create_backup() {
        if ($this->get_theme_setting('auto_backup_enabled') !== 'yes') {
            return;
        }
        
        global $wpdb;
        
        $backup_dir = wp_upload_dir()['basedir'] . '/muhtawaa-backups/';
        if (!file_exists($backup_dir)) {
            wp_mkdir_p($backup_dir);
        }
        
        $backup_file = $backup_dir . 'backup-' . date('Y-m-d-H-i-s') . '.sql';
        
        $tables = array(
            $wpdb->prefix . 'muhtawaa_stats',
            $wpdb->prefix . 'muhtawaa_subscribers',
            $wpdb->prefix . 'muhtawaa_searches',
            $wpdb->prefix . 'muhtawaa_recommendations',
            $wpdb->prefix . 'muhtawaa_settings'
        );
        
        $sql_dump = "-- Muhtawaa Theme Backup\n";
        $sql_dump .= "-- Created: " . date('Y-m-d H:i:s') . "\n\n";
        
        foreach ($tables as $table) {
            $result = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
            
            if (!empty($result)) {
                $sql_dump .= "-- Table: $table\n";
                $sql_dump .= "TRUNCATE TABLE $table;\n";
                
                foreach ($result as $row) {
                    $values = array();
                    foreach ($row as $value) {
                        $values[] = "'" . $wpdb->_escape($value) . "'";
                    }
                    $sql_dump .= "INSERT INTO $table VALUES (" . implode(',', $values) . ");\n";
                }
                $sql_dump .= "\n";
            }
        }
        
        file_put_contents($backup_file, $sql_dump);
        
        // حذف النسخ القديمة (أكثر من شهر)
        $this->cleanup_old_backups($backup_dir);
        
        return $backup_file;
    }
    
    /**
     * تنظيف النسخ الاحتياطية القديمة
     */
    private function cleanup_old_backups($backup_dir) {
        $files = glob($backup_dir . 'backup-*.sql');
        $one_month_ago = time() - (30 * 24 * 60 * 60);
        
        foreach ($files as $file) {
            if (filemtime($file) < $one_month_ago) {
                unlink($file);
            }
        }
    }
    
    /**
     * إرسال تقرير الصيانة
     */
    private function send_maintenance_report() {
        $admin_email = $this->get_theme_setting('notification_email');
        if (!$admin_email) return;
        
        global $wpdb;
        
        // إحصائيات سريعة
        $stats = array(
            'total_posts' => wp_count_posts()->publish,
            'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
            'searches_today' => $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
                date('Y-m-d')
            )),
            'top_search' => $wpdb->get_var("SELECT search_term FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY search_term ORDER BY COUNT(*) DESC LIMIT 1")
        );
        
        $subject = 'تقرير الصيانة اليومية - ' . get_bloginfo('name');
        $message = "تقرير الصيانة اليومية لموقع " . get_bloginfo('name') . "\n\n";
        $message .= "إجمالي المقالات: " . $stats['total_posts'] . "\n";
        $message .= "إجمالي المشتركين: " . $stats['total_subscribers'] . "\n";
        $message .= "البحثات اليوم: " . $stats['searches_today'] . "\n";
        $message .= "أشهر بحث هذا الأسبوع: " . ($stats['top_search'] ?: 'لا يوجد') . "\n\n";
        $message .= "تم تنفيذ الصيانة بنجاح في: " . date('Y-m-d H:i:s');
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * إعداد نظام الإشعارات المحسن
     */
    private function setup_notification_system() {
        // تحميل نظام الإشعارات
        add_action('wp_ajax_dismiss_notification', array($this, 'dismiss_notification'));
        add_action('wp_ajax_nopriv_dismiss_notification', array($this, 'dismiss_notification'));
        
        // إضافة إشعارات في لوحة التحكم
        add_action('admin_notices', array($this, 'show_admin_notifications'));
        
        // إشعارات المستخدمين في الواجهة الأمامية
        add_action('wp_footer', array($this, 'show_frontend_notifications'));
    }
    
    /**
     * إظهار الإشعارات في لوحة التحكم
     */
    public function show_admin_notifications() {
        if (!current_user_can('manage_options')) return;
        
        // فحص التحديثات المطلوبة
        $this->check_theme_updates();
        
        // فحص مشاكل الأداء
        $this->check_performance_issues();
        
        // فحص مشاكل الأمان
        $this->check_security_issues();
    }
    
    /**
     * فحص تحديثات القالب
     */
    private function check_theme_updates() {
        $last_check = get_option('muhtawaa_last_update_check', 0);
        $current_time = time();
        
        // فحص مرة واحدة يومياً
        if (($current_time - $last_check) > DAY_IN_SECONDS) {
            // هنا يمكن إضافة منطق فحص التحديثات من خادم خارجي
            update_option('muhtawaa_last_update_check', $current_time);
        }
    }
    
    /**
     * فحص مشاكل الأداء
     */
    private function check_performance_issues() {
        global $wpdb;
        
        // فحص حجم قاعدة البيانات
        $db_size = $wpdb->get_var("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS 'DB Size in MB' FROM information_schema.tables WHERE table_schema='{$wpdb->dbname}'");
        
        if ($db_size > 500) { // أكثر من 500 ميجا
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>تحذير:</strong> حجم قاعدة البيانات كبير (' . $db_size . ' ميجا). يُنصح بتنظيف البيانات القديمة.</p>
            </div>';
        }
        
        // فحص عدد المراجعات
        $revisions_count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'revision'");
        
        if ($revisions_count > 1000) {
            echo '<div class="notice notice-info is-dismissible">
                <p><strong>تحسين:</strong> يوجد ' . $revisions_count . ' مراجعة. يمكن حذف القديمة منها لتحسين الأداء.</p>
            </div>';
        }
    }
    
    /**
     * فحص مشاكل الأمان
     */
    private function check_security_issues() {
        // فحص إعدادات الأمان الأساسية
        if (get_option('users_can_register')) {
            echo '<div class="notice notice-error is-dismissible">
                <p><strong>تحذير أمني:</strong> التسجيل مفتوح للجميع. يُنصح بإغلاقه إذا لم يكن ضرورياً.</p>
            </div>';
        }
        
        // فحص قوة كلمات المرور
        $weak_users = get_users(array(
            'meta_query' => array(
                array(
                    'key' => 'wp_user_level',
                    'value' => '10',
                    'compare' => '='
                )
            )
        ));
        
        foreach ($weak_users as $user) {
            if (strlen($user->user_pass) < 12) {
                echo '<div class="notice notice-warning is-dismissible">
                    <p><strong>تحذير أمني:</strong> يُنصح المديرين باستخدام كلمات مرور قوية (12 حرف على الأقل).</p>
                </div>';
                break;
            }
        }
    }
    
    /**
     * إظهار الإشعارات في الواجهة الأمامية
     */
    public function show_frontend_notifications() {
        if (is_admin()) return;
        
        $notifications = $this->get_active_notifications();
        
        if (!empty($notifications)) {
            echo '<div id="muhtawaa-notifications">';
            foreach ($notifications as $notification) {
                echo '<div class="muhtawaa-notification notification-' . $notification['type'] . '" data-id="' . $notification['id'] . '">';
                echo '<span class="notification-message">' . $notification['message'] . '</span>';
                echo '<button class="notification-close" data-id="' . $notification['id'] . '">&times;</button>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
    
    /**
     * الحصول على الإشعارات النشطة
     */
    private function get_active_notifications() {
        // يمكن تخصيص هذه الدالة لجلب الإشعارات من قاعدة البيانات
        $notifications = array();
        
        // إشعار ترحيب للزوار الجدد
        if (!isset($_COOKIE['muhtawaa_visited'])) {
            $notifications[] = array(
                'id' => 'welcome',
                'type' => 'info',
                'message' => 'مرحباً بك في موقع محتوى! اكتشف آلاف الحلول العملية للمشاكل اليومية.'
            );
        }
        
        // إشعار النشرة البريدية
        if (!isset($_COOKIE['muhtawaa_newsletter_prompted'])) {
            $notifications[] = array(
                'id' => 'newsletter',
                'type' => 'success',
                'message' => 'اشترك في نشرتنا البريدية واحصل على حل عملي جديد كل يوم! 📧'
            );
        }
        
        return $notifications;
    }
    
    /**
     * رفض الإشعار
     */
    public function dismiss_notification() {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'muhtawaa_nonce')) {
            wp_die('غير مصرح');
        }
        
        $notification_id = sanitize_text_field($_POST['notification_id'] ?? '');
        
        if ($notification_id) {
            // حفظ في الكوكيز لمدة شهر
            setcookie('muhtawaa_notification_' . $notification_id . '_dismissed', '1', time() + (30 * DAY_IN_SECONDS), '/');
            wp_send_json_success('تم رفض الإشعار');
        }
        
        wp_send_json_error('معرف الإشعار مطلوب');
    }
    
    /**
     * تحميل التوصيات الذكية
     */
    public function load_smart_recommendations() {
        if (!is_single() || !$this->get_theme_setting('enable_smart_recommendations')) {
            return;
        }
        
        $post_id = get_the_ID();
        $recommendations = $this->get_smart_recommendations($post_id);
        
        if (!empty($recommendations)) {
            echo '<div id="smart-recommendations" style="display: none;">';
            echo json_encode($recommendations);
            echo '</div>';
        }
    }
    
    /**
     * الحصول على التوصيات الذكية
     */
    private function get_smart_recommendations($post_id) {
        global $wpdb;
        
        $cache_key = "smart_recommendations_$post_id";
        $recommendations = wp_cache_get($cache_key);
        
        if ($recommendations === false) {
            // خوارزمية التوصيات الذكية
            $current_post = get_post($post_id);
            $categories = wp_get_post_categories($post_id);
            $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
            
            $recommended_posts = array();
            
            // 1. مقالات من نفس الفئة
            if (!empty($categories)) {
                $category_posts = get_posts(array(
                    'category__in' => $categories,
                    'post__not_in' => array($post_id),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));
                
                foreach ($category_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'category',
                        'score' => 0.8
                    );
                }
            }
            
            // 2. مقالات بنفس الكلمات المفتاحية
            if (!empty($tags) && count($recommended_posts) < 5) {
                $tag_posts = get_posts(array(
                    'tag__in' => $tags,
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 2,
                    'orderby' => 'rand'
                ));
                
                foreach ($tag_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'tags',
                        'score' => 0.6
                    );
                }
            }
            
            // 3. المقالات الأكثر شعبية
            if (count($recommended_posts) < 5) {
                $popular_posts = get_posts(array(
                    'post__not_in' => array_merge(array($post_id), wp_list_pluck($recommended_posts, 'id')),
                    'posts_per_page' => 3,
                    'meta_key' => '_total_views',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ));
                
                foreach ($popular_posts as $post) {
                    $recommended_posts[] = array(
                        'id' => $post->ID,
                        'title' => $post->post_title,
                        'url' => get_permalink($post->ID),
                        'type' => 'popular',
                        'score' => 0.4
                    );
                }
            }
            
            // ترتيب حسب النقاط
            usort($recommended_posts, function($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            
            $recommendations = array_slice($recommended_posts, 0, 5);
            
            // حفظ في الكاش لمدة ساعة
            wp_cache_set($cache_key, $recommendations, '', HOUR_IN_SECONDS);
        }
        
        return $recommendations;
    }
    
    /**
     * تحسين الأمان
     */
    private function enhance_security() {
        // إخفاء إصدار ووردبريس
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_empty_string');
        
        // منع تعداد المستخدمين
        add_action('wp', function() {
            if (is_author() && !is_user_logged_in()) {
                wp_redirect(home_url());
                exit;
            }
        });
        
        // حماية ملف wp-config
        add_action('init', function() {
            if (strpos($_SERVER['REQUEST_URI'], 'wp-config.php') !== false) {
                wp_die('Access denied');
            }
        });
        
        // إضافة headers أمنية
        add_action('send_headers', function() {
            header('X-Frame-Options: SAMEORIGIN');
            header('X-Content-Type-Options: nosniff');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
        });
        
        // تحديد محاولات تسجيل الدخول
        add_action('wp_login_failed', array($this, 'handle_failed_login'));
        add_filter('authenticate', array($this, 'check_login_attempts'), 30, 3);
    }
    
    /**
     * معالجة فشل تسجيل الدخول
     */
    public function handle_failed_login($username) {
        $ip = $this->get_user_ip();
        $attempts = get_transient("login_attempts_$ip") ?: 0;
        $attempts++;
        
        set_transient("login_attempts_$ip", $attempts, 15 * MINUTE_IN_SECONDS);
        
        if ($attempts >= 5) {
            set_transient("login_blocked_$ip", true, HOUR_IN_SECONDS);
        }
    }
    
    /**
     * فحص محاولات تسجيل الدخول
     */
    public function check_login_attempts($user, $username, $password) {
        $ip = $this->get_user_ip();
        
        if (get_transient("login_blocked_$ip")) {
            return new WP_Error('login_blocked', 'تم حظر عنوان IP الخاص بك مؤقتاً بسبب المحاولات المتكررة.');
        }
        
        return $user;
    }
    
    /**
     * تحسين الأداء
     */
    private function enhance_performance() {
        // ضغط الـ HTML
        if (!is_admin()) {
            ob_start(array($this, 'compress_html'));
        }
        
        // تحسين قاعدة البيانات
        add_action('wp_footer', array($this, 'optimize_database_queries'));
        
        // تأجيل تحميل JavaScript غير الأساسي
        add_filter('script_loader_tag', array($this, 'defer_non_critical_scripts'), 10, 2);
        
        // تحسين الصور
        add_filter('wp_get_attachment_image_attributes', array($this, 'add_lazy_loading'), 10, 2);
        
        // تمكين Gzip
        if (!ob_get_level()) {
            ob_start('ob_gzhandler');
        }
    }
    
    /**
     * ضغط HTML
     */
    public function compress_html($html) {
        // إزالة المسافات الزائدة والتعليقات
        $html = preg_replace('/<!--(.*)-->/Uis', '', $html);
        $html = preg_replace('/\>[^\S ]+/s', '>', $html);
        $html = preg_replace('/[^\S ]+\</s', '<', $html);
        $html = preg_replace('/(\s)+/s', '\\1', $html);
        
        return $html;
    }
    
    /**
     * تأجيل السكريبت غير الأساسية
     */
    public function defer_non_critical_scripts($tag, $handle) {
        $defer_scripts = array('muhtawaa-enhanced', 'muhtawaa-lazyload');
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * إضافة lazy loading للصور
     */
    public function add_lazy_loading($attr, $attachment) {
        if (!is_admin()) {
            $attr['loading'] = 'lazy';
        }
        
        return $attr;
    }
    
    /**
     * تحسين استعلامات قاعدة البيانات
     */
    public function optimize_database_queries() {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $queries_count = get_num_queries();
            $memory_usage = size_format(memory_get_peak_usage(true));
            
            echo "<!-- WordPress Queries: $queries_count | Memory: $memory_usage -->";
        }
    }
    
    /**
     * إعداد المخصص (Customizer)
     */
    public function customize_register($wp_customize) {
        // قسم إعدادات القالب
        $wp_customize->add_section('muhtawaa_theme_settings', array(
            'title' => __('إعدادات القالب', 'muhtawaa'),
            'priority' => 30,
        ));
        
        // الألوان الأساسية
        $wp_customize->add_setting('muhtawaa_primary_color', array(
            'default' => '#667eea',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_primary_color', array(
            'label' => __('اللون الأساسي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        $wp_customize->add_setting('muhtawaa_secondary_color', array(
            'default' => '#764ba2',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'muhtawaa_secondary_color', array(
            'label' => __('اللون الثانوي', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
        )));
        
        // إعدادات التوصيات
        $wp_customize->add_setting('muhtawaa_enable_recommendations', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_recommendations', array(
            'label' => __('تمكين التوصيات الذكية', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // إعدادات البحث المتقدم
        $wp_customize->add_setting('muhtawaa_enable_advanced_search', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control('muhtawaa_enable_advanced_search', array(
            'label' => __('تمكين البحث المتقدم', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'checkbox',
        ));
        
        // نص تذييل مخصص
        $wp_customize->add_setting('muhtawaa_footer_text', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('muhtawaa_footer_text', array(
            'label' => __('نص التذييل المخصص', 'muhtawaa'),
            'section' => 'muhtawaa_theme_settings',
            'type' => 'text',
        ));
        
        // روابط وسائل التواصل
        $social_networks = array(
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر', 
            'instagram' => 'انستغرام',
            'youtube' => 'يوتيوب',
            'linkedin' => 'لينكد إن',
            'telegram' => 'تليجرام'
        );
        
        foreach ($social_networks as $network => $label) {
            $wp_customize->add_setting("muhtawaa_social_$network", array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            
            $wp_customize->add_control("muhtawaa_social_$network", array(
                'label' => $label,
                'section' => 'muhtawaa_theme_settings',
                'type' => 'url',
            ));
        }
    }
    
    /**
     * إضافة meta tags محسنة
     */
    public function add_meta_tags() {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        echo '<meta name="theme-color" content="' . get_theme_mod('muhtawaa_primary_color', '#667eea') . '">' . "\n";
        
        if (is_singular()) {
            $description = wp_trim_words(get_the_excerpt(), 25);
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
            
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
            }
        }
    }
    
    /**
     * دوال مساعدة لإدارة إعدادات القالب
     */
    public function get_theme_setting($key, $default = '') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $value = $wpdb->get_var($wpdb->prepare(
            "SELECT setting_value FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        return $value !== null ? $value : $default;
    }
    
    public function update_theme_setting($key, $value, $type = 'string') {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        
        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $settings_table WHERE setting_key = %s",
            $key
        ));
        
        if ($existing) {
            $wpdb->update(
                $settings_table,
                array(
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'updated_at' => current_time('mysql')
                ),
                array('setting_key' => $key),
                array('%s', '%s', '%s'),
                array('%s')
            );
        } else {
            $wpdb->insert(
                $settings_table,
                array(
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => $type,
                    'created_at' => current_time('mysql')
                ),
                array('%s', '%s', '%s', '%s')
            );
        }
    }
    
    public function get_theme_settings() {
        global $wpdb;
        
        $settings_table = $wpdb->prefix . 'muhtawaa_settings';
        $results = $wpdb->get_results("SELECT setting_key, setting_value FROM $settings_table WHERE autoload = 'yes'", ARRAY_A);
        
        $settings = array();
        foreach ($results as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        
        return $settings;
    }
}

// تهيئة القالب
MuhtawaaTheme::getInstance();

// دوال مساعدة عامة
if (!function_exists('muhtawaa_get_category_icon')) {
    function muhtawaa_get_category_icon($category_name) {
        $icons = array(
            'المنزل والتنظيف' => '🏠',
            'المطبخ والطبخ' => '🍳',
            'توفير المال' => '💰',
            'السيارات' => '🚗',
            'التكنولوجيا' => '📱',
            'الطقس والمناخ' => '🌡️',
            'الصحة والجمال' => '💄',
            'الحديقة والزراعة' => '🌱',
            'الأطفال والعائلة' => '👶',
            'التعليم والدراسة' => '📚'
        );
        
        return isset($icons[$category_name]) ? $icons[$category_name] : '💡';
    }
}

if (!function_exists('muhtawaa_get_difficulty_color')) {
    function muhtawaa_get_difficulty_color($difficulty) {
        $colors = array(
            'سهل جداً' => '#4caf50',
            'سهل' => '#8bc34a',
            'متوسط' => '#ff9800',
            'صعب' => '#f44336',
            'خبير' => '#9c27b0'
        );
        
        return isset($colors[$difficulty]) ? $colors[$difficulty] : '#666';
    }
}

if (!function_exists('muhtawaa_get_social_links')) {
    function muhtawaa_get_social_links() {
        $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'telegram');
        $links = array();
        
        foreach ($social_networks as $network) {
            $url = get_theme_mod("muhtawaa_social_$network", '');
            if (!empty($url)) {
                $links[$network] = $url;
            }
        }
        
        return $links;
    }
}

if (!function_exists('muhtawaa_breadcrumbs')) {
    function muhtawaa_breadcrumbs() {
        if (is_front_page()) return;
        
        echo '<nav class="breadcrumbs" role="navigation" aria-label="مسار التنقل">';
        echo '<div class="container">';
        echo '<ol class="breadcrumb-list">';
        echo '<li><a href="' . home_url() . '">🏠 الرئيسية</a></li>';
        
        if (is_category() || is_single()) {
            if (is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                }
                echo '<li><span>' . get_the_title() . '</span></li>';
            } elseif (is_category()) {
                echo '<li><span>' . single_cat_title('', false) . '</span></li>';
            }
        } elseif (is_page()) {
            $ancestors = get_post_ancestors(get_the_ID());
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
            echo '<li><span>' . get_the_title() . '</span></li>';
        } elseif (is_search()) {
            echo '<li><span>نتائج البحث عن: "' . get_search_query() . '"</span></li>';
        } elseif (is_tag()) {
            echo '<li><span>كلمة مفتاحية: ' . single_tag_title('', false) . '</span></li>';
        } elseif (is_archive()) {
            echo '<li><span>' . get_the_archive_title() . '</span></li>';
        }
        
        echo '</ol>';
        echo '</div>';
        echo '</nav>';
    }
}

// إضافة حقول مخصصة للمقالات
add_action('add_meta_boxes', 'muhtawaa_add_solution_meta_boxes');
function muhtawaa_add_solution_meta_boxes() {
    add_meta_box(
        'solution_details',
        __('تفاصيل الحل المحسنة', 'muhtawaa'),
        'muhtawaa_solution_details_callback',
        'post',
        'normal',
        'high'
    );
    
    add_meta_box(
        'solution_seo',
        __('تحسين محركات البحث', 'muhtawaa'),
        'muhtawaa_solution_seo_callback',
        'post',
        'side',
        'default'
    );
}

function muhtawaa_solution_details_callback($post) {
    wp_nonce_field('muhtawaa_save_solution_details', 'solution_details_nonce');
    
    $difficulty = get_post_meta($post->ID, '_solution_difficulty', true);
    $time_needed = get_post_meta($post->ID, '_solution_time', true);
    $materials = get_post_meta($post->ID, '_solution_materials', true);
    $cost = get_post_meta($post->ID, '_solution_cost', true);
    $tools = get_post_meta($post->ID, '_solution_tools', true);
    $safety_notes = get_post_meta($post->ID, '_solution_safety', true);
    $season = get_post_meta($post->ID, '_solution_season', true);
    $target_audience = get_post_meta($post->ID, '_solution_audience', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="solution_difficulty">مستوى الصعوبة</label></th>
            <td>
                <select name="solution_difficulty" id="solution_difficulty" style="width: 200px;">
                    <option value="">اختر المستوى</option>
                    <option value="سهل جداً" <?php selected($difficulty, 'سهل جداً'); ?>>سهل جداً ⭐</option>
                    <option value="سهل" <?php selected($difficulty, 'سهل'); ?>>سهل ⭐⭐</option>
                    <option value="متوسط" <?php selected($difficulty, 'متوسط'); ?>>متوسط ⭐⭐⭐</option>
                    <option value="صعب" <?php selected($difficulty, 'صعب'); ?>>صعب ⭐⭐⭐⭐</option>
                    <option value="خبير" <?php selected($difficulty, 'خبير'); ?>>خبير ⭐⭐⭐⭐⭐</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_time">الوقت المطلوب</label></th>
            <td><input type="text" name="solution_time" id="solution_time" value="<?php echo esc_attr($time_needed); ?>" placeholder="مثال: 5 دقائق، ساعة واحدة" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_cost">التكلفة التقريبية</label></th>
            <td><input type="text" name="solution_cost" id="solution_cost" value="<?php echo esc_attr($cost); ?>" placeholder="مثال: مجاني، 10 ريال، أقل من 50 ريال" style="width: 300px;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_season">الموسم المناسب</label></th>
            <td>
                <select name="solution_season" id="solution_season" style="width: 200px;">
                    <option value="">طوال السنة</option>
                    <option value="الصيف" <?php selected($season, 'الصيف'); ?>>الصيف ☀️</option>
                    <option value="الشتاء" <?php selected($season, 'الشتاء'); ?>>الشتاء ❄️</option>
                    <option value="الربيع" <?php selected($season, 'الربيع'); ?>>الربيع 🌸</option>
                    <option value="الخريف" <?php selected($season, 'الخريف'); ?>>الخريف 🍂</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_audience">الفئة المستهدفة</label></th>
            <td>
                <select name="solution_audience" id="solution_audience" style="width: 200px;">
                    <option value="">الجميع</option>
                    <option value="المبتدئين" <?php selected($target_audience, 'المبتدئين'); ?>>المبتدئين</option>
                    <option value="الأمهات" <?php selected($target_audience, 'الأمهات'); ?>>الأمهات</option>
                    <option value="الآباء" <?php selected($target_audience, 'الآباء'); ?>>الآباء</option>
                    <option value="الطلاب" <?php selected($target_audience, 'الطلاب'); ?>>الطلاب</option>
                    <option value="كبار السن" <?php selected($target_audience, 'كبار السن'); ?>>كبار السن</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_materials">المواد المطلوبة</label></th>
            <td>
                <textarea name="solution_materials" id="solution_materials" rows="4" cols="60" placeholder="اذكر المواد المطلوبة، كل مادة في سطر جديد"><?php echo esc_textarea($materials); ?></textarea>
                <p class="description">مثال: ملح، خل أبيض، ليمونة، قطعة قماش</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_tools">الأدوات المطلوبة</label></th>
            <td>
                <textarea name="solution_tools" id="solution_tools" rows="3" cols="60" placeholder="اذكر الأدوات المطلوبة، كل أداة في سطر جديد"><?php echo esc_textarea($tools); ?></textarea>
                <p class="description">مثال: مكنسة كهربائية، مفك براغي، وعاء خلط</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="solution_safety">ملاحظات السلامة</label></th>
            <td>
                <textarea name="solution_safety" id="solution_safety" rows="3" cols="60" placeholder="ملاحظات مهمة للسلامة (اختياري)"><?php echo esc_textarea($safety_notes); ?></textarea>
                <p class="description">مثال: استخدم القفازات، تأكد من إغلاق الكهرباء، احذر من الأسطح الساخنة</p>
            </td>
        </tr>
    </table>
    
    <style>
    .form-table th {
        width: 150px;
        vertical-align: top;
        padding-top: 10px;
    }
    
    .form-table td {
        padding: 8px 10px;
    }
    
    .form-table input[type="text"],
    .form-table select,
    .form-table textarea {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px;
    }
    
    .form-table textarea {
        font-family: inherit;
    }
    
    .form-table .description {
        font-style: italic;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_solution_seo_callback($post) {
    $focus_keyword = get_post_meta($post->ID, '_focus_keyword', true);
    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    $social_title = get_post_meta($post->ID, '_social_title', true);
    $social_description = get_post_meta($post->ID, '_social_description', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row"><label for="focus_keyword">الكلمة المفتاحية الرئيسية</label></th>
            <td><input type="text" name="focus_keyword" id="focus_keyword" value="<?php echo esc_attr($focus_keyword); ?>" style="width: 100%;" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="meta_description">وصف meta</label></th>
            <td>
                <textarea name="meta_description" id="meta_description" rows="3" style="width: 100%;" maxlength="160" placeholder="وصف مختصر للمقال (160 حرف كحد أقصى)"><?php echo esc_textarea($meta_description); ?></textarea>
                <p class="description"><span id="meta-count">0</span>/160 حرف</p>
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_title">عنوان وسائل التواصل</label></th>
            <td><input type="text" name="social_title" id="social_title" value="<?php echo esc_attr($social_title); ?>" style="width: 100%;" placeholder="عنوان مخصص للمشاركة على وسائل التواصل" /></td>
        </tr>
        
        <tr>
            <th scope="row"><label for="social_description">وصف وسائل التواصل</label></th>
            <td>
                <textarea name="social_description" id="social_description" rows="3" style="width: 100%;" placeholder="وصف مخصص للمشاركة على وسائل التواصل"><?php echo esc_textarea($social_description); ?></textarea>
            </td>
        </tr>
    </table>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const metaDescription = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        
        function updateMetaCount() {
            const count = metaDescription.value.length;
            metaCount.textContent = count;
            metaCount.style.color = count > 160 ? 'red' : (count > 140 ? 'orange' : 'green');
        }
        
        metaDescription.addEventListener('input', updateMetaCount);
        updateMetaCount(); // تحديث أولي
    });
    </script>
    <?php
}

// حفظ البيانات المخصصة المحسنة
add_action('save_post', 'muhtawaa_save_solution_details');
function muhtawaa_save_solution_details($post_id) {
    if (!isset($_POST['solution_details_nonce']) || !wp_verify_nonce($_POST['solution_details_nonce'], 'muhtawaa_save_solution_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'solution_difficulty', 'solution_time', 'solution_cost',
        'solution_materials', 'solution_tools', 'solution_safety',
        'solution_season', 'solution_audience',
        'focus_keyword', 'meta_description', 'social_title', 'social_description'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            
            if (in_array($field, array('solution_materials', 'solution_tools', 'solution_safety', 'meta_description', 'social_description'))) {
                $value = sanitize_textarea_field($value);
            } else {
                $value = sanitize_text_field($value);
            }
            
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
    
    // تحديث تاريخ آخر تعديل للحل
    update_post_meta($post_id, '_solution_last_updated', current_time('mysql'));
}

// نظام الاستيراد والتصدير
class MuhtawaaImportExport {
    
    public static function export_solutions($format = 'json') {
        if (!current_user_can('manage_options')) {
            wp_die('غير مصرح');
        }
        
        $solutions = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ));
        
        $export_data = array();
        
        foreach ($solutions as $solution) {
            $meta_data = get_post_meta($solution->ID);
            $categories = wp_get_post_categories($solution->ID, array('fields' => 'names'));
            $tags = wp_get_post_tags($solution->ID, array('fields' => 'names'));
            
            $export_data[] = array(
                'title' => $solution->post_title,
                'content' => $solution->post_content,
                'excerpt' => $solution->post_excerpt,
                'date' => $solution->post_date,
                'categories' => $categories,
                'tags' => $tags,
                'meta' => array(
                    'difficulty' => $meta_data['_solution_difficulty'][0] ?? '',
                    'time' => $meta_data['_solution_time'][0] ?? '',
                    'cost' => $meta_data['_solution_cost'][0] ?? '',
                    'materials' => $meta_data['_solution_materials'][0] ?? '',
                    'tools' => $meta_data['_solution_tools'][0] ?? '',
                    'safety' => $meta_data['_solution_safety'][0] ?? '',
                    'season' => $meta_data['_solution_season'][0] ?? '',
                    'audience' => $meta_data['_solution_audience'][0] ?? '',
                )
            );
        }
        
        if ($format === 'json') {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.json"');
            echo json_encode($export_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } elseif ($format === 'csv') {
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename="muhtawaa-solutions-' . date('Y-m-d') . '.csv"');
            
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM
            
            // Headers
            fputcsv($output, array('العنوان', 'المحتوى', 'الملخص', 'التاريخ', 'الفئات', 'الكلمات المفتاحية', 'الصعوبة', 'الوقت', 'التكلفة'));
            
            foreach ($export_data as $row) {
                fputcsv($output, array(
                    $row['title'],
                    strip_tags($row['content']),
                    $row['excerpt'],
                    $row['date'],
                    implode(', ', $row['categories']),
                    implode(', ', $row['tags']),
                    $row['meta']['difficulty'],
                    $row['meta']['time'],
                    $row['meta']['cost']
                ));
            }
            
            fclose($output);
        }
        
        exit;
    }
    
    public static function import_solutions($file_path) {
        if (!current_user_can('manage_options')) {
            return new WP_Error('permission_denied', 'غير مصرح');
        }
        
        if (!file_exists($file_path)) {
            return new WP_Error('file_not_found', 'الملف غير موجود');
        }
        
        $file_content = file_get_contents($file_path);
        $data = json_decode($file_content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('invalid_json', 'ملف JSON غير صحيح');
        }
        
        $imported_count = 0;
        $errors = array();
        
        foreach ($data as $solution_data) {
            $post_data = array(
                'post_title' => sanitize_text_field($solution_data['title']),
                'post_content' => wp_kses_post($solution_data['content']),
                'post_excerpt' => sanitize_textarea_field($solution_data['excerpt']),
                'post_status' => 'draft', // استيراد كمسودة للمراجعة
                'post_type' => 'post'
            );
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                $errors[] = 'فشل في استيراد: ' . $solution_data['title'];
                continue;
            }
            
            // إضافة الفئات
            if (!empty($solution_data['categories'])) {
                wp_set_post_categories($post_id, $solution_data['categories']);
            }
            
            // إضافة الكلمات المفتاحية
            if (!empty($solution_data['tags'])) {
                wp_set_post_tags($post_id, implode(', ', $solution_data['tags']));
            }
            
            // إضافة البيانات المخصصة
            if (!empty($solution_data['meta'])) {
                foreach ($solution_data['meta'] as $key => $value) {
                    update_post_meta($post_id, '_solution_' . $key, sanitize_text_field($value));
                }
            }
            
            $imported_count++;
        }
        
        return array(
            'imported' => $imported_count,
            'errors' => $errors
        );
    }
}

// إضافة صفحة إدارة في لوحة التحكم
add_action('admin_menu', 'muhtawaa_admin_menu');
function muhtawaa_admin_menu() {
    add_menu_page(
        __('إدارة محتوى', 'muhtawaa'),
        __('محتوى', 'muhtawaa'),
        'manage_options',
        'muhtawaa-admin',
        'muhtawaa_admin_page',
        'dashicons-lightbulb',
        30
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('إعدادات القالب', 'muhtawaa'),
        __('الإعدادات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-settings',
        'muhtawaa_settings_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الإحصائيات', 'muhtawaa'),
        __('الإحصائيات', 'muhtawaa'),
        'manage_options',
        'muhtawaa-stats',
        'muhtawaa_stats_page'
    );
    
    add_submenu_page(
        'muhtawaa-admin',
        __('الاستيراد والتصدير', 'muhtawaa'),
        __('استيراد/تصدير', 'muhtawaa'),
        'manage_options',
        'muhtawaa-import-export',
        'muhtawaa_import_export_page'
    );
}

function muhtawaa_admin_page() {
    ?>
    <div class="wrap">
        <h1>لوحة تحكم قالب محتوى</h1>
        
        <div class="muhtawaa-dashboard">
            <div class="dashboard-widgets">
                <?php muhtawaa_dashboard_stats_widget(); ?>
                <?php muhtawaa_dashboard_recent_activity(); ?>
                <?php muhtawaa_dashboard_quick_actions(); ?>
            </div>
        </div>
    </div>
    
    <style>
    .muhtawaa-dashboard {
        margin-top: 20px;
    }
    
    .dashboard-widgets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .dashboard-widget {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .dashboard-widget h3 {
        margin-top: 0;
        color: #667eea;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 15px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }
    
    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #667eea;
        display: block;
    }
    
    .stat-label {
        font-size: 0.9em;
        color: #666;
        margin-top: 5px;
    }
    </style>
    <?php
}

function muhtawaa_dashboard_stats_widget() {
    global $wpdb;
    
    $stats = array(
        'total_posts' => wp_count_posts()->publish,
        'total_subscribers' => $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'"),
        'searches_today' => $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE DATE(created_at) = %s",
            date('Y-m-d')
        )),
        'total_views' => $wpdb->get_var("SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM {$wpdb->postmeta} WHERE meta_key = '_total_views'")
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>📊 الإحصائيات العامة</h3>
        <div class="stat-grid">
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_posts']); ?></span>
                <span class="stat-label">حل منشور</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_subscribers']); ?></span>
                <span class="stat-label">مشترك</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['searches_today']); ?></span>
                <span class="stat-label">بحث اليوم</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($stats['total_views'] ?: 0); ?></span>
                <span class="stat-label">إجمالي المشاهدات</span>
            </div>
        </div>
    </div>
    <?php
}

function muhtawaa_dashboard_recent_activity() {
    global $wpdb;
    
    $recent_searches = $wpdb->get_results(
        "SELECT search_term, COUNT(*) as count 
         FROM {$wpdb->prefix}muhtawaa_searches 
         WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
         GROUP BY search_term 
         ORDER BY count DESC 
         LIMIT 5"
    );
    ?>
    
    <div class="dashboard-widget">
        <h3>🔍 أشهر البحثات هذا الأسبوع</h3>
        <?php if (!empty($recent_searches)): ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($recent_searches as $search): ?>
                    <li style="display: flex; justify-content: space-between; padding: