document.addEventListener("DOMContentLoaded", function () {
  const formIMC = document.getElementById("imcCalculatorForm");
  const heightInput = document.getElementById("imc-height");
  const weightInput = document.getElementById("imc-weight");
  const resultContainer = document.getElementById("imcResultsContainer");
  const initialState = document.getElementById("imcInitialState");
  const resultIMC = document.querySelector(".imc-result-value");
  const imcInterpretation = document.getElementById("imcInterpretation");
  const categoryElement = document.getElementById("imcCategory");

  addMarkerStyles();

  function calculateIMC(weight, height) {
    const heightInMeters = height / 100;
    return weight / Math.pow(heightInMeters, 2);
  }

  formIMC.addEventListener("submit", function (event) {
    event.preventDefault();

    const height = +heightInput.value;
    const weight = +weightInput.value;

    const imc = calculateIMC(weight, height);

    const formattedIMC = parseFloat(imc.toFixed(1));

    resultContainer.style.display = "block";
    initialState.style.display = "none";

    resultIMC.innerHTML = formattedIMC;

    imcInterpretation.style.display = "block";

    generateInterpretation(formattedIMC);

    positionImcMarker(formattedIMC);

    showRecommendedProducts(formattedIMC);
  });

  formIMC.addEventListener("reset", function () {
    resultContainer.style.display = "none";
    initialState.style.display = "block";

    const marker = document.getElementById("imcMarker");
    if (marker) {
      marker.style.display = "none";
    }
  });

  function positionImcMarker(imcValue) {
    const marker = document.getElementById("imcMarker");
    const scaleContainer = document.querySelector(".imc-scale-container");

    if (!marker) {
      const newMarker = document.createElement("div");
      newMarker.id = "imcMarker";
      newMarker.className = "imc-scale-marker";
      scaleContainer.appendChild(newMarker);
    }

    const scaleWidth = document.querySelector(".imc-scale").offsetWidth;

    const minIMC = 15;
    const maxIMC = 40;
    const imcRange = maxIMC - minIMC;

    let boundedIMC = Math.max(minIMC, Math.min(maxIMC, imcValue));

    let percentage = ((boundedIMC - minIMC) / imcRange) * 100;

    percentage = Math.max(0, Math.min(100, percentage));

    const markerElement = document.getElementById("imcMarker");
    markerElement.style.left = `${percentage}%`;

    markerElement.style.display = "block";

    updateCategoryAndMarker(imcValue);
  }

  function updateCategoryAndMarker(imcValue) {
    const marker = document.getElementById("imcMarker");

    marker.className = "imc-scale-marker";

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

    categoryElement.textContent = category;

    marker.classList.add(markerClass);
  }

  function generateInterpretation(imcValue) {
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const interpretation = document.getElementById("imcInterpretation");

    let message = "";

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

    interpretation.textContent = message;
    interpretation.style.display = "block";
  }

  function addMarkerStyles() {
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
