import axios from "axios";

document.querySelector(".personal-data__btn").addEventListener("click", (e) => {
  e.preventDefault();
  document.querySelector(".personal-data__btn").setAttribute("disabled", true);
  const payload = new FormData();
  payload.append("account_first_name", document.getElementById("account_first_name").value);
  payload.append("account_last_name", document.getElementById("account_last_name").value);
  payload.append("account_email", document.getElementById("account_email").value);
  axios
    .post("http://localhost/nadobranich/my-account/edit-account/", payload)
    .then((response) => location.reload());
});
