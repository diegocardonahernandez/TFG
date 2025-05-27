<?php
require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($searchQuery)) {
    header('Location: /');
    exit;
}

$products = Product::getSearchProducts($searchQuery);

renderLayout('search', [
    'products' => $products,
    'searchQuery' => $searchQuery
]);
