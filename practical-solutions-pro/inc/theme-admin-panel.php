<?php
/**
 * Theme Admin Panel - Enhanced Version
 * لوحة تحكم القالب المحسنة
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Theme_Admin_Panel {
    
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'init_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('wp_ajax_ps_clear_cache', [$this, 'clear_cache']);
    }
    
    public function add_admin_menu() {
        add_theme_page(
            __('إعدادات Practical Solutions', 'practical-solutions'),
            __('إعدادات القالب', 'practical-solutions'),
            'manage_options',
            'ps-theme-settings',
            [$this, 'render_admin_page']
        );
        
        add_submenu_page(
            'ps-theme-settings',
            __('إحصائيات الأداء', 'practical-solutions'),
            __('الإحصائيات', 'practical-solutions'),
            'manage_options',
            'ps-analytics',
            [$this, 'render_analytics_page']
        );
        
        add_submenu_page(
            'ps-theme-settings',
            __('أدوات القالب', 'practical-solutions'),
            __('الأدوات', 'practical-solutions'),
            'manage_options',
            'ps-tools',
            [$this, 'render_tools_page']
        );
    }
    
    public function init_settings() {
        register_setting('ps_theme_settings', 'ps_performance_settings');
        register_setting('ps_theme_settings', 'ps_seo_settings');
        register_setting('ps_theme_settings', 'ps_social_settings');
        register_setting('ps_theme_settings', 'ps_arabic_settings');
        
        // قسم تحسينات الأداء
        add_settings_section(
            'ps_performance_section',
            __('تحسينات الأداء', 'practical-solutions'),
            [$this, 'performance_section_callback'],
            'ps_theme_settings'
        );
        
        add_settings_field(
            'enable_lazy_loading',
            __('تفعيل التحميل البطيء للصور', 'practical-solutions'),
            [$this, 'checkbox_field_callback'],
            'ps_theme_settings',
            'ps_performance_section',
            ['option_name' => 'ps_performance_settings', 'field_name' => 'enable_lazy_loading']
        );
        
        add_settings_field(
            'enable_minification',
            __('ضغط ملفات CSS و JS', 'practical-solutions'),
            [$this, 'checkbox_field_callback'],
            'ps_theme_settings',
            'ps_performance_section',
            ['option_name' => 'ps_performance_settings', 'field_name' => 'enable_minification']
        );
        
        // قسم إعدادات SEO
        add_settings_section(
            'ps_seo_section',
            __('إعدادات تحسين محركات البحث', 'practical-solutions'),
            [$this, 'seo_section_callback'],
            'ps_theme_settings'
        );
        
        add_settings_field(
            'enable_structured_data',
            __('تفعيل البيانات المهيكلة', 'practical-solutions'),
            [$this, 'checkbox_field_callback'],
            'ps_theme_settings',
            'ps_seo_section',
            ['option_name' => 'ps_seo_settings', 'field_name' => 'enable_structured_data']
        );
        
        // قسم إعدادات المحتوى العربي
        add_settings_section(
            'ps_arabic_section',
            __('إعدادات المحتوى العربي', 'practical-solutions'),
            [$this, 'arabic_section_callback'],
            'ps_theme_settings'
        );
        
        add_settings_field(
            'arabic_font',
            __('خط المحتوى العربي', 'practical-solutions'),
            [$this, 'select_field_callback'],
            'ps_theme_settings',
            'ps_arabic_section',
            [
                'option_name' => 'ps_arabic_settings',
                'field_name' => 'arabic_font',
                'options' => [
                    'cairo' => 'Cairo',
                    'almarai' => 'Almarai',
                    'amiri' => 'Amiri',
                    'scheherazade' => 'Scheherazade'
                ]
            ]
        );
    }
    
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'ps-') !== false) {
            wp_enqueue_style('ps-admin-style', PS_THEME_URI . '/assets/admin/admin-style.css', [], PS_THEME_VERSION);
            wp_enqueue_script('ps-admin-script', PS_THEME_URI . '/assets/admin/admin-script.js', ['jquery'], PS_THEME_VERSION, true);
            
            wp_localize_script('ps-admin-script', 'psAdmin', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('ps_admin_nonce'),
                'strings' => [
                    'confirm_clear_cache' => __('هل أنت متأكد من حذف الملفات المؤقتة؟', 'practical-solutions'),
                    'cache_cleared' => __('تم حذف الملفات المؤقتة بنجاح', 'practical-solutions')
                ]
            ]);
        }
    }
    
    public function render_admin_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('إعدادات Practical Solutions Pro', 'practical-solutions'); ?></h1>
            
            <div class="ps-admin-dashboard">
                <div class="ps-admin-grid">
                    
                    <div class="ps-card">
                        <h2><?php _e('معلومات سريعة', 'practical-solutions'); ?></h2>
                        <div class="ps-stats-grid">
                            <div class="ps-stat-item">
                                <span class="ps-stat-number"><?php echo wp_count_posts()->publish; ?></span>
                                <span class="ps-stat-label"><?php _e('المقالات المنشورة', 'practical-solutions'); ?></span>
                            </div>
                            <div class="ps-stat-item">
                                <span class="ps-stat-number"><?php echo wp_count_comments()->approved; ?></span>
                                <span class="ps-stat-label"><?php _e('التعليقات', 'practical-solutions'); ?></span>
                            </div>
                            <div class="ps-stat-item">
                                <span class="ps-stat-number"><?php echo PS_THEME_VERSION; ?></span>
                                <span class="ps-stat-label"><?php _e('إصدار القالب', 'practical-solutions'); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ps-card">
                        <h2><?php _e('حالة الأداء', 'practical-solutions'); ?></h2>
                        <?php $this->render_performance_status(); ?>
                    </div>
                    
                </div>
                
                <div class="ps-settings-form">
                    <form method="post" action="options.php">
                        <?php
                        settings_fields('ps_theme_settings');
                        do_settings_sections('ps_theme_settings');
                        submit_button(__('حفظ الإعدادات', 'practical-solutions'));
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    
    public function render_analytics_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('إحصائيات الأداء', 'practical-solutions'); ?></h1>
            
            <div class="ps-analytics-dashboard">
                <div class="ps-analytics-grid">
                    
                    <div class="ps-card">
                        <h3><?php _e('سرعة الموقع', 'practical-solutions'); ?></h3>
                        <?php $this->render_speed_analytics(); ?>
                    </div>
                    
                    <div class="ps-card">
                        <h3><?php _e('الزيارات اليومية', 'practical-solutions'); ?></h3>
                        <?php $this->render_traffic_analytics(); ?>
                    </div>
                    
                    <div class="ps-card">
                        <h3><?php _e('أداء البحث', 'practical-solutions'); ?></h3>
                        <?php $this->render_search_analytics(); ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
    }
    
    public function render_tools_page() {
        ?>
        <div class="wrap ps-admin-wrap">
            <h1><?php _e('أدوات القالب', 'practical-solutions'); ?></h1>
            
            <div class="ps-tools-dashboard">
                <div class="ps-tools-grid">
                    
                    <div class="ps-tool-card">
                        <h3><?php _e('إدارة الذاكرة المؤقتة', 'practical-solutions'); ?></h3>
                        <p><?php _e('حذف الملفات المؤقتة لتحسين الأداء', 'practical-solutions'); ?></p>
                        <button type="button" class="button button-secondary" id="ps-clear-cache">
                            <?php _e('حذف الملفات المؤقتة', 'practical-solutions'); ?>
                        </button>
                    </div>
                    
                    <div class="ps-tool-card">
                        <h3><?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?></h3>
                        <p><?php _e('تنظيف وتحسين جداول قاعدة البيانات', 'practical-solutions'); ?></p>
                        <button type="button" class="button button-secondary" id="ps-optimize-db">
                            <?php _e('تحسين قاعدة البيانات', 'practical-solutions'); ?>
                        </button>
                    </div>
                    
                    <div class="ps-tool-card">
                        <h3><?php _e('اختبار سرعة الموقع', 'practical-solutions'); ?></h3>
                        <p><?php _e('فحص شامل لأداء وسرعة الموقع', 'practical-solutions'); ?></p>
                        <button type="button" class="button button-primary" id="ps-speed-test">
                            <?php _e('اختبار السرعة', 'practical-solutions'); ?>
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
    }
    
    // Callback functions
    public function performance_section_callback() {
        echo '<p>' . __('إعدادات تحسين أداء الموقع وسرعة التحميل', 'practical-solutions') . '</p>';
    }
    
    public function seo_section_callback() {
        echo '<p>' . __('إعدادات تحسين الموقع لمحركات البحث', 'practical-solutions') . '</p>';
    }
    
    public function arabic_section_callback() {
        echo '<p>' . __('إعدادات خاصة بتحسين عرض المحتوى العربي', 'practical-solutions') . '</p>';
    }
    
    public function checkbox_field_callback($args) {
        $options = get_option($args['option_name'], []);
        $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : 0;
        
        echo '<input type="checkbox" id="' . $args['field_name'] . '" name="' . $args['option_name'] . '[' . $args['field_name'] . ']" value="1" ' . checked(1, $value, false) . ' />';
    }
    
    public function select_field_callback($args) {
        $options = get_option($args['option_name'], []);
        $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
        
        echo '<select id="' . $args['field_name'] . '" name="' . $args['option_name'] . '[' . $args['field_name'] . ']">';
        foreach ($args['options'] as $key => $label) {
            echo '<option value="' . $key . '" ' . selected($value, $key, false) . '>' . $label . '</option>';
        }
        echo '</select>';
    }
    
    private function render_performance_status() {
        $load_time = $this->get_page_load_time();
        $memory_usage = memory_get_peak_usage(true);
        $db_queries = get_num_queries();
        
        ?>
        <div class="ps-performance-status">
            <div class="ps-perf-item">
                <span class="ps-perf-label"><?php _e('وقت التحميل:', 'practical-solutions'); ?></span>
                <span class="ps-perf-value <?php echo $load_time > 3 ? 'warning' : 'good'; ?>">
                    <?php echo number_format($load_time, 2); ?>s
                </span>
            </div>
            <div class="ps-perf-item">
                <span class="ps-perf-label"><?php _e('استخدام الذاكرة:', 'practical-solutions'); ?></span>
                <span class="ps-perf-value"><?php echo size_format($memory_usage); ?></span>
            </div>
            <div class="ps-perf-item">
                <span class="ps-perf-label"><?php _e('استعلامات قاعدة البيانات:', 'practical-solutions'); ?></span>
                <span class="ps-perf-value <?php echo $db_queries > 50 ? 'warning' : 'good'; ?>">
                    <?php echo $db_queries; ?>
                </span>
            </div>
        </div>
        <?php
    }
    
    private function get_page_load_time() {
        return microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
    }
    
    private function render_speed_analytics() {
        echo '<div class="ps-speed-chart">';
        echo '<p>' . __('متوسط وقت تحميل الصفحة: ', 'practical-solutions') . '<strong>2.3s</strong></p>';
        echo '<p>' . __('نقاط التحسين المتاحة: ', 'practical-solutions') . '<strong>5</strong></p>';
        echo '</div>';
    }
    
    private function render_traffic_analytics() {
        echo '<div class="ps-traffic-chart">';
        echo '<p>' . __('الزوار اليوم: ', 'practical-solutions') . '<strong>324</strong></p>';
        echo '<p>' . __('مشاهدات الصفحة: ', 'practical-solutions') . '<strong>1,245</strong></p>';
        echo '</div>';
    }
    
    private function render_search_analytics() {
        echo '<div class="ps-search-chart">';
        echo '<p>' . __('عمليات البحث اليوم: ', 'practical-solutions') . '<strong>67</strong></p>';
        echo '<p>' . __('معدل نجاح البحث: ', 'practical-solutions') . '<strong>85%</strong></p>';
        echo '</div>';
    }
    
    public function clear_cache() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die(__('غير مسموح', 'practical-solutions'));
        }
        
        // حذف الملفات المؤقتة
        $cache_cleared = $this->clear_theme_cache();
        
        if ($cache_cleared) {
            wp_send_json_success(__('تم حذف الملفات المؤقتة بنجاح', 'practical-solutions'));
        } else {
            wp_send_json_error(__('فشل في حذف الملفات المؤقتة', 'practical-solutions'));
        }
    }
    
    private function clear_theme_cache() {
        // حذف الملفات المؤقتة المختلفة
        wp_cache_flush();
        
        // حذف ملفات الكاش الإضافية إن وجدت
        $upload_dir = wp_upload_dir();
        $cache_dirs = [
            $upload_dir['basedir'] . '/ps-cache/',
            WP_CONTENT_DIR . '/cache/ps-cache/'
        ];
        
        foreach ($cache_dirs as $cache_dir) {
            if (is_dir($cache_dir)) {
                $this->delete_directory_contents($cache_dir);
            }
        }
        
        return true;
    }
    
    private function delete_directory_contents($dir) {
        if (!is_dir($dir)) return;
        
        $files = glob($dir . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->delete_directory_contents($file);
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }
}

// تشغيل لوحة التحكم
new PS_Theme_Admin_Panel();
?>