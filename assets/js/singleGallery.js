import simpleLightbox from "simplelightbox";

const singleGallery = new SimpleLightbox(".js-single-gallery a", {
  captionsData: "alt",
  captionDelay: 250,
  scrollZoom: false,
});

let singleGalleryThumbs = new SimpleLightbox(".item__images-list a", {
  captionsData: "alt",
  captionDelay: 250,
  scrollZoom: false,
});

function initThumbs() {
  const screenWidth = window.innerWidth;
  if (screenWidth < 768 && !singleGalleryThumbs) {
    let singleGalleryThumbs = new SimpleLightbox(".item__images-list a", {
      captionsData: "alt",
      captionDelay: 250,
      scrollZoom: false,
    });
  } else if (screenWidth >= 768 && singleGalleryThumbs) {
    singleGalleryThumbs.destroy();
    singleGalleryThumbs = null;
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
