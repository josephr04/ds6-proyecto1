
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">Home</div>
        </div>
        
        <ul class="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="form_tablas.php">
                    <i class="fas fa-eye"></i> Ver Empleados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="modificar_campos.php">
                    <i class="fas fa-edit"></i> Editar/Eliminar Empleado
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-user-plus"></i> Agregar Empleado
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="logout.php" class="btn btn-danger btn-logout">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </div>
    
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">📋 Lista de Empleados</h2>
        <div class="row g-4">
        <?php
            include "conexion.php";
            $sql = $conexion->query("
            SELECT empleados.*, 
                   provincia.nombre_provincia, 
                   distrito.nombre_distrito, 
                   corregimiento.nombre_corregimiento 
            FROM empleados 
            LEFT JOIN provincia ON empleados.provincia = provincia.codigo_provincia
            LEFT JOIN distrito ON empleados.distrito = distrito.codigo_distrito
            LEFT JOIN corregimiento ON empleados.corregimiento = corregimiento.codigo_corregimiento
            ");
        
            while ($datos = $sql->fetch_object()) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card employee-card h-100">
                        <div class="card-header text-center">
                            <h5 class="mb-0"><?= $datos->nombre1 . " " . $datos->apellido1 ?></h5>
                            <small><?= $datos->cargo ?> - <?= $datos->departamento ?></small>
                        </div>
                        <div class="card-body">
                            <div class="section-title">👤 Personal</div>
                            <div class="info-line"><i class="bi bi-credit-card-2-front"></i> Cédula: <?= $datos->cedula ?></div>
                            <div class="info-line"><i class="bi bi-gender-ambiguous"></i> Género: <?= $datos->genero == 0 ? 'Masculino' : 'Femenino' ?></div>
                            <div class="info-line"><i class="bi bi-droplet"></i> Sangre: <?= $datos->tipo_sangre ?></div>
                            <div class="info-line"><i class="bi bi-calendar3"></i> Nacimiento: <?= $datos->f_nacimiento ?></div>

                            <div class="section-title">📞 Contacto</div>
                            <div class="info-line"><i class="bi bi-phone"></i> Celular: <?= $datos->celular ?></div>
                            <div class="info-line"><i class="bi bi-telephone"></i> Teléfono: <?= $datos->telefono ?></div>
                            <div class="info-line"><i class="bi bi-envelope"></i> Correo: <?= $datos->correo ?></div>



                            <div class="section-title">🏠 Dirección</div>
                            <div class="info-line"><i class="bi bi-geo-alt"></i> <?= $datos->nombre_provincia ?>, <?= $datos->nombre_distrito ?></div>
                            <div class="info-line"><i class="bi bi-signpost-split"></i> <?= $datos->nombre_corregimiento ?> - <?= $datos->calle ?></div>
                            <div class="info-line"><i class="bi bi-house-door"></i> Casa: <?= $datos->casa ?>, <?= $datos->comunidad ?></div>

                            <div class="section-title">💼 Laboral</div>
                            <div class="info-line"><i class="bi bi-calendar-check"></i> Contratación: <?= $datos->f_contra ?></div>
                            <div class="info-line"><i class="bi bi-building"></i> Estado: <?= $datos->estado ? 'Activo': 'Inactivo'?></div>
                            <div class="info-line"><i class="bi bi-award"></i> Nacionalidad: <?= $datos->nacionalidad ?></div>
                            <div class="info-line"><i class="bi bi-wind"></i> ¿Usa A/C?: <?= $datos->usa_ac == 1 ? 'Sí' : 'No' ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

