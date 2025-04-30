<?php
session_start();
include 'conexion.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            background-color: rgba(99, 99, 99, 0.89);
            display: flex;
            flex-direction: column;
            padding: 15px;
            border-right: 1px solid #ddd;
            color: white;
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
            color: white;
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
            color: #636363;
        }

        .sidebar-footer {
            margin-top: auto;
            text-align: center;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .btn-logout {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            font-weight: bold;
        }

        .sidebar-brand {
            color: white;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            font-weight: bold;
            background-color: #f1f1f1;
            border-bottom: 1px solid rgba(0,0,0,.125);
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
                <a class="nav-link" href="#">
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

    <!-- Contenido Principal -->
    <div class="content">
        <div class="container py-4">
            <h1 class="text-center mb-5 text-dark">Bienvenido Administrador</h1>

            <form class="row g-4 mx-auto" style="max-width: 1200px;" action="conexion.php" method="POST">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <!-- Card Personal -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-center fw-bold">👤 Datos Personales</div>
                        <div class="card-body">
                            <!-- Cédula -->
                            <div class="mb-3">
                                <label class="form-label">Cédula</label>
                                <div class="d-flex gap-2">
                                    <select class="form-control text-center" name="prefijo" required style="max-width: 80px;">
                                        <option value="" disabled selected></option>
                                        <?php
                                        $prefijos = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'PE', 'PN', 'E'];
                                        foreach ($prefijos as $prefijo) {
                                            echo "<option value='$prefijo'>$prefijo</option>";
                                        }
                                        ?>
                                    </select>
                                    <span>-</span>
                                    <input type="number" class="form-control text-center" name="tomo" required style="max-width: 90px;" oninput="this.value = this.value.slice(0, 4)">
                                    <span>-</span>
                                    <input type="number" class="form-control text-center" name="asiento" required style="max-width: 100px;" oninput="this.value = this.value.slice(0, 5)">
                                </div>
                            </div>

                            <!-- Género -->
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-control" name="genero" id="genero" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="0">Masculino (M)</option>
                                    <option value="1">Femenino (F)</option>
                                </select>
                            </div>
                            
                            <!-- Nombre y Apellido -->
                            <div class="mb-3">
                                <label class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="nombre1" required oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="nombre2" required oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="apellido1" required oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="apellido2" required oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
                            </div>
                            
                            <!-- Otros datos personales -->
                            <div class="col-md-6">
                                <label for="usa_ac" class="form-label">¿Usa A/C?</label>
                                <select class="form-control" name="usa_ac" id="usa_ac" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="apellidoc" class="form-label">Apellido de Casada</label>
                                <input type="text" class="form-control" name="apellidoc" id="apellidoc" oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="f_nacimiento">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipo de Sangre</label>
                                <select class="form-control" name="tipo_sangre" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <?php
                                        $tipos_sangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                        foreach ($tipos_sangre as $tipo) {
                                            echo "<option value='$tipo'>$tipo</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Card Contacto -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-center fw-bold">📞 Información de Contacto</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Celular</label>
                                <input type="text" class="form-control" name="celular" required oninput="this.value = validarSoloNumeros(this.value.slice(0, 8))">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" required oninput="this.value = validarSoloNumeros(this.value.slice(0, 7))">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" required oninput="this.value = this.value.slice(0, 40)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <!-- Card Dirección -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-center fw-bold">🏡 Dirección</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Provincia</label>
                                <select class="form-control" name="provincia" id="provincia" onchange="cargarDistritos(this.value)" required>
                                    <option value="" disabled selected>Seleccione una provincia</option>
                                    <?php
                                    $provincias = mysqli_query($conexion, "SELECT codigo_provincia, nombre_provincia FROM provincia");
                                    while ($prov = mysqli_fetch_assoc($provincias)) {
                                        echo "<option value='{$prov['codigo_provincia']}'>{$prov['nombre_provincia']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Distrito</label>
                                <select class="form-control" name="distrito" id="distrito" onchange="cargarCorregimientos(this.value)" required>
                                    <option value="" disabled selected>Seleccione una provincia primero</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Corregimiento</label>
                                <select class="form-control" name="corregimiento" id="corregimiento" required>
                                    <option value="" disabled selected>Seleccione una provincia primero</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Calle</label>
                                <input type="text" class="form-control" name="calle">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Casa</label>
                                <input type="text" class="form-control" name="casa" oninput="this.value = validarSoloNumeros(this.value.slice(0, 10))">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Comunidad</label>
                                <input type="text" class="form-control" name="comunidad" oninput="this.value = this.value.slice(0, 25)">
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Nacionalidad</label>
                            <select class="form-select" name="nacionalidad" required>
                                <option value="">Seleccione una nacionalidad</option>
                                <?php
                                include "conexion.php";
                                $sql = $conexion->query("SELECT codigo, pais FROM nacionalidad ORDER BY pais ASC");
                                while ($row = $sql->fetch_assoc()) {
                                    echo "<option value='{$row['codigo']}'>{$row['pais']} ({$row['codigo']})</option>";
                                }
                                ?>
                            </select>
                        </div>

                        </div>
                    </div>

                    <!-- Card Laboral -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-center fw-bold">💼 Información Laboral</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Fecha de Contratación</label>
                                <input type="date" class="form-control" name="f_contra">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cargo</label>
                                <select class="form-control" name="cargo" required>
                                    <option value="" disabled selected>Seleccione un cargo</option>
                                    <?php
                                    $cargos = mysqli_query($conexion, "SELECT codigo, nombre FROM cargo");
                                    while ($cargo = mysqli_fetch_assoc($cargos)) {
                                        echo "<option value='{$cargo['codigo']}'>{$cargo['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Departamento</label>
                                <select class="form-control" name="departamento" required>
                                    <option value="" disabled selected>Seleccione un departamento</option>
                                    <?php
                                    $departamentos = mysqli_query($conexion, "SELECT codigo, nombre FROM departamento");
                                    while ($dep = mysqli_fetch_assoc($departamentos)) {
                                        echo "<option value='{$dep['codigo']}'>{$dep['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-control" name="estado" required>
                                    <option value="" disabled selected>Seleccione un estado</option>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón de Submit -->
                <button type="submit" name="btnregistrar" class="btn btn-primary px-4">Registrar</button>

            </form>
        </div>
    </div>
    <script src="../javascript/formateo_campos.js"></script>
    <script src="../javascript/genero.js"></script>
    <script src="../javascript/localidades.js"></script>
    
</body>
</html>