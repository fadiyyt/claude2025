<?php
/**
 * الصفحة الرئيسية - قالب محتوى المطور
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

get_header(); ?>

<div class="site-content">
    <div class="container">
        <div class="content-layout">
            
            <!-- المحتوى الرئيسي -->
            <div class="main-content">
                
                <!-- قسم المقالات المميزة -->
                <?php if (is_home() || is_front_page()) : ?>
                <section class="featured-posts">
                    <div class="section-header">
                        <h2 class="section-title">
                            <span class="title-icon">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="currentColor" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            </span>
                            <?php _e('المقالات المميزة', 'muhtawaa'); ?>
                        </h2>
                        <p class="section-description"><?php _e('تصفح أحدث الحلول والمقالات المفيدة', 'muhtawaa'); ?></p>
                    </div>
                    
                    <div class="featured-posts-grid">
                        <?php
                        // استعلام المقالات المميزة
                        $featured_query = new WP_Query(array(
                            'posts_per_page' => 6,
                            'meta_query' => array(
                                array(
                                    'key' => '_muhtawaa_featured',
                                    'value' => '1',
                                    'compare' => '='
                                )
                            ),
                            'post_status' => 'publish'
                        ));
                        
                        if ($featured_query->have_posts()) :
                            $post_count = 0;
                            while ($featured_query->have_posts()) : $featured_query->the_post();
                                $post_count++;
                                $featured_class = ($post_count === 1) ? 'featured-large' : 'featured-small';
                        ?>
                        
                        <article class="featured-post <?php echo $featured_class; ?>">
                            <div class="post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" aria-label="<?php printf(__('اقرأ المقال: %s', 'muhtawaa'), get_the_title()); ?>">
                                        <?php 
                                        if ($post_count === 1) {
                                            the_post_thumbnail('muhtawaa-featured-large', array('loading' => 'eager'));
                                        } else {
                                            the_post_thumbnail('muhtawaa-medium', array('loading' => 'lazy'));
                                        }
                                        ?>
                                    </a>
                                <?php else : ?>
                                    <div class="post-thumbnail-placeholder">
                                        <svg viewBox="0 0 24 24" width="48" height="48">
                                            <path fill="currentColor" d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- علامة المقال المميز -->
                                <span class="featured-badge">
                                    <svg viewBox="0 0 24 24" width="16" height="16">
                                        <path fill="currentColor" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                    <?php _e('مميز', 'muhtawaa'); ?>
                                </span>
                                
                                <!-- معلومات الصعوبة -->
                                <?php if ($difficulty = get_post_meta(get_the_ID(), '_muhtawaa_difficulty', true)) : ?>
                                <span class="difficulty-badge difficulty-<?php echo esc_attr($difficulty); ?>">
                                    <?php echo muhtawaa_get_difficulty_label($difficulty); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-category">
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                        }
                                        ?>
                                    </span>
                                    <span class="post-date">
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo muhtawaa_get_arabic_date(); ?>
                                        </time>
                                    </span>
                                    <span class="post-read-time">
                                        <?php echo muhtawaa_get_read_time() . ' ' . __('دقائق قراءة', 'muhtawaa'); ?>
                                    </span>
                                </div>
                                
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <?php if ($post_count === 1) : ?>
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="post-footer">
                                    <div class="post-stats">
                                        <!-- التقييم -->
                                        <?php if (function_exists('muhtawaa_get_post_rating')) : ?>
                                        <span class="post-rating">
                                            <?php echo muhtawaa_get_post_rating_stars(); ?>
                                            <span class="rating-count">(<?php echo muhtawaa_get_post_rating_count(); ?>)</span>
                                        </span>
                                        <?php endif; ?>
                                        
                                        <!-- المشاهدات -->
                                        <span class="post-views">
                                            <svg viewBox="0 0 24 24" width="14" height="14">
                                                <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                            <?php echo muhtawaa_get_post_views(); ?>
                                        </span>
                                        
                                        <!-- التعليقات -->
                                        <span class="post-comments">
                                            <svg viewBox="0 0 24 24" width="14" height="14">
                                                <path fill="currentColor" d="M21.99 4c0-1.1-.89-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.89 2 2 2h14l4 4-.01-18z"/>
                                            </svg>
                                            <?php comments_number('0', '1', '%'); ?>
                                        </span>
                                    </div>
                                    
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        <?php _e('اقرأ المزيد', 'muhtawaa'); ?>
                                        <svg viewBox="0 0 24 24" width="16" height="16">
                                            <path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        
                        <?php endwhile; wp_reset_postdata(); ?>
                        <?php else : ?>
                        
                        <div class="no-featured-posts">
                            <div class="no-content-message">
                                <svg viewBox="0 0 24 24" width="48" height="48">
                                    <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <h3><?php _e('لا توجد مقالات مميزة حالياً', 'muhtawaa'); ?></h3>
                                <p><?php _e('سيتم عرض المقالات المميزة هنا عند إضافتها', 'muhtawaa'); ?></p>
                            </div>
                        </div>
                        
                        <?php endif; ?>
                    </div>
                </section>
                <?php endif; ?>
                
                <!-- قسم أحدث المقالات -->
                <section class="latest-posts">
                    <div class="section-header">
                        <h2 class="section-title">
                            <span class="title-icon">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="currentColor" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </span>
                            <?php _e('أحدث المقالات', 'muhtawaa'); ?>
                        </h2>
                        <p class="section-description"><?php _e('آخر الحلول والمقالات المنشورة على الموقع', 'muhtawaa'); ?></p>
                    </div>
                    
                    <div class="posts-grid">
                        <?php if (have_posts()) : ?>
                            
                            <?php 
                            // تحديد عدد المقالات حسب الصفحة
                            $posts_per_page = get_option('posts_per_page', 10);
                            
                            // استعلام المقالات العادية (غير المميزة في الصفحة الرئيسية)
                            if (is_home() || is_front_page()) {
                                global $wp_query;
                                $wp_query = new WP_Query(array(
                                    'posts_per_page' => $posts_per_page,
                                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                                    'meta_query' => array(
                                        'relation' => 'OR',
                                        array(
                                            'key' => '_muhtawaa_featured',
                                            'value' => '1',
                                            'compare' => '!='
                                        ),
                                        array(
                                            'key' => '_muhtawaa_featured',
                                            'compare' => 'NOT EXISTS'
                                        )
                                    ),
                                    'post_status' => 'publish'
                                ));
                            }
                            ?>
                            
                            <?php while (have_posts()) : the_post(); ?>
                            
                            <article <?php post_class('post-card'); ?>>
                                
                                <div class="post-thumbnail">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" aria-label="<?php printf(__('اقرأ المقال: %s', 'muhtawaa'), get_the_title()); ?>">
                                            <?php the_post_thumbnail('muhtawaa-medium', array('loading' => 'lazy')); ?>
                                        </a>
                                    <?php else : ?>
                                        <div class="post-thumbnail-placeholder">
                                            <svg viewBox="0 0 24 24" width="48" height="48">
                                                <path fill="currentColor" d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- معلومات الصعوبة -->
                                    <?php if ($difficulty = get_post_meta(get_the_ID(), '_muhtawaa_difficulty', true)) : ?>
                                    <span class="difficulty-badge difficulty-<?php echo esc_attr($difficulty); ?>">
                                        <?php echo muhtawaa_get_difficulty_label($difficulty); ?>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span class="post-category">
                                            <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                        </span>
                                        <span class="post-date">
                                            <time datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo muhtawaa_get_arabic_date(); ?>
                                            </time>
                                        </span>
                                        <span class="post-read-time">
                                            <?php echo muhtawaa_get_read_time() . ' ' . __('دقائق قراءة', 'muhtawaa'); ?>
                                        </span>
                                    </div>
                                    
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <div class="post-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>
                                    
                                    <div class="post-footer">
                                        <div class="post-stats">
                                            <!-- التقييم -->
                                            <?php if (function_exists('muhtawaa_get_post_rating')) : ?>
                                            <span class="post-rating">
                                                <?php echo muhtawaa_get_post_rating_stars(); ?>
                                                <span class="rating-count">(<?php echo muhtawaa_get_post_rating_count(); ?>)</span>
                                            </span>
                                            <?php endif; ?>
                                            
                                            <!-- المشاهدات -->
                                            <span class="post-views">
                                                <svg viewBox="0 0 24 24" width="14" height="14">
                                                    <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                                </svg>
                                                <?php echo muhtawaa_get_post_views(); ?>
                                            </span>
                                            
                                            <!-- التعليقات -->
                                            <span class="post-comments">
                                                <svg viewBox="0 0 24 24" width="14" height="14">
                                                    <path fill="currentColor" d="M21.99 4c0-1.1-.89-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.89 2 2 2h14l4 4-.01-18z"/>
                                                </svg>
                                                <?php comments_number('0', '1', '%'); ?>
                                            </span>
                                        </div>
                                        
                                        <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                            <?php _e('اقرأ المزيد', 'muhtawaa'); ?>
                                            <svg viewBox="0 0 24 24" width="16" height="16">
                                                <path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            
                            <?php endwhile; ?>
                            
                            <!-- التنقل بين الصفحات -->
                            <div class="pagination-wrapper">
                                <?php
                                echo paginate_links(array(
                                    'prev_text' => '<svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>' . __('السابق', 'muhtawaa'),
                                    'next_text' => __('التالي', 'muhtawaa') . '<svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>',
                                    'before_page_number' => '<span class="screen-reader-text">' . __('الصفحة', 'muhtawaa') . ' </span>',
                                    'mid_size' => 2,
                                    'type' => 'list'
                                ));
                                ?>
                            </div>
                            
                        <?php else : ?>
                        
                        <!-- رسالة عدم وجود محتوى -->
                        <div class="no-posts-found">
                            <div class="no-content-message">
                                <svg viewBox="0 0 24 24" width="64" height="64">
                                    <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <h3><?php _e('لا توجد مقالات لعرضها', 'muhtawaa'); ?></h3>
                                <p><?php _e('عذراً، لا توجد مقالات منشورة في الوقت الحالي. يرجى المحاولة لاحقاً.', 'muhtawaa'); ?></p>
                                
                                <?php if (current_user_can('publish_posts')) : ?>
                                <a href="<?php echo admin_url('post-new.php'); ?>" class="btn btn-primary">
                                    <?php _e('إضافة مقال جديد', 'muhtawaa'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php endif; ?>
                        
                    </div>
                </section>
                
                <!-- قسم التصنيفات الشائعة -->
                <?php if (is_home() || is_front_page()) : ?>
                <section class="popular-categories">
                    <div class="section-header">
                        <h2 class="section-title">
                            <span class="title-icon">
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="currentColor" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </span>
                            <?php _e('التصنيفات الشائعة', 'muhtawaa'); ?>
                        </h2>
                        <p class="section-description"><?php _e('تصفح المقالات حسب التصنيفات المختلفة', 'muhtawaa'); ?></p>
                    </div>
                    
                    <div class="categories-grid">
                        <?php
                        $popular_categories = get_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 8,
                            'hide_empty' => true
                        ));
                        
                        if ($popular_categories) :
                            foreach ($popular_categories as $category) :
                                $category_color = get_term_meta($category->term_id, '_muhtawaa_category_color', true);
                                $category_icon = get_term_meta($category->term_id, '_muhtawaa_category_icon', true);
                        ?>
                        
                        <div class="category-card" style="<?php echo $category_color ? '--category-color: ' . esc_attr($category_color) : ''; ?>">
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-link">
                                <div class="category-icon">
                                    <?php if ($category_icon) : ?>
                                        <img src="<?php echo esc_url($category_icon); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy">
                                    <?php else : ?>
                                        <svg viewBox="0 0 24 24" width="32" height="32">
                                            <path fill="currentColor" d="M10 4H4c-1.11 0-2 .89-2 2v6c0 1.11.89 2 2 2h6c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm10 0h-6c-1.11 0-2 .89-2 2v6c0 1.11.89 2 2 2h6c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zM10 14H4c-1.11 0-2 .89-2 2v6c0 1.11.89 2 2 2h6c1.11 0 2-.89 2-2v-6c0-1.11-.89-2-2-2zm10 0h-6c-1.11 0-2 .89-2 2v6c0 1.11.89 2 2 2h6c1.11 0 2-.89 2-2v-6c0-1.11-.89-2-2-2z"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="category-content">
                                    <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                                    <p class="category-description">
                                        <?php 
                                        $description = $category->description;
                                        if ($description) {
                                            echo wp_trim_words($description, 10, '...');
                                        } else {
                                            printf(__('%d مقالة متوفرة', 'muhtawaa'), $category->count);
                                        }
                                        ?>
                                    </p>
                                    <span class="category-count"><?php printf(__('%d مقالة', 'muhtawaa'), $category->count); ?></span>
                                </div>
                            </a>
                        </div>
                        
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
                <?php endif; ?>
                
            </div>
            
            <!-- الشريط الجانبي -->
            <aside class="sidebar" id="secondary" role="complementary">
                <?php get_sidebar(); ?>
            </aside>
            
        </div>
    </div>
</div>

<!-- مخطط البيانات المنظمة للصفحة الرئيسية -->
<?php if (is_home() || is_front_page()) : ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Blog",
    "name": "<?php bloginfo('name'); ?>",
    "description": "<?php bloginfo('description'); ?>",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "inLanguage": "ar",
    "author": {
        "@type": "Organization",
        "name": "<?php bloginfo('name'); ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?php bloginfo('name'); ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_url(get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : get_template_directory_uri() . '/assets/images/logo.png'); ?>"
        }
    }
}
</script>
<?php endif; ?>

<?php get_footer(); ?>