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

const commentForm = document.getElementById("commentform");
commentForm.addEventListener("submit", (e) => {
  const rating = document.querySelector(".stars.selected");
  let isFormValidated = true;

  if (rating == null) {
    isFormValidated = false;
    if (document.querySelector(".error").textContent === "Оцініть товар") {
      e.preventDefault();
      return;
    }
    document
      .querySelector(".reviews__form-raiting")
      .insertAdjacentHTML("beforeend", '<span class="error">Оцініть товар</span>');
  } else {
    document.querySelector(".reviews__form-raiting .error").classList.add("visually-hidden");
  }

  const authorField = document.querySelector("[name=author]");

  if (!authorField.value) {
    authorField.style.borderColor = "#f51010";
    document
      .querySelector(".validation-wrap [name=author] + .error")
      .classList.remove("visually-hidden");
    isFormValidated = false;
  } else {
    authorField.style.borderColor = "#7d7d7d";
    document
      .querySelector(".validation-wrap [name=author] + .error")
      .classList.add("visually-hidden");
  }

  const emailField = document.querySelector("[name=email]");

  if (!emailField.value) {
    emailField.style.borderColor = "#f51010";
    document
      .querySelector(".validation-wrap [name=email] + .error")
      .classList.remove("visually-hidden");
    isFormValidated = false;
  } else {
    const re =
      /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!re.test(String(emailField.value).toLowerCase())) {
      document.querySelector(".validation-wrap [name=email] + .error").textContent =
        "Ведіть існуючий e-mail";
      isFormValidated = false;
    } else {
      emailField.style.borderColor = "#7d7d7d";
      document
        .querySelector(".validation-wrap [name=email] + .error")
        .classList.add("visually-hidden");
    }
  }

  const titleField = document.querySelector("[name=title]");

  if (!titleField.value) {
    titleField.style.borderColor = "#f51010";
    document
      .querySelector(".validation-wrap [name=title] + .error")
      .classList.remove("visually-hidden");
    isFormValidated = false;
  } else {
    titleField.style.borderColor = "#7d7d7d";
    document
      .querySelector(".validation-wrap [name=title] + .error")
      .classList.add("visually-hidden");
  }

  const commentField = document.querySelector("[name=comment]");

  if (!commentField.value) {
    commentField.style.borderColor = "#f51010";
    document
      .querySelector(".validation-wrap [name=comment] + .error")
      .classList.remove("visually-hidden");
    isFormValidated = false;
  } else {
    commentField.style.borderColor = "#7d7d7d";
    document
      .querySelector(".validation-wrap [name=comment] + .error")
      .classList.add("visually-hidden");
  }

  if (isFormValidated == false) {
    e.preventDefault();
  }
});
