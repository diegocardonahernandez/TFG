const cartContainer = document.querySelector(".cart-container");
const cartItems = document.querySelector(".cart-items");
const cartSummary = document.querySelector(".cart-summary");

const subtotalElement = document.querySelector(".subtotal");
const shippingElement = document.querySelector(".shipping");
const totalAmountElement = document.querySelector(".total-amount");
const checkoutButton = document.querySelector(".checkout-btn");

const cartItemElements = document.querySelectorAll(".cart-item");

const FREE_SHIPPING_THRESHOLD = 50;
const SHIPPING_COST = 3.5;

const formatPrice = (price) => {
  return price.toFixed(2) + " €";
};

const extractNumber = (priceString) => {
  return parseFloat(priceString.replace(/[^0-9.,]/g, "").replace(",", "."));
};

const getItemPrice = (priceElement) => {
  if (priceElement.classList.contains("discounted")) {
    const discountedPrice = priceElement.querySelector(".discounted-price").textContent;
    return extractNumber(discountedPrice);
  }
  return extractNumber(priceElement.textContent);
};

const calculateItemTotal = (price, quantity) => {
  return price * quantity;
};

const updateItemTotal = (element) => {
  const price = getItemPrice(element.price);
  const quantity = parseInt(element.quantityInput.value);
  const total = calculateItemTotal(price, quantity);
  element.total.textContent = formatPrice(total);
  return total;
};

const updateCartSummary = () => {
  let subtotal = 0;
  const currentElements = getCartItemElements(
    document.querySelectorAll(".cart-item")
  );

  currentElements.forEach((element) => {
    const price = getItemPrice(element.price);
    const quantity = parseInt(element.quantityInput.value);
    subtotal += calculateItemTotal(price, quantity);
  });

  if (currentElements.length === 0) {
    subtotalElement.textContent = formatPrice(0);
    shippingElement.textContent = formatPrice(0);
    totalAmountElement.textContent = formatPrice(0);
    shippingElement.style.color = "";
    shippingElement.style.fontWeight = "";
  } else {
    const shipping = subtotal >= FREE_SHIPPING_THRESHOLD ? 0 : SHIPPING_COST;
    const total = subtotal + shipping;

    subtotalElement.textContent = formatPrice(subtotal);
    shippingElement.textContent = formatPrice(shipping);
    totalAmountElement.textContent = formatPrice(total);

    if (shipping === 0) {
      shippingElement.style.color = "var(--puro-red)";
      shippingElement.style.fontWeight = "bold";
    } else {
      shippingElement.style.color = "";
      shippingElement.style.fontWeight = "";
    }
  }

  const emptyCartMessage = document.querySelector(".empty-cart");
  if (emptyCartMessage) {
    if (currentElements.length === 0) {
      emptyCartMessage.style.display = "flex";
      cartItems.style.display = "none";
      cartSummary.style.display = "none";
    } else {
      emptyCartMessage.style.display = "none";
      cartItems.style.display = "block";
      cartSummary.style.display = "block";
    }
  }
};

const getCartItemElements = (cartItemElements) => {
  return Array.from(cartItemElements).map((cartItem) => ({
    container: cartItem,
    productId: cartItem.dataset.productId,
    image: cartItem.querySelector(".item-image img"),
    name: cartItem.querySelector(".item-details h3"),
    price: cartItem.querySelector(".item-price"),
    quantityInput: cartItem.querySelector(".quantity-input"),
    decreaseBtn: cartItem.querySelector(".btnDecrease"),
    increaseBtn: cartItem.querySelector(".btnIncrease"),
    total: cartItem.querySelector(".item-total p"),
    removeBtn: cartItem.querySelector(".remove-item"),
  }));
};

const emptyCartMessage = document.querySelector(".empty-cart");
const continueShoppingBtn = document.querySelector(".continue-shopping");

const elements = getCartItemElements(cartItemElements);

updateCartSummary();

const updateQuantityOnServer = async (productId, quantity) => {
  try {
    const response = await fetch("/updateCartProduct", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        productId: productId,
        quantity: quantity,
      }),
    });

    if (!response.ok) {
      const errorData = await response.json();
      console.error("Error al actualizar la cantidad:", errorData.error);
      return false;
    }

    const data = await response.json();
    return data.success;
  } catch (error) {
    console.error("Error:", error);
    return false;
  }
};

elements.forEach((element) => {
  element.quantityInput.addEventListener("change", async () => {
    let quantity = parseInt(element.quantityInput.value);

    if (quantity < 1) quantity = 1;
    if (quantity > 99) quantity = 99;

    element.quantityInput.value = quantity;

    const success = await updateQuantityOnServer(element.productId, quantity);
    if (success) {
      updateCartSummary();
    } else {
      const currentElements = getCartItemElements(
        document.querySelectorAll(".cart-item")
      );
      const currentElement = currentElements.find(
        (el) => el.productId === element.productId
      );
      if (currentElement) {
        element.quantityInput.value = currentElement.quantityInput.value;
      }
    }
  });

  element.increaseBtn.addEventListener("click", async () => {
    const currentValue = parseInt(element.quantityInput.value);
    if (currentValue < 99) {
      const newQuantity = currentValue + 1;
      const success = await updateQuantityOnServer(
        element.productId,
        newQuantity
      );
      if (!success) return;

      element.quantityInput.value = newQuantity;
      updateCartSummary();
    }
  });

  element.decreaseBtn.addEventListener("click", async () => {
    const currentValue = parseInt(element.quantityInput.value);
    if (currentValue > 1) {
      const newQuantity = currentValue - 1;
      const success = await updateQuantityOnServer(
        element.productId,
        newQuantity
      );
      if (!success) return;

      element.quantityInput.value = newQuantity;
      updateCartSummary();
    }
  });

  element.removeBtn.addEventListener("click", async () => {
    try {
      const response = await fetch("/removeProduct", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ productId: element.productId }),
      });

      if (response.ok) {
        element.container.remove();
        updateCartSummary();
      } else {
        console.error("Error al eliminar el producto");
      }
    } catch (error) {
      console.error("Error:", error);
    }
  });
});
