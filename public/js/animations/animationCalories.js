document.addEventListener("DOMContentLoaded", function () {
  const title = document.querySelector(".calorie-title");
  const titleText = title.textContent;
  title.innerHTML = `<span>${titleText}</span>`;

  const productCards = document.querySelectorAll(".calorie-product-card");
  productCards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px) scale(1.03)";
      this.style.boxShadow = "0 10px 20px rgba(0,0,0,0.1)";
    });

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)";
      this.style.boxShadow = "0 2px 10px rgba(0,0,0,0.05)";
    });
  });

  const buttons = document.querySelectorAll(
    ".calorie-btn-calculate, .calorie-product-btn"
  );
  buttons.forEach((button) => {
    button.addEventListener("mouseenter", function () {
      this.style.letterSpacing = "0.7px";
    });

    button.addEventListener("mouseleave", function () {
      this.style.letterSpacing = "normal";
    });
  });

  function animateOnScroll() {
    const elements = document.querySelectorAll(
      ".calorie-calculator-card, .calorie-results-card, .calorie-info-card, .calorie-products-suggestion"
    );

    elements.forEach((el) => {
      const elementTop = el.getBoundingClientRect().top;
      const elementVisible = 150;

      if (elementTop < window.innerHeight - elementVisible) {
        el.classList.add("visible");
      }
    });
  }

  const scrollStyle = document.createElement("style");
  scrollStyle.innerHTML = `
        .calorie-calculator-card, .calorie-results-card, .calorie-info-card, .calorie-products-suggestion {
          opacity: 0;
          transform: translateY(20px);
          transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .calorie-calculator-card.visible, .calorie-results-card.visible, .calorie-info-card.visible, .calorie-products-suggestion.visible {
          opacity: 1;
          transform: translateY(0);
        }
      `;
  document.head.appendChild(scrollStyle);

  window.addEventListener("scroll", animateOnScroll);

  animateOnScroll();

  const formGroups = document.querySelectorAll(".calorie-form-group");
  formGroups.forEach((group) => {
    const input = group.querySelector("input, select");
    if (input) {
      input.addEventListener("focus", function () {
        group.classList.add("active-field");
      });

      input.addEventListener("blur", function () {
        group.classList.remove("active-field");
      });
    }
  });

  const formStyle = document.createElement("style");
  formStyle.innerHTML = `
        .active-field::before {
          content: "";
          position: absolute;
          left: -15px;
          top: 0;
          width: 5px;
          height: 100%;
          background: var(--puro-red);
          transition: all 0.3s ease;
        }
      `;
  document.head.appendChild(formStyle);

  const macroItems = document.querySelectorAll(
    ".calorie-macro-item, .calorie-info-macro-item"
  );
  macroItems.forEach((item) => {
    item.addEventListener("mouseenter", function () {
      const icon = this.querySelector("i");
      if (icon) {
        icon.style.transform = "rotate(15deg) scale(1.2)";
      }
      this.style.transform = item.classList.contains("calorie-macro-item")
        ? "translateX(5px)"
        : "translateY(-5px)";
      this.style.boxShadow = "0 4px 12px rgba(0, 0, 0, 0.1)";
    });

    item.addEventListener("mouseleave", function () {
      const icon = this.querySelector("i");
      if (icon) {
        icon.style.transform = "rotate(0) scale(1)";
      }
      this.style.transform = "translate(0)";
      this.style.boxShadow = "none";
    });
  });

  const goalOptions = document.querySelectorAll(
    ".calorie-goal-option input[type='radio']"
  );
  goalOptions.forEach((option) => {
    option.addEventListener("change", function () {
      if (this.checked) {
        const icon = this.nextElementSibling.querySelector("i");
        if (icon) {
          icon.style.animation = "pulse 1s infinite";
        }

        const label = this.nextElementSibling;
        label.style.transform = "translateY(-5px)";
        setTimeout(() => {
          label.style.transform = "translateY(0)";
        }, 300);
      }
    });
  });

  const rippleButtons = document.querySelectorAll(
    ".calorie-btn-calculate, .calorie-product-btn"
  );
  rippleButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      const ripple = document.createElement("span");
      ripple.classList.add("calorie-ripple");
      this.appendChild(ripple);

      const x = e.clientX - this.getBoundingClientRect().left;
      const y = e.clientY - this.getBoundingClientRect().top;

      ripple.style.left = `${x}px`;
      ripple.style.top = `${y}px`;

      setTimeout(() => {
        ripple.remove();
      }, 600);
    });
  });

  const rippleStyle = document.createElement("style");
  rippleStyle.innerHTML = `
        .calorie-btn-calculate, .calorie-product-btn {
          position: relative;
          overflow: hidden;
        }
        
        .calorie-ripple {
          position: absolute;
          background: rgba(255, 255, 255, 0.5);
          border-radius: 50%;
          transform: scale(0);
          animation: ripple 0.6s linear;
          pointer-events: none;
        }
        
        @keyframes ripple {
          to {
            transform: scale(4);
            opacity: 0;
          }
        }
      `;
  document.head.appendChild(rippleStyle);
});
