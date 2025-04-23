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

            case '/imc':
                require_once __DIR__ . '/../Controller/imcController.php';
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
