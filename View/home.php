<!-- Incluir Animate.css para animaciones más llamativas -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- Carrusel rediseñado para imágenes 1536x1024 -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
        <!-- Primer Slide - Contenido a la izquierda -->
        <div class="carousel-item active hero-slide slide-1">
            <div class="slide-background"></div>
            <div class="container h-100">
                <div class="carousel-caption position-left">
                    <div class="hero-content animate__animated animate__fadeInLeft">
                        <h1 class="hero-title">Tu mayor rival es aquel que ves en el espejo</h1>
                        <p class="hero-subtitle">No pongas límites a tu potencial. Únete al plan premium</p>
                        <div class="hero-cta">
                            <a href="#programs" class="btn btn-danger">¡Vamos!</a>
                            <a href="/profits" class="btn btn-outline">Ver Beneficios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Segundo Slide - Contenido abajo -->
        <div class="carousel-item hero-slide slide-2">
            <div class="slide-background"></div>
            <div class="container h-100">
                <div class="carousel-caption position-bottom">
                    <div class="hero-content animate__animated animate__fadeInUp">
                        <h1 class="hero-title">Transforma tu cuerpo, cambia tu vida</h1>
                        <p class="hero-subtitle">Productos de calidad para maximizar tu rendimiento</p>
                        <div class="hero-cta" id="btnsSlide2">
                            <a href="/products" class="btn btn-danger">Ver Productos</a>
                            <a href="#testimonials" class="btn btn-outline">Testimonios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tercer Slide - Contenido a la derecha -->
        <div class="carousel-item hero-slide slide-3">
            <div class="slide-background"></div>
            <div class="container h-100">
                <div class="carousel-caption position-right">
                    <div class="hero-content animate__animated animate__fadeInRight">
                        <h1 class="hero-title">Entrena con propósito, vive con pasión</h1>
                        <p class="hero-subtitle">Descubre nuestra gama de suplementos premium</p>
                        <div class="hero-cta">
                            <a href="#subscription" class="btn btn-danger">Suscríbete</a>
                            <a href="#faq" class="btn btn-outline">Preguntas Frecuentes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Controles de navegación mejorados -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- El resto del contenido sigue igual... -->

<!-- Nueva sección de productos destacados -->
<section class="featured-products">
    <div class="container">
        <div class="section-title-container">
            <h2 class="section-title">Productos Más Visitados</h2>
            <p class="section-subtitle">Descubre los suplementos favoritos de nuestra comunidad para potenciar tu
                rendimiento</p>
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
                        <img src="<?= $popularProduct->getImagen() ?>" class="product-image"
                            alt="<?= $popularProduct->getNombre() ?>">
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
                                <span
                                    class="meta-value"><?= $popularProduct->getStock() > 0 ? 'En stock' : 'Agotado' ?></span>
                            </li>
                            <li class="product-meta-item">
                                <span class="meta-label">Categoría</span>
                                <span class="meta-value"><?= $popularProduct->getCategoria() ?></span>
                            </li>
                            <li class="product-meta-item">
                                <span class="meta-label">Valoración</span>
                                <span class="meta-value"><?= productStars($popularProduct->getPopularidad()) ?></span>
                            </li>
                        </ul>

                        <div class="product-actions">
                            <a href="#" class="btn-product btn-add-cart">Añadir al carrito</a>
                            <a href="/product?id=<?= $popularProduct->getIdProducto() ?>"
                                class="btn-product btn-details">Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="view-more-container">
            <a href="/products" class="btn-view-more">Ver todos los productos</a>
        </div>
    </div>
    <script src="/js/animations/home.js"></script>
</section>