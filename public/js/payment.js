document.addEventListener("DOMContentLoaded", function () {
  const subtotalElement = document.querySelector(".subtotal");
  const shippingElement = document.querySelector(".shipping");
  const totalElement = document.querySelector(".total-amount");

  const formatPrice = (price) => {
    return price.toFixed(2) + " €";
  };

  const updatePaymentSummary = () => {
    const subtotal = parseFloat(subtotalElement.dataset.amount || 0);
    const shipping = parseFloat(shippingElement.dataset.amount || 0);
    const total = subtotal + shipping;

    subtotalElement.textContent = formatPrice(subtotal);
    shippingElement.textContent = formatPrice(shipping);
    totalElement.textContent = formatPrice(total);

    if (shipping === 0) {
      shippingElement.style.color = "var(--puro-red)";
      shippingElement.style.fontWeight = "bold";
    } else {
      shippingElement.style.color = "";
      shippingElement.style.fontWeight = "";
    }
  };

  updatePaymentSummary();
});
