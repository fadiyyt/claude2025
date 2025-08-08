<!-- تذييل التطبيق -->
    <footer class="app-footer">
        
        <!-- ودجات التذييل -->
        <?php if (is_active_sidebar('footer-widgets')): ?>
        <div class="footer-widgets">
            <?php dynamic_sidebar('footer-widgets'); ?>
        </div>
        <?php endif; ?>
        
        <!-- روابط التنقل السريع -->
        <nav class="footer-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class' => 'footer-menu',
                'container' => false,
                'fallback_cb' => 'practical_solutions_footer_fallback'
            ));
            ?>
        </nav>
        
        <!-- معلومات الموقع -->
        <div class="footer-info">
            <div class="footer-logo">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>
            </div>
            
            <div class="footer-social">
                <?php if (get_option('facebook_url')): ?>
                <a href="<?php echo esc_url(get_option('facebook_url')); ?>" target="_blank" rel="noopener" aria-label="فيسبوك">
                    📘
                </a>
                <?php endif; ?>
                
                <?php if (get_option('twitter_url')): ?>
                <a href="<?php echo esc_url(get_option('twitter_url')); ?>" target="_blank" rel="noopener" aria-label="تويتر">
                    🐦
                </a>
                <?php endif; ?>
                
                <?php if (get_option('instagram_url')): ?>
                <a href="<?php echo esc_url(get_option('instagram_url')); ?>" target="_blank" rel="noopener" aria-label="إنستغرام">
                    📷
                </a>
                <?php endif; ?>
                
                <?php if (get_option('youtube_url')): ?>
                <a href="<?php echo esc_url(get_option('youtube_url')); ?>" target="_blank" rel="noopener" aria-label="يوتيوب">
                    📺
                </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- إحصائيات الموقع -->
        <div class="footer-stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo wp_count_posts()->publish; ?></span>
                <span class="stat-label">حل عملي</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">
                    <?php 
                    $categories = get_categories(array('hide_empty' => true));
                    echo count($categories);
                    ?>
                </span>
                <span class="stat-label">فئة</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">
                    <?php 
                    $user_count = count_users();
                    echo $user_count['total_users'];
                    ?>
                </span>
                <span class="stat-label">مستخدم</span>
            </div>
        </div>
        
        <!-- نص حقوق النشر -->
        <div class="footer-text">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. جميع الحقوق محفوظة.</p>
            <p>تم التطوير بـ ❤️ للمجتمع العربي</p>
        </div>
        
    </footer>

</div> <!-- نهاية app-container -->

<!-- أزرار التحكم العائمة الإضافية -->
<div class="control-buttons">
    <!-- زر العودة لأعلى -->
    <button class="scroll-to-top" id="scrollToTop" aria-label="العودة لأعلى" style="display: none;">
        ⬆️
    </button>
    
    <!-- زر تبديل الوضع المظلم -->
    <?php if (get_theme_mod('enable_dark_mode', false)): ?>
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="تبديل الوضع المظلم">
        🌙
    </button>
    <?php endif; ?>
    
    <!-- زر مشاركة الصفحة -->
    <button class="share-button" id="shareButton" aria-label="مشاركة" style="display: none;">
        📤
    </button>
</div>

<!-- نافذة منبثقة للمشاركة -->
<div class="share-modal" id="shareModal" style="display: none;">
    <div class="share-modal-content">
        <div class="share-modal-header">
            <h3>مشاركة الصفحة</h3>
            <button class="close-modal" id="closeShareModal">&times;</button>
        </div>
        <div class="share-options">
            <button class="share-option" data-platform="whatsapp">
                <span class="share-icon">💬</span>
                <span class="share-text">واتساب</span>
            </button>
            <button class="share-option" data-platform="facebook">
                <span class="share-icon">📘</span>
                <span class="share-text">فيسبوك</span>
            </button>
            <button class="share-option" data-platform="twitter">
                <span class="share-icon">🐦</span>
                <span class="share-text">تويتر</span>
            </button>
            <button class="share-option" data-platform="telegram">
                <span class="share-icon">✈️</span>
                <span class="share-text">تليجرام</span>
            </button>
            <button class="share-option" data-platform="copy">
                <span class="share-icon">📋</span>
                <span class="share-text">نسخ الرابط</span>
            </button>
        </div>
    </div>
</div>

<!-- تراكب الخلفية للنوافذ المنبثقة -->
<div class="modal-overlay" id="modalOverlay" style="display: none;"></div>

