<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';
require '../utils/conexion.php'; // Include your database connection

$email = $_POST['email'] ?? ''; // Get the email from the form submission

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Dirección de correo no válida.";
    exit();
}

// Check if the email exists in the database
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo_institucional = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Generate a unique token
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

    // Store the token and expiry in the database
    $stmt = $conexion->prepare("UPDATE usuarios SET reset_token = ?, reset_token_expiry = ? WHERE correo_institucional = ?");
    $stmt->bind_param("sss", $token, $expiry, $email);
    $stmt->execute();

    // Generate the reset link
    $resetLink = "http://localhost/ds6-proyecto1/web/app/PHP/reset_password.php?token=$token";

    // Send the reset link via email
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2; // Set to 2 for detailed debug output
        $mail->Debugoutput = 'html'; // Output debug information in HTML format
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = ''; // Your Gmail address
        $mail->Password = ''; // Your Gmail password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('Skillify@gmail.com', 'Skillify');
        $mail->addAddress($email); // Recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Recuperar Contraseña';
        $mail->Body = "Haz clic en el siguiente enlace para restablecer tu contraseña: <a href='$resetLink'>$resetLink</a>";

        $mail->send();
        echo "Se ha enviado un enlace de recuperación a tu correo.";
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
} else {
    echo "El correo ingresado no está registrado.";
}
?>