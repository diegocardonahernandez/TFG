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
    nameNewUser.style.border = "1px solid red";
  } else if (/\d/.test(nameNewUser.value)) {
    errorName.innerHTML = "El nombre no puede contener números.";
    errorName.style.display = "block";
    nameNewUser.style.border = "1px solid red";
  } else {
    nameNewUser.value =
      nameNewUser.value[0].toUpperCase() + nameNewUser.value.slice(1);
    errorName.innerHTML = "";
    errorName.style.display = "none";
    nameNewUser.style.border = "1px solid #1f7a1f";
    isNameValid = true;
  }
});

apellidoNewUser.addEventListener("input", () => {
  if (apellidoNewUser.value.length < 3) {
    errorLastName.innerHTML = "El apellido debe tener al menos 3 caracteres.";
    errorLastName.style.display = "block";
    apellidoNewUser.style.border = "1px solid red";
  } else if (/\d/.test(apellidoNewUser.value)) {
    errorLastName.innerHTML = "El apellido no puede contener números.";
    errorLastName.style.display = "block";
    apellidoNewUser.style.border = "1px solid red";
  } else {
    apellidoNewUser.value =
      apellidoNewUser.value[0].toUpperCase() + apellidoNewUser.value.slice(1);
    errorLastName.innerHTML = "";
    errorLastName.style.display = "none";
    apellidoNewUser.style.border = "1px solid #1f7a1f";
    isLastNameValid = true;
  }
});

correoNewUser.addEventListener("input", () => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
  if (!emailPattern.test(correoNewUser.value)) {
    errorEmail.innerHTML = "El correo electrónico no es válido.";
    errorEmail.style.display = "block";
    correoNewUser.style.border = "1px solid red";
  } else {
    errorEmail.innerHTML = "";
    errorEmail.style.display = "none";
    correoNewUser.style.border = "1px solid #1f7a1f";
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
    passwordStrength.style.backgroundColor = "#1f7a1f";
    passwordStrengthText.textContent = "Fuerte";
  }

  if (!regexPasswordFuerte.test(password)) {
    errorPassword.innerHTML = "La contraseña aún no cumple los requisitos.";
    errorPassword.style.display = "block";
    contrasenaNewUser.style.border = "1px solid red";
  } else {
    errorPassword.innerHTML = "";
    errorPassword.style.display = "none";
    contrasenaNewUser.style.border = "1px solid #1f7a1f";
    xz;
    isPasswordValid = true;
  }
});

confirmarContrasena.addEventListener("input", () => {
  if (contrasenaNewUser.value !== confirmarContrasena.value) {
    errorConfirm.innerHTML = "Las contraseñas no coinciden.";
    errorConfirm.style.display = "block";
    confirmarContrasena.style.border = "1px solid red";
  } else {
    errorConfirm.innerHTML = "";
    errorConfirm.style.display = "none";
    confirmarContrasena.style.border = "1px solid #1f7a1f";
    isConfirmPasswordValid = true;
  }
});

nacimientoNewUser.addEventListener("input", () => {
  const value = nacimientoNewUser.value;

  if (!value) {
    errorBirthday.innerHTML = "Por favor, ingresa tu fecha de nacimiento.";
    errorBirthday.style.display = "block";
    nacimientoNewUser.style.border = "1px solid red";
    isBirthdayValid = false;
    return;
  }

  const birthDate = new Date(value);
  const today = new Date();

  let age = today.getFullYear() - birthDate.getFullYear();
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
    nacimientoNewUser.style.border = "1px solid red";
    isBirthdayValid = false;
  } else {
    errorBirthday.innerHTML = "";
    errorBirthday.style.display = "none";
    nacimientoNewUser.style.border = "1px solid #1f7a1f";
    isBirthdayValid = true;
  }
});

telefonoNewUser.addEventListener("input", () => {
  const numero = telefonoNewUser.value.replace(/\D/g, "");

  if (numero[0] !== "6") {
    errorPhone.innerHTML =
      "El número de teléfono debe pertenecer a la región española.";
    errorPhone.style.display = "block";
    telefonoNewUser.style.border = "1px solid red";
    isPhoneValid = false;
  } else if (numero.length !== 9) {
    errorPhone.innerHTML = "El número de teléfono debe tener 9 dígitos.";
    errorPhone.style.display = "block";
    telefonoNewUser.style.border = "1px solid red";
    isPhoneValid = false;
  } else {
    const numeroFormateado = numero.replace(
      /(\d{3})(\d{2})(\d{2})(\d{2})/,
      "$1 $2 $3 $4"
    );
    telefonoNewUser.value = numeroFormateado;

    errorPhone.innerHTML = "";
    errorPhone.style.display = "none";
    telefonoNewUser.style.border = "1px solid #1f7a1f";
    isPhoneValid = true;
  }
});
