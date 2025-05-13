<?php
include "../utils/conexion.php";

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    $stmt = $conexion->prepare("DELETE FROM empleados WHERE cedula = ?");
    $stmt->bind_param("s", $cedula);

    if ($stmt->execute()) {
        header("Location: ../admin/form_tablas.php?exito=2");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al eliminar empleado.</div>";
    }

    $stmt->close();
}

?>
