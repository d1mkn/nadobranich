const selects = document.querySelectorAll(".item__body-select-wrap");
const optionsList = document.querySelector(".select-options-wrap");
const options = document.querySelectorAll(".item__body-select");
const qtyEl = document.querySelector(".old-selector");
let selectedOption = document.querySelector(".selected-option");

selects.forEach((select) => {
  select.addEventListener("click", (e) => {
    if (optionsList.classList.contains("visually-hidden")) {
      optionsList.classList.remove("visually-hidden");
    } else {
      optionsList.classList.add("visually-hidden");
    }
  });

  options.forEach((option) => {
    option.addEventListener("click", (e) => {
      const clickedOption = e.currentTarget;
      if (clickedOption.classList.contains("active")) {
        return;
      }
      const activeOption = select.querySelector(".item__body-select.active");
      if (activeOption) {
        activeOption.classList.remove("active");
      }
      clickedOption.classList.add("active");
      selectedOption.textContent = clickedOption.textContent;
    });
  });
});

document.addEventListener("click", (e) => {
  if (!e.target.closest(".item__body-select-wrap")) {
    optionsList.classList.add("visually-hidden");
  }
});
