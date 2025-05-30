<?php
require_once __DIR__ . '/../View/Partials/header.php';
require_once __DIR__ . '/../Functions/valuationProduct.php';

$availableDiscountedProducts = array_filter($discountedProducts, function ($product) {
    return $product->getStock() > 0;
});
?>

<section class="discounts-header">
    <div class="container">
        <div class="discounts-title-container">
            <h1 class="discounts-title">Ofertas Especiales</h1>
            <p class="discounts-subtitle">Aprovecha nuestras mejores ofertas y maximiza tus resultados</p>
            <div class="discounts-timer">
                <i class="bi bi-clock"></i>
                <span>Las ofertas terminan en: </span>
                <div class="countdown" id="countdown">
                    <div class="countdown-item">
                        <span class="countdown-number" id="days">00</span>
                        <span class="countdown-label">Días</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="hours">00</span>
                        <span class="countdown-label">Horas</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="minutes">00</span>
                        <span class="countdown-label">Min</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="seconds">00</span>
                        <span class="countdown-label">Seg</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="discounts-products">
    <div class="container">
        <?php if (empty($availableDiscountedProducts)): ?>
        <div class="no-discounts-found">
            <div class="no-discounts-icon">
                <i class="bi bi-tag"></i>
            </div>
            <h2>No hay ofertas disponibles en este momento</h2>
            <p>Vuelve pronto para descubrir nuestras próximas ofertas especiales.</p>
            <a href="/" class="btn-back-home">Volver al inicio</a>
        </div>
        <?php else: ?>
        <div class="row">
            <?php foreach ($availableDiscountedProducts as $index => $product): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 discount-product-item product-item"
                style="animation-delay: <?= ($index + 1) * 0.1 ?>s;">
                <div class="discount-product-card">
                    <div class="discount-badge">
                        <span class="discount-percentage">-<?= $product->getDescuento() ?>%</span>
                    </div>

                    <?php if ($product->getStock() <= 10): ?>
                    <span class="stock-badge">¡Últimas <?= $product->getStock() ?> unidades!</span>
                    <?php endif; ?>

                    <div class="discount-product-image-container">
                        <img src="<?= $product->getImagen() ?>" class="discount-product-image"
                            alt="<?= $product->getNombre() ?>">
                    </div>

                    <div class="discount-product-content">
                        <h3 class="discount-product-title"><?= $product->getNombre() ?></h3>
                        <p class="discount-product-description"><?= $product->getDescripcion() ?></p>

                        <div class="discount-price-container">
                            <span class="original-price">
                                <?= number_format($product->getPrecio(), 2) ?> €
                            </span>
                            <span class="discounted-price">
                                <?= number_format($product->getPrecio() * (1 - $product->getDescuento() / 100), 2) ?> €
                            </span>
                        </div>

                        <ul class="discount-product-meta">
                            <li class="discount-product-meta-item">
                                <span class="discount-meta-label">
                                    <i class="bi bi-box-seam"></i>
                                    Stock disponible
                                </span>
                                <span class="discount-meta-value"><?= $product->getStock() ?> unidades</span>
                            </li>
                            <li class="discount-product-meta-item">
                                <span class="discount-meta-label">
                                    <i class="bi bi-tag"></i>
                                    Categoría
                                </span>
                                <span class="discount-meta-value"><?= $product->getCategoria() ?></span>
                            </li>
                            <li class="discount-product-meta-item">
                                <span class="discount-meta-label">
                                    <i class="bi bi-star-fill"></i>
                                    Valoración
                                </span>
                                <span class="discount-meta-value"><?= productStars($product->getPopularidad()) ?></span>
                            </li>
                        </ul>

                        <div class="discount-product-actions">
                            <form action="/cart" method="post">
                                <input type="hidden" name="id" value="<?= $product->getIdProducto() ?>">
                                <button type="submit"
                                    class="btn-product btn-add-cart discount-btn-product discount-btn-add-cart">
                                    Añadir al carrito
                                </button>
                            </form>
                            <a href="/product?id=<?= $product->getIdProducto(); ?>"
                                class="btn-product btn-details discount-btn-product discount-btn-details">
                                Detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<script src="/js/discounts.js"></script>