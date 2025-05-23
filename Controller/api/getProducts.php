<?php
require_once __DIR__ . '/../../Model/Classes/Product.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
  http_response_code(403);
  echo json_encode(['error' => 'Unauthorized']);
  exit();
}

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$productsPerPage = 10;
$allProducts = Product::getAllWithCategory();
$totalProducts = count($allProducts);
$totalPages = max(1, ceil($totalProducts / $productsPerPage));
$currentPage = min($page, $totalPages);
$startIndex = ($currentPage - 1) * $productsPerPage;
$endIndex = min($startIndex + $productsPerPage, $totalProducts);
$currentPageProducts = array_slice($allProducts, $startIndex, $productsPerPage);

$productsArray = array_map(function ($product) {
  return $product->jsonSerialize();
}, $currentPageProducts);

echo json_encode([
  'products' => $productsArray,
  'totalProducts' => $totalProducts,
  'currentPage' => $currentPage,
  'totalPages' => $totalPages,
  'startIndex' => $startIndex,
  'endIndex' => $endIndex
]);
