<?php
$sql = $conexion->query("
    SELECT 
        u.cedula,
        u.correo_institucional,
        u.rol_id,
        e.nombre1,
        e.apellido1
    FROM usuarios u
    INNER JOIN empleados e ON u.cedula = e.cedula
");
?>
