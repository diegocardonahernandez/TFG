const nameNewUser = document.getElementById("registro_nombre");
const apellidoNewUser = document.getElementById("registro_apellido");
const correoNewUser = document.getElementById("registro_correo");
const contrasenaNewUser = document.getElementById("registro_contrasena");
const confirmarContrasena = document.getElementById(
  "registro_confirm_password"
);
const nacimientoNewUser = document.getElementById("registro_fecha_nacimiento");
const generoNewUser = document.getElementById("registro_genero");
const telefonoNewUser = document.getElementById("registro_telefono");
const pesoNewUser = document.getElementById("registro_peso");
const alturaNewUser = document.getElementById("registro_altura");
const fotoNewUser = document.getElementById("registro_foto_perfil");
const terminosYcondiciones = document.getElementById("registro_terms");

const errorMesasage = document.querySelectorAll(".register-errorMessage");
const errorName = document.getElementById("register-errorName");
const errorLastName = document.getElementById("register-errorLastName");
const errorEmail = document.getElementById("register-errorEmail");
const errorPassword = document.getElementById("register-errorPassword");
const errorConfirm = document.getElementById("register-errorConfirm");
const errorBirthday = document.getElementById("register-errorBirthday");
const errorGender = document.getElementById("register-errorGender");
const errorPhone = document.getElementById("register-errorPhone");
const errorWeight = document.getElementById("register-errorWeight");
const errorHeight = document.getElementById("register-errorHeight");
const errorUserImage = document.getElementById("register-errorUserImage");

const requirementsPassword = document.getElementById("requirements");

const formRegister = document.getElementById("register-form");

let isNameValid = false;
let isLastNameValid = false;
let isEmailValid = false;
let isPasswordValid = false;
let isConfirmPasswordValid = false;
let isBirthdayValid = false;
let isGenderValid = false;
let isPhoneValid = false;
let isWeightValid = false;
let isHeightValid = false;
let isUserImageValid = false;
let isTermsAccepted = false;

nameNewUser.addEventListener("input", () => {
  if (nameNewUser.value.length < 3) {
    errorName.innerHTML = "El nombre debe tener al menos 3 caracteres.";
    errorName.style.display = "block";
  } else if (/\d/.test(nameNewUser.value)) {
    errorName.innerHTML = "El nombre no puede contener números.";
    errorName.style.display = "block";
  } else {
    nameNewUser.value =
      nameNewUser.value[0].toUpperCase() + nameNewUser.value.slice(1);
    errorName.innerHTML = "";
    errorName.style.display = "none";
    isNameValid = true;
  }
});

apellidoNewUser.addEventListener("input", () => {
  if (apellidoNewUser.value.length < 3) {
    errorLastName.innerHTML = "El apellido debe tener al menos 3 caracteres.";
    errorLastName.style.display = "block";
  } else if (/\d/.test(apellidoNewUser.value)) {
    errorLastName.innerHTML = "El apellido no puede contener números.";
    errorLastName.style.display = "block";
  } else {
    apellidoNewUser.value =
      apellidoNewUser.value[0].toUpperCase() + apellidoNewUser.value.slice(1);
    errorLastName.innerHTML = "";
    errorLastName.style.display = "none";
    isLastNameValid = true;
  }
});

correoNewUser.addEventListener("input", () => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
  if (!emailPattern.test(correoNewUser.value)) {
    errorEmail.innerHTML = "El correo electrónico no es válido.";
    errorEmail.style.display = "block";
  } else {
    errorEmail.innerHTML = "";
    errorEmail.style.display = "none";
    isEmailValid = true;
  }
});

contrasenaNewUser.addEventListener("input", () => {
  const password = contrasenaNewUser.value;
  const regexPasswordFuerte =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

  let strength = 0;
  if (password.length >= 8) strength++;
  if (/[a-z]/.test(password)) strength++;
  if (/[A-Z]/.test(password)) strength++;
  if (/\d/.test(password)) strength++;
  if (/[\W_]/.test(password)) strength++;

  const percent = (strength / 5) * 100;
  passwordStrength.style.width = `${percent}%`;

  if (strength <= 2) {
    passwordStrength.style.backgroundColor = "#e63946";
    passwordStrengthText.textContent = "Débil";
  } else if (strength <= 4) {
    passwordStrength.style.backgroundColor = "#f4a261";
    passwordStrengthText.textContent = "Media";
  } else {
    passwordStrength.style.backgroundColor = "#2a9d8f";
    passwordStrengthText.textContent = "Fuerte";
  }

  if (!regexPasswordFuerte.test(password)) {
    errorPassword.innerHTML = "La contraseña aún no cumple los requisitos.";
    errorPassword.style.display = "block";
    isPasswordValid = false;
  } else {
    errorPassword.innerHTML = "";
    errorPassword.style.display = "none";
    isPasswordValid = true;
  }
});

confirmarContrasena.addEventListener("input", () => {
  if (contrasenaNewUser.value !== confirmarContrasena.value) {
    errorConfirm.innerHTML = "Las contraseñas no coinciden.";
    errorConfirm.style.display = "block";
  } else {
    errorConfirm.innerHTML = "";
    errorConfirm.style.display = "none";
    isConfirmPasswordValid = true;
  }
});

nacimientoNewUser.addEventListener("input", () => {
  const birthDate = new Date(nacimientoNewUser.value);
  const today = new Date();
  const age = today.getFullYear() - birthDate.getFullYear();
  const monthDiff = today.getMonth() - birthDate.getMonth();

  if (
    monthDiff < 0 ||
    (monthDiff === 0 && today.getDate() < birthDate.getDate())
  ) {
    age--;
  }

  if (age < 16) {
    errorBirthday.innerHTML = "Debes ser mayor de 16 años para registrarte.";
    errorBirthday.style.display = "block";
    isBirthdayValid = false;
  } else {
    errorBirthday.innerHTML = "";
    errorBirthday.style.display = "none";
    isBirthdayValid = true;
  }
});

telefonoNewUser.addEventListener("input", () => {
  if (telefonoNewUser.value[0] != "6") {
    errorPhone.innerHTML =
      "El número de teléfono debe pertenecer a la región española.";
    errorPhone.style.display = "block";
  } else if (
    !isNaN(telefonoNewUser.value) &&
    telefonoNewUser.value.length != 9
  ) {
    errorPhone.innerHTML = "El número de teléfono debe tener 9 dígitos.";
    errorPhone.style.display = "block";
  } else {
    errorPhone.innerHTML = "";
    errorPhone.style.display = "none";
    isPhoneValid = true;
  }
});
