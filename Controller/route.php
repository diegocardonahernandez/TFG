<?php

$method = $_SERVER["REQUEST_METHOD"];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($method) {
    case 'GET':
        switch ($request) {
            case '/':
                require_once __DIR__ . '/../Controller/homeController.php';
                break;
            case '/nutricion':
                require_once __DIR__ . '/../Controller/ProductsControllers/nutritionController.php';
                break;
            default:
                echo "Página no encontrada";
                break;
        }
        break;

    case 'POST':
        // Aquí podrías manejar peticiones POST
        break;

    default:
        echo "Error, método no permitido";
        break;
}
