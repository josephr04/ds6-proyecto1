<?php
$sql = $conexion->query("SELECT 
    e.cedula, e.prefijo, e.tomo, e.asiento, 
    e.nombre1, e.nombre2, e.apellido1, e.apellido2, e.apellidoc, 
    e.genero, e.estado_civil, e.tipo_sangre, e.usa_ac, e.f_nacimiento, 
    e.celular, e.telefono, e.correo, 
    p.nombre_provincia AS provincia,
    d.nombre_distrito AS distrito,
    c.nombre_corregimiento AS corregimiento,  
    e.calle, e.casa, e.comunidad, 
    n.pais AS nacionalidad,
    e.f_contra,
    dep.nombre AS departamento,
    car.nombre AS nombre_cargo,  
    e.estado
FROM empleados e
LEFT JOIN nacionalidad n ON e.nacionalidad = n.codigo
LEFT JOIN corregimiento c ON e.corregimiento = c.codigo_corregimiento
LEFT JOIN provincia p ON e.provincia = p.codigo_provincia
LEFT JOIN distrito d ON e.distrito = d.codigo_distrito
LEFT JOIN departamento dep ON e.departamento = dep.codigo
LEFT JOIN cargo car ON e.cargo = car.codigo");  
?>