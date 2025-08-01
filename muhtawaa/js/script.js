/**
 * الملف الرئيسي للـ JavaScript - قالب محتوى
 * 
 * @package Muhtawaa
 */

jQuery(document).ready(function($) {
    'use strict';
    
    // متغيرات عامة
    let currentPage = 1;
    let isLoading = false;
    let searchTimeout;
    let readingStartTime = Date.now();
    let maxScrollDepth = 0;
    
    // تهيئة التطبيق
    initializeApp();
    
    function initializeApp() {
        setupEventListeners();
        initializeComponents();
        setupPerformanceOptimizations();
        setupAccessibilityFeatures();
        trackUserBehavior();
    }
    
    // إعداد مستمعي الأحداث
    function setupEventListeners() {
        // البحث المباشر
        setupLiveSearch();
        
        // النشرة البريدية
        setupNewsletterSubscription();
        
        // الحل السريع
        setupQuickTips();
        
        // تحميل المزيد من المحتوى
        setupInfiniteScroll();
        
        // مشاركة المحتوى
        setupSocialSharing();
        
        // التفاعل مع الحلول
        setupSolutionInteractions();
        
        // التنقل السلس
        setupSmoothScrolling();
    }
    
    // البحث المباشر
    function setupLiveSearch() {
        const $searchInput = $('.search-bar input[type="search"], .search-field');
        
        $searchInput.on('keyup', function() {
            const searchTerm = $(this).val().trim();
            
            clearTimeout(searchTimeout);
            
            if (searchTerm.length > 2) {
                searchTimeout = setTimeout(() => {
                    performLiveSearch(searchTerm);
                }, 300);
            } else {
                hideSearchResults();
            }
        });
        
        $searchInput.on('focus', function() {
            const searchTerm = $(this).val().trim();
            if (searchTerm.length > 2) {
                performLiveSearch(searchTerm);
            } else {
                showSearchSuggestions();
            }
        });
        
        // إخفاء النتائج عند النقر خارج البحث
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-bar, .search-form').length) {
                hideSearchResults();
            }
        });
    }
    
    function performLiveSearch(searchTerm) {
        if (!muhtawaa_ajax || !muhtawaa_ajax.ajax_url) return;
        
        const $searchContainer = $('.search-bar, .search-form').first();
        $searchContainer.addClass('loading');
        
        $.ajax({
            url: muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'live_search',
                search_term: searchTerm,
                nonce: muhtawaa_ajax.nonce
            },
            success: function(response) {
                $searchContainer.removeClass('loading');
                
                if (response.success && response.data.length > 0) {
                    showSearchResults(response.data, searchTerm);
                } else {
                    showNoSearchResults(searchTerm);
                }
            },
            error: function() {
                $searchContainer.removeClass('loading');
                showNotification('حدث خطأ في البحث', 'error');
            }
        });
    }
    
    function showSearchResults(results, searchTerm) {
        let html = '<div id="search-results" class="search-dropdown" role="listbox">';
        
        results.forEach((result, index) => {
            const highlightedTitle = highlightSearchTerm(result.title, searchTerm);
            
            html += `
                <div class="search-result-item" role="option" data-index="${index}">
                    <a href="${result.url}">
                        <span class="result-title">${highlightedTitle}</span>
                        <span class="result-category">${result.category}</span>
                        ${result.excerpt ? `<div class="result-excerpt">${highlightSearchTerm(result.excerpt, searchTerm)}</div>` : ''}
                    </a>
                </div>
            `;
        });
        
        html += '</div>';
        
        const $searchContainer = $('.search-bar, .search-form').first();
        $searchContainer.find('#search-results').remove();
        $searchContainer.append(html);
        
        // تتبع البحث
        trackSearch(searchTerm, results.length);
    }
    
    function showNoSearchResults(searchTerm) {
        const html = `
            <div id="search-results" class="search-dropdown">
                <div class="no-search-results" style="padding: 2rem; text-align: center; color: #6c757d;">
                    <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #dee2e6;"></i>
                    <h4>لم نجد نتائج لـ "${searchTerm}"</h4>
                    <p>جرب كلمات مفتاحية أخرى أو تصفح فئات الحلول</p>
                </div>
            </div>
        `;
        
        const $searchContainer = $('.search-bar, .search-form').first();
        $searchContainer.find('#search-results').remove();
        $searchContainer.append(html);
    }
    
    function showSearchSuggestions() {
        if (!muhtawaa_ajax || !muhtawaa_ajax.ajax_url) return;
        
        $.ajax({
            url: muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'get_search_suggestions',
                nonce: muhtawaa_ajax.nonce
            },
            success: function(response) {
                if (response.success && response.data.length > 0) {
                    let html = '<div id="search-results" class="search-suggestions">';
                    html += '<h4 style="padding: 1rem; margin: 0; color: #667eea; border-bottom: 1px solid #f0f0f0;">البحث الشائع:</h4>';
                    
                    response.data.forEach(suggestion => {
                        html += `<div class="suggestion-item" style="padding: 0.75rem 1rem; cursor: pointer; transition: background 0.2s;" onclick="searchFor('${suggestion}')">${suggestion}</div>`;
                    });
                    
                    html += '</div>';
                    
                    const $searchContainer = $('.search-bar, .search-form').first();
                    $searchContainer.find('#search-results').remove();
                    $searchContainer.append(html);
                }
            }
        });
    }
    
    function hideSearchResults() {
        $('#search-results').remove();
    }
    
    function highlightSearchTerm(text, term) {
        if (!term || !text) return text;
        
        const regex = new RegExp(`(${term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(regex, '<mark style="background: #fff3cd; padding: 0.1em 0.2em; border-radius: 0.2em;">$1</mark>');
    }
    
    // النشرة البريدية
    function setupNewsletterSubscription() {
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $emailInput = $form.find('input[type="email"]');
            const $submitBtn = $form.find('button[type="submit"]');
            const email = $emailInput.val().trim();
            
            if (!isValidEmail(email)) {
                showNotification('يرجى إدخال بريد إلكتروني صحيح', 'error');
                $emailInput.focus();
                return;
            }
            
            const originalText = $submitBtn.text();
            $submitBtn.html('<div class="loading-spinner"></div> جاري الاشتراك...').prop('disabled', true);
            
            const formData = new FormData(this);
            formData.append('action', 'newsletter_subscribe');
            
            $.ajax({
                url: muhtawaa_ajax.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        showNotification('تم الاشتراك بنجاح! 🎉 تحقق من بريدك الإلكتروني', 'success');
                        $submitBtn.html('تم الاشتراك ✓').css('background', '#4caf50');
                        $emailInput.val('');
                        
                        // إخفاء النموذج بعد النجاح
                        setTimeout(() => {
                            $form.fadeOut('slow');
                        }, 3000);
                    } else {
                        showNotification(response.data || 'حدث خطأ، يرجى المحاولة مرة أخرى', 'error');
                        $submitBtn.text(originalText).prop('disabled', false);
                    }
                },
                error: function() {
                    showNotification('حدث خطأ في الاتصال، يرجى المحاولة مرة أخرى', 'error');
                    $submitBtn.text(originalText).prop('disabled', false);
                }
            });
        });
    }
    
    // الحل السريع
    function setupQuickTips() {
        $('.quick-tips').on('click keydown', function(e) {
            if (e.type === 'keydown' && e.key !== 'Enter' && e.key !== ' ') {
                return;
            }
            
            e.preventDefault();
            loadRandomTip();
        });
    }
    
    function loadRandomTip() {
        if (!muhtawaa_ajax || !muhtawaa_ajax.ajax_url) {
            showBasicTip();
            return;
        }
        
        $.ajax({
            url: muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'get_random_tip',
                nonce: muhtawaa_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    showTipModal(response.data);
                } else {
                    showBasicTip();
                }
            },
            error: function() {
                showBasicTip();
            }
        });
    }
    
    function showTipModal(tip) {
        const modal = $(`
            <div class="tip-modal-overlay">
                <div class="tip-modal">
                    <div class="tip-header">
                        <h3>💡 حل سريع</h3>
                        <button class="tip-close" aria-label="إغلاق">&times;</button>
                    </div>
                    <div class="tip-content">
                        <h4>${tip.title}</h4>
                        <p>${tip.content}</p>
                        <div class="tip-actions">
                            <button class="tip-action-btn helpful" data-post-id="${tip.id}">👍 مفيد</button>
                            <button class="tip-action-btn share" data-title="${tip.title}" data-url="${tip.url}">📱 مشاركة</button>
                            <a href="${tip.url}" class="tip-action-btn read-more">📖 اقرأ المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        `);
        
        $('body').append(modal);
        
        // إظهار المودال
        setTimeout(() => {
            modal.addClass('show');
        }, 100);
        
        // إغلاق المودال
        modal.find('.tip-close').on('click', () => hideTipModal(modal));
        modal.on('click', function(e) {
            if (e.target === this) {
                hideTipModal(modal);
            }
        });
        
        // تقييم الحل
        modal.find('.helpful').on('click', function() {
            const postId = $(this).data('post-id');
            rateSolution(postId, 'helpful');
            $(this).html('👍 شكراً!').prop('disabled', true);
        });
        
        // مشاركة الحل
        modal.find('.share').on('click', function() {
            const title = $(this).data('title');
            const url = $(this).data('url');
            shareContent(title, url);
        });
        
        // دعم لوحة المفاتيح
        modal.on('keydown', function(e) {
            if (e.key === 'Escape') {
                hideTipModal(modal);
            }
        });
    }
    
    function showBasicTip() {
        const tips = [
            "💡 ضع قطعة خبز في علبة السكر لمنع تكتله",
            "🧽 استخدم معجون الأسنان لإزالة خدوش الهاتف البسيطة",
            "🍋 الليمون يزيل رائحة الثوم من اليدين بفعالية",
            "🧊 مكعبات الثلج تساعد في إزالة العلكة من الملابس",
            "📱 وضع الطيران يشحن الهاتف بشكل أسرع"
        ];
        
        const randomTip = tips[Math.floor(Math.random() * tips.length)];
        showNotification(randomTip, 'info');
    }
    
    function hideTipModal(modal) {
        modal.removeClass('show');
        setTimeout(() => {
            modal.remove();
        }, 300);
    }
    
    // تحميل المزيد من المحتوى
    function setupInfiniteScroll() {
        const $loadMoreBtn = $('#load-more-solutions');
        
        if ($loadMoreBtn.length) {
            $loadMoreBtn.on('click', function() {
                loadMoreSolutions();
            });
        }
        
        // التمرير اللانهائي
        $(window).on('scroll', throttle(function() {
            if (isNearBottom() && !isLoading && $('.solutions-grid').length > 0) {
                loadMoreSolutions();
            }
        }, 250));
    }
    
    function loadMoreSolutions() {
        if (isLoading) return;
        
        isLoading = true;
        currentPage++;
        
        const $loadMoreBtn = $('#load-more-solutions');
        const originalText = $loadMoreBtn.text();
        
        $loadMoreBtn.html('<div class="loading-spinner"></div> جاري التحميل...').prop('disabled', true);
        
        $.ajax({
            url: muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_solutions',
                page: currentPage,
                nonce: muhtawaa_ajax.nonce
            },
            success: function(response) {
                isLoading = false;
                
                if (response.success && response.data.html) {
                    $('.solutions-grid').append(response.data.html);
                    
                    // تحريك العناصر الجديدة
                    $('.solutions-grid').children().slice(-response.data.count).hide().fadeIn('slow');
                    
                    if (!response.data.has_more) {
                        $loadMoreBtn.hide();
                        $('.solutions-grid').after('<p class="no-more-solutions">لا توجد حلول أخرى 😊</p>');
                    } else {
                        $loadMoreBtn.text(originalText).prop('disabled', false);
                    }
                } else {
                    currentPage--; // إرجاع رقم الصفحة في حالة الفشل
                    $loadMoreBtn.text(originalText).prop('disabled', false);
                    showNotification('لا توجد حلول أخرى', 'info');
                }
            },
            error: function() {
                isLoading = false;
                currentPage--;
                $loadMoreBtn.text(originalText).prop('disabled', false);
                showNotification('حدث خطأ في تحميل المزيد', 'error');
            }
        });
    }
    
    function isNearBottom() {
        return $(window).scrollTop() + $(window).height() >= $(document).height() - 1000;
    }
    
    // مشاركة المحتوى
    function setupSocialSharing() {
        // مشاركة عبر Web Share API إذا كان متاحاً
        if (navigator.share) {
            $('.share-btn.copy').text('مشاركة').prepend('<i class="fas fa-share-alt"></i> ');
        }
        
        $(document).on('click', '.share-btn', function(e) {
            const platform = this.className.includes('twitter') ? 'twitter' :
                           this.className.includes('facebook') ? 'facebook' :
                           this.className.includes('whatsapp') ? 'whatsapp' : 'copy';
            
            if (platform === 'copy') {
                e.preventDefault();
                shareContent();
            }
            
            // تتبع المشاركة
            trackShare(platform, window.location.href);
        });
    }
    
    function shareContent(title = document.title, url = window.location.href) {
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            }).catch(err => {
                console.log('Share cancelled:', err);
                copyToClipboard(url);
            });
        } else {
            copyToClipboard(url);
        }
    }
    
    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification('تم نسخ الرابط! 📋', 'success');
            }).catch(() => {
                fallbackCopyToClipboard(text);
            });
        } else {
            fallbackCopyToClipboard(text);
        }
    }
    
    function fallbackCopyToClipboard(text) {
        const textArea = $('<textarea>')
            .val(text)
            .css({
                position: 'fixed',
                left: '-999999px',
                top: '-999999px'
            })
            .appendTo('body');
        
        textArea[0].focus();
        textArea[0].select();
        
        try {
            document.execCommand('copy');
            showNotification('تم نسخ الرابط! 📋', 'success');
        } catch (err) {
            showNotification('فشل في نسخ الرابط', 'error');
        }
        
        textArea.remove();
    }
    
    // التفاعل مع الحلول
    function setupSolutionInteractions() {
        // تقييم الحلول
        window.rateSolution = function(postId, rating) {
            if (!muhtawaa_ajax) return;
            
            $.ajax({
                url: muhtawaa_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'rate_solution',
                    post_id: postId,
                    rating: rating,
                    nonce: muhtawaa_ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        showNotification('شكراً لك على التقييم! 🙏', 'success');
                    } else {
                        showNotification('حدث خطأ في التقييم', 'error');
                    }
                },
                error: function() {
                    showNotification('حدث خطأ في الاتصال', 'error');
                }
            });
        };
        
        // حفظ المفضلات
        window.toggleFavorite = function(postId) {
            let favorites = JSON.parse(localStorage.getItem('muhtawaa_favorites') || '[]');
            const index = favorites.indexOf(postId);
            
            if (index > -1) {
                favorites.splice(index, 1);
                showNotification('تم إزالة الحل من المفضلة', 'info');
            } else {
                favorites.push(postId);
                showNotification('تم إضافة الحل للمفضلة ⭐', 'success');
            }
            
            localStorage.setItem('muhtawaa_favorites', JSON.stringify(favorites));
            updateFavoriteButton(postId, favorites.includes(postId));
        };
        
        // تحديث أزرار المفضلة عند التحميل
        const savedFavorites = JSON.parse(localStorage.getItem('muhtawaa_favorites') || '[]');
        savedFavorites.forEach(postId => {
            updateFavoriteButton(postId, true);
        });
    }
    
    function updateFavoriteButton(postId, isFavorite) {
        const $button = $(`.favorite-btn[data-post-id="${postId}"]`);
        if ($button.length) {
            if (isFavorite) {
                $button.addClass('favorited')
                    .css('background', '#dc3545')
                    .css('color', 'white')
                    .find('span').text('محفوظ في المفضلة');
            } else {
                $button.removeClass('favorited')
                    .css('background', '#f8f9fa')
                    .css('color', '#6c757d')
                    .find('span').text('حفظ في المفضلة');
            }
        }
    }
    
    // التنقل السلس
    function setupSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'easeInOutCubic');
            }
        });
    }
    
    // تهيئة المكونات
    function initializeComponents() {
        // أزرار التحميل
        setupLoadingStates();
        
        // تأثيرات الهوفر
        setupHoverEffects();
        
        // lazy loading للصور
        setupLazyLoading();
        
        // زر العودة للأعلى
        setupBackToTop();
    }
    
    function setupLoadingStates() {
        $('form').on('submit', function() {
            const $submitBtn = $(this).find('button[type="submit"]:not([disabled])');
            if ($submitBtn.length) {
                $submitBtn.prop('disabled', true).addClass('loading');
                
                // إعادة تمكين الزر بعد 10 ثوان كحد أقصى
                setTimeout(() => {
                    $submitBtn.prop('disabled', false).removeClass('loading');
                }, 10000);
            }
        });
    }
    
    function setupHoverEffects() {
        $('.solution-card, .category-card').hover(
            function() {
                $(this).addClass('hover');
            },
            function() {
                $(this).removeClass('hover');
            }
        );
    }
    
    function setupLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            img.classList.add('loaded');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }
    
    function setupBackToTop() {
        const $backToTop = $('<button>')
            .attr({
                'id': 'back-to-top',
                'class': 'back-to-top',
                'aria-label': 'العودة للأعلى'
            })
            .html('<i class="fas fa-arrow-up"></i>')
            .hide()
            .appendTo('body');
        
        $(window).on('scroll', throttle(function() {
            if ($(window).scrollTop() > 300) {
                $backToTop.addClass('show').fadeIn();
            } else {
                $backToTop.removeClass('show').fadeOut();
            }
        }, 100));
        
        $backToTop.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        });
    }
    
    // تحسينات الأداء
    function setupPerformanceOptimizations() {
        // تأجيل تحميل المحتوى غير الأساسي
        setTimeout(() => {
            loadDeferredContent();
        }, 2000);
        
        // تنظيف الذاكرة
        $(window).on('beforeunload', () => {
            cleanupResources();
        });
    }
    
    function loadDeferredContent() {
        // تحميل المحتوى المؤجل مثل التعليقات أو الودجات
        $('.deferred-content').each(function() {
            const $this = $(this);
            const src = $this.data('src');
            if (src) {
                $this.load(src);
            }
        });
    }
    
    function cleanupResources() {
        // تنظيف المؤقتات والمراقبات
        clearTimeout(searchTimeout);
    }
    
    // ميزات الوصولية
    function setupAccessibilityFeatures() {
        // دعم لوحة المفاتيح للعناصر التفاعلية
        $('.tip-modal, .notification').attr('tabindex', '-1');
        
        // إعلانات حالة ARIA
        $('<div>')
            .attr({
                'id': 'aria-live-region',
                'aria-live': 'polite',
                'aria-atomic': 'true'
            })
            .css({
                position: 'absolute',
                left: '-10000px',
                width: '1px',
                height: '1px'
            })
            .appendTo('body');
    }
    
    // تتبع سلوك المستخدم
    function trackUserBehavior() {
        // تتبع عمق التمرير
        $(window).on('scroll', throttle(function() {
            const scrollTop = $(window).scrollTop();
            const docHeight = $(document).height();
            const winHeight = $(window).height();
            const scrollPercent = Math.round((scrollTop / (docHeight - winHeight)) * 100);
            
            if (scrollPercent > maxScrollDepth) {
                maxScrollDepth = scrollPercent;
            }
        }, 500));
        
        // إرسال إحصائيات عند مغادرة الصفحة
        $(window).on('beforeunload', function() {
            if (muhtawaa_ajax && muhtawaa_ajax.post_id) {
                const readingTime = Math.round((Date.now() - readingStartTime) / 1000);
                
                if (readingTime > 10 && maxScrollDepth > 25) {
                    navigator.sendBeacon(muhtawaa_ajax.ajax_url, new URLSearchParams({
                        action: 'track_reading',
                        post_id: muhtawaa_ajax.post_id,
                        reading_time: readingTime,
                        scroll_depth: maxScrollDepth,
                        nonce: muhtawaa_ajax.nonce
                    }));
                }
            }
        });
    }
    
    // نظام الإشعارات
    function showNotification(message, type = 'info') {
        // إزالة الإشعارات السابقة
        $('.notification').remove();
        
        const $notification = $(`
            <div class="notification notification-${type}">
                <span class="notification-message">${message}</span>
                <button class="notification-close" aria-label="إغلاق الإشعار">&times;</button>
            </div>
        `);
        
        $('body').append($notification);
        
        // إظهار الإشعار
        setTimeout(() => {
            $notification.addClass('show');
        }, 100);
        
        // إخفاء تلقائي بعد 5 ثوان
        setTimeout(() => {
            hideNotification($notification);
        }, 5000);
        
        // إغلاق عند الضغط على X
        $notification.find('.notification-close').on('click', function() {
            hideNotification($notification);
        });
        
        // إعلان للقارئات الشاشة
        $('#aria-live-region').text(message);
    }
    
    function hideNotification($notification) {
        $notification.removeClass('show');
        setTimeout(() => {
            $notification.remove();
        }, 300);
    }
    
    // دوال مساعدة
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function throttle(func, limit) {
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
    }
    
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
    
    // تتبع الأحداث للإحصائيات
    function trackSearch(query, resultsCount) {
        if (!muhtawaa_ajax) return;
        
        $.ajax({
            url: muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'track_search',
                search_term: query,
                results_count: resultsCount,
                nonce: muhtawaa_ajax.nonce
            }
        });
    }
    
    function trackShare(platform, url) {
        if (!muhtawaa_ajax) return;
        
        $.ajax({
            url: muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'track_share',
                platform: platform,
                url: url,
                nonce: muhtawaa_ajax.nonce
            }
        });
    }
    
    // دوال عامة يمكن الوصول إليها من الخارج
    window.searchFor = function(term) {
        $('.search-field, .search-bar input[type="search"]').val(term).trigger('keyup');
    };
    
    window.showLoadingOverlay = function(message = 'جاري التحميل...') {
        const $overlay = $('#loading-overlay');
        if ($overlay.length) {
            $overlay.css('display', 'flex').find('p').text(message);
        }
    };
    
    window.hideLoadingOverlay = function() {
        $('#loading-overlay').hide();
    };
    
    // تحسينات إضافية
    
    // تحسين أداء التمرير
    let ticking = false;
    
    function updateScrollElements() {
        // تحديث عناصر التمرير مثل progress bar أو fixed elements
        const scrolled = $(window).scrollTop();
        const rate = scrolled * -0.5;
        
        // تأثير Parallax بسيط للعناصر المناسبة
        $('.parallax-element').css('transform', `translate3d(0, ${rate}px, 0)`);
        
        ticking = false;
    }
    
    $(window).on('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateScrollElements);
            ticking = true;
        }
    });
    
    // تحسين الصور
    function optimizeImages() {
        $('img').on('load', function() {
            $(this).addClass('loaded');
        }).on('error', function() {
            $(this).attr('src', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPtit2YjYudipINi52K/ZhSDYp9mE2KrZgdmK2YQ8L3RleHQ+PC9zdmc+');
        });
    }
    
    optimizeImages();
    
    // تحسين النماذج
    function enhanceForms() {
        // إضافة validation بصري
        $('input[required], textarea[required]').on('blur', function() {
            const $this = $(this);
            const value = $this.val().trim();
            
            if (value === '') {
                $this.addClass('error').attr('aria-invalid', 'true');
            } else {
                $this.removeClass('error').attr('aria-invalid', 'false');
            }
        });
        
        // تحسين حقول البريد الإلكتروني
        $('input[type="email"]').on('blur', function() {
            const $this = $(this);
            const email = $this.val().trim();
            
            if (email && !isValidEmail(email)) {
                $this.addClass('error').attr('aria-invalid', 'true');
                showNotification('يرجى إدخال بريد إلكتروني صحيح', 'error');
            } else {
                $this.removeClass('error').attr('aria-invalid', 'false');
            }
        });
    }
    
    enhanceForms();
    
    // تحسين التفاعل مع الأزرار
    function enhanceButtons() {
        // تأثير ripple للأزرار
        $('.category-link, .newsletter-form button, .rating-btn').on('click', function(e) {
            const $this = $(this);
            const pos = $this.offset();
            const ripple = $('<span class="ripple"></span>');
            
            const x = e.pageX - pos.left;
            const y = e.pageY - pos.top;
            
            ripple.css({
                position: 'absolute',
                borderRadius: '50%',
                background: 'rgba(255,255,255,0.6)',
                transform: 'scale(0)',
                animation: 'ripple 0.6s linear',
                left: x - 10,
                top: y - 10,
                width: 20,
                height: 20
            });
            
            $this.css('position', 'relative').css('overflow', 'hidden').append(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    }
    
    enhanceButtons();
    
    // إضافة animation للعناصر عند الظهور
    function setupScrollAnimations() {
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        animationObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.solution-card, .category-card, .section-title').forEach(el => {
                animationObserver.observe(el);
            });
        }
    }
    
    setupScrollAnimations();
    
    // Dark mode toggle (إضافة اختيارية)
    function setupDarkMode() {
        const darkModeToggle = $('<button>')
            .attr({
                'id': 'dark-mode-toggle',
                'class': 'dark-mode-toggle',
                'aria-label': 'تبديل الوضع الليلي'
            })
            .html('<i class="fas fa-moon"></i>')
            .css({
                position: 'fixed',
                bottom: '160px',
                right: '20px',
                background: '#667eea',
                color: 'white',
                border: 'none',
                borderRadius: '50%',
                width: '50px',
                height: '50px',
                cursor: 'pointer',
                boxShadow: '0 2px 10px rgba(0,0,0,0.2)',
                transition: 'all 0.3s',
                zIndex: 1000,
                fontSize: '1.2rem'
            })
            .appendTo('body');
        
        // فحص التفضيل المحفوظ
        const isDarkMode = localStorage.getItem('dark-mode') === 'true';
        if (isDarkMode) {
            $('body').addClass('dark-mode');
            darkModeToggle.html('<i class="fas fa-sun"></i>');
        }
        
        darkModeToggle.on('click', function() {
            $('body').toggleClass('dark-mode');
            const isDark = $('body').hasClass('dark-mode');
            
            $(this).html(isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>');
            localStorage.setItem('dark-mode', isDark);
            
            showNotification(isDark ? 'تم تفعيل الوضع الليلي 🌙' : 'تم تفعيل الوضع العادي ☀️', 'info');
        });
    }
    
    // تفعيل الوضع الليلي (اختياري)
    // setupDarkMode();
    
    // Service Worker للأداء (اختياري)
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('SW registered: ', registration);
            }).catch(function(registrationError) {
                console.log('SW registration failed: ', registrationError);
            });
        });
    }
    
    // إعدادات الأداء النهائية
    $(window).on('load', function() {
        // إخفاء loading screen إن وجد
        $('.loading-screen').fadeOut();
        
        // تحسين الخطوط
        if ('fonts' in document) {
            document.fonts.ready.then(() => {
                $('body').addClass('fonts-loaded');
            });
        }
        
        // تحسين الصور
        $('img[loading="lazy"]').each(function() {
            if (this.complete) {
                $(this).addClass('loaded');
            }
        });
    });
    
    // معالجة الأخطاء العامة
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
        
        // إرسال تقرير الخطأ (اختياري)
        if (muhtawaa_ajax && muhtawaa_ajax.ajax_url) {
            $.ajax({
                url: muhtawaa_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'log_js_error',
                    error: e.error.toString(),
                    url: window.location.href,
                    nonce: muhtawaa_ajax.nonce
                }
            });
        }
    });
    
    // رسالة ترحيب للمطورين
    console.log(`
    🏠 مرحباً بك في موقع محتوى!
    
    هذا الموقع تم تطويره باستخدام:
    - WordPress
    - jQuery
    - CSS3 & HTML5
    - Font Awesome
    
    للمزيد من المعلومات: ${muhtawaa_ajax ? muhtawaa_ajax.home_url : ''}
    `);
});

// CSS إضافي للحركات والتأثيرات
const additionalCSS = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-in {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    .fonts-loaded {
        font-display: swap;
    }
    
    .dark-mode {
        background-color: #1a1a1a;
        color: #e0e0e0;
    }
    
    .dark-mode .header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    }
    
    .dark-mode .solution-card,
    .dark-mode .category-card {
        background: #2c2c2c;
        color: #e0e0e0;
    }
    
    .dark-mode .footer {
        background: #1a1a1a;
    }
    
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    
    .back-to-top {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        transition: all 0.3s;
        opacity: 0;
        visibility: hidden;
        z-index: 999;
    }
    
    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }
    
    .back-to-top:hover {
        background: #5a6fd8;
        transform: translateY(-3px);
    }
    
    input.error,
    textarea.error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    
    .parallax-element {
        will-change: transform;
    }
    
    img.loaded {
        opacity: 1;
        transition: opacity 0.3s;
    }
    
    img:not(.loaded) {
        opacity: 0;
    }
`;

// إضافة الـ CSS إلى الصفحة
const styleSheet = document.createElement('style');
styleSheet.textContent = additionalCSS;
document.head.appendChild(styleSheet);