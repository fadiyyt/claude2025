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
    let noMoreContent = false; // إضافة متغير لمنع الرسائل المتكررة
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
        if (!window.muhtawaa_ajax || !window.muhtawaa_ajax.ajax_url) return;
        
        const $searchContainer = $('.search-bar, .search-form').first();
        $searchContainer.addClass('loading');
        
        $.ajax({
            url: window.muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'live_search',
                search_term: searchTerm,
                nonce: window.muhtawaa_ajax.nonce
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
        if (!window.muhtawaa_ajax || !window.muhtawaa_ajax.ajax_url) return;
        
        $.ajax({
            url: window.muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'get_search_suggestions',
                nonce: window.muhtawaa_ajax.nonce
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
                url: window.muhtawaa_ajax.ajax_url,
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
    
    // الحل السريع - إصلاح مُحدث
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
        if (!window.muhtawaa_ajax || !window.muhtawaa_ajax.ajax_url) {
            showBasicTip();
            return;
        }
        
        $.ajax({
            url: window.muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'get_random_tip',
                nonce: window.muhtawaa_ajax.nonce
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
    
    // تحميل المزيد من المحتوى - مُحدث ومُصحح
    function setupInfiniteScroll() {
        const $loadMoreBtn = $('#load-more-solutions');
        
        if ($loadMoreBtn.length) {
            $loadMoreBtn.on('click', function() {
                loadMoreSolutions();
            });
        }
        
        // التمرير اللانهائي مع تحكم أفضل
        $(window).on('scroll', throttle(function() {
            if (isNearBottom() && !isLoading && !noMoreContent && $('.solutions-grid').length > 0) {
                if ($('#load-more-solutions').is(':visible')) {
                    loadMoreSolutions();
                }
            }
        }, 500));
    }

    function loadMoreSolutions() {
        if (isLoading || noMoreContent) return;
        
        isLoading = true;
        currentPage++;
        
        const $loadMoreBtn = $('#load-more-solutions');
        const originalText = $loadMoreBtn.text();
        
        $loadMoreBtn.html('<div class="loading-spinner"></div> جاري التحميل...').prop('disabled', true);
        
        $.ajax({
            url: window.muhtawaa_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_solutions',
                page: currentPage,
                nonce: window.muhtawaa_ajax.nonce
            },
            success: function(response) {
                isLoading = false;
                
                if (response.success && response.data.html) {
                    $('.solutions-grid').append(response.data.html);
                    
                    // تحريك العناصر الجديدة
                    $('.solutions-grid').children().slice(-response.data.count).hide().fadeIn('slow');
                    
                    if (!response.data.has_more) {
                        noMoreContent = true;
                        $loadMoreBtn.hide();
                        // إضافة رسالة واحدة فقط
                        if (!$('.no-more-solutions').length) {
                            $('.solutions-grid').after('<p class="no-more-solutions" style="text-align: center; margin-top: 2rem; color: #999; font-style: italic;">تم عرض جميع الحلول المتاحة 😊</p>');
                        }
                    } else {
                        $loadMoreBtn.text(originalText).prop('disabled', false);
                    }
                } else {
                    currentPage--;
                    $loadMoreBtn.text(originalText).prop('disabled', false);
                    
                    if (!$('.no-more-solutions').length) {
                        showNotification('لا توجد حلول أخرى', 'info');
                    }
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
            if (!window.muhtawaa_ajax) return;
            
            $.ajax({
                url: window.muhtawaa_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'rate_solution',
                    post_id: postId,
                    rating: rating,
                    nonce: window.muhtawaa_ajax.nonce
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
        
        // زر العودة للأعلى - مُصحح
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
    
    // زر العودة للأعلى - مُصحح ومُحدث
    function setupBackToTop() {
        // إنشاء الزر إذا لم يكن موجوداً
        let $backToTop = $('#back-to-top');
        if (!$backToTop.length) {
            $backToTop = $('<button>')
                .attr({
                    'id': 'back-to-top',
                    'class': 'back-to-top',
                    'aria-label': 'العودة للأعلى'
                })
                .html('<i class="fas fa-arrow-up"></i>')
                .css({
                    position: 'fixed',
                    bottom: '20px',
                    left: '20px',
                    background: '#667eea',
                    color: 'white',
                    border: 'none',
                    borderRadius: '50%',
                    width: '50px',
                    height: '50px',
                    cursor: 'pointer',
                    boxShadow: '0 5px 20px rgba(0,0,0,0.2)',
                    transition: 'all 0.3s',
                    opacity: '0',
                    visibility: 'hidden',
                    zIndex: '999',
                    fontSize: '1.2rem',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center'
                })
                .appendTo('body');
        }
        
        // إظهار/إخفاء الزر عند التمرير
        $(window).on('scroll', throttle(function() {
            if ($(window).scrollTop() > 300) {
                $backToTop.css({
                    opacity: '1',
                    visibility: 'visible'
                }).addClass('show');
            } else {
                $backToTop.css({
                    opacity: '0',
                    visibility: 'hidden'
                }).removeClass('show');
            }
        }, 100));
        
        // النقر على الزر
        $backToTop.off('click').on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        });
        
        // دعم لوحة المفاتيح
        $backToTop.on('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
        
        // تحسين التصميم عند التحويم
        $backToTop.hover(
            function() {
                $(this).css({
                    background: '#5a6fd8',
                    transform: 'translateY(-3px)',
                    boxShadow: '0 8px 25px rgba(0,0,0,0.3)'
                });
            },
            function() {
                $(this).css({
                    background: '#667eea',
                    transform: 'translateY(0)',
                    boxShadow: '0 5px 20px rgba(0,0,0,0.2)'
                });
            }
        );
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
        if (!$('#aria-live-region').length) {
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
                