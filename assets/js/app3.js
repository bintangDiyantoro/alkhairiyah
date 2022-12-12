if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw3.js')
        .then(() => true)
        .catch(err => console.log('service worker not registered', err));
}