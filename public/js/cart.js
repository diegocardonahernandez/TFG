// Selección de elementos principales del carrito
const cartContainer = document.querySelector(".cart-container");
const cartItems = document.querySelector(".cart-items");
const cartSummary = document.querySelector(".cart-summary");

// Elementos del resumen del carrito
const subtotalElement = document.querySelector(".subtotal");
const shippingElement = document.querySelector(".shipping");
const totalAmountElement = document.querySelector(".total-amount");
const checkoutButton = document.querySelector(".checkout-btn");

// Selección de todos los items del carrito
const cartItemElements = document.querySelectorAll(".cart-item");

// Constantes para el cálculo
const FREE_SHIPPING_THRESHOLD = 50;
const SHIPPING_COST = 3.5;

// Función para formatear precios
const formatPrice = (price) => {
  return price.toFixed(2) + " €";
};

// Función para extraer el número de un string con formato de precio (ej: "123.45 €")
const extractNumber = (priceString) => {
  return parseFloat(priceString.replace(/[^0-9.,]/g, "").replace(",", "."));
};

// Función para obtener el precio actual del item (normal o con descuento)
const getItemPrice = (priceElement) => {
  // Si tiene descuento, tomar el precio con descuento
  if (priceElement.classList.contains("discounted")) {
    const discountedPrice =
      priceElement.querySelector(".discounted-price").textContent;
    return extractNumber(discountedPrice);
  }
  // Si no tiene descuento, tomar el precio normal
  return extractNumber(priceElement.textContent);
};

// Función para calcular el total de un item
const calculateItemTotal = (price, quantity) => {
  return price * quantity;
};

// Función para actualizar el total de un item
const updateItemTotal = (element) => {
  const price = getItemPrice(element.price);
  const quantity = parseInt(element.quantityInput.value);
  const total = calculateItemTotal(price, quantity);
  element.total.textContent = formatPrice(total);
  return total;
};

// Función para actualizar el resumen del carrito
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

  // Si no hay elementos, establecer todos los valores a 0
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

    // Actualizar estilo del envío gratuito
    if (shipping === 0) {
      shippingElement.style.color = "var(--puro-red)";
      shippingElement.style.fontWeight = "bold";
    } else {
      shippingElement.style.color = "";
      shippingElement.style.fontWeight = "";
    }
  }

  // Mostrar/ocultar mensaje de carrito vacío
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

// Funciones para seleccionar elementos específicos de cada item del carrito
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

// Selección del mensaje de carrito vacío
const emptyCartMessage = document.querySelector(".empty-cart");
const continueShoppingBtn = document.querySelector(".continue-shopping");

const elements = getCartItemElements(cartItemElements);

// Inicializar los totales
updateCartSummary();

// Función para actualizar la cantidad en el servidor
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

// Event listeners para los botones de cantidad
elements.forEach((element) => {
  // Event listener para el input de cantidad
  element.quantityInput.addEventListener("change", async () => {
    let quantity = parseInt(element.quantityInput.value);

    // Validar límites
    if (quantity < 1) quantity = 1;
    if (quantity > 99) quantity = 99;

    element.quantityInput.value = quantity;

    const success = await updateQuantityOnServer(element.productId, quantity);
    if (success) {
      updateCartSummary();
    } else {
      // Revertir cambios si hay error
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

  // Event listener para el botón de aumentar
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

  // Event listener para el botón de disminuir
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

  // Event listener para el botón de eliminar
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
