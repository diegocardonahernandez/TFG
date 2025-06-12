<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../lib/phpmailer/src/Exception.php';
require __DIR__ . '/../../lib/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../lib/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'purogainscompany@gmail.com';
    $mail->Password   = 'qgwn avwv lnks zmml';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('purogainscompany@gmail.com', 'PUROGAINS');
    $mail->addAddress('negrillo1124@gmail.com', 'Destinatario');

    $mail->isHTML(true);
    $mail->Subject = 'Prueba desde PHPMailer en XAMPP';
    $mail->Body    = 'Hola <b>amigo</b>, este es un correo de prueba desde XAMPP.';
    $mail->AltBody = 'Hola amigo, este es un correo de prueba desde XAMPP.';

    $mail->send();
    echo '✅ Correo enviado correctamente.';
} catch (Exception $e) {
    echo "❌ Error al enviar el correo: {$mail->ErrorInfo}";
}
