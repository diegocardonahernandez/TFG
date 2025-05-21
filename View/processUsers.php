<?php

// Configuración de paginación
$usersPerPage = 10;
$totalUsers = count($users);
$totalPages = ceil($totalUsers / $usersPerPage);

// Determinar la página actual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $totalPages)); // Asegurar que la página esté dentro del rango válido

// Calcular el índice de inicio para la página actual
$startIndex = ($page - 1) * $usersPerPage;

// Obtener los usuarios para la página actual
$users = array_slice($users, $startIndex, $usersPerPage);

?>
<link rel="stylesheet" href="/css/processUsers.css">
<!-- Panel de Administración - Gestión de Usuarios -->
<div class="admin-panel">
    <!-- Cabecera del Panel -->
    <div class="admin-header">
        <div class="admin-title-container">
            <h1 class="admin-title">Gestión de Usuarios</h1>
            <p class="admin-subtitle">Administra los usuarios registrados en PUROGAINS</p>
        </div>
        <button id="btnAddUser" class="btn-admin btn-add-user" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-person-plus"></i> Añadir Nuevo Usuario
        </button>
    </div>

    <!-- Tabla de Usuarios -->
    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)) : ?>
                    <tr>
                        <td colspan="8" class="no-users">No hay usuarios registrados</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr data-user-id="<?php echo htmlspecialchars($user->getIdUsuario()); ?>">
                            <td><?php echo htmlspecialchars($user->getIdUsuario()); ?></td>
                            <td>
                                <div class="user-img-cell">
                                    <img src="<?php echo htmlspecialchars($user->getFotoPerfil()); ?>"
                                        alt="<?php echo htmlspecialchars($user->getNombre()); ?>" class="user-thumbnail">
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($user->getNombre()) . ' ' . htmlspecialchars($user->getApellido()); ?>
                            </td>
                            <td><?php echo htmlspecialchars($user->getCorreo()); ?></td>
                            <td><?php echo htmlspecialchars($user->getTelefono()); ?></td>
                            <td>
                                <span class="user-type <?php echo strtolower(htmlspecialchars($user->getTipoUsuario())); ?>">
                                    <?php echo ucfirst(htmlspecialchars($user->getTipoUsuario())); ?>
                                </span>
                            </td>
                            <td>
                                <span
                                    class="status-badge <?php echo ($user->getEstado() == 'activo') ? 'active' : 'inactive'; ?>">
                                    <?php echo ucfirst(htmlspecialchars($user->getEstado())); ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-view" title="Ver detalles"
                                        data-user-id="<?php echo htmlspecialchars($user->getIdUsuario()); ?>"
                                        data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn-action btn-edit" title="Editar usuario"
                                        data-user-id="<?php echo htmlspecialchars($user->getIdUsuario()); ?>"
                                        data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn-action btn-delete" title="Eliminar usuario"
                                        data-user-id="<?php echo htmlspecialchars($user->getIdUsuario()); ?>"
                                        data-user-name="<?php echo htmlspecialchars($user->getNombre()) . ' ' . htmlspecialchars($user->getApellido()); ?>"
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
            <nav aria-label="Navegación de usuarios">
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

