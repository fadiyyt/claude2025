<?php
/**
 * AJAX Handlers
 * معالجات طلبات AJAX
 * * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * معالج البحث المباشر (Live Search)
 * * @since 1.0.0
 */
function practical_solutions_ajax_live_search() {
    // التحقق من الصلاحيات والأمان
    if (!wp_verify_nonce($_POST['nonce'], 'practical_solutions_nonce')) {
        wp_die(esc_html__('فشل التحقق من الأمان', 'practical-solutions'));
    }

    // الحصول على استعلام البحث
    $search_query = sanitize_text_field($_POST['query']);
    
    if (empty($search_query) || strlen($search_query) < 2) {
        wp_send_json_error(array(
            'message' => esc_html__('يجب إدخال حرفين على الأقل للبحث', 'practical-solutions')
        ));
    }

    // إعداد استعلام البحث
    $args = array(
        's'              => $search_query,
        'post_type'      => array('post', 'solution', 'tip', 'page'),
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'orderby'        => 'relevance',
        'order'          => 'DESC',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => '_ps_featured',
                'value'   => '1',
                'compare' => '='
            ),
            array(
                'key'     => '_ps_featured',
                'value'   => '1',
                'compare' => 'NOT EXISTS'
            )
        )
    );

    // تنفيذ الاستعلام
    $search_results = new WP_Query($args);
    $results = array();

    if ($search_results->have_posts()) {
        while ($search_results->have_posts()) {
            $search_results->the_post();
            
            $post_id = get_the_ID();
            $post_type = get_post_type();
            $post_type_labels = get_post_type_labels(get_post_type_object($post_type));
            
            $results[] = array(
                'id'           => $post_id,
                'title'        => get_the_title(),
                'url'          => get_permalink(),
                'excerpt'      => wp_trim_words(get_the_excerpt(), 20),
                'post_type'    => $post_type,
                'post_type_label' => $post_type_labels->singular_name,
                'thumbnail'    => get_the_post_thumbnail_url($post_id, 'practical-solutions-thumbnail'),
                'date'         => get_the_date('j F Y'),
                'author'       => get_the_author(),
                'categories'   => practical_solutions_get_post_categories($post_id),
                'is_featured'  => get_post_meta($post_id, '_ps_featured', true) === '1'
            );
        }
        wp_reset_postdata();
    }

    // إرسال النتائج
    if (!empty($results)) {
        wp_send_json_success(array(
            'results' => $results,
            'count'   => count($results),
            'total'   => $search_results->found_posts,
            'message' => sprintf(
                _n(
                    'تم العثور على نتيجة واحدة',
                    'تم العثور على %d نتيجة',
                    $search_results->found_posts,
                    'practical-solutions'
                ),
                $search_results->found_posts
            )
        ));
    } else {
        wp_send_json_error(array(
            'message' => esc_html__('لا توجد نتائج للبحث المطلوب', 'practical-solutions')
        ));
    }
}
add_action('wp_ajax_practical_solutions_live_search', 'practical_solutions_ajax_live_search');
add_action('wp_ajax_nopriv_practical_solutions_live_search', 'practical_solutions_ajax_live_search');

/**
 * معالج اقتراحات البحث
 * * @since 1.0.0
 */
function practical_solutions_ajax_search_suggestions() {
    // التحقق من الصلاحيات
    if (!wp_verify_nonce($_POST['nonce'], 'practical_solutions_nonce')) {
        wp_die(esc_html__('فشل التحقق من الأمان', 'practical-solutions'));
    }

    $search_query = sanitize_text_field($_POST['query']);
    
    if (empty($search_query) || strlen($search_query) < 2) {
        wp_send_json_error();
    }

    $suggestions = array();

    // البحث في العناوين
    if(function_exists('practical_solutions_get_title_suggestions')){
        $title_suggestions = practical_solutions_get_title_suggestions($search_query);
    } else {
        $title_suggestions = array();
    }
    
    // البحث في التصنيفات
    if(function_exists('practical_solutions_get_category_suggestions')){
        $category_suggestions = practical_solutions_get_category_suggestions($search_query);
    } else {
        $category_suggestions = array();
    }

    // البحث في العلامات
    if(function_exists('practical_solutions_get_tag_suggestions')){
        $tag_suggestions = practical_solutions_get_tag_suggestions($search_query);
    } else {
        $tag_suggestions = array();
    }

    // دمج الاقتراحات
    $suggestions = array_merge($title_suggestions, $category_suggestions, $tag_suggestions);
    
    // إزالة التكرارات وترتيب النتائج
    $suggestions = array_unique($suggestions, SORT_REGULAR);
    usort($suggestions, function($a, $b) {
        return $a['priority'] - $b['priority'];
    });

    // تحديد عدد الاقتراحات
    $suggestions = array_slice($suggestions, 0, 6);

    wp_send_json_success($suggestions);
}
add_action('wp_ajax_practical_solutions_search_suggestions', 'practical_solutions_ajax_search_suggestions');
add_action('wp_ajax_nopriv_practical_solutions_search_suggestions', 'practical_solutions_ajax_search_suggestions');

