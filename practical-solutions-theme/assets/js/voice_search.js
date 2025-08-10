/**
 * Practical Solutions Theme - Voice Search System
 * نظام البحث الصوتي
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * كلاس نظام البحث الصوتي
 * @class VoiceSearch
 */
window.VoiceSearch = (function() {
    
    // المتغيرات الخاصة
    let instance = null;
    let recognition = null;
    let voiceButton = null;
    let searchInput = null;
    let statusIndicator = null;
    let isListening = false;
    let isSupported = false;
    let currentLanguage = 'ar-SA';
    let recognitionTimeout = null;
    let retryCount = 0;
    let maxRetries = 3;

    // إعدادات افتراضية
    const defaults = {
        language: 'ar-SA',
        continuous: false,
        interimResults: true,
        maxAlternatives: 1,
        timeout: 10000,
        autoSubmit: false,
        showVisualFeedback: true,
        enableHapticFeedback: true
    };

    let settings = {};

    // النصوص والترجمات
    const messages = {
        'ar': {
            'start_listening': 'ابدأ الحديث الآن...',
            'listening': 'أستمع...',
            'processing': 'جاري المعالجة...',
            'error_no_speech': 'لم يتم الكشف عن صوت، يرجى المحاولة مرة أخرى',
            'error_no_microphone': 'الميكروفون غير متاح أو مرفوض الوصول إليه',
            'error_not_supported': 'البحث الصوتي غير مدعوم في متصفحك',
            'error_network': 'خطأ في الشبكة، تحقق من اتصالك بالإنترنت',
            'error_permission_denied': 'تم رفض إذن الوصول للميكروفون',
            'error_timeout': 'انتهت مهلة التسجيل، يرجى المحاولة مرة أخرى',
            'try_again': 'حاول مرة أخرى',
            'voice_search_tip': 'اضغط واستمر للبحث الصوتي'
        },
        'en': {
            'start_listening': 'Start speaking now...',
            'listening': 'Listening...',
            'processing': 'Processing...',
            'error_no_speech': 'No speech detected, please try again',
            'error_no_microphone': 'Microphone not available or access denied',
            'error_not_supported': 'Voice search is not supported in your browser',
            'error_network': 'Network error, check your internet connection',
            'error_permission_denied': 'Microphone access permission denied',
            'error_timeout': 'Recording timeout, please try again',
            'try_again': 'Try again',
            'voice_search_tip': 'Press and hold for voice search'
        }
    };

    /**
     * تهيئة نظام البحث الصوتي
     * @param {Object} options - الخيارات
     */
    function init(options = {}) {
        if (instance) {
            PracticalSolutionsUtils.log('نظام البحث الصوتي مهيأ مسبقاً', 'warn');
            return instance;
        }

        settings = Object.assign({}, defaults, options);
        
        // التحقق من دعم البحث الصوتي
        checkBrowserSupport();
        
        if (!isSupported) {
            PracticalSolutionsUtils.log('البحث الصوتي غير مدعوم', 'warn');
            disableVoiceSearch();
            return null;
        }

        // البحث عن العناصر المطلوبة
        findElements();
        
        if (!voiceButton) {
            PracticalSolutionsUtils.log('زر البحث الصوتي غير موجود', 'warn');
            return null;
        }

        // إعداد نظام التعرف على الصوت
        setupRecognition();
        
        // ربط الأحداث
        bindEvents();
        
        // إعداد العناصر البصرية
        setupVisualElements();
        
        PracticalSolutionsUtils.log('تم تهيئة البحث الصوتي بنجاح');
        
        instance = {
            startListening: startListening,
            stopListening: stopListening,
            toggle: toggleListening,
            isListening: () => isListening,
            isSupported: () => isSupported,
            setLanguage: setLanguage,
            destroy: destroy
        };

        return instance;
    }

    /**
     * التحقق من دعم المتصفح للبحث الصوتي
     */
    function checkBrowserSupport() {
        isSupported = PracticalSolutionsUtils.supportsFeature('speechRecognition');
        
        if (isSupported) {
            // التحقق من اللغة المفضلة
            const browserLang = navigator.language || navigator.userLanguage;
            if (browserLang.startsWith('ar')) {
                currentLanguage = 'ar-SA';
            } else {
                currentLanguage = 'en-US';
            }
        }
    }

    /**
     * البحث عن العناصر في الصفحة
     */
    function findElements() {
        voiceButton = PracticalSolutionsUtils.getElement('.voice-search-btn') ||
                     PracticalSolutionsUtils.getElement('.voice-search-mini-btn');
        
        searchInput = PracticalSolutionsUtils.getElement('.search-field') ||
                     PracticalSolutionsUtils.getElement('.header-search-field');

        // إنشاء مؤشر الحالة إذا لم يكن موجود
        if (!statusIndicator && voiceButton) {
            statusIndicator = PracticalSolutionsUtils.createElement('div', {
                className: 'voice-status-indicator',
                'aria-live': 'polite',
                'aria-atomic': 'true'
            });
            
            voiceButton.parentNode.appendChild(statusIndicator);
        }
    }

    /**
     * إعداد نظام التعرف على الصوت
     */
    function setupRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (!SpeechRecognition) {
            isSupported = false;
            return;
        }

        recognition = new SpeechRecognition();
        
        // إعداد الخصائص
        recognition.lang = currentLanguage;
        recognition.continuous = settings.continuous;
        recognition.interimResults = settings.interimResults;
        recognition.maxAlternatives = settings.maxAlternatives;

        // ربط أحداث التعرف على الصوت
        recognition.onstart = handleRecognitionStart;
        recognition.onresult = handleRecognitionResult;
        recognition.onend = handleRecognitionEnd;
        recognition.onerror = handleRecognitionError;
        recognition.onspeechstart = handleSpeechStart;
        recognition.onspeechend = handleSpeechEnd;
        recognition.onnomatch = handleNoMatch;
    }

    /**
     * ربط الأحداث
     */
    function bindEvents() {
        if (!voiceButton) return;

        // أحداث زر البحث الصوتي
        voiceButton.addEventListener('click', handleVoiceButtonClick);
        voiceButton.addEventListener('mousedown', handleVoiceButtonMouseDown);
        voiceButton.addEventListener('mouseup', handleVoiceButtonMouseUp);
        voiceButton.addEventListener('touchstart', handleVoiceButtonTouchStart, { passive: false });
        voiceButton.addEventListener('touchend', handleVoiceButtonTouchEnd, { passive: false });
        voiceButton.addEventListener('mouseleave', handleVoiceButtonMouseLeave);

        // أحداث لوحة المفاتيح
        voiceButton.addEventListener('keydown', handleVoiceButtonKeydown);

        // أحداث عامة
        document.addEventListener('visibilitychange', handleVisibilityChange);
        window.addEventListener('beforeunload', stopListening);
    }

    /**
     * إعداد العناصر البصرية
     */
    function setupVisualElements() {
        if (!voiceButton) return;

        // إضافة tooltip
        voiceButton.setAttribute('title', getMessage('voice_search_tip'));
        voiceButton.setAttribute('aria-label', getMessage('voice_search_tip'));

        // إضافة أنماط CSS
        addVoiceSearchStyles();
    }

    /**
     * معالجة النقر على زر البحث الصوتي
     * @param {Event} event - حدث النقر
     */
    function handleVoiceButtonClick(event) {
        event.preventDefault();
        event.stopPropagation();
        
        if (!isSupported) {
            showError('error_not_supported');
            return;
        }

        toggleListening();
    }

    /**
     * معالجة الضغط على زر الفأرة
     * @param {Event} event - حدث الضغط
     */
    function handleVoiceButtonMouseDown(event) {
        if (event.button === 0) { // زر الفأرة الأيسر فقط
            startLongPressListening();
        }
    }

    /**
     * معالجة رفع زر الفأرة
     * @param {Event} event - حدث الرفع
     */
    function handleVoiceButtonMouseUp(event) {
        if (event.button === 0) {
            stopLongPressListening();
        }
    }

    /**
     * معالجة اللمس
     * @param {Event} event - حدث اللمس
     */
    function handleVoiceButtonTouchStart(event) {
        event.preventDefault();
        startLongPressListening();
        
        // اهتزاز تكتيكي إذا كان مدعوم
        if (settings.enableHapticFeedback && navigator.vibrate) {
            navigator.vibrate(50);
        }
    }

    /**
     * معالجة انتهاء اللمس
     * @param {Event} event - حدث انتهاء اللمس
     */
    function handleVoiceButtonTouchEnd(event) {
        event.preventDefault();
        stopLongPressListening();
    }

    /**
     * معالجة مغادرة المؤشر للزر
     */
    function handleVoiceButtonMouseLeave() {
        stopLongPressListening();
    }

    /**
     * معالجة أحداث لوحة المفاتيح
     * @param {Event} event - حدث لوحة المفاتيح
     */
    function handleVoiceButtonKeydown(event) {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            toggleListening();
        }
    }

    /**
     * بدء الاستماع بالضغط الطويل
     */
    function startLongPressListening() {
        if (isListening) return;
        
        recognitionTimeout = setTimeout(() => {
            startListening();
        }, 200); // تأخير قصير لتجنب التشغيل العرضي
    }

    /**
     * إيقاف الاستماع بالضغط الطويل
     */
    function stopLongPressListening() {
        if (recognitionTimeout) {
            clearTimeout(recognitionTimeout);
            recognitionTimeout = null;
        }
        
        if (isListening) {
            stopListening();
        }
    }

    /**
     * تبديل حالة الاستماع
     */
    function toggleListening() {
        if (isListening) {
            stopListening();
        } else {
            startListening();
        }
    }

    /**
     * بدء الاستماع
     */
    function startListening() {
        if (!isSupported || !recognition || isListening) return;

        try {
            // إعادة تعيين عداد المحاولات
            retryCount = 0;
            
            // بدء التعرف على الصوت
            recognition.start();
            
            PracticalSolutionsUtils.log('بدء البحث الصوتي');
            
        } catch (error) {
            PracticalSolutionsUtils.log('خطأ في بدء البحث الصوتي: ' + error.message, 'error');
            showError('error_no_microphone');
        }
    }

    /**
     * إيقاف الاستماع
     */
    function stopListening() {
        if (!recognition || !isListening) return;

        try {
            recognition.stop();
            PracticalSolutionsUtils.log('تم إيقاف البحث الصوتي');
        } catch (error) {
            PracticalSolutionsUtils.log('خطأ في إيقاف البحث الصوتي: ' + error.message, 'error');
        }
    }

    /**
     * معالجة بدء التعرف على الصوت
     */
    function handleRecognitionStart() {
        isListening = true;
        
        // تحديث واجهة المستخدم
        updateVoiceButtonState('listening');
        showStatus('start_listening', 'listening');
        
        // تعيين مهلة زمنية للأمان
        recognitionTimeout = setTimeout(() => {
            if (isListening) {
                stopListening();
                showError('error_timeout');
            }
        }, settings.timeout);
        
        PracticalSolutionsUtils.log('بدء الاستماع');
    }

    /**
     * معالجة نتائج التعرف على الصوت
     * @param {Event} event - حدث النتائج
     */
    function handleRecognitionResult(event) {
        let finalTranscript = '';
        let interimTranscript = '';

        // معالجة النتائج
        for (let i = event.resultIndex; i < event.results.length; i++) {
            const transcript = event.results[i][0].transcript;
            
            if (event.results[i].isFinal) {
                finalTranscript += transcript;
            } else {
                interimTranscript += transcript;
            }
        }

        // تحديث حقل البحث
        if (searchInput) {
            if (finalTranscript) {
                searchInput.value = finalTranscript.trim();
                
                // تشغيل حدث input لتحديث الاقتراحات
                const inputEvent = new Event('input', { bubbles: true });
                searchInput.dispatchEvent(inputEvent);
                
                PracticalSolutionsUtils.log('تم التعرف على النص: ' + finalTranscript);
                
                // الإرسال التلقائي إذا كان مفعل
                if (settings.autoSubmit) {
                    submitSearch(finalTranscript.trim());
                }
                
            } else if (interimTranscript && settings.interimResults) {
                // عرض النص المؤقت
                showStatus(interimTranscript, 'interim');
            }
        }
    }

    /**
     * معالجة انتهاء التعرف على الصوت
     */
    function handleRecognitionEnd() {
        isListening = false;
        
        // مسح المهلة الزمنية
        if (recognitionTimeout) {
            clearTimeout(recognitionTimeout);
            recognitionTimeout = null;
        }
        
        // تحديث واجهة المستخدم
        updateVoiceButtonState('idle');
        hideStatus();
        
        PracticalSolutionsUtils.log('انتهاء الاستماع');
    }

    /**
     * معالجة أخطاء التعرف على الصوت
     * @param {Event} event - حدث الخطأ
     */
    function handleRecognitionError(event) {
        isListening = false;
        
        // مسح المهلة الزمنية
        if (recognitionTimeout) {
            clearTimeout(recognitionTimeout);
            recognitionTimeout = null;
        }
        
        let errorMessage = 'error_network';
        
        switch (event.error) {
            case 'no-speech':
                errorMessage = 'error_no_speech';
                break;
            case 'audio-capture':
                errorMessage = 'error_no_microphone';
                break;
            case 'not-allowed':
                errorMessage = 'error_permission_denied';
                break;
            case 'network':
                errorMessage = 'error_network';
                break;
            case 'aborted':
                // تم الإلغاء بواسطة المستخدم، لا تعرض خطأ
                updateVoiceButtonState('idle');
                hideStatus();
                return;
        }
        
        PracticalSolutionsUtils.log('خطأ في البحث الصوتي: ' + event.error, 'error');
        
        // محاولة إعادة المحاولة في حالة بعض الأخطاء
        if (shouldRetry(event.error)) {
            retryRecognition();
        } else {
            showError(errorMessage);
            updateVoiceButtonState('error');
        }
    }

    /**
     * معالجة بدء الكلام
     */
    function handleSpeechStart() {
        showStatus('listening', 'listening');
        updateVoiceButtonState('active');
    }

    /**
     * معالجة انتهاء الكلام
     */
    function handleSpeechEnd() {
        showStatus('processing', 'processing');
        updateVoiceButtonState('processing');
    }

    /**
     * معالجة عدم التطابق
     */
    function handleNoMatch() {
        showError('error_no_speech');
    }

    /**
     * معالجة تغيير رؤية الصفحة
     */
    function handleVisibilityChange() {
        if (document.visibilityState === 'hidden' && isListening) {
            stopListening();
        }
    }

    /**
     * تحديد ما إذا كان يجب إعادة المحاولة
     * @param {string} error - نوع الخطأ
     * @returns {boolean}
     */
    function shouldRetry(error) {
        return retryCount < maxRetries && 
               (error === 'network' || error === 'no-speech') &&
               navigator.onLine;
    }

    /**
     * إعادة محاولة التعرف على الصوت
     */
    function retryRecognition() {
        retryCount++;
        
        setTimeout(() => {
            if (!isListening) {
                PracticalSolutionsUtils.log(`إعادة المحاولة ${retryCount}/${maxRetries}`);
                startListening();
            }
        }, 1000);
    }

    /**
     * إرسال البحث
     * @param {string} query - نص البحث
     */
    function submitSearch(query) {
        if (!query.trim()) return;

        // إيقاف الاستماع أولاً
        stopListening();
        
        // التحقق من وجود نظام البحث المتقدم
        if (window.AdvancedSearch && window.AdvancedSearch.search) {
            window.AdvancedSearch.search(query);
        } else {
            // الإرسال التقليدي
            const searchForm = PracticalSolutionsUtils.getElement('.search-form');
            if (searchForm) {
                searchForm.submit();
            }
        }
    }

    /**
     * تحديث حالة زر البحث الصوتي
     * @param {string} state - الحالة (idle, listening, active, processing, error)
     */
    function updateVoiceButtonState(state) {
        if (!voiceButton) return;

        // إزالة جميع الكلاسات السابقة
        const stateClasses = ['recording', 'listening', 'active', 'processing', 'error'];
        stateClasses.forEach(cls => {
            PracticalSolutionsUtils.removeClass(voiceButton, cls);
        });

        // إضافة الكلاس الجديد
        if (state !== 'idle') {
            PracticalSolutionsUtils.addClass(voiceButton, state);
        }

        // تحديث aria-label
        let ariaLabel = getMessage('voice_search_tip');
        if (state === 'listening') {
            ariaLabel = getMessage('listening');
        } else if (state === 'processing') {
            ariaLabel = getMessage('processing');
        }
        
        voiceButton.setAttribute('aria-label', ariaLabel);
    }

    /**
     * عرض حالة البحث الصوتي
     * @param {string} message - الرسالة
     * @param {string} type - نوع الحالة
     */
    function showStatus(message, type = 'info') {
        if (!statusIndicator) return;

        const displayMessage = message.startsWith('error_') || 
                              message.startsWith('start_') || 
                              message.startsWith('listening') || 
                              message.startsWith('processing') ? 
                              getMessage(message) : message;

        statusIndicator.innerHTML = `
            <div class="voice-status-content voice-status--${type}">
                ${type === 'listening' ? '<div class="voice-animation">' + createVoiceAnimation() + '</div>' : ''}
                <span class="voice-status-text">${displayMessage}</span>
            </div>
        `;

        PracticalSolutionsUtils.addClass(statusIndicator, 'active');
        statusIndicator.setAttribute('aria-hidden', 'false');
    }

    /**
     * إخفاء حالة البحث الصوتي
     */
    function hideStatus() {
        if (!statusIndicator) return;

        PracticalSolutionsUtils.removeClass(statusIndicator, 'active');
        statusIndicator.setAttribute('aria-hidden', 'true');
        
        setTimeout(() => {
            statusIndicator.innerHTML = '';
        }, 300);
    }

    /**
     * عرض رسالة خطأ
     * @param {string} errorKey - مفتاح الخطأ
     */
    function showError(errorKey) {
        const errorMessage = getMessage(errorKey);
        
        showStatus(errorMessage, 'error');
        updateVoiceButtonState('error');
        
        // إخفاء الخطأ بعد فترة
        setTimeout(() => {
            hideStatus();
            updateVoiceButtonState('idle');
        }, 4000);
        
        // عرض إشعار للمستخدم
        PracticalSolutionsUtils.showNotification(errorMessage, 'error', 4000);
    }

    /**
     * إنشاء رسوم متحركة للصوت
     * @returns {string}
     */
    function createVoiceAnimation() {
        const bars = [];
        for (let i = 0; i < 5; i++) {
            bars.push(`<div class="voice-bar" style="animation-delay: ${i * 0.1}s"></div>`);
        }
        return bars.join('');
    }

    /**
     * تعيين اللغة
     * @param {string} language - كود اللغة
     */
    function setLanguage(language) {
        currentLanguage = language;
        
        if (recognition) {
            recognition.lang = language;
        }
        
        PracticalSolutionsUtils.log(`تم تغيير لغة البحث الصوتي إلى: ${language}`);
    }

    /**
     * تعطيل البحث الصوتي
     */
    function disableVoiceSearch() {
        const voiceButtons = PracticalSolutionsUtils.getElements('.voice-search-btn, .voice-search-mini-btn');
        
        voiceButtons.forEach(button => {
            button.disabled = true;
            button.setAttribute('title', getMessage('error_not_supported'));
            PracticalSolutionsUtils.addClass(button, 'voice-search-disabled');
            
            // إضافة رسالة عدم الدعم
            button.addEventListener('click', (e) => {
                e.preventDefault();
                PracticalSolutionsUtils.showNotification(
                    getMessage('error_not_supported'),
                    'warning'
                );
            });
        });
    }

    /**
     * الحصول على رسالة مترجمة
     * @param {string} key - مفتاح الرسالة
     * @returns {string}
     */
    function getMessage(key) {
        const lang = currentLanguage.startsWith('ar') ? 'ar' : 'en';
        return messages[lang][key] || key;
    }

    /**
     * إضافة أنماط CSS للبحث الصوتي
     */
    function addVoiceSearchStyles() {
        if (document.getElementById('ps-voice-search-styles')) return;

        const styles = `
            .voice-search-btn.recording,
            .voice-search-btn.listening,
            .voice-search-btn.active {
                animation: voicePulse 1.5s ease-in-out infinite;
                color: #e74c3c !important;
            }

            .voice-search-btn.processing {
                animation: voiceSpin 1s linear infinite;
                color: #f39c12 !important;
            }

            .voice-search-btn.error {
                color: #e74c3c !important;
                animation: voiceShake 0.5s ease-in-out;
            }

            .voice-search-disabled {
                opacity: 0.5;
                cursor: not-allowed !important;
            }

            .voice-status-indicator {
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.9);
                color: white;
                padding: 0.75rem 1rem;
                border-radius: 8px;
                margin-top: 0.5rem;
                z-index: 1002;
                opacity: 0;
                transition: opacity 0.3s ease;
                pointer-events: none;
                min-width: 200px;
                text-align: center;
            }

            .voice-status-indicator.active {
                opacity: 1;
            }

            .voice-status-content {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-size: 0.9rem;
            }

            .voice-status--error {
                background: rgba(231, 76, 60, 0.9) !important;
            }

            .voice-status--listening {
                background: rgba(0, 124, 186, 0.9) !important;
            }

            .voice-status--processing {
                background: rgba(243, 156, 18, 0.9) !important;
            }

            .voice-animation {
                display: flex;
                gap: 0.2rem;
                align-items: center;
            }

            .voice-bar {
                width: 3px;
                height: 12px;
                background: currentColor;
                border-radius: 2px;
                animation: voiceWave 1.2s ease-in-out infinite;
            }

            .voice-bar:nth-child(2) { animation-delay: 0.1s; }
            .voice-bar:nth-child(3) { animation-delay: 0.2s; }
            .voice-bar:nth-child(4) { animation-delay: 0.3s; }
            .voice-bar:nth-child(5) { animation-delay: 0.4s; }

            @keyframes voicePulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.2); }
            }

            @keyframes voiceSpin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @keyframes voiceShake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-2px); }
                75% { transform: translateX(2px); }
            }

            @keyframes voiceWave {
                0%, 100% { height: 12px; }
                50% { height: 20px; }
            }

            @media (max-width: 768px) {
                .voice-status-indicator {
                    left: 10px;
                    right: 10px;
                    transform: none;
                    min-width: auto;
                }
            }
        `;

        const styleSheet = PracticalSolutionsUtils.createElement('style', {
            id: 'ps-voice-search-styles'
        }, styles);

        document.head.appendChild(styleSheet);
    }

    /**
     * تدمير نظام البحث الصوتي
     */
    function destroy() {
        // إيقاف الاستماع
        stopListening();
        
        // إزالة مستمعي الأحداث
        if (voiceButton) {
            voiceButton.removeEventListener('click', handleVoiceButtonClick);
            voiceButton.removeEventListener('mousedown', handleVoiceButtonMouseDown);
            voiceButton.removeEventListener('mouseup', handleVoiceButtonMouseUp);
            voiceButton.removeEventListener('touchstart', handleVoiceButtonTouchStart);
            voiceButton.removeEventListener('touchend', handleVoiceButtonTouchEnd);
            voiceButton.removeEventListener('mouseleave', handleVoiceButtonMouseLeave);
            voiceButton.removeEventListener('keydown', handleVoiceButtonKeydown);
        }

        document.removeEventListener('visibilitychange', handleVisibilityChange);
        window.removeEventListener('beforeunload', stopListening);

        // مسح المؤقتات
        if (recognitionTimeout) {
            clearTimeout(recognitionTimeout);
        }

        // تنظيف المتغيرات
        recognition = null;
        instance = null;
        
        PracticalSolutionsUtils.log('تم تدمير نظام البحث الصوتي');
    }

    // إرجاع الوظائف العامة
    return {
        init: init
    };

})();