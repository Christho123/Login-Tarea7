<?php

require_once __DIR__ . '/../libraries/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../libraries/PHPMailer/SMTP.php';
require_once __DIR__ . '/../libraries/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService {

    public static function sendOTP($to, $code) {

        $mail = new PHPMailer(true);

        try {
            // 🔐 SMTP GMAIL
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            $mail->Username   = 'qrqdsq45@gmail.com';
            $mail->Password   = 'nexuiwrrertfjygy'; // 🔥 SIN ESPACIOS

            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // 📧 Remitente
            $mail->setFrom('qrqdsq45@gmail.com', 'Sistema OTP');

            // 📩 Destino
            $mail->addAddress($to);

            // 📄 Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Código de verificación';
            $mail->Body    = "
                <h2>Tu código OTP</h2>
                <h1>$code</h1>
                <p>Expira en 5 minutos</p>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            echo "Error al enviar correo: {$mail->ErrorInfo}";
            return false;
        }
    }
}