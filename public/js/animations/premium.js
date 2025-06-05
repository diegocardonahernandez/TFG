document.addEventListener("DOMContentLoaded", function () {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    {
      threshold: 0.1,
    }
  );

  document.querySelectorAll(".premium-benefit-card").forEach((card) => {
    observer.observe(card);
  });

  const ctaContainer = document.querySelector(".premium-cta-container");
  if (ctaContainer) {
    observer.observe(ctaContainer);
  }

  const premiumButton = document.querySelector(".btn-premium");
  if (premiumButton) {
    premiumButton.addEventListener("mouseenter", () => {
      premiumButton.style.transform = "translateY(-3px)";
    });

    premiumButton.addEventListener("mouseleave", () => {
      premiumButton.style.transform = "translateY(0)";
    });
  }

  document.querySelectorAll(".benefit-icon").forEach((icon) => {
    icon.addEventListener("mouseenter", () => {
      icon.classList.add("pulse");
    });

    icon.addEventListener("mouseleave", () => {
      icon.classList.remove("pulse");
    });
  });

  const ctaContent = document.querySelector(".premium-cta-content");
  if (ctaContent) {
    ctaContent.addEventListener("mouseenter", () => {
      ctaContent.classList.add("shimmer");
    });

    ctaContent.addEventListener("mouseleave", () => {
      ctaContent.classList.remove("shimmer");
    });
  }
});
