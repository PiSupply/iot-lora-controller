
var email = document.getElementById("emailAddr");
var confirm_email = document.getElementById("emailConfirm");

var password = document.getElementById("password");
var confirm_pass = document.getElementById("confirmPassword");

function validatePass() {
  if(password.value != confirm_pass.value) {

  }
}

password.onchange = validatePass();
confirm_password.onchange = validatePass();
