import simpleLightbox from "simplelightbox";
import Swiper, { Navigation, Thumbs } from "swiper";
Swiper.use([Navigation, Thumbs]);

let singleGallery = new SimpleLightbox(".js-single-gallery a", {
  captionsData: "alt",
  captionDelay: 250,
  scrollZoom: false,
});

let singleGalleryThumbs = null;

function initThumbs() {
  const screenWidth = window.innerWidth;
  if (screenWidth < 768 && !singleGalleryThumbs) {
    singleGalleryThumbs = new SimpleLightbox(".item__images-list a", {
      captionsData: "alt",
      captionDelay: 250,
      scrollZoom: false,
    });
    singleGallery.destroy();
    singleGallery = null;
  } else if (screenWidth >= 768 && singleGalleryThumbs && !singleGallery) {
    singleGalleryThumbs.destroy();
    singleGalleryThumbs = null;
    singleGallery = new SimpleLightbox(".js-single-gallery a", {
      captionsData: "alt",
      captionDelay: 250,
      scrollZoom: false,
    });
  }
}

const galleryThumbs = document.querySelectorAll(".item__images-list a");
galleryThumbs.forEach((thumb) => {
  thumb.addEventListener("click", (e) => {
    e.preventDefault();
  });
});

let swiperGalleryThumbs = new Swiper(".item__images-list.gallery-thumbs.swiper-container", {
  loop: true,
  freeMode: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
  slidesPerView: 7,
});
let swiperGalleryTop = new Swiper(".item__images-main-wrap.gallery-top.swiper-container", {
  loop: true,
  navigation: {
    nextEl: ".item__images-main-wrap .swiper-button-next",
    prevEl: ".item__images-main-wrap .swiper-button-prev",
  },
  thumbs: {
    swiper: swiperGalleryThumbs,
  },
});

function initSwiper() {
  const screenWidth = window.innerWidth;
  if (screenWidth >= 768 && !swiperGalleryThumbs && !swiperGalleryTop) {
    swiperGalleryThumbs = new Swiper(".item__images-list.gallery-thumbs.swiper-container", {
      loop: true,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
      slidesPerView: "auto",
    });
    
    swiperGalleryTop = new Swiper(".item__images-main-wrap.gallery-top.swiper-container", {
      loop: true,
      navigation: {
        nextEl: ".item__images-main-wrap .swiper-button-next",
        prevEl: ".item__images-main-wrap .swiper-button-prev",
      },
      thumbs: {
        swiper: swiperGalleryThumbs,
      },
    });
  } else if (screenWidth < 768 && swiperGalleryThumbs && swiperGalleryTop) {
    swiperGalleryThumbs.destroy();
    swiperGalleryThumbs = null;

    swiperGalleryTop.destroy();
    swiperGalleryTop = null;
  }
  if (screenWidth < 768) {
    document
      .querySelector(".item__images-list")
      .classList.remove(
        "swiper-backface-hidden",
        "swiper-thumbs",
        "swiper-initialized",
        "swiper-horizontal",
        "swiper-watch-progress"
      );

    document.querySelectorAll(".item__images-list .swiper-slide").forEach((slide) => {
      slide.classList.remove(
        "swiper-slide-active",
        "swiper-slide-thumb-active",
        "swiper-slide-prev",
        "swiper-slide-next"
      );
    });
  }
}

window.addEventListener("load", initSwiper);
window.addEventListener("resize", initSwiper);
window.addEventListener("orientationchange", initSwiper);

window.addEventListener("load", initThumbs);
window.addEventListener("resize", initThumbs);
window.addEventListener("orientationchange", initThumbs);
