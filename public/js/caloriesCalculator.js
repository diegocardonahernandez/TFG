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
let nutrientsChartInstance = null;

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

  if (nutrientsChartInstance) {
    nutrientsChartInstance.destroy();
  }

  nutrientsChartInstance = new Chart(nutrientsChart, {
    type: "doughnut",
    data: {
      datasets: [
        {
          label: "Calorías ",
          data: [
            nutrients.proteinCalories.toFixed(0),
            nutrients.carbsCalories.toFixed(0),
            nutrients.fatCalories.toFixed(0),
          ],
          backgroundColor: ["#d91a36", "#f7a928 ", "#2a5a8c"],
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
      },
    },
  });

  resultContainer.style.display = "block";
  initialText.style.display = "none";
});

document.getElementById("calorieResetBtn").addEventListener("click", () => {
  form.reset();
  resultContainer.style.display = "none";
  initialText.style.display = "block";
});
