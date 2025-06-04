<section class="pdv-product-header">
    <div class="container">
        <div class="pdv-title-container">
            <h1 class="pdv-title"><?= $details[0]->getNombre() ?></h1>
            <div class="pdv-rating">
                <?= productStars($details[0]->getPopularidad()) ?>
            </div>
        </div>
    </div>
</section>

<section class="pdv-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="pdv-gallery">
                    <div class="pdv-main-image-wrapper">
                        <?php if ($details[0]->getStock() <= 10 && $details[0]->getStock() > 0): ?>
                            <span class="pdv-badge pdv-stock-alert">¡Últimas unidades!</span>
                        <?php endif; ?>

                        <img src="<?= $details[0]->getImagen() ?>" class="pdv-main-image"
                            alt="<?= $details[0]->getNombre() ?>">
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="pdv-info-panel">
                    <div class="pdv-top-info">
                        <div class="pdv-category-wrapper">
                            <a href="/category?name=<?= urlencode($details[0]->getCategoria()) ?>"
                                class="pdv-category-link">
                                <?= $details[0]->getCategoria() ?>
                            </a>
                        </div>

                        <div class="pdv-price-display">
                            <span class="pdv-current-price"><?= $details[0]->getPrecio() ?> €</span>
                        </div>
                    </div>

                    <div class="pdv-desc-block">
                        <h3>Descripción</h3>
                        <p><?= $details[0]->getDescripcion() ?></p>
                    </div>

                    <div class="pdv-meta-info">
                        <ul class="pdv-meta-list">
                            <li class="pdv-meta-list-item">
                                <span class="pdv-meta-tag">Disponibilidad</span>
                                <span
                                    class="pdv-meta-content <?= ($details[0]->getStock() > 0 && $details[0]->getEstado() !== 'agotado') ? 'pdv-available' : 'pdv-unavailable' ?>">
                                    <?= ($details[0]->getStock() > 0 && $details[0]->getEstado() !== 'agotado') ? 'En stock' : 'Agotado' ?>
                                </span>
                            </li>
                            <li class="pdv-meta-list-item">
                                <span class="pdv-meta-tag">Código del producto</span>
                                <span class="pdv-meta-content">PUR-<?= $details[0]->getIdProducto() ?></span>
                            </li>
                            <li class="pdv-meta-list-item">
                                <span class="pdv-meta-tag">Fecha de lanzamiento</span>
                                <span
                                    class="pdv-meta-content"><?= date('d/m/Y', strtotime($details[0]->getFechaCreacion())) ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="pdv-purchase-section">
                        <?php if ($details[0]->getStock() > 0 && $details[0]->getEstado() !== 'agotado'): ?>
                            <div class="pdv-purchase-controls">
                                <form action="/cart" method="post" class="pdv-cart-form">
                                    <input type="hidden" name="id" value="<?= $details[0]->getIdProducto() ?>">
                                    <button type="submit" class="pdv-action-btn pdv-add-to-cart">
                                        <i class="fas fa-shopping-cart"></i> Añadir al carrito
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="pdv-out-of-stock">
                                <p>Actualmente este producto está agotado</p>
                                <button class="pdv-action-btn pdv-notify-me"
                                    data-product="<?= $details[0]->getIdProducto() ?>">
                                    <i class="fas fa-bell"></i> Notificarme cuando esté disponible
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pdv-info-tabs">
    <div class="container">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                    type="button" role="tab" aria-controls="details" aria-selected="true">
                    Detalles técnicos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button"
                    role="tab" aria-controls="reviews" aria-selected="false">
                    Opiniones
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button"
                    role="tab" aria-controls="shipping" aria-selected="false">
                    Envío y devoluciones
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty" type="button"
                    role="tab" aria-controls="warranty" aria-selected="false">
                    Garantía
                </button>
            </li>
        </ul>

        <div class="tab-content" id="productTabsContent">
            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                <div class="pdv-tab-inner">
                    <h3>Especificaciones del producto</h3>
                    <p><?= $details[0]->getDetallesProducto() ?></p><br>
                    <div class="pdv-specs">
                        <span class="pdv-spec-title">Información general de calidad</span>
                        <p>Este producto ha sido diseñado para ofrecer el máximo rendimiento y durabilidad. Fabricado
                            con materiales de alta calidad que garantizan una experiencia de uso superior. Todos
                            nuestros productos cumplen con los más estrictos estándares de calidad y pasan por rigurosos
                            controles antes de llegar a nuestros clientes.</p>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="pdv-tab-inner">
                    <h3>Opiniones de clientes</h3>
                    <div class="pdv-reviews-overview">
                        <div class="pdv-rating-summary">
                            <span
                                class="pdv-rating-number"><?= number_format($details[0]->getPopularidad(), 1) ?></span>
                            <div class="pdv-rating-stars">
                                <?= productStars($details[0]->getPopularidad()) ?>
                            </div>
                            <span class="pdv-rating-total">Basado en 24 opiniones</span>
                        </div>
                        <div class="pdv-customer-reviews">
                            <p>Sé el primero en dejar tu opinión sobre este producto.</p>
                            <button class="pdv-write-review">Escribir una opinión</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                <div class="pdv-tab-inner">
                    <div class="pdv-info-columns">
                        <div class="pdv-info-col">
                            <h3>Información de envío</h3>
                            <ul class="pdv-shipping-list">
                                <li><strong>Envío estándar:</strong> 24-48 horas (península)</li>
                                <li><strong>Envío express:</strong> Entrega en 24h para pedidos antes de las 14:00</li>
                                <li><strong>Envío internacional:</strong> 3-5 días laborables</li>
                                <li><strong>Envío gratuito:</strong> En pedidos superiores a 50€</li>
                            </ul>
                        </div>
                        <div class="pdv-info-col">
                            <h3>Política de devoluciones</h3>
                            <p>Tienes 30 días desde la recepción del pedido para devolver cualquier producto que no haya
                                sido
                                utilizado y conserve su embalaje original.</p>
                            <p>Las devoluciones son gratuitas a través de nuestro servicio de mensajería. Para iniciar
                                una
                                devolución, accede a tu cuenta y selecciona el pedido correspondiente.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="warranty" role="tabpanel" aria-labelledby="warranty-tab">
                <div class="pdv-tab-inner">
                    <h3>Garantía de producto</h3>
                    <p>Todos nuestros productos cuentan con una garantía de fabricación de 2 años, cumpliendo con la
                        normativa europea.</p>
                    <div class="pdv-warranty-info">
                        <div class="pdv-info-columns">
                            <div class="pdv-info-col">
                                <h4>¿Qué cubre la garantía?</h4>
                                <ul class="pdv-shipping-list">
                                    <li>Defectos de fabricación</li>
                                    <li>Mal funcionamiento no causado por el uso indebido</li>
                                    <li>Piezas y componentes defectuosos</li>
                                </ul>
                            </div>
                            <div class="pdv-info-col">
                                <h4>Procedimiento de garantía</h4>
                                <p>Para hacer uso de la garantía, contacta con nuestro servicio de atención al cliente a
                                    través
                                    del formulario en la sección de "Contacto" o llamando al teléfono de atención al
                                    cliente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>