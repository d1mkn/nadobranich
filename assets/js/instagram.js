import { refs } from "./refs";

window.addEventListener("load", instaGalleryRender);
window.addEventListener("resize", instaGalleryRender);

function instaGalleryRender() {
  const gallery = refs.instaGallery;

  if (document.documentElement.clientWidth < 1240) {
    gallery.innerHTML = `<li class="insta__gallery-item"></li><li class="insta__gallery-item"></li><li class="insta__gallery-item"></li><li class="insta__gallery-item"></li>`;
  } else {
    gallery.innerHTML = `<li class="insta__gallery-item"><li class="insta__gallery-item"><li class="insta__gallery-item"><li class="insta__gallery-item"><li class="insta__gallery-item"><li class="insta__gallery-item">`;
  }
}
instaGalleryRender();
