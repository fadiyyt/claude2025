<?php
/**
 * نظام التقارير والإحصائيات المتقدمة
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * إضافة صفحة التقارير في الإدارة
 */
function fadi_add_reports_page() {
    add_submenu_page(
        'fadi-dashboard',
        __('التقارير والإحصائيات', 'fadi'),
        __('التقارير', 'fadi'),
        'manage_options',
        'fadi-reports',
        'fadi_reports_page'
    );
}
add_action('admin_menu', 'fadi_add_reports_page');

/**
 * صفحة التقارير الرئيسية
 */
function fadi_reports_page() {
    $current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'overview';
    ?>
    <div class="wrap">
        <h1><?php _e('التقارير والإحصائيات', 'fadi'); ?></h1>
        
        <h2 class="nav-tab-wrapper">
            <a href="?page=fadi-reports&tab=overview" class="nav-tab <?php echo $current_tab == 'overview' ? 'nav-tab-active' : ''; ?>"><?php _e('نظرة عامة', 'fadi'); ?></a>
            <a href="?page=fadi-reports&tab=quotes" class="nav-tab <?php echo $current_tab == 'quotes' ? 'nav-tab-active' : ''; ?>"><?php _e('عروض الأسعار', 'fadi'); ?></a>
            <a href="?page=fadi-reports&tab=financial" class="nav-tab <?php echo $current_tab == 'financial' ? 'nav-tab-active' : ''; ?>"><?php _e('التقارير المالية', 'fadi'); ?></a>
            <a href="?page=fadi-reports&tab=suppliers" class="nav-tab <?php echo $current_tab == 'suppliers' ? 'nav-tab-active' : ''; ?>"><?php _e('الموردين', 'fadi'); ?></a>
            <a href="?page=fadi-reports&tab=employees" class="nav-tab <?php echo $current_tab == 'employees' ? 'nav-tab-active' : ''; ?>"><?php _e('الموظفين', 'fadi'); ?></a>
            <a href="?page=fadi-reports&tab=tenders" class="nav-tab <?php echo $current_tab == 'tenders' ? 'nav-tab-active' : ''; ?>"><?php _e('المناقصات', 'fadi'); ?></a>
        </h2>
        
        <div class="fadi-reports-content">
            <?php
            switch ($current_tab) {
                case 'overview':
                    fadi_reports_overview();
                    break;
                case 'quotes':
                    fadi_reports_quotes();
                    break;
                case 'financial':
                    fadi_reports_financial();
                    break;
                case 'suppliers':
                    fadi_reports_suppliers();
                    break;
                case 'employees':
                    fadi_reports_employees();
                    break;
                case 'tenders':
                    fadi_reports_tenders();
                    break;
                default:
                    fadi_reports_overview();
            }
            ?>
        </div>
    </div>
    
    <style>
    .fadi-report-widget {
        background: white;
        padding: 20px;
        margin: 20px 0;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .fadi-stats-row {
        display: flex;
        gap: 20px;
        margin: 20px 0;
        flex-wrap: wrap;
    }
    
    .fadi-stat-box {
        flex: 1;
        min-width: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }
    
    .fadi-stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }
    
    .fadi-stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .fadi-chart-container {
        height: 300px;
        background: #f9f9f9;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px 0;
    }
    </style>
    <?php
}

/**
 * تقرير النظرة العامة
 */
