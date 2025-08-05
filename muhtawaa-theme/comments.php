<?php
/**
 * قالب التعليقات
 * Comments Template
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// لا تعرض أي شيء إذا كانت المقالة محمية بكلمة مرور
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    
    <?php if (have_comments()) : ?>
        
        <h2 class="comments-title">
            <i class="fas fa-comments"></i>
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                printf(
                    /* translators: %s: post title */
                    esc_html__('تعليق واحد على &ldquo;%s&rdquo;', 'muhtawaa'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: number of comments, 2: post title */
                    esc_html(
                        _nx(
                            '%1$s تعليق على &ldquo;%2$s&rdquo;',
                            '%1$s تعليقات على &ldquo;%2$s&rdquo;',
                            $comments_number,
                            'comments title',
                            'muhtawaa'
                        )
                    ),
                    number_format_i18n($comments_number),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>
        
        <!-- قائمة التعليقات -->
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'muhtawaa_comment_template',
            ));
            ?>
        </ol>
        
        <!-- التنقل بين صفحات التعليقات -->
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav class="comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('التنقل بين التعليقات', 'muhtawaa'); ?></h2>
            <div class="nav-links">
                <div class="nav-previous">
                    <?php previous_comments_link(esc_html__('&rarr; التعليقات الأقدم', 'muhtawaa')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(esc_html__('التعليقات الأحدث &larr;', 'muhtawaa')); ?>
                </div>
            </div>
        </nav>
        <?php endif; ?>
        
    <?php endif; // have_comments() ?>
    
    <?php
    // إذا كانت التعليقات مغلقة وهناك تعليقات، دع نترك رسالة صغيرة
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php esc_html_e('التعليقات مغلقة.', 'muhtawaa'); ?></p>
    <?php endif; ?>
    
    <?php
    // نموذج التعليق
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    
    $fields = array(
        'author' => '<div class="comment-form-author form-group">' .
                    '<label for="author">' . __('الاسم', 'muhtawaa') . ($req ? ' <span class="required">*</span>' : '') . '</label>' .
                    '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />' .
                    '</div>',
                    
        'email'  => '<div class="comment-form-email form-group">' .
                    '<label for="email">' . __('البريد الإلكتروني', 'muhtawaa') . ($req ? ' <span class="required">*</span>' : '') . '</label>' .
                    '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />' .
                    '</div>',
                    
        'url'    => '<div class="comment-form-url form-group">' .
                    '<label for="url">' . __('الموقع الإلكتروني', 'muhtawaa') . '</label>' .
                    '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />' .
                    '</div>',
    );
    
    // إضافة حقل التقييم
    if (is_singular('post')) {
        $fields['rating'] = '<div class="comment-form-rating form-group">' .
                            '<label for="rating">' . __('تقييمك للمقالة', 'muhtawaa') . '</label>' .
                            '<div class="rating-stars-input" data-rating="0">' .
                            '<input type="hidden" name="rating" id="rating" value="0" />' .
                            '<span class="star" data-rating="1"><i class="far fa-star"></i></span>' .
                            '<span class="star" data-rating="2"><i class="far fa-star"></i></span>' .
                            '<span class="star" data-rating="3"><i class="far fa-star"></i></span>' .
                            '<span class="star" data-rating="4"><i class="far fa-star"></i></span>' .
                            '<span class="star" data-rating="5"><i class="far fa-star"></i></span>' .
                            '</div>' .
                            '</div>';
    }
    
    $args = array(
        'id_form'           => 'commentform',
        'class_form'        => 'comment-form',
        'id_submit'         => 'submit',
        'class_submit'      => 'submit btn btn-primary',
        'name_submit'       => 'submit',
        'title_reply'       => __('اترك تعليقاً', 'muhtawaa'),
        'title_reply_to'    => __('اترك تعليقاً على %s', 'muhtawaa'),
        'cancel_reply_link' => __('إلغاء الرد', 'muhtawaa'),
        'label_submit'      => __('نشر التعليق', 'muhtawaa'),
        'format'            => 'xhtml',
        
        'comment_field' => '<div class="comment-form-comment form-group">' .
                           '<label for="comment">' . _x('التعليق', 'noun', 'muhtawaa') . ' <span class="required">*</span></label>' .
                           '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea>' .
                           '</div>',
                           
        'must_log_in' => '<p class="must-log-in">' .
                         sprintf(
                             __('يجب عليك <a href="%s">تسجيل الدخول</a> لنشر تعليق.', 'muhtawaa'),
                             wp_login_url(apply_filters('the_permalink', get_permalink()))
                         ) . '</p>',
                         
        'logged_in_as' => '<p class="logged-in-as">' .
                          sprintf(
                              __('مسجل الدخول بإسم <a href="%1$s">%2$s</a>. <a href="%3$s" title="تسجيل الخروج من هذا الحساب">تسجيل الخروج؟</a>', 'muhtawaa'),
                              admin_url('profile.php'),
                              $user_identity,
                              wp_logout_url(apply_filters('the_permalink', get_permalink()))
                          ) . '</p>',
                          
        'comment_notes_before' => '<p class="comment-notes">' .
                                  __('لن يتم نشر عنوان بريدك الإلكتروني.', 'muhtawaa') . ' ' .
                                  ($req ? __('الحقول المطلوبة محددة بـ <span class="required">*</span>', 'muhtawaa') : '') .
                                  '</p>',
                                  
        'comment_notes_after' => '',
        
        'fields' => apply_filters('comment_form_default_fields', $fields),
    );
    
    comment_form($args);
    ?>
    
</div><!-- #comments -->

<?php
/**
 * قالب التعليق المخصص
 */
function muhtawaa_comment_template($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            
            <!-- رأس التعليق -->
            <header class="comment-header">
                <!-- صورة الكاتب -->
                <div class="comment-author-avatar">
                    <?php echo get_avatar($comment, $args['avatar_size']); ?>
                </div>
                
                <!-- معلومات الكاتب -->
                <div class="comment-author-info">
                    <h4 class="comment-author-name">
                        <?php echo get_comment_author_link(); ?>
                        
                        <?php
                        // إضافة شارة للمؤلف
                        if ($comment->user_id && $comment->user_id == get_post()->post_author) {
                            echo '<span class="author-badge">' . __('المؤلف', 'muhtawaa') . '</span>';
                        }
                        ?>
                    </h4>
                    
                    <div class="comment-metadata">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            /* translators: 1: date, 2: time */
                            printf(esc_html__('%1$s في %2$s', 'muhtawaa'), get_comment_date(), get_comment_time());
                            ?>
                        </time>
                        
                        <?php edit_comment_link(__('(تعديل)', 'muhtawaa'), '  ', ''); ?>
                    </div>
                    
                    <!-- التقييم إن وجد -->
                    <?php
                    $rating = get_comment_meta(get_comment_ID(), 'rating', true);
                    if ($rating) :
                    ?>
                    <div class="comment-rating" data-rating="<?php echo esc_attr($rating); ?>">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if ($i <= $rating) : ?>
                                <i class="fas fa-star"></i>
                            <?php else : ?>
                                <i class="far fa-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </header>
            
            <!-- محتوى التعليق -->
            <div class="comment-content">
                <?php if ($comment->comment_approved == '0') : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('تعليقك في انتظار الموافقة.', 'muhtawaa'); ?></p>
                <?php endif; ?>
                
                <?php comment_text(); ?>
            </div>
            
            <!-- أزرار التفاعل -->
            <footer class="comment-footer">
                <div class="comment-actions">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<span class="reply-link">',
                        'after'     => '</span>',
                    )));
                    ?>
                    
                    <!-- زر الإعجاب -->
                    <button class="comment-like-button" data-comment-id="<?php comment_ID(); ?>">
                        <i class="far fa-thumbs-up"></i>
                        <span class="like-count"><?php echo intval(get_comment_meta(get_comment_ID(), 'likes', true)); ?></span>
                    </button>
                    
                    <!-- زر الإبلاغ -->
                    <?php if (is_user_logged_in()) : ?>
                    <button class="comment-report-button" data-comment-id="<?php comment_ID(); ?>">
                        <i class="fas fa-flag"></i>
                        <?php esc_html_e('إبلاغ', 'muhtawaa'); ?>
                    </button>
                    <?php endif; ?>
                </div>
            </footer>
            
        </article><!-- .comment-body -->
        
        <?php
        // لا نغلق <li> هنا لأن WordPress سيفعل ذلك تلقائياً
}
?>