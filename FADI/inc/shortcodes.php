<?php
/**
 * الشورتكودز المخصصة للقالب
 * 
 * @package FADI
 * @version 1.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * شورتكود لعرض إحصائيات سريعة
 * [fadi_stats type="quotes,suppliers,employees"]
 */
function fadi_stats_shortcode($atts) {
    if (!is_user_logged_in()) {
        return '<p>' . __('يجب تسجيل الدخول لمشاهدة الإحصائيات', 'fadi') . '</p>';
    }
    
    $atts = shortcode_atts(array(
        'type' => 'all',
        'style' => 'grid',
        'show_icons' => 'yes'
    ), $atts);
    
    $types = explode(',', $atts['type']);
    $stats = get_option('fadi_live_statistics', array());
    
    $output = '<div class="fadi-stats-shortcode fadi-stats-' . esc_attr($atts['style']) . '">';
    
    foreach ($types as $type) {
        $type = trim($type);
        
        switch ($type) {
            case 'quotes':
            case 'all':
                $icon = $atts['show_icons'] === 'yes' ? '📋 ' : '';
                $output .= sprintf(
                    '<div class="fadi-stat-item"><span class="fadi-stat-icon">%s</span><span class="fadi-stat-number">%d</span><span class="fadi-stat-label">%s</span></div>',
                    $icon,
                    $stats['total_quotes'] ?? 0,
                    __('عروض الأسعار', 'fadi')
                );
                if ($type !== 'all') break;
                
            case 'suppliers':
            case 'all':
                $icon = $atts['show_icons'] === 'yes' ? '🛒 ' : '';
                $output .= sprintf(
                    '<div class="fadi-stat-item"><span class="fadi-stat-icon">%s</span><span class="fadi-stat-number">%d</span><span class="fadi-stat-label">%s</span></div>',
                    $icon,
                    $stats['total_suppliers'] ?? 0,
                    __('الموردين', 'fadi')
                );
                if ($type !== 'all') break;
                
            case 'employees':
            case 'all':
                $icon = $atts['show_icons'] === 'yes' ? '👥 ' : '';
                $output .= sprintf(
                    '<div class="fadi-stat-item"><span class="fadi-stat-icon">%s</span><span class="fadi-stat-number">%d</span><span class="fadi-stat-label">%s</span></div>',
                    $icon,
                    $stats['total_employees'] ?? 0,
                    __('الموظفين', 'fadi')
                );
                if ($type !== 'all') break;
                
            case 'tenders':
            case 'all':
                $icon = $atts['show_icons'] === 'yes' ? '🏢 ' : '';
                $output .= sprintf(
                    '<div class="fadi-stat-item"><span class="fadi-stat-icon">%s</span><span class="fadi-stat-number">%d</span><span class="fadi-stat-label">%s</span></div>',
                    $icon,
                    $stats['total_tenders'] ?? 0,
                    __('المناقصات', 'fadi')
                );
                if ($type !== 'all') break;
                
            case 'revenue':
                $icon = $atts['show_icons'] === 'yes' ? '💰 ' : '';
                $output .= sprintf(
                    '<div class="fadi-stat-item fadi-stat-revenue"><span class="fadi-stat-icon">%s</span><span class="fadi-stat-number">%s</span><span class="fadi-stat-label">%s</span></div>',
                    $icon,
                    number_format($stats['monthly_revenue'] ?? 0, 0),
                    __('إيرادات الشهر (ر.س)', 'fadi')
                );
                break;
        }
    }
    
    $output .= '</div>';
    
    // إضافة CSS
    $output .= '<style>
    .fadi-stats-shortcode {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin: 20px 0;
    }
    .fadi-stats-grid .fadi-stat-item {
        flex: 1;
        min-width: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }
    .fadi-stat-revenue {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    }
    .fadi-stat-number {
        display: block;
        font-size: 2rem;
        font-weight: bold;
        margin: 10px 0;
    }
    .fadi-stat-label {
        display: block;
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .fadi-stat-icon {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 5px;
    }
    @media (max-width: 768px) {
        .fadi-stats-shortcode {
            flex-direction: column;
        }
    }
    </style>';
    
    return $output;
}
add_shortcode('fadi_stats', 'fadi_stats_shortcode');

/**
 * شورتكود لعرض قائمة أحدث العناصر
 * [fadi_recent type="quotes" limit="5" show_date="yes"]
 */
function fadi_recent_shortcode($atts) {
    if (!is_user_logged_in()) {
        return '<p>' . __('يجب تسجيل الدخول لمشاهدة هذا المحتوى', 'fadi') . '</p>';
    }
    
    $atts = shortcode_atts(array(
        'type' => 'quotes',
        'limit' => '5',
        'show_date' => 'yes',
        'show_status' => 'yes',
        'title' => ''
    ), $atts);
    
    $post_types = array(
        'quotes' => 'quote',
        'suppliers' => 'supplier',
        'employees' => 'employee',
        'tenders' => 'tender',
        'documents' => 'document'
    );
    
    if (!isset($post_types[$atts['type']])) {
        return '<p>' . __('نوع المحتوى غير صالح', 'fadi') . '</p>';
    }
    
    $post_type = $post_types[$atts['type']];
    
    $posts = get_posts(array(
        'post_type' => $post_type,
        'numberposts' => intval($atts['limit']),
        'post_status' => 'publish'
    ));
    
    if (empty($posts)) {
        return '<p>' . __('لا توجد عناصر لعرضها', 'fadi') . '</p>';
    }
    
    $output = '<div class="fadi-recent-shortcode">';
    
    if (!empty($atts['title'])) {
        $output .= '<h3>' . esc_html($atts['title']) . '</h3>';
    }
    
    $output .= '<ul class="fadi-recent-list">';
    
    foreach ($posts as $post) {
        $output .= '<li class="fadi-recent-item">';
        $output .= '<a href="' . get_edit_post_link($post->ID) . '">' . esc_html($post->post_title) . '</a>';
        
        if ($atts['show_date'] === 'yes') {
            $output .= ' <span class="fadi-recent-date">(' . get_the_date('Y-m-d', $post) . ')</span>';
        }
        
        if ($atts['show_status'] === 'yes' && $post_type === 'quote') {
            $status = fadi_get_quote_status($post->ID);
            $output .= ' <span class="fadi-recent-status">[' . esc_html($status) . ']</span>';
        }
        
        $output .= '</li>';
    }
    
    $output .= '</ul></div>';
    
    // إضافة CSS
    $output .= '<style>
    .fadi-recent-shortcode {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: 20px 0;
    }
    .fadi-recent-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .fadi-recent-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    .fadi-recent-item:last-child {
        border-bottom: none;
    }
    .fadi-recent-date {
        color: #666;
        font-size: 0.9rem;
    }
    .fadi-recent-status {
        color: #0073aa;
        font-size: 0.9rem;
        font-weight: bold;
    }
    </style>';
    
    return $output;
}
add_shortcode('fadi_recent', 'fadi_recent_shortcode');

/**
 * شورتكود لعرض التنبيهات والإشعارات
 * [fadi_alerts]
 */
function fadi_alerts_shortcode($atts) {
    if (!is_user_logged_in()) {
        return '';
    }
    
    $atts = shortcode_atts(array(
        'show_expiring_docs' => 'yes',
        'show_tender_deadlines' => 'yes',
        'show_pending_tasks' => 'yes'
    ), $atts);
    
    $alerts = array();
    
    // فحص الوثائق المنتهية الصلاحية
    if ($atts['show_expiring_docs'] === 'yes') {
        $expiring_docs = get_posts(array(
            'post_type' => 'document',
            'post_status' => 'publish',
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
            $expiry_date = get_post_meta($doc->ID, 'expiry_date', true);
            $days_left = ceil((strtotime($expiry_date) - time()) / DAY_IN_SECONDS);
            
            $alerts[] = array(
                'type' => 'warning',
                'message' => sprintf(
                    __('الوثيقة "%s" ستنتهي خلال %d يوم', 'fadi'),
                    $doc->post_title,
                    $days_left
                ),
                'link' => get_edit_post_link($doc->ID)
            );
        }
    }
    
    // فحص مواعيد المناقصات
    if ($atts['show_tender_deadlines'] === 'yes') {
        $upcoming_tenders = get_posts(array(
            'post_type' => 'tender',
            'post_status' => 'publish',
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
            $deadline = get_post_meta($tender->ID, 'tender_deadline', true);
            $hours_left = ceil((strtotime($deadline) - time()) / 3600);
            
            $alerts[] = array(
                'type' => 'info',
                'message' => sprintf(
                    __('المناقصة "%s" موعدها النهائي خلال %d ساعة', 'fadi'),
                    $tender->post_title,
                    $hours_left
                ),
                'link' => get_edit_post_link($tender->ID)
            );
        }
    }
    
    if (empty($alerts)) {
        return '<div class="fadi-alerts-shortcode fadi-no-alerts"><p>✅ ' . __('لا توجد تنبيهات حالياً', 'fadi') . '</p></div>';
    }
    
    $output = '<div class="fadi-alerts-shortcode">';
    $output .= '<h4>' . __('التنبيهات المهمة', 'fadi') . '</h4>';
    $output .= '<ul class="fadi-alerts-list">';
    
    foreach ($alerts as $alert) {
        $icon = $alert['type'] === 'warning' ? '⚠️' : 'ℹ️';
        $output .= '<li class="fadi-alert-item fadi-alert-' . esc_attr($alert['type']) . '">';
        $output .= '<span class="fadi-alert-icon">' . $icon . '</span>';
        
        if (!empty($alert['link'])) {
            $output .= '<a href="' . esc_url($alert['link']) . '">' . esc_html($alert['message']) . '</a>';
        } else {
            $output .= esc_html($alert['message']);
        }
        
        $output .= '</li>';
    }
    
    $output .= '</ul></div>';
    
    // إضافة CSS
    $output .= '<style>
    .fadi-alerts-shortcode {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 8px;
        padding: 15px;
        margin: 20px 0;
    }
    .fadi-no-alerts {
        background: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }
    .fadi-alerts-list {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }
    .fadi-alert-item {
        padding: 8px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .fadi-alert-warning {
        color: #856404;
    }
    .fadi-alert-info {
        color: #0c5460;
    }
    .fadi-alert-icon {
        font-size: 1.2rem;
    }
    .fadi-alerts-shortcode h4 {
        margin: 0 0 10px 0;
        color: #856404;
    }
    </style>';
    
    return $output;
}
add_shortcode('fadi_alerts', 'fadi_alerts_shortcode');

/**
 * شورتكود لعرض نموذج بحث سريع
 * [fadi_search]
 */
function fadi_search_shortcode($atts) {
    if (!is_user_logged_in()) {
        return '';
    }
    
    $atts = shortcode_atts(array(
        'placeholder' => 'البحث في النظام...',
        'types' => 'all'
    ), $atts);
    
    $output = '
    <div class="fadi-search-shortcode">
        <form class="fadi-search-form" onsubmit="return false;">
            <input type="text" class="fadi-search-input" placeholder="' . esc_attr($atts['placeholder']) . '" />
            <button type="submit" class="fadi-search-btn">🔍</button>
        </form>
        <div class="fadi-search-results" style="display: none;"></div>
    </div>
    
    <style>
    .fadi-search-shortcode {
        margin: 20px 0;
    }
    .fadi-search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    .fadi-search-input {
        flex: 1;
        padding: 10px;
        border: 2px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    .fadi-search-btn {
        padding: 10px 15px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .fadi-search-results {
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        max-height: 300px;
        overflow-y: auto;
    }
    .fadi-search-result-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    .fadi-search-result-item:hover {
        background: #f5f5f5;
    }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        let searchTimeout;
        
        $(".fadi-search-input").on("input", function() {
            const query = $(this).val();
            const resultsDiv = $(".fadi-search-results");
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                resultsDiv.hide();
                return;
            }
            
            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: fadi_ajax.ajax_url,
                    type: "POST",
                    data: {
                        action: "fadi_quick_search",
                        search_term: query,
                        search_type: "' . esc_js($atts['types']) . '",
                        nonce: fadi_ajax.nonce
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            let html = "";
                            response.data.forEach(function(item) {
                                html += `<div class="fadi-search-result-item">
                                    <a href="${item.url}">${item.title}</a>
                                    <small> (${item.type})</small>
                                </div>`;
                            });
                            resultsDiv.html(html).show();
                        } else {
                            resultsDiv.html("<div class=\"fadi-search-result-item\">لا توجد نتائج</div>").show();
                        }
                    }
                });
            }, 300);
        });
        
        $(document).click(function(e) {
            if (!$(e.target).closest(".fadi-search-shortcode").length) {
                $(".fadi-search-results").hide();
            }
        });
    });
    </script>';
    
    return $output;
}
add_shortcode('fadi_search', 'fadi_search_shortcode');

