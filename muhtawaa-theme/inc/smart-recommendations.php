<?php
/**
 * نظام التوصيات الذكية
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة نظام التوصيات الذكية
 */
class MuhtawaaSmartRecommendations {
    
    /**
     * تهيئة نظام التوصيات
     */
    public static function init() {
        // خطاف لعرض التوصيات في المقالات
        add_action('wp_footer', array(__CLASS__, 'add_recommendations_script'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_recommendations_assets'));
        
        // AJAX للحصول على التوصيات
        add_action('wp_ajax_get_smart_recommendations', array(__CLASS__, 'get_recommendations_ajax'));
        add_action('wp_ajax_nopriv_get_smart_recommendations', array(__CLASS__, 'get_recommendations_ajax'));
        
        // تحديث إحصائيات المقالات
        add_action('wp_head', array(__CLASS__, 'track_post_view'));
        
        // خطاف لعرض التوصيات بعد المحتوى
        add_filter('the_content', array(__CLASS__, 'add_recommendations_to_content'));
        
        // جدولة تحديث خوارزمية التوصيات
        add_action('wp', array(__CLASS__, 'schedule_recommendations_update'));
        add_action('muhtawaa_update_recommendations', array(__CLASS__, 'update_recommendations_cache'));
    }
    
    /**
     * تحميل أصول نظام التوصيات
     */
    public static function enqueue_recommendations_assets() {
        if (is_single()) {
            // CSS التوصيات
            wp_add_inline_style('muhtawaa-style', self::get_recommendations_css());
            
            // JavaScript التوصيات
            wp_add_inline_script('muhtawaa-main', self::get_recommendations_js());
        }
    }
    
    /**
     * تتبع مشاهدة المقال
     */
    public static function track_post_view() {
        if (is_single()) {
            $post_id = get_the_ID();
            $user_id = get_current_user_id();
            $ip_address = self::get_user_ip();
            
            // تحديث عدد المشاهدات
            $views = get_post_meta($post_id, '_muhtawaa_views', true);
            $views = $views ? intval($views) + 1 : 1;
            update_post_meta($post_id, '_muhtawaa_views', $views);
            
            // حفظ بيانات المشاهدة للمستخدمين المسجلين
            if ($user_id > 0) {
                $user_views = get_user_meta($user_id, '_muhtawaa_viewed_posts', true);
                $user_views = $user_views ? $user_views : array();
                
                if (!in_array($post_id, $user_views)) {
                    $user_views[] = $post_id;
                    update_user_meta($user_id, '_muhtawaa_viewed_posts', $user_views);
                }
            }
            
            // حفظ بيانات المشاهدة للزوار (مؤقتاً)
            if (!isset($_COOKIE['muhtawaa_viewed_posts'])) {
                setcookie('muhtawaa_viewed_posts', json_encode(array($post_id)), time() + (30 * 24 * 60 * 60), '/');
            } else {
                $viewed_posts = json_decode($_COOKIE['muhtawaa_viewed_posts'], true);
                if (!in_array($post_id, $viewed_posts)) {
                    $viewed_posts[] = $post_id;
                    setcookie('muhtawaa_viewed_posts', json_encode($viewed_posts), time() + (30 * 24 * 60 * 60), '/');
                }
            }
        }
    }
    
    /**
     * الحصول على التوصيات عبر AJAX
     */
    public static function get_recommendations_ajax() {
        check_ajax_referer('muhtawaa_recommendations_nonce', 'nonce');
        
        $post_id = intval($_POST['post_id']);
        $count = isset($_POST['count']) ? intval($_POST['count']) : 6;
        
        $recommendations = self::get_post_recommendations($post_id, $count);
        
        wp_send_json_success($recommendations);
    }
    
    /**
     * الحصول على توصيات المقال
     */
    public static function get_post_recommendations($post_id, $count = 6) {
        // محاولة الحصول على التوصيات من الكاش أولاً
        $cache_key = 'muhtawaa_recommendations_' . $post_id . '_' . $count;
        $cached_recommendations = get_transient($cache_key);
        
        if ($cached_recommendations !== false) {
            return $cached_recommendations;
        }
        
        $current_post = get_post($post_id);
        if (!$current_post) {
            return array();
        }
        
        $recommendations = array();
        
        // 1. مقالات من نفس الفئة
        $category_posts = self::get_related_by_category($post_id, $count);
        $recommendations = array_merge($recommendations, $category_posts);
        
        // 2. مقالات بنفس الكلمات المفتاحية
        if (count($recommendations) < $count) {
            $tag_posts = self::get_related_by_tags($post_id, $count - count($recommendations));
            $recommendations = array_merge($recommendations, $tag_posts);
        }
        
        // 3. مقالات مشابهة في المحتوى
        if (count($recommendations) < $count) {
            $content_posts = self::get_related_by_content($post_id, $count - count($recommendations));
            $recommendations = array_merge($recommendations, $content_posts);
        }
        
        // 4. مقالات شائعة (الأكثر مشاهدة)
        if (count($recommendations) < $count) {
            $popular_posts = self::get_popular_posts($count - count($recommendations), $post_id);
            $recommendations = array_merge($recommendations, $popular_posts);
        }
        
        // 5. مقالات حديثة
        if (count($recommendations) < $count) {
            $recent_posts = self::get_recent_posts($count - count($recommendations), $post_id);
            $recommendations = array_merge($recommendations, $recent_posts);
        }
        
        // إزالة التكرارات والمقال الحالي
        $unique_recommendations = array();
        $seen_ids = array($post_id);
        
        foreach ($recommendations as $post) {
            if (!in_array($post['id'], $seen_ids)) {
                $unique_recommendations[] = $post;
                $seen_ids[] = $post['id'];
                
                if (count($unique_recommendations) >= $count) {
                    break;
                }
            }
        }
        
        // ترتيب التوصيات حسب النقاط
        usort($unique_recommendations, function($a, $b) {
            return $b['score'] - $a['score'];
        });
        
        // حفظ في الكاش لمدة ساعة
        set_transient($cache_key, $unique_recommendations, HOUR_IN_SECONDS);
        
        return $unique_recommendations;
    }
    
    /**
     * الحصول على مقالات مرتبطة بنفس الفئة
     */
    private static function get_related_by_category($post_id, $count) {
        $categories = wp_get_post_categories($post_id);
        if (empty($categories)) {
            return array();
        }
        
        $posts = get_posts(array(
            'category__in' => $categories,
            'post__not_in' => array($post_id),
            'numberposts' => $count * 2,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        ));
        
        $related_posts = array();
        foreach ($posts as $post) {
            $related_posts[] = array(
                'id' => $post->ID,
                'title' => get_the_title($post->ID),
                'url' => get_permalink($post->ID),
                'excerpt' => self::get_smart_excerpt($post->post_content, 100),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'medium'),
                'date' => get_the_date('Y-m-d', $post->ID),
                'score' => 90, // نقاط عالية للمقالات من نفس الفئة
                'reason' => 'same_category'
            );
        }
        
        return $related_posts;
    }
    
    /**
     * الحصول على مقالات مرتبطة بنفس الكلمات المفتاحية
     */
    private static function get_related_by_tags($post_id, $count) {
        $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
        if (empty($tags)) {
            return array();
        }
        
        $posts = get_posts(array(
            'tag__in' => $tags,
            'post__not_in' => array($post_id),
            'numberposts' => $count * 2,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        ));
        
        $related_posts = array();
        foreach ($posts as $post) {
            $related_posts[] = array(
                'id' => $post->ID,
                'title' => get_the_title($post->ID),
                'url' => get_permalink($post->ID),
                'excerpt' => self::get_smart_excerpt($post->post_content, 100),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'medium'),
                'date' => get_the_date('Y-m-d', $post->ID),
                'score' => 80, // نقاط جيدة للمقالات بنفس الكلمات المفتاحية
                'reason' => 'same_tags'
            );
        }
        
        return $related_posts;
    }
    
