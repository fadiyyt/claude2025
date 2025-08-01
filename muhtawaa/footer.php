<?php
/**
 * تذييل الصفحة لقالب محتوى
 * 
 * @package Muhtawaa
 */
?>

</main><!-- #main -->

<!-- Newsletter Section -->
<section class="newsletter" role="complementary">
    <div class="container">
        <h2>📧 احصل على حل يومي في بريدك</h2>
        <p>اشترك ليصلك حل عملي جديد كل يوم + نصائح حصرية للمشتركين فقط</p>
        
        <form class="newsletter-form" method="post" aria-label="نموذج الاشتراك في النشرة البريدية">
            <input type="email" 
                   name="subscriber_email" 
                   placeholder="أدخل بريدك الإلكتروني" 
                   required 
                   aria-label="البريد الإلكتروني"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
            <button type="submit" aria-label="اشتراك في النشرة البريدية">
                اشتراك مجاني
            </button>
            <?php wp_nonce_field('newsletter_subscription', 'newsletter_nonce'); ?>
        </form>
        
        <p class="newsletter-note" style="font-size: 0.9rem; opacity: 0.8; margin-top: 1rem;">
            💡 يمكنك إلغاء الاشتراك في أي وقت | لا نرسل رسائل مزعجة أبداً
        </p>
    </div>
</section>

