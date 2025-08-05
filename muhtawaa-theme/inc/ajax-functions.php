<?php
/**
 * وظائف AJAX المتقدمة - قالب محتوى
 * Advanced AJAX Functions
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

/**
 * فئة إدارة وظائف AJAX
 */
class MuhtawaaAjaxFunctions {
    
    /**
     * تهيئة الفئة وربط الوظائف
     */
    public static function init() {
        // وظائف AJAX للمستخدمين المسجلين وغير المسجلين
        add_action('wp_ajax_load_more_posts', array(__CLASS__, 'load_more_posts'));
        add_action('wp_ajax_nopriv_load_more_posts', array(__CLASS__, 'load_more_posts'));
        
        add_action('wp_ajax_search_posts', array(__CLASS__, 'search_posts'));
        add_action('wp_ajax_nopriv_search_posts', array(__CLASS__, 'search_posts'));
        
        add_action('wp_ajax_submit_newsletter', array(__CLASS__, 'submit_newsletter'));
        add_action('wp_ajax_nopriv_submit_newsletter', array(__CLASS__, 'submit_newsletter'));
        
        add_action('wp_ajax_rate_post', array(__CLASS__, 'rate_post'));
        add_action('wp_ajax_nopriv_rate_post', array(__CLASS__, 'rate_post'));
        
        add_action('wp_ajax_load_comments', array(__CLASS__, 'load_comments'));
        add_action('wp_ajax_nopriv_load_comments', array(__CLASS__, 'load_comments'));
        
        add_action('wp_ajax_submit_contact_form', array(__CLASS__, 'submit_contact_form'));
        add_action('wp_ajax_nopriv_submit_contact_form', array(__CLASS__, 'submit_contact_form'));
        
        add_action('wp_ajax_toggle_bookmark', array(__CLASS__, 'toggle_bookmark'));
        add_action('wp_ajax_get_related_posts', array(__CLASS__, 'get_related_posts'));
        add_action('wp_ajax_nopriv_get_related_posts', array(__CLASS__, 'get_related_posts'));
        
        // إضافة متغيرات JavaScript
        add_action('wp_enqueue_scripts', array(__CLASS__, 'localize_ajax_script'));
    }
    