    /**
     * الحصول على مقالات مشابهة في المحتوى
     */
    private static function get_related_by_content($post_id, $count) {
        $current_post = get_post($post_id);
        if (!$current_post) {
            return array();
        }
        
        // استخراج الكلمات الأساسية من المحتوى
        $content_words = self::extract_keywords($current_post->post_content . ' ' . $current_post->post_title);
        
        if (empty($content_words)) {
            return array();
        }
        
        // البحث في قاعدة البيانات
        global $wpdb;
        
        $keywords_string = implode('|', array_map('preg_quote', $content_words));
        
        $query = $wpdb->prepare("
            SELECT p.ID, p.post_title, p.post_content, p.post_date,
                   (
                       CASE WHEN p.post_title REGEXP %s THEN 10 ELSE 0 END +
                       CASE WHEN p.post_content REGEXP %s THEN 5 ELSE 0 END
                   ) as relevance_score
            FROM {$wpdb->posts} p
            WHERE p.post_status = 'publish'
            AND p.post_type = 'post'
            AND p.ID != %d
            AND (p.post_title REGEXP %s OR p.post_content REGEXP %s)
            ORDER BY relevance_score DESC, p.post_date DESC
            LIMIT %d
        ", $keywords_string, $keywords_string, $post_id, $keywords_string, $keywords_string, $count * 2);
        
        $results = $wpdb->get_results($query);
        
        $related_posts = array();
        foreach ($results as $post) {
            $related_posts[] = array(
                'id' => $post->ID,
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
                'excerpt' => self::get_smart_excerpt($post->post_content, 100),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'medium'),
                'date' => get_the_date('Y-m-d', $post->ID),
                'score' => 70 + intval($post->relevance_score), // نقاط متغيرة حسب التشابه
                'reason' => 'similar_content'
            );
        }
        
        return $related_posts;
    }
    
