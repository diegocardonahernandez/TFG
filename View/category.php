<!-- Encabezado de la categoría -->
<section class="category-header">
    <div class="container">
        <div class="category-title-container">
            <h1 class="category-title"><?= $category ?></h1>
            <p class="category-subtitle">Descubre nuestra selección de productos para potenciar tu rendimiento</p>
        </div>
    </div>
</section>

<!-- Sección de productos por categoría -->
<section class="category-products">
    <div class="container">
        <?php if (empty($products)): ?>
            <div class="no-products-found">
                <div class="no-products-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h2>No hay productos disponibles en esta categoría</h2>
                <p>Estamos trabajando para añadir nuevos productos. Vuelve pronto.</p>
                <a href="/" class="btn-back-home">Volver al inicio</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 product-item">
                        <div class="product-card">

                            <?php if ($product->getStock() <= 10 && $product->getStock() > 0): ?>
                                <span class="product-badge stock-badge">¡Últimas unidades!</span>
                            <?php endif; ?>

                            <div class="product-image-container">
                                <img src="<?= $product->getImagen() ?>" class="product-image" alt="<?= $product->getNombre() ?>">
                            </div>

                            <div class="product-content">
                                <h3 class="product-title"><?= $product->getNombre() ?></h3>
                                <p class="product-description"><?= $product->getDescripcion() ?></p>

                                <ul class="product-meta">
                                    <li class="product-meta-item">
                                        <span class="meta-label">Precio</span>
                                        <span class="meta-value"><?= $product->getPrecio() ?> €</span>
                                    </li>
                                    <li class="product-meta-item">
                                        <span class="meta-label">Disponibilidad</span>
                                        <span class="meta-value"><?= $product->getStock() > 0 ? 'En stock' : 'Agotado' ?></span>
                                    </li>
                                    <li class="product-meta-item">
                                        <span class="meta-label">Categoría</span>
                                        <span class="meta-value"><?= $product->getCategoria() ?></span>
                                    </li>
                                    <li class="product-meta-item">
                                        <span class="meta-label">Valoración</span>
                                        <span class="meta-value"><?= productStars($product->getPopularidad()) ?></span>
                                    </li>
                                </ul>

                                <div class="product-actions">
                                    <?php if ($product->getStock() > 0): ?>
                                        <button class="btn-product btn-add-cart" data-product="<?= $product->getIdProducto() ?>">
                                            <i class="fas fa-shopping-cart"></i> Añadir al carrito
                                        </button>
                                    <?php else: ?>
                                        <button class="btn-product btn-notify" data-product="<?= $product->getIdProducto() ?>">
                                            <i class="fas fa-bell"></i> Notificarme
                                        </button>
                                    <?php endif; ?>
                                    <a href="/producto/<?= $product->getIdProducto() ?>" class="btn-product btn-details">
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