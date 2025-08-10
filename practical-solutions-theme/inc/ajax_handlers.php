<?php
/**
 * AJAX Handlers
 * معالجات طلبات AJAX
 * 
 * @package Practical_Solutions
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * معالج البحث المباشر (Live Search)
 * 
 * @since 1.0.0
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
 * 
 * @since 1.0.0
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
    $title_suggestions = practical_solutions_get_title_suggestions($search_query);
    
    // البحث في التصنيفات
    $category_suggestions = practical_solutions_get_category_suggestions($search_query);
    
    // البحث في العلامات
    $tag_suggestions = practical_solutions_get_tag_suggestions($search_query);

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
 * 
 * @since 1.0.0
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
            'html'      => $posts_html,
            'has_more'  => $page < $posts_query->max_num_pages,
            'next_page' => $page + 1,
            'total'     => $posts_query->found_posts
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
 * 
 * @since 1.0.0
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

    if (empty($post_id)) {
        wp_send_json_error(array(
            'message' => esc_html__('معرف المقال غير صحيح', 'practical-solutions')
        ));
    }

    // الحصول على قائمة المفضلة الحالية
    $favorites = get_user_meta($user_id, '_ps_favorites', true);
    $favorites = is_array($favorites) ? $favorites : array();

    $is_favorite = in_array($post_id, $favorites);

    if ($is_favorite) {
        // إزالة من المفضلة
        $favorites = array_diff($favorites, array($post_id));
        $action = 'removed';
        $message = esc_html__('تم إزالة المقال من المفضلة', 'practical-solutions');
    } else {
        // إضافة للمفضلة
        $favorites[] = $post_id;
        $action = 'added';
        $message = esc_html__('تم إضافة المقال للمفضلة', 'practical-solutions');
    }

    // تحديث قائمة المفضلة
    update_user_meta($user_id, '_ps_favorites', $favorites);

    wp_send_json_success(array(
        'action'      => $action,
        'is_favorite' => !$is_favorite,
        'count'       => count($favorites),
        'message'     => $message
    ));
}
add_action('wp_ajax_practical_solutions_toggle_favorite', 'practical_solutions_ajax_toggle_favorite');

/**
 * معالج إرسال تقييم المقال
 * 
 * @since 1.0.0
 */
function practical_solutions_ajax_submit_rating() {
    // التحقق من الصلاحيات
    if (!wp_verify_nonce($_POST['nonce'], 'practical_solutions_nonce')) {
        wp_die(esc_html__('فشل التحقق من الأمان', 'practical-solutions'));
    }

    $post_id = intval($_POST['post_id']);
    $rating = intval($_POST['rating']);
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // التحقق من صحة البيانات
    if (empty($post_id) || $rating < 1 || $rating > 5) {
        wp_send_json_error(array(
            'message' => esc_html__('بيانات التقييم غير صحيحة', 'practical-solutions')
        ));
    }

    // التحقق من عدم تقييم سابق من نفس IP
    $existing_ratings = get_post_meta($post_id, '_ps_ratings', true);
    $existing_ratings = is_array($existing_ratings) ? $existing_ratings : array();

    // البحث عن تقييم سابق من نفس IP
    foreach ($existing_ratings as $existing_rating) {
        if ($existing_rating['ip'] === $user_ip) {
            wp_send_json_error(array(
                'message' => esc_html__('لقد قمت بتقييم هذا المقال مسبقاً', 'practical-solutions')
            ));
        }
    }

    // إضافة التقييم الجديد
    $new_rating = array(
        'rating' => $rating,
        'ip'     => $user_ip,
        'date'   => current_time('mysql'),
        'user_id' => is_user_logged_in() ? get_current_user_id() : 0
    );

    $existing_ratings[] = $new_rating;
    update_post_meta($post_id, '_ps_ratings', $existing_ratings);

    // حساب المتوسط الجديد
    $total_ratings = count($existing_ratings);
    $sum_ratings = array_sum(array_column($existing_ratings, 'rating'));
    $average_rating = round($sum_ratings / $total_ratings, 1);

    // تحديث متوسط التقييم
    update_post_meta($post_id, '_ps_average_rating', $average_rating);
    update_post_meta($post_id, '_ps_total_ratings', $total_ratings);

    wp_send_json_success(array(
        'average_rating' => $average_rating,
        'total_ratings'  => $total_ratings,
        'message'        => esc_html__('شكراً لك على التقييم!', 'practical-solutions')
    ));
}
add_action('wp_ajax_practical_solutions_submit_rating', 'practical_solutions_ajax_submit_rating');
add_action('wp_ajax_nopriv_practical_solutions_submit_rating', 'practical_solutions_ajax_submit_rating');

/**
 * معالج إرسال اشتراك النشرة البريدية
 * 
 * @since 1.0.0
 */
