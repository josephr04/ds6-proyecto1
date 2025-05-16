<?php
include '../utils/conexion.php';

$resultado = $conexion->query("SELECT codigo_provincia, nombre_provincia FROM provincia");

$provincias = array();

while ($fila = $resultado->fetch_assoc()) {
    $provincias[] = $fila;
}

echo json_encode($provincias);
?>
