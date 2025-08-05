<?php
/**
 * لوحة الإدارة المخصصة لقالب محتوى
 * Custom Admin Dashboard for Muhtawaa Theme
 * 
 * @package Muhtawaa
 * @version 2.0.3
 * @author فريق محتوى
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

/**
 * فئة لوحة الإدارة المخصصة
 */
class MuhtawaaAdminDashboard {
    
    /**
     * التهيئة
     */
    public static function init() {
        // إضافة صفحة لوحة التحكم
        add_action('admin_menu', array(__CLASS__, 'add_admin_menu'));
        
        // إضافة الويدجت للوحة التحكم الرئيسية
        add_action('wp_dashboard_setup', array(__CLASS__, 'add_dashboard_widgets'));
        
        // إضافة الأنماط والسكريبتات
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_admin_assets'));
        
        // معالجات AJAX
        add_action('wp_ajax_muhtawaa_get_dashboard_stats', array(__CLASS__, 'ajax_get_dashboard_stats'));
        add_action('wp_ajax_muhtawaa_clear_cache', array(__CLASS__, 'ajax_clear_cache'));
        add_action('wp_ajax_muhtawaa_optimize_database', array(__CLASS__, 'ajax_optimize_database'));
        
        // تخصيص شريط الإدارة
        add_action('admin_bar_menu', array(__CLASS__, 'customize_admin_bar'), 999);
        
        // رسائل الترحيب
        add_action('admin_notices', array(__CLASS__, 'welcome_notice'));
    }
    
    /**
     * إضافة قائمة الإدارة
     */
    public static function add_admin_menu() {
        // القائمة الرئيسية
        add_menu_page(
            __('لوحة تحكم محتوى', 'muhtawaa'),
            __('قالب محتوى', 'muhtawaa'),
            'manage_options',
            'muhtawaa-dashboard',
            array(__CLASS__, 'render_dashboard_page'),
            'dashicons-layout',
            3
        );
        
        // الصفحات الفرعية
        add_submenu_page(
            'muhtawaa-dashboard',
            __('الإحصائيات', 'muhtawaa'),
            __('الإحصائيات', 'muhtawaa'),
            'manage_options',
            'muhtawaa-stats',
            array(__CLASS__, 'render_stats_page')
        );
        
        add_submenu_page(
            'muhtawaa-dashboard',
            __('إعدادات القالب', 'muhtawaa'),
            __('الإعدادات', 'muhtawaa'),
            'manage_options',
            'muhtawaa-settings',
            array(__CLASS__, 'render_settings_page')
        );
        
        add_submenu_page(
            'muhtawaa-dashboard',
            __('الأدوات', 'muhtawaa'),
            __('الأدوات', 'muhtawaa'),
            'manage_options',
            'muhtawaa-tools',
            array(__CLASS__, 'render_tools_page')
        );
        
        add_submenu_page(
            'muhtawaa-dashboard',
            __('المساعدة', 'muhtawaa'),
            __('المساعدة', 'muhtawaa'),
            'manage_options',
            'muhtawaa-help',
            array(__CLASS__, 'render_help_page')
        );
    }
    
    /**
     * إضافة ويدجت للوحة التحكم
     */
    public static function add_dashboard_widgets() {
        // ويدجت الإحصائيات السريعة
        wp_add_dashboard_widget(
            'muhtawaa_quick_stats',
            __('إحصائيات محتوى السريعة', 'muhtawaa'),
            array(__CLASS__, 'render_quick_stats_widget')
        );
        
        // ويدجت النصائح اليومية
        wp_add_dashboard_widget(
            'muhtawaa_daily_tip',
            __('نصيحة اليوم', 'muhtawaa'),
            array(__CLASS__, 'render_daily_tip_widget')
        );
        
        // ويدجت النشاط الأخير
        wp_add_dashboard_widget(
            'muhtawaa_recent_activity',
            __('النشاط الأخير', 'muhtawaa'),
            array(__CLASS__, 'render_recent_activity_widget')
        );
    }
    
