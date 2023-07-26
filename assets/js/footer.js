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
const infoBlocks = document.querySelectorAll(".js-footer-section-info");

window.addEventListener("load", checkInnerWidth);
window.addEventListener("resize", checkInnerWidth);
window.addEventListener("orientationchange", handleOrientationChange);

let listenersAdded = false;

function checkInnerWidth() {
  if (document.documentElement.clientWidth > 1240) {
    document.querySelector(".mobile-menu__container").classList.remove("is-open");
    document.querySelector(".backdrop").classList.add("visually-hidden");
  }

  if (document.documentElement.clientWidth > 767) {
    infoBlocks.forEach((block) => {
      block.classList.remove("visually-hidden");
    });

    if (listenersAdded) {
      removeFooterListeners();
      listenersAdded = false;
    }
    return;
  } else {
    infoBlocks.forEach((block) => {
      block.classList.add("visually-hidden");
    });

    if (!listenersAdded) {
      addFooterListeners();
      listenersAdded = true;
    }
  }

  resetActiveSections();
}

function handleOrientationChange() {
  setTimeout(checkInnerWidth, 100);
}

function resetActiveSections() {
  sections.forEach((section) => {
    const parentSection = section.parentNode;
    parentSection.classList.remove("active");
    const block = section.nextElementSibling;
    if (block && block.classList.contains("js-footer-section-info")) {
      block.classList.add("visually-hidden");
    }
  });
}

function sectionHandler(e) {
  const section = e.currentTarget;
  const parentSection = section.parentNode;
  parentSection.classList.toggle("active");
  const block = section.nextElementSibling;
  if (block && block.classList.contains("js-footer-section-info")) {
    block.classList.toggle("visually-hidden");
  }
}

function addFooterListeners() {
  sections.forEach((section) => {
    section.addEventListener("click", sectionHandler);
  });
}

function removeFooterListeners() {
  sections.forEach((section) => {
    section.removeEventListener("click", sectionHandler);
  });
}
