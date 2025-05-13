<?php
session_start();
include '../utils/conexion.php';
include '../utils/verificar_rol.php';

verificarRol(1); // Solo administrador

// Duración de la sesión (15 minutos)
$timeout = 900; // 900 segundos = 15 minutos

if (isset($_SESSION['last_activity'])) {
    if ((time() - $_SESSION['last_activity']) > $timeout) {
        // Sesión expirada
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
$_SESSION['last_activity'] = time();

if (empty($_SESSION['correo_institucional'])) {
    header("Location: login.php");
    exit();
}

// Contar usuarios registrados
$sql = "SELECT COUNT(*) AS total FROM usuarios";
$resultado = $conexion->query($sql);
$usuarios_registrados = 0;

if ($resultado && $fila = $resultado->fetch_assoc()) {
    $usuarios_registrados = $fila['total'];
}

$departamentos = ['VE', 'MK', 'TI', 'PR', 'RH', 'ST', 'LE'];
$empleados_por_departamento = [];

foreach ($departamentos as $dep) {
    $stmt = $conexion->prepare("SELECT COUNT(*) AS total FROM empleados WHERE departamento = ?");
    $stmt->bind_param("s", $dep);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();
    $empleados_por_departamento[$dep] = $fila['total'] ?? 0;
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleados</title>
    <link rel="icon" href="../img/skillify_favicon.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include '../components/sidebar.php'; ?>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="container py-4">
            <h1 class="text-center mb-5 text-dark">Bienvenido Administrador</h1>
            <div class="row">
                
                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-warning">
                    <div class="card-header bg-warning"><i class="fa fa-user-plus"></i> Empleados Registrados</div>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $usuarios_registrados; ?></h3>
                    </div>
                    <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                        Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-primary">
                    <div class="card-header bg-primary"><i class="fa fa-shopping-bag"></i> Empleados en Ventas</div>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $empleados_por_departamento['VE']; ?></h3>
                    </div>
                    <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                        Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-success">
                    <div class="card-header bg-success"><i class="fa fa-bar-chart"></i> Empleados en Marketing</div>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $empleados_por_departamento['MK']; ?></h3>
                    </div>
                    <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                        Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-danger">
                    <div class="card-header bg-danger"><i class="fa fa-pie-chart"></i> Empleados en IT</div>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $empleados_por_departamento['TI']; ?></h3>
                    </div>
                    <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                        Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-dark">
                        <div class="card-header bg-dark"><i class="fa fa-cogs"></i> Producción</div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $empleados_por_departamento['PR']; ?></h3>
                        </div>
                        <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                            Más información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-header bg-info"><i class="fa fa-users"></i> Recursos Humanos</div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $empleados_por_departamento['RH']; ?></h3>
                        </div>
                        <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                            Más información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-secondary">
                        <div class="card-header bg-secondary"><i class="fa fa-laptop"></i> Soporte Técnico</div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $empleados_por_departamento['ST']; ?></h3>
                        </div>
                        <a class="card-footer text-right text-decoration-none" href="form_tablas.php">  
                            Más información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
                    <div class="card text-white bg-light border">
                        <div class="card-header text-dark bg-light"><i class="fa fa-graduation-cap text-dark"></i> Legal</div>
                        <div class="card-body text-dark">
                            <h3 class="card-title"><?php echo $empleados_por_departamento['LE']; ?></h3>
                        </div>
                        <a class="card-footer text-right text-decoration-none text-dark" href="form_tablas.php">  
                            Más información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../javascript/formateo_campos.js"></script>
    <script src="../javascript/genero.js"></script>
    <script src="../javascript/localidades.js"></script>
    
</body>
</html>