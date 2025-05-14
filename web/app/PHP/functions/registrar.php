<?php

include "../utils/conexion.php";

if (isset($_POST["btnregistrar"])) {
    // Cédula
    $prefijo = $_POST["prefijo"] ?? "";
    $tomo = $_POST["tomo"] ?? "";
    $asiento = $_POST["asiento"] ?? "";
    $cedula = "$prefijo-$tomo-$asiento";

    // Nombres y apellidos
    $nombre1 = $_POST["nombre1"] ?? "";
    $nombre2 = $_POST["nombre2"] ?? "";
    
    $apellido1 = $_POST["apellido1"] ?? "";
    $apellido2 = $_POST["apellido2"] ?? "";
    
    // Lógica para campos que podrían venir vacíos
    $genero = $_POST["genero"] ?? "0"; // default masculino
    $usa_ac = $_POST["usa_ac"] ?? "0"; // default No
    $apellidoc = $_POST["apellidoc"] ?? "0";

    // Si es masculino, forzar valores vacíos o por defecto
    if ($genero === "0") {
        $usa_ac = "0";
        $apellidoc = "0";
    }

    // Otros datos
    $estado_civil = $_POST["estado_civil"] ?? "";
    $tipo_sangre = $_POST["tipo_sangre"] ?? "";
    $f_nacimiento = $_POST["f_nacimiento"] ?? "";
    $celular = $_POST["celular"] ?? "";
    $telefono = $_POST["telefono"] ?? "";
    $correo = $_POST["correo"] ?? "";
    $provincia = $_POST["provincia"] ?? "";
    $distrito = $_POST["distrito"] ?? "";
    $corregimiento = $_POST["corregimiento"] ?? "";
    $calle = $_POST["calle"] ?? "";
    $casa = $_POST["casa"] ?? "";
    $comunidad = $_POST["comunidad"] ?? "";
    $nacionalidad = $_POST["nacionalidad"] ?? "";
    $f_contra = $_POST["f_contra"] ?? "";
    $cargo = $_POST["cargo"] ?? "";
    $departamento = $_POST["departamento"] ?? "";
    $estado = $_POST["estado"] ?? "";

    // Consulta SQL con 28 campos
    $sql = "INSERT INTO empleados (
        cedula, prefijo, tomo, asiento,
        nombre1, nombre2, apellido1, apellido2, apellidoc,
        genero, estado_civil, tipo_sangre, usa_ac, f_nacimiento,
        celular, telefono, correo, provincia, distrito, corregimiento,
        calle, casa, comunidad, nacionalidad, f_contra, cargo, departamento, estado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssssssssssss",
        $cedula, $prefijo, $tomo, $asiento,
        $nombre1, $nombre2, $apellido1, $apellido2, $apellidoc,
        $genero, $estado_civil, $tipo_sangre, $usa_ac, $f_nacimiento,
        $celular, $telefono, $correo, $provincia, $distrito, $corregimiento, $calle, $casa, $comunidad,
        $nacionalidad, $f_contra, $cargo, $departamento, $estado
    );

    if ($stmt->execute()) {
        header("Location: ../admin/agregar_empleado.php?exito=1");
    } else {
        header("Location: ../admin/agregar_empleado.php?error=Error al registrar empleado: " . $stmt->error);
    }

    $stmt->close();
    $conexion->close();
}
?>