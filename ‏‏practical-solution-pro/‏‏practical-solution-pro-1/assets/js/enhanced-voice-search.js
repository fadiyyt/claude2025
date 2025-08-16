/**
 * نظام البحث الصوتي المحسن
 * 
 * @package Practical_Solutions_Pro
 * @version 2.1.0
 */

class EnhancedVoiceSearch {
    constructor() {
        this.recognition = null;
        this.isListening = false;
        this.searchInput = null;
        this.voiceButton = null;
        this.suggestions = [];
        this.history = this.getSearchHistory();
        this.apiKey = psVoiceSearch?.apiKey || '';
        this.currentLanguage = 'ar-SA';
        this.fallbackLanguages = ['ar-EG', 'ar-AE', 'en-US'];
        
        this.init();
    }
    
    /**
     * ==== تهيئة النظام ====
     */
    init() {
        if (!this.checkBrowserSupport()) {
            console.warn('متصفحك لا يدعم البحث الصوتي');
            return;
        }
        
        this.setupElements();
        this.setupSpeechRecognition();
        this.setupEventListeners();
        this.loadSettings();
        this.createVoiceInterface();
        
        // تحميل الاقتراحات المحفوظة
        this.loadCachedSuggestions();
        
        console.log('تم تشغيل نظام البحث الصوتي المحسن');
    }
    
    /**
     * ==== فحص دعم المتصفح ====
     */
    checkBrowserSupport() {
        return 'webkitSpeechRecognition' in window || 'SpeechRecognition' in window;
    }
    
    /**
     * ==== إعداد العناصر الأساسية ====
     */
    setupElements() {
        this.searchInput = document.querySelector('.ps-search-input, #search-input, .search-field');
        
        if (!this.searchInput) {
            // إنشاء حقل البحث إذا لم يوجد
            this.createSearchField();
        }
        
        this.createVoiceButton();
    }
    
    /**
     * ==== إنشاء حقل البحث ====
     */
    createSearchField() {
        const searchContainer = document.querySelector('.ps-search-container, .search-form, header');
        
        if (searchContainer) {
            const searchHTML = `
                <div class="ps-enhanced-search">
                    <input type="text" class="ps-search-input" placeholder="ابحث عن الحلول والنصائح..." />
                    <div class="ps-search-suggestions"></div>
                </div>
            `;
            
            searchContainer.insertAdjacentHTML('beforeend', searchHTML);
            this.searchInput = searchContainer.querySelector('.ps-search-input');
        }
    }
    
    /**
     * ==== إنشاء زر البحث الصوتي ====
     */
    createVoiceButton() {
        if (!this.searchInput) return;
        
        // التحقق من وجود الزر مسبقاً
        const existingButton = this.searchInput.parentNode.querySelector('.ps-voice-button');
        if (existingButton) {
            this.voiceButton = existingButton;
            return;
        }
        
        this.voiceButton = document.createElement('button');
        this.voiceButton.type = 'button';
        this.voiceButton.className = 'ps-voice-button';
        this.voiceButton.innerHTML = `
            <svg class="voice-icon" viewBox="0 0 24 24" width="20" height="20">
                <path d="M12 2C10.9 2 10 2.9 10 4V12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12V4C14 2.9 13.1 2 12 2Z" fill="currentColor"/>
                <path d="M19 10V12C19 15.9 15.9 19 12 19C8.1 19 5 15.9 5 12V10H7V12C7 14.8 9.2 17 12 17C14.8 17 17 14.8 17 12V10H19Z" fill="currentColor"/>
                <path d="M10.5 22H13.5V20H10.5V22Z" fill="currentColor"/>
            </svg>
            <span class="voice-status">اضغط للتحدث</span>
        `;
        
        this.voiceButton.setAttribute('title', 'البحث الصوتي (Ctrl + M)');
        this.voiceButton.setAttribute('aria-label', 'تفعيل البحث الصوتي');
        
        // إدراج الزر بعد حقل البحث
        this.searchInput.parentNode.insertBefore(this.voiceButton, this.searchInput.nextSibling);
        
        // إضافة أنماط CSS
        this.addVoiceButtonStyles();
    }
    
