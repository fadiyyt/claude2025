<?php
/**
 * ملف التثبيت والإعداد الأولي للقالب
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تشغيل عملية التثبيت عند تفعيل القالب
 */
function fadi_theme_activation() {
    // إنشاء الصفحات الأساسية
    fadi_create_essential_pages();
    
    // إعداد الإعدادات الافتراضية
    fadi_setup_default_options();
    
    // إنشاء المجلدات المطلوبة
    fadi_create_directories();
    
    // إضافة البيانات التجريبية
    fadi_add_sample_data();
    
    // تفعيل المهام المجدولة
    fadi_schedule_cron_jobs();
    
    // إعداد قواعد البيانات
    fadi_setup_database();
    
    // تسجيل تاريخ التثبيت
    update_option('fadi_installation_date', current_time('mysql'));
    update_option('fadi_theme_version', '1.0');
    
    // إعادة توجيه إلى صفحة الترحيب
    set_transient('fadi_activation_redirect', true, 30);
}
add_action('after_switch_theme', 'fadi_theme_activation');

/**
 * إنشاء الصفحات الأساسية
 */
function fadi_create_essential_pages() {
    $pages = array(
        'dashboard' => array(
            'title' => __('لوحة التحكم', 'fadi'),
            'content' => '<!-- wp:pattern {"slug":"fadi/dashboard-layout"} /-->'
        ),
        'quotes' => array(
            'title' => __('عروض الأسعار', 'fadi'),
            'content' => __('صفحة إدارة عروض الأسعار', 'fadi')
        ),
        'purchases' => array(
            'title' => __('إدارة المشتريات', 'fadi'),
            'content' => __('صفحة إدارة المشتريات والموردين', 'fadi')
        ),
        'employees' => array(
            'title' => __('شؤون الموظفين', 'fadi'),
            'content' => __('صفحة إدارة شؤون الموظفين', 'fadi')
        ),
        'tenders' => array(
            'title' => __('المناقصات', 'fadi'),
            'content' => __('صفحة إدارة المناقصات', 'fadi')
        ),
        'documents' => array(
            'title' => __('الوثائق الحكومية', 'fadi'),
            'content' => __('صفحة إدارة الوثائق الحكومية', 'fadi')
        )
    );
    
    foreach ($pages as $slug => $page_data) {
        $existing_page = get_page_by_path($slug);
        
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $slug,
                'post_content' => $page_data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
                'comment_status' => 'closed',
                'ping_status' => 'closed'
            ));
            
            if ($page_id && $slug === 'dashboard') {
                // تعيين صفحة لوحة التحكم كصفحة رئيسية للمستخدمين المسجلين
                update_option('fadi_dashboard_page_id', $page_id);
            }
        }
    }
}

/**
 * إعداد الإعدادات الافتراضية
 */
function fadi_setup_default_options() {
    $default_options = array(
        // إعدادات الشركة
        'fadi_company_name' => __('شركة FADI', 'fadi'),
        'fadi_company_address' => __('الرياض، المملكة العربية السعودية', 'fadi'),
        'fadi_company_phone' => '+966 50 000 0000',
        'fadi_company_email' => 'info@fadi.com',
        'fadi_vat_rate' => '15',
        
        // إعدادات النظام
        'fadi_auto_backup' => false,
        'fadi_backup_frequency' => 'weekly',
        'fadi_log_activities' => true,
        'fadi_session_timeout' => 60,
        'fadi_show_stats' => true,
        'fadi_items_per_page' => 10,
        
        // إعدادات التصميم
        'fadi_primary_color' => '#667eea',
        'fadi_secondary_color' => '#764ba2',
        'fadi_background_color' => '#f8f9fa',
        'fadi_primary_font' => 'Tajawal',
        'fadi_font_size' => 16,
        
        // إعدادات الأمان
        'fadi_failed_logins' => array(),
        'fadi_security_enabled' => true,
        
        // إعدادات التقارير
        'fadi_monthly_reports' => true,
        'fadi_report_email' => get_option('admin_email')
    );
    
    foreach ($default_options as $option_name => $default_value) {
        if (!get_option($option_name)) {
            update_option($option_name, $default_value);
        }
    }
}

/**
 * إنشاء المجلدات المطلوبة
 */
