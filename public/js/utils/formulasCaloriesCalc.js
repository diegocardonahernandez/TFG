export function calculateTMB(weight, height, age, gender) {
  let tmb = 10 * weight + 6.25 * height - 5 * age + 5;

  if (gender === "female") {
    tmb = 10 * weight + 6.25 * height - 5 * age - 161;
  }

  return tmb;
}

export function activityLevel(tmb, activityLevel) {
  return tmb * activityLevel;
}

export function adjustAccordingToGoal(calories, goal) {
  let res = calories;
  if (goal === "lose") {
    res = calories * 0.8;
  } else if (goal === "gain") {
    res = calories * 1.2;
  }

  return res;
}

export function macroNutrientDistribution(calories, weight) {
  const proteinGrams = 2 * weight;
  const proteinCalories = proteinGrams * 4;
  const fatGrams = (calories * 0.3) / 9;
  const fatCalories = calories * 0.3;
  const carbsGrams = (calories - (proteinCalories + fatCalories)) / 4;
  const carbsCalories = calories - proteinCalories - fatCalories;

  return {
    proteinGrams,
    proteinCalories,
    fatGrams,
    fatCalories,
    carbsGrams,
    carbsCalories,
  };
}
