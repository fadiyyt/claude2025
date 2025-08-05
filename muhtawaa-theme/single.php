<?php
/**
 * قالب المقالة المفردة
 * Single Post Template
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container">
            
            <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> data-id="<?php the_ID(); ?>">
                
                <!-- رأس المقالة -->
                <header class="entry-header">
                    <!-- التصنيفات -->
                    <?php if (has_category()) : ?>
                    <div class="entry-categories">
                        <?php the_category(' '); ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- العنوان -->
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <!-- معلومات المقالة -->
                    <div class="entry-meta">
                        <!-- الكاتب -->
                        <span class="meta-item author-meta">
                            <i class="fas fa-user"></i>
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
                        
                        <!-- التاريخ -->
                        <span class="meta-item date-meta">
                            <i class="fas fa-calendar-alt"></i>
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </span>
                        
                        <!-- وقت القراءة -->
                        <span class="meta-item reading-time">
                            <i class="fas fa-clock"></i>
                            <?php echo muhtawaa_reading_time(); ?>
                        </span>
                        
                        <!-- عدد المشاهدات -->
                        <span class="meta-item views-count">
                            <i class="fas fa-eye"></i>
                            <?php echo muhtawaa_get_post_views(get_the_ID()); ?> مشاهدة
                        </span>
                        
                        <!-- التعليقات -->
                        <?php if (comments_open()) : ?>
                        <span class="meta-item comments-meta">
                            <i class="fas fa-comments"></i>
                            <a href="#comments">
                                <?php comments_number('لا توجد تعليقات', 'تعليق واحد', '% تعليقات'); ?>
                            </a>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- التقييم الإجمالي -->
                    <?php 
                    $average_rating = get_post_meta(get_the_ID(), '_muhtawaa_average_rating', true);
                    if ($average_rating) : 
                    ?>
                    <div class="post-rating">
                        <div class="rating-stars" data-rating="<?php echo esc_attr($average_rating); ?>">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php if ($i <= $average_rating) : ?>
                                    <i class="fas fa-star"></i>
                                <?php elseif ($i - 0.5 <= $average_rating) : ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php else : ?>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <span class="rating-count">(<?php echo muhtawaa_get_ratings_count(get_the_ID()); ?> تقييم)</span>
                    </div>
                    <?php endif; ?>
                </header>
                
                <!-- الصورة البارزة -->
                <?php if (has_post_thumbnail()) : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                    <?php if (get_post(get_post_thumbnail_id())->post_excerpt) : ?>
                    <p class="thumbnail-caption"><?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- محتوى المقالة -->
                <div class="entry-content">
                    <?php
                    // عرض المحتوى
                    the_content();
                    
                    // روابط التنقل بين الصفحات
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('الصفحات:', 'muhtawaa'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
                
                <!-- ذيل المقالة -->
                <footer class="entry-footer">
                    <!-- الوسوم -->
                    <?php if (has_tag()) : ?>
                    <div class="post-tags">
                        <i class="fas fa-tags"></i>
                        <?php the_tags('', '', ''); ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- مشاركة المقالة -->
                    <div class="social-share">
                        <h4>شارك هذه المقالة:</h4>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                               target="_blank" 
                               class="share-button facebook"
                               title="شارك على فيسبوك">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               class="share-button twitter"
                               title="شارك على تويتر">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" 
                               target="_blank" 
                               class="share-button whatsapp"
                               title="شارك على واتساب">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               class="share-button linkedin"
                               title="شارك على لينكد إن">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="mailto:?subject=<?php echo rawurlencode(get_the_title()); ?>&body=<?php echo rawurlencode(get_the_title() . "\n\n" . get_permalink()); ?>" 
                               class="share-button email"
                               title="شارك عبر البريد الإلكتروني">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <button class="share-button copy-link" 
                                    data-url="<?php echo esc_url(get_permalink()); ?>"
                                    title="نسخ الرابط">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </footer>
                
                <!-- معلومات الكاتب -->
                <div class="author-bio">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                    </div>
                    <div class="author-info">
                        <h3>
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php the_author(); ?>
                            </a>
                        </h3>
                        <?php if (get_the_author_meta('description')) : ?>
                        <p><?php the_author_meta('description'); ?></p>
                        <?php endif; ?>
                        
                        <!-- روابط التواصل الاجتماعي للكاتب -->
                        <div class="author-social">
                            <?php
                            $social_links = array(
                                'twitter' => get_the_author_meta('twitter'),
                                'facebook' => get_the_author_meta('facebook'),
                                'linkedin' => get_the_author_meta('linkedin'),
                                'instagram' => get_the_author_meta('instagram'),
                            );
                            
                            foreach ($social_links as $network => $url) :
                                if ($url) :
                            ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" class="author-social-link">
                                <i class="fab fa-<?php echo esc_attr($network); ?>"></i>
                            </a>
                            <?php 
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- التنقل بين المقالات -->
                <nav class="post-navigation">
                    <div class="nav-links">
                        <div class="nav-previous">
                            <?php
                            $prev_post = get_previous_post();
                            if ($prev_post) :
                            ?>
                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" rel="prev">
                                <span class="nav-subtitle">المقالة السابقة</span>
                                <span class="nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                            </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="nav-next">
                            <?php
                            $next_post = get_next_post();
                            if ($next_post) :
                            ?>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" rel="next">
                                <span class="nav-subtitle">المقالة التالية</span>
                                <span class="nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
                
                <!-- التوصيات الذكية -->
                <section class="smart-recommendations" style="display: none;">
                    <h2 class="section-title">
                        <i class="fas fa-lightbulb"></i>
                        قد يعجبك أيضاً
                    </h2>
                    <div class="smart-recommendations-grid">
                        <!-- سيتم ملؤها بواسطة JavaScript -->
                    </div>
                </section>
                
                <!-- المقالات ذات الصلة -->
                <?php
                $related_posts = muhtawaa_get_related_posts(get_the_ID(), 3);
                if ($related_posts->have_posts()) :
                ?>
                <section class="related-posts">
                    <h2 class="section-title">
                        <i class="fas fa-th-large"></i>
                        مقالات ذات صلة
                    </h2>
                    <div class="related-posts-grid">
                        <?php
                        while ($related_posts->have_posts()) :
                            $related_posts->the_post();
                        ?>
                        <article class="related-post">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="related-post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <div class="related-post-content">
                                <h3 class="related-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="related-post-meta">
                                    <span class="date"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </article>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php endif; ?>
                
                <!-- التعليقات -->
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            </article>
            
            <?php endwhile; ?>
            
            <!-- الشريط الجانبي -->
            <?php get_sidebar(); ?>
            
        </div>
    </main>
</div>

<!-- معلومات منظمة للمقالة (Schema.org) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo esc_js(get_the_title()); ?>",
    "description": "<?php echo esc_js(get_the_excerpt()); ?>",
    "image": "<?php echo esc_js(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>",
    "datePublished": "<?php echo esc_js(get_the_date('c')); ?>",
    "dateModified": "<?php echo esc_js(get_the_modified_date('c')); ?>",
    "author": {
        "@type": "Person",
        "name": "<?php echo esc_js(get_the_author()); ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_js(get_theme_mod('custom_logo') ? wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0] : ''); ?>"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo esc_js(get_permalink()); ?>"
    }
}
</script>

<?php get_footer(); ?>