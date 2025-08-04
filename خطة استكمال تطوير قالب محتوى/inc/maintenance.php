<?php
/**
 * نظام الصيانة التلقائية لقالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0
 * @since 1.0.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

/**
 * فئة نظام الصيانة التلقائية
 */
class MuhtawaaMaintenance {
    
    /**
     * مثيل واحد من الفئة
     */
    private static $instance = null;
    
    /**
     * حالة وضع الصيانة
     */
    private $maintenance_mode = false;
    
    /**
     * مهام الصيانة المجدولة
     */
    private $scheduled_tasks = array();
    
    /**
     * سجل أنشطة الصيانة
     */
    private $maintenance_log = array();
    
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
        // إعداد الخطافات الأساسية
        add_action('init', array($this, 'init_maintenance_system'));
        add_action('admin_init', array($this, 'init_admin_features'));
        
        // خطافات وضع الصيانة
        add_action('template_redirect', array($this, 'check_maintenance_mode'));
        add_action('admin_bar_menu', array($this, 'add_maintenance_admin_bar'), 100);
        
        // خطافات AJAX للإدارة
        add_action('wp_ajax_muhtawaa_toggle_maintenance', array($this, 'toggle_maintenance_mode'));
        add_action('wp_ajax_muhtawaa_run_maintenance_task', array($this, 'run_maintenance_task'));
        add_action('wp_ajax_muhtawaa_get_maintenance_status', array($this, 'get_maintenance_status'));
        
        // جدولة المهام التلقائية
        $this->schedule_automatic_tasks();
        
