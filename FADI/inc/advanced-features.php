<?php
/**
 * الميزات المتقدمة والتكامل مع الخدمات الخارجية
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة الميزات المتقدمة
 */
class FADI_Advanced_Features {
    
    public function __construct() {
        add_action('init', array($this, 'init_advanced_features'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_advanced_scripts'));
        add_action('admin_menu', array($this, 'add_advanced_menu'));
    }
    
    /**
     * تهيئة الميزات المتقدمة
     */
    public function init_advanced_features() {
        // تفعيل REST API المخصص
        $this->setup_custom_rest_api();
        
        // تهيئة نظام الإشعارات المتقدم
        $this->setup_advanced_notifications();
        
        // تهيئة نظام التقارير التلقائية
        $this->setup_automated_reports();
        
        // تهيئة نظام النسخ الاحتياطي الذكي
        $this->setup_smart_backup();
        
        // تهيئة مراقبة الأداء
        $this->setup_performance_monitoring();
    }
    
    /**
     * إعداد REST API مخصص
     */
    public function setup_custom_rest_api() {
        add_action('rest_api_init', function() {
            // نقطة نهاية للإحصائيات
            register_rest_route('fadi/v1', '/stats', array(
                'methods' => 'GET',
                'callback' => array($this, 'api_get_stats'),
                'permission_callback' => array($this, 'api_permission_check')
            ));
            
            // نقطة نهاية للبحث
            register_rest_route('fadi/v1', '/search', array(
                'methods' => 'GET',
                'callback' => array($this, 'api_search'),
                'permission_callback' => array($this, 'api_permission_check'),
                'args' => array(
                    'query' => array(
                        'required' => true,
                        'type' => 'string'
                    )
                )
            ));
            
            // نقطة نهاية للتقارير
            register_rest_route('fadi/v1', '/reports/(?P<type>[a-zA-Z0-9-]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'api_get_report'),
                'permission_callback' => array($this, 'api_permission_check')
            ));
            
            // نقطة نهاية للإشعارات
            register_rest_route('fadi/v1', '/notifications', array(
                'methods' => 'GET',
                'callback' => array($this, 'api_get_notifications'),
                'permission_callback' => array($this, 'api_permission_check')
            ));
        });
    }
    
    /**
     * فحص صلاحيات API
     */
    public function api_permission_check() {
        return current_user_can('manage_options');
    }
    
    /**
     * API للحصول على الإحصائيات
     */
    public function api_get_stats($request) {
        $stats = get_option('fadi_live_statistics', array());
        
        return rest_ensure_response(array(
            'success' => true,
            'data' => $stats,
            'timestamp' => current_time('c')
        ));
    }
    
    /**
     * API للبحث
     */
    public function api_search($request) {
        $query = sanitize_text_field($request->get_param('query'));
        $results = array();
        
        // البحث في أنواع المحتوى المختلفة
        $post_types = array('quote', 'supplier', 'employee', 'tender', 'document');
        
        foreach ($post_types as $post_type) {
            $posts = get_posts(array(
                'post_type' => $post_type,
                's' => $query,
                'numberposts' => 5,
                'post_status' => 'publish'
            ));
            
            foreach ($posts as $post) {
                $results[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'type' => $post_type,
                    'date' => $post->post_date,
                    'excerpt' => get_the_excerpt($post),
                    'url' => get_permalink($post),
                    'edit_url' => get_edit_post_link($post, 'raw')
                );
            }
        }
        
        return rest_ensure_response(array(
            'success' => true,
            'data' => $results,
            'query' => $query,
            'total' => count($results)
        ));
    }
    
    /**
     * API للحصول على التقارير
     */
    public function api_get_report($request) {
        $type = $request->get_param('type');
        $data = array();
        
        switch ($type) {
            case 'quotes':
                $data = $this->generate_quotes_report();
                break;
            case 'financial':
                $data = $this->generate_financial_report();
                break;
            case 'performance':
                $data = $this->generate_performance_report();
                break;
            default:
                return new WP_Error('invalid_report_type', 'نوع التقرير غير صالح', array('status' => 400));
        }
        
        return rest_ensure_response(array(
            'success' => true,
            'type' => $type,
            'data' => $data,
            'generated_at' => current_time('c')
        ));
    }
    
    /**
     * API للحصول على الإشعارات
     */
    public function api_get_notifications($request) {
        $notifications = array();
        
        // فحص الوثائق المنتهية الصلاحية
        $expiring_docs = get_posts(array(
            'post_type' => 'document',
            'meta_query' => array(
                array(
                    'key' => 'expiry_date',
                    'value' => date('Y-m-d', strtotime('+30 days')),
                    'compare' => '<=',
                    'type' => 'DATE'
                )
            ),
            'numberposts' => 5
        ));
        
        foreach ($expiring_docs as $doc) {
            $notifications[] = array(
                'type' => 'warning',
                'title' => 'وثيقة ستنتهي قريباً',
                'message' => sprintf('الوثيقة "%s" ستنتهي صلاحيتها قريباً', $doc->post_title),
                'date' => current_time('c'),
                'action_url' => get_edit_post_link($doc->ID, 'raw')
            );
        }
        
        // فحص المناقصات القريبة
        $upcoming_tenders = get_posts(array(
            'post_type' => 'tender',
            'meta_query' => array(
                array(
                    'key' => 'tender_deadline',
                    'value' => date('Y-m-d H:i:s', strtotime('+7 days')),
                    'compare' => '<=',
                    'type' => 'DATETIME'
                )
            ),
            'numberposts' => 5
        ));
        
        foreach ($upcoming_tenders as $tender) {
            $notifications[] = array(
                'type' => 'info',
                'title' => 'مناقصة تقترب من الموعد النهائي',
                'message' => sprintf('المناقصة "%s" موعدها النهائي قريب', $tender->post_title),
                'date' => current_time('c'),
                'action_url' => get_edit_post_link($tender->ID, 'raw')
            );
        }
        
        return rest_ensure_response(array(
            'success' => true,
            'data' => $notifications,
            'count' => count($notifications)
        ));
    }
    
    /**
     * تهيئة نظام الإشعارات المتقدم
     */
    public function setup_advanced_notifications() {
        // إضافة خطاف للإشعارات المخصصة
        add_action('fadi_send_notification', array($this, 'send_custom_notification'), 10, 3);
        
        // تهيئة قنوات الإشعارات المختلفة
        $this->setup_notification_channels();
    }
    
    /**
     * إعداد قنوات الإشعارات
     */
    public function setup_notification_channels() {
        // إشعارات البريد الإلكتروني
        add_action('fadi_email_notification', array($this, 'send_email_notification'), 10, 2);
        
        // إشعارات داخل النظام
        add_action('fadi_system_notification', array($this, 'add_system_notification'), 10, 2);
        
        // إشعارات Slack (إذا تم تكوينه)
        if (get_option('fadi_slack_webhook')) {
            add_action('fadi_slack_notification', array($this, 'send_slack_notification'), 10, 2);
        }
    }
    
    /**
     * إرسال إشعار مخصص
     */
    public function send_custom_notification($type, $message, $data = array()) {
        $notification = array(
            'type' => $type,
            'message' => $message,
            'data' => $data,
            'timestamp' => current_time('timestamp'),
            'user_id' => get_current_user_id()
        );
        
        // حفظ الإشعار في قاعدة البيانات
        $this->save_notification($notification);
        
        // إرسال عبر القنوات المختلفة
        do_action('fadi_email_notification', $message, $data);
        do_action('fadi_system_notification', $message, $data);
        
        if (get_option('fadi_slack_webhook')) {
            do_action('fadi_slack_notification', $message, $data);
        }
    }
    
    /**
     * حفظ الإشعار في قاعدة البيانات
     */
    public function save_notification($notification) {
        global $wpdb;
        
        $table = $wpdb->prefix . 'fadi_activities';
        
        $wpdb->insert(
            $table,
            array(
                'user_id' => $notification['user_id'],
                'activity_type' => 'notification',
                'activity_action' => $notification['type'],
                'activity_date' => date('Y-m-d H:i:s', $notification['timestamp']),
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
            ),
            array('%d', '%s', '%s', '%s', '%s', '%s')
        );
    }
    
    /**
     * تهيئة التقارير التلقائية
     */
    public function setup_automated_reports() {
        // إضافة خطاف للتقارير المخصصة
        add_action('fadi_generate_custom_report', array($this, 'generate_custom_report'), 10, 2);
        
        // جدولة التقارير التلقائية
        if (!wp_next_scheduled('fadi_auto_report_daily')) {
            wp_schedule_event(time(), 'daily', 'fadi_auto_report_daily');
        }
        
        add_action('fadi_auto_report_daily', array($this, 'generate_daily_report'));
    }
    
    /**
     * إنشاء تقرير يومي تلقائي
     */
    public function generate_daily_report() {
        $stats = array(
            'date' => current_time('Y-m-d'),
            'quotes_today' => $this->count_today_posts('quote'),
            'revenue_today' => $this->calculate_today_revenue(),
            'active_tenders' => $this->count_active_tenders(),
            'expiring_docs' => $this->count_expiring_documents()
        );
        
        // حفظ التقرير
        update_option('fadi_daily_report_' . current_time('Y-m-d'), $stats);
        
        // إرسال تنبيه إذا كان هناك أمور تحتاج انتباه
        if ($stats['expiring_docs'] > 0 || $stats['active_tenders'] > 0) {
            $this->send_daily_alert($stats);
        }
    }
    
    /**
     * تهيئة النسخ الاحتياطي الذكي
     */
    public function setup_smart_backup() {
        add_action('fadi_smart_backup', array($this, 'perform_smart_backup'));
        
        // جدولة النسخ الاحتياطي حسب النشاط
        add_action('save_post', array($this, 'schedule_incremental_backup'), 10, 2);
    }
    
    /**
     * تنفيذ نسخ احتياطي ذكي
     */
    public function perform_smart_backup() {
        // تحديد نوع النسخة الاحتياطية حسب التغييرات
        $last_backup = get_option('fadi_last_smart_backup', 0);
        $changes_since = $this->count_changes_since($last_backup);
        
        if ($changes_since > 50) {
            // نسخة احتياطية كاملة
            $result = fadi_perform_backup('full');
        } elseif ($changes_since > 10) {
            // نسخة احتياطية للبيانات فقط
            $result = fadi_perform_backup('database');
        } else {
            // لا حاجة للنسخ الاحتياطي
            return;
        }
        
        if ($result['success']) {
            update_option('fadi_last_smart_backup', time());
            
            // إشعار بنجاح العملية
            $this->send_custom_notification(
                'backup_success',
                sprintf('تم إنشاء نسخة احتياطية ذكية بنجاح (%s)', $result['file'])
            );
        }
    }
    
    /**
     * تهيئة مراقبة الأداء
     */
    public function setup_performance_monitoring() {
        add_action('wp_footer', array($this, 'collect_performance_metrics'));
        add_action('admin_footer', array($this, 'collect_admin_performance_metrics'));
    }
    
    /**
     * جمع مقاييس الأداء
     */
    public function collect_performance_metrics() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        $metrics = array(
            'page_load_time' => timer_stop(0, 3),
            'memory_usage' => memory_get_peak_usage(true),
            'query_count' => get_num_queries(),
            'timestamp' => current_time('timestamp'),
            'page_url' => $_SERVER['REQUEST_URI'] ?? ''
        );
        
        // حفظ المقاييس
        $this->save_performance_metrics($metrics);
        
        // تنبيه إذا كان الأداء بطيء
        if ($metrics['page_load_time'] > 3 || $metrics['query_count'] > 50) {
            $this->send_performance_alert($metrics);
        }
    }
    
