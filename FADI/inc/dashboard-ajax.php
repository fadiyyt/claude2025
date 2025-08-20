<?php
/**
 * معالج Ajax للوحة التحكم
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * معالج Ajax للحصول على إحصائيات لوحة التحكم
 */
function fadi_get_dashboard_stats() {
    // التحقق من صحة الطلب
    if (!wp_verify_nonce($_POST['nonce'], 'fadi_nonce') || !current_user_can('manage_options')) {
        wp_die('خطأ في التحقق الأمني');
    }
    
    $stats = array(
        'quotes_count' => wp_count_posts('quote')->publish,
        'suppliers_count' => wp_count_posts('supplier')->publish,
        'employees_count' => wp_count_posts('employee')->publish,
        'tenders_count' => wp_count_posts('tender')->publish,
        'documents_count' => wp_count_posts('document')->publish,
        'monthly_revenue' => fadi_calculate_monthly_revenue(),
        'pending_tasks' => fadi_get_pending_tasks_count(),
        'expiring_documents' => fadi_get_expiring_documents_count()
    );
    
    wp_send_json_success($stats);
}
add_action('wp_ajax_fadi_get_dashboard_stats', 'fadi_get_dashboard_stats');

/**
 * معالج Ajax لإنشاء عرض سعر جديد
 */
function fadi_create_new_quote() {
    if (!wp_verify_nonce($_POST['nonce'], 'fadi_nonce') || !current_user_can('manage_options')) {
        wp_die('خطأ في التحقق الأمني');
    }
    
    $client_name = sanitize_text_field($_POST['client_name']);
    $quote_date = sanitize_text_field($_POST['quote_date']);
    $description = sanitize_textarea_field($_POST['description']);
    $items = $_POST['items'];
    
    // إنشاء عرض السعر
    $quote_id = wp_insert_post(array(
        'post_title' => sprintf(__('عرض سعر - %s', 'fadi'), $client_name),
        'post_content' => $description,
        'post_status' => 'publish',
        'post_type' => 'quote',
        'meta_input' => array(
            'client_name' => $client_name,
            'quote_date' => $quote_date,
            'quote_items' => json_encode($items),
            'quote_total' => fadi_calculate_quote_total($items),
            'quote_status' => 'draft'
        )
    ));
    
    if ($quote_id) {
        wp_send_json_success(array(
            'message' => __('تم إنشاء عرض السعر بنجاح', 'fadi'),
            'quote_id' => $quote_id,
            'edit_url' => admin_url('post.php?post=' . $quote_id . '&action=edit')
        ));
    } else {
        wp_send_json_error(__('حدث خطأ في إنشاء عرض السعر', 'fadi'));
    }
}
add_action('wp_ajax_fadi_create_new_quote', 'fadi_create_new_quote');

/**
 * معالج Ajax للبحث السريع
 */
