<?php
/**
 * قالب الصفحة الرئيسية المتطور - الجزء الأول
 * Front Page Template - Part 1: Main Structure
 * 
 * @package Muhtawaa
 * @version 2.0
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main muhtawaa-content" role="main">
        
        <!-- قسم البطل الرئيسي -->
        <section class="hero-section">
            <div class="hero-background">
                <div class="hero-overlay"></div>
                <div class="hero-particles"></div>
            </div>
            
            <div class="container">
                <div class="hero-content">
                    <div class="row align-items-center min-vh-100">
                        <div class="col-lg-6">
                            <div class="hero-text">
                                <h1 class="hero-title fade-in-up">
                                    <?php 
                                    $hero_title = get_theme_mod('hero_title', 'مرحباً بك في محتوى');
                                    echo esc_html($hero_title);
                                    ?>
                                    <span class="text-highlight">الحلول اليومية</span>
                                </h1>
                                
                                <p class="hero-subtitle fade-in-up" style="animation-delay: 0.2s;">
                                    <?php 
                                    $hero_subtitle = get_theme_mod('hero_subtitle', 'نقدم لك أفضل الحلول العملية والمفيدة للحياة اليومية مع محتوى متطور وتجربة مستخدم رائعة');
                                    echo esc_html($hero_subtitle);
                                    ?>
                                </p>
                                
                                <div class="hero-stats fade-in-up" style="animation-delay: 0.4s;">
                                    <div class="stat-item">
                                        <div class="stat-number counter" data-target="<?php echo wp_count_posts()->publish; ?>">0</div>
                                        <div class="stat-label">مقال مفيد</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number counter" data-target="<?php echo wp_count_comments()->approved; ?>">0</div>
                                        <div class="stat-label">تعليق</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number counter" data-target="<?php echo wp_count_terms('category', array('hide_empty' => true)); ?>">0</div>
                                        <div class="stat-label">فئة</div>
                                    </div>
                                </div>
                                
                                <div class="hero-actions fade-in-up" style="animation-delay: 0.6s;">
                                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-primary btn-lg muhtawaa-btn">
                                        <i class="fas fa-rocket"></i>
                                        استكشف المحتوى
                                    </a>
                                    <a href="#about-section" class="btn btn-outline btn-lg">
                                        <i class="fas fa-info-circle"></i>
                                        تعرف علينا
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="hero-image fade-in-right">
                                <?php if (get_theme_mod('hero_image')) : ?>
                                    <img src="<?php echo esc_url(get_theme_mod('hero_image')); ?>" 
                                         alt="<?php echo esc_attr($hero_title); ?>" 
                                         class="img-fluid hero-main-image"
                                         loading="eager">
                                <?php else : ?>
                                    <div class="hero-illustration">
                                        <div class="floating-card" style="--delay: 0s;">
                                            <i class="fas fa-lightbulb"></i>
                                            <span>أفكار مبتكرة</span>
                                        </div>
                                        <div class="floating-card" style="--delay: 0.5s;">
                                            <i class="fas fa-tools"></i>
                                            <span>حلول عملية</span>
                                        </div>
                                        <div class="floating-card" style="--delay: 1s;">
                                            <i class="fas fa-chart-line"></i>
                                            <span>نتائج مضمونة</span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- مؤشر التمرير -->
            <div class="scroll-indicator">
                <div class="scroll-mouse">
                    <div class="scroll-wheel"></div>
                </div>
                <p>تمرر لأسفل</p>
            </div>
        </section>

        <!-- قسم الميزات الرئيسية -->
        <section id="features-section" class="features-section section-padding">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-title">
                        <?php echo esc_html(get_theme_mod('features_title', 'لماذا تختار محتوى؟')); ?>
                    </h2>
                    <p class="section-subtitle">
                        <?php echo esc_html(get_theme_mod('features_subtitle', 'نقدم لك مجموعة متنوعة من الميزات التي تجعل تجربتك معنا استثنائية')); ?>
                    </p>
                    <div class="section-divider"></div>
                </div>
                
                <div class="row">
                    <?php
                    // الميزات الافتراضية
                    $default_features = array(
                        array(
                            'icon' => 'fas fa-bolt',
                            'title' => 'سرعة فائقة',
                            'description' => 'موقع محسن للأداء مع تحميل سريع وتجربة مستخدم ممتازة'
                        ),
                        array(
                            'icon' => 'fas fa-shield-alt',
                            'title' => 'أمان متقدم',
                            'description' => 'حماية عالية المستوى لبياناتك مع أحدث تقنيات الأمان'
                        ),
                        array(
                            'icon' => 'fas fa-mobile-alt',
                            'title' => 'تصميم متجاوب',
                            'description' => 'يعمل بشكل مثالي على جميع الأجهزة والشاشات'
                        ),
                        array(
                            'icon' => 'fas fa-search',
                            'title' => 'بحث ذكي',
                            'description' => 'نظام بحث متطور للعثور على المحتوى بسهولة'
                        ),
                        array(
                            'icon' => 'fas fa-heart',
                            'title' => 'واجهة جذابة',
                            'description' => 'تصميم عصري وأنيق يوفر تجربة بصرية رائعة'
                        ),
                        array(
                            'icon' => 'fas fa-headset',
                            'title' => 'دعم مستمر',
                            'description' => 'فريق دعم متاح دائماً لمساعدتك وحل مشاكلك'
                        )
                    );
                    
                    // عرض الميزات
                    foreach ($default_features as $index => $feature) :
                    ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="feature-card muhtawaa-card hover-lift" 
                                 data-aos="fade-up" 
                                 data-aos-delay="<?php echo $index * 100; ?>">
                                <div class="feature-icon">
                                    <i class="<?php echo esc_attr($feature['icon']); ?>"></i>
                                </div>
                                <h3 class="feature-title"><?php echo esc_html($feature['title']); ?></h3>
                                <p class="feature-description"><?php echo esc_html($feature['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- قسم أحدث المقالات -->
        <section id="latest-posts-section" class="latest-posts-section section-padding bg-secondary">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-title">أحدث المقالات</h2>
                    <p class="section-subtitle">اكتشف أحدث المحتوى والحلول العملية</p>
                    <div class="section-divider"></div>
                </div>
                
                <div class="row">
                    <?php
                    // استعلام أحدث المقالات
                    $latest_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => '_thumbnail_id',
                                'compare' => 'EXISTS'
                            )
                        )
                    ));
                    
                    if ($latest_posts->have_posts()) :
                        $post_index = 0;
                        while ($latest_posts->have_posts()) : $latest_posts->the_post();
                            $post_index++;
                    ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <article class="post-card muhtawaa-card hover-lift" 
                                     data-aos="fade-up" 
                                     data-aos-delay="<?php echo $post_index * 100; ?>">
                                
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
                                        
                                        <!-- تصنيف المقال -->
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
                        endwhile;
                        wp_reset_postdata();
                    else : 
                    ?>
                        <div class="col-12 text-center">
                            <div class="no-posts-message">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h3>لا توجد مقالات بعد</h3>
                                <p class="text-muted">ابدأ بكتابة مقالك الأول!</p>
                                <?php if (current_user_can('publish_posts')) : ?>
                                    <a href="<?php echo admin_url('post-new.php'); ?>" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        إضافة مقال جديد
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($latest_posts->found_posts > 6) : ?>
                    <div class="text-center mt-5">
                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" 
                           class="btn btn-outline btn-lg">
                            <i class="fas fa-th-large"></i>
                            عرض جميع المقالات
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <?php
        // استدعاء الجزء الثاني
        get_template_part('template-parts/front-page', 'part2');
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>