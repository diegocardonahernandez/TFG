<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/User.php';
require_once __DIR__ . '/../Model/Classes/Product.php';

if (!isset($_SESSION['userId'])) {
    header("Location: /login");
    exit;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: /cart");
    exit;
}

$currentUser = User::getUserById($_SESSION['userId']);
$products = [];
$subtotal = 0;
$shipping = 3.5;
$freeShippingThreshold = 50;

foreach ($_SESSION['cart'] as $item) {
    $product = Product::getProductDetails($item['id']);
    if ($product) {
        $price = $product[0]->getPrecio();
        if (isset($_SESSION['userType']) && ($_SESSION['userType'] == "Premium" || $_SESSION['userType'] == "Administrador") && $product[0]->getDescuento() > 0) {
            $price = $price - ($price * $product[0]->getDescuento() / 100);
        }
        $subtotal += $price * $item['quantity'];
        $products[] = $product;
    }
}

$shipping = $subtotal >= $freeShippingThreshold ? 0 : $shipping;
$total = $subtotal + $shipping;

$_SESSION['shipping'] = $shipping;

$cartData = [
    'products' => $products,
    'subtotal' => $subtotal,
    'shipping' => $shipping,
    'total' => $total,
    'freeShippingThreshold' => $freeShippingThreshold
];

renderLayout('processPayment', [
    "currentUser" => $currentUser,
    "cartData" => $cartData
]);