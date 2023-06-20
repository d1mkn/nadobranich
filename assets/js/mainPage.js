"use strict";

const refs = {
  // header
  searchBtn: document.querySelector(".js-search-btn"),
  searchForm: document.querySelector(".js-search-form"),
  // backdrop
  backdrop: document.querySelector(".backdrop"),
  // mobile menu
  menuBtn: document.querySelector(".mobile-menu-btn"),
  menuContainer: document.querySelector(".mobile-menu__container"),
  closeBtn: document.querySelector(".mobile-menu__close-btn"),
  // modal
  modalTriggerList: document.querySelectorAll(".js-quick-view"),
  modal: document.querySelector(".modal"),
  modalDialog: document.querySelector(".modal__dialog"),
  modalBackdrop: document.querySelector(".modal-backdrop"),
  closeButton: document.querySelector(".modal__dialog-close"),
  addButton: document.querySelector(".js-add-to-cart"),
  toCardWrap: document.querySelector(".js-to-cart-modal"),
  toCardClsBtn: document.querySelector(".js-to-cart-close-btn"),
  // faq
  faqItems: document.querySelectorAll(".faq__item"),
  // fabrics
  fabricsItems: document.querySelectorAll(".fabrics__item"),
  // category
  categoryItems: document.querySelectorAll(".category-page__filter-item"),
  categoryDrop: document.querySelectorAll(".category-page__filter-drop"),
  // ordering
  orderingCheckbox1: document.querySelector(".js-checkbox1"),
  orderingCheckbox2: document.querySelector(".js-checkbox2"),
  orderingSummary: document.querySelector(".ordering-details-js"),
  orderingDetails: document.querySelector(".ordering-items-js"),
  // item
  formShowBtn: document.querySelector(".js-form-open-btn"),
  reviewForm: document.querySelector(".js-review-form"),
  // footer
  footerSections: document.querySelectorAll(".js-footer-section"),
  catalogTitle: document.querySelector(".footer__catalog"),
  catalogList: document.querySelector(".footer__catalog-list"),
  infoTitle: document.querySelector(".footer__info"),
  infoList: document.querySelector(".footer__info-list"),
  contactsTitle: document.querySelector(".footer__contacts"),
  contactsList: document.querySelector(".footer__contacts-wrap"),
};

function headerSearchForm() {
  const searchBtn = refs.searchBtn;
  const searchForm = refs.searchForm;

  searchBtn.addEventListener("click", () => {
    if (searchForm.classList.contains("visually-hidden")) {
      searchForm.classList.toggle("animate__fadeIn");
      searchForm.classList.toggle("visually-hidden");
    } else {
      searchForm.classList.toggle("animate__fadeIn");
      searchForm.classList.toggle("animate__fadeOut");
      setTimeout(() => {
        searchForm.classList.toggle("visually-hidden");
        searchForm.classList.toggle("animate__fadeOut");
      }, 500);
    }
  });
}
headerSearchForm();

refs.menuBtn.addEventListener("click", () => {
  refs.backdrop.classList.remove("visually-hidden");
  refs.menuContainer.classList.add("is-open");
  document.body.classList.add("modal-open");
});

refs.backdrop.addEventListener("click", () => {
  refs.backdrop.classList.add("visually-hidden");
  refs.menuContainer.classList.remove("is-open");
  document.body.classList.remove("modal-open");
});

refs.closeBtn.addEventListener("click", () => {
  refs.backdrop.classList.add("visually-hidden");
  refs.menuContainer.classList.remove("is-open");
  document.body.classList.remove("modal-open");
});

const swiper = new Swiper(".swiper-container", {
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

const nextIcons = document.querySelectorAll(".single-category__navigation-icon-next");
const prevIcons = document.querySelectorAll(".single-category__navigation-icon-prev");

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

let isToCartOpened = false;

function openModal() {
  refs.modal.classList.remove("visually-hidden");
  refs.modalBackdrop.classList.remove("visually-hidden");
  refs.modalBackdrop.classList.add("animate__fadeIn");
  document.body.classList.add("modal-open");
}

function closeModal() {
  refs.modalBackdrop.classList.remove("animate__fadeIn");
  refs.modalBackdrop.classList.add("animate__fadeOut");
  setTimeout(() => {
    refs.modalBackdrop.classList.add("visually-hidden");
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("animate__fadeOut");
    document.body.classList.remove("modal-open");
  }, 500);
}

function closeToCartModal() {
  refs.toCardWrap.classList.toggle("animate__fadeInRight");
  refs.toCardWrap.classList.toggle("animate__fadeOutRight");

  setTimeout(() => {
    refs.toCardWrap.classList.toggle("visually-hidden");
    refs.toCardWrap.classList.toggle("animate__fadeOutRight");
  }, 1000);
}

refs.modalTriggerList.forEach((item) => item.addEventListener("click", openModal));

refs.modalBackdrop.addEventListener("click", closeModal);

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeModal();
  }
});

refs.closeButton.addEventListener("click", closeModal);

refs.modal.addEventListener("click", (e) => {
  e.stopPropagation();
});

refs.addButton.addEventListener("click", () => {
  closeModal();
  isToCartOpened = true;
  refs.toCardWrap.classList.toggle("animate__fadeInRight");
  refs.toCardWrap.classList.toggle("visually-hidden");

  setTimeout(() => {
    if (isToCartOpened) {
      closeToCartModal();
    }
  }, 5000);
});

refs.toCardClsBtn.addEventListener("click", () => {
  isToCartOpened = false;
  refs.toCardWrap.classList.toggle("animate__fadeInRight");
  refs.toCardWrap.classList.toggle("animate__fadeOutRight");

  setTimeout(() => {
    refs.toCardWrap.classList.toggle("visually-hidden");
    refs.toCardWrap.classList.toggle("animate__fadeOutRight");
  }, 1000);
});
