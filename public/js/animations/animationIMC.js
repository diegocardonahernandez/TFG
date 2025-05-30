document.addEventListener("DOMContentLoaded", function () {
  const title = document.querySelector(".imc-title");
  const titleText = title.textContent;
  title.innerHTML = `<span>${titleText}</span>`;

  const scaleSegments = document.querySelectorAll(".imc-scale-segment");

  scaleSegments.forEach((segment) => {
    segment.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-3px)";
      this.style.boxShadow = "0 5px 10px rgba(0,0,0,0.1)";
    });

    segment.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
      this.style.boxShadow = "none";
    });
  });

  const consultationBanner = document.querySelector(".imc-consultation-banner");

  if (consultationBanner) {
    for (let i = 0; i < 10; i++) {
      const particle = document.createElement("div");
      particle.className = "imc-particle";
      particle.style.position = "absolute";
      particle.style.width = `${Math.random() * 5 + 3}px`;
      particle.style.height = particle.style.width;
      particle.style.background = "rgba(255, 255, 255, 0.5)";
      particle.style.borderRadius = "50%";
      particle.style.top = `${Math.random() * 100}%`;
      particle.style.left = `${Math.random() * 100}%`;
      particle.style.opacity = `${Math.random() * 0.5 + 0.2}`;

      particle.style.animation = `float ${
        Math.random() * 5 + 3
      }s ease-in-out infinite alternate`;

      const keyframes = `
                @keyframes float {
                    0% {
                        transform: translate(0, 0) rotate(0deg);
                        opacity: ${Math.random() * 0.5 + 0.2};
                    }
                    100% {
                        transform: translate(${Math.random() * 20 - 10}px, ${
        Math.random() * 20 - 10
      }px) rotate(${Math.random() * 360}deg);
                        opacity: ${Math.random() * 0.3 + 0.7};
                    }
                }
            `;

      const styleElement = document.createElement("style");
      styleElement.innerHTML = keyframes;
      document.head.appendChild(styleElement);

      consultationBanner.appendChild(particle);
    }
  }

  const consultationBtn = document.querySelector(".imc-consultation-btn");

  if (consultationBtn) {
    consultationBtn.addEventListener("mouseenter", function () {
      this.style.letterSpacing = "1px";
    });

    consultationBtn.addEventListener("mouseleave", function () {
      this.style.letterSpacing = "normal";
    });
  }

  const calculateBtn = document.querySelector(".imc-btn-calculate");

  if (calculateBtn) {
    calculateBtn.addEventListener("mouseenter", function () {
      this.style.letterSpacing = "1px";
    });

    calculateBtn.addEventListener("mouseleave", function () {
      this.style.letterSpacing = "normal";
    });
  }

  function animateOnScroll() {
    const elements = document.querySelectorAll(
      ".imc-calculator-card, .imc-results-card, .imc-consultation-banner, .imc-info-card"
    );

    elements.forEach((el) => {
      const elementTop = el.getBoundingClientRect().top;
      const elementVisible = 150;

      if (elementTop < window.innerHeight - elementVisible) {
        el.classList.add("visible");
      }
    });
  }

  const style = document.createElement("style");
  style.innerHTML = `
        .imc-calculator-card, .imc-results-card, .imc-consultation-banner, .imc-info-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .imc-calculator-card.visible, .imc-results-card.visible, .imc-consultation-banner.visible, .imc-info-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
    `;
  document.head.appendChild(style);

  window.addEventListener("scroll", animateOnScroll);

  animateOnScroll();

  const imcCalculatorForm = document.getElementById("imcCalculatorForm");

  if (imcCalculatorForm) {
    imcCalculatorForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const imcValue = document.getElementById("imcValue");
      const finalValue = parseFloat(imcValue.textContent || "0");

      function animateCounter(finalValue) {
        let startValue = 0;
        const duration = 1500;
        const frameDuration = 1000 / 60;
        const totalFrames = Math.round(duration / frameDuration);
        const increment = (finalValue - startValue) / totalFrames;

        let currentValue = 0;
        let frame = 0;

        const counter = setInterval(() => {
          frame++;
          currentValue = startValue + increment * frame;

          if (frame === totalFrames) {
            clearInterval(counter);
            imcValue.textContent = finalValue.toFixed(1);
          } else {
            imcValue.textContent = currentValue.toFixed(1);
          }
        }, frameDuration);
      }

      const resultsContainer = document.getElementById("imcResultsContainer");
      const initialState = document.getElementById("imcInitialState");

      if (resultsContainer && initialState) {
        initialState.style.display = "none";
        resultsContainer.style.display = "block";

        animateCounter(finalValue);
      }
    });
  }
});
