<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Error, método no permitido";
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$data = json_decode(file_get_contents('php://input'), true);

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

$key = false;
foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['id'] == $id) {
        $key = $index;
        break;
    }
}

if ($key !== false) {
    if ($action === 'update') {
        $_SESSION['cart'][$key]['quantity'] = $quantity;
    } else {
        $_SESSION['cart'][$key]['quantity']++;
    }
} else {
    $_SESSION['cart'][] = [
        'id' => $id,
        'quantity' => $quantity
    ];
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

header('Location: /cart');
exit;