<link rel="stylesheet" href="/css/premiumStyle.css">
<div class="premium-section">
    <div class="premium-header">
        <div class="premium-title-container">
            <h1 class="premium-title">Beneficios <span>Premium</span></h1>
            <p class="premium-subtitle">Desbloquea todo el potencial de tu experiencia de compra</p>
        </div>
    </div>

    <div class="premium-content">
        <div class="premium-benefits-grid">
            <div class="premium-benefit-card">
                <div class="benefit-icon">
                    <i class="bi bi-tag-fill"></i>
                </div>
                <h3 class="benefit-title">Descuentos Exclusivos</h3>
                <p class="benefit-description">Accede a ofertas especiales y descuentos únicos en toda nuestra selección
                    de productos premium.</p>
                <div class="benefit-highlight">
                    <span class="highlight-value">Hasta 60%</span>
                    <span class="highlight-label">de descuento</span>
                </div>
            </div>

            <div class="premium-benefit-card">
                <div class="benefit-icon">
                    <i class="bi bi-truck"></i>
                </div>
                <h3 class="benefit-title">Entrega Express</h3>
                <p class="benefit-description">Recibe tus productos en un máximo de 24 horas con nuestro servicio de
                    entrega prioritario.</p>
                <div class="benefit-highlight">
                    <span class="highlight-value">24h</span>
                    <span class="highlight-label">entrega garantizada</span>
                </div>
            </div>

            <div class="premium-benefit-card">
                <div class="benefit-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <h3 class="benefit-title">Atención Prioritaria</h3>
                <p class="benefit-description">Accede a nuestro equipo de soporte premium con tiempos de respuesta más
                    rápidos.</p>
                <div class="benefit-highlight">
                    <span class="highlight-value">24/7</span>
                    <span class="highlight-label">soporte dedicado</span>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['userType']) && ($_SESSION['userType'] === 'Premium' || $_SESSION['userType'] === 'Administrador')): ?>
        <div class="premium-status-section">
            <div class="premium-status-card">
                <div class="status-icon">
                    <i class="bi bi-trophy-fill"></i>
                </div>
                <h2 class="status-title">¡Membresía Premium Activa!</h2>
                <p class="status-description">Ya estás disfrutando de todos los beneficios premium. Sigue aprovechando tus ventajas exclusivas.</p>
                <div class="status-highlight">
                    <span class="highlight-value">Premium</span>
                    <span class="highlight-label">Membresía activa</span>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="premium-subscription-section">
            <div class="subscription-container">
                <div class="subscription-header">
                    <h2 class="subscription-title">Únete al Club Premium</h2>
                    <p class="subscription-subtitle">Da el siguiente paso en tu transformación fitness</p>
                </div>
                
                <div class="subscription-card">
                    <div class="price-tag">
                        <div class="price-value">4.99€</div>
                        <div class="price-period">por mes</div>
                        <div class="price-savings">Ahorra hasta 60€ al mes en tus compras</div>
                    </div>

                    <div class="subscription-highlights">
                        <div class="highlight-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Garantía de satisfacción de 30 días</span>
                        </div>
                        <div class="highlight-item">
                            <i class="bi bi-credit-card"></i>
                            <span>Pago seguro y flexible</span>
                        </div>
                        <div class="highlight-item">
                            <i class="bi bi-x-circle"></i>
                            <span>Cancelación en cualquier momento</span>
                        </div>
                    </div>

                    <div class="subscription-cta">
                        <form action="/subscribe" method="post" class="subscription-form">
                            <button type="submit" class="btn-subscribe">
                                <span class="btn-text">Unirse Ahora</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                        <p class="subscription-note">
                            <i class="bi bi-lock-fill"></i>
                            Pago seguro procesado por Stripe
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="/js/animations/premium.js"></script>