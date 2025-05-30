const emailLogin = document.getElementById("email");
const passwordLogin = document.getElementById("password");
const btnLogin = document.querySelector(".btn-login");
const form = document.querySelector(".login-form");

const invalidLoginEmail = document.getElementById("login-errorEmail");
const invalidLoginPassword = document.getElementById("login-errorPassw");

emailLogin.addEventListener("blur", () => {
  const emailPatternLogin = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;

  if (!emailPatternLogin.test(emailLogin.value)) {
    invalidLoginEmail.innerHTML = "Formato de correo inválido";
    invalidLoginEmail.style.display = "block";
    emailLogin.style.borderColor = "red";
  } else {
    invalidLoginEmail.innerHTML = "";
    emailLogin.style.border = "1px solid #ccc";
  }
});

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const email = emailLogin.value;
  const password = passwordLogin.value;

  Swal.fire({
    title: "Validando sus credenciales",
    text: "Por favor espere mientras validamos su información",
    allowEscapeKey: false,
    icon: "info",
    showConfirmButton: false,
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading(),
  });

  setTimeout(() => {
    fetch("/loginForm", {
      method: "POST",
      body: new FormData(form),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success === "true") {
          Swal.fire({
            title: "¡Bienvenid@!",
            text: "Has iniciado sesión exitosamente",
            icon: "success",
            iconColor: "#aa0303",
            showConfirmButton: false,
            timer: 2000,
          }).then(() => {
            window.location.href = "/";
          });
        } else if (data.incorrectPassword === "true") {
          Swal.fire({
            title: "Error",
            text: "Contraseña incorrecta",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
          });
          passwordLogin.style.border = "1px solid red";
          invalidLoginPassword.innerHTML =
            "La contraseña proporcionada es incorrecta";
          invalidLoginPassword.style.display = "block";
        } else if (data.incorrectEmail === "true") {
          Swal.fire({
            title: "Error",
            text: "Correo electrónico no registrado",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
          });
          emailLogin.style.border = "1px solid red";
          invalidLoginEmail.innerHTML =
            "El correo proporcionado no está registrado en nuestra base de datos";
          invalidLoginEmail.style.display = "block";
        } else {
          Swal.fire({
            title: "Error",
            text: "Error al iniciar sesión, por favor intente nuevamente",
            icon: "error",
            iconColor: "#aa0303",
          });
        }
      });
  }, 2000);
});
