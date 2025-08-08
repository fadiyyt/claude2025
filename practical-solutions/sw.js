// Service Worker للحلول العملية
const CACHE_NAME = 'practical-solutions-v1.0.0';
const STATIC_CACHE = 'practical-static-v1';
const DYNAMIC_CACHE = 'practical-dynamic-v1';

// قائمة الملفات الثابتة للتخزين المؤقت
const STATIC_FILES = [
    '/',
    '/wp-content/themes/practical-solutions/style.css',
    '/wp-content/themes/practical-solutions/assets/js/app.js',
    'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Tajawal:wght@300;400;500;700&display=swap'
];

// تثبيت Service Worker
self.addEventListener('install', event => {
    console.log('[SW] Installing...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => {
                console.log('[SW] Caching static files');
                return cache.addAll(STATIC_FILES.filter(url => {
                    // تجنب تخزين الملفات التي قد تسبب مشاكل
                    return !url.includes('admin-ajax.php') && !url.includes('wp-admin');
                }));
            })
            .then(() => {
                console.log('[SW] Static files cached successfully');
                return self.skipWaiting();
            })
            .catch(error => {
                console.log('[SW] Error caching static files:', error);
            })
    );
});

// تفعيل Service Worker
self.addEventListener('activate', event => {
    console.log('[SW] Activating...');
    
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    // حذف التخزين المؤقت القديم
                    if (cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE) {
                        console.log('[SW] Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            console.log('[SW] Activated successfully');
            return self.clients.claim();
        })
    );
});

// اعتراض الطلبات
self.addEventListener('fetch', event => {
    const requestUrl = new URL(event.request.url);
    
    // تجاهل طلبات المتصفح الداخلية وطلبات ووردبريس الإدارية
    if (
        event.request.method !== 'GET' ||
        requestUrl.pathname.includes('/wp-admin/') ||
        requestUrl.pathname.includes('/wp-login.php') ||
        requestUrl.pathname.includes('admin-ajax.php') ||
        requestUrl.pathname.includes('preview=true') ||
        requestUrl.search.includes('customize_changeset_uuid')
    ) {
        return;
    }
    
    // استراتيجية التخزين المؤقت
    if (isStaticAsset(event.request.url)) {
        // Cache First للملفات الثابتة
        event.respondWith(cacheFirst(event.request));
    } else if (isImageRequest(event.request)) {
        // Cache First للصور
        event.respondWith(cacheFirst(event.request));
    } else {
        // Network First للمحتوى الديناميكي
        event.respondWith(networkFirst(event.request));
    }
});

// استراتيجية Cache First
async function cacheFirst(request) {
    try {
        const cached = await caches.match(request);
        if (cached) {
            return cached;
        }
        
        const response = await fetch(request);
        
        if (response.status === 200) {
            const cache = await caches.open(STATIC_CACHE);
            cache.put(request, response.clone());
        }
        
        return response;
    } catch (error) {
        console.log('[SW] Cache first failed:', error);
        return new Response('المحتوى غير متاح حالياً', {
            status: 503,
            statusText: 'Service Unavailable',
            headers: new Headers({
                'Content-Type': 'text/html; charset=utf-8'
            })
        });
    }
}

// استراتيجية Network First
async function networkFirst(request) {
    try {
        const response = await fetch(request);
        
        if (response.status === 200) {
            const cache = await caches.open(DYNAMIC_CACHE);
            cache.put(request, response.clone());
        }
        
        return response;
    } catch (error) {
        console.log('[SW] Network first failed, trying cache:', error);
        
        const cached = await caches.match(request);
        if (cached) {
            return cached;
        }
        
        // صفحة 404 مخصصة للـ offline
        if (request.headers.get('accept').includes('text/html')) {
            return new Response(`
                <!DOCTYPE html>
                <html dir="rtl" lang="ar">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>غير متصل - الحلول العملية</title>
                    <style>
                        body {
                            font-family: 'Segoe UI', Tahoma, sans-serif;
                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            color: white;
                            text-align: center;
                            padding: 50px 20px;
                            margin: 0;
                            min-height: 100vh;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                        }
                        .offline-icon {
                            font-size: 80px;
                            margin-bottom: 30px;
                        }
                        .offline-title {
                            font-size: 28px;
                            margin-bottom: 15px;
                        }
                        .offline-message {
                            font-size: 18px;
                            margin-bottom: 30px;
                            opacity: 0.9;
                            line-height: 1.6;
                        }
                        .retry-btn {
                            background: rgba(255,255,255,0.2);
                            color: white;
                            border: 2px solid white;
                            padding: 15px 30px;
                            border-radius: 25px;
                            font-size: 16px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            text-decoration: none;
                            display: inline-block;
                        }
                        .retry-btn:hover {
                            background: white;
                            color: #667eea;
                        }
                    </style>
                </head>
                <body>
                    <div class="offline-icon">📡</div>
                    <h1 class="offline-title">غير متصل بالإنترنت</h1>
                    <p class="offline-message">
                        عذراً، أنت غير متصل بالإنترنت حالياً.<br>
                        تحقق من اتصالك وحاول مرة أخرى.
                    </p>
                    <button class="retry-btn" onclick="window.location.reload()">
                        إعادة المحاولة
                    </button>
                </body>
                </html>
            `, {
                status: 503,
                statusText: 'Service Unavailable',
                headers: new Headers({
                    'Content-Type': 'text/html; charset=utf-8'
                })
            });
        }
        
        return new Response('غير متاح', {
            status: 503,
            statusText: 'Service Unavailable'
        });
    }
}

