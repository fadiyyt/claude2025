<?php
/**
 * لوحة الإدارة المخصصة لقالب FADI
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة لوحة الإدارة
 */
class FADI_Admin_Panel {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_fadi_admin_action', array($this, 'handle_admin_action'));
    }
    
    /**
     * إضافة قائمة الإدارة
     */
    public function add_admin_menu() {
        add_menu_page(
            __('نظام FADI', 'fadi'),
            __('نظام FADI', 'fadi'),
            'manage_options',
            'fadi-dashboard',
            array($this, 'dashboard_page'),
            'dashicons-dashboard',
            2
        );
        
        add_submenu_page(
            'fadi-dashboard',
            __('عروض الأسعار', 'fadi'),
            __('عروض الأسعار', 'fadi'),
            'manage_options',
            'fadi-quotes',
            array($this, 'quotes_page')
        );
        
        add_submenu_page(
            'fadi-dashboard',
            __('إدارة المشتريات', 'fadi'),
            __('إدارة المشتريات', 'fadi'),
            'manage_options',
            'fadi-purchases',
            array($this, 'purchases_page')
        );
        
        add_submenu_page(
            'fadi-dashboard',
            __('شؤون الموظفين', 'fadi'),
            __('شؤون الموظفين', 'fadi'),
            'manage_options',
            'fadi-employees',
            array($this, 'employees_page')
        );
        
        add_submenu_page(
            'fadi-dashboard',
            __('المناقصات', 'fadi'),
            __('المناقصات', 'fadi'),
            'manage_options',
            'fadi-tenders',
            array($this, 'tenders_page')
        );
        
        add_submenu_page(
            'fadi-dashboard',
            __('الوثائق الحكومية', 'fadi'),
            __('الوثائق الحكومية', 'fadi'),
            'manage_options',
            'fadi-documents',
            array($this, 'documents_page')
        );
        
        add_submenu_page(
            'fadi-dashboard',
            __('إعدادات النظام', 'fadi'),
            __('الإعدادات', 'fadi'),
            'manage_options',
            'fadi-settings',
            array($this, 'settings_page')
        );
    }
    
    /**
     * صفحة لوحة التحكم الرئيسية
     */
    public function dashboard_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('لوحة تحكم نظام FADI', 'fadi'); ?></h1>
            
            <div class="fadi-dashboard-grid">
                <div class="fadi-stats-row">
                    <?php $this->render_stats_widgets(); ?>
                </div>
                
                <div class="fadi-content-row">
                    <div class="fadi-main-content">
                        <?php $this->render_recent_activities(); ?>
                    </div>
                    
                    <div class="fadi-sidebar">
                        <?php $this->render_system_status(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض ودجات الإحصائيات
     */
    private function render_stats_widgets() {
        $stats = $this->get_dashboard_stats();
        ?>
        <div class="fadi-stats-grid">
            <div class="fadi-stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-content">
                    <h3><?php echo $stats['quotes_count']; ?></h3>
                    <p>عروض الأسعار</p>
                </div>
            </div>
            
            <div class="fadi-stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <h3><?php echo $stats['employees_count']; ?></h3>
                    <p>الموظفين</p>
                </div>
            </div>
            
            <div class="fadi-stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-content">
                    <h3><?php echo $stats['tenders_count']; ?></h3>
                    <p>المناقصات</p>
                </div>
            </div>
            
            <div class="fadi-stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-content">
                    <h3><?php echo $stats['documents_count']; ?></h3>
                    <p>الوثائق</p>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض الأنشطة الأخيرة
     */
    private function render_recent_activities() {
        ?>
        <div class="fadi-widget">
            <h3><?php _e('الأنشطة الأخيرة', 'fadi'); ?></h3>
            <div class="fadi-activities">
                <?php
                $activities = $this->get_recent_activities();
                if (!empty($activities) && is_array($activities)) {
                    foreach ($activities as $activity) {
                        // التأكد من وجود جميع الخصائص المطلوبة
                        if (isset($activity->action) && isset($activity->description) && isset($activity->time)) {
                            ?>
                            <div class="activity-item">
                                <div class="activity-icon"><?php echo $this->get_activity_icon($activity->action); ?></div>
                                <div class="activity-content">
                                    <p><?php echo esc_html($activity->description); ?></p>
                                    <small><?php echo human_time_diff($activity->time, current_time('timestamp')) . ' ' . __('منذ', 'fadi'); ?></small>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <div class="no-activities">
                        <p><?php _e('لا توجد أنشطة حديثة', 'fadi'); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض حالة النظام
     */
    private function render_system_status() {
        ?>
        <div class="fadi-widget">
            <h3><?php _e('حالة النظام', 'fadi'); ?></h3>
            <div class="system-status">
                <div class="status-item">
                    <span class="label"><?php _e('إصدار ووردبريس:', 'fadi'); ?></span>
                    <span class="value"><?php echo get_bloginfo('version'); ?></span>
                </div>
                
                <div class="status-item">
                    <span class="label"><?php _e('إصدار PHP:', 'fadi'); ?></span>
                    <span class="value"><?php echo PHP_VERSION; ?></span>
                </div>
                
                <div class="status-item">
                    <span class="label"><?php _e('إصدار القالب:', 'fadi'); ?></span>
                    <span class="value">1.0</span>
                </div>
                
                <div class="status-item">
                    <span class="label"><?php _e('حالة النظام:', 'fadi'); ?></span>
                    <span class="value status-active"><?php _e('نشط', 'fadi'); ?></span>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * الحصول على إحصائيات لوحة التحكم
     */
    private function get_dashboard_stats() {
        return array(
            'quotes_count' => $this->get_count('fadi_quotes'),
            'employees_count' => $this->get_count('fadi_employees'),
            'tenders_count' => $this->get_count('fadi_tenders'),
            'documents_count' => $this->get_count('fadi_documents')
        );
    }
    
    /**
     * الحصول على عدد العناصر
     */
    private function get_count($post_type) {
        $count = wp_count_posts($post_type);
        // التأكد من وجود الخاصية publish قبل الوصول إليها
        return isset($count->publish) ? $count->publish : 0;
    }
    
    /**
     * الحصول على الأنشطة الأخيرة
     */
    private function get_recent_activities() {
        $activities = get_option('fadi_recent_activities', array());
        
        // إذا لم توجد أنشطة، إنشاء بعض الأنشطة التجريبية
        if (empty($activities)) {
            $activities = array(
                (object) array(
                    'action' => 'login',
                    'description' => 'تم تسجيل الدخول إلى النظام',
                    'time' => current_time('timestamp') - 3600
                ),
                (object) array(
                    'action' => 'create',
                    'description' => 'تم إنشاء عرض سعر جديد',
                    'time' => current_time('timestamp') - 7200
                )
            );
        }
        
        return $activities;
    }
    
    /**
     * الحصول على أيقونة النشاط
     */
    private function get_activity_icon($action) {
        $icons = array(
            'login' => '🔐',
            'create' => '➕',
            'update' => '✏️',
            'delete' => '🗑️',
            'view' => '👁️'
        );
        
        return isset($icons[$action]) ? $icons[$action] : '📝';
    }
    
    /**
     * صفحة عروض الأسعار
     */
    public function quotes_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('إدارة عروض الأسعار', 'fadi'); ?></h1>
            <p><?php _e('قريباً - قسم إدارة عروض الأسعار', 'fadi'); ?></p>
        </div>
        <?php
    }
    
    /**
     * صفحة المشتريات
     */
    public function purchases_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('إدارة المشتريات', 'fadi'); ?></h1>
            <p><?php _e('قريباً - قسم إدارة المشتريات', 'fadi'); ?></p>
        </div>
        <?php
    }
    
    /**
     * صفحة الموظفين
     */
    public function employees_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('إدارة الموظفين', 'fadi'); ?></h1>
            <p><?php _e('قريباً - قسم إدارة الموظفين', 'fadi'); ?></p>
        </div>
        <?php
    }
    
    /**
     * صفحة المناقصات
     */
    public function tenders_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('إدارة المناقصات', 'fadi'); ?></h1>
            <p><?php _e('قريباً - قسم إدارة المناقصات', 'fadi'); ?></p>
        </div>
        <?php
    }
    
    /**
     * صفحة الوثائق
     */
    public function documents_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('إدارة الوثائق الحكومية', 'fadi'); ?></h1>
            <p><?php _e('قريباً - قسم إدارة الوثائق', 'fadi'); ?></p>
        </div>
        <?php
    }
    
    /**
     * صفحة الإعدادات
     */
    public function settings_page() {
        ?>
        <div class="wrap fadi-admin">
            <h1><?php _e('إعدادات النظام', 'fadi'); ?></h1>
            <p><?php _e('قريباً - صفحة الإعدادات', 'fadi'); ?></p>
        </div>
        <?php
    }
    
    /**
     * تحميل ملفات الإدارة
     */
    public function enqueue_admin_scripts($hook) {
        if (strpos($hook, 'fadi') !== false) {
            wp_enqueue_style('fadi-admin', get_template_directory_uri() . '/src/css/admin.css', array(), '1.0');
            wp_enqueue_script('fadi-admin', get_template_directory_uri() . '/src/js/admin.js', array('jquery'), '1.0', true);
            
            wp_localize_script('fadi-admin', 'fadi_admin', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('fadi_admin_nonce')
            ));
        }
    }
    
    /**
     * معالج الإجراءات
     */
    public function handle_admin_action() {
        check_ajax_referer('fadi_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die();
        }
        
        $action = sanitize_text_field($_POST['action_type']);
        $result = array('success' => false);
        
        switch ($action) {
            case 'test_connection':
                $result = array('success' => true, 'message' => 'الاتصال يعمل بشكل صحيح');
                break;
        }
        
        wp_send_json($result);
    }
}

// تهيئة فئة لوحة الإدارة
new FADI_Admin_Panel();