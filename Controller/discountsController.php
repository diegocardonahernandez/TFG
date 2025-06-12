<?php

require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/redirectView.php';

$discountedProducts = Product::getDiscountedProducts();

renderLayout('discounts', ["discountedProducts" => $discountedProducts]);