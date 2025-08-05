<?php
/**
 * تذييل الصفحة لقالب محتوى - مُصحح
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
        
        <p class="newsletter-note">
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
                    <div class="stat-item">
                        <span style="color: #667eea;">📝</span> <?php echo $total_posts; ?> حل منشور
                    </div>
                    <div class="stat-item">
                        <span style="color: #48bb78;">🗂️</span> <?php echo $total_categories; ?> فئة
                    </div>
                    <div class="stat-item">
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
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> 
                    <a href="<?php echo home_url(); ?>" style="color: #667eea; text-decoration: none;">
                        <?php bloginfo('name'); ?>
                    </a> 
                    - جميع الحقوق محفوظة</p>
                </div>
                
                <div class="footer-links">
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
<button class="quick-tips" title="حل سريع - اضغط للحصول على نصيحة عشوائية" role="button" tabindex="0" aria-label="الحصول على حل سريع">
    <i class="fas fa-lightbulb" aria-hidden="true"></i>
</button>

<!-- زر العودة للأعلى -->
<button id="back-to-top" class="back-to-top" aria-label="العودة للأعلى">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</button>

<!-- Loading Overlay -->
<div id="loading-overlay">
    <div style="text-align: center;">
        <div class="loading-spinner"></div>
        <p style="color: #667eea; font-weight: bold; margin-top: 1rem;">جاري التحميل...</p>
    </div>
</div>

<!-- ARIA Live Region للإشعارات -->
<div id="aria-live-region" aria-live="polite" aria-atomic="true"></div>

<?php wp_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // التأكد من وجود متغيرات AJAX
    if (typeof muhtawaa_ajax === 'undefined') {
        console.warn('متغيرات AJAX غير محملة');
        window.muhtawaa_ajax = {
            ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('muhtawaa_nonce'); ?>',
            post_id: '<?php echo get_the_ID(); ?>',
            home_url: '<?php echo home_url(); ?>'
        };
    }
    
    // زر الحل السريع
    const quickTipsBtn = document.querySelector('.quick-tips');
    if (quickTipsBtn) {
        quickTipsBtn.addEventListener('click', function() {
            loadRandomTip();
        });
        
        quickTipsBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                loadRandomTip();
            }
        });
    }
    
    // زر العودة للأعلى
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        // إظهار/إخفاء الزر عند التمرير
        function toggleBackToTop() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        }
        
        window.addEventListener('scroll', toggleBackToTop);
        
        // النقر على الزر
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // دعم لوحة المفاتيح
        backToTopBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    }
    
    // دالة تحميل نصيحة عشوائية
    function loadRandomTip() {
        if (!window.muhtawaa_ajax || !window.muhtawaa_ajax.ajax_url) {
            showBasicTip();
            return;
        }
        
        fetch(window.muhtawaa_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=get_random_tip&nonce=${window.muhtawaa_ajax.nonce}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showTipModal(data.data);
            } else {
                showBasicTip();
            }
        })
        .catch(error => {
            console.error('Error loading tip:', error);
            showBasicTip();
        });
    }
    
    // إظهار نصيحة أساسية
    function showBasicTip() {
        const tips = [
            "💡 ضع قطعة خبز في علبة السكر لمنع تكتله",
            "🧽 استخدم معجون الأسنان لإزالة خدوش الهاتف البسيطة",
            "🍋 الليمون يزيل رائحة الثوم من اليدين بفعالية",
            "🧊 مكعبات الثلج تساعد في إزالة العلكة من الملابس",
            "📱 وضع الطيران يشحن الهاتف بشكل أسرع"
        ];
        
        const randomTip = tips[Math.floor(Math.random() * tips.length)];
        showNotification(randomTip, 'info');
    }
    
    // إظهار مودال النصيحة
    function showTipModal(tip) {
        const modal = document.createElement('div');
        modal.className = 'tip-modal-overlay';
        modal.innerHTML = `
            <div class="tip-modal">
                <div class="tip-header">
                    <h3>💡 حل سريع</h3>
                    <button class="tip-close" aria-label="إغلاق">&times;</button>
                </div>
                <div class="tip-content">
                    <h4>${tip.title}</h4>
                    <p>${tip.content}</p>
                    <div class="tip-actions">
                        <button class="tip-action-btn helpful" data-post-id="${tip.id}">👍 مفيد</button>
                        <button class="tip-action-btn share" data-title="${tip.title}" data-url="${tip.url}">📱 مشاركة</button>
                        <a href="${tip.url}" class="tip-action-btn read-more">📖 اقرأ المزيد</a>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // إظهار المودال
        setTimeout(() => {
            modal.classList.add('show');
        }, 100);
        
        // إغلاق المودال
        const closeBtn = modal.querySelector('.tip-close');
        closeBtn.addEventListener('click', () => hideTipModal(modal));
        
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideTipModal(modal);
            }
        });
        
        // تقييم الحل
        const helpfulBtn = modal.querySelector('.helpful');
        helpfulBtn.addEventListener('click', function() {
            const postId = this.dataset.postId;
            if (postId && postId !== '0') {
                rateSolution(postId, 'helpful');
            }
            this.innerHTML = '👍 شكراً!';
            this.disabled = true;
        });
        
        // مشاركة الحل
        const shareBtn = modal.querySelector('.share');
        shareBtn.addEventListener('click', function() {
            const title = this.dataset.title;
            const url = this.dataset.url;
            shareContent(title, url);
        });
        
        // دعم لوحة المفاتيح
        modal.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideTipModal(modal);
            }
        });
    }
    
    // إخفاء مودال النصيحة
    function hideTipModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            if (modal.parentNode) {
                modal.remove();
            }
        }, 300);
    }
    
    // دالة تقييم الحل
    function rateSolution(postId, rating) {
        if (!window.muhtawaa_ajax) return;
        
        fetch(window.muhtawaa_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=rate_solution&post_id=${postId}&rating=${rating}&nonce=${window.muhtawaa_ajax.nonce}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('شكراً لك على التقييم! 🙏', 'success');
            } else {
                showNotification('حدث خطأ في التقييم', 'error');
            }
        })
        .catch(error => {
            console.error('Rating error:', error);
            showNotification('حدث خطأ في الاتصال', 'error');
        });
    }
    
    // دالة المشاركة
    function shareContent(title = document.title, url = window.location.href) {
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            }).catch(err => {
                console.log('Share cancelled:', err);
                copyToClipboard(url);
            });
        } else {
            copyToClipboard(url);
        }
    }
    
    // نسخ للحافظة
    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification('تم نسخ الرابط! 📋', 'success');
            }).catch(() => {
                fallbackCopyToClipboard(text);
            });
        } else {
            fallbackCopyToClipboard(text);
        }
    }
    
    function fallbackCopyToClipboard(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showNotification('تم نسخ الرابط! 📋', 'success');
        } catch (err) {
            showNotification('فشل في نسخ الرابط', 'error');
        }
        
        document.body.removeChild(textArea);
    }
    
    // دالة إظهار الإشعارات
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
        
        // تحديث ARIA live region
        const ariaRegion = document.getElementById('aria-live-region');
        if (ariaRegion) {
            ariaRegion.textContent = message;
        }
    }
    
    function hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }
    
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
            submitBtn.innerHTML = '<div class="loading-spinner"></div> جاري الاشتراك...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            formData.append('action', 'newsletter_subscribe');
            
            fetch(window.muhtawaa_ajax.ajax_url, {
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
    
    // تحسين الروابط الاجتماعية
    const socialLinks = document.querySelectorAll('.social-links a[href="#"]');
    socialLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            showNotification('سيتم إضافة روابط وسائل التواصل قريباً! 📱', 'info');
        });
    });
    
    // إضافة تأثيرات للأزرار العائمة
    const floatingButtons = document.querySelectorAll('.quick-tips, .back-to-top');
    floatingButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
    
    // تتبع الأداء والتفاعل
    let readingStartTime = Date.now();
    let maxScrollDepth = 0;
    
    function trackScrollDepth() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.scrollHeight;
        const winHeight = window.innerHeight;
        const scrollPercent = Math.round((scrollTop / (docHeight - winHeight)) * 100);
        
        if (scrollPercent > maxScrollDepth) {
            maxScrollDepth = scrollPercent;
        }
    }
    
    window.addEventListener('scroll', trackScrollDepth);
    
    // إرسال إحصائيات القراءة عند مغادرة الصفحة
    window.addEventListener('beforeunload', function() {
        if (window.muhtawaa_ajax && window.muhtawaa_ajax.post_id && window.muhtawaa_ajax.post_id !== '0') {
            const readingTime = Math.round((Date.now() - readingStartTime) / 1000);
            
            if (readingTime > 15 && maxScrollDepth > 25) {
                navigator.sendBeacon(window.muhtawaa_ajax.ajax_url, new URLSearchParams({
                    action: 'track_reading',
                    post_id: window.muhtawaa_ajax.post_id,
                    reading_time: readingTime,
                    scroll_depth: maxScrollDepth,
                    nonce: window.muhtawaa_ajax.nonce
                }));
            }
        }
    });
    
    // جعل الدوال متاحة عالمياً
    window.loadRandomTip = loadRandomTip;
    window.showNotification = showNotification;
    window.copyToClipboard = copyToClipboard;
    window.shareContent = shareContent;
    window.rateSolution = rateSolution;
});
</script>

</body>
</html>