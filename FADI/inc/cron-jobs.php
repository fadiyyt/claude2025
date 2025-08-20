<?php
/**
 * المهام المجدولة والكرون جوبز
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * تسجيل المهام المجدولة
 */
function fadi_schedule_cron_jobs() {
    // تنظيف قاعدة البيانات يومياً
    if (!wp_next_scheduled('fadi_daily_cleanup')) {
        wp_schedule_event(time(), 'daily', 'fadi_daily_cleanup');
    }
    
    // فحص الوثائق المنتهية الصلاحية أسبوعياً
    if (!wp_next_scheduled('fadi_check_expiring_documents')) {
        wp_schedule_event(time(), 'weekly', 'fadi_check_expiring_documents');
    }
    
    // إرسال تقارير شهرية
    if (!wp_next_scheduled('fadi_send_monthly_reports')) {
        wp_schedule_event(time(), 'monthly', 'fadi_send_monthly_reports');
    }
    
    // نسخ احتياطي أسبوعي
    if (!wp_next_scheduled('fadi_weekly_backup')) {
        wp_schedule_event(time(), 'weekly', 'fadi_weekly_backup');
    }
    
    // فحص المناقصات المقتربة من الانتهاء يومياً
    if (!wp_next_scheduled('fadi_check_tender_deadlines')) {
        wp_schedule_event(time(), 'daily', 'fadi_check_tender_deadlines');
    }
    
    // تحديث الإحصائيات كل ساعة
    if (!wp_next_scheduled('fadi_update_statistics')) {
        wp_schedule_event(time(), 'hourly', 'fadi_update_statistics');
    }
}
add_action('wp', 'fadi_schedule_cron_jobs');

/**
 * إضافة فترات كرون مخصصة
 */
function fadi_add_cron_intervals($schedules) {
    $schedules['monthly'] = array(
        'interval' => 30 * DAY_IN_SECONDS,
        'display' => __('شهرياً', 'fadi')
    );
    
    $schedules['weekly'] = array(
        'interval' => 7 * DAY_IN_SECONDS,
        'display' => __('أسبوعياً', 'fadi')
    );
    
    return $schedules;
}
add_filter('cron_schedules', 'fadi_add_cron_intervals');

/**
 * تنظيف قاعدة البيانات اليومي
 */
function fadi_daily_cleanup() {
    global $wpdb;
    
    // حذف المراجعات القديمة (أكثر من 30 يوم)
    $wpdb->query("
        DELETE FROM {$wpdb->posts} 
        WHERE post_type = 'revision' 
        AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
    ");
    
    // حذف التعليقات المرفوضة القديمة
    $wpdb->query("
        DELETE FROM {$wpdb->comments} 
        WHERE comment_approved = 'spam' 
        AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
    ");
    
    // تنظيف transients منتهية الصلاحية
    $wpdb->query("
        DELETE FROM {$wpdb->options} 
        WHERE option_name LIKE '_transient_timeout_%' 
        AND option_value < UNIX_TIMESTAMP()
    ");
    
    // تحسين جداول قاعدة البيانات
    $tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);
    foreach ($tables as $table) {
        $wpdb->query("OPTIMIZE TABLE {$table[0]}");
    }
    
    // تسجيل النشاط
    update_option('fadi_last_cleanup', current_time('mysql'));
    error_log('FADI: Daily cleanup completed at ' . current_time('mysql'));
}
add_action('fadi_daily_cleanup', 'fadi_daily_cleanup');

/**
 * فحص الوثائق المنتهية الصلاحية
 */
function fadi_check_expiring_documents() {
    // البحث عن الوثائق التي ستنتهي خلال 30 يوم
    $expiring_docs = get_posts(array(
        'post_type' => 'document',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'expiry_date',
                'value' => array(
                    date('Y-m-d'),
                    date('Y-m-d', strtotime('+30 days'))
                ),
                'compare' => 'BETWEEN',
                'type' => 'DATE'
            )
        ),
        'numberposts' => -1
    ));
    
    if (!empty($expiring_docs)) {
        $admin_email = get_option('admin_email');
        $subject = sprintf(__('تنبيه: %d وثيقة ستنتهي صلاحيتها قريباً', 'fadi'), count($expiring_docs));
        
        $message = __('الوثائق التالية ستنتهي صلاحيتها خلال الـ 30 يوم القادمة:', 'fadi') . "\n\n";
        
        foreach ($expiring_docs as $doc) {
            $expiry_date = get_post_meta($doc->ID, 'expiry_date', true);
            $days_left = ceil((strtotime($expiry_date) - time()) / DAY_IN_SECONDS);
            
            $message .= sprintf(
                "- %s (تنتهي في %s - %d يوم متبقي)\n",
                $doc->post_title,
                $expiry_date,
                $days_left
            );
        }
        
        $message .= "\n" . __('يرجى اتخاذ الإجراءات اللازمة لتجديد هذه الوثائق.', 'fadi');
        
        wp_mail($admin_email, $subject, $message);
        
        // تسجيل في السجل
        error_log(sprintf('FADI: Sent expiring documents notification for %d documents', count($expiring_docs)));
    }
}
add_action('fadi_check_expiring_documents', 'fadi_check_expiring_documents');

