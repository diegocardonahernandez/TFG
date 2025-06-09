<div class="cart-container">
    <h1 class="cart-title">Carrito de Compras</h1>

    <?php if (empty($_SESSION['cart'])): ?>
    <div class="empty-cart">
        <i class="fas fa-shopping-cart"></i>
        <p>Tu carrito está vacío</p>
        <a href="/" class="continue-shopping">Continuar comprando</a>
    </div>
    <?php else: ?>
    <div class="cart-content">
        <div class="cart-items">
            <?php foreach ($products as $product): ?>
            <?php
                    $cartItem = array_filter($_SESSION['cart'], function ($item) use ($product) {
                        return $item['id'] == $product[0]->getIdProducto();
                    });
                    $cartItem = reset($cartItem);
                    ?>
            <div class="cart-item" data-product-id="<?php echo $product[0]->getIdProducto(); ?>">
                <div class="item-image">
                    <img src="<?php echo $product[0]->getImagen(); ?>" alt="<?php echo $product[0]->getNombre(); ?>">
                </div>
                <div class="item-details">
                    <h3><?php echo $product[0]->getNombre(); ?></h3>
                    <?php if (isset($_SESSION['userType'])) {
                        if (($product[0]->getDescuento() > 0) && ($_SESSION['userType'] == "Premium" || $_SESSION['userType'] == "Administrador")) {
                            $precio = $product[0]->getPrecio() - ($product[0]->getPrecio() * $product[0]->getDescuento() / 100);
                    ?>

                    <div class="item-price discounted">
                        <span class="original-price"><?php echo number_format($product[0]->getPrecio(), 2); ?> €</span>
                        <span class="discounted-price"><?php echo number_format($precio, 2); ?> €</span>
                    </div>
                    <?php
                        } else {
                            $precio = $product[0]->getPrecio();
                        ?>
                    <p class="item-price"><?php echo number_format($precio, 2); ?> €</p>
                    <?php
                        }
                    } else {
                        $precio = $product[0]->getPrecio();
                        ?>
                    <p class="item-price"><?php echo number_format($precio, 2); ?> €</p>
                    <?php
                    } ?>
                </div>

                <div class="item-quantity">
                    <button class="quantity-btn minus btnDecrease">-</button>
                    <input type="number" id="quantity" value="<?php echo $cartItem['quantity']; ?>" min="1" max="99"
                        class="quantity-input">
                    <button class="quantity-btn plus btnIncrease">+</button>
                </div>

                <button class="remove-item" title="Eliminar producto del carrito" aria-label="Eliminar producto">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h2>Resumen del Pedido</h2>
            <div class="summary-item">
                <span>Subtotal</span>
                <span class="subtotal">0.00 €</span>
            </div>
            <div class="summary-item">
                <span>Envío</span>
                <span class="shipping">0.00 €</span>
            </div>
            <div class="summary-item total">
                <span>Total</span>
                <span class="total-amount">0.00 €</span>
            </div>
            <?php
                if (isset($_SESSION['userId'])) { ?>
            <a href="/processPayment" class="checkout-btn">Proceder al Pago</a>
            <?php } else { ?>
            <a href="/login" class="checkout-btn disabledPayment">Iniciar sesión</a>
            <p class="login-message"> <i class="bi bi-exclamation-triangle"></i> Inicie sesión para proceder al pago</p>
            <?php } ?>
        </div>
    </div>
    <?php endif; ?>
    <script src="/js/cart.js"></script>
</div>