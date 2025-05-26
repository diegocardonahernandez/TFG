<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Obtener el cuerpo de la petición
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['productId']) || !isset($data['quantity'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Faltan datos requeridos']);
    exit;
}

$productId = $data['productId'];
$quantity = (int)$data['quantity'];

// Validar la cantidad
if ($quantity < 1 || $quantity > 99) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Cantidad no válida']);
    exit;
}

// Buscar el producto en el carrito
$key = array_search($productId, array_column($_SESSION['cart'], 'id'));

if ($key === false) {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Producto no encontrado en el carrito']);
    exit;
}

// Actualizar la cantidad
$_SESSION['cart'][$key]['quantity'] = $quantity;

// Devolver respuesta exitosa
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