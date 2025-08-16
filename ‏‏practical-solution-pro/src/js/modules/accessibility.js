/**
 * Accessibility Module
 * وحدة إمكانية الوصول
 */

export function initAccessibility() {
    // تحسين التنقل بلوحة المفاتيح
    setupKeyboardNavigation();
    
    // إضافة aria-labels
    addAriaLabels();
    
    // تحسين focus management
    improveFocusManagement();
    
    // إضافة live regions
    setupLiveRegions();
}

function setupKeyboardNavigation() {
    document.querySelectorAll('[tabindex], button, a, input, select, textarea').forEach(element => {
        element.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                if (this.tagName.toLowerCase() === 'button' || this.getAttribute('role') === 'button') {
                    e.preventDefault();
                    this.click();
                }
            }
        });
    });
    
    // تحسين التنقل في الاقتراحات
    document.querySelectorAll('.ps-search-input').forEach(input => {
        input.addEventListener('keydown', function(e) {
            const suggestions = this.parentElement.querySelector('.ps-search-suggestions');
            
            if (!suggestions || suggestions.style.display === 'none') return;
            
            const items = suggestions.querySelectorAll('.ps-suggestion-item');
            let currentIndex = Array.from(items).findIndex(item => item.classList.contains('focused'));
            
            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    currentIndex = Math.min(currentIndex + 1, items.length - 1);
                    updateSuggestionFocus(items, currentIndex);
                    break;
                
                case 'ArrowUp':
                    e.preventDefault();
                    currentIndex = Math.max(currentIndex - 1, 0);
                    updateSuggestionFocus(items, currentIndex);
                    break;
                
                case 'Enter':
                    if (currentIndex >= 0 && items[currentIndex]) {
                        e.preventDefault();
                        items[currentIndex].click();
                    }
                    break;
                
                case 'Escape':
                    suggestions.style.display = 'none';
                    this.focus();
                    break;
            }
        });
    });
}

function updateSuggestionFocus(items, currentIndex) {
    items.forEach((item, index) => {
        if (index === currentIndex) {
            item.classList.add('focused');
            item.setAttribute('aria-selected', 'true');
        } else {
            item.classList.remove('focused');
            item.setAttribute('aria-selected', 'false');
        }
    });
}

function addAriaLabels() {
    // إضافة aria-labels للعناصر التفاعلية
    document.querySelectorAll('.ps-search-btn').forEach(btn => {
        if (!btn.getAttribute('aria-label')) {
            btn.setAttribute('aria-label', 'البحث');
        }
    });
    
    document.querySelectorAll('.ps-voice-btn').forEach(btn => {
        if (!btn.getAttribute('aria-label')) {
            btn.setAttribute('aria-label', 'البحث الصوتي');
        }
    });
    
    document.querySelectorAll('.ps-rating-star').forEach(star => {
        const rating = star.dataset.rating;
        if (!star.getAttribute('aria-label') && rating) {
            star.setAttribute('aria-label', `تقييم ${rating} نجوم`);
        }
    });
    
    // إعداد search suggestions
    document.querySelectorAll('.ps-search-suggestions').forEach(suggestions => {
        suggestions.setAttribute('role', 'listbox');
        suggestions.setAttribute('aria-label', 'اقتراحات البحث');
    });
    
    document.querySelectorAll('.ps-suggestion-item').forEach(item => {
        item.setAttribute('role', 'option');
        item.setAttribute('tabindex', '-1');
    });
}

function improveFocusManagement() {
    // إدارة focus للعناصر المنبثقة
    document.addEventListener('click', function(e) {
        if (e.target.closest('.ps-search-input')) {
            const suggestions = e.target.parentElement.querySelector('.ps-search-suggestions');
            if (suggestions && suggestions.style.display !== 'none') {
                suggestions.setAttribute('aria-expanded', 'true');
            }
        }
    });
    
    // تحسين focus للنماذج
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const firstError = this.querySelector('.error, .invalid');
            if (firstError) {
                firstError.focus();
            }
        });
    });
    
    // skip links
    addSkipLinks();
}

function addSkipLinks() {
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.textContent = 'تخطي إلى المحتوى الرئيسي';
    skipLink.className = 'skip-link';
    skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 6px;
        background: #000;
        color: #fff;
        padding: 8px 16px;
        text-decoration: none;
        z-index: 100000;
        opacity: 0;
        transform: translateY(-100%);
        transition: all 0.3s;
    `;
    
    skipLink.addEventListener('focus', function() {
        this.style.opacity = '1';
        this.style.transform = 'translateY(0)';
    });
    
    skipLink.addEventListener('blur', function() {
        this.style.opacity = '0';
        this.style.transform = 'translateY(-100%)';
    });
    
    document.body.insertBefore(skipLink, document.body.firstChild);
}

function setupLiveRegions() {
    // إضافة live region للإشعارات
    const liveRegion = document.createElement('div');
    liveRegion.setAttribute('aria-live', 'polite');
    liveRegion.setAttribute('aria-atomic', 'true');
    liveRegion.className = 'sr-only';
    liveRegion.id = 'ps-live-region';
    liveRegion.style.cssText = `
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    `;
    
    document.body.appendChild(liveRegion);
    
    // دالة لإضافة إعلانات للـ screen readers
    window.announceToScreenReader = function(message) {
        const liveRegion = document.getElementById('ps-live-region');
        if (liveRegion) {
            liveRegion.textContent = message;
            setTimeout(() => {
                liveRegion.textContent = '';
            }, 1000);
        }
    };
}

export default { initAccessibility };