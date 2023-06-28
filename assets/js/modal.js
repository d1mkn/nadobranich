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

let currProduct = null;
let singleSize = null;

function renderInfoFromLocal(e) {
  const productId = e.target.closest(".single-category__item").attributes.productid.value;
  const aboutProducts = JSON.parse(localStorage.getItem("aboutProducts"));
  currProduct = aboutProducts.find((product) => product.id == productId);
  console.log(currProduct);

  // main img
  refs.mainImgWrap.innerHTML = `<img class="modal__images-main" src="${currProduct.productImages.mainImg}" alt="modal main image">`;

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
  function colorListMarkup() {
    currProduct.attributes.forEach((attribute) => {
      if (attribute.hasOwnProperty("pa_color")) {
        colorList = attribute.pa_color;
      }
      if (attribute.hasOwnProperty("Розмір")) {
        singleSize = attribute.Розмір;
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
    refs.sizeList.innerHTML = `<button class="modal__body-size-btn active" data-size="${singleSize[0]}" type="button">
                    ${singleSize[0]}</button>`;
    refs.productSize.textContent = singleSize[0];
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

  // Создание объекта для хранения соответствия цвета и размера с их ценой
  const variationPrices = {};

  selectedVariations.forEach((variation) => {
    const variationDesc = variation.variationDesc;
    const sizeStartIndex = variationDesc.indexOf("Розмір: ") + 8; // Позиция после "Розмір: "
    const sizeEndIndex = variationDesc.indexOf(",", sizeStartIndex); // Позиция перед запятой

    if (sizeStartIndex !== -1 && sizeEndIndex !== -1) {
      const size = variationDesc.substring(sizeStartIndex, sizeEndIndex).trim();
      const price = variation.variationPrice;
      variationPrices[size] = price;
    }
  });

  let markup = "";

  for (const size in variationPrices) {
    if (variationPrices.hasOwnProperty(size)) {
      const price = variationPrices[size];
      prevActiveSize = prevActiveSize || size; // Перший розмір за замовчуванням
      prevActivePrice = prevActivePrice || price; // Перший розмір за замовчуванням
      markup += `<button class="modal__body-size-btn${
        size === prevActiveSize ? " active" : ""
      }" data-size="${size}" data-price="${price}" type="button">
                    ${size}</button>`;
    }
  }
  refs.productPrice.textContent = prevActivePrice + " грн";
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

        // Оновлення інформації про ціну
        refs.productPrice.textContent = targetSize.dataset.price + " грн";
      }
    });
  });
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
