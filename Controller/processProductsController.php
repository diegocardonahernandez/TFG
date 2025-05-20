<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

$productos = Product::getAll();

renderLayout('processProducts', ["products" => $productos]);
