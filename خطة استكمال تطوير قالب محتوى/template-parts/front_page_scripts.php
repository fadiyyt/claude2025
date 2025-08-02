<?php
/**
 * JavaScript مخصص للصفحة الرئيسية
 * Front Page Custom Scripts
 * 
 * @package Muhtawaa
 * @version 2.0
 * @since 1.0.0
 */

// منع الوصول المباشر للملف
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر لهذا الملف');
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    console.log('🚀 تم تحميل قالب محتوى - الصفحة الرئيسية');
    
    // ============================================================================
    // تأثير العداد المتحرك
    // ============================================================================
    function initCounters() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target')) || 0;
            const duration = 2000; // مدة الحركة بالميلي ثانية
            const increment = target / (duration / 16); // 60 FPS
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            // مراقب للتحقق من ظهور العنصر في الشاشة
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        });
    }
    
    // ============================================================================
    // التمرير السلس للروابط الداخلية
    // ============================================================================
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);
                
                if (target) {
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = target.offsetTop - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
    
    // ============================================================================
    // معالجة نموذج النشرة البريدية
    // ============================================================================
    function initNewsletterForm() {
        const form = document.getElementById('newsletter-form');
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[name="newsletter_email"]');
            const submitBtn = this.querySelector('button[type="submit"]');
            const email = emailInput.value.trim();
            
            // التحقق من صحة البريد الإلكتروني
            if (!isValidEmail(email)) {
                showNotification('يرجى إدخال بريد إلكتروني صحيح', 'error');
                return;
            }
            
            // تغيير حالة الزر
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جارٍ الاشتراك...';
            submitBtn.disabled = true;
            
            // محاكاة عملية الإرسال (يمكن استبدالها بطلب AJAX حقيقي)
            setTimeout(() => {
                // إظهار رسالة نجاح
                showNotification('تم اشتراكك بنجاح! شكراً لك.', 'success');
                
                // إعادة تعيين النموذج
                emailInput.value = '';
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // إضافة تأثير بصري للنجاح
                emailInput.style.borderColor = '#48bb78';
                setTimeout(() => {
                    emailInput.style.borderColor = '';
                }, 3000);
                
            }, 2000);
        });
    }
    
    // ============================================================================
    // التحقق من صحة البريد الإلكتروني
    // ============================================================================
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // ============================================================================
    // نظام الإشعارات المخصص
    // ============================================================================
    function showNotification(message, type = 'success') {
        // إزالة الإشعارات السابقة
        const existingNotifications = document.querySelectorAll('.custom-notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = `custom-notification notification-${type}`;
        
        const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
        const bgColor = type === 'success' ? '#48bb78' : '#f56565';
        
        notification.innerHTML = `
            <div class="notification-content">
                <i class="${icon}"></i>
                <span>${message}</span>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        // تطبيق الأنماط
        Object.assign(notification.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            background: bgColor,
            color: 'white',
            padding: '1rem 1.5rem',
            borderRadius: '8px',
            boxShadow: '0 10px 30px rgba(0, 0, 0, 0.2)',
            zIndex: '1000',
            transform: 'translateX(100%)',
            transition: 'transform 0.3s ease',
            maxWidth: '400px',
            display: 'flex',
            alignItems: 'center',
            gap: '0.5rem'
        });
        
        notification.querySelector('.notification-close').style.cssText = `
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.25rem;
            margin-left: 0.5rem;
        `;
        
        document.body.appendChild(notification);
        
        // تأثير الظهور
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // إزالة تلقائية
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
    
    // ============================================================================
    // تأثير parallax للخلفيات
    // ============================================================================
    function initParallaxEffect() {
        let ticking = false;
        
        function updateParallax() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.hero-particles');
            
            parallaxElements.forEach(element => {
                const speed = 0.3;
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
            
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        });
    }
    
    // ============================================================================
    // تحسين تحميل الصور
    // ============================================================================
    function initLazyLoading() {
        const images = document.querySelectorAll('img[loading="lazy"]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        
                        // إضافة تأثير التحميل
                        img.style.opacity = '0';
                        img.style.transition = 'opacity 0.3s ease';
                        
                        img.addEventListener('load', () => {
                            img.style.opacity = '1';
                            img.classList.add('loaded');
                        });
                        
                        imageObserver.unobserve(img);
                    }
                });
            }, { rootMargin: '50px' });
            
            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback للمتصفحات القديمة
            images.forEach(img => img.classList.add('loaded'));
        }
    }
    
    // ============================================================================
    // إضافة تأثيرات التفاعل للبطاقات
    // ============================================================================
    function initCardInteractions() {
        const cards = document.querySelectorAll('.muhtawaa-card, .feature-card, .post-card, .category-card, .testimonial-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
                    this.style.transition = 'all 0.3s ease';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    }
    
    // ============================================================================
    // تأثير الموجة للأزرار
    // ============================================================================
    function initRippleEffect() {
        const buttons = document.querySelectorAll('.btn, .muhtawaa-btn');
        
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
        
        // إضافة أنماط الحركة
        if (!document.querySelector('#ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    // ============================================================================
    // كشف الأقسام عند التمرير
    // ============================================================================
    function initScrollReveal() {
        const sections = document.querySelectorAll('section');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.classList.add('revealed');
                }
            });
        }, { threshold: 0.1 });
        
        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
    }
    
    // ============================================================================
    // تحسين إمكانية الوصول
    // ============================================================================
    function improveAccessibility() {
        // إضافة تنقل بلوحة المفاتيح
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });
        
        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });
        
        // إضافة خصائص إمكانية الوصول للعناصر التفاعلية
        const interactiveElements = document.querySelectorAll('.hover-lift, .post-card, .feature-card');
        interactiveElements.forEach(element => {
            if (!element.getAttribute('role')) {
                element.setAttribute('role', 'button');
            }
            if (!element.getAttribute('tabindex')) {
                element.setAttribute('tabindex', '0');
            }
            
            // إضافة تفاعل بلوحة المفاتيح
            element.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
        
        // إضافة أنماط التركيز المحسنة
        if (!document.querySelector('#accessibility-styles')) {
            const style = document.createElement('style');
            style.id = 'accessibility-styles';
            style.textContent = `
                .keyboard-navigation *:focus {
                    outline: 3px solid var(--primary-color);
                    outline-offset: 2px;
                }
                
                @media (prefers-reduced-motion: reduce) {
                    *, *::before, *::after {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    // ============================================================================
    // تحسين الأداء
    // ============================================================================
    function optimizePerformance() {
        // تأجيل تحميل الخطوط غير الأساسية
        const loadFont = (fontUrl) => {
            const link = document.createElement('link');
            link.href = fontUrl;
            link.rel = 'stylesheet';
            link.media = 'print';
            link.onload = function() { this.media = 'all'; };
            document.head.appendChild(link);
        };
        
        // تحميل خطوط إضافية بشكل تدريجي
        setTimeout(() => {
            loadFont('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
        }, 2000);
        
        // تحسين الصور عند التمرير
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                // أي عمليات مكلفة بعد انتهاء التمرير
            }, 250);
        });
    }
    
    // ============================================================================
    // إضافة حالات التحميل للنماذج
    // ============================================================================
    function initLoadingStates() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    const originalContent = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جارٍ التحميل...';
                    submitBtn.disabled = true;
                    
                    // إعادة تفعيل الزر بعد فترة (للحماية من التعليق)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalContent;
                        submitBtn.disabled = false;
                    }, 10000);
                }
            });
        });
    }
    
    // ============================================================================
    // إنشاء الجسيمات المتحركة
    // ============================================================================
    function createAnimatedParticles() {
        const heroSection = document.querySelector('.hero-section');
        if (!heroSection || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        
        const particleCount = window.innerWidth > 768 ? 30 : 15;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'floating-particle';
            
            const size = Math.random() * 4 + 2;
            const animationDuration = Math.random() * 15 + 10;
            const delay = Math.random() * 5;
            
            particle.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                pointer-events: none;
                animation: floatParticle ${animationDuration}s linear infinite;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                animation-delay: ${delay}s;
                z-index: 1;
            `;
            
            heroSection.appendChild(particle);
        }
        
        // إضافة أنماط الحركة للجسيمات
        if (!document.querySelector('#particle-styles')) {
            const style = document.createElement('style');
            style.id = 'particle-styles';
            style.textContent = `
                @keyframes floatParticle {
                    0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
                    10% { opacity: 1; }
                    90% { opacity: 1; }
                    100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    // ============================================================================
    // تهيئة جميع الوظائف
    // ============================================================================
    function init() {
        try {
            initCounters();
            initSmoothScroll();
            initNewsletterForm();
            initParallaxEffect();
            initLazyLoading();
            initCardInteractions();
            initRippleEffect();
            initScrollReveal();
            improveAccessibility();
            optimizePerformance();
            initLoadingStates();
            createAnimatedParticles();
            
            console.log('✅ تم تحميل جميع وظائف الصفحة الرئيسية بنجاح');
            
        } catch (error) {
            console.error('❌ خطأ في تحميل وظائف الصفحة الرئيسية:', error);
        }
    }
    
    // بدء التهيئة
    init();
    
    // تصدير الوظائف للاستخدام العام
    window.muhtawaaFrontPage = {
        showNotification: showNotification,
        isValidEmail: isValidEmail
    };
    
    // إضافة مستمع لتغيير حجم النافذة
    window.addEventListener('resize', function() {
        // إعادة تهيئة الجسيمات عند تغيير حجم الشاشة
        const existingParticles = document.querySelectorAll('.floating-particle');
        existingParticles.forEach(particle => particle.remove());
        
        setTimeout(createAnimatedParticles, 500);
    });
    
    console.log('🎉 الصفحة الرئيسية جاهزة للاستخدام!');
});
</script>