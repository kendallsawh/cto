// public/service-worker.js


// Listen for the 'push' event and display a notification
self.addEventListener('push', event => {
  //{"title":"title", "body":"body"}
  console.log('Push event received:', event);
  const data = event.data ? event.data.json() : {title: 'Default title', body: 'Default body'};
  event.waitUntil(
    self.registration.showNotification(data.title, {
      body: data.body
      
    })
  );
});

// Test notification upon service worker activation
/*self.addEventListener('activate', event => {
  console.log('Service worker activated');
  event.waitUntil(
    self.registration.showNotification('Activation Notification', {
      body: 'Service Worker Activated',
      icon: '/path/to/your/icon.png' // Optional: Provide a path to an icon
    })
  );
});
*/
