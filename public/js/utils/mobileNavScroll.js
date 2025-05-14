document.addEventListener("DOMContentLoaded", function () {
  // Check if shipping bar exists and add class to body
  if (document.querySelector(".shipping-info-bar")) {
    document.body.classList.add("has-shipping-bar");
  }

  // For mobile: Handle dropdown functionality properly
  if (window.innerWidth < 992) {
    const dropdowns = document.querySelectorAll(".dropdown-toggle");
    dropdowns.forEach((dropdown) => {
      dropdown.addEventListener("click", function (e) {
        // Only prevent default if we're in mobile view
        if (window.innerWidth < 992) {
          e.preventDefault();
          const dropdownMenu = this.nextElementSibling;
          if (dropdownMenu.classList.contains("show")) {
            dropdownMenu.classList.remove("show");
          } else {
            // Close all other dropdowns
            document.querySelectorAll(".dropdown-menu.show").forEach((menu) => {
              menu.classList.remove("show");
            });
            // Open this dropdown
            dropdownMenu.classList.add("show");
          }
        }
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (e) {
      if (!e.target.closest(".dropdown")) {
        document.querySelectorAll(".dropdown-menu.show").forEach((menu) => {
          menu.classList.remove("show");
        });
      }
    });
  }
});
