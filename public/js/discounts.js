// Función para actualizar el contador regresivo
function updateCountdown() {
  // Fecha objetivo (24 horas desde ahora)
  const targetDate = new Date();
  targetDate.setDate(targetDate.getDate() + 1);

  function update() {
    const currentDate = new Date();
    const difference = targetDate - currentDate;

    const days = Math.floor(difference / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
      (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((difference % (1000 * 60)) / 1000);

    // Actualizar los elementos del DOM
    document.getElementById("days").textContent = days
      .toString()
      .padStart(2, "0");
    document.getElementById("hours").textContent = hours
      .toString()
      .padStart(2, "0");
    document.getElementById("minutes").textContent = minutes
      .toString()
      .padStart(2, "0");
    document.getElementById("seconds").textContent = seconds
      .toString()
      .padStart(2, "0");

    // Si el tiempo ha terminado
    if (difference < 0) {
      clearInterval(countdownInterval);
      document.getElementById("countdown").innerHTML =
        '<div class="countdown-ended">¡Oferta finalizada!</div>';
    }
  }

  // Actualizar inmediatamente y luego cada segundo
  update();
  const countdownInterval = setInterval(update, 1000);
}

// Iniciar el contador cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", updateCountdown);
