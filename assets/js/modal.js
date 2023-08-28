import { refs } from "./refs";
import axios from "axios";
import Swiper, { Navigation, Thumbs } from "swiper";
import SimpleLightbox from "simplelightbox";

export let isToCartOpened = false;
let modalGalleryThumbs = null;
let modalGalleryTop = null;

export function openModal() {
  refs.modal.classList.remove("visually-hidden");
  refs.modalBackdrop.classList.remove("visually-hidden");
  refs.modalBackdrop.classList.add("animate__fadeIn");
  document.body.classList.add("modal-open");
  document.querySelector(".modal__images-main-wrap .swiper-wrapper").removeAttribute("style");
}

export function closeModal() {
  refs.modalBackdrop.classList.remove("animate__fadeIn");
  refs.modalBackdrop.classList.add("animate__fadeOut");
  refs.authContainer.classList.add("visually-hidden");
  refs.loginForm.classList.add("visually-hidden");
  refs.registerForm.classList.add("visually-hidden");
  if (modalGalleryThumbs) {
    modalGalleryThumbs.destroy();
    modalGalleryThumbs = null;
  }
  if (modalGalleryTop) {
    modalGalleryTop.destroy();
    modalGalleryTop = null;
  }
  setTimeout(() => {
    refs.modalBackdrop.classList.add("visually-hidden");
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("animate__fadeOut");
    document.body.classList.remove("modal-open");
  }, 500);
}

export function openToCartModal() {
  isToCartOpened = true;
  refs.toCartWrap.classList.toggle("animate__fadeInRight");
  refs.toCartWrap.classList.toggle("visually-hidden");
}

export function closeToCartModal() {
  refs.toCartWrap.classList.toggle("animate__fadeInRight");
  refs.toCartWrap.classList.toggle("animate__fadeOutRight");

  setTimeout(() => {
    refs.toCartWrap.classList.toggle("visually-hidden");
    refs.toCartWrap.classList.toggle("animate__fadeOutRight");
  }, 1000);
}

let currProduct = null;
let singleSize = null;
let prevActiveId;
let prevActiveColor;
let prevActiveSize;

