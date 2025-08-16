/**
 * Service Worker for Practical Solutions Theme
 * خدمة التخزين المؤقت للقالب
 */

const CACHE_NAME = 'practical-solutions-v2.1.0';
const urlsToCache = [
    '/',
    '/wp-content/themes/practical-solutions-pro/assets/css/unified.css',
    '/wp-content/themes/practical-solutions-pro/assets/js/unified.min.js',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap'
];

// تثبيت Service Worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('تم فتح التخزين المؤقت');
                return cache.addAll(urlsToCache);
            })
    );
});

// تفعيل Service Worker
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('حذف التخزين المؤقت القديم:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// اعتراض الطلبات
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                // إرجاع من Cache إذا وُجد
                if (response) {
                    return response;
                }
                
                return fetch(event.request);
            }
        )
    );
});