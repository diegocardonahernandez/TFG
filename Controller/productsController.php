<?php
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/valuationProduct.php';
require_once __DIR__ . '/../Functions/redirectView.php';

$products = Product::getAllWithCategory();

renderLayout('products', ['products' => $products]);
