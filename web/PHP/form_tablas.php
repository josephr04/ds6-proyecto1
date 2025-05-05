<?php
include "utils/conexion.php";
include "utils/select.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'; ?>

    <div class="container">

        <h2 class="text-center mb-4 mt-4 text-dark">📋 Lista de Empleados</h2>

        <?php if (isset($_GET['exito']) && $_GET['exito'] == '1'): ?>
            <div class="mt-3">
                <div class="alert alert-success alert-dismissible fade show" style="max-width: 500px;" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i> ¡Datos actualizados correctamente!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Cédula</th>
                        <th>Primer Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Apellido Casada</th>
                        <th>Género</th>
                        <th>Estado Civil</th>
                        <th>Tipo de Sangre</th>
                        <th>Usa AC</th>
                        <th>Fecha Nac.</th>
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
                        <th>Fecha Contratación</th>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td><?= $datos->cedula ?></td>

                            <td><?= $datos->nombre1 ?></td>
                            <td><?= $datos->nombre2 ?></td>
                            <td><?= $datos->apellido1 ?></td>
                            <td><?= $datos->apellido2 ?></td>
                            <td>
                            <?= (!empty($datos->apellidoc)) ? htmlspecialchars($datos->apellidoc) : 'N/A' ?>
                        </td>
                            <td><?= ($datos->genero == 0) ? 'Masculino' : 'Femenino' ?></td>
                            <td>
                                <?= htmlspecialchars(
                                $datos->estado_civil == 1 ? 'Soltero/a' : 
                                ($datos->estado_civil == 2 ? 'Casado/a' : 
                                ($datos->estado_civil == 3 ? 'Divorciado/a' : 'Viudo/a'))
                                ) ?>
                            </td>
                            <td><?= $datos->tipo_sangre ?></td>
                            <td><?= ($datos->usa_ac == 1) ? 'Sí' : 'N/A' ?></td>
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
                            <td><?= $datos->nacionalidad?></td>
                            <td><?= $datos->f_contra ?></td>
                            <td><?= $datos->nombre_cargo?></td>
                            <td><?= $datos->departamento ?></td>
                            <td><?= ($datos->estado == 1) ?'Activo': 'Inactivo' ?></td>
                            <td>
                                <!-- Botones de acción con iconos de Font Awesome -->
                                <a href="modificar_campos.php?cedula=<?= $datos->cedula ?>" class="btn btn-sm btn-warning d-block mb-2">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                </a>
                                <a href="functions/eliminar.php?cedula=<?= $datos->cedula ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

