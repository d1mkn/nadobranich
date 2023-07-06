import { refs } from "./refs";
import axios from "axios";
import SimpleLightbox from "simplelightbox";

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

function openToCartModal() {
  isToCartOpened = true;
  refs.toCartWrap.classList.toggle("animate__fadeInRight");
  refs.toCartWrap.classList.toggle("visually-hidden");
}

function closeToCartModal() {
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
  const productId = e.target.closest(".single-category__item").attributes.productid.value;
  localStorage.setItem("productId", productId);
  const aboutProducts = JSON.parse(localStorage.getItem("aboutProducts"));
  currProduct = aboutProducts.find((product) => product.id == productId);
  console.log(currProduct);

  // main img
  const mainImg = currProduct.productImages.mainImg;
  refs.mainImgWrap.innerHTML = `<img class="modal__images-main js-modal-main-img" src="${mainImg.url}" alt="${mainImg.alt}">`;

  // image gallery
  refs.modalGallery.innerHTML = galleryMarkup();

  function galleryMarkup() {
    let markup = `<li class="modal__images-item"><a href="${mainImg.url}"><img src="${mainImg.url}" alt="${mainImg.alt}"></a></li>`;
    const imagesList = currProduct.productImages.gallery;

    imagesList.forEach((image) => {
      markup += `<li class="modal__images-item"><a href="${image.url}"><img src="${image.url}" alt="${image.alt}"></a></li>`;
    });
    return markup;
  }
  initGallery();

  // title
  refs.productTitle.textContent = currProduct.productTitle;

  // description
  refs.productDesc.textContent = currProduct.productDesc;

  // rating
  refs.ratingStars.setAttribute(
    "style",
    `width: ${(parseInt(currProduct.rating.average) * 100) / 5}%;`
  );
  refs.ratingLink.textContent = currProduct.rating.reviewCount;
  refs.ratingLink.setAttribute("href", `${currProduct.productLink}#reviews`);

  // price color size
  let colorList = [];
  let sizeList = [];
  function colorListMarkup() {
    currProduct.attributes.forEach((attribute) => {
      if (attribute.hasOwnProperty("pa_color")) {
        colorList = attribute.pa_color;
      }
      if (attribute.hasOwnProperty("pa_size")) {
        singleSize = attribute.pa_size[0].name;
        sizeList = attribute.pa_size;
      }
    });

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
  refs.productColor.textContent = prevActiveColor;

  // Nav buttons
  refs.toItemBtn.setAttribute("href", currProduct.productLink);
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

  // Якщо у товара немає варіацій (акційний)
  if (currProduct.variations.length === 0) {
    refs.productPrice.innerHTML = `<span class="item-price">
                          ${currProduct.beforeSalePrice} грн
                        </span><span class="item-new-price">
                          ${currProduct.price} грн
                        </span>`;
    refs.sizeList.innerHTML = `<button class="modal__body-size-btn active" data-size="${singleSize}" type="button">
                    ${singleSize}</button>`;
    refs.productSize.textContent = singleSize;
    return;
  }
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
      const price = variation.variationPrice;
      const variationId = variation.variationId;
      variationPrices[size] = { price, variationId };
    }
  });

  let markup = "";

  for (const size in variationPrices) {
    if (variationPrices.hasOwnProperty(size)) {
      const { price, variationId } = variationPrices[size];
      prevActiveSize = prevActiveSize || size; // Перший розмір за замовчуванням
      prevActivePrice = prevActivePrice || price; // Ціна за замовчуванням
      prevActiveId = variationId; // Варіація за замовчуванням
      markup += `<button class="modal__body-size-btn${
        size === prevActiveSize ? " active" : ""
      }" data-size="${size}" data-price="${price}" data-variation-id="${variationId}" type="button">
                    ${size}</button>`;
    }
  }
  refs.productPrice.textContent = prevActivePrice + " грн";
  refs.sizeList.innerHTML = markup;
  refs.productSize.textContent = prevActiveSize;
  pickSize();
  localStorage.setItem("variationId", prevActiveId);
  localStorage.setItem("combination", `${prevActiveColor} / ${prevActiveSize}`);
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
        refs.productPrice.textContent = targetSize.dataset.price + " грн";

        // ID варіації для додавання у кошик
        prevActiveId = targetSize.dataset.variationId;
        localStorage.setItem("variationId", prevActiveId);

        localStorage.setItem("combination", `${prevActiveColor} / ${prevActiveSize}`);
      }
    });
  });
}

function initGallery() {
  const mainImg = document.querySelector(".js-modal-main-img");
  const gallery = new SimpleLightbox(".js-modal-gallery a", {
    captionsData: "alt",
    captionDelay: 250,
    scrollZoom: false,
  });

  mainImg.addEventListener("click", (e) => {
    e.preventDefault;
    gallery.open();
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

refs.addToCartButton.addEventListener("click", fetchAddToCart);

refs.toCartClsBtn.addEventListener("click", () => {
  isToCartOpened = false;
  refs.toCartWrap.classList.toggle("animate__fadeInRight");
  refs.toCartWrap.classList.toggle("animate__fadeOutRight");

  setTimeout(() => {
    refs.toCartWrap.classList.toggle("visually-hidden");
    refs.toCartWrap.classList.toggle("animate__fadeOutRight");
  }, 1000);
});
