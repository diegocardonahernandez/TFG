<!-- Register Section -->
<section class="register-section">
    <div class="register-container">
        <!-- Panel izquierdo con imagen y mensaje motivacional -->
        <div class="register-image-panel">
            <div class="overlay"></div>
            <div class="register-motivational">
                <h2 class="register-motto">COMIENZA TU VIAJE AHORA</h2>
                <p class="register-submotto">Únete a nuestra comunidad y transforma tu cuerpo y mente</p>
            </div>
        </div>

        <!-- Panel derecho con formulario de registro -->
        <div class="register-form-panel">
            <!-- Logo y cabecera -->
            <div class="register-header">
                <div class="register-title-container">
                    <h1 class="register-title">Crear Cuenta</h1>
                </div>
            </div>

            <!-- Formulario -->
            <form class="register-form" action="process_register.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="nombre" name="nombre" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="apellido" name="apellido" class="form-input" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="correo" name="correo" class="form-input" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="contrasena" name="contrasena" class="form-input" required>
                            <i class="fas fa-eye toggle-password"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-input"
                                required>
                            <i class="fas fa-eye toggle-password"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar input-icon"></i>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-input"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genero">Género</label>
                        <div class="input-wrapper select-wrapper">
                            <i class="fas fa-venus-mars input-icon"></i>
                            <select id="genero" name="genero" class="form-input" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefono">Teléfono (opcional)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="tel" id="telefono" name="telefono" class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="peso">Peso (kg) (opcional)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-weight input-icon"></i>
                            <input type="number" id="peso" name="peso" step="0.01" min="30" max="300"
                                class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="altura">Altura (m) (opcional)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-ruler-vertical input-icon"></i>
                            <input type="number" id="altura" name="altura" step="0.01" min="1" max="2.5"
                                class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="foto_perfil">Foto de Perfil</label>
                    <div class="input-wrapper file-wrapper">
                        <i class="fas fa-camera input-icon"></i>
                        <input type="file" id="foto_perfil" name="foto_perfil" class="form-input file-input"
                            accept="image/*">
                        <div class="file-preview-container">
                            <img id="preview-image" src="/imgs/default-avatar.png" alt="Vista previa">
                        </div>
                    </div>
                </div>

                <div class="form-options">
                    <div class="terms-agreement">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">Acepto los <a href="terms.php" class="terms-link">Términos y Condiciones</a>
                            y la <a href="privacy.php" class="terms-link">Política de Privacidad</a></label>
                    </div>
                </div>

                <div class="form-options">
                    <div class="newsletter-subscription">
                        <input type="checkbox" id="newsletter" name="newsletter">
                        <label for="newsletter">Quiero recibir ofertas y novedades por email</label>
                    </div>
                </div>

                <button type="submit" class="btn-register">Crear Cuenta</button>
            </form>

            <div class="login-link">
                ¿Ya tienes una cuenta? <a href="/login">Inicia sesión</a>
            </div>
        </div>
    </div>
</section>