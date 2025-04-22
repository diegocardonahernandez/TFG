<?php

require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Model/Classes/Category.php';
require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Functions/valuationProduct.php';

$popularProducts = Product::getMostViewed();

renderLayout('home', ['popularProducts' => $popularProducts]);
