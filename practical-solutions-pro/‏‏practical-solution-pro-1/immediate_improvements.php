<?php
/**
 * تحسينات فورية يمكن إضافتها للقالب
 * Immediate Theme Improvements
 */

// 1. إضافة نظام Rate Limiting للبحث
class PS_Rate_Limiter {
    private $max_requests = 10;
    private $time_window = 60; // ثانية
    
    public function check_rate_limit($action = 'search') {
        $user_ip = $this->get_user_ip();
        $cache_key = "ps_rate_limit_{$action}_{$user_ip}";
        
        $requests = get_transient($cache_key) ?: 0;
        
        if ($requests >= $this->max_requests) {
            wp_die('تم تجاوز حد الطلبات المسموح. يرجى المحاولة لاحقاً.', 'معدل طلبات مرتفع', 429);
        }
        
        set_transient($cache_key, $requests + 1, $this->time_window);
    }
    
    private function get_user_ip() {
        $ip_keys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
        
        foreach ($ip_keys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = explode(',', $_SERVER[$key])[0];
                return filter_var(trim($ip), FILTER_VALIDATE_IP) ?: '0.0.0.0';
            }
        }
        
        return '0.0.0.0';
    }
}

// 2. تحسين أمان AJAX
function ps_secure_ajax_search() {
    // إضافة Rate Limiting
    $rate_limiter = new PS_Rate_Limiter();
    $rate_limiter->check_rate_limit('search');
    
    // التحقق من Nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ps_nonce')) {
        wp_send_json_error(['message' => 'غير مصرح', 'code' => 'INVALID_NONCE']);
    }
    
    // تنظيف المدخلات
    $search_term = sanitize_text_field($_POST['search_term']);
    $search_type = in_array($_POST['search_type'], ['suggestions', 'posts', 'categories']) 
                  ? $_POST['search_type'] 
                  : 'suggestions';
    
    // التحقق من طول الاستعلام
    if (strlen($search_term) < 2 || strlen($search_term) > 100) {
        wp_send_json_error(['message' => 'طول الاستعلام غير صحيح', 'code' => 'INVALID_QUERY_LENGTH']);
    }
    
    // منع SQL Injection والـ XSS
    $search_term = wp_kses($search_term, []);
    
    // تنفيذ البحث مع Cache
    $cache_key = 'ps_search_' . md5($search_term . $search_type);
    $results = wp_cache_get($cache_key, 'ps_search');
    
    if ($results === false) {
        $results = ps_perform_search($search_term, $search_type);
        wp_cache_set($cache_key, $results, 'ps_search', 300); // 5 دقائق
    }
    
    wp_send_json_success($results);
}
add_action('wp_ajax_ps_search_enhanced', 'ps_secure_ajax_search');
add_action('wp_ajax_nopriv_ps_search_enhanced', 'ps_secure_ajax_search');

// 3. تحسين أداء البحث مع Elasticsearch (اختياري)
function ps_perform_search($search_term, $search_type) {
    global $wpdb;
    
    switch ($search_type) {
        case 'suggestions':
            // بحث محسن مع FULLTEXT INDEX
            $query = $wpdb->prepare("
                SELECT DISTINCT p.ID, p.post_title, p.post_excerpt, p.post_date,
                       MATCH(p.post_title, p.post_content) AGAINST(%s IN NATURAL LANGUAGE MODE) as relevance
                FROM {$wpdb->posts} p
                WHERE p.post_status = 'publish' 
                AND p.post_type = 'post'
                AND MATCH(p.post_title, p.post_content) AGAINST(%s IN NATURAL LANGUAGE MODE)
                ORDER BY relevance DESC, p.post_date DESC
                LIMIT 5
            ", $search_term, $search_term);
            
            $posts = $wpdb->get_results($query);
            
            $suggestions = [];
            foreach ($posts as $post) {
                $suggestions[] = [
                    'id' => $post->ID,
                    'title' => wp_kses_post($post->post_title),
                    'url' => get_permalink($post->ID),
                    'excerpt' => wp_trim_words(wp_strip_all_tags($post->post_excerpt ?: $post->post_content), 15),
                    'thumbnail' => get_the_post_thumbnail_url($post->ID, 'ps-thumbnail'),
                    'category' => get_the_category($post->ID)[0]->name ?? '',
                    'date' => get_the_date('j F Y', $post->ID),
                    'relevance' => floatval($post->relevance)
                ];
            }
            
            return $suggestions;
            
        default:
            return [];
    }
}

// 4. إضافة Critical CSS Loading
function ps_load_critical_css() {
    // تحديد Critical CSS حسب نوع الصفحة
    $critical_css = '';
    
    if (is_home() || is_front_page()) {
        $critical_css = get_option('ps_critical_css_home', '');
    } elseif (is_single()) {
        $critical_css = get_option('ps_critical_css_single', '');
    } elseif (is_archive()) {
        $critical_css = get_option('ps_critical_css_archive', '');
    }
    
    if ($critical_css) {
        echo '<style id="ps-critical-css">' . wp_strip_all_tags($critical_css) . '</style>';
    }
}
add_action('wp_head', 'ps_load_critical_css', 1);

// 5. تحسين تحميل الخطوط
function ps_optimize_font_loading() {
    // Preload الخطوط المهمة
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap"></noscript>';
    
    // Font Display Optimization
    echo '<style>
    @font-face {
        font-family: "Noto Sans Arabic";
        font-display: swap;
    }
    </style>';
}
add_action('wp_head', 'ps_optimize_font_loading', 2);

// 6. إضافة WebP Support تلقائي
function ps_serve_webp_images($image, $attachment_id, $size) {
    if (!function_exists('imagewebp')) {
        return $image;
    }
    
    $upload_dir = wp_upload_dir();
    $image_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image[0]);
    $webp_path = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $image_path);
    $webp_url = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $image[0]);
    
    // إنشاء WebP إذا لم يكن موجوداً
    if (!file_exists($webp_path) && file_exists($image_path)) {
        ps_generate_webp($image_path, $webp_path);
    }
    
    // إرجاع WebP إذا كان المتصفح يدعمه
    if (file_exists($webp_path) && ps_browser_supports_webp()) {
        $image[0] = $webp_url;
    }
    
    return $image;
}
add_filter('wp_get_attachment_image_src', 'ps_serve_webp_images', 10, 3);

