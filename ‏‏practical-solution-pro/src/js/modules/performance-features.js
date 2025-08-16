/**
 * Performance Features Module
 * وحدة ميزات الأداء
 */

export function initPerformanceFeatures() {
    // Lazy Loading للصور
    initLazyLoading();
    
    // تحسين will-change للعناصر المتحركة
    optimizeAnimatedElements();
    
    // تأخير تحميل المحتوى غير الضروري
    deferNonCriticalContent();
}

function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        img.classList.add('loaded');
                    }
                    
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px'
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // fallback للمتصفحات القديمة
        document.querySelectorAll('img[data-src]').forEach(img => {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
            img.classList.add('loaded');
        });
    }
}

function optimizeAnimatedElements() {
    const elements = document.querySelectorAll('.ps-card, .ps-button, .ps-search-form');
    
    elements.forEach(el => {
        el.style.willChange = 'transform';
        
        // إزالة will-change بعد انتهاء التفاعل
        el.addEventListener('transitionend', function() {
            this.style.willChange = 'auto';
        });
        
        el.addEventListener('mouseenter', function() {
            this.style.willChange = 'transform';
        });
    });
}

function deferNonCriticalContent() {
    // تأخير تحميل المحتوى غير الحرج
    if ('requestIdleCallback' in window) {
        requestIdleCallback(() => {
            loadNonCriticalContent();
        });
    } else {
        setTimeout(loadNonCriticalContent, 100);
    }
}

function loadNonCriticalContent() {
    // تحميل خدمات التحليلات
    loadAnalyticsServices();
    
    // تحميل عناصر إضافية
    loadAdditionalFeatures();
}

function loadAnalyticsServices() {
    // تحميل Google Analytics إذا كان معرف المتابعة موجوداً
    if (window.psSettings && window.psSettings.gaTrackingId) {
        const script = document.createElement('script');
        script.async = true;
        script.src = `https://www.googletagmanager.com/gtag/js?id=${window.psSettings.gaTrackingId}`;
        document.head.appendChild(script);
        
        script.onload = function() {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', window.psSettings.gaTrackingId);
        };
    }
}

function loadAdditionalFeatures() {
    // تحميل ميزات إضافية حسب الحاجة
    if (document.querySelector('.ps-social-share')) {
        import('./social-sharing.js').then(module => {
            module.initSocialSharing();
        });
    }
    
    if (document.querySelector('.ps-newsletter-form')) {
        import('./newsletter.js').then(module => {
            module.initNewsletter();
        });
    }
}

// مراقبة الأداء
export function monitorPerformance() {
    if ('performance' in window && window.performance.getEntriesByType) {
        const navigationEntries = performance.getEntriesByType('navigation');
        if (navigationEntries.length > 0) {
            const timing = navigationEntries[0];
            const loadTime = timing.loadEventEnd - timing.loadEventStart;
            
            if (window.psSettings && window.psSettings.debug) {
                console.log(`Page load time: ${loadTime}ms`);
            }
        }
    }
}

export default { 
    initPerformanceFeatures, 
    monitorPerformance 
};