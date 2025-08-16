/**
 * Enhanced Features Module - Support Functions
 * وحدة الميزات المحسنة - وظائف الدعم
 */

export function initEnhancedFeatures() {
    console.log('🔧 تفعيل الميزات المحسنة');
    
    // تحسين السلوك العام للموقع
    initSmoothScroll();
    initLazyLoading();
    initFormEnhancements();
    initTooltips();
}

// التمرير السلس للروابط الداخلية
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// التحميل الكسول للصور
function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-loading');
                        img.classList.add('lazy-loaded');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            img.classList.add('lazy-loading');
            imageObserver.observe(img);
        });
    }
}

// تحسينات النماذج
function initFormEnhancements() {
    // تحسين نماذج البحث
    document.querySelectorAll('form[role="search"]').forEach(form => {
        const input = form.querySelector('input[type="search"]');
        
        if (input) {
            // حفظ البحثات السابقة
            const savedSearches = JSON.parse(localStorage.getItem('ps_recent_searches') || '[]');
            
            // إضافة datalist للاقتراحات
            if (savedSearches.length > 0) {
                const datalist = document.createElement('datalist');
                datalist.id = 'recent-searches';
                
                savedSearches.forEach(search => {
                    const option = document.createElement('option');
                    option.value = search;
                    datalist.appendChild(option);
                });
                
                input.setAttribute('list', 'recent-searches');
                form.appendChild(datalist);
            }
            
            // حفظ البحث الجديد
            form.addEventListener('submit', function() {
                const query = input.value.trim();
                if (query && !savedSearches.includes(query)) {
                    savedSearches.unshift(query);
                    if (savedSearches.length > 10) savedSearches.pop();
                    localStorage.setItem('ps_recent_searches', JSON.stringify(savedSearches));
                }
            });
        }
    });
}

// تلميحات مفيدة
function initTooltips() {
    // إضافة tooltips للأزرار المهمة
    const tooltipElements = [
        { selector: '.ps-voice-btn', text: 'اضغط واتكلم للبحث الصوتي' },
        { selector: '.ps-bookmark-btn', text: 'احفظ هذا المقال لقراءته لاحقاً' },
        { selector: '.ps-theme-toggle', text: 'غير بين الوضع الفاتح والمظلم' },
        { selector: '.ps-scroll-top', text: 'العودة لأعلى الصفحة' }
    ];
    
    tooltipElements.forEach(({ selector, text }) => {
        document.querySelectorAll(selector).forEach(element => {
            element.setAttribute('title', text);
            element.setAttribute('data-tooltip', text);
        });
    });
}

export default { initEnhancedFeatures };