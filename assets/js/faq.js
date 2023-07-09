document.querySelectorAll(".faq__item").forEach((item) => {
  const question = item.querySelector(".faq__question");
  const answer = item.querySelector(".faq__answer");

  question.addEventListener("click", () => {
    item.classList.toggle("active");

    if (item.classList.contains("active")) {
      answer.classList.toggle("visually-hidden");
    } else {
      setTimeout(() => {
        answer.classList.toggle("visually-hidden");
      }, 1000);
    }
  });
});
