<?php
require_once __DIR__ . '/../../Model/Classes/Product.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
  http_response_code(403);
  echo json_encode(['error' => 'Unauthorized']);
  exit();
}

$productId = $_GET['id'] ?? null;

if (!$productId) {
  http_response_code(400);
  echo json_encode(['error' => 'Product ID is required']);
  exit();
}

$product = Product::getProductDetails($productId);

if (empty($product)) {
  http_response_code(404);
  echo json_encode(['error' => 'Product not found']);
  exit();
}

echo json_encode($product[0]);
