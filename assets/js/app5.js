if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw5.js')
        .then(() => true)
        .catch(err => console.log('service worker not registered', err));
}