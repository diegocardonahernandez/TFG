<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Error, método no permitido";
    exit;
}

// Inicializar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Asegurarse de que existe el carrito en la sesión
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Obtener el cuerpo de la petición
$data = json_decode(file_get_contents('php://input'), true);

// Si no hay datos JSON, intentar obtener de POST
if (!$data) {
    $data = $_POST;
}

if (!isset($data['id'])) {
    echo "Error, no se ha proporcionado un ID";
    exit;
}

$id = $data['id'];
$quantity = isset($data['quantity']) ? (int)$data['quantity'] : 1;
$action = isset($data['action']) ? $data['action'] : 'increment';

// Buscar el producto en el carrito
$key = false;
foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['id'] == $id) {
        $key = $index;
        break;
    }
}

if ($key !== false) {
    if ($action === 'update') {
        // Actualizar la cantidad específica
        $_SESSION['cart'][$key]['quantity'] = $quantity;
    } else {
        // Incrementar la cantidad
        $_SESSION['cart'][$key]['quantity']++;
    }
} else {
    $_SESSION['cart'][] = [
        'id' => $id,
        'quantity' => $quantity
    ];
}

// Si es una petición AJAX, devolver JSON
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

// Si no es AJAX, redirigir
header('Location: /cart');
exit;