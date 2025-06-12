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

    $peso = isset($_POST['peso']) ? $_POST['peso'] : null;
    $altura = isset($_POST['altura']) ? $_POST['altura'] : null;
    $fotoPerfil = $user->getFotoPerfil();

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['size'] > 0) {
        $fileName = basename($_FILES['foto_perfil']['name']);
        $targetDir = __DIR__ . '/../../public/imgs/FotosPerfiles/';
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . uniqid('perfil_', true) . '_' . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['foto_perfil']['tmp_name']);
        if ($check !== false && in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $targetFile)) {
                $fotoPerfil = '/imgs/FotosPerfiles/' . basename($targetFile);
            }
        }
    } elseif (isset($_POST['foto_perfil_actual'])) {
        $fotoPerfil = $_POST['foto_perfil_actual'];
    }

    if (!empty($_POST['contrasena'])) {
        $user->setContrasena($_POST['contrasena']);
        $result = $user->updateUserDataAndPassw(
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['telefono'],
            $_POST['fecha_nacimiento'],
            $_POST['genero'],
            $peso,
            $altura,
            $fotoPerfil,
            $_POST['contrasena'],
            $_POST['tipo_usuario'],
            $user->getEstado(),
            $_POST['id_usuario']
        );
    } else {
        $result = $user->updateUserData(
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['telefono'],
            $_POST['fecha_nacimiento'],
            $_POST['genero'],
            $peso,
            $altura,
            $fotoPerfil,
            $_POST['tipo_usuario'],
            $user->getEstado(),
            $_POST['id_usuario']
        );
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
