// =============================================================================
// ملف: src/js/modules/search-suggestions.js
// =============================================================================
/**
 * Search Suggestions Module
 * وحدة اقتراحات البحث
 */

export function initSearchSuggestions() {
    console.log('🔍 تفعيل وحدة اقتراحات البحث');
    
    const searchForms = document.querySelectorAll('.ps-search-form, .search-form');
    
    searchForms.forEach(form => {
        const input = form.querySelector('input[type="search"], .ps-search-input');
        if (!input) return;
        
        let suggestions = form.querySelector('.ps-search-suggestions');
        if (!suggestions) {
            suggestions = document.createElement('div');
            suggestions.className = 'ps-search-suggestions';
            suggestions.style.display = 'none';
            form.appendChild(suggestions);
        }
        
        let searchTimeout;
        input.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length >= 2) {
                searchTimeout = setTimeout(() => {
                    performSearch(query, suggestions);
                }, 300);
            } else {
                suggestions.style.display = 'none';
            }
        });
    });
    
    function performSearch(query, container) {
        if (!window.psAjax?.ajaxurl) return;
        
        fetch(window.psAjax.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'ps_search',
                query: query,
                nonce: window.psAjax.nonce || ''
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                displaySuggestions(data.data, container);
            } else {
                container.style.display = 'none';
            }
        })
        .catch(error => console.error('Search error:', error));
    }
    
    function displaySuggestions(results, container) {
        container.innerHTML = results.map(item => `
            <div class="ps-suggestion-item" onclick="window.location.href='${item.url}'">
                <h4 class="ps-suggestion-title">${item.title}</h4>
                <p class="ps-suggestion-excerpt">${item.excerpt || ''}</p>
            </div>
        `).join('');
        
        container.style.display = 'block';
    }
}

export default { initSearchSuggestions };

// =============================================================================
// ملف: src/js/modules/rating-system.js
// =============================================================================
/**
 * Rating System Module
 * وحدة نظام التقييم
 */

export function initRatingSystem() {
    console.log('⭐ تفعيل وحدة نظام التقييم');
    
    // إنشاء ويدجت التقييم إذا لم يكن موجوداً
    if (!document.querySelector('.ps-rating-widget') && document.body.classList.contains('single')) {
        createRatingWidget();
    }
    
    // ربط أحداث النجوم
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('ps-rating-btn')) {
            const rating = parseInt(e.target.dataset.rating);
            const widget = e.target.closest('.ps-rating-widget');
            const postId = widget.dataset.postId || getCurrentPostId();
            
            saveRating(rating, postId);
        }
    });
    
    // تأثيرات hover
    document.addEventListener('mouseenter', function(e) {
        if (e.target.classList.contains('ps-rating-btn')) {
            const rating = parseInt(e.target.dataset.rating);
            const widget = e.target.closest('.ps-rating-widget');
            highlightStars(rating, widget);
        }
    }, true);
    
    document.addEventListener('mouseleave', function(e) {
        if (e.target.classList.contains('ps-rating-widget')) {
            resetStarsHighlight(e.target);
        }
    }, true);
    
    function createRatingWidget() {
        const postId = getCurrentPostId();
        const widget = document.createElement('div');
        widget.className = 'ps-rating-widget';
        widget.dataset.postId = postId;
        widget.innerHTML = `
            <h4 class="ps-rating-title">قيم هذا المقال:</h4>
            <div class="ps-rating-stars">
                <button class="ps-rating-btn" data-rating="1" aria-label="نجمة واحدة">★</button>
                <button class="ps-rating-btn" data-rating="2" aria-label="نجمتان">★</button>
                <button class="ps-rating-btn" data-rating="3" aria-label="ثلاث نجوم">★</button>
                <button class="ps-rating-btn" data-rating="4" aria-label="أربع نجوم">★</button>
                <button class="ps-rating-btn" data-rating="5" aria-label="خمس نجوم">★</button>
            </div>
            <div class="ps-rating-display">
                <span class="ps-rating-average">0.0</span>
                <span class="ps-rating-count">(0 تقييمات)</span>
            </div>
        `;
        
        const content = document.querySelector('.entry-content, .post-content, main');
        if (content) {
            content.appendChild(widget);
        }
    }
    
    function saveRating(rating, postId) {
        if (!window.psAjax?.ajaxurl) return;
        
        fetch(window.psAjax.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'ps_save_rating',
                post_id: postId,
                rating: rating,
                nonce: window.psAjax.nonce || ''
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateRatingDisplay(data.data);
                showNotification('شكراً لك على التقييم!', 'success');
            } else {
                showNotification(data.data || 'حدث خطأ في حفظ التقييم', 'error');
            }
        })
        .catch(error => {
            console.error('Rating error:', error);
            showNotification('حدث خطأ في الاتصال', 'error');
        });
    }
    
    function highlightStars(rating, widget) {
        const stars = widget.querySelectorAll('.ps-rating-btn');
        stars.forEach((star, index) => {
            star.classList.toggle('highlighted', index < rating);
        });
    }
    
    function resetStarsHighlight(widget) {
        const stars = widget.querySelectorAll('.ps-rating-btn');
        stars.forEach(star => star.classList.remove('highlighted'));
    }
    
    function updateRatingDisplay(data) {
        const average = document.querySelector('.ps-rating-average');
        const count = document.querySelector('.ps-rating-count');
        
        if (average) average.textContent = data.average || '0.0';
        if (count) count.textContent = `(${data.count || 0} تقييمات)`;
    }
    
    function getCurrentPostId() {
        const article = document.querySelector('article[id]');
        if (article) {
            return article.id.replace('post-', '');
        }
        
        const postIdEl = document.querySelector('[data-post-id]');
        if (postIdEl) {
            return postIdEl.dataset.postId;
        }
        
        const bodyClass = document.body.className.match(/postid-(\d+)/);
        return bodyClass ? bodyClass[1] : '1';
    }
    
    function showNotification(message, type) {
        if (window.PracticalSolutions?.showNotification) {
            window.PracticalSolutions.showNotification(message, type);
        }
    }
}

