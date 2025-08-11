/**
 * Practical Solutions Theme - Navigation System
 * نظام التنقل المتقدم
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * نظام التنقل المتقدم
 * @namespace PracticalSolutionsNavigation
 */
window.PracticalSolutionsNavigation = (function() {
    
    // المتغيرات الخاصة
    let instance = null;
    let isInitialized = false;
    let isMobileMenuOpen = false;
    let isScrolling = false;
    let lastScrollTop = 0;
    let scrollTimer = null;
    
    // عناصر DOM
    let header = null;
    let mobileMenuToggle = null;
    let mobileMenu = null;
    let navigationLinks = null;
    let backToTopBtn = null;
    let searchToggle = null;
    
    // إعدادات افتراضية
    const defaults = {
        enableStickyHeader: true,
        enableBackToTop: true,
        enableSmoothScroll: true,
        mobileBreakpoint: 768,
        scrollThreshold: 100,
        autoCloseMobileMenu: true,
        enableKeyboardNavigation: true,
        animationDuration: 300
    };
    
    let settings = {};

    /**
     * تهيئة نظام التنقل
     * @param {Object} options - الخيارات
     */
    function init(options = {}) {
        if (instance) {
            console.warn('نظام التنقل مهيأ مسبقاً');
            return instance;
        }

        settings = Object.assign({}, defaults, options);
        
        // البحث عن العناصر
        findElements();
        
        if (!header) {
            console.warn('رأس الصفحة غير موجود');
            return null;
        }
        
        // إعداد الأحداث
        setupEvents();
        
        // إعداد الميزات
        if (settings.enableStickyHeader) {
            setupStickyHeader();
        }
        
        if (settings.enableBackToTop) {
            setupBackToTop();
        }
        
        if (settings.enableSmoothScroll) {
            setupSmoothScroll();
        }
        
        if (settings.enableKeyboardNavigation) {
            setupKeyboardNavigation();
        }
        
        // إعداد القائمة المحمولة
        setupMobileMenu();
        
        // إعداد البحث في الرأس
        setupHeaderSearch();
        
        isInitialized = true;
        console.log('تم تهيئة نظام التنقل بنجاح');
        
        instance = {
            toggleMobileMenu: toggleMobileMenu,
            closeMobileMenu: closeMobileMenu,
            openMobileMenu: openMobileMenu,
            scrollToTop: scrollToTop,
            scrollToElement: scrollToElement,
            showBackToTop: showBackToTop,
            hideBackToTop: hideBackToTop,
            isInitialized: () => isInitialized,
            destroy: destroy
        };
        
        return instance;
    }

    /**
     * البحث عن العناصر في الصفحة
     */
    function findElements() {
        header = document.querySelector('.site-header, header, .main-header');
        mobileMenuToggle = document.querySelector('.mobile-menu-toggle, .menu-toggle, .hamburger');
        mobileMenu = document.querySelector('.mobile-menu, .responsive-menu, .wp-block-navigation__responsive-container');
        navigationLinks = document.querySelectorAll('.wp-block-navigation a, .menu a, nav a');
        backToTopBtn = document.querySelector('#back-to-top, .back-to-top, .scroll-to-top');
        searchToggle = document.querySelector('.search-toggle, .header-search-toggle');
        
        // إنشاء عناصر مفقودة إذا لم توجد
        createMissingElements();
    }

    /**
     * إنشاء عناصر مفقودة
     */
    function createMissingElements() {
        // إنشاء زر القائمة المحمولة إذا لم يوجد
        if (!mobileMenuToggle && header) {
            mobileMenuToggle = document.createElement('button');
            mobileMenuToggle.className = 'mobile-menu-toggle';
            mobileMenuToggle.innerHTML = `
                <span class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </span>
                <span class="sr-only">تبديل القائمة</span>
            `;
            mobileMenuToggle.setAttribute('aria-label', 'تبديل القائمة');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            
            // إدراج الزر في المكان المناسب
            const headerContainer = header.querySelector('.main-header, .site-branding') || header;
            headerContainer.appendChild(mobileMenuToggle);
        }
        
        // إنشاء زر العودة لأعلى إذا لم يوجد
        if (!backToTopBtn && settings.enableBackToTop) {
            backToTopBtn = document.createElement('button');
            backToTopBtn.id = 'back-to-top';
            backToTopBtn.className = 'back-to-top-btn';
            backToTopBtn.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 14L12 9L17 14H7Z"/>
                </svg>
                <span class="sr-only">العودة لأعلى</span>
            `;
            backToTopBtn.setAttribute('aria-label', 'العودة لأعلى الصفحة');
            backToTopBtn.style.cssText = `
                position: fixed;
                bottom: 2rem;
                left: 2rem;
                background: var(--wp--preset--color--primary, #007cba);
                color: white;
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transition: all 0.3s ease;
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transform: translateY(20px);
            `;
            
            document.body.appendChild(backToTopBtn);
        }
    }

    /**
     * إعداد الأحداث
     */
    function setupEvents() {
        // أحداث التمرير
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
        
        // أحداث تغيير حجم النافذة
        window.addEventListener('resize', debounce(handleResize, 250));
        
        // أحداث القائمة المحمولة
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', toggleMobileMenu);
        }
        
        // أحداث زر العودة لأعلى
        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', scrollToTop);
        }
        
        // إغلاق القائمة المحمولة عند النقر خارجها
        document.addEventListener('click', handleOutsideClick);
        
        // أحداث لوحة المفاتيح
        document.addEventListener('keydown', handleKeyPress);
    }

    /**
     * إعداد الرأس الثابت
     */
    function setupStickyHeader() {
        if (!header) return;
        
        // إضافة كلاس الرأس الثابت
        header.classList.add('sticky-header');
        
        // إضافة أنماط CSS
        const style = document.createElement('style');
        style.textContent = `
            .sticky-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 999;
                transition: transform 0.3s ease, background-color 0.3s ease;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }
            
            .sticky-header.header-hidden {
                transform: translateY(-100%);
            }
            
            .sticky-header.header-scrolled {
                background: rgba(255, 255, 255, 0.98);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            
            body.has-sticky-header {
                padding-top: var(--header-height, 80px);
            }
            
            @media (max-width: 768px) {
                body.has-sticky-header {
                    padding-top: var(--header-height-mobile, 60px);
                }
            }
        `;
        document.head.appendChild(style);
        
        // تحديد ارتفاع الرأس
        const headerHeight = header.offsetHeight;
        document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
        document.body.classList.add('has-sticky-header');
    }

    /**
     * إعداد زر العودة لأعلى
     */
    function setupBackToTop() {
        if (!backToTopBtn) return;
        
        // إضافة أنماط CSS
        const style = document.createElement('style');
        style.textContent = `
            .back-to-top-btn {
                position: fixed !important;
                bottom: 2rem !important;
                left: 2rem !important;
                background: var(--wp--preset--color--primary, #007cba) !important;
                color: white !important;
                border: none !important;
                border-radius: 50% !important;
                width: 50px !important;
                height: 50px !important;
                cursor: pointer !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
                transition: all 0.3s ease !important;
                z-index: 1000 !important;
                opacity: 0 !important;
                visibility: hidden !important;
                transform: translateY(20px) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            
            .back-to-top-btn.visible {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
            }
            
            .back-to-top-btn:hover {
                background: var(--wp--preset--color--secondary, #f0f4f8) !important;
                color: var(--wp--preset--color--primary, #007cba) !important;
                transform: translateY(-3px) !important;
                box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
            }
            
            @media (max-width: 768px) {
                .back-to-top-btn {
                    bottom: 1rem !important;
                    left: 1rem !important;
                    width: 45px !important;
                    height: 45px !important;
                }
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * إعداد التمرير السلس
     */
    function setupSmoothScroll() {
        // إضافة تمرير سلس للروابط المحلية
        navigationLinks.forEach(link => {
            if (link.getAttribute('href')?.startsWith('#')) {
                link.addEventListener('click', handleSmoothScroll);
            }
        });
        
        // إضافة CSS للتمرير السلس
        document.documentElement.style.scrollBehavior = 'smooth';
    }

    /**
     * إعداد القائمة المحمولة
     */
    function setupMobileMenu() {
        if (!mobileMenuToggle) return;
        
        // إضافة أنماط CSS للقائمة المحمولة
        const style = document.createElement('style');
        style.textContent = `
            .mobile-menu-toggle {
                display: none;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0.5rem;
                z-index: 1001;
                position: relative;
            }
            
            .hamburger-lines {
                display: flex;
                flex-direction: column;
                width: 24px;
                height: 18px;
                justify-content: space-between;
            }
            
            .hamburger-lines .line {
                height: 2px;
                width: 100%;
                background: var(--wp--preset--color--foreground, #2c3e50);
                transition: all 0.3s ease;
                transform-origin: center;
            }
            
            .mobile-menu-toggle.active .line1 {
                transform: rotate(45deg) translate(5px, 5px);
            }
            
            .mobile-menu-toggle.active .line2 {
                opacity: 0;
            }
            
            .mobile-menu-toggle.active .line3 {
                transform: rotate(-45deg) translate(7px, -6px);
            }
            
            @media (max-width: 768px) {
                .mobile-menu-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .wp-block-navigation__responsive-container-open .wp-block-navigation__responsive-container {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(255, 255, 255, 0.98);
                    backdrop-filter: blur(10px);
                    z-index: 1000;
                    padding: 2rem;
                    overflow-y: auto;
                }
            }
            
            .sr-only {
                position: absolute !important;
                width: 1px !important;
                height: 1px !important;
                padding: 0 !important;
                margin: -1px !important;
                overflow: hidden !important;
                clip: rect(0,0,0,0) !important;
                white-space: nowrap !important;
                border: 0 !important;
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * إعداد البحث في الرأس
     */
    function setupHeaderSearch() {
        const headerSearchForm = document.querySelector('.header-search-form');
        if (!headerSearchForm) return;
        
        const searchInput = headerSearchForm.querySelector('input[type="search"]');
        if (!searchInput) return;
        
        // تحسين تجربة البحث في الرأس
        searchInput.addEventListener('focus', () => {
            headerSearchForm.classList.add('focused');
        });
        
        searchInput.addEventListener('blur', () => {
            setTimeout(() => {
                headerSearchForm.classList.remove('focused');
            }, 200);
        });
        
        // إضافة أنماط للبحث في الرأس
        const style = document.createElement('style');
        style.textContent = `
            .header-search-form.focused .search-input-container {
                box-shadow: 0 4px 20px rgba(0, 124, 186, 0.2) !important;
                background: white !important;
            }
            
            @media (max-width: 768px) {
                .header-search {
                    display: none;
                }
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * إعداد التنقل بلوحة المفاتيح
     */
    function setupKeyboardNavigation() {
        // إضافة دعم مفاتيح الأسهم للقوائم
        navigationLinks.forEach((link, index) => {
            link.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                    e.preventDefault();
                    const nextLink = navigationLinks[index + 1] || navigationLinks[0];
                    nextLink.focus();
                } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                    e.preventDefault();
                    const prevLink = navigationLinks[index - 1] || navigationLinks[navigationLinks.length - 1];
                    prevLink.focus();
                }
            });
        });
    }

    /**
     * معالجة التمرير
     */
    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // إدارة الرأس الثابت
        if (settings.enableStickyHeader && header) {
            if (scrollTop > settings.scrollThreshold) {
                header.classList.add('header-scrolled');
                
                // إخفاء الرأس عند التمرير لأسفل
                if (scrollTop > lastScrollTop && scrollTop > settings.scrollThreshold * 2) {
                    header.classList.add('header-hidden');
                } else {
                    header.classList.remove('header-hidden');
                }
            } else {
                header.classList.remove('header-scrolled', 'header-hidden');
            }
        }
        
        // إدارة زر العودة لأعلى
        if (settings.enableBackToTop && backToTopBtn) {
            if (scrollTop > settings.scrollThreshold * 3) {
                showBackToTop();
            } else {
                hideBackToTop();
            }
        }
        
        lastScrollTop = scrollTop;
    }

    /**
     * معالجة تغيير حجم النافذة
     */
    function handleResize() {
        // إغلاق القائمة المحمولة عند تغيير الحجم للديسكتوب
        if (window.innerWidth > settings.mobileBreakpoint && isMobileMenuOpen) {
            closeMobileMenu();
        }
        
        // تحديث ارتفاع الرأس
        if (header && settings.enableStickyHeader) {
            const headerHeight = header.offsetHeight;
            document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
        }
    }

    /**
     * معالجة النقر خارج القائمة
     */
    function handleOutsideClick(e) {
        if (isMobileMenuOpen && 
            !mobileMenu?.contains(e.target) && 
            !mobileMenuToggle?.contains(e.target)) {
            closeMobileMenu();
        }
    }

    /**
     * معالجة مفاتيح لوحة المفاتيح
     */
    function handleKeyPress(e) {
        // إغلاق القائمة المحمولة بمفتاح Escape
        if (e.key === 'Escape' && isMobileMenuOpen) {
            closeMobileMenu();
            mobileMenuToggle?.focus();
        }
        
        // التنقل بمفتاح Tab في القائمة المحمولة
        if (e.key === 'Tab' && isMobileMenuOpen) {
            trapFocus(e);
        }
    }

    /**
     * معالجة التمرير السلس
     */
    function handleSmoothScroll(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            scrollToElement(targetElement);
            
            // إغلاق القائمة المحمولة إذا كانت مفتوحة
            if (isMobileMenuOpen) {
                closeMobileMenu();
            }
        }
    }

    /**
     * حبس التركيز في القائمة المحمولة
     */
    function trapFocus(e) {
        if (!mobileMenu) return;
        
        const focusableElements = mobileMenu.querySelectorAll(
            'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
        );
        
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        if (e.shiftKey && document.activeElement === firstElement) {
            e.preventDefault();
            lastElement.focus();
        } else if (!e.shiftKey && document.activeElement === lastElement) {
            e.preventDefault();
            firstElement.focus();
        }
    }

    /**
     * تبديل القائمة المحمولة
     */
    function toggleMobileMenu() {
        if (isMobileMenuOpen) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    }

    /**
     * فتح القائمة المحمولة
     */
    function openMobileMenu() {
        if (!mobileMenuToggle) return;
        
        isMobileMenuOpen = true;
        mobileMenuToggle.classList.add('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'true');
        document.body.classList.add('mobile-menu-open');
        
        // تشغيل نظام ووردبريس للقائمة المتجاوبة
        const navContainer = document.querySelector('.wp-block-navigation');
        if (navContainer) {
            navContainer.classList.add('wp-block-navigation__responsive-container-open');
        }
        
        // منع التمرير في الخلفية
        document.body.style.overflow = 'hidden';
        
        // التركيز على أول رابط
        setTimeout(() => {
            const firstLink = mobileMenu?.querySelector('a, button');
            firstLink?.focus();
        }, 100);
    }

    /**
     * إغلاق القائمة المحمولة
     */
    function closeMobileMenu() {
        if (!mobileMenuToggle) return;
        
        isMobileMenuOpen = false;
        mobileMenuToggle.classList.remove('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('mobile-menu-open');
        
        // إيقاف نظام ووردبريس للقائمة المتجاوبة
        const navContainer = document.querySelector('.wp-block-navigation');
        if (navContainer) {
            navContainer.classList.remove('wp-block-navigation__responsive-container-open');
        }
        
        // السماح بالتمرير مرة أخرى
        document.body.style.overflow = '';
    }

    /**
     * التمرير لأعلى الصفحة
     */
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    /**
     * التمرير لعنصر محدد
     */
    function scrollToElement(element, offset = 0) {
        if (!element) return;
        
        const headerHeight = header?.offsetHeight || 0;
        const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - headerHeight - offset;
        
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }

    /**
     * إظهار زر العودة لأعلى
     */
    function showBackToTop() {
        if (backToTopBtn) {
            backToTopBtn.classList.add('visible');
        }
    }

    /**
     * إخفاء زر العودة لأعلى
     */
    function hideBackToTop() {
        if (backToTopBtn) {
            backToTopBtn.classList.remove('visible');
        }
    }

    /**
     * تأخير تنفيذ دالة
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * تدمير النظام
     */
    function destroy() {
        // إزالة الأحداث
        window.removeEventListener('scroll', handleScroll);
        window.removeEventListener('resize', handleResize);
        document.removeEventListener('click', handleOutsideClick);
        document.removeEventListener('keydown', handleKeyPress);
        
        if (mobileMenuToggle) {
            mobileMenuToggle.removeEventListener('click', toggleMobileMenu);
        }
        
        if (backToTopBtn) {
            backToTopBtn.removeEventListener('click', scrollToTop);
        }
        
        // إعادة تعيين المتغيرات
        isInitialized = false;
        instance = null;
        isMobileMenuOpen = false;
        
        console.log('تم تدمير نظام التنقل');
    }

    // تصدير واجهة برمجة التطبيقات العامة
    return {
        init: init,
        toggleMobileMenu: toggleMobileMenu,
        closeMobileMenu: closeMobileMenu,
        openMobileMenu: openMobileMenu,
        scrollToTop: scrollToTop,
        scrollToElement: scrollToElement,
        isInitialized: () => isInitialized,
        destroy: destroy
    };

})();