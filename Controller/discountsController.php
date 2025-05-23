<?php

require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/redirectView.php';

// Obtener productos con descuento
$discountedProducts = Product::getDiscountedProducts();

// Renderizar la vista
renderLayout('discounts', ["discountedProducts" => $discountedProducts]);