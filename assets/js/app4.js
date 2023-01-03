if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw4.js')
        .then(() => true)
        .catch(err => console.log('service worker not registered', err));
}