/**
 * إرسال التقارير الشهرية
 */
function fadi_send_monthly_reports() {
    $admin_email = get_option('admin_email');
    $current_month = date('Y-m');
    $month_name = date_i18n('F Y');
    
    // جمع الإحصائيات
    $stats = array(
        'quotes_created' => fadi_get_monthly_count('quote', $current_month),
        'quotes_sent' => fadi_get_monthly_count_by_status('quote', 'sent', $current_month),
        'quotes_approved' => fadi_get_monthly_count_by_status('quote', 'approved', $current_month),
        'total_revenue' => fadi_get_monthly_revenue($current_month),
        'new_suppliers' => fadi_get_monthly_count('supplier', $current_month),
        'new_employees' => fadi_get_monthly_count('employee', $current_month),
        'tenders_submitted' => fadi_get_monthly_count_by_status('tender', 'submitted', $current_month),
        'documents_expiring' => fadi_get_expiring_documents_count()
    );
    
    $subject = sprintf(__('التقرير الشهري لنظام FADI - %s', 'fadi'), $month_name);
    
    $message = sprintf(__('التقرير الشهري لشهر %s', 'fadi'), $month_name) . "\n\n";
    $message .= "==========================================\n\n";
    
    $message .= __('عروض الأسعار:', 'fadi') . "\n";
    $message .= sprintf(__('- تم إنشاء: %d عرض', 'fadi'), $stats['quotes_created']) . "\n";
    $message .= sprintf(__('- تم إرسال: %d عرض', 'fadi'), $stats['quotes_sent']) . "\n";
    $message .= sprintf(__('- تمت الموافقة على: %d عرض', 'fadi'), $stats['quotes_approved']) . "\n\n";
    
    $message .= sprintf(__('إجمالي الإيرادات: %s ر.س', 'fadi'), number_format($stats['total_revenue'], 2)) . "\n\n";
    
    $message .= __('إدارة الموردين:', 'fadi') . "\n";
    $message .= sprintf(__('- موردين جدد: %d', 'fadi'), $stats['new_suppliers']) . "\n\n";
    
    $message .= __('شؤون الموظفين:', 'fadi') . "\n";
    $message .= sprintf(__('- موظفين جدد: %d', 'fadi'), $stats['new_employees']) . "\n\n";
    
    $message .= __('المناقصات:', 'fadi') . "\n";
    $message .= sprintf(__('- تم التقديم على: %d مناقصة', 'fadi'), $stats['tenders_submitted']) . "\n\n";
    
    if ($stats['documents_expiring'] > 0) {
        $message .= sprintf(__('تحذير: %d وثيقة ستنتهي صلاحيتها قريباً!', 'fadi'), $stats['documents_expiring']) . "\n\n";
    }
    
    $message .= "==========================================\n";
    $message .= __('تم إنشاء هذا التقرير تلقائياً بواسطة نظام FADI', 'fadi');
    
    wp_mail($admin_email, $subject, $message);
    
    // حفظ التقرير في قاعدة البيانات
    $report_data = array(
        'month' => $current_month,
        'stats' => $stats,
        'generated_at' => current_time('mysql')
    );
    
    update_option('fadi_monthly_report_' . $current_month, $report_data);
    
    error_log('FADI: Monthly report sent for ' . $month_name);
}
add_action('fadi_send_monthly_reports', 'fadi_send_monthly_reports');

