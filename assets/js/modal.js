let isToCartOpened = false;

function openModal() {
  refs.modal.classList.remove("visually-hidden");
  refs.modalBackdrop.classList.remove("visually-hidden");
  refs.modalBackdrop.classList.add("animate__fadeIn");
  document.body.classList.add("modal-open");
}

function closeModal() {
  refs.modalBackdrop.classList.remove("animate__fadeIn");
  refs.modalBackdrop.classList.add("animate__fadeOut");
  setTimeout(() => {
    refs.modalBackdrop.classList.add("visually-hidden");
    refs.modal.classList.add("visually-hidden");
    refs.modalBackdrop.classList.remove("animate__fadeOut");
    document.body.classList.remove("modal-open");
  }, 500);
}

function closeToCartModal() {
  refs.toCardWrap.classList.toggle("animate__fadeInRight");
  refs.toCardWrap.classList.toggle("animate__fadeOutRight");

  setTimeout(() => {
    refs.toCardWrap.classList.toggle("visually-hidden");
    refs.toCardWrap.classList.toggle("animate__fadeOutRight");
  }, 1000);
}

function aboutProductToLocal(e) {
  const productId = e.target.closest(".single-category__item").attributes.productid.value;
  localStorage.setItem("productId", productId);
}

refs.modalTriggerList.forEach((item) =>
  item.addEventListener("click", (e) => {
    openModal();
    aboutProductToLocal(e);
  })
);

refs.modalBackdrop.addEventListener("click", closeModal);

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeModal();
  }
});

refs.closeButton.addEventListener("click", closeModal);

refs.modal.addEventListener("click", (e) => {
  e.stopPropagation();
});

refs.addButton.addEventListener("click", () => {
  closeModal();
  isToCartOpened = true;
  refs.toCardWrap.classList.toggle("animate__fadeInRight");
  refs.toCardWrap.classList.toggle("visually-hidden");

  setTimeout(() => {
    if (isToCartOpened) {
      closeToCartModal();
    }
  }, 5000);
});

refs.toCardClsBtn.addEventListener("click", () => {
  isToCartOpened = false;
  refs.toCardWrap.classList.toggle("animate__fadeInRight");
  refs.toCardWrap.classList.toggle("animate__fadeOutRight");

  setTimeout(() => {
    refs.toCardWrap.classList.toggle("visually-hidden");
    refs.toCardWrap.classList.toggle("animate__fadeOutRight");
  }, 1000);
});
