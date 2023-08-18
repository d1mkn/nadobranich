import axios from "axios";
import { refs } from "./refs";

refs.openLogin.forEach((loginLink) => {
  loginLink.addEventListener("click", (e) => {
    e.preventDefault();
    if (!refs.registerForm.classList.contains("visually-hidden")) {
      refs.registerForm.classList.add("visually-hidden");
      refs.loginForm.classList.remove("visually-hidden");
    } else {
      refs.modal.classList.add("visually-hidden");
      refs.modalBackdrop.classList.remove("visually-hidden");
      refs.modalBackdrop.classList.add("animate__fadeIn");
      document.body.classList.add("modal-open");
      refs.authContainer.classList.toggle("visually-hidden");
      refs.loginForm.classList.remove("visually-hidden");
    }
  });
});

refs.openRegister.forEach((registerLink) => {
  registerLink.addEventListener("click", (e) => {
    e.preventDefault();
    if (!refs.loginForm.classList.contains("visually-hidden")) {
      refs.loginForm.classList.add("visually-hidden");
      refs.registerForm.classList.remove("visually-hidden");
    } else {
      refs.modal.classList.add("visually-hidden");
      refs.modalBackdrop.classList.remove("visually-hidden");
      refs.modalBackdrop.classList.add("animate__fadeIn");
      document.body.classList.add("modal-open");
      refs.authContainer.classList.toggle("visually-hidden");
      refs.registerForm.classList.remove("visually-hidden");
    }
  });
});

refs.authCloseBtn.addEventListener("click", () => {
  refs.modalBackdrop.classList.remove("animate__fadeIn");
  refs.modalBackdrop.classList.add("animate__fadeOut");
  refs.authContainer.classList.add("visually-hidden");
  refs.loginForm.classList.add("visually-hidden");
  refs.registerForm.classList.add("visually-hidden");
  setTimeout(() => {
    refs.modalBackdrop.classList.add("visually-hidden");
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("animate__fadeOut");
    document.body.classList.remove("modal-open");
  }, 500);
});

refs.authSubmits.forEach((submit) => {
  submit.addEventListener("click", (e) => {
    e.preventDefault();
    let isFormValidated = true;
    const actionLink = e.currentTarget.closest("form").action;

    if (!refs.loginForm.classList.contains("visually-hidden")) {
      refs.emailLoginValidation.classList.add("visually-hidden");
      refs.emailLoginField.style.borderColor = "#7d7d7d";
      refs.passwordLoginValidation.classList.add("visually-hidden");
      refs.passwordLoginField.style.borderColor = "#7d7d7d";

      if (!refs.emailLoginField.value) {
        refs.emailLoginValidation.classList.remove("visually-hidden");
        refs.emailLoginField.style.borderColor = "#f51010";
        isFormValidated = false;
      }

      if (!refs.passwordLoginField.value) {
        refs.passwordLoginValidation.classList.remove("visually-hidden");
        refs.passwordLoginField.style.borderColor = "#f51010";
        isFormValidated = false;
      }

      if (isFormValidated == true) {
        submit.setAttribute("disabled", "true");
        const payload = new FormData();
        payload.append("log", refs.emailLoginField.value);
        payload.append("pwd", refs.passwordLoginField.value);
        axios
          .post(actionLink, payload)
          .then((response) => {
            submit.removeAttribute("disabled");
            if (response.data.length > 1) {
              refs.loginRequestAnswer.classList.remove("visually-hidden");
            } else {
              refs.loginRequestAnswer.classList.remove("visually-hidden");
              refs.loginRequestAnswer.textContent = "Ви успішно авторизувалися!";
              refs.loginRequestAnswer.style.color = "green";
              location.reload();
            }
          })
          .catch((error) => {
            if (error) {
              console.log("Error:", error.message);
              submit.removeAttribute("disabled");
              document.querySelector(".invalid-input-message.req-error").textContent =
                "Під час запиту відбулася помилка. Будь ласка, спробуйте ще раз пізніше";
            }
          });
      }
    } else {
      refs.registerUserName.style.borderColor = "#7d7d7d";
      refs.registerUserNameValidation.classList.add("visually-hidden");
      refs.registerUserLastName.style.borderColor = "#7d7d7d";
      refs.registerUserLastNameValidation.classList.add("visually-hidden");
      refs.registerUserPassword.style.borderColor = "#7d7d7d";
      refs.registerUserPasswordValidation.classList.add("visually-hidden");

      if (!refs.registerUserName.value) {
        refs.registerUserName.style.borderColor = "#f51010";
        refs.registerUserNameValidation.classList.remove("visually-hidden");
        isFormValidated = false;
      }

      if (!refs.registerUserLastName.value) {
        refs.registerUserLastName.style.borderColor = "#f51010";
        refs.registerUserLastNameValidation.classList.remove("visually-hidden");
        isFormValidated = false;
      }

      if (!refs.registerUserEmail.value) {
        refs.registerUserEmail.style.borderColor = "#f51010";
        refs.registerUserEmailValidation.classList.remove("visually-hidden");
        isFormValidated = false;
      } else {
        const re =
          /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if (!re.test(String(refs.registerUserEmail.value).toLowerCase())) {
          refs.registerUserEmailValidation.textContent = "Вкажіть існуючий e-mail";
          isFormValidated = false;
        } else {
          refs.registerUserEmail.style.borderColor = "#7d7d7d";
          refs.registerUserEmailValidation.classList.add("visually-hidden");
        }
      }

      if (refs.registerUserPassword.value.length < 6) {
        refs.registerUserPassword.style.borderColor = "#f51010";
        refs.registerUserPasswordValidation.textContent =
          "Мінімальна довжина пароля складає 6 символів";
        refs.registerUserPasswordValidation.classList.remove("visually-hidden");
        isFormValidated = false;
      }

      if (isFormValidated) {
        submit.setAttribute("disabled", "true");
        const payload = new FormData();
        payload.append("billing_first_name", refs.registerUserName.value);
        payload.append("billing_last_name", refs.registerUserLastName.value);
        payload.append("user_email", refs.registerUserEmail.value);
        payload.append("user_login", refs.registerUserEmail.value.split("@")[0]);
        payload.append("user_password", refs.registerUserPassword.value);

        axios
          .post(actionLink, payload)
          .then((response) => {
            submit.removeAttribute("disabled");
            if (response.data.indexOf('<div id="login_error">') != "-1") {
              document.querySelector(".reg-req-error").classList.remove("visually-hidden");
              document.querySelector(".reg-req-error").textContent =
                "Користувач з такою електронною поштою вже існує. Вкажіть іншу пошту або увійдіть використовуючи пароль";
            } else {
              document.querySelector(".reg-req-error").classList.remove("visually-hidden");
              document.querySelector(".reg-req-error").textContent = "Дякуємо за реєстрацію!";
              document.querySelector(".reg-req-error").style.color = "green";
              location.reload();
            }
          })
          .catch((error) => {
            if (error) {
              console.log("Error:", error.message);
              submit.removeAttribute("disabled");
              document.querySelector(".reg-req-error").textContent =
                "Під час запиту відбулася помилка. Будь ласка, спробуйте ще раз пізніше";
            }
          });
      }
    }
  });
});
