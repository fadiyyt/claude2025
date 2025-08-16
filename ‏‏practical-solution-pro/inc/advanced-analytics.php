<?php
/**
 * Advanced Analytics System - نظام التحليلات المتقدم المُصلح
 * المسار: /inc/advanced-analytics.php
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Advanced_Analytics {
    
    private static $table_name;
    private static $search_table;
    
    public function __construct() {
        global $wpdb;
        self::$table_name = $wpdb->prefix . 'ps_analytics';
        self::$search_table = $wpdb->prefix . 'ps_search_analytics';
        
        add_action('init', array($this, 'init'));
    }
    public function init() {
        add_action('wp_ajax_ps_get_analytics_data', array($this, 'get_analytics_data'));
        add_action('wp_ajax_ps_export_analytics', array($this, 'export_analytics'));
        add_action('wp_ajax_ps_cleanup_old_analytics', array($this, 'cleanup_old_data'));
        add_action('after_switch_theme', array($this, 'create_tables'));
        add_action('ps_daily_cleanup', array($this, 'daily_cleanup'));
        
        if (!wp_next_scheduled('ps_daily_cleanup')) {
            wp_schedule_event(time(), 'daily', 'ps_daily_cleanup');
        }
    }
    
    public static function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        $analytics_table_sql = "CREATE TABLE " . self::$table_name . " (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) DEFAULT NULL,
            page_url varchar(255) NOT NULL,
            page_title varchar(255) DEFAULT NULL,
            user_ip varchar(45) DEFAULT NULL,
            user_agent text DEFAULT NULL,
            referer varchar(255) DEFAULT NULL,
            visit_date datetime NOT NULL,
            time_on_page int(11) DEFAULT 0,
            bounce_rate tinyint(1) DEFAULT 0,
            device_type varchar(20) DEFAULT NULL,
            browser varchar(50) DEFAULT NULL,
            country varchar(2) DEFAULT NULL,
            PRIMARY KEY (id),
            KEY post_id (post_id),
            KEY visit_date (visit_date),
            KEY device_type (device_type)
        ) $charset_collate;";
        
        $search_table_sql = "CREATE TABLE " . self::$search_table . " (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            search_query varchar(255) NOT NULL,
            voice_text text DEFAULT NULL,
            results_count int(11) DEFAULT 0,
            search_type varchar(20) NOT NULL DEFAULT 'text',
            user_ip varchar(45) DEFAULT NULL,
            user_agent text DEFAULT NULL,
            search_date datetime NOT NULL,
            clicked_result varchar(255) DEFAULT NULL,
            session_id varchar(64) DEFAULT NULL,
            PRIMARY KEY (id),
            KEY search_query (search_query),
            KEY search_date (search_date),
            KEY search_type (search_type)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($analytics_table_sql);
        dbDelta($search_table_sql);
    }

    private static function create_index_safely($table_name, $index_name, $columns) {
        global $wpdb;
        $index_exists = $wpdb->get_var($wpdb->prepare("SHOW INDEX FROM `$table_name` WHERE Key_name = %s", $index_name));
        if (!$index_exists) {
            $wpdb->query("CREATE INDEX `$index_name` ON `$table_name` $columns");
        }
    }
    
    public static function track_page_view($post_id = null) {
        global $wpdb;
        $analytics_settings = get_option('ps_analytics_settings', array());
        if (!($analytics_settings['enabled'] ?? true)) { return; }
        
        $data = array(
            'post_id' => $post_id,
            'page_url' => esc_url_raw($_SERVER['REQUEST_URI'] ?? ''),
            'page_title' => wp_get_document_title(),
            'user_ip' => self::get_anonymized_ip(),
            'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
            'referer' => esc_url_raw($_SERVER['HTTP_REFERER'] ?? ''),
            'visit_date' => current_time('mysql'),
            'device_type' => self::detect_device_type(),
            'browser' => self::detect_browser(),
            'country' => self::detect_country()
        );
        $wpdb->insert(self::$table_name, $data);
    }
    
    public static function log_search_event($search_data) {
        global $wpdb;
        $analytics_settings = get_option('ps_analytics_settings', array());
        if (!($analytics_settings['track_search_analytics'] ?? true)) { return; }
        
        $data = array(
            'search_query' => sanitize_text_field($search_data['query'] ?? ''),
            'voice_text' => sanitize_textarea_field($search_data['voice_text'] ?? ''),
            'results_count' => intval($search_data['results_count'] ?? 0),
            'search_type' => sanitize_text_field($search_data['search_type'] ?? 'text'),
            'user_ip' => self::get_anonymized_ip(),
            'user_agent' => sanitize_text_field($search_data['user_agent'] ?? ''),
            'search_date' => current_time('mysql'),
            'session_id' => self::get_session_id()
        );
        $wpdb->insert(self::$search_table, $data);
    }
    
    public function get_analytics_data() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) { wp_send_json_error(__('غير مصرح', 'practical-solutions')); }
        
        $period = sanitize_text_field($_POST['period'] ?? '7days');
        $type = sanitize_text_field($_POST['type'] ?? 'overview');
        $data = array();
        
        switch ($type) {
            case 'overview': $data = $this->get_overview_data($period); break;
            case 'pages': $data = $this->get_pages_performance($period); break;
            case 'search': $data = $this->get_search_analytics($period); break;
            case 'devices': $data = $this->get_device_analytics($period); break;
            default: $data = $this->get_overview_data($period);
        }
        wp_send_json_success($data);
    }
    
    private function get_overview_data($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period);
        $total_views = $wpdb->get_var("SELECT COUNT(*) FROM " . self::$table_name . " WHERE $date_condition");
        $unique_pages = $wpdb->get_var("SELECT COUNT(DISTINCT post_id) FROM " . self::$table_name . " WHERE $date_condition AND post_id IS NOT NULL");
        $total_searches = $wpdb->get_var("SELECT COUNT(*) FROM " . self::$search_table . " WHERE $date_condition");
        $bounce_rate = $wpdb->get_var("SELECT AVG(bounce_rate) FROM " . self::$table_name . " WHERE $date_condition");
        $daily_views = $wpdb->get_results("SELECT DATE(visit_date) as date, COUNT(*) as views FROM " . self::$table_name . " WHERE $date_condition GROUP BY DATE(visit_date) ORDER BY date ASC");
        
        return array('total_views' => intval($total_views), 'unique_pages' => intval($unique_pages), 'total_searches' => intval($total_searches), 'bounce_rate' => round(floatval($bounce_rate) * 100, 1), 'daily_views' => $daily_views);
    }
    
    private function get_pages_performance($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period);
        return $wpdb->get_results("SELECT p.ID, p.post_title, COUNT(a.id) as views, AVG(a.time_on_page) as avg_time, COUNT(DISTINCT DATE(a.visit_date)) as active_days FROM " . self::$table_name . " a LEFT JOIN {$wpdb->posts} p ON a.post_id = p.ID WHERE $date_condition AND a.post_id IS NOT NULL GROUP BY a.post_id ORDER BY views DESC LIMIT 20");
    }
    
    private function get_search_analytics($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period, 'search_date');
        $top_searches = $wpdb->get_results("SELECT search_query, COUNT(*) as search_count, AVG(results_count) as avg_results, search_type FROM " . self::$search_table . " WHERE $date_condition GROUP BY search_query ORDER BY search_count DESC LIMIT 20");
        $voice_stats = $wpdb->get_row("SELECT COUNT(*) as total_voice_searches, COUNT(*) * 100.0 / (SELECT COUNT(*) FROM " . self::$search_table . " WHERE $date_condition) as voice_percentage FROM " . self::$search_table . " WHERE $date_condition AND search_type = 'voice'");
        return array('top_searches' => $top_searches, 'voice_stats' => $voice_stats);
    }
    
    private function get_device_analytics($period) {
        global $wpdb;
        $date_condition = $this->get_date_condition($period);
        $device_stats = $wpdb->get_results("SELECT device_type, COUNT(*) as views, COUNT(*) * 100.0 / (SELECT COUNT(*) FROM " . self::$table_name . " WHERE $date_condition) as percentage FROM " . self::$table_name . " WHERE $date_condition GROUP BY device_type ORDER BY views DESC");
        $browser_stats = $wpdb->get_results("SELECT browser, COUNT(*) as views FROM " . self::$table_name . " WHERE $date_condition GROUP BY browser ORDER BY views DESC LIMIT 10");
        return array('devices' => $device_stats, 'browsers' => $browser_stats);
    }
    
    private function get_date_condition($period, $date_column = 'visit_date') {
        $days = 7;
        switch ($period) {
            case '1day': $days = 1; break;
            case '7days': $days = 7; break;
            case '30days': $days = 30; break;
            case '90days': $days = 90; break;
        }
        return "$date_column >= DATE_SUB(NOW(), INTERVAL $days DAY)";
    }
    
    public function export_analytics() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) { wp_send_json_error(__('غير مصرح', 'practical-solutions')); }
        
        $period = sanitize_text_field($_POST['period'] ?? '30days');
        $format = sanitize_text_field($_POST['format'] ?? 'csv');
        $data = $this->get_export_data($period);
        
        if ($format === 'csv') {
            $csv_data = $this->convert_to_csv($data);
            wp_send_json_success(array('data' => $csv_data, 'filename' => 'analytics-' . date('Y-m-d') . '.csv'));
        } else {
            wp_send_json_success(array('data' => $data, 'filename' => 'analytics-' . date('Y-m-d') . '.json'));
        }
    }
    
    public function cleanup_old_data() {
        check_ajax_referer('ps_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) { wp_send_json_error(__('غير مصرح', 'practical-solutions')); }
        $this->daily_cleanup();
        wp_send_json_success(__('تم تنظيف البيانات القديمة', 'practical-solutions'));
    }
    
    public function daily_cleanup() {
        global $wpdb;
        $analytics_settings = get_option('ps_analytics_settings', array());
        $retention_days = intval($analytics_settings['data_retention_days'] ?? 365);
        
        $wpdb->query($wpdb->prepare("DELETE FROM " . self::$table_name . " WHERE visit_date < DATE_SUB(NOW(), INTERVAL %d DAY)", $retention_days));
        $wpdb->query($wpdb->prepare("DELETE FROM " . self::$search_table . " WHERE search_date < DATE_SUB(NOW(), INTERVAL %d DAY)", $retention_days));
        $wpdb->query("OPTIMIZE TABLE " . self::$table_name);
        $wpdb->query("OPTIMIZE TABLE " . self::$search_table);
    }
    
    private static function get_anonymized_ip() {
        $analytics_settings = get_option('ps_analytics_settings', array());
        if ($analytics_settings['anonymize_ip'] ?? true) { return 'anonymized'; }
        
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                $ip = sanitize_text_field($_SERVER[$key]);
                return preg_replace('/\.\d+$/', '.xxx', $ip);
            }
        }
        return 'unknown';
    }
    
    private static function detect_device_type() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if (preg_match('/mobile|android|iphone|ipad/i', $user_agent)) { return 'mobile'; }
        if (preg_match('/tablet/i', $user_agent)) { return 'tablet'; }
        return 'desktop';
    }
    
    private static function detect_browser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if (strpos($user_agent, 'Chrome') !== false) { return 'Chrome'; }
        if (strpos($user_agent, 'Firefox') !== false) { return 'Firefox'; }
        if (strpos($user_agent, 'Safari') !== false) { return 'Safari'; }
        if (strpos($user_agent, 'Edge') !== false) { return 'Edge'; }
        return 'Other';
    }
    
    private static function detect_country() {
        return 'SA';
    }
    
    private static function get_session_id() {
        if (!session_id()) { session_start(); }
        return session_id();
    }
    
    private function get_export_data($period) {
        return array('overview' => $this->get_overview_data($period), 'pages' => $this->get_pages_performance($period), 'search' => $this->get_search_analytics($period), 'devices' => $this->get_device_analytics($period));
    }
    
    private function convert_to_csv($data) {
        $csv = "Type,Metric,Value\n";
        $csv .= "Overview,Total Views," . $data['overview']['total_views'] . "\n";
        $csv .= "Overview,Unique Pages," . $data['overview']['unique_pages'] . "\n";
        $csv .= "Overview,Total Searches," . $data['overview']['total_searches'] . "\n";
        return $csv;
    }
}

new PS_Advanced_Analytics();
