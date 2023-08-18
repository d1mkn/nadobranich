import axios from "axios";
import { refs } from "./refs";

if (document.querySelector(".cabinet-navigation__wrap")) {
  const buttons = document.querySelectorAll(".js-cabinet-nav-item");
  const sections = document.querySelectorAll(".cabinet-section");

  buttons[0].classList.add("active");
  sections[0].classList.add("cabinet-section-active");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const target = button.getAttribute("data-target");

      sections.forEach((section) => {
        section.classList.remove("cabinet-section-active");
      });

      const selectedSection = document.getElementById(target);
      selectedSection.classList.add("cabinet-section-active");

      buttons.forEach((btn) => {
        btn.classList.remove("active");
      });

      button.classList.add("active");
    });
  });

  refs.userLogout.addEventListener("click", (e) => {
    e.preventDefault();
    e.currentTarget.style.cursor = "progress";
    document.querySelector("body").style.cursor = "progress";
    axios.post(refs.userLogout.attributes.href.value).then((data) => location.reload());
  });
}