function fadi_quick_search() {
    if (!wp_verify_nonce($_POST['nonce'], 'fadi_nonce') || !current_user_can('manage_options')) {
        wp_die('خطأ في التحقق الأمني');
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $search_type = sanitize_text_field($_POST['search_type']);
    
    $results = array();
    
    switch ($search_type) {
        case 'quotes':
            $results = fadi_search_quotes($search_term);
            break;
        case 'suppliers':
            $results = fadi_search_suppliers($search_term);
            break;
        case 'employees':
            $results = fadi_search_employees($search_term);
            break;
        case 'all':
        default:
            $results = fadi_search_all($search_term);
            break;
    }
    
    wp_send_json_success($results);
}
add_action('wp_ajax_fadi_quick_search', 'fadi_quick_search');

/**
 * معالج Ajax للحصول على الإشعارات
 */
function fadi_check_notifications() {
    if (!wp_verify_nonce($_POST['nonce'], 'fadi_nonce') || !current_user_can('manage_options')) {
        wp_die('خطأ في التحقق الأمني');
    }
    
    $notifications = array();
    
    // فحص الوثائق المنتهية الصلاحية
    $expiring_docs = fadi_get_expiring_documents();
    foreach ($expiring_docs as $doc) {
        $notifications[] = array(
            'type' => 'warning',
            'message' => sprintf(__('الوثيقة %s ستنتهي صلاحيتها في %s', 'fadi'), $doc->post_title, $doc->expiry_date)
        );
    }
    
    // فحص المناقصات القريبة الانتهاء
    $expiring_tenders = fadi_get_expiring_tenders();
    foreach ($expiring_tenders as $tender) {
        $notifications[] = array(
            'type' => 'info',
            'message' => sprintf(__('المناقصة %s موعدها النهائي %s', 'fadi'), $tender->post_title, $tender->deadline)
        );
    }
    
    // فحص المهام المتأخرة
    $overdue_tasks = fadi_get_overdue_tasks();
    if (!empty($overdue_tasks)) {
        $notifications[] = array(
            'type' => 'error',
            'message' => sprintf(__('لديك %d مهمة متأخرة', 'fadi'), count($overdue_tasks))
        );
    }
    
    wp_send_json_success($notifications);
}
add_action('wp_ajax_fadi_check_notifications', 'fadi_check_notifications');

/**
 * معالج Ajax لتصدير البيانات
 */
function fadi_export_data() {
    if (!wp_verify_nonce($_POST['nonce'], 'fadi_nonce') || !current_user_can('manage_options')) {
        wp_die('خطأ في التحقق الأمني');
    }
    
    $export_type = sanitize_text_field($_POST['export_type']);
    $date_from = sanitize_text_field($_POST['date_from']);
    $date_to = sanitize_text_field($_POST['date_to']);
    
    $data = array();
    
    switch ($export_type) {
        case 'quotes':
            $data = fadi_export_quotes($date_from, $date_to);
            break;
        case 'suppliers':
            $data = fadi_export_suppliers();
            break;
        case 'employees':
            $data = fadi_export_employees();
            break;
        case 'financial':
            $data = fadi_export_financial_data($date_from, $date_to);
            break;
    }
    
    // إنشاء ملف CSV
    $filename = sprintf('fadi-export-%s-%s.csv', $export_type, date('Y-m-d'));
    $file_path = wp_upload_dir()['path'] . '/' . $filename;
    
    $file = fopen($file_path, 'w');
    fputcsv($file, array_keys($data[0])); // Headers
    
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    
    fclose($file);
    
    wp_send_json_success(array(
        'download_url' => wp_upload_dir()['url'] . '/' . $filename,
        'filename' => $filename
    ));
}
add_action('wp_ajax_fadi_export_data', 'fadi_export_data');

/**
 * معالج Ajax للنسخ الاحتياطي
 */
function fadi_create_backup() {
    if (!wp_verify_nonce($_POST['nonce'], 'fadi_nonce') || !current_user_can('manage_options')) {
        wp_die('خطأ في التحقق الأمني');
    }
    
    $backup_type = sanitize_text_field($_POST['backup_type']);
    
    try {
        $backup_result = fadi_perform_backup($backup_type);
        
        if ($backup_result['success']) {
            wp_send_json_success(array(
                'message' => __('تم إنشاء النسخة الاحتياطية بنجاح', 'fadi'),
                'backup_file' => $backup_result['file'],
                'backup_size' => size_format($backup_result['size'])
            ));
        } else {
            wp_send_json_error($backup_result['message']);
        }
    } catch (Exception $e) {
        wp_send_json_error(__('حدث خطأ في إنشاء النسخة الاحتياطية: ', 'fadi') . $e->getMessage());
    }
}
add_action('wp_ajax_fadi_create_backup', 'fadi_create_backup');

/**
 * وظائف مساعدة
 */

function fadi_calculate_monthly_revenue() {
    global $wpdb;
    
    $current_month = date('Y-m');
    
    $revenue = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(meta_value) 
        FROM {$wpdb->postmeta} pm 
        JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
        WHERE pm.meta_key = 'quote_total' 
        AND p.post_type = 'quote' 
        AND p.post_status = 'publish'
        AND DATE_FORMAT(p.post_date, '%%Y-%%m') = %s
    ", $current_month));
    
    return $revenue ? floatval($revenue) : 0;
}

function fadi_get_pending_tasks_count() {
    $tasks = get_posts(array(
        'post_type' => 'task',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'task_status',
                'value' => 'pending',
                'compare' => '='
            )
        ),
        'numberposts' => -1
    ));
    
    return count($tasks);
}

