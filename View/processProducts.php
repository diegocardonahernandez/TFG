<?php

// Configuración de paginación
$productsPerPage = 10;
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $productsPerPage);

// Determinar la página actual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $totalPages)); // Asegurar que la página esté dentro del rango válido

// Calcular el índice de inicio para la página actual
$startIndex = ($page - 1) * $productsPerPage;

// Obtener los productos para la página actual
$products = array_slice($products, $startIndex, $productsPerPage);

?>
<link rel="stylesheet" href="/css/processProducts.css">
<!-- Panel de Administración - Gestión de Productos -->
<div class="admin-panel">
    <!-- Cabecera del Panel -->
    <div class="admin-header">
        <div class="admin-title-container">
            <h1 class="admin-title">Gestión de Productos</h1>
            <p class="admin-subtitle">Administra el catálogo de productos de PUROGAINS</p>
        </div>
        <button id="btnAddProduct" class="btn-admin btn-add-product" data-bs-toggle="modal"
            data-bs-target="#addProductModal">
            <i class="bi bi-plus-circle"></i> Añadir Nuevo Producto
        </button>
    </div>

    <!-- Tabla de Productos -->
    <div class="products-table-container">
        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Descuento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="9" class="no-products">No hay productos disponibles</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <tr data-product-id="<?php echo htmlspecialchars($product->getIdProducto()); ?>">
                            <td><?php echo htmlspecialchars($product->getIdProducto()); ?></td>
                            <td>
                                <div class="product-img-cell">
                                    <img src="<?php echo htmlspecialchars($product->getImagen()); ?>"
                                        alt="<?php echo htmlspecialchars($product->getNombre()); ?>" class="product-thumbnail">
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($product->getNombre()); ?></td>
                            <td><?php echo htmlspecialchars($product->getCategoria()); ?></td>
                            <td>€<?php echo number_format($product->getPrecio(), 2); ?></td>
                            <td><?php echo htmlspecialchars($product->getStock()); ?></td>
                            <td><?php echo $product->getDescuento() ? htmlspecialchars($product->getDescuento()) . '%' : '0%'; ?>
                            </td>
                            <td>
                                <span
                                    class="status-badge <?php echo ($product->getEstado() == 'activo') ? 'active' : 'inactive'; ?>">
                                    <?php echo ucfirst(htmlspecialchars($product->getEstado())); ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-edit" title="Editar producto"
                                        data-product-id="<?php echo htmlspecialchars($product->getIdProducto()); ?>"
                                        data-bs-toggle="modal" data-bs-target="#editProductModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn-action btn-delete" title="Eliminar producto"
                                        data-product-id="<?php echo htmlspecialchars($product->getIdProducto()); ?>"
                                        data-product-name="<?php echo htmlspecialchars($product->getNombre()); ?>"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <?php if ($totalPages > 1) : ?>
        <div class="pagination-container">
            <nav aria-label="Navegación de productos">
                <ul class="pagination">
                    <!-- Botón Anterior -->
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a href="?page=<?php echo $page - 1; ?>" class="page-link"
                            <?php echo ($page <= 1) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>

                    <!-- Páginas -->
                    <?php
                    // Determinar rango de páginas a mostrar
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);

                    // Mostrar primera página si no está en el rango
                    if ($startPage > 1) {
                        echo '<li class="page-item"><a href="?page=1" class="page-link">1</a></li>';
                        if ($startPage > 2) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                    }

                    // Mostrar páginas en el rango
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
                    }

                    // Mostrar última página si no está en el rango
                    if ($endPage < $totalPages) {
                        if ($endPage < $totalPages - 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        echo '<li class="page-item"><a href="?page=' . $totalPages . '" class="page-link">' . $totalPages . '</a></li>';
                    }
                    ?>

                    <!-- Botón Siguiente -->
                    <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                        <a href="?page=<?php echo $page + 1; ?>" class="page-link"
                            <?php echo ($page >= $totalPages) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Añadir Producto (Bootstrap) -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Añadir Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" class="product-form" method="post" action="process_product.php"
                    enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productName" class="form-label">Nombre del Producto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                    <input type="text" id="productName" name="nombre" class="form-control"
                                        placeholder="Nombre del producto" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productCategory" class="form-label">Categoría</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-bookmark"></i></span>
                                    <select id="productCategory" name="id_categoria" class="form-select" required>
                                        <option value="">Seleccionar categoría</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?php echo htmlspecialchars($category['id_categoria']); ?>">
                                                <?php echo htmlspecialchars($category['nombre']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="productDescription" class="form-label">Descripción</label>
                            <textarea id="productDescription" name="descripcion" class="form-control"
                                placeholder="Breve descripción del producto" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="productDetails" class="form-label">Detalles del Producto</label>
                            <textarea id="productDetails" name="detalles_producto" class="form-control"
                                placeholder="Información detallada del producto" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productPrice" class="form-label">Precio (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                                    <input type="number" id="productPrice" name="precio" class="form-control"
                                        step="0.01" min="0" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productStock" class="form-label">Stock</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                    <input type="number" id="productStock" name="stock" class="form-control" min="0"
                                        placeholder="0" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productDiscount" class="form-label">Descuento (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-percent"></i></span>
                                    <input type="number" id="productDiscount" name="descuento" class="form-control"
                                        min="0" max="100" placeholder="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="productStatus" class="form-label">Estado</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                    <select id="productStatus" name="estado" class="form-select" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                        <option value="agotado">Agotado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="productPopularity" class="form-label">Popularidad</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star"></i></span>
                                <input type="number" id="productPopularity" name="popularidad" class="form-control"
                                    min="0" placeholder="0" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="addProductImage" class="form-label">Imagen del Producto</label>
                            <div class="mb-2">
                                <input type="file" id="addProductImage" name="imagen" class="form-control"
                                    accept="image/*">
                            </div>
                            <div class="image-preview-container text-center">
                                <img id="addImagePreview" src="/api/placeholder/200/200" alt="Vista previa"
                                    class="img-thumbnail image-preview" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveAddProductButton">Guardar Producto</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Producto (Bootstrap) -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" class="product-form" method="post" action="process_product.php"
                    enctype="multipart/form-data">
                    <input type="hidden" id="editProductId" name="id_producto" value="">
                    <input type="hidden" name="action" value="edit">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProductName" class="form-label">Nombre del Producto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                    <input type="text" id="editProductName" name="nombre" class="form-control"
                                        placeholder="Nombre del producto" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProductCategory" class="form-label">Categoría</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-bookmark"></i></span>
                                    <select id="editProductCategory" name="id_categoria" class="form-select" required>
                                        <option value="">Seleccionar categoría</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?php echo htmlspecialchars($category['id_categoria']); ?>">
                                                <?php echo htmlspecialchars($category['nombre']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="editProductDescription" class="form-label">Descripción</label>
                            <textarea id="editProductDescription" name="descripcion" class="form-control"
                                placeholder="Breve descripción del producto" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="editProductDetails" class="form-label">Detalles del Producto</label>
                            <textarea id="editProductDetails" name="detalles_producto" class="form-control"
                                placeholder="Información detallada del producto" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProductPrice" class="form-label">Precio (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                                    <input type="number" id="editProductPrice" name="precio" class="form-control"
                                        step="0.01" min="0" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProductStock" class="form-label">Stock</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                    <input type="number" id="editProductStock" name="stock" class="form-control" min="0"
                                        placeholder="0" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProductDiscount" class="form-label">Descuento (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-percent"></i></span>
                                    <input type="number" id="editProductDiscount" name="descuento" class="form-control"
                                        min="0" max="100" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editProductStatus" class="form-label">Estado</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                    <select id="editProductStatus" name="estado" class="form-select" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                        <option value="agotado">Agotado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="editProductPopularity" class="form-label">Popularidad</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star"></i></span>
                                <input type="number" id="editProductPopularity" name="popularidad" class="form-control"
                                    min="0" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="editProductImage" class="form-label">Imagen del Producto</label>
                            <div class="mb-2">
                                <input type="file" id="editProductImage" name="imagen" class="form-control"
                                    accept="image/*">
                                <small class="form-text text-muted">Dejar en blanco para mantener la imagen
                                    actual</small>
                            </div>
                            <div class="image-preview-container text-center">
                                <img id="editImagePreview" src="/api/placeholder/200/200" alt="Vista previa"
                                    class="img-thumbnail image-preview" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveEditProductButton">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación Eliminar (Bootstrap) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="delete-message">¿Estás seguro de que deseas eliminar el producto "<span
                        id="deleteProductName"></span>"? Esta acción no se puede deshacer.</p>
                <form id="deleteForm" method="post" action="process_product.php">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_producto" id="deleteProductId" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>