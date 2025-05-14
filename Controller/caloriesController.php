<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/recommendProducts.php';

<<<<<<< HEAD
$goal = 'gain'; // This should be set based on user input or session data
$result = recommendProducts($goal);
=======
>>>>>>> 58f3a6295f4dabbbebdcf6151a7f21810b16ac3c

renderLayout('caloriesCalc');