function fadi_get_expiring_documents_count() {
    $expiring_date = date('Y-m-d', strtotime('+30 days'));
    
    $documents = get_posts(array(
        'post_type' => 'document',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'expiry_date',
                'value' => $expiring_date,
                'compare' => '<='
            )
        ),
        'numberposts' => -1
    ));
    
    return count($documents);
}

function fadi_calculate_quote_total($items) {
    $total = 0;
    
    foreach ($items as $item) {
        $quantity = floatval($item['quantity']);
        $price = floatval($item['price']);
        $total += $quantity * $price;
    }
    
    // إضافة الضريبة المضافة
    $vat_rate = get_option('fadi_vat_rate', 15) / 100;
    $total_with_vat = $total * (1 + $vat_rate);
    
    return $total_with_vat;
}

function fadi_search_quotes($search_term) {
    $quotes = get_posts(array(
        'post_type' => 'quote',
        'post_status' => 'publish',
        's' => $search_term,
        'numberposts' => 10
    ));
    
    $results = array();
    foreach ($quotes as $quote) {
        $results[] = array(
            'id' => $quote->ID,
            'title' => $quote->post_title,
            'type' => 'quote',
            'date' => get_the_date('Y-m-d', $quote),
            'url' => get_permalink($quote)
        );
    }
    
    return $results;
}

function fadi_search_suppliers($search_term) {
    $suppliers = get_posts(array(
        'post_type' => 'supplier',
        'post_status' => 'publish',
        's' => $search_term,
        'numberposts' => 10
    ));
    
    $results = array();
    foreach ($suppliers as $supplier) {
        $results[] = array(
            'id' => $supplier->ID,
            'title' => $supplier->post_title,
            'type' => 'supplier',
            'contact' => get_post_meta($supplier->ID, 'supplier_contact', true),
            'url' => get_permalink($supplier)
        );
    }
    
    return $results;
}

function fadi_search_employees($search_term) {
    $employees = get_posts(array(
        'post_type' => 'employee',
        'post_status' => 'publish',
        's' => $search_term,
        'numberposts' => 10
    ));
    
    $results = array();
    foreach ($employees as $employee) {
        $results[] = array(
            'id' => $employee->ID,
            'title' => $employee->post_title,
            'type' => 'employee',
            'position' => get_post_meta($employee->ID, 'employee_position', true),
            'url' => get_permalink($employee)
        );
    }
    
    return $results;
}

function fadi_search_all($search_term) {
    $results = array();
    
    $results = array_merge($results, fadi_search_quotes($search_term));
    $results = array_merge($results, fadi_search_suppliers($search_term));
    $results = array_merge($results, fadi_search_employees($search_term));
    
    return $results;
}

function fadi_get_expiring_documents() {
    $expiring_date = date('Y-m-d', strtotime('+30 days'));
    
    return get_posts(array(
        'post_type' => 'document',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'expiry_date',
                'value' => $expiring_date,
                'compare' => '<='
            )
        ),
        'numberposts' => 5
    ));
}

function fadi_get_expiring_tenders() {
    $expiring_date = date('Y-m-d', strtotime('+7 days'));
    
    return get_posts(array(
        'post_type' => 'tender',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'tender_deadline',
                'value' => $expiring_date,
                'compare' => '<='
            )
        ),
        'numberposts' => 5
    ));
}