/**
 * معالج تحميل المزيد من المقالات
 * * @since 1.0.0
 */
function practical_solutions_ajax_load_more_posts() {
    // التحقق من الصلاحيات
    if (!wp_verify_nonce($_POST['nonce'], 'practical_solutions_nonce')) {
        wp_die(esc_html__('فشل التحقق من الأمان', 'practical-solutions'));
    }

    $page = intval($_POST['page']);
    $post_type = sanitize_text_field($_POST['post_type']);
    $category = sanitize_text_field($_POST['category']);
    $per_page = intval($_POST['per_page']) ?: 6;

    // إعداد الاستعلام
    $args = array(
        'post_type'      => $post_type ?: 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    // إضافة فلتر التصنيف إذا كان محدد
    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => practical_solutions_get_taxonomy_for_post_type($post_type),
                'field'    => 'slug',
                'terms'    => $category
            )
        );
    }

    $posts_query = new WP_Query($args);
    $posts_html = '';

    if ($posts_query->have_posts()) {
        ob_start();
        while ($posts_query->have_posts()) {
            $posts_query->the_post();
            // تضمين قالب المقال
            get_template_part('template-parts/content', 'card');
        }
        $posts_html = ob_get_clean();
        wp_reset_postdata();
        wp_send_json_success(array(
            'html'     => $posts_html,
            'has_more' => $page < $posts_query->max_num_pages,
            'next_page' => $page + 1,
            'total'    => $posts_query->found_posts
        ));
    } else {
        wp_send_json_error(array(
            'message' => esc_html__('لا توجد مقالات أخرى', 'practical-solutions')
        ));
    }
}
add_action('wp_ajax_practical_solutions_load_more_posts', 'practical_solutions_ajax_load_more_posts');
add_action('wp_ajax_nopriv_practical_solutions_load_more_posts', 'practical_solutions_ajax_load_more_posts');

/**
 * معالج إضافة/إزالة من المفضلة
 * * @since 1.0.0
 */
function practical_solutions_ajax_toggle_favorite() {
    // التحقق من تسجيل الدخول
    if (!is_user_logged_in()) {
        wp_send_json_error(array(
            'message' => esc_html__('يجب تسجيل الدخول لحفظ المفضلة', 'practical-solutions')
        ));
    }

    // التحقق من الصلاحيات
    if (!wp_verify_nonce($_POST['nonce'], 'practical_solutions_nonce')) {
        wp_die(esc_html__('فشل التحقق من الأمان', 'practical-solutions'));
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    if (!$post_id || !$user_id) {
        wp_send_json_error(array(
            'message' => esc_html__('خطأ في البيانات', 'practical-solutions')
        ));
    }

    $favorites = get_user_meta($user_id, 'practical_solutions_favorites', true);
    if (!is_array($favorites)) {
        $favorites = array();
    }

    $message = '';
    if (in_array($post_id, $favorites)) {
        // إزالة من المفضلة
        $favorites = array_diff($favorites, array($post_id));
        $message = esc_html__('تمت الإزالة من المفضلة بنجاح', 'practical-solutions');
    } else {
        // إضافة إلى المفضلة
        $favorites[] = $post_id;
        $message = esc_html__('تمت الإضافة إلى المفضلة بنجاح', 'practical-solutions');
    }

    update_user_meta($user_id, 'practical_solutions_favorites', array_values($favorites));

    wp_send_json_success(array(
        'message' => $message,
        'is_favorite' => in_array($post_id, $favorites)
    ));
}
add_action('wp_ajax_practical_solutions_toggle_favorite', 'practical_solutions_ajax_toggle_favorite');

/**
 * معالج الحصول على قوائم التشغيل المفضلة
 * * @since 1.0.0
 */
function practical_solutions_ajax_get_favorite_posts() {
    // التحقق من تسجيل الدخول
    if (!is_user_logged_in()) {
        wp_send_json_error(array(
            'message' => esc_html__('يجب تسجيل الدخول لعرض المفضلة', 'practical-solutions')
        ));
    }

    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'practical_solutions_favorites', true);

    if (empty($favorites)) {
        wp_send_json_error(array(
            'message' => esc_html__('لا توجد مقالات في المفضلة', 'practical-solutions')
        ));
    }

    $args = array(
        'post_type'      => array('post', 'solution', 'tip'),
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post__in'       => $favorites,
        'orderby'        => 'post__in'
    );

    $favorite_posts_query = new WP_Query($args);
    $posts_html = '';

    if ($favorite_posts_query->have_posts()) {
        ob_start();
        while ($favorite_posts_query->have_posts()) {
            $favorite_posts_query->the_post();
            get_template_part('template-parts/content', 'card');
        }
        $posts_html = ob_get_clean();
        wp_reset_postdata();
        
        wp_send_json_success(array(
            'html'  => $posts_html,
            'count' => $favorite_posts_query->found_posts,
        ));
    } else {
        wp_send_json_error(array(
            'message' => esc_html__('لا توجد مقالات في المفضلة', 'practical-solutions')
        ));
    }
}
add_action('wp_ajax_practical_solutions_get_favorite_posts', 'practical_solutions_ajax_get_favorite_posts');

