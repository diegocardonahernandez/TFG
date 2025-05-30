<section class="user-profile-section">
    <div class="user-profile-container">
        <div class="user-profile-header">
            <h2 class="user-profile-title">Mi Perfil</h2>
            <p class="user-profile-subtitle">Visualiza y modifica tus datos personales para mantener tu información
                actualizada</p>
            <div class="user-profile-logout">
                <a href="/logout" class="user-profile-logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>

        <div class="user-profile-content">
            <div class="user-profile-main">
                <form action="/updateUserData" class="user-profile-form" id="user-profile-form" method="post"
                    enctype="multipart/form-data">
                    <div class="user-profile-top-section">
                        <div class="user-profile-image-container">
                            <div class="user-profile-image" id="user-profile-image-preview"
                                style="background-image: url('<?php echo !empty($currentUser->getFotoPerfil()) ? $currentUser->getFotoPerfil() : '/assets/img/default-profile.jpg'; ?>');">
                            </div>
                            <label for="user-profile-image-upload" class="user-profile-image-upload-btn">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="user-profile-image-upload" name="user-profile-image-upload"
                                class="user-profile-hidden-file-input" accept="image/*">
                        </div>
                    </div>

                    <h3 class="user-profile-section-title">Información Personal</h3>

                    <div class="user-profile-form-row">
                        <div class="user-profile-form-group">
                            <label for="user_profile_nombre">Nombre</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-user user-profile-input-icon"></i>
                                <input type="text" id="user_profile_nombre" name="user_profile_nombre"
                                    class="user-profile-form-input" value="<?php echo $currentUser->getNombre(); ?>"
                                    required>
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorName"></span>
                        </div>

                        <div class="user-profile-form-group">
                            <label for="user_profile_apellido">Apellido</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-user user-profile-input-icon"></i>
                                <input type="text" id="user_profile_apellido" name="user_profile_apellido"
                                    class="user-profile-form-input" value="<?php echo $currentUser->getApellido(); ?>"
                                    required>
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorLastName"></span>
                        </div>
                    </div>

                    <div class="user-profile-form-group">
                        <label for="user_profile_correo">Correo Electrónico</label>
                        <div class="user-profile-input-wrapper">
                            <i class="fas fa-envelope user-profile-input-icon"></i>
                            <input type="email" id="user_profile_correo" name="user_profile_correo"
                                class="user-profile-form-input" value="<?php echo $currentUser->getCorreo(); ?>"
                                disabled>
                        </div>
                        <span class="user-profile-error-message" id="user-profile-errorEmail"></span>
                    </div>

                    <div class="user-profile-form-row">
                        <div class="user-profile-form-group">
                            <label for="user_profile_fecha_nacimiento">Fecha de Nacimiento</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-calendar user-profile-input-icon"></i>
                                <input type="date" id="user_profile_fecha_nacimiento"
                                    name="user_profile_fecha_nacimiento" class="user-profile-form-input"
                                    value="<?php echo $currentUser->getFechaNacimiento(); ?>" required>
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorBirthday"></span>
                        </div>

                        <div class="user-profile-form-group">
                            <label for="user_profile_genero">Género</label>
                            <div class="user-profile-input-wrapper user-profile-select-wrapper">
                                <i class="fas fa-venus-mars user-profile-input-icon"></i>
                                <select id="user_profile_genero" name="user_profile_genero"
                                    class="user-profile-form-input" required>
                                    <option value="Masculino"
                                        <?php echo ($currentUser->getGenero() == 'Masculino') ? 'selected' : ''; ?>>
                                        Masculino</option>
                                    <option value="Femenino"
                                        <?php echo ($currentUser->getGenero() == 'Femenino') ? 'selected' : ''; ?>>
                                        Femenino</option>
                                    <option value="Otro"
                                        <?php echo ($currentUser->getGenero() == 'Otro') ? 'selected' : ''; ?>>
                                        Otro</option>
                                </select>
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorGender"></span>
                        </div>
                    </div>

                    <div class="user-profile-form-row">
                        <div class="user-profile-form-group">
                            <label for="user_profile_telefono">Teléfono</label>
                            <div class="user-profile-input-wrapper" id="inputPhone">
                                <i class="fas fa-phone user-profile-input-icon">+34</i>
                                <input type="tel" id="user_profile_telefono" name="user_profile_telefono"
                                    class="user-profile-form-input" value="<?php echo $currentUser->getTelefono(); ?>">
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorPhone"></span>
                        </div>

                        <div class="user-profile-form-group">
                            <label for="user_profile_peso">Peso (kg)</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-weight user-profile-input-icon"></i>
                                <input type="number" id="user_profile_peso" name="user_profile_peso"
                                    class="user-profile-form-input" step="0.1"
                                    value="<?php echo intval($currentUser->getPeso()); ?>">
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorWeight"></span>
                        </div>

                        <div class="user-profile-form-group">
                            <label for="user_profile_altura">Altura (cm)</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-ruler-vertical user-profile-input-icon"></i>
                                <input type="number" id="user_profile_altura" name="user_profile_altura"
                                    class="user-profile-form-input"
                                    value="<?php echo intval($currentUser->getAltura()); ?>">
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorHeight"></span>
                        </div>
                    </div>

                    <h3 class="user-profile-section-title">Seguridad de la Cuenta</h3>

                    <div class="user-profile-form-group">
                        <label for="user_profile_current_password">Contraseña Actual</label>
                        <div class="user-profile-input-wrapper">
                            <i class="fas fa-lock user-profile-input-icon"></i>
                            <input type="password" id="user_profile_current_password"
                                name="user_profile_current_password" class="user-profile-form-input">
                            <i class="fas fa-eye user-profile-toggle-password"></i>
                        </div>
                        <span class="user-profile-error-message" id="user-profile-errorCurrentPassword"></span>
                    </div>

                    <div class="user-profile-form-row">
                        <div class="user-profile-form-group">
                            <label for="user_profile_new_password">Nueva Contraseña</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-lock user-profile-input-icon"></i>
                                <input type="password" id="user_profile_new_password" name="user_profile_new_password"
                                    class="user-profile-form-input">
                                <i class="fas fa-eye user-profile-toggle-password"></i>
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorNewPassword"></span>
                            <div class="user-profile-password-strength-container">
                                <span id="user-profile-passwordStrengthText"></span>
                                <div class="user-profile-password-strength-bar">
                                    <div id="user-profile-passwordStrength" class="user-profile-strength-fill"></div>
                                </div>
                            </div>
                        </div>

                        <div class="user-profile-form-group">
                            <label for="user_profile_confirm_password">Confirmar Nueva Contraseña</label>
                            <div class="user-profile-input-wrapper">
                                <i class="fas fa-lock user-profile-input-icon"></i>
                                <input type="password" id="user_profile_confirm_password"
                                    name="user_profile_confirm_password" class="user-profile-form-input">
                                <i class="fas fa-eye user-profile-toggle-password"></i>
                            </div>
                            <span class="user-profile-error-message" id="user-profile-errorConfirmPassword"></span>
                        </div>
                    </div>

                    <div class="user-profile-form-actions">
                        <button type="submit" class="user-profile-btn-save" disabled>Guardar Cambios</button>
                        <button type="reset" class="user-profile-btn-cancel">Cancelar</button>
                    </div>

                    <div class="user-profile-danger-zone">
                        <h3 class="user-profile-danger-title">Zona de Peligro</h3>
                        <div class="user-profile-danger-content">
                            <div class="user-profile-danger-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>Las acciones en esta zona son permanentes y no se pueden deshacer.</p>
                            </div>
                            <button type="button" class="user-profile-btn-danger" id="user-profile-delete-account-btn">
                                <i class="fas fa-trash"></i> Eliminar mi cuenta
                            </button>
                            <p class="user-profile-danger-text">Esta acción no se puede deshacer. Se eliminarán
                                permanentemente todos tus datos y no podrás recuperar tu cuenta.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/profile.js"></script>
</section>