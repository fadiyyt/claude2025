<?php
/**
 * نموذج البحث لقالب محتوى
 * 
 * @package Muhtawaa
 */

$unique_id = wp_unique_id('search-form-');
$aria_label = ! empty($args['aria_label']) ? 'aria-label="' . esc_attr($args['aria_label']) . '"' : '';
?>

<form role="search" <?php echo $aria_label; ?> method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-input-wrapper" style="position: relative; display: flex; align-items: center;">
        <label for="<?php echo esc_attr($unique_id); ?>" class="screen-reader-text" style="position: absolute; left: -9999px;">
            <?php _e('البحث عن:', 'muhtawaa'); ?>
        </label>
        
        <input type="search" 
               id="<?php echo esc_attr($unique_id); ?>"
               class="search-field" 
               placeholder="<?php echo esc_attr_x('ابحث عن حل لمشكلتك...', 'placeholder', 'muhtawaa'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               autocomplete="off"
               style="border: none; outline: none; padding: 10px 15px; border-radius: 20px; flex: 1; font-size: 14px; background: transparent;"
               required />
        
        <button type="submit" 
                class="search-submit" 
                aria-label="<?php echo esc_attr_x('بحث', 'submit button', 'muhtawaa'); ?>"
                style="background: #667eea; color: white; border: none; padding: 10px 15px; border-radius: 20px; cursor: pointer; transition: background 0.3s; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-search" aria-hidden="true"></i>
            <span class="search-text" style="margin-right: 5px; display: none;">بحث</span>
        </button>
    </div>
    
    <!-- Search Suggestions Container -->
    <div class="search-suggestions-container" style="position: absolute; top: 100%; left: 0; right: 0; z-index: 1001; display: none;">
        <!-- سيتم ملء هذا بواسطة JavaScript -->
    </div>
    
    <!-- Quick Search Filters -->
    <div class="quick-search-filters" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border-radius: 0 0 20px 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); z-index: 1000; padding: 1rem;">
        <div class="filter-header" style="margin-bottom: 1rem;">
            <h4 style="margin: 0; color: #667eea; font-size: 0.9rem;">🔍 بحث سريع في:</h4>
        </div>
        
        <div class="filter-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 0.5rem;">
            <?php
            // الحصول على الفئات الشائعة
            $popular_categories = get_terms(array(
                'taxonomy' => 'solution_category',
                'number' => 6,
                'hide_empty' => true,
                'orderby' => 'count',
                'order' => 'DESC'
            ));
            
            if ($popular_categories && !is_wp_error($popular_categories)) {
                foreach ($popular_categories as $category) {
                    $icon = muhtawaa_get_category_icon($category->name);
                    echo '<button type="button" class="filter-option" data-category="' . esc_attr($category->slug) . '" style="background: #f8f9fa; border: 1px solid #dee2e6; color: #495057; padding: 0.5rem; border-radius: 15px; cursor: pointer; font-size: 0.8rem; transition: all 0.3s; text-align: center;">';
                    echo '<span style="display: block; font-size: 1.2rem; margin-bottom: 0.25rem;">' . $icon . '</span>';
                    echo '<span>' . $category->name . '</span>';
                    echo '</button>';
                }
            }
            ?>
        </div>
        
        <div class="popular-searches" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e9ecef;">
            <h5 style="margin: 0 0 0.5rem 0; color: #6c757d; font-size: 0.8rem;">البحث الشائع:</h5>
            <div class="popular-terms" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                <?php
                // كلمات البحث الشائعة (يمكن تخصيصها)
                $popular_terms = array(
                    'تنظيف المنزل',
                    'توفير الكهرباء', 
                    'حلول المطبخ',
                    'إزالة البقع',
                    'صيانة السيارة',
                    'حلول سريعة'
                );
                
                foreach ($popular_terms as $term) {
                    echo '<button type="button" class="popular-term" data-term="' . esc_attr($term) . '" style="background: white; border: 1px solid #dee2e6; color: #6c757d; padding: 0.25rem 0.75rem; border-radius: 15px; cursor: pointer; font-size: 0.8rem; transition: all 0.3s;">';
                    echo $term;
                    echo '</button>';
                }
                ?>
            </div>
        </div>
    </div>
</form>

<style>
/* تحسينات CSS لنموذج البحث */
.search-form {
    position: relative;
    display: flex;
    background: white;
    border-radius: 25px;
    padding: 5px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s;
}

.search-form:focus-within {
    box-shadow: 0 2px 20px rgba(102, 126, 234, 0.2);
}

.search-input-wrapper {
    width: 100%;
}

.search-field {
    width: 100%;
}

.search-field:focus {
    outline: none;
}

.search-submit:hover,
.search-submit:focus {
    background: #5a6fd8 !important;
    outline: none;
    transform: scale(1.05);
}

.search-submit:active {
    transform: scale(0.95);
}

/* Search Suggestions */
.search-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-result-item {
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background-color 0.2s;
}

.search-result-item:hover,
.search-result-item:focus {
    background: #f8f9fa;
}

.search-result-item:last-child {
    border-bottom: none;
    border-radius: 0 0 20px 20px;
}

