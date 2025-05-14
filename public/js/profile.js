// Estado de validaciones - inicializamos todos con null para indicar que no se han validado
let isNameValid = null;
let isLastNameValid = null;
let isCurrentPassValid = null;
let isPasswordValid = true; // Por defecto true si no se cambia la contraseña
let isConfirmPasswordValid = true; // Por defecto true si no se cambia la contraseña
let isBirthdayValid = null;
let isPhoneValid = null;
let isWeightValid = null;
let isHeightValid = null;
let isUserImageValid = true;

const profileForm = document.getElementById("user-profile-form");
const btnSaveChanges = document.querySelector(".user-profile-btn-save");

// Campos del formulario
const profileInputFirstName = document.getElementById("user_profile_nombre");
const profileInputLastName = document.getElementById("user_profile_apellido");
const profileInputEmail = document.getElementById("user_profile_correo");
const profileInputBirthDate = document.getElementById(
  "user_profile_fecha_nacimiento"
);
const profileSelectGender = document.getElementById("user_profile_genero");
const profileInputPhone = document.getElementById("user_profile_telefono");
const profileInputWeight = document.getElementById("user_profile_peso");
const profileInputHeight = document.getElementById("user_profile_altura");
const profileInputCurrentPassword = document.getElementById(
  "user_profile_current_password"
);
const profileInputNewPassword = document.getElementById(
  "user_profile_new_password"
);
const profileInputConfirmPassword = document.getElementById(
  "user_profile_confirm_password"
);

// Campos de error
const profileErrorName = document.getElementById("user-profile-errorName");
const profileErrorLastName = document.getElementById(
  "user-profile-errorLastName"
);
const profileErrorPassword = document.getElementById(
  "user-profile-errorNewPassword"
);
const profileErrorConfirm = document.getElementById(
  "user-profile-errorConfirmPassword"
);
const profileErrorBirthday = document.getElementById(
  "user-profile-errorBirthday"
);
const profileErrorGender = document.getElementById("user-profile-errorGender");
const profileErrorPhone = document.getElementById("user-profile-errorPhone");
const profileErrorWeight = document.getElementById("user-profile-errorWeight");
const profileErrorHeight = document.getElementById("user-profile-errorHeight");
const profileErrorCurrentPassword = document.getElementById(
  "user-profile-errorCurrentPassword"
);

// Medidor de fuerza
const profilePasswordStrength = document.getElementById(
  "user-profile-passwordStrength"
);
const profilePasswordStrengthText = document.getElementById(
  "user-profile-passwordStrengthText"
);

// Función para validar los campos al cargar la página
function validateInitialFormValues() {
  // Validar nombre
  validateName(profileInputFirstName.value);

  // Validar apellido
  validateLastName(profileInputLastName.value);

  // Validar fecha de nacimiento
  validateBirthday(profileInputBirthDate.value);

  // Validar teléfono
  validatePhone(profileInputPhone.value);

  // Validar peso
  validateWeight(profileInputWeight.value);

  // Validar altura
  validateHeight(profileInputHeight.value);

  // Comprobar validez del formulario
  checkFormValidity();
}

// Función para validar nombre
function validateName(value) {
  if (value.length < 3) {
    profileErrorName.textContent =
      "El nombre debe tener al menos 3 caracteres.";
    profileErrorName.style.display = "block";
    profileInputFirstName.style.border = "1px solid red";
    isNameValid = false;
  } else if (/\d/.test(value)) {
    profileErrorName.textContent = "El nombre no puede contener números.";
    profileErrorName.style.display = "block";
    profileInputFirstName.style.border = "1px solid red";
    isNameValid = false;
  } else {
    profileErrorName.style.display = "none";
    profileInputFirstName.style.border = "1px solid #ccc";
    isNameValid = true;
  }
}

// Función para validar apellido
function validateLastName(value) {
  if (value.length < 3) {
    profileErrorLastName.textContent =
      "El apellido debe tener al menos 3 caracteres.";
    profileErrorLastName.style.display = "block";
    profileInputLastName.style.border = "1px solid red";
    isLastNameValid = false;
  } else if (/\d/.test(value)) {
    profileErrorLastName.textContent = "El apellido no puede contener números.";
    profileErrorLastName.style.display = "block";
    profileInputLastName.style.border = "1px solid red";
    isLastNameValid = false;
  } else {
    profileErrorLastName.style.display = "none";
    profileInputLastName.style.border = "1px solid #ccc";
    isLastNameValid = true;
  }
}

