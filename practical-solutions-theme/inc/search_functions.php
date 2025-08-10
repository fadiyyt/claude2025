<?php
/**
 * Search Functions
 * وظائف البحث المتقدم
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * تحسين استعلام البحث الافتراضي
 * 
 * @param WP_Query $query استعلام ووردبريس
 * @since 1.0.0
 */
function practical_solutions_modify_main_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        // إضافة أنواع المحتوى المخصصة للبحث
        $query->set('post_type', array('post', 'page', 'solution', 'tip'));
        
        // تحسين ترتيب النتائج
        $query->set('orderby', array(
            'relevance' => 'DESC',
            'date'      => 'DESC'
        ));
        
        // زيادة عدد النتائج لكل صفحة
        $query->set('posts_per_page', 12);
        
        // تحسين دقة البحث
        add_filter('posts_search', 'practical_solutions_improve_search_query', 10, 2);
    }
}
add_action('pre_get_posts', 'practical_solutions_modify_main_search');

/**
 * تحسين استعلام البحث SQL
 * 
 * @param string $search استعلام البحث الحالي
 * @param WP_Query $query استعلام ووردبريس
 * @return string استعلام البحث المحسن
 * @since 1.0.0
 */
function practical_solutions_improve_search_query($search, $query) {
    global $wpdb;
    
    if (empty($search) || !$query->is_search()) {
        return $search;
    }
    
    $search_terms = $query->get('search_terms');
    if (empty($search_terms)) {
        return $search;
    }
    
    $search_conditions = array();
    
    foreach ($search_terms as $term) {
        $term = $wpdb->esc_like($term);
        
        // البحث في العنوان (أولوية عالية)
        $search_conditions[] = "({$wpdb->posts}.post_title LIKE '%{$term}%')";
        
        // البحث في المحتوى (أولوية متوسطة)
        $search_conditions[] = "({$wpdb->posts}.post_content LIKE '%{$term}%')";
        
        // البحث في المقتطف (أولوية متوسطة)
        $search_conditions[] = "({$wpdb->posts}.post_excerpt LIKE '%{$term}%')";
    }
    
    if (!empty($search_conditions)) {
        $search = ' AND (' . implode(' OR ', $search_conditions) . ') ';
    }
    
    return $search;
}

/**
 * إضافة البحث في التصنيفات والعلامات
 * 
 * @param WP_Query $query استعلام ووردبريس
 * @since 1.0.0
 */
function practical_solutions_search_in_taxonomies($query) {
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        $search_term = $query->get('s');
        
        if (!empty($search_term)) {
            // البحث في التصنيفات
            $taxonomy_query = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'name',
                    'terms'    => $search_term,
                    'operator' => 'LIKE'
                ),
                array(
                    'taxonomy' => 'solution_category',
                    'field'    => 'name',
                    'terms'    => $search_term,
                    'operator' => 'LIKE'
                ),
                array(
                    'taxonomy' => 'tip_category',
                    'field'    => 'name',
                    'terms'    => $search_term,
                    'operator' => 'LIKE'
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'name',
                    'terms'    => $search_term,
                    'operator' => 'LIKE'
                ),
                array(
                    'taxonomy' => 'difficulty_level',
                    'field'    => 'name',
                    'terms'    => $search_term,
                    'operator' => 'LIKE'
                )
            );
            
            $existing_tax_query = $query->get('tax_query');
            if (!empty($existing_tax_query)) {
                $taxonomy_query = array(
                    'relation' => 'OR',
                    $existing_tax_query,
                    $taxonomy_query
                );
            }
            
            $query->set('tax_query', $taxonomy_query);
        }
    }
}
add_action('pre_get_posts', 'practical_solutions_search_in_taxonomies');

/**
 * إضافة البحث في الحقول المخصصة
 * 
 * @param WP_Query $query استعلام ووردبريس
 * @since 1.0.0
 */
function practical_solutions_search_in_meta_fields($query) {
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        $search_term = $query->get('s');
        
        if (!empty($search_term)) {
            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key'     => '_ps_keywords',
                    'value'   => $search_term,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => '_ps_tips',
                    'value'   => $search_term,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => '_ps_tools_needed',
                    'value'   => $search_term,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => '_ps_problem_solved',
                    'value'   => $search_term,
                    'compare' => 'LIKE'
                )
            );
            
            $existing_meta_query = $query->get('meta_query');
            if (!empty($existing_meta_query)) {
                $meta_query = array(
                    'relation' => 'OR',
                    $existing_meta_query,
                    $meta_query
                );
            }
            
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'practical_solutions_search_in_meta_fields');