<!-- رسائل التنبيه -->
<div class="toast-container" id="toastContainer"></div>

<?php wp_footer(); ?>

<!-- سكريبت التطبيق الرئيسي -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // المتغيرات الرئيسية
    const scrollToTopBtn = document.getElementById('scrollToTop');
    const darkModeToggle = document.getElementById('darkModeToggle');
    const shareButton = document.getElementById('shareButton');
    const shareModal = document.getElementById('shareModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const toastContainer = document.getElementById('toastContainer');
    
    // إظهار/إخفاء زر العودة لأعلى
    function toggleScrollButton() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.display = 'block';
        } else {
            scrollToTopBtn.style.display = 'none';
        }
    }
    
    window.addEventListener('scroll', toggleScrollButton);
    
    // وظيفة العودة لأعلى
    if (scrollToTopBtn) {
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // تبديل الوضع المظلم
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            
            // حفظ التفضيل في التخزين المحلي
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            
            // تغيير أيقونة الزر
            this.textContent = isDarkMode ? '☀️' : '🌙';
            
            showToast(isDarkMode ? 'تم تفعيل الوضع المظلم' : 'تم إلغاء الوضع المظلم');
        });
        
        // استرجاع التفضيل المحفوظ
        const savedDarkMode = localStorage.getItem('darkMode') === 'true';
        if (savedDarkMode) {
            document.body.classList.add('dark-mode');
            darkModeToggle.textContent = '☀️';
        }
    }
    
    // إظهار زر المشاركة في صفحة المقال
    if (document.body.classList.contains('single-post') && shareButton) {
        shareButton.style.display = 'block';
    }
    
    // فتح نافذة المشاركة
    if (shareButton) {
        shareButton.addEventListener('click', function() {
            shareModal.style.display = 'block';
            modalOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    }
    
    // إغلاق نافذة المشاركة
    function closeShareModal() {
        shareModal.style.display = 'none';
        modalOverlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    const closeModalBtn = document.getElementById('closeShareModal');
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeShareModal);
    }
    
    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeShareModal);
    }
    
    // وظائف المشاركة
    const shareOptions = document.querySelectorAll('.share-option');
    shareOptions.forEach(option => {
        option.addEventListener('click', function() {
            const platform = this.dataset.platform;
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            
            let shareUrl = '';
            
            switch(platform) {
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title} ${url}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                    break;
                case 'copy':
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        showToast('تم نسخ الرابط إلى الحافظة');
                        closeShareModal();
                    });
                    return;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
                closeShareModal();
            }
        });
    });
    
    // وظيفة إظهار الرسائل التوضيحية
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;
        
        toastContainer.appendChild(toast);
        
        // إظهار الرسالة
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);
        
        // إخفاء الرسالة
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toastContainer.removeChild(toast);
            }, 300);
        }, 3000);
    }
    
    // تحسين الصور البطيء (Lazy Loading)
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // تتبع التفاعل مع المحتوى
    function trackEngagement(action, element) {
        // يمكن إضافة Google Analytics أو أي نظام تتبع آخر هنا
        if (typeof gtag !== 'undefined') {
            gtag('event', action, {
                'event_category': 'engagement',
                'event_label': element
            });
        }
    }
    
    // تتبع النقرات على البطاقات
    const contentCards = document.querySelectorAll('.content-card');
    contentCards.forEach(card => {
        card.addEventListener('click', function() {
            const title = this.querySelector('.card-title')?.textContent || 'unknown';
            trackEngagement('card_click', title);
        });
    });
    
    // تتبع استخدام البحث
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('search', function() {
            trackEngagement('search', this.value);
        });
    }
    
    // حفظ التقدم في القراءة
    if (document.body.classList.contains('single-post')) {
        let readingProgress = 0;
        
        function updateReadingProgress() {
            const article = document.querySelector('article');
            if (!article) return;
            
            const articleTop = article.offsetTop;
            const articleHeight = article.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollTop = window.pageYOffset;
            
            const progress = ((scrollTop - articleTop + windowHeight) / articleHeight) * 100;
            readingProgress = Math.max(0, Math.min(100, progress));
            
            // حفظ التقدم في التخزين المحلي
            const postId = document.body.classList.toString().match(/postid-(\d+)/);
            if (postId) {
                localStorage.setItem(`reading_progress_${postId[1]}`, readingProgress);
            }
        }
        
        window.addEventListener('scroll', updateReadingProgress);
    }
    
    // تحسين الأداء: تأجيل تحميل المحتوى غير المرئي
    const deferredElements = document.querySelectorAll('[data-defer]');
    if (deferredElements.length > 0) {
        const deferObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const deferredContent = element.dataset.defer;
                    
                    // تحميل المحتوى المؤجل
                    fetch(deferredContent)
                        .then(response => response.text())
                        .then(html => {
                            element.innerHTML = html;
                            deferObserver.unobserve(element);
                        });
                }
            });
        });
        
        deferredElements.forEach(el => deferObserver.observe(el));
    }
    
    // خاصية السحب للتحديث (Pull to Refresh)
    let touchStartY = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartY = e.changedTouches[0].screenY;
    });
    
    document.addEventListener('touchend', function(e) {
        touchEndY = e.changedTouches[0].screenY;
        handlePullToRefresh();
    });
    
    function handlePullToRefresh() {
        if (window.pageYOffset === 0 && touchEndY - touchStartY > 100) {
            showToast('جارٍ تحديث المحتوى...');
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    }
    
});