// Función para validar fecha de nacimiento
function validateBirthday(value) {
  if (!value) {
    profileErrorBirthday.textContent =
      "Por favor, ingresa tu fecha de nacimiento.";
    profileErrorBirthday.style.display = "block";
    profileInputBirthDate.style.border = "1px solid red";
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
    profileErrorBirthday.textContent = "Debes ser mayor de 16 años.";
    profileErrorBirthday.style.display = "block";
    profileInputBirthDate.style.border = "1px solid red";
    isBirthdayValid = false;
  } else {
    profileErrorBirthday.style.display = "none";
    profileInputBirthDate.style.border = "1px solid #ccc";
    isBirthdayValid = true;
  }
}

// Función para validar teléfono
function validatePhone(value) {
  const number = value.replace(/\D/g, "");

  if (number.length === 0) {
    // Si está vacío, podría ser opcional
    profileErrorPhone.style.display = "none";
    profileInputPhone.style.border = "1px solid #ccc";
    isPhoneValid = true;
    return;
  }

  if (number[0] !== "6") {
    profileErrorPhone.textContent =
      "El número de teléfono debe pertenecer a la región española.";
    profileErrorPhone.style.display = "block";
    profileInputPhone.style.border = "1px solid red";
    isPhoneValid = false;
  } else if (number.length !== 9) {
    profileErrorPhone.textContent =
      "El número de teléfono debe tener 9 dígitos.";
    profileErrorPhone.style.display = "block";
    profileInputPhone.style.border = "1px solid red";
    isPhoneValid = false;
  } else {
    profileErrorPhone.style.display = "none";
    profileInputPhone.style.border = "1px solid #ccc";
    isPhoneValid = true;
  }
}

// Función para validar peso
function validateWeight(value) {
  if (!value.trim()) {
    profileErrorWeight.textContent = "Este campo es obligatorio.";
    profileErrorWeight.style.display = "block";
    profileInputWeight.style.border = "1px solid red";
    isWeightValid = false;
  } else {
    const weight = parseInt(value);
    if (weight < 30 || weight > 200) {
      profileErrorWeight.textContent = "El peso debe estar entre 30 y 200 kg.";
      profileErrorWeight.style.display = "block";
      profileInputWeight.style.border = "1px solid red";
      isWeightValid = false;
    } else {
      profileErrorWeight.style.display = "none";
      profileInputWeight.style.border = "1px solid #ccc";
      isWeightValid = true;
    }
  }
}

// Función para validar altura
function validateHeight(value) {
  if (!value.trim()) {
    profileErrorHeight.textContent = "Este campo es obligatorio.";
    profileErrorHeight.style.display = "block";
    profileInputHeight.style.border = "1px solid red";
    isHeightValid = false;
  } else {
    const height = parseInt(value);
    if (height < 100 || height > 250) {
      profileErrorHeight.textContent =
        "La altura debe estar entre 100 y 250 cm.";
      profileErrorHeight.style.display = "block";
      profileInputHeight.style.border = "1px solid red";
      isHeightValid = false;
    } else {
      profileErrorHeight.style.display = "none";
      profileInputHeight.style.border = "1px solid #ccc";
      isHeightValid = true;
    }
  }
}

// Nombre
profileInputFirstName.addEventListener("input", () => {
  profileInputFirstName.value =
    profileInputFirstName.value.charAt(0).toUpperCase() +
    profileInputFirstName.value.slice(1);
  validateName(profileInputFirstName.value);
  checkFormValidity();
});

// Apellido
profileInputLastName.addEventListener("input", () => {
  profileInputLastName.value =
    profileInputLastName.value.charAt(0).toUpperCase() +
    profileInputLastName.value.slice(1);
  validateLastName(profileInputLastName.value);
  checkFormValidity();
});

// Fecha de nacimiento
profileInputBirthDate.addEventListener("input", () => {
  validateBirthday(profileInputBirthDate.value);
  checkFormValidity();
});

// Teléfono
profileInputPhone.addEventListener("input", () => {
  const number = profileInputPhone.value.replace(/\D/g, "");

  validatePhone(profileInputPhone.value);

  // Aplicamos formato si es válido
  if (isPhoneValid && number.length === 9) {
    const formatted = number.replace(
      /(\d{3})(\d{2})(\d{2})(\d{2})/,
      "$1 $2 $3 $4"
    );
    profileInputPhone.value = formatted;
  }

  checkFormValidity();
});

// Peso
profileInputWeight.addEventListener("input", () => {
  validateWeight(profileInputWeight.value);
  checkFormValidity();
});

// Altura
profileInputHeight.addEventListener("input", () => {
  validateHeight(profileInputHeight.value);
  checkFormValidity();
});

