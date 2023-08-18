import axios from "axios";
import { refs } from "./refs";

if (document.querySelector(".cabinet-navigation__wrap")) {
  refs.submitChangePass.addEventListener("click", (e) => {
    e.preventDefault();
    const actionLink = e.currentTarget.closest("form").action;
    refs.submitChangePass.setAttribute("disabled", true);
    const payload = new FormData();
    payload.append("password_current", document.getElementById("password_current").value);
    payload.append("password_1", document.getElementById("password_1").value);
    payload.append("password_2", document.getElementById("password_2").value);
    axios.post(actionLink, payload).then((response) => location.reload());
  });
}
