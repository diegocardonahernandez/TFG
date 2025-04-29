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
const calculateButton = document.getElementById("calorieCalculateBtn");
const resultContainer = document.getElementById("calorieResultsContainer");
const resultCalories = document.getElementById("calorieValue");
const resultProteinGrams = document.getElementById("proteinGrams");
const resultCarbsGrams = document.getElementById("carbsGrams");
const resultFatGrams = document.getElementById("fatGrams");
const resultProteinCalories = document.getElementById("proteinCalories");
const resultCarbsCalories = document.getElementById("carbsCalories");
const resultFatCalories = document.getElementById("fatCalories");

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

  resultContainer.style.display = "block";
});
