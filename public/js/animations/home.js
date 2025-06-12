document.addEventListener("DOMContentLoaded", function () {
  var myCarousel = document.getElementById("carouselExampleCaptions");

  function resetAnimations() {
    let slides = document.querySelectorAll(".carousel-item");
    slides.forEach(function (slide) {
      let title = slide.querySelector(".hero-title");
      let subtitle = slide.querySelector(".hero-subtitle");
      let cta = slide.querySelector(".hero-cta");

      if (title) {
        title.style.animation = "none";
        title.style.opacity = "0";
        title.style.transform = "translateX(-100px) scale(0.8)";
        title.style.whiteSpace = "normal";
        title.style.overflow = "visible";
        title.style.borderRight = "none";
      }

      if (subtitle) {
        subtitle.style.animation = "none";
        subtitle.style.opacity = "0";
        subtitle.style.transform = "translateY(30px)";
      }

      if (cta) {
        cta.style.animation = "none";
        cta.style.opacity = "0";
        cta.style.transform = "translateY(40px) scale(0.9)";
        const buttons = cta.querySelectorAll(".btn");
        buttons.forEach((btn) => {
          btn.style.animation = "none";
          btn.style.opacity = "1";
          btn.style.transform = "none";
        });
      }
    });
  }

  function applyAnimations(activeSlide) {
    const title = activeSlide.querySelector(".hero-title");
    const subtitle = activeSlide.querySelector(".hero-subtitle");
    const cta = activeSlide.querySelector(".hero-cta");
    const isMobile = window.innerWidth <= 768;
    const isSmallMobile = window.innerWidth <= 576;

    setTimeout(() => {
      if (activeSlide.classList.contains("slide-1")) {
        if (title) {
          title.style.animation = isMobile
            ? "titleSlideInLeft 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards"
            : "titleSlideInLeft 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards";
          title.style.animationDelay = "0.3s";
        }
        if (subtitle) {
          subtitle.style.animation = isMobile
            ? "subtitleFadeIn 0.8s ease-out forwards"
            : "subtitleFadeIn 1s ease-out forwards";
          subtitle.style.animationDelay = "0.8s";
        }
        if (cta) {
          cta.style.animation = isMobile
            ? "buttonsSlideUp 0.8s ease-out forwards"
            : "buttonsSlideUp 1s ease-out forwards";
          cta.style.animationDelay = "1.2s";
        }
      } else if (activeSlide.classList.contains("slide-2")) {
        if (title) {
          title.style.animation = isMobile
            ? "titleSlideInUp 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards"
            : "titleSlideInUp 1.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards";
          title.style.animationDelay = "0.2s";
          title.style.whiteSpace = "normal";
          title.style.overflow = "visible";
          title.style.borderRight = "none";
        }
        if (subtitle) {
          subtitle.style.animation = isMobile
            ? "subtitleFadeIn 0.8s ease-out forwards"
            : "subtitleFadeIn 1s ease-out forwards";
          subtitle.style.animationDelay = "0.9s";
        }
        if (cta) {
          cta.style.animation = isMobile
            ? "buttonsSlideUp 0.8s ease-out forwards"
            : "buttonsSlideUp 1s ease-out forwards";
          cta.style.animationDelay = "1.3s";
        }
      } else if (activeSlide.classList.contains("slide-3")) {
        if (title) {
          title.style.animation = isMobile
            ? "titleSlideInRight 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards"
            : "titleSlideInRight 1.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards";
          title.style.animationDelay = "0.25s";
          title.style.transformOrigin = "right center";
        }
        if (subtitle) {
          subtitle.style.animation = isMobile
            ? "subtitleFadeIn 0.8s ease-out forwards"
            : "subtitleFadeIn 1s ease-out forwards";
          subtitle.style.animationDelay = "0.85s";
        }
        if (cta) {
          cta.style.animation = isMobile
            ? "buttonsSlideUp 0.8s ease-out forwards"
            : "buttonsSlideUp 1s ease-out forwards";
          cta.style.animationDelay = "1.25s";
        }
      }
    }, 100);
  }

  const firstSlide = document.querySelector(".carousel-item.active");
  if (firstSlide) {
    setTimeout(() => {
      applyAnimations(firstSlide);
    }, 500);
  }

  myCarousel.addEventListener("slide.bs.carousel", function (e) {
    resetAnimations();
    let nextSlide = e.relatedTarget;
    applyAnimations(nextSlide);
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
      icon.style.transform = "scale(1.1)";
      icon.style.transition = "all 0.3s ease";
    });

    button.addEventListener("mouseleave", function () {
      const icon = this.querySelector(
        ".carousel-control-prev-icon, .carousel-control-next-icon"
      );
      icon.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
      icon.style.transform = "scale(1)";
    });
  });

  window.addEventListener("scroll", function () {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector(".carousel");
    if (parallax) {
      const speed = scrolled * 0.3;
      parallax.style.transform = `translateY(${speed}px)`;
    }
  });

  myCarousel.addEventListener("mouseenter", function () {
    this.style.animationPlayState = "paused";
  });

  myCarousel.addEventListener("mouseleave", function () {
    this.style.animationPlayState = "running";
  });

  const ctaButtons = document.querySelectorAll(".hero-cta .btn");
  ctaButtons.forEach((button) => {
    button.addEventListener("mouseenter", function () {
      this.style.animation = "pulse 0.6s ease-in-out";
    });

    button.addEventListener("animationend", function () {
      this.style.animation = "";
    });
  });

  if ("ontouchstart" in window) {
    myCarousel.addEventListener("touchstart", function () {
      const style = document.createElement("style");
      style.textContent = `
        .hero-title, .hero-subtitle, .hero-cta {
          animation-duration: 0.8s !important;
        }
        .hero-title {
          white-space: normal !important;
          overflow: visible !important;
          border-right: none !important;
        }
        .hero-cta {
          flex-direction: column !important;
          align-items: center !important;
          gap: 0.8rem !important;
          width: 100% !important;
        }
        .hero-cta .btn {
          width: 100% !important;
          max-width: 280px !important;
        }
      `;
      document.head.appendChild(style);
    });
  }

  window.addEventListener("resize", function () {
    const activeSlide = document.querySelector(".carousel-item.active");
    if (activeSlide) {
      resetAnimations();
      applyAnimations(activeSlide);
    }
  });
});
