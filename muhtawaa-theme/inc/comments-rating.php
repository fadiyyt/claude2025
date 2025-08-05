<?php
/**
 * نظام التعليقات والتقييم المتقدم
 * Advanced Comments and Rating System
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

/**
 * فئة نظام التعليقات والتقييم
 */
class MuhtawaaCommentsRating {
    
    /**
     * تهيئة نظام التعليقات والتقييم
     */
    public static function init() {
        // إضافة حقول التقييم للتعليقات
        add_action('comment_form_before_fields', array(__CLASS__, 'add_rating_field'));
        add_action('comment_form_logged_in_after', array(__CLASS__, 'add_rating_field'));
        
        // حفظ التقييم
        add_action('comment_post', array(__CLASS__, 'save_comment_rating'));
        
        // عرض التقييم مع التعليق
        add_filter('comment_text', array(__CLASS__, 'display_comment_rating'), 10, 2);
        
        // تحديث متوسط التقييم عند إضافة/حذف/تعديل تعليق
        add_action('comment_post', array(__CLASS__, 'update_post_average_rating'));
        add_action('trash_comment', array(__CLASS__, 'update_post_average_rating_on_delete'));
        add_action('untrash_comment', array(__CLASS__, 'update_post_average_rating_on_untrash'));
        add_action('deleted_comment', array(__CLASS__, 'update_post_average_rating_on_delete'));
        add_action('edit_comment', array(__CLASS__, 'update_post_average_rating'));
        
        // إضافة أنماط CSS للتقييم
        add_action('wp_head', array(__CLASS__, 'add_rating_styles'));
        
        // إضافة JavaScript للتقييم
        add_action('wp_footer', array(__CLASS__, 'add_rating_scripts'));
        
        // AJAX لتحديث التقييم
        add_action('wp_ajax_muhtawaa_update_rating', array(__CLASS__, 'ajax_update_rating'));
        add_action('wp_ajax_nopriv_muhtawaa_update_rating', array(__CLASS__, 'ajax_update_rating'));
        
        // AJAX للإعجاب بالتعليقات
        add_action('wp_ajax_muhtawaa_like_comment', array(__CLASS__, 'ajax_like_comment'));
        add_action('wp_ajax_nopriv_muhtawaa_like_comment', array(__CLASS__, 'ajax_like_comment'));
        
        // تخصيص قائمة التعليقات
        add_filter('wp_list_comments_args', array(__CLASS__, 'customize_comments_args'));
        
        // إضافة حقول إضافية للتعليقات
        add_filter('comment_form_default_fields', array(__CLASS__, 'add_custom_comment_fields'));
        
        // التحقق من صحة التعليق
        add_filter('preprocess_comment', array(__CLASS__, 'verify_comment_data'));
        
        // إضافة قسم التقييمات في لوحة التحكم
        add_action('add_meta_boxes', array(__CLASS__, 'add_ratings_meta_box'));
        
        // إضافة أعمدة التقييم في قائمة التعليقات
        add_filter('manage_edit-comments_columns', array(__CLASS__, 'add_rating_column'));
        add_action('manage_comments_custom_column', array(__CLASS__, 'display_rating_column'), 10, 2);
        
        // فلترة التعليقات حسب التقييم
        add_action('restrict_manage_comments', array(__CLASS__, 'add_rating_filter'));
        add_filter('comments_clauses', array(__CLASS__, 'filter_comments_by_rating'), 10, 2);
    }
    
