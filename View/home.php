<!-- Hero Section - Sin cambios -->
<section class="hero-section">
    <div class="hero-container">
        <div class="hero-image-container">
            <!-- Image will be added via CSS background for better control -->
        </div>
        <div class="hero-content">
            <h1 class="hero-title">Tu mayor rival es aquel que ves en el espejo</h1>
            <p class="hero-subtitle">No pongas límites a tu potencial. Únete al plan premium</p>
            <div class="hero-cta">
                <a href="#programs" class="btn btn-primary">¡Vamos!</a>
                <a href="#about" class="btn btn-outline">Ver Beneficios</a>
            </div>
        </div>
    </div>
</section>


<!-- Nueva sección de productos destacados -->
<section class="featured-products">
    <div class="container">
        <div class="section-title-container">
            <h2 class="section-title">Productos Más Visitados</h2>
            <p class="section-subtitle">Descubre los suplementos favoritos de nuestra comunidad para potenciar tu rendimiento</p>
        </div>

        <!-- Utilizando Bootstrap para la adaptación responsiva -->
        <div class="row">
            <?php foreach ($popularProducts as $index => $popularProduct): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 product-item">
                    <div class="product-card">
                        <?php if ($index === 0): ?>
                            <span class="product-badge">Top Ventas</span>
                        <?php elseif ($index === 1): ?>
                            <span class="product-badge">Nuevo</span>
                        <?php endif; ?>

                        <div class="product-image-container">
                            <img src="<?= $popularProduct->getImagen() ?>" class="product-image" alt="<?= $popularProduct->getNombre() ?>">
                        </div>

                        <div class="product-content">
                            <h3 class="product-title"><?= $popularProduct->getNombre() ?></h3>
                            <p class="product-description"><?= $popularProduct->getDescripcion() ?></p>

                            <ul class="product-meta">
                                <li class="product-meta-item">
                                    <span class="meta-label">Precio</span>
                                    <span class="meta-value"><?= $popularProduct->getPrecio() ?> €</span>
                                </li>
                                <li class="product-meta-item">
                                    <span class="meta-label">Disponibilidad</span>
                                    <span class="meta-value"><?= $popularProduct->getStock() > 0 ? 'En stock' : 'Agotado' ?></span>
                                </li>
                                <li class="product-meta-item">
                                    <span class="meta-label">Categoría</span>
                                    <span class="meta-value"><?= $popularProduct->getCategoria() ?></span>
                                </li>
                            </ul>

                            <div class="product-actions">
                                <a href="#" class="btn-product btn-add-cart">Añadir al carrito</a>
                                <a href="#" class="btn-product btn-details">Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="view-more-container">
            <a href="/productos" class="btn-view-more">Ver todos los productos</a>
        </div>
    </div>
</section>