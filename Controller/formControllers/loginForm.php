<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once __DIR__ . '/../../Model/Classes/User.php';

    $email = $_POST['login_email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    $usuarios = User::getAllUsers();

    foreach ($usuarios as $usuario) {
        if ($usuario->getCorreo() === $email) {

            if (password_verify($password, $usuario->getContrasena())) {
                $_SESSION['userId'] = $usuario->getIdUsuario();
                $_SESSION['userType'] = $usuario->getTipoUsuario();
                $_SESSION['userEmail'] = $usuario->getCorreo();

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