export default { initRatingSystem };

// =============================================================================
// ملف: src/js/modules/performance-features.js
// =============================================================================
/**
 * Performance Features Module
 * وحدة ميزات الأداء
 */

export function initPerformanceFeatures() {
    console.log('⚡ تفعيل وحدة ميزات الأداء');
    
    // تحسين التحميل الكسول للصور
    initLazyLoading();
    
    // تحسين الخطوط
    optimizeFonts();
    
    // مراقبة الأداء
    monitorPerformance();
}

function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-loading');
                        img.classList.add('lazy-loaded');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            img.classList.add('lazy-loading');
            imageObserver.observe(img);
        });
    }
}

function optimizeFonts() {
    // تحسين تحميل الخطوط
    if ('fontDisplay' in document.documentElement.style) {
        const style = document.createElement('style');
        style.textContent = `
            @font-face {
                font-family: 'Noto Sans Arabic';
                font-display: swap;
            }
        `;
        document.head.appendChild(style);
    }
}

function monitorPerformance() {
    if ('performance' in window && window.performance.getEntriesByType) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                const navigationEntries = performance.getEntriesByType('navigation');
                if (navigationEntries.length > 0) {
                    const timing = navigationEntries[0];
                    const loadTime = timing.loadEventEnd - timing.loadEventStart;
                    
                    if (window.psAjax?.debug) {
                        console.log(`Page load time: ${loadTime}ms`);
                    }
                }
            }, 1000);
        });
    }
}

export default { initPerformanceFeatures };

// =============================================================================
// ملف: src/js/modules/pwa-features.js
// =============================================================================
/**
 * PWA Features Module
 * وحدة ميزات تطبيق الويب التقدمي
 */

export function initPWAFeatures() {
    console.log('📱 تفعيل وحدة PWA');
    
    // تسجيل Service Worker
    registerServiceWorker();
    
    // إشعارات التحديث
    setupUpdateNotifications();
    
    // إشعارات التثبيت
    setupInstallPrompt();
}

function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            const swPath = window.psAjax?.theme_url ? 
                `${window.psAjax.theme_url}/sw.js` : '/sw.js';
                
            navigator.serviceWorker.register(swPath)
                .then(registration => {
                    if (window.psAjax?.debug) {
                        console.log('SW registered: ', registration);
                    }
                })
                .catch(registrationError => {
                    if (window.psAjax?.debug) {
                        console.log('SW registration failed: ', registrationError);
                    }
                });
        });
    }
}

function setupUpdateNotifications() {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.addEventListener('controllerchange', () => {
            showNotification('تم تحديث الموقع! أعد تحميل الصفحة للحصول على أحدث إصدار.', 'info');
        });
    }
}

function setupInstallPrompt() {
    let deferredPrompt;
    
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        
        // إظهار زر التثبيت
        showInstallButton(deferredPrompt);
    });
}

