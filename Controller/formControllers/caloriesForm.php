<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once __DIR__ . '/../../Functions/recommendProducts.php';

    $goal = $_POST['goal'];
    $result = recommendProducts($goal);

    header('Content-Type: application/json');
    echo json_encode(["productsGoal" => $result]);
}