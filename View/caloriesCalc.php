<section class="calorie-header">
    <div class="container">
        <div class="calorie-title-container">
            <h1 class="calorie-title">Calculadora de Calorías</h1>
            <p class="calorie-subtitle">Determina tus necesidades calóricas y macronutrientes según tus objetivos</p>
        </div>
    </div>
</section>

<section class="calorie-calculator-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="calorie-calculator-card">
                    <div class="calorie-calculator-content">
                        <h3 class="calorie-calculator-title">Ingresa tus datos</h3>
                        <p class="calorie-calculator-description">Completa los campos para calcular tus necesidades
                            calóricas y recomendaciones de macronutrientes.</p>

                        <form id="calorieCalculatorForm" class="calorie-calculator-form" method="POST"
                            action="/caloriesForm">
                            <div class="calorie-form-group">
                                <label for="cal-height" class="calorie-form-label">Altura (cm)</label>
                                <div class="calorie-input-wrapper">
                                    <input type="number" id="cal-height" class="calorie-form-input"
                                        placeholder="Ej: 170" min="100" max="250" required>
                                    <span class="calorie-input-suffix">cm</span>
                                </div>
                            </div>

                            <div class="calorie-form-group">
                                <label for="cal-weight" class="calorie-form-label">Peso (kg)</label>
                                <div class="calorie-input-wrapper">
                                    <input type="number" id="cal-weight" class="calorie-form-input" placeholder="Ej: 70"
                                        min="30" max="300" required>
                                    <span class="calorie-input-suffix">kg</span>
                                </div>
                            </div>

                            <div class="calorie-form-group">
                                <label for="cal-age" class="calorie-form-label">Edad</label>
                                <div class="calorie-input-wrapper">
                                    <input type="number" id="cal-age" class="calorie-form-input" placeholder="Ej: 30"
                                        min="15" max="100" required>
                                    <span class="calorie-input-suffix">años</span>
                                </div>
                            </div>

                            <div class="calorie-form-group">
                                <label class="calorie-form-label">Género</label>
                                <div class="calorie-radio-group">
                                    <div class="calorie-radio-option">
                                        <input type="radio" id="cal-male" name="gender" value="male" checked>
                                        <label for="cal-male">Hombre</label>
                                    </div>
                                    <div class="calorie-radio-option">
                                        <input type="radio" id="cal-female" name="gender" value="female">
                                        <label for="cal-female">Mujer</label>
                                    </div>
                                </div>
                            </div>

                            <div class="calorie-form-group">
                                <label class="calorie-form-label">Nivel de actividad</label>
                                <select id="cal-activity" class="calorie-form-input">
                                    <option value="1.2">Sedentario (poco o ningún ejercicio)</option>
                                    <option value="1.375">Ligero (ejercicio 1-3 días/semana)</option>
                                    <option value="1.55" selected>Moderado (ejercicio 3-5 días/semana)</option>
                                    <option value="1.725">Activo (ejercicio 6-7 días/semana)</option>
                                    <option value="1.9">Muy activo (atleta o trabajo físico intenso)</option>
                                </select>
                            </div>

                            <div class="calorie-form-group">
                                <label class="calorie-form-label">Objetivo</label>
                                <div class="calorie-goal-options">
                                    <div class="calorie-goal-option">
                                        <input type="radio" id="goal-lose" name="goal" value="lose" checked>
                                        <label for="goal-lose" class="calorie-goal-label">
                                            <i class="fas fa-weight"></i>
                                            <span>Perder Peso</span>
                                            <small>Déficit calórico para reducir grasa</small>
                                        </label>
                                    </div>
                                    <div class="calorie-goal-option">
                                        <input type="radio" id="goal-maintain" name="goal" value="maintain">
                                        <label for="goal-maintain" class="calorie-goal-label">
                                            <i class="fas fa-balance-scale"></i>
                                            <span>Mantener Peso</span>
                                            <small>Equilibrio calórico</small>
                                        </label>
                                    </div>
                                    <div class="calorie-goal-option">
                                        <input type="radio" id="goal-gain" name="goal" value="gain">
                                        <label for="goal-gain" class="calorie-goal-label">
                                            <i class="fas fa-dumbbell"></i>
                                            <span>Ganar Masa</span>
                                            <small>Superávit calórico para ganar músculo</small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="calorie-form-actions">
                                <button type="submit" class="calorie-btn-calculate" id="calorieCalculateBtn">
                                    <i class="fas fa-calculator"></i> Calcular Calorías
                                </button>
                                <button type="reset" class="calorie-btn-reset" id="calorieResetBtn">
                                    <i class="fas fa-redo"></i> Reiniciar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="calorie-results-card">
                    <div class="calorie-results-content">
                        <h3 class="calorie-results-title">Tus necesidades nutricionales</h3>

                        <div id="calorieInitialState" class="calorie-initial-state">
                            <div class="calorie-icon-container">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <p class="calorie-initial-text" id="calorieInitialText">Completa el formulario para ver tus
                                necesidades calóricas</p>
                        </div>

                        <div id="calorieResultsContainer" class="calorie-results-container" style="display: none;">
                            <div class="calorie-result-summary">
                                <div class="calorie-daily-value">
                                    <span id="calorieValue">0</span>
                                    <div class="calorie-daily-label">calorías diarias</div>
                                </div>
                            </div>

                            <div class="calorie-macros-container">
                                <h4 class="calorie-macros-title">Distribución de macronutrientes</h4>

                                <div class="calorie-macro-chart">
                                    <div class="calorie-chart-container">
                                        <canvas id="macroChart"></canvas>
                                    </div>
                                    <div class="calorie-chart-legend">
                                        <div class="calorie-legend-item">
                                            <span class="calorie-legend-color protein-color"></span>
                                            <span class="calorie-legend-text">Proteínas</span>
                                        </div>
                                        <div class="calorie-legend-item">
                                            <span class="calorie-legend-color carbs-color"></span>
                                            <span class="calorie-legend-text">Carbohidratos</span>
                                        </div>
                                        <div class="calorie-legend-item">
                                            <span class="calorie-legend-color fat-color"></span>
                                            <span class="calorie-legend-text">Grasas</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="calorie-macros-breakdown">
                                    <div class="calorie-macro-item">
                                        <div class="calorie-macro-icon protein-icon">
                                            <i class="fas fa-drumstick-bite"></i>
                                        </div>
                                        <div class="calorie-macro-content">
                                            <div class="calorie-macro-name">Proteínas</div>
                                            <div class="calorie-macro-value">
                                                <span id="proteinGrams">0</span>g
                                                (<span id="proteinCalories">0</span> kcal)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="calorie-macro-item">
                                        <div class="calorie-macro-icon carbs-icon">
                                            <i class="fas fa-bread-slice"></i>
                                        </div>
                                        <div class="calorie-macro-content">
                                            <div class="calorie-macro-name">Carbohidratos</div>
                                            <div class="calorie-macro-value">
                                                <span id="carbsGrams">0</span>g
                                                (<span id="carbsCalories">0</span> kcal)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="calorie-macro-item">
                                        <div class="calorie-macro-icon fat-icon">
                                            <i class="fas fa-cheese"></i>
                                        </div>
                                        <div class="calorie-macro-content">
                                            <div class="calorie-macro-name">Grasas</div>
                                            <div class="calorie-macro-value">
                                                <span id="fatGrams">0</span>g
                                                (<span id="fatCalories">0</span> kcal)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="calorie-products-suggestion">
                                <h4 class="calorie-products-title">Suplementos recomendados</h4>
                                <div class="calorie-products-container" id="calorieProducts">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="calorie-info-card">
                    <div class="calorie-info-header">
                        <h3 class="calorie-info-title">¿Por qué calcular tus necesidades calóricas?</h3>
                    </div>
                    <div class="calorie-info-content">
                        <p>Conocer tus necesidades calóricas diarias es fundamental para alcanzar tus objetivos de
                            fitness. Ya sea que busques perder peso, ganar masa muscular o mantener tu composición
                            corporal actual, la nutrición adecuada es clave para el éxito.</p>

                        <h4 class="calorie-info-subtitle">Macronutrientes y su importancia:</h4>
                        <div class="calorie-info-macros">
                            <div class="calorie-info-macro-item">
                                <div class="calorie-info-macro-header protein-header">
                                    <i class="fas fa-drumstick-bite"></i>
                                    <h5>Proteínas</h5>
                                </div>
                                <div class="calorie-info-macro-content">
                                    <p>Fundamentales para la reparación y construcción de tejido muscular. Aportan 4
                                        calorías por gramo.</p>
                                </div>
                            </div>
                            <div class="calorie-info-macro-item">
                                <div class="calorie-info-macro-header carbs-header">
                                    <i class="fas fa-bread-slice"></i>
                                    <h5>Carbohidratos</h5>
                                </div>
                                <div class="calorie-info-macro-content">
                                    <p>Principal fuente de energía para el cuerpo y el cerebro. Aportan 4 calorías por
                                        gramo.</p>
                                </div>
                            </div>
                            <div class="calorie-info-macro-item">
                                <div class="calorie-info-macro-header fat-header">
                                    <i class="fas fa-cheese"></i>
                                    <h5>Grasas</h5>
                                </div>
                                <div class="calorie-info-macro-content">
                                    <p>Esenciales para la absorción de vitaminas y la producción hormonal. Aportan 9
                                        calorías por gramo.</p>
                                </div>
                            </div>
                        </div>

                        <div class="calorie-disclaimer">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Esta calculadora proporciona una estimación de tus necesidades calóricas basada en
                                fórmulas establecidas. Las necesidades individuales pueden variar según factores como la
                                composición corporal, metabolismo y nivel de actividad específicos. Para un plan
                                nutricional personalizado, consulta con un nutricionista deportivo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/animations/animationCalories.js"></script>
    <script type="module" src="/js/caloriesCalculator.js"></script>
</section>