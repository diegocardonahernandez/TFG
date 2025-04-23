<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Functions/valuationProduct.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

$id = $_GET['id'];
$details = Product::getProductDetails($id);

renderLayout('productDetails', ['details' => $details]);
