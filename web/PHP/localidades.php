<?php
include 'conexion.php';

$tipo = $_GET['tipo'] ?? '';
$datos = [];

if ($tipo === 'distrito' && isset($_GET['provincia_id'])) {
    $codigo_provincia = $_GET['provincia_id'];
    $stmt = $conexion->prepare("SELECT codigo_distrito, nombre_distrito FROM distrito WHERE codigo_provincia = ?");
    $stmt->bind_param("s", $codigo_provincia);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }

} elseif ($tipo === 'corregimiento' && isset($_GET['distrito_id'])) {
    $codigo_distrito = $_GET['distrito_id'];
    $stmt = $conexion->prepare("SELECT codigo_corregimiento, nombre_corregimiento FROM corregimiento WHERE codigo_distrito = ?");
    $stmt->bind_param("s", $codigo_distrito);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
}

echo json_encode($datos);
?>
