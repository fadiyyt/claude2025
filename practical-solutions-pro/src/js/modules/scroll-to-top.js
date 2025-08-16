/**
 * Scroll to Top Module - Complete Implementation
 * وحدة زر العودة للأعلى - تنفيذ كامل
 */

export function initScrollToTop() {
    console.log('⬆️ تفعيل وحدة العودة للأعلى');
    
    const ScrollToTop = {
        button: null,
        isVisible: false,
        
        init() {
            this.createButton();
            this.bindEvents();
            this.handleScroll(); // فحص أولي
        },
        
        createButton() {
            // البحث عن زر موجود
            this.button = document.querySelector('.ps-scroll-top');
            
            if (!this.button) {
                this.button = document.createElement('button');
                this.button.className = 'ps-scroll-top';
                this.button.setAttribute('aria-label', 'العودة للأعلى');
                this.button.innerHTML = `
                    <span class="scroll-icon" aria-hidden="true">⬆️</span>
                    <span class="sr-only">العودة للأعلى</span>
                `;
                
                // إضافة أنماط أساسية مباشرة
                Object.assign(this.button.style, {
                    position: 'fixed',
                    bottom: '30px',
                    left: '30px',
                    backgroundColor: 'var(--ps-color-primary, #007cba)',
                    color: 'white',
                    border: 'none',
                    width: '50px',
                    height: '50px',
                    borderRadius: '50%',
                    cursor: 'pointer',
                    fontSize: '20px',
                    boxShadow: '0 4px 15px rgba(0,0,0,0.2)',
                    transition: 'all 0.3s ease',
                    zIndex: '1000',
                    display: 'none',
                    alignItems: 'center',
                    justifyContent: 'center'
                });
                
                document.body.appendChild(this.button);
            }
        },
        
        bindEvents() {
            // حدث النقر
            this.button.addEventListener('click', (e) => {
                e.preventDefault();
                this.scrollToTop();
            });
            
            // حدث hover
            this.button.addEventListener('mouseenter', () => {
                this.button.style.backgroundColor = 'var(--ps-color-primary-dark, #005a87)';
                this.button.style.transform = 'translateY(-3px) scale(1.05)';
            });
            
            this.button.addEventListener('mouseleave', () => {
                this.button.style.backgroundColor = 'var(--ps-color-primary, #007cba)';
                this.button.style.transform = 'translateY(0) scale(1)';
            });
            
            // مراقبة التمرير
            window.addEventListener('scroll', this.throttle(() => {
                this.handleScroll();
            }, 100));
            
            // مراقبة تغيير حجم النافذة
            window.addEventListener('resize', this.throttle(() => {
                this.adjustPosition();
            }, 250));
        },
        
        handleScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const shouldShow = scrollTop > 300;
            
            if (shouldShow && !this.isVisible) {
                this.show();
            } else if (!shouldShow && this.isVisible) {
                this.hide();
            }
            
            // تحديث progress indicator
            this.updateProgress();
        },
        
        show() {
            this.isVisible = true;
            this.button.style.display = 'flex';
            
            // انيميشن الظهور
            requestAnimationFrame(() => {
                this.button.style.opacity = '0';
                this.button.style.transform = 'translateY(20px) scale(0.8)';
                
                requestAnimationFrame(() => {
                    this.button.style.opacity = '1';
                    this.button.style.transform = 'translateY(0) scale(1)';
                });
            });
        },
        
        hide() {
            this.isVisible = false;
            this.button.style.opacity = '0';
            this.button.style.transform = 'translateY(20px) scale(0.8)';
            
            setTimeout(() => {
                if (!this.isVisible) {
                    this.button.style.display = 'none';
                }
            }, 300);
        },
        
        scrollToTop() {
            const startPosition = window.pageYOffset;
            const targetPosition = 0;
            const distance = startPosition - targetPosition;
            const duration = Math.min(Math.max(distance / 3, 300), 1000); // 300ms-1000ms
            let startTime = null;
            
            const animation = (currentTime) => {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const progress = Math.min(timeElapsed / duration, 1);
                
                // easing function (ease-out)
                const easeOutCubic = 1 - Math.pow(1 - progress, 3);
                
                window.scrollTo(0, startPosition - (distance * easeOutCubic));
                
                if (timeElapsed < duration) {
                    requestAnimationFrame(animation);
                } else {
                    // التأكد من الوصول للهدف
                    window.scrollTo(0, 0);
                    
                    // إشعار الوصول
                    if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
                        window.PracticalSolutions.showNotification('تم العودة للأعلى', 'info');
                    }
                }
            };
            
            requestAnimationFrame(animation);
        },
        
        updateProgress() {
            const scrollTop = window.pageYOffset;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            
            // إضافة مؤشر التقدم إذا لم يكن موجوداً
            let progressRing = this.button.querySelector('.progress-ring');
            if (!progressRing && scrollPercent > 0) {
                progressRing = document.createElement('div');
                progressRing.className = 'progress-ring';
                progressRing.innerHTML = `
                    <svg width="54" height="54" style="position: absolute; top: -2px; left: -2px;">
                        <circle cx="27" cy="27" r="25" stroke="rgba(255,255,255,0.3)" stroke-width="2" fill="none"/>
                        <circle cx="27" cy="27" r="25" stroke="white" stroke-width="2" fill="none" 
                                stroke-dasharray="157" stroke-dashoffset="157" 
                                style="transform: rotate(-90deg); transform-origin: center; transition: stroke-dashoffset 0.3s ease;"/>
                    </svg>
                `;
                this.button.appendChild(progressRing);
            }
            
            if (progressRing) {
                const circle = progressRing.querySelector('circle:last-child');
                const circumference = 157; // 2 * π * 25
                const offset = circumference - (scrollPercent / 100) * circumference;
                circle.style.strokeDashoffset = offset;
            }
        },
        
        adjustPosition() {
            // تعديل موقع الزر حسب حجم الشاشة
            if (window.innerWidth <= 768) {
                Object.assign(this.button.style, {
                    bottom: '20px',
                    left: '20px',
                    width: '45px',
                    height: '45px'
                });
            } else {
                Object.assign(this.button.style, {
                    bottom: '30px',
                    left: '30px',
                    width: '50px',
                    height: '50px'
                });
            }
        },
        
        // دالة throttle للأداء
        throttle(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            }
        }
    };
    
    ScrollToTop.init();
    
    // تصدير للاستخدام الخارجي
    window.PSScrollToTop = ScrollToTop;
}

export default { initScrollToTop };