    /**
     * حفظ مقاييس الأداء
     */
    public function save_performance_metrics($metrics) {
        $existing_metrics = get_option('fadi_performance_metrics', array());
        $existing_metrics[] = $metrics;
        
        // الاحتفاظ بآخر 100 قياس فقط
        if (count($existing_metrics) > 100) {
            $existing_metrics = array_slice($existing_metrics, -100);
        }
        
        update_option('fadi_performance_metrics', $existing_metrics);
    }
    
    /**
     * تحميل السكريبتات المتقدمة
     */
    public function enqueue_advanced_scripts() {
        if (is_user_logged_in()) {
            wp_enqueue_script(
                'fadi-advanced',
                get_template_directory_uri() . '/src/js/advanced-features.js',
                array('jquery', 'fadi-main'),
                '1.0',
                true
            );
            
            wp_localize_script('fadi-advanced', 'fadi_advanced', array(
                'rest_url' => rest_url('fadi/v1/'),
                'nonce' => wp_create_nonce('wp_rest'),
                'user_id' => get_current_user_id()
            ));
        }
    }
    
    /**
     * إضافة قائمة الميزات المتقدمة
     */
    public function add_advanced_menu() {
        add_submenu_page(
            'fadi-dashboard',
            __('الميزات المتقدمة', 'fadi'),
            __('الميزات المتقدمة', 'fadi'),
            'manage_options',
            'fadi-advanced',
            array($this, 'advanced_features_page')
        );
    }
    
