/**
 * JavaScript الرئيسي - قالب محتوى
 * Main JavaScript for Muhtawaa Theme
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

(function($) {
    'use strict';

    // كائن القالب الرئيسي
    var Muhtawaa = {
        // الإعدادات
        settings: {
            animationDuration: 300,
            scrollOffset: 100,
            breakpoints: {
                mobile: 576,
                tablet: 768,
                desktop: 992,
                wide: 1200
            }
        },

        // التهيئة
        init: function() {
            this.bindEvents();
            this.initMobileMenu();
            this.initStickyHeader();
            this.initScrollToTop();
            this.initLazyLoading();
            this.initTooltips();
            this.initModals();
            this.initForms();
            this.initAnimations();
            this.initRatingSystem();
            this.initNotifications();
            this.initSmartRecommendations();
            this.initSearch();
        },

        // ربط الأحداث
        bindEvents: function() {
            var self = this;

            // تغيير حجم النافذة
            $(window).on('resize', $.throttle(250, function() {
                self.onResize();
            }));

            // التمرير
            $(window).on('scroll', $.throttle(100, function() {
                self.onScroll();
            }));

            // النقرات العامة
            $(document).on('click', 'a[href^="#"]', function(e) {
                self.smoothScroll(e);
            });
        },

        // القائمة المحمولة
        initMobileMenu: function() {
            var $toggle = $('.mobile-menu-toggle');
            var $menu = $('.main-navigation');
            var $body = $('body');

            $toggle.on('click', function(e) {
                e.preventDefault();
                $body.toggleClass('mobile-menu-active');
                $menu.slideToggle(300);
                $(this).toggleClass('active');
            });

            // إغلاق القائمة عند النقر خارجها
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.main-navigation, .mobile-menu-toggle').length) {
                    if ($body.hasClass('mobile-menu-active')) {
                        $body.removeClass('mobile-menu-active');
                        $menu.slideUp(300);
                        $toggle.removeClass('active');
                    }
                }
            });

            // القوائم المنسدلة في المحمول
            $('.menu-item-has-children > a').on('click', function(e) {
                if ($(window).width() <= Muhtawaa.settings.breakpoints.tablet) {
                    e.preventDefault();
                    $(this).siblings('.sub-menu').slideToggle(300);
                    $(this).parent().toggleClass('active');
                }
            });
        },

        // الهيدر اللاصق
        initStickyHeader: function() {
            var $header = $('.site-header');
            var headerHeight = $header.outerHeight();
            var scrollPos = 0;

            $(window).on('scroll', function() {
                var currentScroll = $(this).scrollTop();

                if (currentScroll > headerHeight) {
                    $header.addClass('sticky');
                    
                    // إخفاء/إظهار الهيدر حسب اتجاه التمرير
                    if (currentScroll > scrollPos && currentScroll > 300) {
                        $header.addClass('hidden');
                    } else {
                        $header.removeClass('hidden');
                    }
                } else {
                    $header.removeClass('sticky hidden');
                }

                scrollPos = currentScroll;
            });
        },

        // زر العودة للأعلى
        initScrollToTop: function() {
            var $button = $('<button/>', {
                'class': 'scroll-to-top',
                'html': '<i class="fas fa-chevron-up"></i>',
                'aria-label': 'العودة للأعلى'
            }).appendTo('body');

            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 300) {
                    $button.fadeIn(300);
                } else {
                    $button.fadeOut(300);
                }
            });

            $button.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 600);
            });
        },

        // التحميل الكسول للصور
        initLazyLoading: function() {
            if ('IntersectionObserver' in window) {
                var lazyImages = document.querySelectorAll('img[data-lazy]');
                
                var imageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            var image = entry.target;
                            image.src = image.dataset.lazy;
                            image.classList.add('loaded');
                            imageObserver.unobserve(image);
                        }
                    });
                });

                lazyImages.forEach(function(image) {
                    imageObserver.observe(image);
                });
            }
        },

        // تلميحات الأدوات
        initTooltips: function() {
            $('[data-tooltip]').each(function() {
                var $this = $(this);
                var text = $this.data('tooltip');
                
                $this.on('mouseenter', function() {
                    var $tooltip = $('<div class="tooltip">' + text + '</div>');
                    $('body').append($tooltip);
                    
                    var pos = $this.offset();
                    $tooltip.css({
                        top: pos.top - $tooltip.outerHeight() - 10,
                        left: pos.left + ($this.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
                    }).fadeIn(200);
                }).on('mouseleave', function() {
                    $('.tooltip').fadeOut(200, function() {
                        $(this).remove();
                    });
                });
            });
        },

        // النوافذ المنبثقة
        initModals: function() {
            var self = this;

            // فتح النافذة
            $('[data-modal]').on('click', function(e) {
                e.preventDefault();
                var modalId = $(this).data('modal');
                self.openModal(modalId);
            });

            // إغلاق النافذة
            $('.modal-close, .modal-overlay').on('click', function() {
                self.closeModal();
            });

            // إغلاق بزر ESC
            $(document).on('keyup', function(e) {
                if (e.keyCode === 27) {
                    self.closeModal();
                }
            });
        },

        // فتح نافذة منبثقة
        openModal: function(modalId) {
            var $modal = $('#' + modalId);
            if ($modal.length) {
                $('body').addClass('modal-open');
                $modal.fadeIn(300);
            }
        },

        // إغلاق النافذة المنبثقة
        closeModal: function() {
            $('.modal').fadeOut(300, function() {
                $('body').removeClass('modal-open');
            });
        },

        // معالجة النماذج
        initForms: function() {
            // تحسين النماذج
            $('.form-group input, .form-group textarea').on('focus', function() {
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                if (!$(this).val()) {
                    $(this).parent().removeClass('focused');
                }
            });

            // التحقق من النماذج
            $('form[data-validate]').on('submit', function(e) {
                var $form = $(this);
                var isValid = true;

                $form.find('[required]').each(function() {
                    var $field = $(this);
                    if (!$field.val().trim()) {
                        isValid = false;
                        $field.addClass('error');
                        $field.parent().append('<span class="error-message">هذا الحقل مطلوب</span>');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    return false;
                }
            });

            // إزالة رسائل الخطأ عند الكتابة
            $('input, textarea').on('input', function() {
                $(this).removeClass('error');
                $(this).siblings('.error-message').remove();
            });
        },

        // الحركات والتأثيرات
        initAnimations: function() {
            // تأثير الظهور عند التمرير
            var animatedElements = document.querySelectorAll('[data-animate]');
            
            if ('IntersectionObserver' in window && animatedElements.length) {
                var animationObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            var element = entry.target;
                            var animation = element.dataset.animate;
                            element.classList.add('animated', animation);
                            animationObserver.unobserve(element);
                        }
                    });
                }, {
                    threshold: 0.1
                });

                animatedElements.forEach(function(element) {
                    animationObserver.observe(element);
                });
            }

            // تأثير التموج عند النقر
            $('.btn, .ripple-effect').on('click', function(e) {
                var $this = $(this);
                var offset = $this.offset();
                var relativeX = e.clientX - offset.left;
                var relativeY = e.clientY - offset.top;

                var $ripple = $('<span class="ripple"></span>');
                $ripple.css({
                    left: relativeX,
                    top: relativeY
                });

                $this.append($ripple);
                setTimeout(function() {
                    $ripple.remove();
                }, 600);
            });
        },

        // نظام التقييم
        initRatingSystem: function() {
            var self = this;

            // التقييم بالنجوم
            $('.rating-stars').each(function() {
                var $container = $(this);
                var $stars = $container.find('.star');
                var $input = $container.find('input[type="hidden"]');

                $stars.on('click', function() {
                    var rating = $(this).data('rating');
                    $input.val(rating);
                    self.updateStars($container, rating);
                });

                $stars.on('mouseenter', function() {
                    var rating = $(this).data('rating');
                    self.previewStars($container, rating);
                });

                $container.on('mouseleave', function() {
                    var currentRating = $input.val() || 0;
                    self.updateStars($container, currentRating);
                });
            });

            // عرض التقييمات الموجودة
            $('.comment-rating').each(function() {
                var rating = $(this).data('rating');
                self.displayRating($(this), rating);
            });
        },

        // تحديث النجوم
        updateStars: function($container, rating) {
            $container.find('.star').each(function(index) {
                if (index < rating) {
                    $(this).addClass('active').removeClass('hover');
                } else {
                    $(this).removeClass('active hover');
                }
            });
        },

        // معاينة النجوم
        previewStars: function($container, rating) {
            $container.find('.star').each(function(index) {
                if (index < rating) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });
        },

        // عرض التقييم
        displayRating: function($element, rating) {
            var stars = '';
            for (var i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="fas fa-star"></i>';
                } else if (i - 0.5 <= rating) {
                    stars += '<i class="fas fa-star-half-alt"></i>';
                } else {
                    stars += '<i class="far fa-star"></i>';
                }
            }
            $element.html(stars);
        },

        // نظام الإشعارات
        initNotifications: function() {
            var self = this;

            // عرض الإشعارات المحفوظة
            this.checkStoredNotifications();

            // الاشتراك في الإشعارات الفورية
            if (window.muhtawaa_ajax && window.muhtawaa_ajax.notifications_enabled) {
                this.subscribeToNotifications();
            }
        },

        // فحص الإشعارات المحفوظة
        checkStoredNotifications: function() {
            if (window.muhtawaa_ajax) {
                $.post(window.muhtawaa_ajax.ajax_url, {
                    action: 'get_user_notifications',
                    nonce: window.muhtawaa_ajax.nonce
                }, function(response) {
                    if (response.success && response.data.notifications) {
                        response.data.notifications.forEach(function(notification) {
                            Muhtawaa.showNotification(notification);
                        });
                    }
                });
            }
        },

        // الاشتراك في الإشعارات الفورية
        subscribeToNotifications: function() {
            // يمكن استخدام WebSockets أو Server-Sent Events هنا
            // مثال بسيط باستخدام polling
            setInterval(function() {
                Muhtawaa.checkNewNotifications();
            }, 30000); // كل 30 ثانية
        },

        // فحص الإشعارات الجديدة
        checkNewNotifications: function() {
            if (window.muhtawaa_ajax) {
                $.post(window.muhtawaa_ajax.ajax_url, {
                    action: 'check_new_notifications',
                    nonce: window.muhtawaa_ajax.nonce,
                    last_check: this.lastNotificationCheck || 0
                }, function(response) {
                    if (response.success && response.data.notifications) {
                        response.data.notifications.forEach(function(notification) {
                            Muhtawaa.showNotification(notification);
                        });
                        Muhtawaa.lastNotificationCheck = Date.now();
                    }
                });
            }
        },

        // عرض إشعار
        showNotification: function(notification) {
            var $notification = $('<div/>', {
                'class': 'notification ' + (notification.type || 'info'),
                'html': '<div class="notification-content">' +
                        '<h4>' + notification.title + '</h4>' +
                        '<p>' + notification.message + '</p>' +
                        '</div>' +
                        '<button class="notification-close">&times;</button>'
            });

            $('.notifications-container').append($notification);
            
            setTimeout(function() {
                $notification.addClass('show');
            }, 100);

            // إغلاق تلقائي بعد 5 ثواني
            setTimeout(function() {
                Muhtawaa.hideNotification($notification);
            }, 5000);

            // إغلاق يدوي
            $notification.find('.notification-close').on('click', function() {
                Muhtawaa.hideNotification($notification);
            });
        },

        // إخفاء إشعار
        hideNotification: function($notification) {
            $notification.removeClass('show');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        },

        // التوصيات الذكية
        initSmartRecommendations: function() {
            if ($('.smart-recommendations').length && window.muhtawaa_ajax) {
                var postId = $('#post-id').val() || $('article').data('id');
                
                if (postId) {
                    $.post(window.muhtawaa_ajax.ajax_url, {
                        action: 'get_smart_recommendations',
                        post_id: postId,
                        count: 6,
                        nonce: window.muhtawaa_ajax.nonce
                    }, function(response) {
                        if (response.success && response.data) {
                            Muhtawaa.renderRecommendations(response.data);
                        }
                    });
                }
            }
        },

        // عرض التوصيات
        renderRecommendations: function(recommendations) {
            var html = '';
            recommendations.forEach(function(item) {
                html += '<div class="recommendation-item">' +
                        '<a href="' + item.url + '">' +
                        (item.thumbnail ? '<img src="' + item.thumbnail + '" alt="' + item.title + '">' : '') +
                        '<h4>' + item.title + '</h4>' +
                        '<p>' + item.excerpt + '</p>' +
                        '</a></div>';
            });
            
            $('.smart-recommendations-grid').html(html);
            $('.smart-recommendations').fadeIn();
        },

        // البحث المتقدم
        initSearch: function() {
            var $searchForm = $('.search-form');
            var $searchInput = $searchForm.find('.search-field');
            var $searchResults = $('.search-results-dropdown');
            var searchTimeout;

            // البحث الفوري
            $searchInput.on('input', function() {
                var query = $(this).val();
                
                clearTimeout(searchTimeout);
                
                if (query.length >= 3) {
                    searchTimeout = setTimeout(function() {
                        Muhtawaa.performSearch(query);
                    }, 300);
                } else {
                    $searchResults.hide();
                }
            });

            // إغلاق نتائج البحث عند النقر خارجها
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-form').length) {
                    $searchResults.hide();
                }
            });
        },

        // تنفيذ البحث
        performSearch: function(query) {
            var $searchResults = $('.search-results-dropdown');
            
            if (window.muhtawaa_ajax) {
                $.post(window.muhtawaa_ajax.ajax_url, {
                    action: 'advanced_search',
                    query: query,
                    nonce: window.muhtawaa_ajax.nonce
                }, function(response) {
                    if (response.success && response.data.results) {
                        Muhtawaa.displaySearchResults(response.data.results);
                    }
                });
            }
        },

        // عرض نتائج البحث
        displaySearchResults: function(results) {
            var $searchResults = $('.search-results-dropdown');
            var html = '';

            if (results.length > 0) {
                results.forEach(function(result) {
                    html += '<div class="search-result-item">' +
                            '<a href="' + result.url + '">' +
                            '<h5>' + result.title + '</h5>' +
                            '<p>' + result.excerpt + '</p>' +
                            '</a></div>';
                });
            } else {
                html = '<div class="no-results">لا توجد نتائج</div>';
            }

            $searchResults.html(html).show();
        },

        // التمرير السلس
        smoothScroll: function(e) {
            var target = $(e.currentTarget.hash);
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: target.offset().top - this.settings.scrollOffset
                }, 600);
            }
        },

        // عند تغيير حجم النافذة
        onResize: function() {
            // إعادة حساب العناصر المعتمدة على الحجم
            this.updateLayoutElements();
        },

        // عند التمرير
        onScroll: function() {
            // تحديث العناصر المعتمدة على التمرير
            this.updateScrollElements();
        },

        // تحديث عناصر التخطيط
        updateLayoutElements: function() {
            // يمكن إضافة أي تحديثات مطلوبة هنا
        },

        // تحديث عناصر التمرير
        updateScrollElements: function() {
            // يمكن إضافة أي تحديثات مطلوبة هنا
        }
    };

    // تهيئة القالب عند تحميل الصفحة
    $(document).ready(function() {
        Muhtawaa.init();
    });

    // تعريض الكائن للاستخدام العام
    window.Muhtawaa = Muhtawaa;

})(jQuery);

// دالة throttle للأداء
(function($) {
    $.throttle = function(delay, callback) {
        var timeout, last;
        return function() {
            var now = new Date().getTime();
            if (last && now < last + delay) {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    last = now;
                    callback.apply(this, arguments);
                }.bind(this), delay);
            } else {
                last = now;
                callback.apply(this, arguments);
            }
        };
    };
})(jQuery);