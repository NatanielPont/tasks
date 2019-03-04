importScripts("/service-worker/precache-manifest.44ff156a170503b729c58bc98c53836b.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");

workbox.skipWaiting()
workbox.clientsClaim()

// workbox.routing.registerRoute(
//   new RegExp('https://hacker-news.firebaseio.com'),
//   workbox.strategies.staleWhileRevalidate()
// );

// TODO cal utilitzar PushManager al registrar el service worker
self.addEventListener('push', (event) => {
  const title = 'TODO CANVIAR TITOL'
  const options = {
    body: event.data.text()
  }
  event.waitUntil(self.registration.showNotification(title, options))
})

workbox.precaching.precacheAndRoute(self.__precacheManifest)
// workbox.precaching.precacheAndRoute([]) També funciona i workbox substitueix pel que pertoca -> placeholder

// static
// workbox.routing.registerRoute(
//   new RegExp('.(?:ico)$'),
//   workbox.strategies.networkFirst({
//     cacheName: 'icons'
//   })
// )

// images
workbox.routing.registerRoute(
  new RegExp('.(?:jpg|jpeg|png|gif|svg|webp)$'),
  workbox.strategies.cacheFirst({
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
  workbox.strategies.staleWhileRevalidate({ cacheName: 'landing' })
)

