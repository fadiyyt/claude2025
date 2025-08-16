/**
 * Voice Search Module
 * وحدة البحث الصوتي
 */

export function initVoiceSearch() {
    // التحقق من دعم Web Speech API
    if (!('webkitSpeechRecognition' in window || 'SpeechRecognition' in window)) {
        console.warn('Voice search not supported in this browser');
        return;
    }

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();
    
    // إعدادات التعرف على الصوت
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'ar-SA';

    // إعداد أزرار البحث الصوتي
    document.querySelectorAll('.ps-voice-btn').forEach(button => {
        button.addEventListener('click', function() {
            const searchInput = this.parentElement.querySelector('.ps-search-input');
            
            button.classList.add('recording');
            button.setAttribute('aria-label', 'جاري التسجيل...');
            
            recognition.start();
            
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                if (searchInput) {
                    searchInput.value = transcript;
                    // تفعيل حدث input لتشغيل الاقتراحات
                    searchInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
            };
            
            recognition.onend = function() {
                button.classList.remove('recording');
                button.setAttribute('aria-label', 'البحث الصوتي');
            };
            
            recognition.onerror = function(event) {
                console.error('Voice recognition error:', event.error);
                button.classList.remove('recording');
                button.setAttribute('aria-label', 'البحث الصوتي');
                
                // إظهار رسالة خطأ للمستخدم
                if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
                    window.PracticalSolutions.showNotification(
                        'حدث خطأ في التعرف على الصوت، حاول مرة أخرى',
                        'error'
                    );
                }
            };
        });
    });
}

// تصدير الوحدة
export default { initVoiceSearch };