    /**
     * صفحة الميزات المتقدمة
     */
    public function advanced_features_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('الميزات المتقدمة', 'fadi'); ?></h1>
            
            <div class="fadi-advanced-features">
                <div class="fadi-feature-card">
                    <h2><?php _e('API المخصص', 'fadi'); ?></h2>
                    <p><?php _e('الوصول لبيانات النظام عبر REST API', 'fadi'); ?></p>
                    <p><strong><?php _e('نقطة النهاية:', 'fadi'); ?></strong> <code><?php echo rest_url('fadi/v1/'); ?></code></p>
                </div>
                
                <div class="fadi-feature-card">
                    <h2><?php _e('مراقبة الأداء', 'fadi'); ?></h2>
                    <p><?php _e('مراقبة أداء النظام وتحليل الاستخدام', 'fadi'); ?></p>
                    <?php $metrics = get_option('fadi_performance_metrics', array()); ?>
                    <p><strong><?php _e('المقاييس المحفوظة:', 'fadi'); ?></strong> <?php echo count($metrics); ?></p>
                </div>
                
                <div class="fadi-feature-card">
                    <h2><?php _e('النسخ الاحتياطي الذكي', 'fadi'); ?></h2>
                    <p><?php _e('نسخ احتياطية تلقائية حسب النشاط', 'fadi'); ?></p>
                    <?php $last_backup = get_option('fadi_last_smart_backup', 0); ?>
                    <p><strong><?php _e('آخر نسخة احتياطية:', 'fadi'); ?></strong> 
                        <?php echo $last_backup ? date_i18n('Y-m-d H:i', $last_backup) : __('لم يتم', 'fadi'); ?>
                    </p>
                </div>
                
