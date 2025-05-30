if (document.querySelector(".cart-container")) {
  const decreaseButtons = document.querySelectorAll(".btnDecrease");
  const increaseButtons = document.querySelectorAll(".btnIncrease");

  decreaseButtons.forEach((decreaseBtn, index) => {
    const quantityInput = decreaseBtn.parentElement.querySelector(
      'input[type="number"]'
    );

    decreaseBtn.addEventListener("click", () => {
      if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    });
  });

  increaseButtons.forEach((increaseBtn, index) => {
    const quantityInput = increaseBtn.parentElement.querySelector(
      'input[type="number"]'
    );

    increaseBtn.addEventListener("click", () => {
      quantityInput.value = parseInt(quantityInput.value) + 1;
    });
  });
} else {
  const quantityElem = document.getElementById("quantity");
  const decreaseElem = document.querySelector(".btnDecrease");
  const increaseElem = document.querySelector(".btnIncrease");

  decreaseElem.addEventListener("click", () => {
    if (quantityElem.value > 1) {
      quantityElem.value = parseInt(quantityElem.value) - 1;
    }
  });

  increaseElem.addEventListener("click", () => {
    quantityElem.value = parseInt(quantityElem.value) + 1;
  });
}
