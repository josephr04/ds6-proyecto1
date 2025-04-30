<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background-color: rgba(99, 99, 99, 0.89);
            display: flex;
            flex-direction: column;
            padding: 15px;
            border-right: 1px solid #ddd;
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 0.5rem;
            width: 100%;
        }

        .sidebar-nav .nav-link {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .sidebar-nav .nav-link:hover {
            background-color: #e9ecef;
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .sidebar-nav .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            margin-top: auto;
            text-align: center;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .btn-logout {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">Home</div>
    </div>
    <ul class="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-users"></i> Gestion de Empleados
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-eye"></i> Ver Empleados
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="modificar_campos.php">
                <i class="fas fa-edit"></i> Editar/Eliminar Empleado
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-user-plus"></i> Agregar Empleado
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-file-alt"></i> Reportes
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="logout.php" class="btn btn-danger btn-logout">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </div>
</div>

<div class="content">
    <!-- Contenido principal de tu aplicación aquí -->
</div>
</body>
</html>