<!-- Modal Añadir Usuario (Bootstrap) -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Añadir Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" class="user-form" method="post" action="process_user.php"
                    enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">

                    <!-- Información Personal -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información Personal</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userFirstName" class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" id="userFirstName" name="nombre" class="form-control"
                                            placeholder="Nombre" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userLastName" class="form-label">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" id="userLastName" name="apellido" class="form-control"
                                            placeholder="Apellido" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userGender" class="form-label">Género</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                                        <select id="userGender" name="genero" class="form-select" required>
                                            <option value="">Seleccionar género</option>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userBirthdate" class="form-label">Fecha de Nacimiento</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" id="userBirthdate" name="fecha_nacimiento"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información de Contacto</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userEmail" class="form-label">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" id="userEmail" name="correo" class="form-control"
                                            placeholder="correo@ejemplo.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userPhone" class="form-label">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" id="userPhone" name="telefono" class="form-control"
                                            placeholder="+34 612345678">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Física -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información Física</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userWeight" class="form-label">Peso (kg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                                        <input type="number" id="userWeight" name="peso" class="form-control"
                                            step="0.01" min="20" max="300" placeholder="70.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userHeight" class="form-label">Altura (cm)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-rulers"></i></span>
                                        <input type="number" id="userHeight" name="altura" class="form-control" min="50"
                                            max="250" placeholder="170">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Cuenta -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información de Cuenta</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userPassword" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" id="userPassword" name="contrasena" class="form-control"
                                            placeholder="Contraseña" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userConfirmPassword" class="form-label">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" id="userConfirmPassword" name="confirm_contrasena"
                                            class="form-control" placeholder="Confirmar contraseña" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userType" class="form-label">Tipo de Usuario</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <select id="userType" name="tipo_usuario" class="form-select" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="cliente">Cliente</option>
                                            <option value="admin">Admin</option>
                                            <option value="entrenador">Entrenador</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userStatus" class="form-label">Estado</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                        <select id="userStatus" name="estado" class="form-select" required>
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                            <option value="suspendido">Suspendido</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto de Perfil -->
                    <div class="form-section">
                        <h6 class="form-section-title">Foto de Perfil</h6>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="userProfilePhoto" class="form-label">Foto de Perfil</label>
                                <div class="mb-2">
                                    <input type="file" id="userProfilePhoto" name="foto_perfil" class="form-control"
                                        accept="image/*">
                                </div>
                                <div class="image-preview-container text-center">
                                    <img id="addPhotoPreview" src="/api/placeholder/200/200" alt="Vista previa"
                                        class="img-thumbnail image-preview" style="max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveAddUserButton">Guardar Usuario</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario (Bootstrap) -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" class="user-form" method="post" action="process_user.php"
                    enctype="multipart/form-data">
                    <input type="hidden" id="editUserId" name="id_usuario" value="">
                    <input type="hidden" name="action" value="edit">

                    <!-- Información Personal -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información Personal</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserFirstName" class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" id="editUserFirstName" name="nombre" class="form-control"
                                            placeholder="Nombre" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserLastName" class="form-label">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" id="editUserLastName" name="apellido" class="form-control"
                                            placeholder="Apellido" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserGender" class="form-label">Género</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                                        <select id="editUserGender" name="genero" class="form-select" required>
                                            <option value="">Seleccionar género</option>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserBirthdate" class="form-label">Fecha de Nacimiento</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" id="editUserBirthdate" name="fecha_nacimiento"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información de Contacto</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserEmail" class="form-label">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" id="editUserEmail" name="correo" class="form-control"
                                            placeholder="correo@ejemplo.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserPhone" class="form-label">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" id="editUserPhone" name="telefono" class="form-control"
                                            placeholder="+34 612345678">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Física -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información Física</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserWeight" class="form-label">Peso (kg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                                        <input type="number" id="editUserWeight" name="peso" class="form-control"
                                            step="0.01" min="20" max="300" placeholder="70.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserHeight" class="form-label">Altura (cm)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-rulers"></i></span>
                                        <input type="number" id="editUserHeight" name="altura" class="form-control"
                                            min="50" max="250" placeholder="170">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Cuenta -->
                    <div class="form-section">
                        <h6 class="form-section-title">Información de Cuenta</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserPassword" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" id="editUserPassword" name="contrasena"
                                            class="form-control" placeholder="Dejar en blanco para mantener la actual">
                                        <small class="form-text text-muted">Dejar en blanco para mantener la contraseña
                                            actual</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserConfirmPassword" class="form-label">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" id="editUserConfirmPassword" name="confirm_contrasena"
                                            class="form-control" placeholder="Confirmar contraseña">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserType" class="form-label">Tipo de Usuario</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <select id="editUserType" name="tipo_usuario" class="form-select" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="cliente">Cliente</option>
                                            <option value="admin">Admin</option>
                                            <option value="entrenador">Entrenador</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editUserStatus" class="form-label">Estado</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                        <select id="editUserStatus" name="estado" class="form-select" required>
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                            <option value="suspendido">Suspendido</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto de Perfil -->
                    <div class="form-section">
                        <h6 class="form-section-title">Foto de Perfil</h6>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="editUserProfilePhoto" class="form-label">Foto de Perfil</label>
                                <div class="mb-2">
                                    <input type="file" id="editUserProfilePhoto" name="foto_perfil" class="form-control"
                                        accept="image/*">
                                    <small class="form-text text-muted">Dejar en blanco para mantener la foto
                                        actual</small>
                                </div>
                                <div class="image-preview-container text-center">
                                    <img id="editPhotoPreview" src="/api/placeholder/200/200" alt="Vista previa"
                                        class="img-thumbnail image-preview" style="max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveEditUserButton">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Usuario (Bootstrap) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar al usuario <span id="deleteUserName" class="fw-bold">Nombre del
                        Usuario</span>?</p>
                <p class="text-danger">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteUserForm" method="post" action="process_user.php">
                    <input type="hidden" id="deleteUserId" name="id_usuario" value="">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Vista previa de la imagen para el formulario de añadir usuario
    document.getElementById('userProfilePhoto').addEventListener('change', function(e) {
        const preview = document.getElementById('addPhotoPreview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Vista previa de la imagen para el formulario de editar usuario
    document.getElementById('editUserProfilePhoto').addEventListener('change', function(e) {
        const preview = document.getElementById('editPhotoPreview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Listener para el botón de guardar al añadir un nuevo usuario
    document.getElementById('saveAddUserButton').addEventListener('click', function() {
        // Validar que las contraseñas coincidan
        const password = document.getElementById('userPassword').value;
        const confirmPassword = document.getElementById('userConfirmPassword').value;

        if (password !== confirmPassword) {
            alert('Las contraseñas no coinciden');
            return;
        }

        // Enviar el formulario
        document.getElementById('addUserForm').submit();
    });

    // Listener para el botón de guardar cambios al editar un usuario
    document.getElementById('saveEditUserButton').addEventListener('click', function() {
        // Validar que las contraseñas coincidan si se están cambiando
        const password = document.getElementById('editUserPassword').value;
        const confirmPassword = document.getElementById('editUserConfirmPassword').value;

        if (password !== '' && password !== confirmPassword) {
            alert('Las contraseñas no coinciden');
            return;
        }

        // Enviar el formulario
        document.getElementById('editUserForm').submit();
    });

    // Listener para los botones de editar usuario
    document.querySelectorAll('.btn-edit').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');

            // Aquí normalmente cargaríamos los datos del usuario mediante AJAX
            // Como ejemplo, simplemente establecemos el ID del usuario
            document.getElementById('editUserId').value = userId;

            // Cargar los datos del usuario (simulación)
            // En una aplicación real, esto se haría con una llamada AJAX
            // fetch('get_user.php?id=' + userId)...
        });
    });

    // Listener para los botones de ver usuario
    document.querySelectorAll('.btn-view').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');

            // Aquí normalmente cargaríamos los datos del usuario mediante AJAX
            // Como ejemplo, simplemente mostramos el ID del usuario
            document.getElementById('viewUserId').textContent = userId;

            // Cargar los datos del usuario (simulación)
            // En una aplicación real, esto se haría con una llamada AJAX
            // fetch('get_user.php?id=' + userId)...
        });
    });

    // Listener para los botones de eliminar usuario
    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');

            document.getElementById('deleteUserId').value = userId;
            document.getElementById('deleteUserName').textContent = userName;
        });
    });

    // Enlazar el botón de editar desde la vista de detalle
    document.getElementById('editFromViewButton').addEventListener('click', function() {
        const userId = document.getElementById('viewUserId').textContent;
        document.getElementById('editUserId').value = userId;

        // Cerrar el modal de vista y abrir el de edición
        bootstrap.Modal.getInstance(document.getElementById('viewUserModal')).hide();
    });
</script>