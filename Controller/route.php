<?php
require_once __DIR__ . '/../Functions/redirectView.php';

$method = $_SERVER["REQUEST_METHOD"];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
            case '/accountUser':
                require_once __DIR__ . '/../Controller/userAccountController.php';
                break;
            case '/processProducts':
                require_once __DIR__ . '/../Controller/processProductsController.php';
                break;
            case '/processUsers':
                require_once __DIR__ . '/../Controller/processUsersController.php';
                break;
            case '/getProduct':
                require_once __DIR__ . '/../Controller/api/getProduct.php';
                break;
            case '/getUser':
                require_once __DIR__ . '/../Controller/api/getUser.php';
                break;
            case '/getUsers':
                require_once __DIR__ . '/../Controller/api/getUsers.php';
                break;
            case '/logout':
                require_once __DIR__ . '/../Controller/logout.php';
                break;
            case '/profits':
                renderLayout('premiumProfits');
                break;
            case '/discounts':
                require_once __DIR__ . '/../Controller/discountsController.php';
                break;
            case '/getCategories':
                require_once __DIR__ . '/../Controller/api/getCategories.php';
                break;
            case '/getProducts':
                require_once __DIR__ . '/../Controller/api/getProducts.php';
                break;
            case '/products':
                require_once __DIR__ . '/../Controller/productsController.php';
                break;
            default:
                echo "Página no encontrada";
                break;
        }
        break;

    case 'POST':
        switch ($request) {
            case '/registerForm':
                require_once __DIR__ . '/../Controller/formControllers/registerForm.php';
                break;
            case '/caloriesForm':
                require_once __DIR__ . '/../Controller/formControllers/caloriesForm.php';
                break;
            case '/loginForm':
                require_once __DIR__ . '/../Controller/formControllers/loginForm.php';
                break;
            case '/updateUserData':
                require_once __DIR__ . '/../Controller/formControllers/profileUserForm.php';
                break;
            case '/deleteAccount':
                require_once __DIR__ . '/../Controller/deleteUser.php';
                break;
            case '/addProduct':
                require_once __DIR__ . '/../Controller/formControllers/addProductForm.php';
                break;
            case '/updateProduct':
                require_once __DIR__ . '/../Controller/formControllers/updateProductForm.php';
                break;
            case '/updateUser':
                require_once __DIR__ . '/../Controller/formControllers/updateUserForm.php';
                break;
            case '/deleteUser':
                require_once __DIR__ . '/../Controller/api/deleteUser.php';
                break;
            case '/deleteProduct':
                require_once __DIR__ . '/../Controller/api/deleteProduct.php';
                break;
            case '/getCategories':
                require_once __DIR__ . '/../Controller/api/getCategories.php';
                break;
            case '/getProduct':
                require_once __DIR__ . '/../Controller/api/getProduct.php';
                break;
            case '/getUser':
                require_once __DIR__ . '/../Controller/api/getUser.php';
                break;
            case '/getUsers':
                require_once __DIR__ . '/../Controller/api/getUsers.php';
                break;
            default:
                echo "Ruta POST no reconocida";
                break;
        }
        break;

    default:
        echo "Error, método no permitido";
        break;
}
