/**
 * Practical Solutions Pro - Main JavaScript Source (Fixed & Complete)
 * الملف الرئيسي لـ JavaScript - مصحح ومكتمل
 * المسار: /src/js/main.js
 * الإصدار: 2.2.3
 */

(function($) {
    'use strict';

    // إنتظار jQuery و DOM
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is required for Practical Solutions Pro');
        return;
    }

    // =============================================================================
    // المتغيرات العامة والإعدادات
    // =============================================================================
    const PS = {
        settings: window.psAjax || {},
        features: window.psFeatures || {},
        version: '2.2.3',
        debug: window.psAjax?.debug || false,
        
        // عناصر DOM
        elements: {
            body: null,
            searchForms: null,
            voiceButtons: null,
            ratingButtons: null,
            bookmarkButtons: null,
            themeToggle: null,
            scrollTopButton: null
        },
        
        // حالات التطبيق
        state: {
            isListening: false,
            currentTheme: localStorage.getItem('ps_theme') || 'light',
            bookmarks: []
        }
    };

    // =============================================================================
    // تهيئة التطبيق الرئيسية
    // =============================================================================
    $(document).ready(function() {
        PS.log('🚀 Practical Solutions Pro v' + PS.version + ' Starting...');
        
        // ربط عناصر DOM
        PS.bindElements();
        
        // تهيئة الميزات
        PS.initAllFeatures();
        
        PS.log('✅ All features initialized successfully');
    });

    // ربط عناصر DOM المهمة
    PS.bindElements = function() {
        PS.elements.body = $('body');
        PS.elements.searchForms = $('.ps-search-form, .ps-hero-search-form, .search-form');
        PS.elements.voiceButtons = $('.ps-voice-btn, .ps-hero-voice-btn');
        PS.elements.ratingButtons = $('.ps-rating-btn');
        PS.elements.bookmarkButtons = $('.ps-bookmark-btn');
        PS.elements.themeToggle = $('.ps-theme-toggle');
        PS.elements.scrollTopButton = $('.ps-scroll-top');
    };

    // تهيئة جميع الميزات
    PS.initAllFeatures = function() {
        // ميزات البحث
        PS.initSearch();
        PS.initVoiceSearch();
        
        // ميزات التفاعل
        PS.initRatingSystem();
        PS.initBookmarkSystem();
        
        // ميزات واجهة المستخدم
        PS.initDarkMode();
        PS.initScrollToTop();
        PS.initBackToHome();
        
        // تحسينات إضافية
        PS.initAccessibility();
        PS.initSmoothScroll();
    };

    // =============================================================================
    // نظام البحث والاقتراحات
    // =============================================================================
    PS.initSearch = function() {
        PS.log('🔍 Initializing search system');
        
        // البحث عن نماذج البحث
        const searchForms = document.querySelectorAll('.ps-search-form, .ps-hero-search-form, .search-form');
        
        searchForms.forEach(form => {
            const input = form.querySelector('input[type="search"], .ps-search-input');
            if (!input) return;
            
            // إنشاء حاوي الاقتراحات
            let suggestions = form.querySelector('.ps-search-suggestions');
            if (!suggestions) {
                suggestions = document.createElement('div');
                suggestions.className = 'ps-search-suggestions';
                suggestions.style.display = 'none';
                form.appendChild(suggestions);
            }
            
            // ربط أحداث البحث
            let searchTimeout;
            input.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();
                
                if (query.length >= 2) {
                    searchTimeout = setTimeout(() => {
                        PS.performSearch(query, suggestions);
                    }, 300);
                } else {
                    suggestions.style.display = 'none';
                }
            });
            
            // إخفاء الاقتراحات عند النقر خارجها
            document.addEventListener('click', function(e) {
                if (!form.contains(e.target)) {
                    suggestions.style.display = 'none';
                }
            });
        });
    };

    PS.performSearch = function(query, suggestionsContainer) {
        if (!PS.settings.ajaxurl) {
            PS.log('Ajax URL not configured');
            return;
        }
        
        $.ajax({
            url: PS.settings.ajaxurl,
            type: 'POST',
            data: {
                action: 'ps_search',
                query: query,
                nonce: PS.settings.nonce || ''
            },
            success: function(response) {
                if (response.success && response.data && response.data.length > 0) {
                    PS.displaySuggestions(response.data, suggestionsContainer);
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            },
            error: function() {
                PS.log('Search request failed');
            }
        });
    };

    PS.displaySuggestions = function(results, container) {
        container.innerHTML = '';
        
        results.forEach((item, index) => {
            const suggestionDiv = document.createElement('div');
            suggestionDiv.className = 'ps-suggestion-item';
            suggestionDiv.innerHTML = `
                <div class="ps-suggestion-content">
                    <h4 class="ps-suggestion-title">${item.title}</h4>
                    <p class="ps-suggestion-excerpt">${item.excerpt || ''}</p>
                </div>
            `;
            
            suggestionDiv.addEventListener('click', () => {
                window.location.href = item.url;
            });
            
            container.appendChild(suggestionDiv);
        });
        
        container.style.display = 'block';
    };

    // =============================================================================
    // البحث الصوتي
    // =============================================================================
    PS.initVoiceSearch = function() {
        if (!('webkitSpeechRecognition' in window || 'SpeechRecognition' in window)) {
            PS.log('⚠️ Voice search not supported');
            $('.ps-voice-btn, .ps-hero-voice-btn').hide();
            return;
        }

        PS.log('🎤 Initializing voice search');

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'ar-SA';

        $(document).on('click', '.ps-voice-btn, .ps-hero-voice-btn', function() {
            const $button = $(this);
            const $form = $button.closest('form, .ps-search-form, .ps-hero-search-form');
            const $input = $form.find('input[type="search"], .ps-search-input');
            
            if (PS.state.isListening) {
                recognition.stop();
                return;
            }
            
            PS.state.isListening = true;
            $button.addClass('recording').attr('aria-label', 'جاري التسجيل...');
            
            recognition.start();
            
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                $input.val(transcript).trigger('input');
                PS.log('🎤 Voice recognized: ' + transcript);
            };
            
            recognition.onend = function() {
                PS.state.isListening = false;
                $button.removeClass('recording').attr('aria-label', 'البحث الصوتي');
            };
            
            recognition.onerror = function(event) {
                PS.log('❌ Voice recognition error: ' + event.error);
                PS.state.isListening = false;
                $button.removeClass('recording').attr('aria-label', 'البحث الصوتي');
                PS.showNotification('حدث خطأ في التعرف على الصوت، حاول مرة أخرى', 'error');
            };
        });
    };

    // =============================================================================
    // نظام التقييم
    // =============================================================================
    PS.initRatingSystem = function() {
        PS.log('⭐ Initializing rating system');
        
        // إنشاء ويدجت التقييم إذا لم يكن موجوداً
        if ($('.ps-rating-widget').length === 0 && $('body').hasClass('single')) {
            PS.createRatingWidget();
        }
        
        // ربط أحداث النجوم
        $(document).on('click', '.ps-rating-btn', function() {
            const rating = parseInt($(this).data('rating'));
            const $widget = $(this).closest('.ps-rating-widget');
            const postId = $widget.data('post-id') || PS.getCurrentPostId();
            
            PS.saveRating(rating, postId);
        });
        
        // تأثيرات hover
        $(document).on('mouseenter', '.ps-rating-btn', function() {
            const rating = parseInt($(this).data('rating'));
            const $widget = $(this).closest('.ps-rating-widget');
            PS.highlightStars(rating, $widget);
        });
        
        $(document).on('mouseleave', '.ps-rating-widget', function() {
            PS.resetStarsHighlight($(this));
        });
    };

    PS.createRatingWidget = function() {
        const postId = PS.getCurrentPostId();
        const $widget = $(`
            <div class="ps-rating-widget" data-post-id="${postId}">
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
            </div>
        `);
        
        $('.entry-content, .post-content, main').first().append($widget);
    };

    PS.saveRating = function(rating, postId) {
        if (!PS.settings.ajaxurl) return;
        
        $.ajax({
            url: PS.settings.ajaxurl,
            type: 'POST',
            data: {
                action: 'ps_save_rating',
                post_id: postId,
                rating: rating,
                nonce: PS.settings.nonce || ''
            },
            success: function(response) {
                if (response.success) {
                    PS.updateRatingDisplay(response.data);
                    PS.showNotification('شكراً لك على التقييم!', 'success');
                } else {
                    PS.showNotification(response.data || 'حدث خطأ في حفظ التقييم', 'error');
                }
            },
            error: function() {
                PS.showNotification('حدث خطأ في الاتصال', 'error');
            }
        });
    };

    PS.highlightStars = function(rating, $widget) {
        $widget.find('.ps-rating-btn').each(function(index) {
            $(this).toggleClass('highlighted', index < rating);
        });
    };

    PS.resetStarsHighlight = function($widget) {
        $widget.find('.ps-rating-btn').removeClass('highlighted');
    };

    PS.updateRatingDisplay = function(data) {
        $('.ps-rating-average').text(data.average || '0.0');
        $('.ps-rating-count').text(`(${data.count || 0} تقييمات)`);
    };

    // =============================================================================
    // نظام المحفوظات
    // =============================================================================
    PS.initBookmarkSystem = function() {
        PS.log('🔖 Initializing bookmark system');
        
        // تحميل المحفوظات
        PS.loadBookmarks();
        
        // إنشاء أزرار الحفظ
        if ($('.ps-bookmark-btn').length === 0 && $('body').hasClass('single')) {
            PS.createBookmarkButton();
        }
        
        // ربط الأحداث
        $(document).on('click', '.ps-bookmark-btn', function() {
            const postId = $(this).data('post-id') || PS.getCurrentPostId();
            const postTitle = $(this).data('post-title') || document.title;
            const postUrl = $(this).data('post-url') || window.location.href;
            
            PS.toggleBookmark(postId, postTitle, postUrl, $(this));
        });
        
        // رابط المحفوظات
        PS.createBookmarksLink();
    };

    PS.createBookmarkButton = function() {
        const postId = PS.getCurrentPostId();
        const isBookmarked = PS.isBookmarked(postId);
        
        const $button = $(`
            <button class="ps-bookmark-btn ${isBookmarked ? 'bookmarked' : ''}" 
                    data-post-id="${postId}" 
                    data-post-title="${document.title}"
                    data-post-url="${window.location.href}">
                <span class="bookmark-icon">${isBookmarked ? '🔖' : '📌'}</span>
                <span class="bookmark-text">${isBookmarked ? 'محفوظ' : 'حفظ'}</span>
            </button>
        `);
        
        $('.entry-header, .post-header, .wp-block-post-title').first().after($button);
    };

    PS.toggleBookmark = function(postId, postTitle, postUrl, $button) {
        if (PS.isBookmarked(postId)) {
            PS.removeBookmark(postId);
            $button.removeClass('bookmarked')
                  .find('.bookmark-icon').text('📌')
                  .siblings('.bookmark-text').text('حفظ');
            PS.showNotification('تم إزالة المقال من المحفوظات', 'info');
        } else {
            PS.addBookmark(postId, postTitle, postUrl);
            $button.addClass('bookmarked')
                  .find('.bookmark-icon').text('🔖')
                  .siblings('.bookmark-text').text('محفوظ');
            PS.showNotification('تم حفظ المقال', 'success');
        }
    };

    PS.addBookmark = function(postId, postTitle, postUrl) {
        const bookmark = {
            id: postId,
            title: postTitle,
            url: postUrl,
            date: new Date().toISOString()
        };
        
        PS.state.bookmarks.push(bookmark);
        PS.saveBookmarks();
    };

    PS.removeBookmark = function(postId) {
        PS.state.bookmarks = PS.state.bookmarks.filter(b => b.id != postId);
        PS.saveBookmarks();
    };

    PS.isBookmarked = function(postId) {
        return PS.state.bookmarks.some(b => b.id == postId);
    };

    PS.loadBookmarks = function() {
        try {
            const saved = localStorage.getItem('ps_bookmarks');
            PS.state.bookmarks = saved ? JSON.parse(saved) : [];
        } catch (e) {
            PS.state.bookmarks = [];
        }
    };

    PS.saveBookmarks = function() {
        try {
            localStorage.setItem('ps_bookmarks', JSON.stringify(PS.state.bookmarks));
        } catch (e) {
            PS.log('Error saving bookmarks');
        }
    };

    PS.createBookmarksLink = function() {
        if ($('.ps-bookmarks-link').length > 0) return;
        
        const $link = $('<a href="#" class="ps-bookmarks-link">📚 المحفوظات</a>');
        $link.on('click', function(e) {
            e.preventDefault();
            PS.showBookmarksModal();
        });
        
        const $menu = $('.menu, .navigation, header nav').first();
        if ($menu.length) {
            $menu.append($('<li></li>').append($link));
        }
    };

    PS.showBookmarksModal = function() {
        $('.ps-bookmarks-modal').remove();
        
        const $modal = $(`
            <div class="ps-bookmarks-modal">
                <div class="ps-modal-content">
                    <div class="ps-modal-header">
                        <h2>المقالات المحفوظة</h2>
                        <button class="ps-modal-close">&times;</button>
                    </div>
                    <div class="ps-bookmarks-list">
                        ${PS.renderBookmarksList()}
                    </div>
                </div>
            </div>
        `);
        
        $('body').append($modal);
        
        $modal.on('click', '.ps-modal-close, .ps-bookmarks-modal', function(e) {
            if (e.target === this) {
                $modal.remove();
            }
        });
        
        $modal.show();
    };

    PS.renderBookmarksList = function() {
        if (PS.state.bookmarks.length === 0) {
            return '<p class="ps-no-bookmarks">لا توجد مقالات محفوظة</p>';
        }
        
        return PS.state.bookmarks.map(bookmark => `
            <div class="ps-bookmark-item">
                <h3><a href="${bookmark.url}">${bookmark.title}</a></h3>
                <small>محفوظ في: ${new Date(bookmark.date).toLocaleDateString('ar')}</small>
                <button class="ps-remove-bookmark" data-id="${bookmark.id}">إزالة</button>
            </div>
        `).join('');
    };

    // =============================================================================
    // الوضع المظلم
    // =============================================================================
    PS.initDarkMode = function() {
        PS.log('🌙 Initializing dark mode');
        
        // إنشاء زر التبديل
        if ($('.ps-theme-toggle').length === 0) {
            PS.createThemeToggle();
        }
        
        // تطبيق الثيم المحفوظ
        PS.applyTheme(PS.state.currentTheme);
        
        // ربط الأحداث
        $(document).on('click', '.ps-theme-toggle', function() {
            PS.toggleTheme();
        });
    };

    PS.createThemeToggle = function() {
        const $toggle = $(`
            <button class="ps-theme-toggle" aria-label="تبديل الوضع المظلم">
                <span class="theme-icon">${PS.state.currentTheme === 'dark' ? '☀️' : '🌙'}</span>
                <span class="theme-text">${PS.state.currentTheme === 'dark' ? 'فاتح' : 'مظلم'}</span>
            </button>
        `);
        
        $('header, .site-header').first().prepend($toggle);
    };

    PS.toggleTheme = function() {
        PS.state.currentTheme = PS.state.currentTheme === 'light' ? 'dark' : 'light';
        PS.applyTheme(PS.state.currentTheme);
        PS.saveThemePreference();
        
        // تحديث الزر
        $('.ps-theme-toggle .theme-icon').text(PS.state.currentTheme === 'dark' ? '☀️' : '🌙');
        $('.ps-theme-toggle .theme-text').text(PS.state.currentTheme === 'dark' ? 'فاتح' : 'مظلم');
        
        PS.showNotification(`تم التبديل إلى الوضع ${PS.state.currentTheme === 'dark' ? 'المظلم' : 'الفاتح'}`, 'info');
    };

    PS.applyTheme = function(theme) {
        PS.elements.body.removeClass('light-theme dark-theme').addClass(theme + '-theme');
        $('html').attr('data-theme', theme);
    };

    PS.saveThemePreference = function() {
        try {
            localStorage.setItem('ps_theme', PS.state.currentTheme);
        } catch (e) {
            PS.log('Error saving theme preference');
        }
    };

    // =============================================================================
    // زر العودة للأعلى
    // =============================================================================
    PS.initScrollToTop = function() {
        PS.log('⬆️ Initializing scroll to top');
        
        if ($('.ps-scroll-top').length === 0) {
            PS.createScrollTopButton();
        }
        
        $(window).on('scroll', PS.throttle(PS.handleScroll, 100));
        $(document).on('click', '.ps-scroll-top', function() {
            $('html, body').animate({ scrollTop: 0 }, 500);
        });
    };

    PS.createScrollTopButton = function() {
        const $button = $(`
            <button class="ps-scroll-top" aria-label="العودة للأعلى" style="display: none;">
                <span class="scroll-icon">⬆️</span>
            </button>
        `);
        
        $('body').append($button);
    };

    PS.handleScroll = function() {
        const scrollTop = $(window).scrollTop();
        const $button = $('.ps-scroll-top');
        
        if (scrollTop > 300) {
            $button.fadeIn();
        } else {
            $button.fadeOut();
        }
    };

    // =============================================================================
    // زر العودة للرئيسية
    // =============================================================================
    PS.initBackToHome = function() {
        if (!$('body').hasClass('single') && !$('body').hasClass('page')) return;
        
        PS.log('🏠 Adding back to home button');
        
        if ($('.ps-back-home').length === 0) {
            const $backButton = $(`
                <a href="${PS.settings.home_url || '/'}" class="ps-back-home">
                    <span class="back-icon">🏠</span>
                    <span class="back-text">العودة للرئيسية</span>
                </a>
            `);
            
            $('.entry-header, .post-header, .page-header').first().prepend($backButton);
        }
    };

    // =============================================================================
    // تحسينات إمكانية الوصول
    // =============================================================================
    PS.initAccessibility = function() {
        PS.log('♿ Improving accessibility');
        
        // skip links
        if ($('.skip-link').length === 0) {
            const $skipLink = $('<a href="#main" class="skip-link">تخطي إلى المحتوى الرئيسي</a>');
            $('body').prepend($skipLink);
        }
        
        // تحسين التنقل بالكيبورد
        $('[tabindex], button, a, input, select, textarea').on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) {
                if (this.tagName.toLowerCase() === 'button' || $(this).attr('role') === 'button') {
                    e.preventDefault();
                    $(this).click();
                }
            }
        });
    };

    // =============================================================================
    // التمرير السلس
    // =============================================================================
    PS.initSmoothScroll = function() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 500);
            }
        });
    };

    // =============================================================================
    // الدوال المساعدة
    // =============================================================================
    PS.getCurrentPostId = function() {
        return $('article[id]').attr('id')?.replace('post-', '') || 
               $('[data-post-id]').data('post-id') ||
               $('body').attr('class').match(/postid-(\d+)/)?.[1] ||
               1;
    };

    PS.showNotification = function(message, type = 'info') {
        $('.ps-notification').remove();
        
        const $notification = $(`
            <div class="ps-notification ps-notification-${type}">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `);
        
        $('body').append($notification);
        
        setTimeout(() => $notification.addClass('show'), 10);
        
        setTimeout(() => {
            $notification.removeClass('show');
            setTimeout(() => $notification.remove(), 300);
        }, 3000);
        
        $notification.find('.notification-close').on('click', function() {
            $notification.removeClass('show');
            setTimeout(() => $notification.remove(), 300);
        });
    };

    PS.throttle = function(func, limit) {
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
    };

    PS.log = function(message) {
        if (PS.debug) {
            console.log('[PS Theme] ' + message);
        }
    };

    // تصدير للاستخدام الخارجي
    window.PracticalSolutions = PS;

})(jQuery);