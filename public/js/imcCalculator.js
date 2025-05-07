// Script principal para la calculadora de IMC
document.addEventListener("DOMContentLoaded", function () {
  // Elementos del DOM
  const formIMC = document.getElementById("imcCalculatorForm");
  const heightInput = document.getElementById("imc-height");
  const weightInput = document.getElementById("imc-weight");
  const resultContainer = document.getElementById("imcResultsContainer");
  const initialState = document.getElementById("imcInitialState");
  const resultIMC = document.querySelector(".imc-result-value");
  const imcInterpretation = document.getElementById("imcInterpretation");
  const categoryElement = document.getElementById("imcCategory");

  // Añadir CSS necesario para los marcadores (inmediatamente)
  addMarkerStyles();

  // Función para calcular IMC
  function calculateIMC(weight, height) {
    const heightInMeters = height / 100;
    return weight / Math.pow(heightInMeters, 2);
  }

  // Función que se ejecuta al enviar el formulario
  formIMC.addEventListener("submit", function (event) {
    event.preventDefault();

    const height = +heightInput.value;
    const weight = +weightInput.value;

    const imc = calculateIMC(weight, height);

    // Formatear IMC a un decimal
    const formattedIMC = parseFloat(imc.toFixed(1));

    // Mostrar resultado
    resultContainer.style.display = "block";
    initialState.style.display = "none";

    // Asegurar que el valor del IMC se actualice correctamente
    resultIMC.innerHTML = formattedIMC;

    // Mostrar la interpretación (en lugar de ocultarla)
    imcInterpretation.style.display = "block";

    // Generar interpretación del IMC
    generateInterpretation(formattedIMC);

    // Posicionar el marcador en la escala
    positionImcMarker(formattedIMC);

    // Mostrar productos recomendados basados en IMC
    showRecommendedProducts(formattedIMC);
  });

  // Agregar listener para resetear el formulario
  formIMC.addEventListener("reset", function () {
    resultContainer.style.display = "none";
    initialState.style.display = "block";

    // Resetear el marcador
    const marker = document.getElementById("imcMarker");
    if (marker) {
      marker.style.display = "none";
    }
  });

  /**
   * Posiciona el marcador en la escala de IMC según el valor calculado
   * @param {number} imcValue - Valor del IMC calculado
   */
  function positionImcMarker(imcValue) {
    const marker = document.getElementById("imcMarker");
    const scaleContainer = document.querySelector(".imc-scale-container");

    // Si no existe el marcador, crearlo
    if (!marker) {
      const newMarker = document.createElement("div");
      newMarker.id = "imcMarker";
      newMarker.className = "imc-scale-marker";
      scaleContainer.appendChild(newMarker);
    }

    // Obtener el ancho total de la escala
    const scaleWidth = document.querySelector(".imc-scale").offsetWidth;

    // Definir los límites de la escala IMC para el cálculo
    const minIMC = 15; // Valor mínimo considerado en la escala
    const maxIMC = 40; // Valor máximo considerado en la escala
    const imcRange = maxIMC - minIMC;

    // Limitar el valor de IMC para la visualización en la escala
    let boundedIMC = Math.max(minIMC, Math.min(maxIMC, imcValue));

    // Calcular la posición porcentual en la escala
    let percentage = ((boundedIMC - minIMC) / imcRange) * 100;

    // Limitar el porcentaje entre 0% y 100%
    percentage = Math.max(0, Math.min(100, percentage));

    // Posicionar el marcador
    const markerElement = document.getElementById("imcMarker");
    markerElement.style.left = `${percentage}%`;

    // Hacer visible el marcador
    markerElement.style.display = "block";

    // Actualizar la categoría y el color del marcador
    updateCategoryAndMarker(imcValue);
  }

  /**
   * Actualiza la categoría de IMC y el color del marcador
   * @param {number} imcValue - Valor del IMC calculado
   */
  function updateCategoryAndMarker(imcValue) {
    const marker = document.getElementById("imcMarker");

    // Resetear clases del marcador
    marker.className = "imc-scale-marker";

    // Determinar la categoría según el valor IMC
    let category, markerClass;

    if (imcValue < 18.5) {
      category = "Bajo peso";
      markerClass = "imc-marker-underweight";
    } else if (imcValue >= 18.5 && imcValue < 25) {
      category = "Peso normal";
      markerClass = "imc-marker-normal";
    } else if (imcValue >= 25 && imcValue < 30) {
      category = "Sobrepeso";
      markerClass = "imc-marker-overweight";
    } else if (imcValue >= 30 && imcValue < 35) {
      category = "Obesidad grado I";
      markerClass = "imc-marker-obese";
    } else if (imcValue >= 35 && imcValue < 40) {
      category = "Obesidad grado II";
      markerClass = "imc-marker-obese";
    } else {
      category = "Obesidad grado III";
      markerClass = "imc-marker-obese";
    }

    // Actualizar el texto de la categoría
    categoryElement.textContent = category;

    // Añadir clase al marcador según la categoría
    marker.classList.add(markerClass);
  }

  /**
   * Genera la interpretación textual del IMC
   * @param {number} imcValue - Valor del IMC calculado
   */
  function generateInterpretation(imcValue) {
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const interpretation = document.getElementById("imcInterpretation");

    let message = "";

    // Interpretación general basada en el IMC
    if (imcValue < 18.5) {
      message = `Tu IMC de ${imcValue} indica que tienes bajo peso. `;
    } else if (imcValue >= 18.5 && imcValue < 25) {
      message = `¡Felicidades! Tu IMC de ${imcValue} está dentro del rango normal. `;
    } else if (imcValue >= 25 && imcValue < 30) {
      message = `Tu IMC de ${imcValue} indica sobrepeso. `;
    } else if (imcValue >= 30 && imcValue < 35) {
      message = `Tu IMC de ${imcValue} indica obesidad grado I. `;
    } else if (imcValue >= 35 && imcValue < 40) {
      message = `Tu IMC de ${imcValue} indica obesidad grado II. `;
    } else {
      message = `Tu IMC de ${imcValue} indica obesidad grado III. `;
    }

    // Mostrar la interpretación
    interpretation.textContent = message;
    interpretation.style.display = "block";
  }

  /**
   * Muestra productos recomendados basados en el IMC
   * @param {number} imcValue - Valor del IMC calculado
   */
  function showRecommendedProducts(imcValue) {
    const productsContainer = document.getElementById("imcProducts");

    // Limpiar productos anteriores
    productsContainer.innerHTML = "";

    // Aquí se implementaría la lógica para mostrar productos recomendados
    // basados en el IMC calculado
    // Por ahora, dejamos esta función como un marcador de posición
  }

  /**
   * Añade los estilos CSS necesarios para los marcadores de IMC
   */
  function addMarkerStyles() {
    // Comprobar si los estilos ya existen para evitar duplicaciones
    if (!document.getElementById("imc-marker-styles")) {
      const style = document.createElement("style");
      style.id = "imc-marker-styles";
      style.textContent = `
          .imc-scale-marker {
            position: absolute;
            bottom: 100%;
            width: 16px;
            height: 16px;
            background-color: #333;
            border-radius: 50%;
            transform: translateX(-50%);
            border: 2px solid white;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
            transition: left 0.5s ease-in-out;
          }
          
          .imc-marker-underweight {
            background-color: #3b82f6; /* Azul para bajo peso */
          }
          
          .imc-marker-normal {
            background-color: #22c55e; /* Verde para peso normal */
          }
          
          .imc-marker-overweight {
            background-color: #f59e0b; /* Amarillo para sobrepeso */
          }
          
          .imc-marker-obese {
            background-color: #ef4444; /* Rojo para obesidad */
          }
          
          .imc-scale-container {
            position: relative;
            margin-top: 20px;
            margin-bottom: 30px;
          }
        `;
      document.head.appendChild(style);
    }
  }
});
