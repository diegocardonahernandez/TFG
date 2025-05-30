document.addEventListener("DOMContentLoaded", function () {
  var myCarousel = document.getElementById("carouselExampleCaptions");

  myCarousel.addEventListener("slide.bs.carousel", function (e) {
    let slides = document.querySelectorAll(".carousel-item");
    slides.forEach(function (slide) {
      let content = slide.querySelector(".hero-content");
      if (content) {
        content.classList.remove(
          "animate__animated",
          "animate__fadeInLeft",
          "animate__fadeInRight",
          "animate__fadeInUp"
        );
      }
    });

    let nextSlide = e.relatedTarget;
    let content = nextSlide.querySelector(".hero-content");

    if (nextSlide.classList.contains("slide-1")) {
      content.classList.add("animate__animated", "animate__fadeInLeft");
    } else if (nextSlide.classList.contains("slide-2")) {
      content.classList.add("animate__animated", "animate__fadeInUp");
    } else if (nextSlide.classList.contains("slide-3")) {
      content.classList.add("animate__animated", "animate__fadeInRight");
    }
  });

  const controlButtons = document.querySelectorAll(
    ".carousel-control-prev, .carousel-control-next"
  );
  controlButtons.forEach((button) => {
    button.addEventListener("mouseenter", function () {
      const icon = this.querySelector(
        ".carousel-control-prev-icon, .carousel-control-next-icon"
      );
      icon.style.backgroundColor = "var(--puro-red)";
    });

    button.addEventListener("mouseleave", function () {
      const icon = this.querySelector(
        ".carousel-control-prev-icon, .carousel-control-next-icon"
      );
      icon.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
    });
  });
});
