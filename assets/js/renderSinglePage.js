import { refs } from "./refs";
import "./customSelect.js";

const { isSimple, price, variations, dir, aboutSizes } = JSON.parse(
  localStorage.getItem("aboutSingleProduct")
);

if (!isSimple) {
  const variationPriceWrap = refs.wooVatiationPriceWrap;
  const variationPicker = document.querySelector(".js-variations-select");
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
  const sizeNotation = `
    <div class="item__body-size-info-wrap">
      <div class="faq__items-wrap">
        <div class="faq__item">
          <div class="faq__question">
            <h2 class="faq__question-title">Розміри</h2>
          <div class="faq__question-icon">
            <svg width="13" height="8"><use href="${dir}/assets/images/icons.svg#faq-arrow"></use></svg>
          </div>
        </div>
        <div class="faq__answer visually-hidden">
          ${aboutSizes}
        </div>
      </div>
    </div>`;
  const resetLink = document.querySelector(".reset_variations");

  if (variations.length < 2) {
    document
      .querySelector(".body-price-wrap")
      .insertAdjacentHTML(
        "afterbegin",
        `<span class='single-item-price'> ${variations[0].regularPrice} грн </span>`
      );
    refs.singleProductPrice.textContent = `${price} грн`;
    refs.singleProductPrice.style.color = "#f51010";
  } else {
    refs.singleProductPrice.textContent = `Від ${price} грн`;
  }
  variationPriceWrap.classList.add("visually-hidden");
  colorPicker.classList.add("item__body-color-picker");
  sizePicker.classList.add("item__body-size-picker");
  sizePicker.insertAdjacentHTML("afterend", sizeNotation);
  colorItems.forEach((item) => {
    item.classList.add("item__body-color-item");
    item.style.boxShadow = "unset";
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
    const selectedColor = document.querySelector(".item__body-color-wrap .selected");
    const selectedSize = document.querySelector(".item__body-size-wrap .selected");
    const activeColor = document.querySelector(".variable-item.color-variable-item.selected");
    const activeSize = document.querySelector(
      '[aria-label="Розмір"] .variable-item.button-variable-item.selected .variable-item-contents'
    );
    mutations.forEach((mutation) => {
      if (mutation.type == "childList") {
        const variationPrice = document.querySelector(".woocommerce-Price-amount.amount bdi");
        if (variationPrice) {
          const newPrice = variationPrice.textContent;
          var priceCleaning = newPrice.replace(/,/g, "").replace(/\.\d+/g, "");
          refs.singleProductPrice.textContent = priceCleaning;
        }

        if (selectedColor) {
          const currColor = selectedColor.dataset.title;
          document.querySelector(".item__body-item-color").textContent = currColor;
        }

        if (selectedSize) {
          const currSize = selectedSize.dataset.title;
          document.querySelector(".item__body-item-size").textContent = currSize;
        }

        if (activeColor) {
          activeColor.classList.add("active");
        }

        if (activeSize) {
          activeSize.style.width = "100%";
        }

        if (activeColor && selectedSize) {
          const optionsList = document.querySelector(".select-options-wrap");
          const qtyWrap = document.querySelector(".quantity");
          const size = document.querySelector(".item__body-item-size");
          const color = document.querySelector(".item__body-item-color");
          const sizeText = size.textContent.trim();
          const colorText = color.textContent.trim();
          const regex = new RegExp(`Розмір: ${sizeText}, Колір: ${colorText}`);
          const currVar = variations.find((variation) => variation.variationDesc.match(regex));
          const currVarSalePrice = currVar.salePrice;
          const currId = currVar.variationId;
          const currQty = currVar.variationQty;
          const qtyEl = document.querySelector(".old-selector");
          document.querySelector(".selected-option").textContent = "";
          optionsList.classList.add("visually-hidden");
          localStorage.setItem("singleVariationId", currId);
          localStorage.setItem("singleCombination", `${colorText} / ${sizeText}`);
          qtyWrap.setAttribute("title", `В наявності ${currQty} од.`);
          qtyEl.setAttribute("type", "number");
          qtyEl.setAttribute("max", currQty);
          qtyEl.setAttribute("value", "1");
          if (currVarSalePrice !== "") {
            refs.singleProductPriceWrap.innerHTML = `<span class="single-item-price"> ${currVar.regularPrice} грн</span><p class="item__body-price js-variation-price" style="color: rgb(245, 16, 16);">${currVarSalePrice} грн</p>`;
          } else {
            refs.singleProductPriceWrap.innerHTML = `<p class="item__body-price js-variation-price">${priceCleaning}</p>`;
          }
          if (qtyEl.value < 1) {
            qtyEl.value = currQty;
            document.querySelector(".selected-option").textContent = currQty;
          } else {
            document.querySelector(".selected-option").textContent = "1";
          }
          let selectMarkup = "";
          for (let i = 1; i <= currQty; i += 1) {
            selectMarkup += `<div class="item__body-select">${i}</div>`;
          }
          document.querySelector(".select-options-wrap").innerHTML = selectMarkup;
          document.querySelectorAll(".item__body-select").forEach((option) => {
            option.addEventListener("click", (e) => {
              const clickedOption = e.currentTarget;
              if (clickedOption.classList.contains("active")) {
                return;
              }
              const activeOption = document
                .querySelector(".select-options-wrap")
                .querySelector(".item__body-select.active");
              if (activeOption) {
                activeOption.classList.remove("active");
              }
              clickedOption.classList.add("active");
              document.querySelector(".selected-option").textContent = clickedOption.textContent;
              qtyEl.setAttribute("value", clickedOption.textContent);
            });
          });
        }
      }
    });
  });

  const config = { childList: true, subtree: true };
  observer.observe(variationPicker, config);
}
