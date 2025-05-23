<?php
require_once __DIR__ . '/../../Model/Classes/User.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$userId = $_POST['id'] ?? null;

if (!$userId) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit();
}

try {
    $result = User::deleteUser($userId);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
