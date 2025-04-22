<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Functions/valuationProduct.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

$currentCategory = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$category = ltrim($currentCategory, '/');
$productsCategory = Product::getProductsCategory($category);

renderLayout('category', ['category' => $category, 'products' => $productsCategory]);