/**
 * تخصيص ترتيب نتائج البحث حسب الصلة
 * 
 * @param array $orderby ترتيب الاستعلام
 * @param WP_Query $query استعلام ووردبريس
 * @return array ترتيب محسن
 * @since 1.0.0
 */
function practical_solutions_search_orderby_relevance($orderby, $query) {
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        global $wpdb;
        
        $search_term = $query->get('s');
        if (!empty($search_term)) {
            $search_term = $wpdb->esc_like($search_term);
            
            // ترتيب حسب الصلة مع إعطاء أولوية للعنوان
            $orderby = "
                CASE 
                    WHEN {$wpdb->posts}.post_title LIKE '%{$search_term}%' THEN 1
                    WHEN {$wpdb->posts}.post_excerpt LIKE '%{$search_term}%' THEN 2
                    WHEN {$wpdb->posts}.post_content LIKE '%{$search_term}%' THEN 3
                    ELSE 4
                END ASC,
                {$wpdb->posts}.post_date DESC
            ";
        }
    }
    
    return $orderby;
}
add_filter('posts_orderby', 'practical_solutions_search_orderby_relevance', 10, 2);

/**
 * تمييز النتائج المميزة في البحث
 * 
 * @param WP_Query $query استعلام ووردبريس
 * @since 1.0.0
 */
function practical_solutions_boost_featured_in_search($query) {
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        // إضافة المقالات المميزة للأعلى
        $meta_query = $query->get('meta_query') ?: array();
        
        $meta_query['featured_clause'] = array(
            'key'     => '_ps_featured',
            'compare' => 'EXISTS'
        );
        
        $query->set('meta_query', $meta_query);
        
        // ترتيب المميزة أولاً
        $query->set('orderby', array(
            'featured_clause' => 'DESC',
            'relevance'       => 'DESC',
            'date'            => 'DESC'
        ));
    }
}
add_action('pre_get_posts', 'practical_solutions_boost_featured_in_search');

/**
 * إضافة فلاتر البحث المتقدم
 * 
 * @since 1.0.0
 */
function practical_solutions_advanced_search_filters() {
    if (is_search()) {
        // فلتر نوع المحتوى
        if (!empty($_GET['post_type']) && is_array($_GET['post_type'])) {
            add_filter('pre_get_posts', function($query) {
                if ($query->is_main_query() && $query->is_search()) {
                    $post_types = array_map('sanitize_text_field', $_GET['post_type']);
                    $allowed_post_types = array('post', 'solution', 'tip', 'page');
                    $post_types = array_intersect($post_types, $allowed_post_types);
                    
                    if (!empty($post_types)) {
                        $query->set('post_type', $post_types);
                    }
                }
            });
        }
        
        // فلتر التصنيف
        if (!empty($_GET['category'])) {
            add_filter('pre_get_posts', function($query) {
                if ($query->is_main_query() && $query->is_search()) {
                    $category = sanitize_text_field($_GET['category']);
                    $query->set('category_name', $category);
                }
            });
        }
        
        // فلتر مستوى الصعوبة
        if (!empty($_GET['difficulty'])) {
            add_filter('pre_get_posts', function($query) {
                if ($query->is_main_query() && $query->is_search()) {
                    $difficulty = sanitize_text_field($_GET['difficulty']);
                    $tax_query = $query->get('tax_query') ?: array();
                    
                    $tax_query[] = array(
                        'taxonomy' => 'difficulty_level',
                        'field'    => 'slug',
                        'terms'    => $difficulty
                    );
                    
                    $query->set('tax_query', $tax_query);
                }
            });
        }
        
        // فلتر التاريخ
        if (!empty($_GET['date_filter'])) {
            add_filter('pre_get_posts', function($query) {
                if ($query->is_main_query() && $query->is_search()) {
                    $date_filter = sanitize_text_field($_GET['date_filter']);
                    
                    switch ($date_filter) {
                        case 'week':
                            $query->set('date_query', array(
                                array(
                                    'after' => '1 week ago'
                                )
                            ));
                            break;
                        case 'month':
                            $query->set('date_query', array(
                                array(
                                    'after' => '1 month ago'
                                )
                            ));
                            break;
                        case 'year':
                            $query->set('date_query', array(
                                array(
                                    'after' => '1 year ago'
                                )
                            ));
                            break;
                    }
                }
            });
        }
    }
}
add_action('init', 'practical_solutions_advanced_search_filters');