// Nueva Contraseña - Solo validamos si se está ingresando una
profileInputNewPassword.addEventListener("input", () => {
  const password = profileInputNewPassword.value;

  // Si el campo está vacío, no requiere validación
  if (!password) {
    profileErrorPassword.style.display = "none";
    profileInputNewPassword.style.border = "1px solid #ccc";
    profilePasswordStrength.style.width = "0%";
    profilePasswordStrengthText.textContent = "";
    isPasswordValid = true;
    isCurrentPassValid = true; // Resetear validación de contraseña actual
    checkFormValidity();
    return;
  }

  const strongPasswordRegex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

  let strength = 0;
  if (password.length >= 8) strength++;
  if (/[a-z]/.test(password)) strength++;
  if (/[A-Z]/.test(password)) strength++;
  if (/\d/.test(password)) strength++;
  if (/[\W_]/.test(password)) strength++;

  const percent = (strength / 5) * 100;
  profilePasswordStrength.style.width = `${percent}%`;

  if (strength <= 2) {
    profilePasswordStrength.style.backgroundColor = "#e63946";
    profilePasswordStrengthText.textContent = "Débil";
  } else if (strength <= 4) {
    profilePasswordStrength.style.backgroundColor = "#f4a261";
    profilePasswordStrengthText.textContent = "Media";
  } else {
    profilePasswordStrength.style.backgroundColor = "#1f7a1f";
    profilePasswordStrengthText.textContent = "Fuerte";
  }

  if (!strongPasswordRegex.test(password)) {
    profileErrorPassword.textContent =
      "La contraseña aún no cumple los requisitos.";
    profileErrorPassword.style.display = "block";
    profileInputNewPassword.style.border = "1px solid red";
    isPasswordValid = false;
  } else {
    profileErrorPassword.style.display = "none";
    profileInputNewPassword.style.border = "1px solid #ccc";
    isPasswordValid = true;
  }

  // Validar también la confirmación si ya existe
  if (profileInputConfirmPassword.value) {
    validateConfirmPassword();
  }

  // Verificar si la contraseña actual está rellenada
  isCurrentPassValid = profileInputCurrentPassword.value.trim().length > 0;

  checkFormValidity();
});

// Función para validar confirmación de contraseña
function validateConfirmPassword() {
  // Si no hay contraseña nueva, no hay nada que confirmar
  if (!profileInputNewPassword.value) {
    profileErrorConfirm.style.display = "none";
    profileInputConfirmPassword.style.border = "1px solid #ccc";
    isConfirmPasswordValid = true;
    return;
  }

  if (profileInputNewPassword.value !== profileInputConfirmPassword.value) {
    profileErrorConfirm.textContent = "Las contraseñas no coinciden.";
    profileErrorConfirm.style.display = "block";
    profileInputConfirmPassword.style.border = "1px solid red";
    isConfirmPasswordValid = false;
  } else {
    profileErrorConfirm.textContent = "";
    profileErrorConfirm.style.display = "none";
    profileInputConfirmPassword.style.border = "1px solid #ccc";
    isConfirmPasswordValid = true;
  }
}

profileInputConfirmPassword.addEventListener("input", () => {
  validateConfirmPassword();
  checkFormValidity();
});

function checkFormValidity() {
  // Si hay contraseña nueva, necesitamos validar también la confirmación y que la contraseña actual esté rellenada
  if (profileInputNewPassword.value) {
    isPasswordValid =
      isPasswordValid && profileInputNewPassword.value.length > 0;
    isConfirmPasswordValid =
      isConfirmPasswordValid &&
      profileInputConfirmPassword.value === profileInputNewPassword.value;
    // Verificar que la contraseña actual esté rellenada
    isCurrentPassValid = profileInputCurrentPassword.value.trim().length > 0;
  } else {
    // Si no hay contraseña nueva, ambos campos son válidos por defecto
    isPasswordValid = true;
    isConfirmPasswordValid = true;
    isCurrentPassValid = true; // No es necesario verificar la contraseña actual si no se cambia la contraseña
  }

  // Habilitamos el botón si todos los campos son válidos
  if (
    isNameValid &&
    isLastNameValid &&
    isBirthdayValid &&
    isPhoneValid &&
    isWeightValid &&
    isHeightValid &&
    isPasswordValid &&
    isConfirmPasswordValid &&
    isCurrentPassValid // Añadimos la verificación de la contraseña actual
  ) {
    btnSaveChanges.removeAttribute("disabled");
    console.log("Formulario válido: Botón habilitado");
    return true;
  } else {
    btnSaveChanges.setAttribute("disabled", "true");
    console.log("Formulario inválido: Botón deshabilitado", {
      isNameValid,
      isLastNameValid,
      isBirthdayValid,
      isPhoneValid,
      isWeightValid,
      isHeightValid,
      isPasswordValid,
      isConfirmPasswordValid,
      isCurrentPassValid, // Añadimos al log
    });
    return false;
  }
}

