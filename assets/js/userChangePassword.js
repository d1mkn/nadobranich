import axios from "axios";
import { refs } from "./refs";

const {
  submitChangePass,
  userOldPasswordField,
  userNewPasswordFirstField,
  userNewPasswordSecondField,
  userOldPasswordValidation,
  userNewPasswordValidation,
} = refs;

let isFormValidated = true;

if (document.querySelector(".cabinet-navigation__wrap")) {
  userNewPasswordFirstField.addEventListener("input", arePasswordsSame);
  userNewPasswordSecondField.addEventListener("input", arePasswordsSame);

  submitChangePass.addEventListener("click", (e) => {
    e.preventDefault();
    console.log(isFormValidated);
    userOldPasswordField.removeAttribute("style");
    userNewPasswordFirstField.removeAttribute("style");
    userNewPasswordSecondField.removeAttribute("style");
    userOldPasswordValidation.classList.add("visually-hidden");

    if (!userOldPasswordField.value) {
      userOldPasswordField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (!userNewPasswordFirstField.value) {
      userNewPasswordFirstField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (!userNewPasswordSecondField.value) {
      userNewPasswordSecondField.style.borderColor = "#f51010";
      isFormValidated = false;
    }

    if (isFormValidated) {
      submitChangePass.setAttribute("disabled", true);
      const actionLink = e.currentTarget.closest("form").action;
      const payload = new FormData();
      payload.append("password_current", document.getElementById("password_current").value);
      payload.append("password_1", document.getElementById("password_1").value);
      payload.append("password_2", document.getElementById("password_2").value);
      axios
        .post(actionLink, payload)
        .then((response) => {
          if (response.data.indexOf("pass-error") === -1) {
            submitChangePass.removeAttribute("disabled");
            userNewPasswordSecondField.style.margin = "0px";
            userNewPasswordValidation.classList.remove("visually-hidden");
            userNewPasswordValidation.style.color = "green";
            userNewPasswordValidation.textContent = "Пароль змінено успішно!";
            location.reload();
          } else {
            userOldPasswordField.style.borderColor = "#f51010";
            userOldPasswordField.style.margin = "0px";
            userOldPasswordValidation.classList.remove("visually-hidden");
            submitChangePass.removeAttribute("disabled");
          }
        })
        .catch((error) => {
          if (error) {
            console.log("Error:", error.message);
          }
        });
    }
  });
}

function arePasswordsSame() {
  const firstNewPassword = userNewPasswordFirstField.value;
  const secondNewPassword = userNewPasswordSecondField.value;

  if (firstNewPassword !== secondNewPassword) {
    userNewPasswordFirstField.style.borderColor = "#f51010";
    userNewPasswordSecondField.style.borderColor = "#f51010";
    isFormValidated = false;
    userNewPasswordValidation.classList.remove("visually-hidden");
    userNewPasswordValidation.style.color = "#f51010";
    userNewPasswordValidation.textContent = "Паролі мають бути однаковими";
    userNewPasswordSecondField.style.margin = "0px";
  } else {
    userNewPasswordFirstField.removeAttribute("style");
    userNewPasswordSecondField.removeAttribute("style");
    userNewPasswordSecondField.removeAttribute("style");
    userNewPasswordValidation.classList.add("visually-hidden");
    isFormValidated = true;
  }
}
