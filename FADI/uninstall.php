<?php
/**
 * ملف إلغاء التثبيت الكامل للقالب
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('WP_UNINSTALL_PLUGIN') && !defined('ABSPATH')) {
    exit;
}

// التحقق من الصلاحيات
if (!current_user_can('manage_options')) {
    return;
}

/**
 * إزالة جميع بيانات القالب
 */
function fadi_complete_uninstall() {
    global $wpdb;
    
    // 1. إزالة المهام المجدولة
    fadi_uninstall_clear_cron_jobs();
    
    // 2. حذف الجداول المخصصة
    fadi_uninstall_drop_tables();
    
    // 3. حذف جميع المحتوى المخصص
    fadi_uninstall_delete_content();
    
    // 4. إزالة الإعدادات
    fadi_uninstall_remove_options();
    
    // 5. حذف الملفات المرفوعة
    fadi_uninstall_delete_files();
    
    // 6. تنظيف قاعدة البيانات
    fadi_uninstall_cleanup_database();
    
    // 7. إزالة قواعد .htaccess
    fadi_uninstall_remove_htaccess_rules();
    
    // 8. تسجيل عملية الإلغاء
    error_log('FADI: Complete uninstallation completed at ' . current_time('mysql'));
}

/**
 * إزالة المهام المجدولة
 */
function fadi_uninstall_clear_cron_jobs() {
    $cron_jobs = array(
        'fadi_daily_cleanup',
        'fadi_check_expiring_documents',
        'fadi_send_monthly_reports',
        'fadi_weekly_backup',
        'fadi_check_tender_deadlines',
        'fadi_update_statistics'
    );
    
    foreach ($cron_jobs as $job) {
        wp_clear_scheduled_hook($job);
    }
    
    // إزالة مهام التذكير الفردية
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_doing_cron%'");
}

/**
 * حذف الجداول المخصصة
 */
function fadi_uninstall_drop_tables() {
    global $wpdb;
    
    $tables_to_drop = array(
        $wpdb->prefix . 'fadi_activities',
        $wpdb->prefix . 'fadi_statistics',
    );
    
    foreach ($tables_to_drop as $table) {
        $wpdb->query("DROP TABLE IF EXISTS {$table}");
    }
    
    // إزالة الفهارس المخصصة
    $wpdb->query("ALTER TABLE {$wpdb->posts} DROP INDEX IF EXISTS fadi_post_type_status");
    $wpdb->query("ALTER TABLE {$wpdb->postmeta} DROP INDEX IF EXISTS fadi_meta_key_value");
}

/**
 * حذف جميع المحتوى المخصص
 */
function fadi_uninstall_delete_content() {
    global $wpdb;
    
    // أنواع المحتوى المخصصة
    $custom_post_types = array('quote', 'supplier', 'employee', 'tender', 'document', 'task');
    
    foreach ($custom_post_types as $post_type) {
        // الحصول على جميع المقالات من هذا النوع
        $posts = get_posts(array(
            'post_type' => $post_type,
            'numberposts' => -1,
            'post_status' => 'any'
        ));
        
        // حذف كل مقال وبياناته الوصفية
        foreach ($posts as $post) {
            // حذف البيانات الوصفية
            $wpdb->delete($wpdb->postmeta, array('post_id' => $post->ID));
            
            // حذف علاقات التصنيفات
            $wpdb->delete($wpdb->term_relationships, array('object_id' => $post->ID));
            
            // حذف المقال
            $wpdb->delete($wpdb->posts, array('ID' => $post->ID));
        }
    }
    
    // حذف التصنيفات المخصصة
    $custom_taxonomies = array(
        'quote_category', 'quote_status', 'supplier_category', 
        'employee_department', 'tender_status', 'document_type'
    );
    
    foreach ($custom_taxonomies as $taxonomy) {
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false
        ));
        
        foreach ($terms as $term) {
            wp_delete_term($term->term_id, $taxonomy);
        }
    }
    
    // حذف الصفحات المخصصة
    $custom_pages = array('dashboard', 'quotes', 'purchases', 'employees', 'tenders', 'documents');
    
    foreach ($custom_pages as $page_slug) {
        $page = get_page_by_path($page_slug);
        if ($page) {
            wp_delete_post($page->ID, true);
        }
    }
}

