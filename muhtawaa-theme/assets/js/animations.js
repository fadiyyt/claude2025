/**
 * ملف الحركات المتقدمة - قالب محتوى
 * 
 * @package Muhtawaa
 * @version 2.0.3
 * @author فريق التطوير
 */

(function($) {
    'use strict';

    /**
     * فئة الحركات المتقدمة
     */
    class MuhtawaaAnimations {
        constructor() {
            this.animationQueue = [];
            this.isAnimating = false;
            this.observers = new Map();
            
            this.init();
            this.bindEvents();
        }

        /**
         * تهيئة النظام
         */
        init() {
            this.initScrollAnimations();
            this.initHoverEffects();
            this.initLoadingAnimations();
            this.initCounterAnimations();
            this.initTypingEffect();
            this.initParticleEffects();
            this.initMorphingShapes();
            this.initStaggeredAnimations();
            this.initScrollTriggers();
        }

        /**
         * ربط الأحداث
         */
        bindEvents() {
            // حدث التمرير
            $(window).on('scroll', this.throttle(this.handleScroll.bind(this), 16));
            
            // حدث تغيير حجم النافذة
            $(window).on('resize', this.debounce(this.handleResize.bind(this), 250));
            
            // أحداث اللمس للأجهزة المحمولة
            $(document).on('touchstart', this.handleTouchStart.bind(this));
            $(document).on('touchend', this.handleTouchEnd.bind(this));
            
            // أحداث مخصصة
            $(document).on('muhtawaa:animate', this.handleCustomAnimation.bind(this));
            $(document).on('muhtawaa:page-loaded', this.initPageAnimations.bind(this));
        }

        /**
         * حركات التمرير
         */
        initScrollAnimations() {
            // العناصر التي تظهر عند التمرير
            const animatedElements = $('.animate-on-scroll, .fade-in-up, .fade-in-down, .fade-in-left, .fade-in-right, .zoom-in, .rotate-in');
            
            if (animatedElements.length && 'IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const element = $(entry.target);
                            const animationType = this.getAnimationType(element);
                            const delay = element.data('animation-delay') || 0;
                            
                            setTimeout(() => {
                                this.animateElement(element, animationType);
                            }, delay);
                            
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '50px 0px'
                });

                animatedElements.each(function() {
                    observer.observe(this);
                });

                this.observers.set('scroll', observer);
            }
        }

        /**
         * تأثيرات الهوفر المتقدمة
         */
        initHoverEffects() {
            // تأثير الهوفر على البطاقات
            $('.muhtawaa-card, .post-card').each(function() {
                const card = $(this);
                
                card.hover(
                    function() {
                        // عند الدخول
                        $(this).addClass('hover-active');
                        
                        // تحريك الصورة
                        const img = $(this).find('img');
                        if (img.length) {
                            img.css('transform', 'scale(1.05)');
                        }
                        
                        // تأثير الظل
                        $(this).css('box-shadow', '0 20px 40px rgba(0,0,0,0.15)');
                    },
                    function() {
                        // عند الخروج
                        $(this).removeClass('hover-active');
                        
                        const img = $(this).find('img');
                        if (img.length) {
                            img.css('transform', 'scale(1)');
                        }
                        
                        $(this).css('box-shadow', '');
                    }
                );
            });

            // تأثير الهوفر على الأزرار
            $('.btn, .muhtawaa-button').each(function() {
                const btn = $(this);
                const originalBg = btn.css('background-color');
                
                btn.hover(
                    function() {
                        $(this).addClass('btn-hover');
                        
                        // تأثير الموجة
                        const ripple = $('<span class="btn-ripple"></span>');
                        $(this).append(ripple);
                        
                        setTimeout(() => ripple.remove(), 600);
                    },
                    function() {
                        $(this).removeClass('btn-hover');
                    }
                );
            });

            // تأثير الهوفر على الروابط
            $('.muhtawaa-link, .post-title a').hover(
                function() {
                    $(this).addClass('link-hover');
                },
                function() {
                    $(this).removeClass('link-hover');
                }
            );
        }

        /**
         * حركات التحميل
         */
        initLoadingAnimations() {
            // شاشة التحميل الرئيسية
            const loader = $('.muhtawaa-loader');
            
            if (loader.length) {
                $(window).on('load', () => {
                    loader.addClass('fade-out');
                    
                    setTimeout(() => {
                        loader.remove();
                        this.startEntranceAnimations();
                    }, 500);
                });
            } else {
                // بدء الحركات مباشرة إذا لم يكن هناك شاشة تحميل
                $(document).ready(() => {
                    this.startEntranceAnimations();
                });
            }

            // حركات تحميل المحتوى الديناميكي
            this.initContentLoading();
        }

        /**
         * بدء حركات الدخول
         */
        startEntranceAnimations() {
            // حركة العنوان الرئيسي
            $('.page-title, .site-title').addClass('animate-slide-down');
            
            // حركة القائمة
            setTimeout(() => {
                $('.main-navigation .menu-item').each(function(index) {
                    setTimeout(() => {
                        $(this).addClass('animate-fade-in');
                    }, index * 100);
                });
            }, 