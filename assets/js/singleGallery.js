import simpleLightbox from "simplelightbox";

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

window.addEventListener("load", initThumbs);
window.addEventListener("resize", initThumbs);
window.addEventListener("orientationchange", initThumbs);

const galleryThumbs = document.querySelectorAll(".item__images-list a");
galleryThumbs.forEach((thumb) => {
  thumb.addEventListener("click", (e) => {
    e.preventDefault();
  });
});
