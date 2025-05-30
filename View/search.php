<section class="search-header">
    <div class="container">
        <div class="search-title-container">
            <h1 class="search-title">Resultados de búsqueda</h1>
            <p class="search-subtitle">
                <?php if (empty($products)): ?>
                No se encontraron productos para "<?= htmlspecialchars($searchQuery) ?>"
                <?php else: ?>
                Se encontraron <?= count($products) ?> productos para "<?= htmlspecialchars($searchQuery) ?>"
                <?php endif; ?>
            </p>
        </div>
    </div>
</section>

<section class="search-results">
    <div class="container">
        <?php if (empty($products)): ?>
        <div class="no-results-found">
            <div class="no-results-icon">
                <i class="bi bi-search"></i>
            </div>
            <h2>No se encontraron productos</h2>
            <p>Intenta con otros términos de búsqueda o navega por nuestras categorías.</p>
            <a href="/" class="btn-back-home">Volver al inicio</a>
        </div>
        <?php else: ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 search-product-item">
                <div class="search-product-card">
                    <?php if ($product->getStock() <= 10 && $product->getStock() > 0): ?>
                    <span class="search-product-badge stock-badge">¡Últimas unidades!</span>
                    <?php endif; ?>

                    <div class="search-product-image-container">
                        <img src="<?= $product->getImagen() ?>" class="search-product-image"
                            alt="<?= $product->getNombre() ?>">
                    </div>

                    <div class="search-product-content">
                        <h3 class="search-product-title"><?= $product->getNombre() ?></h3>
                        <p class="search-product-description"><?= $product->getDescripcion() ?></p>

                        <ul class="search-product-meta">
                            <li class="search-product-meta-item">
                                <span class="search-meta-label">Precio</span>
                                <span class="search-meta-value"><?= $product->getPrecio() ?> €</span>
                            </li>
                            <li class="search-product-meta-item">
                                <span class="search-meta-label">Disponibilidad</span>
                                <span
                                    class="search-meta-value"><?= $product->getStock() > 0 ? 'En stock' : 'Agotado' ?></span>
                            </li>
                            <li class="search-product-meta-item">
                                <span class="search-meta-label">Categoría</span>
                                <span class="search-meta-value"><?= $product->getCategoria() ?></span>
                            </li>
                        </ul>

                        <div class="search-product-actions">
                            <?php if ($product->getStock() > 0): ?>
                            <form action="/cart" method="post">
                                <input type="hidden" name="id" value="<?= $product->getIdProducto() ?>">
                                <button type="submit" class="btn-product search-btn-add-cart">Añadir al carrito</button>
                            </form>
                            <?php else: ?>
                            <button class="search-btn-product search-btn-notify"
                                data-product="<?= $product->getIdProducto() ?>">
                                <i class="bi bi-bell"></i> Notificarme
                            </button>
                            <?php endif; ?>
                            <a href="/product?id=<?= $product->getIdProducto() ?>"
                                class="search-btn-product search-btn-details">
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