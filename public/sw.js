importScripts('/service-worker/precache-manifest.7120e20d94ee3c0e95eac71cf197f30d.js', 'https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js')

workbox.skipWaiting()
workbox.clientsClaim()

// workbox.routing.registerRoute(
//   new RegExp('https://hacker-news.firebaseio.com'),
//   workbox.strategies.staleWhileRevalidate()
// );

// workbox.precaching.cleanupOutdatedCaches()

// TODO cal utilitzar PushManager al registrar el service worker
// self.addEventListener('push', (event) => {
//   const title = 'TODO CANVIAR TITOL'
//   const options = {
//     body: event.data.text()
//   }
//   event.waitUntil(self.registration.showNotification(title, options))
// })

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
const showNotification = () => {
  self.registration.showNotification('Post Sent', {
    body: 'You are back online and your post was successfully sent!'
    // icon: 'assets/icon/256.png',
    // badge: 'assets/icon/32png.png'
  })
}

const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
  maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
  callbacks: {
    queueDidReplay: showNotification
  }
})

workbox.routing.registerRoute(
  '/api/v1/newsletter',
  new workbox.strategies.NetworkOnly({
    plugins: [bgSyncPlugin]
  }),
  'POST'
)

const WebPush = {
  init () {
    self.addEventListener('push', this.notificationPush.bind(this))
    self.addEventListener('notificationclick', this.notificationClick.bind(this))
    self.addEventListener('notificationclose', this.notificationClose.bind(this))
  },

  /**
   * Handle notification push event.
   *
   * https://developer.mozilla.org/en-US/docs/Web/Events/push
   *
   * @param {NotificationEvent} event
   */
  notificationPush (event) {
    console.log('hola noti push1')
    if (!(self.Notification && self.Notification.permission === 'granted')) {
      console.log('hola noti push2 not granted')
      return
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/PushMessageData
    if (event.data) {
      event.waitUntil(

        this.sendNotification(event.data.json())

      )
    }
  },

  /**
   * Handle notification push event.
   *
   * https://developer.mozilla.org/en-US/docs/Web/Events/push
   *
   * @param {NotificationEvent} event
   */
  notificationClick (event) {
    if (!event.action) {
      if (event.notification.data) {
        if (event.notification.data.url) {
          promiseChain = self.clients.openWindow(event.notification.data.url)
          event.waitUntil(promiseChain)
          return
        }
      }
      promiseChain = self.clients.openWindow('/')
      event.waitUntil(promiseChain)
      return
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/PushMessageData
    switch (event.action) {
      case 'open_url':
        if (event.notification.data) {
          if (event.notification.data.url) {
            promiseChain = self.clients.openWindow(event.notification.data.url)
            event.waitUntil(promiseChain)
            break
          }
        }
        break
      case 'other_action':
        break
      default:
        console.log(`Unknown action clicked: '${event.action}'`)
        break
    }
  },

  /**
   * Handle notification close event (Chrome 50+, Firefox 55+).
   *
   * https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerGlobalScope/onnotificationclose
   *
   * @param {NotificationEvent} event
   */
  notificationClose (event) {
    self.registration.pushManager.getSubscription().then(subscription => {
      if (subscription) {
        this.dismissNotification(event, subscription)
      }
    })
  },

  /**
   * Send notification to the user.
   *
   * https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerRegistration/showNotification
   *
   * @param {PushMessageData|Object} data
   */
  sendNotification (data) {
    console.log('hola noti push3')

    return self.registration.showNotification(data.title, data)
  },

  /**
   * Send request to server to dismiss a notification.
   *
   * @param  {NotificationEvent} event
   * @param  {String} subscription.endpoint
   * @return {Response}
   */
  dismissNotification ({ notification }, { endpoint }) {
    console.log('dismissNotification triggered!')
    if (!notification.data || !notification.data.id) {
      return
    }

    const data = new FormData()
    data.append('endpoint', endpoint)

    // Send a request to the server to mark the notification as read.
    fetch(`/api/v1/unread_notifications/${notification.data.id}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      method: 'POST',
      body: data
    })
  }
}
WebPush.init()
