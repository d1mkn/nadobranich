const options = document.querySelectorAll(".orderby option");

options.forEach((option) => {
  switch (option.textContent) {
    case "Сортування за замовчуванням":
      option.textContent = "За замовчуванням";
      break;
    case "Сортувати за популярністю":
      option.textContent = "За популярністю";
      break;
    case "Сортувати за оцінкою":
      option.textContent = "За рейтингом";
      break;
    case "Сортувати за останніми":
      option.textContent = "Від новіших";
      break;
    case "Сортувати за ціною: від нижчої до вищої":
      option.textContent = "Від дешевших";
      break;
    case "Сортувати за ціною: від вищої до нижчої":
      option.textContent = "Від дорожчих";
      break;
  }
});

window.addEventListener("load", rerenderFilter);
window.addEventListener("resize", rerenderFilter);

function rerenderFilter() {
  const filterSections = document.querySelectorAll(".wpc-filters-section");
  const screenWidth = window.innerWidth;
  const mediaQuery = window.matchMedia("(max-width: 767px) and (orientation: portrait)");

  if (mediaQuery.matches && screenWidth < 768) {
    const filterMobileBtn = document.querySelector(".wpc-filters-button-text");
    const standartFilter = document.querySelector(".category-page__filter-title");
    standartFilter.setAttribute("style", "display: none;");
    filterMobileBtn.outerText = "Фільтр";
    document.querySelector(".wpc-button-inner").setAttribute("style", "font-weight: 600;");
    document
      .querySelector(".wpc-button-inner")
      .closest(".wpc-open-close-filters-button")
      .classList.add("category-page__sort");
  }

  if (screenWidth >= 768) {
    const filters = document.querySelectorAll(".wpc-filter-title");
    const priceFilter = Array.from(filters).find((filter) => filter.innerText === "Ціна");
    const section = document.querySelector(".wpc-filter-content.wpc-filter-_price");
    const form = document.querySelector(".wpc-filter-range-form.wpc-form-without-slider");
    const standartFilter = document.querySelector(".category-page__filter-title");
    standartFilter.removeAttribute("style");

    form.closest(".wpc-filters-section").classList.add("wpc-closed");
    form.closest(".wpc-filters-section").classList.add("wpc-filter-has-selected");
    form.classList.add("filter-price-pick");
    priceFilter.innerHTML =
      '<button><span class="wpc-wrap-icons">Ціна</span><span class="wpc-open-icon"></span></button>';

    const chips = document.querySelectorAll(".wpc-filter-chip-name");

    chips.forEach((chip) => {
      let newText = chip.textContent;

      if (newText.includes("Min price")) {
        newText = newText.replace("Min price", "Від");
      } else if (newText.includes("Max price")) {
        newText = newText.replace("Max price", "До");
      }

      const result = newText.match(/\d+/);

      if (result) {
        const value = result[0];
        newText = newText.replace(/\d+/, `${value} грн`);
      }

      chip.textContent = newText;
    });
  }

  if (screenWidth >= 1240) {
    filterSections.forEach((section) => {
      section.addEventListener("mouseover", () => {
        section.classList.remove("wpc-closed");
        section.classList.add("wpc-opened");
      });

      section.addEventListener("mouseout", () => {
        section.classList.remove("wpc-opened");
        section.classList.add("wpc-closed");
      });
    });
  }

  filterSections.forEach((section) => {
    if (section.classList.contains("wpc-opened")) {
      section.classList.remove("wpc-opened");
    } else {
      section.classList.add("wpc-closed");
    }
  });
}
