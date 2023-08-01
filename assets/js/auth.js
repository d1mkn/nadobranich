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

refs.authSubmit.addEventListener("click", (e) => {
  e.preventDefault();
  refs.emailLoginValidation.classList.add("visually-hidden");
  refs.passwordLoginValidation.classList.add("visually-hidden");

  let isFormValidated = true;

  if (!refs.emailLoginField.value) {
    refs.emailLoginValidation.classList.remove("visually-hidden");
    isFormValidated = false;
  }

  if (!refs.passwordLoginField.value) {
    refs.passwordLoginValidation.classList.remove("visually-hidden");
    isFormValidated = false;
  }

  if (isFormValidated == true) {
    document.querySelector(".auth-modal__form-submit").setAttribute("disabled", "true");
    const payload = new FormData();
    payload.append("log", refs.emailLoginField.value);
    payload.append("pwd", refs.passwordLoginField.value);
    axios.post("http://localhost/nadobranich/wp-login.php", payload).then((response) => {
      document.querySelector(".auth-modal__form-submit").removeAttribute("disabled");
      if (response.data.length > 1) {
        document
          .querySelector(".invalid-input-message.req-error")
          .classList.remove("visually-hidden");
      } else {
        document
          .querySelector(".invalid-input-message.req-error")
          .classList.remove("visually-hidden");
        document.querySelector(".invalid-input-message.req-error").textContent =
          "Ви успішно авторизувалися!";
        document.querySelector(".invalid-input-message.req-error").style.color = "green";
        location.reload();
      }
    });
  }
});

refs.registerUserEmail.addEventListener("change", () => {
  console.log(refs.registerUserEmail.value.split("@")[0]);
  refs.registerUserLogin.setAttribute("value", `${refs.registerUserEmail.value.split("@")[0]}`);
});
