<!-- Sección de encabezado de categoría -->
<section class="category-header">
    <div class="container">
        <div class="category-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="/productos">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $category ?></li>
                </ol>
            </nav>
        </div>
        
        <div class="category-intro">
            <h1 class="category-title"><?= $category ?></h1>
            <div class="category-description">
                <p>Descubre nuestra selección de <?= strtolower($category) ?> de alta calidad diseñados para potenciar tu rendimiento y ayudarte a alcanzar tus objetivos.</p>
            </div>
            
            <div class="category-filters">
                <div class="filter-group">
                    <label for="sort-by">Ordenar por:</label>
                    <select id="sort-by" class="form-select">
                        <option value="popular">Más populares</option>
                        <option value="newest">Más recientes</option>
                        <option value="price-low">Precio: menor a mayor</option>
                        <option value="price-high">Precio: mayor a menor</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de productos -->
<section class="featured-products">
    <div class="container">
        <div class="category-summary">
            <div class="summary-count">
                <span class="total-products"><?= count($products) ?> productos</span> en <strong><?= $category ?></strong>
            </div>
            <div class="view-toggle">
                <button class="btn-view-option active" data-view="grid"><i class="fas fa-th"></i></button>
                <button class="btn-view-option" data-view="list"><i class="fas fa-list"></i></button>
            </div>
        </div>

        <!-- Utilizando Bootstrap para la adaptación responsiva -->
        <div class="row products-grid" id="products-container">
            <?php foreach ($products as $index => $product): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 product-item">
                    <div class="product-card">
                        <?php if ($index === 0): ?>
                            <span class="product-badge popular">Top Ventas</span>
                        <?php elseif ($product->getFechaCreacion() && strtotime($product->getFechaCreacion()) > strtotime('-30 days')): ?>
                            <span class="product-badge new">Nuevo</span>
                        <?php endif; ?>

                        <div class="product-image-container">
                            <img src="<?= $product->getImagen() ?>" class="product-image" alt="<?= $product->getNombre() ?>">
                        </div>

                        <div class="product-content">
                            <h3 class="product-title"><a href="/producto/<?= $product->getIdProducto() ?>"><?= $product->getNombre() ?></a></h3>
                            <p class="product-description"><?= substr($product->getDescripcion(), 0, 80) ?>...</p>

                            <div class="product-pricing">
                                <span class="price-current"><?= $product->getPrecio() ?> €</span>
                            </div>

                            <ul class="product-meta">
                                <li class="product-meta-item">
                                    <span class="meta-label">Disponibilidad</span>
                                    <span class="meta-value <?= $product->getStock() > 0 ? 'in-stock' : 'out-of-stock' ?>"><?= $product->getStock() > 0 ? 'En stock' : 'Agotado' ?></span>
                                </li>
                                <li class="product-meta-item">
                                    <span class="meta-label">Categoría</span>
                                    <span class="meta-value"><?= $product->getCategoria() ?></span>
                                </li>
                            </ul>

                            <div class="product-actions">
                                <button class="btn-product btn-add-cart <?= $product->getStock() <= 0 ? 'disabled' : '' ?>">
                                    <i class="fas fa-shopping-cart"></i> Añadir al carrito
                                </button>
                                <a href="/producto/<?= $product->getIdProducto() ?>" class="btn-product btn-details">
                                    <i class="fas fa-info-circle"></i> Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Paginación -->
        <?php 
        $totalProducts = count($products);
        $productsPerPage = 12;
        $totalPages = ceil($totalProducts / $productsPerPage);
        
        if ($totalPages > 1): 
        ?>
        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === 1 ? 'active' : '' ?>"><a class="page-link" href="#"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>

        <!-- Botón ver más productos -->
        <div class="view-more-container">
            <a href="/productos" class="btn-view-more">Ver todos los productos</a>
        </div>
    </div>
</section>