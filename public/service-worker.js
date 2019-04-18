importScripts("/service-worker/precache-manifest.e5ae2a855f1a9f6df28541802e0da2a8.js", "https://storage.googleapis.com/workbox-cdn/releases/4.3.0/workbox-sw.js");

workbox.setConfig({
  debug: true
})

// workbox.skipWaiting()
// workbox.clientsClaim()

// 4.0
workbox.core.skipWaiting()
workbox.core.clientsClaim()

// workbox.routing.registerRoute(
//   new RegExp('https://hacker-news.firebaseio.com'),
//   workbox.strategies.staleWhileRevalidate()
// );

// TODO cal utilitzar PushManager al registrar el service worker
self.addEventListener('push', (event) => {
  const title = 'Tasks Nataniel Pont'
  const options = {
    body: event.data.text()
  }
  event.waitUntil(self.registration.showNotification(title, options))
})
self.addEventListener('sync', function (event) {

})

const showNotification = () => {
  self.registration.showNotification('Post Sent', {
    body: 'You are back online and your post was successfully sent!'
    // icon: 'assets/icon/256.png',
    // badge: 'assets/icon/32png.png'
  })
}

workbox.precaching.precacheAndRoute(self.__precacheManifest)
workbox.routing.registerRoute(
  new RegExp('https://tasks.*/img/*.*(?:jpg|jpeg|png|gif|svg|webp)$'),
  new workbox.strategies.CacheFirst({
    cacheName: 'images',
    plugins: [
      new workbox.expiration.Plugin({
        maxEntries: 20,
        purgeOnQuotaError: true
      })
    ]
  })
)

workbox.routing.registerRoute(
  '/',
  new workbox.strategies.NetworkFirst({ cacheName: 'landing' })
)

workbox.routing.registerRoute(
  '/tasques',
  new workbox.strategies.StaleWhileRevalidate({ cacheName: 'tasques' })
)

workbox.routing.registerRoute(
  new RegExp('/api/'),
  new workbox.strategies.NetworkFirst({ cacheName: 'api' })
)

const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
  maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
  callbacks: {
    queueDidReplay: showNotification
  }
})

workbox.routing.registerRoute(
  '/api/v1/newsletter',
  new workbox.strategies.NetworkOnly({
    cacheName: 'api',
    plugins: [bgSyncPlugin]
  }),
  'POST'
)

