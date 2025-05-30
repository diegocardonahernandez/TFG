function updateCountdown() {
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

    if (difference < 0) {
      clearInterval(countdownInterval);
      document.getElementById("countdown").innerHTML =
        '<div class="countdown-ended">¡Oferta finalizada!</div>';
    }
  }

  update();
  const countdownInterval = setInterval(update, 1000);
}

document.addEventListener("DOMContentLoaded", updateCountdown);