    /**
     * ==== إضافة أنماط زر البحث الصوتي ====
     */
    addVoiceButtonStyles() {
        if (document.querySelector('#ps-voice-search-styles')) return;
        
        const styles = document.createElement('style');
        styles.id = 'ps-voice-search-styles';
        styles.textContent = `
            .ps-voice-button {
                background: linear-gradient(135deg, #007cba, #005a87);
                border: none;
                border-radius: 50px;
                padding: 12px 16px;
                color: white;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s ease;
                box-shadow: 0 2px 8px rgba(0, 124, 186, 0.3);
                margin-left: 8px;
                margin-right: 8px;
            }
            
            .ps-voice-button:hover {
                background: linear-gradient(135deg, #005a87, #007cba);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 124, 186, 0.4);
            }
            
            .ps-voice-button:active {
                transform: translateY(0);
            }
            
            .ps-voice-button.listening {
                background: linear-gradient(135deg, #e74c3c, #c0392b);
                animation: pulse 1.5s infinite;
            }
            
            .ps-voice-button.processing {
                background: linear-gradient(135deg, #f39c12, #e67e22);
            }
            
            .ps-voice-button.success {
                background: linear-gradient(135deg, #27ae60, #2ecc71);
            }
            
            .ps-voice-button .voice-icon {
                transition: transform 0.3s ease;
            }
            
            .ps-voice-button.listening .voice-icon {
                transform: scale(1.2);
                animation: bounce 0.6s infinite alternate;
            }
            
            @keyframes pulse {
                0% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7); }
                70% { box-shadow: 0 0 0 10px rgba(231, 76, 60, 0); }
                100% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0); }
            }
            
            @keyframes bounce {
                from { transform: scale(1.2) translateY(0); }
                to { transform: scale(1.2) translateY(-3px); }
            }
            
            .ps-voice-feedback {
                position: fixed;
                top: 20px;
                right: 20px;
                background: rgba(0, 0, 0, 0.9);
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                z-index: 9999;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            }
            
            .ps-voice-feedback.show {
                transform: translateX(0);
            }
            
            .ps-search-suggestions {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                max-height: 300px;
                overflow-y: auto;
                z-index: 1000;
                display: none;
            }
            
            .ps-search-suggestions.show {
                display: block;
            }
            
            .ps-suggestion-item {
                padding: 12px 16px;
                border-bottom: 1px solid #eee;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 10px;
                transition: background 0.2s ease;
            }
            
            .ps-suggestion-item:hover {
                background: #f8f9fa;
            }
            
            .ps-suggestion-item:last-child {
                border-bottom: none;
            }
            
            .ps-suggestion-icon {
                width: 16px;
                height: 16px;
                opacity: 0.6;
            }
            
            .ps-suggestion-text {
                flex: 1;
            }
            
            .ps-suggestion-type {
                font-size: 12px;
                color: #666;
                background: #f0f0f0;
                padding: 2px 6px;
                border-radius: 4px;
            }
            
            @media (max-width: 768px) {
                .ps-voice-button {
                    padding: 10px 12px;
                    font-size: 12px;
                }
                
                .ps-voice-button .voice-status {
                    display: none;
                }
            }
        `;
        
        document.head.appendChild(styles);
    }
    
    /**
     * ==== إعداد التعرف على الكلام ====
     */
    setupSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (!SpeechRecognition) {
            console.error('Speech Recognition غير مدعوم في هذا المتصفح');
            return;
        }
        
        this.recognition = new SpeechRecognition();
        this.recognition.continuous = false;
        this.recognition.interimResults = true;
        this.recognition.lang = this.currentLanguage;
        this.recognition.maxAlternatives = 5;
        
        // معالج بداية الاستماع
        this.recognition.onstart = () => {
            this.isListening = true;
            this.updateButtonState('listening');
            this.showFeedback('استمع الآن... تحدث بوضوح');
        };
        
        // معالج النتائج
        this.recognition.onresult = (event) => {
            this.handleSpeechResult(event);
        };
        
        // معالج انتهاء الاستماع
        this.recognition.onend = () => {
            this.isListening = false;
            this.updateButtonState('default');
            this.hideFeedback();
        };
        
