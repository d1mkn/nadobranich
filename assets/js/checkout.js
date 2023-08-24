import axios from "axios";
import IMask from "imask";
import { refs } from "./refs";

const {
  odreringForm,
  billingFirstNameField,
  billingLastNameField,
  billingPhoneField,
  billingEmailField,
  deliveryText,
  deliveryOptions,
  orderingSummary,
  orderingDetails,
  deliveryCityPickerText,
  deliveryCityPickerBorder,
  deliveryPostOfficeText,
  deliveryPostOfficeBorder,
  deliveryAddressField,
  codMethod,
  liqpayMethod,
  radioLabel,
  orderingSubmitBtn,
} = refs;

odreringForm.addEventListener("submit", (e) => {
  let isFormValidated = true;
  let deliveryMethod = document.querySelector(".zen-ui-select-1 .zen-ui-select__option--current");
  billingFirstNameField.removeAttribute("style");
  billingLastNameField.removeAttribute("style");
  billingPhoneField.removeAttribute("style");
  billingEmailField.removeAttribute("style");
  deliveryCityPickerBorder.removeAttribute("style");
  deliveryAddressField.removeAttribute("style");

  if (!billingFirstNameField.value) {
    billingFirstNameField.scrollIntoView(false);
    billingFirstNameField.style.borderColor = "#f51010";
    isFormValidated = false;
  } else {
    const re = /^[A-ZА-ЯЄІЇҐ][a-zA-Zа-яА-Яєіїґ]{1,}$/;
    if (!re.test(String(billingFirstNameField.value))) {
      billingFirstNameField.scrollIntoView(false);
      billingFirstNameField.style.borderColor = "#f51010";
      isFormValidated = false;
    }
  }

  if (!billingLastNameField.value) {
    billingLastNameField.scrollIntoView(false);
    billingLastNameField.style.borderColor = "#f51010";
    isFormValidated = false;
  } else {
    const re = /^[A-ZА-ЯЄІЇҐ][a-zA-Zа-яА-Яєіїґ]{1,}$/;
    if (!re.test(String(billingLastNameField.value))) {
      billingLastNameField.scrollIntoView(false);
      billingLastNameField.style.borderColor = "#f51010";
      isFormValidated = false;
    }
  }

  if (!billingPhoneField.value || billingPhoneField.value.indexOf("_") !== -1) {
    billingPhoneField.scrollIntoView(false);
    billingPhoneField.style.borderColor = "#f51010";
    isFormValidated = false;
  }

  if (!billingEmailField.value) {
    billingEmailField.scrollIntoView(false);
    billingEmailField.style.borderColor = "#f51010";
    isFormValidated = false;
  } else {
    const re =
      /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!re.test(String(billingEmailField.value).toLowerCase())) {
      billingEmailField.scrollIntoView(false);
      billingEmailField.style.borderColor = "#f51010";
      isFormValidated = false;
    }
  }

  if (deliveryMethod.textContent === "Відділення Нової Пошти") {
    if (deliveryCityPickerText.textContent === "Оберіть місто") {
      deliveryCityPickerBorder.scrollIntoView(false);
      deliveryCityPickerBorder.style.borderColor = "#f51010";
      isFormValidated = false;
    }
    if (deliveryPostOfficeText.textContent === "Оберіть відділення") {
      deliveryPostOfficeBorder.scrollIntoView(false);
      deliveryPostOfficeBorder.style.borderColor = "#f51010";
      isFormValidated = false;
    }
  }

  if (deliveryMethod.textContent === "Кур'єр Нової Пошти") {
    if (deliveryCityPickerText.textContent === "Оберіть місто") {
      deliveryCityPickerBorder.scrollIntoView(false);
      deliveryCityPickerBorder.style.borderColor = "#f51010";
      isFormValidated = false;
    }
    if (deliveryAddressField.value === "") {
      deliveryAddressField.scrollIntoView(false);
      deliveryAddressField.style.borderColor = "#f51010";
      isFormValidated = false;
    }
  }

  if (!codMethod.checked && !liqpayMethod.checked) {
    isFormValidated = false;
    radioLabel.forEach((element) => {
      element.classList.add("animate__flash");
      element.classList.add("animate__repeat-2");
    });

    setTimeout(() => {
      radioLabel.forEach((element) => {
        element.classList.remove("animate__flash");
        element.classList.remove("animate__repeat-2");
      });
    }, 2000);
  }

  e.preventDefault();
  if (isFormValidated) {
    const actionLink = e.currentTarget.closest("form").action;
    orderingSubmitBtn.setAttribute("disabled", true);
    const payload = new FormData();
    payload.append("billing_first_name", document.getElementById("billing_first_name").value);
    payload.append("billing_last_name", document.getElementById("billing_last_name").value);
    payload.append("billing_company", "");
    payload.append("billing_country", "UA");
    payload.append(
      "billing_address_1",
      document.getElementById("wcus_np_billing_custom_address").value
    );
    payload.append("billing_address_2", "");
    payload.append(
      "billing_city",
      document.querySelector("[name=wcus_np_billing_city_name]").value
    );
    payload.append("billing_state", "");
    payload.append("billing_postcode", "");
    payload.append("billing_phone", document.getElementById("billing_phone").value);
    payload.append("billing_email", document.getElementById("billing_email").value);
    payload.append(
      "wcus_np_billing_custom_address_active",
      document.querySelector("[name=wcus_np_billing_custom_address_active]").value
    );
    payload.append(
      "wcus_np_billing_city",
      document.querySelector("[name=wcus_np_billing_city]").value
    );
    payload.append(
      "wcus_np_billing_city_name",
      document.querySelector("[name=wcus_np_billing_city_name]").value
    );
    payload.append(
      "wcus_np_billing_warehouse",
      document.querySelector("[name=wcus_np_billing_warehouse]").value
    );
    payload.append(
      "wcus_np_billing_warehouse_name",
      document.querySelector("[name=wcus_np_billing_warehouse_name]").value
    );
    payload.append(
      "wcus_np_billing_custom_address",
      document.querySelector("[name=wcus_np_billing_custom_address]").value
    );
    payload.append("order_comments", document.getElementById("order_comments").value);
    payload.append("shipping_method[0]", "nova_poshta_shipping:2");
    if (codMethod.checked) {
      payload.append("payment_method", "cod");
    }
    if (liqpayMethod.checked) {
      payload.append("payment_method", "liqpay-webplus");
    }
    payload.append(
      "woocommerce-process-checkout-nonce",
      document.getElementById("woocommerce-process-checkout-nonce").value
    );
    payload.append("_wp_http_referer", document.querySelector("[name=_wp_http_referer]").value);
    axios
      .post(`${actionLink}/?wc-ajax=checkout`, payload)
      .then((response) => console.log(response));
  }
});

// animations

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

document
  .querySelector(".zen-ui-select-2 .zen-ui-select__options")
  .addEventListener("mouseleave", () => {
    if (
      document.querySelector(".zen-ui-select-2 .zen-ui-select__value-text").textContent !==
      "Оберіть місто"
    ) {
      deliveryCityPickerBorder.removeAttribute("style");
    }
  });

document
  .querySelector(".zen-ui-select-3 .zen-ui-select__options")
  .addEventListener("mouseleave", () => {
    if (
      document.querySelector(".zen-ui-select-3 .zen-ui-select__value-text").textContent !==
      "Оберіть відділення"
    ) {
      deliveryPostOfficeBorder.removeAttribute("style");
    }
  });

deliveryAddressField.addEventListener("input", () => {
  deliveryAddressField.removeAttribute("style");
});

document.querySelector(".ordering__form-inputs-group").childNodes.forEach((element) => {
  element.addEventListener("click", () => {
    element.querySelector(".ordering__form-input").removeAttribute("style");
  });
});
