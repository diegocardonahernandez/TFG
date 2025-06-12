<?php

require_once __DIR__ . '/../../Model/Classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userToUpdate = User::getUserById($_SESSION['userId']);
    $passwordUser = $_POST['user_profile_current_password'];

    if (isset($_FILES['user-profile-image-upload']) && $_FILES['user-profile-image-upload']['error'] === UPLOAD_ERR_OK) {
        $foto_nombre = basename($_FILES['user-profile-image-upload']['name']);
        $foto_tmp = $_FILES['user-profile-image-upload']['tmp_name'];
        $extension = pathinfo($foto_nombre, PATHINFO_EXTENSION);
        $nombre_archivo_unico = uniqid('perfil_', true) . '.' . $extension;
        $ruta_destino = __DIR__ . '/../../public/imgs/FotosPerfiles/' . $nombre_archivo_unico;

        if (!move_uploaded_file($foto_tmp, $ruta_destino)) {
            header('Content-Type: application/json');
            echo json_encode(["error" => "No se pudo guardar la foto."]);
            exit();
        }

        $ruta_foto = '/imgs/FotosPerfiles/' . $nombre_archivo_unico;
    } else {
        $ruta_foto = $userToUpdate->getFotoPerfil();
    }

    if (empty($passwordUser)) {
        header('Content-Type: application/json');
        echo json_encode(["passwordNotChanged" => true]);

        User::updateUserData(
            $_POST['user_profile_nombre'],
            $_POST['user_profile_apellido'],
            $_POST['user_profile_telefono'],
            $_POST['user_profile_fecha_nacimiento'],
            $_POST['user_profile_genero'],
            $_POST['user_profile_peso'],
            $_POST['user_profile_altura'],
            $ruta_foto,
            $userToUpdate->getTipoUsuario(),
            $userToUpdate->getEstado(),
            $_SESSION['userId']
        );
        exit();
    }

    if (password_verify($passwordUser, $userToUpdate->getContrasena())) {
        header('Content-Type: application/json');
        echo json_encode(["success" => true]);

        User::updateUserDataAndPassw(
            $_POST['user_profile_nombre'],
            $_POST['user_profile_apellido'],
            $_POST['user_profile_telefono'],
            $_POST['user_profile_fecha_nacimiento'],
            $_POST['user_profile_genero'],
            $_POST['user_profile_peso'],
            $_POST['user_profile_altura'],
            $ruta_foto,
            password_hash($_POST['user_profile_new_password'], PASSWORD_BCRYPT),
            $userToUpdate->getTipoUsuario(),
            $userToUpdate->getEstado(),
            $_SESSION['userId']
        );

        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(["incorrectPassword" => true]);
        exit();
    }
}