/**
 * إضافة معلومات إضافية لنتائج البحث
 * 
 * @param array $posts قائمة المقالات
 * @param WP_Query $query استعلام ووردبريس
 * @return array المقالات مع معلومات إضافية
 * @since 1.0.0
 */
function practical_solutions_enhance_search_results($posts, $query) {
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        foreach ($posts as $post) {
            // إضافة معلومات مفيدة للمقال
            $post->search_score = practical_solutions_calculate_search_score($post, $query->get('s'));
            $post->post_type_label = practical_solutions_get_post_type_label($post->post_type);
            $post->reading_time = practical_solutions_calculate_reading_time($post->post_content);
            $post->difficulty_level = practical_solutions_get_difficulty_level($post->ID);
        }
        
        // إعادة ترتيب حسب النقاط
        usort($posts, function($a, $b) {
            return $b->search_score - $a->search_score;
        });
    }
    
    return $posts;
}
add_filter('posts_results', 'practical_solutions_enhance_search_results', 10, 2);

/**
 * حساب نقاط الصلة للمقال
 * 
 * @param WP_Post $post المقال
 * @param string $search_term كلمة البحث
 * @return int نقاط الصلة
 * @since 1.0.0
 */
function practical_solutions_calculate_search_score($post, $search_term) {
    $score = 0;
    $search_term = strtolower($search_term);
    
    // نقاط للعنوان
    if (stripos($post->post_title, $search_term) !== false) {
        $score += 10;
        
        // نقاط إضافية إذا كان في بداية العنوان
        if (stripos($post->post_title, $search_term) === 0) {
            $score += 5;
        }
    }
    
    // نقاط للمقتطف
    if (stripos($post->post_excerpt, $search_term) !== false) {
        $score += 5;
    }
    
    // نقاط للمحتوى
    $content_matches = substr_count(strtolower($post->post_content), $search_term);
    $score += $content_matches * 2;
    
    // نقاط للتصنيفات
    $categories = get_the_category($post->ID);
    foreach ($categories as $category) {
        if (stripos($category->name, $search_term) !== false) {
            $score += 3;
        }
    }
    
    // نقاط للمقالات المميزة
    if (get_post_meta($post->ID, '_ps_featured', true) === '1') {
        $score += 8;
    }
    
    // نقاط للمقالات الحديثة
    $post_age_days = (time() - strtotime($post->post_date)) / (60 * 60 * 24);
    if ($post_age_days <= 30) {
        $score += 3;
    } elseif ($post_age_days <= 90) {
        $score += 1;
    }
    
    // نقاط للمقالات الشائعة
    $views = get_post_meta($post->ID, '_ps_views', true);
    if ($views > 1000) {
        $score += 2;
    }
    
    return $score;
}

/**
 * الحصول على تسمية نوع المحتوى
 * 
 * @param string $post_type نوع المحتوى
 * @return string التسمية
 * @since 1.0.0
 */
function practical_solutions_get_post_type_label($post_type) {
    $labels = array(
        'post'     => esc_html__('مقال', 'practical-solutions'),
        'solution' => esc_html__('حل', 'practical-solutions'),
        'tip'      => esc_html__('نصيحة', 'practical-solutions'),
        'page'     => esc_html__('صفحة', 'practical-solutions')
    );
    
    return isset($labels[$post_type]) ? $labels[$post_type] : esc_html__('محتوى', 'practical-solutions');
}

/**
 * حساب وقت القراءة التقريبي
 * 
 * @param string $content محتوى المقال
 * @return int وقت القراءة بالدقائق
 * @since 1.0.0
 */
function practical_solutions_calculate_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // متوسط 200 كلمة في الدقيقة للعربية
    
    return max(1, $reading_time);
}

/**
 * الحصول على مستوى الصعوبة
 * 
 * @param int $post_id معرف المقال
 * @return string مستوى الصعوبة
 * @since 1.0.0
 */
function practical_solutions_get_difficulty_level($post_id) {
    $terms = get_the_terms($post_id, 'difficulty_level');
    
    if ($terms && !is_wp_error($terms)) {
        return $terms[0]->name;
    }
    
    return esc_html__('متوسط', 'practical-solutions');
}

/**
 * تسجيل استعلامات البحث للإحصائيات
 * 
 * @since 1.0.0
 */