/**
 * النسخ الاحتياطي الأسبوعي
 */
function fadi_weekly_backup() {
    if (!get_theme_mod('fadi_auto_backup', false)) {
        return; // النسخ الاحتياطي معطل
    }
    
    try {
        $backup_result = fadi_perform_backup('database');
        
        if ($backup_result['success']) {
            $admin_email = get_option('admin_email');
            $subject = __('نجح إنشاء النسخة الاحتياطية الأسبوعية', 'fadi');
            $message = sprintf(
                __('تم إنشاء النسخة الاحتياطية بنجاح.\nاسم الملف: %s\nحجم الملف: %s\nالتاريخ: %s', 'fadi'),
                $backup_result['file'],
                size_format($backup_result['size']),
                current_time('Y-m-d H:i:s')
            );
            
            wp_mail($admin_email, $subject, $message);
            error_log('FADI: Weekly backup completed successfully');
        } else {
            throw new Exception($backup_result['message']);
        }
    } catch (Exception $e) {
        $admin_email = get_option('admin_email');
        $subject = __('فشل في إنشاء النسخة الاحتياطية الأسبوعية', 'fadi');
        $message = sprintf(
            __('حدث خطأ أثناء إنشاء النسخة الاحتياطية:\n%s\n\nيرجى فحص النظام والمحاولة مرة أخرى.', 'fadi'),
            $e->getMessage()
        );
        
        wp_mail($admin_email, $subject, $message);
        error_log('FADI: Weekly backup failed - ' . $e->getMessage());
    }
}
add_action('fadi_weekly_backup', 'fadi_weekly_backup');

/**
 * فحص مواعيد المناقصات
 */
function fadi_check_tender_deadlines() {
    // البحث عن المناقصات التي ستنتهي خلال 7 أيام
    $upcoming_tenders = get_posts(array(
        'post_type' => 'tender',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'tender_deadline',
                'value' => array(
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s', strtotime('+7 days'))
                ),
                'compare' => 'BETWEEN',
                'type' => 'DATETIME'
            )
        ),
        'numberposts' => -1
    ));
    
    if (!empty($upcoming_tenders)) {
        $admin_email = get_option('admin_email');
        $subject = sprintf(__('تنبيه: %d مناقصة تقترب من الموعد النهائي', 'fadi'), count($upcoming_tenders));
        
        $message = __('المناقصات التالية تقترب من مواعيدها النهائية:', 'fadi') . "\n\n";
        
        foreach ($upcoming_tenders as $tender) {
            $deadline = get_post_meta($tender->ID, 'tender_deadline', true);
            $organization = get_post_meta($tender->ID, 'tender_organization', true);
            $hours_left = ceil((strtotime($deadline) - time()) / 3600);
            
            $message .= sprintf(
                "- %s (%s)\n  الموعد النهائي: %s (%d ساعة متبقية)\n\n",
                $tender->post_title,
                $organization,
                $deadline,
                $hours_left
            );
        }
        
        $message .= __('يرجى مراجعة هذه المناقصات واتخاذ الإجراءات اللازمة.', 'fadi');
        
        wp_mail($admin_email, $subject, $message);
        
        error_log(sprintf('FADI: Sent tender deadline notification for %d tenders', count($upcoming_tenders)));
    }
}
add_action('fadi_check_tender_deadlines', 'fadi_check_tender_deadlines');

