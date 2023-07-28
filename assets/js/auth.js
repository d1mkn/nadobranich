import { refs } from "./refs";

refs.openLogin.forEach((loginLink) => {
  loginLink.addEventListener("click", (e) => {
    e.preventDefault();
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("visually-hidden");
    refs.modalBackdrop.classList.add("animate__fadeIn");
    document.body.classList.add("modal-open");
    refs.authContainer.classList.toggle("visually-hidden");
  });
});

refs.authCloseBtn.addEventListener("click", () => {
  refs.modalBackdrop.classList.remove("animate__fadeIn");
  refs.modalBackdrop.classList.add("animate__fadeOut");
  refs.authContainer.classList.add("visually-hidden");
  setTimeout(() => {
    refs.modalBackdrop.classList.add("visually-hidden");
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("animate__fadeOut");
    document.body.classList.remove("modal-open");
  }, 500);
})