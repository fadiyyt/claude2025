/**
 * ملف الميزات المتقدمة - قالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0
 * @author فريق التطوير
 */

(function($) {
    'use strict';

    /**
     * فئة الميزات المتقدمة
     */
    class MuhtawaaEnhanced {
        constructor() {
            this.init();
            this.bindEvents();
        }

        /**
         * تهيئة الفئة
         */
        init() {
            this.initLazyLoading();
            this.initInfiniteScroll();
            this.initFilterSystem();
            this.initModalSystem();
            this.initTooltips();
            this.initProgressBar();
            this.initParallaxEffects();
            this.initStickyElements();
            this.initImageZoom();
            this.initContentTabs();
        }

        /**
         * ربط الأحداث
         */
        bindEvents() {
            // حدث تحميل الصور الكسولة
            $(document).on('muhtawaa:lazy-loaded', this.onImageLazyLoaded);
            
            // حدث فلترة المحتوى
            $(document).on('muhtawaa:content-filtered', this.onContentFiltered);
            
            // حدث فتح/إغلاق النافذة المنبثقة
            $(document).on('muhtawaa:modal-opened', this.onModalOpened);
            $(document).on('muhtawaa:modal-closed', this.onModalClosed);
            
            // حدث التمرير
            $(window).on('scroll', this.throttle(this.onScroll.bind(this), 16));
            
            // حدث تغيير حجم النافذة
            $(window).on('resize', this.debounce(this.onResize.bind(this), 250));
        }

        /**
         * تحميل الصور الكسولة (Lazy Loading)
         */
        initLazyLoading() {
            const lazyImages = document.querySelectorAll('img[data-src], img[loading="lazy"]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            
                            // تحميل الصورة
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                            }
                            
                            // إضافة فئة التحميل
                            img.classList.add('muhtawaa-loaded');
                            
                            // إطلاق حدث مخصص
                            $(document).trigger('muhtawaa:lazy-loaded', [img]);
                            
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                    threshold: 0.01
                });

                lazyImages.forEach(img => imageObserver.observe(img));
            } else {
                // Fallback للمتصفحات القديمة
                lazyImages.forEach(img => {
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                });
            }
        }

        /**
         * التمرير اللانهائي (Infinite Scroll)
         */
        initInfiniteScroll() {
            const container = $('.muhtawaa-posts-container');
            const loadMoreBtn = $('.load-more-posts');
            
            if (container.length && loadMoreBtn.length) {
                let isLoading = false;
                let currentPage = parseInt(muhtawaaData.currentPage) || 1;
                const maxPages = parseInt(muhtawaaData.maxPages) || 1;

                // إضافة observer للتحميل التلقائي
                const loadMoreObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !isLoading && currentPage < maxPages) {
                            this.loadMorePosts(container, ++currentPage).then(() => {
                                isLoading = false;
                            });
                            isLoading = true;
                        }
                    });
                }, { threshold: 0.1 });

                if (loadMoreBtn.is(':visible')) {
                    loadMoreObserver.observe(loadMoreBtn[0]);
                }

                // حدث النقر على زر التحميل
                loadMoreBtn.on('click', (e) => {
                    e.preventDefault();
                    if (!isLoading && currentPage < maxPages) {
                        isLoading = true;
                        this.loadMorePosts(container, ++currentPage).then(() => {
                            isLoading = false;
                        });
                    }
                });
            }
        }

        /**
         * تحميل المزيد من المقالات
         */
        async loadMorePosts(container, page) {
            try {
                const response = await $.ajax({
                    url: muhtawaaData.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_load_more_posts',
                        nonce: muhtawaaData.nonce,
                        page: page,
                        query_vars: muhtawaaData.queryVars || {}
                    }
                });

                if (response.success && response.data.html) {
                    const newPosts = $(response.data.html);
                    
                    // إضافة حركة للمقالات الجديدة
                    newPosts.hide().appendTo(container).fadeIn(600);
                    
                    // تهيئة التحميل الكسول للصور الجديدة
                    this.initLazyLoading();
                    
                    // إطلاق حدث التحميل
                    $(document).trigger('muhtawaa:posts-loaded', [newPosts]);
                    
                    // إخفاء زر التحميل إذا انتهت الصفحات
                    if (page >= response.data.max_pages) {
                        $('.load-more-posts').fadeOut();
                    }
                }
            } catch (error) {
                console.error('خطأ في تحميل المقالات:', error);
                this.showNotification('حدث خطأ في تحميل المقالات', 'error');
            }
        }

        /**
         * نظام الفلترة المتقدم
         */
        initFilterSystem() {
            const filterContainer = $('.muhtawaa-filters');
            const contentContainer = $('.muhtawaa-filterable-content');
            
            if (filterContainer.length && contentContainer.length) {
                // فلترة حسب الفئة
                filterContainer.on('click', '.filter-category', (e) => {
                    e.preventDefault();
                    const category = $(e.target).data('category');
                    this.filterContent('category', category);
                });

                // فلترة حسب التاريخ
                filterContainer.on('change', '.filter-date', (e) => {
                    const date = $(e.target).val();
                    this.filterContent('date', date);
                });

                // فلترة حسب التقييم
                filterContainer.on('click', '.filter-rating', (e) => {
                    e.preventDefault();
                    const rating = $(e.target).data('rating');
                    this.filterContent('rating', rating);
                });

                // إعادة تعيين الفلاتر
                filterContainer.on('click', '.reset-filters', (e) => {
                    e.preventDefault();
                    this.resetFilters();
                });
            }
        }

        /**
         * فلترة المحتوى
         */
        async filterContent(type, value) {
            const container = $('.muhtawaa-filterable-content');
            const loader = $('<div class="muhtawaa-filter-loader"><i class="fas fa-spinner fa-spin"></i> جاري التحميل...</div>');
            
            container.append(loader);

            try {
                const response = await $.ajax({
                    url: muhtawaaData.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'muhtawaa_filter_content',
                        nonce: muhtawaaData.nonce,
                        filter_type: type,
                        filter_value: value,
                        current_filters: this.getCurrentFilters()
                    }
                });

                if (response.success) {
                    container.html(response.data.html);
                    
                    // تحديث عدد النتائج
                    $('.filter-results-count').text(response.data.count);
                    
                    // تحديث الحالة النشطة للفلاتر
                    this.updateActiveFilters(type, value);
                    
                    // إطلاق حدث الفلترة
                    $(document).trigger('muhtawaa:content-filtered', [type, value]);
                }
            } catch (error) {
                console.error('خطأ في فلترة المحتوى:', error);
                this.showNotification('حدث خطأ في فلترة المحتوى', 'error');
            } finally {
                loader.remove();
            }
        }

        /**
         * نظام النوافذ المنبثقة المتقدم
         */
        initModalSystem() {
            // فتح النافذة المنبثقة
            $(document).on('click', '[data-modal]', (e) => {
                e.preventDefault();
                const modalId = $(e.target).data('modal');
                this.openModal(modalId);
            });

            // إغلاق النافذة المنبثقة
            $(document).on('click', '.muhtawaa-modal-close, .muhtawaa-modal-backdrop', (e) => {
                if (e.target === e.currentTarget) {
                    this.closeModal();
                }
            });

            // إغلاق بالضغط على Escape
            $(document).on('keydown', (e) => {
                if (e.keyCode === 27) {
                    this.closeModal();
                }
            });
        }

        /**
         * فتح النافذة المنبثقة
         */
        openModal(modalId) {
            const modal = $(`#${modalId}`);
            if (modal.length) {
                $('body').addClass('modal-open');
                modal.addClass('active').fadeIn(300);
                
                // تركيز على أول عنصر قابل للتركيز
                modal.find('input, textarea, button').first().focus();
                
                // إطلاق حدث فتح النافذة
                $(document).trigger('muhtawaa:modal-opened', [modalId]);
            }
        }

        /**
         * إغلاق النافذة المنبثقة
         */
        closeModal() {
            const activeModal = $('.muhtawaa-modal.active');
            if (activeModal.length) {
                const modalId = activeModal.attr('id');
                
                activeModal.removeClass('active').fadeOut(300, () => {
                    $('body').removeClass('modal-open');
                });
                
                // إطلاق حدث إغلاق النافذة
                $(document).trigger('muhtawaa:modal-closed', [modalId]);
            }
        }

        /**
         * تلميحات الأدوات (Tooltips)
         */
        initTooltips() {
            $('[data-tooltip]').each(function() {
                const element = $(this);
                const text = element.data('tooltip');
                const position = element.data('tooltip-position') || 'top';
                
                element.hover(
                    function() {
                        const tooltip = $(`<div class="muhtawaa-tooltip muhtawaa-tooltip-${position}">${text}</div>`);
                        $('body').append(tooltip);
                        
                        const rect = this.getBoundingClientRect();
                        let top, left;
                        
                        switch(position) {
                            case 'bottom':
                                top = rect.bottom + window.scrollY + 10;
                                left = rect.left + (rect.width / 2) - (tooltip.outerWidth() / 2);
                                break;
                            case 'left':
                                top = rect.top + window.scrollY + (rect.height / 2) - (tooltip.outerHeight() / 2);
                                left = rect.left - tooltip.outerWidth() - 10;
                                break;
                            case 'right':
                                top = rect.top + window.scrollY + (rect.height / 2) - (tooltip.outerHeight() / 2);
                                left = rect.right + 10;
                                break;
                            default: // top
                                top = rect.top + window.scrollY - tooltip.outerHeight() - 10;
                                left = rect.left + (rect.width / 2) - (tooltip.outerWidth() / 2);
                        }
                        
                        tooltip.css({ top, left }).fadeIn(200);
                    },
                    function() {
                        $('.muhtawaa-tooltip').fadeOut(200, function() {
                            $(this).remove();
                        });
                    }
                );
            });
        }

        /**
         * شريط التقدم للقراءة
         */
        initProgressBar() {
            if ($('.muhtawaa-reading-progress').length) {
                $(window).on('scroll', this.throttle(() => {
                    const article = $('.single-post .entry-content');
                    if (article.length) {
                        const articleTop = article.offset().top;
                        const articleHeight = article.outerHeight();
                        const windowTop = $(window).scrollTop();
                        const windowHeight = $(window).height();
                        
                        const progress = Math.max(0, Math.min(100, 
                            ((windowTop + windowHeight - articleTop) / articleHeight) * 100
                        ));
                        
                        $('.muhtawaa-reading-progress .progress-fill').css('width', progress + '%');
                    }
                }, 16));
            }
        }

        /**
         * تأثيرات المنظر (Parallax)
         */
        initParallaxEffects() {
            const parallaxElements = $('.muhtawaa-parallax');
            
            if (parallaxElements.length && !this.isMobile()) {
                $(window).on('scroll', this.throttle(() => {
                    const scrollTop = $(window).scrollTop();
                    
                    parallaxElements.each(function() {
                        const element = $(this);
                        const speed = element.data('parallax-speed') || 0.5;
                        const yPos = -(scrollTop * speed);
                        
                        element.css('transform', `translateY(${yPos}px)`);
                    });
                }, 16));
            }
        }

        /**
         * العناصر الثابتة (Sticky Elements)
         */
        initStickyElements() {
            $('.muhtawaa-sticky').each(function() {
                const element = $(this);
                const offset = element.data('sticky-offset') || 0;
                const originalPosition = element.offset().top;
                
                $(window).on('scroll', () => {
                    const scrollTop = $(window).scrollTop();
                    
                    if (scrollTop >= originalPosition - offset) {
                        element.addClass('is-sticky');
                    } else {
                        element.removeClass('is-sticky');
                    }
                });
            });
        }

        /**
         * تكبير الصور
         */
        initImageZoom() {
            $('.muhtawaa-zoomable').on('click', function(e) {
                e.preventDefault();
                const img = $(this);
                const src = img.attr('src') || img.data('full-src');
                
                if (src) {
                    const lightbox = $(`
                        <div class="muhtawaa-lightbox">
                            <div class="lightbox-backdrop"></div>
                            <div class="lightbox-content">
                                <img src="${src}" alt="${img.attr('alt') || ''}">
                                <button class="lightbox-close"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    `);
                    
                    $('body').append(lightbox).addClass('lightbox-open');
                    lightbox.fadeIn(300);
                    
                    // إغلاق الـ lightbox
                    lightbox.on('click', '.lightbox-close, .lightbox-backdrop', () => {
                        lightbox.fadeOut(300, function() {
                            $(this).remove();
                            $('body').removeClass('lightbox-open');
                        });
                    });
                }
            });
        }

        /**
         * نظام التبويبات
         */
        initContentTabs() {
            $('.muhtawaa-tabs').each(function() {
                const tabsContainer = $(this);
                const tabs = tabsContainer.find('.tab-link');
                const panels = tabsContainer.find('.tab-panel');
                
                tabs.on('click', function(e) {
                    e.preventDefault();
                    const targetTab = $(this).data('tab');
                    
                    // إزالة الحالة النشطة من جميع التبويبات
                    tabs.removeClass('active');
                    panels.removeClass('active');
                    
                    // تفعيل التبويب المحدد
                    $(this).addClass('active');
                    $(`#${targetTab}`).addClass('active');
                });
            });
        }

        /**
         * عرض إشعار
         */
        showNotification(message, type = 'info') {
            if (window.MuhtawaaNotifications) {
                window.MuhtawaaNotifications.show(message, type);
            } else {
                alert(message);
            }
        }

        /**
         * الحصول على الفلاتر الحالية
         */
        getCurrentFilters() {
            const filters = {};
            
            $('.muhtawaa-filters .active').each(function() {
                const filterType = $(this).data('filter-type');
                const filterValue = $(this).data('filter-value');
                
                if (filterType && filterValue) {
                    if (!filters[filterType]) {
                        filters[filterType] = [];
                    }
                    filters[filterType].push(filterValue);
                }
            });
            
            return filters;
        }

        /**
         * تحديث الفلاتر النشطة
         */
        updateActiveFilters(type, value) {
            $(`.filter-${type}`).removeClass('active');
            $(`.filter-${type}[data-${type}="${value}"]`).addClass('active');
        }

        /**
         * إعادة تعيين الفلاتر
         */
        resetFilters() {
            $('.muhtawaa-filters .active').removeClass('active');
            $('.muhtawaa-filterable-content').load(location.href + ' .muhtawaa-filterable-content > *');
        }

        /**
         * التحقق من الجهاز المحمول
         */
        isMobile() {
            return window.innerWidth <= 768;
        }

        /**
         * دالة Throttle
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

        /**
         * دالة Debounce
         */
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
         * معالج التمرير
         */
        onScroll() {
            // يمكن إضافة وظائف مخصصة هنا
        }

        /**
         * معالج تغيير حجم النافذة
         */
        onResize() {
            // إعادة حساب العناصر الثابتة
            this.initStickyElements();
        }

        /**
         * معالج تحميل الصور الكسولة
         */
        onImageLazyLoaded(event, img) {
            // إضافة حركة عند تحميل الصورة
            $(img).addClass('fade-in');
        }

        /**
         * معالج فلترة المحتوى
         */
        onContentFiltered(event, type, value) {
            // تحديث الرابط في المتصفح
            if (history.pushState) {
                const url = new URL(window.location);
                url.searchParams.set(type, value);
                history.pushState({}, '', url);
            }
        }

        /**
         * معالج فتح النافذة المنبثقة
         */
        onModalOpened(event, modalId) {
            // منع التمرير في الخلفية
            $('body').css('overflow', 'hidden');
        }

        /**
         * معالج إغلاق النافذة المنبثقة
         */
        onModalClosed(event, modalId) {
            // استعادة التمرير
            $('body').css('overflow', '');
        }
    }

    /**
     * تهيئة الفئة عند تحميل الصفحة
     */
    $(document).ready(function() {
        // التحقق من توفر البيانات المطلوبة
        if (typeof muhtawaaData !== 'undefined') {
            window.MuhtawaaEnhanced = new MuhtawaaEnhanced();
        } else {
            console.warn('بيانات muhtawaaData غير متوفرة');
        }
    });

})(jQuery);