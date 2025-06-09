<?php
require_once __DIR__ . '/../Functions/redirectView.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header('Location: /login');
    exit();
}

// Check if user is already premium
if (isset($_SESSION['userType']) && ($_SESSION['userType'] === 'Premium' || $_SESSION['userType'] === 'Administrador')) {
    header('Location: /profits');
    exit();
}

// Render the premium subscription view
renderLayout('premiumSubscription'); 