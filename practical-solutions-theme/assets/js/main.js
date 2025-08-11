/**
 * Practical Solutions Theme - Main JavaScript File
 * الملف الرئيسي الذي يربط جميع أنظمة القالب
 * 
 * @package Practical_Solutions
 * @version 1.0.0
 * @author Your Name
 */

'use strict';

/**
 * تطبيق الحلول العملية الرئيسي
 * @namespace PracticalSolutionsApp
 */
window.PracticalSolutionsApp = (function() {
    
    // المتغيرات الخاصة
    let isInitialized = false;
    let systems = {};
    let performance = {
        startTime: Date.now(),
        initTime: null,
        systems: {}
    };

    // إعدادات التطبيق
    const config = {
        // إعدادات عامة
        debug: false,
        enablePerformanceMonitoring: true,
        initTimeout: 10000,
        
        // إعدادات الأنظمة
        systems: {
            utils: {
                enabled: true,
                priority: 1
            },
            search: {
                enabled: true,
                priority: 2,
                options: {
                    minSearchLength: 2,
                    debounceDelay: 300,
                    enableAutoComplete: true,
                    enableHistory: true,
                    enableInstantSearch: false
                }
            },
            voiceSearch: {
                enabled: true,
                priority: 3,
                options: {
                    language: 'ar-SA',
                    timeout: 10000,
                    autoSubmit: false,
                    showVisualFeedback: true
                }
            },
            navigation: {
                enabled: true,
                priority: 2,
                options: {
                    enableStickyHeader: true,
                    enableBackToTop: true,
                    enableSmoothScroll: true,
                    mobileBreakpoint: 768
                }
            },
            lazyLoading: {
                enabled: true,
                priority: 4,
                options: {
                    rootMargin: '50px 0px',
                    enablePlaceholder: true,
                    enableFadeIn: true,
                    enableWebP: true
                }
            }
        }
    };

    /**
     * تهيئة التطبيق
     * @param {Object} options - خيارات التهيئة
     */
    function init(options = {}) {
        if (isInitialized) {
            log('التطبيق مُهيأ مسبقاً', 'warn');
            return;
        }

        log('بدء تهيئة تطبيق الحلول العملية...');
        
        // دمج الخيارات مع الإعدادات الافتراضية
        mergeConfig(options);
        
        // تهيئة مراقبة الأداء
        if (config.enablePerformanceMonitoring) {
            initPerformanceMonitoring();
        }
        
        // تهيئة الأنظمة
        initSystems()
            .then(() => {
                completeInitialization();
            })
            .catch(error => {
                handleInitializationError(error);
            });
    }

    /**
     * دمج الإعدادات
     * @param {Object} options - الخيارات الجديدة
     */
    function mergeConfig(options) {
        // دمج الإعدادات العامة
        Object.assign(config, options);
        
        // دمج إعدادات الأنظمة
        if (options.systems) {
            Object.keys(options.systems).forEach(systemName => {
                if (config.systems[systemName]) {
                    Object.assign(config.systems[systemName], options.systems[systemName]);
                }
            });
        }
        
        // تطبيق إعدادات التصحيح
        if (config.debug) {
            window.PS_DEBUG = true;
        }
    }

    /**
     * تهيئة مراقبة الأداء
     */
    function initPerformanceMonitoring() {
        // تسجيل بداية التحميل
        performance.loadStart = performance.startTime;
        
        // مراقبة أحداث تحميل الصفحة
        document.addEventListener('DOMContentLoaded', () => {
            performance.domReady = Date.now();
        });
        
        window.addEventListener('load', () => {
            performance.windowLoad = Date.now();
            logPerformanceMetrics();
        });
        
        // مراقبة الأداء المتقدم إذا كان متاح
        if ('performance' in window && 'getEntriesByType' in performance) {
            monitorAdvancedPerformance();
        }
    }

    /**
     * تهيئة الأنظمة
     * @returns {Promise}
     */
    async function initSystems() {
        const systemNames = Object.keys(config.systems)
            .filter(name => config.systems[name].enabled)
            .sort((a, b) => config.systems[a].priority - config.systems[b].priority);

        log(`تهيئة ${systemNames.length} نظام...`);

        for (const systemName of systemNames) {
            try {
                await initSystem(systemName);
            } catch (error) {
                log(`فشل في تهيئة نظام ${systemName}: ${error.message}`, 'error');
                
                // تسجيل النظام كفاشل لكن استمرار التهيئة
                systems[systemName] = { 
                    initialized: false, 
                    error: error.message 
                };
            }
        }
    }

    /**
     * تهيئة نظام واحد
     * @param {string} systemName - اسم النظام
     * @returns {Promise}
     */
    async function initSystem(systemName) {
        const startTime = Date.now();
        const systemConfig = config.systems[systemName];
        
        log(`تهيئة نظام ${systemName}...`);

        return new Promise((resolve, reject) => {
            // تعيين timeout للنظام
            const timeout = setTimeout(() => {
                reject(new Error(`انتهت مهلة تهيئة نظام ${systemName}`));
            }, config.initTimeout);

            try {
                let systemInstance = null;

                switch (systemName) {
                    case 'utils':
                        // Utils جاهز مسبقاً
                        systemInstance = window.PracticalSolutionsUtils;
                        break;

                    case 'search':
                        if (window.AdvancedSearch) {
                            systemInstance = window.AdvancedSearch.init(systemConfig.options);
                        }
                        break;

                    case 'voiceSearch':
                        if (window.VoiceSearch) {
                            systemInstance = window.VoiceSearch.init(systemConfig.options);
                        }
                        break;

                    case 'navigation':
                        if (window.NavigationSystem) {
                            systemInstance = window.NavigationSystem.init(systemConfig.options);
                        }
                        break;

                    case 'lazyLoading':
                        if (window.LazyLoading) {
                            systemInstance = window.LazyLoading.init(systemConfig.options);
                        }
                        break;

                    default:
                        reject(new Error(`نظام غير معروف: ${systemName}`));
                        return;
                }

                clearTimeout(timeout);

                // حفظ معلومات النظام
                const endTime = Date.now();
                systems[systemName] = {
                    instance: systemInstance,
                    initialized: !!systemInstance,
                    initTime: endTime - startTime,
                    config: systemConfig
                };

                // حفظ أداء النظام
                performance.systems[systemName] = {
                    initTime: endTime - startTime,
                    success: !!systemInstance
                };

                if (systemInstance) {
                    log(`✓ تم تهيئة نظام ${systemName} (${endTime - startTime}ms)`);
                    resolve(systemInstance);
                } else {
                    log(`⚠ لم يتم العثور على نظام ${systemName}`, 'warn');
                    resolve(null);
                }

            } catch (error) {
                clearTimeout(timeout);
                reject(error);
            }
        });
    }

    /**
     * إكمال التهيئة
     */
    function completeInitialization() {
        isInitialized = true;
        performance.initTime = Date.now() - performance.startTime;
        
        // إعداد الأحداث العامة
        setupGlobalEvents();
        
        // إعداد الاختصارات
        setupKeyboardShortcuts();
        
        // إعداد الأحداث المخصصة
        setupCustomEvents();
        
        // تشغيل callback الانتهاء
        fireReadyEvent();
        
        log(`✅ تم تهيئة التطبيق بنجاح في ${performance.initTime}ms`);
        
        // عرض ملخص الأنظمة
        logSystemsSummary();
    }

    /**
     * معالجة خطأ التهيئة
     * @param {Error} error - الخطأ
     */
    function handleInitializationError(error) {
        log(`❌ فشل في تهيئة التطبيق: ${error.message}`, 'error');
        
        // محاولة تهيئة الأنظمة الأساسية على الأقل
        tryBasicInitialization();
    }

    /**
     * محاولة تهيئة أساسية
     */
    function tryBasicInitialization() {
        log('محاولة تهيئة أساسية...');
        
        // تهيئة الوظائف الأساسية فقط
        if (window.PracticalSolutionsUtils) {
            systems.utils = { 
                instance: window.PracticalSolutionsUtils, 
                initialized: true 
            };
        }
        
        setupGlobalEvents();
        fireReadyEvent();
        
        log('تم تهيئة النظام في الوضع الأساسي');
    }

    /**
     * إعداد الأحداث العامة
     */
    function setupGlobalEvents() {
        // مراقبة حالة الاتصال
        window.addEventListener('online', handleConnectionChange);
        window.addEventListener('offline', handleConnectionChange);
        
        // مراقبة أخطاء JavaScript
        window.addEventListener('error', handleGlobalError);
        
        // مراقبة أخطاء Promise
        window.addEventListener('unhandledrejection', handleUnhandledRejection);
        
        // مراقبة تغيير الصفحة
        window.addEventListener('beforeunload', handleBeforeUnload);
        
        // مراقبة تغيير الرؤية
        document.addEventListener('visibilitychange', handleVisibilityChange);
    }

    /**
     * إعداد اختصارات لوحة المفاتيح
     */
    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', (event) => {
            // Ctrl/Cmd + K للبحث
            if ((event.ctrlKey || event.metaKey) && event.key === 'k') {
                event.preventDefault();
                focusSearch();
            }
            
            // Alt + T للعودة لأعلى
            if (event.altKey && event.key === 't') {
                event.preventDefault();
                scrollToTop();
            }
            
            // Alt + M لفتح القائمة المحمولة
            if (event.altKey && event.key === 'm') {
                event.preventDefault();
                toggleMobileMenu();
            }
        });
    }

    /**
     * إعداد الأحداث المخصصة
     */
    function setupCustomEvents() {
        // حدث اكتمال البحث
        document.addEventListener('searchCompleted', (event) => {
            log(`تم البحث عن: ${event.detail.query}`);
        });
        
        // حدث تقدم التحميل الكسول
        document.addEventListener('lazyLoadingProgress', (event) => {
            if (config.debug) {
                log(`تقدم التحميل الكسول: ${event.detail.progress}%`);
            }
        });
        
        // حدث تغيير النظام
        document.addEventListener('systemStateChange', (event) => {
            log(`تغيير حالة النظام: ${event.detail.system} - ${event.detail.state}`);
        });
    }

    /**
     * معالجة تغيير الاتصال
     * @param {Event} event - حدث تغيير الاتصال
     */
    function handleConnectionChange(event) {
        const isOnline = navigator.onLine;
        log(`حالة الاتصال: ${isOnline ? 'متصل' : 'غير متصل'}`);
        
        if (isOnline) {
            // إعادة تهيئة بعض الأنظمة إذا لزم الأمر
            handleReconnection();
        } else {
            // التعامل مع حالة عدم الاتصال
            handleDisconnection();
        }
    }

    /**
     * معالجة الأخطاء العامة
     * @param {Event} event - حدث الخطأ
     */
    function handleGlobalError(event) {
        log(`خطأ JavaScript: ${event.message} في ${event.filename}:${event.lineno}`, 'error');
        
        // إرسال تقرير الخطأ إذا كان مفعل
        if (config.enableErrorReporting) {
            reportError(event);
        }
    }

    /**
     * معالجة رفض Promise غير المعالج
     * @param {Event} event - حدث الرفض
     */
    function handleUnhandledRejection(event) {
        log(`Promise مرفوض: ${event.reason}`, 'error');
        
        // منع ظهور الخطأ في الكونسول
        event.preventDefault();
    }

    /**
     * معالجة قبل إغلاق الصفحة
     * @param {Event} event - حدث قبل الإغلاق
     */
    function handleBeforeUnload(event) {
        // حفظ البيانات الهامة
        saveUserData();
        
        // تنظيف الأنظمة
        cleanup();
    }

    /**
     * معالجة تغيير رؤية الصفحة
     */
    function handleVisibilityChange() {
        if (document.visibilityState === 'hidden') {
            // إيقاف العمليات غير الضرورية
            pauseNonEssentialSystems();
        } else {
            // استئناف العمليات
            resumeSystems();
        }
    }

    /**
     * التركيز على حقل البحث
     */
    function focusSearch() {
        if (systems.search && systems.search.instance) {
            const searchField = document.querySelector('.search-field');
            if (searchField) {
                searchField.focus();
                searchField.select();
            }
        }
    }

    /**
     * العودة لأعلى الصفحة
     */
    function scrollToTop() {
        if (systems.navigation && systems.navigation.instance) {
            systems.navigation.instance.scrollToTop();
        } else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    /**
     * تبديل القائمة المحمولة
     */
    function toggleMobileMenu() {
        if (systems.navigation && systems.navigation.instance) {
            systems.navigation.instance.toggleMobileMenu();
        }
    }

    /**
     * معالجة إعادة الاتصال
     */
    function handleReconnection() {
        // إعادة تشغيل البحث إذا كان معطل
        if (systems.search && !systems.search.initialized) {
            tryReinitializeSystem('search');
        }
        
        // إعادة تشغيل التحميل الكسول
        if (systems.lazyLoading && systems.lazyLoading.instance) {
            systems.lazyLoading.instance.refresh();
        }
    }

    /**
     * معالجة قطع الاتصال
     */
    function handleDisconnection() {
        // إيقاف العمليات التي تحتاج للإنترنت
        pauseNetworkDependentSystems();
        
        // عرض رسالة للمستخدم
        if (window.PracticalSolutionsUtils) {
            window.PracticalSolutionsUtils.showNotification(
                'تم قطع الاتصال بالإنترنت. بعض الميزات قد لا تعمل.',
                'warning',
                0
            );
        }
    }

    /**
     * محاولة إعادة تهيئة نظام
     * @param {string} systemName - اسم النظام
     */
    function tryReinitializeSystem(systemName) {
        log(`محاولة إعادة تهيئة نظام ${systemName}...`);
        
        initSystem(systemName)
            .then(() => {
                log(`✓ تم إعادة تهيئة نظام ${systemName}`);
            })
            .catch(error => {
                log(`فشل في إعادة تهيئة نظام ${systemName}: ${error.message}`, 'error');
            });
    }

    /**
     * إيقاف الأنظمة غير الضرورية
     */
    function pauseNonEssentialSystems() {
        // إيقاف التحميل الكسول مؤقتاً
        if (systems.lazyLoading && systems.lazyLoading.instance) {
            // سيتم تنفيذ الإيقاف المؤقت هنا
        }
    }

    /**
     * إيقاف الأنظمة المعتمدة على الشبكة
     */
    function pauseNetworkDependentSystems() {
        // إيقاف البحث المتقدم
        if (systems.search && systems.search.instance) {
            // سيتم تنفيذ الإيقاف هنا
        }
    }

    /**
     * استئناف الأنظمة
     */
    function resumeSystems() {
        // استئناف جميع الأنظمة
        Object.keys(systems).forEach(systemName => {
            if (systems[systemName] && systems[systemName].instance) {
                // سيتم تنفيذ الاستئناف هنا
            }
        });
    }

    /**
     * حفظ بيانات المستخدم
     */
    function saveUserData() {
        // حفظ تاريخ البحث
        if (systems.search && systems.search.instance) {
            // سيتم الحفظ تلقائياً من النظام
        }
        
        // حفظ الإعدادات
        if (window.localStorage) {
            try {
                localStorage.setItem('ps_app_state', JSON.stringify({
                    lastVisit: Date.now(),
                    systemsState: getSystemsState()
                }));
            } catch (e) {
                log('فشل في حفظ بيانات المستخدم', 'warn');
            }
        }
    }

    /**
     * الحصول على حالة الأنظمة
     * @returns {Object}
     */
    function getSystemsState() {
        const state = {};
        Object.keys(systems).forEach(systemName => {
            state[systemName] = {
                initialized: systems[systemName].initialized,
                hasError: !!systems[systemName].error
            };
        });
        return state;
    }

    /**
     * تنظيف الأنظمة
     */
    function cleanup() {
        Object.keys(systems).forEach(systemName => {
            const system = systems[systemName];
            if (system && system.instance && typeof system.instance.destroy === 'function') {
                try {
                    system.instance.destroy();
                    log(`تم تنظيف نظام ${systemName}`);
                } catch (error) {
                    log(`فشل في تنظيف نظام ${systemName}: ${error.message}`, 'error');
                }
            }
        });
    }

    /**
     * إطلاق حدث الجاهزية
     */
    function fireReadyEvent() {
        const readyEvent = new CustomEvent('PracticalSolutionsReady', {
            detail: {
                systems: systems,
                performance: performance,
                config: config
            }
        });
        
        document.dispatchEvent(readyEvent);
        
        // استدعاء callback إذا كان موجود
        if (window.onPracticalSolutionsReady && typeof window.onPracticalSolutionsReady === 'function') {
            window.onPracticalSolutionsReady(systems, performance);
        }
    }

    /**
     * مراقبة الأداء المتقدم
     */
    function monitorAdvancedPerformance() {
        // مراقبة Paint Timing
        if ('PerformancePaintTiming' in window) {
            const paintTimings = performance.getEntriesByType('paint');
            paintTimings.forEach(timing => {
                performance[timing.name] = timing.startTime;
            });
        }
        
        // مراقبة Navigation Timing
        if ('PerformanceNavigationTiming' in window) {
            const navTiming = performance.getEntriesByType('navigation')[0];
            if (navTiming) {
                performance.navigation = {
                    dns: navTiming.domainLookupEnd - navTiming.domainLookupStart,
                    connect: navTiming.connectEnd - navTiming.connectStart,
                    request: navTiming.responseEnd - navTiming.requestStart,
                    response: navTiming.responseEnd - navTiming.responseStart,
                    dom: navTiming.domContentLoadedEventEnd - navTiming.navigationStart,
                    load: navTiming.loadEventEnd - navTiming.navigationStart
                };
            }
        }
    }

    /**
     * تسجيل مقاييس الأداء
     */
    function logPerformanceMetrics() {
        if (!config.enablePerformanceMonitoring) return;
        
        const metrics = {
            'إجمالي وقت التهيئة': `${performance.initTime}ms`,
            'تحميل DOM': `${performance.domReady - performance.startTime}ms`,
            'تحميل النافذة': `${performance.windowLoad - performance.startTime}ms`
        };
        
        if (performance.navigation) {
            Object.assign(metrics, {
                'البحث عن DNS': `${performance.navigation.dns.toFixed(2)}ms`,
                'الاتصال': `${performance.navigation.connect.toFixed(2)}ms`,
                'الطلب': `${performance.navigation.request.toFixed(2)}ms`,
                'الاستجابة': `${performance.navigation.response.toFixed(2)}ms`
            });
        }
        
        console.group('📊 مقاييس الأداء');
        Object.entries(metrics).forEach(([key, value]) => {
            console.log(`${key}: ${value}`);
        });
        console.groupEnd();
    }

    /**
     * تسجيل ملخص الأنظمة
     */
    function logSystemsSummary() {
        const initializedSystems = Object.keys(systems).filter(name => systems[name].initialized);
        const failedSystems = Object.keys(systems).filter(name => !systems[name].initialized);
        
        console.group('🔧 ملخص الأنظمة');
        console.log(`✅ أنظمة مُهيأة: ${initializedSystems.length}`);
        
        initializedSystems.forEach(name => {
            const time = systems[name].initTime || 0;
            console.log(`  • ${name} (${time}ms)`);
        });
        
        if (failedSystems.length > 0) {
            console.log(`❌ أنظمة فاشلة: ${failedSystems.length}`);
            failedSystems.forEach(name => {
                const error = systems[name].error || 'سبب غير معروف';
                console.log(`  • ${name}: ${error}`);
            });
        }
        
        console.groupEnd();
    }

    /**
     * تسجيل رسالة
     * @param {string} message - الرسالة
     * @param {string} type - نوع الرسالة
     */
    function log(message, type = 'log') {
        if (window.PracticalSolutionsUtils && window.PracticalSolutionsUtils.log) {
            window.PracticalSolutionsUtils.log(message, type);
        } else {
            console[type](`[Practical Solutions] ${message}`);
        }
    }

    /**
     * الحصول على معلومات النظام
     * @param {string} systemName - اسم النظام
     * @returns {Object|null}
     */
    function getSystem(systemName) {
        return systems[systemName] || null;
    }

    /**
     * الحصول على جميع الأنظمة
     * @returns {Object}
     */
    function getAllSystems() {
        return { ...systems };
    }

    /**
     * الحصول على معلومات الأداء
     * @returns {Object}
     */
    function getPerformance() {
        return { ...performance };
    }

    /**
     * التحقق من حالة التهيئة
     * @returns {boolean}
     */
    function isReady() {
        return isInitialized;
    }

    // التهيئة التلقائية عند تحميل DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            // تأخير قصير للتأكد من تحميل جميع الملفات
            setTimeout(init, 100);
        });
    } else {
        // DOM جاهز، تهيئة فورية
        setTimeout(init, 100);
    }

    // إرجاع الواجهة العامة
    return {
        init: init,
        getSystem: getSystem,
        getAllSystems: getAllSystems,
        getPerformance: getPerformance,
        isReady: isReady,
        focusSearch: focusSearch,
        scrollToTop: scrollToTop,
        toggleMobileMenu: toggleMobileMenu,
        cleanup: cleanup
    };

})();