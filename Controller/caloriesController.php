<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/recommendProducts.php';

$goal = 'gain'; // This should be set based on user input or session data
$result = recommendProducts($goal);

renderLayout('caloriesCalc', ['recommendProducts' => $result]);
