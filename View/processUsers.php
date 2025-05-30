<section class="admin-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1 class="admin-title fw-bold text-dark mb-0 display-6">Administración de Usuarios</h1>
                <p class="text-muted mt-2 mb-0">Gestiona los usuarios del sistema</p>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">Listado de Usuarios</h5>
                    <span id="usersCountSkeleton" class="skeleton-badge"></span>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2 d-none" id="usersCountReal">
                        <i class="bi bi-people me-1"></i> <span id="totalUsers"></span> usuarios
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="usersSkeleton" class="p-4">
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
                                        <div class="skeleton-text"></div>
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

                <div id="usersTable" class="d-none">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="fw-semibold px-4 py-3">ID</th>
                                    <th class="fw-semibold px-4 py-3">Nombre</th>
                                    <th class="fw-semibold px-4 py-3">Correo</th>
                                    <th class="fw-semibold px-4 py-3">Tipo</th>
                                    <th class="fw-semibold px-4 py-3">Estado</th>
                                    <th class="fw-semibold px-4 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="noUsersMessage" class="text-center py-5 d-none">
                        <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                        <p class="mt-3 mb-0 text-muted">No hay usuarios disponibles</p>
                    </div>
                    <div id="paginationContainer"></div>
                    <div class="text-center mt-3">
                        <small class="text-muted" id="paginationInfo"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-header bg-light py-3">
                    <h5 class="modal-title fw-bold" id="editUserModalLabel">
                        <i class="bi bi-pencil-square me-2 text-danger"></i>Editar Usuario
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editUserForm" class="needs-validation row g-3" novalidate>
                        <input type="hidden" id="editUserId" name="id_usuario">
                        <input type="hidden" id="editUserPhotoActual" name="foto_perfil_actual">

                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="editUserName" class="form-label fw-medium">Nombre</label>
                                    <input type="text" class="form-control rounded-3" id="editUserName" name="nombre"
                                        required>
                                    <div class="invalid-feedback">El nombre es obligatorio</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editUserLastName" class="form-label fw-medium">Apellido</label>
                                    <input type="text" class="form-control rounded-3" id="editUserLastName"
                                        name="apellido" required>
                                    <div class="invalid-feedback">El apellido es obligatorio</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-md-6">
                                    <label for="editUserEmail" class="form-label fw-medium">Correo</label>
                                    <input type="email" class="form-control rounded-3" id="editUserEmail" name="correo"
                                        required>
                                    <div class="invalid-feedback">El correo es obligatorio</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editUserPhone" class="form-label fw-medium">Teléfono</label>
                                    <input type="tel" class="form-control rounded-3" id="editUserPhone" name="telefono"
                                        required>
                                    <div class="invalid-feedback">El teléfono es obligatorio</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-md-6">
                                    <label for="editUserType" class="form-label fw-medium">Tipo de Usuario</label>
                                    <select class="form-select rounded-3" id="editUserType" name="tipo_usuario"
                                        required>
                                        <option value="Usuario">Usuario</option>
                                        <option value="Premium">Premium</option>
                                        <option value="Administrador">Administrador</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione un tipo de usuario</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editUserStatus" class="form-label fw-medium">Estado</label>
                                    <div class="d-flex gap-3 mt-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="editUserStatusActive" value="1">
                                            <label class="form-check-label" for="editUserStatusActive">Activo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estado"
                                                id="editUserStatusInactive" value="0">
                                            <label class="form-check-label"
                                                for="editUserStatusInactive">Inactivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="editUserBirthDate" class="form-label fw-medium">Fecha de
                                        Nacimiento</label>
                                    <input type="date" class="form-control rounded-3" id="editUserBirthDate"
                                        name="fecha_nacimiento" required>
                                    <div class="invalid-feedback">La fecha de nacimiento es obligatoria</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="editUserGender" class="form-label fw-medium">Género</label>
                                    <select class="form-select rounded-3" id="editUserGender" name="genero" required>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione un género</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-md-6">
                                    <label for="editUserWeight" class="form-label fw-medium">Peso (kg)</label>
                                    <input type="number" class="form-control rounded-3" id="editUserWeight" name="peso"
                                        min="0" step="0.1">
                                </div>
                                <div class="col-md-6">
                                    <label for="editUserHeight" class="form-label fw-medium">Altura (cm)</label>
                                    <input type="number" class="form-control rounded-3" id="editUserHeight"
                                        name="altura" min="0" step="0.1">
                                </div>
                            </div>

                            <div class="mt-2">
                                <label for="editUserPhoto" class="form-label fw-medium">Foto de Perfil</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="file" class="form-control rounded-3" id="editUserPhoto"
                                        name="foto_perfil" accept="image/*">
                                    <img id="editUserPhotoPreview" src="" alt="Previsualización"
                                        class="img-thumbnail rounded-3" style="display: none;">
                                </div>
                                <small class="text-muted">Dejar vacío para mantener la imagen actual</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top py-3">
                    <button type="button" class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" id="updateUser">
                        <i class="bi bi-check-lg me-1"></i> Actualizar Usuario
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
                        <h5 class="fw-bold mb-3">Eliminar Usuario</h5>
                        <p class="mb-0">¿Estás seguro de que deseas eliminar el usuario <span id="userToDeleteName"
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

<link rel="stylesheet" href="/css/processUsers.css">
<script src="/js/processUsers.js"></script>