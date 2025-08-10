/**
 * Practical Solutions Theme - Utility Functions
 * وظائف مساعدة عامة للقالب
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * وظائف مساعدة عامة للقالب
 * @namespace PracticalSolutionsUtils
 */
window.PracticalSolutionsUtils = (function() {
    
    /**
     * كتابة رسالة في الكونسول مع تنسيق مناسب
     * @param {string} message - الرسالة
     * @param {string} type - نوع الرسالة (log, warn, error)
     */
    function log(message, type = 'log') {
        if (window.console && typeof console[type] === 'function') {
            console[type](`[Practical Solutions] ${message}`);
        }
    }

    /**
     * التحقق من وجود عنصر في الصفحة
     * @param {string} selector - محدد العنصر
     * @returns {Element|null} العنصر أو null
     */
    function getElement(selector) {
        return document.querySelector(selector);
    }

    /**
     * التحقق من وجود عناصر متعددة في الصفحة
     * @param {string} selector - محدد العناصر
     * @returns {NodeList} قائمة العناصر
     */
    function getElements(selector) {
        return document.querySelectorAll(selector);
    }

    /**
     * إضافة مستمع حدث مع التحقق من وجود العنصر
     * @param {string} selector - محدد العنصر
     * @param {string} event - نوع الحدث
     * @param {Function} callback - الدالة المراد تنفيذها
     * @param {boolean} useCapture - استخدام capture أم لا
     */
    function addEventListenerSafe(selector, event, callback, useCapture = false) {
        const element = getElement(selector);
        if (element) {
            element.addEventListener(event, callback, useCapture);
            return true;
        }
        return false;
    }

    /**
     * إضافة مستمعي أحداث لعناصر متعددة
     * @param {string} selector - محدد العناصر
     * @param {string} event - نوع الحدث
     * @param {Function} callback - الدالة المراد تنفيذها
     */
    function addEventListenerMultiple(selector, event, callback) {
        const elements = getElements(selector);
        elements.forEach(element => {
            element.addEventListener(event, callback);
        });
    }

    /**
     * إزالة كلاس من عنصر مع التحقق
     * @param {Element} element - العنصر
     * @param {string} className - اسم الكلاس
     */
    function removeClass(element, className) {
        if (element && element.classList) {
            element.classList.remove(className);
        }
    }

    /**
     * إضافة كلاس لعنصر مع التحقق
     * @param {Element} element - العنصر
     * @param {string} className - اسم الكلاس
     */
    function addClass(element, className) {
        if (element && element.classList) {
            element.classList.add(className);
        }
    }

    /**
     * تبديل كلاس على عنصر
     * @param {Element} element - العنصر
     * @param {string} className - اسم الكلاس
     */
    function toggleClass(element, className) {
        if (element && element.classList) {
            element.classList.toggle(className);
        }
    }

    /**
     * التحقق من وجود كلاس في عنصر
     * @param {Element} element - العنصر
     * @param {string} className - اسم الكلاس
     * @returns {boolean}
     */
    function hasClass(element, className) {
        return element && element.classList && element.classList.contains(className);
    }

    /**
     * عرض أو إخفاء عنصر
     * @param {Element} element - العنصر
     * @param {boolean} show - عرض أم إخفاء
     */
    function toggleDisplay(element, show) {
        if (element) {
            element.style.display = show ? 'block' : 'none';
        }
    }

    /**
     * تأخير تنفيذ دالة (debounce)
     * @param {Function} func - الدالة
     * @param {number} wait - وقت التأخير بالميلي ثانية
     * @param {boolean} immediate - تنفيذ فوري أم لا
     * @returns {Function}
     */
    function debounce(func, wait, immediate = false) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func(...args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func(...args);
        };
    }

    /**
     * تحديد تنفيذ دالة (throttle)
     * @param {Function} func - الدالة
     * @param {number} limit - الحد الأقصى للوقت بالميلي ثانية
     * @returns {Function}
     */
    function throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    /**
     * تنظيف النص من HTML tags
     * @param {string} str - النص
     * @returns {string}
     */
    function stripHtml(str) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = str;
        return tempDiv.textContent || tempDiv.innerText || '';
    }

    /**
     * تقصير النص مع إضافة نقاط
     * @param {string} str - النص
     * @param {number} length - الطول المطلوب
     * @returns {string}
     */
    function truncateText(str, length = 100) {
        if (str.length <= length) return str;
        return str.substr(0, length) + '...';
    }

    /**
     * تحويل النص الأول لحرف كبير
     * @param {string} str - النص
     * @returns {string}
     */
    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    /**
     * إرسال طلب AJAX
     * @param {Object} options - خيارات الطلب
     * @returns {Promise}
     */
    function ajaxRequest(options) {
        const defaults = {
            method: 'POST',
            url: window.practicalSolutions?.ajaxUrl || '/wp-admin/admin-ajax.php',
            data: {},
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            timeout: 30000
        };

        const config = Object.assign({}, defaults, options);

        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            
            xhr.timeout = config.timeout;
            xhr.open(config.method, config.url, true);

            // إعداد headers
            Object.keys(config.headers).forEach(key => {
                xhr.setRequestHeader(key, config.headers[key]);
            });

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            resolve(response);
                        } catch (e) {
                            resolve(xhr.responseText);
                        }
                    } else {
                        reject(new Error(`HTTP ${xhr.status}: ${xhr.statusText}`));
                    }
                }
            };

            xhr.ontimeout = () => reject(new Error('طلب انتهت مهلته الزمنية'));
            xhr.onerror = () => reject(new Error('حدث خطأ في الشبكة'));

            // إعداد البيانات
            let requestData = '';
            if (config.data) {
                if (typeof config.data === 'object') {
                    const formData = new FormData();
                    Object.keys(config.data).forEach(key => {
                        formData.append(key, config.data[key]);
                    });
                    requestData = new URLSearchParams(formData).toString();
                } else {
                    requestData = config.data;
                }
            }

            xhr.send(requestData);
        });
    }

    /**
     * حفظ بيانات في Local Storage مع التحقق من الدعم
     * @param {string} key - المفتاح
     * @param {*} value - القيمة
     * @returns {boolean}
     */
    function setLocalStorage(key, value) {
        try {
            if (typeof Storage !== 'undefined') {
                localStorage.setItem(key, JSON.stringify(value));
                return true;
            }
        } catch (e) {
            log('خطأ في حفظ البيانات محلياً: ' + e.message, 'warn');
        }
        return false;
    }

    /**
     * استرجاع بيانات من Local Storage
     * @param {string} key - المفتاح
     * @param {*} defaultValue - القيمة الافتراضية
     * @returns {*}
     */
    function getLocalStorage(key, defaultValue = null) {
        try {
            if (typeof Storage !== 'undefined') {
                const item = localStorage.getItem(key);
                return item ? JSON.parse(item) : defaultValue;
            }
        } catch (e) {
            log('خطأ في استرجاع البيانات محلياً: ' + e.message, 'warn');
        }
        return defaultValue;
    }

    /**
     * حذف بيانات من Local Storage
     * @param {string} key - المفتاح
     */
    function removeLocalStorage(key) {
        try {
            if (typeof Storage !== 'undefined') {
                localStorage.removeItem(key);
            }
        } catch (e) {
            log('خطأ في حذف البيانات محلياً: ' + e.message, 'warn');
        }
    }

    /**
     * التحقق من أن الجهاز محمول
     * @returns {boolean}
     */
    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    /**
     * التحقق من أن المتصفح يدعم ميزة معينة
     * @param {string} feature - اسم الميزة
     * @returns {boolean}
     */
    function supportsFeature(feature) {
        switch (feature) {
            case 'speechRecognition':
                return 'webkitSpeechRecognition' in window || 'SpeechRecognition' in window;
            case 'localStorage':
                return typeof Storage !== 'undefined';
            case 'intersectionObserver':
                return 'IntersectionObserver' in window;
            case 'serviceWorker':
                return 'serviceWorker' in navigator;
            default:
                return feature in window;
        }
    }

    /**
     * إنشاء عنصر HTML
     * @param {string} tag - نوع العنصر
     * @param {Object} attributes - الخصائص
     * @param {string} content - المحتوى
     * @returns {Element}
     */
    function createElement(tag, attributes = {}, content = '') {
        const element = document.createElement(tag);
        
        Object.keys(attributes).forEach(key => {
            if (key === 'className') {
                element.className = attributes[key];
            } else if (key === 'innerHTML') {
                element.innerHTML = attributes[key];
            } else {
                element.setAttribute(key, attributes[key]);
            }
        });

        if (content) {
            element.innerHTML = content;
        }

        return element;
    }

    /**
     * إظهار رسالة تنبيه مؤقتة
     * @param {string} message - الرسالة
     * @param {string} type - نوع الرسالة (success, error, info, warning)
     * @param {number} duration - مدة العرض بالميلي ثانية
     */
    function showNotification(message, type = 'info', duration = 5000) {
        // إزالة التنبيهات السابقة
        const existingNotifications = getElements('.ps-notification');
        existingNotifications.forEach(notification => {
            notification.remove();
        });

        const notification = createElement('div', {
            className: `ps-notification ps-notification--${type}`,
            innerHTML: `
                <div class="ps-notification__content">
                    <span class="ps-notification__message">${message}</span>
                    <button class="ps-notification__close" aria-label="إغلاق">×</button>
                </div>
            `
        });

        // إضافة أنماط inline
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : type === 'warning' ? '#f39c12' : '#007cba'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            font-family: inherit;
            max-width: 400px;
            animation: slideInRight 0.3s ease-out;
        `;

        document.body.appendChild(notification);

        // إضافة مستمع لزر الإغلاق
        const closeBtn = notification.querySelector('.ps-notification__close');
        closeBtn.addEventListener('click', () => {
            notification.remove();
        });

        // إزالة تلقائية بعد المدة المحددة
        if (duration > 0) {
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, duration);
        }
    }

    /**
     * تمرير لطيف لعنصر معين
     * @param {Element|string} target - العنصر أو المحدد
     * @param {number} duration - مدة التمرير بالميلي ثانية
     * @param {number} offset - إزاحة إضافية
     */
    function smoothScrollTo(target, duration = 800, offset = 0) {
        const targetElement = typeof target === 'string' ? getElement(target) : target;
        
        if (!targetElement) return;

        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = ease(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }

    // إرجاع الوظائف العامة
    return {
        log,
        getElement,
        getElements,
        addEventListenerSafe,
        addEventListenerMultiple,
        removeClass,
        addClass,
        toggleClass,
        hasClass,
        toggleDisplay,
        debounce,
        throttle,
        stripHtml,
        truncateText,
        capitalize,
        ajaxRequest,
        setLocalStorage,
        getLocalStorage,
        removeLocalStorage,
        isMobile,
        supportsFeature,
        createElement,
        showNotification,
        smoothScrollTo
    };

})();