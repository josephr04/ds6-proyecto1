<?php
include '../utils/conexion.php';

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    $query = "DELETE FROM usuarios WHERE cedula = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $cedula);
    $resultado = $stmt->execute();

    if ($resultado) {
        header("Location: ../admin/agregar_usuario.php?eliminado=1");
        exit();
    } else {
        header("Location: ../admin/agregar_usuario.php?eliminado=0");
        exit();
    }
} else {
    header("Location: ../admin/agregar_usuario.php");
    exit();
}