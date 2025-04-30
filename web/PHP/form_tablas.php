
<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        th {
            background-color: #0d6efd;
            color: white;
            text-align: center;
            vertical-align: middle;
        }
        td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">📋 Lista de Empleados</h2>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cargo</th>
                            <th>Departamento</th>
                            <th>Cédula</th>
                            <th>Género</th>
                            <th>Tipo de Sangre</th>
                            <th>F. Nacimiento</th>
                            <th>Celular</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th>Contratación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conexion.php";
                        $sql = $conexion->query("SELECT * FROM empleados");

                        while ($datos = $sql->fetch_object()) { ?>
                            <tr>
                                <td><?= $datos->nombre1 ?></td>
                                <td><?= $datos->apellido1 ?></td>
                                <td><?= $datos->cargo ?></td>
                                <td><?= $datos->departamento ?></td>
                                <td><?= $datos->cedula ?></td>
                                <td><?= $datos->genero == 0 ? 'Masculino' : 'Femenino' ?></td>
                                <td><?= $datos->tipo_sangre ?></td>
                                <td><?= $datos->f_nacimiento ?></td>
                                <td><?= $datos->celular ?></td>
                                <td><?= $datos->telefono ?></td>
                                <td><?= $datos->correo ?></td>
                                <td><?= $datos->provincia ?>, <?= $datos->distrito ?>, <?= $datos->corregimiento ?>, <?= $datos->calle ?>, Casa <?= $datos->casa ?>, <?= $datos->comunidad ?></td>
                                <td><?= $datos->f_contra ?></td>
                                <td><?= $datos->estado ? 'Activo' : 'Inactivo' ?></td>
                                <td class="text-center">
                                    <a href="editar_empleado.php?id=<?= $datos->id ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <a href="eliminar_empleado.php?id=<?= $datos->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?');"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