        // معالج الأخطاء
        this.recognition.onerror = (event) => {
            this.handleSpeechError(event);
        };
    }
    
    /**
     * ==== إعداد مستمعي الأحداث ====
     */
    setupEventListeners() {
        // النقر على زر البحث الصوتي
        if (this.voiceButton) {
            this.voiceButton.addEventListener('click', () => {
                this.toggleListening();
            });
        }
        
        // اختصار لوحة المفاتيح
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === 'm') {
                e.preventDefault();
                this.toggleListening();
            }
        });
        
        // البحث أثناء الكتابة
        if (this.searchInput) {
            this.searchInput.addEventListener('input', (e) => {
                this.handleTextInput(e.target.value);
            });
            
            this.searchInput.addEventListener('focus', () => {
                this.showSuggestions();
            });
            
            this.searchInput.addEventListener('blur', (e) => {
                // تأخير إخفاء الاقتراحات للسماح بالنقر عليها
                setTimeout(() => {
                    this.hideSuggestions();
                }, 200);
            });
        }
        
        // النقر خارج منطقة البحث
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.ps-enhanced-search')) {
                this.hideSuggestions();
            }
        });
    }
    
    /**
     * ==== تبديل حالة الاستماع ====
     */
    toggleListening() {
        if (!this.recognition) {
            this.showFeedback('البحث الصوتي غير متوفر في متصفحك', 'error');
            return;
        }
        
        if (this.isListening) {
            this.stopListening();
        } else {
            this.startListening();
        }
    }
    
    /**
     * ==== بدء الاستماع ====
     */
    startListening() {
        try {
            this.recognition.start();
        } catch (error) {
            console.error('خطأ في بدء التعرف على الكلام:', error);
            this.showFeedback('حدث خطأ في تشغيل البحث الصوتي', 'error');
        }
    }
    
    /**
     * ==== إيقاف الاستماع ====
     */
    stopListening() {
        if (this.recognition) {
            this.recognition.stop();
        }
    }
    
    /**
     * ==== معالجة نتائج الكلام ====
     */
    handleSpeechResult(event) {
        let finalTranscript = '';
        let interimTranscript = '';
        
        for (let i = event.resultIndex; i < event.results.length; i++) {
            const transcript = event.results[i][0].transcript;
            
            if (event.results[i].isFinal) {
                finalTranscript += transcript;
            } else {
                interimTranscript += transcript;
            }
        }
        
        // عرض النص المؤقت
        if (interimTranscript) {
            if (this.searchInput) {
                this.searchInput.value = interimTranscript;
                this.searchInput.style.color = '#999';
            }
            this.showFeedback(`سمعت: "${interimTranscript}"`);
        }
        
        // معالجة النص النهائي
        if (finalTranscript) {
            this.processFinalTranscript(finalTranscript.trim());
        }
    }
    
    /**
     * ==== معالجة النص النهائي ====
     */
    async processFinalTranscript(transcript) {
        if (!transcript) return;
        
        this.updateButtonState('processing');
        this.showFeedback('جاري معالجة طلبك...');
        
        // تنظيف النص وتحسينه
        const cleanedText = this.cleanAndEnhanceText(transcript);
        
        if (this.searchInput) {
            this.searchInput.value = cleanedText;
            this.searchInput.style.color = '';
        }
        
        // حفظ في التاريخ
        this.saveToHistory(cleanedText);
        
        // الحصول على اقتراحات ذكية
        await this.getAISuggestions(cleanedText);
        
        // تنفيذ البحث
        this.performSearch(cleanedText);
        
        this.updateButtonState('success');
        this.showFeedback(`تم البحث عن: "${cleanedText}"`, 'success');
        
        setTimeout(() => {
            this.updateButtonState('default');
        }, 2000);
    }
    
    /**
     * ==== تنظيف وتحسين النص ====
     */
    cleanAndEnhanceText(text) {
        // إزالة الكلمات الزائدة والتنظيف
        let cleaned = text
            .replace(/أريد أن أبحث عن/gi, '')
            .replace(/ابحث عن/gi, '')
            .replace(/أبحث عن/gi, '')
            .replace(/كيف/gi, 'كيفية')
            .replace(/ايش/gi, 'ما هو')
            .replace(/وش/gi, 'ما هو')
            .replace(/شلون/gi, 'كيفية')
            .trim();
        
        // تصحيح أخطاء شائعة
        const corrections = {
            'تطبيقات': 'تطبيقات',
            'برامج': 'برامج',
            'حلول': 'حلول',
            'نصايح': 'نصائح',
            'معلومات': 'معلومات'
        };
        
        Object.entries(corrections).forEach(([wrong, correct]) => {
            cleaned = cleaned.replace(new RegExp(wrong, 'gi'), correct);
        });
        
        return cleaned;
    }
    
    /**
     * ==== معالجة أخطاء الكلام ====
     */
    handleSpeechError(event) {
        this.isListening = false;
        this.updateButtonState('default');
        
        let errorMessage = 'حدث خطأ في البحث الصوتي';
        
        switch (event.error) {
            case 'no-speech':
                errorMessage = 'لم يتم التقاط أي صوت. حاول مرة أخرى';
                break;
            case 'audio-capture':
                errorMessage = 'لا يمكن الوصول للميكروفون';
                break;
            case 'not-allowed':
                errorMessage = 'تم رفض إذن استخدام الميكروفون';
                break;
            case 'network':
                errorMessage = 'خطأ في الشبكة. تحقق من اتصالك';
                break;
            case 'language-not-supported':
                this.tryFallbackLanguage();
                return;
        }
        
        this.showFeedback(errorMessage, 'error');
    }
    
    /**
     * ==== تجربة لغة احتياطية ====
     */
    tryFallbackLanguage() {
        const currentIndex = this.fallbackLanguages.indexOf(this.currentLanguage);
        
        if (currentIndex < this.fallbackLanguages.length - 1) {
            this.currentLanguage = this.fallbackLanguages[currentIndex + 1];
            this.recognition.lang = this.currentLanguage;
            this.showFeedback(`جاري التبديل للغة ${this.currentLanguage}...`);
            this.startListening();
        } else {
            this.showFeedback('اللغة غير مدعومة في هذا المتصفح', 'error');
        }
    }
    
    /**
     * ==== تحديث حالة الزر ====
     */
    updateButtonState(state) {
        if (!this.voiceButton) return;
        
        this.voiceButton.className = `ps-voice-button ${state}`;
        
        const statusElement = this.voiceButton.querySelector('.voice-status');
        if (!statusElement) return;
        
        const messages = {
            'default': 'اضغط للتحدث',
            'listening': 'استمع...',
            'processing': 'جاري المعالجة...',
            'success': 'تم!'
        };
        
        statusElement.textContent = messages[state] || messages.default;
    }
    
    /**
     * ==== عرض رسالة التغذية الراجعة ====
     */
    showFeedback(message, type = 'info') {
        // إزالة الرسالة السابقة
        const existingFeedback = document.querySelector('.ps-voice-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }
        
        const feedback = document.createElement('div');
        feedback.className = `ps-voice-feedback ${type}`;
        feedback.textContent = message;
        
        document.body.appendChild(feedback);
        
        // عرض الرسالة
        setTimeout(() => {
            feedback.classList.add('show');
        }, 100);
        
        // إخفاء الرسالة تلقائياً
        setTimeout(() => {
            this.hideFeedback();
        }, type === 'error' ? 5000 : 3000);
    }
    
    /**
     * ==== إخفاء رسالة التغذية الراجعة ====
     */
    hideFeedback() {
        const feedback = document.querySelector('.ps-voice-feedback');
        if (feedback) {
            feedback.classList.remove('show');
            setTimeout(() => {
                feedback.remove();
            }, 300);
        }
    }
    
    /**
     * ==== معالجة إدخال النص العادي ====
     */
    async handleTextInput(value) {
        if (value.length < 2) {
            this.hideSuggestions();
            return;
        }
        
        // الحصول على اقتراحات
        const suggestions = await this.getSuggestions(value);
        this.displaySuggestions(suggestions);
    }
    
    /**
     * ==== الحصول على الاقتراحات ====
     */
    async getSuggestions(query) {
        const suggestions = [];
        
        // اقتراحات من التاريخ
        const historySuggestions = this.history
            .filter(item => item.toLowerCase().includes(query.toLowerCase()))
            .slice(0, 3)
            .map(item => ({
                text: item,
                type: 'history',
                icon: '🕐'
            }));
        
        suggestions.push(...historySuggestions);
        
        // اقتراحات ثابتة شائعة
        const commonSuggestions = [
            'حلول منزلية',
            'نصائح تقنية',
            'تطبيقات مفيدة',
            'إدارة الوقت',
            'تنظيم المنزل',
            'وصفات سريعة',
            'نصائح مالية',
            'تطوير الذات'
        ]
        .filter(item => item.toLowerCase().includes(query.toLowerCase()))
        .slice(0, 3)
        .map(item => ({
            text: item,
            type: 'common',
            icon: '💡'
        }));
        
        suggestions.push(...commonSuggestions);
        
        // اقتراحات من الذكاء الاصطناعي
        if (this.apiKey) {
            try {
                const aiSuggestions = await this.getAISuggestions(query);
                suggestions.push(...aiSuggestions.slice(0, 2));
            } catch (error) {
                console.warn('فشل في الحصول على اقتراحات الذكاء الاصطناعي:', error);
            }
        }
        
        return suggestions.slice(0, 8);
    }
    
    /**
     * ==== الحصول على اقتراحات الذكاء الاصطناعي ====
     */
    async getAISuggestions(query) {
        if (!this.apiKey) return [];
        
        try {
            const response = await fetch(psVoiceSearch.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'ps_get_ai_suggestions',
                    query: query,
                    nonce: psVoiceSearch.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success && data.data.suggestions) {
                return data.data.suggestions.map(suggestion => ({
                    text: suggestion,
                    type: 'ai',
                    icon: '🤖'
                }));
            }
        } catch (error) {
            console.error('خطأ في الحصول على اقتراحات AI:', error);
        }
        
        return [];
    }
    
    /**
     * ==== عرض الاقتراحات ====
     */
    displaySuggestions(suggestions) {
        if (!this.searchInput) return;
        
        let suggestionsContainer = this.searchInput.parentNode.querySelector('.ps-search-suggestions');
        
        if (!suggestionsContainer) {
            suggestionsContainer = document.createElement('div');
            suggestionsContainer.className = 'ps-search-suggestions';
            this.searchInput.parentNode.appendChild(suggestionsContainer);
        }
        
        if (suggestions.length === 0) {
            this.hideSuggestions();
            return;
        }
        
        const suggestionsHTML = suggestions.map(suggestion => `
            <div class="ps-suggestion-item" data-text="${suggestion.text}">
                <span class="ps-suggestion-icon">${suggestion.icon}</span>
                <span class="ps-suggestion-text">${suggestion.text}</span>
                <span class="ps-suggestion-type">${this.getSuggestionTypeLabel(suggestion.type)}</span>
            </div>
        `).join('');
        
        suggestionsContainer.innerHTML = suggestionsHTML;
        suggestionsContainer.classList.add('show');
        
        // إضافة مستمعي الأحداث للاقتراحات
        suggestionsContainer.querySelectorAll('.ps-suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                const text = item.getAttribute('data-text');
                this.selectSuggestion(text);
            });
        });
    }
    
    /**
     * ==== الحصول على تسمية نوع الاقتراح ====
     */
    getSuggestionTypeLabel(type) {
        const labels = {
            'history': 'تاريخ',
            'common': 'شائع',
            'ai': 'ذكي',
            'related': 'مرتبط'
        };
        
        return labels[type] || 'اقتراح';
    }
    
    /**
     * ==== اختيار اقتراح ====
     */
    selectSuggestion(text) {
        if (this.searchInput) {
            this.searchInput.value = text;
        }
        
        this.hideSuggestions();
        this.saveToHistory(text);
        this.performSearch(text);
    }
    
    /**
     * ==== إخفاء الاقتراحات ====
     */
    hideSuggestions() {
        const suggestionsContainer = document.querySelector('.ps-search-suggestions');
        if (suggestionsContainer) {
            suggestionsContainer.classList.remove('show');
        }
    }
    
    /**
     * ==== عرض الاقتراحات ====
     */
    showSuggestions() {
        if (this.searchInput && this.searchInput.value.length >= 2) {
            this.handleTextInput(this.searchInput.value);
        }
    }
    
    /**
     * ==== تنفيذ البحث ====
     */
    performSearch(query) {
        if (!query.trim()) return;
        
        // إضافة المعايير الخاصة بالبحث
        const searchParams = new URLSearchParams({
            s: query,
            voice_search: '1'
        });
        
        // التوجه لصفحة النتائج
        window.location.href = `${psVoiceSearch.homeUrl}?${searchParams.toString()}`;
    }
    
    /**
     * ==== حفظ في تاريخ البحث ====
     */
    saveToHistory(query) {
        if (!query || this.history.includes(query)) return;
        
        this.history.unshift(query);
        this.history = this.history.slice(0, 20); // الاحتفاظ بـ 20 عنصر فقط
        
        localStorage.setItem('ps_voice_search_history', JSON.stringify(this.history));
    }
    
    /**
     * ==== الحصول على تاريخ البحث ====
     */
    getSearchHistory() {
        try {
            const history = localStorage.getItem('ps_voice_search_history');
            return history ? JSON.parse(history) : [];
        } catch (error) {
            console.error('خطأ في قراءة تاريخ البحث:', error);
            return [];
        }
    }
    
    /**
     * ==== تحميل الإعدادات ====
     */
    loadSettings() {
        try {
            const settings = localStorage.getItem('ps_voice_search_settings');
            if (settings) {
                const parsed = JSON.parse(settings);
                this.currentLanguage = parsed.language || this.currentLanguage;
                
                if (this.recognition) {
                    this.recognition.lang = this.currentLanguage;
                }
            }
        } catch (error) {
            console.error('خطأ في تحميل إعدادات البحث الصوتي:', error);
        }
    }
    
    /**
     * ==== حفظ الإعدادات ====
     */
    saveSettings() {
        const settings = {
            language: this.currentLanguage,
            updated: Date.now()
        };
        
        localStorage.setItem('ps_voice_search_settings', JSON.stringify(settings));
    }
    
    /**
     * ==== تحميل الاقتراحات المحفوظة ====
     */
    loadCachedSuggestions() {
        try {
            const cached = localStorage.getItem('ps_cached_suggestions');
            if (cached) {
                const data = JSON.parse(cached);
                // التحقق من صحة البيانات المحفوظة
                if (Date.now() - data.timestamp < 3600000) { // ساعة واحدة
                    this.suggestions = data.suggestions || [];
                }
            }
        } catch (error) {
            console.error('خطأ في تحميل الاقتراحات المحفوظة:', error);
        }
    }
    
    /**
     * ==== إنشاء واجهة الصوت المتقدمة ====
     */
    createVoiceInterface() {
        // إضافة مؤشر مستوى الصوت
        if (this.voiceButton) {
            const volumeIndicator = document.createElement('div');
            volumeIndicator.className = 'ps-volume-indicator';
            volumeIndicator.innerHTML = `
                <div class="volume-bar"></div>
                <div class="volume-bar"></div>
                <div class="volume-bar"></div>
            `;
            
            this.voiceButton.appendChild(volumeIndicator);
        }
    }
    
    /**
     * ==== تنظيف الموارد ====
     */
    destroy() {
        if (this.recognition) {
            this.recognition.stop();
            this.recognition = null;
        }
        
        // إزالة مستمعي الأحداث
        if (this.voiceButton) {
            this.voiceButton.removeEventListener('click', this.toggleListening);
        }
        
        // حفظ الإعدادات قبل الإغلاق
        this.saveSettings();
    }
}

// تشغيل النظام عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    // التحقق من وجود البيانات المطلوبة
    if (typeof psVoiceSearch !== 'undefined') {
        window.psVoiceSearchInstance = new EnhancedVoiceSearch();
    } else {
        console.warn('بيانات البحث الصوتي غير متوفرة');
    }
});

// تنظيف عند إغلاق الصفحة
window.addEventListener('beforeunload', () => {
    if (window.psVoiceSearchInstance) {
        window.psVoiceSearchInstance.destroy();
    }
});

// تصدير الكلاس للاستخدام الخارجي
window.EnhancedVoiceSearch = EnhancedVoiceSearch;