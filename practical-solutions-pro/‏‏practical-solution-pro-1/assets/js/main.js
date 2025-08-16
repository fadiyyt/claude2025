/**
 * Practical Solutions Pro - Main JavaScript
 * ملف JavaScript الرئيسي الموحد
 * الإصدار: 2.2.2
 */

// استيراد جميع الوحدات
import './modules/voice-search';
import './modules/search-suggestions';
import './modules/rating-system';
import './modules/performance-features';
import './modules/accessibility';
import './modules/pwa-features';

// الكود الرئيسي
(function($) {
    'use strict';

    // إعدادات عامة
    const psSettings = {
        ajaxurl: psAjax?.ajaxurl || '/wp-admin/admin-ajax.php',
        nonce: psAjax?.nonce || '',
        isRTL: psAjax?.is_rtl || false,
        homeUrl: psAjax?.home_url || '/',
        debug: window.location.hostname === 'localhost'
    };

    // تطبيق التحسينات عند تحميل DOM
    $(document).ready(function() {
        initializeTheme();
        setupPerformanceOptimizations();
        setupAccessibilityFeatures();
        setupPWAFeatures();
    });

    /**
     * تهيئة القالب الأساسية
     */
    function initializeTheme() {
        console.log('🚀 Practical Solutions Pro v2.2.2 Initialized');
        
        // تفعيل الميزات حسب الصفحة
        if (window.psFeatures?.ratingEnabled) {
            initRatingSystem();
        }
        
        if (window.psFeatures?.enhancedSearch) {
            initEnhancedSearch();
        }
        
        // إعداد الأحداث العامة
        setupGlobalEvents();
    }

    /**
     * إعداد الأحداث العامة
     */
    function setupGlobalEvents() {
        // تحسين النقر على الروابط
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 500);
            }
        });

        // تحسين النماذج
        $('form').on('submit', function(e) {
            const form = $(this);
            const submitBtn = form.find('[type="submit"]');
            
            if (!form.data('ajax')) return;
            
            e.preventDefault();
            submitBtn.prop('disabled', true).text(psAjax.loading || 'جاري التحميل...');
            
            // معالجة إرسال النموذج عبر AJAX
            handleFormSubmission(form);
        });
    }

    /**
     * معالجة إرسال النماذج
     */
    function handleFormSubmission(form) {
        const formData = new FormData(form[0]);
        formData.append('action', form.data('action') || 'ps_form_submit');
        formData.append('nonce', psSettings.nonce);

        $.ajax({
            url: psSettings.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showNotification(response.data.message || 'تم الإرسال بنجاح', 'success');
                    form[0].reset();
                } else {
                    showNotification(response.data.message || 'حدث خطأ', 'error');
                }
            },
            error: function() {
                showNotification(psAjax.error || 'حدث خطأ في الشبكة', 'error');
            },
            complete: function() {
                form.find('[type="submit"]').prop('disabled', false).text('إرسال');
            }
        });
    }

    /**
     * عرض الإشعارات
     */
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="ps-notification ps-notification--${type}">
                <span class="ps-notification__message">${message}</span>
                <button class="ps-notification__close">&times;</button>
            </div>
        `);

        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('ps-notification--show');
        }, 100);

        // إزالة الإشعار تلقائياً
        setTimeout(() => {
            notification.removeClass('ps-notification--show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);

        // إزالة عند النقر على زر الإغلاق
        notification.find('.ps-notification__close').on('click', function() {
            notification.removeClass('ps-notification--show');
            setTimeout(() => notification.remove(), 300);
        });
    }

    /**
     * تحسينات الأداء
     */
    function setupPerformanceOptimizations() {
        // Lazy loading للصور
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // تحسين will-change للعناصر المتحركة
        const animatedElements = document.querySelectorAll('.ps-card, .ps-button, .ps-search-form');
        animatedElements.forEach(el => {
            el.style.willChange = 'transform';
        });
    }

    /**
     * إعداد ميزات الـ PWA
     */
    function setupPWAFeatures() {
        // التحقق من دعم Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('SW registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }

        // إشعار التحديث
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.addEventListener('controllerchange', () => {
                showNotification('تم تحديث الموقع! أعد تحميل الصفحة للحصول على أحدث إصدار.', 'info');
            });
        }
    }

    /**
     * إعداد ميزات إمكانية الوصول
     */
    function setupAccessibilityFeatures() {
        // تحسين التنقل بلوحة المفاتيح
        $('[tabindex], button, a, input, select, textarea').on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) { // Enter أو Space
                if (this.tagName.toLowerCase() === 'button' || $(this).attr('role') === 'button') {
                    e.preventDefault();
                    $(this).click();
                }
            }
        });

        // إضافة aria-labels للعناصر التفاعلية
        $('.ps-search-btn').attr('aria-label', 'البحث');
        $('.ps-voice-btn').attr('aria-label', 'البحث الصوتي');
        $('.ps-rating-star').each(function() {
            const rating = $(this).data('rating');
            $(this).attr('aria-label', `تقييم ${rating} نجوم`);
        });

        // إدارة focus للعناصر المنبثقة
        $('.ps-search-suggestions').on('shown', function() {
            $(this).find('.ps-suggestion-item:first').focus();
        });
    }

    // تصدير الوظائف للاستخدام الخارجي
    window.PracticalSolutions = {
        showNotification,
        settings: psSettings,
        version: '2.2.2'
    };

})(jQuery);