function ps_browser_supports_webp() {
    return isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false;
}

function ps_generate_webp($source, $destination) {
    $image_type = exif_imagetype($source);
    $image = null;
    
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($source);
            // حفظ الشفافية
            imagealphablending($image, false);
            imagesavealpha($image, true);
            break;
    }
    
    if ($image) {
        imagewebp($image, $destination, 85);
        imagedestroy($image);
        return true;
    }
    
    return false;
}

// 7. إضافة نظام Error Logging محسن
function ps_log_error($message, $context = []) {
    if (!WP_DEBUG_LOG) return;
    
    $log_entry = [
        'timestamp' => current_time('mysql'),
        'message' => $message,
        'context' => $context,
        'url' => $_SERVER['REQUEST_URI'] ?? '',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'user_id' => get_current_user_id(),
        'memory_usage' => memory_get_usage(true),
        'peak_memory' => memory_get_peak_usage(true)
    ];
    
    error_log('PS_THEME_ERROR: ' . wp_json_encode($log_entry));
}

// 8. تحسين الأداء بـ Object Caching
function ps_cache_get($key, $group = 'ps_theme') {
    $cache_key = 'ps_' . md5($key);
    
    // محاولة الحصول من Object Cache أولاً
    $value = wp_cache_get($cache_key, $group);
    
    if ($value === false) {
        // محاولة الحصول من Transients كبديل
        $value = get_transient($cache_key);
    }
    
    return $value;
}

function ps_cache_set($key, $value, $group = 'ps_theme', $expiration = 3600) {
    $cache_key = 'ps_' . md5($key);
    
    // حفظ في Object Cache
    wp_cache_set($cache_key, $value, $group, $expiration);
    
    // حفظ في Transients كبديل
    set_transient($cache_key, $value, $expiration);
    
    return true;
}

// 9. إضافة نظام تحديث القالب التلقائي
class PS_Theme_Updater {
    private $theme_slug = 'practical-solutions-pro';
    private $version = '2.1.0';
    private $update_server = 'https://api.yoursite.com/theme-updates/';
    
    public function __construct() {
        add_filter('pre_set_site_transient_update_themes', [$this, 'check_for_updates']);
    }
    
    public function check_for_updates($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }
        
        $remote_version = $this->get_remote_version();
        
        if (version_compare($this->version, $remote_version, '<')) {
            $transient->response[$this->theme_slug] = [
                'theme' => $this->theme_slug,
                'new_version' => $remote_version,
                'url' => 'https://yoursite.com/theme-info/',
                'package' => $this->get_download_url()
            ];
        }
        
        return $transient;
    }
    
    private function get_remote_version() {
        $request = wp_remote_get($this->update_server . 'check-version.php');
        
        if (!is_wp_error($request) && wp_remote_retrieve_response_code($request) === 200) {
            return wp_remote_retrieve_body($request);
        }
        
        return $this->version;
    }
    
    private function get_download_url() {
        return $this->update_server . 'download.php?theme=' . $this->theme_slug;
    }
}
new PS_Theme_Updater();

// 10. إضافة Analytics Dashboard
function ps_add_analytics_dashboard() {
    if (!current_user_can('manage_options')) return;
    
    add_dashboard_widget(
        'ps_analytics_widget',
        '📊 إحصائيات الحلول العملية',
        'ps_render_analytics_widget'
    );
}
add_action('wp_dashboard_setup', 'ps_add_analytics_dashboard');

function ps_render_analytics_widget() {
    global $wpdb;
    
    // إحصائيات البحث
    $search_stats = $wpdb->get_results("
        SELECT 
            JSON_EXTRACT(data, '$.query') as query,
            COUNT(*) as count
        FROM {$wpdb->prefix}ps_analytics 
        WHERE event = 'search' 
        AND timestamp >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        GROUP BY query 
        ORDER BY count DESC 
        LIMIT 5
    ");
    
    echo '<div class="ps-analytics-widget">';
    echo '<h4>🔍 أشهر عمليات البحث (آخر 7 أيام)</h4>';
    
    if ($search_stats) {
        echo '<ul>';
        foreach ($search_stats as $stat) {
            $query = trim($stat->query, '"');
            echo '<li><strong>' . esc_html($query) . '</strong> - ' . intval($stat->count) . ' مرة</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>لا توجد إحصائيات بحث متاحة.</p>';
    }
    
    echo '</div>';
}
?>