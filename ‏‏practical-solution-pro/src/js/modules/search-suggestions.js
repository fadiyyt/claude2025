/**
 * Search Suggestions Module
 * وحدة اقتراحات البحث
 */

export function initSearchSuggestions() {
    let searchTimeout;
    
    document.querySelectorAll('.ps-search-input').forEach(input => {
        const suggestionsContainer = input.parentElement.querySelector('.ps-search-suggestions');
        
        if (!suggestionsContainer) return;
        
        input.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                hideSuggestions(suggestionsContainer);
                return;
            }
            
            showLoadingSuggestion(suggestionsContainer);
            
            searchTimeout = setTimeout(() => {
                fetchSuggestions(query, suggestionsContainer);
            }, 300);
        });
        
        input.addEventListener('blur', function() {
            // تأخير إخفاء الاقتراحات للسماح بالنقر عليها
            setTimeout(() => {
                hideSuggestions(suggestionsContainer);
            }, 200);
        });
        
        input.addEventListener('focus', function() {
            if (this.value.trim().length >= 2) {
                showSuggestions(suggestionsContainer);
            }
        });
    });
    
    // معالجة النقر على الاقتراحات
    document.addEventListener('click', function(e) {
        if (e.target.closest('.ps-suggestion-item')) {
            const suggestion = e.target.closest('.ps-suggestion-item');
            const url = suggestion.dataset.url;
            
            if (url) {
                window.location.href = url;
            }
        }
    });
}

function fetchSuggestions(query, container) {
    const formData = new FormData();
    formData.append('action', 'ps_get_suggestions');
    formData.append('query', query);
    formData.append('nonce', window.psAjax?.nonce || '');
    
    fetch(window.psAjax?.ajaxurl || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data.length > 0) {
            renderSuggestions(data.data, container);
        } else {
            showNoResults(container);
        }
    })
    .catch(error => {
        console.error('Search suggestions error:', error);
        hideSuggestions(container);
    });
}

function renderSuggestions(suggestions, container) {
    container.innerHTML = '';
    
    suggestions.forEach(suggestion => {
        const item = document.createElement('div');
        item.className = 'ps-suggestion-item';
        item.dataset.url = suggestion.url;
        
        item.innerHTML = `
            <span class="ps-suggestion-icon">🔍</span>
            <span class="ps-suggestion-text">${suggestion.title}</span>
        `;
        
        container.appendChild(item);
    });
    
    showSuggestions(container);
}

function showLoadingSuggestion(container) {
    container.innerHTML = `
        <div class="ps-suggestion-item">
            <span class="ps-suggestion-icon">⏳</span>
            <span class="ps-suggestion-text">جاري البحث...</span>
        </div>
    `;
    showSuggestions(container);
}

function showNoResults(container) {
    container.innerHTML = `
        <div class="ps-suggestion-item">
            <span class="ps-suggestion-icon">❌</span>
            <span class="ps-suggestion-text">لا توجد نتائج</span>
        </div>
    `;
    showSuggestions(container);
}

function showSuggestions(container) {
    container.style.display = 'block';
}

function hideSuggestions(container) {
    container.style.display = 'none';
}

export default { initSearchSuggestions };