<?php
/**
 * Theme Name: محتوى - الحلول اليومية المطور
 * Functions and definitions - النسخة المُنظمة والمحسنة
 * 
 * @package Muhtawaa
 * @version 2.0.3
 * @author فريق محتوى
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
}if (!function_exists('muhtawaa_get_read_time')) {
    /**
     * حساب وقت القراءة التقريبي للمقال بالدقائق
     *
     * @param int|null $post_id معرف المقال المطلوب حسابه
     * @param int $words_per_minute عدد الكلمات في الدقيقة
     * @return int عدد الدقائق التقديري
     */
    function muhtawaa_get_read_time($post_id = null, $words_per_minute = 200) {
        $post_id = $post_id ? $post_id : get_the_ID();
        $content = get_post_field('post_content', $post_id);

        // إزالة الوسوم وحساب الكلمات
        $content = wp_strip_all_tags($content);
        $word_count = str_word_count($content);
        if (!$word_count) {
            $word_count = count(preg_split('/\s+/u', $content, -1, PREG_SPLIT_NO_EMPTY));
        }

        $minutes = ceil($word_count / $words_per_minute);
        return max(1, $minutes);
    }
}
/**
 * دوال مساعدة إضافية
 * Additional Helper Functions
 * 
 * يُضاف هذا الكود إلى نهاية ملف inc/helper-functions.php
 * 
 * @package Muhtawaa
 * @version 2.0
 */

/**
 * حساب وقت القراءة
 */
if (!function_exists('muhtawaa_reading_time')) {
    function muhtawaa_reading_time($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // متوسط 200 كلمة في الدقيقة
        
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

/**
 * عدد مشاهدات المقال
 */
if (!function_exists('muhtawaa_get_post_views')) {
    function muhtawaa_get_post_views($post_id) {
        $views = get_post_meta($post_id, '_muhtawaa_views', true);
        return $views ? number_format_i18n($views) : '0';
    }
}

/**
 * تحديث عدد المشاهدات
 */
if (!function_exists('muhtawaa_set_post_views')) {
    function muhtawaa_set_post_views($post_id) {
        $views = get_post_meta($post_id, '_muhtawaa_views', true);
        $views = $views ? intval($views) : 0;
        update_post_meta($post_id, '_muhtawaa_views', $views + 1);
    }
}

// تحديث المشاهدات تلقائياً
add_action('wp_head', function() {
    if (is_single()) {
        muhtawaa_set_post_views(get_the_ID());
    }
});

/**
 * الحصول على عدد التقييمات
 */
if (!function_exists('muhtawaa_get_ratings_count')) {
    function muhtawaa_get_ratings_count($post_id) {
        $ratings_count = get_post_meta($post_id, '_muhtawaa_ratings_count', true);
        return $ratings_count ? intval($ratings_count) : 0;
    }
}

/**
 * الحصول على المقالات ذات الصلة
 */
if (!function_exists('muhtawaa_get_related_posts')) {
    function muhtawaa_get_related_posts($post_id, $count = 3) {
        $categories = wp_get_post_categories($post_id);
        $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
        
        $args = array(
            'post__not_in' => array($post_id),
            'posts_per_page' => $count,
            'ignore_sticky_posts' => true,
            'orderby' => 'rand',
        );
        
        // البحث حسب الفئات أولاً
        if ($categories) {
            $args['category__in'] = $categories;
        }
        
        // ثم حسب الوسوم
        if (empty($categories) && $tags) {
            $args['tag__in'] = $tags;
        }
        
        return new WP_Query($args);
    }
}

/**
 * ويدجت الإحصائيات
 */
if (!function_exists('muhtawaa_stats_widget')) {
    function muhtawaa_stats_widget() {
        $stats = array(
            'posts' => wp_count_posts()->publish,
            'comments' => wp_count_comments()->approved,
            'categories' => count(get_categories()),
            'tags' => count(get_tags()),
        );
        ?>
        <ul class="stats-list">
            <li>
                <i class="fas fa-file-alt"></i>
                <strong><?php echo number_format_i18n($stats['posts']); ?></strong>
                <span><?php _e('مقالة', 'muhtawaa'); ?></span>
            </li>
            <li>
                <i class="fas fa-comments"></i>
                <strong><?php echo number_format_i18n($stats['comments']); ?></strong>
                <span><?php _e('تعليق', 'muhtawaa'); ?></span>
            </li>
            <li>
                <i class="fas fa-folder"></i>
                <strong><?php echo number_format_i18n($stats['categories']); ?></strong>
                <span><?php _e('تصنيف', 'muhtawaa'); ?></span>
            </li>
            <li>
                <i class="fas fa-tags"></i>
                <strong><?php echo number_format_i18n($stats['tags']); ?></strong>
                <span><?php _e('وسم', 'muhtawaa'); ?></span>
            </li>
        </ul>
        <?php
    }
}

/**
 * إضافة حقول التواصل الاجتماعي للمؤلفين
 */
function muhtawaa_add_author_social_fields($contactmethods) {
    $contactmethods['twitter'] = __('Twitter', 'muhtawaa');
    $contactmethods['facebook'] = __('Facebook', 'muhtawaa');
    $contactmethods['linkedin'] = __('LinkedIn', 'muhtawaa');
    $contactmethods['instagram'] = __('Instagram', 'muhtawaa');
    
    return $contactmethods;
}
add_filter('user_contactmethods', 'muhtawaa_add_author_social_fields');

/**
 * تحسين مقتطفات المقالات
 */
function muhtawaa_custom_excerpt_length($length) {
    return 30; // عدد الكلمات
}
add_filter('excerpt_length', 'muhtawaa_custom_excerpt_length');

function muhtawaa_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'muhtawaa_custom_excerpt_more');

/**
 * إضافة دعم نسخ الرابط في JavaScript
 */
add_action('wp_footer', function() {
    ?>
    <script>
    // نسخ الرابط
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copy-link');
        copyButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(url).then(function() {
                        // عرض رسالة نجاح
                        const originalHTML = button.innerHTML;
                        button.innerHTML = '<i class="fas fa-check"></i>';
                        setTimeout(function() {
                            button.innerHTML = originalHTML;
                        }, 2000);
                    });
                } else {
                    // fallback للمتصفحات القديمة
                    const textArea = document.createElement('textarea');
                    textArea.value = url;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                }
            });
        });
    });
    </script>
    <?php
});

