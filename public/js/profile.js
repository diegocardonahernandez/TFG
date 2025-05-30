let isNameValid = null;
let isLastNameValid = null;
let isCurrentPassValid = null;
let isPasswordValid = true;
let isConfirmPasswordValid = true;
let isBirthdayValid = null;
let isPhoneValid = null;
let isWeightValid = null;
let isHeightValid = null;
let isUserImageValid = true;

const profileForm = document.getElementById("user-profile-form");
const btnSaveChanges = document.querySelector(".user-profile-btn-save");

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

const profilePasswordStrength = document.getElementById(
  "user-profile-passwordStrength"
);
const profilePasswordStrengthText = document.getElementById(
  "user-profile-passwordStrengthText"
);

const profileImagePreview = document.getElementById(
  "user-profile-image-preview"
);
const profileImageInput = document.getElementById("user-profile-image-upload");

function validateInitialFormValues() {
  validateName(profileInputFirstName.value);

  validateLastName(profileInputLastName.value);

  validateBirthday(profileInputBirthDate.value);

  validatePhone(profileInputPhone.value);

  validateWeight(profileInputWeight.value);

  validateHeight(profileInputHeight.value);

  checkFormValidity();
}

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

function validatePhone(value) {
  const number = value.replace(/\D/g, "");

  if (number.length === 0) {
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

profileInputFirstName.addEventListener("input", () => {
  profileInputFirstName.value =
    profileInputFirstName.value.charAt(0).toUpperCase() +
    profileInputFirstName.value.slice(1);
  validateName(profileInputFirstName.value);
  checkFormValidity();
});

profileInputLastName.addEventListener("input", () => {
  profileInputLastName.value =
    profileInputLastName.value.charAt(0).toUpperCase() +
    profileInputLastName.value.slice(1);
  validateLastName(profileInputLastName.value);
  checkFormValidity();
});

profileInputBirthDate.addEventListener("input", () => {
  validateBirthday(profileInputBirthDate.value);
  checkFormValidity();
});

profileInputPhone.addEventListener("input", () => {
  const number = profileInputPhone.value.replace(/\D/g, "");

  validatePhone(profileInputPhone.value);

  if (isPhoneValid && number.length === 9) {
    const formatted = number.replace(
      /(\d{3})(\d{2})(\d{2})(\d{2})/,
      "$1 $2 $3 $4"
    );
    profileInputPhone.value = formatted;
  }

  checkFormValidity();
});

profileInputWeight.addEventListener("input", () => {
  validateWeight(profileInputWeight.value);
  checkFormValidity();
});

profileInputHeight.addEventListener("input", () => {
  validateHeight(profileInputHeight.value);
  checkFormValidity();
});

profileInputNewPassword.addEventListener("input", () => {
  const password = profileInputNewPassword.value;

  if (!password) {
    profileErrorPassword.style.display = "none";
    profileInputNewPassword.style.border = "1px solid #ccc";
    profilePasswordStrength.style.width = "0%";
    profilePasswordStrengthText.textContent = "";
    isPasswordValid = true;
    isCurrentPassValid = true;
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

  if (profileInputConfirmPassword.value) {
    validateConfirmPassword();
  }

  isCurrentPassValid = profileInputCurrentPassword.value.trim().length > 0;

  checkFormValidity();
});

function validateConfirmPassword() {
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
  if (profileInputNewPassword.value) {
    isPasswordValid =
      isPasswordValid && profileInputNewPassword.value.length > 0;
    isConfirmPasswordValid =
      isConfirmPasswordValid &&
      profileInputConfirmPassword.value === profileInputNewPassword.value;
    isCurrentPassValid = profileInputCurrentPassword.value.trim().length > 0;
  } else {
    isPasswordValid = true;
    isConfirmPasswordValid = true;
    isCurrentPassValid = true;
  }

  if (
    isNameValid &&
    isLastNameValid &&
    isBirthdayValid &&
    isPhoneValid &&
    isWeightValid &&
    isHeightValid &&
    isPasswordValid &&
    isConfirmPasswordValid &&
    isCurrentPassValid
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
      isCurrentPassValid,
    });
    return false;
  }
}

profileImageInput.addEventListener("change", function () {
  if (this.files && this.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      profileImagePreview.style.backgroundImage = `url('${e.target.result}')`;
    };

    reader.readAsDataURL(this.files[0]);
  }
});

document.addEventListener("DOMContentLoaded", () => {
  validateInitialFormValues();
});

profileForm.addEventListener("submit", function (event) {
  event.preventDefault();
  const isChangingPassword = profileInputNewPassword.value.trim() !== "";

  const formData = new FormData(profileForm);

  fetch("/updateUserData", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.passwordNotChanged) {
        Swal.fire({
          title: "¡Datos actualizados!",
          text: "Tus datos personales han sido actualizados correctamente.",
          confirmButtonColor: "#aa0303",
          confirmButtonText: "Volver",
        });

        if (data.new_image_path) {
          profileImagePreview.style.backgroundImage = `url('${data.new_image_path}')`;
        }
      } else if (data.success) {
        Swal.fire({
          title: "¡Cambios guardados!",
          text: isChangingPassword
            ? "Tu contraseña se cambió con éxito."
            : "Tus datos personales han sido actualizados correctamente.",
          confirmButtonColor: "#aa0303",
          confirmButtonText: "Volver",
        }).then((result) => {
          if (result.isConfirmed && isChangingPassword) {
            profileInputCurrentPassword.value = "";
            profileInputNewPassword.value = "";
            profileInputConfirmPassword.value = "";
            profilePasswordStrength.style.width = "0%";
            profilePasswordStrengthText.textContent = "";
          }
        });

        if (data.new_image_path) {
          profileImagePreview.style.backgroundImage = `url('${data.new_image_path}')`;
        }
      } else if (data.incorrectPassword) {
        Swal.fire({
          icon: "error",
          title: "Contraseña incorrecta",
          text: "La contraseña actual que has introducido no es correcta.",
          confirmButtonColor: "#aa0303",
          confirmButtonText: "Volver",
        });
        profileInputCurrentPassword.style.border = "1px solid red";
        profileErrorCurrentPassword.textContent =
          "La contraseña actual es incorrecta.";
        profileErrorCurrentPassword.style.display = "block";
      } else {
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

profileInputCurrentPassword.addEventListener("input", function () {
  if (profileErrorCurrentPassword.style.display === "block") {
    profileInputCurrentPassword.style.border = "1px solid #ccc";
    profileErrorCurrentPassword.style.display = "none";
  }

  isCurrentPassValid = profileInputCurrentPassword.value.trim().length > 0;

  if (profileInputNewPassword.value) {
    checkFormValidity();
  }
});

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

document
  .getElementById("user-profile-delete-account-btn")
  .addEventListener("click", function () {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción eliminará permanentemente tu cuenta y todos tus datos. No podrás recuperarlos.",
      icon: "warning",
      iconColor: "red",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar cuenta",
      cancelButtonText: "Cancelar",
      cancelButtonColor: " #2E8B57",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("/deleteAccount", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              Swal.fire({
                title: "¡Cuenta eliminada!",
                text: "Tu cuenta ha sido eliminada correctamente.",
                icon: null,
                confirmButtonColor: "#aa0303",
              }).then(() => {
                window.location.href = "/logout";
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

document
  .querySelector(".user-profile-btn-cancel")
  .addEventListener("click", function () {
    setTimeout(() => {
      validateInitialFormValues();
    }, 100);
  });
