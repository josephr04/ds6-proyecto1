<?php
include '../utils/conexion.php';

header('Content-Type: application/json');

// Funcion para obtener datos de la base de datos
function fetchData($conexion, $query, $param) {
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

// Sanitizar y validar los parámetros de entrada
$tipo = $_GET['tipo'] ?? '';
$tipo = htmlspecialchars(trim($tipo), ENT_QUOTES, 'UTF-8');
$datos = [];

if ($tipo === 'distrito') {
    $codigo_provincia = $_GET['provincia_id'] ?? '';
    $codigo_provincia = htmlspecialchars(trim($codigo_provincia), ENT_QUOTES, 'UTF-8');
    if ($codigo_provincia) {
        $datos = fetchData($conexion, "SELECT codigo_distrito, nombre_distrito FROM distrito WHERE codigo_provincia = ?", $codigo_provincia);
    }
} elseif ($tipo === 'corregimiento') {
    $codigo_distrito = $_GET['distrito_id'] ?? '';
    $codigo_distrito = htmlspecialchars(trim($codigo_distrito), ENT_QUOTES, 'UTF-8');
    if ($codigo_distrito) {
        $datos = fetchData($conexion, "SELECT codigo_corregimiento, nombre_corregimiento FROM corregimiento WHERE codigo_distrito = ?", $codigo_distrito);
    }
}

// Generar la respuesta en formato JSON
echo json_encode($datos);
?>