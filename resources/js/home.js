console.log("tes")

const gallery = document.getElementById('galleryContainer');
  let scrollSpeed = 1;
  let scrollInterval;

  function startAutoScroll() {
    scrollInterval = setInterval(() => {
      gallery.scrollLeft += scrollSpeed;
      if (gallery.scrollLeft + gallery.clientWidth >= gallery.scrollWidth - 1) {
        clearInterval(scrollInterval);
        setTimeout(() => {
          gallery.scrollTo({
            left: 0,
            behavior: "smooth"
          });
          setTimeout(startAutoScroll, 1000);
        }, 500);
      }
    }, 20);
  }

  function stopAutoScroll() {
    clearInterval(scrollInterval);
  }

  startAutoScroll();

  gallery.addEventListener('mouseenter', stopAutoScroll);
  gallery.addEventListener('mouseleave', startAutoScroll);
