import {
  calculateTMB,
  activityLevel,
  adjustAccordingToGoal,
  macroNutrientDistribution,
} from "./utils/formulasCaloriesCalc.js";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("calorieCalculatorForm");
  const heightInput = document.getElementById("cal-height");
  const weightInput = document.getElementById("cal-weight");
  const ageInput = document.getElementById("cal-age");
  const activityLevelInput = document.getElementById("cal-activity");
  const resultContainer = document.getElementById("calorieResultsContainer");
  const resultCalories = document.getElementById("calorieValue");
  const resultProteinGrams = document.getElementById("proteinGrams");
  const resultCarbsGrams = document.getElementById("carbsGrams");
  const resultFatGrams = document.getElementById("fatGrams");
  const resultProteinCalories = document.getElementById("proteinCalories");
  const resultCarbsCalories = document.getElementById("carbsCalories");
  const resultFatCalories = document.getElementById("fatCalories");
  const initialText = document.getElementById("calorieInitialText");
  const nutrientsChart = document.getElementById("macroChart");
  const productsGoalContainer = document.getElementById("calorieProducts");
  const resetButton = document.getElementById("calorieResetBtn");

  let nutrientsChartInstance = null;

  // Función para mostrar animaciones
  function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      const currentValue = Math.floor(progress * (end - start) + start);
      element.innerHTML = currentValue;
      if (progress < 1) {
        window.requestAnimationFrame(step);
      }
    };
    window.requestAnimationFrame(step);
  }

  // Función para animar la aparición de elementos con delay
  function animateElements(elements, delay = 100) {
    elements.forEach((element, index) => {
      setTimeout(() => {
        element.style.opacity = "1";
        element.style.transform = "translateY(0)";
      }, index * delay);
    });
  }

  function loadRecommendedProducts() {
    const formData = new FormData(form);

    fetch("/caloriesForm", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        const productsGoal = data.productsGoal;
        productsGoalContainer.innerHTML = "";

        if (productsGoal && productsGoal.length > 0) {
          productsGoal.forEach((product) => {
            // Verificar las propiedades que vienen en el objeto product
            console.log("Producto recibido:", product);

            // Usar las propiedades correctas con verificación de existencia
            const productHTML = `
          <div class="calorie-product-card">
            <img src="${product.imagen || ""}" alt="${
              product.nombre || "Producto"
            }" class="calorie-product-image">
            <div class="calorie-product-content">
              <h5 class="calorie-product-name">${
                product.nombre || "Producto sin nombre"
              }</h5>
              <p class="calorie-product-description">${
                product.descripcion || "Sin descripción"
              }</p>
              <a href="/product?id=${
                product.id_producto || product.IdProducto || "#"
              }" class="calorie-product-btn">Ver producto</a>
            </div>
          </div>
        `;

            productsGoalContainer.innerHTML += productHTML;
          });
        } else {
          productsGoalContainer.innerHTML =
            "<p>No se encontraron productos recomendados.</p>";
        }
      })
      .catch((error) => {
        console.error("Error al obtener los productos:", error);
        productsGoalContainer.innerHTML =
          "<p>Hubo un error al cargar los productos. Detalles: " +
          error.message +
          "</p>";
      });
  }

  // Evento de envío del formulario
  form.addEventListener("submit", (event) => {
    event.preventDefault();

    // Mostrar indicador de carga
    initialText.innerHTML =
      '<i class="fas fa-circle-notch fa-spin"></i> Calculando...';

    // Simulamos un breve retraso para dar sensación de procesamiento
    setTimeout(() => {
      // Obtener el objetivo seleccionado
      const selectedGoal = document.querySelector(
        "input[name=goal]:checked"
      ).value;

      // Realizar cálculos
      const tmb = calculateTMB(
        +weightInput.value,
        +heightInput.value,
        +ageInput.value,
        document.querySelector("input[name=gender]:checked").value
      );

      const calories = activityLevel(tmb, +activityLevelInput.value);

      const result = adjustAccordingToGoal(calories, selectedGoal);

      const nutrients = macroNutrientDistribution(result, +weightInput.value);

      // Cargar productos recomendados (pasando el objetivo)
      loadRecommendedProducts();

      // Preparar para animaciones (establecer valores iniciales)
      resultProteinGrams.innerHTML = "0";
      resultCarbsGrams.innerHTML = "0";
      resultFatGrams.innerHTML = "0";
      resultProteinCalories.innerHTML = "0";
      resultCarbsCalories.innerHTML = "0";
      resultFatCalories.innerHTML = "0";
      resultCalories.innerHTML = "0";

      // Mostrar contenedor de resultados
      resultContainer.style.display = "block";
      initialText.innerHTML = "Resultados:";

      // Configurar animaciones de elementos con opacidad y posición
      const macroItems = document.querySelectorAll(".calorie-macro-item");
      macroItems.forEach((item) => {
        item.style.opacity = "0";
        item.style.transform = "translateY(20px)";
        item.style.transition = "opacity 0.5s ease, transform 0.5s ease";
      });

      // Iniciar animación de conteo para el valor de calorías
      animateValue(resultCalories, 0, Math.round(result), 1500);

      // Iniciar animaciones para los valores de macronutrientes (con un poco de retraso)
      setTimeout(() => {
        animateValue(
          resultProteinGrams,
          0,
          Math.round(nutrients.proteinGrams),
          1200
        );
        animateValue(
          resultCarbsGrams,
          0,
          Math.round(nutrients.carbsGrams),
          1200
        );
        animateValue(resultFatGrams, 0, Math.round(nutrients.fatGrams), 1200);
        animateValue(
          resultProteinCalories,
          0,
          Math.round(nutrients.proteinCalories),
          1200
        );
        animateValue(
          resultCarbsCalories,
          0,
          Math.round(nutrients.carbsCalories),
          1200
        );
        animateValue(
          resultFatCalories,
          0,
          Math.round(nutrients.fatCalories),
          1200
        );

        // Animar aparición de elementos
        animateElements(macroItems, 150);
      }, 600);

      // Eliminar instancia de gráfico existente si hay una
      if (nutrientsChartInstance) {
        nutrientsChartInstance.destroy();
      }

      // Crear nueva instancia de gráfico con animación
      setTimeout(() => {
        nutrientsChartInstance = new Chart(nutrientsChart, {
          type: "doughnut",
          data: {
            labels: ["Proteínas", "Carbohidratos", "Grasas"],
            datasets: [
              {
                data: [
                  nutrients.proteinCalories.toFixed(0),
                  nutrients.carbsCalories.toFixed(0),
                  nutrients.fatCalories.toFixed(0),
                ],
                backgroundColor: ["#d62839", "#ff9505", "#0a2463"],
                hoverBackgroundColor: ["#f73b51", "#ffb23d", "#2565c9"],
                borderWidth: 0,
                hoverOffset: 8,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: "70%",
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                callbacks: {
                  label: function (context) {
                    const label = context.label || "";
                    const value = context.formattedValue;
                    const percentage = Math.round((context.raw / result) * 100);
                    return `${label}: ${value} kcal (${percentage}%)`;
                  },
                },
                padding: 12,
                boxPadding: 6,
              },
            },
            animation: {
              animateScale: true,
              animateRotate: true,
              duration: 1200,
              easing: "easeOutCirc",
            },
          },
        });
      }, 400);
    }, 800); // Fin de setTimeout
  });

  // Evento de reset del formulario
  resetButton.addEventListener("click", () => {
    form.reset();

    // Ocultar resultados con animación fade-out
    resultContainer.style.opacity = "0";
    setTimeout(() => {
      resultContainer.style.display = "none";
      resultContainer.style.opacity = "1"; // Restaurar opacidad para próxima vez
      initialText.style.display = "block";
      initialText.innerHTML =
        "Completa el formulario para ver tus necesidades calóricas";
      productsGoalContainer.innerHTML = ""; // Limpiar contenedor de productos
    }, 300);

    // Si hay un gráfico, destruirlo
    if (nutrientsChartInstance) {
      nutrientsChartInstance.destroy();
      nutrientsChartInstance = null;
    }
  });

  // Inicializar transiciones
  resultContainer.style.transition = "opacity 0.3s ease";
});
