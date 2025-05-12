<?php
include 'utils/conexion.php';

$token = $_GET['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';

    // Validate the token and update the password
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("UPDATE usuarios SET contrasena = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashedPassword, $token);
        $stmt->execute();

        echo "Tu contraseña ha sido restablecida correctamente.";
    } else {
        echo "El token es inválido o ha expirado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Restablecer Contraseña</h2>
        <form action="reset_password.php" method="POST" class="mt-4">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
            <div class="mb-3">
                <label for="new_password" class="form-label">Nueva Contraseña</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Ingrese su nueva contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
        </form>
    </div>
</body>
</html>