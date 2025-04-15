<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container p-4">
        <h3 class="text-center text-primary">Listado de Empleados</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Apellido de Casada</th>
                    <th>Género</th>
                    <th>¿Usa A/C?</th>
                    <th>Estado Civil</th>
                    <th>Tipo de Sangre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Celular</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Provincia</th>
                    <th>Distrito</th>
                    <th>Corregimiento</th>
                    <th>Calle</th>
                    <th>Casa</th>
                    <th>Comunidad</th>
                    <th>Nacionalidad</th>
                    <th>Fecha de Contratación</th>
                    <th>Cargo</th>
                    <th>Departamento</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "conexion.php"; // Cambia esto por tu archivo real de conexión

                $sql = $conexion->query("SELECT * FROM empleados");

                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id ?></td>
                        <td><?= $datos->cedula_completa ?></td>
                        <td><?= $datos->nombre1 ?></td>
                        <td><?= $datos->nombre2 ?></td>
                        <td><?= $datos->apellido1 ?></td>
                        <td><?= $datos->apellido2 ?></td>
                        <td><?= $datos->apellidoc ?></td>
                        <td><?= $datos->genero == 0 ? 'Masculino' : 'Femenino' ?></td>
                        <td><?= $datos->usa_ac == 0 ? 'Sí' : 'No' ?></td>
                        <td><?= ucfirst($datos->estado_civil) ?></td>
                        <td><?= $datos->tipo_sangre ?></td>
                        <td><?= $datos->f_nacimiento ?></td>
                        <td><?= $datos->celular ?></td>
                        <td><?= $datos->telefono ?></td>
                        <td><?= $datos->correo ?></td>
                        <td><?= $datos->provincia ?></td>
                        <td><?= $datos->distrito ?></td>
                        <td><?= $datos->corregimiento ?></td>
                        <td><?= $datos->calle ?></td>
                        <td><?= $datos->casa ?></td>
                        <td><?= $datos->comunidad ?></td>
                        <td><?= $datos->nacionalidad ?></td>
                        <td><?= $datos->f_contra ?></td>
                        <td><?= $datos->cargo ?></td>
                        <td><?= $datos->departamento ?></td>
                        <td><?= $datos->estado ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
