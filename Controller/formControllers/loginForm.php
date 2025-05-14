<?php

// Solo ejecutar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once __DIR__ . '/../../Model/Classes/User.php';

    // Obtener los datos enviados desde el formulario
    $email = $_POST['login_email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    // Obtener todos los usuarios desde el modelo
    $usuarios = User::getAllUsers();

    // Recorrer usuarios para buscar coincidencia por correo
    foreach ($usuarios as $usuario) {
        if ($usuario->getCorreo() === $email) {

            if (password_verify($password, $usuario->getContrasena())) {
                $_SESSION['userId'] = $usuario->getIdUsuario();

                header('Content-Type: application/json');
                echo json_encode(["success" => "true"]);
                exit();
            } else {

                header('Content-Type: application/json');
                echo json_encode(["incorrectPassword" => "true"]);
                exit();
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode(["incorrectEmail" => "true"]);
    exit();
}
