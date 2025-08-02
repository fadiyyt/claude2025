<?php
/**
 * قالب الصفحة الرئيسية - الجزء الثالث والنهائي
 * Front Page Template - Part 3: Final Sections & Styles
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

<!-- قسم النشرة البريدية -->
<section id="newsletter-section" class="newsletter-section section-padding bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="newsletter-content">
                    <h2 class="newsletter-title text-white">ابق على اطلاع</h2>
                    <p class="newsletter-subtitle text-white">
                        اشترك في نشرتنا البريدية لتصلك أحدث المقالات والحلول العملية
                    </p>
                    
                    <form class="newsletter-form" id="newsletter-form" action="#" method="post">
                        <div class="input-group">
                            <input type="email" 
                                   class="form-control form-control-lg" 
                                   placeholder="أدخل بريدك الإلكتروني" 
                                   name="newsletter_email" 
                                   required>
                            <button type="submit" class="btn btn-secondary btn-lg">
                                <i class="fas fa-paper-plane"></i>
                                اشترك الآن
                            </button>
                        </div>
                        
                        <div class="newsletter-privacy">
                            <small class="text-white opacity-75">
                                <i class="fas fa-lock"></i>
                                نحن نحترم خصوصيتك ولن نشارك بريدك الإلكتروني مع أي طرف ثالث
                            </small>
                        </div>
                    </form>
                    
                    <div class="newsletter-stats">
                        <div class="stat-item">
                            <div class="stat-number text-white">500+</div>
                            <div class="stat-label text-white opacity-75">مشترك</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number text-white">95%</div>
                            <div class="stat-label text-white opacity-75">نسبة الرضا</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number text-white">0</div>
                            <div class="stat-label text-white opacity-75">إزعاج</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- قسم التواصل السريع -->
<section id="quick-contact-section" class="quick-contact-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="contact-card muhtawaa-card text-center">
                    <h2 class="contact-title">هل لديك سؤال أو اقتراح؟</h2>
                    <p class="contact-subtitle">
                        نحن هنا لمساعدتك! تواصل معنا ودعنا نقدم لك أفضل الحلول
                    </p>
                    
                    <div class="contact-methods">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" 
                           class="contact-method">
                            <i class="fas fa-envelope"></i>
                            <span>راسلنا</span>
                        </a>
                        
                        <?php if (get_theme_mod('phone_number')) : ?>
                            <a href="tel:<?php echo esc_attr(get_theme_mod('phone_number')); ?>" 
                               class="contact-method">
                                <i class="fas fa-phone"></i>
                                <span>اتصل بنا</span>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('whatsapp_number')) : ?>
                            <a href="https://wa.me/<?php echo esc_attr(str_replace('+', '', get_theme_mod('whatsapp_number'))); ?>" 
                               class="contact-method" 
                               target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span>واتساب</span>
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('faq'))); ?>" 
                           class="contact-method">
                            <i class="fas fa-question-circle"></i>
                            <span>الأسئلة الشائعة</span>
                        </a>
                    </div>
                    
                    <div class="contact-social">
                        <p>تابعنا على وسائل التواصل الاجتماعي:</p>
                        <div class="social-links">
                            <?php
                            $social_links = array(
                                'facebook' => array('icon' => 'fab fa-facebook-f', 'name' => 'فيسبوك'),
                                'twitter' => array('icon' => 'fab fa-twitter', 'name' => 'تويتر'),
                                'instagram' => array('icon' => 'fab fa-instagram', 'name' => 'انستجرام'),
                                'youtube' => array('icon' => 'fab fa-youtube', 'name' => 'يوتيوب'),
                                'linkedin' => array('icon' => 'fab fa-linkedin-in', 'name' => 'لينكد إن'),
                                'telegram' => array('icon' => 'fab fa-telegram-plane', 'name' => 'تيليجرام')
                            );
                            
                            foreach ($social_links as $platform => $data) :
                                $social_url = get_theme_mod($platform . '_url');
                                if ($social_url) :
                            ?>
                                <a href="<?php echo esc_url($social_url); ?>" 
                                   class="social-link" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   title="<?php echo esc_attr($data['name']); ?>">
                                    <i class="<?php echo esc_attr($data['icon']); ?>"></i>
                                </a>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- تضمين ملف الأنماط المخصصة -->
<?php get_template_part('template-parts/front-page', 'styles'); ?>

<!-- تضمين ملف الـ JavaScript -->
<?php get_template_part('template-parts/front-page', 'scripts'); ?>