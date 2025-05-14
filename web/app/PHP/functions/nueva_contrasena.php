<?php
include '../utils/conexion.php';

$token = $_GET['token'] ?? '';

// Si la solicitud es un POST, procesamos el restablecimiento de la contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';

    // Validar el token y actualizar la contraseña
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hashear la nueva contraseña
        $stmt = $conexion->prepare("UPDATE usuarios SET contraseña = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashedPassword, $token);
        $stmt->execute();

        $successMessage = "Tu contraseña ha sido restablecida correctamente.";
    } else {
        $errorMessage = "El token es inválido o ha expirado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/skillify_favicon.ico" type="image/ico">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
    }

    .card {
      border: none;
      border-radius: 2rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
      color: #333;
    }

    .form-control {
      border-radius: 1rem;
      padding: 0.75rem 1rem;
    }

    .form-control::placeholder {
      color: #aaa;
    }

    .btn-custom {
      border-radius: 2rem;
      padding: 0.75rem 2rem;
      font-weight: 500;
      background-color: #6a11cb;
      border: none;
      color: #fff;
    }

    .btn-custom:hover {
      background-color: #5718a5;
    }

    .text-muted {
      font-size: 0.9rem;
    }

    .social-icons a {
      margin: 0 0.5rem;
      color: #6a11cb;
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: #2575fc;
    }
  </style>
</head>
<body>
    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="max-width: 500px;">
            <h2 class="text-center mb-4">Restablecer Contraseña</h2>

            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success text-center">
                    <?php echo $successMessage; ?>
                </div>
                <div class="d-grid">
                    <a href="../login.php" class="btn btn-custom">Regresar al Login</a>
                </div>
            <?php elseif (isset($errorMessage)): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $errorMessage; ?>
                </div>
                <div class="d-grid">
                    <a href="../reset/forgot_password.php" class="btn btn-custom">Intentar de nuevo</a>
                </div>
            <?php else: ?>
                <form action="reset_password.php" method="POST">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <div class="mb-3">
                        <input type="password" name="new_password" class="form-control" placeholder="Nueva contraseña" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Restablecer Contraseña</button>
                    </div>
                </form>
            <?php endif; ?>

            <p class="text-center text-muted mb-0 small mt-4">
              <img src="../img/skillify_logo.png" alt="Skillify Logo" style="max-width: 100px;">
            </p>            
        </div>
    </section>
</body>
</html>