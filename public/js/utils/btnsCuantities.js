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
