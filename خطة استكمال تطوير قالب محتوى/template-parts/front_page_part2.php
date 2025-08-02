<?php
/**
 * قالب الصفحة الرئيسية - الجزء الثاني
 * Front Page Template - Part 2: Middle Sections
 * 
 * @package Muhtawaa
 * @version 2.0
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}
?>

<!-- قسم نبذة عن الموقع -->
<section id="about-section" class="about-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-content">
                    <h2 class="section-title">
                        <?php echo esc_html(get_theme_mod('about_title', 'من نحن؟')); ?>
                    </h2>
                    <p class="about-description">
                        <?php echo esc_html(get_theme_mod('about_description', 'نحن فريق متخصص في تقديم المحتوى المفيد والحلول العملية للحياة اليومية. هدفنا هو مساعدتك في العثور على الحلول المناسبة لمختلف التحديات التي تواجهها.')); ?>
                    </p>
                    
                    <div class="about-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>محتوى أصلي ومفيد</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>حلول عملية مجربة</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>تحديث مستمر</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>دعم مجتمعي</span>
                        </div>
                    </div>
                    
                    <div class="about-actions">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-info-circle"></i>
                            تعرف علينا أكثر
                        </a>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" 
                           class="btn btn-outline">
                            <i class="fas fa-envelope"></i>
                            تواصل معنا
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-image">
                    <?php if (get_theme_mod('about_image')) : ?>
                        <img src="<?php echo esc_url(get_theme_mod('about_image')); ?>" 
                             alt="نبذة عن الموقع" 
                             class="img-fluid rounded-lg">
                    <?php else : ?>
                        <div class="about-illustration">
                            <div class="stats-circle">
                                <div class="stat-item">
                                    <div class="stat-number counter" data-target="95">0</div>
                                    <div class="stat-label">رضا العملاء</div>
                                </div>
                            </div>
                            <div class="achievement-badges">
                                <div class="badge-item">
                                    <i class="fas fa-award"></i>
                                    <span>جودة عالية</span>
                                </div>
                                <div class="badge-item">
                                    <i class="fas fa-users"></i>
                                    <span>مجتمع نشط</span>
                                </div>
                                <div class="badge-item">
                                    <i class="fas fa-rocket"></i>
                                    <span>نمو سريع</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- قسم الفئات الرئيسية -->
<section id="categories-section" class="categories-section section-padding bg-secondary">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">فئات المحتوى</h2>
            <p class="section-subtitle">استكشف المحتوى حسب الفئات المختلفة</p>
            <div class="section-divider"></div>
        </div>
        
        <div class="row">
            <?php
            // جلب الفئات الرئيسية
            $categories = get_categories(array(
                'orderby' => 'count',
                'order' => 'DESC',
                'number' => 8,
                'hide_empty' => true
            ));
            
            if ($categories) :
                foreach ($categories as $index => $category) :
                    $category_color = get_term_meta($category->term_id, 'category_color', true);
                    if (!$category_color) {
                        $colors = ['#667eea', '#764ba2', '#f093fb', '#48bb78', '#ed8936', '#f56565', '#4299e1', '#9f7aea'];
                        $category_color = $colors[$index % count($colors)];
                    }
            ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card muhtawaa-card hover-lift text-center" 
                         data-aos="zoom-in" 
                         data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="category-icon" style="background: <?php echo esc_attr($category_color); ?>;">
                            <?php
                            // أيقونات افتراضية للفئات
                            $category_icons = array(
                                'تقنية' => 'fas fa-laptop-code',
                                'صحة' => 'fas fa-heartbeat',
                                'طبخ' => 'fas fa-utensils',
                                'سفر' => 'fas fa-plane',
                                'تعليم' => 'fas fa-graduation-cap',
                                'رياضة' => 'fas fa-dumbbell',
                                'فن' => 'fas fa-palette',
                                'أعمال' => 'fas fa-briefcase'
                            );
                            
                            $icon = isset($category_icons[$category->name]) ? $category_icons[$category->name] : 'fas fa-folder';
                            ?>
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                        
                        <h3 class="category-title">
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </h3>
                        
                        <p class="category-count">
                            <?php printf(_n('%d مقال', '%d مقالة', $category->count, 'muhtawaa'), $category->count); ?>
                        </p>
                        
                        <?php if ($category->description) : ?>
                            <p class="category-description">
                                <?php echo wp_trim_words($category->description, 10, '...'); ?>
                            </p>
                        <?php endif; ?>
                        
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                           class="category-link">
                            استكشف الفئة
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            <?php 
                endforeach;
            else :
            ?>
                <div class="col-12 text-center">
                    <div class="no-categories-message">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h3>لا توجد فئات بعد</h3>
                        <p class="text-muted">ابدأ بإنشاء فئات للمحتوى!</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- قسم الشهادات والآراء -->
<section id="testimonials-section" class="testimonials-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">آراء المتابعين</h2>
            <p class="section-subtitle">ماذا يقول المتابعون عن تجربتهم معنا</p>
            <div class="section-divider"></div>
        </div>
        
        <div class="testimonials-slider">
            <div class="row">
                <?php
                // شهادات افتراضية
                $testimonials = array(
                    array(
                        'name' => 'أحمد محمد',
                        'position' => 'مطور ويب',
                        'image' => '',
                        'text' => 'موقع رائع يقدم محتوى مفيد وحلول عملية. استفدت كثيراً من المقالات والنصائح المقدمة.',
                        'rating' => 5
                    ),
                    array(
                        'name' => 'فاطمة أحمد',
                        'position' => 'مصممة جرافيك',
                        'image' => '',
                        'text' => 'تصميم الموقع جميل جداً وسهل الاستخدام. المحتوى عالي الجودة ومفيد للغاية.',
                        'rating' => 5
                    ),
                    array(
                        'name' => 'محمد علي',
                        'position' => 'رائد أعمال',
                        'image' => '',
                        'text' => 'أنصح بشدة بمتابعة هذا الموقع. يقدم حلول عملية ونصائح قيمة للحياة اليومية.',
                        'rating' => 4
                    )
                );
                
                foreach ($testimonials as $index => $testimonial) :
                ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-card muhtawaa-card" 
                             data-aos="fade-up" 
                             data-aos-delay="<?php echo $index * 200; ?>">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                                
                                <p class="testimonial-text">
                                    "<?php echo esc_html($testimonial['text']); ?>"
                                </p>
                                
                                <div class="testimonial-rating">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h4 class="author-name"><?php echo esc_html($testimonial['name']); ?></h4>
                                    <p class="author-position"><?php echo esc_html($testimonial['position']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php
// استدعاء الجزء الثالث والنهائي
get_template_part('template-parts/front-page', 'part3');
?>