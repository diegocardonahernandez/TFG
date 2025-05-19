// Script para la funcionalidad de "Agendar consulta"
document.addEventListener("DOMContentLoaded", function () {
  // Elementos del DOM
  const consultaBtn = document.querySelector(".imc-consultation-btn");

  // Evento para el botón de agendar consulta
  if (consultaBtn) {
    consultaBtn.addEventListener("click", function (event) {
      event.preventDefault();
      showConsultaModal();
    });
  }

  /**
   * Muestra el modal de SweetAlert para agendar consulta
   */
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

        // Validar que ambos campos estén completos
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

        // Retornar los datos para usarlos después
        return { fecha, motivo };
      },
    }).then((result) => {
      if (result.isConfirmed) {
        // Aquí podrías enviar los datos a un servidor o procesarlos
        Swal.fire({
          title: "¡Consulta agendada!",
          text: `Recibiras un correo resumiendo la información de la consulta solicitada. 
          ¡Gracias por confiar en nosotros!`,
          icon: "success",
          confirmButtonColor: "#2E8B57",
        });

        // Aquí se implementaría el código para guardar la consulta
        console.log("Datos de consulta:", result.value);
      }
    });
  }

  /**
   * Obtiene la fecha de mañana en formato YYYY-MM-DD para el atributo min del input date
   * @returns {string} Fecha de mañana en formato YYYY-MM-DD
   */
  function getTomorrowDate() {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    return tomorrow.toISOString().split("T")[0];
  }

  /**
   * Formatea una fecha YYYY-MM-DD a un formato más legible
   * @param {string} dateString - Fecha en formato YYYY-MM-DD
   * @returns {string} Fecha formateada
   */
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

// Alternativa: Modal de Bootstrap (descomenta este código y comenta el anterior si prefieres usar Bootstrap)
/*
document.addEventListener("DOMContentLoaded", function () {
  // Elementos del DOM
  const consultaBtn = document.querySelector(".imc-consultation-btn");
  
  // Agregar el modal al DOM
  addConsultaModal();
  
  // Obtener referencia al modal después de agregarlo
  const consultaModal = new bootstrap.Modal(document.getElementById('consultaModal'));
  
  // Evento para el botón de agendar consulta
  if (consultaBtn) {
    consultaBtn.addEventListener("click", function (event) {
      event.preventDefault();
      consultaModal.show();
    });
  }
  
  // Manejar el envío del formulario
  const consultaForm = document.getElementById('consultaForm');
  if (consultaForm) {
    consultaForm.addEventListener('submit', function(event) {
      event.preventDefault();
      
      // Obtener los datos del formulario
      const formData = new FormData(consultaForm);
      const fecha = formData.get('fecha-consulta');
      const motivo = formData.get('motivo-consulta');
      
      // Esconder el modal
      consultaModal.hide();
      
      // Mostrar confirmación
      setTimeout(() => {
        Swal.fire({
          title: '¡Consulta agendada!',
          text: `Tu consulta ha sido programada para el ${formatDate(fecha)}. Te contactaremos pronto para confirmar.`,
          icon: 'success',
          confirmButtonColor: '#4CAF50'
        });
      }, 500);
      
      // Aquí se implementaría el código para guardar la consulta
      console.log('Datos de consulta:', { fecha, motivo });
      
      // Resetear formulario
      consultaForm.reset();
    });
  }
  
  /**
   * Agrega el HTML del modal de consulta al final del body
   */
function addConsultaModal() {
  const modalHTML = `
      <div class="modal fade" id="consultaModal" tabindex="-1" aria-labelledby="consultaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="consultaModalLabel">Agendar consulta</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="consultaForm">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="fecha-consulta" class="form-label">Fecha de consulta</label>
                  <input type="date" class="form-control" id="fecha-consulta" name="fecha-consulta" min="${getTomorrowDate()}" required>
                </div>
                <div class="mb-3">
                  <label for="motivo-consulta" class="form-label">Motivo de consulta</label>
                  <textarea class="form-control" id="motivo-consulta" name="motivo-consulta" rows="4" placeholder="Describe brevemente el motivo de tu consulta" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agendar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    `;

  document.body.insertAdjacentHTML("beforeend", modalHTML);
}

/**
 * Obtiene la fecha de mañana en formato YYYY-MM-DD para el atributo min del input date
 * @returns {string} Fecha de mañana en formato YYYY-MM-DD
 */
function getTomorrowDate() {
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  return tomorrow.toISOString().split("T")[0];
}

/**
 * Formatea una fecha YYYY-MM-DD a un formato más legible
 * @param {string} dateString - Fecha en formato YYYY-MM-DD
 * @returns {string} Fecha formateada
 */
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
