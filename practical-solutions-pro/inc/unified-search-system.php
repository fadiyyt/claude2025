<?php
/**
 * Unified Search System - Enhanced for Arabic
 * نظام البحث الموحد المحسن للعربية
 */

if (!defined('ABSPATH')) {
    exit;
}

class PS_Unified_Search_System {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_search_assets']);
        add_action('wp_ajax_ps_search', [$this, 'handle_ajax_search']);
        add_action('wp_ajax_nopriv_ps_search', [$this, 'handle_ajax_search']);
        add_action('wp_ajax_ps_search_suggestions', [$this, 'get_search_suggestions']);
        add_action('wp_ajax_nopriv_ps_search_suggestions', [$this, 'get_search_suggestions']);
        add_filter('posts_search', [$this, 'improve_search_query'], 10, 2);
        add_action('init', [$this, 'create_search_table']);
        add_shortcode('ps_search_form', [$this, 'search_form_shortcode']);
    }
    
    public function enqueue_search_assets() {
        wp_enqueue_script('ps-search', PS_THEME_URI . '/assets/js/search.js', ['jquery'], PS_THEME_VERSION, true);
        wp_enqueue_style('ps-search-style', PS_THEME_URI . '/assets/css/search.css', [], PS_THEME_VERSION);
        
        wp_localize_script('ps-search', 'psSearch', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ps_search_nonce'),
            'strings' => [
                'searching' => __('جاري البحث...', 'practical-solutions'),
                'no_results' => __('لا توجد نتائج', 'practical-solutions'),
                'min_chars' => __('يرجى إدخال 3 أحرف على الأقل', 'practical-solutions'),
                'search_placeholder' => __('ابحث في الموقع...', 'practical-solutions')
            ]
        ]);
    }
    
    public function create_search_table() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_search_stats';
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            search_term varchar(255) NOT NULL,
            search_count int(11) DEFAULT 1,
            results_count int(11) DEFAULT 0,
            last_searched datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY search_term (search_term)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    public function handle_ajax_search() {
        check_ajax_referer('ps_search_nonce', 'nonce');
        
        $search_term = sanitize_text_field($_POST['search_term']);
        $post_type = sanitize_text_field($_POST['post_type'] ?? 'post');
        $per_page = intval($_POST['per_page'] ?? 10);
        
        if (strlen($search_term) < 3) {
            wp_send_json_error(__('يرجى إدخال 3 أحرف على الأقل', 'practical-solutions'));
        }
        
        $this->log_search_term($search_term);
        
        $results = $this->perform_advanced_search($search_term, $post_type, $per_page);
        
        if (!empty($results['posts'])) {
            wp_send_json_success([
                'posts' => $results['posts'],
                'total' => $results['total'],
                'suggestions' => $this->get_related_suggestions($search_term)
            ]);
        } else {
            wp_send_json_error([
                'message' => __('لا توجد نتائج لهذا البحث', 'practical-solutions'),
                'suggestions' => $this->get_popular_searches()
            ]);
        }
    }
    
    public function get_search_suggestions() {
        check_ajax_referer('ps_search_nonce', 'nonce');
        
        $term = sanitize_text_field($_POST['term']);
        
        if (strlen($term) < 2) {
            wp_send_json_success([]);
        }
        
        $suggestions = $this->get_smart_suggestions($term);
        
        wp_send_json_success($suggestions);
    }
    
    private function perform_advanced_search($search_term, $post_type = 'post', $per_page = 10) {
        global $wpdb;
        
        // تنظيف وتحسين مصطلح البحث للعربية
        $cleaned_term = $this->clean_arabic_search_term($search_term);
        $search_words = explode(' ', $cleaned_term);
        
        $args = [
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'meta_query' => [],
            'orderby' => 'relevance',
            'order' => 'DESC'
        ];
        
        // بناء استعلام بحث متقدم
        $search_query = $this->build_advanced_search_query($search_words);
        $args['search_terms'] = $search_query;
        
        add_filter('posts_search', [$this, 'custom_search_filter'], 10, 2);
        
        $query = new WP_Query($args);
        
        remove_filter('posts_search', [$this, 'custom_search_filter'], 10);
        
        $posts_data = [];
        while ($query->have_posts()) {
            $query->the_post();
            $posts_data[] = [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => $this->get_search_excerpt(get_the_content(), $search_term),
                'url' => get_permalink(),
                'date' => get_the_date(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                'category' => $this->get_primary_category()
            ];
        }
        wp_reset_postdata();
        
        // تسجيل عدد النتائج
        $this->update_search_stats($search_term, $query->found_posts);
        
        return [
            'posts' => $posts_data,
            'total' => $query->found_posts
        ];
    }
    
    private function clean_arabic_search_term($term) {
        // إزالة التشكيل
        $term = preg_replace('/[\x{064B}-\x{065F}]/u', '', $term);
        
        // تطبيع الهمزات
        $term = str_replace(['أ', 'إ', 'آ'], 'ا', $term);
        $term = str_replace(['ة'], 'ه', $term);
        $term = str_replace(['ى'], 'ي', $term);
        
        return trim($term);
    }
    
    private function build_advanced_search_query($search_words) {
        global $wpdb;
        
        $search_conditions = [];
        
        foreach ($search_words as $word) {
            if (strlen($word) > 2) {
                $word = $wpdb->esc_like($word);
                $search_conditions[] = "({$wpdb->posts}.post_title LIKE '%{$word}%' OR {$wpdb->posts}.post_content LIKE '%{$word}%' OR {$wpdb->posts}.post_excerpt LIKE '%{$word}%')";
            }
        }
        
        return implode(' AND ', $search_conditions);
    }
    
    public function custom_search_filter($search, $wp_query) {
        global $wpdb;
        
        if (!$wp_query->is_search() || !isset($wp_query->query_vars['search_terms'])) {
            return $search;
        }
        
        $search_query = $wp_query->query_vars['search_terms'];
        
        if (!empty($search_query)) {
            $search = " AND ({$search_query}) ";
        }
        
        return $search;
    }
    
    private function get_search_excerpt($content, $search_term) {
        $content = strip_tags($content);
        $search_pos = mb_stripos($content, $search_term);
        
        if ($search_pos !== false) {
            $start = max(0, $search_pos - 50);
            $excerpt = mb_substr($content, $start, 200);
            
            // تمييز الكلمة المبحوث عنها
            $excerpt = str_ireplace($search_term, '<mark>' . $search_term . '</mark>', $excerpt);
            
            return '...' . $excerpt . '...';
        }
        
        return mb_substr($content, 0, 150) . '...';
    }
    
    private function get_primary_category() {
        $categories = get_the_category();
        if (!empty($categories)) {
            return $categories[0]->name;
        }
        return '';
    }
    
    private function get_smart_suggestions($term) {
        global $wpdb;
        
        $suggestions = [];
        
        // البحث في المقالات المنشورة
        $posts = $wpdb->get_results($wpdb->prepare("
            SELECT post_title 
            FROM {$wpdb->posts} 
            WHERE post_status = 'publish' 
            AND post_type = 'post'
            AND post_title LIKE %s 
            ORDER BY post_date DESC 
            LIMIT 5
        ", '%' . $wpdb->esc_like($term) . '%'));
        
        foreach ($posts as $post) {
            $suggestions[] = [
                'title' => $post->post_title,
                'type' => 'post'
            ];
        }
        
        // البحث في التصنيفات
        $categories = $wpdb->get_results($wpdb->prepare("
            SELECT name 
            FROM {$wpdb->terms} t
            INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
            WHERE tt.taxonomy = 'category'
            AND name LIKE %s 
            LIMIT 3
        ", '%' . $wpdb->esc_like($term) . '%'));
        
        foreach ($categories as $category) {
            $suggestions[] = [
                'title' => $category->name,
                'type' => 'category'
            ];
        }
        
        // إضافة الاقتراحات الشائعة
        $popular = $this->get_popular_searches(3);
        $suggestions = array_merge($suggestions, $popular);
        
        return array_slice($suggestions, 0, 8);
    }
    
    private function get_related_suggestions($search_term) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_search_stats';
        
        $suggestions = $wpdb->get_results($wpdb->prepare("
            SELECT search_term, search_count 
            FROM {$table_name} 
            WHERE search_term LIKE %s 
            AND search_term != %s
            ORDER BY search_count DESC 
            LIMIT 5
        ", '%' . $wpdb->esc_like($search_term) . '%', $search_term));
        
        return array_map(function($item) {
            return [
                'title' => $item->search_term,
                'type' => 'suggestion',
                'count' => $item->search_count
            ];
        }, $suggestions);
    }
    
    private function get_popular_searches($limit = 5) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_search_stats';
        
        $popular = $wpdb->get_results($wpdb->prepare("
            SELECT search_term, search_count 
            FROM {$table_name} 
            ORDER BY search_count DESC 
            LIMIT %d
        ", $limit));
        
        return array_map(function($item) {
            return [
                'title' => $item->search_term,
                'type' => 'popular',
                'count' => $item->search_count
            ];
        }, $popular);
    }
    
    private function log_search_term($search_term) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_search_stats';
        
        $wpdb->query($wpdb->prepare("
            INSERT INTO {$table_name} (search_term, search_count, last_searched) 
            VALUES (%s, 1, NOW()) 
            ON DUPLICATE KEY UPDATE 
            search_count = search_count + 1, 
            last_searched = NOW()
        ", $search_term));
    }
    
    private function update_search_stats($search_term, $results_count) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ps_search_stats';
        
        $wpdb->update(
            $table_name,
            ['results_count' => $results_count],
            ['search_term' => $search_term],
            ['%d'],
            ['%s']
        );
    }
    
    public function improve_search_query($search, $wp_query) {
        if (!$wp_query->is_search() || is_admin()) {
            return $search;
        }
        
        global $wpdb;
        $search_term = $wp_query->query_vars['s'];
        
        if (!empty($search_term)) {
            $cleaned_term = $this->clean_arabic_search_term($search_term);
            $search_words = explode(' ', $cleaned_term);
            
            $search_conditions = [];
            foreach ($search_words as $word) {
                if (strlen($word) > 2) {
                    $word = $wpdb->esc_like($word);
                    $search_conditions[] = "({$wpdb->posts}.post_title LIKE '%{$word}%' OR {$wpdb->posts}.post_content LIKE '%{$word}%')";
                }
            }
            
            if (!empty($search_conditions)) {
                $search = ' AND (' . implode(' OR ', $search_conditions) . ') ';
            }
        }
        
        return $search;
    }
    
    public function search_form_shortcode($atts) {
        $atts = shortcode_atts([
            'placeholder' => __('ابحث في الموقع...', 'practical-solutions'),
            'button_text' => __('بحث', 'practical-solutions'),
            'show_suggestions' => true,
            'style' => 'default'
        ], $atts);
        
        ob_start();
        ?>
        <form class="ps-search-form ps-search-<?php echo esc_attr($atts['style']); ?>" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="ps-search-wrapper">
                <input type="search" 
                       name="s" 
                       class="ps-search-input" 
                       placeholder="<?php echo esc_attr($atts['placeholder']); ?>"
                       value="<?php echo esc_attr(get_search_query()); ?>"
                       autocomplete="off"
                       <?php if ($atts['show_suggestions']): ?>data-suggestions="true"<?php endif; ?>>
                
                <button type="submit" class="ps-search-button">
                    <span class="ps-search-icon">🔍</span>
                    <span class="ps-search-text"><?php echo esc_html($atts['button_text']); ?></span>
                </button>
                
                <?php if ($atts['show_suggestions']): ?>
                <div class="ps-search-suggestions" style="display: none;"></div>
                <?php endif; ?>
            </div>
            
            <div class="ps-search-results" style="display: none;"></div>
        </form>
        <?php
        return ob_get_clean();
    }
}

// تشغيل نظام البحث
new PS_Unified_Search_System();
?>