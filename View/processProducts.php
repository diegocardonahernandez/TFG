<section class="admin-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1 class="admin-title fw-bold text-dark mb-0 display-6">Administración de Productos</h1>
                <p class="text-muted mt-2 mb-0">Gestiona tu catálogo de productos</p>
            </div>
            <div class="col-md-4 text-md-end">
                <button class="btn btn-danger rounded-pill shadow-sm border-0 px-4 py-2" data-bs-toggle="modal"
                    data-bs-target="#addProductModal">
                    <i class="bi bi-plus-lg me-1"></i> Nuevo Producto
                </button>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">Listado de Productos</h5>
                    <span id="productsCountSkeleton" class="skeleton-badge"></span>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2 d-none" id="productsCountReal">
                        <i class="bi bi-box-seam me-1"></i> <span id="totalProducts"></span> productos
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="productsSkeleton" class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        <div class="skeleton-text"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 10; $i++): ?>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-image"></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-badge"></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-text"></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-badge"></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="skeleton-badge"></div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <div class="skeleton-button"></div>
                                            <div class="skeleton-button"></div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="productsTable" class="d-none">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="fw-semibold px-4 py-3">ID</th>
                                    <th class="fw-semibold px-4 py-3">Imagen</th>
                                    <th class="fw-semibold px-4 py-3">Nombre</th>
                                    <th class="fw-semibold px-4 py-3">Categoría</th>
                                    <th class="fw-semibold px-4 py-3">Precio</th>
                                    <th class="fw-semibold px-4 py-3">Stock</th>
                                    <th class="fw-semibold px-4 py-3">Estado</th>
                                    <th class="fw-semibold px-4 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="noProductsMessage" class="text-center py-5 d-none">
                        <i class="bi bi-archive text-muted" style="font-size: 3rem;"></i>
                        <p class="mt-3 mb-0 text-muted">No hay productos disponibles</p>
                        <p class="text-muted">Añade un nuevo producto para comenzar</p>
                    </div>
                    <div id="paginationContainer"></div>
                    <div class="text-center mt-3">
                        <small class="text-muted" id="paginationInfo"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-header bg-light py-3">
                    <h5 class="modal-title fw-bold" id="addProductModalLabel">
                        <i class="bi bi-plus-circle me-2 text-danger"></i>Añadir Nuevo Producto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addProductForm" class="needs-validation row" novalidate>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="productName" class="form-label fw-medium">Nombre</label>
                                <input type="text" class="form-control rounded-3" id="productName" name="nombre"
                                    required>
                                <div class="invalid-feedback">El nombre es obligatorio</div>
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label fw-medium">Categoría</label>
                                <select class="form-select rounded-3" id="productCategory" name="id_categoria" required>
                                    <option value="">Seleccionar categoría</option>
                                </select>
                                <div class="invalid-feedback">Seleccione una categoría</div>
                            </div>

                            <div class="mb-3">
                                <label for="productStatus" class="form-label fw-medium">Estado</label>
                                <select class="form-select rounded-3" id="productStatus" name="estado" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="productPrice" class="form-label fw-medium">Precio</label>
                                <div class="input-group">
                                    <input type="number" class="form-control rounded-start-3" id="productPrice"
                                        name="precio" step="0.01" required>
                                    <span class="input-group-text rounded-end-3">€</span>
                                </div>
                                <div class="invalid-feedback">Ingrese un precio válido</div>
                            </div>

                            <div class="mb-3">
                                <label for="productStock" class="form-label fw-medium">Stock</label>
                                <input type="number" class="form-control rounded-3" id="productStock" name="stock"
                                    required>
                                <div class="invalid-feedback">Ingrese el stock disponible</div>
                            </div>

                            <div class="mb-3">
                                <label for="productImage" class="form-label fw-medium">Imagen</label>
                                <input type="file" class="form-control rounded-3" id="productImage" name="imagen"
                                    accept="image/*" required>
                                <div class="invalid-feedback">Seleccione una imagen</div>
                                <div class="mt-2">
                                    <img id="imagePreview" src="" alt="Vista previa"
                                        class="img-thumbnail rounded-3 d-none"
                                        style="max-width: 120px; max-height: 120px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="productDescription" class="form-label fw-medium">Descripción</label>
                                <textarea class="form-control rounded-3" id="productDescription" name="descripcion"
                                    rows="3" required></textarea>
                                <div class="invalid-feedback">La descripción es obligatoria</div>
                            </div>

                            <div class="mb-3">
                                <label for="detalles_producto" class="form-label fw-medium">Detalles del
                                    producto</label>
                                <textarea class="form-control rounded-3" id="detalles_producto" name="detalles_producto"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top py-3">
                    <button type="button" class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" id="saveProduct">
                        <i class="bi bi-save me-1"></i> Guardar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-header bg-light py-3">
                    <h5 class="modal-title fw-bold" id="editProductModalLabel">
                        <i class="bi bi-pencil-square me-2 text-danger"></i>Editar Producto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editProductForm" class="needs-validation row g-3" novalidate>
                        <input type="hidden" id="editProductId" name="id_producto">

                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="editProductName" class="form-label fw-medium">Nombre</label>
                                    <input type="text" class="form-control rounded-3" id="editProductName" name="nombre"
                                        required>
                                    <div class="invalid-feedback">El nombre es obligatorio</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editProductCategory" class="form-label fw-medium">Categoría</label>
                                    <select class="form-select rounded-3" id="editProductCategory" name="id_categoria"
                                        required>
                                        <option value="">Seleccionar categoría</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione una categoría</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-md-6">
                                    <label for="editProductPrice" class="form-label fw-medium">Precio</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control rounded-start-3" id="editProductPrice"
                                            name="precio" step="0.01" required>
                                        <span class="input-group-text rounded-end-3">€</span>
                                    </div>
                                    <div class="invalid-feedback">Ingrese un precio válido</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editProductDiscount" class="form-label fw-medium">Descuento</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control rounded-start-3"
                                            id="editProductDiscount" name="descuento" step="0.01" min="0" max="100">
                                        <span class="input-group-text rounded-end-3">%</span>
                                    </div>
                                    <div class="invalid-feedback">El descuento debe estar entre 0 y 100</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-md-6">
                                    <label for="editProductStock" class="form-label fw-medium">Stock</label>
                                    <input type="number" class="form-control rounded-3" id="editProductStock"
                                        name="stock" required>
                                    <div class="invalid-feedback">Ingrese el stock disponible</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editProductStatus" class="form-label fw-medium">Estado</label>
                                    <div class="status-radio-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="editProductStatusActive" value="activo">
                                            <label class="form-check-label" for="editProductStatusActive">
                                                <i class="bi bi-check-circle-fill me-1"></i>Activo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="editProductStatusInactive" value="inactivo">
                                            <label class="form-check-label" for="editProductStatusInactive">
                                                <i class="bi bi-x-circle-fill me-1"></i>Inactivo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="editProductStatusOutOfStock" value="agotado">
                                            <label class="form-check-label" for="editProductStatusOutOfStock">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Agotado
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-12">
                                    <label for="editProductDescription" class="form-label fw-medium">Descripción</label>
                                    <textarea class="form-control rounded-3" id="editProductDescription"
                                        name="descripcion" rows="3" required></textarea>
                                    <div class="invalid-feedback">La descripción es obligatoria</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-12">
                                    <label for="editProductDetails" class="form-label fw-medium">Detalles del
                                        producto</label>
                                    <textarea class="form-control rounded-3" id="editProductDetails"
                                        name="detalles_producto" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="mt-2">
                                <label for="editProductImage" class="form-label fw-medium">Imagen del Producto</label>
                                <input type="file" class="form-control rounded-3" id="editProductImage" name="imagen"
                                    accept="image/*">
                                <small class="text-muted">Dejar vacío para mantener la imagen actual</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top py-3">
                    <button type="button" class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" id="updateProduct">
                        <i class="bi bi-check-lg me-1"></i> Actualizar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-header bg-light py-3">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-trash me-2 text-danger"></i>Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 d-inline-flex mb-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Eliminar Producto</h5>
                        <p class="mb-0">¿Estás seguro de que deseas eliminar el producto <span id="productToDeleteName"
                                class="fw-bold"></span>?</p>
                        <p class="text-danger mt-3"><i class="bi bi-info-circle-fill me-1"></i> Esta acción no se puede
                            deshacer.</p>
                    </div>
                </div>
                <div class="modal-footer border-top py-3">
                    <button type="button" class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" id="confirmDelete">
                        <i class="bi bi-trash me-1"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/js/processProducts.js"></script>