// وظائف مساعدة إضافية
function practical_solutions_fallback() {
    return '<ul class="footer-menu">' +
           '<li><a href="' + practicalAjax.home_url + '">الرئيسية</a></li>' +
           '<li><a href="' + practicalAjax.home_url + '/about">من نحن</a></li>' +
           '<li><a href="' + practicalAjax.home_url + '/contact">اتصل بنا</a></li>' +
           '<li><a href="' + practicalAjax.home_url + '/privacy">سياسة الخصوصية</a></li>' +
           '</ul>';
}
</script>

<!-- تنسيقات CSS إضافية للمكونات الجديدة -->
<style>
.control-buttons {
    position: fixed;
    bottom: 80px;
    right: 20px;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.control-buttons button {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: none;
    background: var(--primary-color);
    color: white;
    font-size: 18px;
    cursor: pointer;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
}

.control-buttons button:hover {
    transform: scale(1.1);
    background: #357abd;
}

.share-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    z-index: 2000;
    max-width: 300px;
    width: 90%;
}

.share-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.share-modal-header h3 {
    margin: 0;
    font-size: 18px;
    color: var(--dark-color);
}

.close-modal {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #999;
}

.share-options {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.share-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
    border: 2px solid #f0f0f0;
    border-radius: 12px;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
}

.share-option:hover {
    border-color: var(--primary-color);
    background: #f8f9fa;
}

.share-icon {
    font-size: 24px;
    margin-bottom: 8px;
}

.share-text {
    font-size: 12px;
    font-weight: 500;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1500;
}

.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 3000;
}

.toast {
    background: var(--success-color);
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 10px;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    box-shadow: var(--card-shadow);
}

.toast.show {
    transform: translateX(0);
}

.toast.toast-error {
    background: var(--danger-color);
}

.toast.toast-warning {
    background: var(--secondary-color);
}

.footer-stats {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
    padding: 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 24px;
    font-weight: bold;
    color: var(--secondary-color);
}

.stat-label {
    font-size: 12px;
    opacity: 0.8;
}

.footer-social {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 15px 0;
}

.footer-social a {
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 18px;
}

.footer-social a:hover {
    background: var(--primary-color);
    transform: translateY(-3px);
}

/* الوضع المظلم للمكونات الجديدة */
.dark-mode .share-modal {
    background: #3a3a3a;
    color: #e1e1e1;
}

.dark-mode .share-modal-header {
    border-bottom-color: #5a5a5a;
}

.dark-mode .share-option {
    background: #4a4a4a;
    border-color: #5a5a5a;
    color: #e1e1e1;
}

.dark-mode .share-option:hover {
    background: #5a5a5a;
}

/* تحسينات الاستجابة */
@media (max-width: 480px) {
    .control-buttons {
        right: 15px;
        bottom: 70px;
    }
    
    .share-modal {
        max-width: 280px;
    }
    
    .share-options {
        grid-template-columns: 1fr;
    }
    
    .footer-stats {
        flex-direction: column;
        gap: 15px;
    }
}
</style>

</body>
</html>

<?php
// وظيفة احتياطية لقائمة التذييل
function practical_solutions_footer_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . home_url() . '">الرئيسية</a></li>';
    echo '<li><a href="' . home_url('/about') . '">من نحن</a></li>';
    echo '<li><a href="' . home_url('/contact') . '">اتصل بنا</a></li>';
    echo '<li><a href="' . home_url('/privacy') . '">سياسة الخصوصية</a></li>';
    echo '</ul>';
}
?>