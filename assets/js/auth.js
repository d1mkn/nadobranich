import { refs } from "./refs";

refs.userMenu.addEventListener("click", (e) => {
  e.preventDefault();
  const formLink = e.target;
  if (formLink.dataset.type === "login") {
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("visually-hidden");
    refs.modalBackdrop.classList.add("animate__fadeIn");
    document.body.classList.add("modal-open");
    refs.authContainer.classList.toggle("visually-hidden");
  }
});
