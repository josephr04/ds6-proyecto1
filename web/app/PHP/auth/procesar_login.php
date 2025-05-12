<?php
include '../utils/conexion.php';
session_start();

if (isset($_POST['correo_institucional']) && isset($_POST['contrasena'])) {
    $correo = $_POST['correo_institucional'];
    $contrasena = $_POST['contrasena'];

    // Sanitizar y validar los parámetros de entrada
    $correo = htmlspecialchars(trim($correo), ENT_QUOTES, 'UTF-8');
    $contrasena = htmlspecialchars(trim($contrasena), ENT_QUOTES, 'UTF-8');

    // Consulta SQL para verificar el usuario y la contraseña
    $stmt = $conexion->prepare("SELECT id, rol_id FROM usuarios WHERE correo_institucional = ? AND contraseña = ?");
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        session_regenerate_id(true); // Regenerate session ID to prevent session fixation
        $_SESSION['correo_institucional'] = $correo;
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol_id'] = $usuario['rol_id'];

        // Redirigir según el rol
        if ($usuario['rol_id'] == 1) {
            header("Location: ../admin/index.php"); // página de administrador
        } elseif ($usuario['rol_id'] == 2) {
            header("Location: ../empleado/perfil.php"); // página de usuario
        } else {
            header("Location: ../login.php?error=Rol no reconocido.");
        }
        exit();
    } else {
        header("Location: ../login.php?error=Correo o contraseña incorrectos. Por favor, intente de nuevo.");
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../login.php?error=Hay campos vacíos.");
    exit();
}
?>