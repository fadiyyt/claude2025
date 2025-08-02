/**
 * نظام البحث التفاعلي المباشر
 * Interactive Live Search System
 * 
 * @package Muhtawaa
 * @version 2.0
 */

(function($) {
    'use strict';

    const MuhtawaaSearch = {
        // إعدادات البحث
        settings: {
            minLength: 2,
            debounceDelay: 300,
            maxResults: 10,
            enableAutocomplete: true,
            enableCategories: true,
            enableFilters: true,
            cacheResults: true,
            cacheExpiry: 300000, // 5 دقائق
            highlightTerms: true,
            showExcerpts: true,
            excerptLength: 150
        },

        // حالة البحث
        state: {
            isSearching: false,
            currentQuery: '',
            selectedIndex: -1,
            cache: new Map(),
            searchHistory: [],
            recentSearches: [],
            activeFilters: {
                category: '',
                tags: [],
                dateRange: '',
                difficulty: '',
                contentType: ''
            }
        },

        // عناصر DOM
        elements: {
            $searchForm: $('.search-form'),
            $searchInput: $('.search-input'),
            $searchResults: $('.search-results'),
            $searchSuggestions: $('.search-suggestions'),
            $searchFilters: $('.search-filters'),
            $loadingIndicator: $('.search-loading'),
            $noResults: $('.no-results'),
            $searchHistory: $('.search-history'),
            $clearHistory: $('.clear-search-history')
        },

        // تهيئة نظام البحث
        init: function() {
            this.createSearchInterface();
            this.bindEvents();
            this.loadSearchHistory();
            this.initializeFilters();
            
            console.log('🔍 Muhtawaa Search System initialized');
        },

        // إنشاء واجهة البحث
        createSearchInterface: function() {
            // إنشاء حاوي النتائج إذا لم يكن موجوداً
            if (!this.elements.$searchResults.length) {
                this.elements.$searchResults = $('<div class="search-results"></div>');
                this.elements.$searchForm.after(this.elements.$searchResults);
            }

            // إنشاء حاوي الاقتراحات
            if (!this.elements.$searchSuggestions.length) {
                this.elements.$searchSuggestions = $('<div class="search-suggestions"></div>');
                this.elements.$searchResults.before(this.elements.$searchSuggestions);
            }

            // إنشاء مؤشر التحميل
            if (!this.elements.$loadingIndicator.length) {
                this.elements.$loadingIndicator = $('<div class="search-loading"><div class="loading-spinner"></div><span>جاري البحث...</span></div>');
                this.elements.$searchResults.before(this.elements.$loadingIndicator);
            }

            // إضافة خصائص إمكانية الوصول
            this.setupAccessibility();
        },

        // ربط الأحداث
        bindEvents: function() {
            const self = this;

            // البحث أثناء الكتابة
            this.elements.$searchInput.on('input', this.debounce(this.handleInput.bind(this), this.settings.debounceDelay));

            // أحداث لوحة المفاتيح
            this.elements.$searchInput.on('keydown', this.handleKeydown.bind(this));

            // التركيز والإلغاء
            this.elements.$searchInput.on('focus', this.handleFocus.bind(this));
            this.elements.$searchInput.on('blur', this.handleBlur.bind(this));

            // إرسال النموذج
            this.elements.$searchForm.on('submit', this.handleSubmit.bind(this));

            // النقر على النتائج
            $(document).on('click', '.search-result-item', this.handleResultClick.bind(this));

            // النقر على الاقتراحات
            $(document).on('click', '.search-suggestion-item', this.handleSuggestionClick.bind(this));

            // تغيير الفلاتر
            $(document).on('change', '.search-filter', this.handleFilterChange.bind(this));

            // مسح التاريخ
            this.elements.$clearHistory.on('click', this.clearSearchHistory.bind(this));

            // البحث الصوتي (إذا كان متاحاً)
            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                this.initVoiceSearch();
            }
        },

        // إدارة الإدخال
        handleInput: function(e) {
            const query = e.target.value.trim();
            
            if (query.length >= this.settings.minLength) {
                this.performSearch(query);
            } else if (query.length === 0) {
                this.clearResults();
                this.showSearchHistory();
            } else {
                this.clearResults();
            }
        },

        // إدارة أحداث لوحة المفاتيح
        handleKeydown: function(e) {
            const $results = this.elements.$searchResults.find('.search-result-item');
            const totalResults = $results.length;

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    this.state.selectedIndex = Math.min(this.state.selectedIndex + 1, totalResults - 1);
                    this.updateSelection($results);
                    break;

                case 'ArrowUp':
                    e.preventDefault();
                    this.state.selectedIndex = Math.max(this.state.selectedIndex - 1, -1);
                    this.updateSelection($results);
                    break;

                case 'Enter':
                    e.preventDefault();
                    if (this.state.selectedIndex >= 0) {
                        const $selected = $results.eq(this.state.selectedIndex);
                        this.selectResult($selected);
                    } else {
                        this.handleSubmit(e);
                    }
                    break;

                case 'Escape':
                    this.clearResults();
                    this.elements.$searchInput.blur();
                    break;

                case 'Tab':
                    if (this.settings.enableAutocomplete && this.state.selectedIndex >= 0) {
                        e.preventDefault();
                        const $selected = $results.eq(this.state.selectedIndex);
                        const title = $selected.find('.result-title').text();
                        this.elements.$searchInput.val(title);
                    }
                    break;
            }
        },

        // تحديث التحديد
        updateSelection: function($results) {
            $results.removeClass('selected');
            
            if (this.state.selectedIndex >= 0) {
                $results.eq(this.state.selectedIndex).addClass('selected');
                
                // تمرير إلى العنصر المحدد
                const $selected = $results.eq(this.state.selectedIndex);
                const container = this.elements.$searchResults[0];
                const selectedElement = $selected[0];
                
                if (selectedElement && container) {
                    const containerHeight = container.clientHeight;
                    const selectedTop = selectedElement.offsetTop;
                    const selectedHeight = selectedElement.clientHeight;
                    
                    if (selectedTop < container.scrollTop) {
                        container.scrollTop = selectedTop;
                    } else if (selectedTop + selectedHeight > container.scrollTop + containerHeight) {
                        container.scrollTop = selectedTop + selectedHeight - containerHeight;
                    }
                }
            }
        },

        // إدارة التركيز
        handleFocus: function() {
            const query = this.elements.$searchInput.val().trim();
            
            if (query.length >= this.settings.minLength) {
                this.showResults();
            } else {
                this.showSearchHistory();
            }
        },

        // إدارة فقدان التركيز
        handleBlur: function() {
            // تأخير إخفاء النتائج للسماح بالنقر عليها
            setTimeout(() => {
                this.hideResults();
            }, 200);
        },

        // إدارة إرسال النموذج
        handleSubmit: function(e) {
            e.preventDefault();
            const query = this.elements.$searchInput.val().trim();
            
            if (query.length >= this.settings.minLength) {
                this.addToSearchHistory(query);
                this.redirectToSearchPage(query);
            }
        },

        // تنفيذ البحث
        performSearch: function(query) {
            if (this.state.isSearching) {
                return;
            }

            this.state.currentQuery = query;
            this.state.selectedIndex = -1;

            // التحقق من وجود النتائج في الذاكرة المؤقتة
            const cacheKey = this.getCacheKey(query);
            const cachedResults = this.getFromCache(cacheKey);

            if (cachedResults) {
                this.displayResults(cachedResults, query);
                return;
            }

            // عرض مؤشر التحميل
            this.showLoading();

            // إجراء البحث
            this.searchRequest = $.ajax({
                url: muhtawaa_search.ajax_url,
                type: 'POST',
                data: {
                    action: 'muhtawaa_live_search',
                    query: query,
                    filters: this.state.activeFilters,
                    max_results: this.settings.maxResults,
                    nonce: muhtawaa_search.nonce
                },
                success: (response) => {
                    this.hideLoading();
                    
                    if (response.success) {
                        const results = response.data;
                        this.saveToCache(cacheKey, results);
                        this.displayResults(results, query);
                        this.updateSuggestions(results.suggestions || []);
                    } else {
                        this.showError(response.data.message || 'حدث خطأ في البحث');
                    }
                },
                error: () => {
                    this.hideLoading();
                    this.showError('حدث خطأ في الاتصال');
                },
                complete: () => {
                    this.state.isSearching = false;
                }
            });
        },

        // عرض النتائج
        displayResults: function(results, query) {
            if (!results.posts || results.posts.length === 0) {
                this.showNoResults(query);
                return;
            }

            let html = '<div class="search-results-header">';
            html += `<span class="results-count">تم العثور على ${results.total_found} نتيجة</span>`;
            if (results.search_time) {
                html += `<span class="search-time">(${results.search_time} ثانية)</span>`;
            }
            html += '</div>';

            html += '<div class="search-results-list">';

            results.posts.forEach((post, index) => {
                html += this.createResultItem(post, query, index);
            });

            html += '</div>';

            // إضافة رابط "عرض جميع النتائج" إذا كان هناك المزيد
            if (results.total_found > this.settings.maxResults) {
                html += `<div class="search-results-footer">
                    <a href="${this.getSearchPageUrl(query)}" class="view-all-results">
                        عرض جميع النتائج (${results.total_found})
                    </a>
                </div>`;
            }

            this.elements.$searchResults.html(html).addClass('visible');
            this.elements.$noResults.hide();
        },

        // إنشاء عنصر نتيجة
        createResultItem: function(post, query, index) {
            const highlightedTitle = this.settings.highlightTerms ? 
                this.highlightSearchTerms(post.title, query) : post.title;
            
            const highlightedExcerpt = this.settings.highlightTerms ? 
                this.highlightSearchTerms(post.excerpt, query) : post.excerpt;

            let html = `<div class="search-result-item" data-post-id="${post.id}" data-index="${index}">`;
            
            // صورة مميزة
            if (post.thumbnail) {
                html += `<div class="result-thumbnail">
                    <img src="${post.thumbnail}" alt="${post.title}" loading="lazy">
                </div>`;
            }

            html += '<div class="result-content">';
            
            // العنوان
            html += `<h3 class="result-title">
                <a href="${post.url}">${highlightedTitle}</a>
            </h3>`;

            // المعلومات الإضافية
            html += '<div class="result-meta">';
            
            if (post.category) {
                html += `<span class="result-category">
                    <i class="fas fa-folder"></i> ${post.category}
                </span>`;
            }

            if (post.date) {
                html += `<span class="result-date">
                    <i class="fas fa-calendar"></i> ${post.date}
                </span>`;
            }

            if (post.difficulty) {
                html += `<span class="result-difficulty difficulty-${post.difficulty}">
                    <i class="fas fa-signal"></i> ${this.getDifficultyLabel(post.difficulty)}
                </span>`;
            }

            html += '</div>';

            // المقطع
            if (this.settings.showExcerpts && post.excerpt) {
                html += `<div class="result-excerpt">${highlightedExcerpt}</div>`;
            }

            // العلامات
            if (post.tags && post.tags.length > 0) {
                html += '<div class="result-tags">';
                post.tags.forEach(tag => {
                    html += `<span class="result-tag">${tag}</span>`;
                });
                html += '</div>';
            }

            html += '</div>'; // إنهاء result-content
            html += '</div>'; // إنهاء search-result-item

            return html;
        },

        // تسليط الضوء على مصطلحات البحث
        highlightSearchTerms: function(text, query) {
            if (!text || !query) return text;

            const terms = query.split(/\s+/).filter(term => term.length > 1);
            let highlightedText = text;

            terms.forEach(term => {
                const regex = new RegExp(`(${this.escapeRegex(term)})`, 'gi');
                highlightedText = highlightedText.replace(regex, '<mark>$1</mark>');
            });

            return highlightedText;
        },

        // تحديث الاقتراحات
        updateSuggestions: function(suggestions) {
            if (!this.settings.enableAutocomplete || !suggestions.length) {
                this.elements.$searchSuggestions.hide();
                return;
            }

            let html = '<div class="suggestions-header">اقتراحات:</div>';
            html += '<div class="suggestions-list">';

            suggestions.forEach((suggestion, index) => {
                html += `<div class="search-suggestion-item" data-suggestion="${suggestion}" data-index="${index}">
                    <i class="fas fa-search"></i>
                    <span>${suggestion}</span>
                </div>`;
            });

            html += '</div>';

            this.elements.$searchSuggestions.html(html).show();
        },

        // عرض عدم وجود نتائج
        showNoResults: function(query) {
            const html = `
                <div class="no-results-message">
                    <i class="fas fa-search fa-3x"></i>
                    <h3>لم يتم العثور على نتائج</h3>
                    <p>عذراً، لم نتمكن من العثور على أي نتائج لـ "<strong>${query}</strong>"</p>
                    <div class="search-suggestions-tips">
                        <h4>نصائح للبحث:</h4>
                        <ul>
                            <li>تأكد من صحة الكتابة</li>
                            <li>جرب استخدام كلمات مختلفة أو مرادفات</li>
                            <li>استخدم كلمات أقل أو أكثر عمومية</li>
                            <li>تحقق من الفلاتر المطبقة</li>
                        </ul>
                    </div>
                </div>
            `;

            this.elements.$searchResults.html(html).addClass('visible');
            this.showSearchHistory();
        },

        // عرض مؤشر التحميل
        showLoading: function() {
            this.state.isSearching = true;
            this.elements.$loadingIndicator.show();
            this.elements.$searchResults.hide();
            this.elements.$searchSuggestions.hide();
        },

        // إخفاء مؤشر التحميل
        hideLoading: function() {
            this.elements.$loadingIndicator.hide();
        },

        // عرض خطأ
        showError: function(message) {
            const html = `
                <div class="search-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>حدث خطأ</h3>
                    <p>${message}</p>
                    <button class="btn btn-primary retry-search">إعادة المحاولة</button>
                </div>
            `;

            this.elements.$searchResults.html(html).addClass('visible');
        },

        // إظهار النتائج
        showResults: function() {
            this.elements.$searchResults.show();
        },

        // إخفاء النتائج
        hideResults: function() {
            this.elements.$searchResults.hide();
            this.elements.$searchSuggestions.hide();
        },

        // مسح النتائج
        clearResults: function() {
            this.elements.$searchResults.empty().removeClass('visible');
            this.elements.$searchSuggestions.empty().hide();
            this.state.selectedIndex = -1;
            
            // إلغاء طلب البحث الحالي
            if (this.searchRequest) {
                this.searchRequest.abort();
                this.state.isSearching = false;
            }
        },

        // إدارة النقر على النتيجة
        handleResultClick: function(e) {
            const $item = $(e.currentTarget);
            this.selectResult($item);
        },

        // إدارة النقر على الاقتراح
        handleSuggestionClick: function(e) {
            const $item = $(e.currentTarget);
            const suggestion = $item.data('suggestion');
            
            this.elements.$searchInput.val(suggestion);
            this.performSearch(suggestion);
        },

        // تحديد النتيجة
        selectResult: function($item) {
            const url = $item.find('a').attr('href');
            const postId = $item.data('post-id');
            
            // إضافة إلى التاريخ
            this.addToSearchHistory(this.state.currentQuery);
            
            // تتبع النقرة
            this.trackSearchClick(postId, this.state.currentQuery);
            
            // الانتقال إلى الصفحة
            window.location.href = url;
        },

        // إدارة تغيير الفلاتر
        handleFilterChange: function(e) {
            const $filter = $(e.target);
            const filterType = $filter.data('filter');
            const filterValue = $filter.val();

            this.state.activeFilters[filterType] = filterValue;
            
            // إعادة البحث مع الفلاتر الجديدة
            const query = this.elements.$searchInput.val().trim();
            if (query.length >= this.settings.minLength) {
                this.clearCache(); // مسح الذاكرة المؤقتة لأن الفلاتر تغيرت
                this.performSearch(query);
            }

            // تحديث عداد الفلاتر
            this.updateFilterCounter();
        },

        // تحديث عداد الفلاتر
        updateFilterCounter: function() {
            const activeCount = Object.values(this.state.activeFilters)
                .filter(value => value && value.length > 0).length;
            
            const $counter = $('.active-filters-count');
            if (activeCount > 0) {
                $counter.text(activeCount).show();
            } else {
                $counter.hide();
            }
        },

        // إدارة تاريخ البحث
        addToSearchHistory: function(query) {
            if (!query || this.state.searchHistory.includes(query)) {
                return;
            }

            this.state.searchHistory.unshift(query);
            
            // الاحتفاظ بـ 10 عمليات بحث فقط
            if (this.state.searchHistory.length > 10) {
                this.state.searchHistory = this.state.searchHistory.slice(0, 10);
            }

            this.saveSearchHistory();
        },

        // عرض تاريخ البحث
        showSearchHistory: function() {
            if (this.state.searchHistory.length === 0) {
                return;
            }

            let html = '<div class="search-history-header">عمليات البحث الأخيرة:</div>';
            html += '<div class="search-history-list">';

            this.state.searchHistory.forEach(query => {
                html += `<div class="search-history-item" data-query="${query}">
                    <i class="fas fa-history"></i>
                    <span>${query}</span>
                    <button class="remove-history-item" data-query="${query}">×</button>
                </div>`;
            });

            html += '</div>';
            html += '<button class="clear-all-history">مسح جميع التاريخ</button>';

            this.elements.$searchResults.html(html).addClass('visible');
        },

        // حفظ تاريخ البحث
        saveSearchHistory: function() {
            try {
                localStorage.setItem('muhtawaa_search_history', JSON.stringify(this.state.searchHistory));
            } catch (e) {
                console.warn('لا يمكن حفظ تاريخ البحث:', e);
            }
        },

        // تحميل تاريخ البحث
        loadSearchHistory: function() {
            try {
                const saved = localStorage.getItem('muhtawaa_search_history');
                if (saved) {
                    this.state.searchHistory = JSON.parse(saved);
                }
            } catch (e) {
                console.warn('لا يمكن تحميل تاريخ البحث:', e);
                this.state.searchHistory = [];
            }
        },

        // مسح تاريخ البحث
        clearSearchHistory: function() {
            this.state.searchHistory = [];
            this.saveSearchHistory();
            this.clearResults();
        },

        // إدارة الذاكرة المؤقتة
        getCacheKey: function(query) {
            const filtersKey = JSON.stringify(this.state.activeFilters);
            return `search_${query}_${btoa(filtersKey)}`;
        },

        saveToCache: function(key, data) {
            if (!this.settings.cacheResults) return;

            this.state.cache.set(key, {
                data: data,
                timestamp: Date.now()
            });
        },

        getFromCache: function(key) {
            if (!this.settings.cacheResults) return null;

            const cached = this.state.cache.get(key);
            if (!cached) return null;

            // التحقق من انتهاء صلاحية الذاكرة المؤقتة
            if (Date.now() - cached.timestamp > this.settings.cacheExpiry) {
                this.state.cache.delete(key);
                return null;
            }

            return cached.data;
        },

        clearCache: function() {
            this.state.cache.clear();
        },

        // البحث الصوتي
        initVoiceSearch: function() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();
            
            this.recognition.lang = 'ar-SA';
            this.recognition.continuous = false;
            this.recognition.interimResults = false;

            // إضافة زر البحث الصوتي
            const $voiceBtn = $('<button type="button" class="voice-search-btn" title="البحث الصوتي"><i class="fas fa-microphone"></i></button>');
            this.elements.$searchForm.append($voiceBtn);

            $voiceBtn.on('click', () => {
                this.startVoiceSearch();
            });

            this.recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                this.elements.$searchInput.val(transcript);
                this.performSearch(transcript);
            };

            this.recognition.onerror = (event) => {
                console.warn('خطأ في البحث الصوتي:', event.error);
            };
        },

        startVoiceSearch: function() {
            if (this.recognition) {
                this.recognition.start();
                $('.voice-search-btn').addClass('listening');
                
                this.recognition.onend = () => {
                    $('.voice-search-btn').removeClass('listening');
                };
            }
        },

        // إعداد إمكانية الوصول
        setupAccessibility: function() {
            this.elements.$searchInput.attr({
                'role': 'searchbox',
                'aria-label': 'البحث في الموقع',
                'aria-describedby': 'search-instructions',
                'aria-autocomplete': 'list',
                'aria-expanded': 'false'
            });

            this.elements.$searchResults.attr({
                'role': 'listbox',
                'aria-label': 'نتائج البحث'
            });

            // إضافة تعليمات البحث
            if (!$('#search-instructions').length) {
                const instructions = $('<div id="search-instructions" class="sr-only">استخدم الأسهم للتنقل، Enter للاختيار، Escape للإغلاق</div>');
                this.elements.$searchForm.append(instructions);
            }
        },

        // دوال مساعدة
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        escapeRegex: function(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\        // عرض النتائج
        displayResults: function(results, query) {');
        },

        getDifficultyLabel: function(difficulty) {
            const labels = {
                'beginner': 'مبتدئ',
                'intermediate': 'متوسط',
                'advanced': 'متقدم',
                'expert': 'خبير'
            };
            return labels[difficulty] || difficulty;
        },

        getSearchPageUrl: function(query) {
            const params = new URLSearchParams();
            params.set('s', query);
            
            // إضافة الفلاتر النشطة
            Object.keys(this.state.activeFilters).forEach(key => {
                const value = this.state.activeFilters[key];
                if (value && value.length > 0) {
                    params.set(key, value);
                }
            });

            return `${window.location.origin}/?${params.toString()}`;
        },

        redirectToSearchPage: function(query) {
            window.location.href = this.getSearchPageUrl(query);
        },

        trackSearchClick: function(postId, query) {
            // إرسال إحصائيات النقر
            $.post(muhtawaa_search.ajax_url, {
                action: 'muhtawaa_track_search_click',
                post_id: postId,
                query: query,
                nonce: muhtawaa_search.nonce
            });
        },

        // تهيئة الفلاتر
        initializeFilters: function() {
            // إعداد فلاتر التاريخ
            this.setupDateRangeFilter();
            
            // إعداد فلاتر الفئات
            this.setupCategoryFilter();
            
            // إعداد فلاتر الصعوبة
            this.setupDifficultyFilter();
        },

        setupDateRangeFilter: function() {
            const $dateFilter = $('.date-range-filter');
            if ($dateFilter.length) {
                $dateFilter.on('change', (e) => {
                    this.state.activeFilters.dateRange = e.target.value;
                    this.handleFilterChange(e);
                });
            }
        },

        setupCategoryFilter: function() {
            const $categoryFilter = $('.category-filter');
            if ($categoryFilter.length) {
                $categoryFilter.on('change', (e) => {
                    this.state.activeFilters.category = e.target.value;
                    this.handleFilterChange(e);
                });
            }
        },

        setupDifficultyFilter: function() {
            const $difficultyFilter = $('.difficulty-filter');
            if ($difficultyFilter.length) {
                $difficultyFilter.on('change', (e) => {
                    this.state.activeFilters.difficulty = e.target.value;
                    this.handleFilterChange(e);
                });
            }
        },

        // تنظيف النظام
        destroy: function() {
            // إلغاء طلب البحث
            if (this.searchRequest) {
                this.searchRequest.abort();
            }

            // مسح الذاكرة المؤقتة
            this.clearCache();

            // إزالة مستمعي الأحداث
            this.elements.$searchInput.off('.muhtawaa-search');
            $(document).off('.muhtawaa-search');

            console.log('🧹 Muhtawaa Search destroyed');
        }
    };

    // API عامة للبحث
    window.MuhtawaaSearch = {
        init: MuhtawaaSearch.init.bind(MuhtawaaSearch),
        destroy: MuhtawaaSearch.destroy.bind(MuhtawaaSearch),
        search: MuhtawaaSearch.performSearch.bind(MuhtawaaSearch),
        clearResults: MuhtawaaSearch.clearResults.bind(MuhtawaaSearch),
        settings: MuhtawaaSearch.settings,
        state: MuhtawaaSearch.state
    };

    // تهيئة نظام البحث عند جاهزية DOM
    $(document).ready(function() {
        if (typeof muhtawaa_search !== 'undefined') {
            MuhtawaaSearch.init();
        }
    });

})(jQuery);