function showInstallButton(prompt) {
    const installButton = document.createElement('button');
    installButton.className = 'ps-install-app';
    installButton.textContent = '📱 تثبيت التطبيق';
    installButton.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background: var(--ps-color-primary, #007cba);
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    `;
    
    installButton.addEventListener('click', () => {
        prompt.prompt();
        prompt.userChoice.then((result) => {
            if (result.outcome === 'accepted') {
                console.log('User accepted the install prompt');
            }
            installButton.remove();
        });
    });
    
    document.body.appendChild(installButton);
    
    // إخفاء بعد 10 ثوان
    setTimeout(() => {
        if (installButton.parentNode) {
            installButton.remove();
        }
    }, 10000);
}

function showNotification(message, type) {
    if (window.PracticalSolutions?.showNotification) {
        window.PracticalSolutions.showNotification(message, type);
    }
}

export default { initPWAFeatures };

// =============================================================================
// ملف: src/js/modules/social-sharing.js
// =============================================================================
/**
 * Social Sharing Module
 * وحدة المشاركة الاجتماعية
 */

export function initSocialSharing() {
    console.log('📤 تفعيل وحدة المشاركة الاجتماعية');
    
    // إنشاء أزرار المشاركة
    createShareButtons();
    
    // ربط الأحداث
    setupShareEvents();
}

function createShareButtons() {
    const shareContainer = document.querySelector('.ps-social-share');
    if (shareContainer || !document.body.classList.contains('single')) return;
    
    const shareDiv = document.createElement('div');
    shareDiv.className = 'ps-social-share';
    shareDiv.innerHTML = `
        <h4>شارك هذا المقال:</h4>
        <div class="ps-share-buttons">
            <button class="ps-share-btn" data-platform="facebook" aria-label="مشاركة على فيسبوك">
                📘 فيسبوك
            </button>
            <button class="ps-share-btn" data-platform="twitter" aria-label="مشاركة على تويتر">
                🐦 تويتر
            </button>
            <button class="ps-share-btn" data-platform="linkedin" aria-label="مشاركة على لينكد إن">
                💼 لينكد إن
            </button>
            <button class="ps-share-btn" data-platform="copy" aria-label="نسخ الرابط">
                📋 نسخ الرابط
            </button>
        </div>
    `;
    
    const content = document.querySelector('.entry-content, .post-content');
    if (content) {
        content.appendChild(shareDiv);
    }
}

function setupShareEvents() {
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('ps-share-btn')) {
            const platform = e.target.dataset.platform;
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            
            switch (platform) {
                case 'facebook':
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
                    break;
                case 'twitter':
                    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank');
                    break;
                case 'linkedin':
                    window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank');
                    break;
                case 'copy':
                    copyToClipboard(window.location.href);
                    break;
            }
        }
    });
}

function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('تم نسخ الرابط!', 'success');
        });
    } else {
        // fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showNotification('تم نسخ الرابط!', 'success');
    }
}

function showNotification(message, type) {
    if (window.PracticalSolutions?.showNotification) {
        window.PracticalSolutions.showNotification(message, type);
    }
}

export default { initSocialSharing };

// =============================================================================
// ملف: src/js/modules/newsletter.js
// =============================================================================
/**
 * Newsletter Module
 * وحدة النشرة البريدية
 */

export function initNewsletter() {
    console.log('📧 تفعيل وحدة النشرة البريدية');
    
    const newsletterForms = document.querySelectorAll('.ps-newsletter-form, .newsletter-form');
    
    newsletterForms.forEach(form => {
        setupNewsletterForm(form);
    });
}

function setupNewsletterForm(form) {
    const emailInput = form.querySelector('input[type="email"]');
    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
    
    if (!emailInput || !submitButton) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        handleNewsletterSubmission(form, emailInput, submitButton);
    });
    
    emailInput.addEventListener('input', function() {
        validateEmailInput(this);
    });
}

function handleNewsletterSubmission(form, emailInput, submitButton) {
    const email = emailInput.value.trim();
    
    if (!isValidEmail(email)) {
        showError('يرجى إدخال بريد إلكتروني صحيح');
        return;
    }
    
    const originalText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'جاري الاشتراك...';
    
    // محاكاة إرسال البيانات
    setTimeout(() => {
        submitButton.disabled = false;
        submitButton.textContent = originalText;
        emailInput.value = '';
        showSuccess('تم الاشتراك بنجاح!');
    }, 2000);
}

function validateEmailInput(input) {
    const email = input.value.trim();
    if (email && !isValidEmail(email)) {
        input.setCustomValidity('يرجى إدخال بريد إلكتروني صحيح');
    } else {
        input.setCustomValidity('');
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showError(message) {
    showNotification(message, 'error');
}

function showSuccess(message) {
    showNotification(message, 'success');
}

function showNotification(message, type) {
    if (window.PracticalSolutions?.showNotification) {
        window.PracticalSolutions.showNotification(message, type);
    }
}

export default { initNewsletter };