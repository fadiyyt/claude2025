/**
 * Practical Solutions Theme - Lazy Loading System
 * نظام التحميل الكسول للصور والمحتوى
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * كلاس نظام التحميل الكسول
 * @class LazyLoading
 */
window.LazyLoading = (function() {
    
    // المتغيرات الخاصة
    let instance = null;
    let imageObserver = null;
    let iframeObserver = null;
    let lazyImages = [];
    let lazyIframes = [];
    let isObserverSupported = false;
    let loadedCount = 0;
    let totalCount = 0;
    let progressCallback = null;

    // إعدادات افتراضية
    const defaults = {
        rootMargin: '50px 0px',
        threshold: 0.01,
        enableProgressTracking: true,
        enablePlaceholder: true,
        enableFadeIn: true,
        placeholderColor: '#f0f4f8',
        fallbackDelay: 300,
        retryAttempts: 3,
        retryDelay: 1000,
        enableWebP: true,
        enableResponsiveImages: true,
        loadingClass: 'lazy-loading',
        loadedClass: 'lazy-loaded',
        errorClass: 'lazy-error'
    };

    let settings = {};

    /**
     * تهيئة نظام التحميل الكسول
     * @param {Object} options - الخيارات
     */
    function init(options = {}) {
        if (instance) {
            PracticalSolutionsUtils.log('نظام التحميل الكسول مهيأ مسبقاً', 'warn');
            return instance;
        }

        settings = Object.assign({}, defaults, options);
        
        // التحقق من دعم Intersection Observer
        checkObserverSupport();
        
        // إعداد النظام
        setupLazyLoading();
        
        // إضافة أنماط CSS
        addLazyLoadingStyles();
        
        PracticalSolutionsUtils.log('تم تهيئة نظام التحميل الكسول بنجاح');
        
        instance = {
            loadImages: loadAllImages,
            loadIframes: loadAllIframes,
            refresh: refresh,
            addProgressCallback: addProgressCallback,
            getProgress: getProgress,
            destroy: destroy
        };

        return instance;
    }

    /**
     * التحقق من دعم Intersection Observer
     */
    function checkObserverSupport() {
        isObserverSupported = PracticalSolutionsUtils.supportsFeature('intersectionObserver');
        
        if (!isObserverSupported) {
            PracticalSolutionsUtils.log('Intersection Observer غير مدعوم، سيتم استخدام fallback', 'warn');
        }
    }

    /**
     * إعداد نظام التحميل الكسول
     */
    function setupLazyLoading() {
        // البحث عن العناصر القابلة للتحميل الكسول
        findLazyElements();
        
        if (isObserverSupported) {
            // إعداد Intersection Observer
            setupObservers();
        } else {
            // استخدام fallback للمتصفحات القديمة
            setupFallback();
        }
        
        // إعداد تتبع التقدم
        if (settings.enableProgressTracking) {
            setupProgressTracking();
        }
    }

    /**
     * البحث عن العناصر القابلة للتحميل الكسول
     */
    function findLazyElements() {
        // البحث عن الصور
        lazyImages = Array.from(document.querySelectorAll('img[data-src], img[loading="lazy"]'));
        
        // البحث عن iframes
        lazyIframes = Array.from(document.querySelectorAll('iframe[data-src]'));
        
        // حساب العدد الإجمالي
        totalCount = lazyImages.length + lazyIframes.length;
        
        // إعداد العناصر
        setupLazyImages();
        setupLazyIframes();
        
        PracticalSolutionsUtils.log(`تم العثور على ${totalCount} عنصر للتحميل الكسول`);
    }

    /**
     * إعداد الصور للتحميل الكسول
     */
    function setupLazyImages() {
        lazyImages.forEach(img => {
            // إضافة كلاس التحميل
            PracticalSolutionsUtils.addClass(img, settings.loadingClass);
            
            // إعداد البيانات
            if (!img.dataset.src && img.src) {
                img.dataset.src = img.src;
                img.removeAttribute('src');
            }
            
            // إضافة placeholder إذا كان مفعل
            if (settings.enablePlaceholder) {
                setupImagePlaceholder(img);
            }
            
            // إعداد الصور المتجاوبة
            if (settings.enableResponsiveImages) {
                setupResponsiveImage(img);
            }
            
            // إضافة معالج الخطأ
            img.addEventListener('error', handleImageError);
            img.addEventListener('load', handleImageLoad);
        });
    }

    /**
     * إعداد iframes للتحميل الكسول
     */
    function setupLazyIframes() {
        lazyIframes.forEach(iframe => {
            // إضافة كلاس التحميل
            PracticalSolutionsUtils.addClass(iframe, settings.loadingClass);
            
            // إعداد البيانات
            if (!iframe.dataset.src && iframe.src) {
                iframe.dataset.src = iframe.src;
                iframe.removeAttribute('src');
            }
            
            // إضافة placeholder
            if (settings.enablePlaceholder) {
                setupIframePlaceholder(iframe);
            }
            
            // إضافة معالج التحميل
            iframe.addEventListener('load', handleIframeLoad);
        });
    }

    /**
     * إعداد placeholder للصورة
     * @param {Element} img - عنصر الصورة
     */
    function setupImagePlaceholder(img) {
        const width = img.getAttribute('width') || img.offsetWidth || 300;
        const height = img.getAttribute('height') || img.offsetHeight || 200;
        
        // إنشاء placeholder SVG
        const placeholder = createPlaceholderSVG(width, height, 'صورة');
        
        img.src = placeholder;
        img.style.backgroundColor = settings.placeholderColor;
    }

    /**
     * إعداد placeholder لـ iframe
     * @param {Element} iframe - عنصر iframe
     */
    function setupIframePlaceholder(iframe) {
        const width = iframe.getAttribute('width') || iframe.offsetWidth || 560;
        const height = iframe.getAttribute('height') || iframe.offsetHeight || 315;
        
        // إنشاء عنصر placeholder
        const placeholder = PracticalSolutionsUtils.createElement('div', {
            className: 'iframe-placeholder',
            innerHTML: `
                <div class="placeholder-content">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <span>اضغط للتحميل</span>
                </div>
            `
        });
        
        placeholder.style.cssText = `
            width: ${width}px;
            height: ${height}px;
            background: ${settings.placeholderColor};
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
            color: #666;
            flex-direction: column;
            gap: 10px;
        `;
        
        // إدراج placeholder قبل iframe
        iframe.parentNode.insertBefore(placeholder, iframe);
        iframe.style.display = 'none';
        
        // إضافة حدث النقر للتحميل اليدوي
        placeholder.addEventListener('click', () => {
            loadIframe(iframe);
            placeholder.remove();
            iframe.style.display = 'block';
        });
        
        iframe.placeholder = placeholder;
    }

    /**
     * إعداد الصورة المتجاوبة
     * @param {Element} img - عنصر الصورة
     */
    function setupResponsiveImage(img) {
        // التحقق من وجود srcset
        if (img.dataset.srcset) {
            return; // الصورة لديها بالفعل srcset
        }
        
        // إنشاء srcset تلقائي إذا لم يكن موجود
        const src = img.dataset.src;
        if (src && !src.includes('srcset')) {
            const basename = src.substring(0, src.lastIndexOf('.'));
            const extension = src.substring(src.lastIndexOf('.'));
            
            // إنشاء أحجام مختلفة (افتراضي)
            const sizes = [
                { size: '400w', suffix: '-400w' },
                { size: '800w', suffix: '-800w' },
                { size: '1200w', suffix: '-1200w' }
            ];
            
            const srcset = sizes.map(size => `${basename}${size.suffix}${extension} ${size.size}`).join(', ');
            img.dataset.srcset = srcset;
            img.dataset.sizes = '(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw';
        }
    }

    /**
     * إعداد Intersection Observers
     */
    function setupObservers() {
        const observerOptions = {
            rootMargin: settings.rootMargin,
            threshold: settings.threshold
        };

        // Observer للصور
        if (lazyImages.length > 0) {
            imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        loadImage(img);
                        imageObserver.unobserve(img);
                    }
                });
            }, observerOptions);

            lazyImages.forEach(img => imageObserver.observe(img));
        }

        // Observer لـ iframes
        if (lazyIframes.length > 0) {
            iframeObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const iframe = entry.target;
                        loadIframe(iframe);
                        iframeObserver.unobserve(iframe);
                    }
                });
            }, observerOptions);

            lazyIframes.forEach(iframe => iframeObserver.observe(iframe));
        }
    }

    /**
     * إعداد fallback للمتصفحات القديمة
     */
    function setupFallback() {
        // استخدام حدث التمرير كـ fallback
        const checkLazyElements = PracticalSolutionsUtils.throttle(() => {
            lazyImages.forEach(img => {
                if (isElementInViewport(img)) {
                    loadImage(img);
                }
            });

            lazyIframes.forEach(iframe => {
                if (isElementInViewport(iframe)) {
                    loadIframe(iframe);
                }
            });
        }, 100);

        window.addEventListener('scroll', checkLazyElements);
        window.addEventListener('resize', checkLazyElements);
        
        // تحميل أولي للعناصر المرئية
        setTimeout(checkLazyElements, settings.fallbackDelay);
    }

    /**
     * التحقق من أن العنصر في منطقة العرض
     * @param {Element} element - العنصر
     * @returns {boolean}
     */
    function isElementInViewport(element) {
        const rect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        const windowWidth = window.innerWidth || document.documentElement.clientWidth;
        
        return (
            rect.top <= windowHeight + 50 &&
            rect.bottom >= -50 &&
            rect.left <= windowWidth &&
            rect.right >= 0
        );
    }

    /**
     * تحميل صورة
     * @param {Element} img - عنصر الصورة
     * @param {number} attempt - محاولة التحميل
     */
    function loadImage(img, attempt = 1) {
        if (!img.dataset.src) return;

        // التحقق من دعم WebP
        const src = settings.enableWebP ? getWebPVersion(img.dataset.src) : img.dataset.src;
        
        // إنشاء صورة جديدة للتحميل المسبق
        const imageLoader = new Image();
        
        imageLoader.onload = () => {
            // تطبيق الصورة على العنصر الأصلي
            img.src = src;
            
            // تطبيق srcset إذا كان موجود
            if (img.dataset.srcset) {
                img.srcset = img.dataset.srcset;
            }
            
            if (img.dataset.sizes) {
                img.sizes = img.dataset.sizes;
            }
            
            // إزالة data attributes
            delete img.dataset.src;
            delete img.dataset.srcset;
            delete img.dataset.sizes;
            
            // تطبيق تأثير التحميل
            applyLoadedEffect(img);
        };
        
        imageLoader.onerror = () => {
            handleLoadError(img, attempt, 'image');
        };
        
        // بدء التحميل
        imageLoader.src = src;
    }

    /**
     * تحميل iframe
     * @param {Element} iframe - عنصر iframe
     * @param {number} attempt - محاولة التحميل
     */
    function loadIframe(iframe, attempt = 1) {
        if (!iframe.dataset.src) return;

        // تطبيق المصدر
        iframe.src = iframe.dataset.src;
        
        // إزالة data attribute
        delete iframe.dataset.src;
        
        // إزالة placeholder إذا كان موجود
        if (iframe.placeholder) {
            iframe.placeholder.remove();
            iframe.style.display = 'block';
        }
        
        // تطبيق تأثير التحميل
        applyLoadedEffect(iframe);
    }

    /**
     * معالجة خطأ التحميل
     * @param {Element} element - العنصر
     * @param {number} attempt - محاولة التحميل
     * @param {string} type - نوع العنصر
     */
    function handleLoadError(element, attempt, type) {
        if (attempt < settings.retryAttempts) {
            // إعادة المحاولة بعد تأخير
            setTimeout(() => {
                PracticalSolutionsUtils.log(`إعادة محاولة تحميل ${type}: ${attempt + 1}/${settings.retryAttempts}`);
                
                if (type === 'image') {
                    loadImage(element, attempt + 1);
                } else if (type === 'iframe') {
                    loadIframe(element, attempt + 1);
                }
            }, settings.retryDelay * attempt);
        } else {
            // تطبيق كلاس الخطأ
            PracticalSolutionsUtils.removeClass(element, settings.loadingClass);
            PracticalSolutionsUtils.addClass(element, settings.errorClass);
            
            // إنشاء صورة خطأ للصور
            if (type === 'image') {
                element.src = createErrorPlaceholder();
                element.alt = 'فشل في تحميل الصورة';
            }
            
            PracticalSolutionsUtils.log(`فشل في تحميل ${type} بعد ${settings.retryAttempts} محاولات`, 'error');
            
            // تحديث التقدم
            updateProgress();
        }
    }

    /**
     * تطبيق تأثير التحميل المكتمل
     * @param {Element} element - العنصر
     */
    function applyLoadedEffect(element) {
        // إزالة كلاس التحميل وإضافة كلاس التحميل المكتمل
        PracticalSolutionsUtils.removeClass(element, settings.loadingClass);
        PracticalSolutionsUtils.addClass(element, settings.loadedClass);
        
        // تطبيق تأثير fade-in إذا كان مفعل
        if (settings.enableFadeIn) {
            element.style.opacity = '0';
            element.style.transition = 'opacity 0.3s ease';
            
            // استخدام requestAnimationFrame لضمان التأثير
            requestAnimationFrame(() => {
                element.style.opacity = '1';
            });
        }
        
        // إطلاق حدث مخصص
        const loadedEvent = new CustomEvent('lazyLoaded', {
            detail: { element: element }
        });
        element.dispatchEvent(loadedEvent);
        
        // تحديث التقدم
        updateProgress();
    }

    /**
     * معالجة تحميل الصورة
     * @param {Event} event - حدث التحميل
     */
    function handleImageLoad(event) {
        const img = event.target;
        PracticalSolutionsUtils.log(`تم تحميل الصورة: ${img.src}`);
    }

    /**
     * معالجة خطأ الصورة
     * @param {Event} event - حدث الخطأ
     */
    function handleImageError(event) {
        const img = event.target;
        PracticalSolutionsUtils.log(`فشل في تحميل الصورة: ${img.src}`, 'error');
    }

    /**
     * معالجة تحميل iframe
     * @param {Event} event - حدث التحميل
     */
    function handleIframeLoad(event) {
        const iframe = event.target;
        PracticalSolutionsUtils.log(`تم تحميل iframe: ${iframe.src}`);
    }

    /**
     * الحصول على نسخة WebP من الصورة
     * @param {string} src - مصدر الصورة
     * @returns {string}
     */
    function getWebPVersion(src) {
        // التحقق من دعم WebP
        if (!supportsWebP()) {
            return src;
        }
        
        // تحويل الصورة لـ WebP إذا كان ممكن
        const extension = src.substring(src.lastIndexOf('.'));
        const supportedFormats = ['.jpg', '.jpeg', '.png'];
        
        if (supportedFormats.includes(extension.toLowerCase())) {
            return src.replace(extension, '.webp');
        }
        
        return src;
    }

    /**
     * التحقق من دعم WebP
     * @returns {boolean}
     */
    function supportsWebP() {
        const canvas = document.createElement('canvas');
        canvas.width = 1;
        canvas.height = 1;
        
        return canvas.toDataURL('image/webp').indexOf('data:image/webp') === 0;
    }

    /**
     * إنشاء placeholder SVG
     * @param {number} width - العرض
     * @param {number} height - الارتفاع
     * @param {string} text - النص
     * @returns {string}
     */
    function createPlaceholderSVG(width, height, text) {
        const svg = `
            <svg width="${width}" height="${height}" xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="${settings.placeholderColor}"/>
                <text x="50%" y="50%" text-anchor="middle" dy=".3em" 
                      font-family="Arial, sans-serif" font-size="14" fill="#999">
                    ${text}
                </text>
            </svg>
        `;
        
        return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg);
    }

    /**
     * إنشاء placeholder للخطأ
     * @returns {string}
     */
    function createErrorPlaceholder() {
        const svg = `
            <svg width="200" height="150" xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="#f8f9fa"/>
                <circle cx="100" cy="60" r="20" fill="#dc3545"/>
                <text x="100" y="65" text-anchor="middle" fill="white" font-size="24">!</text>
                <text x="100" y="100" text-anchor="middle" font-family="Arial" font-size="12" fill="#6c757d">
                    فشل في التحميل
                </text>
            </svg>
        `;
        
        return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg);
    }

    /**
     * إعداد تتبع التقدم
     */
    function setupProgressTracking() {
        loadedCount = 0;
        
        // تسجيل مستمع للأحداث المخصصة
        document.addEventListener('lazyLoaded', updateProgress);
    }

    /**
     * تحديث التقدم
     */
    function updateProgress() {
        loadedCount++;
        
        const progress = totalCount > 0 ? (loadedCount / totalCount) * 100 : 100;
        
        // استدعاء callback إذا كان موجود
        if (progressCallback && typeof progressCallback === 'function') {
            progressCallback(progress, loadedCount, totalCount);
        }
        
        // إطلاق حدث تقدم عام
        const progressEvent = new CustomEvent('lazyLoadingProgress', {
            detail: {
                progress: progress,
                loaded: loadedCount,
                total: totalCount
            }
        });
        document.dispatchEvent(progressEvent);
        
        // تسجيل في الكونسول
        if (loadedCount === totalCount) {
            PracticalSolutionsUtils.log(`تم الانتهاء من التحميل الكسول: ${loadedCount}/${totalCount} عنصر`);
        }
    }

    /**
     * إضافة callback للتقدم
     * @param {Function} callback - دالة callback
     */
    function addProgressCallback(callback) {
        progressCallback = callback;
    }

    /**
     * الحصول على التقدم الحالي
     * @returns {Object}
     */
    function getProgress() {
        return {
            progress: totalCount > 0 ? (loadedCount / totalCount) * 100 : 100,
            loaded: loadedCount,
            total: totalCount
        };
    }

    /**
     * تحميل جميع الصور فورياً
     */
    function loadAllImages() {
        lazyImages.forEach(img => {
            if (img.dataset.src) {
                loadImage(img);
                if (imageObserver) {
                    imageObserver.unobserve(img);
                }
            }
        });
    }

    /**
     * تحميل جميع iframes فورياً
     */
    function loadAllIframes() {
        lazyIframes.forEach(iframe => {
            if (iframe.dataset.src) {
                loadIframe(iframe);
                if (iframeObserver) {
                    iframeObserver.unobserve(iframe);
                }
            }
        });
    }

    /**
     * تحديث النظام للعناصر الجديدة
     */
    function refresh() {
        // إيقاف observers الحالية
        if (imageObserver) {
            imageObserver.disconnect();
        }
        if (iframeObserver) {
            iframeObserver.disconnect();
        }
        
        // إعادة البحث والإعداد
        findLazyElements();
        
        if (isObserverSupported) {
            setupObservers();
        }
        
        PracticalSolutionsUtils.log('تم تحديث نظام التحميل الكسول');
    }

    /**
     * إضافة أنماط CSS للتحميل الكسول
     */
    function addLazyLoadingStyles() {
        if (document.getElementById('ps-lazy-loading-styles')) return;

        const styles = `
            /* أنماط التحميل الكسول */
            .lazy-loading {
                opacity: 0.7;
                transition: opacity 0.3s ease;
            }

            .lazy-loaded {
                opacity: 1;
            }

            .lazy-error {
                opacity: 0.5;
                filter: grayscale(100%);
            }

            /* placeholder للصور */
            img.lazy-loading {
                background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
                background-size: 200% 100%;
                animation: shimmer 1.5s infinite;
            }

            /* placeholder لـ iframes */
            .iframe-placeholder {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                border: 2px dashed #ddd;
                transition: all 0.3s ease;
            }

            .iframe-placeholder:hover {
                border-color: var(--wp--preset--color--primary, #007cba);
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .placeholder-content {
                text-align: center;
                font-size: 0.9rem;
                font-weight: 500;
            }

            /* تأثير shimmer */
            @keyframes shimmer {
                0% {
                    background-position: -200% 0;
                }
                100% {
                    background-position: 200% 0;
                }
            }

            /* تحسينات الأداء */
            img[data-src] {
                background: ${settings.placeholderColor};
                min-height: 100px;
            }

            iframe[data-src] {
                background: ${settings.placeholderColor};
                min-height: 200px;
            }

            /* تأثيرات التحميل */
            .lazy-loaded {
                animation: fadeInUp 0.5s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* معالجة الصور المكسورة */
            .lazy-error::after {
                content: '⚠️ فشل في التحميل';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(220, 53, 69, 0.9);
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 4px;
                font-size: 0.8rem;
                white-space: nowrap;
            }

            /* نمط الصور المتجاوبة */
            img.lazy-loading,
            img.lazy-loaded {
                max-width: 100%;
                height: auto;
            }

            /* تحسينات للأجهزة المحمولة */
            @media (max-width: 768px) {
                .iframe-placeholder {
                    min-height: 200px;
                }
                
                .lazy-error::after {
                    font-size: 0.7rem;
                    padding: 0.25rem 0.5rem;
                }
            }
        `;

        const styleSheet = PracticalSolutionsUtils.createElement('style', {
            id: 'ps-lazy-loading-styles'
        }, styles);

        document.head.appendChild(styleSheet);
    }

    /**
     * تدمير نظام التحميل الكسول
     */
    function destroy() {
        // إيقاف observers
        if (imageObserver) {
            imageObserver.disconnect();
            imageObserver = null;
        }
        
        if (iframeObserver) {
            iframeObserver.disconnect();
            iframeObserver = null;
        }
        
        // إزالة مستمعي الأحداث
        document.removeEventListener('lazyLoaded', updateProgress);
        
        lazyImages.forEach(img => {
            img.removeEventListener('error', handleImageError);
            img.removeEventListener('load', handleImageLoad);
        });
        
        lazyIframes.forEach(iframe => {
            iframe.removeEventListener('load', handleIframeLoad);
        });
        
        // مسح المتغيرات
        lazyImages = [];
        lazyIframes = [];
        loadedCount = 0;
        totalCount = 0;
        progressCallback = null;
        instance = null;
        
        PracticalSolutionsUtils.log('تم تدمير نظام التحميل الكسول');
    }

    // إرجاع الوظائف العامة
    return {
        init: init
    };

})();