function practical_solutions_ajax_newsletter_subscribe() {
    // التحقق من الصلاحيات
    if (!wp_verify_nonce($_POST['nonce'], 'practical_solutions_nonce')) {
        wp_die(esc_html__('فشل التحقق من الأمان', 'practical-solutions'));
    }

    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);

    // التحقق من صحة البريد الإلكتروني
    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => esc_html__('عنوان البريد الإلكتروني غير صحيح', 'practical-solutions')
        ));
    }

    // التحقق من عدم الاشتراك المسبق
    $subscribers = get_option('ps_newsletter_subscribers', array());
    
    foreach ($subscribers as $subscriber) {
        if ($subscriber['email'] === $email) {
            wp_send_json_error(array(
                'message' => esc_html__('هذا البريد مشترك بالفعل في النشرة', 'practical-solutions')
            ));
        }
    }

    // إضافة المشترك الجديد
    $new_subscriber = array(
        'email'      => $email,
        'name'       => $name,
        'date'       => current_time('mysql'),
        'ip'         => $_SERVER['REMOTE_ADDR'],
        'status'     => 'active',
        'source'     => 'website'
    );

    $subscribers[] = $new_subscriber;
    update_option('ps_newsletter_subscribers', $subscribers);

    // إرسال بريد ترحيب (اختياري)
    practical_solutions_send_welcome_email($email, $name);

    wp_send_json_success(array(
        'message' => esc_html__('تم الاشتراك بنجاح! شكراً لك', 'practical-solutions')
    ));
}
add_action('wp_ajax_practical_solutions_newsletter_subscribe', 'practical_solutions_ajax_newsletter_subscribe');
add_action('wp_ajax_nopriv_practical_solutions_newsletter_subscribe', 'practical_solutions_ajax_newsletter_subscribe');

// ===========================================
// وظائف مساعدة
// ===========================================

/**
 * الحصول على تصنيفات المقال
 * 
 * @param int $post_id معرف المقال
 * @return array قائمة التصنيفات
 * @since 1.0.0
 */
function practical_solutions_get_post_categories($post_id) {
    $categories = array();
    $post_type = get_post_type($post_id);
    
    switch ($post_type) {
        case 'solution':
            $terms = get_the_terms($post_id, 'solution_category');
            break;
        case 'tip':
            $terms = get_the_terms($post_id, 'tip_category');
            break;
        default:
            $terms = get_the_terms($post_id, 'category');
    }
    
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

/**
 * الحصول على اقتراحات العناوين
 * 
 * @param string $query استعلام البحث
 * @return array قائمة الاقتراحات
 * @since 1.0.0
 */
function practical_solutions_get_title_suggestions($query) {
    global $wpdb;
    
    $suggestions = array();
    
    $results = $wpdb->get_results($wpdb->prepare(
        "SELECT post_title, ID FROM {$wpdb->posts} 
         WHERE post_title LIKE %s 
         AND post_status = 'publish' 
         AND post_type IN ('post', 'solution', 'tip') 
         ORDER BY post_date DESC 
         LIMIT 5",
        '%' . $wpdb->esc_like($query) . '%'
    ));
    
    foreach ($results as $result) {
        $suggestions[] = array(
            'title'    => $result->post_title,
            'type'     => 'post',
            'url'      => get_permalink($result->ID),
            'priority' => 1
        );
    }
    
    return $suggestions;
}

/**
 * الحصول على اقتراحات التصنيفات
 * 
 * @param string $query استعلام البحث
 * @return array قائمة الاقتراحات
 * @since 1.0.0
 */
function practical_solutions_get_category_suggestions($query) {
    $suggestions = array();
    $taxonomies = array('category', 'solution_category', 'tip_category');
    
    foreach ($taxonomies as $taxonomy) {
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'name__like' => $query,
            'number'     => 3
        ));
        
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $suggestions[] = array(
                    'title'    => $term->name,
                    'type'     => 'category',
                    'url'      => get_term_link($term),
                    'priority' => 2
                );
            }
        }
    }
    
    return $suggestions;
}

/**
 * الحصول على اقتراحات العلامات
 * 
 * @param string $query استعلام البحث
 * @return array قائمة الاقتراحات
 * @since 1.0.0
 */
function practical_solutions_get_tag_suggestions($query) {
    $suggestions = array();
    
    $terms = get_terms(array(
        'taxonomy'   => 'post_tag',
        'name__like' => $query,
        'number'     => 2
    ));
    
    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $suggestions[] = array(
                'title'    => '#' . $term->name,
                'type'     => 'tag',
                'url'      => get_term_link($term),
                'priority' => 3
            );
        }
    }
    
    return $suggestions;
}

/**
 * الحصول على التصنيف المناسب لنوع المحتوى
 * 
 * @param string $post_type نوع المحتوى
 * @return string اسم التصنيف
 * @since 1.0.0
 */
function practical_solutions_get_taxonomy_for_post_type($post_type) {
    switch ($post_type) {
        case 'solution':
            return 'solution_category';
        case 'tip':
            return 'tip_category';
        default:
            return 'category';
    }
}

/**
 * إرسال بريد ترحيب للمشتركين الجدد
 * 
 * @param string $email البريد الإلكتروني
 * @param string $name الاسم
 * @since 1.0.0
 */
function practical_solutions_send_welcome_email($email, $name) {
    $subject = esc_html__('مرحباً بك في النشرة البريدية', 'practical-solutions');
    
    $message = sprintf(
        esc_html__('مرحباً %s،\n\nشكراً لك على الاشتراك في نشرتنا البريدية.\nسنرسل لك أفضل الحلول العملية والنصائح المفيدة.\n\nمع تحياتنا،\nفريق الحلول العملية', 'practical-solutions'),
        $name
    );
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    wp_mail($email, $subject, nl2br($message), $headers);
}
