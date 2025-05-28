<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../Model/Classes/User.php';

    $users = User::getAllUsers();
    $correoExiste = false;

    foreach ($users as $user) {
        if ($user->getCorreo() === $_POST['registro_correo']) {
            $correoExiste = true;
            break;
        }
    }

    if ($correoExiste) {
        header('Content-Type: application/json');
        echo json_encode(["invalidEmail" => true]);
        exit();
    }

    $foto_nombre = null;
    $ruta_foto = null;

    if (isset($_FILES['registro_foto_perfil']) && $_FILES['registro_foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $foto_nombre = basename($_FILES['registro_foto_perfil']['name']);
        $foto_tmp = $_FILES['registro_foto_perfil']['tmp_name'];
        $ruta_destino = __DIR__ . '/../../public/imgs/FotosPerfiles/' . $foto_nombre;

        if (!move_uploaded_file($foto_tmp, $ruta_destino)) {
            header('Content-Type: application/json');
            echo json_encode(["error" => "No se pudo guardar la foto."]);
            exit();
        }

        $ruta_foto = '/imgs/FotosPerfiles/' . $foto_nombre;
    } else {
        $ruta_foto = '/imgs/FotosPerfiles/userIcon.png';
    }

    $telefono = !empty($_POST['registro_telefono']) ? $_POST['registro_telefono'] : null;
    $peso = !empty($_POST['registro_peso']) ? floatval($_POST['registro_peso']) : null;
    $altura = !empty($_POST['registro_altura']) ? floatval($_POST['registro_altura']) : null;
    $contrasena_segura = password_hash($_POST['registro_contrasena'], PASSWORD_BCRYPT);

    User::insertNewUser(
        $_POST['registro_nombre'],
        $_POST['registro_apellido'],
        $telefono,
        $_POST['registro_correo'],
        $contrasena_segura,
        $_POST['registro_fecha_nacimiento'],
        $_POST['registro_genero'],
        $peso,
        $altura,
        'Usuario',
        'Activo',
        $ruta_foto
    );

    header('Content-Type: application/json');
    echo json_encode(["success" => true]);
    exit();
}