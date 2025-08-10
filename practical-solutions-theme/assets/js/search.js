/**
 * Practical Solutions Theme - Advanced Search System
 * نظام البحث المتقدم
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * كلاس نظام البحث المتقدم
 * @class AdvancedSearch
 */
window.AdvancedSearch = (function() {
    
    // المتغيرات الخاصة
    let instance = null;
    let searchForm = null;
    let searchInput = null;
    let suggestionsContainer = null;
    let submitButton = null;
    let clearButton = null;
    let loadingIndicator = null;
    let debounceTimer = null;
    let currentSuggestions = [];
    let activeSuggestionIndex = -1;
    let isSearching = false;
    let searchHistory = [];
    let recentSearches = [];

    // إعدادات افتراضية
    const defaults = {
        minSearchLength: 2,
        debounceDelay: 300,
        maxSuggestions: 8,
        maxRecentSearches: 5,
        cacheTimeout: 300000, // 5 دقائق
        enableHistory: true,
        enableAutoComplete: true,
        enableInstantSearch: false
    };

    let settings = {};

    /**
     * تهيئة نظام البحث
     * @param {Object} options - الخيارات
     */
    function init(options = {}) {
        if (instance) {
            PracticalSolutionsUtils.log('نظام البحث مهيأ مسبقاً', 'warn');
            return instance;
        }

        settings = Object.assign({}, defaults, options);
        
        // البحث عن العناصر المطلوبة
        findElements();
        
        if (!searchForm || !searchInput) {
            PracticalSolutionsUtils.log('عناصر البحث غير موجودة', 'error');
            return null;
        }

        // تهيئة العناصر والأحداث
        setupElements();
        bindEvents();
        loadSearchHistory();
        
        PracticalSolutionsUtils.log('تم تهيئة نظام البحث بنجاح');
        
        instance = {
            search: performSearch,
            clearSearch: clearSearch,
            showSuggestions: showSuggestions,
            hideSuggestions: hideSuggestions,
            addToHistory: addToHistory,
            getHistory: getSearchHistory,
            clearHistory: clearSearchHistory,
            destroy: destroy
        };

        return instance;
    }

    /**
     * البحث عن العناصر في الصفحة
     */
    function findElements() {
        searchForm = PracticalSolutionsUtils.getElement('.search-form');
        searchInput = PracticalSolutionsUtils.getElement('.search-field');
        suggestionsContainer = PracticalSolutionsUtils.getElement('#search-suggestions') || 
                              PracticalSolutionsUtils.getElement('.search-suggestions');
        submitButton = PracticalSolutionsUtils.getElement('.search-submit');
        clearButton = PracticalSolutionsUtils.getElement('.search-clear');
        
        // إنشاء حاوي الاقتراحات إذا لم يكن موجود
        if (!suggestionsContainer && searchForm) {
            suggestionsContainer = PracticalSolutionsUtils.createElement('div', {
                id: 'search-suggestions',
                className: 'search-suggestions',
                role: 'listbox',
                'aria-label': 'اقتراحات البحث'
            });
            searchForm.appendChild(suggestionsContainer);
        }

        // إنشاء مؤشر التحميل
        if (searchForm && !loadingIndicator) {
            loadingIndicator = PracticalSolutionsUtils.createElement('div', {
                className: 'search-loading',
                innerHTML: `
                    <div class="search-loading-spinner"></div>
                    <span class="search-loading-text">${getTranslation('loading')}</span>
                `
            });
            searchForm.appendChild(loadingIndicator);
        }
    }

    /**
     * إعداد العناصر
     */
    function setupElements() {
        // إضافة خصائص إمكانية الوصول
        searchInput.setAttribute('autocomplete', 'off');
        searchInput.setAttribute('aria-expanded', 'false');
        searchInput.setAttribute('aria-haspopup', 'listbox');
        
        if (suggestionsContainer) {
            suggestionsContainer.setAttribute('aria-hidden', 'true');
        }

        // إعداد placeholder ديناميكي
        if (!searchInput.placeholder) {
            searchInput.placeholder = getTranslation('search_placeholder');
        }

        // إضافة أنماط CSS اللازمة
        addSearchStyles();
    }

    /**
     * ربط الأحداث
     */
    function bindEvents() {
        // أحداث حقل البحث
        searchInput.addEventListener('input', handleInputChange);
        searchInput.addEventListener('focus', handleInputFocus);
        searchInput.addEventListener('blur', handleInputBlur);
        searchInput.addEventListener('keydown', handleKeydown);

        // أحداث النموذج
        if (searchForm) {
            searchForm.addEventListener('submit', handleFormSubmit);
        }

        // أحداث زر المسح
        if (clearButton) {
            clearButton.addEventListener('click', clearSearch);
        }

        // أحداث النقر خارج منطقة البحث
        document.addEventListener('click', handleDocumentClick);

        // أحداث لوحة المفاتيح العامة
        document.addEventListener('keydown', handleGlobalKeydown);
    }

    /**
     * معالجة تغيير النص في حقل البحث
     * @param {Event} event - حدث التغيير
     */
    function handleInputChange(event) {
        const query = event.target.value.trim();
        
        // إظهار/إخفاء زر المسح
        toggleClearButton(query.length > 0);
        
        // تنظيف المؤقت السابق
        clearTimeout(debounceTimer);
        
        if (query.length >= settings.minSearchLength) {
            // تأخير البحث لتحسين الأداء
            debounceTimer = setTimeout(() => {
                if (settings.enableAutoComplete) {
                    fetchSuggestions(query);
                }
                
                if (settings.enableInstantSearch) {
                    performInstantSearch(query);
                }
            }, settings.debounceDelay);
        } else {
            hideSuggestions();
            
            // عرض البحث السابق إذا كان الحقل فارغ
            if (query.length === 0 && settings.enableHistory) {
                showRecentSearches();
            }
        }
    }

    /**
     * معالجة التركيز على حقل البحث
     * @param {Event} event - حدث التركيز
     */
    function handleInputFocus(event) {
        const query = event.target.value.trim();
        
        if (query.length >= settings.minSearchLength) {
            showSuggestions();
        } else if (settings.enableHistory && recentSearches.length > 0) {
            showRecentSearches();
        }
        
        searchInput.setAttribute('aria-expanded', 'true');
    }

    /**
     * معالجة فقدان التركيز
     * @param {Event} event - حدث فقدان التركيز
     */
    function handleInputBlur(event) {
        // تأخير الإخفاء للسماح بالنقر على الاقتراحات
        setTimeout(() => {
            hideSuggestions();
            searchInput.setAttribute('aria-expanded', 'false');
        }, 200);
    }

    /**
     * معالجة أحداث لوحة المفاتيح
     * @param {Event} event - حدث لوحة المفاتيح
     */
    function handleKeydown(event) {
        if (!suggestionsContainer || !PracticalSolutionsUtils.hasClass(suggestionsContainer, 'active')) {
            return;
        }

        const suggestions = suggestionsContainer.querySelectorAll('.suggestion-item');
        
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                navigateSuggestions('down', suggestions);
                break;
                
            case 'ArrowUp':
                event.preventDefault();
                navigateSuggestions('up', suggestions);
                break;
                
            case 'Enter':
                event.preventDefault();
                if (activeSuggestionIndex >= 0 && suggestions[activeSuggestionIndex]) {
                    selectSuggestion(suggestions[activeSuggestionIndex]);
                } else {
                    handleFormSubmit(event);
                }
                break;
                
            case 'Escape':
                hideSuggestions();
                searchInput.blur();
                break;
                
            case 'Tab':
                hideSuggestions();
                break;
        }
    }

    /**
     * معالجة إرسال النموذج
     * @param {Event} event - حدث الإرسال
     */
    function handleFormSubmit(event) {
        const query = searchInput.value.trim();
        
        if (query.length < settings.minSearchLength) {
            event.preventDefault();
            PracticalSolutionsUtils.showNotification(
                getTranslation('search_minimum'),
                'warning'
            );
            return false;
        }

        // إضافة للتاريخ
        addToHistory(query);
        
        // إخفاء الاقتراحات
        hideSuggestions();
        
        PracticalSolutionsUtils.log(`تم البحث عن: ${query}`);
        
        // السماح للنموذج بالإرسال الطبيعي
        return true;
    }

    /**
     * التنقل بين الاقتراحات
     * @param {string} direction - الاتجاه (up/down)
     * @param {NodeList} suggestions - قائمة الاقتراحات
     */
    function navigateSuggestions(direction, suggestions) {
        if (!suggestions.length) return;

        // إزالة التمييز السابق
        suggestions.forEach(item => {
            PracticalSolutionsUtils.removeClass(item, 'active');
        });

        // تحديد الفهرس الجديد
        if (direction === 'down') {
            activeSuggestionIndex = (activeSuggestionIndex + 1) % suggestions.length;
        } else {
            activeSuggestionIndex = activeSuggestionIndex <= 0 ? 
                suggestions.length - 1 : activeSuggestionIndex - 1;
        }

        // تمييز الاقتراح النشط
        const activeItem = suggestions[activeSuggestionIndex];
        PracticalSolutionsUtils.addClass(activeItem, 'active');
        
        // تحديث aria-activedescendant
        searchInput.setAttribute('aria-activedescendant', activeItem.id || `suggestion-${activeSuggestionIndex}`);
        
        // التمرير للعنصر النشط إذا لزم الأمر
        activeItem.scrollIntoView({ block: 'nearest' });
    }

    /**
     * جلب اقتراحات البحث
     * @param {string} query - نص البحث
     */
    async function fetchSuggestions(query) {
        // التحقق من التخزين المؤقت أولاً
        const cachedSuggestions = getCachedSuggestions(query);
        if (cachedSuggestions) {
            displaySuggestions(cachedSuggestions, query);
            return;
        }

        try {
            showLoadingIndicator();
            
            const response = await PracticalSolutionsUtils.ajaxRequest({
                method: 'POST',
                data: {
                    action: 'ps_search_suggestions',
                    query: query,
                    nonce: window.practicalSolutions?.nonce || '',
                    max_results: settings.maxSuggestions
                }
            });

            if (response.success && response.data) {
                const suggestions = response.data;
                
                // حفظ في التخزين المؤقت
                cacheSuggestions(query, suggestions);
                
                // عرض الاقتراحات
                displaySuggestions(suggestions, query);
            } else {
                PracticalSolutionsUtils.log('لم يتم العثور على اقتراحات', 'info');
                hideSuggestions();
            }
            
        } catch (error) {
            PracticalSolutionsUtils.log('خطأ في جلب الاقتراحات: ' + error.message, 'error');
            hideSuggestions();
        } finally {
            hideLoadingIndicator();
        }
    }

    /**
     * عرض الاقتراحات
     * @param {Array} suggestions - قائمة الاقتراحات
     * @param {string} query - نص البحث
     */
    function displaySuggestions(suggestions, query) {
        if (!suggestions || !suggestions.length || !suggestionsContainer) {
            hideSuggestions();
            return;
        }

        currentSuggestions = suggestions;
        activeSuggestionIndex = -1;

        const suggestionsList = suggestions.map((suggestion, index) => {
            const highlightedTitle = highlightMatchingText(suggestion.title, query);
            const typeLabel = getTypeLabel(suggestion.type);
            
            return `
                <li class="suggestion-item" 
                    data-query="${PracticalSolutionsUtils.stripHtml(suggestion.title)}"
                    data-url="${suggestion.url || ''}"
                    data-type="${suggestion.type || 'post'}"
                    id="suggestion-${index}"
                    role="option">
                    <div class="suggestion-content">
                        <span class="suggestion-title">${highlightedTitle}</span>
                        <span class="suggestion-type">${typeLabel}</span>
                    </div>
                    ${suggestion.excerpt ? `<div class="suggestion-excerpt">${PracticalSolutionsUtils.truncateText(suggestion.excerpt, 80)}</div>` : ''}
                </li>
            `;
        }).join('');

        suggestionsContainer.innerHTML = `
            <ul class="suggestions-list" role="listbox" aria-label="اقتراحات البحث">
                ${suggestionsList}
            </ul>
        `;

        // إضافة مستمعي الأحداث
        bindSuggestionEvents();
        
        // إظهار الاقتراحات
        showSuggestions();
    }

    /**
     * ربط أحداث الاقتراحات
     */
    function bindSuggestionEvents() {
        const suggestionItems = suggestionsContainer.querySelectorAll('.suggestion-item');
        
        suggestionItems.forEach((item, index) => {
            item.addEventListener('click', () => selectSuggestion(item));
            item.addEventListener('mouseenter', () => {
                // إزالة التمييز من جميع الاقتراحات
                suggestionItems.forEach(suggestion => {
                    PracticalSolutionsUtils.removeClass(suggestion, 'active');
                });
                
                // تمييز الاقتراح الحالي
                PracticalSolutionsUtils.addClass(item, 'active');
                activeSuggestionIndex = index;
            });
        });
    }

    /**
     * اختيار اقتراح
     * @param {Element} suggestionElement - عنصر الاقتراح
     */
    function selectSuggestion(suggestionElement) {
        const query = suggestionElement.dataset.query;
        const url = suggestionElement.dataset.url;
        
        if (url) {
            // الانتقال للرابط مباشرة
            window.location.href = url;
        } else {
            // تحديث حقل البحث وإرسال النموذج
            searchInput.value = query;
            addToHistory(query);
            hideSuggestions();
            
            if (searchForm) {
                searchForm.submit();
            }
        }
    }

    /**
     * تمييز النص المطابق في الاقتراحات
     * @param {string} text - النص
     * @param {string} query - نص البحث
     * @returns {string}
     */
    function highlightMatchingText(text, query) {
        if (!query) return text;
        
        const regex = new RegExp(`(${escapeRegExp(query)})`, 'gi');
        return text.replace(regex, '<mark class="search-highlight">$1</mark>');
    }

    /**
     * الهروب من أحرف التعبير النمطي
     * @param {string} string - النص
     * @returns {string}
     */
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    /**
     * الحصول على تسمية نوع المحتوى
     * @param {string} type - نوع المحتوى
     * @returns {string}
     */
    function getTypeLabel(type) {
        const labels = {
            'post': 'مقال',
            'page': 'صفحة',
            'solution': 'حل',
            'tip': 'نصيحة',
            'category': 'تصنيف'
        };
        
        return labels[type] || 'محتوى';
    }

    /**
     * عرض البحث السابق
     */
    function showRecentSearches() {
        if (!recentSearches.length || !suggestionsContainer) return;

        const recentList = recentSearches.map((search, index) => `
            <li class="suggestion-item recent-search" 
                data-query="${search}"
                id="recent-${index}"
                role="option">
                <div class="suggestion-content">
                    <span class="suggestion-title">
                        <svg class="recent-icon" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c.09-.09.15-.21.15-.35V7c0-.28-.22-.5-.5-.5s-.5.22-.5.5v5.79c0 .13.05.26.15.35l3.5 3.5c.2.2.51.2.71 0s.2-.51 0-.71l-3.51-3.53z"/>
                        </svg>
                        ${search}
                    </span>
                    <span class="suggestion-type">بحث سابق</span>
                </div>
            </li>
        `).join('');

        suggestionsContainer.innerHTML = `
            <div class="suggestions-header">
                <span>البحث السابق</span>
                <button type="button" class="clear-history-btn" title="مسح التاريخ">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
            <ul class="suggestions-list recent-searches-list" role="listbox" aria-label="البحث السابق">
                ${recentList}
            </ul>
        `;

        // ربط الأحداث
        bindSuggestionEvents();
        
        const clearHistoryBtn = suggestionsContainer.querySelector('.clear-history-btn');
        if (clearHistoryBtn) {
            clearHistoryBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                clearSearchHistory();
                hideSuggestions();
            });
        }

        showSuggestions();
    }

    /**
     * إجراء بحث فوري
     * @param {string} query - نص البحث
     */
    async function performInstantSearch(query) {
        if (isSearching) return;
        
        isSearching = true;
        
        try {
            const response = await PracticalSolutionsUtils.ajaxRequest({
                method: 'POST',
                data: {
                    action: 'ps_instant_search',
                    query: query,
                    nonce: window.practicalSolutions?.nonce || ''
                }
            });

            if (response.success) {
                // عرض النتائج الفورية
                displayInstantResults(response.data);
            }
            
        } catch (error) {
            PracticalSolutionsUtils.log('خطأ في البحث الفوري: ' + error.message, 'error');
        } finally {
            isSearching = false;
        }
    }

    /**
     * إظهار مؤشر التحميل
     */
    function showLoadingIndicator() {
        if (loadingIndicator) {
            PracticalSolutionsUtils.toggleDisplay(loadingIndicator, true);
        }
    }

    /**
     * إخفاء مؤشر التحميل
     */
    function hideLoadingIndicator() {
        if (loadingIndicator) {
            PracticalSolutionsUtils.toggleDisplay(loadingIndicator, false);
        }
    }

    /**
     * إظهار الاقتراحات
     */
    function showSuggestions() {
        if (suggestionsContainer) {
            PracticalSolutionsUtils.addClass(suggestionsContainer, 'active');
            suggestionsContainer.setAttribute('aria-hidden', 'false');
        }
    }

    /**
     * إخفاء الاقتراحات
     */
    function hideSuggestions() {
        if (suggestionsContainer) {
            PracticalSolutionsUtils.removeClass(suggestionsContainer, 'active');
            suggestionsContainer.setAttribute('aria-hidden', 'true');
        }
        activeSuggestionIndex = -1;
    }

    /**
     * إظهار/إخفاء زر المسح
     * @param {boolean} show - إظهار أم لا
     */
    function toggleClearButton(show) {
        if (clearButton) {
            PracticalSolutionsUtils.toggleDisplay(clearButton, show);
        }
    }

    /**
     * مسح البحث
     */
    function clearSearch() {
        if (searchInput) {
            searchInput.value = '';
            searchInput.focus();
        }
        
        hideSuggestions();
        toggleClearButton(false);
        
        // إظهار البحث السابق
        if (settings.enableHistory && recentSearches.length > 0) {
            showRecentSearches();
        }
    }

    /**
     * إضافة للتاريخ
     * @param {string} query - نص البحث
     */
    function addToHistory(query) {
        if (!settings.enableHistory || !query.trim()) return;
        
        // إزالة البحث من القائمة إذا كان موجود
        const existingIndex = recentSearches.indexOf(query);
        if (existingIndex > -1) {
            recentSearches.splice(existingIndex, 1);
        }
        
        // إضافة في المقدمة
        recentSearches.unshift(query);
        
        // الحد الأقصى للبحث السابق
        if (recentSearches.length > settings.maxRecentSearches) {
            recentSearches = recentSearches.slice(0, settings.maxRecentSearches);
        }
        
        // حفظ في التخزين المحلي
        saveSearchHistory();
    }

    /**
     * الحصول على تاريخ البحث
     * @returns {Array}
     */
    function getSearchHistory() {
        return [...recentSearches];
    }

    /**
     * مسح تاريخ البحث
     */
    function clearSearchHistory() {
        recentSearches = [];
        saveSearchHistory();
        PracticalSolutionsUtils.showNotification('تم مسح تاريخ البحث', 'success');
    }

    /**
     * حفظ تاريخ البحث
     */
    function saveSearchHistory() {
        if (settings.enableHistory) {
            PracticalSolutionsUtils.setLocalStorage('ps_search_history', recentSearches);
        }
    }

    /**
     * تحميل تاريخ البحث
     */
    function loadSearchHistory() {
        if (settings.enableHistory) {
            recentSearches = PracticalSolutionsUtils.getLocalStorage('ps_search_history', []);
        }
    }

    /**
     * حفظ الاقتراحات في التخزين المؤقت
     * @param {string} query - نص البحث
     * @param {Array} suggestions - الاقتراحات
     */
    function cacheSuggestions(query, suggestions) {
        const cacheKey = `ps_suggestions_${query.toLowerCase()}`;
        const cacheData = {
            suggestions: suggestions,
            timestamp: Date.now()
        };
        
        PracticalSolutionsUtils.setLocalStorage(cacheKey, cacheData);
    }

    /**
     * استرجاع الاقتراحات من التخزين المؤقت
     * @param {string} query - نص البحث
     * @returns {Array|null}
     */
    function getCachedSuggestions(query) {
        const cacheKey = `ps_suggestions_${query.toLowerCase()}`;
        const cacheData = PracticalSolutionsUtils.getLocalStorage(cacheKey);
        
        if (cacheData && cacheData.timestamp) {
            const isExpired = (Date.now() - cacheData.timestamp) > settings.cacheTimeout;
            
            if (!isExpired) {
                return cacheData.suggestions;
            } else {
                // إزالة البيانات المنتهية الصلاحية
                PracticalSolutionsUtils.removeLocalStorage(cacheKey);
            }
        }
        
        return null;
    }

    /**
     * معالجة النقر على المستند
     * @param {Event} event - حدث النقر
     */
    function handleDocumentClick(event) {
        if (searchForm && !searchForm.contains(event.target)) {
            hideSuggestions();
        }
    }

    /**
     * معالجة أحداث لوحة المفاتيح العامة
     * @param {Event} event - حدث لوحة المفاتيح
     */
    function handleGlobalKeydown(event) {
        // اختصار Ctrl+K أو Cmd+K للتركيز على البحث
        if ((event.ctrlKey || event.metaKey) && event.key === 'k') {
            event.preventDefault();
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
    }

    /**
     * الحصول على ترجمة نص
     * @param {string} key - مفتاح الترجمة
     * @returns {string}
     */
    function getTranslation(key) {
        const translations = window.practicalSolutions?.strings || {};
        return translations[key] || key;
    }

    /**
     * إضافة أنماط CSS للبحث
     */
    function addSearchStyles() {
        if (document.getElementById('ps-search-styles')) return;

        const styles = `
            .search-loading {
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%);
                background: white;
                padding: 1rem;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1001;
                display: none;
                align-items: center;
                gap: 0.5rem;
            }

            .search-loading-spinner {
                width: 16px;
                height: 16px;
                border: 2px solid #f3f3f3;
                border-top: 2px solid #007cba;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .search-highlight {
                background-color: #fff3cd;
                color: #856404;
                padding: 0.1em 0.2em;
                border-radius: 3px;
                font-weight: 600;
            }

            .suggestions-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #f0f0f0;
                font-size: 0.85rem;
                color: #666;
                font-weight: 500;
            }

            .clear-history-btn {
                background: none;
                border: none;
                cursor: pointer;
                padding: 0.25rem;
                border-radius: 4px;
                color: #999;
                transition: all 0.2s ease;
            }

            .clear-history-btn:hover {
                background-color: #f5f5f5;
                color: #666;
            }

            .recent-search .recent-icon {
                margin-left: 0.5rem;
                color: #999;
            }

            .suggestion-excerpt {
                font-size: 0.8rem;
                color: #666;
                margin-top: 0.25rem;
                line-height: 1.3;
            }

            @media (max-width: 768px) {
                .search-suggestions {
                    left: -10px;
                    right: -10px;
                }
            }
        `;

        const styleSheet = PracticalSolutionsUtils.createElement('style', {
            id: 'ps-search-styles'
        }, styles);

        document.head.appendChild(styleSheet);
    }

    /**
     * تدمير نظام البحث
     */
    function destroy() {
        // إزالة مستمعي الأحداث
        if (searchInput) {
            searchInput.removeEventListener('input', handleInputChange);
            searchInput.removeEventListener('focus', handleInputFocus);
            searchInput.removeEventListener('blur', handleInputBlur);
            searchInput.removeEventListener('keydown', handleKeydown);
        }

        if (searchForm) {
            searchForm.removeEventListener('submit', handleFormSubmit);
        }

        if (clearButton) {
            clearButton.removeEventListener('click', clearSearch);
        }

        document.removeEventListener('click', handleDocumentClick);
        document.removeEventListener('keydown', handleGlobalKeydown);

        // مسح المتغيرات
        clearTimeout(debounceTimer);
        instance = null;
        
        PracticalSolutionsUtils.log('تم تدمير نظام البحث');
    }

    /**
     * تنفيذ بحث برمجي
     * @param {string} query - نص البحث
     */
    function performSearch(query) {
        if (searchInput) {
            searchInput.value = query;
            if (searchForm) {
                searchForm.submit();
            }
        }
    }

    // إرجاع الوظائف العامة
    return {
        init: init
    };

})();