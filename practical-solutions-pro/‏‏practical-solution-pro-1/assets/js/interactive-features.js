/**
 * Interactive Features for Practical Solutions Pro
 * الميزات التفاعلية المتقدمة للحلول العملية الاحترافية
 * المكان: /assets/js/interactive-features.js
 */

(function(window, document, $) {
    'use strict';
    
    // التحقق من توفر PracticalSolutions
    if (!window.PracticalSolutions) {
        console.error('PracticalSolutions not found. Interactive features require unified.js');
        return;
    }
    
    const PS = window.PracticalSolutions;
    
    /**
     * ==== نظام المفضلة (Bookmarks) ====
     */
    PS.Bookmarks = {
        bookmarks: new Set(),
        initialized: false,
        
        init: function() {
            if (this.initialized) return;
            
            this.loadBookmarks();
            this.bindEvents();
            this.updateUI();
            this.initialized = true;
            
            PS.Events.emit('bookmarks:ready');
        },
        
        loadBookmarks: function() {
            try {
                const saved = localStorage.getItem('ps_bookmarks');
                if (saved) {
                    this.bookmarks = new Set(JSON.parse(saved));
                }
            } catch (e) {
                console.warn('Error loading bookmarks:', e);
                this.bookmarks = new Set();
            }
        },
        
        saveBookmarks: function() {
            try {
                localStorage.setItem('ps_bookmarks', JSON.stringify([...this.bookmarks]));
            } catch (e) {
                console.warn('Error saving bookmarks:', e);
            }
        },
        
        bindEvents: function() {
            $(document).on('click', '.ps-bookmark-btn', this.handleBookmarkClick.bind(this));
            $(document).on('click', '.ps-bookmark-toggle', this.handleBookmarkClick.bind(this));
        },
        
        handleBookmarkClick: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const postId = button.dataset.postId || PS.settings.postId;
            
            if (!postId) {
                this.showNotification('معرف المقال غير موجود', 'error');
                return;
            }
            
            const isBookmarked = this.isBookmarked(postId);
            
            if (isBookmarked) {
                this.removeBookmark(postId, button);
            } else {
                this.addBookmark(postId, button);
            }
        },
        
        addBookmark: function(postId, button = null) {
            this.bookmarks.add(postId);
            this.saveBookmarks();
            
            // تحديث الواجهة
            this.updateBookmarkButton(postId, true, button);
            
            // إرسال للخادم إذا كان المستخدم مسجل الدخول
            if (PS.settings.userId) {
                this.syncBookmarkToServer(postId, 'add');
            }
            
            this.showNotification(PS.settings.strings.bookmarkAdded || 'تم إضافة للمفضلة', 'success');
            PS.Events.emit('bookmark:added', { postId });
        },
        
        removeBookmark: function(postId, button = null) {
            this.bookmarks.delete(postId);
            this.saveBookmarks();
            
            // تحديث الواجهة
            this.updateBookmarkButton(postId, false, button);
            
            // إرسال للخادم إذا كان المستخدم مسجل الدخول
            if (PS.settings.userId) {
                this.syncBookmarkToServer(postId, 'remove');
            }
            
            this.showNotification(PS.settings.strings.bookmarkRemoved || 'تم إزالة من المفضلة', 'info');
            PS.Events.emit('bookmark:removed', { postId });
        },
        
        isBookmarked: function(postId) {
            return this.bookmarks.has(postId.toString());
        },
        
        updateBookmarkButton: function(postId, isBookmarked, specificButton = null) {
            const buttons = specificButton ? [specificButton] : 
                document.querySelectorAll(`[data-post-id="${postId}"].ps-bookmark-btn, [data-post-id="${postId}"].ps-bookmark-toggle`);
            
            buttons.forEach(button => {
                button.classList.toggle('bookmarked', isBookmarked);
                
                const icon = button.querySelector('.ps-bookmark-icon, i');
                if (icon) {
                    icon.textContent = isBookmarked ? '❤️' : '🤍';
                    icon.className = isBookmarked ? 'ps-bookmark-icon bookmarked' : 'ps-bookmark-icon';
                }
                
                const text = button.querySelector('.ps-bookmark-text');
                if (text) {
                    text.textContent = isBookmarked ? 'محفوظ' : 'حفظ';
                }
                
                button.setAttribute('aria-pressed', isBookmarked);
                button.title = isBookmarked ? 'إزالة من المفضلة' : 'إضافة للمفضلة';
            });
        },
        
        updateUI: function() {
            this.bookmarks.forEach(postId => {
                this.updateBookmarkButton(postId, true);
            });
        },
        
        syncBookmarkToServer: function(postId, action) {
            PS.Ajax.request('ps_bookmark_post', {
                post_id: postId,
                bookmark_action: action
            }).catch(error => {
                console.warn('Bookmark sync failed:', error);
            });
        },
        
        showNotification: function(message, type) {
            if (PS.Notifications) {
                PS.Notifications.show(message, type);
            }
        },
        
        getBookmarks: function() {
            return [...this.bookmarks];
        },
        
        getBookmarksCount: function() {
            return this.bookmarks.size;
        }
    };
    
    /**
     * ==== نظام التقييمات (Rating System) ====
     */
    PS.RatingSystem = {
        initialized: false,
        ratings: new Map(),
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.loadUserRatings();
            this.initialized = true;
            
            PS.Events.emit('rating:ready');
        },
        
        bindEvents: function() {
            $(document).on('click', '.ps-star', this.handleStarClick.bind(this));
            $(document).on('mouseenter', '.ps-star', this.handleStarHover.bind(this));
            $(document).on('mouseleave', '.ps-rating-stars', this.handleStarsLeave.bind(this));
            $(document).on('click', '.ps-rating-submit', this.handleRatingSubmit.bind(this));
        },
        
        handleStarClick: function(e) {
            const star = e.currentTarget;
            const rating = parseInt(star.dataset.rating);
            const widget = star.closest('.ps-rating-system');
            
            if (!widget) return;
            
            this.setRating(widget, rating);
        },
        
        handleStarHover: function(e) {
            const star = e.currentTarget;
            const rating = parseInt(star.dataset.rating);
            const widget = star.closest('.ps-rating-system');
            
            if (!widget) return;
            
            this.highlightStars(widget, rating, true);
        },
        
        handleStarsLeave: function(e) {
            const widget = e.currentTarget.closest('.ps-rating-system');
            if (!widget) return;
            
            const currentRating = this.getCurrentRating(widget);
            this.highlightStars(widget, currentRating, false);
        },
        
        handleRatingSubmit: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const widget = button.closest('.ps-rating-system');
            const postId = widget.dataset.postId || PS.settings.postId;
            const rating = this.getCurrentRating(widget);
            
            if (!rating) {
                this.showNotification('يرجى اختيار تقييم أولاً', 'warning');
                return;
            }
            
            this.submitRating(postId, rating, widget);
        },
        
        setRating: function(widget, rating) {
            const postId = widget.dataset.postId || PS.settings.postId;
            
            // تحديث واجهة المستخدم
            this.highlightStars(widget, rating, false);
            widget.dataset.userRating = rating;
            
            // حفظ محلياً
            this.ratings.set(postId, rating);
            this.saveUserRatings();
            
            // إظهار زر الإرسال
            const submitBtn = widget.querySelector('.ps-rating-submit');
            if (submitBtn) {
                submitBtn.style.display = 'inline-block';
            }
            
            PS.Events.emit('rating:selected', { postId, rating });
        },
        
        highlightStars: function(widget, rating, isHover = false) {
            const stars = widget.querySelectorAll('.ps-star');
            
            stars.forEach((star, index) => {
                const starRating = index + 1;
                const isActive = starRating <= rating;
                
                star.classList.toggle('active', isActive);
                star.classList.toggle('hover-effect', isHover && isActive);
                
                // تحديث لون النجمة
                star.style.color = isActive ? 
                    (isHover ? '#ffeb3b' : '#ffc107') : '#ddd';
            });
        },
        
        getCurrentRating: function(widget) {
            return parseInt(widget.dataset.userRating) || 0;
        },
        
        submitRating: function(postId, rating, widget) {
            const submitBtn = widget.querySelector('.ps-rating-submit');
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'جاري الإرسال...';
            }
            
            PS.Ajax.request('ps_submit_rating', {
                post_id: postId,
                rating: rating
            }).then(response => {
                if (response.success) {
                    this.handleRatingSuccess(widget, response.data);
                } else {
                    this.showNotification(response.data || 'حدث خطأ في إرسال التقييم', 'error');
                }
            }).catch(error => {
                this.showNotification('حدث خطأ في الاتصال', 'error');
            }).finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'إرسال التقييم';
                }
            });
        },
        
        handleRatingSuccess: function(widget, data) {
            // إخفاء زر الإرسال وإظهار رسالة النجاح
            const submitBtn = widget.querySelector('.ps-rating-submit');
            if (submitBtn) {
                submitBtn.style.display = 'none';
            }
            
            // إضافة رسالة النجاح
            let successMsg = widget.querySelector('.ps-rating-submitted');
            if (!successMsg) {
                successMsg = document.createElement('div');
                successMsg.className = 'ps-rating-submitted';
                successMsg.textContent = PS.settings.strings.ratingSubmitted || 'شكراً لك على التقييم!';
                widget.appendChild(successMsg);
            }
            
            // تحديث إحصائيات التقييم
            if (data.newAverage) {
                this.updateRatingDisplay(widget, data.newAverage, data.totalRatings);
            }
            
            this.showNotification('تم إرسال التقييم بنجاح', 'success');
            PS.Events.emit('rating:submitted', data);
        },
        
        updateRatingDisplay: function(widget, average, count = null) {
            const averageEl = widget.querySelector('.ps-rating-average');
            const countEl = widget.querySelector('.ps-rating-count');
            
            if (averageEl) {
                averageEl.textContent = average.toFixed(1);
            }
            
            if (countEl && count !== null) {
                countEl.textContent = `(${count} تقييم)`;
            }
        },
        
        loadUserRatings: function() {
            try {
                const saved = localStorage.getItem('ps_user_ratings');
                if (saved) {
                    this.ratings = new Map(JSON.parse(saved));
                }
            } catch (e) {
                console.warn('Error loading ratings:', e);
                this.ratings = new Map();
            }
        },
        
        saveUserRatings: function() {
            try {
                localStorage.setItem('ps_user_ratings', JSON.stringify([...this.ratings]));
            } catch (e) {
                console.warn('Error saving ratings:', e);
            }
        },
        
        showNotification: function(message, type) {
            if (PS.Notifications) {
                PS.Notifications.show(message, type);
            }
        }
    };
    
    /**
     * ==== نظام المشاركة الاجتماعية ====
     */
    PS.SocialSharing = {
        initialized: false,
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.initialized = true;
            
            PS.Events.emit('sharing:ready');
        },
        
        bindEvents: function() {
            $(document).on('click', '.ps-share-btn', this.handleShareClick.bind(this));
            $(document).on('click', '.ps-copy-link', this.handleCopyLink.bind(this));
        },
        
        handleShareClick: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const platform = button.dataset.platform;
            const url = button.dataset.url || window.location.href;
            const title = button.dataset.title || document.title;
            const description = button.dataset.description || '';
            
            this.shareToplatform(platform, url, title, description);
            this.trackShare(platform);
        },
        
        shareToplatform: function(platform, url, title, description) {
            const encodedUrl = encodeURIComponent(url);
            const encodedTitle = encodeURIComponent(title);
            const encodedDescription = encodeURIComponent(description);
            
            const shareUrls = {
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
                twitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`,
                linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`,
                whatsapp: `https://wa.me/?text=${encodedTitle}%20${encodedUrl}`,
                telegram: `https://t.me/share/url?url=${encodedUrl}&text=${encodedTitle}`,
                email: `mailto:?subject=${encodedTitle}&body=${encodedDescription}%0A%0A${encodedUrl}`
            };
            
            if (shareUrls[platform]) {
                if (platform === 'email') {
                    window.location.href = shareUrls[platform];
                } else {
                    this.openShareWindow(shareUrls[platform], platform);
                }
            }
        },
        
        openShareWindow: function(url, platform) {
            const width = 600;
            const height = 400;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;
            
            const windowFeatures = `width=${width},height=${height},left=${left},top=${top},resizable=yes,scrollbars=yes`;
            
            window.open(url, `share_${platform}`, windowFeatures);
        },
        
        handleCopyLink: function(e) {
            e.preventDefault();
            
            const button = e.currentTarget;
            const url = button.dataset.url || window.location.href;
            
            this.copyToClipboard(url).then(() => {
                this.showNotification(PS.settings.strings.shareSuccess || 'تم نسخ الرابط', 'success');
                this.trackShare('copy');
            }).catch(() => {
                this.showNotification('فشل في نسخ الرابط', 'error');
            });
        },
        
        copyToClipboard: function(text) {
            if (navigator.clipboard) {
                return navigator.clipboard.writeText(text);
            } else {
                // للمتصفحات القديمة
                return new Promise((resolve, reject) => {
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    textArea.style.position = 'fixed';
                    textArea.style.opacity = '0';
                    document.body.appendChild(textArea);
                    textArea.select();
                    
                    try {
                        const successful = document.execCommand('copy');
                        document.body.removeChild(textArea);
                        
                        if (successful) {
                            resolve();
                        } else {
                            reject();
                        }
                    } catch (err) {
                        document.body.removeChild(textArea);
                        reject(err);
                    }
                });
            }
        },
        
        trackShare: function(platform) {
            if (PS.settings.features.share_tracking) {
                PS.Ajax.request('ps_track_share', {
                    post_id: PS.settings.postId,
                    platform: platform
                }).catch(error => {
                    console.warn('Share tracking failed:', error);
                });
            }
            
            PS.Events.emit('share:tracked', { platform });
        },
        
        showNotification: function(message, type) {
            if (PS.Notifications) {
                PS.Notifications.show(message, type);
            }
        }
    };
    
    /**
     * ==== نظام تتبع نشاط المستخدم ====
     */
    PS.UserActivity = {
        initialized: false,
        sessionData: {
            startTime: Date.now(),
            scrollDepth: 0,
            interactions: 0,
            timeOnPage: 0,
            engagementScore: 0
        },
        
        init: function() {
            if (this.initialized) return;
            
            this.bindEvents();
            this.startTracking();
            this.initialized = true;
            
            PS.Events.emit('activity:ready');
        },
        
        bindEvents: function() {
            // تتبع التمرير
            $(window).on('scroll', PS.Utils.throttle(this.trackScroll.bind(this), 250));
            
            // تتبع التفاعلات
            $(document).on('click', this.trackInteraction.bind(this));
            $(document).on('keydown', this.trackInteraction.bind(this));
            
            // إرسال البيانات قبل المغادرة
            $(window).on('beforeunload', this.sendActivityData.bind(this));
            
            // إرسال دوري
            setInterval(this.sendActivityData.bind(this), 30000); // كل 30 ثانية
        },
        
        trackScroll: function() {
            const scrollTop = window.pageYOffset;
            const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollDepth = documentHeight > 0 ? scrollTop / documentHeight : 0;
            
            this.sessionData.scrollDepth = Math.max(this.sessionData.scrollDepth, scrollDepth);
            this.updateEngagementScore();
        },
        
        trackInteraction: function() {
            this.sessionData.interactions++;
            this.updateEngagementScore();
        },
        
        updateEngagementScore: function() {
            const timeWeight = Math.min((Date.now() - this.sessionData.startTime) / 300000, 1); // 5 دقائق كحد أقصى
            const scrollWeight = this.sessionData.scrollDepth;
            const interactionWeight = Math.min(this.sessionData.interactions / 10, 1);
            
            this.sessionData.engagementScore = Math.round(
                (timeWeight * 0.4 + scrollWeight * 0.4 + interactionWeight * 0.2) * 100
            );
        },
        
        startTracking: function() {
            // تتبع الوقت
            this.timeTracker = setInterval(() => {
                this.sessionData.timeOnPage = Math.round((Date.now() - this.sessionData.startTime) / 1000);
            }, 1000);
        },
        
        sendActivityData: function() {
            if (!PS.settings.features.analytics) return;
            
            this.updateEngagementScore();
            
            const data = {
                post_id: PS.settings.postId,
                session_id: this.getSessionId(),
                activity_type: 'page_engagement',
                scroll_depth: this.sessionData.scrollDepth,
                time_on_page: this.sessionData.timeOnPage,
                interactions_count: this.sessionData.interactions,
                engagement_score: this.sessionData.engagementScore
            };
            
            // استخدام sendBeacon إذا كان متاحاً للإرسال الموثوق
            if (navigator.sendBeacon) {
                const formData = new FormData();
                formData.append('action', 'ps_track_user_activity');
                formData.append('nonce', PS.settings.nonce);
                
                Object.keys(data).forEach(key => {
                    formData.append(key, data[key]);
                });
                
                navigator.sendBeacon(PS.settings.ajaxUrl, formData);
            } else {
                PS.Ajax.request('ps_track_user_activity', data).catch(error => {
                    console.warn('Activity tracking failed:', error);
                });
            }
        },
        
        getSessionId: function() {
            let sessionId = sessionStorage.getItem('ps_session_id');
            if (!sessionId) {
                sessionId = 'ps_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                sessionStorage.setItem('ps_session_id', sessionId);
            }
            return sessionId;
        }
    };
    
    /**
     * ==== تهيئة الميزات التفاعلية ====
     */
    PS.InteractiveFeatures = {
        init: function() {
            // تهيئة النظم المختلفة حسب الإعدادات
            if (PS.settings.features.bookmarks) {
                PS.Bookmarks.init();
            }
            
            if (PS.settings.features.rating_system) {
                PS.RatingSystem.init();
            }
            
            if (PS.settings.features.share_tracking) {
                PS.SocialSharing.init();
            }
            
            if (PS.settings.features.analytics) {
                PS.UserActivity.init();
            }
            
            PS.Events.emit('interactive-features:ready');
        }
    };
    
    // تهيئة عند جاهزية النظام
    PS.Events.on('ps:ready', () => {
        PS.InteractiveFeatures.init();
    });
    
    // تصدير للنطاق العام
    window.PSInteractiveFeatures = PS.InteractiveFeatures;
    
})(window, document, window.jQuery);