// Ejecutar validación inicial al cargar la página
document.addEventListener("DOMContentLoaded", () => {
  validateInitialFormValues();
});

// Manejar el envío del formulario con validación
profileForm.addEventListener("submit", function (event) {
  event.preventDefault();

  // Verificar si se intenta cambiar la contraseña
  const isChangingPassword = profileInputNewPassword.value.trim() !== "";

  // Crear objeto FormData con los datos del formulario
  const formData = new FormData(profileForm);

  // Enviar los datos al servidor mediante AJAX
  fetch("/updateUserData", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      // Manejar las diferentes respuestas del servidor
      if (data.passwordNotChanged) {
        // Caso 1: Solo se actualizaron datos personales (sin cambio de contraseña)
        Swal.fire({
          title: "¡Datos actualizados!",
          text: "Tus datos personales han sido actualizados correctamente.",
          confirmButtonColor: "#aa0303",
        });
        setTimeout(() => {
          window.location.href = "/accountUser";
        }, 2500);
      } else if (data.success) {
        // Caso 2: Se actualizaron datos y contraseña correctamente
        Swal.fire({
          title: "¡Cambios guardados!",
          text: isChangingPassword
            ? "Tu contraseña ha sido actualizada"
            : "Tus datos personales han sido actualizados correctamente.",
          confirmButtonColor: "#aa0303",
        }).then((result) => {
          if (result.isConfirmed && isChangingPassword) {
            // Si se cambió la contraseña, limpiamos los campos relacionados
            profileInputCurrentPassword.value = "";
            profileInputNewPassword.value = "";
            profileInputConfirmPassword.value = "";
            profilePasswordStrength.style.width = "0%";
            profilePasswordStrengthText.textContent = "";
          }
        });
        setTimeout(() => {
          window.location.href = "/login";
        }, 2500);
      } else if (data.incorrectPassword) {
        // Caso 3: La contraseña actual es incorrecta
        Swal.fire({
          icon: "error",
          title: "Contraseña incorrecta",
          text: "La contraseña actual que has introducido no es correcta.",
          confirmButtonColor: "#aa0303",
        });
        // Marcar el campo de contraseña actual como inválido
        profileInputCurrentPassword.style.border = "1px solid red";
        profileErrorCurrentPassword.textContent =
          "La contraseña actual es incorrecta.";
        profileErrorCurrentPassword.style.display = "block";
      } else {
        // Caso general de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Ha ocurrido un error al actualizar los datos. Por favor, inténtalo de nuevo.",
          confirmButtonColor: "#d33",
        });
      }
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
      Swal.fire({
        icon: "error",
        title: "Error de conexión",
        text: "Ha ocurrido un problema al conectar con el servidor. Por favor, inténtalo más tarde.",
        confirmButtonColor: "#d33",
      });
    });
});

// Corregir el estilo de la contraseña actual cuando el usuario comienza a escribir
profileInputCurrentPassword.addEventListener("input", function () {
  if (profileErrorCurrentPassword.style.display === "block") {
    profileInputCurrentPassword.style.border = "1px solid #ccc";
    profileErrorCurrentPassword.style.display = "none";
  }

  // Validar si hay contenido en el campo de contraseña actual
  isCurrentPassValid = profileInputCurrentPassword.value.trim().length > 0;

  // Solo es necesario validar si se está intentando cambiar la contraseña
  if (profileInputNewPassword.value) {
    checkFormValidity();
  }
});

// Visualizador de contraseñas (mostrar/ocultar)
document
  .querySelectorAll(".user-profile-toggle-password")
  .forEach(function (toggleBtn) {
    toggleBtn.addEventListener("click", function () {
      const passwordField = this.previousElementSibling;
      if (passwordField.type === "password") {
        passwordField.type = "text";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
      }
    });
  });

// Modal de confirmación para eliminar cuenta
document
  .getElementById("user-profile-delete-account-btn")
  .addEventListener("click", function () {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción eliminará permanentemente tu cuenta y todos tus datos. No podrás recuperarlos.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar cuenta",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        // Aquí iría el código para eliminar la cuenta
        fetch("/deleteAccount", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              Swal.fire(
                "¡Cuenta eliminada!",
                "Tu cuenta ha sido eliminada correctamente.",
                "success"
              ).then(() => {
                window.location.href = "/";
              });
            } else {
              Swal.fire(
                "Error",
                "Ha ocurrido un error al eliminar la cuenta.",
                "error"
              );
            }
          });
      }
    });
  });

// Botón de cancelar - resetea el formulario y valida de nuevo
document
  .querySelector(".user-profile-btn-cancel")
  .addEventListener("click", function () {
    setTimeout(() => {
      validateInitialFormValues();
    }, 100); // Pequeño timeout para asegurar que el reset se ha completado
  });
