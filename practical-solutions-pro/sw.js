/**
 * Service Worker for Practical Solutions Pro (Fixed)
 * خدمة التخزين المؤقت المصححة
 */

const CACHE_NAME = 'practical-solutions-v2.2.3';
const STATIC_CACHE = 'static-v2.2.3';
const DYNAMIC_CACHE = 'dynamic-v2.2.3';

// الملفات الأساسية للتخزين المؤقت
const urlsToCache = [
    '/',
    '/wp-content/themes/practical-solutions-pro/dist/css/main.min.css',
    '/wp-content/themes/practical-solutions-pro/dist/js/main.min.js',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
];

// تثبيت Service Worker
self.addEventListener('install', (event) => {
    console.log('SW: Installing...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then((cache) => {
                console.log('SW: Cache opened');
                return cache.addAll(urlsToCache.map(url => {
                    return new Request(url, { cache: 'reload' });
                }));
            })
            .then(() => {
                console.log('SW: All files cached');
                return self.skipWaiting();
            })
            .catch((error) => {
                console.error('SW: Cache failed:', error);
            })
    );
});

// تفعيل Service Worker
self.addEventListener('activate', (event) => {
    console.log('SW: Activating...');
    
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE) {
                        console.log('SW: Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            console.log('SW: Activated');
            return self.clients.claim();
        })
    );
});

// اعتراض الطلبات
self.addEventListener('fetch', (event) => {
    // تجاهل طلبات غير HTTP
    if (!event.request.url.startsWith('http')) {
        return;
    }
    
    // تجاهل طلبات Admin
    if (event.request.url.includes('/wp-admin/') || 
        event.request.url.includes('/wp-login.php')) {
        return;
    }
    
    event.respondWith(
        // البحث في الكاش أولاً
        caches.match(event.request)
            .then((cachedResponse) => {
                if (cachedResponse) {
                    return cachedResponse;
                }
                
                // إذا لم يوجد في الكاش، جلب من الشبكة
                return fetch(event.request)
                    .then((response) => {
                        // التحقق من صحة الاستجابة
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }
                        
                        // تحديد نوع الكاش حسب نوع الملف
                        const responseToCache = response.clone();
                        const cacheName = isStaticResource(event.request.url) ? 
                            STATIC_CACHE : DYNAMIC_CACHE;
                        
                        caches.open(cacheName)
                            .then((cache) => {
                                cache.put(event.request, responseToCache);
                            });
                        
                        return response;
                    })
                    .catch(() => {
                        // في حالة عدم توفر الإنترنت، إرجاع صفحة offline
                        if (event.request.destination === 'document') {
                            return caches.match('/offline.html') || 
                                   new Response('<h1>غير متصل بالإنترنت</h1>', {
                                       headers: { 'Content-Type': 'text/html' }
                                   });
                        }
                    });
            })
    );
});

// دالة للتحقق من الملفات الثابتة
function isStaticResource(url) {
    return url.includes('.css') || 
           url.includes('.js') || 
           url.includes('.woff') || 
           url.includes('.woff2') || 
           url.includes('.ttf') ||
           url.includes('fonts.googleapis.com');
}

// تنظيف الكاش الديناميكي
self.addEventListener('message', (event) => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
    
    if (event.data && event.data.type === 'CLEAR_CACHE') {
        caches.delete(DYNAMIC_CACHE).then(() => {
            console.log('SW: Dynamic cache cleared');
        });
    }
});

// إشعار التحديث
self.addEventListener('controllerchange', () => {
    console.log('SW: New version available');
});