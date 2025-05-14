<?php

require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../Model/Classes/User.php';

if (!isset($_SESSION['userId'])) {
    header("Location: /");
    exit;
}

$currentUser = User::getUserById($_SESSION['userId']);

renderLayout('userAccount', ["currentUser" => $currentUser]);