        // تحميل حالة الصيانة
        $this->maintenance_mode = get_option('muhtawaa_maintenance_mode', false);
    }
    
    /**
     * تهيئة نظام الصيانة
     */
    public function init_maintenance_system() {
        // تعريف مهام الصيانة
        $this->define_maintenance_tasks();
        
        // إنشاء جدول سجل الصيانة
        $this->create_maintenance_log_table();
        
        // تحميل إعدادات الصيانة
        $this->load_maintenance_settings();
    }
    
    /**
     * إعداد ميزات الإدارة
     */
    public function init_admin_features() {
        // إضافة صفحة إعدادات الصيانة
        add_action('admin_menu', array($this, 'add_maintenance_admin_page'));
        
        // تحميل ملفات CSS و JS للإدارة
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        
        // إضافة ويدجت لوحة التحكم
        add_action('wp_dashboard_setup', array($this, 'add_maintenance_dashboard_widget'));
    }
    
    /**
     * تعريف مهام الصيانة المتاحة
     */
    private function define_maintenance_tasks() {
        $this->scheduled_tasks = array(
            'cleanup_database' => array(
                'name' => __('تنظيف قاعدة البيانات', 'muhtawaa'),
                'description' => __('حذف البيانات غير المستخدمة والمؤقتة', 'muhtawaa'),
                'frequency' => 'weekly',
                'function' => array($this, 'cleanup_database'),
                'priority' => 'medium',
                'estimated_time' => 300 // 5 دقائق
            ),
            'optimize_images' => array(
                'name' => __('تحسين الصور', 'muhtawaa'),
                'description' => __('ضغط وتحسين صور الموقع', 'muhtawaa'),
                'frequency' => 'weekly',
                'function' => array($this, 'optimize_images'),
                'priority' => 'low',
                'estimated_time' => 600 // 10 دقائق
            ),
            'update_search_index' => array(
                'name' => __('تحديث فهرس البحث', 'muhtawaa'),
                'description' => __('إعادة بناء فهرس البحث المتقدم', 'muhtawaa'),
                'frequency' => 'daily',
                'function' => array($this, 'update_search_index'),
                'priority' => 'high',
                'estimated_time' => 180 // 3 دقائق
            ),
            'backup_critical_data' => array(
                'name' => __('نسخ احتياطي للبيانات الهامة', 'muhtawaa'),
                'description' => __('إنشاء نسخة احتياطية للإعدادات والبيانات الهامة', 'muhtawaa'),
                'frequency' => 'daily',
                'function' => array($this, 'backup_critical_data'),
                'priority' => 'high',
                'estimated_time' => 120 // دقيقتان
            ),
            'clear_cache' => array(
                'name' => __('مسح التخزين المؤقت', 'muhtawaa'),
                'description' => __('مسح جميع ملفات التخزين المؤقت', 'muhtawaa'),
                'frequency' => 'daily',
                'function' => array($this, 'clear_cache'),
                'priority' => 'medium',
                'estimated_time' => 60 // دقيقة واحدة
            ),
            'security_scan' => array(
                'name' => __('فحص الأمان', 'muhtawaa'),
                'description' => __('فحص الموقع للثغرات الأمنية', 'muhtawaa'),
                'frequency' => 'daily',
                'function' => array($this, 'security_scan'),
                'priority' => 'high',
                'estimated_time' => 240 // 4 دقائق
            ),
            'update_recommendations' => array(
                'name' => __('تحديث التوصيات', 'muhtawaa'),
                'description' => __('إعادة حساب التوصيات الذكية', 'muhtawaa'),
                'frequency' => 'hourly',
                'function' => array($this, 'update_recommendations'),
                'priority' => 'medium',
                'estimated_time' => 300 // 5 دقائق
            )
        );
    }
    
    /**
     * إنشاء جدول سجل الصيانة
     */
    private function create_maintenance_log_table() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            task_name varchar(100) NOT NULL,
            status enum('running', 'completed', 'failed', 'cancelled') NOT NULL,
            start_time datetime NOT NULL,
            end_time datetime NULL,
            duration int(11) DEFAULT 0,
            details longtext,
            error_message text NULL,
            memory_usage varchar(50) DEFAULT '',
            cpu_usage varchar(50) DEFAULT '',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY task_name (task_name),
            KEY status (status),
            KEY start_time (start_time)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * تحميل إعدادات الصيانة
     */
    private function load_maintenance_settings() {
        $this->maintenance_settings = get_option('muhtawaa_maintenance_settings', array(
            'auto_maintenance' => true,
            'maintenance_time' => '02:00', // 2 صباحاً
            'max_execution_time' => 1800, // 30 دقيقة
            'memory_limit' => '256M',
            'email_notifications' => true,
            'admin_email' => get_option('admin_email'),
            'exclude_admin_from_maintenance' => true,
            'maintenance_message' => __('الموقع تحت الصيانة، يرجى المحاولة لاحقاً', 'muhtawaa')
        ));
    }
    
    /**
     * فحص وضع الصيانة
     */
    public function check_maintenance_mode() {
        if (!$this->maintenance_mode) {
            return;
        }
        
        // السماح للمديرين بالوصول
        if ($this->maintenance_settings['exclude_admin_from_maintenance'] && current_user_can('administrator')) {
            return;
        }
        
        // السماح بالوصول لصفحات الإدارة
        if (is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
            return;
        }
        
        // عرض صفحة الصيانة
        $this->display_maintenance_page();
        exit;
    }
    
    /**
     * عرض صفحة الصيانة
     */
    private function display_maintenance_page() {
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');
        header('Retry-After: 3600'); // ساعة واحدة
        
        $maintenance_message = $this->maintenance_settings['maintenance_message'];
        $estimated_time = get_option('muhtawaa_maintenance_estimated_end', '');
        
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php _e('الموقع تحت الصيانة', 'muhtawaa'); ?> - <?php bloginfo('name'); ?></title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    margin: 0;
                    padding: 0;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    direction: rtl;
                }
                .maintenance-container {
                    background: white;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                    text-align: center;
                    max-width: 500px;
                    margin: 20px;
                }
                .maintenance-icon {
                    font-size: 60px;
                    color: #667eea;
                    margin-bottom: 20px;
                }
                .maintenance-title {
                    color: #333;
                    font-size: 28px;
                    margin-bottom: 15px;
                }
                .maintenance-message {
                    color: #666;
                    font-size: 16px;
                    line-height: 1.6;
                    margin-bottom: 20px;
                }
                .estimated-time {
                    background: #f8f9fa;
                    padding: 15px;
                    border-radius: 8px;
                    border-right: 4px solid #667eea;
                    margin: 20px 0;
                }
                .progress-bar {
                    width: 100%;
                    height: 8px;
                    background: #f0f0f0;
                    border-radius: 4px;
                    overflow: hidden;
                    margin-top: 20px;
                }
                .progress-fill {
                    height: 100%;
                    background: linear-gradient(90deg, #667eea, #764ba2);
                    border-radius: 4px;
                    animation: progress 2s ease-in-out infinite;
                }
                @keyframes progress {
                    0% { width: 0%; }
                    50% { width: 70%; }
                    100% { width: 100%; }
                }
                .contact-info {
                    margin-top: 30px;
                    font-size: 14px;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class="maintenance-container">
                <div class="maintenance-icon">🔧</div>
                <h1 class="maintenance-title"><?php _e('الموقع تحت الصيانة', 'muhtawaa'); ?></h1>
                <p class="maintenance-message"><?php echo esc_html($maintenance_message); ?></p>
                
                <?php if (!empty($estimated_time)): ?>
                <div class="estimated-time">
                    <strong><?php _e('الوقت المتوقع للانتهاء:', 'muhtawaa'); ?></strong><br>
                    <?php echo esc_html($estimated_time); ?>
                </div>
                <?php endif; ?>
                
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                
                <div class="contact-info">
                    <?php _e('للاستفسارات العاجلة يرجى التواصل مع إدارة الموقع', 'muhtawaa'); ?>
                </div>
            </div>
            
            <script>
                // تحديث الصفحة كل 30 ثانية للتحقق من انتهاء الصيانة
                setTimeout(function() {
                    location.reload();
                }, 30000);
            </script>
        </body>
        </html>
        <?php
    }
    
    /**
     * تشغيل/إيقاف وضع الصيانة
     */
    public function toggle_maintenance_mode() {
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_maintenance_nonce') || !current_user_can('administrator')) {
            wp_die(__('خطأ في التحقق من الأمان', 'muhtawaa'));
        }
        
        $this->maintenance_mode = !$this->maintenance_mode;
        update_option('muhtawaa_maintenance_mode', $this->maintenance_mode);
        
        if ($this->maintenance_mode) {
            $this->log_maintenance_activity('maintenance_mode_enabled', 'تم تفعيل وضع الصيانة');
            $message = __('تم تفعيل وضع الصيانة', 'muhtawaa');
        } else {
            $this->log_maintenance_activity('maintenance_mode_disabled', 'تم إيقاف وضع الصيانة');
            $message = __('تم إيقاف وضع الصيانة', 'muhtawaa');
        }
        
        wp_send_json_success(array(
            'message' => $message,
            'maintenance_mode' => $this->maintenance_mode
        ));
    }
    
    /**
     * تشغيل مهمة صيانة محددة
     */
    public function run_maintenance_task() {
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_maintenance_nonce') || !current_user_can('administrator')) {
            wp_die(__('خطأ في التحقق من الأمان', 'muhtawaa'));
        }
        
        $task_name = sanitize_text_field($_POST['task_name']);
        
        if (!isset($this->scheduled_tasks[$task_name])) {
            wp_send_json_error(array('message' => __('مهمة غير موجودة', 'muhtawaa')));
        }
        
        $task = $this->scheduled_tasks[$task_name];
        $start_time = current_time('mysql');
        $log_id = $this->start_maintenance_log($task_name, $start_time);
        
        try {
            // زيادة حد الذاكرة والوقت للمهمة
            @ini_set('memory_limit', $this->maintenance_settings['memory_limit']);
            @set_time_limit($this->maintenance_settings['max_execution_time']);
            
            // تشغيل المهمة
            $result = call_user_func($task['function']);
            
            $end_time = current_time('mysql');
            $duration = strtotime($end_time) - strtotime($start_time);
            
            $this->complete_maintenance_log($log_id, $end_time, $duration, $result);
            
            wp_send_json_success(array(
                'message' => sprintf(__('تم تشغيل مهمة %s بنجاح', 'muhtawaa'), $task['name']),
                'duration' => $duration,
                'result' => $result
            ));
            
        } catch (Exception $e) {
            $end_time = current_time('mysql');
            $duration = strtotime($end_time) - strtotime($start_time);
            
            $this->fail_maintenance_log($log_id, $end_time, $duration, $e->getMessage());
            
            wp_send_json_error(array(
                'message' => sprintf(__('فشل في تشغيل مهمة %s: %s', 'muhtawaa'), $task['name'], $e->getMessage())
            ));
        }
    }
    
    /**
     * تنظيف قاعدة البيانات
     */
    private function cleanup_database() {
        global $wpdb;
        
        $results = array();
        
        // حذف التعليقات المرسلة للمهملات
        $spam_comments = $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_approved = 'spam'");
        $results['spam_comments_deleted'] = $spam_comments;
        
        // حذف المراجعات القديمة (أكثر من 10)
        $wpdb->query("
            DELETE p1 FROM {$wpdb->posts} p1
            INNER JOIN {$wpdb->posts} p2 
            WHERE p1.post_parent = p2.ID 
            AND p1.post_type = 'revision' 
            AND p1.ID NOT IN (
                SELECT * FROM (
                    SELECT ID FROM {$wpdb->posts} 
                    WHERE post_type = 'revision' 
                    ORDER BY post_date DESC 
                    LIMIT 10
                ) AS temp
            )
        ");
        
        // حذف البيانات الوصفية المعزولة
        $orphaned_meta = $wpdb->query("
            DELETE pm FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE p.ID IS NULL
        ");
        $results['orphaned_postmeta_deleted'] = $orphaned_meta;
        
        // تحسين جداول قاعدة البيانات
        $tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);
        $optimized_tables = 0;
        foreach ($tables as $table) {
            $wpdb->query("OPTIMIZE TABLE {$table[0]}");
            $optimized_tables++;
        }
        $results['tables_optimized'] = $optimized_tables;
        
        // مسح التخزين المؤقت للكائنات
        wp_cache_flush();
        $results['cache_flushed'] = true;
        
        return $results;
    }
    
    /**
     * تحسين الصور
     */
    private function optimize_images() {
        $results = array('images_processed' => 0, 'space_saved' => 0);
        
        // الحصول على الصور غير المحسنة
        $uploads_dir = wp_upload_dir();
        $images = get_posts(array(
            'post_type' => 'attachment',
            'post_mime_type' => array('image/jpeg', 'image/png', 'image/gif'),
            'posts_per_page' => 50,
            'meta_query' => array(
                array(
                    'key' => '_muhtawaa_optimized',
                    'compare' => 'NOT EXISTS'
                )
            )
        ));
        
        foreach ($images as $image) {
            $file_path = get_attached_file($image->ID);
            
            if (file_exists($file_path)) {
                $original_size = filesize($file_path);
                
                // تحسين الصورة (هنا يمكن استخدام مكتبات تحسين الصور)
                $this->compress_image($file_path);
                
                $new_size = filesize($file_path);
                $saved_space = $original_size - $new_size;
                
                // تحديث البيانات الوصفية
                update_post_meta($image->ID, '_muhtawaa_optimized', true);
                update_post_meta($image->ID, '_muhtawaa_original_size', $original_size);
                update_post_meta($image->ID, '_muhtawaa_optimized_size', $new_size);
                update_post_meta($image->ID, '_muhtawaa_space_saved', $saved_space);
                
                $results['images_processed']++;
                $results['space_saved'] += $saved_space;
            }
        }
        
        return $results;
    }
    
    /**
     * ضغط الصورة
     */
    private function compress_image($file_path) {
        $image_info = getimagesize($file_path);
        
        if (!$image_info) {
            return false;
        }
        
        $mime_type = $image_info['mime'];
        
        switch ($mime_type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file_path);
                if ($image) {
                    imagejpeg($image, $file_path, 85); // جودة 85%
                    imagedestroy($image);
                }
                break;
                
            case 'image/png':
                $image = imagecreatefrompng($file_path);
                if ($image) {
                    imagepng($image, $file_path, 6); // ضغط مستوى 6
                    imagedestroy($image);
                }
                break;
        }
        
        return true;
    }
    
    /**
     * تحديث فهرس البحث
     */
    private function update_search_index() {
        // التحقق من وجود نظام البحث المتقدم
        if (!class_exists('MuhtawaaAdvancedSearch')) {
            return array('error' => 'نظام البحث المتقدم غير مفعل');
        }
        
        $search_system = MuhtawaaAdvancedSearch::getInstance();
        $result = $search_system->rebuild_search_index();
        
        return array(
            'posts_indexed' => $result['posts_count'],
            'index_size' => $result['index_size'],
            'processing_time' => $result['processing_time']
        );
    }
    
    /**
     * نسخ احتياطي للبيانات الهامة
     */
    private function backup_critical_data() {
        $backup_data = array();
        
        // نسخ احتياطي لإعدادات القالب
        $theme_options = array();
        $theme_mods = get_theme_mods();
        $backup_data['theme_mods'] = $theme_mods;
        
        // نسخ احتياطي لإعدادات ووردبريس الهامة
        $wp_options = array(
            'blogname', 'blogdescription', 'admin_email',
            'users_can_register', 'default_role', 'timezone_string'
        );
        
        foreach ($wp_options as $option) {
            $backup_data['wp_options'][$option] = get_option($option);
        }
        
        // نسخ احتياطي للقوائم
        $menus = wp_get_nav_menus();
        $backup_data['menus'] = array();
        foreach ($menus as $menu) {
            $backup_data['menus'][$menu->term_id] = wp_get_nav_menu_items($menu->term_id);
        }
        
        // حفظ النسخة الاحتياطية
        $backup_file = wp_upload_dir()['basedir'] . '/muhtawaa-backup-' . date('Y-m-d-H-i-s') . '.json';
        file_put_contents($backup_file, json_encode($backup_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        // الاحتفاظ بآخر 5 نسخ احتياطية فقط
        $this->cleanup_old_backups();
        
        return array(
            'backup_file' => basename($backup_file),
            'backup_size' => filesize($backup_file),
            'items_backed_up' => count($backup_data)
        );
    }
    
    /**
     * مسح التخزين المؤقت
     */
    private function clear_cache() {
        $results = array();
        
        // مسح تخزين ووردبريس المؤقت
        wp_cache_flush();
        $results['wp_cache_cleared'] = true;
        
        // مسح ملفات التخزين المؤقت للقالب
        $cache_dir = wp_upload_dir()['basedir'] . '/muhtawaa-cache/';
        if (is_dir($cache_dir)) {
            $cache_files = glob($cache_dir . '*');
            $deleted_files = 0;
            foreach ($cache_files as $file) {
                if (is_file($file)) {
                    unlink($file);
                    $deleted_files++;
                }
            }
            $results['cache_files_deleted'] = $deleted_files;
        }
        
        // مسح تخزين الكائنات المؤقت
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
            $results['object_cache_cleared'] = true;
        }
        
        return $results;
    }
    
    /**
     * فحص الأمان
     */
    private function security_scan() {
        $issues = array();
        $results = array();
        
        // فحص ملفات ووردبريس الأساسية
        if (!function_exists('get_core_checksums')) {
            require_once ABSPATH . 'wp-admin/includes/update.php';
        }
        
        // فحص أذونات الملفات
        $critical_files = array(
            ABSPATH . 'wp-config.php' => '600',
            ABSPATH . '.htaccess' => '644'
        );
        
        foreach ($critical_files as $file => $expected_permission) {
            if (file_exists($file)) {
                $current_permission = substr(sprintf('%o', fileperms($file)), -3);
                if ($current_permission !== $expected_permission) {
                    $issues[] = sprintf('ملف %s له أذونات %s بدلاً من %s', basename($file), $current_permission, $expected_permission);
                }
            }
        }
        
        // فحص الإضافات والقوالب المحدثة
        $outdated_plugins = get_plugin_updates();
        if (!empty($outdated_plugins)) {
            $issues[] = sprintf('يوجد %d إضافة تحتاج تحديث', count($outdated_plugins));
        }
        
        // فحص كلمات المرور الضعيفة
        $weak_passwords = $this->check_weak_passwords();
        if (!empty($weak_passwords)) {
            $issues[] = sprintf('يوجد %d مستخدم بكلمة مرور ضعيفة', count($weak_passwords));
        }
        
        $results['issues_found'] = count($issues);
        $results['issues'] = $issues;
        $results['security_score'] = $this->calculate_security_score($issues);
        
        return $results;
    }
    
    /**
     * فحص كلمات المرور الضعيفة
     */
    private function check_weak_passwords() {
        // قائمة كلمات المرور الشائعة والضعيفة
        $weak_passwords = array(
            'password', '123456', 'admin', 'test', 'guest',
            'qwerty', 'abc123', 'password123', '111111', 'welcome'
        );
        
        $users = get_users(array('fields' => array('ID', 'user_login')));
        $weak_users = array();
        
        foreach ($users as $user) {
            // فحص تقريبي - في التطبيق الحقيقي نحتاج طريقة أكثر تطوراً
            $user_data = get_userdata($user->ID);
            if (in_array(strtolower($user_data->user_login), $weak_passwords)) {
                $weak_users[] = $user->ID;
            }
        }
        
        return $weak_users;
    }
    
    /**
     * حساب نقاط الأمان
     */
    private function calculate_security_score($issues) {
        $max_score = 100;
        $deduction_per_issue = 10;
        
        $score = $max_score - (count($issues) * $deduction_per_issue);
        return max(0, $score);
    }
    
    /**
     * تحديث التوصيات الذكية
     */
    private function update_recommendations() {
        if (!class_exists('MuhtawaaSmartRecommendations')) {
            return array('error' => 'نظام التوصيات الذكية غير مفعل');
        }
        
        $recommendations_system = MuhtawaaSmartRecommendations::getInstance();
        $result = $recommendations_system->rebuild_recommendations();
        
        return array(
            'recommendations_generated' => $result['count'],
            'processing_time' => $result['time'],
            'accuracy_score' => $result['accuracy']
        );
    }
    
    /**
     * جدولة المهام التلقائية
     */
    private function schedule_automatic_tasks() {
        foreach ($this->scheduled_tasks as $task_name => $task) {
            $hook_name = 'muhtawaa_maintenance_' . $task_name;
            
            if (!wp_next_scheduled($hook_name)) {
                wp_schedule_event(time(), $task['frequency'], $hook_name);
            }
            
            add_action($hook_name, function() use ($task_name, $task) {
                if (get_option('muhtawaa_auto_maintenance', true)) {
                    $this->run_scheduled_task($task_name, $task);
                }
            });
        }
    }
    
    /**
     * تشغيل مهمة مجدولة
     */
    private function run_scheduled_task($task_name, $task) {
        $start_time = current_time('mysql');
        $log_id = $this->start_maintenance_log($task_name, $start_time);
        
        try {
            $result = call_user_func($task['function']);
            
            $end_time = current_time('mysql');
            $duration = strtotime($end_time) - strtotime($start_time);
            
            $this->complete_maintenance_log($log_id, $end_time, $duration, $result);
            
            // إرسال إشعار في حالة المهام الهامة
            if ($task['priority'] === 'high') {
                $this->send_maintenance_notification($task_name, 'completed', $result);
            }
            
        } catch (Exception $e) {
            $end_time = current_time('mysql');
            $duration = strtotime($end_time) - strtotime($start_time);
            
            $this->fail_maintenance_log($log_id, $end_time, $duration, $e->getMessage());
            
            // إرسال إشعار فشل
            $this->send_maintenance_notification($task_name, 'failed', $e->getMessage());
        }
    }
    
    /**
     * بدء تسجيل مهمة صيانة
     */
    private function start_maintenance_log($task_name, $start_time) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';
        
        $wpdb->insert(
            $table_name,
            array(
                'task_name' => $task_name,
                'status' => 'running',
                'start_time' => $start_time,
                'memory_usage' => $this->get_memory_usage(),
                'cpu_usage' => $this->get_cpu_usage()
            ),
            array('%s', '%s', '%s', '%s', '%s')
        );
        
        return $wpdb->insert_id;
    }
    
    /**
     * إكمال تسجيل مهمة الصيانة
     */
    private function complete_maintenance_log($log_id, $end_time, $duration, $result) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';
        
        $wpdb->update(
            $table_name,
            array(
                'status' => 'completed',
                'end_time' => $end_time,
                'duration' => $duration,
                'details' => json_encode($result, JSON_UNESCAPED_UNICODE),
                'memory_usage' => $this->get_memory_usage(),
                'cpu_usage' => $this->get_cpu_usage()
            ),
            array('id' => $log_id),
            array('%s', '%s', '%d', '%s', '%s', '%s'),
            array('%d')
        );
    }
    
    /**
     * تسجيل فشل مهمة الصيانة
     */
    private function fail_maintenance_log($log_id, $end_time, $duration, $error_message) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';
        
        $wpdb->update(
            $table_name,
            array(
                'status' => 'failed',
                'end_time' => $end_time,
                'duration' => $duration,
                'error_message' => $error_message,
                'memory_usage' => $this->get_memory_usage(),
                'cpu_usage' => $this->get_cpu_usage()
            ),
            array('id' => $log_id),
            array('%s', '%s', '%d', '%s', '%s', '%s'),
            array('%d')
        );
    }
    
    /**
     * الحصول على استخدام الذاكرة
     */
    private function get_memory_usage() {
        $memory_usage = memory_get_usage(true);
        return size_format($memory_usage);
    }
    
    /**
     * الحصول على استخدام المعالج (تقريبي)
     */
    private function get_cpu_usage() {
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            return round($load[0] * 100, 2) . '%';
        }
        return 'غير متاح';
    }
    
    /**
     * تسجيل نشاط الصيانة
     */
    private function log_maintenance_activity($activity, $details = '') {
        $this->maintenance_log[] = array(
            'timestamp' => current_time('mysql'),
            'activity' => $activity,
            'details' => $details,
            'user_id' => get_current_user_id()
        );
        
        // حفظ السجل في قاعدة البيانات أو ملف
        update_option('muhtawaa_maintenance_activity_log', $this->maintenance_log);
    }
    
    /**
     * إرسال إشعار الصيانة
     */
    private function send_maintenance_notification($task_name, $status, $details) {
        if (!$this->maintenance_settings['email_notifications']) {
            return;
        }
        
        $task_info = $this->scheduled_tasks[$task_name];
        $admin_email = $this->maintenance_settings['admin_email'];
        
        $subject = sprintf(
            '[%s] %s - %s',
            get_bloginfo('name'),
            $task_info['name'],
            $status === 'completed' ? 'مكتملة' : 'فشلت'
        );
        
        $message = sprintf(
            "مرحباً،\n\n" .
            "تم %s مهمة الصيانة: %s\n\n" .
            "التفاصيل:\n%s\n\n" .
            "الوقت: %s\n\n" .
            "---\n" .
            "رسالة تلقائية من نظام صيانة قالب محتوى",
            $status === 'completed' ? 'إكمال' : 'فشل في',
            $task_info['name'],
            is_array($details) ? print_r($details, true) : $details,
            current_time('Y-m-d H:i:s')
        );
        
        wp_mail($admin_email, $subject, $message);
    }
    
    /**
     * إضافة صفحة إعدادات الصيانة في الإدارة
     */
    public function add_maintenance_admin_page() {
        add_management_page(
            __('صيانة الموقع', 'muhtawaa'),
            __('صيانة الموقع', 'muhtawaa'),
            'administrator',
            'muhtawaa-maintenance',
            array($this, 'maintenance_admin_page')
        );
    }
    
    /**
     * صفحة إدارة الصيانة
     */
    public function maintenance_admin_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('صيانة الموقع', 'muhtawaa'); ?></h1>
            
            <div class="muhtawaa-maintenance-dashboard">
                <!-- حالة وضع الصيانة -->
                <div class="maintenance-status-card">
                    <h2><?php _e('وضع الصيانة', 'muhtawaa'); ?></h2>
                    <p class="status-indicator <?php echo $this->maintenance_mode ? 'active' : 'inactive'; ?>">
                        <?php echo $this->maintenance_mode ? __('مفعل', 'muhtawaa') : __('غير مفعل', 'muhtawaa'); ?>
                    </p>
                    <button id="toggle-maintenance" class="button button-primary">
                        <?php echo $this->maintenance_mode ? __('إيقاف الصيانة', 'muhtawaa') : __('تفعيل الصيانة', 'muhtawaa'); ?>
                    </button>
                </div>
                
                <!-- مهام الصيانة المتاحة -->
                <div class="maintenance-tasks-section">
                    <h2><?php _e('مهام الصيانة', 'muhtawaa'); ?></h2>
                    <div class="tasks-grid">
                        <?php foreach ($this->scheduled_tasks as $task_name => $task): ?>
                        <div class="task-card" data-task="<?php echo esc_attr($task_name); ?>">
                            <h3><?php echo esc_html($task['name']); ?></h3>
                            <p><?php echo esc_html($task['description']); ?></p>
                            <div class="task-meta">
                                <span class="frequency"><?php echo esc_html($task['frequency']); ?></span>
                                <span class="priority priority-<?php echo esc_attr($task['priority']); ?>">
                                    <?php echo esc_html($task['priority']); ?>
                                </span>
                            </div>
                            <div class="task-actions">
                                <button class="button run-task" data-task="<?php echo esc_attr($task_name); ?>">
                                    <?php _e('تشغيل الآن', 'muhtawaa'); ?>
                                </button>
                                <span class="estimated-time">
                                    <?php printf(__('~%d دقيقة', 'muhtawaa'), ceil($task['estimated_time'] / 60)); ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- سجل الأنشطة -->
                <div class="maintenance-log-section">
                    <h2><?php _e('سجل أنشطة الصيانة', 'muhtawaa'); ?></h2>
                    <div class="log-table-container">
                        <?php $this->display_maintenance_log_table(); ?>
                    </div>
                </div>
                
                <!-- إعدادات الصيانة -->
                <div class="maintenance-settings-section">
                    <h2><?php _e('إعدادات الصيانة', 'muhtawaa'); ?></h2>
                    <form id="maintenance-settings-form">
                        <table class="form-table">
                            <tr>
                                <th><?php _e('تفعيل الصيانة التلقائية', 'muhtawaa'); ?></th>
                                <td>
                                    <input type="checkbox" name="auto_maintenance" value="1" 
                                           <?php checked($this->maintenance_settings['auto_maintenance']); ?>>
                                    <p class="description"><?php _e('تشغيل مهام الصيانة تلقائياً حسب الجدولة', 'muhtawaa'); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e('وقت الصيانة المفضل', 'muhtawaa'); ?></th>
                                <td>
                                    <input type="time" name="maintenance_time" 
                                           value="<?php echo esc_attr($this->maintenance_settings['maintenance_time']); ?>">
                                    <p class="description"><?php _e('الوقت المفضل لتشغيل مهام الصيانة', 'muhtawaa'); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e('إشعارات البريد الإلكتروني', 'muhtawaa'); ?></th>
                                <td>
                                    <input type="checkbox" name="email_notifications" value="1" 
                                           <?php checked($this->maintenance_settings['email_notifications']); ?>>
                                    <input type="email" name="admin_email" 
                                           value="<?php echo esc_attr($this->maintenance_settings['admin_email']); ?>"
                                           placeholder="<?php _e('البريد الإلكتروني للإدارة', 'muhtawaa'); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e('رسالة وضع الصيانة', 'muhtawaa'); ?></th>
                                <td>
                                    <textarea name="maintenance_message" rows="3" class="large-text"><?php 
                                        echo esc_textarea($this->maintenance_settings['maintenance_message']); 
                                    ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <p class="submit">
                            <button type="submit" class="button button-primary">
                                <?php _e('حفظ الإعدادات', 'muhtawaa'); ?>
                            </button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        
        <style>
        .muhtawaa-maintenance-dashboard {
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }
        
        .maintenance-status-card {
            background: #fff;
            border: 1px solid #ccd0d4;
            padding: 20px;
            border-radius: 8px;
        }
        
        .status-indicator {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            margin: 10px 0;
        }
        
        .status-indicator.active {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-indicator.inactive {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .task-card {
            background: #fff;
            border: 1px solid #ccd0d4;
            padding: 15px;
            border-radius: 8px;
        }
        
        .task-card h3 {
            margin: 0 0 10px 0;
            color: #23282d;
        }
        
        .task-meta {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }
        
        .task-meta span {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            background: #f1f1f1;
        }
        
        .priority-high { background: #ffebee !important; color: #c62828; }
        .priority-medium { background: #fff3e0 !important; color: #ef6c00; }
        .priority-low { background: #e8f5e8 !important; color: #2e7d32; }
        
        .task-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        
        .estimated-time {
            font-size: 12px;
            color: #666;
        }
        
        .log-table-container {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .maintenance-settings-section {
            background: #fff;
            border: 1px solid #ccd0d4;
            padding: 20px;
            border-radius: 8px;
        }
        </style>
        <?php
    }
    
    /**
     * عرض جدول سجل الصيانة
     */
    private function display_maintenance_log_table() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';
        $logs = $wpdb->get_results(
            "SELECT * FROM $table_name ORDER BY start_time DESC LIMIT 20"
        );
        
        if (empty($logs)) {
            echo '<p>' . __('لا يوجد سجل أنشطة', 'muhtawaa') . '</p>';
            return;
        }
        
        ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('المهمة', 'muhtawaa'); ?></th>
                    <th><?php _e('الحالة', 'muhtawaa'); ?></th>
                    <th><?php _e('وقت البداية', 'muhtawaa'); ?></th>
                    <th><?php _e('المدة', 'muhtawaa'); ?></th>
                    <th><?php _e('استخدام الذاكرة', 'muhtawaa'); ?></th>
                    <th><?php _e('الإجراءات', 'muhtawaa'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                <tr>
                    <td>
                        <strong><?php echo esc_html($this->scheduled_tasks[$log->task_name]['name'] ?? $log->task_name); ?></strong>
                    </td>
                    <td>
                        <span class="status-badge status-<?php echo esc_attr($log->status); ?>">
                            <?php 
                            $status_labels = array(
                                'running' => __('قيد التشغيل', 'muhtawaa'),
                                'completed' => __('مكتملة', 'muhtawaa'),
                                'failed' => __('فشلت', 'muhtawaa'),
                                'cancelled' => __('ملغاة', 'muhtawaa')
                            );
                            echo $status_labels[$log->status] ?? $log->status;
                            ?>
                        </span>
                    </td>
                    <td><?php echo esc_html($log->start_time); ?></td>
                    <td>
                        <?php 
                        if ($log->duration > 0) {
                            echo human_time_diff(0, $log->duration);
                        } else {
                            echo '—';
                        }
                        ?>
                    </td>
                    <td><?php echo esc_html($log->memory_usage); ?></td>
                    <td>
                        <button class="button button-small view-log-details" 
                                data-log-id="<?php echo $log->id; ?>">
                            <?php _e('عرض التفاصيل', 'muhtawaa'); ?>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <style>
        .status-badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-running { background: #fff3cd; color: #856404; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-failed { background: #f8d7da; color: #721c24; }
        .status-cancelled { background: #e2e3e5; color: #383d41; }
        </style>
        <?php
    }
    
    /**
     * تحميل ملفات CSS و JS للإدارة
     */
    public function enqueue_admin_assets($hook) {
        if ($hook !== 'tools_page_muhtawaa-maintenance') {
            return;
        }
        
        wp_enqueue_script(
            'muhtawaa-maintenance-admin',
            get_template_directory_uri() . '/assets/js/maintenance-admin.js',
            array('jquery'),
            THEME_VERSION,
            true
        );
        
        wp_localize_script('muhtawaa-maintenance-admin', 'muhtawaaMaintenance', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_maintenance_nonce'),
            'strings' => array(
                'confirm_toggle' => __('هل أنت متأكد من تغيير وضع الصيانة؟', 'muhtawaa'),
                'confirm_run_task' => __('هل تريد تشغيل هذه المهمة الآن؟', 'muhtawaa'),
                'task_running' => __('جاري تشغيل المهمة...', 'muhtawaa'),
                'task_completed' => __('تم إكمال المهمة بنجاح', 'muhtawaa'),
                'task_failed' => __('فشل في تشغيل المهمة', 'muhtawaa')
            )
        ));
    }
    
    /**
     * إضافة ويدجت لوحة التحكم
     */
    public function add_maintenance_dashboard_widget() {
        wp_add_dashboard_widget(
            'muhtawaa-maintenance-widget',
            __('صيانة الموقع', 'muhtawaa'),
            array($this, 'maintenance_dashboard_widget_content')
        );
    }
    
    /**
     * محتوى ويدجت لوحة التحكم
     */
    public function maintenance_dashboard_widget_content() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';

        $table_exists = $wpdb->get_var(
            $wpdb->prepare(
                "SHOW TABLES LIKE %s",
                $table_name
            )
        );

        if ($table_exists !== $table_name) {
            echo '<p>' . esc_html__('لا توجد بيانات صيانة متاحة بعد.', 'muhtawaa') . '</p>';
            return;
        }

        // آخر مهمة صيانة
        $last_task = $wpdb->get_row(
            "SELECT * FROM $table_name ORDER BY start_time DESC LIMIT 1"
        );
        
        // عدد المهام المكتملة اليوم
        $today_tasks = $wpdb->get_var(
            "SELECT COUNT(*) FROM $table_name 
            WHERE DATE(start_time) = CURDATE() AND status = 'completed'"
        );
        
        // عدد المهام الفاشلة هذا الأسبوع
        $failed_tasks = $wpdb->get_var(
            "SELECT COUNT(*) FROM $table_name 
            WHERE start_time >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND status = 'failed'"
        );
        
        ?>
        <div class="muhtawaa-maintenance-widget">
            <div class="maintenance-stats">
                <div class="stat-item">
                    <span class="stat-number"><?php echo $today_tasks; ?></span>
                    <span class="stat-label"><?php _e('مهام اليوم', 'muhtawaa'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo $failed_tasks; ?></span>
                    <span class="stat-label"><?php _e('مهام فاشلة', 'muhtawaa'); ?></span>
                </div>
            </div>
            
            <?php if ($last_task): ?>
            <div class="last-task-info">
                <h4><?php _e('آخر مهمة صيانة', 'muhtawaa'); ?></h4>
                <p>
                    <strong><?php echo esc_html($this->scheduled_tasks[$last_task->task_name]['name'] ?? $last_task->task_name); ?></strong><br>
                    <span class="status-<?php echo esc_attr($last_task->status); ?>">
                        <?php echo esc_html($last_task->status); ?>
                    </span> - 
                    <?php echo human_time_diff(strtotime($last_task->start_time), current_time('timestamp')); ?> 
                    <?php _e('منذ', 'muhtawaa'); ?>
                </p>
            </div>
            <?php endif; ?>
            
            <div class="widget-actions">
                <a href="<?php echo admin_url('tools.php?page=muhtawaa-maintenance'); ?>" class="button button-primary">
                    <?php _e('إدارة الصيانة', 'muhtawaa'); ?>
                </a>
                
                <?php if (!$this->maintenance_mode): ?>
                <button id="quick-maintenance-toggle" class="button">
                    <?php _e('تفعيل وضع الصيانة', 'muhtawaa'); ?>
                </button>
                <?php endif; ?>
            </div>
        </div>
        
        <style>
        .muhtawaa-maintenance-widget .maintenance-stats {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .muhtawaa-maintenance-widget .stat-item {
            text-align: center;
            flex: 1;
        }
        
        .muhtawaa-maintenance-widget .stat-number {
            display: block;
            font-size: 24px;
            font-weight: bold;
            color: #0073aa;
        }
        
        .muhtawaa-maintenance-widget .stat-label {
            font-size: 12px;
            color: #666;
        }
        
        .muhtawaa-maintenance-widget .last-task-info {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin: 15px 0;
        }
        
        .muhtawaa-maintenance-widget .widget-actions {
            display: flex;
            gap: 10px;
        }
        
        .muhtawaa-maintenance-widget .widget-actions .button {
            flex: 1;
            text-align: center;
        }
        </style>
        <?php
    }
    
    /**
     * إضافة رابط الصيانة لشريط الإدارة
     */
    public function add_maintenance_admin_bar($wp_admin_bar) {
        if (!current_user_can('administrator')) {
            return;
        }
        
        $wp_admin_bar->add_node(array(
            'id' => 'muhtawaa-maintenance',
            'title' => $this->maintenance_mode ? 
                       '<span style="color: #ff6b6b;">🔧 ' . __('وضع الصيانة', 'muhtawaa') . '</span>' :
                       '🔧 ' . __('الصيانة', 'muhtawaa'),
            'href' => admin_url('tools.php?page=muhtawaa-maintenance'),
            'meta' => array(
                'title' => __('إدارة صيانة الموقع', 'muhtawaa')
            )
        ));
        
        if ($this->maintenance_mode) {
            $wp_admin_bar->add_node(array(
                'parent' => 'muhtawaa-maintenance',
                'id' => 'disable-maintenance',
                'title' => __('إيقاف وضع الصيانة', 'muhtawaa'),
                'href' => '#',
                'meta' => array(
                    'onclick' => 'muhtawaaToggleMaintenance(); return false;'
                )
            ));
        }
    }
    
    /**
     * تنظيف النسخ الاحتياطية القديمة
     */
    private function cleanup_old_backups() {
        $upload_dir = wp_upload_dir()['basedir'];
        $backup_files = glob($upload_dir . '/muhtawaa-backup-*.json');
        
        // ترتيب الملفات حسب تاريخ الإنشاء
        usort($backup_files, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        
        // حذف الملفات الزائدة عن 5
        $files_to_delete = array_slice($backup_files, 5);
        foreach ($files_to_delete as $file) {
            unlink($file);
        }
    }
    
    /**
     * الحصول على حالة الصيانة
     */
    public function get_maintenance_status() {
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_maintenance_nonce')) {
            wp_die(__('خطأ في التحقق من الأمان', 'muhtawaa'));
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'muhtawaa_maintenance_log';
        
        // آخر المهام
        $recent_tasks = $wpdb->get_results(
            "SELECT * FROM $table_name ORDER BY start_time DESC LIMIT 5"
        );
        
        // إحصائيات سريعة
        $stats = array(
            'total_tasks_today' => $wpdb->get_var(
                "SELECT COUNT(*) FROM $table_name WHERE DATE(start_time) = CURDATE()"
            ),
            'failed_tasks_week' => $wpdb->get_var(
                "SELECT COUNT(*) FROM $table_name 
                WHERE start_time >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND status = 'failed'"
            ),
            'running_tasks' => $wpdb->get_var(
                "SELECT COUNT(*) FROM $table_name WHERE status = 'running'"
            )
        );
        
        wp_send_json_success(array(
            'maintenance_mode' => $this->maintenance_mode,
            'recent_tasks' => $recent_tasks,
            'stats' => $stats,
            'scheduled_tasks' => array_keys($this->scheduled_tasks)
        ));
    }
}

// تهيئة نظام الصيانة
function muhtawaa_init_maintenance() {
    return MuhtawaaMaintenance::getInstance();
}

// تشغيل النظام
add_action('init', 'muhtawaa_init_maintenance');

// وظائف مساعدة للمطورين
if (!function_exists('muhtawaa_enable_maintenance_mode')) {
    function muhtawaa_enable_maintenance_mode($message = '') {
        $maintenance = MuhtawaaMaintenance::getInstance();
        update_option('muhtawaa_maintenance_mode', true);
        if (!empty($message)) {
            $settings = get_option('muhtawaa_maintenance_settings', array());
            $settings['maintenance_message'] = $message;
            update_option('muhtawaa_maintenance_settings', $settings);
        }
    }
}

if (!function_exists('muhtawaa_disable_maintenance_mode')) {
    function muhtawaa_disable_maintenance_mode() {
        update_option('muhtawaa_maintenance_mode', false);
    }
}

if (!function_exists('muhtawaa_is_maintenance_mode')) {
    function muhtawaa_is_maintenance_mode() {
        return get_option('muhtawaa_maintenance_mode', false);
    }
}

if (!function_exists('muhtawaa_run_maintenance_task')) {
    function muhtawaa_run_maintenance_task($task_name) {
        $maintenance = MuhtawaaMaintenance::getInstance();
        // سيتم تطوير هذه الوظيفة لاحقاً للاستخدام البرمجي
        return false;
    }
}