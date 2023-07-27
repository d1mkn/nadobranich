import { refs } from "./refs";
import "./auth";

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
  refs.backdrop.classList.toggle("visually-hidden");
  refs.menuContainer.classList.toggle("is-open");
  document.body.classList.toggle("modal-open");
});

refs.backdrop.addEventListener("click", () => {
  refs.backdrop.classList.add("visually-hidden");
  refs.menuContainer.classList.remove("is-open");
  document.body.classList.remove("modal-open");
});
