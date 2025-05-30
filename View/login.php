<section class="login-section">
    <div class="login-container">
        <div class="login-image-panel">
            <div class="overlay"></div>
            <div class="login-motivational">
                <h2 class="login-motto">EL CAMINO HACIA TU MEJOR VERSIÓN</h2>
                <p class="login-submotto">Accede a tu cuenta y continúa superando tus límites</p>
            </div>
        </div>

        <div class="login-form-panel">
            <div class="login-header">
                <div class="login-title-container">
                    <h1 class="login-title">Iniciar Sesión</h1>
                </div>
            </div>

            <form class="login-form" action="/loginForm" method="POST">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="text" id="email" name="login_email" class="form-input" required>
                    </div>
                    <span class="login-errorMessage" id="login-errorEmail"></span>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="login_password" class="form-input" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <span class="login-errorMessage" id="login-errorPassw">hhhhh</span>
                </div>

                <div class="form-options">
                    <div class="form-help">
                        <a href="#" class="help-link">¿Necesitas ayuda?</a>
                    </div>
                </div>


                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>


            <div class="register-link">
                ¿No tienes una cuenta?
                <a href="/register" class="register-link-a">Regístrate ahora</a>
            </div>

        </div>
    </div>
    <script src="/js/validateLogin.js"></script>
</section>