function fadi_reports_overview() {
    $stats = get_option('fadi_live_statistics', array());
    ?>
    <div class="fadi-report-widget">
        <h2><?php _e('الإحصائيات العامة', 'fadi'); ?></h2>
        
        <div class="fadi-stats-row">
            <div class="fadi-stat-box">
                <span class="fadi-stat-number"><?php echo $stats['total_quotes'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('إجمالي عروض الأسعار', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box">
                <span class="fadi-stat-number"><?php echo $stats['total_suppliers'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('إجمالي الموردين', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box">
                <span class="fadi-stat-number"><?php echo $stats['total_employees'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('إجمالي الموظفين', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box">
                <span class="fadi-stat-number"><?php echo $stats['total_tenders'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('إجمالي المناقصات', 'fadi'); ?></span>
            </div>
        </div>
        
        <div class="fadi-stats-row">
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <span class="fadi-stat-number"><?php echo number_format($stats['monthly_revenue'] ?? 0, 0); ?></span>
                <span class="fadi-stat-label"><?php _e('إيرادات هذا الشهر (ر.س)', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <span class="fadi-stat-number"><?php echo number_format($stats['yearly_revenue'] ?? 0, 0); ?></span>
                <span class="fadi-stat-label"><?php _e('إيرادات هذا العام (ر.س)', 'fadi'); ?></span>
            </div>
        </div>
        
        <?php if (isset($stats['last_updated'])): ?>
        <p style="text-align: center; color: #666; margin-top: 20px;">
            <?php printf(__('آخر تحديث: %s', 'fadi'), date_i18n('Y-m-d H:i', strtotime($stats['last_updated']))); ?>
        </p>
        <?php endif; ?>
    </div>
    
    <div class="fadi-report-widget">
        <h2><?php _e('التنبيهات والمهام العاجلة', 'fadi'); ?></h2>
        
        <?php
        $pending_tasks = $stats['pending_tasks'] ?? 0;
        $expiring_docs = $stats['expiring_documents'] ?? 0;
        
        if ($pending_tasks > 0 || $expiring_docs > 0):
        ?>
        <div class="fadi-stats-row">
            <?php if ($pending_tasks > 0): ?>
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: #000;">
                <span class="fadi-stat-number"><?php echo $pending_tasks; ?></span>
                <span class="fadi-stat-label"><?php _e('مهام معلقة', 'fadi'); ?></span>
            </div>
            <?php endif; ?>
            
            <?php if ($expiring_docs > 0): ?>
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
                <span class="fadi-stat-number"><?php echo $expiring_docs; ?></span>
                <span class="fadi-stat-label"><?php _e('وثائق ستنتهي قريباً', 'fadi'); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p style="text-align: center; color: #28a745; font-weight: bold;">
            ✅ <?php _e('لا توجد تنبيهات عاجلة حالياً', 'fadi'); ?>
        </p>
        <?php endif; ?>
    </div>
    
    <div class="fadi-report-widget">
        <h2><?php _e('الأداء الشهري', 'fadi'); ?></h2>
        <div class="fadi-chart-container">
            <p><?php _e('رسم بياني للأداء الشهري', 'fadi'); ?><br><small><?php _e('(سيتم تطويره في الإصدارات القادمة)', 'fadi'); ?></small></p>
        </div>
    </div>
    <?php
}

/**
 * تقرير عروض الأسعار
 */
function fadi_reports_quotes() {
    $total_quotes = wp_count_posts('quote')->publish;
    
    // إحصائيات حسب الحالة
    $quote_stats = fadi_get_quotes_by_status();
    
    // إحصائيات شهرية
    $monthly_quotes = fadi_get_monthly_quotes_stats();
    
    ?>
    <div class="fadi-report-widget">
        <h2><?php _e('إحصائيات عروض الأسعار', 'fadi'); ?></h2>
        
        <div class="fadi-stats-row">
            <div class="fadi-stat-box">
                <span class="fadi-stat-number"><?php echo $total_quotes; ?></span>
                <span class="fadi-stat-label"><?php _e('إجمالي العروض', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <span class="fadi-stat-number"><?php echo $quote_stats['approved'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('عروض موافق عليها', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);">
                <span class="fadi-stat-number"><?php echo $quote_stats['sent'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('عروض مرسلة', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                <span class="fadi-stat-number"><?php echo $quote_stats['draft'] ?? 0; ?></span>
                <span class="fadi-stat-label"><?php _e('مسودات', 'fadi'); ?></span>
            </div>
        </div>
        
        <?php if (!empty($quote_stats)): ?>
        <div style="margin: 20px 0;">
            <h3><?php _e('معدل النجاح', 'fadi'); ?></h3>
            <?php 
            $success_rate = $total_quotes > 0 ? (($quote_stats['approved'] ?? 0) / $total_quotes) * 100 : 0;
            ?>
            <div style="background: #f1f1f1; height: 30px; border-radius: 15px; overflow: hidden;">
                <div style="width: <?php echo $success_rate; ?>%; height: 100%; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    <?php echo number_format($success_rate, 1); ?>%
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="fadi-report-widget">
        <h2><?php _e('العروض الشهرية', 'fadi'); ?></h2>
        <div class="fadi-chart-container">
            <p><?php _e('رسم بياني للعروض الشهرية', 'fadi'); ?><br><small><?php _e('(سيتم تطويره في الإصدارات القادمة)', 'fadi'); ?></small></p>
        </div>
    </div>
    
    <div class="fadi-report-widget">
        <h2><?php _e('أحدث عروض الأسعار', 'fadi'); ?></h2>
        <?php
        $recent_quotes = get_posts(array(
            'post_type' => 'quote',
            'numberposts' => 10,
            'post_status' => 'publish'
        ));
        
        if ($recent_quotes):
        ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('العنوان', 'fadi'); ?></th>
                    <th><?php _e('العميل', 'fadi'); ?></th>
                    <th><?php _e('المبلغ', 'fadi'); ?></th>
                    <th><?php _e('الحالة', 'fadi'); ?></th>
                    <th><?php _e('التاريخ', 'fadi'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_quotes as $quote): ?>
                <tr>
                    <td><a href="<?php echo get_edit_post_link($quote->ID); ?>"><?php echo $quote->post_title; ?></a></td>
                    <td><?php echo get_post_meta($quote->ID, 'client_name', true); ?></td>
                    <td><?php echo number_format(get_post_meta($quote->ID, 'total_amount', true), 2); ?> ر.س</td>
                    <td>
                        <?php 
                        $terms = get_the_terms($quote->ID, 'quote_status');
                        echo $terms ? $terms[0]->name : __('غير محدد', 'fadi');
                        ?>
                    </td>
                    <td><?php echo get_the_date('Y-m-d', $quote); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p><?php _e('لا توجد عروض أسعار حتى الآن', 'fadi'); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * التقرير المالي
 */
function fadi_reports_financial() {
    $current_year = date('Y');
    $current_month = date('Y-m');
    
    $monthly_revenue = fadi_get_monthly_revenue($current_month);
    $yearly_revenue = fadi_get_yearly_revenue($current_year);
    $last_year_revenue = fadi_get_yearly_revenue($current_year - 1);
    
    $growth_rate = $last_year_revenue > 0 ? (($yearly_revenue - $last_year_revenue) / $last_year_revenue) * 100 : 0;
    
    ?>
    <div class="fadi-report-widget">
        <h2><?php _e('التقرير المالي', 'fadi'); ?></h2>
        
        <div class="fadi-stats-row">
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <span class="fadi-stat-number"><?php echo number_format($monthly_revenue, 0); ?></span>
                <span class="fadi-stat-label"><?php _e('إيرادات هذا الشهر (ر.س)', 'fadi'); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <span class="fadi-stat-number"><?php echo number_format($yearly_revenue, 0); ?></span>
                <span class="fadi-stat-label"><?php echo sprintf(__('إيرادات %s (ر.س)', 'fadi'), $current_year); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                <span class="fadi-stat-number"><?php echo number_format($last_year_revenue, 0); ?></span>
                <span class="fadi-stat-label"><?php echo sprintf(__('إيرادات %s (ر.س)', 'fadi'), $current_year - 1); ?></span>
            </div>
            
            <div class="fadi-stat-box" style="background: linear-gradient(135deg, <?php echo $growth_rate >= 0 ? '#28a745, #20c997' : '#dc3545, #fd7e14'; ?> 100%);">
                <span class="fadi-stat-number"><?php echo number_format($growth_rate, 1); ?>%</span>
                <span class="fadi-stat-label"><?php _e('معدل النمو السنوي', 'fadi'); ?></span>
            </div>
        </div>
    </div>
    
    <div class="fadi-report-widget">
        <h2><?php _e('الإيرادات الشهرية', 'fadi'); ?></h2>
        <div class="fadi-chart-container">
            <p><?php _e('رسم بياني للإيرادات الشهرية', 'fadi'); ?><br><small><?php _e('(سيتم تطويره في الإصدارات القادمة)', 'fadi'); ?></small></p>
        </div>
    </div>
    
    <div class="fadi-report-widget">
        <h2><?php _e('توزيع الإيرادات حسب الشهر', 'fadi'); ?></h2>
        <?php
        $monthly_breakdown = array();
        for ($i = 1; $i <= 12; $i++) {
            $month = sprintf('%s-%02d', $current_year, $i);
            $revenue = fadi_get_monthly_revenue($month);
            $monthly_breakdown[$month] = $revenue;
        }
        ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('الشهر', 'fadi'); ?></th>
                    <th><?php _e('الإيرادات (ر.س)', 'fadi'); ?></th>
                    <th><?php _e('النسبة من الإجمالي', 'fadi'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monthly_breakdown as $month => $revenue): ?>
                <tr>
                    <td><?php echo date_i18n('F Y', strtotime($month . '-01')); ?></td>
                    <td><?php echo number_format($revenue, 2); ?></td>
                    <td>
                        <?php 
                        $percentage = $yearly_revenue > 0 ? ($revenue / $yearly_revenue) * 100 : 0;
                        echo number_format($percentage, 1) . '%';
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * وظائف مساعدة للتقارير
 */
function fadi_get_quotes_by_status() {
    $statuses = get_terms(array(
        'taxonomy' => 'quote_status',
        'hide_empty' => false
    ));
    
    $stats = array();
    foreach ($statuses as $status) {
        $count = get_posts(array(
            'post_type' => 'quote',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'quote_status',
                    'field' => 'slug',
                    'terms' => $status->slug
                )
            ),
            'numberposts' => -1,
            'fields' => 'ids'
        ));
        
        $stats[$status->slug] = count($count);
    }
    
    return $stats;
}

function fadi_get_monthly_quotes_stats() {
    global $wpdb;
    
    $results = $wpdb->get_results("
        SELECT 
            DATE_FORMAT(post_date, '%Y-%m') as month,
            COUNT(*) as count
        FROM {$wpdb->posts} 
        WHERE post_type = 'quote' 
        AND post_status = 'publish'
        AND post_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
        GROUP BY DATE_FORMAT(post_date, '%Y-%m')
        ORDER BY month ASC
    ");
    
    return $results;
}

/**
 * تصدير التقارير
 */
function fadi_export_report() {
    if (!current_user_can('manage_options')) {
        wp_die(__('غير مصرح لك بالوصول لهذه الصفحة', 'fadi'));
    }
    
    $report_type = sanitize_text_field($_GET['report_type']);
    $format = sanitize_text_field($_GET['format']);
    
    switch ($report_type) {
        case 'quotes':
            $data = fadi_get_quotes_export_data();
            break;
        case 'financial':
            $data = fadi_get_financial_export_data();
            break;
        default:
            wp_die(__('نوع تقرير غير صالح', 'fadi'));
    }
    
    if ($format === 'csv') {
        fadi_export_csv($data, $report_type);
    } elseif ($format === 'pdf') {
        fadi_export_pdf($data, $report_type);
    }
}

function fadi_export_csv($data, $report_type) {
    $filename = sprintf('fadi-report-%s-%s.csv', $report_type, date('Y-m-d'));
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // إضافة BOM لدعم UTF-8
    fputs($output, "\xEF\xBB\xBF");
    
    if (!empty($data)) {
        // كتابة العناوين
        fputcsv($output, array_keys($data[0]));
        
        // كتابة البيانات
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
    }
    
    fclose($output);
    exit;
}

function fadi_get_quotes_export_data() {
    $quotes = get_posts(array(
        'post_type' => 'quote',
        'numberposts' => -1,
        'post_status' => 'publish'
    ));
    
    $data = array();
    foreach ($quotes as $quote) {
        $data[] = array(
            'العنوان' => $quote->post_title,
            'العميل' => get_post_meta($quote->ID, 'client_name', true),
            'المبلغ' => get_post_meta($quote->ID, 'total_amount', true),
            'التاريخ' => get_the_date('Y-m-d', $quote),
            'الحالة' => fadi_get_quote_status($quote->ID)
        );
    }
    
    return $data;
}

function fadi_get_quote_status($quote_id) {
    $terms = get_the_terms($quote_id, 'quote_status');
    return $terms ? $terms[0]->name : __('غير محدد', 'fadi');
}