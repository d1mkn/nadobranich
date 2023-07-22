import Swiper, { Navigation } from "swiper";

Swiper.use([Navigation]);
const swiper = new Swiper(".single-category.swiper-container", {
  loop: false,

  on: {
    init: navigationBtnStyle.bind(this),
    slideChange: navigationBtnStyle.bind(this),
  },

  breakpoints: {
    320: {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      slidesPerView: "auto",
      slidesPerGroup: 1,
    },

    768: {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      slidesPerView: "auto",
      slidesPerGroup: 1,
    },
  },
});

const galleryThumbs = new Swiper(".gallery-thumbs.swiper-container", {
  loop: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
});
const galleryTop = new Swiper(".gallery-top .swiper-container", {
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: galleryThumbs,
  },
});

const nextIcons = document.querySelectorAll(
  ".single-category__navigation .single-category__navigation-icon-next"
);
const prevIcons = document.querySelectorAll(
  ".single-category__navigation .single-category__navigation-icon-prev"
);

nextIcons.forEach((icon) => {
  const nextEl = icon.closest(".swiper-button-next");

  nextEl.addEventListener("click", () => {
    if (nextEl.classList.contains("swiper-button-disabled")) {
      return;
    }

    icon.classList.add("icow35");
    setTimeout(() => {
      icon.classList.remove("icow35");
    }, 200);
  });
});

prevIcons.forEach((icon) => {
  const prevEl = icon.closest(".swiper-button-prev");

  prevEl.addEventListener("click", () => {
    if (prevEl.classList.contains("swiper-button-disabled")) {
      return;
    }

    icon.classList.add("icow35");
    setTimeout(() => {
      icon.classList.remove("icow35");
    }, 200);
  });
});

function navigationBtnStyle(swiper) {
  const nextEl = swiper.navigation.nextEl;
  const prevEl = swiper.navigation.prevEl;

  if (Array.isArray(nextEl) && Array.isArray(prevEl)) {
    nextEl[0].classList.contains("swiper-button-disabled")
      ? (nextEl[0].style.opacity = "0.5")
      : nextEl[0].removeAttribute("style");

    prevEl[0].classList.contains("swiper-button-disabled")
      ? (prevEl[0].style.opacity = "0.5")
      : prevEl[0].removeAttribute("style");
  } else {
    nextEl.classList.contains("swiper-button-disabled")
      ? (nextEl.style.opacity = "0.5")
      : nextEl.removeAttribute("style");

    prevEl.classList.contains("swiper-button-disabled")
      ? (prevEl.style.opacity = "0.5")
      : prevEl.removeAttribute("style");
  }
}
