<?php
require_once __DIR__ . '/../../Model/Classes/Category.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
  http_response_code(403);
  echo json_encode(['error' => 'Unauthorized']);
  exit();
}

$categories = Category::getCategory();
echo json_encode($categories);
