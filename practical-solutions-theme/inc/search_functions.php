<?php
/**
 * Search Functions
 * وظائف البحث المتقدم
 * * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * إضافة نقاط نهاية REST API للبحث
 * * @since 1.0.0
 */
function practical_solutions_register_search_endpoints() {
    // نقطة نهاية البحث المتقدم
    register_rest_route('practical-solutions/v1', '/search', array(
        'methods' => 'GET',
        'callback' => 'practical_solutions_advanced_search',
        'permission_callback' => '__return_true',
        'args' => array(
            'query' => array(
                'required' => true,
                'sanitize_callback' => 'sanitize_text_field',
                'validate_callback' => function($param) {
                    return !empty($param) && strlen($param) >= 2;
                }
            ),
            'post_type' => array(
                'default' => 'post',
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'posts_per_page' => array(
                'default' => 10,
                'sanitize_callback' => 'absint',
            ),
        ),
    ));

    // نقطة نهاية اقتراحات البحث
    register_rest_route('practical-solutions/v1', '/search-suggestions', array(
        'methods' => 'GET',
        'callback' => 'practical_solutions_search_suggestions',
        'permission_callback' => '__return_true',
        'args' => array(
            'query' => array(
                'required' => true,
                'sanitize_callback' => 'sanitize_text_field',
                'validate_callback' => function($param) {
                    return !empty($param) && strlen($param) >= 2;
                }
            ),
        ),
    ));
}
add_action('rest_api_init', 'practical_solutions_register_search_endpoints');

/**
 * معالج البحث المتقدم
 * * @param WP_REST_Request $request طلب REST
 * @return WP_REST_Response|WP_Error
 * @since 1.0.0
 */
function practical_solutions_advanced_search($request) {
    $query = $request->get_param('query');
    $post_type = $request->get_param('post_type');
    $posts_per_page = $request->get_param('posts_per_page');

    // تسجيل البحث في السجل
    if(function_exists('practical_solutions_log_search')){
        practical_solutions_log_search($query);
    }
    

    // إعداد استعلام البحث
    $search_args = array(
        's' => $query,
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_practical_solutions_keywords',
                'value' => $query,
                'compare' => 'LIKE'
            ),
        ),
    );

    // تحسين البحث للغة العربية
    if(function_exists('practical_solutions_improve_arabic_search')){
        add_filter('posts_search', 'practical_solutions_improve_arabic_search', 10, 2);
    }
    
    $search_query = new WP_Query($search_args);
    
    // إزالة الفلتر بعد الاستخدام
    if(function_exists('practical_solutions_improve_arabic_search')){
        remove_filter('posts_search', 'practical_solutions_improve_arabic_search', 10);
    }
    

    $results = array();

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            
            $post_id = get_the_ID();
            $results[] = array(
                'id' => $post_id,
                'title' => get_the_title(),
                'excerpt' => practical_solutions_get_search_excerpt($query),
                'permalink' => get_permalink(),
                'date' => get_the_date('c'),
                'author' => get_the_author(),
                'post_type' => get_post_type(),
                'featured_image' => get_the_post_thumbnail_url($post_id, 'medium'),
                'categories' => wp_get_post_categories($post_id, array('fields' => 'names')),
                'tags' => wp_get_post_tags($post_id, array('fields' => 'names')),
                'relevance_score' => practical_solutions_calculate_relevance($query, $post_id),
            );
        }
        wp_reset_postdata();
    }

    // ترتيب النتائج حسب الصلة
    usort($results, function($a, $b) {
        return $b['relevance_score'] - $a['relevance_score'];
    });

    return rest_ensure_response(array(
        'results' => $results,
        'total' => $search_query->found_posts,
        'query' => $query,
        'suggestions' => practical_solutions_get_search_suggestions($query),
    ));
}

/**
 * معالج اقتراحات البحث
 * * @param WP_REST_Request $request طلب REST
 * @return WP_REST_Response|WP_Error
 * @since 1.0.0
 */
