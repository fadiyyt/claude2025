<?php
/**
 * وظائف AJAX الأساسية لقالب محتوى
 * 
 * @package Muhtawaa
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
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
        // نصيحة افتراضية إذا لم توجد مقالات
        $tip_data = array(
            'id' => 0,
            'title' => 'نصيحة سريعة',
            'content' => 'ضع قطعة خبز في علبة السكر لمنع تكتله وجعله يبقى ناعماً لفترة أطول!',
            'url' => home_url(),
            'difficulty' => 'سهل'
        );
        
        wp_send_json_success($tip_data);
    }
}
add_action('wp_ajax_get_random_tip', 'muhtawaa_get_random_tip');
add_action('wp_ajax_nopriv_get_random_tip', 'muhtawaa_get_random_tip');

// البحث المباشر
function muhtawaa_live_search() {
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
        'orderby' => 'relevance'
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
    
    wp_send_json_success($results);
}
add_action('wp_ajax_live_search', 'muhtawaa_live_search');
add_action('wp_ajax_nopriv_live_search', 'muhtawaa_live_search');

// اشتراك النشرة البريدية
function muhtawaa_newsletter_subscribe() {
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
    
    // إنشاء الجدول إذا لم يكن موجوداً
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        date_subscribed datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'active',
        source varchar(50) DEFAULT 'website',
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
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
            'source' => 'website'
        ),
        array('%s', '%s', '%s', '%s')
    );
    
    if ($result) {
        wp_send_json_success('تم الاشتراك بنجاح! تحقق من بريدك الإلكتروني');
    } else {
        wp_send_json_error('حدث خطأ، يرجى المحاولة مرة أخرى');
    }
}
add_action('wp_ajax_newsletter_subscribe', 'muhtawaa_newsletter_subscribe');
add_action('wp_ajax_nopriv_newsletter_subscribe', 'muhtawaa_newsletter_subscribe');

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
    
    // منع التقييم المتكرر لمدة 24 ساعة  
    set_transient($cache_key, $rating, DAY_IN_SECONDS);
    
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
    
    wp_send_json_success($default_suggestions);
}
add_action('wp_ajax_get_search_suggestions', 'muhtawaa_get_search_suggestions');
add_action('wp_ajax_nopriv_get_search_suggestions', 'muhtawaa_get_search_suggestions');

// تتبع البحث
function muhtawaa_track_search() {
    if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_nonce')) {
        wp_send_json_error('غير مصرح');
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $results_count = intval($_POST['results_count']) ?: 0;
    
    if (!empty($search_term)) {
        // حفظ البحث في قاعدة البيانات
        global $wpdb;
        $table_name = $wpdb->prefix . 'muhtawaa_searches';
        
        // إنشاء الجدول إذا لم يكن موجوداً
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            search_term varchar(255) NOT NULL,
            results_count int(11) DEFAULT 0,
            user_ip varchar(45),
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY search_term (search_term),
            KEY created_at (created_at)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        $wpdb->insert(
            $table_name,
            array(
                'search_term' => $search_term,
                'results_count' => $results_count,
                'user_ip' => $_SERVER['REMOTE_ADDR'],
                'created_at' => current_time('mysql')
            ),
            array('%s', '%d', '%s', '%s')
        );
        
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
    
    // يمكن حفظ هذه المعلومات في قاعدة البيانات أو ملف log
    error_log("Share tracked: $platform - $url");
    
    wp_send_json_success('تم تسجيل المشاركة');
}
add_action('wp_ajax_track_share', 'muhtawaa_track_share');
add_action('wp_ajax_nopriv_track_share', 'muhtawaa_track_share');

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
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    // جدول البحثات
    $searches_table = $wpdb->prefix . 'muhtawaa_searches';
    $sql_searches = "CREATE TABLE IF NOT EXISTS $searches_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        search_term varchar(255) NOT NULL,
        results_count int(11) DEFAULT 0,
        user_ip varchar(45),
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY search_term (search_term),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_subscribers);
    dbDelta($sql_searches);
}

?>