function fadi_get_overdue_tasks() {
    $today = date('Y-m-d');
    
    return get_posts(array(
        'post_type' => 'task',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'task_due_date',
                'value' => $today,
                'compare' => '<'
            ),
            array(
                'key' => 'task_status',
                'value' => 'completed',
                'compare' => '!='
            )
        ),
        'numberposts' => -1
    ));
}

function fadi_perform_backup($backup_type) {
    // منطق النسخ الاحتياطي
    $backup_dir = wp_upload_dir()['path'] . '/backups/';
    
    if (!file_exists($backup_dir)) {
        wp_mkdir_p($backup_dir);
    }
    
    $timestamp = date('Y-m-d_H-i-s');
    $backup_filename = "fadi-backup-{$backup_type}-{$timestamp}.zip";
    $backup_path = $backup_dir . $backup_filename;
    
    // إنشاء ملف ZIP
    $zip = new ZipArchive();
    if ($zip->open($backup_path, ZipArchive::CREATE) !== TRUE) {
        return array('success' => false, 'message' => 'لا يمكن إنشاء ملف النسخة الاحتياطية');
    }
    
    // إضافة الملفات حسب نوع النسخة الاحتياطية
    switch ($backup_type) {
        case 'database':
            $sql_file = fadi_export_database();
            $zip->addFile($sql_file, 'database.sql');
            break;
        case 'files':
            fadi_add_theme_files_to_zip($zip);
            break;
        case 'full':
            $sql_file = fadi_export_database();
            $zip->addFile($sql_file, 'database.sql');
            fadi_add_theme_files_to_zip($zip);
            break;
    }
    
    $zip->close();
    
    return array(
        'success' => true,
        'file' => $backup_filename,
        'size' => filesize($backup_path)
    );
}

function fadi_export_database() {
    // تصدير قاعدة البيانات
    global $wpdb;
    
    $backup_dir = wp_upload_dir()['path'] . '/backups/';
    $sql_file = $backup_dir . 'database_' . date('Y-m-d_H-i-s') . '.sql';
    
    // هنا يمكن إضافة منطق تصدير قاعدة البيانات
    // لأغراض الأمان، سنقوم بتصدير جداول FADI فقط
    
    $tables = array(
        $wpdb->posts,
        $wpdb->postmeta,
        $wpdb->options
    );
    
    $sql_content = '';
    foreach ($tables as $table) {
        $sql_content .= fadi_export_table($table);
    }
    
    file_put_contents($sql_file, $sql_content);
    
    return $sql_file;
}

function fadi_export_table($table) {
    global $wpdb;
    
    $sql = '';
    $sql .= "-- Table: {$table}\n";
    $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";
    
    // إنشاء الجدول
    $create_table = $wpdb->get_row("SHOW CREATE TABLE `{$table}`", ARRAY_N);
    $sql .= $create_table[1] . ";\n\n";
    
    // بيانات الجدول (للجداول المهمة فقط)
    if (in_array($table, array($wpdb->posts, $wpdb->postmeta))) {
        $rows = $wpdb->get_results("SELECT * FROM `{$table}` WHERE post_type IN ('quote', 'supplier', 'employee', 'tender', 'document')", ARRAY_A);
        
        if (!empty($rows)) {
            $sql .= "INSERT INTO `{$table}` VALUES \n";
            $values = array();
            
            foreach ($rows as $row) {
                $values[] = "('" . implode("','", array_map('esc_sql', $row)) . "')";
            }
            
            $sql .= implode(",\n", $values) . ";\n\n";
        }
    }
    
    return $sql;
}

function fadi_add_theme_files_to_zip($zip) {
    $theme_dir = get_template_directory();
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($theme_dir),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    
    foreach ($iterator as $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($theme_dir) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }
}