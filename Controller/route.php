<?php

$method = $_SERVER["REQUEST_METHOD"];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($method) {
    case 'GET':
        switch ($request) {
            case '/':
                require_once __DIR__ . '/../Controller/homeController.php';
                break;

            case '/Equipamiento':
            case '/Ropa':
            case '/Suplementos':
                require_once __DIR__ . '/../Controller/categoriesController.php';
                break;

            case '/product':
                require_once __DIR__ . '/../Controller/productDetailsController.php';
                break;

            case '/calories':
                require_once __DIR__ . '/../Controller/caloriesController.php';
                break;

            case '/recommendProducts':
                require_once __DIR__ . '/../Functions/recommendProducts.php';
                break;

            case '/imc':
                require_once __DIR__ . '/../Controller/imcController.php';
                break;

            case '/login':
                require_once __DIR__ . '/../Controller/loginController.php';
                break;

            case '/register':
                require_once __DIR__ . '/../Controller/registerController.php';
                break;

            default:;
                echo "Página no encontrada";
                break;
        }
        break;

    case 'POST':

        break;

    default:
        echo "Error, método no permitido";
        break;
}
