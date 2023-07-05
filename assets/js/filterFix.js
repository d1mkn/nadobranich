const filters = document.querySelectorAll(".wpc-filter-title");
const priceFilter = Array.from(filters).find((filter) => filter.innerText === "Ціна");
priceFilter.innerHTML =
  '<button><span class="wpc-wrap-icons">Ціна</span><span class="wpc-open-icon"></span></button>';
