/**
 * ملف طلبات AJAX المتقدمة - قالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0.3
 * @author فريق التطوير
 */

(function($) {
    'use strict';

    /**
     * فئة AJAX المتقدمة
     */
    class MuhtawaaAjax {
        constructor() {
            this.requestQueue = [];
            this.activeRequests = new Map();
            this.cache = new Map();
            this.retryAttempts = 3;
            this.timeout = 30000; // 30 ثانية
            
            this.init();
            this.bindEvents();
        }

        /**
         * تهيئة النظام
         */
        init() {
            this.setupDefaults();
            this.initLoadMore();
            this.initLiveSearch();
            this.initFormHandlers();
            this.initComments();
            this.initRating();
            this.initBookmarks();
            this.initLikes();
            this.initInfiniteScroll();
        }

        /**
         * إعداد الافتراضيات
         */
        setupDefaults() {
            // إعداد AJAX الافتراضي
            $.ajaxSetup({
                timeout: this.timeout,
                beforeSend: (xhr, settings) => {
                    // إضافة توكن الأمان
                    if (settings.data && typeof settings.data === 'object') {
                        settings.data.nonce = muhtawaaData.nonce;
                    } else if (typeof settings.data === 'string') {
                        settings.data += '&nonce=' + muhtawaaData.nonce;
                    }
                    
                    // إضافة الطلب للطلبات النشطة
                    this.activeRequests.set(settings.url, xhr);
                },
                complete: (xhr, status) => {
                    // إزالة الطلب من الطلبات النشطة
                    this.activeRequests.delete(xhr.responseURL || '');
                },
                error: (xhr, status, error) => {
                    this.handleAjaxError(xhr, status, error);
                }
            });
        }

        /**
         * ربط الأحداث
         */
        bindEvents() {
            // أحداث النماذج
            $(document).on('submit', '.muhtawaa-ajax-form', this.handleFormSubmit.bind(this));
            
            // أحداث البحث المباشر
            $(document).on('input', '.muhtawaa-live-search', this.handleLiveSearch.bind(this));
            
            // أحداث التحميل المتدرج
            $(document).on('click', '.muhtawaa-load-more', this.handleLoadMore.bind(this));
            
            // أحداث التقييم
            $(document).on('click', '.muhtawaa-rating .star', this.handleRating.bind(this));
            
            // أحداث الإعجاب
            $(document).on('click', '.muhtawaa-like-btn', this.handleLike.bind(this));
            
            // أحداث الحفظ
            $(document).on('click', '.muhtawaa-bookmark-btn', this.handleBookmark.bind(this));
            
            // أحداث التعليقات
            $(document).on('submit', '.muhtawaa-comment-form', this.handleCommentSubmit.bind(this));
            $(document).on('click', '.muhtawaa-comment-reply', this.handleCommentReply.bind(this));
            
            // أحداث مخصصة
            $(document).on('muhtawaa:ajax-request', this.handleCustomRequest.bind(this));
        }

        /**
         * تحميل المزيد من المحتوى
         */
        initLoadMore() {
            $('.muhtawaa-load-more-container').each(function() {
                const container = $(this);
                const button = container.find('.muhtawaa-load-more');
                
                if (button.length) {
                    button.data('page', 1);
                    button.data('loading', false);
                }
            });
        }

        /**
         * معالج تحميل المزيد
         */
        handleLoadMore(e) {
            e.preventDefault();
            
            const button = $(e.target);
            const container = button.closest('.muhtawaa-load-more-container');
            const contentContainer = container.find('.muhtawaa-content-container');
            
            if (button.data('loading')) return;
            
            const currentPage = parseInt(button.data('page')) || 1;
            const nextPage = currentPage + 1;
            const maxPages = parseInt(button.data('max-pages')) || 1;
            
            if (nextPage > maxPages) {
                button.hide();
                return;
            }

            this.loadMoreContent(contentContainer, button, nextPage);
        }

        /**
         * تحميل المزيد من المحتوى
         */
        async loadMoreContent(container, button, page) {
            button.data('loading', true);
            
            // تحديث نص الزر
            const originalText = button.text();
            button.html('<i class="fas fa-spinner fa-spin"></i> جاري التحميل...');
            
            try {
                const data = {
                    action: 'muhtawaa_load_more',
                    page: page,
                    post_type: button.data('post-type') || 'post',
                    posts_per_page: button.data('posts-per-page') || 6,
                    category: button.data('category') || '',
                    orderby: button.data('orderby') || 'date',
                    order: button.data('order') || 'DESC'
                };

                const response = await this.request('POST', muhtawaaData.ajaxurl, data);
                
                if (response.success && response.data.html) {
                    // إضافة المحتوى الجديد
                    const newContent = $(response.data.html);
                    newContent.hide().appendTo(container).fadeIn(600);
                    
                    // تحديث رقم الصفحة
                    button.data('page', page);
                    
                    // إخفاء الزر إذا انتهت الصفحات
                    if (page >= response.data.max_pages) {
                        button.fadeOut();
                    }
                    
                    // إطلاق حدث التحميل
                    $(document).trigger('muhtawaa:content-loaded', [newContent, page]);
                    
                } else {
                    this.showError('لم يتم العثور على محتوى إضافي');
                }
                
            } catch (error) {
                this.showError('حدث خطأ في تحميل المحتوى');
                console.error('خطأ تحميل المحتوى:', error);
                
            } finally {
                button.text(originalText);
                button.data('loading', false);
            }
        }

        /**
         * البحث المباشر
         */
        initLiveSearch() {
            const searchInputs = $('.muhtawaa-live-search');
            
            searchInputs.each(function() {
                const input = $(this);
                const resultsContainer = input.siblings('.muhtawaa-search-results');
                
                if (resultsContainer.length === 0) {
                    input.after('<div class="muhtawaa-search-results"></div>');
                }
            });
        }

        /**
         * معالج البحث المباشر
         */
        handleLiveSearch(e) {
            const input = $(e.target);
            const query = input.val().trim();
            const resultsContainer = input.siblings('.muhtawaa-search-results');
            const minLength = parseInt(input.data('min-length')) || 3;
            
            // إلغاء البحث السابق
            if (input.data('search-timeout')) {
                clearTimeout(input.data('search-timeout'));
            }
            
            if (query.length < minLength) {
                resultsContainer.hide();
                return;
            }
            
            // تأخير البحث لتحسين الأداء
            const timeout = setTimeout(() => {
                this.performLiveSearch(query, resultsContainer, input);
            }, 300);
            
            input.data('search-timeout', timeout);
        }

        /**
         * تنفيذ البحث المباشر
         */
        async performLiveSearch(query, container, input) {
            // التحقق من التخزين المؤقت
            const cacheKey = `search_${query}`;
            if (this.cache.has(cacheKey)) {
                const cachedResults = this.cache.get(cacheKey);
                this.displaySearchResults(cachedResults, container);
                return;
            }
            
            // عرض مؤشر التحميل
            container.html('<div class="search-loading"><i class="fas fa-spinner fa-spin"></i> جاري البحث...</div>').show();
            
            try {
                const data = {
                    action: 'muhtawaa_live_search',
                    query: query,
                    post_type: input.data('post-type') || 'post',
                    limit: input.data('limit') || 5,
                    search_in: input.data('search-in') || 'title,content'
                };

                const response = await this.request('POST', muhtawaaData.ajaxurl, data);
                
                if (response.success) {
                    // حفظ في التخزين المؤقت
                    this.cache.set(cacheKey, response.data);
                    
                    // عرض النتائج
                    this.displaySearchResults(response.data, container);
                    
                } else {
                    container.html('<div class="search-no-results">لم يتم العثور على نتائج</div>');
                }
                
            } catch (error) {
                container.html('<div class="search-error">حدث خطأ في البحث</div>');
                console.error('خطأ البحث المباشر:', error);
            }
        }

        /**
         * عرض نتائج البحث
         */
        displaySearchResults(data, container) {
            if (!data.results || data.results.length === 0) {
                container.html('<div class="search-no-results">لم يتم العثور على نتائج</div>');
                return;
            }
            
            let html = '<ul class="search-results-list">';
            
            data.results.forEach(result => {
                html += `
                    <li class="search-result-item">
                        <a href="${result.url}" class="search-result-link">
                            ${result.thumbnail ? `<img src="${result.thumbnail}" alt="${result.title}" class="search-result-thumb">` : ''}
                            <div class="search-result-content">
                                <h4 class="search-result-title">${result.title}</h4>
                                <p class="search-result-excerpt">${result.excerpt}</p>
                                <span class="search-result-meta">${result.date} | ${result.category}</span>
                            </div>
                        </a>
                    </li>
                `;
            });
            
            html += '</ul>';
            
            if (data.total > data.results.length) {
                html += `<div class="search-view-all"><a href="${muhtawaaData.homeUrl}?s=${encodeURIComponent(data.query)}">عرض جميع النتائج (${data.total})</a></div>`;
            }
            
            container.html(html).show();
        }

        /**
         * معالج النماذج
         */
        initFormHandlers() {
            // إعداد التحقق من صحة النماذج
            $('.muhtawaa-ajax-form').each(function() {
                const form = $(this);
                
                // إضافة مؤشرات التحميل
                if (!form.find('.form-loading').length) {
                    form.append('<div class="form-loading" style="display:none;"><i class="fas fa-spinner fa-spin"></i> جاري المعالجة...</div>');
                }
                
                // إضافة منطقة الرسائل
                if (!form.find('.form-messages').length) {
                    form.prepend('<div class="form-messages"></div>');
                }
            });
        }

        /**
         * معالج إرسال النماذج
         */
        async handleFormSubmit(e) {
            e.preventDefault();
            
            const form = $(e.target);
            const submitBtn = form.find('[type="submit"]');
            const loadingIndicator = form.find('.form-loading');
            const messagesContainer = form.find('.form-messages');
            
            // التحقق من صحة النموذج
            if (!this.validateForm(form)) {
                return;
            }
            
            // تعطيل الزر وعرض التحميل
            submitBtn.prop('disabled', true);
            loadingIndicator.show();
            messagesContainer.empty();
            
            try {
                const formData = new FormData(form[0]);
                formData.append('action', form.data('action') || 'muhtawaa_form_submit');
                
                const response = await this.request('POST', muhtawaaData.ajaxurl, formData, {
                    processData: false,
                    contentType: false
                });
                
                if (response.success) {
                    this.showSuccess(response.data.message || 'تم الإرسال بنجاح', messagesContainer);
                    
                    // إعادة تعيين النموذج إذا طُلب ذلك
                    if (response.data.reset_form) {
                        form[0].reset();
                    }
                    
                    // إعادة توجيه إذا طُلب ذلك
                    if (response.data.redirect) {
                        setTimeout(() => {
                            window.location.href = response.data.redirect;
                        }, 1000);
                    }
                    
                } else {
                    this.showError(response.data.message || 'حدث خطأ في الإرسال', messagesContainer);
                }
                
            } catch (error) {
                this.showError('حدث خطأ في الاتصال', messagesContainer);
                console.error('خطأ إرسال النموذج:', error);
                
            } finally {
                submitBtn.prop('disabled', false);
                loadingIndicator.hide();
            }
        }

        /**
         * التحقق من صحة النموذج
         */
        validateForm(form) {
            let isValid = true;
            
            // إزالة رسائل الخطأ السابقة
            form.find('.field-error').remove();
            form.find('.error').removeClass('error');
            
            // التحقق من الحقول المطلوبة
            form.find('[required]').each(function() {
                const field = $(this);
                const value = field.val().trim();
                
                if (!value) {
                    isValid = false;
                    field.addClass('error');
                    field.after('<span class="field-error">هذا الحقل مطلوب</span>');
                }
            });
            
            // التحقق من البريد الإلكتروني
            form.find('[type="email"]').each(function() {
                const field = $(this);
                const value = field.val().trim();
                
                if (value && !this.isValidEmail(value)) {
                    isValid = false;
                    field.addClass('error');
                    field.after('<span class="field-error">البريد الإلكتروني غير صحيح</span>');
                }
            });
            
            // التحقق من كلمة المرور
            form.find('[type="password"]').each(function() {
                const field = $(this);
                const value = field.val();
                const minLength = parseInt(field.attr('minlength')) || 8;
                
                if (value && value.length < minLength) {
                    isValid = false;
                    field.addClass('error');
                    field.after(`<span class="field-error">كلمة المرور يجب أن تكون ${minLength} أحرف على الأقل</span>`);
                }
            });
            
            // التحقق من تطابق كلمة المرور
            const password = form.find('[name="password"]').val();
            const confirmPassword = form.find('[name="confirm_password"]').val();
            
            if (password && confirmPassword && password !== confirmPassword) {
                isValid = false;
                form.find('[name="confirm_password"]').addClass('error');
                form.find('[name="confirm_password"]').after('<span class="field-error">كلمات المرور غير متطابقة</span>');
            }
            
            return isValid;
        }

        /**
         * نظام التعليقات
         */
        initComments() {
            // إعداد نماذج التعليقات
            $('.muhtawaa-comment-form').each(function() {
                const form = $(this);
                
                if (!form.find('.comment-loading').length) {
                    form.append('<div class="comment-loading" style="display:none;"><i class="fas fa-spinner fa-spin"></i> جاري إرسال التعليق...</div>');
                }
            });
        }

        /**
         * معالج إرسال التعليقات
         */
        async handleCommentSubmit(e) {
            e.preventDefault();
            
            const form = $(e.target);
            const submitBtn = form.find('[type="submit"]');
            const loadingIndicator = form.find('.comment-loading');
            const commentsContainer = $('.muhtawaa-comments-list');
            
            submitBtn.prop('disabled', true);
            loadingIndicator.show();
            
            try {
                const formData = new FormData(form[0]);
                formData.append('action', 'muhtawaa_submit_comment');
                formData.append('post_id', muhtawaaData.postId);
                
                const response = await this.request('POST', muhtawaaData.ajaxurl, formData, {
                    processData: false,
                    contentType: false
                });
                
                if (response.success) {
                    // إضافة التعليق الجديد
                    const newComment = $(response.data.comment_html);
                    newComment.hide().prependTo(commentsContainer).fadeIn(600);
                    
                    // إعادة تعيين النموذج
                    form[0].reset();
                    
                    // تحديث عدد التعليقات
                    const commentCount = $('.comments-count');
                    const currentCount = parseInt(commentCount.text()) || 0;
                    commentCount.text(currentCount + 1);
                    
                    this.showSuccess('تم إضافة التعليق بنجاح');
                    
                } else {
                    this.showError(response.data.message || 'حدث خطأ في إضافة التعليق');
                }
                
            } catch (error) {
                this.showError('حدث خطأ في الاتصال');
                console.error('خطأ إرسال التعليق:', error);
                
            } finally {
                submitBtn.prop('disabled', false);
                loadingIndicator.hide();
            }
        }

        /**
         * معالج الرد على التعليقات
         */
        handleCommentReply(e) {
            e.preventDefault();
            
            const replyBtn = $(e.target);
            const commentId = replyBtn.data('comment-id');
            const replyForm = $('.muhtawaa-reply-form');
            
            // نقل نموذج الرد
            replyForm.find('[name="parent_id"]').val(commentId);
            replyBtn.closest('.comment').after(replyForm);
            replyForm.show();
            
            // التركيز على حقل التعليق
            replyForm.find('textarea').focus();
        }

        /**
         * نظام التقييم
         */
        initRating() {
            $('.muhtawaa-rating').each(function() {
                const rating = $(this);
                const stars = rating.find('.star');
                
                stars.hover(
                    function() {
                        const index = $(this).index();
                        stars.removeClass('active').slice(0, index + 1).addClass('active');
                    },
                    function() {
                        const currentRating = rating.data('current-rating') || 0;
                        stars.removeClass('active').slice(0, currentRating).addClass('active');
                    }
                );
            });
        }

        /**
         * معالج التقييم
         */
        async handleRating(e) {
            e.preventDefault();
            
            const star = $(e.target);
            const ratingContainer = star.closest('.muhtawaa-rating');
            const rating = star.index() + 1;
            const postId = ratingContainer.data('post-id') || muhtawaaData.postId;
            
            try {
                const response = await this.request('POST', muhtawaaData.ajaxurl, {
                    action: 'muhtawaa_rate_post',
                    post_id: postId,
                    rating: rating
                });
                
                if (response.success) {
                    // تحديث التقييم المعروض
                    ratingContainer.data('current-rating', rating);
                    ratingContainer.find('.star').removeClass('active').slice(0, rating).addClass('active');
                    
                    // تحديث متوسط التقييم
                    const avgRating = $('.average-rating');
                    if (avgRating.length && response.data.average) {
                        avgRating.text(response.data.average);
                    }
                    
                    // تحديث عدد التقييمات
                    const ratingCount = $('.rating-count');
                    if (ratingCount.length && response.data.count) {
                        ratingCount.text(response.data.count);
                    }
                    
                    this.showSuccess('شكراً لك على التقييم');
                    
                } else {
                    this.showError(response.data.message || 'حدث خطأ في التقييم');
                }
                
            } catch (error) {
                this.showError('حدث خطأ في الاتصال');
                console.error('خطأ التقييم:', error);
            }
        }

        /**
         * نظام الإعجاب
         */
        initLikes() {
            $('.muhtawaa-like-btn').each(function() {
                const btn = $(this);
                const count = btn.find('.like-count');
                
                // إضافة تأثير بصري
                btn.on('mouseenter', function() {
                    $(this).addClass('hover');
                }).on('mouseleave', function() {
                    $(this).removeClass('hover');
                });
            });
        }

        /**
         * معالج الإعجاب
         */
        async handleLike(e) {
            e.preventDefault();
            
            const btn = $(e.target).closest('.muhtawaa-like-btn');
            const postId = btn.data('post-id') || muhtawaaData.postId;
            const countElement = btn.find('.like-count');
            const iconElement = btn.find('i');
            
            // منع النقرات المتكررة
            if (btn.data('processing')) return;
            btn.data('processing', true);
            
            try {
                const response = await this.request('POST', muhtawaaData.ajaxurl, {
                    action: 'muhtawaa_toggle_like',
                    post_id: postId
                });
                
                if (response.success) {
                    // تحديث العداد
                    countElement.text(response.data.count);
                    
                    // تحديث الحالة
                    if (response.data.liked) {
                        btn.addClass('liked');
                        iconElement.removeClass('far').addClass('fas');
                        
                        // تأثير بصري
                        btn.addClass('like-animation');
                        setTimeout(() => btn.removeClass('like-animation'), 600);
                        
                    } else {
                        btn.removeClass('liked');
                        iconElement.removeClass('fas').addClass('far');
                    }
                    
                } else {
                    this.showError(response.data.message || 'حدث خطأ');
                }
                
            } catch (error) {
                this.showError('حدث خطأ في الاتصال');
                console.error('خطأ الإعجاب:', error);
                
            } finally {
                btn.data('processing', false);
            }
        }

        /**
         * نظام الحفظ
         */
        initBookmarks() {
            $('.muhtawaa-bookmark-btn').each(function() {
                const btn = $(this);
                
                btn.on('mouseenter', function() {
                    $(this).addClass('hover');
                }).on('mouseleave', function() {
                    $(this).removeClass('hover');
                });
            });
        }

        /**
         * معالج الحفظ
         */
        async handleBookmark(e) {
            e.preventDefault();
            
            const btn = $(e.target).closest('.muhtawaa-bookmark-btn');
            const postId = btn.data('post-id') || muhtawaaData.postId;
            const iconElement = btn.find('i');
            const textElement = btn.find('.bookmark-text');
            
            if (btn.data('processing')) return;
            btn.data('processing', true);
            
            try {
                const response = await this.request('POST', muhtawaaData.ajaxurl, {
                    action: 'muhtawaa_toggle_bookmark',
                    post_id: postId
                });
                
                if (response.success) {
                    if (response.data.bookmarked) {
                        btn.addClass('bookmarked');
                        iconElement.removeClass('far').addClass('fas');
                        if (textElement.length) {
                            textElement.text('محفوظ');
                        }
                        
                        this.showSuccess('تم حفظ المقال');
                        
                    } else {
                        btn.removeClass('bookmarked');
                        iconElement.removeClass('fas').addClass('far');
                        if (textElement.length) {
                            textElement.text('حفظ');
                        }
                        
                        this.showSuccess('تم إلغاء الحفظ');
                    }
                    
                } else {
                    this.showError(response.data.message || 'حدث خطأ');
                }
                
            } catch (error) {
                this.showError('حدث خطأ في الاتصال');
                console.error('خطأ الحفظ:', error);
                
            } finally {
                btn.data('processing', false);
            }
        }

        /**
         * التمرير اللانهائي
         */
        initInfiniteScroll() {
            const container = $('.muhtawaa-infinite-scroll');
            
            if (container.length && 'IntersectionObserver' in window) {
                const trigger = container.find('.infinite-scroll-trigger');
                
                if (trigger.length) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.loadNextPage(container);
                            }
                        });
                    }, { threshold: 0.1 });

                    observer.observe(trigger[0]);
                }
            }
        }

        /**
         * تحميل الصفحة التالية
         */
        async loadNextPage(container) {
            const trigger = container.find('.infinite-scroll-trigger');
            const currentPage = parseInt(container.data('current-page')) || 1;
            const maxPages = parseInt(container.data('max-pages')) || 1;
            
            if (currentPage >= maxPages || container.data('loading')) {
                trigger.hide();
                return;
            }
            
            container.data('loading', true);
            trigger.html('<i class="fas fa-spinner fa-spin"></i> جاري التحميل...');
            
            try {
                const response = await this.request('POST', muhtawaaData.ajaxurl, {
                    action: 'muhtawaa_infinite_scroll',
                    page: currentPage + 1,
                    query_vars: container.data('query-vars') || {}
                });
                
                if (response.success && response.data.html) {
                    const newContent = $(response.data.html);
                    newContent.hide().insertBefore(trigger).fadeIn(600);
                    
                    container.data('current-page', currentPage + 1);
                    
                    if (currentPage + 1 >= maxPages) {
                        trigger.hide();
                    } else {
                        trigger.html('');
                    }
                    
                    $(document).trigger('muhtawaa:infinite-loaded', [newContent]);
                    
                } else {
                    trigger.hide();
                }
                
            } catch (error) {
                trigger.html('حدث خطأ في التحميل');
                console.error('خطأ التمرير اللانهائي:', error);
                
            } finally {
                container.data('loading', false);
            }
        }

        /**
         * طلب AJAX عام
         */
        async request(method, url, data, options = {}) {
            const defaultOptions = {
                method: method,
                url: url,
                data: data,
                dataType: 'json',
                cache: false
            };
            
            const ajaxOptions = { ...defaultOptions, ...options };
            
            return new Promise((resolve, reject) => {
                $.ajax(ajaxOptions)
                    .done(resolve)
                    .fail(reject);
            });
        }

        /**
         * معالج الطلبات المخصصة
         */
        handleCustomRequest(e, requestData) {
            const { method, url, data, success, error } = requestData;
            
            this.request(method || 'POST', url || muhtawaaData.ajaxurl, data)
                .then(response => {
                    if (typeof success === 'function') {
                        success(response);
                    }
                })
                .catch(err => {
                    if (typeof error === 'function') {
                        error(err);
                    } else {
                        this.handleAjaxError(err);
                    }
                });
        }

        /**
         * معالج أخطاء AJAX
         */
        handleAjaxError(xhr, status, error) {
            let message = 'حدث خطأ في الاتصال';
            
            if (status === 'timeout') {
                message = 'انتهت مهلة الاتصال';
            } else if (status === 'abort') {
                message = 'تم إلغاء الطلب';
            } else if (xhr.status === 404) {
                message = 'الصفحة غير موجودة';
            } else if (xhr.status === 500) {
                message = 'خطأ في الخادم';
            } else if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                message = xhr.responseJSON.data.message;
            }
            
            this.showError(message);
            console.error('خطأ AJAX:', { xhr, status, error });
        }

        /**
         * دوال المساعدة
         */
        
        /**
         * التحقق من صحة البريد الإلكتروني
         */
        isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        /**
         * عرض رسالة نجاح
         */
        showSuccess(message, container = null) {
            if (window.MuhtawaaNotifications) {
                window.MuhtawaaNotifications.show(message, 'success');
            } else if (container) {
                container.html(`<div class="alert alert-success">${message}</div>`);
            } else {
                alert(message);
            }
        }

        /**
         * عرض رسالة خطأ
         */
        showError(message, container = null) {
            if (window.MuhtawaaNotifications) {
                window.MuhtawaaNotifications.show(message, 'error');
            } else if (container) {
                container.html(`<div class="alert alert-error">${message}</div>`);
            } else {
                alert(message);
            }
        }

        /**
         * إلغاء جميع الطلبات النشطة
         */
        cancelAllRequests() {
            this.activeRequests.forEach(xhr => {
                if (xhr.readyState !== 4) {
                    xhr.abort();
                }
            });
            this.activeRequests.clear();
        }

        /**
         * مسح التخزين المؤقت
         */
        clearCache() {
            this.cache.clear();
        }

        /**
         * API عامة
         */
        
        /**
         * إجراء طلب AJAX مخصص
         */
        customRequest(options) {
            return this.request(
                options.method || 'POST',
                options.url || muhtawaaData.ajaxurl,
                options.data || {},
                options.ajaxOptions || {}
            );
        }
    }

    /**
     * تهيئة النظام عند تحميل الصفحة
     */
    $(document).ready(function() {
        if (typeof muhtawaaData !== 'undefined') {
            window.MuhtawaaAjax = new MuhtawaaAjax();
            
            // إتاحة API للاستخدام الخارجي
            window.muhtawaaAjax = function(options) {
                if (window.MuhtawaaAjax) {
                    return window.MuhtawaaAjax.customRequest(options);
                }
            };
        } else {
            console.warn('بيانات muhtawaaData غير متوفرة');
        }
    });

    /**
     * إلغاء الطلبات عند مغادرة الصفحة
     */
    $(window).on('beforeunload', function() {
        if (window.MuhtawaaAjax) {
            window.MuhtawaaAjax.cancelAllRequests();
        }
    });

})(jQuery);