<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/recommendProducts.php';

// Arreglar la captura del objetivo dle usuario

$result = recommendProducts('maintain');

renderLayout('caloriesCalc', ['recommendProducts' => $result]);
