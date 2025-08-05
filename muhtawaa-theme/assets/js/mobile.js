/**
 * ملف تحسينات الأجهزة المحمولة - قالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0.3
 * @author فريق التطوير
 */

(function($) {
    'use strict';

    /**
     * فئة تحسينات الجوال
     */
    class MuhtawaaMobile {
        constructor() {
            this.isMobile = this.detectMobile();
            this.isTablet = this.detectTablet();
            this.touchStartX = 0;
            this.touchStartY = 0;
            this.touchEndX = 0;
            this.touchEndY = 0;
            this.swipeThreshold = 50;
            this.tapThreshold = 10;
            this.lastTap = 0;
            
            this.init();
            this.bindEvents();
        }

        /**
         * تهيئة النظام
         */
        init() {
            if (!this.isMobile && !this.isTablet) return;
            
            this.addMobileClasses();
            this.optimizeViewport();
            this.initMobileNavigation();
            this.initTouchGestures();
            this.initSwipeGestures();
            this.initPullToRefresh();
            this.initMobileSearch();
            this.initMobileModal();
            this.initMobileMenu();
            this.initMobileShare();
            this.initMobileScroll();
            this.initMobileForm();
            this.initMobileImage();
            this.initOfflineSupport();
        }

        /**
         * ربط الأحداث
         */
        bindEvents() {
            // أحداث اللمس الأساسية
            $(document).on('touchstart', this.handleTouchStart.bind(this));
            $(document).on('touchmove', this.handleTouchMove.bind(this));
            $(document).on('touchend', this.handleTouchEnd.bind(this));
            
            // أحداث التوجه
            $(window).on('orientationchange', this.handleOrientationChange.bind(this));
            $(window).on('resize', this.debounce(this.handleResize.bind(this), 250));
            
            // أحداث الشبكة
            $(window).on('online', this.handleOnline.bind(this));
            $(window).on('offline', this.handleOffline.bind(this));
            
            // أحداث مخصصة
            $(document).on('muhtawaa:mobile-menu-toggle', this.handleMenuToggle.bind(this));
            $(document).on('muhtawaa:mobile-search-toggle', this.handleSearchToggle.bind(this));
        }

        /**
         * إضافة فئات الجوال
         */
        addMobileClasses() {
            const body = $('body');
            
            if (this.isMobile) {
                body.addClass('is-mobile');
            }
            
            if (this.isTablet) {
                body.addClass('is-tablet');
            }
            
            // إضافة فئة التوجه
            const orientation = window.innerHeight > window.innerWidth ? 'portrait' : 'landscape';
            body.addClass(`orientation-${orientation}`);
            
            // إضافة فئة نظام التشغيل
            const os = this.detectOS();
            if (os) {
                body.addClass(`os-${os}`);
            }
            
            // إضافة فئة المتصفح
            const browser = this.detectBrowser();
            if (browser) {
                body.addClass(`browser-${browser}`);
            }
        }

        /**
         * تحسين العرض للجوال
         */
        optimizeViewport() {
            // إضافة meta viewport إذا لم تكن موجودة
            if (!$('meta[name="viewport"]').length) {
                $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">');
            }
            
            // منع التكبير عند التركيز على الحقول (iOS Safari)
            if (this.isIOS()) {
                $('input, textarea, select').on('focus', function() {
                    $('meta[name="viewport"]').attr('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no');
                }).on('blur', function() {
                    $('meta[name="viewport"]').attr('content', 'width=device-width, initial-scale=1.0, user-scalable=yes');
                });
            }
            
            // تحسين الأداء للجوال
            if (this.isMobile) {
                // تقليل جودة الصور على الشاشات الصغيرة
                this.optimizeImages();
                
                // تأجيل تحميل المحتوى غير المرئي
                this.deferNonCriticalContent();
            }
        }

        /**
         * قائمة التنقل المحمولة
         */
        initMobileNavigation() {
            const nav = $('.main-navigation');
            const mobileToggle = $('.mobile-menu-toggle');
            
            // إنشاء زر القائمة إذا لم يكن موجوداً
            if (mobileToggle.length === 0) {
                const toggleBtn = $(`
                    <button class="mobile-menu-toggle" aria-label="فتح القائمة">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                `);
                $('.site-header').prepend(toggleBtn);
            }
            
            // معالج فتح/إغلاق القائمة
            $(document).on('click', '.mobile-menu-toggle', (e) => {
                e.preventDefault();
                this.toggleMobileMenu();
            });
            
            // إغلاق القائمة عند النقر خارجها
            $(document).on('click', (e) => {
                if (!$(e.target).closest('.main-navigation, .mobile-menu-toggle').length) {
                    this.closeMobileMenu();
                }
            });
            
            // إغلاق القائمة عند الضغط على Escape
            $(document).on('keydown', (e) => {
                if (e.keyCode === 27) {
                    this.closeMobileMenu();
                }
            });
            
            // تحسين القوائم الفرعية للجوال
            this.optimizeSubMenus();
        }

        /**
         * تبديل القائمة المحمولة
         */
        toggleMobileMenu() {
            const nav = $('.main-navigation');
            const toggle = $('.mobile-menu-toggle');
            const body = $('body');
            
            if (nav.hasClass('mobile-menu-open')) {
                this.closeMobileMenu();
            } else {
                nav.addClass('mobile-menu-open');
                toggle.addClass('active');
                body.addClass('mobile-menu-active');
                
                // منع التمرير في الخلفية
                body.css('overflow', 'hidden');
                
                // إطلاق حدث مخصص
                $(document).trigger('muhtawaa:mobile-menu-opened');
            }
        }

        /**
         * إغلاق القائمة المحمولة
         */
        closeMobileMenu() {
            const nav = $('.main-navigation');
            const toggle = $('.mobile-menu-toggle');
            const body = $('body');
            
            nav.removeClass('mobile-menu-open');
            toggle.removeClass('active');
            body.removeClass('mobile-menu-active');
            
            // استعادة التمرير
            body.css('overflow', '');
            
            // إطلاق حدث مخصص
            $(document).trigger('muhtawaa:mobile-menu-closed');
        }

        /**
         * تحسين القوائم الفرعية
         */
        optimizeSubMenus() {
            $('.menu-item-has-children').each(function() {
                const menuItem = $(this);
                const subMenu = menuItem.find('.sub-menu');
                
                // إضافة زر للقوائم الفرعية
                if (!menuItem.find('.submenu-toggle').length) {
                    const toggleBtn = $('<button class="submenu-toggle" aria-label="فتح القائمة الفرعية"><i class="fas fa-chevron-down"></i></button>');
                    menuItem.append(toggleBtn);
                    
                    // معالج فتح/إغلاق القائمة الفرعية
                    toggleBtn.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const isOpen = subMenu.hasClass('open');
                        
                        // إغلاق جميع القوائم الفرعية الأخرى
                        $('.sub-menu.open').removeClass('open');
                        $('.submenu-toggle.active').removeClass('active');
                        
                        if (!isOpen) {
                            subMenu.addClass('open');
                            $(this).addClass('active');
                        }
                    });
                }
            });
        }

        /**
         * إيماءات اللمس
         */
        initTouchGestures() {
            // إيماءة النقر المزدوج للتكبير
            $(document).on('touchend', '.muhtawaa-zoomable', (e) => {
                const currentTime = new Date().getTime();
                const tapLength = currentTime - this.lastTap;
                
                if (tapLength < 500 && tapLength > 0) {
                    // نقر مزدوج
                    const element = $(e.target);
                    this.handleDoubleTap(element);
                    e.preventDefault();
                }
                this.lastTap = currentTime;
            });
            
            // إيماءة الضغط المطول
            let pressTimer;
            $(document).on('touchstart', '.muhtawaa-long-press', (e) => {
                pressTimer = setTimeout(() => {
                    this.handleLongPress($(e.target));
                }, 500);
            }).on('touchend touchmove', '.muhtawaa-long-press', () => {
                clearTimeout(pressTimer);
            });
        }

        /**
         * إيماءات السحب
         */
        initSwipeGestures() {
            // السحب على البطاقات للمشاركة أو الحفظ
            $('.muhtawaa-swipeable').each(function() {
                const element = $(this);
                let startX, startY, currentX, currentY;
                let isSwiping = false;
                
                element.on('touchstart', function(e) {
                    const touch = e.originalEvent.touches[0];
                    startX = touch.clientX;
                    startY = touch.clientY;
                    isSwiping = false;
                });
                
                element.on('touchmove', function(e) {
                    if (!startX || !startY) return;
                    
                    const touch = e.originalEvent.touches[0];
                    currentX = touch.clientX;
                    currentY = touch.clientY;
                    
                    const diffX = startX - currentX;
                    const diffY = startY - currentY;
                    
                    // التحقق من السحب الأفقي
                    if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 10) {
                        isSwiping = true;
                        e.preventDefault();
                        
                        // إضافة تأثير بصري للسحب
                        const percentage = Math.min(Math.abs(diffX) / element.width() * 100, 100);
                        element.css('transform', `translateX(${-diffX}px)`);
                        
                        // إظهار أزرار الإجراءات
                        if (diffX > 0) {
                            // سحب لليسار - إظهار إجراءات اليمين
                            element.addClass('swiped-left');
                        } else {
                            // سحب لليمين - إظهار إجراءات اليسار
                            element.addClass('swiped-right');
                        }
                    }
                });
                
                element.on('touchend', function(e) {
                    if (isSwiping) {
                        const diffX = startX - currentX;
                        
                        if (Math.abs(diffX) > element.width() * 0.3) {
                            // سحب كامل - تنفيذ الإجراء
                            if (diffX > 0) {
                                $(document).trigger('muhtawaa:swipe-left', [element]);
                            } else {
                                $(document).trigger('muhtawaa:swipe-right', [element]);
                            }
                        } else {
                            // إعادة العنصر لمكانه
                            element.css('transform', '');
                            element.removeClass('swiped-left swiped-right');
                        }
                    }
                    
                    startX = startY = currentX = currentY = null;
                    isSwiping = false;
                });
            });
        }

        /**
         * السحب للتحديث
         */
        initPullToRefresh() {
            if (!this.isMobile) return;
            
            const container = $('.muhtawaa-pull-refresh');
            if (container.length === 0) return;
            
            let startY = 0;
            let currentY = 0;
            let isPulling = false;
            const threshold = 60;
            
            // إضافة مؤشر التحديث
            const refreshIndicator = $('<div class="pull-refresh-indicator"><i class="fas fa-arrow-down"></i><span>اسحب للتحديث</span></div>');
            container.prepend(refreshIndicator);
            
            container.on('touchstart', (e) => {
                if ($(window).scrollTop() === 0) {
                    startY = e.originalEvent.touches[0].clientY;
                    isPulling = true;
                }
            });
            
            container.on('touchmove', (e) => {
                if (!isPulling) return;
                
                currentY = e.originalEvent.touches[0].clientY;
                const pullDistance = currentY - startY;
                
                if (pullDistance > 0) {
                    e.preventDefault();
                    
                    const percentage = Math.min(pullDistance / threshold, 1);
                    refreshIndicator.css('transform', `translateY(${pullDistance}px)`);
                    
                    if (pullDistance >= threshold) {
                        refreshIndicator.addClass('ready');
                        refreshIndicator.find('span').text('اتركه للتحديث');
                    } else {
                        refreshIndicator.removeClass('ready');
                        refreshIndicator.find('span').text('اسحب للتحديث');
                    }
                }
            });
            
            container.on('touchend', (e) => {
                if (!isPulling) return;
                
                const pullDistance = currentY - startY;
                
                if (pullDistance >= threshold) {
                    // تنفيذ التحديث
                    this.performPullRefresh(refreshIndicator);
                } else {
                    // إعادة المؤشر لمكانه
                    refreshIndicator.css('transform', '');
                    refreshIndicator.removeClass('ready');
                }
                
                isPulling = false;
            });
        }

        /**
         * تنفيذ السحب للتحديث
         */
        async performPullRefresh(indicator) {
            indicator.addClass('refreshing');
            indicator.find('i').removeClass('fa-arrow-down').addClass('fa-spinner fa-spin');
            indicator.find('span').text('جاري التحديث...');
            
            try {
                // إعادة تحميل الصفحة أو تحديث المحتوى
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                // تحديث المحتوى هنا
                $(document).trigger('muhtawaa:content-refreshed');
                
                // إخفاء المؤشر
                indicator.addClass('success');
                indicator.find('span').text('تم التحديث');
                
                setTimeout(() => {
                    indicator.css('transform', '');
                    indicator.removeClass('refreshing success ready');
                    indicator.find('i').removeClass('fa-spinner fa-spin').addClass('fa-arrow-down');
                    indicator.find('span').text('اسحب للتحديث');
                }, 1000);
                
            } catch (error) {
                indicator.addClass('error');
                indicator.find('span').text('فشل التحديث');
                console.error('خطأ السحب للتحديث:', error);
            }
        }

        /**
         * البحث المحمول
         */
        initMobileSearch() {
            const searchToggle = $('.mobile-search-toggle');
            const searchForm = $('.mobile-search-form');
            
            // إنشاء نموذج البحث المحمول إذا لم يكن موجوداً
            if (searchForm.length === 0 && this.isMobile) {
                const mobileSearch = $(`
                    <div class="mobile-search-form">
                        <div class="search-overlay"></div>
                        <div class="search-container">
                            <form class="search-form" role="search">
                                <input type="search" class="search-field" placeholder="ابحث في الموقع..." autocomplete="off">
                                <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
                                <button type="button" class="search-close"><i class="fas fa-times"></i></button>
                            </form>
                            <div class="search-suggestions"></div>
                        </div>
                    </div>
                `);
                $('body').append(mobileSearch);
            }
            
            // معالج فتح البحث
            searchToggle.on('click', (e) => {
                e.preventDefault();
                this.openMobileSearch();
            });
            
            // معالج إغلاق البحث
            $(document).on('click', '.search-close, .search-overlay', () => {
                this.closeMobileSearch();
            });
            
            // البحث المباشر
            $(document).on('input', '.mobile-search-form .search-field', (e) => {
                const query = $(e.target).val().trim();
                if (query.length >= 2) {
                    this.performMobileSearch(query);
                }
            });
        }

        /**
         * فتح البحث المحمول
         */
        openMobileSearch() {
            const searchForm = $('.mobile-search-form');
            const body = $('body');
            
            searchForm.addClass('active');
            body.addClass('search-active');
            
            // التركيز على حقل البحث
            setTimeout(() => {
                searchForm.find('.search-field').focus();
            }, 300);
        }

        /**
         * إغلاق البحث المحمول
         */
        closeMobileSearch() {
            const searchForm = $('.mobile-search-form');
            const body = $('body');
            
            searchForm.removeClass('active');
            body.removeClass('search-active');
            
            // مسح حقل البحث
            searchForm.find('.search-field').val('');
            searchForm.find('.search-suggestions').empty();
        }

        /**
         * تنفيذ البحث المحمول
         */
        async performMobileSearch(query) {
            const suggestions = $('.search-suggestions');
            
            suggestions.html('<div class="search-loading"><i class="fas fa-spinner fa-spin"></i> جاري البحث...</div>');
            
            try {
                // استخدام نفس نظام البحث من AJAX
                if (window.MuhtawaaAjax) {
                    const response = await window.MuhtawaaAjax.request('POST', muhtawaaData.ajaxurl, {
                        action: 'muhtawaa_live_search',
                        query: query,
                        limit: 8
                    });
                    
                    if (response.success && response.data.results) {
                        this.displayMobileSearchResults(response.data.results, suggestions);
                    } else {
                        suggestions.html('<div class="search-no-results">لم يتم العثور على نتائج</div>');
                    }
                }
            } catch (error) {
                suggestions.html('<div class="search-error">حدث خطأ في البحث</div>');
                console.error('خطأ البحث المحمول:', error);
            }
        }

        /**
         * عرض نتائج البحث المحمول
         */
        displayMobileSearchResults(results, container) {
            let html = '<ul class="mobile-search-results">';
            
            results.forEach(result => {
                html += `
                    <li class="search-result-item">
                        <a href="${result.url}" class="search-result-link">
                            <div class="result-content">
                                <h4 class="result-title">${result.title}</h4>
                                <p class="result-excerpt">${result.excerpt}</p>
                            </div>
                        </a>
                    </li>
                `;
            });
            
            html += '</ul>';
            container.html(html);
        }

        /**
         * النوافذ المنبثقة المحمولة
         */
        initMobileModal() {
            // تحسين النوافذ المنبثقة للجوال
            $('.muhtawaa-modal').each(function() {
                const modal = $(this);
                
                // إضافة إيماءة السحب للإغلاق
                let startY = 0;
                let currentY = 0;
                
                modal.on('touchstart', '.modal-content', function(e) {
                    startY = e.originalEvent.touches[0].clientY;
                });
                
                modal.on('touchmove', '.modal-content', function(e) {
                    currentY = e.originalEvent.touches[0].clientY;
                    const diff = currentY - startY;
                    
                    if (diff > 0) {
                        $(this).css('transform', `translateY(${diff}px)`);
                    }
                });
                
                modal.on('touchend', '.modal-content', function(e) {
                    const diff = currentY - startY;
                    
                    if (diff > 100) {
                        // إغلاق النافذة
                        modal.removeClass('active');
                    } else {
                        // إعادة النافذة لمكانها
                        $(this).css('transform', '');
                    }
                });
            });
        }

        /**
         * المشاركة المحمولة
         */
        initMobileShare() {
            // تحسين أزرار المشاركة للجوال
            $('.muhtawaa-share-mobile').on('click', function(e) {
                e.preventDefault();
                
                const url = $(this).data('url') || window.location.href;
                const title = $(this).data('title') || document.title;
                const text = $(this).data('text') || '';
                
                // استخدام Web Share API إذا كان متوفراً
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        text: text,
                        url: url
                    }).catch(err => {
                        console.log('خطأ في المشاركة:', err);
                    });
                } else {
                    // عرض خيارات المشاركة التقليدية
                    this.showMobileShareOptions(url, title, text);
                }
            });
        }

        /**
         * عرض خيارات المشاركة المحمولة
         */
        showMobileShareOptions(url, title, text) {
            const shareModal = $(`
                <div class="mobile-share-modal">
                    <div class="share-backdrop"></div>
                    <div class="share-content">
                        <h3>مشاركة المقال</h3>
                        <div class="share-options">
                            <a href="https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}" class="share-option whatsapp" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span>واتساب</span>
                            </a>
                            <a href="https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}" class="share-option telegram" target="_blank">
                                <i class="fab fa-telegram"></i>
                                <span>تلجرام</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}" class="share-option twitter" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span>تويتر</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" class="share-option facebook" target="_blank">
                                <i class="fab fa-facebook"></i>
                                <span>فيسبوك</span>
                            </a>
                            <button class="share-option copy-link" data-url="${url}">
                                <i class="fas fa-copy"></i>
                                <span>نسخ الرابط</span>
                            </button>
                        </div>
                        <button class="share-close"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `);
            
            $('body').append(shareModal);
            shareModal.addClass('active');
            
            // معالج إغلاق النافذة
            shareModal.on('click', '.share-close, .share-backdrop', function() {
                shareModal.removeClass('active');
                setTimeout(() => shareModal.remove(), 300);
            });
            
            // معالج نسخ الرابط
            shareModal.on('click', '.copy-link', function(e) {
                e.preventDefault();
                const url = $(this).data('url');
                
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(url).then(() => {
                        $(this).find('span').text('تم النسخ');
                        setTimeout(() => {
                            shareModal.removeClass('active');
                            setTimeout(() => shareModal.remove(), 300);
                        }, 1000);
                    });
                }
            });
        }

        /**
         * التمرير المحمول المحسن
         */
        initMobileScroll() {
            if (!this.isMobile) return;
            
            // إخفاء/إظهار الهيدر عند التمرير
            let lastScrollTop = 0;
            const header = $('.site-header');
            
            $(window).on('scroll', this.throttle(() => {
                const scrollTop = $(window).scrollTop();
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // التمرير لأسفل - إخفاء الهيدر
                    header.addClass('header-hidden');
                } else {
                    // التمرير لأعلى - إظهار الهيدر
                    header.removeClass('header-hidden');
                }
                
                lastScrollTop = scrollTop;
            }, 100));
            
            // زر العودة للأعلى
            const backToTop = $('.back-to-top');
            
            if (backToTop.length === 0) {
                const backBtn = $('<button class="back-to-top mobile-back-top"><i class="fas fa-chevron-up"></i></button>');
                $('body').append(backBtn);
                
                backBtn.on('click', () => {
                    $('html, body').animate({ scrollTop: 0 }, 500);
                });
            }
            
            $(window).on('scroll', this.throttle(() => {
                const scrollTop = $(window).scrollTop();
                
                if (scrollTop > 300) {
                    $('.mobile-back-top').addClass('visible');
                } else {
                    $('.mobile-back-top').removeClass('visible');
                }
            }, 100));
        }

        /**
         * النماذج المحمولة المحسنة
         */
        initMobileForm() {
            if (!this.isMobile) return;
            
            // تحسين حقول الإدخال للجوال
            $('input, textarea, select').each(function() {
                const field = $(this);
                const type = field.attr('type');
                
                // إضافة خصائص الجوال المناسبة
                if (type === 'email') {
                    field.attr('autocapitalize', 'none');
                    field.attr('autocorrect', 'off');
                    field.attr('inputmode', 'email');
                } else if (type === 'tel') {
                    field.attr('inputmode', 'tel');
                } else if (type === 'number') {
                    field.attr('inputmode', 'numeric');
                } else if (type === 'url') {
                    field.attr('autocapitalize', 'none');
                    field.attr('autocorrect', 'off');
                    field.attr('inputmode', 'url');
                }
                
                // تحسين مظهر حقول النص للجوال
                if (field.is('textarea')) {
                    field.attr('rows', 4); // تقليل الصفوف الافتراضية
                }
            });
            
            // منع التكبير عند التركيز على الحقول الصغيرة
            $('input[type="text"], input[type="email"], input[type="password"], textarea').on('focus', function() {
                if (parseFloat($(this).css('font-size')) < 16) {
                    $(this).css('font-size', '16px');
                }
            });
        }

        /**
         * الصور المحمولة المحسنة
         */
        initMobileImage() {
            if (!this.isMobile) return;
            
            // تحسين عرض الصور للجوال
            $('img').each(function() {
                const img = $(this);
                
                // إضافة loading="lazy" للصور
                if (!img.attr('loading')) {
                    img.attr('loading', 'lazy');
                }
                
                // تحسين حجم الصور للجوال
                if (img.attr('src') && !img.hasClass('no-mobile-optimize')) {
                    const src = img.attr('src');
                    
                    // استبدال الصور الكبيرة بنسخ مصغرة للجوال
                    if (src.includes('wp-content/uploads/')) {
                        const mobileSrc = src.replace(/\.(jpg|jpeg|png|webp)$/i, '-mobile.$1');
                        
                        // التحقق من وجود النسخة المصغرة
                        const testImg = new Image();
                        testImg.onload = function() {
                            img.attr('src', mobileSrc);
                        };
                        testImg.src = mobileSrc;
                    }
                }
            });
            
            // تحسين معارض الصور للجوال
            $('.gallery').each(function() {
                const gallery = $(this);
                
                // إضافة إيماءات السحب للتنقل
                this.addSwipeGallery(gallery);
            });
        }

        /**
         * إضافة السحب لمعارض الصور
         */
        addSwipeGallery(gallery) {
            const items = gallery.find('.gallery-item');
            let currentIndex = 0;
            
            items.on('touchstart', (e) => {
                this.touchStartX = e.originalEvent.touches[0].clientX;
            });
            
            items.on('touchend', (e) => {
                this.touchEndX = e.originalEvent.changedTouches[0].clientX;
                const diffX = this.touchStartX - this.touchEndX;
                
                if (Math.abs(diffX) > this.swipeThreshold) {
                    if (diffX > 0 && currentIndex < items.length - 1) {
                        // سحب لليسار - الصورة التالية
                        currentIndex++;
                        this.scrollToGalleryItem(gallery, currentIndex);
                    } else if (diffX < 0 && currentIndex > 0) {
                        // سحب لليمين - الصورة السابقة
                        currentIndex--;
                        this.scrollToGalleryItem(gallery, currentIndex);
                    }
                }
            });
        }

        /**
         * التمرير لعنصر معرض محدد
         */
        scrollToGalleryItem(gallery, index) {
            const items = gallery.find('.gallery-item');
            const targetItem = items.eq(index);
            
            if (targetItem.length) {
                gallery.animate({
                    scrollLeft: targetItem.position().left + gallery.scrollLeft()
                }, 300);
            }
        }

        /**
         * دعم العمل بدون اتصال
         */
        initOfflineSupport() {
            // التحقق من حالة الاتصال
            this.updateConnectionStatus();
            
            // إضافة Service Worker للتخزين المؤقت
            if ('serviceWorker' in navigator) {
                this.registerServiceWorker();
            }
            
            // تخزين المحتوى المهم محلياً
            this.cacheImportantContent();
        }

        /**
         * تسجيل Service Worker
         */
        async registerServiceWorker() {
            try {
                const registration = await navigator.serviceWorker.register('/sw.js');
                console.log('Service Worker مسجل بنجاح:', registration);
                
                // تحديث Service Worker
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            // إشعار المستخدم بالتحديث المتاح
                            this.showUpdateNotification();
                        }
                    });
                });
                
            } catch (error) {
                console.log('فشل تسجيل Service Worker:', error);
            }
        }

        /**
         * تخزين المحتوى المهم
         */
        cacheImportantContent() {
            if ('localStorage' in window) {
                // تخزين المقالات المقروءة حديثاً
                const recentPosts = JSON.parse(localStorage.getItem('muhtawaa_recent_posts') || '[]');
                
                // إضافة المقال الحالي للمقالات الحديثة
                if (muhtawaaData.postId) {
                    const currentPost = {
                        id: muhtawaaData.postId,
                        title: document.title,
                        url: window.location.href,
                        timestamp: Date.now()
                    };
                    
                    // إزالة المقال إذا كان موجوداً مسبقاً
                    const filteredPosts = recentPosts.filter(post => post.id !== currentPost.id);
                    
                    // إضافة المقال في المقدمة
                    filteredPosts.unshift(currentPost);
                    
                    // الاحتفاظ بآخر 10 مقالات فقط
                    const limitedPosts = filteredPosts.slice(0, 10);
                    
                    localStorage.setItem('muhtawaa_recent_posts', JSON.stringify(limitedPosts));
                }
            }
        }

        /**
         * معالج الأحداث
         */
        
        handleTouchStart(e) {
            this.touchStartX = e.originalEvent.touches[0].clientX;
            this.touchStartY = e.originalEvent.touches[0].clientY;
        }

        handleTouchMove(e) {
            // منع التمرير المطاطي على iOS
            if (this.isIOS() && !$(e.target).closest('.scrollable').length) {
                const scrollTop = $(window).scrollTop();
                const documentHeight = $(document).height();
                const windowHeight = $(window).height();
                
                if ((scrollTop <= 0) || (scrollTop >= documentHeight - windowHeight)) {
                    e.preventDefault();
                }
            }
        }

        handleTouchEnd(e) {
            this.touchEndX = e.originalEvent.changedTouches[0].clientX;
            this.touchEndY = e.originalEvent.changedTouches[0].clientY;
            
            // تحديد اتجاه السحب
            const diffX = this.touchStartX - this.touchEndX;
            const diffY = this.touchStartY - this.touchEndY;
            
            // إطلاق أحداث السحب
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > this.swipeThreshold) {
                if (diffX > 0) {
                    $(document).trigger('muhtawaa:swipe-left', [e.target]);
                } else {
                    $(document).trigger('muhtawaa:swipe-right', [e.target]);
                }
            } else if (Math.abs(diffY) > this.swipeThreshold) {
                if (diffY > 0) {
                    $(document).trigger('muhtawaa:swipe-up', [e.target]);
                } else {
                    $(document).trigger('muhtawaa:swipe-down', [e.target]);
                }
            }
        }

        handleOrientationChange() {
            // تأخير معالجة التوجه لإتاحة الوقت للمتصفح لتحديث الأبعاد
            setTimeout(() => {
                const orientation = window.innerHeight > window.innerWidth ? 'portrait' : 'landscape';
                const body = $('body');
                
                body.removeClass('orientation-portrait orientation-landscape');
                body.addClass(`orientation-${orientation}`);
                
                // إعادة حساب الأبعاد
                this.recalculateDimensions();
                
                // إطلاق حدث مخصص
                $(document).trigger('muhtawaa:orientation-changed', [orientation]);
            }, 500);
        }

        handleResize() {
            this.recalculateDimensions();
            
            // تحديث فئات الجهاز
            this.isMobile = this.detectMobile();
            this.isTablet = this.detectTablet();
            this.addMobileClasses();
        }

        handleOnline() {
            $('body').removeClass('offline').addClass('online');
            this.showConnectionNotification('تم استعادة الاتصال بالإنترنت', 'success');
            
            // مزامنة البيانات المحفوظة محلياً
            this.syncOfflineData();
        }

        handleOffline() {
            $('body').removeClass('online').addClass('offline');
            this.showConnectionNotification('لا يوجد اتصال بالإنترنت. سيتم العمل في وضع عدم الاتصال.', 'warning');
        }

        handleMenuToggle(e, action) {
            if (action === 'open') {
                this.toggleMobileMenu();
            } else if (action === 'close') {
                this.closeMobileMenu();
            }
        }

        handleSearchToggle(e, action) {
            if (action === 'open') {
                this.openMobileSearch();
            } else if (action === 'close') {
                this.closeMobileSearch();
            }
        }

        handleDoubleTap(element) {
            // تكبير/تصغير الصورة
            if (element.is('img') || element.hasClass('muhtawaa-zoomable')) {
                const isZoomed = element.hasClass('zoomed');
                
                if (isZoomed) {
                    element.removeClass('zoomed');
                    element.css('transform', 'scale(1)');
                } else {
                    element.addClass('zoomed');
                    element.css('transform', 'scale(2)');
                }
            }
        }

        handleLongPress(element) {
            // إظهار قائمة سياقية
            if (element.hasClass('muhtawaa-contextual')) {
                this.showContextMenu(element);
            }
            
            // إطلاق حدث مخصص
            $(document).trigger('muhtawaa:long-press', [element]);
        }

        /**
         * دوال المساعدة
         */
        
        /**
         * اكتشاف الجهاز المحمول
         */
        detectMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
                   window.innerWidth <= 768;
        }

        /**
         * اكتشاف الجهاز اللوحي
         */
        detectTablet() {
            return /iPad|Android/i.test(navigator.userAgent) && window.innerWidth > 768 && window.innerWidth <= 1024;
        }

        /**
         * اكتشاف نظام التشغيل
         */
        detectOS() {
            const ua = navigator.userAgent;
            
            if (/Android/i.test(ua)) return 'android';
            if (/iPhone|iPad|iPod/i.test(ua)) return 'ios';
            if (/Windows Phone/i.test(ua)) return 'windows';
            if (/BlackBerry/i.test(ua)) return 'blackberry';
            
            return null;
        }

        /**
         * اكتشاف المتصفح
         */
        detectBrowser() {
            const ua = navigator.userAgent;
            
            if (/Chrome/i.test(ua) && !/Edge/i.test(ua)) return 'chrome';
            if (/Safari/i.test(ua) && !/Chrome/i.test(ua)) return 'safari';
            if (/Firefox/i.test(ua)) return 'firefox';
            if (/Edge/i.test(ua)) return 'edge';
            if (/Opera/i.test(ua)) return 'opera';
            
            return null;
        }

        /**
         * التحقق من iOS
         */
        isIOS() {
            return /iPhone|iPad|iPod/i.test(navigator.userAgent);
        }

        /**
         * إعادة حساب الأبعاد
         */
        recalculateDimensions() {
            // تحديث متغيرات CSS للأبعاد
            const vh = window.innerHeight * 0.01;
            const vw = window.innerWidth * 0.01;
            
            document.documentElement.style.setProperty('--vh', `${vh}px`);
            document.documentElement.style.setProperty('--vw', `${vw}px`);
            
            // إطلاق حدث إعادة الحساب
            $(document).trigger('muhtawaa:dimensions-recalculated');
        }

        /**
         * تحديث حالة الاتصال
         */
        updateConnectionStatus() {
            const isOnline = navigator.onLine;
            const body = $('body');
            
            if (isOnline) {
                body.removeClass('offline').addClass('online');
            } else {
                body.removeClass('online').addClass('offline');
            }
        }

        /**
         * مزامنة البيانات المحفوظة محلياً
         */
        async syncOfflineData() {
            if ('localStorage' in window) {
                const offlineData = JSON.parse(localStorage.getItem('muhtawaa_offline_data') || '[]');
                
                if (offlineData.length > 0) {
                    // إرسال البيانات المحفوظة
                    try {
                        for (const data of offlineData) {
                            await this.sendOfflineData(data);
                        }
                        
                        // مسح البيانات بعد المزامنة الناجحة
                        localStorage.removeItem('muhtawaa_offline_data');
                        this.showConnectionNotification('تم مزامنة البيانات المحفوظة', 'success');
                        
                    } catch (error) {
                        console.error('خطأ في مزامنة البيانات:', error);
                    }
                }
            }
        }

        /**
         * إرسال البيانات المحفوظة
         */
        async sendOfflineData(data) {
            if (window.MuhtawaaAjax) {
                return await window.MuhtawaaAjax.request('POST', muhtawaaData.ajaxurl, data);
            }
        }

        /**
         * عرض قائمة سياقية
         */
        showContextMenu(element) {
            const contextMenu = $(`
                <div class="mobile-context-menu">
                    <div class="context-backdrop"></div>
                    <div class="context-content">
                        <button class="context-option" data-action="copy">نسخ</button>
                        <button class="context-option" data-action="share">مشاركة</button>
                        <button class="context-option" data-action="save">حفظ</button>
                        <button class="context-close"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `);
            
            $('body').append(contextMenu);
            contextMenu.addClass('active');
            
            // معالج إغلاق القائمة
            contextMenu.on('click', '.context-close, .context-backdrop', function() {
                contextMenu.removeClass('active');
                setTimeout(() => contextMenu.remove(), 300);
            });
            
            // معالج خيارات القائمة
            contextMenu.on('click', '.context-option', function(e) {
                const action = $(this).data('action');
                $(document).trigger('muhtawaa:context-action', [action, element]);
                
                contextMenu.removeClass('active');
                setTimeout(() => contextMenu.remove(), 300);
            });
        }

        /**
         * تحسين الصور للجوال
         */
        optimizeImages() {
            $('img').each(function() {
                const img = $(this);
                
                // تأجيل تحميل الصور خارج الشاشة
                if (!img.attr('loading')) {
                    img.attr('loading', 'lazy');
                }
                
                // تصغير جودة الصور للجوال
                const src = img.attr('src');
                if (src && src.includes('wp-content/uploads/')) {
                    // استبدال الصور عالية الدقة بنسخ محسنة للجوال
                    const mobileSrc = src.replace(/\.(jpg|jpeg|png)$/i, '_mobile.$1');
                    
                    // اختبار وجود النسخة المحسنة
                    const testImg = new Image();
                    testImg.onload = function() {
                        img.attr('src', mobileSrc);
                    };
                    testImg.src = mobileSrc;
                }
            });
        }

        /**
         * تأجيل المحتوى غير الحرج
         */
        deferNonCriticalContent() {
            // تأجيل تحميل الويدجت غير المهمة
            $('.widget:not(.widget-important)').each(function() {
                const widget = $(this);
                const placeholder = $('<div class="widget-placeholder">جاري التحميل...</div>');
                
                widget.hide().after(placeholder);
                
                // تحميل الويدجت عند التمرير إليها
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            widget.show();
                            placeholder.remove();
                            observer.unobserve(entry.target);
                        }
                    });
                });
                
                observer.observe(placeholder[0]);
            });
            
            // تأجيل تحميل المحتوى الثقيل
            $('.heavy-content').each(function() {
                const content = $(this);
                content.data('original-content', content.html());
                content.html('<div class="loading-placeholder">جاري التحميل...</div>');
                
                setTimeout(() => {
                    content.html(content.data('original-content'));
                }, 2000);
            });
        }

        /**
         * عرض إشعار الاتصال
         */
        showConnectionNotification(message, type = 'info') {
            if (window.MuhtawaaNotifications) {
                window.MuhtawaaNotifications.show(message, type);
            }
        }

        /**
         * عرض إشعار التحديث
         */
        showUpdateNotification() {
            const updateBanner = $(`
                <div class="app-update-banner">
                    <div class="update-content">
                        <i class="fas fa-download"></i>
                        <span>يتوفر تحديث جديد للموقع</span>
                        <button class="update-btn">تحديث</button>
                        <button class="update-close"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `);
            
            $('body').append(updateBanner);
            updateBanner.addClass('visible');
            
            // معالج تحديث الموقع
            updateBanner.on('click', '.update-btn', function() {
                window.location.reload();
            });
            
            // معالج إغلاق الإشعار
            updateBanner.on('click', '.update-close', function() {
                updateBanner.removeClass('visible');
                setTimeout(() => updateBanner.remove(), 300);
            });
        }

        /**
         * دوال Utility
         */
        
        throttle(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            }
        }

        debounce(func, wait, immediate) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                const later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                const callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }

        /**
         * API عامة
         */
        
        /**
         * فتح القائمة المحمولة
         */
        openMenu() {
            this.toggleMobileMenu();
        }

        /**
         * إغلاق القائمة المحمولة
         */
        closeMenu() {
            this.closeMobileMenu();
        }

        /**
         * فتح البحث المحمول
         */
        openSearch() {
            this.openMobileSearch();
        }

        /**
         * إغلاق البحث المحمول
         */
        closeSearch() {
            this.closeMobileSearch();
        }

        /**
         * التحقق من نوع الجهاز
         */
        getDeviceType() {
            if (this.isMobile) return 'mobile';
            if (this.isTablet) return 'tablet';
            return 'desktop';
        }

        /**
         * الحصول على معلومات الجهاز
         */
        getDeviceInfo() {
            return {
                type: this.getDeviceType(),
                os: this.detectOS(),
                browser: this.detectBrowser(),
                orientation: window.innerHeight > window.innerWidth ? 'portrait' : 'landscape',
                screenWidth: window.screen.width,
                screenHeight: window.screen.height,
                viewportWidth: window.innerWidth,
                viewportHeight: window.innerHeight,
                pixelRatio: window.devicePixelRatio || 1,
                isOnline: navigator.onLine,
                touchSupport: 'ontouchstart' in window
            };
        }
    }

    /**
     * تهيئة النظام عند تحميل الصفحة
     */
    $(document).ready(function() {
        // تهيئة نظام الجوال
        window.MuhtawaaMobile = new MuhtawaaMobile();
        
        // إتاحة API للاستخدام الخارجي
        window.muhtawaaMobile = {
            openMenu: () => window.MuhtawaaMobile.openMenu(),
            closeMenu: () => window.MuhtawaaMobile.closeMenu(),
            openSearch: () => window.MuhtawaaMobile.openSearch(),
            closeSearch: () => window.MuhtawaaMobile.closeSearch(),
            getDeviceType: () => window.MuhtawaaMobile.getDeviceType(),
            getDeviceInfo: () => window.MuhtawaaMobile.getDeviceInfo()
        };
        
        // إطلاق حدث التهيئة
        $(document).trigger('muhtawaa:mobile-initialized');
    });

})(jQuery);