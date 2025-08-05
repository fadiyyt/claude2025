<?php
/**
 * الشريط الجانبي
 * The Sidebar
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// التحقق من وجود ويدجت نشطة
if (!is_active_sidebar('main-sidebar') && 
    !is_active_sidebar('solutions-sidebar') && 
    !is_active_sidebar('pages-sidebar')) {
    return;
}

// تحديد الشريط الجانبي المناسب
$sidebar_id = 'main-sidebar'; // الافتراضي

if (is_singular('solution') || is_post_type_archive('solution')) {
    $sidebar_id = 'solutions-sidebar';
} elseif (is_page()) {
    $sidebar_id = 'pages-sidebar';
}

// السماح بتخصيص الشريط الجانبي
$sidebar_id = apply_filters('muhtawaa_sidebar_id', $sidebar_id);
?>

<aside id="secondary" class="widget-area" role="complementary">
    
    <?php if (is_active_sidebar($sidebar_id)) : ?>
        
        <?php dynamic_sidebar($sidebar_id); ?>
        
    <?php else : ?>
        
        <!-- ويدجت افتراضية إذا لم يكن هناك ويدجت نشطة -->
        <div class="widget widget_search">
            <h3 class="widget-title"><?php esc_html_e('بحث', 'muhtawaa'); ?></h3>
            <?php get_search_form(); ?>
        </div>
        
        <div class="widget widget_recent_posts">
            <h3 class="widget-title"><?php esc_html_e('أحدث المقالات', 'muhtawaa'); ?></h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                
                foreach ($recent_posts as $post) :
                    $post_id = $post['ID'];
                ?>
                <li>
                    <a href="<?php echo get_permalink($post_id); ?>">
                        <?php echo esc_html($post['post_title']); ?>
                    </a>
                    <span class="post-date"><?php echo get_the_date('', $post_id); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="widget widget_categories">
            <h3 class="widget-title"><?php esc_html_e('التصنيفات', 'muhtawaa'); ?></h3>
            <ul>
                <?php
                wp_list_categories(array(
                    'orderby'    => 'name',
                    'title_li'   => '',
                    'show_count' => true,
                ));
                ?>
            </ul>
        </div>
        
        <div class="widget widget_tag_cloud">
            <h3 class="widget-title"><?php esc_html_e('الوسوم', 'muhtawaa'); ?></h3>
            <?php wp_tag_cloud(); ?>
        </div>
        
    <?php endif; ?>
    
    <!-- ويدجت إضافية مخصصة -->
    <?php
    // ويدجت الإحصائيات
    if (function_exists('muhtawaa_stats_widget')) :
    ?>
    <div class="widget widget_stats">
        <h3 class="widget-title">
            <i class="fas fa-chart-bar"></i>
            <?php esc_html_e('إحصائيات الموقع', 'muhtawaa'); ?>
        </h3>
        <div class="stats-content">
            <?php muhtawaa_stats_widget(); ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- ويدجت النشرة البريدية -->
    <?php if (is_active_sidebar('newsletter-area')) : ?>
    <div class="widget widget_newsletter">
        <?php dynamic_sidebar('newsletter-area'); ?>
    </div>
    <?php else : ?>
    <div class="widget widget_newsletter">
        <h3 class="widget-title">
            <i class="fas fa-envelope"></i>
            <?php esc_html_e('النشرة البريدية', 'muhtawaa'); ?>
        </h3>
        <div class="newsletter-content">
            <p><?php esc_html_e('اشترك في نشرتنا البريدية لتصلك آخر المقالات والنصائح.', 'muhtawaa'); ?></p>
            <form class="newsletter-form" action="#" method="post">
                <input type="email" 
                       name="email" 
                       placeholder="<?php esc_attr_e('بريدك الإلكتروني', 'muhtawaa'); ?>" 
                       required>
                <button type="submit" class="btn btn-primary">
                    <?php esc_html_e('اشترك', 'muhtawaa'); ?>
                </button>
            </form>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- ويدجت المقالات الشائعة -->
    <div class="widget widget_popular_posts">
        <h3 class="widget-title">
            <i class="fas fa-fire"></i>
            <?php esc_html_e('الأكثر قراءة', 'muhtawaa'); ?>
        </h3>
        <ul class="popular-posts-list">
            <?php
            $popular_posts = new WP_Query(array(
                'posts_per_page' => 5,
                'meta_key' => '_muhtawaa_views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'post_status' => 'publish'
            ));
            
            if ($popular_posts->have_posts()) :
                $counter = 1;
                while ($popular_posts->have_posts()) :
                    $popular_posts->the_post();
            ?>
            <li class="popular-post-item">
                <span class="post-number"><?php echo $counter; ?></span>
                <div class="post-details">
                    <a href="<?php the_permalink(); ?>" class="post-title">
                        <?php the_title(); ?>
                    </a>
                    <div class="post-meta">
                        <span class="views">
                            <i class="fas fa-eye"></i>
                            <?php echo muhtawaa_get_post_views(get_the_ID()); ?>
                        </span>
                        <span class="date">
                            <?php echo get_the_date(); ?>
                        </span>
                    </div>
                </div>
            </li>
            <?php
                    $counter++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </div>
    
    <!-- ويدجت الإعلانات -->
    <?php if (is_active_sidebar('ads-area')) : ?>
    <div class="widget widget_ads">
        <?php dynamic_sidebar('ads-area'); ?>
    </div>
    <?php endif; ?>
    
    <!-- ويدجت التواصل الاجتماعي -->
    <div class="widget widget_social">
        <h3 class="widget-title">
            <i class="fas fa-share-alt"></i>
            <?php esc_html_e('تابعنا', 'muhtawaa'); ?>
        </h3>
        <div class="social-links">
            <?php
            $social_networks = array(
                'facebook' => array(
                    'icon' => 'fab fa-facebook-f',
                    'url' => get_theme_mod('muhtawaa_facebook_url', '#'),
                    'label' => 'Facebook'
                ),
                'twitter' => array(
                    'icon' => 'fab fa-twitter',
                    'url' => get_theme_mod('muhtawaa_twitter_url', '#'),
                    'label' => 'Twitter'
                ),
                'instagram' => array(
                    'icon' => 'fab fa-instagram',
                    'url' => get_theme_mod('muhtawaa_instagram_url', '#'),
                    'label' => 'Instagram'
                ),
                'youtube' => array(
                    'icon' => 'fab fa-youtube',
                    'url' => get_theme_mod('muhtawaa_youtube_url', '#'),
                    'label' => 'YouTube'
                ),
                'linkedin' => array(
                    'icon' => 'fab fa-linkedin-in',
                    'url' => get_theme_mod('muhtawaa_linkedin_url', '#'),
                    'label' => 'LinkedIn'
                ),
            );
            
            foreach ($social_networks as $network => $data) :
                if (!empty($data['url']) && $data['url'] !== '#') :
            ?>
            <a href="<?php echo esc_url($data['url']); ?>" 
               class="social-link <?php echo esc_attr($network); ?>" 
               target="_blank"
               rel="noopener noreferrer"
               title="<?php echo esc_attr($data['label']); ?>">
                <i class="<?php echo esc_attr($data['icon']); ?>"></i>
            </a>
            <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
    
</aside><!-- #secondary -->