function renderInfoFromLocal(e) {
  const productId = e.target.closest(".single-category__item").dataset.productid;
  localStorage.setItem("productId", productId);
  const aboutProducts = JSON.parse(localStorage.getItem("aboutProducts"));
  currProduct = aboutProducts.find((product) => product.id == productId);
  console.log(currProduct);

  // main img
  const mainImg = currProduct.productImages.mainImg;
  refs.mainImgWrap.innerHTML = topImgMarkup();

  function topImgMarkup() {
    let markup = `<div class="modal__images-main swiper-slide"><a href="${mainImg.url}"><img src="${mainImg.url}" alt="${mainImg.alt}"></a></div>`;
    const imagesList = currProduct.productImages.gallery;

    imagesList.forEach((image) => {
      markup += `<div class="modal__images-main swiper-slide"><a href="${image.url}"><img src="${image.url}" alt="${image.alt}"></a></div>`;
    });
    return markup;
  }

  // image gallery
  refs.modalGallery.innerHTML = galleryMarkup();

  function galleryMarkup() {
    let markup = `<li class="modal__images-item swiper-slide"><a href="${mainImg.url}"><img class="modal__images-item" src="${mainImg.url}" alt="${mainImg.alt}"></a></li>`;
    const imagesList = currProduct.productImages.gallery;

    imagesList.forEach((image) => {
      markup += `<li class="modal__images-item swiper-slide"><a href="${image.url}"><img src="${image.url}" alt="${image.alt}"></a></li>`;
    });
    return markup;
  }
  initGallery();

  // title
  refs.productTitle.textContent = currProduct.productTitle;

  // description
  refs.productDesc.textContent = currProduct.productDesc;

  // rating
  if (currProduct.rating.average == 0) {
    refs.ratingLink.textContent = "0";
    refs.ratingStars.setAttribute("style", `width: 0%;`);
  } else {
    refs.ratingLink.textContent = currProduct.rating.reviewCount;
    const ratingPercentage = (parseFloat(currProduct.rating.average) * 100) / 5;
    const adjustedPercentage = ratingPercentage + Math.floor(ratingPercentage / 20) * 0.5;

    refs.ratingStars.setAttribute("style", `width: ${adjustedPercentage}%;`);
  }
  refs.ratingLink.setAttribute("href", `${currProduct.productLink}#reviews`);

  // price color size
  let colorListTemp = [];
  let colorList = [];
  let sizeList = [];
  function colorListMarkup() {
    currProduct.attributes.forEach((attribute) => {
      if (attribute.hasOwnProperty("pa_color")) {
        colorListTemp = attribute.pa_color;
      }
      if (attribute.hasOwnProperty("pa_size")) {
        singleSize = attribute.pa_size[0].name;
        sizeList = attribute.pa_size;
      }
    });

    for (var i = 0; i < colorListTemp.length; i++) {
      var colorName = colorListTemp[i].name;
      var matchingVariation = currProduct.variations.find((item) =>
        item.variationDesc.includes(`Колір: ${colorName}`)
      );
      if (matchingVariation) {
        colorList.push(colorListTemp[i]);
      }
    }

    let markup = "";
    for (let i = 0; i < colorList.length; i++) {
      const color = colorList[i].slug;
      const colorName = colorList[i].name;
      prevActiveColor = colorList[0].name;
      i === 0
        ? (markup += `<div class="modal__body-color-item active" data-color="${colorName}">
        <div style="background-color: ${color};"></div>
                  </div>`)
        : (markup += `<div class="modal__body-color-item" data-color="${colorName}">
        <div style="background-color: ${color};"></div>
                  </div>`);
    }
    return markup;
  }
  refs.colorList.innerHTML = colorListMarkup();
  console.log(colorList);
  refs.productColor.textContent = prevActiveColor;

  // Nav buttons
  refs.toItemBtn.setAttribute("href", currProduct.productLink);

  Swiper.use([Navigation, Thumbs]);
  modalGalleryThumbs = new Swiper(".modal__images-list-wrap.gallery-thumbs.swiper-container", {
    slidesPerView: "auto",
    loop: true,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
  });
  modalGalleryTop = new Swiper(".modal__images-main-wrap.gallery-top.swiper-container", {
    loop: true,
    navigation: {
      nextEl: ".modal-gallery-nav.swiper-button-next",
      prevEl: ".modal-gallery-nav.swiper-button-prev",
    },
    thumbs: {
      swiper: modalGalleryThumbs,
    },
  });

  function initModalSwiper() {
    const screenWidth = window.innerWidth;

    if (screenWidth >= 768 && !modalGalleryThumbs && !modalGalleryTop) {
      let modalGalleryThumbs = new Swiper(".modal__images-list-wrap.swiper-container", {
        slidesPerView: 7,
        loopedSlides: 4,
        loop: true,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
      });
      let modalGalleryTop = new Swiper(".modal__images-main-wrap.swiper-container", {
        loop: true,
        loopedSlides: 4,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: modalGalleryThumbs,
        },
      });
    } else if (screenWidth < 768 && modalGalleryThumbs && modalGalleryTop) {
      modalGalleryThumbs.destroy();
      modalGalleryThumbs = null;

      modalGalleryTop.destroy();
      modalGalleryTop = null;
    }
    if (screenWidth < 768) {
      document
        .querySelector(".modal__images-list")
        .classList.remove(
          "swiper-backface-hidden",
          "swiper-thumbs",
          "swiper-initialized",
          "swiper-horizontal",
          "swiper-watch-progress"
        );

      document.querySelectorAll(".modal__images-item.swiper-slide").forEach((slide) => {
        slide.classList.remove(
          "swiper-slide-active",
          "swiper-slide-thumb-active",
          "swiper-slide-prev",
          "swiper-slide-next"
        );
      });
    }
  }
  initModalSwiper();
}

