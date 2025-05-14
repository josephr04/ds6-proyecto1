<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';
require '../utils/conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../../');
$dotenv->load();

$email = $_POST['email'] ?? '';

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Dirección de correo no válida.";
    exit();
}

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo_institucional = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $stmt = $conexion->prepare("UPDATE usuarios SET reset_token = ?, reset_token_expiry = ? WHERE correo_institucional = ?");
    $stmt->bind_param("sss", $token, $expiry, $email);
    $stmt->execute();

    $resetLink = "http://localhost/ds6-proyecto1/web/app/PHP/reset/reset_password.php?token=$token";

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['GMAIL_USER'];
        $mail->Password = $_ENV['GMAIL_PASS'];
        $mail->addEmbeddedImage('../img/skillify_banner.png', 'bannerID');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($_ENV['GMAIL_USER'], 'Skillify');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Cambiar Contraseña';
        $mail->Body = '
            <h2>¡Restablece tu contraseña!</h2>
            <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
            <p><a href="' . $resetLink . '">' . $resetLink . '</a></p>
            <br>
            <img src="cid:bannerID" alt="Banner" style="width:100%; max-width:600px;">
        ';
        $mail->send();
        header("Location: ../reset/recuperacion_exito.php");
    } catch (Exception $e) {
        header("Location: ../reset/forgot_password.php?error=Error al enviar el correo: {$mail->ErrorInfo}");
    }
} else {
    header("Location: ../reset/forgot_password.php?error=El correo ingresado no está registrado.");
}

?>