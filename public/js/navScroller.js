// Archivo: navbar-script.js

document.addEventListener("DOMContentLoaded", function () {
  // Definir alturas de elementos como variables CSS
  const root = document.documentElement;
  const shippingBar = document.querySelector(".shipping-info-bar");
  const navbar = document.querySelector(".navbar");

  // Comprueba si existe la barra de información de envío
  if (shippingBar) {
    document.body.classList.add("has-shipping-bar");

    // Establecer la altura real de la barra de envío como variable CSS
    const shippingBarHeight = shippingBar.offsetHeight;
    root.style.setProperty("--shipping-bar-height", `${shippingBarHeight}px`);
  } else {
    // Si no hay barra de envío, establecer la altura a 0
    root.style.setProperty("--shipping-bar-height", "0px");
  }

  // Establecer la altura real del navbar como variable CSS
  if (navbar) {
    const navbarHeight = navbar.offsetHeight;
    root.style.setProperty("--navbar-height", `${navbarHeight}px`);
  }

  // Variables para controlar el scroll
  let lastScrollTop = 0;
  const shippingBarHeight = shippingBar ? shippingBar.offsetHeight : 0;

  // Función para manejar el scroll
  window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // Determinar dirección del scroll
    if (scrollTop > lastScrollTop) {
      // Scroll hacia abajo - opcionalmente puedes ocultar la barra de información
      if (shippingBar && scrollTop > 100) {
        shippingBar.style.transform = "translateY(-100%)";
        navbar.style.top = "0";
      }
    } else {
      // Scroll hacia arriba - mostrar todo
      if (shippingBar) {
        shippingBar.style.transform = "translateY(0)";
        navbar.style.top = shippingBarHeight + "px";
      }
    }

    lastScrollTop = scrollTop;
  });
});