// فحص إذا كان الطلب للملفات الثابتة
function isStaticAsset(url) {
    return url.includes('.css') || 
           url.includes('.js') || 
           url.includes('.woff') || 
           url.includes('.woff2') || 
           url.includes('.ttf') ||
           url.includes('fonts.googleapis.com');
}

// فحص إذا كان الطلب للصور
function isImageRequest(request) {
    return request.destination === 'image' ||
           request.url.includes('.jpg') ||
           request.url.includes('.jpeg') ||
           request.url.includes('.png') ||
           request.url.includes('.gif') ||
           request.url.includes('.webp') ||
           request.url.includes('.svg');
}

// معالجة الرسائل من الصفحة الرئيسية
self.addEventListener('message', event => {
    if (event.data && event.data.type) {
        switch (event.data.type) {
            case 'SKIP_WAITING':
                self.skipWaiting();
                break;
            case 'CACHE_URLS':
                cacheUrls(event.data.urls);
                break;
            case 'CLEAR_CACHE':
                clearAllCaches();
                break;
        }
    }
});

// تخزين مؤقت لعدة URLs
async function cacheUrls(urls) {
    try {
        const cache = await caches.open(DYNAMIC_CACHE);
        await cache.addAll(urls);
        console.log('[SW] URLs cached successfully');
    } catch (error) {
        console.log('[SW] Error caching URLs:', error);
    }
}

// مسح جميع التخزين المؤقت
async function clearAllCaches() {
    try {
        const cacheNames = await caches.keys();
        await Promise.all(
            cacheNames.map(cacheName => caches.delete(cacheName))
        );
        console.log('[SW] All caches cleared');
    } catch (error) {
        console.log('[SW] Error clearing caches:', error);
    }
}

// دعم الإشعارات Push
self.addEventListener('push', event => {
    console.log('[SW] Push received');
    
    let notificationData = {
        title: 'الحلول العملية',
        body: 'حل جديد متاح!',
        icon: '/wp-content/themes/practical-solutions/assets/icons/icon-192x192.png',
        badge: '/wp-content/themes/practical-solutions/assets/icons/badge-72x72.png',
        vibrate: [200, 100, 200],
        data: {
            url: '/'
        },
        actions: [
            {
                action: 'view',
                title: 'عرض الحل',
                icon: '/wp-content/themes/practical-solutions/assets/icons/view-icon.png'
            },
            {
                action: 'close',
                title: 'إغلاق',
                icon: '/wp-content/themes/practical-solutions/assets/icons/close-icon.png'
            }
        ]
    };
    
    // إذا كانت البيانات متوفرة من الخادم
    if (event.data) {
        try {
            const pushData = event.data.json();
            notificationData = { ...notificationData, ...pushData };
        } catch (error) {
            console.log('[SW] Error parsing push data:', error);
        }
    }
    
    event.waitUntil(
        self.registration.showNotification(notificationData.title, notificationData)
    );
});

// التعامل مع النقر على الإشعارات
self.addEventListener('notificationclick', event => {
    console.log('[SW] Notification clicked');
    
    event.notification.close();
    
    if (event.action === 'view') {
        event.waitUntil(
            clients.openWindow(event.notification.data.url || '/')
        );
    } else if (event.action !== 'close') {
        // النقر على الإشعار نفسه (ليس على الأزرار)
        event.waitUntil(
            clients.openWindow(event.notification.data.url || '/')
        );
    }
});

// مزامنة البيانات في الخلفية
self.addEventListener('sync', event => {
    console.log('[SW] Background sync');
    
    if (event.tag === 'practical-sync') {
        event.waitUntil(syncData());
    }
});

// دالة مزامنة البيانات
async function syncData() {
    try {
        // يمكن إضافة منطق المزامنة هنا
        // مثل إرسال التقييمات المحفوظة محلياً
        console.log('[SW] Data synced successfully');
    } catch (error) {
        console.log('[SW] Sync failed:', error);
    }
}

// تنظيف التخزين المؤقت دورياً
self.addEventListener('periodicsync', event => {
    if (event.tag === 'practical-cleanup') {
        event.waitUntil(cleanupOldCache());
    }
});

// تنظيف التخزين المؤقت القديم
async function cleanupOldCache() {
    try {
        const cache = await caches.open(DYNAMIC_CACHE);
        const requests = await cache.keys();
        const oneWeekAgo = Date.now() - (7 * 24 * 60 * 60 * 1000);
        
        await Promise.all(
            requests.map(async request => {
                const response = await cache.match(request);
                const dateHeader = response.headers.get('date');
                
                if (dateHeader) {
                    const responseDate = new Date(dateHeader).getTime();
                    if (responseDate < oneWeekAgo) {
                        await cache.delete(request);
                        console.log('[SW] Deleted old cache entry:', request.url);
                    }
                }
            })
        );
        
        console.log('[SW] Cache cleanup completed');
    } catch (error) {
        console.log('[SW] Cache cleanup failed:', error);
    }
}

// معالجة أخطاء JavaScript
self.addEventListener('error', event => {
    console.log('[SW] Error occurred:', event.error);
});

self.addEventListener('unhandledrejection', event => {
    console.log('[SW] Unhandled promise rejection:', event.reason);
});

// تسجيل حالة Service Worker
console.log('[SW] Service Worker loaded successfully');