function fadi_create_directories() {
    $upload_dir = wp_upload_dir();
    $fadi_dirs = array(
        $upload_dir['basedir'] . '/fadi',
        $upload_dir['basedir'] . '/fadi/backups',
        $upload_dir['basedir'] . '/fadi/exports',
        $upload_dir['basedir'] . '/fadi/documents',
        $upload_dir['basedir'] . '/fadi/quotes',
        $upload_dir['basedir'] . '/fadi/reports'
    );
    
    foreach ($fadi_dirs as $dir) {
        if (!file_exists($dir)) {
            wp_mkdir_p($dir);
            
            // إضافة ملف .htaccess لحماية المجلدات الحساسة
            if (in_array(basename($dir), array('backups', 'exports'))) {
                file_put_contents($dir . '/.htaccess', "Order deny,allow\nDeny from all");
            }
            
            // إضافة ملف index.php فارغ لمنع عرض محتويات المجلد
            file_put_contents($dir . '/index.php', '<?php // Silence is golden');
        }
    }
}

/**
 * إضافة البيانات التجريبية
 */
function fadi_add_sample_data() {
    // إضافة مورد تجريبي
    $supplier_id = wp_insert_post(array(
        'post_title' => __('مورد تجريبي', 'fadi'),
        'post_content' => __('هذا مورد تجريبي يمكنك تعديله أو حذفه', 'fadi'),
        'post_status' => 'publish',
        'post_type' => 'supplier',
        'meta_input' => array(
            'contact_person' => __('أحمد محمد', 'fadi'),
            'contact_email' => 'ahmed@example.com',
            'contact_phone' => '+966 50 123 4567',
            'supplier_rating' => 4
        )
    ));
    
    if ($supplier_id) {
        wp_set_object_terms($supplier_id, 'معدات', 'supplier_category');
    }
    
    // إضافة موظف تجريبي
    $employee_id = wp_insert_post(array(
        'post_title' => __('موظف تجريبي', 'fadi'),
        'post_content' => __('هذا موظف تجريبي يمكنك تعديله أو حذفه', 'fadi'),
        'post_status' => 'publish',
        'post_type' => 'employee',
        'meta_input' => array(
            'employee_id' => 'EMP001',
            'employee_position' => __('مطور', 'fadi'),
            'employee_email' => 'employee@example.com',
            'employee_status' => 'active',
            'hire_date' => date('Y-m-d')
        )
    ));
    
    if ($employee_id) {
        wp_set_object_terms($employee_id, 'تقنية المعلومات', 'employee_department');
    }
    
    // إضافة عرض سعر تجريبي
    $quote_id = wp_insert_post(array(
        'post_title' => __('عرض سعر تجريبي', 'fadi'),
        'post_content' => __('هذا عرض سعر تجريبي يمكنك تعديله أو حذفه', 'fadi'),
        'post_status' => 'publish',
        'post_type' => 'quote',
        'meta_input' => array(
            'client_name' => __('عميل تجريبي', 'fadi'),
            'client_email' => 'client@example.com',
            'quote_date' => date('Y-m-d'),
            'subtotal' => 1000,
            'vat_rate' => 15,
            'vat_amount' => 150,
            'total_amount' => 1150,
            'quote_items' => json_encode(array(
                array(
                    'description' => __('خدمة تجريبية', 'fadi'),
                    'unit' => 'piece',
                    'quantity' => 1,
                    'price' => 1000
                )
            ))
        )
    ));
    
    if ($quote_id) {
        wp_set_object_terms($quote_id, 'مسودة', 'quote_status');
    }
}

/**
 * إعداد قواعد البيانات
 */
