document.addEventListener("DOMContentLoaded", function () {
  const consultaBtn = document.getElementById("scheduleBtn");

  if (consultaBtn) {
    consultaBtn.addEventListener("click", function (event) {
      event.preventDefault();
      showConsultaModal();
    });
  }

  function showConsultaModal() {
    Swal.fire({
      title: "Agendar Consulta",
      html: `
        <div class="swal-consulta-form">
          <div class="swal-form-group">
            <label for="fecha-consulta">Fecha de consulta:</label>
            <input type="date" id="fecha-consulta" class="swal-form-input" min="${getTomorrowDate()}" required>
          </div>
          <div class="swal-form-group">
            <label for="motivo-consulta">Motivo de consulta:</label>
            <textarea id="motivo-consulta" class="swal-form-textarea" placeholder="Describe brevemente el motivo de tu consulta" rows="4" required></textarea>
          </div>
        </div>
      `,
      showCancelButton: true,
      confirmButtonText: "Agendar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#2E8B57",
      cancelButtonColor: "#d33",
      focusConfirm: false,
      customClass: {
        container: "consulta-sweet-container",
        popup: "consulta-sweet-popup",
        confirmButton: "consulta-confirm-button",
        cancelButton: "consulta-cancel-button",
      },
      preConfirm: () => {
        const fecha = document.getElementById("fecha-consulta").value;
        const motivo = document.getElementById("motivo-consulta").value;

        if (!fecha) {
          Swal.showValidationMessage("Por favor selecciona una fecha");
          return false;
        }

        if (!motivo.trim()) {
          Swal.showValidationMessage(
            "Por favor describe el motivo de tu consulta"
          );
          return false;
        }

        return { fecha, motivo };
      },
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById("hidden-fecha-consulta").value =
          result.value.fecha;
        document.getElementById("hidden-motivo-consulta").value =
          result.value.motivo;

        const formData = new FormData(document.getElementById("consultaForm"));

        fetch("/schedule-consultation", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              Swal.fire({
                title: "¡Consulta Agendada!",
                text: "Te hemos enviado un correo con los detalles de tu consulta",
                icon: "success",
                confirmButtonColor: "#2E8B57",
              }).then(() => {
                window.location.href = "/imc";
              });
            } else {
              Swal.fire({
                title: "Error",
                text: data.message,
                icon: "error",
                confirmButtonColor: "#d33",
              });
            }
          })
          .catch((error) => {
            Swal.fire({
              title: "Error",
              text: "Hubo un problema al agendar tu consulta. Por favor, intenta de nuevo.",
              icon: "error",
              confirmButtonColor: "#d33",
            });
          });
      }
    });
  }

  function getTomorrowDate() {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    return tomorrow.toISOString().split("T")[0];
  }

  function formatDate(dateString) {
    const options = {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    };
    const date = new Date(dateString);
    return date.toLocaleDateString("es-ES", options);
  }
});

function getTomorrowDate() {
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  return tomorrow.toISOString().split("T")[0];
}

function formatDate(dateString) {
  const options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const date = new Date(dateString);
  return date.toLocaleDateString("es-ES", options);
}
