<?php
require_once __DIR__ . '/../../Model/Classes/User.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId']) || $_SESSION['userType'] !== 'Administrador') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

try {
    $user = new User();
    $user->setIdUsuario($_POST['id_usuario']);
    $user->setNombre($_POST['nombre']);
    $user->setApellido($_POST['apellido']);
    $user->setTelefono($_POST['telefono']);
    $user->setCorreo($_POST['correo']);
    $user->setFechaNacimiento($_POST['fecha_nacimiento']);
    $user->setGenero($_POST['genero']);
    $user->setTipoUsuario($_POST['tipo_usuario']);
    $user->setEstado(isset($_POST['estado']) ? intval($_POST['estado']) : 0);

    // If password is provided, update it
    if (!empty($_POST['contrasena'])) {
        $user->setContrasena($_POST['contrasena']);
        $result = $user->updateUserDataAndPassw(
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['telefono'],
            $_POST['fecha_nacimiento'],
            $_POST['genero'],
            $user->getPeso(),
            $user->getAltura(),
            $user->getFotoPerfil(),
            $_POST['contrasena'],
            $_POST['id_usuario']
        );
    } else {
        $result = $user->updateUserData(
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['telefono'],
            $_POST['fecha_nacimiento'],
            $_POST['genero'],
            $user->getPeso(),
            $user->getAltura(),
            $user->getFotoPerfil(),
            $_POST['id_usuario']
        );
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
