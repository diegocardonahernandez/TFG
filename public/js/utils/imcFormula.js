export function calculateIMC(weight, height) {
  const heightInMeters = height / 100;
  const imc = weight / Math.pow(heightInMeters, 2);
  return imc.toFixed(2);
}
