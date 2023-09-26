self.addEventListener("install", e =>{
    // console.log("install");
    e.waitUntil(
        caches.open("static").then(cache =>{
            return cache.addAll(['./', "./css/style.css", "./img/logo/logo.jpg", "./img/default.png"])
        })
    );
});

self.addEventListener("fetch", e =>{
    console.log(`intercepting fetch request for: ${ e.request.url }`);
})