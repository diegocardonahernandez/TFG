<?php

require_once __DIR__ . '/../Model/Classes/User.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/redirectView.php';

if (!isset($_SESSION['userId'])) {
    header('Location: /login');
    exit();
}

$currentUser = User::getUserById($_SESSION['userId']);

$sessionId = $_GET['session_id'] ?? null;

if (!$sessionId) {
    header('Location: /');
    exit();
}

require_once __DIR__ . '/../lib/stripe/init.php';
\Stripe\Stripe::setApiKey('sk_test_51RVrxgQ46PVjWGdXHNKc9goQkExIJozD1NAUJiIKYNdlZ6I6VvCB0Myyvnl07UQoxhfOSXL2IbbY6lNwFEx9G8Zk00yWgE7KEk');

try {

    foreach ($_SESSION['cart'] as $item) {
        Product::decreaseStock($item['id'], $item['quantity']);
    }

    $session = \Stripe\Checkout\Session::retrieve($sessionId);
    $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

    $paymentData = [
        'orderId' => $session->id,
        'paymentId' => $paymentIntent->id,
        'amount' => $paymentIntent->amount / 100,
        'currency' => strtoupper($paymentIntent->currency),
        'status' => $paymentIntent->status,
        'date' => date('d/m/Y H:i', $paymentIntent->created),
        'paymentMethod' => $paymentIntent->payment_method_types[0] ?? 'card'
    ];

    unset($_SESSION['cart']);

    renderLayout('paymentConfirmation', [
        "currentUser" => $currentUser,
        "paymentData" => $paymentData
    ]);
} catch (Exception $e) {
    header('Location: /cart');
    exit();
}