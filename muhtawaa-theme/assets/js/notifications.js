/**
 * نظام الإشعارات المتقدم
 * Advanced Notifications System
 * 
 * @package Muhtawaa
 * @version 2.0.3
 */

(function($) {
    'use strict';

    const MuhtawaaNotifications = {
        // إعدادات النظام
        settings: {
            position: 'top-right', // top-right, top-left, bottom-right, bottom-left, top-center, bottom-center
            autoClose: true,
            autoCloseDelay: 5000,
            showProgressBar: true,
            enableSound: false,
            soundUrl: '',
            maxNotifications: 5,
            stackSpacing: 10,
            animationDuration: 300,
            enablePersistence: true,
            enableGrouping: true,
            rtlSupport: true
        },

        // أنواع الإشعارات
        types: {
            success: {
                icon: 'fas fa-check-circle',
                color: '#10b981',
                sound: 'success.mp3'
            },
            error: {
                icon: 'fas fa-exclamation-circle',
                color: '#ef4444',
                sound: 'error.mp3'
            },
            warning: {
                icon: 'fas fa-exclamation-triangle',
                color: '#f59e0b',
                sound: 'warning.mp3'
            },
            info: {
                icon: 'fas fa-info-circle',
                color: '#3b82f6',
                sound: 'info.mp3'
            },
            loading: {
                icon: 'fas fa-spinner fa-spin',
                color: '#6b7280',
                sound: null
            }
        },

        // حالة النظام
        state: {
            notifications: [],
            idCounter: 0,
            container: null,
            audioContext: null,
            isInitialized: false,
            groupedNotifications: {},
            persistentQueue: []
        },

        // تهيئة نظام الإشعارات
        init: function() {
            if (this.state.isInitialized) {
                return;
            }

            this.createContainer();
            this.bindEvents();
            this.initializeAudio();
            this.loadPersistentNotifications();
            this.setupWebNotifications();
            this.initializeServiceWorker();
            
            this.state.isInitialized = true;
            console.log('🔔 Muhtawaa Notifications System initialized');
        },

        // إنشاء حاوي الإشعارات
        createContainer: function() {
            const containerClass = `notifications-container notifications-${this.settings.position}`;
            
            this.state.container = $(`<div class="${containerClass}"></div>`);
            $('body').append(this.state.container);

            // إضافة الأنماط الأساسية
            this.injectStyles();
        },

        // ربط الأحداث
        bindEvents: function() {
            // النقر على الإشعار
            $(document).on('click', '.notification', this.handleNotificationClick.bind(this));

            // إغلاق الإشعار
            $(document).on('click', '.notification-close', this.handleCloseClick.bind(this));

            // التمرير فوق الإشعار (إيقاف العداد)
            $(document).on('mouseenter', '.notification', this.pauseAutoClose.bind(this));
            $(document).on('mouseleave', '.notification', this.resumeAutoClose.bind(this));

            // إجراءات الإشعار
            $(document).on('click', '.notification-action', this.handleActionClick.bind(this));

            // إشعارات النظام
            if ('Notification' in window) {
                $(document).on('visibilitychange', this.handleVisibilityChange.bind(this));
            }

            // اختصارات لوحة المفاتيح
            $(document).on('keydown', this.handleKeyboard.bind(this));
        },

        // عرض إشعار
        show: function(message, type = 'info', options = {}) {
            if (!this.state.isInitialized) {
                this.init();
            }

            const notification = this.createNotification(message, type, options);
            
            // التحقق من التجميع
            if (this.settings.enableGrouping && options.group) {
                return this.handleGroupedNotification(notification, options.group);
            }

            return this.displayNotification(notification);
        },

        // إنشاء إشعار
        createNotification: function(message, type, options) {
            const id = ++this.state.idCounter;
            const typeConfig = this.types[type] || this.types.info;

            const notification = {
                id: id,
                message: message,
                type: type,
                title: options.title || '',
                icon: options.icon || typeConfig.icon,
                color: options.color || typeConfig.color,
                autoClose: options.autoClose !== undefined ? options.autoClose : this.settings.autoClose,
                autoCloseDelay: options.autoCloseDelay || this.settings.autoCloseDelay,
                persistent: options.persistent || false,
                actions: options.actions || [],
                data: options.data || {},
                group: options.group || null,
                sound: options.sound !== undefined ? options.sound : typeConfig.sound,
                onClick: options.onClick || null,
                onClose: options.onClose || null,
                createdAt: new Date(),
                isVisible: false,
                isPaused: false,
                progress: 100
            };

            return notification;
        },

        // عرض الإشعار
        displayNotification: function(notification) {
            // إزالة الإشعارات الزائدة
            this.limitNotifications();

            // إنشاء عنصر DOM
            const $element = this.createNotificationElement(notification);
            notification.element = $element;

            // إضافة إلى الحاوي
            if (this.settings.position.includes('top')) {
                this.state.container.prepend($element);
            } else {
                this.state.container.append($element);
            }

            // إضافة إلى المصفوفة
            this.state.notifications.push(notification);

            // تشغيل الحركة
            this.animateIn($element);

            // تشغيل الصوت
            if (notification.sound && this.settings.enableSound) {
                this.playSound(notification.sound);
            }

            // بدء العداد التلقائي
            if (notification.autoClose) {
                this.startAutoClose(notification);
            }

            // إرسال إشعار النظام
            if (options.systemNotification && 'Notification' in window && Notification.permission === 'granted') {
                this.showSystemNotification(notification);
            }

            // حفظ في التخزين المحلي للإشعارات المستمرة
            if (notification.persistent) {
                this.savePersistentNotification(notification);
            }

            // إرسال حدث مخصص
            $(document).trigger('muhtawaa:notification:show', [notification]);

            return notification.id;
        },

        // إنشاء عنصر DOM للإشعار
        createNotificationElement: function(notification) {
            let html = `<div class="notification notification-${notification.type}" data-id="${notification.id}">`;

            // شريط التقدم
            if (this.settings.showProgressBar && notification.autoClose) {
                html += '<div class="notification-progress"><div class="notification-progress-bar"></div></div>';
            }

            html += '<div class="notification-content">';

            // الأيقونة
            html += `<div class="notification-icon" style="color: ${notification.color}">
                <i class="${notification.icon}"></i>
            </div>`;

            html += '<div class="notification-body">';

            // العنوان
            if (notification.title) {
                html += `<div class="notification-title">${notification.title}</div>`;
            }

            // الرسالة
            html += `<div class="notification-message">${notification.message}</div>`;

            // الإجراءات
            if (notification.actions && notification.actions.length > 0) {
                html += '<div class="notification-actions">';
                notification.actions.forEach(action => {
                    html += `<button class="notification-action" data-action="${action.id}" data-notification-id="${notification.id}">
                        ${action.text}
                    </button>`;
                });
                html += '</div>';
            }

            html += '</div>'; // notification-body

            // زر الإغلاق
            html += `<button class="notification-close" data-notification-id="${notification.id}" aria-label="إغلاق الإشعار">
                <i class="fas fa-times"></i>
            </button>`;

            html += '</div>'; // notification-content
            html += '</div>'; // notification

            return $(html);
        },

        // تحريك الإشعار عند الظهور
        animateIn: function($element) {
            $element.addClass('notification-enter');
            
            setTimeout(() => {
                $element.addClass('notification-enter-active').removeClass('notification-enter');
            }, 10);
        },

        // تحريك الإشعار عند الاختفاء
        animateOut: function($element, callback) {
            $element.addClass('notification-exit');
            
            setTimeout(() => {
                $element.addClass('notification-exit-active');
                
                setTimeout(() => {
                    if (callback) callback();
                }, this.settings.animationDuration);
            }, 10);
        },

        // بدء العداد التلقائي
        startAutoClose: function(notification) {
            if (!notification.autoClose || notification.persistent) {
                return;
            }

            const startTime = Date.now();
            const duration = notification.autoCloseDelay;

            notification.autoCloseTimer = setInterval(() => {
                if (notification.isPaused) {
                    return;
                }

                const elapsed = Date.now() - startTime;
                const progress = Math.max(0, 100 - (elapsed / duration) * 100);
                
                notification.progress = progress;
                this.updateProgressBar(notification);

                if (elapsed >= duration) {
                    this.hide(notification.id);
                }
            }, 50);
        },

        // إيقاف العداد التلقائي مؤقتاً
        pauseAutoClose: function(e) {
            const id = $(e.currentTarget).data('id');
            const notification = this.findNotification(id);
            
            if (notification && notification.autoCloseTimer) {
                notification.isPaused = true;
            }
        },

        // استئناف العداد التلقائي
        resumeAutoClose: function(e) {
            const id = $(e.currentTarget).data('id');
            const notification = this.findNotification(id);
            
            if (notification && notification.autoCloseTimer) {
                notification.isPaused = false;
            }
        },

        // تحديث شريط التقدم
        updateProgressBar: function(notification) {
            if (!this.settings.showProgressBar || !notification.element) {
                return;
            }

            const $progressBar = notification.element.find('.notification-progress-bar');
            $progressBar.css('width', notification.progress + '%');
        },

        // إخفاء إشعار
        hide: function(id) {
            const notification = this.findNotification(id);
            
            if (!notification) {
                return;
            }

            // إيقاف العداد
            if (notification.autoCloseTimer) {
                clearInterval(notification.autoCloseTimer);
            }

            // تشغيل حركة الاختفاء
            this.animateOut(notification.element, () => {
                // إزالة من DOM
                notification.element.remove();
                
                // إزالة من المصفوفة
                this.state.notifications = this.state.notifications.filter(n => n.id !== id);
                
                // إزالة من التخزين المحلي
                this.removePersistentNotification(id);
                
                // استدعاء callback الإغلاق
                if (notification.onClose) {
                    notification.onClose(notification);
                }
                
                // إرسال حدث مخصص
                $(document).trigger('muhtawaa:notification:hide', [notification]);
            });
        },

        // إخفاء جميع الإشعارات
        hideAll: function() {
            this.state.notifications.forEach(notification => {
                this.hide(notification.id);
            });
        },

        // العثور على إشعار
        findNotification: function(id) {
            return this.state.notifications.find(n => n.id === id);
        },

        // تحديد عدد الإشعارات
        limitNotifications: function() {
            while (this.state.notifications.length >= this.settings.maxNotifications) {
                const oldest = this.state.notifications[0];
                if (!oldest.persistent) {
                    this.hide(oldest.id);
                } else {
                    break;
                }
            }
        },

        // إدارة النقر على الإشعار
        handleNotificationClick: function(e) {
            if ($(e.target).closest('.notification-close, .notification-action').length) {
                return;
            }

            const id = $(e.currentTarget).data('id');
            const notification = this.findNotification(id);
            
            if (notification && notification.onClick) {
                notification.onClick(notification, e);
            }
        },

        // إدارة النقر على زر الإغلاق
        handleCloseClick: function(e) {
            e.stopPropagation();
            const id = $(e.currentTarget).data('notification-id');
            this.hide(id);
        },

        // إدارة النقر على الإجراءات
        handleActionClick: function(e) {
            e.stopPropagation();
            
            const actionId = $(e.currentTarget).data('action');
            const notificationId = $(e.currentTarget).data('notification-id');
            const notification = this.findNotification(notificationId);
            
            if (notification) {
                const action = notification.actions.find(a => a.id === actionId);
                if (action && action.callback) {
                    action.callback(notification, actionId);
                }
                
                // إخفاء الإشعار بعد تنفيذ الإجراء (اختياري)
                if (action.closeAfter !== false) {
                    this.hide(notificationId);
                }
            }
        },

        // إدارة أحداث لوحة المفاتيح
        handleKeyboard: function(e) {
            // Escape لإغلاق جميع الإشعارات
            if (e.key === 'Escape') {
                this.hideAll();
            }
        },

        // إدارة تغيير رؤية الصفحة
        handleVisibilityChange: function() {
            if (document.hidden && this.state.notifications.length > 0) {
                // إرسال إشعار نظام عندما تكون الصفحة مخفية
                const unreadCount = this.state.notifications.length;
                this.showSystemNotification({
                    title: 'إشعارات جديدة',
                    message: `لديك ${unreadCount} إشعار جديد`,
                    icon: '/wp-content/themes/muhtawaa/assets/images/icon-192x192.png'
                });
            }
        },

        // إدارة الإشعارات المجمعة
        handleGroupedNotification: function(notification, group) {
            if (!this.state.groupedNotifications[group]) {
                this.state.groupedNotifications[group] = {
                    count: 0,
                    notifications: [],
                    element: null
                };
            }

            const groupData = this.state.groupedNotifications[group];
            groupData.count++;
            groupData.notifications.push(notification);

            if (groupData.element) {
                // تحديث الإشعار المجمع الموجود
                this.updateGroupedNotification(group);
            } else {
                // إنشاء إشعار مجمع جديد
                this.createGroupedNotification(group);
            }

            return notification.id;
        },

        // إنشاء إشعار مجمع
        createGroupedNotification: function(group) {
            const groupData = this.state.groupedNotifications[group];
            const firstNotification = groupData.notifications[0];
            
            const groupedNotification = {
                ...firstNotification,
                id: `group_${group}`,
                message: `${groupData.count} إشعار جديد`,
                isGrouped: true,
                group: group
            };

            const $element = this.createNotificationElement(groupedNotification);
            groupData.element = $element;

            // إضافة معالج النقر للتوسيع
            $element.on('click', () => {
                this.expandGroupedNotification(group);
            });

            this.displayGroupedElement($element);
        },

        // تحديث الإشعار المجمع
        updateGroupedNotification: function(group) {
            const groupData = this.state.groupedNotifications[group];
            const $message = groupData.element.find('.notification-message');
            $message.text(`${groupData.count} إشعار جديد`);

            // إضافة تأثير تحديث
            groupData.element.addClass('notification-updated');
            setTimeout(() => {
                groupData.element.removeClass('notification-updated');
            }, 300);
        },

        // توسيع الإشعارات المجمعة
        expandGroupedNotification: function(group) {
            const groupData = this.state.groupedNotifications[group];
            
            // إخفاء الإشعار المجمع
            groupData.element.remove();
            
            // عرض جميع الإشعارات الفردية
            groupData.notifications.forEach(notification => {
                this.displayNotification(notification);
            });
            
            // مسح البيانات المجمعة
            delete this.state.groupedNotifications[group];
        },

        // تهيئة الصوت
        initializeAudio: function() {
            if (!this.settings.enableSound) {
                return;
            }

            try {
                this.state.audioContext = new (window.AudioContext || window.webkitAudioContext)();
                this.loadSounds();
            } catch (e) {
                console.warn('لا يمكن تهيئة الصوت:', e);
                this.settings.enableSound = false;
            }
        },

        // تحميل الأصوات
        loadSounds: function() {
            Object.keys(this.types).forEach(type => {
                const sound = this.types[type].sound;
                if (sound) {
                    this.loadSound(sound);
                }
            });
        },

        // تحميل صوت واحد
        loadSound: function(soundFile) {
            const audio = new Audio();
            audio.src = `${this.settings.soundUrl}/${soundFile}`;
            audio.preload = 'auto';
            
            // تخزين الصوت للاستخدام اللاحق
            this.sounds = this.sounds || {};
            this.sounds[soundFile] = audio;
        },

        // تشغيل الصوت
        playSound: function(soundFile) {
            if (!this.settings.enableSound || !this.sounds || !this.sounds[soundFile]) {
                return;
            }

            try {
                const audio = this.sounds[soundFile].cloneNode();
                audio.volume = 0.3;
                audio.play();
            } catch (e) {
                console.warn('لا يمكن تشغيل الصوت:', e);
            }
        },

        // إعداد إشعارات الويب
        setupWebNotifications: function() {
            if (!('Notification' in window)) {
                return;
            }

            // طلب الإذن إذا لم يكن ممنوحاً
            if (Notification.permission === 'default') {
                Notification.requestPermission();
            }
        },

        // عرض إشعار النظام
        showSystemNotification: function(notification) {
            if (!('Notification' in window) || Notification.permission !== 'granted') {
                return;
            }

            const systemNotification = new Notification(notification.title || 'إشعار جديد', {
                body: notification.message,
                icon: notification.icon || '/wp-content/themes/muhtawaa/assets/images/icon-192x192.png',
                tag: notification.id,
                data: notification.data,
                requireInteraction: notification.persistent,
                dir: this.settings.rtlSupport ? 'rtl' : 'ltr'
            });

            systemNotification.onclick = () => {
                window.focus();
                if (notification.onClick) {
                    notification.onClick(notification);
                }
                systemNotification.close();
            };

            // إغلاق تلقائي
            if (!notification.persistent) {
                setTimeout(() => {
                    systemNotification.close();
                }, notification.autoCloseDelay || this.settings.autoCloseDelay);
            }
        },

        // تهيئة Service Worker
        initializeServiceWorker: function() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('Service Worker registered successfully');
                        this.setupPushNotifications(registration);
                    })
                    .catch(error => {
                        console.warn('Service Worker registration failed:', error);
                    });
            }
        },

        // إعداد إشعارات الدفع
        setupPushNotifications: function(registration) {
            // هذا يتطلب إعداد خادم للدفع
            // يمكن تطويره لاحقاً حسب الحاجة
        },

        // حفظ الإشعارات المستمرة
        savePersistentNotification: function(notification) {
            if (!this.settings.enablePersistence) {
                return;
            }

            try {
                const saved = JSON.parse(localStorage.getItem('muhtawaa_notifications') || '[]');
                saved.push({
                    id: notification.id,
                    message: notification.message,
                    type: notification.type,
                    title: notification.title,
                    createdAt: notification.createdAt.toISOString()
                });
                
                localStorage.setItem('muhtawaa_notifications', JSON.stringify(saved));
            } catch (e) {
                console.warn('لا يمكن حفظ الإشعار:', e);
            }
        },

        // تحميل الإشعارات المستمرة
        loadPersistentNotifications: function() {
            if (!this.settings.enablePersistence) {
                return;
            }

            try {
                const saved = JSON.parse(localStorage.getItem('muhtawaa_notifications') || '[]');
                saved.forEach(data => {
                    // عرض الإشعارات المحفوظة (إذا كانت حديثة)
                    const createdAt = new Date(data.createdAt);
                    const now = new Date();
                    const daysDiff = (now - createdAt) / (1000 * 60 * 60 * 24);
                    
                    if (daysDiff < 7) { // الإشعارات الأحدث من أسبوع
                        this.show(data.message, data.type, {
                            title: data.title,
                            persistent: true,
                            autoClose: false
                        });
                    }
                });
            } catch (e) {
                console.warn('لا يمكن تحميل الإشعارات:', e);
            }
        },

        // إزالة إشعار مستمر
        removePersistentNotification: function(id) {
            if (!this.settings.enablePersistence) {
                return;
            }

            try {
                const saved = JSON.parse(localStorage.getItem('muhtawaa_notifications') || '[]');
                const filtered = saved.filter(notification => notification.id !== id);
                localStorage.setItem('muhtawaa_notifications', JSON.stringify(filtered));
            } catch (e) {
                console.warn('لا يمكن إزالة الإشعار:', e);
            }
        },

        // حقن الأنماط الأساسية
        injectStyles: function() {
            const styles = `
                <style id="muhtawaa-notifications-styles">
                    .notifications-container {
                        position: fixed;
                        z-index: 9999;
                        pointer-events: none;
                    }
                    
                    .notifications-top-right {
                        top: 20px;
                        right: 20px;
                    }
                    
                    .notifications-top-left {
                        top: 20px;
                        left: 20px;
                    }
                    
                    .notifications-bottom-right {
                        bottom: 20px;
                        right: 20px;
                    }
                    
                    .notifications-bottom-left {
                        bottom: 20px;
                        left: 20px;
                    }
                    
                    .notifications-top-center {
                        top: 20px;
                        left: 50%;
                        transform: translateX(-50%);
                    }
                    
                    .notifications-bottom-center {
                        bottom: 20px;
                        left: 50%;
                        transform: translateX(-50%);
                    }
                    
                    .notification {
                        pointer-events: auto;
                        margin-bottom: 10px;
                        max-width: 400px;
                        min-width: 300px;
                        background: white;
                        border-radius: 8px;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                        overflow: hidden;
                        cursor: pointer;
                        position: relative;
                    }
                    
                    .notification-enter {
                        opacity: 0;
                        transform: translateX(100%);
                    }
                    
                    .notification-enter-active {
                        opacity: 1;
                        transform: translateX(0);
                        transition: all 0.3s ease;
                    }
                    
                    .notification-exit {
                        opacity: 1;
                        transform: translateX(0);
                    }
                    
                    .notification-exit-active {
                        opacity: 0;
                        transform: translateX(100%);
                        transition: all 0.3s ease;
                    }
                    
                    .notification-progress {
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        height: 3px;
                        background: rgba(0,0,0,0.1);
                    }
                    
                    .notification-progress-bar {
                        height: 100%;
                        background: currentColor;
                        transition: width 0.1s ease;
                    }
                    
                    .notification-content {
                        display: flex;
                        align-items: flex-start;
                        padding: 16px;
                        gap: 12px;
                    }
                    
                    .notification-icon {
                        font-size: 20px;
                        flex-shrink: 0;
                        margin-top: 2px;
                    }
                    
                    .notification-body {
                        flex: 1;
                        min-width: 0;
                    }
                    
                    .notification-title {
                        font-weight: 600;
                        margin-bottom: 4px;
                        color: #1f2937;
                    }
                    
                    .notification-message {
                        color: #4b5563;
                        line-height: 1.5;
                    }
                    
                    .notification-actions {
                        margin-top: 12px;
                        display: flex;
                        gap: 8px;
                    }
                    
                    .notification-action {
                        padding: 6px 12px;
                        border: 1px solid #d1d5db;
                        background: white;
                        border-radius: 4px;
                        font-size: 14px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    }
                    
                    .notification-action:hover {
                        background: #f9fafb;
                    }
                    
                    .notification-close {
                        position: absolute;
                        top: 8px;
                        right: 8px;
                        background: none;
                        border: none;
                        color: #9ca3af;
                        cursor: pointer;
                        padding: 4px;
                        border-radius: 4px;
                        transition: color 0.2s ease;
                    }
                    
                    .notification-close:hover {
                        color: #6b7280;
                    }
                    
                    .notification-updated {
                        animation: notification-pulse 0.3s ease;
                    }
                    
                    @keyframes notification-pulse {
                        0%, 100% { transform: scale(1); }
                        50% { transform: scale(1.02); }
                    }
                </style>
            `;
            
            if (!$('#muhtawaa-notifications-styles').length) {
                $('head').append(styles);
            }
        },

        // دوال مساعدة سريعة
        success: function(message, options = {}) {
            return this.show(message, 'success', options);
        },

        error: function(message, options = {}) {
            return this.show(message, 'error', options);
        },

        warning: function(message, options = {}) {
            return this.show(message, 'warning', options);
        },

        info: function(message, options = {}) {
            return this.show(message, 'info', options);
        },

        loading: function(message, options = {}) {
            return this.show(message, 'loading', {
                ...options,
                autoClose: false,
                persistent: true
            });
        },

        // تنظيف النظام
        destroy: function() {
            // مسح جميع العدادات
            this.state.notifications.forEach(notification => {
                if (notification.autoCloseTimer) {
                    clearInterval(notification.autoCloseTimer);
                }
            });

            // إزالة الحاوي
            if (this.state.container) {
                this.state.container.remove();
            }

            // إزالة الأنماط
            $('#muhtawaa-notifications-styles').remove();

            // إزالة مستمعي الأحداث
            $(document).off('.muhtawaa-notifications');

            // إعادة تعيين الحالة
            this.state = {
                notifications: [],
                idCounter: 0,
                container: null,
                audioContext: null,
                isInitialized: false,
                groupedNotifications: {},
                persistentQueue: []
            };

            console.log('🧹 Muhtawaa Notifications destroyed');
        }
    };

    // API عامة للإشعارات
    window.MuhtawaaNotifications = {
        init: MuhtawaaNotifications.init.bind(MuhtawaaNotifications),
        show: MuhtawaaNotifications.show.bind(MuhtawaaNotifications),
        hide: MuhtawaaNotifications.hide.bind(MuhtawaaNotifications),
        hideAll: MuhtawaaNotifications.hideAll.bind(MuhtawaaNotifications),
        success: MuhtawaaNotifications.success.bind(MuhtawaaNotifications),
        error: MuhtawaaNotifications.error.bind(MuhtawaaNotifications),
        warning: MuhtawaaNotifications.warning.bind(MuhtawaaNotifications),
        info: MuhtawaaNotifications.info.bind(MuhtawaaNotifications),
        loading: MuhtawaaNotifications.loading.bind(MuhtawaaNotifications),
        destroy: MuhtawaaNotifications.destroy.bind(MuhtawaaNotifications),
        settings: MuhtawaaNotifications.settings
    };

    // تهيئة النظام عند جاهزية DOM
    $(document).ready(function() {
        MuhtawaaNotifications.init();
    });

})(jQuery);