/**
 * تحديث الإحصائيات
 */
function fadi_update_statistics() {
    $stats = array(
        'total_quotes' => wp_count_posts('quote')->publish,
        'total_suppliers' => wp_count_posts('supplier')->publish,
        'total_employees' => wp_count_posts('employee')->publish,
        'total_tenders' => wp_count_posts('tender')->publish,
        'total_documents' => wp_count_posts('document')->publish,
        'monthly_revenue' => fadi_get_monthly_revenue(date('Y-m')),
        'yearly_revenue' => fadi_get_yearly_revenue(date('Y')),
        'pending_tasks' => fadi_get_pending_tasks_count(),
        'expiring_documents' => fadi_get_expiring_documents_count(),
        'last_updated' => current_time('mysql')
    );
    
    update_option('fadi_live_statistics', $stats);
}
add_action('fadi_update_statistics', 'fadi_update_statistics');

/**
 * وظائف مساعدة للإحصائيات
 */
function fadi_get_monthly_count($post_type, $month) {
    global $wpdb;
    
    return $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s 
        AND post_status = 'publish'
        AND DATE_FORMAT(post_date, '%%Y-%%m') = %s
    ", $post_type, $month));
}

function fadi_get_monthly_count_by_status($post_type, $status, $month) {
    global $wpdb;
    
    return $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT p.ID) 
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
        WHERE p.post_type = %s 
        AND p.post_status = 'publish'
        AND DATE_FORMAT(p.post_date, '%%Y-%%m') = %s
        AND t.slug = %s
    ", $post_type, $month, $status));
}

function fadi_get_monthly_revenue($month) {
    global $wpdb;
    
    $revenue = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(CAST(pm.meta_value AS DECIMAL(10,2))) 
        FROM {$wpdb->postmeta} pm 
        JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
        LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
        WHERE pm.meta_key = 'total_amount' 
        AND p.post_type = 'quote' 
        AND p.post_status = 'publish'
        AND DATE_FORMAT(p.post_date, '%%Y-%%m') = %s
        AND t.slug = 'approved'
    ", $month));
    
    return $revenue ? floatval($revenue) : 0;
}

function fadi_get_yearly_revenue($year) {
    global $wpdb;
    
    $revenue = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(CAST(pm.meta_value AS DECIMAL(10,2))) 
        FROM {$wpdb->postmeta} pm 
        JOIN {$wpdb->posts} p ON pm.post_id = p.ID 
        LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
        WHERE pm.meta_key = 'total_amount' 
        AND p.post_type = 'quote' 
        AND p.post_status = 'publish'
        AND DATE_FORMAT(p.post_date, '%%Y') = %s
        AND t.slug = 'approved'
    ", $year));
    
    return $revenue ? floatval($revenue) : 0;
}

/**
 * إلغاء المهام المجدولة عند إلغاء تفعيل القالب
 */
function fadi_clear_scheduled_jobs() {
    $cron_jobs = array(
        'fadi_daily_cleanup',
        'fadi_check_expiring_documents',
        'fadi_send_monthly_reports',
        'fadi_weekly_backup',
        'fadi_check_tender_deadlines',
        'fadi_update_statistics'
    );
    
    foreach ($cron_jobs as $job) {
        $timestamp = wp_next_scheduled($job);
        if ($timestamp) {
            wp_unschedule_event($timestamp, $job);
        }
    }
}
add_action('switch_theme', 'fadi_clear_scheduled_jobs');

/**
 * إضافة صفحة مراقبة الكرون في الإدارة
 */
function fadi_add_cron_monitor_page() {
    add_submenu_page(
        'fadi-dashboard',
        __('مراقبة المهام المجدولة', 'fadi'),
        __('المهام المجدولة', 'fadi'),
        'manage_options',
        'fadi-cron-monitor',
        'fadi_cron_monitor_page'
    );
}
add_action('admin_menu', 'fadi_add_cron_monitor_page');

/**
 * صفحة مراقبة المهام المجدولة
 */
