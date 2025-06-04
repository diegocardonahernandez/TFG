<link rel="stylesheet" href="/css/paymentStyle.css">
<section class="payment-section">
    <div class="payment-container">
        <div class="payment-header">
            <h2 class="payment-title">Procesar Pago</h2>
            <p class="payment-subtitle">Complete su pago de forma segura con Stripe</p>
        </div>

        <form action="/pay" method="post" class="payment-content">
            <div class="payment-form-main">
                <div class="payment-form-right">
                    <div class="payment-summary">
                        <h3 class="payment-summary-title">Resumen del Pedido</h3>
                        <div class="payment-summary-content">
                            <div class="summary-item">
                                <span>Subtotal</span>
                                <span class="subtotal"
                                    data-amount="<?php echo $cartData['subtotal']; ?>"><?php echo number_format($cartData['subtotal'], 2); ?>
                                    €</span>
                            </div>
                            <div class="summary-item">
                                <span>Envío</span>
                                <span class="shipping"
                                    data-amount="<?php echo $cartData['shipping']; ?>"><?php echo number_format($cartData['shipping'], 2); ?>
                                    €</span>
                            </div>
                            <div class="summary-item total">
                                <span>Total</span>
                                <span class="total-amount"><?php echo number_format($cartData['total'], 2); ?> €</span>
                            </div>
                        </div>

                        <?php if ($cartData['shipping'] > 0): ?>
                        <div class="payment-info-container">
                            <div class="payment-free-shipping-info">
                                <i class="fas fa-truck"></i>
                                <p>Añade
                                    <?php echo number_format($cartData['freeShippingThreshold'] - $cartData['subtotal'], 2); ?>
                                    € más para envío gratis</p>
                            </div>
                            <div class="payment-security-info">
                                <i class="fas fa-shield-alt"></i>
                                <p>Su información está protegida con encriptación SSL de 256 bits</p>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="payment-security-info">
                            <i class="fas fa-shield-alt"></i>
                            <p>Su información está protegida con encriptación SSL de 256 bits</p>
                        </div>
                        <?php endif; ?>

                        <div class="payment-methods">
                            <img src="/imgs/visa.webp" alt="Visa" class="payment-method-icon">
                            <img src="/imgs/mastercard.webp" alt="Mastercard" class="payment-method-icon">
                            <img src="/imgs/amex.webp" alt="American Express" class="payment-method-icon">
                        </div>

                        <div class="payment-form-actions">
                            <button type="submit" class="payment-btn-process">Pagar Ahora</button>
                            <a href="/cart" class="payment-btn-cancel">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="/js/payment.js"></script>
</section>