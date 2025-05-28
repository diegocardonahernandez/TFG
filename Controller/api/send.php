<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir los archivos necesarios de PHPMailer
require __DIR__ . '/../../lib/phpmailer/src/Exception.php';
require __DIR__ . '/../../lib/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../lib/phpmailer/src/SMTP.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();                                      // Usar SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Servidor SMTP de Gmail
    $mail->SMTPAuth   = true;                             // Habilitar autenticación SMTP
    $mail->Username   = 'purogainscompany@gmail.com';            // Tu correo Gmail
    $mail->Password   = 'qgwn avwv lnks zmml';                // Contraseña de aplicación de Gmail
    $mail->SMTPSecure = 'tls';                            // Encriptación TLS
    $mail->Port       = 587;                              // Puerto SMTP

    // Remitente y destinatario
    $mail->setFrom('purogainscompany@gmail.com', 'PUROGAINS');
    $mail->addAddress('negrillo1124@gmail.com', 'Destinatario');

    // Contenido del correo
    $mail->isHTML(true);                                  // Habilitar HTML
    $mail->Subject = 'Prueba desde PHPMailer en XAMPP';
    $mail->Body    = 'Hola <b>amigo</b>, este es un correo de prueba desde XAMPP.';
    $mail->AltBody = 'Hola amigo, este es un correo de prueba desde XAMPP.';

    // Enviar
    $mail->send();
    echo '✅ Correo enviado correctamente.';
} catch (Exception $e) {
    echo "❌ Error al enviar el correo: {$mail->ErrorInfo}";
}