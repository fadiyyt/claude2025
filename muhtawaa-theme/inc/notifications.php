<?php
/**
 * نظام الإشعارات المحسن لقالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

/**
 * فئة نظام الإشعارات المحسن
 */
class MuhtawaaNotifications {
    
    /**
     * مثيل واحد من الفئة
     */
    private static $instance = null;
    
    /**
     * جدول قاعدة البيانات للإشعارات
     */
    private $table_name;
    
    /**
     * أنواع الإشعارات المتاحة
     */
    private $notification_types = array(
        'comment' => 'تعليق جديد',
        'rating' => 'تقييم جديد', 
        'solution_update' => 'تحديث الحل',
        'system' => 'إشعار النظام',
        'user_action' => 'إجراء المستخدم',
        'admin' => 'إشعار الإدارة'
    );
    
    /**
     * الحصول على المثيل الوحيد
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * منشئ الفئة
     */
    private function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'muhtawaa_notifications';
        
        // إعداد الخطافات
        add_action('init', array($this, 'init_hooks'));
        add_action('wp_ajax_muhtawaa_mark_notification_read', array($this, 'mark_notification_read'));
        add_action('wp_ajax_muhtawaa_get_notifications', array($this, 'get_user_notifications'));
        add_action('wp_ajax_muhtawaa_clear_all_notifications', array($this, 'clear_all_notifications'));
        
        // خطافات إنشاء الإشعارات التلقائية
        add_action('comment_post', array($this, 'create_comment_notification'), 10, 3);
        add_action('muhtawaa_rating_added', array($this, 'create_rating_notification'), 10, 3);
        add_action('muhtawaa_solution_updated', array($this, 'create_solution_update_notification'), 10, 2);
        