.search-result-item a {
    text-decoration: none;
    color: #333;
    display: block;
}

.result-title {
    font-weight: 600;
    display: block;
    margin-bottom: 0.25rem;
    color: #333;
}

.result-category {
    font-size: 0.85em;
    color: #667eea;
    background: #f0f4ff;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    display: inline-block;
}

.result-excerpt {
    font-size: 0.9em;
    color: #6c757d;
    margin-top: 0.25rem;
    line-height: 1.4;
}

/* Quick Filters */
.filter-option:hover,
.filter-option:focus {
    background: #667eea !important;
    color: white !important;
    border-color: #667eea !important;
    transform: translateY(-2px);
}

.filter-option.active {
    background: #667eea !important;
    color: white !important;
    border-color: #667eea !important;
}

.popular-term:hover,
.popular-term:focus {
    background: #667eea !important;
    color: white !important;
    border-color: #667eea !important;
}

/* Loading State */
.search-form.loading .search-submit {
    pointer-events: none;
}

.search-form.loading .search-submit::after {
    content: '';
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 5px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* No Results */
.no-search-results {
    padding: 2rem;
    text-align: center;
    color: #6c757d;
}

.no-search-results i {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

/* تحسينات الموبايل */
@media (max-width: 768px) {
    .search-form {
        max-width: 100%;
    }
    
    .search-field {
        font-size: 16px; /* منع التكبير في iOS */
    }
    
    .search-text {
        display: none !important;
    }
    
    .filter-options {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .popular-terms {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .search-form {
        padding: 3px;
    }
    
    .search-field {
        padding: 8px 12px;
        font-size: 14px;
    }
    
    .search-submit {
        padding: 8px 12px;
    }
    
    .filter-options {
        grid-template-columns: 1fr;
    }
}

/* تحسينات الوصولية */
@media (prefers-reduced-motion: reduce) {
    .search-dropdown,
    .filter-option,
    .popular-term,
    .search-submit {
        animation: none;
        transition: none;
    }
}

/* حالة التركيز المحسنة */
.search-field:focus,
.search-submit:focus,
.filter-option:focus,
.popular-term:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* الطباعة */
@media print {
    .search-form {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.search-form');
    const searchField = searchForm.querySelector('.search-field');
    const searchSubmit = searchForm.querySelector('.search-submit');
    const suggestionsContainer = searchForm.querySelector('.search-suggestions-container');
    const quickFilters = searchForm.querySelector('.quick-search-filters');
    
    let searchTimeout;
    let currentFocus = -1;
    
    // إظهار/إخفاء الفلاتر السريعة
    searchField.addEventListener('focus', function() {
        if (this.value.length === 0) {
            showQuickFilters();
        }
    });
    
    // البحث المباشر
    searchField.addEventListener('input', function() {
        const query = this.value.trim();
        currentFocus = -1;
        
        clearTimeout(searchTimeout);
        
        if (query.length === 0) {
            hideSuggestions();
            showQuickFilters();
            return;
        }
        
        hideQuickFilters();
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => {
                performLiveSearch(query);
            }, 300);
        } else {
            hideSuggestions();
        }
    });
    
    // التنقل بلوحة المفاتيح
    searchField.addEventListener('keydown', function(e) {
        const suggestions = suggestionsContainer.querySelectorAll('.search-result-item');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            currentFocus++;
            addActive(suggestions);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            currentFocus--;
            addActive(suggestions);
        } else if (e.key === 'Enter') {
            if (currentFocus > -1 && suggestions[currentFocus]) {
                e.preventDefault();
                suggestions[currentFocus].querySelector('a').click();
            }
        } else if (e.key === 'Escape') {
            hideSuggestions();
            hideQuickFilters();
            this.blur();
        }
    });
    
    function addActive(suggestions) {
        if (!suggestions.length) return;
        
        removeActive(suggestions);
        
        if (currentFocus >= suggestions.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = suggestions.length - 1;
        
        suggestions[currentFocus].classList.add('active');
        suggestions[currentFocus].style.background = '#f8f9fa';
    }
    
    function removeActive(suggestions) {
        suggestions.forEach(item => {
            item.classList.remove('active');
            item.style.background = '';
        });
    }
    
    // البحث المباشر
    function performLiveSearch(query) {
        searchForm.classList.add('loading');
        
        fetch(muhtawaa_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=live_search&search_term=${encodeURIComponent(query)}&nonce=${muhtawaa_ajax.nonce}`
        })
        .then(response => response.json())
        .then(data => {
            searchForm.classList.remove('loading');
            
            if (data.success && data.data.length > 0) {
                showSearchResults(data.data, query);
            } else {
                showNoResults(query);
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            searchForm.classList.remove('loading');
            showNoResults(query);
        });
    }
    
    function showSearchResults(results, query) {
        let html = '<div class="search-dropdown">';
        
        results.forEach((result, index) => {
            // تمييز النص المطابق
            const highlightedTitle = highlightSearchTerm(result.title, query);
            const highlightedExcerpt = result.excerpt ? highlightSearchTerm(result.excerpt, query) : '';
            
            html += `
                <div class="search-result-item" data-index="${index}">
                    <a href="${result.url}">
                        <span class="result-title">${highlightedTitle}</span>
                        <span class="result-category">${result.category}</span>
                        ${highlightedExcerpt ? `<div class="result-excerpt">${highlightedExcerpt}</div>` : ''}
                    </a>
                </div>
            `;
        });
        
        html += '</div>';
        
        suggestionsContainer.innerHTML = html;
        suggestionsContainer.style.display = 'block';
        
        // إضافة مستمعي الأحداث
        const items = suggestionsContainer.querySelectorAll('.search-result-item');
        items.forEach((item, index) => {
            item.addEventListener('mouseenter', () => {
                currentFocus = index;
                addActive(items);
            });
            
            item.addEventListener('click', () => {
                // تتبع النقرات للإحصائيات
                trackSearchClick(query, item.querySelector('a').href);
            });
        });
    }
    
    function showNoResults(query) {
        const html = `
            <div class="search-dropdown">
                <div class="no-search-results">
                    <i class="fas fa-search"></i>
                    <h4>لم نجد نتائج لـ "${query}"</h4>
                    <p>جرب كلمات مفتاحية أخرى أو تصفح فئات الحلول</p>
                </div>
            </div>
        `;
        
        suggestionsContainer.innerHTML = html;
        suggestionsContainer.style.display = 'block';
    }
    
    function highlightSearchTerm(text, term) {
        if (!term || !text) return text;
        
        const regex = new RegExp(`(${term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(regex, '<mark style="background: #fff3cd; padding: 0.1em 0.2em; border-radius: 0.2em;">$1</mark>');
    }
    
    function showQuickFilters() {
        quickFilters.style.display = 'block';
        quickFilters.setAttribute('aria-hidden', 'false');
    }
    
    function hideQuickFilters() {
        quickFilters.style.display = 'none'; 
        quickFilters.setAttribute('aria-hidden', 'true');
    }
    
    function hideSuggestions() {
        suggestionsContainer.style.display = 'none';
        suggestionsContainer.innerHTML = '';
        currentFocus = -1;
    }
    
    // معالج الفلاتر السريعة
    const filterOptions = quickFilters.querySelectorAll('.filter-option');
    filterOptions.forEach(option => {
        option.addEventListener('click', function() {
            const category = this.dataset.category;
            searchField.value = this.textContent.trim();
            hideQuickFilters();
            searchForm.submit();
        });
    });
    
    // معالج الكلمات الشائعة
    const popularTerms = quickFilters.querySelectorAll('.popular-term');
    popularTerms.forEach(term => {
        term.addEventListener('click', function() {
            const searchTerm = this.dataset.term;
            searchField.value = searchTerm;
            hideQuickFilters();
            performLiveSearch(searchTerm);
        });
    });
    
    // إغلاق عند النقر خارج النموذج
    document.addEventListener('click', function(e) {
        if (!searchForm.contains(e.target)) {
            hideSuggestions();
            hideQuickFilters();
        }
    });
    
    // تتبع البحث
    searchForm.addEventListener('submit', function(e) {
        const query = searchField.value.trim();
        if (query.length > 0) {
            trackSearch(query);
        }
    });
    
    function trackSearch(query) {
        // إرسال إحصائيات البحث
        fetch(muhtawaa_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=track_search&search_term=${encodeURIComponent(query)}&nonce=${muhtawaa_ajax.nonce}`
        }).catch(error => console.error('Search tracking error:', error));
    }
    
    function trackSearchClick(query, url) {
        // تتبع النقر على نتائج البحث
        fetch(muhtawaa_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=track_search_click&search_term=${encodeURIComponent(query)}&result_url=${encodeURIComponent(url)}&nonce=${muhtawaa_ajax.nonce}`
        }).catch(error => console.error('Search click tracking error:', error));
    }
    
    // تحسين الأداء - debounce
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
    
    // Voice Search (إذا كان متاحاً)
    if ('webkitSpeechRecognition' in window) {
        const voiceBtn = document.createElement('button');
        voiceBtn.type = 'button';
        voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        voiceBtn.className = 'voice-search-btn';
        voiceBtn.style.cssText = `
            background: #f8f9fa;
            border: none;
            padding: 8px;
            border-radius: 50%;
            margin-left: 5px;
            cursor: pointer;
            color: #6c757d;
            transition: all 0.3s;
        `;
        voiceBtn.title = 'البحث الصوتي';
        
        const inputWrapper = searchForm.querySelector('.search-input-wrapper');
        inputWrapper.appendChild(voiceBtn);
        
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'ar-SA';
        recognition.continuous = false;
        recognition.interimResults = false;
        
        voiceBtn.addEventListener('click', function() {
            this.style.color = '#dc3545';
            recognition.start();
        });
        
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            searchField.value = transcript;
            voiceBtn.style.color = '#6c757d';
            performLiveSearch(transcript);
        };
        
        recognition.onerror = function() {
            voiceBtn.style.color = '#6c757d';
        };
    }
});
</script>