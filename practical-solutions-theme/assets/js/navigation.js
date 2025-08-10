/**
 * Practical Solutions Theme - Navigation System
 * نظام التنقل والقوائم
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * كلاس نظام التنقل
 * @class NavigationSystem
 */
window.NavigationSystem = (function() {
    
    // المتغيرات الخاصة
    let instance = null;
    let mobileMenuToggle = null;
    let mobileMenuOverlay = null;
    let primaryNavigation = null;
    let header = null;
    let backToTopButton = null;
    let isMobileMenuOpen = false;
    let isScrolled = false;
    let lastScrollTop = 0;
    let headerHeight = 0;
    let scrollThreshold = 100;
    let currentSubMenu = null;

    // إعدادات افتراضية
    const defaults = {
        enableStickyHeader: true,
        enableBackToTop: true,
        enableSmoothScroll: true,
        enableKeyboardNavigation: true,
        mobileBreakpoint: 768,
        scrollThreshold: 100,
        autoCloseDelay: 300,
        animationDuration: 300
    };

    let settings = {};

    /**
     * تهيئة نظام التنقل
     * @param {Object} options - الخيارات
     */
    function init(options = {}) {
        if (instance) {
            PracticalSolutionsUtils.log('نظام التنقل مهيأ مسبقاً', 'warn');
            return instance;
        }

        settings = Object.assign({}, defaults, options);
        
        // البحث عن العناصر المطلوبة
        findElements();
        
        // إعداد التنقل
        setupNavigation();
        
        // ربط الأحداث
        bindEvents();
        
        // إعداد العودة لأعلى
        if (settings.enableBackToTop) {
            setupBackToTop();
        }
        
        // إعداد التمرير السلس
        if (settings.enableSmoothScroll) {
            setupSmoothScroll();
        }
        
        // إضافة أنماط CSS
        addNavigationStyles();
        
        PracticalSolutionsUtils.log('تم تهيئة نظام التنقل بنجاح');
        
        instance = {
            openMobileMenu: openMobileMenu,
            closeMobileMenu: closeMobileMenu,
            toggleMobileMenu: toggleMobileMenu,
            scrollToTop: scrollToTop,
            scrollToElement: scrollToElement,
            isMobileMenuOpen: () => isMobileMenuOpen,
            destroy: destroy
        };

        return instance;
    }

    /**
     * البحث عن العناصر في الصفحة
     */
    function findElements() {
        mobileMenuToggle = PracticalSolutionsUtils.getElement('.mobile-menu-toggle') ||
                          PracticalSolutionsUtils.getElement('.menu-toggle');
        
        mobileMenuOverlay = PracticalSolutionsUtils.getElement('.mobile-menu-overlay') ||
                           PracticalSolutionsUtils.getElement('.mobile-menu');
        
        primaryNavigation = PracticalSolutionsUtils.getElement('.primary-navigation') ||
                           PracticalSolutionsUtils.getElement('.main-navigation');
        
        header = PracticalSolutionsUtils.getElement('.site-header') ||
                PracticalSolutionsUtils.getElement('header');

        // إنشاء زر العودة لأعلى إذا لم يكن موجود
        createBackToTopButton();
    }

    /**
     * إعداد التنقل
     */
    function setupNavigation() {
        // حساب ارتفاع الرأس
        if (header) {
            headerHeight = header.offsetHeight;
        }

        // إعداد القائمة المحمولة
        setupMobileMenu();
        
        // إعداد القوائم الفرعية
        setupSubMenus();
        
        // إعداد إمكانية الوصول
        setupAccessibility();
        
        // إعداد الرأس الثابت
        if (settings.enableStickyHeader) {
            setupStickyHeader();
        }
    }

    /**
     * إعداد القائمة المحمولة
     */
    function setupMobileMenu() {
        if (!mobileMenuToggle) return;

        // إضافة خصائص إمكانية الوصول
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        mobileMenuToggle.setAttribute('aria-controls', 'mobile-menu');
        mobileMenuToggle.setAttribute('aria-label', getTranslation('menu_toggle'));

        if (mobileMenuOverlay) {
            mobileMenuOverlay.setAttribute('id', 'mobile-menu');
            mobileMenuOverlay.setAttribute('aria-hidden', 'true');
        }

        // إضافة أيقونة الهامبرغر إذا لم تكن موجودة
        if (!mobileMenuToggle.querySelector('svg') && !mobileMenuToggle.querySelector('.menu-icon')) {
            mobileMenuToggle.innerHTML = `
                <span class="menu-icon">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </span>
                <span class="sr-only">${getTranslation('menu_toggle')}</span>
            `;
        }
    }

    /**
     * إعداد القوائم الفرعية
     */
    function setupSubMenus() {
        if (!primaryNavigation) return;

        const subMenuToggles = primaryNavigation.querySelectorAll('.wp-block-navigation-submenu');
        
        subMenuToggles.forEach(submenu => {
            const toggle = submenu.querySelector('.wp-block-navigation-submenu__toggle');
            const menu = submenu.querySelector('.wp-block-navigation-submenu__container');
            
            if (toggle && menu) {
                // إضافة خصائص إمكانية الوصول
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-haspopup', 'true');
                
                const menuId = `submenu-${Math.random().toString(36).substr(2, 9)}`;
                menu.setAttribute('id', menuId);
                toggle.setAttribute('aria-controls', menuId);
                
                // ربط الأحداث
                bindSubMenuEvents(submenu, toggle, menu);
            }
        });
    }

    /**
     * ربط أحداث القائمة الفرعية
     * @param {Element} submenu - عنصر القائمة الفرعية
     * @param {Element} toggle - زر التبديل
     * @param {Element} menu - القائمة
     */
    function bindSubMenuEvents(submenu, toggle, menu) {
        // النقر على زر التبديل
        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSubMenu(submenu, toggle, menu);
        });

        // التمرير بالفأرة (للديسكتوب)
        if (!PracticalSolutionsUtils.isMobile()) {
            submenu.addEventListener('mouseenter', () => {
                openSubMenu(submenu, toggle, menu);
            });

            submenu.addEventListener('mouseleave', () => {
                closeSubMenu(submenu, toggle, menu);
            });
        }

        // أحداث لوحة المفاتيح
        if (settings.enableKeyboardNavigation) {
            toggle.addEventListener('keydown', (e) => {
                handleSubMenuKeydown(e, submenu, toggle, menu);
            });
        }
    }

    /**
     * إعداد إمكانية الوصول
     */
    function setupAccessibility() {
        // تحسين التنقل بلوحة المفاتيح
        if (settings.enableKeyboardNavigation && primaryNavigation) {
            const focusableElements = primaryNavigation.querySelectorAll(
                'a, button, [tabindex]:not([tabindex="-1"])'
            );

            focusableElements.forEach((element, index) => {
                element.addEventListener('keydown', (e) => {
                    handleNavigationKeydown(e, focusableElements, index);
                });
            });
        }

        // إضافة مؤشرات التركيز المرئية
        addFocusIndicators();
    }

    /**
     * إعداد الرأس الثابت
     */
    function setupStickyHeader() {
        if (!header) return;

        // إضافة كلاس للرأس الثابت
        PracticalSolutionsUtils.addClass(header, 'sticky-header');
    }

    /**
     * ربط الأحداث
     */
    function bindEvents() {
        // أحداث زر القائمة المحمولة
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', handleMobileMenuToggle);
        }

        // أحداث التمرير
        window.addEventListener('scroll', PracticalSolutionsUtils.throttle(handleScroll, 16));
        
        // أحداث تغيير حجم النافذة
        window.addEventListener('resize', PracticalSolutionsUtils.debounce(handleResize, 250));
        
        // أحداث لوحة المفاتيح العامة
        document.addEventListener('keydown', handleGlobalKeydown);
        
        // النقر خارج القائمة المحمولة
        document.addEventListener('click', handleDocumentClick);
        
        // أحداث التمرير للروابط الداخلية
        bindInternalLinks();
    }

    /**
     * معالجة النقر على زر القائمة المحمولة
     * @param {Event} event - حدث النقر
     */
    function handleMobileMenuToggle(event) {
        event.preventDefault();
        event.stopPropagation();
        
        toggleMobileMenu();
    }

    /**
     * معالجة التمرير
     */
    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // تحديث حالة التمرير
        const wasScrolled = isScrolled;
        isScrolled = scrollTop > scrollThreshold;
        
        if (isScrolled !== wasScrolled) {
            updateHeaderState();
        }
        
        // إخفاء/إظهار الرأس عند التمرير
        if (settings.enableStickyHeader && header) {
            const isScrollingUp = scrollTop < lastScrollTop;
            
            if (scrollTop > headerHeight * 2) {
                if (isScrollingUp) {
                    PracticalSolutionsUtils.removeClass(header, 'header-hidden');
                    PracticalSolutionsUtils.addClass(header, 'header-visible');
                } else {
                    PracticalSolutionsUtils.addClass(header, 'header-hidden');
                    PracticalSolutionsUtils.removeClass(header, 'header-visible');
                }
            }
        }
        
        // تحديث زر العودة لأعلى
        updateBackToTopButton();
        
        lastScrollTop = scrollTop;
    }

    /**
     * معالجة تغيير حجم النافذة
     */
    function handleResize() {
        const isMobile = window.innerWidth < settings.mobileBreakpoint;
        
        // إغلاق القائمة المحمولة إذا تم التبديل للديسكتوب
        if (!isMobile && isMobileMenuOpen) {
            closeMobileMenu();
        }
        
        // إعادة حساب ارتفاع الرأس
        if (header) {
            headerHeight = header.offsetHeight;
        }
    }

    /**
     * معالجة أحداث لوحة المفاتيح العامة
     * @param {Event} event - حدث لوحة المفاتيح
     */
    function handleGlobalKeydown(event) {
        switch (event.key) {
            case 'Escape':
                if (isMobileMenuOpen) {
                    closeMobileMenu();
                    mobileMenuToggle?.focus();
                }
                // إغلاق القوائم الفرعية المفتوحة
                closeAllSubMenus();
                break;
                
            case 'Tab':
                // إدارة التنقل بالتاب في القائمة المحمولة
                if (isMobileMenuOpen) {
                    handleMobileMenuTabNavigation(event);
                }
                break;
        }
    }

    /**
     * معالجة النقر على المستند
     * @param {Event} event - حدث النقر
     */
    function handleDocumentClick(event) {
        // إغلاق القائمة المحمولة إذا تم النقر خارجها
        if (isMobileMenuOpen && 
            mobileMenuOverlay && 
            !mobileMenuOverlay.contains(event.target) &&
            !mobileMenuToggle?.contains(event.target)) {
            closeMobileMenu();
        }
        
        // إغلاق القوائم الفرعية
        closeAllSubMenus();
    }

    /**
     * معالجة أحداث لوحة المفاتيح للتنقل
     * @param {Event} event - حدث لوحة المفاتيح
     * @param {NodeList} elements - العناصر القابلة للتركيز
     * @param {number} currentIndex - الفهرس الحالي
     */
    function handleNavigationKeydown(event, elements, currentIndex) {
        let targetIndex = currentIndex;
        
        switch (event.key) {
            case 'ArrowRight':
                event.preventDefault();
                targetIndex = (currentIndex + 1) % elements.length;
                break;
                
            case 'ArrowLeft':
                event.preventDefault();
                targetIndex = currentIndex === 0 ? elements.length - 1 : currentIndex - 1;
                break;
                
            case 'Home':
                event.preventDefault();
                targetIndex = 0;
                break;
                
            case 'End':
                event.preventDefault();
                targetIndex = elements.length - 1;
                break;
        }
        
        if (targetIndex !== currentIndex) {
            elements[targetIndex].focus();
        }
    }

    /**
     * معالجة أحداث لوحة المفاتيح للقائمة الفرعية
     * @param {Event} event - حدث لوحة المفاتيح
     * @param {Element} submenu - القائمة الفرعية
     * @param {Element} toggle - زر التبديل
     * @param {Element} menu - القائمة
     */
    function handleSubMenuKeydown(event, submenu, toggle, menu) {
        switch (event.key) {
            case 'Enter':
            case ' ':
                event.preventDefault();
                toggleSubMenu(submenu, toggle, menu);
                break;
                
            case 'ArrowDown':
                event.preventDefault();
                openSubMenu(submenu, toggle, menu);
                // التركيز على أول عنصر في القائمة
                const firstLink = menu.querySelector('a');
                if (firstLink) firstLink.focus();
                break;
                
            case 'Escape':
                closeSubMenu(submenu, toggle, menu);
                toggle.focus();
                break;
        }
    }

    /**
     * ربط الروابط الداخلية للتمرير السلس
     */
    function bindInternalLinks() {
        const internalLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
        
        internalLinks.forEach(link => {
            link.addEventListener('click', handleInternalLinkClick);
        });
    }

    /**
     * معالجة النقر على الروابط الداخلية
     * @param {Event} event - حدث النقر
     */
    function handleInternalLinkClick(event) {
        const href = event.currentTarget.getAttribute('href');
        const targetId = href.substring(1);
        const target = document.getElementById(targetId);
        
        if (target) {
            event.preventDefault();
            
            // إغلاق القائمة المحمولة إذا كانت مفتوحة
            if (isMobileMenuOpen) {
                closeMobileMenu();
            }
            
            // التمرير السلس للعنصر
            scrollToElement(target);
            
            // تحديث URL
            if (history.pushState) {
                history.pushState(null, null, href);
            } else {
                location.hash = href;
            }
        }
    }

    /**
     * فتح القائمة المحمولة
     */
    function openMobileMenu() {
        if (isMobileMenuOpen || !mobileMenuOverlay) return;
        
        isMobileMenuOpen = true;
        
        // تحديث العناصر
        PracticalSolutionsUtils.addClass(document.body, 'mobile-menu-open');
        PracticalSolutionsUtils.addClass(mobileMenuOverlay, 'active');
        
        if (mobileMenuToggle) {
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            mobileMenuToggle.setAttribute('aria-label', getTranslation('close_menu'));
            PracticalSolutionsUtils.addClass(mobileMenuToggle, 'active');
        }
        
        mobileMenuOverlay.setAttribute('aria-hidden', 'false');
        
        // منع التمرير في الخلفية
        disableBodyScroll();
        
        // التركيز على أول عنصر في القائمة
        setTimeout(() => {
            const firstFocusable = mobileMenuOverlay.querySelector('a, button, [tabindex]:not([tabindex="-1"])');
            if (firstFocusable) {
                firstFocusable.focus();
            }
        }, settings.animationDuration);
        
        PracticalSolutionsUtils.log('تم فتح القائمة المحمولة');
    }

    /**
     * إغلاق القائمة المحمولة
     */
    function closeMobileMenu() {
        if (!isMobileMenuOpen || !mobileMenuOverlay) return;
        
        isMobileMenuOpen = false;
        
        // تحديث العناصر
        PracticalSolutionsUtils.removeClass(document.body, 'mobile-menu-open');
        PracticalSolutionsUtils.removeClass(mobileMenuOverlay, 'active');
        
        if (mobileMenuToggle) {
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            mobileMenuToggle.setAttribute('aria-label', getTranslation('menu_toggle'));
            PracticalSolutionsUtils.removeClass(mobileMenuToggle, 'active');
        }
        
        mobileMenuOverlay.setAttribute('aria-hidden', 'true');
        
        // إعادة تفعيل التمرير
        enableBodyScroll();
        
        PracticalSolutionsUtils.log('تم إغلاق القائمة المحمولة');
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
     * فتح قائمة فرعية
     * @param {Element} submenu - القائمة الفرعية
     * @param {Element} toggle - زر التبديل
     * @param {Element} menu - القائمة
     */
    function openSubMenu(submenu, toggle, menu) {
        // إغلاق القوائم الفرعية الأخرى
        closeAllSubMenus(submenu);
        
        currentSubMenu = submenu;
        
        PracticalSolutionsUtils.addClass(submenu, 'is-open');
        toggle.setAttribute('aria-expanded', 'true');
        menu.setAttribute('aria-hidden', 'false');
    }

    /**
     * إغلاق قائمة فرعية
     * @param {Element} submenu - القائمة الفرعية
     * @param {Element} toggle - زر التبديل
     * @param {Element} menu - القائمة
     */
    function closeSubMenu(submenu, toggle, menu) {
        PracticalSolutionsUtils.removeClass(submenu, 'is-open');
        toggle.setAttribute('aria-expanded', 'false');
        menu.setAttribute('aria-hidden', 'true');
        
        if (currentSubMenu === submenu) {
            currentSubMenu = null;
        }
    }

    /**
     * تبديل قائمة فرعية
     * @param {Element} submenu - القائمة الفرعية
     * @param {Element} toggle - زر التبديل
     * @param {Element} menu - القائمة
     */
    function toggleSubMenu(submenu, toggle, menu) {
        const isOpen = PracticalSolutionsUtils.hasClass(submenu, 'is-open');
        
        if (isOpen) {
            closeSubMenu(submenu, toggle, menu);
        } else {
            openSubMenu(submenu, toggle, menu);
        }
    }

    /**
     * إغلاق جميع القوائم الفرعية
     * @param {Element} except - استثناء قائمة معينة
     */
    function closeAllSubMenus(except = null) {
        if (!primaryNavigation) return;
        
        const openSubMenus = primaryNavigation.querySelectorAll('.wp-block-navigation-submenu.is-open');
        
        openSubMenus.forEach(submenu => {
            if (submenu !== except) {
                const toggle = submenu.querySelector('.wp-block-navigation-submenu__toggle');
                const menu = submenu.querySelector('.wp-block-navigation-submenu__container');
                
                if (toggle && menu) {
                    closeSubMenu(submenu, toggle, menu);
                }
            }
        });
    }

    /**
     * معالجة التنقل بالتاب في القائمة المحمولة
     * @param {Event} event - حدث التاب
     */
    function handleMobileMenuTabNavigation(event) {
        if (!mobileMenuOverlay) return;
        
        const focusableElements = mobileMenuOverlay.querySelectorAll(
            'a, button, [tabindex]:not([tabindex="-1"])'
        );
        
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        if (event.shiftKey) {
            // Shift + Tab
            if (document.activeElement === firstElement) {
                event.preventDefault();
                lastElement.focus();
            }
        } else {
            // Tab
            if (document.activeElement === lastElement) {
                event.preventDefault();
                firstElement.focus();
            }
        }
    }

    /**
     * تحديث حالة الرأس
     */
    function updateHeaderState() {
        if (!header) return;
        
        if (isScrolled) {
            PracticalSolutionsUtils.addClass(header, 'is-scrolled');
        } else {
            PracticalSolutionsUtils.removeClass(header, 'is-scrolled');
        }
    }

    /**
     * منع التمرير في الخلفية
     */
    function disableBodyScroll() {
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = `${scrollbarWidth}px`;
    }

    /**
     * إعادة تفعيل التمرير
     */
    function enableBodyScroll() {
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }

    /**
     * إنشاء زر العودة لأعلى
     */
    function createBackToTopButton() {
        if (backToTopButton || !settings.enableBackToTop) return;
        
        backToTopButton = PracticalSolutionsUtils.createElement('button', {
            className: 'back-to-top',
            'aria-label': getTranslation('back_to_top'),
            innerHTML: `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                </svg>
            `
        });
        
        document.body.appendChild(backToTopButton);
    }

    /**
     * إعداد زر العودة لأعلى
     */
    function setupBackToTop() {
        if (!backToTopButton) return;
        
        backToTopButton.addEventListener('click', scrollToTop);
        
        // إخفاء الزر في البداية
        backToTopButton.style.opacity = '0';
        backToTopButton.style.pointerEvents = 'none';
    }

    /**
     * تحديث زر العودة لأعلى
     */
    function updateBackToTopButton() {
        if (!backToTopButton) return;
        
        const shouldShow = window.pageYOffset > window.innerHeight / 2;
        
        if (shouldShow) {
            backToTopButton.style.opacity = '1';
            backToTopButton.style.pointerEvents = 'auto';
        } else {
            backToTopButton.style.opacity = '0';
            backToTopButton.style.pointerEvents = 'none';
        }
    }

    /**
     * العودة لأعلى الصفحة
     */
    function scrollToTop() {
        PracticalSolutionsUtils.smoothScrollTo(document.body, 800);
    }

    /**
     * التمرير لعنصر معين
     * @param {Element} element - العنصر المستهدف
     * @param {number} offset - الإزاحة
     */
    function scrollToElement(element, offset = 0) {
        const finalOffset = offset || (headerHeight + 20);
        PracticalSolutionsUtils.smoothScrollTo(element, 800, finalOffset);
    }

    /**
     * إعداد التمرير السلس
     */
    function setupSmoothScroll() {
        // إضافة behavior: smooth للمتصفحات التي تدعمه
        if ('scrollBehavior' in document.documentElement.style) {
            document.documentElement.style.scrollBehavior = 'smooth';
        }
    }

    /**
     * إضافة مؤشرات التركيز
     */
    function addFocusIndicators() {
        const focusableElements = document.querySelectorAll(
            'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
        );
        
        focusableElements.forEach(element => {
            element.addEventListener('focus', () => {
                PracticalSolutionsUtils.addClass(element, 'ps-focused');
            });
            
            element.addEventListener('blur', () => {
                PracticalSolutionsUtils.removeClass(element, 'ps-focused');
            });
        });
    }

    /**
     * الحصول على ترجمة نص
     * @param {string} key - مفتاح الترجمة
     * @returns {string}
     */
    function getTranslation(key) {
        const translations = window.practicalSolutions?.strings || {};
        return translations[key] || key;
    }

    /**
     * إضافة أنماط CSS للتنقل
     */
    function addNavigationStyles() {
        if (document.getElementById('ps-navigation-styles')) return;

        const styles = `
            /* أنماط القائمة المحمولة */
            .mobile-menu-open {
                overflow: hidden;
            }

            .mobile-menu-toggle {
                display: none;
                background: none;
                border: 1px solid var(--wp--preset--color--base, #ecf0f1);
                border-radius: 8px;
                padding: 0.75rem;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                z-index: 1001;
            }

            .mobile-menu-toggle:hover {
                background-color: var(--wp--preset--color--base, #ecf0f1);
            }

            .mobile-menu-toggle.active .menu-line:nth-child(1) {
                transform: rotate(45deg) translate(6px, 6px);
            }

            .mobile-menu-toggle.active .menu-line:nth-child(2) {
                opacity: 0;
            }

            .mobile-menu-toggle.active .menu-line:nth-child(3) {
                transform: rotate(-45deg) translate(6px, -6px);
            }

            .menu-icon {
                display: flex;
                flex-direction: column;
                gap: 3px;
                width: 20px;
                height: 14px;
            }

            .menu-line {
                width: 100%;
                height: 2px;
                background-color: var(--wp--preset--color--foreground, #2c3e50);
                transition: all 0.3s ease;
                transform-origin: center;
            }

            .mobile-menu-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: var(--wp--preset--color--background, #ffffff);
                z-index: 1000;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                overflow-y: auto;
                padding: 2rem 1rem;
            }

            .mobile-menu-overlay.active {
                transform: translateX(0);
            }

            /* أنماط الرأس الثابت */
            .sticky-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 999;
                transition: transform 0.3s ease;
            }

            .sticky-header.is-scrolled {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .sticky-header.header-hidden {
                transform: translateY(-100%);
            }

            .sticky-header.header-visible {
                transform: translateY(0);
            }

            /* أنماط القوائم الفرعية */
            .wp-block-navigation-submenu.is-open .wp-block-navigation-submenu__container {
                display: block;
                opacity: 1;
                transform: translateY(0);
            }

            .wp-block-navigation-submenu__container {
                opacity: 0;
                transform: translateY(-10px);
                transition: all 0.3s ease;
            }

            /* زر العودة لأعلى */
            .back-to-top {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                width: 50px;
                height: 50px;
                background: var(--wp--preset--color--primary, #007cba);
                color: white;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                z-index: 998;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .back-to-top:hover {
                background: var(--wp--preset--color--accent, #e74c3c);
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            }

            /* مؤشرات التركيز */
            .ps-focused {
                outline: 2px solid var(--wp--preset--color--primary, #007cba);
                outline-offset: 2px;
            }

            /* الاستجابة للأجهزة المحمولة */
            @media (max-width: 768px) {
                .mobile-menu-toggle {
                    display: flex;
                }

                .primary-navigation .wp-block-navigation__container {
                    display: none;
                }

                .back-to-top {
                    bottom: 1rem;
                    right: 1rem;
                    width: 45px;
                    height: 45px;
                }
            }

            @media (max-width: 480px) {
                .mobile-menu-overlay {
                    padding: 1rem;
                }
            }

            /* تحسينات إضافية */
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }

            /* تأثيرات انتقالية للقوائم */
            .wp-block-navigation a {
                transition: color 0.2s ease;
            }

            .wp-block-navigation a:hover {
                color: var(--wp--preset--color--primary, #007cba);
            }

            /* تحسين شكل التمرير */
            html {
                scroll-padding-top: 100px;
            }
        `;

        const styleSheet = PracticalSolutionsUtils.createElement('style', {
            id: 'ps-navigation-styles'
        }, styles);

        document.head.appendChild(styleSheet);
    }

    /**
     * تدمير نظام التنقل
     */
    function destroy() {
        // إغلاق القائمة المحمولة
        if (isMobileMenuOpen) {
            closeMobileMenu();
        }
        
        // إزالة مستمعي الأحداث
        if (mobileMenuToggle) {
            mobileMenuToggle.removeEventListener('click', handleMobileMenuToggle);
        }

        window.removeEventListener('scroll', handleScroll);
        window.removeEventListener('resize', handleResize);
        document.removeEventListener('keydown', handleGlobalKeydown);
        document.removeEventListener('click', handleDocumentClick);

        // إزالة الروابط الداخلية
        const internalLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
        internalLinks.forEach(link => {
            link.removeEventListener('click', handleInternalLinkClick);
        });

        // إزالة زر العودة لأعلى
        if (backToTopButton && backToTopButton.parentNode) {
            backToTopButton.parentNode.removeChild(backToTopButton);
        }

        // إعادة تفعيل التمرير
        enableBodyScroll();

        // مسح المتغيرات
        instance = null;
        
        PracticalSolutionsUtils.log('تم تدمير نظام التنقل');
    }

    // إرجاع الوظائف العامة
    return {
        init: init
    };

})();