function fadi_cron_monitor_page() {
    $cron_jobs = array(
        'fadi_daily_cleanup' => __('تنظيف قاعدة البيانات اليومي', 'fadi'),
        'fadi_check_expiring_documents' => __('فحص الوثائق المنتهية الصلاحية', 'fadi'),
        'fadi_send_monthly_reports' => __('إرسال التقارير الشهرية', 'fadi'),
        'fadi_weekly_backup' => __('النسخ الاحتياطي الأسبوعي', 'fadi'),
        'fadi_check_tender_deadlines' => __('فحص مواعيد المناقصات', 'fadi'),
        'fadi_update_statistics' => __('تحديث الإحصائيات', 'fadi')
    );
    
    ?>
    <div class="wrap">
        <h1><?php _e('مراقبة المهام المجدولة', 'fadi'); ?></h1>
        
        <div class="fadi-cron-status">
            <h2><?php _e('حالة المهام المجدولة', 'fadi'); ?></h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php _e('المهمة', 'fadi'); ?></th>
                        <th><?php _e('الحالة', 'fadi'); ?></th>
                        <th><?php _e('التشغيل التالي', 'fadi'); ?></th>
                        <th><?php _e('الإجراءات', 'fadi'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cron_jobs as $job => $name): ?>
                    <tr>
                        <td><strong><?php echo esc_html($name); ?></strong></td>
                        <td>
                            <?php 
                            $next_run = wp_next_scheduled($job);
                            if ($next_run) {
                                echo '<span style="color: green;">✅ ' . __('نشط', 'fadi') . '</span>';
                            } else {
                                echo '<span style="color: red;">❌ ' . __('معطل', 'fadi') . '</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php 
                            if ($next_run) {
                                echo date_i18n('Y-m-d H:i:s', $next_run);
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($next_run): ?>
                                <a href="?page=fadi-cron-monitor&action=run_now&job=<?php echo esc_attr($job); ?>" class="button button-small"><?php _e('تشغيل الآن', 'fadi'); ?></a>
                            <?php else: ?>
                                <a href="?page=fadi-cron-monitor&action=schedule&job=<?php echo esc_attr($job); ?>" class="button button-primary button-small"><?php _e('تفعيل', 'fadi'); ?></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="fadi-cron-logs">
            <h2><?php _e('سجل آخر الأنشطة', 'fadi'); ?></h2>
            <div style="background: #f1f1f1; padding: 15px; border-radius: 5px; font-family: monospace; max-height: 300px; overflow-y: auto;">
                <?php
                $log_file = WP_CONTENT_DIR . '/debug.log';
                if (file_exists($log_file)) {
                    $logs = file_get_contents($log_file);
                    $fadi_logs = array_filter(explode("\n", $logs), function($line) {
                        return strpos($line, 'FADI:') !== false;
                    });
                    
                    $recent_logs = array_slice(array_reverse($fadi_logs), 0, 20);
                    foreach ($recent_logs as $log) {
                        echo esc_html($log) . "<br>";
                    }
                } else {
                    echo __('لا توجد سجلات متاحة', 'fadi');
                }
                ?>
            </div>
        </div>
    </div>
    
    <?php
    // معالجة الإجراءات
    if (isset($_GET['action']) && isset($_GET['job'])) {
        $job = sanitize_text_field($_GET['job']);
        $action = sanitize_text_field($_GET['action']);
        
        if (array_key_exists($job, $cron_jobs)) {
            switch ($action) {
                case 'run_now':
                    do_action($job);
                    echo '<div class="notice notice-success"><p>' . sprintf(__('تم تشغيل المهمة "%s" بنجاح', 'fadi'), $cron_jobs[$job]) . '</p></div>';
                    break;
                case 'schedule':
                    wp_schedule_event(time(), 'daily', $job);
                    echo '<div class="notice notice-success"><p>' . sprintf(__('تم تفعيل المهمة "%s"', 'fadi'), $cron_jobs[$job]) . '</p></div>';
                    break;
            }
        }
    }
}