<div class="confirmation-section">
    <div class="confirmation-container">
        <div class="confirmation-content">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="confirmation-title">¡Pago Procesado con Éxito!</h1>
            <p class="confirmation-message">
                Gracias por tu compra. Tu pedido ha sido procesado correctamente.
            </p>
            <div class="confirmation-details">
                <div class="detail-item">
                    <span class="detail-label">Número de Pedido:</span>
                    <span class="detail-value">#<?php echo substr($paymentData['orderId'], 0, 8); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">ID de Pago:</span>
                    <span class="detail-value"><?php echo $paymentData['paymentId']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Importe:</span>
                    <span class="detail-value"><?php echo number_format($paymentData['amount'], 2); ?>
                        <?php echo $paymentData['currency']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Fecha:</span>
                    <span class="detail-value"><?php echo $paymentData['date']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Método de Pago:</span>
                    <span class="detail-value"><?php echo ucfirst($paymentData['paymentMethod']); ?></span>
                </div>
            </div>
            <div class="confirmation-actions">
                <a href="/" class="btn-home">
                    <i class="fas fa-home"></i>
                    Volver al Inicio
                </a>
                <a href="/mis-pedidos" class="btn-orders">
                    <i class="fas fa-shopping-bag"></i>
                    Ver Mis Pedidos
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.confirmation-section {
    padding: 4rem 0;
    background-color: var(--puro-light-gray);
    min-height: calc(100vh - 150px);
}

.confirmation-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.confirmation-content {
    background-color: var(--puro-white);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    padding: 3rem;
    text-align: center;
    animation: fadeIn 0.5s ease-out forwards;
}

.confirmation-icon {
    font-size: 4rem;
    color: var(--puro-success);
    margin-bottom: 1.5rem;
    animation: scaleIn 0.5s ease-out forwards;
}

.confirmation-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--puro-black);
    margin-bottom: 1rem;
}

.confirmation-message {
    font-size: 1.1rem;
    color: var(--puro-gray);
    margin-bottom: 2rem;
}

.confirmation-details {
    background-color: var(--puro-light-gray);
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    text-align: left;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--puro-border-gray);
}

.detail-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: var(--puro-black);
}

.detail-value {
    color: var(--puro-gray);
}

.status-succeeded {
    color: var(--puro-success);
    font-weight: 600;
}

.status-processing {
    color: var(--puro-warning);
    font-weight: 600;
}

.status-requires_payment_method,
.status-requires_confirmation,
.status-requires_action {
    color: var(--puro-warning);
    font-weight: 600;
}

.status-canceled {
    color: var(--puro-danger);
    font-weight: 600;
}

.confirmation-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-home,
.btn-orders {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition-standard);
}

.btn-home {
    background-color: var(--puro-red);
    color: var(--puro-white);
}

.btn-home:hover {
    background-color: var(--puro-red-hover);
    transform: translateY(-2px);
}

.btn-orders {
    background-color: transparent;
    color: var(--puro-black);
    border: 1px solid var(--puro-border-gray);
}

.btn-orders:hover {
    background-color: var(--puro-black);
    color: var(--puro-white);
    border-color: var(--puro-black);
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }

    to {
        transform: scale(1);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .confirmation-content {
        padding: 2rem;
    }

    .confirmation-title {
        font-size: 1.8rem;
    }

    .confirmation-actions {
        flex-direction: column;
    }

    .btn-home,
    .btn-orders {
        width: 100%;
        justify-content: center;
    }
}

@media (prefers-color-scheme: dark) {
    .confirmation-content {
        background-color: var(--puro-white);
    }

    .confirmation-details {
        background-color: #2a2a2a;
    }
}
</style>