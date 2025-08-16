/**
 * PWA Features Module
 * وحدة ميزات تطبيق الويب التقدمي
 */

export function initPWAFeatures() {
    // تسجيل Service Worker
    registerServiceWorker();
    
    // إشعار التثبيت
    setupInstallPrompt();
    
    // مراقبة حالة الشبكة
    monitorNetworkStatus();
    
    // تحديثات التطبيق
    handleAppUpdates();
}

function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('SW registered: ', registration);
                    
                    // مراقبة التحديثات
                    registration.addEventListener('updatefound', () => {
                        const newWorker = registration.installing;
                        newWorker.addEventListener('statechange', () => {
                            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                showUpdateNotification();
                            }
                        });
                    });
                })
                .catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
        });
        
        // مراقبة التحكم الجديد
        navigator.serviceWorker.addEventListener('controllerchange', () => {
            window.location.reload();
        });
    }
}

function setupInstallPrompt() {
    let deferredPrompt;
    
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        showInstallButton();
    });
    
    function showInstallButton() {
        const installButton = document.createElement('button');
        installButton.textContent = '📱 تثبيت التطبيق';
        installButton.className = 'ps-install-btn';
        installButton.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--ps-primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        `;
        
        installButton.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                
                if (outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                    announceToScreenReader('تم تثبيت التطبيق بنجاح');
                }
                
                deferredPrompt = null;
                installButton.remove();
            }
        });
        
        document.body.appendChild(installButton);
        
        // إخفاء الزر بعد فترة
        setTimeout(() => {
            if (installButton.parentNode) {
                installButton.style.opacity = '0';
                setTimeout(() => installButton.remove(), 300);
            }
        }, 10000);
    }
}

function monitorNetworkStatus() {
    function updateNetworkStatus() {
        if (navigator.onLine) {
            hideOfflineNotification();
            syncOfflineData();
        } else {
            showOfflineNotification();
        }
    }
    
    window.addEventListener('online', updateNetworkStatus);
    window.addEventListener('offline', updateNetworkStatus);
    
    // التحقق الأولي
    updateNetworkStatus();
}

function showOfflineNotification() {
    if (document.getElementById('offline-notification')) return;
    
    const notification = document.createElement('div');
    notification.id = 'offline-notification';
    notification.innerHTML = `
        <span>🔌 أنت غير متصل بالإنترنت</span>
        <small>سيتم حفظ التغييرات عند الاتصال</small>
    `;
    notification.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #ff6b35;
        color: white;
        padding: 10px;
        text-align: center;
        z-index: 10000;
        transform: translateY(-100%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateY(0)';
    }, 100);
    
    announceToScreenReader('أنت غير متصل بالإنترنت');
}

function hideOfflineNotification() {
    const notification = document.getElementById('offline-notification');
    if (notification) {
        notification.style.transform = 'translateY(-100%)';
        setTimeout(() => notification.remove(), 300);
        announceToScreenReader('تم استعادة الاتصال بالإنترنت');
    }
}

function syncOfflineData() {
    // مزامنة البيانات المحفوظة محلياً
    if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
        navigator.serviceWorker.controller.postMessage({
            type: 'SYNC_DATA'
        });
    }
}

function handleAppUpdates() {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.addEventListener('message', event => {
            if (event.data && event.data.type === 'UPDATE_AVAILABLE') {
                showUpdateNotification();
            }
        });
    }
}

function showUpdateNotification() {
    if (window.PracticalSolutions && window.PracticalSolutions.showNotification) {
        const updateButton = document.createElement('button');
        updateButton.textContent = 'تحديث الآن';
        updateButton.style.cssText = `
            background: var(--ps-success);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
        `;
        
        updateButton.addEventListener('click', () => {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.getRegistration().then(registration => {
                    if (registration && registration.waiting) {
                        registration.waiting.postMessage({ type: 'SKIP_WAITING' });
                    }
                });
            }
        });
        
        const message = document.createElement('div');
        message.textContent = 'تحديث جديد متاح! ';
        message.appendChild(updateButton);
        
        window.PracticalSolutions.showNotification(message.outerHTML, 'info');
    }
}

// تصدير دالة للاستخدام من الخارج
window.updateApp = function() {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.getRegistration().then(registration => {
            if (registration) {
                registration.update();
            }
        });
    }
};

export default { initPWAFeatures };