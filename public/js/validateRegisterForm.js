document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const error = params.get("error");

  if (error === "correo") {
    Swal.fire({
      title: "¡Error! Correo duplicado",
      text: "Ya existe un usuario con ese correo electrónico.",
      icon: "error",
      confirmButtonText: "Aceptar",
      confirmButtonColor: "#aa0303",
    });
  }
});

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
const btnCreateAccount = document.querySelector(".btn-register");

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
    isNameValid = false;
  } else if (/\d/.test(nameNewUser.value)) {
    errorName.innerHTML = "El nombre no puede contener números.";
    errorName.style.display = "block";
    nameNewUser.style.border = "1px solid red";
    isNameValid = false;
  } else {
    nameNewUser.value =
      nameNewUser.value[0].toUpperCase() + nameNewUser.value.slice(1);
    errorName.innerHTML = "";
    errorName.style.display = "none";
    nameNewUser.style.border = "1px solid #1f7a1f";
    isNameValid = true;
  }
  checkFormValidity();
});

apellidoNewUser.addEventListener("input", () => {
  if (apellidoNewUser.value.length < 3) {
    errorLastName.innerHTML = "El apellido debe tener al menos 3 caracteres.";
    errorLastName.style.display = "block";
    apellidoNewUser.style.border = "1px solid red";
    isLastNameValid = false;
  } else if (/\d/.test(apellidoNewUser.value)) {
    errorLastName.innerHTML = "El apellido no puede contener números.";
    errorLastName.style.display = "block";
    apellidoNewUser.style.border = "1px solid red";
    isLastNameValid = false;
  } else {
    apellidoNewUser.value =
      apellidoNewUser.value[0].toUpperCase() + apellidoNewUser.value.slice(1);
    errorLastName.innerHTML = "";
    errorLastName.style.display = "none";
    apellidoNewUser.style.border = "1px solid #1f7a1f";
    isLastNameValid = true;
  }
  checkFormValidity();
});

correoNewUser.addEventListener("input", () => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
  if (!emailPattern.test(correoNewUser.value)) {
    errorEmail.innerHTML = "El correo electrónico no es válido.";
    errorEmail.style.display = "block";
    correoNewUser.style.border = "1px solid red";
    isEmailValid = false;
  } else {
    errorEmail.innerHTML = "";
    errorEmail.style.display = "none";
    correoNewUser.style.border = "1px solid #1f7a1f";
    isEmailValid = true;
  }
  checkFormValidity();
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
    isPasswordValid = false;
  } else {
    errorPassword.innerHTML = "";
    errorPassword.style.display = "none";
    contrasenaNewUser.style.border = "1px solid #1f7a1f";
    isPasswordValid = true;
  }
  checkFormValidity();
});

confirmarContrasena.addEventListener("input", () => {
  if (contrasenaNewUser.value !== confirmarContrasena.value) {
    errorConfirm.innerHTML = "Las contraseñas no coinciden.";
    errorConfirm.style.display = "block";
    confirmarContrasena.style.border = "1px solid red";
    isConfirmPasswordValid = false;
  } else {
    errorConfirm.innerHTML = "";
    errorConfirm.style.display = "none";
    confirmarContrasena.style.border = "1px solid #1f7a1f";
    isConfirmPasswordValid = true;
  }
  checkFormValidity();
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
  checkFormValidity();
});

generoNewUser.addEventListener("change", () => {
  if (generoNewUser.value !== "") {
    isGenderValid = true;
    errorGender.style.display = "none";
    generoNewUser.style.border = "1px solid #1f7a1f";
  } else {
    isGenderValid = false;
    errorGender.innerHTML = "Selecciona un género.";
    errorGender.style.display = "block";
    generoNewUser.style.border = "1px solid red";
  }
  checkFormValidity();
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
  checkFormValidity();
});

pesoNewUser.addEventListener("input", () => {
  const peso = parseInt(pesoNewUser.value);

  if (peso < 30 || peso > 200) {
    errorWeight.innerHTML = "El peso debe estar entre 30 y 200 kg.";
    errorWeight.style.display = "block";
    pesoNewUser.style.border = "1px solid red";
    isWeightValid = false;
  } else {
    errorWeight.innerHTML = "";
    errorWeight.style.display = "none";
    pesoNewUser.style.border = "1px solid #1f7a1f";
    isWeightValid = true;
  }
  checkFormValidity();
});

alturaNewUser.addEventListener("input", () => {
  const altura = parseInt(alturaNewUser.value);

  if (altura < 100 || altura > 250) {
    errorHeight.innerHTML = "La altura debe estar entre 100 y 250 cm.";
    errorHeight.style.display = "block";
    alturaNewUser.style.border = "1px solid red";
    isHeightValid = false;
  } else {
    errorHeight.innerHTML = "";
    errorHeight.style.display = "none";
    alturaNewUser.style.border = "1px solid #1f7a1f";
    isHeightValid = true;
  }
  checkFormValidity();
});

terminosYcondiciones.addEventListener("change", () => {
  if (terminosYcondiciones.checked) {
    isTermsAccepted = true;
  } else {
    isTermsAccepted = false;
  }
  checkFormValidity();
});

function checkFormValidity() {
  if (
    isNameValid &&
    isLastNameValid &&
    isEmailValid &&
    isPasswordValid &&
    isConfirmPasswordValid &&
    isBirthdayValid &&
    isGenderValid &&
    isPhoneValid &&
    isWeightValid &&
    isHeightValid &&
    isTermsAccepted
  ) {
    btnCreateAccount.removeAttribute("disabled");
    return true;
  } else {
    btnCreateAccount.setAttribute("disabled", "true");
    return false;
  }
}

btnCreateAccount.addEventListener("click", (e) => {
  e.preventDefault();
  let isFormValid = checkFormValidity();

  if (isFormValid) {
    // Primero mostramos la alerta de "procesando datos"
    Swal.fire({
      title: "Procesando datos",
      text: "Por favor espere mientras procesamos su solicitud...",
      icon: "info",
      iconColor: "#666666",
      showConfirmButton: false,
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    setTimeout(() => {
      Swal.fire({
        title: "¡Registro exitoso!",
        text: "Tu cuenta ha sido creada con éxito. Serás redirigido al forulario de inicio de sesión.",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#aa0303",
      }).then((result) => {
        if (result.isConfirmed) {
          formRegister.submit();
        }
      });
    }, 3000);
  }
});
