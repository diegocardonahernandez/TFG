<?php

require_once __DIR__ . '/../Model/Classes/Product.php';

function recommendProducts($goal)
{
    $productsGoal = [];
    $recommendProducts = [];

    switch ($goal) {

        case 'lose':
            $productsGoal = ['ThermoBurn Xtreme', 'BCAA 2:1:1', 'Ashwagandha Balance', 'Pre-Entreno Explosivo'];
            $recommendProducts = Product::getProductsForGoal($productsGoal);
            break;

        case 'maintain':
            $productsGoal = ['Multivitamínico Deportivo', 'Electrolyte Mix', 'Glutamina Pura', 'Omega-3'];
            $recommendProducts = Product::getProductsForGoal($productsGoal);
            break;

        case 'gain':
            $productsGoal = ['Proteína Whey', 'Ganador de Peso', 'Creatina Monohidratada', 'ZMA'];
            $recommendProducts = Product::getProductsForGoal($productsGoal);
            break;
    }
    return $recommendProducts;
}