function pickColor() {
  let activeIndex = 0;
  document.querySelectorAll("[data-color]").forEach((color, index) => {
    color.addEventListener("click", (e) => {
      const targetColor = e.currentTarget;
      const targetIndex = Array.from(targetColor.parentElement.children).indexOf(targetColor);

      if (activeIndex !== targetIndex) {
        document.querySelectorAll("[data-color]")[activeIndex].classList.remove("active");
        targetColor.classList.add("active");
        activeIndex = targetIndex;

        // Оновлення інформації про обраний колір
        refs.productColor.textContent = targetColor.dataset.color;
        prevActiveColor = targetColor.dataset.color;

        renderVariations(targetColor.dataset.color);
      }
    });
  });

  renderVariations(refs.productColor.textContent);
}

function renderVariations(selectedColor) {
  let prevActivePrice = null;
  let prevActiveSize = null;
  const selectedVariations = currProduct.variations.filter((variation) => {
    const colorIndex = variation.variationDesc.indexOf(`Колір: ${selectedColor}`);
    return colorIndex !== -1;
  });

  // Збереження комбінацій кольору та розміру + ціна
  const variationPrices = {};

  selectedVariations.forEach((variation) => {
    const variationDesc = variation.variationDesc;
    const sizeStartIndex = variationDesc.indexOf("Розмір: ") + 8;
    const sizeEndIndex = variationDesc.indexOf(",", sizeStartIndex);

    if (sizeStartIndex !== -1 && sizeEndIndex !== -1) {
      const size = variationDesc.substring(sizeStartIndex, sizeEndIndex).trim();
      const salePrice = variation.variationPrice;
      const price = variation.regularPrice;
      const variationId = variation.variationId;
      variationPrices[size] = { salePrice, price, variationId };
    }
  });

  let markup = "";

  let isFirst = true;

  for (const size in variationPrices) {
    if (variationPrices.hasOwnProperty(size)) {
      const { salePrice, price, variationId } = variationPrices[size];
      if (isFirst) {
        prevActiveSize = prevActiveSize || size; // Перший розмір за замовчуванням
        if (price === salePrice) {
          prevActivePrice = prevActivePrice || price; // Ціна за замовчуванням
          refs.productPrice.textContent = prevActivePrice + " грн";
        } else {
          refs.productPrice.innerHTML = `<span class="item-price">${price} грн</span>
                                          <span class="item-new-price">${salePrice} грн</span>`;
        }
        prevActiveId = variationId; // Варіація за замовчуванням
        localStorage.setItem("variationId", prevActiveId);
        localStorage.setItem("combination", `${prevActiveColor} / ${prevActiveSize}`);
        isFirst = false;
      }
      markup += `<button class="modal__body-size-btn${
        size === prevActiveSize ? " active" : ""
      }" data-size="${size}" data-price="${price}" data-sale="${salePrice}" data-variation-id="${variationId}" type="button">
                    ${size}</button>`;
    }
  }
  refs.sizeList.innerHTML = markup;
  refs.productSize.textContent = prevActiveSize;
  pickSize();
}

function pickSize() {
  let activeIndex = 0;
  document.querySelectorAll("[data-size]").forEach((size, index) => {
    size.addEventListener("click", (e) => {
      const targetSize = e.currentTarget;
      const targetIndex = Array.from(targetSize.parentElement.children).indexOf(targetSize);

      if (activeIndex !== targetIndex) {
        document.querySelectorAll("[data-size]")[activeIndex].classList.remove("active");
        targetSize.classList.add("active");
        activeIndex = targetIndex;

        // Оновлення інформації про обраний розмір
        refs.productSize.textContent = targetSize.dataset.size;
        prevActiveSize = targetSize.dataset.size;

        // Оновлення інформації про ціну
        console.log(targetSize.dataset.sale);
        if (targetSize.dataset.sale === targetSize.dataset.price) {
          refs.productPrice.innerHTML = `<p class="body-price js-modal-price">${targetSize.dataset.price} грн</p>`;
        } else {
          refs.productPrice.innerHTML = `<span class="item-price">${targetSize.dataset.price} грн</span>
                                          <span class="item-new-price">${targetSize.dataset.sale} грн</span>`;
        }

        // ID варіації для додавання у кошик
        prevActiveId = targetSize.dataset.variationId;
        localStorage.setItem("variationId", prevActiveId);

        localStorage.setItem("combination", `${prevActiveColor} / ${prevActiveSize}`);
      }
    });
  });
}

