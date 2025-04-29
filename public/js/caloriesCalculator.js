import {
  calculateTMB,
  activityLevel,
  adjustAccordingToGoal,
  macroNutrientDistribution,
} from "./utils/formulasCaloriesCalc.js";

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

form.addEventListener("submit", (event) => {
  event.preventDefault();

  const tmb = calculateTMB(
    +weightInput.value,
    +heightInput.value,
    +ageInput.value,
    document.querySelector("input[name=gender]:checked").value
  );

  const calories = activityLevel(tmb, +activityLevelInput.value);

  const result = adjustAccordingToGoal(
    calories,
    document.querySelector("input[name=goal]:checked").value
  );

  const nutrients = macroNutrientDistribution(result, +weightInput.value);
  resultProteinGrams.innerHTML = Math.round(nutrients.proteinGrams);
  resultCarbsGrams.innerHTML = Math.round(nutrients.carbsGrams);
  resultFatGrams.innerHTML = Math.round(nutrients.fatGrams);
  resultProteinCalories.innerHTML = Math.round(nutrients.proteinCalories);
  resultCarbsCalories.innerHTML = Math.round(nutrients.carbsCalories);
  resultFatCalories.innerHTML = Math.round(nutrients.fatCalories);

  resultCalories.innerHTML = Math.round(result);

  new Chart(nutrientsChart, {
    type: "doughnut",
    data: {
      labels: ["Proteínas", "carbohidratos", "Grasas"],
      datasets: [
        {
          label: "Distribución de Macronutrientes",
          data: [
            nutrients.proteinCalories,
            nutrients.carbsCalories,
            nutrients.fatCalories,
          ],
          backgroundColor: ["#a60f2d", "#ffcd8b", "#4b0082"],
          hoverOffset: 4,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        title: {
          display: true,
          text: "Distribución de Macronutrientes",
        },
      },
    },
  });

  resultContainer.style.display = "block";
  initialText.style.display = "none";
});
