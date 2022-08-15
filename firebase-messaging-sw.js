importScripts('https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js');

firebase.initializeApp({
          apiKey: "AIzaSyB-RclJ3nO0yWpmXvhKUPDDD2RNwpT6h20",

          authDomain: "telemedicine-internal.firebaseapp.com",

          databaseURL: "https://telemedicine-internal-default-rtdb.asia-southeast1.firebasedatabase.app",

          projectId: "telemedicine-internal",

          storageBucket: "telemedicine-internal.appspot.com",

          messagingSenderId: "782919055693",

          appId: "1:782919055693:web:68b90d015a672459381f04"

 
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/itwonders-web-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
 