function practical_solutions_search_suggestions($request) {
    $query = $request->get_param('query');
    
    $suggestions = array();
    
    // اقتراحات من العناوين
    if(function_exists('practical_solutions_get_title_suggestions')){
        $title_suggestions = practical_solutions_get_title_suggestions($query);
        $suggestions = array_merge($suggestions, $title_suggestions);
    }
    
    // اقتراحات من التصنيفات
    if(function_exists('practical_solutions_get_category_suggestions')){
        $category_suggestions = practical_solutions_get_category_suggestions($query);
        $suggestions = array_merge($suggestions, $category_suggestions);
    }
    
    // اقتراحات من الكلمات المفتاحية
    if(function_exists('practical_solutions_get_keyword_suggestions')){
        $keyword_suggestions = practical_solutions_get_keyword_suggestions($query);
        $suggestions = array_merge($suggestions, $keyword_suggestions);
    }
    
    // اقتراحات من السجل السابق
    if(function_exists('practical_solutions_get_history_suggestions')){
        $history_suggestions = practical_solutions_get_history_suggestions($query);
        $suggestions = array_merge($suggestions, $history_suggestions);
    }
    
    // إزالة التكرارات وترتيب الاقتراحات
    $suggestions = array_unique($suggestions, SORT_REGULAR);
    $suggestions = array_slice($suggestions, 0, 8); // الحد الأقصى 8 اقتراحات
    
    return rest_ensure_response($suggestions);
}

