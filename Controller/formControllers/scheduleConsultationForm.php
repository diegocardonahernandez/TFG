<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../lib/phpmailer/src/Exception.php';
require __DIR__ . '/../../lib/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../lib/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Error, método no permitido";
        exit;
    }

    if (!isset($_POST['fecha-consulta']) || !isset($_POST['motivo-consulta'])) {
        echo "Error, datos incompletos";
        exit;
    }

    $fechaConsulta = $_POST['fecha-consulta'];
    $motivoConsulta = $_POST['motivo-consulta'];
    $destinatario = $_SESSION['userEmail'];

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'purogainscompany@gmail.com';
    $mail->Password   = 'qgwn avwv lnks zmml';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('purogainscompany@gmail.com', 'PUROGAINS');
    $mail->addAddress($destinatario, 'Destinatario');

    $mail->isHTML(true);
    $mail->Subject = '¡Tu consulta ha sido agendada! - PUROGAINS';

    setlocale(LC_TIME, 'es_ES.UTF-8');
    $fechaFormateada = strftime("%A %d de %B del %Y", strtotime($fechaConsulta));

    $mail->Body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; color: #333;'>
        <div style='text-align: center; margin-bottom: 30px;'>
            <h1 style='color: #aa0303; margin-bottom: 10px;'>¡Tu consulta está confirmada!</h1>
            <p style='font-size: 16px; color: #666;'>Gracias por confiar en PUROGAINS para tu bienestar</p>
        </div>
        
        <div style='background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;'>
            <h2 style='color: #aa0303; margin-bottom: 15px;'>Detalles de tu consulta</h2>
            <p style='margin-bottom: 10px;'><strong>📅 Fecha:</strong> $fechaFormateada</p>
            <p style='margin-bottom: 10px;'><strong>📝 Motivo de la consulta:</strong></p>
            <p style='background-color: white; padding: 15px; border-radius: 5px; color: #666;'>$motivoConsulta</p>
        </div>
        
        <div style='background-color: #666666; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;'>
            <p style='margin: 0;'>📌 Importante: Recibirás un correo de confirmación con el enlace de la videollamada 24 horas antes de tu consulta.</p>
        </div>
        
        <div style='text-align: center; color: #666; font-size: 14px;'>
            <p>Si necesitas modificar o cancelar tu consulta, por favor contáctanos respondiendo este correo.</p>
            <p style='margin-top: 20px;'>© " . date('Y') . " PUROGAINS - Tu camino hacia una vida saludable</p>
        </div>
        <div style='text-align: center; border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px; font-size: 12px; color: #999;'>
            <p>Recibiste este correo porque solicitaste una consulta nutricional desde la calculadora IMC de PUROGAINS.</p>
            <p>Si no realizaste esta solicitud, por favor <a href='mailto:purogainscompany@gmail.com?subject=Consulta no solicitada&body=No solicité esta consulta nutricional.' style='color: #aa0303; text-decoration: none;'>contáctanos</a>.</p>
        </div>
    </div>";

    $mail->AltBody = "¡Tu consulta está confirmada!\n\n" .
        "Fecha: $fechaFormateada\n" .
        "Motivo de la consulta: $motivoConsulta\n\n" .
        "Importante: Recibirás un correo de confirmación con el enlace de la videollamada 24 horas antes de tu consulta.\n\n" .
        "Si necesitas modificar o cancelar tu consulta, por favor contáctanos respondiendo este correo.";

    $mail->send();

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Consulta agendada correctamente']);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => "Error al enviar el correo: {$mail->ErrorInfo}"]);
}