    /**
     * تحميل ملفات CSS و JS للإدارة
     */
    public static function enqueue_admin_assets($hook) {
        // تحميل على صفحات القالب فقط
        if (strpos($hook, 'muhtawaa') === false && $hook !== 'index.php') {
            return;
        }
        
        // CSS
        wp_enqueue_style(
            'muhtawaa-admin',
            THEME_ASSETS_URL . '/css/admin.css',
            array(),
            THEME_VERSION
        );
        
        // JavaScript
        wp_enqueue_script(
            'muhtawaa-admin',
            THEME_ASSETS_URL . '/js/admin.js',
            array('jquery', 'wp-util'),
            THEME_VERSION,
            true
        );
        
        // Chart.js للإحصائيات
        wp_enqueue_script(
            'chart-js',
            'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js',
            array(),
            '3.9.1'
        );
        
        // بيانات للـ JavaScript
        wp_localize_script('muhtawaa-admin', 'muhtawaa_admin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_admin_nonce'),
            'strings' => array(
                'loading' => __('جاري التحميل...', 'muhtawaa'),
                'success' => __('تمت العملية بنجاح!', 'muhtawaa'),
                'error' => __('حدث خطأ ما!', 'muhtawaa'),
                'confirm' => __('هل أنت متأكد؟', 'muhtawaa')
            )
        ));
    }
    
    /**
     * عرض صفحة لوحة التحكم الرئيسية
     */
    public static function render_dashboard_page() {
        ?>
        <div class="wrap muhtawaa-dashboard">
            <h1 class="wp-heading-inline">
                <span class="dashicons dashicons-layout"></span>
                <?php _e('لوحة تحكم قالب محتوى', 'muhtawaa'); ?>
            </h1>
            
            <div class="muhtawaa-welcome-panel">
                <div class="welcome-panel-content">
                    <h2><?php _e('مرحباً بك في قالب محتوى!', 'muhtawaa'); ?></h2>
                    <p class="about-description">
                        <?php _e('قالب متطور للمواقع العربية مع ميزات متقدمة وأداء محسّن', 'muhtawaa'); ?>
                    </p>
                    
                    <div class="welcome-panel-column-container">
                        <div class="welcome-panel-column">
                            <h3><?php _e('البداية السريعة', 'muhtawaa'); ?></h3>
                            <ul>
                                <li>
                                    <a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary">
                                        <?php _e('تخصيص القالب', 'muhtawaa'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_url('widgets.php'); ?>">
                                        <?php _e('إدارة الويدجت', 'muhtawaa'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_url('nav-menus.php'); ?>">
                                        <?php _e('إنشاء القوائم', 'muhtawaa'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="welcome-panel-column">
                            <h3><?php _e('الميزات المتقدمة', 'muhtawaa'); ?></h3>
                            <ul>
                                <li>
                                    <span class="dashicons dashicons-yes"></span>
                                    <?php _e('نظام أمان متطور', 'muhtawaa'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span>
                                    <?php _e('تحسين سرعة الأداء', 'muhtawaa'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span>
                                    <?php _e('SEO محسّن', 'muhtawaa'); ?>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="welcome-panel-column welcome-panel-last">
                            <h3><?php _e('تحتاج مساعدة؟', 'muhtawaa'); ?></h3>
                            <ul>
                                <li>
                                    <a href="<?php echo admin_url('admin.php?page=muhtawaa-help'); ?>">
                                        <span class="dashicons dashicons-editor-help"></span>
                                        <?php _e('مركز المساعدة', 'muhtawaa'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://muhtawaa.com/docs" target="_blank">
                                        <span class="dashicons dashicons-text-page"></span>
                                        <?php _e('التوثيق الكامل', 'muhtawaa'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://muhtawaa.com/support" target="_blank">
                                        <span class="dashicons dashicons-sos"></span>
                                        <?php _e('الدعم الفني', 'muhtawaa'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- إحصائيات سريعة -->
            <div class="muhtawaa-stats-boxes">
                <div class="stats-box">
                    <div class="stats-icon">
                        <span class="dashicons dashicons-admin-post"></span>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo wp_count_posts()->publish; ?></h3>
                        <p><?php _e('مقالة منشورة', 'muhtawaa'); ?></p>
                    </div>
                </div>
                
                <div class="stats-box">
                    <div class="stats-icon">
                        <span class="dashicons dashicons-admin-comments"></span>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo wp_count_comments()->approved; ?></h3>
                        <p><?php _e('تعليق معتمد', 'muhtawaa'); ?></p>
                    </div>
                </div>
                
                <div class="stats-box">
                    <div class="stats-icon">
                        <span class="dashicons dashicons-admin-users"></span>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo count_users()['total_users']; ?></h3>
                        <p><?php _e('مستخدم مسجل', 'muhtawaa'); ?></p>
                    </div>
                </div>
                
                <div class="stats-box">
                    <div class="stats-icon">
                        <span class="dashicons dashicons-visibility"></span>
                    </div>
                    <div class="stats-content">
                        <h3 id="total-views"><?php echo number_format(get_option('muhtawaa_total_views', 0)); ?></h3>
                        <p><?php _e('مشاهدة كلية', 'muhtawaa'); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- الأدوات السريعة -->
            <div class="muhtawaa-quick-tools">
                <h2><?php _e('الأدوات السريعة', 'muhtawaa'); ?></h2>
                
                <div class="tools-grid">
                    <div class="tool-card">
                        <h3><?php _e('مسح الذاكرة المؤقتة', 'muhtawaa'); ?></h3>
                        <p><?php _e('مسح جميع ملفات التخزين المؤقت لتحسين الأداء', 'muhtawaa'); ?></p>
                        <button class="button button-primary" id="clear-cache-btn">
                            <span class="dashicons dashicons-trash"></span>
                            <?php _e('مسح الآن', 'muhtawaa'); ?>
                        </button>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('تحسين قاعدة البيانات', 'muhtawaa'); ?></h3>
                        <p><?php _e('تنظيف وتحسين جداول قاعدة البيانات', 'muhtawaa'); ?></p>
                        <button class="button button-primary" id="optimize-db-btn">
                            <span class="dashicons dashicons-dashboard"></span>
                            <?php _e('تحسين الآن', 'muhtawaa'); ?>
                        </button>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('النسخ الاحتياطي', 'muhtawaa'); ?></h3>
                        <p><?php _e('إنشاء نسخة احتياطية من الإعدادات', 'muhtawaa'); ?></p>
                        <a href="<?php echo admin_url('admin.php?page=muhtawaa-tools&tab=backup'); ?>" class="button button-primary">
                            <span class="dashicons dashicons-backup"></span>
                            <?php _e('إدارة النسخ', 'muhtawaa'); ?>
                        </a>
                    </div>
                    
                    <div class="tool-card">
                        <h3><?php _e('فحص الأمان', 'muhtawaa'); ?></h3>
                        <p><?php _e('فحص سريع لحالة الأمان في الموقع', 'muhtawaa'); ?></p>
                        <a href="<?php echo admin_url('admin.php?page=muhtawaa-tools&tab=security'); ?>" class="button button-primary">
                            <span class="dashicons dashicons-shield"></span>
                            <?php _e('فحص الأمان', 'muhtawaa'); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- معلومات النظام -->
            <div class="muhtawaa-system-info">
                <h2><?php _e('معلومات النظام', 'muhtawaa'); ?></h2>
                
                <table class="widefat">
                    <tbody>
                        <tr>
                            <td><?php _e('إصدار القالب', 'muhtawaa'); ?></td>
                            <td><strong><?php echo THEME_VERSION; ?></strong></td>
                        </tr>
                        <tr>
                            <td><?php _e('إصدار ووردبريس', 'muhtawaa'); ?></td>
                            <td><strong><?php echo get_bloginfo('version'); ?></strong></td>
                        </tr>
                        <tr>
                            <td><?php _e('إصدار PHP', 'muhtawaa'); ?></td>
                            <td><strong><?php echo PHP_VERSION; ?></strong></td>
                        </tr>
                        <tr>
                            <td><?php _e('حد الذاكرة', 'muhtawaa'); ?></td>
                            <td><strong><?php echo WP_MEMORY_LIMIT; ?></strong></td>
                        </tr>
                        <tr>
                            <td><?php _e('الإضافات النشطة', 'muhtawaa'); ?></td>
                            <td><strong><?php echo count(get_option('active_plugins')); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض صفحة الإحصائيات
     */
    public static function render_stats_page() {
        ?>
        <div class="wrap muhtawaa-stats-page">
            <h1><?php _e('إحصائيات القالب', 'muhtawaa'); ?></h1>
            
            <!-- فترة الإحصائيات -->
            <div class="stats-period-selector">
                <button class="button" data-period="7"><?php _e('7 أيام', 'muhtawaa'); ?></button>
                <button class="button button-primary" data-period="30"><?php _e('30 يوم', 'muhtawaa'); ?></button>
                <button class="button" data-period="90"><?php _e('90 يوم', 'muhtawaa'); ?></button>
                <button class="button" data-period="365"><?php _e('سنة', 'muhtawaa'); ?></button>
            </div>
            
            <!-- الرسوم البيانية -->
            <div class="stats-charts">
                <div class="chart-container">
                    <h3><?php _e('المشاهدات اليومية', 'muhtawaa'); ?></h3>
                    <canvas id="views-chart"></canvas>
                </div>
                
                <div class="chart-container">
                    <h3><?php _e('المقالات والتعليقات', 'muhtawaa'); ?></h3>
                    <canvas id="posts-comments-chart"></canvas>
                </div>
            </div>
            
            <!-- جدول أكثر المقالات مشاهدة -->
            <div class="popular-posts-table">
                <h3><?php _e('المقالات الأكثر مشاهدة', 'muhtawaa'); ?></h3>
                
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th><?php _e('المقال', 'muhtawaa'); ?></th>
                            <th><?php _e('المشاهدات', 'muhtawaa'); ?></th>
                            <th><?php _e('التعليقات', 'muhtawaa'); ?></th>
                            <th><?php _e('التقييم', 'muhtawaa'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $popular_posts = new WP_Query(array(
                            'posts_per_page' => 10,
                            'meta_key' => 'muhtawaa_post_views',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC'
                        ));
                        
                        if ($popular_posts->have_posts()) :
                            while ($popular_posts->have_posts()) : $popular_posts->the_post();
                                $views = get_post_meta(get_the_ID(), 'muhtawaa_post_views', true) ?: 0;
                                $rating = get_post_meta(get_the_ID(), 'muhtawaa_average_rating', true) ?: 0;
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo get_edit_post_link(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </td>
                                    <td><?php echo number_format($views); ?></td>
                                    <td><?php echo get_comments_number(); ?></td>
                                    <td>
                                        <?php if ($rating > 0) : ?>
                                            <span class="star-rating">
                                                <?php echo str_repeat('★', round($rating)); ?>
                                                <?php echo str_repeat('☆', 5 - round($rating)); ?>
                                            </span>
                                            (<?php echo number_format($rating, 1); ?>)
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <tr>
                                <td colspan="4"><?php _e('لا توجد بيانات حتى الآن', 'muhtawaa'); ?></td>
                            </tr>
                            <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض صفحة الإعدادات
     */
    public static function render_settings_page() {
        // حفظ الإعدادات
        if (isset($_POST['muhtawaa_save_settings']) && wp_verify_nonce($_POST['muhtawaa_settings_nonce'], 'muhtawaa_settings')) {
            self::save_settings();
            echo '<div class="notice notice-success"><p>' . __('تم حفظ الإعدادات بنجاح!', 'muhtawaa') . '</p></div>';
        }
        
        $tabs = array(
            'general' => __('عام', 'muhtawaa'),
            'appearance' => __('المظهر', 'muhtawaa'),
            'performance' => __('الأداء', 'muhtawaa'),
            'security' => __('الأمان', 'muhtawaa'),
            'seo' => __('SEO', 'muhtawaa'),
            'advanced' => __('متقدم', 'muhtawaa')
        );
        
        $current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
        ?>
        
        <div class="wrap muhtawaa-settings">
            <h1><?php _e('إعدادات قالب محتوى', 'muhtawaa'); ?></h1>
            
            <nav class="nav-tab-wrapper">
                <?php foreach ($tabs as $tab_key => $tab_name) : ?>
                    <a href="?page=muhtawaa-settings&tab=<?php echo $tab_key; ?>" 
                       class="nav-tab <?php echo $current_tab === $tab_key ? 'nav-tab-active' : ''; ?>">
                        <?php echo $tab_name; ?>
                    </a>
                <?php endforeach; ?>
            </nav>
            
            <form method="post" action="">
                <?php wp_nonce_field('muhtawaa_settings', 'muhtawaa_settings_nonce'); ?>
                
                <div class="settings-content">
                    <?php
                    switch ($current_tab) {
                        case 'general':
                            self::render_general_settings();
                            break;
                        case 'appearance':
                            self::render_appearance_settings();
                            break;
                        case 'performance':
                            self::render_performance_settings();
                            break;
                        case 'security':
                            self::render_security_settings();
                            break;
                        case 'seo':
                            self::render_seo_settings();
                            break;
                        case 'advanced':
                            self::render_advanced_settings();
                            break;
                    }
                    ?>
                </div>
                
                <p class="submit">
                    <input type="submit" name="muhtawaa_save_settings" class="button-primary" 
                           value="<?php esc_attr_e('حفظ الإعدادات', 'muhtawaa'); ?>">
                </p>
            </form>
        </div>
        <?php
    }
    
    /**
     * عرض الإعدادات العامة
     */
    private static function render_general_settings() {
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="enable_daily_tips"><?php _e('تفعيل النصائح اليومية', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_daily_tips" name="muhtawaa_settings[enable_daily_tips]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_daily_tips', 1)); ?>>
                    <p class="description"><?php _e('عرض نصيحة يومية في لوحة التحكم', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_breadcrumbs"><?php _e('تفعيل مسار التنقل', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_breadcrumbs" name="muhtawaa_settings[enable_breadcrumbs]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_breadcrumbs', 1)); ?>>
                    <p class="description"><?php _e('عرض مسار التنقل في جميع الصفحات', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="posts_per_page"><?php _e('عدد المقالات في الصفحة', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="number" id="posts_per_page" name="muhtawaa_settings[posts_per_page]" 
                           value="<?php echo get_option('muhtawaa_posts_per_page', 10); ?>" 
                           min="1" max="50" class="small-text">
                    <p class="description"><?php _e('عدد المقالات المعروضة في صفحات الأرشيف', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="excerpt_length"><?php _e('طول المقتطف', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="number" id="excerpt_length" name="muhtawaa_settings[excerpt_length]" 
                           value="<?php echo get_option('muhtawaa_excerpt_length', 55); ?>" 
                           min="10" max="200" class="small-text">
                    <span><?php _e('كلمة', 'muhtawaa'); ?></span>
                    <p class="description"><?php _e('عدد الكلمات في المقتطف', 'muhtawaa'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * عرض إعدادات المظهر
     */
    private static function render_appearance_settings() {
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="layout_style"><?php _e('نمط التخطيط', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <select id="layout_style" name="muhtawaa_settings[layout_style]">
                        <option value="boxed" <?php selected(get_option('muhtawaa_layout_style'), 'boxed'); ?>>
                            <?php _e('محاصر', 'muhtawaa'); ?>
                        </option>
                        <option value="wide" <?php selected(get_option('muhtawaa_layout_style'), 'wide'); ?>>
                            <?php _e('عريض', 'muhtawaa'); ?>
                        </option>
                        <option value="fullwidth" <?php selected(get_option('muhtawaa_layout_style'), 'fullwidth'); ?>>
                            <?php _e('عرض كامل', 'muhtawaa'); ?>
                        </option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="sidebar_position"><?php _e('موضع الشريط الجانبي', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <select id="sidebar_position" name="muhtawaa_settings[sidebar_position]">
                        <option value="right" <?php selected(get_option('muhtawaa_sidebar_position', 'right'), 'right'); ?>>
                            <?php _e('يمين', 'muhtawaa'); ?>
                        </option>
                        <option value="left" <?php selected(get_option('muhtawaa_sidebar_position'), 'left'); ?>>
                            <?php _e('يسار', 'muhtawaa'); ?>
                        </option>
                        <option value="none" <?php selected(get_option('muhtawaa_sidebar_position'), 'none'); ?>>
                            <?php _e('بدون شريط جانبي', 'muhtawaa'); ?>
                        </option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_animations"><?php _e('تفعيل الحركات', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_animations" name="muhtawaa_settings[enable_animations]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_animations', 1)); ?>>
                    <p class="description"><?php _e('تفعيل الحركات والانتقالات في الموقع', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="sticky_header"><?php _e('تثبيت رأس الموقع', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="sticky_header" name="muhtawaa_settings[sticky_header]" 
                           value="1" <?php checked(get_option('muhtawaa_sticky_header', 1)); ?>>
                    <p class="description"><?php _e('تثبيت رأس الموقع عند التمرير', 'muhtawaa'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * عرض إعدادات الأداء
     */
    private static function render_performance_settings() {
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="enable_cache"><?php _e('تفعيل التخزين المؤقت', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_cache" name="muhtawaa_settings[enable_cache]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_cache', 1)); ?>>
                    <p class="description"><?php _e('تفعيل نظام التخزين المؤقت لتحسين السرعة', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_lazy_load"><?php _e('تفعيل التحميل الكسول', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_lazy_load" name="muhtawaa_settings[enable_lazy_load]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_lazy_load', 1)); ?>>
                    <p class="description"><?php _e('تأجيل تحميل الصور حتى الحاجة إليها', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="minify_assets"><?php _e('ضغط الملفات', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="minify_assets" name="muhtawaa_settings[minify_assets]" 
                           value="1" <?php checked(get_option('muhtawaa_minify_assets', 1)); ?>>
                    <p class="description"><?php _e('ضغط ملفات CSS و JavaScript', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="optimize_images"><?php _e('تحسين الصور تلقائياً', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="optimize_images" name="muhtawaa_settings[optimize_images]" 
                           value="1" <?php checked(get_option('muhtawaa_optimize_images', 1)); ?>>
                    <p class="description"><?php _e('ضغط الصور تلقائياً عند الرفع', 'muhtawaa'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * عرض إعدادات الأمان
     */
    private static function render_security_settings() {
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="disable_xmlrpc"><?php _e('تعطيل XML-RPC', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="disable_xmlrpc" name="muhtawaa_settings[disable_xmlrpc]" 
                           value="1" <?php checked(get_option('muhtawaa_disable_xmlrpc', 1)); ?>>
                    <p class="description"><?php _e('تعطيل XML-RPC لمنع هجمات القوة الغاشمة', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="hide_wp_version"><?php _e('إخفاء إصدار ووردبريس', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="hide_wp_version" name="muhtawaa_settings[hide_wp_version]" 
                           value="1" <?php checked(get_option('muhtawaa_hide_wp_version', 1)); ?>>
                    <p class="description"><?php _e('إخفاء رقم إصدار ووردبريس من الكود المصدري', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="limit_login_attempts"><?php _e('تحديد محاولات الدخول', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="number" id="limit_login_attempts" name="muhtawaa_settings[limit_login_attempts]" 
                           value="<?php echo get_option('muhtawaa_limit_login_attempts', 5); ?>" 
                           min="1" max="10" class="small-text">
                    <span><?php _e('محاولة', 'muhtawaa'); ?></span>
                    <p class="description"><?php _e('عدد المحاولات المسموحة قبل الحظر المؤقت', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_security_headers"><?php _e('رؤوس الأمان', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_security_headers" name="muhtawaa_settings[enable_security_headers]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_security_headers', 1)); ?>>
                    <p class="description"><?php _e('إضافة رؤوس HTTP الأمنية', 'muhtawaa'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * عرض إعدادات SEO
     */
    private static function render_seo_settings() {
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="enable_schema_markup"><?php _e('تفعيل Schema Markup', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_schema_markup" name="muhtawaa_settings[enable_schema_markup]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_schema_markup', 1)); ?>>
                    <p class="description"><?php _e('إضافة بيانات منظمة للصفحات', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_og_tags"><?php _e('تفعيل Open Graph', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_og_tags" name="muhtawaa_settings[enable_og_tags]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_og_tags', 1)); ?>>
                    <p class="description"><?php _e('إضافة علامات Open Graph للمشاركة الاجتماعية', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_twitter_cards"><?php _e('تفعيل Twitter Cards', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_twitter_cards" name="muhtawaa_settings[enable_twitter_cards]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_twitter_cards', 1)); ?>>
                    <p class="description"><?php _e('إضافة علامات Twitter Cards', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="enable_sitemap"><?php _e('تفعيل خريطة الموقع', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_sitemap" name="muhtawaa_settings[enable_sitemap]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_sitemap', 1)); ?>>
                    <p class="description"><?php _e('إنشاء خريطة موقع XML تلقائياً', 'muhtawaa'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * عرض الإعدادات المتقدمة
     */
    private static function render_advanced_settings() {
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="enable_debug_mode"><?php _e('وضع التطوير', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="enable_debug_mode" name="muhtawaa_settings[enable_debug_mode]" 
                           value="1" <?php checked(get_option('muhtawaa_enable_debug_mode', 0)); ?>>
                    <p class="description"><?php _e('تفعيل وضع التطوير لعرض معلومات التصحيح', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="custom_css"><?php _e('CSS مخصص', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <textarea id="custom_css" name="muhtawaa_settings[custom_css]" 
                              rows="10" cols="50" class="large-text code"><?php 
                        echo esc_textarea(get_option('muhtawaa_custom_css', '')); 
                    ?></textarea>
                    <p class="description"><?php _e('أضف أكواد CSS مخصصة هنا', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="custom_js"><?php _e('JavaScript مخصص', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <textarea id="custom_js" name="muhtawaa_settings[custom_js]" 
                              rows="10" cols="50" class="large-text code"><?php 
                        echo esc_textarea(get_option('muhtawaa_custom_js', '')); 
                    ?></textarea>
                    <p class="description"><?php _e('أضف أكواد JavaScript مخصصة هنا', 'muhtawaa'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="analytics_code"><?php _e('كود التحليلات', 'muhtawaa'); ?></label>
                </th>
                <td>
                    <textarea id="analytics_code" name="muhtawaa_settings[analytics_code]" 
                              rows="5" cols="50" class="large-text code"><?php 
                        echo esc_textarea(get_option('muhtawaa_analytics_code', '')); 
                    ?></textarea>
                    <p class="description"><?php _e('أضف كود Google Analytics أو أي كود تحليلات آخر', 'muhtawaa'); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * حفظ الإعدادات
     */
    private static function save_settings() {
        if (!isset($_POST['muhtawaa_settings'])) {
            return;
        }
        
        $settings = $_POST['muhtawaa_settings'];
        
        // حفظ كل إعداد
        foreach ($settings as $key => $value) {
            if (is_array($value)) {
                $value = array_map('sanitize_text_field', $value);
            } else {
                $value = sanitize_text_field($value);
            }
            
            update_option('muhtawaa_' . $key, $value);
        }
        
        // معالجة الخيارات غير المحددة (checkboxes)
        $checkboxes = array(
            'enable_daily_tips',
            'enable_breadcrumbs',
            'enable_animations',
            'sticky_header',
            'enable_cache',
            'enable_lazy_load',
            'minify_assets',
            'optimize_images',
            'disable_xmlrpc',
            'hide_wp_version',
            'enable_security_headers',
            'enable_schema_markup',
            'enable_og_tags',
            'enable_twitter_cards',
            'enable_sitemap',
            'enable_debug_mode'
        );
        
        foreach ($checkboxes as $checkbox) {
            if (!isset($settings[$checkbox])) {
                update_option('muhtawaa_' . $checkbox, 0);
            }
        }
    }
    
    /**
     * عرض صفحة الأدوات
     */
    public static function render_tools_page() {
        $tabs = array(
            'cache' => __('التخزين المؤقت', 'muhtawaa'),
            'database' => __('قاعدة البيانات', 'muhtawaa'),
            'backup' => __('النسخ الاحتياطي', 'muhtawaa'),
            'security' => __('فحص الأمان', 'muhtawaa'),
            'import-export' => __('الاستيراد والتصدير', 'muhtawaa')
        );
        
        $current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'cache';
        ?>
        
        <div class="wrap muhtawaa-tools">
            <h1><?php _e('أدوات قالب محتوى', 'muhtawaa'); ?></h1>
            
            <nav class="nav-tab-wrapper">
                <?php foreach ($tabs as $tab_key => $tab_name) : ?>
                    <a href="?page=muhtawaa-tools&tab=<?php echo $tab_key; ?>" 
                       class="nav-tab <?php echo $current_tab === $tab_key ? 'nav-tab-active' : ''; ?>">
                        <?php echo $tab_name; ?>
                    </a>
                <?php endforeach; ?>
            </nav>
            
            <div class="tools-content">
                <?php
                switch ($current_tab) {
                    case 'cache':
                        self::render_cache_tools();
                        break;
                    case 'database':
                        self::render_database_tools();
                        break;
                    case 'backup':
                        self::render_backup_tools();
                        break;
                    case 'security':
                        self::render_security_tools();
                        break;
                    case 'import-export':
                        self::render_import_export_tools();
                        break;
                }
                ?>
            </div>
        </div>
        <?php
    }
    
    /**
     * أدوات التخزين المؤقت
     */
    private static function render_cache_tools() {
        ?>
        <div class="cache-tools">
            <h2><?php _e('إدارة التخزين المؤقت', 'muhtawaa'); ?></h2>
            
            <div class="tool-card">
                <h3><?php _e('مسح جميع الملفات المؤقتة', 'muhtawaa'); ?></h3>
                <p><?php _e('سيتم حذف جميع ملفات التخزين المؤقت للصفحات والصور والملفات الأخرى', 'muhtawaa'); ?></p>
                <button class="button button-primary clear-all-cache">
                    <?php _e('مسح الكل', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="tool-card">
                <h3><?php _e('مسح ذاكرة التخزين المؤقت للصفحات', 'muhtawaa'); ?></h3>
                <p><?php _e('حذف الصفحات المخزنة مؤقتاً فقط', 'muhtawaa'); ?></p>
                <button class="button clear-page-cache">
                    <?php _e('مسح صفحات التخزين المؤقت', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="tool-card">
                <h3><?php _e('مسح ذاكرة التخزين المؤقت للصور', 'muhtawaa'); ?></h3>
                <p><?php _e('حذف الصور المصغرة المخزنة مؤقتاً', 'muhtawaa'); ?></p>
                <button class="button clear-image-cache">
                    <?php _e('مسح صور التخزين المؤقت', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="cache-stats">
                <h3><?php _e('إحصائيات التخزين المؤقت', 'muhtawaa'); ?></h3>
                <table class="widefat">
                    <tr>
                        <td><?php _e('حجم التخزين المؤقت', 'muhtawaa'); ?></td>
                        <td><strong id="cache-size">-</strong></td>
                    </tr>
                    <tr>
                        <td><?php _e('عدد الملفات المخزنة', 'muhtawaa'); ?></td>
                        <td><strong id="cache-files">-</strong></td>
                    </tr>
                    <tr>
                        <td><?php _e('آخر مسح', 'muhtawaa'); ?></td>
                        <td><strong id="last-clear">-</strong></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }
    
    /**
     * أدوات قاعدة البيانات
     */
    private static function render_database_tools() {
        global $wpdb;
        
        // حساب حجم الجداول
        $tables = $wpdb->get_results("
            SELECT 
                table_name AS 'name',
                ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'size'
            FROM information_schema.TABLES 
            WHERE table_schema = '" . DB_NAME . "'
            ORDER BY (data_length + index_length) DESC
        ");
        ?>
        
        <div class="database-tools">
            <h2><?php _e('أدوات قاعدة البيانات', 'muhtawaa'); ?></h2>
            
            <div class="tool-card">
                <h3><?php _e('تحسين الجداول', 'muhtawaa'); ?></h3>
                <p><?php _e('تحسين جميع جداول قاعدة البيانات لتحسين الأداء', 'muhtawaa'); ?></p>
                <button class="button button-primary optimize-database">
                    <?php _e('تحسين الآن', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="tool-card">
                <h3><?php _e('تنظيف المراجعات', 'muhtawaa'); ?></h3>
                <p><?php _e('حذف جميع مراجعات المقالات القديمة', 'muhtawaa'); ?></p>
                <?php
                $revisions_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'revision'");
                ?>
                <p><?php printf(__('عدد المراجعات: %d', 'muhtawaa'), $revisions_count); ?></p>
                <button class="button clean-revisions" <?php echo $revisions_count == 0 ? 'disabled' : ''; ?>>
                    <?php _e('تنظيف المراجعات', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="tool-card">
                <h3><?php _e('تنظيف التعليقات المزعجة', 'muhtawaa'); ?></h3>
                <p><?php _e('حذف جميع التعليقات المزعجة والمحذوفة', 'muhtawaa'); ?></p>
                <?php
                $spam_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = 'spam' OR comment_approved = 'trash'");
                ?>
                <p><?php printf(__('عدد التعليقات المزعجة: %d', 'muhtawaa'), $spam_count); ?></p>
                <button class="button clean-spam" <?php echo $spam_count == 0 ? 'disabled' : ''; ?>>
                    <?php _e('تنظيف التعليقات المزعجة', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="database-tables">
                <h3><?php _e('حجم الجداول', 'muhtawaa'); ?></h3>
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th><?php _e('الجدول', 'muhtawaa'); ?></th>
                            <th><?php _e('الحجم (MB)', 'muhtawaa'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tables as $table) : ?>
                            <tr>
                                <td><?php echo esc_html($table->name); ?></td>
                                <td><?php echo esc_html($table->size); ?> MB</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    
    /**
     * أدوات النسخ الاحتياطي
     */
    private static function render_backup_tools() {
        ?>
        <div class="backup-tools">
            <h2><?php _e('النسخ الاحتياطي والاستعادة', 'muhtawaa'); ?></h2>
            
            <div class="tool-card">
                <h3><?php _e('نسخ احتياطي للإعدادات', 'muhtawaa'); ?></h3>
                <p><?php _e('إنشاء نسخة احتياطية من جميع إعدادات القالب', 'muhtawaa'); ?></p>
                <button class="button button-primary export-settings">
                    <?php _e('تصدير الإعدادات', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="tool-card">
                <h3><?php _e('استعادة الإعدادات', 'muhtawaa'); ?></h3>
                <p><?php _e('استعادة الإعدادات من نسخة احتياطية سابقة', 'muhtawaa'); ?></p>
                <input type="file" id="import-settings-file" accept=".json">
                <button class="button import-settings" disabled>
                    <?php _e('استيراد الإعدادات', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="backup-history">
                <h3><?php _e('سجل النسخ الاحتياطية', 'muhtawaa'); ?></h3>
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th><?php _e('التاريخ', 'muhtawaa'); ?></th>
                            <th><?php _e('النوع', 'muhtawaa'); ?></th>
                            <th><?php _e('الحجم', 'muhtawaa'); ?></th>
                            <th><?php _e('الإجراءات', 'muhtawaa'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4"><?php _e('لا توجد نسخ احتياطية حتى الآن', 'muhtawaa'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    
    /**
     * أدوات فحص الأمان
     */
    private static function render_security_tools() {
        ?>
        <div class="security-tools">
            <h2><?php _e('فحص الأمان', 'muhtawaa'); ?></h2>
            
            <div class="security-scan">
                <button class="button button-primary button-hero run-security-scan">
                    <span class="dashicons dashicons-shield"></span>
                    <?php _e('بدء فحص الأمان', 'muhtawaa'); ?>
                </button>
            </div>
            
            <div class="scan-results" style="display: none;">
                <h3><?php _e('نتائج الفحص', 'muhtawaa'); ?></h3>
                <div class="scan-progress">
                    <div class="progress-bar"></div>
                </div>
                
                <div class="results-list"></div>
            </div>
            
            <div class="security-checklist">
                <h3><?php _e('قائمة فحص الأمان', 'muhtawaa'); ?></h3>
                <ul>
                    <li>
                        <span class="status-icon"></span>
                        <?php _e('إصدار ووردبريس محدث', 'muhtawaa'); ?>
                    </li>
                    <li>
                        <span class="status-icon"></span>
                        <?php _e('الإضافات محدثة', 'muhtawaa'); ?>
                    </li>
                    <li>
                        <span class="status-icon"></span>
                        <?php _e('كلمات مرور قوية', 'muhtawaa'); ?>
                    </li>
                    <li>
                        <span class="status-icon"></span>
                        <?php _e('صلاحيات الملفات صحيحة', 'muhtawaa'); ?>
                    </li>
                    <li>
                        <span class="status-icon"></span>
                        <?php _e('SSL مفعل', 'muhtawaa'); ?>
                    </li>
                </ul>
            </div>
        </div>
        <?php
    }
    
    /**
     * أدوات الاستيراد والتصدير
     */
    private static function render_import_export_tools() {
        ?>
        <div class="import-export-tools">
            <h2><?php _e('الاستيراد والتصدير', 'muhtawaa'); ?></h2>
            
            <div class="tool-card">
                <h3><?php _e('تصدير المحتوى', 'muhtawaa'); ?></h3>
                <p><?php _e('تصدير المقالات والصفحات والتعليقات', 'muhtawaa'); ?></p>
                <form method="post" action="">
                    <label>
                        <input type="checkbox" name="export_posts" checked>
                        <?php _e('المقالات', 'muhtawaa'); ?>
                    </label><br>
                    <label>
                        <input type="checkbox" name="export_pages" checked>
                        <?php _e('الصفحات', 'muhtawaa'); ?>
                    </label><br>
                    <label>
                        <input type="checkbox" name="export_comments" checked>
                        <?php _e('التعليقات', 'muhtawaa'); ?>
                    </label><br><br>
                    <button class="button button-primary">
                        <?php _e('تصدير', 'muhtawaa'); ?>
                    </button>
                </form>
            </div>
            
            <div class="tool-card">
                <h3><?php _e('استيراد المحتوى', 'muhtawaa'); ?></h3>
                <p><?php _e('استيراد محتوى من ملف XML', 'muhtawaa'); ?></p>
                <input type="file" id="import-file" accept=".xml">
                <button class="button import-content" disabled>
                    <?php _e('استيراد', 'muhtawaa'); ?>
                </button>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض صفحة المساعدة
     */
    public static function render_help_page() {
        ?>
        <div class="wrap muhtawaa-help">
            <h1><?php _e('مركز المساعدة', 'muhtawaa'); ?></h1>
            
            <div class="help-sections">
                <div class="help-section">
                    <h2><?php _e('البداية السريعة', 'muhtawaa'); ?></h2>
                    <div class="help-videos">
                        <div class="video-card">
                            <h3><?php _e('تثبيت القالب', 'muhtawaa'); ?></h3>
                            <p><?php _e('تعلم كيفية تثبيت وتفعيل قالب محتوى', 'muhtawaa'); ?></p>
                            <a href="#" class="button"><?php _e('مشاهدة الفيديو', 'muhtawaa'); ?></a>
                        </div>
                        
                        <div class="video-card">
                            <h3><?php _e('الإعدادات الأولية', 'muhtawaa'); ?></h3>
                            <p><?php _e('إعداد القالب للمرة الأولى', 'muhtawaa'); ?></p>
                            <a href="#" class="button"><?php _e('مشاهدة الفيديو', 'muhtawaa'); ?></a>
                        </div>
                        
                        <div class="video-card">
                            <h3><?php _e('تخصيص المظهر', 'muhtawaa'); ?></h3>
                            <p><?php _e('تخصيص ألوان وخطوط القالب', 'muhtawaa'); ?></p>
                            <a href="#" class="button"><?php _e('مشاهدة الفيديو', 'muhtawaa'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="help-section">
                    <h2><?php _e('الأسئلة الشائعة', 'muhtawaa'); ?></h2>
                    <div class="faq-accordion">
                        <div class="faq-item">
                            <h3 class="faq-question">
                                <?php _e('كيف أقوم بتغيير الشعار؟', 'muhtawaa'); ?>
                                <span class="toggle-icon">+</span>
                            </h3>
                            <div class="faq-answer">
                                <p><?php _e('يمكنك تغيير الشعار من خلال الذهاب إلى المظهر > تخصيص > هوية الموقع', 'muhtawaa'); ?></p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="faq-question">
                                <?php _e('كيف أضيف قائمة جديدة؟', 'muhtawaa'); ?>
                                <span class="toggle-icon">+</span>
                            </h3>
                            <div class="faq-answer">
                                <p><?php _e('اذهب إلى المظهر > القوائم وقم بإنشاء قائمة جديدة', 'muhtawaa'); ?></p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="faq-question">
                                <?php _e('هل القالب متوافق مع الجوال؟', 'muhtawaa'); ?>
                                <span class="toggle-icon">+</span>
                            </h3>
                            <div class="faq-answer">
                                <p><?php _e('نعم، القالب متجاوب بالكامل ومتوافق مع جميع الأجهزة', 'muhtawaa'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="help-section">
                    <h2><?php _e('الدعم الفني', 'muhtawaa'); ?></h2>
                    <div class="support-options">
                        <div class="support-card">
                            <span class="dashicons dashicons-text-page"></span>
                            <h3><?php _e('التوثيق', 'muhtawaa'); ?></h3>
                            <p><?php _e('دليل شامل لجميع ميزات القالب', 'muhtawaa'); ?></p>
                            <a href="https://muhtawaa.com/docs" target="_blank" class="button">
                                <?php _e('قراءة التوثيق', 'muhtawaa'); ?>
                            </a>
                        </div>
                        
                        <div class="support-card">
                            <span class="dashicons dashicons-format-chat"></span>
                            <h3><?php _e('منتدى الدعم', 'muhtawaa'); ?></h3>
                            <p><?php _e('احصل على إجابات من المجتمع', 'muhtawaa'); ?></p>
                            <a href="https://muhtawaa.com/forum" target="_blank" class="button">
                                <?php _e('زيارة المنتدى', 'muhtawaa'); ?>
                            </a>
                        </div>
                        
                        <div class="support-card">
                            <span class="dashicons dashicons-email"></span>
                            <h3><?php _e('البريد الإلكتروني', 'muhtawaa'); ?></h3>
                            <p><?php _e('تواصل مع فريق الدعم مباشرة', 'muhtawaa'); ?></p>
                            <a href="mailto:support@muhtawaa.com" class="button">
                                <?php _e('إرسال بريد', 'muhtawaa'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض ويدجت الإحصائيات السريعة
     */
    public static function render_quick_stats_widget() {
        $total_posts = wp_count_posts()->publish;
        $total_comments = wp_count_comments()->approved;
        $total_users = count_users()['total_users'];
        $total_views = get_option('muhtawaa_total_views', 0);
        ?>
        
        <div class="muhtawaa-quick-stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($total_posts); ?></span>
                <span class="stat-label"><?php _e('مقالة', 'muhtawaa'); ?></span>
            </div>
            
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($total_comments); ?></span>
                <span class="stat-label"><?php _e('تعليق', 'muhtawaa'); ?></span>
            </div>
            
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($total_users); ?></span>
                <span class="stat-label"><?php _e('مستخدم', 'muhtawaa'); ?></span>
            </div>
            
            <div class="stat-item">
                <span class="stat-number"><?php echo number_format($total_views); ?></span>
                <span class="stat-label"><?php _e('مشاهدة', 'muhtawaa'); ?></span>
            </div>
        </div>
        
        <p class="dashboard-link">
            <a href="<?php echo admin_url('admin.php?page=muhtawaa-stats'); ?>" class="button">
                <?php _e('عرض التفاصيل', 'muhtawaa'); ?>
            </a>
        </p>
        <?php
    }
    
    /**
     * عرض ويدجت النصيحة اليومية
     */
    public static function render_daily_tip_widget() {
        $tips = array(
            __('استخدم الصور المصغرة البارزة لجذب انتباه القراء', 'muhtawaa'),
            __('اكتب عناوين جذابة وواضحة لمقالاتك', 'muhtawaa'),
            __('استخدم الوسوم والفئات لتنظيم المحتوى', 'muhtawaa'),
            __('تفاعل مع تعليقات القراء لبناء مجتمع نشط', 'muhtawaa'),
            __('احرص على تحديث المحتوى القديم بانتظام', 'muhtawaa'),
            __('استخدم الروابط الداخلية لتحسين تجربة التصفح', 'muhtawaa'),
            __('اكتب محتوى أصلي وذو قيمة للقراء', 'muhtawaa'),
            __('استخدم الكلمات المفتاحية بشكل طبيعي', 'muhtawaa'),
            __('أضف وصف ميتا لكل صفحة ومقال', 'muhtawaa'),
            __('تأكد من سرعة تحميل موقعك', 'muhtawaa')
        );
        
        $tip_index = date('z') % count($tips);
        $daily_tip = $tips[$tip_index];
        ?>
        
        <div class="muhtawaa-daily-tip">
            <span class="tip-icon">💡</span>
            <p><?php echo esc_html($daily_tip); ?></p>
        </div>
        
        <p class="tip-footer">
            <small><?php _e('نصيحة جديدة كل يوم!', 'muhtawaa'); ?></small>
        </p>
        <?php
    }
    
    /**
     * عرض ويدجت النشاط الأخير
     */
    public static function render_recent_activity_widget() {
        ?>
        <div class="muhtawaa-recent-activity">
            <ul class="activity-list">
                <?php
                // آخر المقالات
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 3,
                    'post_status' => 'publish'
                ));
                
                foreach ($recent_posts as $post) {
                    ?>
                    <li class="activity-item">
                        <span class="activity-icon dashicons dashicons-admin-post"></span>
                        <div class="activity-content">
                            <a href="<?php echo get_edit_post_link($post['ID']); ?>">
                                <?php echo esc_html($post['post_title']); ?>
                            </a>
                            <span class="activity-time">
                                <?php echo human_time_diff(strtotime($post['post_date']), current_time('timestamp')) . ' ' . __('مضت', 'muhtawaa'); ?>
                            </span>
                        </div>
                    </li>
                    <?php
                }
                
                // آخر التعليقات
                $recent_comments = get_comments(array(
                    'number' => 2,
                    'status' => 'approve'
                ));
                
                foreach ($recent_comments as $comment) {
                    ?>
                    <li class="activity-item">
                        <span class="activity-icon dashicons dashicons-admin-comments"></span>
                        <div class="activity-content">
                            <?php printf(
                                __('%s علق على %s', 'muhtawaa'),
                                '<strong>' . esc_html($comment->comment_author) . '</strong>',
                                '<a href="' . get_edit_comment_link($comment) . '">' . get_the_title($comment->comment_post_ID) . '</a>'
                            ); ?>
                            <span class="activity-time">
                                <?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp')) . ' ' . __('مضت', 'muhtawaa'); ?>
                            </span>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    
    /**
     * تخصيص شريط الإدارة
     */
    public static function customize_admin_bar($wp_admin_bar) {
        // إضافة قائمة محتوى
        $wp_admin_bar->add_node(array(
            'id' => 'muhtawaa-menu',
            'title' => '<span class="ab-icon dashicons dashicons-layout"></span>' . __('محتوى', 'muhtawaa'),
            'href' => admin_url('admin.php?page=muhtawaa-dashboard'),
            'meta' => array(
                'title' => __('قالب محتوى', 'muhtawaa')
            )
        ));
        
        // الروابط الفرعية
        $wp_admin_bar->add_node(array(
            'id' => 'muhtawaa-settings',
            'parent' => 'muhtawaa-menu',
            'title' => __('الإعدادات', 'muhtawaa'),
            'href' => admin_url('admin.php?page=muhtawaa-settings')
        ));
        
        $wp_admin_bar->add_node(array(
            'id' => 'muhtawaa-tools',
            'parent' => 'muhtawaa-menu',
            'title' => __('الأدوات', 'muhtawaa'),
            'href' => admin_url('admin.php?page=muhtawaa-tools')
        ));
        
        $wp_admin_bar->add_node(array(
            'id' => 'muhtawaa-clear-cache',
            'parent' => 'muhtawaa-menu',
            'title' => __('مسح الذاكرة المؤقتة', 'muhtawaa'),
            'href' => '#',
            'meta' => array(
                'onclick' => 'muhtawaaClearCache(); return false;'
            )
        ));
    }
    
    /**
     * رسالة الترحيب
     */
    public static function welcome_notice() {
        $user_id = get_current_user_id();
        
        if (!get_user_meta($user_id, 'muhtawaa_welcome_dismissed', true)) {
            ?>
            <div class="notice notice-info is-dismissible muhtawaa-welcome-notice">
                <h2><?php _e('مرحباً بك في قالب محتوى!', 'muhtawaa'); ?></h2>
                <p><?php _e('شكراً لاختيارك قالب محتوى. يمكنك البدء بتخصيص موقعك من خلال:', 'muhtawaa'); ?></p>
                <p>
                    <a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary">
                        <?php _e('تخصيص القالب', 'muhtawaa'); ?>
                    </a>
                    <a href="<?php echo admin_url('admin.php?page=muhtawaa-dashboard'); ?>" class="button">
                        <?php _e('لوحة التحكم', 'muhtawaa'); ?>
                    </a>
                    <a href="<?php echo admin_url('admin.php?page=muhtawaa-help'); ?>" class="button">
                        <?php _e('المساعدة', 'muhtawaa'); ?>
                    </a>
                </p>
            </div>
            <script>
            jQuery(document).on('click', '.muhtawaa-welcome-notice .notice-dismiss', function() {
                jQuery.post(ajaxurl, {
                    action: 'muhtawaa_dismiss_welcome',
                    nonce: '<?php echo wp_create_nonce('muhtawaa_dismiss_welcome'); ?>'
                });
            });
            </script>
            <?php
        }
    }
    
    /**
     * معالج AJAX لإحصائيات لوحة التحكم
     */
    public static function ajax_get_dashboard_stats() {
        check_ajax_referer('muhtawaa_admin_nonce', 'nonce');
        
        $stats = array(
            'posts' => wp_count_posts()->publish,
            'comments' => wp_count_comments()->approved,
            'users' => count_users()['total_users'],
            'views' => get_option('muhtawaa_total_views', 0),
            'performance' => rand(85, 98) // نسبة الأداء (مؤقتاً)
        );
        
        wp_send_json_success($stats);
    }
    
    /**
     * معالج AJAX لمسح الذاكرة المؤقتة
     */
    public static function ajax_clear_cache() {
        check_ajax_referer('muhtawaa_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('ليس لديك صلاحية لتنفيذ هذا الإجراء', 'muhtawaa'));
        }
        
        // مسح transients
        global $wpdb;
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%'");
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_site_transient_%'");
        
        // تحديث وقت آخر مسح
        update_option('muhtawaa_last_cache_clear', current_time('timestamp'));
        
        wp_send_json_success(array(
            'message' => __('تم مسح الذاكرة المؤقتة بنجاح', 'muhtawaa')
        ));
    }
    
    /**
     * معالج AJAX لتحسين قاعدة البيانات
     */
    public static function ajax_optimize_database() {
        check_ajax_referer('muhtawaa_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('ليس لديك صلاحية لتنفيذ هذا الإجراء', 'muhtawaa'));
        }
        
        global $wpdb;
        
        // الحصول على جميع الجداول
        $tables = $wpdb->get_col("SHOW TABLES FROM " . DB_NAME);
        
        $optimized = 0;
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE $table");
            $optimized++;
        }
        
        // تحديث وقت آخر تحسين
        update_option('muhtawaa_last_db_optimize', current_time('timestamp'));
        
        wp_send_json_success(array(
            'message' => sprintf(__('تم تحسين %d جدول بنجاح', 'muhtawaa'), $optimized),
            'tables_optimized' => $optimized
        ));
    }
}

// تفعيل لوحة الإدارة
add_action('init', array('MuhtawaaAdminDashboard', 'init'));

// معالج إلغاء رسالة الترحيب
add_action('wp_ajax_muhtawaa_dismiss_welcome', function() {
    check_ajax_referer('muhtawaa_dismiss_welcome', 'nonce');
    update_user_meta(get_current_user_id(), 'muhtawaa_welcome_dismissed', true);
    wp_die();
});
                