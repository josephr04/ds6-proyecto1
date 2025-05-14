<?php
include '../utils/conexion.php';
include "../utils/select_usuarios.php";
include '../utils/verificar_rol.php';

verificarRol(1); // Solo administrador

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    <link rel="icon" href="../img/skillify_favicon.ico" type="image/ico">
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include '../components/sidebar.php'; ?>

    <div class="container py-4" style="padding-left: 250px;">
        <h1 class="text-center text-dark">Usuarios</h1>
                
        <!-- Mensaje de éxito -->
        <?php if (isset($_GET['exito']) && $_GET['exito'] == '1'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i> ¡Usuario creado correctamente!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row mb-4">

            <!-- Lista de usuarios -->
            <div class="col-md-7 mt-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-center fw-bold mb-2">Lista de usuarios</div>
                    <div class="table-container">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre1</th>
                                    <th>Apellido1</th>
                                    <th>Correo Institucional</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($datos = $sql->fetch_object()) { ?>
                                    <tr>
                                        <td><?= $datos->cedula ?></td>
                                        <td><?= $datos->nombre1 ?></td>
                                        <td><?= $datos->apellido1 ?></td>
                                        <td><?= $datos->correo_institucional?></td>
                                        <td><?= ($datos->rol_id == 1) ?'Administrador': 'Usuario' ?></td>
                                        <td>
                                            <a href="../functions/eliminar_usuario.php?cedula=<?= $datos->cedula ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
            <!-- Form de usuario -->
            <div class="col-md-5 mt-4">
                <form action="../functions/registrar_usuario.php" method="POST" class="mx-auto" style="max-width: 600px;">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-center fw-bold">👤 Crear Usuario</div>
                        <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Correo Institucional</label>
                            <input type="email" class="form-control" name="correo_institucional" required maxlength="100">
                        </div>

                        <!-- Cédula -->
                        <div class="mb-3">
                            <label class="form-label">Empleado</label>
                            <select class="form-control" name="cedula" required>
                                <option value="" disabled selected>Seleccione un empleado</option>
                                <?php
                                $query = "SELECT cedula, nombre1, apellido1 FROM empleados";
                                $result = mysqli_query($conexion, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $cedula = $row['cedula'];
                                    $nombreCompleto = $row['nombre1'] . ' ' . $row['apellido1'];
                                    echo "<option value='$cedula'>$cedula / $nombreCompleto</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" required minlength="6" maxlength="30">
                        </div>

                        <!-- Rol -->
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select class="form-control" name="rol" required>
                                <option value="" disabled selected>Seleccione un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>

                        </div>

                    </div>

                    <!-- Botón -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 mb-2">Crear</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
