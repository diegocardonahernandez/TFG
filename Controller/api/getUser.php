<?php
require_once __DIR__ . '/../../Model/Classes/User.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$userId = $_GET['id'] ?? null;

if (!$userId) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit();
}

$user = User::getUserById($userId);

if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']);
    exit();
}

echo json_encode([
    'id_usuario' => $user->getIdUsuario(),
    'nombre' => $user->getNombre(),
    'apellido' => $user->getApellido(),
    'telefono' => $user->getTelefono(),
    'correo' => $user->getCorreo(),
    'fecha_nacimiento' => $user->getFechaNacimiento(),
    'genero' => $user->getGenero(),
    'tipo_usuario' => $user->getTipoUsuario(),
    'estado' => $user->getEstado(),
    'peso' => $user->getPeso(),
    'altura' => $user->getAltura(),
    'foto_perfil' => $user->getFotoPerfil()
]);
