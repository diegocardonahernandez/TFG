<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Model/Classes/User.php';

$productos = Product::getAll();
$usuarios = User::getAllUsers();

renderLayout('administration', ["productos" => $productos, "usuarios" => $usuarios]);
