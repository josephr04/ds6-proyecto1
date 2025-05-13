<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecer Contraseña</title>
  <link rel="icon" href="../img/skillify_favicon.ico" type="image/ico">
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
      <form action="../functions/nueva_contrasena.php" method="POST">
          <div class="card p-4" style="max-width: 500px;">
              <h2 class="text-center mb-4">Restablecer Contraseña</h2>
              <div class="mb-3">
                  <p class="text-center text-muted mb-4">Ingresa tu nueva contraseña.</p>
                  <!-- Campo de nueva contraseña -->
                  <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nueva contraseña" required>
              </div>

              <!-- Campo oculto para enviar el token -->
              <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

              <div class="d-grid mb-1">
                <button type="submit" class="btn btn-custom">Restablecer contraseña</button>
              </div>

              <div class="social-icons text-center mb-3">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-google"></i></a>
              </div>

              <p class="text-center text-muted mb-0 small">
                <img src="../img/skillify_logo.png" alt="Skillify Logo" style="max-width: 100px;">
              </p>
          </div>
      </form>
  </section>

</body>
</html>
