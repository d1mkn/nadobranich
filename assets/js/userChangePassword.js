import axios from "axios";
import { refs } from "./refs";

refs.submitChangePass.addEventListener("click", (e) => {
  e.preventDefault();
  refs.submitChangePass.setAttribute("disabled", true);
  const payload = new FormData();
  payload.append("password_current", document.getElementById("password_current").value);
  payload.append("password_1", document.getElementById("password_1").value);
  payload.append("password_2", document.getElementById("password_2").value);
  axios
    .post("http://localhost/nadobranich/my-account/edit-account/", payload)
    .then((response) => location.reload());
});