    /**
     * إضافة حقل التقييم لنموذج التعليق
     */
    public static function add_rating_field() {
        if ('post' !== get_post_type()) {
            return;
        }
        ?>
        <div class="comment-form-rating">
            <label for="rating"><?php _e('تقييمك للحل', 'muhtawaa'); ?> <span class="required">*</span></label>
            <fieldset class="rating-stars">
                <input type="radio" id="star5" name="rating" value="5" required />
                <label for="star5" title="ممتاز - 5 نجوم">
                    <i class="fas fa-star"></i>
                </label>
                
                <input type="radio" id="star4" name="rating" value="4" />
                <label for="star4" title="جيد جداً - 4 نجوم">
                    <i class="fas fa-star"></i>
                </label>
                
                <input type="radio" id="star3" name="rating" value="3" />
                <label for="star3" title="جيد - 3 نجوم">
                    <i class="fas fa-star"></i>
                </label>
                
                <input type="radio" id="star2" name="rating" value="2" />
                <label for="star2" title="مقبول - نجمتان">
                    <i class="fas fa-star"></i>
                </label>
                
                <input type="radio" id="star1" name="rating" value="1" />
                <label for="star1" title="ضعيف - نجمة واحدة">
                    <i class="fas fa-star"></i>
                </label>
            </fieldset>
            <div class="rating-text">
                <span id="rating-text-display"><?php _e('اختر تقييمك', 'muhtawaa'); ?></span>
            </div>
        </div>
        <?php
    }
    
    /**
     * حفظ تقييم التعليق
     */
    public static function save_comment_rating($comment_id) {
        if (isset($_POST['rating']) && '' !== $_POST['rating']) {
            $rating = intval($_POST['rating']);
            if ($rating >= 1 && $rating <= 5) {
                add_comment_meta($comment_id, 'rating', $rating);
            }
        }
    }
    
