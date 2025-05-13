<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recuperación de Contraseña</title>
  <link rel="icon" href="../img/skillify_favicon.ico" type="image/ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
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
      <h2 class="text-center mb-4">Recuperar Contraseña</h2>
      <p class="text-center text-muted mb-4">Se ha enviado un enlace de recuperación a tu correo.</p>

      <div class="d-grid mb-1">
        <a href="../login.php" class="btn btn-custom">Volver a Iniciar Sesión</a>
      </div>

      <div class="social-icons text-center">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-google"></i></a>
      </div>

      <p class="text-center text-muted mb-0 small">
        <img src="../img/skillify_logo.png" alt="Skillify Logo" style="max-width: 100px;">
      </p>
    </div>
  </section>

  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>