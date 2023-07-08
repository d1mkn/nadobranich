import { refs } from "./refs";

const { isSimple, price } = JSON.parse(localStorage.getItem("aboutSingleProduct"));

if (!isSimple) {
  refs.singleProductPrice.textContent = `Від ${price} грн`;

  const variationPrice = refs.wooVatiationPrice;
  variationPrice.classList.add("visually-hidden");

  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === "childList") {
        const newPrice = mutation.target.textContent;

        const priceCleaning = newPrice.replace(/,/g, "").replace(/\.\d+/g, "");
        refs.singleProductPrice.textContent = priceCleaning;
      }
    });
  });

  const config = { childList: true, subtree: true };
  observer.observe(variationPrice, config);
}