<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer-content">
            <!-- عمود فئات الحلول -->
            <div class="footer-section" role="navigation" aria-label="فئات الحلول">
                <h3>🗂️ فئات الحلول</h3>
                <ul>
                    <?php
                    $footer_categories = get_terms(array(
                        'taxonomy' => 'solution_category',
                        'number' => 6,
                        'hide_empty' => false,
                        'orderby' => 'count',
                        'order' => 'DESC'
                    ));
                    
                    if ($footer_categories && !is_wp_error($footer_categories)) {
                        foreach ($footer_categories as $category) {
                            $icon = muhtawaa_get_category_icon($category->name);
                            echo '<li><a href="' . get_term_link($category) . '" title="' . esc_attr($category->description) . '">';
                            echo $icon . ' ' . esc_html($category->name);
                            echo ' <small>(' . $category->count . ')</small>';
                            echo '</a></li>';
                        }
                    } else {
                        // فئات افتراضية إذا لم توجد فئات
                        $default_categories = array(
                            '🏠 المنزل والتنظيف',
                            '🍳 المطبخ والطبخ', 
                            '💰 توفير المال',
                            '🚗 السيارات',
                            '📱 التكنولوجيا',
                            '🌡️ الطقس والمناخ'
                        );
                        
                        foreach ($default_categories as $category) {
                            echo '<li><a href="#" onclick="return false;">' . $category . ' <small>(قريباً)</small></a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            
            <!-- عمود الروابط المفيدة -->
            <div class="footer-section" role="navigation" aria-label="روابط مفيدة">
                <h3>🔗 روابط مفيدة</h3>
                <?php
                if (has_nav_menu('footer-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => false,
                    ));
                } else {
                    // روابط افتراضية
                    echo '<ul>';
                    echo '<li><a href="' . home_url('/about') . '">عن محتوى</a></li>';
                    echo '<li><a href="' . home_url('/contact') . '">اتصل بنا</a></li>';
                    echo '<li><a href="' . home_url('/suggest') . '">اقترح حلاً</a></li>';
                    echo '<li><a href="' . home_url('/privacy') . '">سياسة الخصوصية</a></li>';
                    echo '<li><a href="' . home_url('/terms') . '">شروط الاستخدام</a></li>';
                    echo '<li><a href="' . get_feed_link() . '" target="_blank">RSS <i class="fas fa-rss"></i></a></li>';
                    echo '</ul>';
                }
                ?>
            </div>
            
            <!-- عمود وسائل التواصل والإحصائيات -->
            <div class="footer-section">
                <h3>📊 إحصائيات الموقع</h3>
                <div class="footer-stats" style="margin-bottom: 1.5rem;">
                    <?php
                    $total_posts = wp_count_posts()->publish;
                    $total_categories = wp_count_terms('solution_category');
                    $total_comments = wp_count_comments()->approved;
                    ?>
                    <div class="stat-item" style="margin-bottom: 0.5rem;">
                        <span style="color: #667eea;">📝</span> <?php echo $total_posts; ?> حل منشور
                    </div>
                    <div class="stat-item" style="margin-bottom: 0.5rem;">
                        <span style="color: #48bb78;">🗂️</span> <?php echo $total_categories; ?> فئة
                    </div>
                    <div class="stat-item" style="margin-bottom: 0.5rem;">
                        <span style="color: #ed8936;">💬</span> <?php echo $total_comments; ?> تعليق
                    </div>
                </div>
                
                <h4 style="margin-bottom: 1rem; color: #667eea;">تابعنا</h4>
                <div class="social-links" role="navigation" aria-label="وسائل التواصل الاجتماعي">
                    <?php
                    $social_links = muhtawaa_get_social_links();
                    $social_icons = array(
                        'twitter' => 'fab fa-twitter',
                        'facebook' => 'fab fa-facebook',
                        'instagram' => 'fab fa-instagram',
                        'youtube' => 'fab fa-youtube',
                        'tiktok' => 'fab fa-tiktok'
                    );
                    
                    foreach ($social_links as $platform => $url) {
                        if (!empty($url)) {
                            $icon = $social_icons[$platform];
                            $platform_name = ucfirst($platform);
                            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener" aria-label="تابعنا على ' . $platform_name . '">';
                            echo '<i class="' . $icon . '"></i>';
                            echo '</a>';
                        }
                    }
                    
                    // روابط افتراضية إذا لم يتم تعيين روابط
                    if (empty(array_filter($social_links))) {
                        echo '<a href="#" aria-label="تابعنا على تويتر"><i class="fab fa-twitter"></i></a>';
                        echo '<a href="#" aria-label="تابعنا على فيسبوك"><i class="fab fa-facebook"></i></a>';
                        echo '<a href="#" aria-label="تابعنا على انستغرام"><i class="fab fa-instagram"></i></a>';
                        echo '<a href="#" aria-label="تابعنا على يوتيوب"><i class="fab fa-youtube"></i></a>';
                        echo '<a href="#" aria-label="تابعنا على تيك توك"><i class="fab fa-tiktok"></i></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- شريط المعلومات السفلي -->
        <div class="footer-bottom">
            <div class="footer-bottom-content" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> 
                    <a href="<?php echo home_url(); ?>" style="color: #667eea; text-decoration: none;">
                        <?php bloginfo('name'); ?>
                    </a> 
                    - جميع الحقوق محفوظة</p>
                </div>
                
                <div class="footer-links" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <span style="color: #95a5a6;">صُنع بـ ❤️ في السعودية</span>
                    <?php if (function_exists('wp_get_theme')): ?>
                        <span style="color: #95a5a6;">| قالب محتوى v<?php echo wp_get_theme()->get('Version'); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- زر الحل السريع العائم -->
<div class="quick-tips" title="حل سريع - اضغط للحصول على نصيحة عشوائية" role="button" tabindex="0" aria-label="الحصول على حل سريع">
    <i class="fas fa-lightbulb" aria-hidden="true"></i>
</div>

<!-- زر العودة للأعلى -->
<button id="back-to-top" class="back-to-top" aria-label="العودة للأعلى" style="position: fixed; bottom: 20px; left: 20px; background: #667eea; color: white; border: none; border-radius: 50%; width: 50px; height: 50px; cursor: pointer; box-shadow: 0 5px 20px rgba(0,0,0,0.2); transition: all 0.3s; opacity: 0; visibility: hidden; z-index: 999;">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</button>

<!-- Loading Overlay -->
<div id="loading-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.9); z-index: 10000; display: none; align-items: center; justify-content: center;">
    <div style="text-align: center;">
        <div class="loading-spinner" style="margin: 0 auto 1rem;"></div>
        <p style="color: #667eea; font-weight: bold;">جاري التحميل...</p>
    </div>
</div>

<?php wp_footer(); ?>

<style>
/* تحسينات CSS إضافية للفوتر */
.newsletter {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
    text-align: center;
}

.newsletter h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.newsletter p {
    margin-bottom: 2rem;
    opacity: 0.9;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.newsletter-form {
    display: flex;
    max-width: 500px;
    margin: 0 auto 1rem;
    gap: 10px;
}

.newsletter-form input {
    flex: 1;
    padding: 15px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    outline: none;
}

.newsletter-form input:focus {
    box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
}

.newsletter-form button {
    background: white;
    color: #667eea;
    border: none;
    padding: 15px 25px;
    border-radius: 25px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    white-space: nowrap;
}

.newsletter-form button:hover,
.newsletter-form button:focus {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.newsletter-form button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.footer {
    background: #2c3e50;
    color: white;
    padding: 3rem 0 1rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h3 {
    margin-bottom: 1rem;
    color: #667eea;
    font-size: 1.2rem;
}

.footer-section h4 {
    margin-bottom: 1rem;
    color: #667eea;
    font-size: 1rem;
}

.footer-section ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 0.5rem;
}

.footer-section ul li a {
    color: #ecf0f1;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-block;
    padding: 0.25rem 0;
}

.footer-section ul li a:hover,
.footer-section ul li a:focus {
    color: #667eea;
    transform: translateX(5px);
}

.footer-section ul li a small {
    color: #95a5a6;
}

.social-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 50%;
    transition: all 0.3s;
    font-size: 1.2rem;
}

.social-links a:hover,
.social-links a:focus {
    background: #5a6fd8;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid #34495e;
    color: #95a5a6;
}

.footer-bottom a {
    color: #667eea;
    text-decoration: none;
}

.footer-bottom a:hover {
    text-decoration: underline;
}

.quick-tips {
    position: fixed;
    bottom: 90px;
    right: 20px;
    background: #667eea;
    color: white;
    padding: 15px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    transition: all 0.3s;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: none;
}

.quick-tips:hover,
.quick-tips:focus {
    transform: scale(1.1);
    background: #5a6fd8;
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
}

.back-to-top {
    transition: all 0.3s;
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover,
.back-to-top:focus {
    background: #5a6fd8;
    transform: translateY(-3px);
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
}

.footer-stats .stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

/* تحسينات الموبايل */
@media (max-width: 768px) {
    .newsletter-form {
        flex-direction: column;
    }
    
    .newsletter-form input,
    .newsletter-form button {
        width: 100%;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .quick-tips {
        bottom: 80px;
        right: 15px;
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .back-to-top {
        bottom: 15px;
        left: 15px;
        width: 45px;
        height: 45px;
    }
    
    .social-links {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .newsletter {
        padding: 2rem 0;
    }
    
    .newsletter h2 {
        font-size: 1.5rem;
    }
    
    .footer {
        padding: 2rem 0 1rem;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

/* تحسينات الوصولية */
@media (prefers-reduced-motion: reduce) {
    .quick-tips,
    .back-to-top,
    .footer-section ul li a,
    .social-links a,
    .newsletter-form button {
        transition: none;
    }
}

/* تحسين الطباعة */
@media print {
    .newsletter,
    .quick-tips,
    .back-to-top,
    #loading-overlay {
        display: none !important;
    }
    
    .footer {
        background: white !important;
        color: black !important;
        border-top: 2px solid #ccc;
    }
    
    .footer a {
        color: black !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // زر العودة للأعلى
    const backToTopBtn = document.getElementById('back-to-top');
    
    function toggleBackToTop() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    }
    
    window.addEventListener('scroll', toggleBackToTop);
    
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // دعم لوحة المفاتيح للأزرار العائمة
    document.querySelector('.quick-tips').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            this.click();
        }
    });
    
    backToTopBtn.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            this.click();
        }
    });
    
    // تحسين النشرة البريدية
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const submitBtn = this.querySelector('button[type="submit"]');
            const email = emailInput.value.trim();
            
            if (!email || !isValidEmail(email)) {
                showNotification('يرجى إدخال بريد إلكتروني صحيح', 'error');
                emailInput.focus();
                return;
            }
            
            const originalText = submitBtn.textContent;
            submitBtn.innerHTML = '<div class="loading-spinner" style="display: inline-block; margin-left: 10px;"></div> جاري الاشتراك...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            formData.append('action', 'newsletter_subscribe');
            
            fetch(muhtawaa_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('تم الاشتراك بنجاح! 🎉 تحقق من بريدك الإلكتروني', 'success');
                    submitBtn.innerHTML = 'تم الاشتراك ✓';
                    submitBtn.style.background = '#4caf50';
                    emailInput.value = '';
                    
                    // إخفاء النموذج بعد النجاح
                    setTimeout(() => {
                        newsletterForm.style.opacity = '0.7';
                        newsletterForm.style.pointerEvents = 'none';
                    }, 2000);
                } else {
                    showNotification(data.data || 'حدث خطأ، يرجى المحاولة مرة أخرى', 'error');
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Newsletter error:', error);
                showNotification('حدث خطأ في الاتصال، يرجى المحاولة مرة أخرى', 'error');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function showNotification(message, type = 'info') {
        // إزالة الإشعارات السابقة
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <span class="notification-message">${message}</span>
            <button class="notification-close" aria-label="إغلاق الإشعار">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        // إظهار الإشعار
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // إخفاء تلقائي بعد 5 ثوان
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        
        // إغلاق عند الضغط على X
        notification.querySelector('.notification-close').addEventListener('click', function() {
            hideNotification(notification);
        });
    }
    
    function hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }
    
    // تحسين أداء التمرير
    let ticking = false;
    
    function updateScrollPosition() {
        toggleBackToTop();
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateScrollPosition);
            ticking = true;
        }
    });
    
    // تحميل lazy للروابط الاجتماعية
    const socialLinks = document.querySelectorAll('.social-links a[href="#"]');
    socialLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            showNotification('سيتم إضافة روابط وسائل التواصل قريباً! 📱', 'info');
        });
    });
    
    // إحصائيات الاستخدام
    if (typeof muhtawaa_ajax !== 'undefined' && muhtawaa_ajax.post_id) {
        // تتبع الوقت المقضي في الصفحة
        let startTime = Date.now();
        let maxScroll = 0;
        
        window.addEventListener('scroll', function() {
            const scrollPercent = Math.round((window.pageYOffset / (document.body.scrollHeight - window.innerHeight)) * 100);
            if (scrollPercent > maxScroll) {
                maxScroll = scrollPercent;
            }
        });
        
        window.addEventListener('beforeunload', function() {
            const timeSpent = Math.round((Date.now() - startTime) / 1000);
            
            if (timeSpent > 10 && maxScroll > 25) { // إذا قضى أكثر من 10 ثواني وتمرر أكثر من 25%
                navigator.sendBeacon(muhtawaa_ajax.ajax_url, new URLSearchParams({
                    action: 'track_reading',
                    post_id: muhtawaa_ajax.post_id,
                    reading_time: timeSpent,
                    scroll_depth: maxScroll,
                    nonce: muhtawaa_ajax.nonce
                }));
            }
        });
    }
});

// دالة عامة لإظهار تراكب التحميل
function showLoadingOverlay(message = 'جاري التحميل...') {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.style.display = 'flex';
        const messageElement = overlay.querySelector('p');
        if (messageElement) {
            messageElement.textContent = message;
        }
    }
}

function hideLoadingOverlay() {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.style.display = 'none';
    }
}
</script>

</body>
</html>