    /**
     * الحصول على المقالات الأكثر شعبية
     */
    private static function get_popular_posts($count, $exclude_id = 0) {
        $posts = get_posts(array(
            'numberposts' => $count * 2,
            'meta_key' => '_muhtawaa_views',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post__not_in' => array($exclude_id),
            'post_status' => 'publish'
        ));
        
        $popular_posts = array();
        foreach ($posts as $post) {
            $views = get_post_meta($post->ID, '_muhtawaa_views', true);
            $popular_posts[] = array(
                'id' => $post->ID,
                'title' => get_the_title($post->ID),
                'url' => get_permalink($post->ID),
                'excerpt' => self::get_smart_excerpt($post->post_content, 100),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'medium'),
                'date' => get_the_date('Y-m-d', $post->ID),
                'score' => 50 + min(intval($views) / 10, 30), // نقاط متوسطة مع زيادة حسب المشاهدات
                'reason' => 'popular'
            );
        }
        
        return $popular_posts;
    }
    
    /**
     * الحصول على المقالات الحديثة
     */
    private static function get_recent_posts($count, $exclude_id = 0) {
        $posts = get_posts(array(
            'numberposts' => $count,
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => array($exclude_id),
            'post_status' => 'publish'
        ));
        
        $recent_posts = array();
        foreach ($posts as $post) {
            $recent_posts[] = array(
                'id' => $post->ID,
                'title' => get_the_title($post->ID),
                'url' => get_permalink($post->ID),
                'excerpt' => self::get_smart_excerpt($post->post_content, 100),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'medium'),
                'date' => get_the_date('Y-m-d', $post->ID),
                'score' => 40, // نقاط منخفضة للمقالات الحديثة فقط
                'reason' => 'recent'
            );
        }
        
        return $recent_posts;
    }
    
    /**
     * استخراج الكلمات الأساسية من النص
     */
    private static function extract_keywords($text) {
        // تنظيف النص
        $text = strip_tags($text);
        $text = preg_replace('/[^\p{Arabic}\p{L}\s]/u', ' ', $text);
        $text = preg_replace('/\s+/', ' ', trim($text));
        
        // تقسيم النص إلى كلمات
        $words = explode(' ', $text);
        
        // الكلمات المستبعدة (كلمات الوصل)
        $stop_words = array(
            'في', 'من', 'إلى', 'على', 'عن', 'مع', 'هذا', 'هذه', 'ذلك', 'تلك',
            'التي', 'الذي', 'التي', 'اللذان', 'اللتان', 'الذين', 'اللواتي',
            'ما', 'كيف', 'متى', 'أين', 'لماذا', 'أم', 'أو', 'لكن', 'لكن',
            'بعد', 'قبل', 'أثناء', 'خلال', 'ضد', 'نحو', 'حول', 'بين',
            'تحت', 'فوق', 'أمام', 'خلف', 'يمين', 'يسار', 'شرق', 'غرب',
            'the', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of',
            'with', 'by', 'from', 'up', 'about', 'into', 'through', 'during'
        );
        
        // فلترة الكلمات
        $keywords = array();
        foreach ($words as $word) {
            $word = trim($word);
            if (strlen($word) > 2 && !in_array(strtolower($word), $stop_words)) {
                $keywords[] = $word;
            }
        }
        
        // الحصول على الكلمات الأكثر تكراراً
        $word_count = array_count_values($keywords);
        arsort($word_count);
        
        return array_slice(array_keys($word_count), 0, 10);
    }
    
    /**
     * الحصول على مقتطف ذكي
     */
    private static function get_smart_excerpt($content, $length = 100) {
        $content = strip_tags($content);
        $content = preg_replace('/\s+/', ' ', trim($content));
        
        if (strlen($content) <= $length) {
            return $content;
        }
        
        $excerpt = substr($content, 0, $length);
        $last_space = strrpos($excerpt, ' ');
        
        if ($last_space !== false) {
            $excerpt = substr($excerpt, 0, $last_space);
        }
        
        return $excerpt . '...';
    }
    
    /**
     * إضافة التوصيات إلى المحتوى
     */
    public static function add_recommendations_to_content($content) {
        if (is_single() && !is_admin() && is_main_query()) {
            $recommendations_html = self::get_recommendations_html();
            $content .= $recommendations_html;
        }
        
        return $content;
    }
    
    /**
     * الحصول على HTML التوصيات
     */
    private static function get_recommendations_html() {
        ob_start();
        ?>
        <div id="muhtawaa-recommendations" class="muhtawaa-recommendations-container">
            <div class="recommendations-header">
                <h3>قد يعجبك أيضاً</h3>
                <div class="recommendations-loading">
                    <span class="loading-spinner"></span>
                    جاري تحميل التوصيات...
                </div>
            </div>
            <div class="recommendations-grid" id="recommendations-grid"></div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * إضافة سكريبت التوصيات
     */
    public static function add_recommendations_script() {
        if (is_single()) {
            $post_id = get_the_ID();
            $nonce = wp_create_nonce('muhtawaa_recommendations_nonce');
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    loadSmartRecommendations(<?php echo $post_id; ?>, '<?php echo $nonce; ?>');
                });
            </script>
            <?php
        }
    }
    
    /**
     * الحصول على CSS التوصيات
     */
    private static function get_recommendations_css() {
        return "
        .muhtawaa-recommendations-container {
            margin: 2rem 0;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }
        
        .recommendations-header h3 {
            margin: 0 0 1rem 0;
            color: #2c3e50;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .recommendations-loading {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .loading-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid #e9ecef;
            border-top: 2px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .recommendations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .recommendation-item {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e9ecef;
        }
        
        .recommendation-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .recommendation-thumbnail {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 0.75rem;
        }
        
        .recommendation-title {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            line-height: 1.4;
        }
        
        .recommendation-title a {
            color: #2c3e50;
            text-decoration: none;
        }
        
        .recommendation-title a:hover {
            color: #007bff;
        }
        
        .recommendation-excerpt {
            color: #6c757d;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 0.75rem;
        }
        
        .recommendation-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: #adb5bd;
        }
        
        .recommendation-date {
            font-style: italic;
        }
        
        .recommendation-reason {
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
        }
        
        @media (max-width: 768px) {
            .muhtawaa-recommendations-container {
                padding: 1rem;
                margin: 1rem 0;
            }
            
            .recommendations-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .recommendation-item {
                padding: 0.75rem;
            }
            
            .recommendation-thumbnail {
                height: 120px;
            }
        }
        ";
    }
    
    /**
     * الحصول على JavaScript التوصيات
     */
    private static function get_recommendations_js() {
        return '
        function loadSmartRecommendations(postId, nonce) {
            const container = document.getElementById("muhtawaa-recommendations");
            const grid = document.getElementById("recommendations-grid");
            const loading = container.querySelector(".recommendations-loading");
            
            if (!container || !grid) return;
            
            // إظهار مؤشر التحميل
            loading.style.display = "flex";
            
            fetch(muhtawaa_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                    action: "get_smart_recommendations",
                    post_id: postId,
                    count: 6,
                    nonce: nonce
                })
            })
            .then(response => response.json())
            .then(data => {
                loading.style.display = "none";
                
                if (data.success && data.data.length > 0) {
                    renderRecommendations(grid, data.data);
                } else {
                    container.style.display = "none";
                }
            })
            .catch(error => {
                console.error("خطأ في تحميل التوصيات:", error);
                loading.style.display = "none";
                container.style.display = "none";
            });
        }
        
        function renderRecommendations(grid, recommendations) {
            grid.innerHTML = "";

            recommendations.forEach(item => {
                const reasonLabels = {
                    "same_category": "نفس الفئة",
                    "same_tags": "كلمات مشابهة",
                    "similar_content": "محتوى مشابه",
                    "popular": "الأكثر شعبية",
                    "recent": "حديث"
                };

                const reasonLabel = reasonLabels[item.reason] || "مقترح";

                const itemHtml = `
                    <article class="recommendation-item">
                        ${item.thumbnail ? `<img src="${item.thumbnail}" alt="${item.title}" class="recommendation-thumbnail" loading="lazy">` : ""}
                        <h4 class="recommendation-title">
                            <a href="${item.url}">${item.title}</a>
                        </h4>
                        <p class="recommendation-excerpt">${item.excerpt}</p>
                        <div class="recommendation-meta">
                            <span class="recommendation-date">${formatDate(item.date)}</span>
                            <span class="recommendation-reason">${reasonLabel}</span>
                        </div>
                    </article>
                `;

                grid.insertAdjacentHTML("beforeend", itemHtml);
            });
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays === 1) return "أمس";
            if (diffDays <= 7) return `منذ ${diffDays} أيام`;
            if (diffDays <= 30) return `منذ ${Math.ceil(diffDays / 7)} أسابيع`;
            if (diffDays <= 365) return `منذ ${Math.ceil(diffDays / 30)} أشهر`;
            return `منذ ${Math.ceil(diffDays / 365)} سنوات`;
        }
        ';
    }
    
    /**
     * جدولة تحديث التوصيات
     */
    public static function schedule_recommendations_update() {
        if (!wp_next_scheduled('muhtawaa_update_recommendations')) {
            wp_schedule_event(time(), 'hourly', 'muhtawaa_update_recommendations');
        }
    }
    
    /**
     * تحديث كاش التوصيات
     */
    public static function update_recommendations_cache() {
        // الحصول على أحدث المقالات
        $recent_posts = get_posts(array(
            'numberposts' => 50,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        
        // تحديث كاش التوصيات لكل مقال
        foreach ($recent_posts as $post) {
            $cache_keys = array(
                'muhtawaa_recommendations_' . $post->ID . '_6',
                'muhtawaa_recommendations_' . $post->ID . '_4',
                'muhtawaa_recommendations_' . $post->ID . '_8'
            );
            
            foreach ($cache_keys as $key) {
                delete_transient($key);
            }
        }
    }
    
    /**
     * الحصول على عنوان IP للمستخدم
     */
    private static function get_user_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return '0.0.0.0';
    }
    
    /**
     * الحصول على توصيات للمستخدم المسجل
     */
    public static function get_user_personalized_recommendations($user_id, $count = 10) {
        $viewed_posts = get_user_meta($user_id, '_muhtawaa_viewed_posts', true);
        $viewed_posts = $viewed_posts ? $viewed_posts : array();
        
        if (empty($viewed_posts)) {
            return self::get_popular_posts($count);
        }
        
        // تحليل اهتمامات المستخدم
        $user_categories = array();
        $user_tags = array();
        
        foreach ($viewed_posts as $post_id) {
            $categories = wp_get_post_categories($post_id);
            $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
            
            $user_categories = array_merge($user_categories, $categories);
            $user_tags = array_merge($user_tags, $tags);
        }
        
        // الحصول على الفئات والكلمات المفتاحية الأكثر تكراراً
        $top_categories = array_slice(array_keys(array_count_values($user_categories)), 0, 3);
        $top_tags = array_slice(array_keys(array_count_values($user_tags)), 0, 5);
        
        // البحث عن مقالات مشابهة
        $query_args = array(
            'numberposts' => $count * 2,
            'post__not_in' => $viewed_posts,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        if (!empty($top_categories)) {
            $query_args['category__in'] = $top_categories;
        }
        
        if (!empty($top_tags)) {
            $query_args['tag__in'] = $top_tags;
        }
        
        $recommended_posts = get_posts($query_args);
        
        $recommendations = array();
        foreach ($recommended_posts as $post) {
            $recommendations[] = array(
                'id' => $post->ID,
                'title' => get_the_title($post->ID),
                'url' => get_permalink($post->ID),
                'excerpt' => self::get_smart_excerpt($post->post_content, 100),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'medium'),
                'date' => get_the_date('Y-m-d', $post->ID),
                'score' => 95, // نقاط عالية للتوصيات الشخصية
                'reason' => 'personalized'
            );
            
            if (count($recommendations) >= $count) {
                break;
            }
        }
        
        return $recommendations;
    }
    
    /**
     * إضافة ويدجت التوصيات الذكية
     */
    public static function register_recommendations_widget() {
        register_widget('Muhtawaa_Smart_Recommendations_Widget');
    }
    
    /**
     * الحصول على إحصائيات التوصيات
     */
    public static function get_recommendations_stats() {
        global $wpdb;
        
        $stats = array();
        
        // إجمالي المقالات
        $stats['total_posts'] = wp_count_posts()->publish;
        
        // المقالات الأكثر مشاهدة
        $popular_posts = $wpdb->get_results("
            SELECT post_id, meta_value as views 
            FROM {$wpdb->postmeta} 
            WHERE meta_key = '_muhtawaa_views' 
            ORDER BY CAST(meta_value AS UNSIGNED) DESC 
            LIMIT 10
        ");
        
        $stats['popular_posts'] = array();
        foreach ($popular_posts as $post) {
            $stats['popular_posts'][] = array(
                'id' => $post->post_id,
                'title' => get_the_title($post->post_id),
                'views' => intval($post->views)
            );
        }
        
        // إحصائيات الفئات
        $categories = get_categories(array('hide_empty' => true));
        $stats['categories_count'] = count($categories);
        
        // إحصائيات الكلمات المفتاحية
        $tags = get_tags(array('hide_empty' => true));
        $stats['tags_count'] = count($tags);
        
        return $stats;
    }
}

/**
 * ويدجت التوصيات الذكية
 */
class Muhtawaa_Smart_Recommendations_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'muhtawaa_smart_recommendations',
            __('التوصيات الذكية - محتوى', 'muhtawaa'),
            array(
                'description' => __('عرض التوصيات الذكية للمقالات المرتبطة', 'muhtawaa')
            )
        );
    }
    
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $count = isset($instance['count']) ? intval($instance['count']) : 5;
        $show_thumbnails = isset($instance['show_thumbnails']) ? $instance['show_thumbnails'] : true;
        
        echo $args['before_widget'];
        
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        if (is_single()) {
            $post_id = get_the_ID();
            $recommendations = MuhtawaaSmartRecommendations::get_post_recommendations($post_id, $count);
        } else {
            $recommendations = MuhtawaaSmartRecommendations::get_popular_posts($count);
        }
        
        if (!empty($recommendations)) {
            echo '<div class="smart-recommendations-widget">';
            
            foreach ($recommendations as $item) {
                echo '<div class="recommendation-widget-item">';
                
                if ($show_thumbnails && $item['thumbnail']) {
                    echo '<div class="recommendation-widget-thumbnail">';
                    echo '<img src="' . esc_url($item['thumbnail']) . '" alt="' . esc_attr($item['title']) . '">';
                    echo '</div>';
                }
                
                echo '<div class="recommendation-widget-content">';
                echo '<h4><a href="' . esc_url($item['url']) . '">' . esc_html($item['title']) . '</a></h4>';
                echo '<p>' . esc_html($item['excerpt']) . '</p>';
                echo '<small>' . esc_html($item['date']) . '</small>';
                echo '</div>';
                
                echo '</div>';
            }
            
            echo '</div>';
        }
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : __('قد يعجبك أيضاً', 'muhtawaa');
        $count = isset($instance['count']) ? $instance['count'] : 5;
        $show_thumbnails = isset($instance['show_thumbnails']) ? $instance['show_thumbnails'] : true;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'muhtawaa'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('عدد المقالات:', 'muhtawaa'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" min="1" max="20" value="<?php echo esc_attr($count); ?>">
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_thumbnails); ?> id="<?php echo $this->get_field_id('show_thumbnails'); ?>" name="<?php echo $this->get_field_name('show_thumbnails'); ?>">
            <label for="<?php echo $this->get_field_id('show_thumbnails'); ?>"><?php _e('عرض الصور المصغرة', 'muhtawaa'); ?></label>
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['count'] = (!empty($new_instance['count'])) ? intval($new_instance['count']) : 5;
        $instance['show_thumbnails'] = isset($new_instance['show_thumbnails']);
        
        return $instance;
    }
}

// تهيئة نظام التوصيات الذكية
add_action('init', array('MuhtawaaSmartRecommendations', 'init'));
add_action('widgets_init', array('MuhtawaaSmartRecommendations', 'register_recommendations_widget'));