function practical_solutions_log_search_queries() {
    if (is_search() && !is_admin()) {
        $search_query = get_search_query();
        
        if (!empty($search_query)) {
            $search_log = get_option('ps_search_log', array());
            
            $today = date('Y-m-d');
            if (!isset($search_log[$today])) {
                $search_log[$today] = array();
            }
            
            if (!isset($search_log[$today][$search_query])) {
                $search_log[$today][$search_query] = 0;
            }
            
            $search_log[$today][$search_query]++;
            
            // الاحتفاظ ببيانات آخر 30 يوم فقط
            $cutoff_date = date('Y-m-d', strtotime('-30 days'));
            foreach ($search_log as $date => $queries) {
                if ($date < $cutoff_date) {
                    unset($search_log[$date]);
                }
            }
            
            update_option('ps_search_log', $search_log);
        }
    }
}
add_action('wp', 'practical_solutions_log_search_queries');

/**
 * إنشاء قائمة الكلمات المفتاحية الشائعة
 * 
 * @return array قائمة الكلمات الشائعة
 * @since 1.0.0
 */
function practical_solutions_get_popular_search_keywords() {
    $search_log = get_option('ps_search_log', array());
    $popular_keywords = array();
    
    foreach ($search_log as $date => $queries) {
        foreach ($queries as $query => $count) {
            if (!isset($popular_keywords[$query])) {
                $popular_keywords[$query] = 0;
            }
            $popular_keywords[$query] += $count;
        }
    }
    
    // ترتيب حسب الشعبية
    arsort($popular_keywords);
    
    // إرجاع أول 10 كلمات
    return array_slice($popular_keywords, 0, 10, true);
}

/**
 * إضافة widget للكلمات المفتاحية الشائعة
 * 
 * @since 1.0.0
 */
function practical_solutions_popular_searches_widget() {
    $popular_keywords = practical_solutions_get_popular_search_keywords();
    
    if (!empty($popular_keywords)) {
        echo '<div class="popular-searches-widget">';
        echo '<h3>' . esc_html__('عمليات البحث الشائعة', 'practical-solutions') . '</h3>';
        echo '<ul class="popular-searches-list">';
        
        foreach ($popular_keywords as $keyword => $count) {
            $search_url = add_query_arg('s', urlencode($keyword), home_url('/'));
            echo '<li>';
            echo '<a href="' . esc_url($search_url) . '">' . esc_html($keyword) . '</a>';
            echo '<span class="search-count">(' . intval($count) . ')</span>';
            echo '</li>';
        }
        
        echo '</ul>';
        echo '</div>';
    }
}

/**
 * تحسين عرض نتائج البحث الفارغة
 * 
 * @since 1.0.0
 */
function practical_solutions_improve_no_results() {
    if (is_search() && !have_posts()) {
        global $wp_query;
        
        $search_query = get_search_query();
        
        // اقتراح بحث بديل
        $suggested_posts = practical_solutions_get_suggested_posts($search_query);
        
        if (!empty($suggested_posts)) {
            echo '<div class="search-suggestions">';
            echo '<h3>' . esc_html__('ربما تقصد:', 'practical-solutions') . '</h3>';
            echo '<div class="suggested-posts">';
            
            foreach ($suggested_posts as $post) {
                echo '<div class="suggested-post">';
                echo '<h4><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></h4>';
                echo '<p>' . wp_trim_words(get_the_excerpt($post->ID), 20) . '</p>';
                echo '</div>';
            }
            
            echo '</div>';
            echo '</div>';
        }
        
        // عرض الكلمات المفتاحية الشائعة
        practical_solutions_popular_searches_widget();
    }
}
add_action('wp_footer', 'practical_solutions_improve_no_results');

/**
 * الحصول على مقالات مقترحة بناءً على البحث
 * 
 * @param string $search_query استعلام البحث
 * @return array قائمة المقالات المقترحة
 * @since 1.0.0
 */
function practical_solutions_get_suggested_posts($search_query) {
    // البحث عن مقالات مشابهة
    $args = array(
        'post_type'      => array('post', 'solution', 'tip'),
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'orderby'        => 'rand',
        'meta_query'     => array(
            array(
                'key'     => '_ps_keywords',
                'value'   => $search_query,
                'compare' => 'LIKE'
            )
        )
    );
    
    $suggested_posts = get_posts($args);
    
    // إذا لم نجد نتائج، اعرض المقالات الشائعة
    if (empty($suggested_posts)) {
        $args = array(
            'post_type'      => array('post', 'solution', 'tip'),
            'post_status'    => 'publish',
            'posts_per_page' => 3,
            'meta_key'       => '_ps_views',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC'
        );
        
        $suggested_posts = get_posts($args);
    }
    
    return $suggested_posts;
}
