import { refs } from "./refs";

const { isSimple, price } = JSON.parse(localStorage.getItem("aboutSingleProduct"));

if (!isSimple) {
  const variationPriceWrap = refs.wooVatiationPriceWrap;
  const variationPicker = document.querySelector(".variations");
  const colorPicker = document.querySelector(
    ".variable-items-wrapper.color-variable-items-wrapper.wvs-style-squared"
  );
  const colorItems = document.querySelectorAll(".variable-item.color-variable-item");
  const colors = document.querySelectorAll(".variable-item-span.variable-item-span-color");
  const sizePicker = document.querySelector('[aria-label="Розмір"]');
  const sizeItems = document.querySelectorAll(
    '[aria-label="Розмір"] .variable-item.button-variable-item'
  );
  const sizes = document.querySelectorAll(
    '[aria-label="Розмір"] .variable-item.button-variable-item .variable-item-contents'
  );
  const resetLink = document.querySelector(".reset_variations");

  refs.singleProductPrice.textContent = `Від ${price} грн`;
  variationPriceWrap.classList.add("visually-hidden");
  colorPicker.classList.add("item__body-color-picker");
  sizePicker.classList.add("item__body-size-picker");
  colorItems.forEach((item) => {
    item.classList.add("item__body-color-item");
    item.style.borderRadius = "50%";
    item.style.boxShadow = "unset";
    item.style.margin = "0px";
  });
  colors.forEach((color) => {
    color.style.borderRadius = "50%";
  });
  sizeItems.forEach((item) => {
    item.style.height = "unset";
    item.style.margin = "0px";
    item.style.padding = "0px";
    item.style.borderRadius = "5px";
    item.style.boxShadow = "unset";
    item.style.outline = "unset";
  });
  sizes.forEach((size) => {
    size.classList.add("item__body-size-btn");
    size.style.display = "block";
    size.style.height = "unset";
  });

  resetLink.classList.add("visually-hidden");

  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === "childList") {
        const variationPrice = document.querySelector(".woocommerce-Price-amount.amount bdi");
        if (variationPrice) {
          const newPrice = variationPrice.textContent;
          const priceCleaning = newPrice.replace(/,/g, "").replace(/\.\d+/g, "");
          refs.singleProductPrice.textContent = priceCleaning;
        }

        const selectedColor = document.querySelector(".item__body-color-wrap .selected");
        if (selectedColor) {
          const currColor = selectedColor.dataset.title;
          document.querySelector(".item__body-item-color").textContent = currColor;
        }

        const selectedSize = document.querySelector(".item__body-size-wrap .selected");
        if (selectedSize) {
          const currSize = selectedSize.dataset.title;
          document.querySelector(".item__body-item-size").textContent = currSize;
        }

        const activeColor = document.querySelector(".variable-item.color-variable-item.selected");
        if (activeColor) {
          activeColor.classList.add("active");
        }

        const activeSize = document.querySelector(
          '[aria-label="Розмір"] .variable-item.button-variable-item.selected .variable-item-contents'
        );
        if (activeSize) {
          activeSize.style.width = "100%";
        }
      }
    });
  });

  const config = { childList: true, subtree: true };
  observer.observe(variationPicker, config);
}
