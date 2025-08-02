/**
 * ملف JavaScript الرئيسي
 * Main JavaScript Functions
 * 
 * @package Muhtawaa
 * @version 2.0
 */

(function($) {
    'use strict';

    // متغيرات عامة
    const MuhtawaaTheme = {
        // إعدادات عامة
        settings: {
            animationSpeed: 300,
            scrollOffset: 100,
            debounceDelay: 250,
            breakpoints: {
                mobile: 768,
                tablet: 992,
                desktop: 1200
            }
        },

        // حالة التطبيق
        state: {
            isMenuOpen: false,
            isScrolling: false,
            currentDevice: 'desktop',
            scrollPosition: 0
        },

        // عناصر DOM المهمة
        elements: {
            $window: $(window),
            $document: $(document),
            $body: $('body'),
            $header: $('.site-header'),
            $nav: $('.main-nav'),
            $menuToggle: $('.nav-toggle'),
            $menuItems: $('.nav-menu li'),
            $searchToggle: $('.search-toggle'),
            $searchForm: $('.search-form'),
            $backToTop: $('.back-to-top')
        },

        // تهيئة التطبيق
        init: function() {
            this.bindEvents();
            this.initComponents();
            this.checkDevice();
            this.initScrollEffects();
            this.initLazyLoading();
            this.initAccessibility();
            
            // إخفاء شاشة التحميل
            this.hideLoader();
            
            console.log('🚀 Muhtawaa Theme initialized successfully');
        },

        // ربط الأحداث
        bindEvents: function() {
            const self = this;

            // أحداث النافذة
            this.elements.$window.on({
                'scroll.muhtawaa': this.debounce(this.handleScroll.bind(this), this.settings.debounceDelay),
                'resize.muhtawaa': this.debounce(this.handleResize.bind(this), this.settings.debounceDelay),
                'load.muhtawaa': this.handleLoad.bind(this)
            });

            // أحداث التنقل
            this.elements.$menuToggle.on('click.muhtawaa', this.toggleMobileMenu.bind(this));
            this.elements.$menuItems.on('click.muhtawaa', this.closeMobileMenu.bind(this));

            // أحداث البحث
            this.elements.$searchToggle.on('click.muhtawaa', this.toggleSearch.bind(this));

            // أحداث الـ Back to Top
            this.elements.$backToTop.on('click.muhtawaa', this.scrollToTop.bind(this));

            // أحداث لوحة المفاتيح
            this.elements.$document.on('keydown.muhtawaa', this.handleKeyboard.bind(this));

            // أحداث التركيز (إمكانية الوصول)
            this.elements.$document.on('focusin.muhtawaa', this.handleFocusIn.bind(this));

            // أحداث النقر خارج العناصر
            this.elements.$document.on('click.muhtawaa', this.handleOutsideClick.bind(this));
        },

        // تهيئة المكونات
        initComponents: function() {
            this.initDropdowns();
            this.initTabs();
            this.initAccordion();
            this.initTooltips();
            this.initModal();
            this.initCarousel();
        },

        // إدارة التمرير
        handleScroll: function() {
            const scrollTop = this.elements.$window.scrollTop();
            const windowHeight = this.elements.$window.height();
            const documentHeight = this.elements.$document.height();
            
            this.state.scrollPosition = scrollTop;
            this.state.isScrolling = true;

            // تحديث رأس الصفحة
            this.updateHeader(scrollTop);

            // تحديث شريط التقدم
            this.updateProgressBar(scrollTop, documentHeight, windowHeight);

            // إظهار/إخفاء زر العودة للأعلى
            this.toggleBackToTop(scrollTop);

            // تأثيرات الظهور أثناء التمرير
            this.handleScrollReveal();

            // إيقاف حالة التمرير بعد انتهاء الحركة
            clearTimeout(this.scrollTimeout);
            this.scrollTimeout = setTimeout(() => {
                this.state.isScrolling = false;
            }, 150);
        },

        // تحديث رأس الصفحة أثناء التمرير
        updateHeader: function(scrollTop) {
            if (scrollTop > this.settings.scrollOffset) {
                this.elements.$header.addClass('header-scrolled');
            } else {
                this.elements.$header.removeClass('header-scrolled');
            }
        },

        // تحديث شريط التقدم
        updateProgressBar: function(scrollTop, documentHeight, windowHeight) {
            const progress = (scrollTop / (documentHeight - windowHeight)) * 100;
            $('.scroll-progress').css('width', Math.min(progress, 100) + '%');
        },

        // إظهار/إخفاء زر العودة للأعلى
        toggleBackToTop: function(scrollTop) {
            if (scrollTop > this.settings.scrollOffset * 3) {
                this.elements.$backToTop.addClass('visible');
            } else {
                this.elements.$backToTop.removeClass('visible');
            }
        },

        // العودة للأعلى
        scrollToTop: function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, {
                duration: this.settings.animationSpeed * 2,
                easing: 'easeInOutCubic'
            });
        },

        // إدارة تغيير حجم النافذة
        handleResize: function() {
            this.checkDevice();
            this.adjustLayout();
            this.repositionElements();
        },

        // فحص نوع الجهاز
        checkDevice: function() {
            const width = this.elements.$window.width();
            let device = 'desktop';

            if (width < this.settings.breakpoints.mobile) {
                device = 'mobile';
            } else if (width < this.settings.breakpoints.tablet) {
                device = 'tablet';
            }

            if (this.state.currentDevice !== device) {
                this.elements.$body
                    .removeClass('device-' + this.state.currentDevice)
                    .addClass('device-' + device);
                
                this.state.currentDevice = device;
                this.handleDeviceChange(device);
            }
        },

        // إدارة تغيير الجهاز
        handleDeviceChange: function(device) {
            // إغلاق القائمة على الأجهزة الكبيرة
            if (device !== 'mobile' && this.state.isMenuOpen) {
                this.closeMobileMenu();
            }

            // تحديث تخطيط العناصر
            this.updateComponentsForDevice(device);
        },

        // تحديث المكونات حسب الجهاز
        updateComponentsForDevice: function(device) {
            // تحديث الدروبداون
            if (device === 'mobile') {
                $('.dropdown-menu').removeClass('show');
            }

            // تحديث النماذج
            this.adjustFormsForDevice(device);

            // تحديث الجداول
            this.adjustTablesForDevice(device);
        },

        // تبديل القائمة المحمولة
        toggleMobileMenu: function(e) {
            e.preventDefault();
            
            if (this.state.isMenuOpen) {
                this.closeMobileMenu();
            } else {
                this.openMobileMenu();
            }
        },

        // فتح القائمة المحمولة
        openMobileMenu: function() {
            this.state.isMenuOpen = true;
            this.elements.$body.addClass('menu-open');
            this.elements.$menuToggle.addClass('active');
            this.elements.$nav.addClass('active');
            
            // تحريك العناصر بتأخير
            this.elements.$menuItems.each((index, item) => {
                setTimeout(() => {
                    $(item).addClass('show');
                }, index * 100);
            });

            // إمكانية الوصول
            this.elements.$menuToggle.attr('aria-expanded', 'true');
            this.elements.$nav.attr('aria-hidden', 'false');
        },

        // إغلاق القائمة المحمولة
        closeMobileMenu: function() {
            this.state.isMenuOpen = false;
            this.elements.$body.removeClass('menu-open');
            this.elements.$menuToggle.removeClass('active');
            this.elements.$nav.removeClass('active');
            this.elements.$menuItems.removeClass('show');

            // إمكانية الوصول
            this.elements.$menuToggle.attr('aria-expanded', 'false');
            this.elements.$nav.attr('aria-hidden', 'true');
        },

        // تبديل البحث
        toggleSearch: function(e) {
            e.preventDefault();
            
            const $searchForm = this.elements.$searchForm;
            const isActive = $searchForm.hasClass('active');

            if (isActive) {
                $searchForm.removeClass('active');
                this.elements.$searchToggle.attr('aria-expanded', 'false');
            } else {
                $searchForm.addClass('active');
                $searchForm.find('input[type="search"]').focus();
                this.elements.$searchToggle.attr('aria-expanded', 'true');
            }
        },

        // إدارة أحداث لوحة المفاتيح
        handleKeyboard: function(e) {
            const key = e.key;

            switch (key) {
                case 'Escape':
                    this.handleEscapeKey();
                    break;
                case 'Tab':
                    this.handleTabKey(e);
                    break;
                case 'Enter':
                    this.handleEnterKey(e);
                    break;
            }
        },

        // إدارة مفتاح Escape
        handleEscapeKey: function() {
            // إغلاق القائمة
            if (this.state.isMenuOpen) {
                this.closeMobileMenu();
            }

            // إغلاق البحث
            if (this.elements.$searchForm.hasClass('active')) {
                this.elements.$searchForm.removeClass('active');
            }

            // إغلاق المودال
            $('.modal.show').each(function() {
                $(this).removeClass('show');
            });

            // إغلاق الدروبداون
            $('.dropdown.show').removeClass('show');
        },

        // إدارة النقر خارج العناصر
        handleOutsideClick: function(e) {
            const $target = $(e.target);

            // إغلاق البحث عند النقر خارجه
            if (!$target.closest('.search-form, .search-toggle').length) {
                this.elements.$searchForm.removeClass('active');
            }

            // إغلاق الدروبداون عند النقر خارجه
            if (!$target.closest('.dropdown').length) {
                $('.dropdown.show').removeClass('show');
            }
        },

        // تهيئة تأثيرات الظهور أثناء التمرير
        initScrollEffects: function() {
            this.scrollElements = $('.scroll-reveal');
            this.setupScrollObserver();
        },

        // إعداد مراقب التمرير
        setupScrollObserver: function() {
            if ('IntersectionObserver' in window) {
                this.scrollObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            $(entry.target).addClass('revealed');
                            this.scrollObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '50px'
                });

                this.scrollElements.each((index, element) => {
                    this.scrollObserver.observe(element);
                });
            } else {
                // Fallback للمتصفحات القديمة
                this.handleScrollReveal();
            }
        },

        // إدارة ظهور العناصر أثناء التمرير (Fallback)
        handleScrollReveal: function() {
            if (!this.scrollElements.length) return;

            const windowHeight = this.elements.$window.height();
            const scrollTop = this.elements.$window.scrollTop();

            this.scrollElements.each((index, element) => {
                const $element = $(element);
                const elementTop = $element.offset().top;
                
                if (elementTop < scrollTop + windowHeight - 100 && !$element.hasClass('revealed')) {
                    setTimeout(() => {
                        $element.addClass('revealed');
                    }, index * 100);
                }
            });
        },

        // تهيئة التحميل التدريجي للصور
        initLazyLoading: function() {
            if ('IntersectionObserver' in window) {
                this.lazyImages = $('img[data-src]');
                
                this.imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const $img = $(entry.target);
                            const src = $img.data('src');
                            
                            if (src) {
                                $img.attr('src', src).removeAttr('data-src');
                                $img.addClass('loaded');
                                this.imageObserver.unobserve(entry.target);
                            }
                        }
                    });
                });

                this.lazyImages.each((index, img) => {
                    this.imageObserver.observe(img);
                });
            }
        },

        // تهيئة إمكانية الوصول
        initAccessibility: function() {
            // إضافة خصائص ARIA
            this.setupAriaAttributes();
            
            // إدارة التركيز
            this.setupFocusManagement();
            
            // إعداد اختصارات لوحة المفاتيح
            this.setupKeyboardShortcuts();
        },

        // إعداد خصائص ARIA
        setupAriaAttributes: function() {
            // إضافة ARIA للقائمة
            this.elements.$menuToggle.attr({
                'aria-expanded': 'false',
                'aria-controls': 'main-menu',
                'aria-label': 'تبديل القائمة الرئيسية'
            });

            this.elements.$nav.attr({
                'aria-hidden': 'true',
                'id': 'main-menu'
            });

            // إضافة ARIA للبحث
            this.elements.$searchToggle.attr({
                'aria-expanded': 'false',
                'aria-controls': 'search-form',
                'aria-label': 'تبديل نموذج البحث'
            });
        },

        // إدارة التركيز
        setupFocusManagement: function() {
            // التركيز على القائمة عند فتحها
            this.elements.$nav.on('transitionend', () => {
                if (this.state.isMenuOpen) {
                    this.elements.$nav.find('a:first').focus();
                }
            });
        },

        // إعداد اختصارات لوحة المفاتيح
        setupKeyboardShortcuts: function() {
            this.elements.$document.on('keydown', (e) => {
                // Ctrl + / للبحث
                if (e.ctrlKey && e.key === '/') {
                    e.preventDefault();
                    this.toggleSearch(e);
                }
                
                // Alt + M للقائمة
                if (e.altKey && e.key === 'm') {
                    e.preventDefault();
                    this.toggleMobileMenu(e);
                }
            });
        },

        // تهيئة الدروبداون
        initDropdowns: function() {
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                const $dropdown = $(this).closest('.dropdown');
                const isOpen = $dropdown.hasClass('show');
                
                // إغلاق جميع الدروبداون الأخرى
                $('.dropdown').removeClass('show');
                
                if (!isOpen) {
                    $dropdown.addClass('show');
                    $(this).attr('aria-expanded', 'true');
                } else {
                    $(this).attr('aria-expanded', 'false');
                }
            });
        },

        // تهيئة التبويبات
        initTabs: function() {
            $('.tab-nav a').on('click', function(e) {
                e.preventDefault();
                const $this = $(this);
                const target = $this.attr('href');
                const $tabNav = $this.closest('.tab-nav');
                const $tabContent = $tabNav.siblings('.tab-content');
                
                // إزالة الحالة النشطة
                $tabNav.find('a').removeClass('active').attr('aria-selected', 'false');
                $tabContent.find('.tab-pane').removeClass('active');
                
                // إضافة الحالة النشطة
                $this.addClass('active').attr('aria-selected', 'true');
                $tabContent.find(target).addClass('active');
            });
        },

        // تهيئة الأكورديون
        initAccordion: function() {
            $('.accordion-header').on('click', function(e) {
                e.preventDefault();
                const $header = $(this);
                const $item = $header.closest('.accordion-item');
                const $content = $item.find('.accordion-content');
                const isOpen = $item.hasClass('active');
                
                if (isOpen) {
                    $item.removeClass('active');
                    $content.slideUp(300);
                    $header.attr('aria-expanded', 'false');
                } else {
                    // إغلاق العناصر الأخرى (اختياري)
                    $item.siblings('.accordion-item').removeClass('active')
                        .find('.accordion-content').slideUp(300);
                    $item.siblings('.accordion-item').find('.accordion-header')
                        .attr('aria-expanded', 'false');
                    
                    $item.addClass('active');
                    $content.slideDown(300);
                    $header.attr('aria-expanded', 'true');
                }
            });
        },

        // تهيئة التلميحات
        initTooltips: function() {
            $('[data-tooltip]').each(function() {
                const $element = $(this);
                const text = $element.data('tooltip');
                const position = $element.data('tooltip-position') || 'top';
                
                $element.on('mouseenter focus', function() {
                    const $tooltip = $('<div class="tooltip">')
                        .addClass('tooltip-' + position)
                        .text(text)
                        .appendTo('body');
                    
                    const elementRect = this.getBoundingClientRect();
                    const tooltipRect = $tooltip[0].getBoundingClientRect();
                    
                    let top, left;
                    
                    switch (position) {
                        case 'top':
                            top = elementRect.top - tooltipRect.height - 10;
                            left = elementRect.left + (elementRect.width / 2) - (tooltipRect.width / 2);
                            break;
                        case 'bottom':
                            top = elementRect.bottom + 10;
                            left = elementRect.left + (elementRect.width / 2) - (tooltipRect.width / 2);
                            break;
                        case 'left':
                            top = elementRect.top + (elementRect.height / 2) - (tooltipRect.height / 2);
                            left = elementRect.left - tooltipRect.width - 10;
                            break;
                        case 'right':
                            top = elementRect.top + (elementRect.height / 2) - (tooltipRect.height / 2);
                            left = elementRect.right + 10;
                            break;
                    }
                    
                    $tooltip.css({ top: top, left: left }).addClass('show');
                });
                
                $element.on('mouseleave blur', function() {
                    $('.tooltip').remove();
                });
            });
        },

        // تهيئة المودال
        initModal: function() {
            // فتح المودال
            $('[data-modal]').on('click', function(e) {
                e.preventDefault();
                const target = $(this).data('modal');
                const $modal = $(target);
                
                if ($modal.length) {
                    $modal.addClass('show');
                    $('body').addClass('modal-open');
                    
                    // التركيز على المودال
                    $modal.attr('tabindex', '-1').focus();
                    
                    // إمكانية الوصول
                    $modal.attr('aria-hidden', 'false');
                }
            });
            
            // إغلاق المودال
            $('.modal-close, .modal-backdrop').on('click', function() {
                const $modal = $(this).closest('.modal');
                $modal.removeClass('show');
                $('body').removeClass('modal-open');
                $modal.attr('aria-hidden', 'true');
            });
        },

        // تهيئة الدوارة (Carousel)
        initCarousel: function() {
            $('.carousel').each(function() {
                const $carousel = $(this);
                const $items = $carousel.find('.carousel-item');
                const $indicators = $carousel.find('.carousel-indicators button');
                const $prevBtn = $carousel.find('.carousel-prev');
                const $nextBtn = $carousel.find('.carousel-next');
                
                let currentIndex = 0;
                const totalItems = $items.length;
                
                // إظهار العنصر المحدد
                function showItem(index) {
                    $items.removeClass('active').eq(index).addClass('active');
                    $indicators.removeClass('active').eq(index).addClass('active');
                    currentIndex = index;
                }
                
                // العنصر التالي
                function nextItem() {
                    const nextIndex = (currentIndex + 1) % totalItems;
                    showItem(nextIndex);
                }
                
                // العنصر السابق
                function prevItem() {
                    const prevIndex = (currentIndex - 1 + totalItems) % totalItems;
                    showItem(prevIndex);
                }
                
                // ربط الأحداث
                $nextBtn.on('click', nextItem);
                $prevBtn.on('click', prevItem);
                
                $indicators.on('click', function() {
                    const index = $(this).index();
                    showItem(index);
                });
                
                // التشغيل التلقائي (إذا كان مفعلاً)
                if ($carousel.data('autoplay')) {
                    const interval = $carousel.data('interval') || 5000;
                    
                    const autoPlay = setInterval(nextItem, interval);
                    
                    // إيقاف التشغيل التلقائي عند التفاعل
                    $carousel.on('mouseenter', () => clearInterval(autoPlay));
                }
            });
        },

        // تعديل النماذج للأجهزة المختلفة
        adjustFormsForDevice: function(device) {
            const $forms = $('form');
            
            if (device === 'mobile') {
                $forms.addClass('mobile-optimized');
            } else {
                $forms.removeClass('mobile-optimized');
            }
        },

        // تعديل الجداول للأجهزة المختلفة
        adjustTablesForDevice: function(device) {
            const $tables = $('table');
            
            if (device === 'mobile') {
                $tables.each(function() {
                    const $table = $(this);
                    if (!$table.closest('.table-responsive').length) {
                        $table.wrap('<div class="table-responsive"></div>');
                    }
                });
            }
        },

        // تعديل التخطيط
        adjustLayout: function() {
            // تحديث ارتفاع العناصر
            this.updateElementHeights();
            
            // إعادة حساب مواضع العناصر المطلقة
            this.recalculateAbsolutePositions();
        },

        // تحديث ارتفاع العناصر
        updateElementHeights: function() {
            $('.equal-height').each(function() {
                const $container = $(this);
                const $items = $container.find('.equal-height-item');
                
                // إعادة تعيين الارتفاع
                $items.css('height', 'auto');
                
                // العثور على أعلى عنصر
                let maxHeight = 0;
                $items.each(function() {
                    const height = $(this).outerHeight();
                    if (height > maxHeight) {
                        maxHeight = height;
                    }
                });
                
                // تطبيق الارتفاع المتساوي
                $items.css('height', maxHeight);
            });
        },

        // إعادة ترتيب العناصر
        repositionElements: function() {
            // إعادة ترتيب الدروبداون
            $('.dropdown-menu').each(function() {
                const $menu = $(this);
                const $toggle = $menu.siblings('.dropdown-toggle');
                
                if ($toggle.length) {
                    const toggleRect = $toggle[0].getBoundingClientRect();
                    const menuRect = $menu[0].getBoundingClientRect();
                    const windowWidth = window.innerWidth;
                    
                    // التحقق من وجود مساحة كافية
                    if (toggleRect.right + menuRect.width > windowWidth) {
                        $menu.addClass('dropdown-menu-right');
                    } else {
                        $menu.removeClass('dropdown-menu-right');
                    }
                }
            });
        },

        // إخفاء شاشة التحميل
        hideLoader: function() {
            const $loader = $('.page-loader');
            
            if ($loader.length) {
                setTimeout(() => {
                    $loader.addClass('loaded');
                    
                    setTimeout(() => {
                        $loader.remove();
                    }, 500);
                }, 100);
            }
        },

        // إدارة التحميل
        handleLoad: function() {
            // تشغيل الحركات المؤجلة
            $('.animate-on-load').addClass('animated');
            
            // تحديث تخطيط الصفحة
            this.adjustLayout();
            
            // إرسال حدث مخصص
            this.elements.$document.trigger('muhtawaa:loaded');
        },

        // دالة مساعدة للتأخير
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        // دالة مساعدة للخنق
        throttle: function(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        },

        // تنظيف الأحداث
        destroy: function() {
            // إزالة مراقبي الأحداث
            this.elements.$window.off('.muhtawaa');
            this.elements.$document.off('.muhtawaa');
            
            // إزالة مراقبي IntersectionObserver
            if (this.scrollObserver) {
                this.scrollObserver.disconnect();
            }
            
            if (this.imageObserver) {
                this.imageObserver.disconnect();
            }
            
            console.log('🧹 Muhtawaa Theme destroyed');
        }
    };

    // مساعدات jQuery إضافية
    $.fn.muhtawaaFadeIn = function(duration = 300) {
        return this.each(function() {
            $(this).css({
                opacity: 0,
                display: 'block'
            }).animate({
                opacity: 1
            }, duration);
        });
    };

    $.fn.muhtawaaFadeOut = function(duration = 300) {
        return this.each(function() {
            $(this).animate({
                opacity: 0
            }, duration, function() {
                $(this).css('display', 'none');
            });
        });
    };

    $.fn.muhtawaaSlideToggle = function(duration = 300) {
        return this.each(function() {
            const $element = $(this);
            if ($element.is(':visible')) {
                $element.slideUp(duration);
            } else {
                $element.slideDown(duration);
            }
        });
    };

    // API عامة للثيم
    window.MuhtawaaTheme = {
        init: MuhtawaaTheme.init.bind(MuhtawaaTheme),
        destroy: MuhtawaaTheme.destroy.bind(MuhtawaaTheme),
        settings: MuhtawaaTheme.settings,
        state: MuhtawaaTheme.state,
        
        // دوال مساعدة
        openModal: function(modalId) {
            const $modal = $(modalId);
            if ($modal.length) {
                $modal.addClass('show');
                $('body').addClass('modal-open');
            }
        },
        
        closeModal: function(modalId) {
            const $modal = modalId ? $(modalId) : $('.modal.show');
            $modal.removeClass('show');
            $('body').removeClass('modal-open');
        },
        
        showNotification: function(message, type = 'info', duration = 5000) {
            const $notification = $(`
                <div class="notification notification-${type}">
                    <div class="notification-content">
                        <span class="notification-message">${message}</span>
                        <button class="notification-close" aria-label="إغلاق">×</button>
                    </div>
                </div>
            `);
            
            $('body').append($notification);
            
            setTimeout(() => {
                $notification.addClass('show');
            }, 100);
            
            $notification.find('.notification-close').on('click', () => {
                $notification.removeClass('show');
                setTimeout(() => $notification.remove(), 300);
            });
            
            if (duration > 0) {
                setTimeout(() => {
                    $notification.removeClass('show');
                    setTimeout(() => $notification.remove(), 300);
                }, duration);
            }
        }
    };

    // تهيئة التطبيق عند جاهزية DOM
    $(document).ready(function() {
        MuhtawaaTheme.init();
    });

    // تنظيف عند إغلاق الصفحة
    $(window).on('beforeunload', function() {
        MuhtawaaTheme.destroy();
    });

})(jQuery);