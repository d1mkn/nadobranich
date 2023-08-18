import axios from "axios";
import { refs } from "./refs";

if (document.querySelector(".cabinet-navigation__wrap")) {
  refs.submitInfoEdit.addEventListener("click", (e) => {
    e.preventDefault();
    const actionLink = e.currentTarget.closest("form").action;
    refs.submitInfoEdit.setAttribute("disabled", true);
    const payload = new FormData();
    payload.append("account_first_name", document.getElementById("account_first_name").value);
    payload.append("account_last_name", document.getElementById("account_last_name").value);
    payload.append("account_email", document.getElementById("account_email").value);
    axios.post(actionLink, payload).then((response) => location.reload());
  });
}