function initGallery() {
  let gallery = new SimpleLightbox(".js-modal-main-img a", {
    captionsData: "alt",
    captionDelay: 250,
    scrollZoom: false,
  });

  let modalThumbs = null;

  function initThumbs() {
    const screenWidth = window.innerWidth;
    if (screenWidth < 768 && !modalThumbs) {
      modalThumbs = new SimpleLightbox(".modal__images-list a", {
        captionsData: "alt",
        captionDelay: 250,
        scrollZoom: false,
      });
      gallery.destroy();
      gallery = null;
    } else if (screenWidth >= 768 && modalThumbs && !gallery) {
      modalThumbs.destroy();
      modalThumbs = null;
      gallery = new SimpleLightbox(".js-single-gallery a", {
        captionsData: "alt",
        captionDelay: 250,
        scrollZoom: false,
      });
    }
  }

  initThumbs();

  const galleryThumbs = document.querySelectorAll(".modal__images-list a");
  galleryThumbs.forEach((thumb) => {
    thumb.addEventListener("click", (e) => {
      e.preventDefault();
    });
  });

  const modalGalleryThumbs = document.querySelectorAll(".modal__images-list a");
  galleryThumbs.forEach((thumb) => {
    thumb.addEventListener("click", (e) => {
      e.preventDefault();
    });
  });
}

function fetchAddToCart() {
  const variationId = localStorage.getItem("variationId");
  refs.addToCartButton.setAttribute("disabled", "true");
  refs.modalLoader.classList.remove("visually-hidden");
  axios
    .post(`?add-to-cart=${variationId}`)
    .then(() => {
      return axios.get(`/nadobranich/wp-json/wc/store/cart`);
    })
    .then((response) => {
      const data = response.data.items;
      for (let i = 0; i < data.length; i += 1) {
        const variation = data[i];
        if (variation.id === parseInt(variationId)) {
          const name = variation.name;
          const image = variation.images[0].thumbnail;
          const combination = localStorage.getItem("combination");
          const qty = 1;
          const link = variation.permalink;
          closeModal();
          renderAddToCartModal(name, image, combination, qty);
          openToCartModal();
          refs.addToCartButton.removeAttribute("disabled");
          refs.modalLoader.classList.add("visually-hidden");
          setTimeout(() => {
            if (isToCartOpened) {
              closeToCartModal();
            }
          }, 3000);
        }
        if (refs.cartCounter) {
          refs.cartCounter.setAttribute("class", "cart-counter");
          refs.cartCounter.textContent = response.data.items_count;
        }
      }
    })
    .catch((error) => {
      alert(
        "Під час додавання товару до кошика відбулася неочікувана помилка. Будь ласка, зверніться до менеджера."
      );
    });
}

function renderAddToCartModal(name, image, combination, qty) {
  refs.toCartTitle.textContent = name;
  refs.toCartImg.setAttribute("src", image);
  refs.toCartImg.setAttribute("alt", `Зображення ${name}`);
  refs.toCartVar.textContent = combination;
  refs.toCartQty.textContent = `Кількість: ${qty} шт.`;
}

refs.modalTriggerList.forEach((item) => {
  item.addEventListener("click", (e) => {
    openModal();
    renderInfoFromLocal(e);
    pickColor();
    pickSize();
  });
});

refs.modalBackdrop.addEventListener("click", (e) => {
  if (e.currentTarget === e.target) {
    closeModal();
  }
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeModal();
  }
});

if (refs.closeButton) {
  refs.closeButton.addEventListener("click", closeModal);
}

if (refs.modal) {
  refs.modal.addEventListener("click", (e) => {
    e.stopPropagation();
  });
}

if (refs.addToCartButton) {
  refs.addToCartButton.addEventListener("click", fetchAddToCart);
}

if (refs.toCartClsBtn) {
  refs.toCartClsBtn.addEventListener("click", () => {
    isToCartOpened = false;
    refs.toCartWrap.classList.toggle("animate__fadeInRight");
    refs.toCartWrap.classList.toggle("animate__fadeOutRight");

    setTimeout(() => {
      refs.toCartWrap.classList.toggle("visually-hidden");
      refs.toCartWrap.classList.toggle("animate__fadeOutRight");
    }, 1000);
  });
}
