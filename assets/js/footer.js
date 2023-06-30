const footerRefs = {
  // footer
  footerSections: document.querySelectorAll(".js-footer-section"),
  catalogTitle: document.querySelector(".footer__catalog"),
  catalogList: document.querySelector(".footer__catalog-list"),
  infoTitle: document.querySelector(".footer__info"),
  infoList: document.querySelector(".footer__info-list"),
  contactsTitle: document.querySelector(".footer__contacts"),
  contactsList: document.querySelector(".footer__contacts-wrap"),
};

const sections = footerRefs.footerSections;

window.addEventListener("resize", checkInnerWidth);

function checkInnerWidth() {
  if (document.documentElement.clientWidth < 767) {
    document.querySelector(".footer__catalog-list").classList.add("visually-hidden");
    document.querySelector(".footer__info-list").classList.add("visually-hidden");
    document.querySelector(".footer__contacts-wrap").classList.add("visually-hidden");
    return;
  } else {
    document.querySelector(".footer__catalog-list").classList.remove("visually-hidden");
    document.querySelector(".footer__info-list").classList.remove("visually-hidden");
    document.querySelector(".footer__contacts-wrap").classList.remove("visually-hidden");
  }
}

document.querySelectorAll(".js-footer-section").forEach((section) => {
  const info = section.querySelector(".js-footer-section-info");
  section.addEventListener("click", () => {
    section.classList.toggle("active");

    if (section.classList.contains("active")) {
      section.style.pointerEvents = "none";
      info.classList.toggle("visually-hidden");
      setTimeout(() => {
        section.style.pointerEvents = "auto";
      }, 500);
    } else {
      section.style.pointerEvents = "none";
      setTimeout(() => {
        section.removeAttribute("style");
        info.classList.toggle("visually-hidden");
      }, 500);
    }
  });
});
