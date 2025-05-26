<?php
require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [];
foreach ($_SESSION['cart'] as $item) {
    $product = Product::getProductDetails($item['id']);
    if ($product) {
        $products[] = $product;
    }
}

renderLayout('cart', ['products' => $products]);
