import { refs } from "./refs";

const formShowBtn = refs.formShowBtn;
const form = refs.reviewForm;

formShowBtn.addEventListener("click", () => {
  if (form.classList.contains("visually-hidden")) {
    formShowBtn.setAttribute("disabled", "true");
    form.classList.toggle("visually-hidden");
    form.classList.toggle("h0");
    form.classList.toggle("h490");
    form.classList.toggle("o0");

    setTimeout(() => {
      formShowBtn.removeAttribute("disabled");
    }, 500);
  } else {
    formShowBtn.setAttribute("disabled", "true");
    form.classList.toggle("h0");
    form.classList.toggle("h490");
    form.classList.toggle("o0");

    setTimeout(() => {
      form.classList.toggle("visually-hidden");

      setTimeout(() => {
        formShowBtn.removeAttribute("disabled");
      }, 250);
    }, 500);
  }
});
