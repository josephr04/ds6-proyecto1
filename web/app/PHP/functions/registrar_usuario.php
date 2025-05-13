<?php
include '../utils/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo_institucional']);
    $cedula = $_POST['cedula'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    // Validación básica
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }

    $stmt = $conexion->prepare("INSERT INTO usuarios (correo_institucional, cedula, contraseña, rol_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $correo, $cedula, $contrasena, $rol);

    if ($stmt->execute()) {
        header("Location: ../admin/agregar_usuario.php?exito=1");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