/**
 * شورتكود لعرض تقرير مختصر
 * [fadi_mini_report type="monthly"]
 */
function fadi_mini_report_shortcode($atts) {
    if (!is_user_logged_in()) {
        return '';
    }
    
    $atts = shortcode_atts(array(
        'type' => 'monthly',
        'title' => ''
    ), $atts);
    
    $output = '<div class="fadi-mini-report">';
    
    if (!empty($atts['title'])) {
        $output .= '<h3>' . esc_html($atts['title']) . '</h3>';
    }
    
    switch ($atts['type']) {
        case 'monthly':
            $current_month = date('Y-m');
            $revenue = fadi_get_monthly_revenue($current_month);
            $quotes_count = fadi_get_monthly_count('quote', $current_month);
            
            $output .= '<div class="fadi-mini-report-stats">';
            $output .= '<div class="fadi-mini-stat">';
            $output .= '<span class="fadi-mini-stat-number">' . number_format($revenue, 0) . '</span>';
            $output .= '<span class="fadi-mini-stat-label">ر.س إيرادات الشهر</span>';
            $output .= '</div>';
            $output .= '<div class="fadi-mini-stat">';
            $output .= '<span class="fadi-mini-stat-number">' . $quotes_count . '</span>';
            $output .= '<span class="fadi-mini-stat-label">عروض أسعار الشهر</span>';
            $output .= '</div>';
            $output .= '</div>';
            break;
            
        case 'yearly':
            $current_year = date('Y');
            $revenue = fadi_get_yearly_revenue($current_year);
            $quotes_count = wp_count_posts('quote')->publish;
            
            $output .= '<div class="fadi-mini-report-stats">';
            $output .= '<div class="fadi-mini-stat">';
            $output .= '<span class="fadi-mini-stat-number">' . number_format($revenue, 0) . '</span>';
            $output .= '<span class="fadi-mini-stat-label">ر.س إيرادات السنة</span>';
            $output .= '</div>';
            $output .= '<div class="fadi-mini-stat">';
            $output .= '<span class="fadi-mini-stat-number">' . $quotes_count . '</span>';
            $output .= '<span class="fadi-mini-stat-label">إجمالي العروض</span>';
            $output .= '</div>';
            $output .= '</div>';
            break;
    }
    
    $output .= '</div>';
    
    // إضافة CSS
    $output .= '<style>
    .fadi-mini-report {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: 20px 0;
    }
    .fadi-mini-report-stats {
        display: flex;
        gap: 20px;
    }
    .fadi-mini-stat {
        flex: 1;
        text-align: center;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 5px;
    }
    .fadi-mini-stat-number {
        display: block;
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .fadi-mini-stat-label {
        display: block;
        font-size: 0.9rem;
        opacity: 0.9;
    }
    @media (max-width: 768px) {
        .fadi-mini-report-stats {
            flex-direction: column;
        }
    }
    </style>';
    
    return $output;
}
add_shortcode('fadi_mini_report', 'fadi_mini_report_shortcode');