<?php
include 'conexion.php';
session_start();
if (isset($_POST['correo_institucional']) && isset($_POST['contrasena'])) {
    $correo = $_POST['correo_institucional'];
    $contrasena = $_POST['contrasena'];

    // Sanitizar y validar los parámetros de entrada
    $correo = htmlspecialchars(trim($correo), ENT_QUOTES, 'UTF-8');
    $contrasena = htmlspecialchars(trim($contrasena), ENT_QUOTES, 'UTF-8');

    // Consulta SQL para verificar el usuario y la contraseña
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo_institucional = ? AND contraseña = ?");
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        session_regenerate_id(true); // Regenerate session ID to prevent session fixation
        $_SESSION['correo_institucional'] = $correo;
        header("Location: ./index.php"); // Redirigir a la página principal
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }

    $stmt->close();
} else {
    echo "Por favor, complete todos los campos.";
}
?>