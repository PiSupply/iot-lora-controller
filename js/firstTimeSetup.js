
var email = document.getElementById("emailAddr");
var confirm_email = document.getElementById("emailConfirm");

var password = document.getElementById("password");
var confirm_pass = document.getElementById("confirmPassword");

function validatePass() {
  if(password.value != confirm_pass.value) {
    confirm_pass.setCustomValidity("Passwords do not match.");
  }
  else {
    confirm_pass.setCustomValidity("");
  }
}

function validateEmail() {
  if(email.value != confirm_email.value) {
    confirm_email.setCustomValidity("Emails do not match.");
  }
  else {
    confirm_email.setCustomValidity("");
  }
}

password.onchange = validatePass();
confirm_password.onchange = validatePass();
