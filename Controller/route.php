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
            case '/privacy':
                renderLayout('privacy');
                break;
            case '/terms':
                renderLayout('terms');
                break;
            case '/faq':
                renderLayout('faq');
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
            case '/premium':
                require_once __DIR__ . '/../Controller/premiumSubscriptionController.php';
                break;
            case '/premiumSuccess':
                require_once __DIR__ . '/../Controller/premiumSuccessController.php';
                break;
            case '/testimonials':
                renderLayout('testimonials');
                break;
            case '/discounts':
                require_once __DIR__ . '/../Controller/discountsController.php';
                break;
            case '/cart':
                require_once __DIR__ . '/../Controller/cartController.php';
                break;
            case '/search':
                require_once __DIR__ . '/../Controller/searchController.php';
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
            case '/sendEmail':
                require_once __DIR__ . '/../Controller/api/send.php';
                break;
            case '/processPayment':
                require_once __DIR__ . '/../Controller/processPaymentController.php';
                break;
            case '/paymentConfirmation':
                require_once __DIR__ . '/../Controller/paymentConfirmationController.php';
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
            case '/cart':
                require_once __DIR__ . '/../Controller/cartPostController.php';
                break;
            case '/removeProduct':
                require_once __DIR__ . '/../Controller/cartRemoveController.php';
                break;
            case '/updateCartProduct':
                require_once __DIR__ . '/../Controller/cartUpdateController.php';
                break;
            case '/schedule-consultation':
                require_once __DIR__ . '/../Controller/formControllers/scheduleConsultationForm.php';
                break;
            case '/pay':
                require_once __DIR__ . '/../Controller/paymentController.php';
                break;
            case '/premiumPayment':
                require_once __DIR__ . '/../Controller/premiumPaymentController.php';
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