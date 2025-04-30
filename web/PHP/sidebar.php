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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <php>
    
    </php>
    <style>
        body {
            display: flex;
            height: 290px;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background-color:rgba(255, 250, 243, 0.89);
            display: flex;
            flex-direction: column;
            padding: 15px;
            border-right: 1px solid #ddd;{}
            
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 0.5rem;
        }

        .sidebar-nav .nav-link {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-radius: 5px;
        }

        .sidebar-nav .nav-link:hover {
            background-color: #e9ecef;
            color: #000;
        }

        .sidebar-footer {
            margin-top: auto;
            text-align: center;
        }

        .sidebar-toggler {
            background: none;
            border: none;
            cursor: pointer;
        }

        .content {
            flex-grow: 1;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-header border-bottom">
    <div class="sidebar-brand">Home</div>
  </div>
  <ul class="sidebar-nav">
    <li class="nav-item nav-group show">
      <a class="nav-link nav-group-toggle">
        <i class="nav-icon cil-puzzle"></i> Gestion de Empleados
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span class="nav-icon"></span> Ver Empleado
          </a>
        </li>


          <a class="nav-link" href="modificar_campos.php">
              <i class="fa-solid fa-pen-to-square"></i> Editar/Eliminar Empleado
          </a>
        </li>
        <a href="logout.php" class="btn btn-danger w-100 mt-auto">Cerrar Sesión</a>
        
      </ul>
    </li>   
  </ul>
</div>
</body>
</html>