/**
 * دالة مساعدة للحصول على تصنيفات المقال
 * * @param int $post_id معرف المقال
 * @return array قائمة التصنيفات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_post_categories')){
    function practical_solutions_get_post_categories($post_id) {
        $categories = array();
        $terms = get_the_terms($post_id, 'category');
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $categories[] = array(
                    'name' => $term->name,
                    'slug' => $term->slug,
                    'url'  => get_term_link($term)
                );
            }
        }
        return $categories;
    }
}

/**
 * دالة مساعدة للحصول على taxonomy بناءً على post type
 * * @param string $post_type نوع المقال
 * @return string اسم الـ taxonomy
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_taxonomy_for_post_type')){
    function practical_solutions_get_taxonomy_for_post_type($post_type) {
        $taxonomy = 'category';
        switch ($post_type) {
            case 'solution':
                $taxonomy = 'solution_category';
                break;
            case 'tip':
                $taxonomy = 'tip_category';
                break;
        }
        return $taxonomy;
    }
}

/**
 * الحصول على اقتراحات من العناوين
 * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_title_suggestions')){
    function practical_solutions_get_title_suggestions($query) {
        global $wpdb;
        
        $normalized_query = practical_solutions_normalize_arabic_text($query);
        
        $suggestions = $wpdb->get_results($wpdb->prepare("
            SELECT post_title AS label, 'title' AS type
            FROM {$wpdb->posts}
            WHERE post_status = 'publish'
            AND post_type IN ('post', 'page')
            AND practical_solutions_normalize_arabic_text(post_title) LIKE '%%%s%%'
            ORDER BY post_title ASC
            LIMIT 3
        ", $normalized_query));

        $results = array();
        foreach($suggestions as $s) {
            $results[] = array(
                'text'     => $s->label,
                'url'      => '#', // يجب تحديث هذا لاحقا
                'priority' => 1
            );
        }
        
        return $results;
    }
}

/**
 * الحصول على اقتراحات من التصنيفات
 * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_category_suggestions')){
    function practical_solutions_get_category_suggestions($query) {
        $terms = get_terms(array(
            'taxonomy'   => 'category',
            'name__like' => $query,
            'hide_empty' => true,
            'number'     => 3,
        ));

        $results = array();
        foreach($terms as $term) {
            $results[] = array(
                'text'     => $term->name,
                'url'      => get_term_link($term),
                'priority' => 2
            );
        }

        return $results;
    }
}

/**
 * الحصول على اقتراحات من العلامات
 * @param string $query استعلام البحث
 * @return array الاقتراحات
 * @since 1.0.0
 */
if(!function_exists('practical_solutions_get_tag_suggestions')){
    function practical_solutions_get_tag_suggestions($query) {
        $terms = get_terms(array(
            'taxonomy'   => 'post_tag',
            'name__like' => $query,
            'hide_empty' => true,
            'number'     => 3,
        ));

        $results = array();
        foreach($terms as $term) {
            $results[] = array(
                'text'     => $term->name,
                'url'      => get_term_link($term),
                'priority' => 3
            );
        }

        return $results;
    }
}