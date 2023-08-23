import IMask from "imask";
import { refs } from "./refs";

const { billingPhoneField } = refs;
// animations

const checkbox1 = refs.orderingCheckbox1;
const checkbox2 = refs.orderingCheckbox2;
const orderingMethod1 = document.querySelector(".js-ordering-data1");
const orderingMethod2 = document.querySelector(".js-ordering-data2");
const orderingSummary = refs.orderingSummary;
const orderingDetails = refs.orderingDetails;

const phoneMaskOptions = {
  mask: "+38 (000) 000-00-00",
  lazy: false,
};

const phoneMask = new IMask(billingPhoneField, phoneMaskOptions);

checkbox1.addEventListener("click", () => {
  orderingMethod1.classList.toggle("visually-hidden");
});

checkbox2.addEventListener("click", () => {
  orderingMethod2.classList.toggle("visually-hidden");
});

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
