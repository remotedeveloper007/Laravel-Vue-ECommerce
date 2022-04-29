const cacheName = 'E-Shop';
// let filesToCache = [
//   '/',
//   '/index.html',
//   // '/css/style.css',
//   '/assets/public/css/main.css',
//   '/assets/public/js/main.js'
// ];





// const cacheName = 'v1';
self.addEventListener('activate', (e) => {
  e.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== cacheName) {
            return caches.delete(cache);
          }
        })
      )
    })
  )
});

// self.addEventListener('fetch', e => {
//   e.respondWith(
//     fetch(e.request)
//       .then(res => {
//         const resClone = res.clone();
//         caches
//           .open(cacheName)
//           .then(cache => {
//             cache.put(e.request, resClone);
//           });
//         return res;
//       }).catch(err => caches.match(e.request).then(res => res))
//   );
// });


/* Start the service worker and cache all of the app's content */

// self.addEventListener('install', function (e) =>{
//   e.waitUntil(
//     caches.open(cacheName).then(function (cache) {
//       return cache.addAll(filesToCache);
//     })
//   );
// });

/* Serve cached content when offline */

self.addEventListener('fetch', function (e) {

  // No "fetch" events are dispatched to the service worker until it
  // successfully installs and activates.

  // All operations on caches are async, including matching URLs, so we use
  // promises heavily. e.respondWith() even takes promises to enable this:  

  e.respondWith(
    caches.match(e.request).then(function (response) {
      return response || fetch(e.request);
    })
  );
});