    /**
     * عرض التقييم مع التعليق
     */
    public static function display_comment_rating($comment_text, $comment = null) {
        if (is_object($comment)) {
            $rating = get_comment_meta($comment->comment_ID, 'rating', true);
            
            if ($rating) {
                $rating_html = '<div class="comment-rating">';
                $rating_html .= '<div class="rating-display">';
                
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        $rating_html .= '<i class="fas fa-star filled"></i>';
                    } else {
                        $rating_html .= '<i class="far fa-star"></i>';
                    }
                }
                
                $rating_html .= '<span class="rating-value">(' . $rating . '/5)</span>';
                $rating_html .= '</div>';
                
                // إضافة معلومات إضافية
                $likes = get_comment_meta($comment->comment_ID, 'likes', true) ?: 0;
                $helpful = get_comment_meta($comment->comment_ID, 'helpful_count', true) ?: 0;
                
                $rating_html .= '<div class="comment-actions">';
                $rating_html .= '<button class="like-comment" data-comment-id="' . $comment->comment_ID . '">';
                $rating_html .= '<i class="far fa-thumbs-up"></i> ';
                $rating_html .= '<span class="like-count">' . $likes . '</span>';
                $rating_html .= '</button>';
                
                $rating_html .= '<span class="helpful-indicator">';
                $rating_html .= '<i class="fas fa-check-circle"></i> ';
                $rating_html .= sprintf(__('%d وجدوا هذا مفيداً', 'muhtawaa'), $helpful);
                $rating_html .= '</span>';
                $rating_html .= '</div>';
                
                $rating_html .= '</div>';
                
                $comment_text = $rating_html . $comment_text;
            }
        }
        
        return $comment_text;
    }
    
    /**
     * تحديث متوسط التقييم للمقال
     */
    public static function update_post_average_rating($comment_id) {
        $comment = get_comment($comment_id);
        if (!$comment || $comment->comment_approved != 1) {
            return;
        }
        
        $post_id = $comment->comment_post_ID;
        self::calculate_and_update_post_rating($post_id);
    }
    
    /**
     * تحديث التقييم عند حذف تعليق
     */
    public static function update_post_average_rating_on_delete($comment_id) {
        $comment = get_comment($comment_id);
        if ($comment) {
            self::calculate_and_update_post_rating($comment->comment_post_ID);
        }
    }
    
    /**
     * تحديث التقييم عند استرجاع تعليق
     */
    public static function update_post_average_rating_on_untrash($comment_id) {
        $comment = get_comment($comment_id);
        if ($comment) {
            self::calculate_and_update_post_rating($comment->comment_post_ID);
        }
    }
    
    /**
     * حساب وتحديث متوسط التقييم
     */
    private static function calculate_and_update_post_rating($post_id) {
        $args = array(
            'post_id' => $post_id,
            'status' => 'approve',
            'meta_key' => 'rating',
            'meta_value' => array('1', '2', '3', '4', '5'),
            'meta_compare' => 'IN'
        );
        
        $comments = get_comments($args);
        
        if ($comments) {
            $total_rating = 0;
            $rating_count = 0;
            
            foreach ($comments as $comment) {
                $rating = get_comment_meta($comment->comment_ID, 'rating', true);
                if ($rating) {
                    $total_rating += intval($rating);
                    $rating_count++;
                }
            }
            
            if ($rating_count > 0) {
                $average_rating = round($total_rating / $rating_count, 1);
                update_post_meta($post_id, '_average_rating', $average_rating);
                update_post_meta($post_id, '_rating_count', $rating_count);
                update_post_meta($post_id, '_total_rating', $total_rating);
            }
        } else {
            delete_post_meta($post_id, '_average_rating');
            delete_post_meta($post_id, '_rating_count');
            delete_post_meta($post_id, '_total_rating');
        }
    }
    
    /**
     * إضافة أنماط CSS للتقييم
     */
    public static function add_rating_styles() {
        ?>
        <style>
        /* نجوم التقييم في نموذج التعليق */
        .comment-form-rating {
            margin-bottom: 20px;
        }
        
        .comment-form-rating label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #2d3748;
        }
        
        .rating-stars {
            display: inline-flex;
            flex-direction: row-reverse;
            border: none;
            padding: 0;
        }
        
        .rating-stars input[type="radio"] {
            display: none;
        }
        
        .rating-stars label {
            cursor: pointer;
            font-size: 24px;
            color: #cbd5e0;
            margin: 0 2px;
            transition: all 0.2s ease;
        }
        
        .rating-stars label:hover,
        .rating-stars label:hover ~ label,
        .rating-stars input[type="radio"]:checked ~ label {
            color: #f6e05e;
        }
        
        .rating-text {
            margin-top: 10px;
            font-size: 14px;
            color: #718096;
        }
        
        /* عرض التقييم في التعليقات */
        .comment-rating {
            margin-bottom: 15px;
            padding: 15px;
            background: #f7fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .rating-display {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 10px;
        }
        
        .rating-display i {
            font-size: 16px;
            color: #cbd5e0;
        }
        
        .rating-display i.filled {
            color: #f6e05e;
        }
        
        .rating-value {
            margin-left: 10px;
            font-size: 14px;
            color: #718096;
            font-weight: 500;
        }
        
        /* أزرار التفاعل مع التعليق */
        .comment-actions {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 10px;
        }
        
        .like-comment {
            background: none;
            border: 1px solid #e2e8f0;
            padding: 5px 12px;
            border-radius: 20px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: #4a5568;
            transition: all 0.2s ease;
        }
        
        .like-comment:hover {
            background: #edf2f7;
            border-color: #cbd5e0;
        }
        
        .like-comment.liked {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .helpful-indicator {
            font-size: 14px;
            color: #48bb78;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* ملخص التقييمات */
        .ratings-summary {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .ratings-summary h3 {
            margin: 0 0 20px;
            color: #2d3748;
            font-size: 20px;
        }
        
        .overall-rating {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .rating-number {
            font-size: 48px;
            font-weight: 700;
            color: #2d3748;
            line-height: 1;
        }
        
        .rating-stars-large {
            display: flex;
            gap: 3px;
        }
        
        .rating-stars-large i {
            font-size: 24px;
            color: #cbd5e0;
        }
        
        .rating-stars-large i.filled {
            color: #f6e05e;
        }
        
        .rating-meta {
            font-size: 14px;
            color: #718096;
        }
        
        /* توزيع التقييمات */
        .rating-distribution {
            margin-top: 20px;
        }
        
        .rating-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        
        .rating-label {
            min-width: 70px;
            font-size: 14px;
            color: #4a5568;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .rating-progress {
            flex: 1;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .rating-progress-fill {
            height: 100%;
            background: #f6e05e;
            transition: width 0.3s ease;
        }
        
        .rating-count {
            min-width: 40px;
            text-align: right;
            font-size: 14px;
            color: #718096;
        }
        
        /* نموذج التعليق المحسن */
        .comment-form {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
        }
        
        .comment-form-title {
            margin: 0 0 20px;
            font-size: 20px;
            color: #2d3748;
        }
        
        .comment-form textarea {
            width: 100%;
            min-height: 120px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            resize: vertical;
            font-family: inherit;
            font-size: 15px;
            transition: border-color 0.2s ease;
        }
        
        .comment-form textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .comment-form .submit {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        
        .comment-form .submit:hover {
            background: #5a67d8;
        }
        
        /* قائمة التعليقات المحسنة */
        .comment-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .comment {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.2s ease;
        }
        
        .comment:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .comment-author {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .comment-author .avatar {
            border-radius: 50%;
            border: 3px solid #e2e8f0;
        }
        
        .comment-author-info {
            flex: 1;
        }
        
        .comment-author-name {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }
        
        .comment-date {
            font-size: 13px;
            color: #718096;
        }
        
        .comment-content {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        /* تحسينات للجوال */
        @media (max-width: 768px) {
            .overall-rating {
                flex-direction: column;
                text-align: center;
            }
            
            .rating-bar {
                flex-wrap: wrap;
            }
            
            .rating-label {
                min-width: 100%;
                margin-bottom: 5px;
            }
            
            .comment-form {
                padding: 20px;
            }
            
            .comment {
                padding: 15px;
            }
        }
        </style>
        <?php
    }
    
    /**
     * إضافة JavaScript للتقييم
     */
    public static function add_rating_scripts() {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // تحديث نص التقييم عند التغيير
            var ratingTexts = {
                '1': '<?php _e('ضعيف - نجمة واحدة', 'muhtawaa'); ?>',
                '2': '<?php _e('مقبول - نجمتان', 'muhtawaa'); ?>',
                '3': '<?php _e('جيد - 3 نجوم', 'muhtawaa'); ?>',
                '4': '<?php _e('جيد جداً - 4 نجوم', 'muhtawaa'); ?>',
                '5': '<?php _e('ممتاز - 5 نجوم', 'muhtawaa'); ?>'
            };
            
            $('input[name="rating"]').on('change', function() {
                var rating = $(this).val();
                $('#rating-text-display').text(ratingTexts[rating]);
            });
            
            // معالج الإعجاب بالتعليق
            $('.like-comment').on('click', function(e) {
                e.preventDefault();
                
                var button = $(this);
                var commentId = button.data('comment-id');
                var likeCount = button.find('.like-count');
                
                // منع النقرات المتعددة
                if (button.hasClass('processing')) {
                    return;
                }
                
                button.addClass('processing');
                
                $.ajax({
                    url: muhtawaa_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_like_comment',
                        comment_id: commentId,
                        nonce: muhtawaa_ajax.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            likeCount.text(response.data.likes);
                            
                            if (response.data.liked) {
                                button.addClass('liked');
                            } else {
                                button.removeClass('liked');
                            }
                        }
                    },
                    complete: function() {
                        button.removeClass('processing');
                    }
                });
            });
            
            // تأثيرات حركية للنجوم
            $('.rating-stars label').hover(
                function() {
                    $(this).find('i').addClass('fa-bounce');
                },
                function() {
                    $(this).find('i').removeClass('fa-bounce');
                }
            );
            
            // تحسين تجربة المستخدم في نموذج التعليق
            $('#comment').on('focus', function() {
                $(this).closest('.comment-form').addClass('focused');
            }).on('blur', function() {
                $(this).closest('.comment-form').removeClass('focused');
            });
            
            // التحقق من صحة النموذج
            $('#commentform').on('submit', function(e) {
                var rating = $('input[name="rating"]:checked').val();
                
                if (!rating) {
                    e.preventDefault();
                    alert('<?php _e('من فضلك اختر تقييماً قبل إرسال تعليقك', 'muhtawaa'); ?>');
                    
                    // إبراز حقل التقييم
                    $('.comment-form-rating').addClass('error');
                    
                    // التمرير إلى حقل التقييم
                    $('html, body').animate({
                        scrollTop: $('.comment-form-rating').offset().top - 100
                    }, 500);
                    
                    return false;
                }
            });
            
            // إزالة تنبيه الخطأ عند اختيار تقييم
            $('input[name="rating"]').on('change', function() {
                $('.comment-form-rating').removeClass('error');
            });
        });
        </script>
        <?php
    }
    
    /**
     * معالج AJAX لتحديث التقييم
     */
    public static function ajax_update_rating() {
        check_ajax_referer('muhtawaa_ajax_nonce', 'nonce');
        
        $comment_id = intval($_POST['comment_id']);
        $rating = intval($_POST['rating']);
        
        if ($comment_id && $rating >= 1 && $rating <= 5) {
            update_comment_meta($comment_id, 'rating', $rating);
            
            $comment = get_comment($comment_id);
            if ($comment) {
                self::calculate_and_update_post_rating($comment->comment_post_ID);
            }
            
            wp_send_json_success(array(
                'message' => __('تم تحديث التقييم بنجاح', 'muhtawaa'),
                'rating' => $rating
            ));
        } else {
            wp_send_json_error(array(
                'message' => __('حدث خطأ في تحديث التقييم', 'muhtawaa')
            ));
        }
    }
    
    /**
     * معالج AJAX للإعجاب بالتعليق
     */
    public static function ajax_like_comment() {
        check_ajax_referer('muhtawaa_ajax_nonce', 'nonce');
        
        $comment_id = intval($_POST['comment_id']);
        
        if (!$comment_id) {
            wp_send_json_error();
        }
        
        // الحصول على معرف المستخدم أو IP
        $user_identifier = is_user_logged_in() ? 'user_' . get_current_user_id() : 'ip_' . $_SERVER['REMOTE_ADDR'];
        
        // الحصول على قائمة الإعجابات
        $likes_list = get_comment_meta($comment_id, 'likes_list', true) ?: array();
        $likes_count = get_comment_meta($comment_id, 'likes', true) ?: 0;
        
        if (in_array($user_identifier, $likes_list)) {
            // إلغاء الإعجاب
            $likes_list = array_diff($likes_list, array($user_identifier));
            $likes_count = max(0, $likes_count - 1);
            $liked = false;
        } else {
            // إضافة إعجاب
            $likes_list[] = $user_identifier;
            $likes_count++;
            $liked = true;
        }
        
        // تحديث البيانات
        update_comment_meta($comment_id, 'likes_list', $likes_list);
        update_comment_meta($comment_id, 'likes', $likes_count);
        
        // تحديث عدد المفيد
        if ($liked) {
            $helpful_count = get_comment_meta($comment_id, 'helpful_count', true) ?: 0;
            update_comment_meta($comment_id, 'helpful_count', $helpful_count + 1);
        }
        
        wp_send_json_success(array(
            'likes' => $likes_count,
            'liked' => $liked
        ));
    }
    
    /**
     * تخصيص معاملات قائمة التعليقات
     */
    public static function customize_comments_args($args) {
        $args['callback'] = array(__CLASS__, 'custom_comment_template');
        $args['style'] = 'div';
        $args['avatar_size'] = 60;
        
        return $args;
    }
    
    /**
     * قالب التعليق المخصص
     */
    public static function custom_comment_template($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <div <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">
            <article class="comment-body">
                <header class="comment-author">
                    <?php echo get_avatar($comment, $args['avatar_size']); ?>
                    
                    <div class="comment-author-info">
                        <div class="comment-author-name">
                            <?php comment_author_link(); ?>
                            
                            <?php
                            // إضافة شارة للمؤلف
                            if ($comment->user_id && $comment->user_id == get_post()->post_author) {
                                echo '<span class="author-badge">' . __('المؤلف', 'muhtawaa') . '</span>';
                            }
                            ?>
                        </div>
                        
                        <time class="comment-date" datetime="<?php comment_time('c'); ?>">
                            <?php
                            /* translators: 1: date, 2: time */
                            printf(__('%1$s في %2$s', 'muhtawaa'), get_comment_date(), get_comment_time());
                            ?>
                        </time>
                    </div>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
                    <div class="comment-awaiting-moderation">
                        <?php _e('تعليقك في انتظار الموافقة.', 'muhtawaa'); ?>
                    </div>
                    <?php endif; ?>
                </header>
                
                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>
                
                <footer class="comment-footer">
                    <div class="comment-reply">
                        <?php
                        comment_reply_link(array_merge($args, array(
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                            'reply_text' => __('رد', 'muhtawaa'),
                            'before' => '<span class="reply-link">',
                            'after' => '</span>'
                        )));
                        ?>
                    </div>
                    
                    <?php if (current_user_can('edit_comment', $comment->comment_ID)) : ?>
                    <div class="comment-edit">
                        <?php edit_comment_link(__('تعديل', 'muhtawaa'), '<span class="edit-link">', '</span>'); ?>
                    </div>
                    <?php endif; ?>
                </footer>
            </article>
        </div>
        <?php
    }
    
    /**
     * إضافة حقول مخصصة لنموذج التعليق
     */
    public static function add_custom_comment_fields($fields) {
        // إضافة حقل الموقع (اختياري)
        if (!isset($fields['url'])) {
            $fields['url'] = '<p class="comment-form-url">
                <label for="url">' . __('الموقع الإلكتروني', 'muhtawaa') . '</label>
                <input id="url" name="url" type="url" value="" size="30" placeholder="' . __('https://example.com', 'muhtawaa') . '" />
            </p>';
        }
        
        // إعادة ترتيب الحقول
        $new_fields = array();
        $new_fields['author'] = $fields['author'];
        $new_fields['email'] = $fields['email'];
        $new_fields['url'] = $fields['url'];
        
        return $new_fields;
    }
    
    /**
     * التحقق من صحة بيانات التعليق
     */
    public static function verify_comment_data($commentdata) {
        // التحقق من التقييم للمقالات فقط
        if (get_post_type($commentdata['comment_post_ID']) === 'post') {
            if (!isset($_POST['rating']) || empty($_POST['rating'])) {
                wp_die(__('من فضلك اختر تقييماً للحل قبل إرسال تعليقك.', 'muhtawaa'));
            }
            
            $rating = intval($_POST['rating']);
            if ($rating < 1 || $rating > 5) {
                wp_die(__('التقييم غير صالح. يجب أن يكون بين 1 و 5.', 'muhtawaa'));
            }
        }
        
        return $commentdata;
    }
    
    /**
     * إضافة صندوق التقييمات في لوحة التحكم
     */
    public static function add_ratings_meta_box() {
        add_meta_box(
            'muhtawaa_ratings_box',
            __('ملخص التقييمات', 'muhtawaa'),
            array(__CLASS__, 'display_ratings_meta_box'),
            'post',
            'side',
            'high'
        );
    }
    
    /**
     * عرض صندوق التقييمات
     */
    public static function display_ratings_meta_box($post) {
        $average_rating = get_post_meta($post->ID, '_average_rating', true);
        $rating_count = get_post_meta($post->ID, '_rating_count', true);
        
        if ($average_rating) {
            echo '<div class="ratings-meta-box">';
            
            // المتوسط العام
            echo '<div class="overall-rating-admin">';
            echo '<div class="rating-number-admin">' . number_format($average_rating, 1) . '</div>';
            echo '<div class="rating-stars-admin">';
            
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= round($average_rating)) {
                    echo '<span class="dashicons dashicons-star-filled"></span>';
                } else {
                    echo '<span class="dashicons dashicons-star-empty"></span>';
                }
            }
            
            echo '</div>';
            echo '<div class="rating-count-admin">';
            printf(_n('بناءً على تقييم واحد', 'بناءً على %s تقييم', $rating_count, 'muhtawaa'), $rating_count);
            echo '</div>';
            echo '</div>';
            
            // توزيع التقييمات
            echo '<div class="rating-distribution-admin">';
            
            for ($star = 5; $star >= 1; $star--) {
                $star_count = self::get_rating_count_by_star($post->ID, $star);
                $percentage = $rating_count > 0 ? ($star_count / $rating_count * 100) : 0;
                
                echo '<div class="rating-bar-admin">';
                echo '<span class="star-label">' . $star . ' <span class="dashicons dashicons-star-filled"></span></span>';
                echo '<div class="rating-progress-admin">';
                echo '<div class="rating-progress-fill-admin" style="width: ' . $percentage . '%;"></div>';
                echo '</div>';
                echo '<span class="star-count">' . $star_count . '</span>';
                echo '</div>';
            }
            
            echo '</div>';
            echo '</div>';
            
            echo '<style>
            .ratings-meta-box {
                text-align: center;
            }
            .overall-rating-admin {
                margin-bottom: 20px;
            }
            .rating-number-admin {
                font-size: 36px;
                font-weight: 700;
                color: #23282d;
                margin-bottom: 5px;
            }
            .rating-stars-admin .dashicons {
                font-size: 20px;
                width: 20px;
                height: 20px;
                color: #ffb900;
            }
            .rating-count-admin {
                font-size: 12px;
                color: #666;
                margin-top: 5px;
            }
            .rating-distribution-admin {
                margin-top: 15px;
            }
            .rating-bar-admin {
                display: flex;
                align-items: center;
                margin-bottom: 8px;
                font-size: 12px;
            }
            .star-label {
                width: 35px;
                text-align: left;
                display: flex;
                align-items: center;
                gap: 2px;
            }
            .star-label .dashicons {
                font-size: 12px;
                width: 12px;
                height: 12px;
                color: #ffb900;
            }
            .rating-progress-admin {
                flex: 1;
                height: 6px;
                background: #e5e5e5;
                margin: 0 8px;
                border-radius: 3px;
                overflow: hidden;
            }
            .rating-progress-fill-admin {
                height: 100%;
                background: #ffb900;
                transition: width 0.3s ease;
            }
            .star-count {
                width: 25px;
                text-align: right;
                color: #666;
            }
            </style>';
        } else {
            echo '<p>' . __('لا توجد تقييمات بعد.', 'muhtawaa') . '</p>';
        }
    }
    
    /**
     * الحصول على عدد التقييمات لنجمة معينة
     */
    private static function get_rating_count_by_star($post_id, $star) {
        $args = array(
            'post_id' => $post_id,
            'status' => 'approve',
            'meta_key' => 'rating',
            'meta_value' => $star
        );
        
        $comments = get_comments($args);
        return count($comments);
    }
    
    /**
     * إضافة عمود التقييم في قائمة التعليقات
     */
    public static function add_rating_column($columns) {
        $columns['rating'] = __('التقييم', 'muhtawaa');
        return $columns;
    }
    
    /**
     * عرض محتوى عمود التقييم
     */
    public static function display_rating_column($column, $comment_id) {
        if ($column === 'rating') {
            $rating = get_comment_meta($comment_id, 'rating', true);
            
            if ($rating) {
                echo '<div class="comment-rating-column">';
                
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        echo '<span class="dashicons dashicons-star-filled" style="color: #ffb900;"></span>';
                    } else {
                        echo '<span class="dashicons dashicons-star-empty" style="color: #ddd;"></span>';
                    }
                }
                
                echo ' <span style="color: #666;">(' . $rating . '/5)</span>';
                echo '</div>';
            } else {
                echo '<span style="color: #999;">—</span>';
            }
        }
    }
    
    /**
     * إضافة فلتر التقييم في قائمة التعليقات
     */
    public static function add_rating_filter() {
        ?>
        <select name="filter_rating" id="filter-by-rating">
            <option value=""><?php _e('جميع التقييمات', 'muhtawaa'); ?></option>
            <?php
            for ($i = 5; $i >= 1; $i--) {
                $selected = (isset($_GET['filter_rating']) && $_GET['filter_rating'] == $i) ? 'selected' : '';
                echo '<option value="' . $i . '" ' . $selected . '>' . sprintf(__('%d نجوم', 'muhtawaa'), $i) . '</option>';
            }
            ?>
            <option value="no_rating" <?php selected(isset($_GET['filter_rating']) ? $_GET['filter_rating'] : '', 'no_rating'); ?>><?php _e('بدون تقييم', 'muhtawaa'); ?></option>
        </select>
        <?php
    }
    
    /**
     * فلترة التعليقات حسب التقييم
     */
    public static function filter_comments_by_rating($clauses, $wp_comment_query) {
        global $wpdb;
        
        if (isset($_GET['filter_rating']) && !empty($_GET['filter_rating'])) {
            $rating = $_GET['filter_rating'];
            
            if ($rating === 'no_rating') {
                // التعليقات بدون تقييم
                $clauses['join'] .= " LEFT JOIN {$wpdb->commentmeta} AS cm_rating ON ({$wpdb->comments}.comment_ID = cm_rating.comment_id AND cm_rating.meta_key = 'rating')";
                $clauses['where'] .= " AND cm_rating.meta_value IS NULL";
            } else {
                // التعليقات بتقييم محدد
                $rating = intval($rating);
                $clauses['join'] .= " INNER JOIN {$wpdb->commentmeta} AS cm_rating ON ({$wpdb->comments}.comment_ID = cm_rating.comment_id)";
                $clauses['where'] .= $wpdb->prepare(" AND cm_rating.meta_key = 'rating' AND cm_rating.meta_value = %d", $rating);
            }
        }
        
        return $clauses;
    }
    
    /**
     * الحصول على ملخص التقييمات لعرضه في الواجهة الأمامية
     */
    public static function get_ratings_summary($post_id) {
        $average_rating = get_post_meta($post_id, '_average_rating', true);
        $rating_count = get_post_meta($post_id, '_rating_count', true);
        
        if (!$average_rating) {
            return false;
        }
        
        $summary = array(
            'average' => floatval($average_rating),
            'count' => intval($rating_count),
            'distribution' => array()
        );
        
        // حساب توزيع التقييمات
        for ($star = 5; $star >= 1; $star--) {
            $star_count = self::get_rating_count_by_star($post_id, $star);
            $percentage = $rating_count > 0 ? round(($star_count / $rating_count * 100), 1) : 0;
            
            $summary['distribution'][$star] = array(
                'count' => $star_count,
                'percentage' => $percentage
            );
        }
        
        return $summary;
    }
    
    /**
     * عرض ملخص التقييمات
     */
    public static function display_ratings_summary($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $summary = self::get_ratings_summary($post_id);
        
        if (!$summary) {
            return;
        }
        
        ?>
        <div class="ratings-summary" id="ratings-summary">
            <h3><?php _e('تقييمات المستخدمين', 'muhtawaa'); ?></h3>
            
            <div class="overall-rating">
                <div class="rating-info">
                    <div class="rating-number"><?php echo number_format($summary['average'], 1); ?></div>
                    <div class="rating-stars-large">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= round($summary['average'])) {
                                echo '<i class="fas fa-star filled"></i>';
                            } else {
                                echo '<i class="far fa-star"></i>';
                            }
                        }
                        ?>
                    </div>
                    <div class="rating-meta">
                        <?php
                        printf(
                            _n('بناءً على تقييم واحد', 'بناءً على %s تقييم', $summary['count'], 'muhtawaa'),
                            number_format_i18n($summary['count'])
                        );
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="rating-distribution">
                <?php foreach ($summary['distribution'] as $star => $data) : ?>
                <div class="rating-bar">
                    <span class="rating-label">
                        <?php echo $star; ?> <i class="fas fa-star"></i>
                    </span>
                    <div class="rating-progress">
                        <div class="rating-progress-fill" style="width: <?php echo $data['percentage']; ?>%;"></div>
                    </div>
                    <span class="rating-count"><?php echo $data['count']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

// تهيئة نظام التعليقات والتقييم
add_action('init', array('MuhtawaaCommentsRating', 'init'));

/**
 * دالة مساعدة لعرض ملخص التقييمات
 */
function muhtawaa_display_ratings_summary($post_id = null) {
    MuhtawaaCommentsRating::display_ratings_summary($post_id);
}

/**
 * دالة مساعدة للحصول على متوسط التقييم
 */
function muhtawaa_get_post_rating_average($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return get_post_meta($post_id, '_average_rating', true) ?: 0;
}

/**
 * دالة مساعدة للحصول على عدد التقييمات
 */
function muhtawaa_get_post_rating_count($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return get_post_meta($post_id, '_rating_count', true) ?: 0;
}
?>