        // إنشاء الجدول عند التفعيل
        register_activation_hook(__FILE__, array($this, 'create_notifications_table'));
    }
    
    /**
     * تهيئة الخطافات
     */
    public function init_hooks() {
        // إضافة أنماط CSS للإشعارات
        add_action('wp_enqueue_scripts', array($this, 'enqueue_notification_assets'));
        
        // إضافة الإشعارات لشريط الإدارة
        add_action('admin_bar_menu', array($this, 'add_notifications_to_admin_bar'), 100);
        
        // إضافة أيقونة الإشعارات في الواجهة الأمامية
        add_action('wp_footer', array($this, 'add_notification_icon'));
    }
    
    /**
     * إنشاء جدول الإشعارات
     */
    public function create_notifications_table() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE {$this->table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NOT NULL,
            type varchar(50) NOT NULL,
            title varchar(255) NOT NULL,
            content text NOT NULL,
            action_url varchar(500) DEFAULT '',
            is_read tinyint(1) DEFAULT 0,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            read_at datetime NULL,
            priority enum('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
            expire_at datetime NULL,
            meta_data longtext,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY type (type),
            KEY is_read (is_read),
            KEY created_at (created_at),
            KEY priority (priority)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * إنشاء إشعار جديد
     */
    public function create_notification($user_id, $type, $title, $content, $args = array()) {
        global $wpdb;
        
        // التحقق من صحة البيانات
        if (empty($user_id) || empty($type) || empty($title) || empty($content)) {
            return false;
        }
        
        // الإعدادات الافتراضية
        $defaults = array(
            'action_url' => '',
            'priority' => 'medium',
            'expire_at' => null,
            'meta_data' => array()
        );
        
        $args = wp_parse_args($args, $defaults);
        
        // إدخال الإشعار في قاعدة البيانات
        $result = $wpdb->insert(
            $this->table_name,
            array(
                'user_id' => intval($user_id),
                'type' => sanitize_text_field($type),
                'title' => sanitize_text_field($title),
                'content' => wp_kses_post($content),
                'action_url' => esc_url_raw($args['action_url']),
                'priority' => sanitize_text_field($args['priority']),
                'expire_at' => $args['expire_at'],
                'meta_data' => json_encode($args['meta_data']),
                'created_at' => current_time('mysql')
            ),
            array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );
        
        if ($result) {
            $notification_id = $wpdb->insert_id;
            
            // تشغيل إجراء مخصص بعد إنشاء الإشعار
            do_action('muhtawaa_notification_created', $notification_id, $user_id, $type, $args);
            
            // إرسال إشعار فوري إذا كان المستخدم متصل
            $this->send_real_time_notification($user_id, array(
                'id' => $notification_id,
                'type' => $type,
                'title' => $title,
                'content' => $content,
                'priority' => $args['priority']
            ));
            
            return $notification_id;
        }
        
        return false;
    }
    
    /**
     * الحصول على إشعارات المستخدم
     */
    public function get_notifications($user_id, $limit = 10, $unread_only = false) {
        global $wpdb;
        
        $where_clause = "WHERE user_id = %d";
        $values = array($user_id);
        
        // إضافة شرط الإشعارات غير المقروءة فقط
        if ($unread_only) {
            $where_clause .= " AND is_read = 0";
        }
        
        // إضافة شرط انتهاء الصلاحية
        $where_clause .= " AND (expire_at IS NULL OR expire_at > NOW())";
        
        $sql = $wpdb->prepare(
            "SELECT * FROM {$this->table_name} 
            {$where_clause} 
            ORDER BY priority = 'urgent' DESC, priority = 'high' DESC, created_at DESC 
            LIMIT %d",
            array_merge($values, array($limit))
        );
        
        return $wpdb->get_results($sql);
    }
    
    /**
     * عدد الإشعارات غير المقروءة
     */
    public function get_unread_count($user_id) {
        global $wpdb;
        
        return $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$this->table_name} 
            WHERE user_id = %d AND is_read = 0 
            AND (expire_at IS NULL OR expire_at > NOW())",
            $user_id
        ));
    }
    
    /**
     * تحديد إشعار كمقروء
     */
    public function mark_notification_read() {
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_notifications_nonce')) {
            wp_die(__('خطأ في التحقق من الأمان', 'muhtawaa'));
        }
        
        $notification_id = intval($_POST['notification_id']);
        $user_id = get_current_user_id();
        
        global $wpdb;
        
        $result = $wpdb->update(
            $this->table_name,
            array(
                'is_read' => 1,
                'read_at' => current_time('mysql')
            ),
            array(
                'id' => $notification_id,
                'user_id' => $user_id
            ),
            array('%d', '%s'),
            array('%d', '%d')
        );
        
        if ($result) {
            wp_send_json_success(array(
                'message' => __('تم تحديد الإشعار كمقروء', 'muhtawaa')
            ));
        } else {
            wp_send_json_error(array(
                'message' => __('فشل في تحديث الإشعار', 'muhtawaa')
            ));
        }
    }
    
    /**
     * مسح جميع الإشعارات
     */
    public function clear_all_notifications() {
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_notifications_nonce')) {
            wp_die(__('خطأ في التحقق من الأمان', 'muhtawaa'));
        }
        
        $user_id = get_current_user_id();
        
        global $wpdb;
        
        $result = $wpdb->update(
            $this->table_name,
            array('is_read' => 1, 'read_at' => current_time('mysql')),
            array('user_id' => $user_id, 'is_read' => 0),
            array('%d', '%s'),
            array('%d', '%d')
        );
        
        wp_send_json_success(array(
            'message' => __('تم مسح جميع الإشعارات', 'muhtawaa')
        ));
    }
    
    /**
     * إنشاء إشعار تعليق جديد
     */
    public function create_comment_notification($comment_id, $comment_approved, $commentdata) {
        if ($comment_approved !== 1) {
            return; // تجاهل التعليقات غير المعتمدة
        }
        
        $comment = get_comment($comment_id);
        $post = get_post($comment->comment_post_ID);
        
        // إشعار كاتب المقال
        if ($post->post_author != $comment->user_id) {
            $this->create_notification(
                $post->post_author,
                'comment',
                __('تعليق جديد على مقالك', 'muhtawaa'),
                sprintf(
                    __('علق %s على مقالك "%s"', 'muhtawaa'),
                    $comment->comment_author,
                    $post->post_title
                ),
                array(
                    'action_url' => get_comment_link($comment_id),
                    'priority' => 'medium',
                    'meta_data' => array(
                        'comment_id' => $comment_id,
                        'post_id' => $post->ID
                    )
                )
            );
        }
    }
    
    /**
     * إنشاء إشعار تقييم جديد
     */
    public function create_rating_notification($post_id, $rating, $user_id) {
        $post = get_post($post_id);
        
        if ($post->post_author != $user_id) {
            $stars = str_repeat('⭐', $rating);
            
            $this->create_notification(
                $post->post_author,
                'rating',
                __('تقييم جديد لحلك', 'muhtawaa'),
                sprintf(
                    __('تم تقييم حلك "%s" بـ %s', 'muhtawaa'),
                    $post->post_title,
                    $stars
                ),
                array(
                    'action_url' => get_permalink($post_id),
                    'priority' => 'medium',
                    'meta_data' => array(
                        'post_id' => $post_id,
                        'rating' => $rating
                    )
                )
            );
        }
    }
    
    /**
     * تحميل ملفات CSS و JS للإشعارات
     */
    public function enqueue_notification_assets() {
        wp_enqueue_style(
            'muhtawaa-notifications',
            get_template_directory_uri() . '/assets/css/notifications.css',
            array(),
            THEME_VERSION
        );
        
        wp_enqueue_script(
            'muhtawaa-notifications',
            get_template_directory_uri() . '/assets/js/notifications.js',
            array('jquery'),
            THEME_VERSION,
            true
        );
        
        // تمرير البيانات لـ JavaScript
        wp_localize_script('muhtawaa-notifications', 'muhtawaaNotifications', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_notifications_nonce'),
            'strings' => array(
                'mark_read' => __('تحديد كمقروء', 'muhtawaa'),
                'clear_all' => __('مسح الكل', 'muhtawaa'),
                'no_notifications' => __('لا توجد إشعارات', 'muhtawaa'),
                'loading' => __('جاري التحميل...', 'muhtawaa')
            )
        ));
    }
    
    /**
     * إضافة أيقونة الإشعارات
     */
    public function add_notification_icon() {
        if (!is_user_logged_in()) {
            return;
        }
        
        $user_id = get_current_user_id();
        $unread_count = $this->get_unread_count($user_id);
        
        ?>
        <div id="muhtawaa-notifications-icon" class="muhtawaa-notifications-wrapper">
            <button class="notifications-toggle" aria-label="<?php _e('الإشعارات', 'muhtawaa'); ?>">
                <i class="fas fa-bell"></i>
                <?php if ($unread_count > 0): ?>
                    <span class="notification-count"><?php echo $unread_count; ?></span>
                <?php endif; ?>
            </button>
            
            <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3><?php _e('الإشعارات', 'muhtawaa'); ?></h3>
                    <?php if ($unread_count > 0): ?>
                        <button class="clear-all-btn"><?php _e('مسح الكل', 'muhtawaa'); ?></button>
                    <?php endif; ?>
                </div>
                
                <div class="notifications-list">
                    <?php $this->display_notifications_list($user_id); ?>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * عرض قائمة الإشعارات
     */
    private function display_notifications_list($user_id, $limit = 10) {
        $notifications = $this->get_notifications($user_id, $limit);
        
        if (empty($notifications)) {
            echo '<div class="no-notifications">' . __('لا توجد إشعارات', 'muhtawaa') . '</div>';
            return;
        }
        
        foreach ($notifications as $notification) {
            $read_class = $notification->is_read ? 'read' : 'unread';
            $priority_class = 'priority-' . $notification->priority;
            $icon = $this->get_notification_icon($notification->type);
            
            ?>
            <div class="notification-item <?php echo $read_class . ' ' . $priority_class; ?>" 
                 data-id="<?php echo $notification->id; ?>">
                
                <div class="notification-icon">
                    <i class="<?php echo $icon; ?>"></i>
                </div>
                
                <div class="notification-content">
                    <h4 class="notification-title"><?php echo esc_html($notification->title); ?></h4>
                    <p class="notification-text"><?php echo wp_kses_post($notification->content); ?></p>
                    <span class="notification-time">
                        <?php echo human_time_diff(strtotime($notification->created_at), current_time('timestamp')); ?>
                        <?php _e('منذ', 'muhtawaa'); ?>
                    </span>
                </div>
                
                <?php if (!$notification->is_read): ?>
                    <button class="mark-read-btn" data-id="<?php echo $notification->id; ?>">
                        <i class="fas fa-check"></i>
                    </button>
                <?php endif; ?>
                
                <?php if (!empty($notification->action_url)): ?>
                    <a href="<?php echo esc_url($notification->action_url); ?>" class="notification-link">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                <?php endif; ?>
            </div>
            <?php
        }
    }
    
    /**
     * الحصول على أيقونة نوع الإشعار
     */
    private function get_notification_icon($type) {
        $icons = array(
            'comment' => 'fas fa-comment',
            'rating' => 'fas fa-star',
            'solution_update' => 'fas fa-edit',
            'system' => 'fas fa-cog',
            'user_action' => 'fas fa-user',
            'admin' => 'fas fa-shield-alt'
        );
        
        return isset($icons[$type]) ? $icons[$type] : 'fas fa-bell';
    }
    
    /**
     * إرسال إشعار فوري عبر WebSocket أو Server-Sent Events
     */
    private function send_real_time_notification($user_id, $notification_data) {
        // يمكن تطوير هذه الوظيفة لاحقاً لإرسال إشعارات فورية
        // باستخدام تقنيات مثل WebSocket أو Server-Sent Events
        
        // حالياً نحفظ في session للإشعارات الفورية
        if (!session_id()) {
            session_start();
        }
        
        if (!isset($_SESSION['muhtawaa_real_time_notifications'])) {
            $_SESSION['muhtawaa_real_time_notifications'] = array();
        }
        
        $_SESSION['muhtawaa_real_time_notifications'][] = $notification_data;
    }
    
    /**
     * تنظيف الإشعارات المنتهية الصلاحية
     */
    public function cleanup_expired_notifications() {
        global $wpdb;
        
        $wpdb->query(
            "DELETE FROM {$this->table_name} 
            WHERE expire_at IS NOT NULL AND expire_at < NOW()"
        );
    }
    
    /**
     * تنظيف الإشعارات القديمة (أكثر من شهر)
     */
    public function cleanup_old_notifications() {
        global $wpdb;
        
        $wpdb->query(
            "DELETE FROM {$this->table_name} 
            WHERE is_read = 1 AND read_at < DATE_SUB(NOW(), INTERVAL 30 DAY)"
        );
    }
}

