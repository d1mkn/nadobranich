import { refs } from "./refs";

function headerSearchForm() {
  const searchBtn = refs.searchBtn;
  const searchForm = refs.searchForm;

  searchBtn.addEventListener("click", () => {
    if (searchForm.classList.contains("visually-hidden")) {
      searchForm.classList.toggle("animate__fadeIn");
      searchForm.classList.toggle("visually-hidden");
    } else {
      searchForm.classList.toggle("animate__fadeIn");
      searchForm.classList.toggle("animate__fadeOut");
      setTimeout(() => {
        searchForm.classList.toggle("visually-hidden");
        searchForm.classList.toggle("animate__fadeOut");
      }, 500);
    }
  });
}
headerSearchForm();

refs.menuBtn.addEventListener("click", () => {
  refs.backdrop.classList.remove("visually-hidden");
  refs.menuContainer.classList.add("is-open");
  document.body.classList.add("modal-open");
});

refs.backdrop.addEventListener("click", () => {
  refs.backdrop.classList.add("visually-hidden");
  refs.menuContainer.classList.remove("is-open");
  document.body.classList.remove("modal-open");
});

refs.closeBtn.addEventListener("click", () => {
  refs.backdrop.classList.add("visually-hidden");
  refs.menuContainer.classList.remove("is-open");
  document.body.classList.remove("modal-open");
});