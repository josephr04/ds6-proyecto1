<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Empleados</title>
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
    <form action="auth/procesar_login.php" method="POST" class="w-100" style="max-width: 400px;">
      <div class="card p-4">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <p class="text-center text-muted mb-4">Ingrese su correo institucional y contraseña</p>

        <div class="mb-3">
          <input type="email" name="correo_institucional" class="form-control" placeholder="Correo institucional" required />
        </div>

        <div class="mb-3">
          <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required />
        </div>

        <?php if (isset($_GET['error'])): ?>
          <div class="text-danger text-center mb-3">
            <?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?>
          </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <a href="#!" class="text-muted small">¿Olvidó su contraseña?</a>
        </div>

        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-custom">Entrar</button>
        </div>

        <div class="social-icons text-center mb-3">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-google"></i></a>
        </div>

        <p class="text-center text-muted mb-0 small">Empresa Ficticia S.A</p>
      </div>
    </form>
  </section>

  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
