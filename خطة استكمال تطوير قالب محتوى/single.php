<?php
/**
 * صفحة المقال المفرد - قالب محتوى المطور
 * 
 * @package Muhtawaa
 * @version 2.0
 * @since 1.0.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

get_header(); ?>

<div class="site-content single-post-content">
    <div class="container">
        <div class="content-layout">
            
            <!-- المحتوى الرئيسي -->
            <main class="main-content" id="primary">
                
                <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    
                    <!-- رأس المقال -->
                    <header class="entry-header">
                        
                        <!-- معلومات المقال العلوية -->
                        <div class="entry-meta-top">
                            <div class="meta-categories">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    foreach ($categories as $category) {
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="meta-category">' . esc_html($category->name) . '</a>';
                                    }
                                }
                                ?>
                            </div>
                            
                            <!-- معلومات الصعوبة والوقت -->
                            <div class="meta-info">
                                <?php if ($difficulty = get_post_meta(get_the_ID(), '_muhtawaa_difficulty', true)) : ?>
                                <span class="difficulty-badge difficulty-<?php echo esc_attr($difficulty); ?>">
                                    <?php echo muhtawaa_get_difficulty_label($difficulty); ?>
                                </span>
                                <?php endif; ?>
                                
                                <span class="read-time">
                                    <svg viewBox="0 0 24 24" width="16" height="16">
                                        <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                    </svg>
                                    <?php echo muhtawaa_get_read_time() . ' ' . __('دقائق قراءة', 'muhtawaa'); ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- عنوان المقال -->
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
                        <!-- ملخص المقال -->
                        <?php if (has_excerpt()) : ?>
                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- معلومات المقال السفلية -->
                        <div class="entry-meta-bottom">
                            <div class="author-info">
                                <div class="author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
                                </div>
                                <div class="author-details">
                                    <span class="author-name">
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                    <div class="publish-info">
                                        <time datetime="<?php echo get_the_date('c'); ?>" class="published-date">
                                            <?php echo muhtawaa_get_arabic_date(); ?>
                                        </time>
                                        
                                        <?php if (get_the_modified_date() !== get_the_date()) : ?>
                                        <time datetime="<?php echo get_the_modified_date('c'); ?>" class="updated-date">
                                            <?php printf(__('آخر تحديث: %s', 'muhtawaa'), muhtawaa_get_arabic_date(get_the_modified_date())); ?>
                                        </time>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- إحصائيات المقال -->
                            <div class="post-stats">
                                <span class="post-views">
                                    <svg viewBox="0 0 24 24" width="16" height="16">
                                        <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                    <?php echo muhtawaa_get_post_views(); ?> <?php _e('مشاهدة', 'muhtawaa'); ?>
                                </span>
                                
                                <span class="post-comments-link">
                                    <svg viewBox="0 0 24 24" width="16" height="16">
                                        <path fill="currentColor" d="M21.99 4c0-1.1-.89-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.89 2 2 2h14l4 4-.01-18z"/>
                                    </svg>
                                    <a href="#comments"><?php comments_number(__('بدون تعليقات', 'muhtawaa'), __('تعليق واحد', 'muhtawaa'), __('% تعليقات', 'muhtawaa')); ?></a>
                                </span>
                                
                                <!-- التقييم -->
                                <?php if (function_exists('muhtawaa_get_post_rating')) : ?>
                                <div class="post-rating-display">
                                    <?php echo muhtawaa_get_post_rating_stars(); ?>
                                    <span class="rating-average"><?php echo muhtawaa_get_post_rating_average(); ?></span>
                                    <span class="rating-count">(<?php echo muhtawaa_get_post_rating_count(); ?>)</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- أزرار المشاركة العلوية -->
                        <div class="post-share-top">
                            <span class="share-label"><?php _e('شارك المقال:', 'muhtawaa'); ?></span>
                            <?php echo muhtawaa_get_social_share_buttons(); ?>
                        </div>
                        
                    </header>
                    
                    <!-- صورة المقال المميزة -->
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php 
                        the_post_thumbnail('muhtawaa-large', array(
                            'alt' => get_the_title(),
                            'loading' => 'eager'
                        )); 
                        ?>
                        
                        <!-- وصف الصورة -->
                        <?php 
                        $thumbnail_caption = get_the_post_thumbnail_caption();
                        if ($thumbnail_caption) : ?>
                        <figcaption class="thumbnail-caption">
                            <?php echo esc_html($thumbnail_caption); ?>
                        </figcaption>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- محتوى المقال -->
                    <div class="entry-content">
                        
                        <!-- جدول المحتويات -->
                        <?php if (function_exists('muhtawaa_generate_toc') && get_theme_mod('show_table_of_contents', true)) : ?>
                        <div class="table-of-contents" id="table-of-contents">
                            <h3 class="toc-title">
                                <svg viewBox="0 0 24 24" width="20" height="20">
                                    <path fill="currentColor" d="M3,9H17V7H3V9M3,13H17V11H3V13M3,17H17V15H3V17M19,17H21V15H19V17M19,7V9H21V7H19M19,13H21V11H19V13Z"/>
                                </svg>
                                <?php _e('المحتويات', 'muhtawaa'); ?>
                                <button class="toc-toggle" aria-label="<?php _e('إظهار/إخفاء المحتويات', 'muhtawaa'); ?>">
                                    <svg viewBox="0 0 24 24" width="16" height="16">
                                        <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                    </svg>
                                </button>
                            </h3>
                            <div class="toc-content">
                                <?php echo muhtawaa_generate_toc(get_the_content()); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- المحتوى الفعلي -->
                        <div class="post-content-wrapper">
                            <?php
                            the_content();
                            
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('الصفحات:', 'muhtawaa'),
                                'after' => '</div>',
                                'pagelink' => '<span class="page-number">%</span>',
                            ));
                            ?>
                        </div>
                        
                        <!-- معلومات إضافية عن المقال -->
                        <?php 
                        $solution_steps = get_post_meta(get_the_ID(), '_muhtawaa_solution_steps', true);
                        $required_tools = get_post_meta(get_the_ID(), '_muhtawaa_required_tools', true);
                        $estimated_time = get_post_meta(get_the_ID(), '_muhtawaa_estimated_time', true);
                        ?>
                        
                        <?php if ($solution_steps || $required_tools || $estimated_time) : ?>
                        <div class="solution-info">
                            
                            <?php if ($solution_steps) : ?>
                            <div class="solution-steps">
                                <h3><?php _e('خطوات الحل:', 'muhtawaa'); ?></h3>
                                <div class="steps-content">
                                    <?php echo wp_kses_post($solution_steps); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($required_tools) : ?>
                            <div class="required-tools">
                                <h3><?php _e('الأدوات المطلوبة:', 'muhtawaa'); ?></h3>
                                <div class="tools-content">
                                    <?php echo wp_kses_post($required_tools); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($estimated_time) : ?>
                            <div class="estimated-time">
                                <h3><?php _e('الوقت المتوقع:', 'muhtawaa'); ?></h3>
                                <span class="time-value"><?php echo esc_html($estimated_time); ?></span>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                        <?php endif; ?>
                        
                    </div>
                    
                    <!-- تذييل المقال -->
                    <footer class="entry-footer">
                        
                        <!-- الوسوم -->
                        <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <span class="tags-label">
                                <svg viewBox="0 0 24 24" width="16" height="16">
                                    <path fill="currentColor" d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7V17C3 18.1 3.9 19 5 19H16C16.67 19 17.27 18.67 17.63 18.16L22 12L17.63 5.84Z"/>
                                </svg>
                                <?php _e('الوسوم:', 'muhtawaa'); ?>
                            </span>
                            <?php the_tags('', '', ''); ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- أزرار المشاركة السفلية -->
                        <div class="post-share-bottom">
                            <h3><?php _e('شارك هذا المقال', 'muhtawaa'); ?></h3>
                            <?php echo muhtawaa_get_social_share_buttons(true); ?>
                        </div>
                        
                        <!-- نظام التقييم -->
                        <?php if (function_exists('muhtawaa_display_rating_form')) : ?>
                        <div class="post-rating-section">
                            <h3><?php _e('قيم هذا المقال', 'muhtawaa'); ?></h3>
                            <?php muhtawaa_display_rating_form(get_the_ID()); ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- معلومات المؤلف -->
                        <div class="author-bio">
                            <div class="author-avatar-large">
                                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                            </div>
                            <div class="author-info-detailed">
                                <h3 class="author-title">
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php the_author(); ?>
                                    </a>
                                </h3>
                                <p class="author-description">
                                    <?php 
                                    $author_description = get_the_author_meta('description');
                                    if ($author_description) {
                                        echo esc_html($author_description);
                                    } else {
                                        printf(__('كاتب في موقع %s', 'muhtawaa'), get_bloginfo('name'));
                                    }
                                    ?>
                                </p>
                                <div class="author-stats">
                                    <span class="author-posts-count">
                                        <?php printf(__('%d مقالة منشورة', 'muhtawaa'), count_user_posts(get_the_author_meta('ID'))); ?>
                                    </span>
                                    
                                    <!-- روابط وسائل التواصل للمؤلف -->
                                    <?php
                                    $author_social = array(
                                        'facebook' => get_the_author_meta('facebook'),
                                        'twitter' => get_the_author_meta('twitter'),
                                        'linkedin' => get_the_author_meta('linkedin'),
                                        'website' => get_the_author_meta('url')
                                    );
                                    
                                    if (array_filter($author_social)) : ?>
                                    <div class="author-social">
                                        <?php foreach ($author_social as $platform => $url) : ?>
                                            <?php if ($url) : ?>
                                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="author-social-link author-<?php echo $platform; ?>">
                                                <span class="screen-reader-text"><?php printf(__('%s على %s', 'muhtawaa'), get_the_author(), ucfirst($platform)); ?></span>
                                            </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                    </footer>
                    
                </article>
                
                <!-- التنقل بين المقالات -->
                <nav class="post-navigation" role="navigation" aria-label="<?php _e('التنقل بين المقالات', 'muhtawaa'); ?>">
                    <div class="nav-links">
                        
                        <?php 
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        
                        <?php if ($prev_post) : ?>
                        <div class="nav-previous">
                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" rel="prev">
                                <div class="nav-direction">
                                    <svg viewBox="0 0 24 24" width="20" height="20">
                                        <path fill="currentColor" d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
                                    </svg>
                                    <?php _e('المقال السابق', 'muhtawaa'); ?>
                                </div>
                                <div class="nav-content">
                                    <?php if (has_post_thumbnail($prev_post->ID)) : ?>
                                    <div class="nav-thumbnail">
                                        <?php echo get_the_post_thumbnail($prev_post->ID, 'muhtawaa-thumbnail'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="nav-text">
                                        <h4 class="nav-title"><?php echo get_the_title($prev_post->ID); ?></h4>
                                        <span class="nav-date"><?php echo get_the_date('', $prev_post->ID); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" rel="next">
                                <div class="nav-direction">
                                    <?php _e('المقال التالي', 'muhtawaa'); ?>
                                    <svg viewBox="0 0 24 24" width="20" height="20">
                                        <path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                                    </svg>
                                </div>
                                <div class="nav-content">
                                    <?php if (has_post_thumbnail($next_post->ID)) : ?>
                                    <div class="nav-thumbnail">
                                        <?php echo get_the_post_thumbnail($next_post->ID, 'muhtawaa-thumbnail'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="nav-text">
                                        <h4 class="nav-title"><?php echo get_the_title($next_post->ID); ?></h4>
                                        <span class="nav-date"><?php echo get_the_date('', $next_post->ID); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </nav>
                
                <!-- المقالات ذات الصلة -->
                <?php
                $related_posts = muhtawaa_get_related_posts(get_the_ID(), 3);
                if ($related_posts->have_posts()) : ?>
                <section class="related-posts">
                    <h3 class="related-title">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                        <?php _e('مقالات ذات صلة', 'muhtawaa'); ?>
                    </h3>
                    
                    <div class="related-posts-grid">
                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                        <article class="related-post">
                            <div class="related-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('muhtawaa-medium', array('loading' => 'lazy')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <div class="related-content">
                                <div class="related-meta">
                                    <span class="related-category">
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name);
                                        }
                                        ?>
                                    </span>
                                    <span class="related-date"><?php echo muhtawaa_get_arabic_date(); ?></span>
                                </div>
                                
                                <h4 class="related-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                
                                <div class="related-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </div>
                                
                                <div class="related-stats">
                                    <span class="related-views">
                                        <svg viewBox="0 0 24 24" width="14" height="14">
                                            <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5z"/>
                                        </svg>
                                        <?php echo muhtawaa_get_post_views(); ?>
                                    </span>
                                    <span class="related-read-time">
                                        <?php echo muhtawaa_get_read_time() . ' ' . __('د', 'muhtawaa'); ?>
                                    </span>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </section>
                <?php endif; ?>
                
                <!-- التعليقات -->
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
                
                <?php endwhile; ?>
                
            </main>
            
            <!-- الشريط الجانبي -->
            <aside class="sidebar" id="secondary" role="complementary">
                <?php get_sidebar('single'); ?>
            </aside>
            
        </div>
    </div>
</div>

<!-- البيانات المنظمة للمقال -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo esc_js(get_the_title()); ?>",
    "description": "<?php echo esc_js(wp_trim_words(get_the_excerpt(), 25)); ?>",
    "image": {
        "@type": "ImageObject",
        "url": "<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>",
        "width": 1200,
        "height": 630
    },
    "author": {
        "@type": "Person",
        "name": "<?php echo esc_js(get_the_author()); ?>",
        "url": "<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?php bloginfo('name'); ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_url(get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : get_template_directory_uri() . '/assets/images/logo.png'); ?>"
        }
    },
    "datePublished": "<?php echo get_the_date('c'); ?>",
    "dateModified": "<?php echo get_the_modified_date('c'); ?>",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo esc_url(get_permalink()); ?>"
    },
    "inLanguage": "ar",
    "articleSection": "<?php echo esc_js(implode(', ', wp_get_post_categories(get_the_ID(), array('fields' => 'names')))); ?>",
    "keywords": "<?php echo esc_js(implode(', ', wp_get_post_tags(get_the_ID(), array('fields' => 'names')))); ?>",
    "wordCount": "<?php echo str_word_count(strip_tags(get_the_content())); ?>",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo function_exists('muhtawaa_get_post_rating_average') ? muhtawaa_get_post_rating_average() : '0'; ?>",
        "reviewCount": "<?php echo function_exists('muhtawaa_get_post_rating_count') ? muhtawaa_get_post_rating_count() : '0'; ?>"
    }
}
</script>

<?php get_footer(); ?>