<?php
require_once __DIR__ . '/../../Model/Classes/User.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$usersPerPage = 10;
$allUsers = User::getAllUsers();
$totalUsers = count($allUsers);
$totalPages = max(1, ceil($totalUsers / $usersPerPage));
$currentPage = min($page, $totalPages);
$startIndex = ($currentPage - 1) * $usersPerPage;
$endIndex = min($startIndex + $usersPerPage, $totalUsers);
$currentPageUsers = array_slice($allUsers, $startIndex, $usersPerPage);

$usersArray = array_map(function ($user) {
    return [
        'id_usuario' => $user->getIdUsuario(),
        'nombre' => $user->getNombre(),
        'apellido' => $user->getApellido(),
        'correo' => $user->getCorreo(),
        'tipo_usuario' => $user->getTipoUsuario(),
        'estado' => $user->getEstado()
    ];
}, $currentPageUsers);

echo json_encode([
    'users' => $usersArray,
    'totalUsers' => $totalUsers,
    'currentPage' => $currentPage,
    'totalPages' => $totalPages,
    'startIndex' => $startIndex,
    'endIndex' => $endIndex
]);
