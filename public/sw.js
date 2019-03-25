<<<<<<< HEAD
<<<<<<< HEAD
importScripts("/service-worker/precache-manifest.eb9e5a94eea23932fd0dac0cbf774fc7.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");
=======
importScripts("/service-worker/precache-manifest.7120e20d94ee3c0e95eac71cf197f30d.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");
>>>>>>> master
=======
importScripts('/service-worker/precache-manifest.7120e20d94ee3c0e95eac71cf197f30d.js', 'https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js')
>>>>>>> master

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
