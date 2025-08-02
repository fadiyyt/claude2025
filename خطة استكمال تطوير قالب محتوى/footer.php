<?php
/**
 * تذييل الموقع - قالب محتوى المطور
 * 
 * @package Muhtawaa
 * @version 2.0
 * @since 1.0.0
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}
?>

        <!-- منطقة بعد المحتوى -->
        <?php if (is_active_sidebar('after-content') && (is_home() || is_front_page())) : ?>
        <section class="after-content-section">
            <div class="container">
                <?php dynamic_sidebar('after-content'); ?>
            </div>
        </section>
        <?php endif; ?>
        
    </main><!-- #main -->
    
    <!-- بداية التذييل -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        
        <!-- قسم ويدجت التذييل الرئيسي -->
        <?php 
        $footer_widgets_active = false;
        for ($i = 1; $i <= 4; $i++) {
            if (is_active_sidebar("footer-{$i}")) {
                $footer_widgets_active = true;
                break;
            }
        }
        ?>
        
        <?php if ($footer_widgets_active) : ?>
        <div class="footer-widgets">
            <div class="container">
                <div class="footer-widgets-grid">
                    
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <?php if (is_active_sidebar("footer-{$i}")) : ?>
                    <div class="footer-widget-area footer-widget-<?php echo $i; ?>">
                        <?php dynamic_sidebar("footer-{$i}"); ?>
                    </div>
                    <?php endif; ?>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- معلومات الاتصال والروابط السريعة -->
        <div class="footer-info">
            <div class="container">
                <div class="footer-info-grid">
                    
                    <!-- معلومات الموقع -->
                    <div class="footer-site-info">
                        <div class="footer-logo">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <h3 class="footer-site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h3>
                            <?php endif; ?>
                        </div>
                        
                        <div class="footer-description">
                            <?php 
                            $description = get_bloginfo('description');
                            if ($description) {
                                echo '<p>' . esc_html($description) . '</p>';
                            } else {
                                echo '<p>' . __('موقع محتوى - مصدرك الأول للحلول اليومية والمقالات المفيدة باللغة العربية.', 'muhtawaa') . '</p>';
                            }
                            ?>
                        </div>
                        
                        <!-- روابط وسائل التواصل الاجتماعي -->
                        <div class="social-links">
                            <?php
                            $social_links = array(
                                'facebook'  => get_theme_mod('social_facebook', ''),
                                'twitter'   => get_theme_mod('social_twitter', ''),
                                'instagram' => get_theme_mod('social_instagram', ''),
                                'youtube'   => get_theme_mod('social_youtube', ''),
                                'linkedin'  => get_theme_mod('social_linkedin', ''),
                                'telegram'  => get_theme_mod('social_telegram', ''),
                                'whatsapp'  => get_theme_mod('social_whatsapp', ''),
                                'email'     => get_theme_mod('contact_email', ''),
                            );
                            
                            $social_icons = array(
                                'facebook'  => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
                                'twitter'   => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>',
                                'instagram' => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
                                'youtube'   => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                                'linkedin'  => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
                                'telegram'  => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
                                'whatsapp'  => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/></svg>',
                                'email'     => '<svg viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
                            );
                            
                            foreach ($social_links as $platform => $url) {
                                if (!empty($url)) {
                                    $icon = isset($social_icons[$platform]) ? $social_icons[$platform] : '';
                                    $label = ucfirst($platform);
                                    $target = ($platform === 'email') ? '' : ' target="_blank" rel="noopener noreferrer"';
                                    $href = ($platform === 'email') ? 'mailto:' . $url : esc_url($url);
                                    
                                    echo '<a href="' . $href . '" class="social-link social-' . $platform . '" aria-label="' . sprintf(__('تابعنا على %s', 'muhtawaa'), $label) . '"' . $target . '>' . $icon . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                    <!-- روابط سريعة -->
                    <div class="footer-quick-links">
                        <h4><?php _e('روابط سريعة', 'muhtawaa'); ?></h4>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-quick',
                            'menu_class'     => 'footer-menu quick-links',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => 'muhtawaa_footer_quick_links_fallback',
                        ));
                        ?>
                    </div>
                    
                    <!-- معلومات الاتصال -->
                    <div class="footer-contact-info">
                        <h4><?php _e('تواصل معنا', 'muhtawaa'); ?></h4>
                        <div class="contact-info-list">
                            
                            <?php if ($email = get_theme_mod('contact_email')) : ?>
                            <div class="contact-item">
                                <svg class="contact-icon" viewBox="0 0 24 24" width="16" height="16">
                                    <path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($phone = get_theme_mod('contact_phone')) : ?>
                            <div class="contact-item">
                                <svg class="contact-icon" viewBox="0 0 24 24" width="16" height="16">
                                    <path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                                <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($address = get_theme_mod('contact_address')) : ?>
                            <div class="contact-item">
                                <svg class="contact-icon" viewBox="0 0 24 24" width="16" height="16">
                                    <path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                <span><?php echo esc_html($address); ?></span>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                    <!-- النشرة البريدية -->
                    <div class="footer-newsletter">
                        <h4><?php _e('النشرة البريدية', 'muhtawaa'); ?></h4>
                        <p><?php _e('اشترك في نشرتنا البريدية لتحصل على أحدث الحلول والمقالات', 'muhtawaa'); ?></p>
                        
                        <form class="newsletter-form" action="#" method="post">
                            <div class="newsletter-input-wrapper">
                                <input type="email" 
                                       name="newsletter_email" 
                                       placeholder="<?php _e('البريد الإلكتروني', 'muhtawaa'); ?>" 
                                       required 
                                       aria-label="<?php _e('البريد الإلكتروني للنشرة البريدية', 'muhtawaa'); ?>">
                                <button type="submit" 
                                        class="newsletter-submit" 
                                        aria-label="<?php _e('اشتراك في النشرة', 'muhtawaa'); ?>">
                                    <svg viewBox="0 0 24 24" width="20" height="20">
                                        <path fill="currentColor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="newsletter-privacy">
                                <small><?php _e('سنحترم خصوصيتك ولن نشارك بياناتك مع أطراف ثالثة', 'muhtawaa'); ?></small>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- منطقة التذييل السفلية -->
        <?php if (is_active_sidebar('footer-bottom')) : ?>
        <div class="footer-bottom-widgets">
            <div class="container">
                <?php dynamic_sidebar('footer-bottom'); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- شريط حقوق الطبع والنشر -->
        <div class="footer-copyright">
            <div class="container">
                <div class="copyright-content">
                    
                    <div class="copyright-text">
                        <p>
                            <?php 
                            $copyright_text = get_theme_mod('copyright_text', '');
                            if ($copyright_text) {
                                echo esc_html($copyright_text);
                            } else {
                                printf(
                                    __('&copy; %1$s %2$s. جميع الحقوق محفوظة.', 'muhtawaa'),
                                    date('Y'),
                                    get_bloginfo('name')
                                );
                            }
                            ?>
                        </p>
                    </div>
                    
                    <div class="footer-links">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-legal',
                            'menu_class'     => 'footer-legal-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => 'muhtawaa_footer_legal_links_fallback',
                        ));
                        ?>
                    </div>
                    
                    <div class="theme-credit">
                        <p>
                            <?php 
                            printf(
                                __('تم التطوير بواسطة %s', 'muhtawaa'),
                                '<a href="#" target="_blank" rel="noopener">' . __('فريق محتوى', 'muhtawaa') . '</a>'
                            );
                            ?>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </footer><!-- #colophon -->
    
</div><!-- #page -->

<!-- زر الانتقال لأعلى -->
<button id="scroll-to-top" class="scroll-to-top" aria-label="<?php _e('انتقل لأعلى', 'muhtawaa'); ?>" title="<?php _e('انتقل لأعلى', 'muhtawaa'); ?>">
    <svg viewBox="0 0 24 24" width="24" height="24">
        <path fill="currentColor" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
    </svg>
</button>

<!-- إشعارات النظام -->
<div id="notification-container" class="notification-container" aria-live="polite"></div>

<!-- تحميل JavaScript -->
<?php wp_footer(); ?>

<!-- إحصائيات Google Analytics (إذا كان مفعلاً) -->
<?php if ($ga_code = get_theme_mod('google_analytics_code')) : ?>
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_code); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo esc_attr($ga_code); ?>');
</script>
<?php endif; ?>

<!-- Schema.org للتذييل -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "<?php bloginfo('name'); ?>",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "description": "<?php bloginfo('description'); ?>",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "SA",
        "addressLocality": "الرياض"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?php echo esc_attr(get_theme_mod('contact_phone', '')); ?>",
        "contactType": "customer service",
        "availableLanguage": "Arabic"
    },
    "sameAs": [
        <?php
        $social_schema = array();
        foreach ($social_links as $platform => $url) {
            if (!empty($url) && $platform !== 'email') {
                $social_schema[] = '"' . esc_url($url) . '"';
            }
        }
        echo implode(',', $social_schema);
        ?>
    ]
}
</script>

<!-- أكواد تتبع إضافية -->
<?php if ($tracking_code = get_theme_mod('additional_tracking_code')) : ?>
<?php echo $tracking_code; ?>
<?php endif; ?>

</body>
</html>