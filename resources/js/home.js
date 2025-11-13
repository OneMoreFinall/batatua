console.log("tes home.js dimuat");

const gallery = document.getElementById('galleryContainer');

if (gallery) {
    let scrollSpeed = 1;
    let scrollInterval;

    function startAutoScroll() {
        scrollInterval = setInterval(() => {
            gallery.scrollLeft += scrollSpeed;
            
            if (gallery.scrollLeft >= (gallery.scrollWidth / 2)) {
                gallery.scrollLeft = 0;
            }
        }, 20);
    }

    function stopAutoScroll() {
        clearInterval(scrollInterval);
    }

    startAutoScroll();

    gallery.addEventListener('mouseenter', stopAutoScroll);
    gallery.addEventListener('mouseleave', startAutoScroll);
}