/**
 * إزالة جميع الإعدادات
 */
function fadi_uninstall_remove_options() {
    global $wpdb;
    
    // قائمة الإعدادات المحددة
    $specific_options = array(
        'fadi_company_name', 'fadi_company_address', 'fadi_company_phone', 'fadi_company_email',
        'fadi_vat_rate', 'fadi_auto_backup', 'fadi_backup_frequency', 'fadi_log_activities',
        'fadi_session_timeout', 'fadi_show_stats', 'fadi_items_per_page', 'fadi_primary_color',
        'fadi_secondary_color', 'fadi_background_color', 'fadi_primary_font', 'fadi_font_size',
        'fadi_failed_logins', 'fadi_security_enabled', 'fadi_monthly_reports', 'fadi_report_email',
        'fadi_installation_date', 'fadi_theme_version', 'fadi_deactivation_date',
        'fadi_last_cleanup', 'fadi_last_update_date', 'fadi_system_requirements',
        'fadi_requirements_met', 'fadi_live_statistics', 'fadi_dashboard_page_id',
        'fadi_last_customizer_update'
    );
    
    foreach ($specific_options as $option) {
        delete_option($option);
    }
    
    // حذف جميع الإعدادات التي تبدأ بـ fadi_
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'fadi_%'");
    
    // حذف التقارير الشهرية المحفوظة
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'fadi_monthly_report_%'");
    
    // حذف البيانات الوصفية للمستخدمين المرتبطة بـ FADI
    $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key LIKE 'fadi_%'");
    
    // حذف transients
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_fadi_%'");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_fadi_%'");
}

/**
 * حذف الملفات المرفوعة
 */
function fadi_uninstall_delete_files() {
    $upload_dir = wp_upload_dir();
    $fadi_dir = $upload_dir['basedir'] . '/fadi';
    
    if (is_dir($fadi_dir)) {
        fadi_uninstall_recursive_delete($fadi_dir);
    }
    
    // حذف ملفات النسخ الاحتياطي المتناثرة
    $backup_files = glob($upload_dir['basedir'] . '/fadi-backup-*.zip');
    foreach ($backup_files as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
    
    // حذف ملفات التصدير المتناثرة
    $export_files = glob($upload_dir['basedir'] . '/fadi-export-*.csv');
    foreach ($export_files as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}

/**
 * حذف مجلد بشكل تكراري
 */
function fadi_uninstall_recursive_delete($dir) {
    if (!is_dir($dir)) {
        return false;
    }
    
    $files = array_diff(scandir($dir), array('.', '..'));
    
    foreach ($files as $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        
        if (is_dir($path)) {
            fadi_uninstall_recursive_delete($path);
        } else {
            unlink($path);
        }
    }
    
    return rmdir($dir);
}

/**
 * تنظيف قاعدة البيانات
 */
function fadi_uninstall_cleanup_database() {
    global $wpdb;
    
    // حذف التعليقات اليتيمة (إن وجدت)
    $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_post_ID NOT IN (SELECT ID FROM {$wpdb->posts})");
    
    // حذف البيانات الوصفية اليتيمة
    $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT ID FROM {$wpdb->posts})");
    $wpdb->query("DELETE FROM {$wpdb->termmeta} WHERE term_id NOT IN (SELECT term_id FROM {$wpdb->terms})");
    
    // حذف علاقات التصنيفات اليتيمة
    $wpdb->query("DELETE FROM {$wpdb->term_relationships} WHERE object_id NOT IN (SELECT ID FROM {$wpdb->posts})");
    $wpdb->query("DELETE FROM {$wpdb->term_relationships} WHERE term_taxonomy_id NOT IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy})");
    
    // تحسين الجداول
    $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->postmeta}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->options}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->terms}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->term_taxonomy}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->term_relationships}");
}

/**
 * إزالة قواعد .htaccess
 */
