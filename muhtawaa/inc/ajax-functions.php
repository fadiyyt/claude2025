<?php
/**
 * وظائف AJAX والميزات المتقدمة لقالب محتوى
 * 
 * @package Muhtawaa
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تمرير متغيرات JavaScript
function muhtawaa_localize_script() {
    wp_localize_script('muhtawaa-script', 'muhtawaa_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('muhtawaa_nonce'),
        'post_id' => get_the_ID(),
        'is_admin' => current_user_can('manage_options'),
        'home_url' => home_url(),
        'current_user_id' => get_current_user_id(),
        'strings' => array(
            'loading' => __('جاري التحميل...', 'muhtawaa'),
            'error' => __('حدث خطأ', 'muhtawaa'),
            'success' => __('تم بنجاح', 'muhtawaa'),
            'no_results' => __('لا توجد نتائج', 'muhtawaa'),
        )
    ));
}
add_action('wp_enqueue_scripts', 'muhtawaa_localize_script');

// البحث المباشر
function muhtawaa_live_search() {
    // التحقق من الأمان
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    
    if (empty($search_term) || strlen($search_term) < 2) {
        wp_send_json_error('يجب أن يكون النص مكون من حرفين على الأقل');
    }
    
    // البحث في المقالات
    $posts_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        's' => $search_term,
        'posts_per_page' => 8,
        'orderby' => 'relevance',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_solution_difficulty',
                'compare' => 'EXISTS'
            ),
            array(
                'key' => '_solution_difficulty',
                'compare' => 'NOT EXISTS'
            )
        )
    ));
    
    $results = array();
    
    if ($posts_query->have_posts()) {
        while ($posts_query->have_posts()) {
            $posts_query->the_post();
            
            // الحصول على الفئة
            $categories = get_the_terms(get_the_ID(), 'solution_category');
            $category_name = 'عام';
            if ($categories && !is_wp_error($categories)) {
                $category_name = $categories[0]->name;
            }
            
            // الحصول على الصعوبة
            $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true);
            
            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'url' => get_permalink(),
                'category' => $category_name,
                'excerpt' => wp_trim_words(get_the_excerpt(), 15),
                'difficulty' => $difficulty ?: 'سهل',
                'views' => get_post_meta(get_the_ID(), '_total_views', true) ?: 0
            );
        }
        wp_reset_postdata();
    }
    
    // تسجيل البحث للإحصائيات
    muhtawaa_log_search($search_term, count($results));
    
    wp_send_json_success($results);
}
add_action('wp_ajax_live_search', 'muhtawaa_live_search');
add_action('wp_ajax_nopriv_live_search', 'muhtawaa_live_search');

// اشتراك النشرة البريدية
function muhtawaa_newsletter_subscribe() {
    // التحقق من الأمان
    if (!wp_verify_nonce($_POST['newsletter_nonce'], 'newsletter_subscription')) {
        wp_send_json_error('غير مصرح');
    }
    
    $email = sanitize_email($_POST['subscriber_email']);
    
    if (!is_email($email)) {
        wp_send_json_error('بريد إلكتروني غير صحيح');
    }
    
    // التحقق من وجود البريد مسبقاً
    global $wpdb;
    $table_name = $wpdb->prefix . 'muhtawaa_subscribers';
    
    $existing_subscriber = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE email = %s",
        $email
    ));
    
    if ($existing_subscriber > 0) {
        wp_send_json_error('هذا البريد مشترك مسبقاً');
    }
    
    // إضافة مشترك جديد
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'date_subscribed' => current_time('mysql'),
            'status' => 'active',
            'source' => 'website',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($result) {
        // إرسال بريد ترحيبي
        muhtawaa_send_welcome_email($email);
        
        // تسجيل الحدث
        do_action('muhtawaa_new_subscriber', $email);
        
        wp_send_json_success('تم الاشتراك بنجاح! تحقق من بريدك الإلكتروني');
    } else {
        wp_send_json_error('حدث خطأ، يرجى المحاولة مرة أخرى');
    }
}
add_action('wp_ajax_newsletter_subscribe', 'muhtawaa_newsletter_subscribe');
add_action('wp_ajax_nopriv_newsletter_subscribe', 'muhtawaa_newsletter_subscribe');

// إرسال بريد ترحيبي
function muhtawaa_send_welcome_email($email) {
    $subject = 'مرحباً بك في محتوى! 🎉';
    
    $message = '
    <div style="font-family: Arial, sans-serif; direction: rtl; text-align: right; max-width: 600px; margin: 0 auto;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; color: white; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0; font-size: 2.5em;">مرحباً بك في محتوى! 🏠</h1>
            <p style="margin: 10px 0 0 0; font-size: 1.2em;">حلول ذكية لحياة أسهل</p>
        </div>
        
        <div style="padding: 30px; background: white; border: 1px solid #e0e0e0;">
            <h2 style="color: #333; margin-bottom: 20px;">شكراً لانضمامك إلينا!</h2>
            <p style="line-height: 1.6; margin-bottom: 20px;">نحن سعداء لوجودك معنا في رحلة اكتشاف الحلول العملية للحياة اليومية.</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="color: #667eea; margin-bottom: 15px;">ماذا ستحصل عليه:</h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin: 10px 0; padding-right: 25px; position: relative;">
                        <span style="position: absolute; right: 0; color: #4caf50;">✅</span>
                        حل عملي جديد كل يوم
                    </li>
                    <li style="margin: 10px 0; padding-right: 25px; position: relative;">
                        <span style="position: absolute; right: 0; color: #4caf50;">✅</span>  
                        نصائح حصرية للمشتركين
                    </li>
                    <li style="margin: 10px 0; padding-right: 25px; position: relative;">
                        <span style="position: absolute; right: 0; color: #4caf50;">✅</span>
                        أحدث الحلول قبل الجميع
                    </li>
                    <li style="margin: 10px 0; padding-right: 25px; position: relative;">
                        <span style="position: absolute; right: 0; color: #4caf50;">✅</span>
                        محتوى مجاني 100%
                    </li>
                </ul>
            </div>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="' . home_url() . '" style="background: #667eea; color: white; padding: 15px 30px; text-decoration: none; border-radius: 25px; display: inline-block; font-weight: bold;">
                    🏠 زيارة الموقع
                </a>
            </div>
            
            <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0;">
                <h4 style="color: #856404; margin-bottom: 10px;">💡 نصيحة اليوم:</h4>
                <p style="color: #856404; margin: 0;">ضع قطعة خبز في علبة السكر لمنع تكتله وجعله يبقى ناعماً لفترة أطول!</p>
            </div>
        </div>
        
        <div style="background: #f8f9fa; padding: 20px; text-align: center; color: #666; border-radius: 0 0 10px 10px; border: 1px solid #e0e0e0; border-top: none;">
            <p style="margin: 0; font-size: 0.9em;">
                إذا لم تعد ترغب في تلقي رسائلنا، يمكنك 
                <a href="' . home_url('/unsubscribe?email=' . urlencode($email)) . '" style="color: #667eea;">إلغاء الاشتراك هنا</a>
            </p>
            <p style="margin: 10px 0 0 0; font-size: 0.8em;">&copy; ' . date('Y') . ' محتوى - جميع الحقوق محفوظة</p>
        </div>
    </div>';
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: محتوى <noreply@' . str_replace('www.', '', parse_url(home_url(), PHP_URL_HOST)) . '>'
    );
    
    wp_mail($email, $subject, $message, $headers);
}

// الحصول على حل عشوائي
function muhtawaa_get_random_tip() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $random_posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'orderby' => 'rand',
        'meta_query' => array(
            array(
                'key' => '_solution_difficulty',
                'value' => array('سهل جداً', 'سهل'),
                'compare' => 'IN'
            )
        )
    ));
    
    if (empty($random_posts)) {
        // إذا لم توجد مقالات بصعوبة سهلة، اجلب أي مقال
        $random_posts = get_posts(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'rand'
        ));
    }
    
    if (!empty($random_posts)) {
        $post = $random_posts[0];
        $tip_data = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'content' => wp_trim_words(strip_tags($post->post_content), 35),
            'url' => get_permalink($post->ID),
            'difficulty' => get_post_meta($post->ID, '_solution_difficulty', true) ?: 'سهل'
        );
        
        wp_send_json_success($tip_data);
    } else {
        wp_send_json_error('لا توجد نصائح متاحة حالياً');
    }
}
add_action('wp_ajax_get_random_tip', 'muhtawaa_get_random_tip');
add_action('wp_ajax_nopriv_get_random_tip', 'muhtawaa_get_random_tip');

// تقييم الحلول
function muhtawaa_rate_solution() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $post_id = intval($_POST['post_id']);
    $rating = sanitize_text_field($_POST['rating']);
    
    if (!$post_id || !in_array($rating, array('helpful', 'not-helpful'))) {
        wp_send_json_error('بيانات غير صحيحة');
    }
    
    // التحقق من IP للمنع التكرار
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $cache_key = 'rating_' . $post_id . '_' . md5($user_ip);
    
    if (get_transient($cache_key)) {
        wp_send_json_error('لقد قمت بالتقييم مسبقاً');
    }
    
    // حفظ التقييم
    $current_helpful = get_post_meta($post_id, '_helpful_count', true) ?: 0;
    $current_not_helpful = get_post_meta($post_id, '_not_helpful_count', true) ?: 0;
    
    if ($rating === 'helpful') {
        update_post_meta($post_id, '_helpful_count', $current_helpful + 1);
    } else {
        update_post_meta($post_id, '_not_helpful_count', $current_not_helpful + 1);
    }
    
    // حفظ تفاصيل التقييم في جدول منفصل
    global $wpdb;
    $ratings_table = $wpdb->prefix . 'muhtawaa_ratings';
    
    $wpdb->insert(
        $ratings_table,
        array(
            'post_id' => $post_id,
            'rating' => $rating,
            'ip_address' => $user_ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => current_time('mysql')
        ),
        array('%d', '%s', '%s', '%s', '%s')
    );
    
    // منع التقييم المتكرر لمدة 24 ساعة  
    set_transient($cache_key, $rating, DAY_IN_SECONDS);
    
    // تسجيل الحدث للإحصائيات
    do_action('muhtawaa_solution_rated', $post_id, $rating);
    
    wp_send_json_success('تم حفظ التقييم بنجاح');
}
add_action('wp_ajax_rate_solution', 'muhtawaa_rate_solution');
add_action('wp_ajax_nopriv_rate_solution', 'muhtawaa_rate_solution');

// تحميل المزيد من الحلول
function muhtawaa_load_more_solutions() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $page = intval($_POST['page']);
    $posts_per_page = 6;
    
    $solutions = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    if (!$solutions->have_posts()) {
        wp_send_json_error('لا توجد حلول إضافية');
    }
    
    ob_start();
    
    while ($solutions->have_posts()) {
        $solutions->the_post();
        $difficulty = get_post_meta(get_the_ID(), '_solution_difficulty', true) ?: 'سهل';
        $time_needed = get_post_meta(get_the_ID(), '_solution_time', true);
        $views = get_post_meta(get_the_ID(), '_total_views', true) ?: 0;
        
        // الحصول على الفئة
        $categories = get_the_terms(get_the_ID(), 'solution_category');
        $category_name = '';
        if ($categories && !is_wp_error($categories)) {
            $category_name = $categories[0]->name;
        }
        ?>
        <article class="solution-card">
            <div class="solution-image">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('solution-thumbnail', array('alt' => get_the_title())); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" style="color: white; text-decoration: none;">
                        <?php echo muhtawaa_get_category_icon($category_name); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="solution-content">
                <h3 class="solution-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <p class="solution-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                </p>
                <div class="solution-meta">
                    <div class="meta-left">
                        <span class="meta-time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> مضت</span>
                        <?php if ($time_needed): ?>
                            <span class="meta-duration">⏱️ <?php echo $time_needed; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="meta-right">
                        <span class="difficulty" style="background-color: <?php echo muhtawaa_get_difficulty_color($difficulty); ?>; color: white;">
                            <?php echo $difficulty; ?>
                        </span>
                    </div>
                </div>
                <?php if ($views > 0): ?>
                    <div class="solution-stats" style="margin-top: 0.5rem; font-size: 0.8rem; color: #888;">
                        👀 <?php echo $views; ?> مشاهدة
                    </div>
                <?php endif; ?>
            </div>
        </article>
        <?php
    }
    
    $html = ob_get_clean();
    wp_reset_postdata();
    
    $has_more = $solutions->max_num_pages > $page;
    
    wp_send_json_success(array(
        'html' => $html,
        'has_more' => $has_more,
        'count' => $solutions->post_count
    ));
}
add_action('wp_ajax_load_more_solutions', 'muhtawaa_load_more_solutions');
add_action('wp_ajax_nopriv_load_more_solutions', 'muhtawaa_load_more_solutions');

// تتبع قراءة المقالات
function muhtawaa_track_reading() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $post_id = intval($_POST['post_id']);
    $reading_time = intval($_POST['reading_time']);
    $scroll_depth = intval($_POST['scroll_depth']);
    
    if (!$post_id) {
        wp_send_json_error('معرف المقال مطلوب');
    }
    
    // تحديث إحصائيات المشاهدة
    $current_views = get_post_meta($post_id, '_total_views', true) ?: 0;
    update_post_meta($post_id, '_total_views', $current_views + 1);
    
    // حفظ وقت القراءة
    if ($reading_time > 0) {
        $current_reading_time = get_post_meta($post_id, '_avg_reading_time', true) ?: 0;
        $reading_sessions = get_post_meta($post_id, '_reading_sessions', true) ?: 0;
        
        // حساب متوسط وقت القراءة
        $new_avg = (($current_reading_time * $reading_sessions) + $reading_time) / ($reading_sessions + 1);
        
        update_post_meta($post_id, '_avg_reading_time', round($new_avg));
        update_post_meta($post_id, '_reading_sessions', $reading_sessions + 1);
    }
    
    // حفظ عمق التمرير
    if ($scroll_depth > 0) {
        update_post_meta($post_id, '_max_scroll_depth', $scroll_depth);
    }
    
    // حفظ تفاصيل القراءة في الجدول
    global $wpdb;
    $reading_table = $wpdb->prefix . 'muhtawaa_reading_stats';
    
    $wpdb->insert(
        $reading_table,
        array(
            'post_id' => $post_id,
            'reading_time' => $reading_time,
            'scroll_depth' => $scroll_depth,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => current_time('mysql')
        ),
        array('%d', '%d', '%d', '%s', '%s', '%s')
    );
    
    wp_send_json_success('تم حفظ إحصائيات القراءة');
}
add_action('wp_ajax_track_reading', 'muhtawaa_track_reading');
add_action('wp_ajax_nopriv_track_reading', 'muhtawaa_track_reading');

// اقتراحات البحث الشائعة
function muhtawaa_get_search_suggestions() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    // اقتراحات افتراضية
    $default_suggestions = array(
        'تنظيف المنزل',
        'توفير الكهرباء',
        'حلول المطبخ',
        'إزالة البقع',
        'صيانة السيارة',
        'حلول سريعة',
        'توفير المال',
        'تنظيف الفرن'
    );
    
    // الحصول على البحثات الأكثر شيوعاً من قاعدة البيانات
    global $wpdb;
    $searches_table = $wpdb->prefix . 'muhtawaa_searches';
    
    $popular_searches = $wpdb->get_results(
        "SELECT search_term, COUNT(*) as count 
         FROM $searches_table 
         WHERE created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)
         GROUP BY search_term 
         ORDER BY count DESC 
         LIMIT 5",
        ARRAY_A
    );
    
    $suggestions = $default_suggestions;
    
    // إضافة البحثات الشائعة
    if ($popular_searches) {
        foreach ($popular_searches as $search) {
            if (!in_array($search['search_term'], $suggestions)) {
                array_unshift($suggestions, $search['search_term']);
            }
        }
    }
    
    // إرجاع أول 8 اقتراحات
    wp_send_json_success(array_slice($suggestions, 0, 8));
}
add_action('wp_ajax_get_search_suggestions', 'muhtawaa_get_search_suggestions');
add_action('wp_ajax_nopriv_get_search_suggestions', 'muhtawaa_get_search_suggestions');

// عدد التعليقات في انتظار المراجعة (للمسؤولين)
function muhtawaa_get_pending_comments_count() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $pending_count = wp_count_comments()->moderated;
    
    wp_send_json_success(array('count' => $pending_count));
}
add_action('wp_ajax_get_pending_comments_count', 'muhtawaa_get_pending_comments_count');

// تتبع البحث
function muhtawaa_track_search() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $results_count = intval($_POST['results_count']) ?: 0;
    
    if (!empty($search_term)) {
        muhtawaa_log_search($search_term, $results_count);
        wp_send_json_success('تم تسجيل البحث');
    }
    
    wp_send_json_error('كلمة البحث مطلوبة');
}
add_action('wp_ajax_track_search', 'muhtawaa_track_search');
add_action('wp_ajax_nopriv_track_search', 'muhtawaa_track_search');

// تتبع المشاركة
function muhtawaa_track_share() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $platform = sanitize_text_field($_POST['platform']);
    $url = esc_url_raw($_POST['url']);
    
    global $wpdb;
    $shares_table = $wpdb->prefix . 'muhtawaa_shares';
    
    $wpdb->insert(
        $shares_table,
        array(
            'platform' => $platform,
            'url' => $url,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => current_time('mysql')
        ),
        array('%s', '%s', '%s', '%s', '%s')
    );
    
    wp_send_json_success('تم تسجيل المشاركة');
}
add_action('wp_ajax_track_share', 'muhtawaa_track_share');
add_action('wp_ajax_nopriv_track_share', 'muhtawaa_track_share');

// تسجيل أخطاء JavaScript
function muhtawaa_log_js_error() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $error = sanitize_text_field($_POST['error']);
    $url = esc_url_raw($_POST['url']);
    
    // تسجيل الخطأ في ملف log
    error_log("JS Error on $url: $error");
    
    // يمكن أيضاً حفظ الأخطاء في قاعدة البيانات للتحليل
    global $wpdb;
    $errors_table = $wpdb->prefix . 'muhtawaa_js_errors';
    
    $wpdb->insert(
        $errors_table,
        array(
            'error_message' => $error,
            'page_url' => $url,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => current_time('mysql')
        ),
        array('%s', '%s', '%s', '%s', '%s')
    );
    
    wp_send_json_success('تم تسجيل الخطأ');
}
add_action('wp_ajax_log_js_error', 'muhtawaa_log_js_error');
add_action('wp_ajax_nopriv_log_js_error', 'muhtawaa_log_js_error');

// دوال مساعدة

// تسجيل البحثات
function muhtawaa_log_search($search_term, $results_count) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'muhtawaa_searches';
    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    $wpdb->insert(
        $table_name,
        array(
            'search_term' => $search_term,
            'results_count' => $results_count,
            'ip_address' => $user_ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'created_at' => current_time('mysql')
        ),
        array('%s', '%d', '%s', '%s', '%s')
    );
}

// خطاف البحث لتسجيل البحثات التلقائي
function muhtawaa_track_wordpress_searches($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $search_term = get_search_query();
        if (!empty($search_term)) {
            $results_count = $query->found_posts;
            muhtawaa_log_search($search_term, $results_count);
        }
    }
}
add_action('pre_get_posts', 'muhtawaa_track_wordpress_searches');

// إنشاء الجداول المطلوبة
function muhtawaa_create_ajax_tables() {
    global $wpdb;
    
    $charset_collate = $wpdb->get_charset_collate();
    
    // جدول المشتركين
    $subscribers_table = $wpdb->prefix . 'muhtawaa_subscribers';
    $sql_subscribers = "CREATE TABLE IF NOT EXISTS $subscribers_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        date_subscribed datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'active',
        source varchar(50) DEFAULT 'website',
        ip_address varchar(45),
        user_agent text,
        PRIMARY KEY (id),
        UNIQUE KEY email (email),
        KEY status (status),
        KEY date_subscribed (date_subscribed)
    ) $charset_collate;";
    
    // جدول البحثات
    $searches_table = $wpdb->prefix . 'muhtawaa_searches';
    $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        search_term varchar(255) NOT NULL,
        results_count int(11) DEFAULT 0,
        ip_address varchar(45),
        user_agent text,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY search_term (search_term),
        KEY created_at (created_at),
        KEY results_count (results_count)
    ) $charset_collate;";
    
    // جدول التقييمات
    $ratings_table = $wpdb->prefix . 'muhtawaa_ratings';
    $sql_ratings = "CREATE TABLE IF NOT EXISTS $ratings_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id bigint(20) NOT NULL,
        rating varchar(20) NOT NULL,
        ip_address varchar(45),
        user_agent text,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY rating (rating),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    // جدول إحصائيات القراءة
    $reading_table = $wpdb->prefix . 'muhtawaa_reading_stats';
    $sql_reading = "CREATE TABLE IF NOT EXISTS $reading_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id bigint(20) NOT NULL,
        reading_time int(11) DEFAULT 0,
        scroll_depth int(11) DEFAULT 0,
        ip_address varchar(45),
        user_agent text,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    // جدول المشاركات
    $shares_table = $wpdb->prefix . 'muhtawaa_shares';
    $sql_shares = "CREATE TABLE IF NOT EXISTS $shares_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        platform varchar(50) NOT NULL,
        url text NOT NULL,
        ip_address varchar(45),
        user_agent text,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY platform (platform),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    // جدول أخطاء JavaScript
    $errors_table = $wpdb->prefix . 'muhtawaa_js_errors';
    $sql_errors = "CREATE TABLE IF NOT EXISTS $errors_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        error_message text NOT NULL,
        page_url text,
        ip_address varchar(45),
        user_agent text,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_subscribers);
    dbDelta($sql_searches);
    dbDelta($sql_ratings);
    dbDelta($sql_reading);
    dbDelta($sql_shares);
    dbDelta($sql_errors);
}

// تنشيط الجداول عند تفعيل القالب
add_action('after_switch_theme', 'muhtawaa_create_ajax_tables');

// إضافة تقارير للمسؤولين
function muhtawaa_add_admin_reports() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    add_submenu_page(
        'edit.php',
        'تقارير محتوى',
        'تقارير محتوى',
        'manage_options',
        'muhtawaa-reports',
        'muhtawaa_admin_reports_page'
    );
}
add_action('admin_menu', 'muhtawaa_add_admin_reports');

function muhtawaa_admin_reports_page() {
    global $wpdb;
    
    // إحصائيات عامة
    $total_subscribers = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_subscribers WHERE status = 'active'");
    $total_searches = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)");
    $total_ratings = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_ratings WHERE created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)");
    $total_shares = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}muhtawaa_shares WHERE created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)");
    
    // البحثات الأكثر شيوعاً
    $popular_searches = $wpdb->get_results(
        "SELECT search_term, COUNT(*) as count 
         FROM {$wpdb->prefix}muhtawaa_searches 
         WHERE created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)
         GROUP BY search_term 
         ORDER BY count DESC 
         LIMIT 10"
    );
    
    // المقالات الأكثر مشاهدة
    $top_posts = $wpdb->get_results(
        "SELECT p.ID, p.post_title, pm.meta_value as views
         FROM {$wpdb->posts} p
         LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_total_views'
         WHERE p.post_status = 'publish' AND p.post_type = 'post'
         ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
         LIMIT 10"
    );
    
    // منصات المشاركة الأكثر استخداماً
    $share_platforms = $wpdb->get_results(
        "SELECT platform, COUNT(*) as count 
         FROM {$wpdb->prefix}muhtawaa_shares 
         WHERE created_at > DATE_SUB(NOW(), INTERVAL 30 DAY)
         GROUP BY platform 
         ORDER BY count DESC"
    );
    
    ?>
    <div class="wrap">
        <h1>📊 تقارير موقع محتوى</h1>
        
        <!-- إحصائيات سريعة -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 20px 0;">
            <div class="card" style="background: #667eea; color: white; padding: 20px; text-align: center; border-radius: 8px;">
                <h2 style="margin: 0; font-size: 2.5em;"><?php echo number_format($total_subscribers); ?></h2>
                <p style="margin: 10px 0 0;">مشترك نشط</p>
            </div>
            <div class="card" style="background: #48bb78; color: white; padding: 20px; text-align: center; border-radius: 8px;">
                <h2 style="margin: 0; font-size: 2.5em;"><?php echo number_format($total_searches); ?></h2>
                <p style="margin: 10px 0 0;">بحث (30 يوم)</p>
            </div>
            <div class="card" style="background: #ed8936; color: white; padding: 20px; text-align: center; border-radius: 8px;">
                <h2 style="margin: 0; font-size: 2.5em;"><?php echo number_format($total_ratings); ?></h2>
                <p style="margin: 10px 0 0;">تقييم (30 يوم)</p>
            </div>
            <div class="card" style="background: #38b2ac; color: white; padding: 20px; text-align: center; border-radius: 8px;">
                <h2 style="margin: 0; font-size: 2.5em;"><?php echo number_format($total_shares); ?></h2>
                <p style="margin: 10px 0 0;">مشاركة (30 يوم)</p>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px;">
            <!-- البحثات الشائعة -->
            <div class="card">
                <div class="card-header">
                    <h3>🔍 البحثات الأكثر شيوعاً</h3>
                </div>
                <div class="card-body">
                    <?php if ($popular_searches): ?>
                        <ol>
                            <?php foreach ($popular_searches as $search): ?>
                                <li style="margin-bottom: 10px;">
                                    <strong><?php echo esc_html($search->search_term); ?></strong>
                                    <span style="color: #666; margin-right: 10px;">(<?php echo $search->count; ?> مرة)</span>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    <?php else: ?>
                        <p>لا توجد بحثات مسجلة</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- المقالات الأكثر مشاهدة -->
            <div class="card">
                <div class="card-header">
                    <h3>👀 المقالات الأكثر مشاهدة</h3>
                </div>
                <div class="card-body">
                    <?php if ($top_posts): ?>
                        <ol>
                            <?php foreach ($top_posts as $post): ?>
                                <li style="margin-bottom: 10px;">
                                    <a href="<?php echo get_edit_post_link($post->ID); ?>" target="_blank">
                                        <strong><?php echo esc_html($post->post_title); ?></strong>
                                    </a>
                                    <span style="color: #666; margin-right: 10px;">(<?php echo number_format($post->views ?: 0); ?> مشاهدة)</span>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    <?php else: ?>
                        <p>لا توجد مشاهدات مسجلة</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- منصات المشاركة -->
        <?php if ($share_platforms): ?>
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3>📱 منصات المشاركة الأكثر استخداماً</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <?php foreach ($share_platforms as $platform): ?>
                        <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px; min-width: 120px;">
                            <div style="font-size: 2em; margin-bottom: 10px;">
                                <?php
                                $icons = array(
                                    'twitter' => '🐦',
                                    'facebook' => '📘', 
                                    'whatsapp' => '💬',
                                    'copy' => '📋'
                                );
                                echo isset($icons[$platform->platform]) ? $icons[$platform->platform] : '🔗';
                                ?>
                            </div>
                            <div><strong><?php echo ucfirst($platform->platform); ?></strong></div>
                            <div style="color: #666;"><?php echo $platform->count; ?> مشاركة</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- إجراءات سريعة -->
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3>⚡ إجراءات سريعة</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="<?php echo admin_url('edit.php'); ?>" class="button button-primary">
                        📝 إدارة المقالات
                    </a>
                    <a href="<?php echo admin_url('edit-tags.php?taxonomy=solution_category'); ?>" class="button">
                        🗂️ إدارة الفئات
                    </a>
                    <a href="<?php echo admin_url('edit-comments.php'); ?>" class="button">
                        💬 إدارة التعليقات
                    </a>
                    <button onclick="exportSubscribers()" class="button">
                        📧 تصدير المشتركين
                    </button>
                    <button onclick="clearOldData()" class="button" style="background: #dc3545; color: white;">
                        🗑️ تنظيف البيانات القديمة
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function exportSubscribers() {
        if (confirm('هل تريد تصدير قائمة المشتركين؟')) {
            window.location.href = ajaxurl + '?action=export_subscribers&nonce=<?php echo wp_create_nonce('export_subscribers'); ?>';
        }
    }
    
    function clearOldData() {
        if (confirm('هل تريد حذف البيانات الأقدم من 6 أشهر؟ هذا الإجراء لا يمكن التراجع عنه.')) {
            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=cleanup_old_data&nonce=<?php echo wp_create_nonce('cleanup_old_data'); ?>'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('تم تنظيف البيانات بنجاح');
                    location.reload();
                } else {
                    alert('حدث خطأ: ' + data.data);
                }
            });
        }
    }
    </script>
    
    <style>
    .card {
        background: white;
        border: 1px solid #c3c4c7;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
    }
    
    .card-header {
        background: #f6f7f7;
        border-bottom: 1px solid #c3c4c7;
        padding: 15px 20px;
    }
    
    .card-header h3 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
    }
    
    .card-body {
        padding: 20px;
    }
    </style>
    <?php
}

// تصدير المشتركين
function muhtawaa_export_subscribers() {
    if (!current_user_can('manage_options')) {
        wp_die('غير مصرح');
    }
    
    if (!wp_verify_nonce($_GET['nonce'], 'export_subscribers')) {
        wp_die('غير مصرح');
    }
    
    global $wpdb;
    $subscribers = $wpdb->get_results(
        "SELECT email, date_subscribed, status, source 
         FROM {$wpdb->prefix}muhtawaa_subscribers 
         ORDER BY date_subscribed DESC"
    );
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="subscribers-' . date('Y-m-d') . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    // كتابة الرؤوس
    fputcsv($output, array('البريد الإلكتروني', 'تاريخ الاشتراك', 'الحالة', 'المصدر'));
    
    // كتابة البيانات
    foreach ($subscribers as $subscriber) {
        fputcsv($output, array(
            $subscriber->email,
            $subscriber->date_subscribed,
            $subscriber->status,
            $subscriber->source
        ));
    }
    
    fclose($output);
    exit;
}
add_action('wp_ajax_export_subscribers', 'muhtawaa_export_subscribers');

// تنظيف البيانات القديمة
function muhtawaa_cleanup_old_data_ajax() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('غير مصرح');
    }
    
    if (!wp_verify_nonce($_POST['nonce'], 'cleanup_old_data')) {
        wp_send_json_error('غير مصرح');
    }
    
    global $wpdb;
    
    $deleted_searches = $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
    $deleted_ratings = $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_ratings WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
    $deleted_reading = $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_reading_stats WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
    $deleted_shares = $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_shares WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
    $deleted_errors = $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_js_errors WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 MONTH)");
    
    // تنظيف transients منتهية الصلاحية
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_rating_%' AND option_value < UNIX_TIMESTAMP()");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_rating_%'");
    
    $total_deleted = $deleted_searches + $deleted_ratings + $deleted_reading + $deleted_shares + $deleted_errors;
    
    wp_send_json_success("تم حذف $total_deleted سجل قديم");
}
add_action('wp_ajax_cleanup_old_data', 'muhtawaa_cleanup_old_data_ajax');

// تنظيف تلقائي يومي
function muhtawaa_daily_cleanup() {
    global $wpdb;
    
    // حذف البيانات الأقدم من 6 أشهر
    $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_searches WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
    $wpdb->query("DELETE FROM {$wpdb->prefix}muhtawaa_js_errors WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 MONTH)");
    
    // تنظيف transients منتهية الصلاحية
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
    
    // تحسين الجداول
    $tables = array(
        $wpdb->prefix . 'muhtawaa_subscribers',
        $wpdb->prefix . 'muhtawaa_searches', 
        $wpdb->prefix . 'muhtawaa_ratings',
        $wpdb->prefix . 'muhtawaa_reading_stats',
        $wpdb->prefix . 'muhtawaa_shares'
    );
    
    foreach ($tables as $table) {
        $wpdb->query("OPTIMIZE TABLE $table");
    }
}

// تشغيل التنظيف اليومي
if (!wp_next_scheduled('muhtawaa_daily_cleanup')) {
    wp_schedule_event(time(), 'daily', 'muhtawaa_daily_cleanup');
}
add_action('muhtawaa_daily_cleanup', 'muhtawaa_daily_cleanup');

// إلغاء جدولة التنظيف عند إلغاء تفعيل القالب
function muhtawaa_deactivation_cleanup() {
    wp_clear_scheduled_hook('muhtawaa_daily_cleanup');
}
add_action('switch_theme', 'muhtawaa_deactivation_cleanup');

?>