function fadi_setup_database() {
    global $wpdb;
    
/**
 * إعداد قواعد البيانات
 */
function fadi_setup_database() {
    global $wpdb;
    
    // إنشاء جدول للنشاطات والسجلات
    $activities_table = $wpdb->prefix . 'fadi_activities';
    
    $sql = "CREATE TABLE IF NOT EXISTS {$activities_table} (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id int(11) NOT NULL,
        activity_type varchar(50) NOT NULL,
        activity_action varchar(100) NOT NULL,
        object_id int(11) DEFAULT NULL,
        object_type varchar(50) DEFAULT NULL,
        ip_address varchar(45) DEFAULT NULL,
        user_agent text DEFAULT NULL,
        activity_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id),
        KEY activity_date (activity_date),
        KEY object_id (object_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // إنشاء جدول للإحصائيات المؤرشفة
    $stats_table = $wpdb->prefix . 'fadi_statistics';
    
    $sql_stats = "CREATE TABLE IF NOT EXISTS {$stats_table} (
        id int(11) NOT NULL AUTO_INCREMENT,
        stat_date date NOT NULL,
        stat_type varchar(50) NOT NULL,
        stat_value text NOT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY unique_stat (stat_date, stat_type),
        KEY stat_date (stat_date)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    dbDelta($sql_stats);
    
    // إضافة فهارس إضافية للأداء
    $wpdb->query("ALTER TABLE {$wpdb->posts} ADD INDEX fadi_post_type_status (post_type, post_status)");
    $wpdb->query("ALTER TABLE {$wpdb->postmeta} ADD INDEX fadi_meta_key_value (meta_key, meta_value(191))");
}

/**
 * إنشاء ملف .htaccess للأمان
 */
function fadi_create_htaccess_rules() {
    $htaccess_path = ABSPATH . '.htaccess';
    $fadi_rules = '
# FADI Security Rules - Start
<IfModule mod_rewrite.c>
    # حماية ملفات النظام
    RewriteRule ^wp-config\.php$ - [F,L]
    RewriteRule ^wp-admin/includes/ - [F,L]
    RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
    RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
    RewriteRule ^wp-includes/theme-compat/ - [F,L]
    
    # منع الوصول للملفات الحساسة
    RewriteRule ^(.*)?\.git(.*)?$ - [F,L]
    RewriteRule ^(.*)?\.svn(.*)?$ - [F,L]
    RewriteRule ^(.*)?\.(env|log|sql|bak)$ - [F,L]
    
    # حماية ضد الهجمات الشائعة
    RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
    RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
    RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
    RewriteRule ^(.*)$ - [F,L]
</IfModule>

# تحسين الأداء
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
</IfModule>

<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
# FADI Security Rules - End

';
    
    // إضافة القواعد إلى .htaccess إذا لم تكن موجودة
    if (file_exists($htaccess_path)) {
        $htaccess_content = file_get_contents($htaccess_path);
        if (strpos($htaccess_content, 'FADI Security Rules') === false) {
            file_put_contents($htaccess_path, $fadi_rules . "\n" . $htaccess_content);
        }
    } else {
        file_put_contents($htaccess_path, $fadi_rules);
    }
}

/**
 * إنشاء معالج إلغاء التثبيت
 */
function fadi_theme_deactivation() {
    // مسح المهام المجدولة
    fadi_clear_scheduled_jobs();
    
    // إزالة صفحات الإعادة التوجيه
    delete_transient('fadi_activation_redirect');
    
    // تسجيل تاريخ إلغاء التفعيل
    update_option('fadi_deactivation_date', current_time('mysql'));
}
add_action('switch_theme', 'fadi_theme_deactivation');

/**
 * إعادة توجيه إلى صفحة الترحيب
 */
function fadi_activation_redirect() {
    if (get_transient('fadi_activation_redirect')) {
        delete_transient('fadi_activation_redirect');
        
        if (!isset($_GET['activate-multi'])) {
            wp_redirect(admin_url('admin.php?page=fadi-welcome'));
            exit;
        }
    }
}
add_action('admin_init', 'fadi_activation_redirect');

/**
 * صفحة الترحيب
 */
function fadi_add_welcome_page() {
    add_theme_page(
        __('مرحباً بك في FADI', 'fadi'),
        __('مرحباً بك في FADI', 'fadi'),
        'manage_options',
        'fadi-welcome',
        'fadi_welcome_page'
    );
}
add_action('admin_menu', 'fadi_add_welcome_page');

/**
 * محتوى صفحة الترحيب
 */
function fadi_welcome_page() {
    ?>
    <div class="wrap fadi-welcome">
        <h1><?php _e('مرحباً بك في قالب FADI', 'fadi'); ?></h1>
        
        <div class="fadi-welcome-hero">
            <div class="fadi-welcome-content">
                <h2><?php _e('شكراً لاختيارك قالب FADI', 'fadi'); ?></h2>
                <p><?php _e('قالب FADI هو نظام إدارة شخصي متطور لأتمتة وتنظيم المهام اليومية. تم تصميمه خصيصاً لمساعدتك في إدارة عملك بكفاءة عالية.', 'fadi'); ?></p>
            </div>
        </div>
        
        <div class="fadi-welcome-features">
            <h2><?php _e('الميزات الرئيسية', 'fadi'); ?></h2>
            
            <div class="fadi-features-grid">
                <div class="fadi-feature">
                    <div class="fadi-feature-icon">📋</div>
                    <h3><?php _e('عروض الأسعار', 'fadi'); ?></h3>
                    <p><?php _e('إنشاء عروض أسعار احترافية مع حساب تلقائي للضرائب', 'fadi'); ?></p>
                </div>
                
                <div class="fadi-feature">
                    <div class="fadi-feature-icon">🛒</div>
                    <h3><?php _e('إدارة المشتريات', 'fadi'); ?></h3>
                    <p><?php _e('قاعدة بيانات شاملة للموردين والمنتجات', 'fadi'); ?></p>
                </div>
                
                <div class="fadi-feature">
                    <div class="fadi-feature-icon">👥</div>
                    <h3><?php _e('شؤون الموظفين', 'fadi'); ?></h3>
                    <p><?php _e('إدارة ملفات الموظفين والعهد والمهام', 'fadi'); ?></p>
                </div>
                
                <div class="fadi-feature">
                    <div class="fadi-feature-icon">🏢</div>
                    <h3><?php _e('المناقصات', 'fadi'); ?></h3>
                    <p><?php _e('تتبع المناقصات مع تنبيهات المواعيد النهائية', 'fadi'); ?></p>
                </div>
                
                <div class="fadi-feature">
                    <div class="fadi-feature-icon">📄</div>
                    <h3><?php _e('الوثائق الحكومية', 'fadi'); ?></h3>
                    <p><?php _e('تنظيم الوثائق مع تنبيهات التجديد', 'fadi'); ?></p>
                </div>
                
                <div class="fadi-feature">
                    <div class="fadi-feature-icon">📊</div>
                    <h3><?php _e('التقارير المتقدمة', 'fadi'); ?></h3>
                    <p><?php _e('تقارير شاملة وإحصائيات تفصيلية', 'fadi'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="fadi-welcome-actions">
            <h2><?php _e('الخطوات التالية', 'fadi'); ?></h2>
            
            <div class="fadi-actions-grid">
                <div class="fadi-action-card">
                    <h3><?php _e('إعداد معلومات الشركة', 'fadi'); ?></h3>
                    <p><?php _e('قم بتحديث معلومات شركتك في الإعدادات', 'fadi'); ?></p>
                    <a href="<?php echo admin_url('admin.php?page=fadi-settings'); ?>" class="button button-primary"><?php _e('إعداد الآن', 'fadi'); ?></a>
                </div>
                
                <div class="fadi-action-card">
                    <h3><?php _e('استكشف لوحة التحكم', 'fadi'); ?></h3>
                    <p><?php _e('تعرف على واجهة النظام وإمكانياته', 'fadi'); ?></p>
                    <a href="<?php echo admin_url('admin.php?page=fadi-dashboard'); ?>" class="button button-primary"><?php _e('استكشف الآن', 'fadi'); ?></a>
                </div>
                
                <div class="fadi-action-card">
                    <h3><?php _e('إنشاء أول عرض سعر', 'fadi'); ?></h3>
                    <p><?php _e('ابدأ بإنشاء عرض سعر تجريبي', 'fadi'); ?></p>
                    <a href="<?php echo admin_url('post-new.php?post_type=quote'); ?>" class="button button-primary"><?php _e('إنشاء عرض', 'fadi'); ?></a>
                </div>
            </div>
        </div>
        
        <div class="fadi-welcome-support">
            <h2><?php _e('الدعم والمساعدة', 'fadi'); ?></h2>
            <p><?php _e('إذا واجهتك أي مشاكل أو كان لديك أسئلة، يمكنك:', 'fadi'); ?></p>
            
            <ul>
                <li><?php _e('مراجعة دليل الاستخدام المضمن', 'fadi'); ?></li>
                <li><?php _e('فحص سجلات النظام في حالة وجود أخطاء', 'fadi'); ?></li>
                <li><?php _e('التأكد من أن خادمك يلبي المتطلبات الأساسية', 'fadi'); ?></li>
            </ul>
        </div>
    </div>
    
    <style>
    .fadi-welcome {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .fadi-welcome-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        border-radius: 10px;
        margin: 20px 0;
        text-align: center;
    }
    
    .fadi-welcome-hero h2 {
        font-size: 2rem;
        margin-bottom: 15px;
    }
    
    .fadi-features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .fadi-feature {
        background: white;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #e1e5e9;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .fadi-feature-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }
    
    .fadi-feature h3 {
        color: #333;
        margin-bottom: 10px;
    }
    
    .fadi-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .fadi-action-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #e1e5e9;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .fadi-action-card h3 {
        color: #333;
        margin-bottom: 10px;
    }
    
    .fadi-action-card p {
        margin-bottom: 20px;
        color: #666;
    }
    
    .fadi-welcome-support {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        margin: 30px 0;
    }
    
    .fadi-welcome-support ul {
        list-style-type: disc;
        padding-right: 20px;
    }
    
    .fadi-welcome-support li {
        margin-bottom: 8px;
        color: #666;
    }
    </style>
    <?php
}

/**
 * إخفاء صفحة الترحيب بعد زيارتها
 */
function fadi_hide_welcome_page() {
    remove_submenu_page('themes.php', 'fadi-welcome');
}
add_action('admin_head', 'fadi_hide_welcome_page');

/**
 * فحص متطلبات النظام
 */
function fadi_check_system_requirements() {
    $requirements = array(
        'php_version' => array(
            'required' => '8.0',
            'current' => PHP_VERSION,
            'status' => version_compare(PHP_VERSION, '8.0', '>=')
        ),
        'wp_version' => array(
            'required' => '6.0',
            'current' => get_bloginfo('version'),
            'status' => version_compare(get_bloginfo('version'), '6.0', '>=')
        ),
        'memory_limit' => array(
            'required' => '256M',
            'current' => ini_get('memory_limit'),
            'status' => wp_convert_hr_to_bytes(ini_get('memory_limit')) >= wp_convert_hr_to_bytes('256M')
        ),
        'max_execution_time' => array(
            'required' => '60',
            'current' => ini_get('max_execution_time'),
            'status' => ini_get('max_execution_time') >= 60 || ini_get('max_execution_time') == 0
        )
    );
    
    $all_requirements_met = true;
    foreach ($requirements as $requirement) {
        if (!$requirement['status']) {
            $all_requirements_met = false;
            break;
        }
    }
    
    update_option('fadi_system_requirements', $requirements);
    update_option('fadi_requirements_met', $all_requirements_met);
    
    return $requirements;
}

/**
 * عرض تحذيرات المتطلبات
 */
function fadi_requirements_notice() {
    if (!get_option('fadi_requirements_met', false)) {
        $requirements = get_option('fadi_system_requirements', array());
        ?>
        <div class="notice notice-warning">
            <p><strong><?php _e('تحذير: قالب FADI', 'fadi'); ?></strong></p>
            <p><?php _e('بعض متطلبات النظام غير مستوفاة. قد يؤثر هذا على أداء القالب:', 'fadi'); ?></p>
            <ul>
                <?php foreach ($requirements as $name => $req): ?>
                    <?php if (!$req['status']): ?>
                    <li><?php printf(__('%s: مطلوب %s، موجود %s', 'fadi'), $name, $req['required'], $req['current']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}
add_action('admin_notices', 'fadi_requirements_notice');

/**
 * تشغيل فحص المتطلبات عند التفعيل
 */
add_action('after_switch_theme', 'fadi_check_system_requirements');

/**
 * إنشاء ملف robots.txt محسن
 */
function fadi_create_robots_txt() {
    $robots_content = "User-agent: *
Disallow: /wp-admin/
Disallow: /wp-includes/
Disallow: /wp-content/uploads/fadi/backups/
Disallow: /wp-content/uploads/fadi/exports/
Allow: /wp-content/uploads/

Sitemap: " . home_url('/sitemap.xml') . "
";
    
    $robots_path = ABSPATH . 'robots.txt';
    if (!file_exists($robots_path)) {
        file_put_contents($robots_path, $robots_content);
    }
}
add_action('after_switch_theme', 'fadi_create_robots_txt');

/**
 * تحديث البيانات عند ترقية القالب
 */
function fadi_theme_update_check() {
    $current_version = get_option('fadi_theme_version', '0.0');
    $new_version = '1.0';
    
    if (version_compare($current_version, $new_version, '<')) {
        // تشغيل سكريبت التحديث
        fadi_run_update_script($current_version, $new_version);
        
        // تحديث رقم الإصدار
        update_option('fadi_theme_version', $new_version);
        update_option('fadi_last_update_date', current_time('mysql'));
    }
}
add_action('after_setup_theme', 'fadi_theme_update_check');

/**
 * تشغيل سكريبت التحديث
 */
function fadi_run_update_script($from_version, $to_version) {
    // تحديث قاعدة البيانات إذا لزم الأمر
    fadi_setup_database();
    
    // إضافة التصنيفات الجديدة
    fadi_add_default_terms();
    
    // تحديث الإعدادات
    fadi_setup_default_options();
    
    // تسجيل عملية التحديث
    error_log(sprintf('FADI: Theme updated from %s to %s', $from_version, $to_version));
}