// تهيئة نظام الإشعارات
function muhtawaa_init_notifications() {
    return MuhtawaaNotifications::getInstance();
}

// تشغيل النظام
add_action('init', 'muhtawaa_init_notifications');

// جدولة تنظيف الإشعارات اليومية
if (!wp_next_scheduled('muhtawaa_cleanup_notifications')) {
    wp_schedule_event(time(), 'daily', 'muhtawaa_cleanup_notifications');
}

add_action('muhtawaa_cleanup_notifications', function() {
    $notifications = MuhtawaaNotifications::getInstance();
    $notifications->cleanup_expired_notifications();
    $notifications->cleanup_old_notifications();
});

// وظائف مساعدة للمطورين
if (!function_exists('muhtawaa_create_notification')) {
    function muhtawaa_create_notification($user_id, $type, $title, $content, $args = array()) {
        $notifications = MuhtawaaNotifications::getInstance();
        return $notifications->create_notification($user_id, $type, $title, $content, $args);
    }
}

if (!function_exists('muhtawaa_get_user_notifications')) {
    function muhtawaa_get_user_notifications($user_id, $limit = 10, $unread_only = false) {
        $notifications = MuhtawaaNotifications::getInstance();
        return $notifications->get_notifications($user_id, $limit, $unread_only);
    }
}

if (!function_exists('muhtawaa_get_unread_notifications_count')) {
    function muhtawaa_get_unread_notifications_count($user_id) {
        $notifications = MuhtawaaNotifications::getInstance();
        return $notifications->get_unread_count($user_id);
    }
}