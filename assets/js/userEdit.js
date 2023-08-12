import axios from "axios";
import { refs } from "./refs";

refs.submitInfoEdit.addEventListener("click", (e) => {
  e.preventDefault();
  refs.submitInfoEdit.setAttribute("disabled", true);
  const payload = new FormData();
  payload.append("account_first_name", document.getElementById("account_first_name").value);
  payload.append("account_last_name", document.getElementById("account_last_name").value);
  payload.append("account_email", document.getElementById("account_email").value);
  axios
    .post("http://localhost/nadobranich/my-account/edit-account/", payload)
    .then((response) => location.reload());
});