/**
 * تحسين البحث للغة العربية
 * * @param string $search استعلام البحث
 * @param WP_Query $query كائن الاستعلام
 * @return string
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_improve_arabic_search')){
    function practical_solutions_improve_arabic_search($search, $query) {
        global $wpdb;
        if (empty($search) || !$query->is_search()) {
            return $search;
        }
        
        $search_term = $query->get('s');
        
        // تنظيف النص العربي
        $search_term = practical_solutions_normalize_arabic_text($search_term);
        
        // البحث في العناوين والمحتوى والمقتطف
        $search_columns = array(
            'post_title',
            'post_content',
            'post_excerpt'
        );
        
        $search_parts = array();
        foreach ($search_columns as $column) {
            $search_parts[] = "({$wpdb->posts}.{$column} LIKE '%%" . esc_sql($wpdb->esc_like($search_term)) . "%%')";
        }
        
        // إضافة البحث في الكلمات المفتاحية
        $search_parts[] = "(pm.meta_key = '_practical_solutions_keywords' AND pm.meta_value LIKE '%%" . esc_sql($wpdb->esc_like($search_term)) . "%%')";
        
        $search = ' AND (' . implode(' OR ', $search_parts) . ')';
        
        return $search;
    }
}

/**
 * تنظيف النص العربي من الحركات والهمزات
 * * @param string $text النص المراد تنظيفه
 * @return string النص بعد التنظيف
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_normalize_arabic_text')){
    function practical_solutions_normalize_arabic_text($text) {
        $text = preg_replace('/[أآإ]/', 'ا', $text);
        $text = str_replace('ة', 'ه', $text);
        $text = str_replace('ى', 'ي', $text);
        $text = str_replace('ؤ', 'و', $text);
        $text = str_replace('ئ', 'ي', $text);
        $text = preg_replace('/[ّ`]/', '', $text); // إزالة الشدة
        return $text;
    }
}

/**
 * الحصول على مقتطف بحث
 * * @param string $query استعلام البحث
 * @return string المقتطف
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_search_excerpt')){
    function practical_solutions_get_search_excerpt($query) {
        $post = get_post();
        $content = $post->post_content;
        $excerpt = $post->post_excerpt;
        
        if (!empty($excerpt)) {
            return wp_trim_words($excerpt, 30);
        }
        
        // البحث عن الكلمات في المحتوى
        $pos = stripos($content, $query);
        if ($pos !== false) {
            $start = max(0, $pos - 100); // 100 حرف قبل الكلمة
            $end = min(strlen($content), $pos + 100); // 100 حرف بعد الكلمة
            $excerpt = substr($content, $start, $end - $start);
            
            // تمييز الكلمة
            $excerpt = str_ireplace($query, '<strong>' . $query . '</strong>', $excerpt);
            
            return '... ' . wp_trim_words($excerpt, 30) . ' ...';
        }
        
        return wp_trim_words($content, 30);
    }
}

/**
 * حساب درجة الصلة للبحث
 * * @param string $query استعلام البحث
 * @param int $post_id معرف المقال
 * @return int درجة الصلة
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_calculate_relevance')){
    function practical_solutions_calculate_relevance($query, $post_id) {
        $relevance = 0;
        $post = get_post($post_id);
        
        if (!$post) {
            return $relevance;
        }
        
        $title = $post->post_title;
        $content = $post->post_content;
        $keywords = get_post_meta($post_id, '_practical_solutions_keywords', true);
        
        // إذا كانت الكلمة في العنوان
        if (stripos($title, $query) !== false) {
            $relevance += 100;
        }
        
        // إذا كانت الكلمة في الكلمات المفتاحية
        if (stripos($keywords, $query) !== false) {
            $relevance += 80;
        }
        
        // إذا كانت الكلمة في المحتوى
        if (stripos($content, $query) !== false) {
            $relevance += 50;
        }
        
        return $relevance;
    }
}

/**
 * تسجيل عمليات البحث
 * * @param string $query استعلام البحث
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_log_search')){
    function practical_solutions_log_search($query) {
        $search_log = get_option('ps_search_log', array());
        $date = date('Y-m-d');
        
        if (!isset($search_log[$date])) {
            $search_log[$date] = array();
        }
        
        if (!isset($search_log[$date][$query])) {
            $search_log[$date][$query] = 0;
        }
        
        $search_log[$date][$query]++;
        
        update_option('ps_search_log', $search_log);
    }
}

/**
 * الحصول على اقتراحات من العناوين
 * * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_title_suggestions')){
    function practical_solutions_get_title_suggestions($query) {
        global $wpdb;
        
        $normalized_query = practical_solutions_normalize_arabic_text($query);
        
        $suggestions = $wpdb->get_col($wpdb->prepare("
            SELECT DISTINCT post_title
            FROM {$wpdb->posts}
            WHERE post_status = 'publish'
            AND post_type IN ('post', 'page', 'solution', 'tip')
            AND practical_solutions_normalize_arabic_text(post_title) LIKE '%%%s%%'
            ORDER BY post_title ASC
            LIMIT 5
        ", $normalized_query));
        
        return $suggestions;
    }
}

/**
 * الحصول على اقتراحات من التصنيفات
 * * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_category_suggestions')){
    function practical_solutions_get_category_suggestions($query) {
        $terms = get_terms(array(
            'taxonomy' => array('category', 'post_tag', 'solution_category', 'tip_category'),
            'name__like' => $query,
            'hide_empty' => true,
            'number' => 5,
        ));
        
        $suggestions = array();
        foreach ($terms as $term) {
            $suggestions[] = $term->name;
        }
        
        return $suggestions;
    }
}

/**
 * الحصول على اقتراحات من الكلمات المفتاحية
 * * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_keyword_suggestions')){
    function practical_solutions_get_keyword_suggestions($query) {
        global $wpdb;
        
        $suggestions = $wpdb->get_col($wpdb->prepare("
            SELECT DISTINCT meta_value
            FROM {$wpdb->postmeta}
            WHERE meta_key = '_practical_solutions_keywords'
            AND meta_value LIKE '%%%s%%'
            LIMIT 5
        ", $query));
        
        return $suggestions;
    }
}

/**
 * الحصول على اقتراحات من سجل البحث
 * * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_history_suggestions')){
    function practical_solutions_get_history_suggestions($query) {
        $search_log = get_option('ps_search_log', array());
        $suggestions = array();
        
        foreach ($search_log as $date => $queries) {
            foreach ($queries as $search_query => $count) {
                if (stripos($search_query, $query) !== false) {
                    $suggestions[] = $search_query;
                }
            }
        }
        
        // ترتيب الاقتراحات حسب التكرار
        uasort($suggestions, function($a, $b) use ($search_log) {
            $count_a = 0;
            foreach ($search_log as $date => $queries) {
                if (isset($queries[$a])) {
                    $count_a += $queries[$a];
                }
            }
            
            $count_b = 0;
            foreach ($search_log as $date => $queries) {
                if (isset($queries[$b])) {
                    $count_b += $queries[$b];
                }
            }
            
            return $count_b - $count_a;
        });
        
        return array_slice($suggestions, 0, 5);
    }
}