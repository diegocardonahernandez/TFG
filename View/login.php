<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="login-container">
                    <!-- Lado izquierdo: Imagen y mensaje motivacional -->
                    <div class="login-image-side">
                        <div class="login-overlay">
                            <div class="login-overlay-content">
                                <h2 class="login-overlay-title">¡Bienvenido de nuevo!</h2>
                                <p class="login-overlay-subtitle">Tu camino hacia tus objetivos continúa aquí</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lado derecho: Formulario de inicio de sesión -->
                    <div class="login-form-side">
                        <div class="login-form-header">
                            <h1 class="login-title">Iniciar Sesión</h1>
                            <p class="login-subtitle">Accede a tu cuenta para gestionar tus pedidos y mucho más</p>
                        </div>

                        <form class="login-form" id="loginForm">
                            <div class="login-form-group">
                                <label for="email" class="login-form-label">Correo Electrónico</label>
                                <div class="login-input-wrapper">
                                    <i class="fas fa-envelope login-input-icon"></i>
                                    <input type="email" id="email" class="login-form-input" placeholder="ejemplo@correo.com" required>
                                </div>
                            </div>

                            <div class="login-form-group">
                                <label for="password" class="login-form-label">Contraseña</label>
                                <div class="login-input-wrapper">
                                    <i class="fas fa-lock login-input-icon"></i>
                                    <input type="password" id="password" class="login-form-input" placeholder="Tu contraseña" required>
                                    <i class="fas fa-eye login-toggle-password" id="togglePassword"></i>
                                </div>
                            </div>

                            <div class="login-options">
                                <div class="login-remember">
                                    <input type="checkbox" id="remember" class="login-checkbox">
                                    <label for="remember">Recordar sesión</label>
                                </div>
                                <a href="#" class="login-forgot">¿Olvidaste tu contraseña?</a>
                            </div>

                            <button type="submit" class="login-btn-submit">
                                <span>Iniciar Sesión</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>

                        </form>

                        <div class="login-register-cta">
                            <p>¿No tienes una cuenta?</p>
                            <a href="/registro" class="login-register-link">Regístrate ahora</a>
                        </div>

                        <div class="login-info">
                            <p>Al iniciar sesión, aceptas nuestros <a href="#">Términos y condiciones</a> y <a href="#">Política de privacidad</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Registro - Solo información sobre qué datos se solicitarán -->
<div class="modal fade" id="registerInfoModal" tabindex="-1" aria-labelledby="registerInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content register-modal">
            <div class="modal-header register-modal-header">
                <h5 class="modal-title" id="registerInfoModalLabel">Información de Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body register-modal-body">
                <p>Para registrarte necesitarás proporcionar:</p>
                <ul class="register-info-list">
                    <li><i class="fas fa-user"></i> Nombre y Apellido</li>
                    <li><i class="fas fa-phone"></i> Teléfono</li>
                    <li><i class="fas fa-envelope"></i> Correo Electrónico</li>
                    <li><i class="fas fa-lock"></i> Contraseña</li>
                    <li><i class="fas fa-calendar"></i> Fecha de Nacimiento</li>
                    <li><i class="fas fa-venus-mars"></i> Género</li>
                    <li><i class="fas fa-weight"></i> Peso</li>
                    <li><i class="fas fa-ruler-vertical"></i> Altura</li>
                </ul>
                <p class="register-info-note">Estos datos nos ayudarán a personalizar tu experiencia y recomendaciones de productos.</p>
            </div>
            <div class="modal-footer register-modal-footer">
                <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="/registro" class="btn-register-redirect">Ir a Registro</a>
            </div>
        </div>
    </div>
</div>