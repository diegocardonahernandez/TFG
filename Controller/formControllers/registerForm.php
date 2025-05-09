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
        header('Location: /register?error=correo');
        exit();
    }

    // Procesamiento seguro de archivo
    $foto_nombre = basename($_FILES['registro_foto_perfil']['name']);
    $foto_tmp = $_FILES['registro_foto_perfil']['tmp_name'];
    $ruta_destino = __DIR__ . '../../public/imgs/FotosPerfiles' . $foto_nombre;
    move_uploaded_file($foto_tmp, $ruta_destino);

    // Valores opcionales con NULL por defecto si no se proveen
    $telefono = !empty($_POST['registro_telefono']) ? $_POST['registro_telefono'] : null;
    $peso = !empty($_POST['registro_peso']) ? floatval($_POST['registro_peso']) : null;
    $altura = !empty($_POST['registro_altura']) ? floatval($_POST['registro_altura']) : null;

    // Hash de contraseña
    $contrasena_segura = password_hash($_POST['registro_contrasena'], PASSWORD_BCRYPT);

    // Inserción del usuario
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
        '/imgs/FotosPerfiles/' . $foto_nombre
    );

    header('Location: /login');
    exit();
}