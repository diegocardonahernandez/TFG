document.addEventListener("DOMContentLoaded", function () {
  const root = document.documentElement;
  const shippingBar = document.querySelector(".shipping-info-bar");
  const navbar = document.querySelector(".navbar");

  if (shippingBar) {
    document.body.classList.add("has-shipping-bar");

    const shippingBarHeight = shippingBar.offsetHeight;
    root.style.setProperty("--shipping-bar-height", `${shippingBarHeight}px`);
  } else {
    root.style.setProperty("--shipping-bar-height", "0px");
  }

  if (navbar) {
    const navbarHeight = navbar.offsetHeight;
    root.style.setProperty("--navbar-height", `${navbarHeight}px`);
  }

  let lastScrollTop = 0;
  const shippingBarHeight = shippingBar ? shippingBar.offsetHeight : 0;

  window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
      if (shippingBar && scrollTop > 100) {
        shippingBar.style.transform = "translateY(-100%)";
        navbar.style.top = "0";
      }
    } else {
      if (shippingBar) {
        shippingBar.style.transform = "translateY(0)";
        navbar.style.top = shippingBarHeight + "px";
      }
    }

    lastScrollTop = scrollTop;
  });
});
