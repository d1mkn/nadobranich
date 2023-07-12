import axios from "axios";
import { refs } from "./refs";
import { isToCartOpened, openToCartModal, closeToCartModal } from "./modal";

const variationForm = document.querySelector(".variations_form");
const addToCartButton = document.querySelector(".item__body-to-cart-btn.single_add_to_cart_button");
const btnLoader = document.querySelector(
  ".item__body-to-cart-btn.single_add_to_cart_button .loader"
);

variationForm.addEventListener("submit", (e) => {
  e.preventDefault();
  singlefetchAddToCart();
});

function singlefetchAddToCart() {
  const singleVariationId = localStorage.getItem("singleVariationId");
  const qty = document.querySelector(".item__body-select").value;
  document
    .querySelector(".item__body-to-cart-btn.single_add_to_cart_button")
    .setAttribute("disabled", "true");
  btnLoader.classList.remove("visually-hidden");
  axios
    .post(`?add-to-cart=${singleVariationId}&quantity=${qty}`)
    .then(() => {
      return axios.get(`/nadobranich/wp-json/wc/store/cart`);
    })
    .then((response) => {
      const data = response.data.items;
      for (let i = 0; i < data.length; i += 1) {
        const variation = data[i];
        if (variation.id === parseInt(singleVariationId)) {
          const name = variation.name;
          const image = variation.images[0].thumbnail;
          const combination = localStorage.getItem("singleCombination");
          renderAddToCartModal(name, image, combination, qty);
          openToCartModal();
          addToCartButton.removeAttribute("disabled");
          btnLoader.classList.add("visually-hidden");
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
