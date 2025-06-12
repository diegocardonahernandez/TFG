<?php

require_once __DIR__ . '/../lib/stripe/init.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo 'Método no permitido';
    exit;
}

if (!isset($_SESSION['cart'])) {
    echo 'No se ha encontrado la información de la compra';
    exit;
}

\Stripe\Stripe::setApiKey('sk_test_51RVrxgQ46PVjWGdXHNKc9goQkExIJozD1NAUJiIKYNdlZ6I6VvCB0Myyvnl07UQoxhfOSXL2IbbY6lNwFEx9G8Zk00yWgE7KEk');

try {
    $lineItems = [];
    foreach ($_SESSION['cart'] as $item) {
        $product = Product::getProductDetails($item['id'])[0];
        $price = $product->getPrecio();

        if (isset($_SESSION['userType']) && ($_SESSION['userType'] == "Premium" || $_SESSION['userType'] == "Administrador") && $product->getDescuento() > 0) {
            $price = $price - ($price * $product->getDescuento() / 100);
        }

        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $product->getNombre(),
                ],
                'unit_amount' => (int) round($price * 100),
            ],
            'quantity' => $item['quantity'],
        ];
    }

    if (isset($_SESSION['shipping']) && $_SESSION['shipping'] > 0) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Gastos de envío',
                ],
                'unit_amount' => (int) round($_SESSION['shipping'] * 100),
            ],
            'quantity' => 1,
        ];
    }

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => 'http://localhost:8000/paymentConfirmation?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost:8000/cart',
    ]);

    $url = $session->url;
    header('Location: ' . $url);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}