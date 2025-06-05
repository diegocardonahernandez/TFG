<section class="register-section">
    <div class="register-container">
        <div class="register-image-panel">
            <div class="overlay"></div>
            <div class="register-motivational">
                <h2 class="register-motto">COMIENZA TU VIAJE AHORA</h2>
                <p class="register-submotto">Únete a nuestra comunidad y transforma tu cuerpo y mente</p>
            </div>
        </div>

        <div class="register-form-panel">
            <div class="register-header">
                <div class="register-title-container">
                    <h1 class="register-title">Crear Cuenta</h1>
                </div>
            </div>

            <form class="register-form" action="/registerForm" method="post" enctype="multipart/form-data"
                id="register-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="registro_nombre">Nombre</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="registro_nombre" name="registro_nombre" class="form-input" required>
                            <i class="bi bi-check-circle-fill" id="iconNameCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorName"></span>
                    </div>

                    <div class="form-group">
                        <label for="registro_apellido">Apellido</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="registro_apellido" name="registro_apellido" class="form-input"
                                required>
                            <i class="bi bi-check-circle-fill" id="iconLastNameCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorLastName"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="registro_correo">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="registro_correo" name="registro_correo" class="form-input" required>
                        <i class="bi bi-check-circle-fill" id="iconEmailCheck"></i>
                    </div>
                    <span class="register-errorMessage" id="register-errorEmail"></span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="registro_contrasena">Contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="registro_contrasena" name="registro_contrasena"
                                class="form-input" required>
                            <i class="bi bi-check-circle-fill" id="iconPasswordCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorPassword"></span>
                        <div class="password-strength-container">
                            <span id="passwordStrengthText"></span>
                            <div class="password-strength-bar">
                                <div id="passwordStrength" class="strength-fill"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="registro_confirm_password">Confirmar Contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="registro_confirm_password" name="registro_confirm_password"
                                class="form-input" required>
                            <i class="bi bi-check-circle-fill" id="iconConfirmCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorConfirm"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="registro_fecha_nacimiento">Fecha de Nacimiento</label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar input-icon"></i>
                            <input type="date" id="registro_fecha_nacimiento" name="registro_fecha_nacimiento"
                                class="form-input" required>
                        </div>
                        <span class="register-errorMessage" id="register-errorBirthday"></span>
                    </div>

                    <div class="form-group">
                        <label for="registro_genero">Género</label>
                        <div class="input-wrapper select-wrapper">
                            <i class="fas fa-venus-mars input-icon"></i>
                            <select id="registro_genero" name="registro_genero" class="form-input" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <span class="register-errorMessage" id="register-errorGender"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="registro_telefono">Teléfono</label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone input-icon">+34</i>
                            <input type="tel" id="registro_telefono" name="registro_telefono" class="form-input">
                            <i class="bi bi-check-circle-fill" id="iconNumberCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorPhone"></span>
                    </div>

                    <div class="form-group">
                        <label for="registro_peso">Peso (kg)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-weight input-icon"></i>
                            <input type="number" id="registro_peso" name="registro_peso" class="form-input">
                            <i class="bi bi-check-circle-fill" id="iconWeightCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorWeight"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="registro_altura">Altura (cm)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-ruler-vertical input-icon"></i>
                            <input type="number" id="registro_altura" name="registro_altura" class="form-input">
                            <i class="bi bi-check-circle-fill" id="iconHeightCheck"></i>
                        </div>
                        <span class="register-errorMessage" id="register-errorHeight"></span>
                    </div>

                    <div class="form-group">
                        <label for="registro_foto_perfil">Foto de Perfil</label>
                        <div class="input-wrapper file-wrapper">
                            <i class="fas fa-camera input-icon"></i>
                            <input type="file" id="registro_foto_perfil" name="registro_foto_perfil"
                                class="form-input file-input" accept="image/*">
                        </div>
                        <span class="register-errorMessage" id="register-errorUserImage"></span>
                    </div>
                </div>

                <div class="form-options">
                    <div class="terms-agreement">
                        <input type="checkbox" id="registro_terms" name="registro_terms" required>
                        <label for="registro_terms">Acepto los <a href="/terms" class="terms-link">Términos y
                                Condiciones</a>
                            y la <a href="/privacy" class="terms-link">Política de Privacidad</a></label>
                    </div>
                </div>

                <div class="form-options">
                    <div class="newsletter-subscription">
                        <input type="checkbox" id="registro_newsletter" name="registro_newsletter">
                        <label for="registro_newsletter">Quiero recibir ofertas y novedades por email</label>
                    </div>
                </div>

                <button type="submit" class="btn-register" disabled>Crear Cuenta</button>
            </form>

            <div class="login-link">
                ¿Ya tienes una cuenta? <a href="/login">Inicia sesión</a>
            </div>
        </div>
    </div>
    <script src="/js/validateRegisterForm.js"></script>
</section>