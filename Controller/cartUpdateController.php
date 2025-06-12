<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['productId']) || !isset($data['quantity'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Faltan datos requeridos']);
    exit;
}

$productId = $data['productId'];
$quantity = (int)$data['quantity'];

if ($quantity < 1 || $quantity > 99) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Cantidad no válida']);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$key = false;
foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['id'] == $productId) {
        $key = $index;
        break;
    }
}

if ($key === false) {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Producto no encontrado en el carrito']);
    exit;
}

$_SESSION['cart'][$key]['quantity'] = $quantity;

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Cantidad actualizada correctamente',
    'data' => [
        'productId' => $productId,
        'quantity' => $quantity
    ]
]);
exit;