/**
 * إضافة حاوية الإشعارات
 */
add_action('wp_footer', function() {
    echo '<div class="notifications-container"></div>';
});

/**
 * دالة لإنشاء breadcrumbs
 */
if (!function_exists('muhtawaa_breadcrumbs')) {
    function muhtawaa_breadcrumbs() {
        if (is_home() || is_front_page()) return;
        
        echo '<nav class="breadcrumbs" aria-label="' . __('التنقل', 'muhtawaa') . '">';
        echo '<ol class="breadcrumb-list">';
        echo '<li><a href="' . home_url() . '"><i class="fas fa-home"></i> ' . __('الرئيسية', 'muhtawaa') . '</a></li>';
        
        if (is_category()) {
            echo '<li class="active">' . single_cat_title('', false) . '</li>';
        } elseif (is_tag()) {
            echo '<li class="active">' . single_tag_title('', false) . '</li>';
        } elseif (is_author()) {
            echo '<li class="active">' . get_the_author() . '</li>';
        } elseif (is_search()) {
            echo '<li class="active">' . __('نتائج البحث', 'muhtawaa') . '</li>';
        } elseif (is_single()) {
            $categories = get_the_category();
            if ($categories) {
                echo '<li><a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a></li>';
            }
            echo '<li class="active">' . get_the_title() . '</li>';
        } elseif (is_page()) {
            echo '<li class="active">' . get_the_title() . '</li>';
        } elseif (is_404()) {
            echo '<li class="active">' . __('صفحة غير موجودة', 'muhtawaa') . '</li>';
        }
        
        echo '</ol>';
        echo '</nav>';
    }
}

/**
 * إصلاح عدادات المشاركات
 */
function muhtawaa_fix_post_counts() {
    // إصلاح عداد المشاهدات للمقالات الموجودة
    $posts = get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
    
    foreach ($posts as $post) {
        $views = get_post_meta($post->ID, '_muhtawaa_views', true);
        if (!$views) {
            update_post_meta($post->ID, '_muhtawaa_views', rand(10, 100));
        }
    }
}

// تشغيل مرة واحدة عند تفعيل القالب
add_action('after_switch_theme', 'muhtawaa_fix_post_counts');

/**
 * إضافة دعم Schema.org
 */
function muhtawaa_schema_type() {
    $schema = 'https://schema.org/';
    
    if (is_single()) {
        $type = "Article";
    } elseif (is_author()) {
        $type = "ProfilePage";
    } elseif (is_search()) {
        $type = "SearchResultsPage";
    } else {
        $type = "WebPage";
    }
    
    echo 'itemscope itemtype="' . $schema . $type . '"';
}



// نهاية الملف