                <div class="fadi-feature-card">
                    <h2><?php _e('التقارير التلقائية', 'fadi'); ?></h2>
                    <p><?php _e('تقارير يومية وإشعارات ذكية', 'fadi'); ?></p>
                    <?php $daily_report = get_option('fadi_daily_report_' . current_time('Y-m-d')); ?>
                    <p><strong><?php _e('تقرير اليوم:', 'fadi'); ?></strong> 
                        <?php echo $daily_report ? __('متوفر', 'fadi') : __('لم يتم إنشاؤه بعد', 'fadi'); ?>
                    </p>
                </div>
            </div>
        </div>
        
        <style>
        .fadi-advanced-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .fadi-feature-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #ccd0d4;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .fadi-feature-card h2 {
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .fadi-feature-card p {
            margin-bottom: 10px;
            color: #666;
        }
        
        .fadi-feature-card code {
            background: #f1f1f1;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        </style>
        <?php
    }
    
    // وظائف مساعدة
    private function count_today_posts($post_type) {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(*) FROM {$wpdb->posts} 
            WHERE post_type = %s 
            AND post_status = 'publish' 
            AND DATE(post_date) = %s
        ", $post_type, current_time('Y-m-d')));
    }
    
    private function calculate_today_revenue() {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare("
            SELECT SUM(CAST(pm.meta_value AS DECIMAL(10,2))) 
            FROM {$wpdb->postmeta} pm 
            JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
            WHERE pm.meta_key = 'total_amount' 
            AND p.post_type = 'quote' 
            AND DATE(p.post_date) = %s
        ", current_time('Y-m-d'))) ?: 0;
    }
    
    private function count_active_tenders() {
        return count(get_posts(array(
            'post_type' => 'tender',
            'meta_query' => array(
                array(
                    'key' => 'tender_deadline',
                    'value' => current_time('Y-m-d'),
                    'compare' => '>=',
                    'type' => 'DATE'
                )
            ),
            'numberposts' => -1,
            'fields' => 'ids'
        )));
    }
    
    private function count_expiring_documents() {
        return count(get_posts(array(
            'post_type' => 'document',
            'meta_query' => array(
                array(
                    'key' => 'expiry_date',
                    'value' => date('Y-m-d', strtotime('+30 days')),
                    'compare' => '<=',
                    'type' => 'DATE'
                )
            ),
            'numberposts' => -1,
            'fields' => 'ids'
        )));
    }
    
    private function count_changes_since($timestamp) {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(*) FROM {$wpdb->posts} 
            WHERE post_modified_gmt > %s 
            AND post_type IN ('quote', 'supplier', 'employee', 'tender', 'document')
        ", date('Y-m-d H:i:s', $timestamp)));
    }
}

// تهيئة الميزات المتقدمة
new FADI_Advanced_Features();