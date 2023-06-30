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
  if (document.documentElement.clientWidth > 767) {
    document.querySelector(".footer__catalog-list").classList.remove("visually-hidden");
    document.querySelector(".footer__info-list").classList.remove("visually-hidden");
    document.querySelector(".footer__contacts-wrap").classList.remove("visually-hidden");

    if (listenersAdded) {
      removeFooterListeners(infoBlocks);
      listenersAdded = false;
    }
  } else {
    document.querySelector(".footer__catalog-list").classList.add("visually-hidden");
    document.querySelector(".footer__info-list").classList.add("visually-hidden");
    document.querySelector(".footer__contacts-wrap").classList.add("visually-hidden");

    if (!listenersAdded) {
      addFooterListeners(infoBlocks);
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
    if (section.classList.contains("active")) {
      section.classList.remove("active");
      const block = section.querySelector(".js-footer-section-info");
      if (block) {
        block.classList.add("visually-hidden");
        section.removeAttribute("style");
      }
    }
  });
}

function sectionHandler(e) {
  const section = e.currentTarget;
  const block = section.querySelector(".js-footer-section-info");

  section.classList.toggle("active");

  if (section.classList.contains("active")) {
    section.style.pointerEvents = "none";
    if (block) {
      block.classList.toggle("visually-hidden");
    }
    setTimeout(() => {
      section.style.pointerEvents = "auto";
    }, 500);
  } else {
    section.style.pointerEvents = "none";
    if (block) {
      setTimeout(() => {
        section.removeAttribute("style");
        block.classList.toggle("visually-hidden");
      }, 500);
    }
  }
}

function addFooterListeners(blocks) {
  blocks.forEach((block) => {
    const section = block.closest(".js-footer-section");
    if (section) {
      section.addEventListener("click", sectionHandler);
      block.dataset.sectionHandlerAdded = true;
    }
  });
}

function removeFooterListeners(blocks) {
  blocks.forEach((block) => {
    const section = block.closest(".js-footer-section");
    if (section && block.dataset.sectionHandlerAdded === "true") {
      section.removeEventListener("click", sectionHandler);
      delete block.dataset.sectionHandlerAdded;
    }
  });
}