// CSS إضافي للميزات التفاعلية
const interactiveFeaturesCSS = `
<style>
/* نظام المفضلة */
.ps-bookmark-btn {
    background: none;
    border: 2px solid var(--ps-color-primary, #007cba);
    color: var(--ps-color-primary, #007cba);
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.ps-bookmark-btn:hover {
    background: var(--ps-color-primary, #007cba);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,123,186,0.3);
}

.ps-bookmark-btn.bookmarked {
    background: var(--ps-color-primary, #007cba);
    color: white;
    border-color: var(--ps-color-primary, #007cba);
}

.ps-bookmark-btn.bookmarked:hover {
    background: #0056b3;
    border-color: #0056b3;
}

.ps-bookmark-icon {
    font-size: 16px;
    transition: transform 0.3s ease;
}

.ps-bookmark-btn:hover .ps-bookmark-icon {
    transform: scale(1.1);
}

/* نظام التقييمات */
.ps-rating-system {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 20px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.ps-rating-stars {
    display: flex;
    gap: 4px;
}

.ps-star {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
    user-select: none;
}

.ps-star:hover,
.ps-star.active {
    color: #ffc107;
    transform: scale(1.1);
}

.ps-star.hover-effect {
    color: #ffeb3b;
    transform: scale(1.2);
}

.ps-rating-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.ps-rating-average {
    font-weight: 600;
    font-size: 18px;
    color: var(--ps-color-contrast, #1a1a1a);
}

.ps-rating-count {
    font-size: 14px;
    color: var(--ps-color-tertiary, #64748b);
}

.ps-rating-submit {
    background: var(--ps-color-primary, #007cba);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: none;
}

.ps-rating-submit:hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.ps-rating-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.ps-rating-submitted {
    color: var(--ps-color-success, #10b981);
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.ps-rating-submitted::before {
    content: "✓";
    font-weight: bold;
}

/* نظام المشاركة */
.ps-share-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin: 20px 0;
}

.ps-share-btn {
    padding: 10px 15px;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    min-width: 100px;
    justify-content: center;
}

.ps-share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    color: white;
    text-decoration: none;
}

.ps-share-facebook { background: #1877f2; }
.ps-share-facebook:hover { background: #166fe5; }

.ps-share-twitter { background: #1da1f2; }
.ps-share-twitter:hover { background: #1a91da; }

.ps-share-linkedin { background: #0077b5; }
.ps-share-linkedin:hover { background: #006ba1; }

.ps-share-whatsapp { background: #25d366; }
.ps-share-whatsapp:hover { background: #22c55e; }

.ps-share-telegram { background: #0088cc; }
.ps-share-telegram:hover { background: #007bb5; }

.ps-copy-link { 
    background: var(--ps-color-tertiary, #64748b); 
}
.ps-copy-link:hover { 
    background: #4b5563; 
}

/* تحسينات الاستجابة */
@media (max-width: 768px) {
    .ps-rating-system {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .ps-rating-stars {
        align-self: center;
    }
    
    .ps-share-buttons {
        justify-content: center;
    }
    
    .ps-share-btn {
        min-width: 80px;
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .ps-bookmark-btn {
        padding: 6px 10px;
        font-size: 12px;
    }
}

/* تحسينات إمكانية الوصول */
.ps-bookmark-btn:focus,
.ps-rating-submit:focus,
.ps-share-btn:focus {
    outline: 2px solid var(--ps-color-primary, #007cba);
    outline-offset: 2px;
}

.ps-star:focus {
    outline: 2px solid #ffc107;
    outline-offset: 2px;
    border-radius: 4px;
}

/* تأثيرات التحميل */
.ps-rating-submit.loading::after {
    content: "";
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 8px;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', interactiveFeaturesCSS);