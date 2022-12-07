const staticCacheName = 'static-site-v1'
    // const dynamicCacheName = 'dynamic-site-v1'
const assets = [
        '/',
        // '/admin',
        '/admin/fallback',
        '/assets/vendor/fontawesome-free/css/all.min.css',
        'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
        'https://fonts.gstatic.com/s/nunito/v25/XRXX3I6Li01BKofIMNaORs7nczIHNHI.woff2',
        'https://fonts.gstatic.com/s/nunito/v25/XRXX3I6Li01BKofIMNaDRs7nczIH.woff2',
        'https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOOaBTMnFcQIG.woff2',
        // 'https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofINeaBTMnFcQ.woff',
        '/assets/img/alkhairiyah.png',
        '/assets/css/sb-admin-2.min.css',
        '/assets/adminmainstyle3.css',
        '/assets/css/pickmeup1.css',
        '/manifest.json',
        '/assets/vendor/jquery/jquery.min.js',
        '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        '/assets/vendor/jquery-easing/jquery.easing.min.js',
        '/assets/js/sb-admin-2-2.js',
        '/assets/js/sweetalert2.all.min.js',
        '/assets/js/pickmeup1.js',
        '/assets/js/adminmainscript3.js',
        '/assets/js/app2.js',
    ]
    // install event
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(staticCacheName).then(cache => {
            cache.addAll(assets)
        })
    )
})

// activate event
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName)
                .map(key => caches.delete(key))
            )
        })
    )
});

// fetch event
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(cacheRes => {
            return cacheRes || fetch(event.request)
                // .then(fetchRes => {
                //     return caches.open(dynamicCacheName).then(cache => {
                //         cache.put(event.request.url, fetchRes.clone())
                //         return fetchRes
                //     })
                // })
        })
    )
});