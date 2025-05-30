<section class="category-header">
    <div class="container">
        <div class="category-title-container">
            <h1 class="category-title"><?= $category ?></h1>
            <p class="category-subtitle">Descubre nuestra selección de productos para potenciar tu rendimiento</p>
        </div>
    </div>
</section>

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
            <div class="col-lg-4 col-md-6 col-sm-12 category-product-item">
                <div class="category-product-card">

                    <?php if ($product->getStock() <= 10 && $product->getStock() > 0): ?>
                    <span class="category-product-badge stock-badge">¡Últimas unidades!</span>
                    <?php endif; ?>

                    <div class="category-product-image-container">
                        <img src="<?= $product->getImagen() ?>" class="category-product-image"
                            alt="<?= $product->getNombre() ?>">
                    </div>

                    <div class="category-product-content">
                        <h3 class="category-product-title"><?= $product->getNombre() ?></h3>
                        <p class="category-product-description"><?= $product->getDescripcion() ?></p>

                        <ul class="category-product-meta">
                            <li class="category-product-meta-item">
                                <span class="category-meta-label">Precio</span>
                                <span class="category-meta-value"><?= $product->getPrecio() ?> €</span>
                            </li>
                            <li class="category-product-meta-item">
                                <span class="category-meta-label">Disponibilidad</span>
                                <span
                                    class="category-meta-value"><?= ($product->getStock() > 0 && $product->getEstado() !== 'agotado') ? 'En stock' : 'Agotado' ?></span>
                            </li>
                            <li class="category-product-meta-item">
                                <span class="category-meta-label">Categoría</span>
                                <span class="category-meta-value"><?= $product->getCategoria() ?></span>
                            </li>
                            <li class="category-product-meta-item">
                                <span class="category-meta-label">Valoración</span>
                                <span class="category-meta-value"><?= productStars($product->getPopularidad()) ?></span>
                            </li>
                        </ul>

                        <div class="category-product-actions">
                            <?php if ($product->getStock() > 0 && $product->getEstado() !== 'agotado'): ?>
                            <form action="/cart" method="post">
                                <input type="hidden" name="id" value="<?= $product->getIdProducto() ?>">
                                <button type="submit" class="btn-product btn-add-cart">Añadir al carrito</button>
                            </form>
                            <?php else: ?>
                            <button class="category-btn-product category-btn-notify"
                                data-product="<?= $product->getIdProducto() ?>">
                                <i class="fas fa-bell"></i> Notificarme
                            </button>
                            <?php endif; ?>
                            <a href="/product?id=<?= $product->getIdProducto() ?>"
                                class="category-btn-product category-btn-details">
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