function fadi_uninstall_remove_htaccess_rules() {
    $htaccess_path = ABSPATH . '.htaccess';
    
    if (file_exists($htaccess_path)) {
        $htaccess_content = file_get_contents($htaccess_path);
        
        // إزالة قواعد FADI
        $htaccess_content = preg_replace(
            '/# FADI Security Rules - Start.*?# FADI Security Rules - End\n*/s',
            '',
            $htaccess_content
        );
        
        file_put_contents($htaccess_path, $htaccess_content);
    }
}

/**
 * التأكيد على الإلغاء
 */
function fadi_confirm_uninstall() {
    if (isset($_POST['confirm_uninstall']) && $_POST['confirm_uninstall'] === 'yes') {
        if (wp_verify_nonce($_POST['uninstall_nonce'], 'fadi_uninstall')) {
            fadi_complete_uninstall();
            
            wp_redirect(admin_url('themes.php?uninstalled=true'));
            exit;
        }
    }
}

// تشغيل عملية الإلغاء إذا تم استدعاءها من WordPress
if (defined('WP_UNINSTALL_PLUGIN') || (isset($_GET['action']) && $_GET['action'] === 'fadi_uninstall')) {
    fadi_complete_uninstall();
}

/**
 * إضافة صفحة إلغاء التثبيت في الإدارة
 */
function fadi_add_uninstall_page() {
    add_submenu_page(
        'fadi-dashboard',
        __('إلغاء تثبيت القالب', 'fadi'),
        __('إلغاء التثبيت', 'fadi'),
        'manage_options',
        'fadi-uninstall',
        'fadi_uninstall_page'
    );
}
add_action('admin_menu', 'fadi_add_uninstall_page');

/**
 * صفحة إلغاء التثبيت
 */
function fadi_uninstall_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('إلغاء تثبيت قالب FADI', 'fadi'); ?></h1>
        
        <div class="notice notice-warning">
            <p><strong><?php _e('تحذير:', 'fadi'); ?></strong> <?php _e('هذا الإجراء سيحذف جميع بيانات القالب نهائياً ولا يمكن التراجع عنه!', 'fadi'); ?></p>
        </div>
        
        <div class="fadi-uninstall-info">
            <h2><?php _e('ما الذي سيتم حذفه؟', 'fadi'); ?></h2>
            <ul>
                <li><?php _e('جميع عروض الأسعار والموردين والموظفين', 'fadi'); ?></li>
                <li><?php _e('جميع المناقصات والوثائق والمهام', 'fadi'); ?></li>
                <li><?php _e('جميع الإعدادات والتخصيصات', 'fadi'); ?></li>
                <li><?php _e('جميع النسخ الاحتياطية والتقارير', 'fadi'); ?></li>
                <li><?php _e('جميع الملفات المرفوعة المرتبطة بالقالب', 'fadi'); ?></li>
                <li><?php _e('جداول قاعدة البيانات المخصصة', 'fadi'); ?></li>
            </ul>
        </div>
        
        <form method="post" action="" onsubmit="return confirm('<?php _e('هل أنت متأكد تماماً من حذف جميع بيانات القالب نهائياً؟', 'fadi'); ?>');">
            <?php wp_nonce_field('fadi_uninstall', 'uninstall_nonce'); ?>
            
            <h3><?php _e('تأكيد الإلغاء', 'fadi'); ?></h3>
            <label>
                <input type="checkbox" name="confirm_uninstall" value="yes" required>
                <?php _e('أؤكد أنني أريد حذف جميع بيانات قالب FADI نهائياً', 'fadi'); ?>
            </label>
            
            <p>
                <input type="submit" name="submit" class="button button-primary" value="<?php _e('إلغاء التثبيت نهائياً', 'fadi'); ?>" />
                <a href="<?php echo admin_url('admin.php?page=fadi-dashboard'); ?>" class="button"><?php _e('إلغاء', 'fadi'); ?></a>
            </p>
        </form>
    </div>
    
    <style>
    .fadi-uninstall-info {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        margin: 20px 0;
    }
    
    .fadi-uninstall-info ul {
        list-style-type: disc;
        padding-right: 20px;
    }
    
    .fadi-uninstall-info li {
        margin-bottom: 8px;
        color: #d63384;
    }
    </style>
    <?php
}

// معالجة طلب الإلغاء
add_action('admin_init', 'fadi_confirm_uninstall');