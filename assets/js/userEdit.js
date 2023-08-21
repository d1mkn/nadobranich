import axios from "axios";
import { refs } from "./refs";

const { userNameField, userLastNameField, userPhoneField, userEmailField } = refs;

if (document.querySelector(".cabinet-navigation__wrap")) {
  refs.submitInfoEdit.addEventListener("click", (e) => {
    e.preventDefault();
    let isFormValidated = true;

    userNameField.style.borderColor = "#7d7d7d";
    userLastNameField.style.borderColor = "#7d7d7d";
    userPhoneField.style.borderColor = "#7d7d7d";
    userEmailField.style.borderColor = "#7d7d7d";

    if (!userNameField.value) {
      userNameField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (!userLastNameField.value) {
      userLastNameField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (!userPhoneField.value) {
      userPhoneField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (!userEmailField.value) {
      userEmailField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (isFormValidated) {
      const actionLink = e.currentTarget.closest("form").action;
      refs.submitInfoEdit.setAttribute("disabled", true);
      const payload = new FormData();
      payload.append("account_first_name", document.getElementById("account_first_name").value);
      payload.append("account_last_name", document.getElementById("account_last_name").value);
      payload.append("account_email", document.getElementById("account_email").value);
      payload.append("account_phone", document.getElementById("account_phone").value);
      axios.post(actionLink, payload).then((response) => location.reload());
    }
  });
}
