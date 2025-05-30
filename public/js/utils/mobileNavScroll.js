document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector(".shipping-info-bar")) {
    document.body.classList.add("has-shipping-bar");
  }

  if (window.innerWidth < 992) {
    const dropdowns = document.querySelectorAll(".dropdown-toggle");
    dropdowns.forEach((dropdown) => {
      dropdown.addEventListener("click", function (e) {
        if (window.innerWidth < 992) {
          e.preventDefault();
          const dropdownMenu = this.nextElementSibling;
          if (dropdownMenu.classList.contains("show")) {
            dropdownMenu.classList.remove("show");
          } else {
            document.querySelectorAll(".dropdown-menu.show").forEach((menu) => {
              menu.classList.remove("show");
            });
            dropdownMenu.classList.add("show");
          }
        }
      });
    });

    document.addEventListener("click", function (e) {
      if (!e.target.closest(".dropdown")) {
        document.querySelectorAll(".dropdown-menu.show").forEach((menu) => {
          menu.classList.remove("show");
        });
      }
    });
  }
});
