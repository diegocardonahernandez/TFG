<?php

require_once __DIR__ . '/../Model/Classes/User.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/redirectView.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../lib/phpmailer/src/Exception.php';
require __DIR__ . '/../lib/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../lib/phpmailer/src/SMTP.php';

if (!isset($_SESSION['userId'])) {
    header('Location: /login');
    exit();
}

$currentUser = User::getUserById($_SESSION['userId']);

$sessionId = $_GET['session_id'] ?? null;

if (!$sessionId) {
    header('Location: /');
    exit();
}

require_once __DIR__ . '/../lib/stripe/init.php';
\Stripe\Stripe::setApiKey('sk_test_51RVrxgQ46PVjWGdXHNKc9goQkExIJozD1NAUJiIKYNdlZ6I6VvCB0Myyvnl07UQoxhfOSXL2IbbY6lNwFEx9G8Zk00yWgE7KEk');

try {

    foreach ($_SESSION['cart'] as $item) {
        Product::decreaseStockAndUpdatePopularidad($item['id'], $item['quantity']);
    }

    $session = \Stripe\Checkout\Session::retrieve($sessionId);
    $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

    $paymentData = [
        'orderId' => $session->id,
        'paymentId' => $paymentIntent->id,
        'amount' => $paymentIntent->amount / 100,
        'currency' => strtoupper($paymentIntent->currency),
        'status' => $paymentIntent->status,
        'date' => date('d/m/Y H:i', $paymentIntent->created),
        'paymentMethod' => $paymentIntent->payment_method_types[0] ?? 'card'
    ];

    unset($_SESSION['cart']);

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
        $mail->addAddress($currentUser->getCorreo(), $currentUser->getNombre() . ' ' . $currentUser->getApellido());

        $mail->isHTML(true);
        $mail->Subject = '¡Gracias por tu compra! - PUROGAINS';

        $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; color: #333;'>
            <div style='text-align: center; margin-bottom: 30px;'>
                <h1 style='color: #aa0303; margin-bottom: 10px;'>¡Gracias por tu compra, {$currentUser->getNombre()}!</h1>
                <p style='font-size: 16px; color: #666;'>Tu pedido ha sido procesado exitosamente</p>
            </div>
            
            <div style='background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;'>
                <h2 style='color: #aa0303; margin-bottom: 15px;'>Detalles de tu compra</h2>
                <p style='margin-bottom: 10px;'><strong>👤 Cliente:</strong> {$currentUser->getNombre()} {$currentUser->getApellido()}</p>
                <p style='margin-bottom: 10px;'><strong>📧 Email:</strong> {$currentUser->getCorreo()}</p>
                <p style='margin-bottom: 10px;'><strong>📱 Teléfono:</strong> {$currentUser->getTelefono()}</p>
                <p style='margin-bottom: 10px;'><strong>🛍️ Número de orden:</strong> {$paymentData['orderId']}</p>
                <p style='margin-bottom: 10px;'><strong>💰 Total:</strong> {$paymentData['amount']} {$paymentData['currency']}</p>
                <p style='margin-bottom: 10px;'><strong>📅 Fecha:</strong> {$paymentData['date']}</p>
                <p style='margin-bottom: 10px;'><strong>💳 Método de pago:</strong> {$paymentData['paymentMethod']}</p>
            </div>
            
            <div style='background-color: #666666; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;'>
                <p style='margin: 0;'>📦 Tu pedido será procesado y enviado lo antes posible. Recibirás actualizaciones sobre el estado de tu envío.</p>
            </div>
            
            <div style='text-align: center; color: #666; font-size: 14px;'>
                <p>Si tienes alguna pregunta sobre tu pedido, no dudes en contactarnos.</p>
                <p style='margin-top: 20px;'>© " . date('Y') . " PUROGAINS - Tu camino hacia una vida saludable</p>
            </div>
            <div style='text-align: center; border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px; font-size: 12px; color: #999;'>
                <p>Este es un correo automático de confirmación de compra de PUROGAINS.</p>
                <p>Si no realizaste esta compra, por favor <a href='mailto:purogainscompany@gmail.com?subject=Compra no autorizada&body=No realicé esta compra.' style='color: #aa0303; text-decoration: none;'>contáctanos</a>.</p>
            </div>
        </div>";

        $mail->AltBody = "¡Gracias por tu compra, {$currentUser->getNombre()}!\n\n" .
            "Cliente: {$currentUser->getNombre()} {$currentUser->getApellido()}\n" .
            "Email: {$currentUser->getCorreo()}\n" .
            "Teléfono: {$currentUser->getTelefono()}\n" .
            "Número de orden: {$paymentData['orderId']}\n" .
            "Total: {$paymentData['amount']} {$paymentData['currency']}\n" .
            "Fecha: {$paymentData['date']}\n" .
            "Método de pago: {$paymentData['paymentMethod']}\n\n" .
            "Tu pedido será procesado y enviado lo antes posible. Recibirás actualizaciones sobre el estado de tu envío.";

        $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar el correo de confirmación: " . $mail->ErrorInfo);
    }

    renderLayout('paymentConfirmation', [
        "currentUser" => $currentUser,
        "paymentData" => $paymentData
    ]);
} catch (Exception $e) {
    header('Location: /cart');
    exit();
}