    /**
     * إضافة متغيرات AJAX إلى JavaScript
     */
    public static function localize_ajax_script() {
        wp_localize_script('muhtawaa-main', 'muhtawaa_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('muhtawaa_ajax_nonce'),
            'loading_text' => __('جارٍ التحميل...', 'muhtawaa'),
            'error_text' => __('حدث خطأ، يرجى المحاولة مرة أخرى', 'muhtawaa'),
            'success_text' => __('تم بنجاح!', 'muhtawaa'),
            'no_more_posts' => __('لا توجد مقالات أخرى', 'muhtawaa'),
            'invalid_email' => __('يرجى إدخال بريد إلكتروني صحيح', 'muhtawaa'),
            'required_fields' => __('يرجى ملء جميع الحقول المطلوبة', 'muhtawaa')
        ));
    }
    
    /**
     * تحميل المزيد من المقالات
     */
    public static function load_more_posts() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $page = intval($_POST['page']) ?: 1;
        $posts_per_page = intval($_POST['posts_per_page']) ?: 6;
        $category = sanitize_text_field($_POST['category']) ?: '';
        $search = sanitize_text_field($_POST['search']) ?: '';
        
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'paged' => $page,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        // إضافة فلتر الفئة
        if (!empty($category)) {
            $args['category_name'] = $category;
        }
        
        // إضافة فلتر البحث
        if (!empty($search)) {
            $args['s'] = $search;
        }
        
        $query = new WP_Query($args);
        $posts_html = '';
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                ob_start();
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="post-card muhtawaa-card hover-lift">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>" class="post-image-link">
                                    <?php the_post_thumbnail('medium_large', array(
                                        'class' => 'post-image img-fluid',
                                        'loading' => 'lazy'
                                    )); ?>
                                    <div class="post-overlay">
                                        <i class="fas fa-external-link-alt"></i>
                                    </div>
                                </a>
                                
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) :
                                    $category = $categories[0];
                                ?>
                                    <span class="post-category badge badge-primary">
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comments"></i>
                                    <?php comments_number('0', '1', '%'); ?>
                                </span>
                            </div>
                            
                            <h3 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <p class="post-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                            </p>
                            
                            <div class="post-footer">
                                <div class="post-author">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 30, '', '', array('class' => 'author-avatar')); ?>
                                    <span><?php the_author(); ?></span>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    اقرأ المزيد
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php
                $posts_html .= ob_get_clean();
            }
            wp_reset_postdata();
        }
        
        $response = array(
            'success' => true,
            'posts_html' => $posts_html,
            'has_more' => ($query->found_posts > ($page * $posts_per_page)),
            'total_posts' => $query->found_posts,
            'current_page' => $page
        );
        
        wp_send_json($response);
    }
    
    /**
     * البحث في المقالات
     */
    public static function search_posts() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $search_term = sanitize_text_field($_POST['search_term']);
        $limit = intval($_POST['limit']) ?: 5;
        
        if (empty($search_term)) {
            wp_send_json_error(__('يرجى إدخال كلمة للبحث', 'muhtawaa'));
        }
        
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            's' => $search_term,
            'orderby' => 'relevance'
        );
        
        $query = new WP_Query($args);
        $results = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                $results[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'permalink' => get_permalink(),
                    'excerpt' => wp_trim_words(get_the_excerpt(), 20, '...'),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                    'date' => get_the_date(),
                    'author' => get_the_author(),
                    'category' => !empty(get_the_category()) ? get_the_category()[0]->name : ''
                );
            }
            wp_reset_postdata();
        }
        
        wp_send_json_success(array(
            'results' => $results,
            'total_found' => $query->found_posts
        ));
    }
    
    /**
     * اشتراك في النشرة البريدية
     */
    public static function submit_newsletter() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $email = sanitize_email($_POST['email']);
        
        if (!is_email($email)) {
            wp_send_json_error(__('يرجى إدخال بريد إلكتروني صحيح', 'muhtawaa'));
        }
        
        // التحقق من عدم وجود البريد مسبقاً
        $existing_subscriber = get_option('muhtawaa_newsletter_subscribers', array());
        
        if (in_array($email, $existing_subscriber)) {
            wp_send_json_error(__('هذا البريد الإلكتروني مشترك مسبقاً', 'muhtawaa'));
        }
        
        // إضافة المشترك الجديد
        $existing_subscriber[] = $email;
        update_option('muhtawaa_newsletter_subscribers', $existing_subscriber);
        
        // حفظ تاريخ الاشتراك
        $subscription_data = get_option('muhtawaa_newsletter_data', array());
        $subscription_data[$email] = array(
            'date' => current_time('mysql'),
            'ip' => self::get_user_ip(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'status' => 'active'
        );
        update_option('muhtawaa_newsletter_data', $subscription_data);
        
        // إرسال إيميل ترحيبي (اختياري)
        $subject = sprintf(__('أهلاً بك في نشرة %s البريدية', 'muhtawaa'), get_bloginfo('name'));
        $message = sprintf(
            __('مرحباً،\n\nشكراً لاشتراكك في نشرتنا البريدية.\n\nسنرسل لك أحدث المقالات والأخبار.\n\nفريق %s', 'muhtawaa'),
            get_bloginfo('name')
        );
        
        wp_mail($email, $subject, $message);
        
        // تسجيل الحدث
        if (class_exists('MuhtawaaNotifications')) {
            MuhtawaaNotifications::log_event('newsletter_subscription', array(
                'email' => $email,
                'ip' => self::get_user_ip()
            ));
        }
        
        wp_send_json_success(__('تم اشتراكك بنجاح! سنرسل لك أحدث المقالات.', 'muhtawaa'));
    }
    
    /**
     * تقييم المقال
     */
    public static function rate_post() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $post_id = intval($_POST['post_id']);
        $rating = intval($_POST['rating']);
        
        if (!$post_id || $rating < 1 || $rating > 5) {
            wp_send_json_error(__('بيانات غير صحيحة', 'muhtawaa'));
        }
        
        $user_ip = self::get_user_ip();
        $rated_ips = get_post_meta($post_id, '_muhtawaa_rated_ips', true) ?: array();
        
        // التحقق من عدم تقييم المستخدم مسبقاً
        if (in_array($user_ip, $rated_ips)) {
            wp_send_json_error(__('لقد قيمت هذا المقال مسبقاً', 'muhtawaa'));
        }
        
        // حفظ التقييم
        $current_ratings = get_post_meta($post_id, '_muhtawaa_ratings', true) ?: array();
        $current_ratings[] = $rating;
        update_post_meta($post_id, '_muhtawaa_ratings', $current_ratings);
        
        // حفظ IP المستخدم
        $rated_ips[] = $user_ip;
        update_post_meta($post_id, '_muhtawaa_rated_ips', $rated_ips);
        
        // حساب المتوسط
        $average_rating = array_sum($current_ratings) / count($current_ratings);
        update_post_meta($post_id, '_muhtawaa_average_rating', $average_rating);
        
        wp_send_json_success(array(
            'average_rating' => round($average_rating, 1),
            'total_ratings' => count($current_ratings),
            'message' => __('شكراً لتقييمك!', 'muhtawaa')
        ));
    }
    
    /**
     * تحميل التعليقات
     */
    public static function load_comments() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $post_id = intval($_POST['post_id']);
        $page = intval($_POST['page']) ?: 1;
        $per_page = 5;
        
        $comments = get_comments(array(
            'post_id' => $post_id,
            'status' => 'approve',
            'number' => $per_page,
            'offset' => ($page - 1) * $per_page,
            'orderby' => 'comment_date',
            'order' => 'DESC'
        ));
        
        $comments_html = '';
        
        foreach ($comments as $comment) {
            ob_start();
            ?>
            <div class="comment-item" data-comment-id="<?php echo $comment->comment_ID; ?>">
                <div class="comment-author">
                    <?php echo get_avatar($comment->comment_author_email, 50); ?>
                    <div class="author-info">
                        <h5><?php echo esc_html($comment->comment_author); ?></h5>
                        <span class="comment-date"><?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp')); ?> <?php _e('منذ', 'muhtawaa'); ?></span>
                    </div>
                </div>
                <div class="comment-content">
                    <?php echo wpautop($comment->comment_content); ?>
                </div>
            </div>
            <?php
            $comments_html .= ob_get_clean();
        }
        
        $total_comments = get_comments_number($post_id);
        $has_more = ($page * $per_page) < $total_comments;
        
        wp_send_json_success(array(
            'comments_html' => $comments_html,
            'has_more' => $has_more,
            'total_comments' => $total_comments
        ));
    }
    
    /**
     * إرسال نموذج الاتصال
     */
    public static function submit_contact_form() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // التحقق من البيانات
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            wp_send_json_error(__('يرجى ملء جميع الحقول المطلوبة', 'muhtawaa'));
        }
        
        if (!is_email($email)) {
            wp_send_json_error(__('يرجى إدخال بريد إلكتروني صحيح', 'muhtawaa'));
        }
        
        // إعداد الرسالة
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');
        
        $email_subject = sprintf('[%s] رسالة جديدة من: %s', $site_name, $subject);
        $email_message = sprintf(
            "رسالة جديدة من موقع %s\n\n" .
            "الاسم: %s\n" .
            "البريد الإلكتروني: %s\n" .
            "الموضوع: %s\n\n" .
            "الرسالة:\n%s\n\n" .
            "---\n" .
            "تم الإرسال في: %s\n" .
            "عنوان IP: %s",
            $site_name,
            $name,
            $email,
            $subject,
            $message,
            current_time('mysql'),
            self::get_user_ip()
        );
        
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . $site_name . ' <' . $admin_email . '>',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );
        
        // إرسال الرسالة
        $sent = wp_mail($admin_email, $email_subject, $email_message, $headers);
        
        if ($sent) {
            // حفظ الرسالة في قاعدة البيانات (اختياري)
            $contact_messages = get_option('muhtawaa_contact_messages', array());
            $contact_messages[] = array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'date' => current_time('mysql'),
                'ip' => self::get_user_ip(),
                'status' => 'new'
            );
            update_option('muhtawaa_contact_messages', $contact_messages);
            
            wp_send_json_success(__('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.', 'muhtawaa'));
        } else {
            wp_send_json_error(__('فشل في إرسال الرسالة، يرجى المحاولة مرة أخرى', 'muhtawaa'));
        }
    }
    
    /**
     * تبديل الإشارة المرجعية
     */
    public static function toggle_bookmark() {
        if (!is_user_logged_in()) {
            wp_send_json_error(__('يجب تسجيل الدخول أولاً', 'muhtawaa'));
        }
        
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $post_id = intval($_POST['post_id']);
        $user_id = get_current_user_id();
        
        if (!$post_id) {
            wp_send_json_error(__('معرف المقال غير صحيح', 'muhtawaa'));
        }
        
        $bookmarks = get_user_meta($user_id, '_muhtawaa_bookmarks', true) ?: array();
        
        if (in_array($post_id, $bookmarks)) {
            // إزالة الإشارة المرجعية
            $bookmarks = array_diff($bookmarks, array($post_id));
            $action = 'removed';
            $message = __('تم إزالة المقال من المفضلة', 'muhtawaa');
        } else {
            // إضافة الإشارة المرجعية
            $bookmarks[] = $post_id;
            $action = 'added';
            $message = __('تم إضافة المقال إلى المفضلة', 'muhtawaa');
        }
        
        update_user_meta($user_id, '_muhtawaa_bookmarks', $bookmarks);
        
        wp_send_json_success(array(
            'action' => $action,
            'message' => $message,
            'total_bookmarks' => count($bookmarks)
        ));
    }
    
    /**
     * جلب المقالات ذات الصلة
     */
    public static function get_related_posts() {
        // التحقق من الأمان
        if (!wp_verify_nonce($_POST['nonce'], 'muhtawaa_ajax_nonce')) {
            wp_die(__('فشل التحقق من الأمان', 'muhtawaa'));
        }
        
        $post_id = intval($_POST['post_id']);
        $limit = intval($_POST['limit']) ?: 3;
        
        if (!$post_id) {
            wp_send_json_error(__('معرف المقال غير صحيح', 'muhtawaa'));
        }
        
        // جلب فئات المقال الحالي
        $categories = wp_get_post_categories($post_id);
        
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'post__not_in' => array($post_id),
            'category__in' => $categories,
            'orderby' => 'rand'
        );
        
        $query = new WP_Query($args);
        $related_posts = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                
                $related_posts[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'permalink' => get_permalink(),
                    'excerpt' => wp_trim_words(get_the_excerpt(), 15, '...'),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                    'date' => get_the_date(),
                    'author' => get_the_author(),
                    'category' => !empty(get_the_category()) ? get_the_category()[0]->name : '',
                    'reading_time' => self::calculate_reading_time(get_the_content())
                );
            }
            wp_reset_postdata();
        }
        
        wp_send_json_success(array(
            'related_posts' => $related_posts,
            'total_found' => count($related_posts)
        ));
    }
    
    /**
     * حساب وقت القراءة المتوقع
     */
    private static function calculate_reading_time($content) {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // متوسط 200 كلمة في الدقيقة
        return $reading_time;
    }
    
    /**
     * الحصول على عنوان IP الخاص بالمستخدم
     */
    private static function get_user_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    
    /**
     * تنظيف وحماية البيانات
     */
    private static function sanitize_request_data($data, $type = 'text') {
        switch ($type) {
            case 'email':
                return sanitize_email($data);
            case 'textarea':
                return sanitize_textarea_field($data);
            case 'url':
                return esc_url_raw($data);
            case 'int':
                return intval($data);
            default:
                return sanitize_text_field($data);
        }
    }
    
    /**
     * معالجة الأخطاء وتسجيلها
     */
    private static function log_ajax_error($function_name, $error_message, $data = array()) {
        $log_entry = array(
            'timestamp' => current_time('mysql'),
            'function' => $function_name,
            'error' => $error_message,
            'data' => $data,
            'user_ip' => self::get_user_ip(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        );
        
        $ajax_errors = get_option('muhtawaa_ajax_errors', array());
        $ajax_errors[] = $log_entry;
        
        // الاحتفاظ بآخر 100 خطأ فقط
        if (count($ajax_errors) > 100) {
            $ajax_errors = array_slice($ajax_errors, -100);
        }
        
        update_option('muhtawaa_ajax_errors', $ajax_errors);
        
        // تسجيل في ملف الأخطاء إذا كان متاحاً
        if (function_exists('error_log')) {
            error_log("Muhtawaa AJAX Error [{$function_name}]: {$error_message}");
        }
    }
}

// تهيئة فئة AJAX
add_action('init', array('MuhtawaaAjaxFunctions', 'init'));