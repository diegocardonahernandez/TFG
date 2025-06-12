<?php

require_once __DIR__ . '/../Model/Classes/User.php';
require_once __DIR__ . '/../Model/Classes/Product.php';
require_once __DIR__ . '/../Functions/redirectView.php';
require_once __DIR__ . '/../lib/dompdf/autoload.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

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

    $session = \Stripe\Checkout\Session::retrieve([
        'id' => $sessionId,
        'expand' => ['line_items']
    ]);
    $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

    $paymentData = [
        'orderId' => $session->id,
        'paymentId' => $paymentIntent->id,
        'amount' => $paymentIntent->amount / 100,
        'currency' => strtoupper($paymentIntent->currency),
        'status' => $paymentIntent->status,
        'date' => date('d/m/Y H:i', $paymentIntent->created),
        'paymentMethod' => $paymentIntent->payment_method_types[0] ?? 'card',
        'shipping' => $session->shipping_cost ? $session->shipping_cost->amount_total / 100 : 0
    ];

    unset($_SESSION['cart']);
    unset($_SESSION['shipping']);

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');

    $dompdf = new Dompdf($options);

    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Helvetica, Arial, sans-serif; color: #222; background: #fff; margin: 0; padding: 0; }
            .invoice-container { max-width: 700px; margin: 40px auto; padding: 40px 30px; border: 1px solid #e0e0e0; border-radius: 10px; background: #fafbfc; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
            .header { text-align: center; margin-bottom: 30px; }
            .company-name { font-size: 32px; font-weight: bold; color: #aa0303; letter-spacing: 2px; margin-bottom: 4px; }
            .company-desc { color: #888; font-size: 15px; margin-bottom: 2px; }
            .invoice-title { font-size: 22px; color: #222; font-weight: 700; margin-top: 20px; margin-bottom: 0; }
            .divider { border: none; border-top: 2px solid #aa0303; margin: 18px 0 28px 0; }
            .section-title { color: #aa0303; font-size: 16px; font-weight: 700; margin-bottom: 10px; }
            .info-table { width: 100%; margin-bottom: 18px; }
            .info-table td { padding: 4px 0; font-size: 15px; }
            .info-label { color: #444; font-weight: 600; width: 160px; }
            .info-value { color: #222; }
            .items-table { width: 100%; border-collapse: collapse; margin: 18px 0 10px 0; }
            .items-table th { background: #aa0303; color: #fff; padding: 10px; font-size: 15px; font-weight: 700; border-top-left-radius: 6px; border-top-right-radius: 6px; }
            .items-table td { padding: 10px; border-bottom: 1px solid #e0e0e0; font-size: 15px; }
            .items-table tr:last-child td { border-bottom: none; }
            .summary-table { width: 100%; margin-top: 18px; border-collapse: collapse; }
            .summary-table tr { height: 32px; }
            .summary-label, .grand-total-label { text-align: right; color: #444; font-weight: 600; padding-right: 16px; }
            .summary-value, .grand-total-value { text-align: right; color: #222; font-weight: 700; min-width: 120px; }
            .grand-total-row .grand-total-label, .grand-total-row .grand-total-value { color: #aa0303; font-size: 18px; font-weight: 800; }
            .footer { text-align: left; color: #aaa; font-size: 13px; margin-top: 40px; border-top: 1px solid #e0e0e0; padding-top: 22px; line-height: 1.5; }
        </style>
    </head>
    <body>
        <div class="invoice-container">
            <div class="header">
                <div class="company-name">PUROGAINS</div>
                <div class="company-desc">Su tienda de nutrición y suplementación deportiva</div>
                <div class="invoice-title">Factura de compra</div>
            </div>
            <hr class="divider" />
            <div class="section-title">Datos del Cliente</div>
            <table class="info-table">
                <tr><td class="info-label">Nombre:</td><td class="info-value">' . htmlspecialchars($currentUser->getNombre() . ' ' . $currentUser->getApellido()) . '</td></tr>
                <tr><td class="info-label">Email:</td><td class="info-value">' . htmlspecialchars($currentUser->getCorreo()) . '</td></tr>
                <tr><td class="info-label">Teléfono:</td><td class="info-value">' . htmlspecialchars($currentUser->getTelefono()) . '</td></tr>
            </table>
            <div class="section-title">Detalles de la Factura</div>
            <table class="info-table">
                <tr><td class="info-label">Número de Factura:</td><td class="info-value">' . htmlspecialchars($session->id) . '</td></tr>
                <tr><td class="info-label">Fecha de Emisión:</td><td class="info-value">' . date('d/m/Y H:i', $paymentIntent->created) . '</td></tr>
                <tr><td class="info-label">Método de Pago:</td><td class="info-value">' . ucfirst($paymentIntent->payment_method_types[0] ?? 'Tarjeta') . '</td></tr>
            </table>
            <div class="section-title">Productos Adquiridos</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>';
    if ($session->line_items && $session->line_items->data) {
        foreach ($session->line_items->data as $item) {
            $html .= '
                    <tr>
                        <td>' . htmlspecialchars($item->description) . '</td>
                        <td>' . $item->quantity . '</td>
                        <td>' . number_format($item->amount_total / 100 / $item->quantity, 2) . ' €</td>
                        <td>' . number_format($item->amount_total / 100, 2) . ' €</td>
                    </tr>';
        }
    }
    $html .= '
                </tbody>
            </table>
            <table class="summary-table">
                <tr>
                    <td class="summary-label" colspan="2">Subtotal:</td>
                    <td class="summary-value" colspan="2">' . number_format($session->amount_subtotal / 100, 2) . ' €</td>
                </tr>';
    if ($session->shipping_cost) {
        $html .= '
                <tr>
                    <td class="summary-label" colspan="2">Envío:</td>
                    <td class="summary-value" colspan="2">' . number_format($session->shipping_cost->amount_total / 100, 2) . ' €</td>
                </tr>';
    }
    $html .= '
                <tr class="grand-total-row">
                    <td class="grand-total-label" colspan="2">Total:</td>
                    <td class="grand-total-value" colspan="2">' . number_format($session->amount_total / 100, 2) . ' €</td>
                </tr>
            </table>
            <div class="footer">
                Gracias por confiar en PUROGAINS. Si tiene cualquier consulta sobre su pedido o requiere una factura detallada, no dude en contactarnos.<br/>
                Este documento es válido como comprobante de compra.<br/>
                PUROGAINS &copy; ' . date('Y') . '
            </div>
        </div>
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $pdfContent = $dompdf->output();
    $tempFile = tempnam(sys_get_temp_dir(), 'receipt_');
    file_put_contents($tempFile, $pdfContent);

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
        $mail->Subject = 'Confirmacion de compra y factura - PUROGAINS';

        $mail->Body = "
        <div style='font-family: Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 32px 24px; color: #222; background: #fafbfc; border-radius: 10px; border: 1px solid #e0e0e0;'>
            <div style='text-align: center; margin-bottom: 24px;'>
                <span style='font-size: 28px; font-weight: bold; color: #aa0303; letter-spacing: 2px;'>PUROGAINS</span><br/>
                <span style='color: #888; font-size: 15px;'>Su tienda de nutrición y suplementación deportiva</span>
            </div>
            <div style='font-size: 20px; color: #222; font-weight: 700; margin-bottom: 18px;'>Confirmación de compra</div>
            <div style='font-size: 15px; color: #444; margin-bottom: 18px;'>Estimado/a <b>{$currentUser->getNombre()} {$currentUser->getApellido()}</b>,<br>Le agradecemos su confianza en PUROGAINS. Su pedido ha sido procesado correctamente. Adjuntamos la factura en PDF a este correo.</div>
            <div style='background: #fff; border-radius: 8px; border: 1px solid #e0e0e0; padding: 18px 16px; margin-bottom: 18px;'>
                <div style='font-size: 16px; color: #aa0303; font-weight: 700; margin-bottom: 10px;'>Resumen de su compra</div>
                <table style='width: 100%; font-size: 15px; color: #222;'>
                    <tr><td style='font-weight: 600; color: #444;'>Número de factura:</td><td>{$session->id}</td></tr>
                    <tr><td style='font-weight: 600; color: #444;'>Fecha:</td><td>" . date('d/m/Y H:i', $paymentIntent->created) . "</td></tr>
                    <tr><td style='font-weight: 600; color: #444;'>Total:</td><td><b>" . number_format($session->amount_total / 100, 2) . " €</b></td></tr>
                </table>
            </div>
            <div style='font-size: 14px; color: #666; margin-bottom: 10px;'>Si tiene cualquier consulta sobre su pedido, puede responder a este correo o escribirnos a <a href='mailto:purogainscompany@gmail.com' style='color: #aa0303;'>purogainscompany@gmail.com</a>.</div>
            <div style='font-size: 13px; color: #aaa; text-align: center; margin-top: 24px;'>Este correo es una confirmación automática. PUROGAINS &copy; " . date('Y') . "</div>
        </div>";

        $mail->AltBody = "Estimado/a {$currentUser->getNombre()} {$currentUser->getApellido()},\n\nGracias por su compra en PUROGAINS. Adjuntamos la factura en PDF.\n\nNúmero de factura: {$session->id}\nFecha: " . date('d/m/Y H:i', $paymentIntent->created) . "\nTotal: " . number_format($session->amount_total / 100, 2) . " €\n\nSi tiene cualquier consulta, puede responder a este correo o escribirnos a purogainscompany@gmail.com.\n\nPUROGAINS";

        $mail->addAttachment($tempFile, 'recibo_purogains_' . $session->id . '.pdf', 'base64', 'application/pdf');

        $mail->send();

        unlink($tempFile);
    } catch (Exception $e) {
        error_log("Error al enviar el correo de confirmación: " . $mail->ErrorInfo);
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }
    }

    renderLayout('paymentConfirmation', [
        "currentUser" => $currentUser,
        "paymentData" => $paymentData
    ]);
} catch (Exception $e) {
    header('Location: /cart');
    exit();
}