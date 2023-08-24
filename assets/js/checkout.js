import axios from "axios";
import IMask from "imask";
import { refs } from "./refs";

const { billingPhoneField, orderingSubmitBtn, deliveryText, deliveryOptions } = refs;

// animations
const orderingSummary = refs.orderingSummary;
const orderingDetails = refs.orderingDetails;

const phoneMaskOptions = {
  mask: "+38 (000) 000-00-00",
  lazy: false,
};

const phoneMask = new IMask(billingPhoneField, phoneMaskOptions);

orderingSummary.addEventListener("click", () => {
  orderingSummary.classList.toggle("active");
  orderingDetails.classList.toggle("active");

  if (orderingSummary.classList.contains("active")) {
    orderingSummary.style.display = "block";
    orderingSummary.style.maxHeight = `${orderingDetails.clientHeight} + ${orderingSummary.scrollHeight} + px`;
    orderingSummary.style.pointerEvents = "none";
    setTimeout(() => {
      orderingSummary.style.pointerEvents = "auto";
    }, 1000);
  } else {
    orderingSummary.style.pointerEvents = "none";
    setTimeout(() => {
      orderingSummary.style.display = "none";
      orderingSummary.style.maxHeight = "0";
      orderingSummary.removeAttribute("style");
    }, 1000);
  }
});

// logic

deliveryOptions.forEach((option) => {
  if (option.textContent == "\n          на відділення\n        ") {
    option.innerHTML = "Відділення Нової Пошти";
  }
  if (option.textContent == "\n          до дверей\n        ") {
    option.textContent = "Кур'єр Нової Пошти";
  }
});
deliveryText.textContent = document.querySelector(".zen-ui-select__option--current").textContent;
document
  .querySelectorAll(".zen-ui-select__options .zen-ui-select__option")[0]
  .addEventListener("click", () => {
    deliveryText.textContent = document.querySelector(
      ".zen-ui-select__option--current"
    ).textContent;
  });
document
  .querySelectorAll(".zen-ui-select__options .zen-ui-select__option")[1]
  .addEventListener("click", () => {
    deliveryText.textContent = document.querySelector(
      ".zen-ui-select__option--current"
    ).textContent;
  });

orderingSubmitBtn.addEventListener("click", (e) => {
  e.preventDefault();
  const actionLink = e.currentTarget.closest("form").action;
  // refs.submitInfoEdit.setAttribute("disabled", true);
  const payload = new FormData();
  // payload.append("account_first_name", document.getElementById("account_first_name").value);
  // payload.append("account_last_name", document.getElementById("account_last_name").value);
  // payload.append("account_email", document.getElementById("account_email").value);
  // payload.append("account_phone", document.getElementById("account_phone").value);
  axios.post(`${actionLink}/?wc-ajax=checkout`, payload).then((response) => console.log(response));
});
