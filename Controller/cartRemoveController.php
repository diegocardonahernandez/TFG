<?php

// Inicializar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['productId'])) {
    echo json_encode(['error' => 'ID de producto no proporcionado']);
    exit;
}

$productId = $data['productId'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

$cart = array_filter($cart, function ($item) use ($productId) {
    return $item['id'] != $productId;
});

$_SESSION['cart'] = array_values($cart); // reindex array

echo json_encode(['success' => true]);