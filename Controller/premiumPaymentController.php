<?php

require_once __DIR__ . '/../lib/stripe/init.php';
require_once __DIR__ . '/../Model/Classes/User.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo 'Método no permitido';
    exit;
}

if (!isset($_SESSION['userId'])) {
    echo 'Usuario no autenticado';
    exit;
}

\Stripe\Stripe::setApiKey('sk_test_51RVrxgQ46PVjWGdXHNKc9goQkExIJozD1NAUJiIKYNdlZ6I6VvCB0Myyvnl07UQoxhfOSXL2IbbY6lNwFEx9G8Zk00yWgE7KEk');

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Suscripción Premium',
                    'description' => 'Acceso a todas las funcionalidades premium',
                ],
                'unit_amount' => 499, // 4.99 EUR
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost:8000/premiumSuccess?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost:8000/premium',
        'metadata' => [
            'user_id' => $_SESSION['userId']
        ]
    ]);

    $url = $session->url;
    header('Location: ' . $url);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
} 