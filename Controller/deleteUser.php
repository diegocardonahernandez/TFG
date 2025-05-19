<?php

require_once __DIR__ . '/../Model/Classes/User.php';

$count = User::deleteUser($_SESSION['userId']);
header('Content-Type: application/json');

if ($count > 0) {
    echo json_encode(["success" => true]);
}
