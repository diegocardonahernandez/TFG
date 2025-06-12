<?php
require_once __DIR__ . '/../Functions/redirectView.php';

if (!isset($_SESSION['userId'])) {
    header('Location: /login');
    exit();
}

if (isset($_SESSION['userType']) && ($_SESSION['userType'] === 'Premium' || $_SESSION['userType'] === 'Administrador')) {
    header('Location: /profits');
    exit();
}

renderLayout('premiumSubscription'); 