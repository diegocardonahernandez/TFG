<section class="imc-header">
    <div class="container">
        <div class="imc-title-container">
            <h1 class="imc-title"><span>Calculadora de IMC</span></h1>
            <p class="imc-subtitle">Calcula tu Índice de Masa Corporal y descubre tu estado físico actual</p>
        </div>
    </div>
</section>

<section class="imc-calculator-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="imc-calculator-card">
                    <div class="imc-calculator-content">
                        <h3 class="imc-calculator-title">Ingresa tus datos</h3>
                        <p class="imc-calculator-description">Completa los campos para calcular tu IMC y conocer tu
                            estado físico actual.</p>

                        <form id="imcCalculatorForm" class="imc-calculator-form">
                            <div class="imc-form-group">
                                <label for="height" class="imc-form-label">Altura (cm)</label>
                                <div class="imc-input-wrapper">
                                    <input type="number" id="imc-height" class="imc-form-input" placeholder="Ej: 170"
                                        min="100" max="250" required>
                                    <span class="imc-input-suffix">cm</span>
                                </div>
                            </div>

                            <div class="imc-form-group">
                                <label for="weight" class="imc-form-label">Peso (kg)</label>
                                <div class="imc-input-wrapper">
                                    <input type="number" id="imc-weight" class="imc-form-input" placeholder="Ej: 70"
                                        min="30" max="300" required>
                                    <span class="imc-input-suffix">kg</span>
                                </div>
                            </div>

                            <div class="imc-form-group">
                                <label class="imc-form-label">Género</label>
                                <div class="imc-radio-group">
                                    <div class="imc-radio-option">
                                        <input type="radio" id="male" name="gender" value="male" checked>
                                        <label for="male">Hombre</label>
                                    </div>
                                    <div class="imc-radio-option">
                                        <input type="radio" id="female" name="gender" value="female">
                                        <label for="female">Mujer</label>
                                    </div>
                                </div>
                                <p></p>
                            </div>

                            <div class="imc-form-actions">
                                <button type="submit" class="imc-btn-calculate">
                                    <i class="fas fa-calculator"></i> Calcular IMC
                                </button>
                                <button type="reset" class="imc-btn-reset">
                                    <i class="fas fa-redo"></i> Reiniciar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="imc-results-card">
                    <div class="imc-results-content">
                        <h3 class="imc-results-title"><a href="#imcExplication">Índice de Masa Corporal</a></h3>

                        <div id="imcInitialState" class="imc-initial-state">
                            <div class="imc-icon-container">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <p class="imc-initial-text" id="imcInitialText">Completa el formulario para ver tu resultado
                                de IMC</p>
                        </div>

                        <div id="imcResultsContainer" class="imc-results-container" style="display: none;">
                            <div class="imc-result-indicator">
                                <div class="imc-result-value">
                                    <span id="imcValue">0.0</span>
                                </div>
                                <div class="imc-result-category" id="imcCategory">
                                    Categoría
                                </div>
                            </div>

                            <div class="imc-result-interpretation">
                                <p class="imc-interpretation-text" id="imcInterpretation">
                                    Complete el formulario para ver la interpretación.
                                </p>
                            </div>

                            <div class="imc-scale-container">
                                <div class="imc-scale">
                                    <div class="imc-scale-segment imc-segment-underweight" data-tooltip="Bajo peso">
                                        <span>&lt;18.5</span>
                                    </div>
                                    <div class="imc-scale-segment imc-segment-normal" data-tooltip="Normal">
                                        <span>18.5-24.9</span>
                                    </div>
                                    <div class="imc-scale-segment imc-segment-overweight" data-tooltip="Sobrepeso">
                                        <span>25-29.9</span>
                                    </div>
                                    <div class="imc-scale-segment imc-segment-obese" data-tooltip="Obesidad">
                                        <span>&gt;30</span>
                                    </div>
                                </div>
                                <div class="imc-scale-marker" id="imcMarker"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="imc-consultation-banner">
                    <div class="imc-consultation-content">
                        <div class="imc-consultation-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="imc-consultation-text">
                            <h3>¿Necesitas asesoramiento profesional?</h3>
                            <p>Nuestros especialistas pueden ofrecerte un plan personalizado según tus resultados de IMC
                            </p>
                        </div>

                        <?php
                        if (!isset($_SESSION['userId'])) {
                            echo '<div class="imc-consultation-action">
                            <a href="/login" class="imc-consultation-btn"
                                <i class="fas fa-calendar-check"></i> Iniciar Sesión
                            </a>
                        </div>';
                        } else {
                            echo '  <div class="imc-consultation-action">
                            <form action="/schedule-consultation" method="POST" class="imc-consultation-form" id="consultaForm">
                                <input type="hidden" name="fecha-consulta" id="hidden-fecha-consulta">
                                <input type="hidden" name="motivo-consulta" id="hidden-motivo-consulta">
                                <button type="submit" class="imc-consultation-btn" id="scheduleBtn">
                                    <i class="fas fa-calendar-check"></i> Agendar consulta
                                </button>
                            </form>
                        </div>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="imc-info-card" id="imcExplication">
                    <div class="imc-info-header">
                        <h3 class="imc-info-title">¿Qué es el IMC?</h3>
                    </div>
                    <div class="imc-info-content">
                        <p>El Índice de Masa Corporal (IMC) es una medida que relaciona el peso con la altura. Se
                            calcula dividiendo el peso en kilogramos por el cuadrado de la altura en metros (kg/m²).</p>

                        <h4 class="imc-info-subtitle">Clasificación del IMC según la OMS:</h4>
                        <ul class="imc-info-list">
                            <li class="imc-info-item">
                                <span class="imc-info-label">Bajo peso:</span>
                                <span class="imc-info-value">IMC inferior a 18.5</span>
                            </li>
                            <li class="imc-info-item">
                                <span class="imc-info-label">Peso normal:</span>
                                <span class="imc-info-value">IMC entre 18.5 y 24.9</span>
                            </li>
                            <li class="imc-info-item">
                                <span class="imc-info-label">Sobrepeso:</span>
                                <span class="imc-info-value">IMC entre 25 y 29.9</span>
                            </li>
                            <li class="imc-info-item">
                                <span class="imc-info-label">Obesidad grado I:</span>
                                <span class="imc-info-value">IMC entre 30 y 34.9</span>
                            </li>
                            <li class="imc-info-item">
                                <span class="imc-info-label">Obesidad grado II:</span>
                                <span class="imc-info-value">IMC entre 35 y 39.9</span>
                            </li>
                            <li class="imc-info-item">
                                <span class="imc-info-label">Obesidad grado III:</span>
                                <span class="imc-info-value">IMC superior a 40</span>
                            </li>
                        </ul>

                        <div class="imc-disclaimer">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>El IMC es solo un indicador y no considera la distribución de la masa corporal, el
                                género, la edad u otros factores importantes. Consulta siempre con un profesional de la
                                salud para una evaluación completa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/animations/animationIMC.js"></script>
    <script src="/js/utils/scheduleDate.js"></script>
    <script src="/js/imcCalculator.js"></script>
</section>