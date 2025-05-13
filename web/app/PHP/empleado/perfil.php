<?php
session_start();
include '../utils/conexion.php';
include '../utils/verificar_rol.php';

verificarRol(2); // Solo usuario

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

// Obtener datos del usuario desde la sesión
$correo = $_SESSION['correo_institucional'];
$datos = null;

// Consultar la información del usuario
$sql = $conexion->prepare("SELECT * FROM usuarios WHERE correo_institucional = ?");
$sql->bind_param("s", $correo);
$sql->execute();
$resultado = $sql->get_result();

if ($resultado && $resultado->num_rows > 0) {
    $empleado = $resultado->fetch_assoc();

    $cedula = $empleado['cedula'];

    $stmt_empleado = $conexion->prepare("SELECT * FROM empleados WHERE cedula = ?");
    $stmt_empleado->bind_param("s", $cedula);
    $stmt_empleado->execute();
    $res_empleado = $stmt_empleado->get_result();

    if ($res_empleado && $res_empleado->num_rows > 0) {
        $datos = $res_empleado->fetch_assoc();
    } else {
        header("Location: ../login.php?error=No se encontraron datos del empleado.");
        exit();
    }
} else {
    header("Location: ../login.php?error=No se encontraron datos del usuario.");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado</title>
    <link rel="icon" href="../img/skillify_favicon.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include '../components/empleado_sidebar.php'; ?>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="container py-4">
            <h1 class="text-center mb-5">Bienvenido Empleado</h1>
            <form action="functions/actualizar.php" method="POST" class="row g-3">
            <input type="hidden" name="id" value="<?= htmlspecialchars($datos['cedula'] ?? '', ENT_QUOTES, 'UTF-8') ?>" >
                
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <!-- Card Datos Personales -->
                    <div class="card shadow-sm">
                        <div class="card-header">👤 Datos Personales</div>
                        <div class="card-body">
                            <!-- Cédula -->
                            <div class="mb-3">
                                <label class="form-label">Cédula</label>
                                <input type="hidden" name="cedula_original" value="<?= $datos['cedula'] ?? '' ?>" >
                                <div class="d-flex gap-2">
                                    <select class="form-control text-center" name="prefijo" required style="max-width: 80px;" disabled>
                                        <option value="" disabled>Seleccione</option>
                                        <?php
                                        $prefijos = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'PE', 'PN', 'E'];
                                        foreach ($prefijos as $p) {
                                            $selected = (isset($datos['prefijo']) && $p == $datos['prefijo']) ? 'selected' : '';
                                            echo "<option value='$p' $selected>$p</option>";
                                        }
                                        ?>
                                    </select>
                                    <span>-</span>
                                    <input type="number" class="form-control text-center" name="tomo" required style="max-width: 90px;" 
                                           oninput="this.value = this.value.slice(0, 4)" value="<?= $datos['tomo'] ?? '' ?>" disabled>
                                    <span>-</span>
                                    <input type="number" class="form-control text-center" name="asiento" required style="max-width: 100px;" 
                                           oninput="this.value = this.value.slice(0, 5)" value="<?= $datos['asiento'] ?? '' ?>" disabled>
                                </div>
                            </div>

                            <!-- Género -->
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-control" name="genero" id="genero" disabled>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="0" <?= isset($datos['genero']) && $datos['genero'] == 0 ? 'selected' : '' ?>>Masculino (M)</option>
                                    <option value="1" <?= isset($datos['genero']) && $datos['genero'] == 1 ? 'selected' : '' ?>>Femenino (F)</option>
                                </select>
                            </div>

                            <!-- Nombres y Apellidos -->
                            <div class="mb-3">
                                <label class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="nombre1" value="<?= $datos['nombre1'] ?? '' ?>" 
                                      oninput="this.value = validarSoloLetras(this.value.slice(0, 25))" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="nombre2" value="<?= $datos['nombre2'] ?? '' ?>" 
                                      oninput="this.value = validarSoloLetras(this.value.slice(0, 25))" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="apellido1" value="<?= $datos['apellido1'] ?? '' ?>" 
                                      oninput="this.value = validarSoloLetras(this.value.slice(0, 25))" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="apellido2" value="<?= $datos['apellido2'] ?? '' ?>" 
                                      oninput="this.value = validarSoloLetras(this.value.slice(0, 25))" disabled>
                            </div>
                            
                            <!-- Otros datos personales -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="usa_ac" class="form-label">¿Usa A/C?</label>
                                    <select class="form-control" name="usa_ac" id="usa_ac" disabled>
                                        <option value="" disabled <?= !isset($datos['usa_ac']) ? 'selected' : '' ?>>Seleccione una opción</option>
                                        <option value="0" <?= isset($datos['usa_ac']) && $datos['usa_ac'] == 0 ? 'selected' : '' ?>>No</option>
                                        <option value="1" <?= isset($datos['usa_ac']) && $datos['usa_ac'] == 1 ? 'selected' : '' ?>>Sí</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="apellidoc" class="form-label">Apellido de Casada</label>
                                    <input type="text" class="form-control" name="apellidoc" id="apellidoc" 
                                           value="<?= $datos['apellidoc'] ?? '' ?>" oninput="this.value = validarSoloLetras(this.value.slice(0, 25))" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                            <label for="estado_civil" class="form-label">Estado Civil</label>
                            <select class="form-select" name="estado_civil" id="estado_civil" disabled>
                                <option value="" disabled <?php echo ($datos['estado_civil'] == '') ? 'selected' : ''; ?>>Seleccione su estado civil</option>
                                <option value="1" <?php echo ($datos['estado_civil'] == '1') ? 'selected' : ''; ?>>Soltero/a</option>
                                <option value="2" <?php echo ($datos['estado_civil'] == '2') ? 'selected' : ''; ?>>Casado/a</option>
                                <option value="3" <?php echo ($datos['estado_civil'] == '3') ? 'selected' : ''; ?>>Divorciado/a</option>
                                <option value="4" <?php echo ($datos['estado_civil'] == '4') ? 'selected' : ''; ?>>Viudo/a</option>
                            </select>
                        </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="f_nacimiento" value="<?= $datos['f_nacimiento'] ?? '' ?>" disabled>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipo de Sangre</label>
                                <select class="form-control" name="tipo_sangre" disabled>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <?php
                                        $tipos_sangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                        foreach ($tipos_sangre as $tipo) {
                                            $selected = (isset($datos['tipo_sangre']) && $tipo == $datos['tipo_sangre']) ? 'selected' : '';
                                            echo "<option value='$tipo' $selected>$tipo</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Card Contacto -->
                    <div class="card shadow-sm">
                        <div class="card-header">📞 Información de Contacto</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Celular</label>
                                <input type="text" class="form-control" name="celular" value="<?= $datos['celular'] ?? '' ?>" 
                                       oninput="this.value = validarSoloNumeros(this.value.slice(0, 8))" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" value="<?= $datos['telefono'] ?? '' ?>" 
                                       oninput="this.value = validarSoloNumeros(this.value.slice(0, 7))" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" value="<?= $datos['correo'] ?? '' ?>" 
                                       oninput="this.value = this.value.slice(0, 40)" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <!-- Card Dirección -->
                    <div class="card shadow-sm">
                        <div class="card-header">🏡 Dirección</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Provincia</label>
                                <select class="form-control" name="provincia" id="provincia" onchange="cargarDistritos(this.value)" disabled>
                                    <option value="" disabled <?= empty($datos['provincia']) ? 'selected' : '' ?>>Seleccione una provincia</option>
                                    <?php
                                    $provincias = mysqli_query($conexion, "SELECT codigo_provincia, nombre_provincia FROM provincia");
                                    while ($prov = mysqli_fetch_assoc($provincias)) {
                                        $selected = (isset($datos['provincia']) && $datos['provincia'] == $prov['codigo_provincia']) ? 'selected' : '';
                                        echo "<option value='{$prov['codigo_provincia']}' $selected>{$prov['nombre_provincia']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Distrito</label>
                                <select class="form-control" name="distrito" id="distrito" onchange="cargarCorregimientos(this.value)" disabled>
                                    <?php
                                    $distritos_options = '<option value="" disabled>Seleccione una provincia primero</option>';
                                    if (!empty($datos['provincia'])) {
                                        $distritos = mysqli_query($conexion, "SELECT codigo_distrito, nombre_distrito FROM distrito WHERE codigo_provincia = '{$datos['provincia']}'");
                                        $distritos_options = '<option value="" disabled>Seleccione un distrito</option>';
                                        while ($dist = mysqli_fetch_assoc($distritos)) {
                                            $selected = (isset($datos['distrito']) && $datos['distrito'] == $dist['codigo_distrito']) ? 'selected' : '';
                                            $distritos_options .= "<option value='{$dist['codigo_distrito']}' $selected>{$dist['nombre_distrito']}</option>";
                                        }
                                    }
                                    echo $distritos_options;
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Corregimiento</label>
                                <select class="form-control" name="corregimiento" id="corregimiento" disabled>
                                    <?php
                                    $corregimientos_options = '<option value="" disabled>Seleccione un distrito primero</option>';
                                    if (!empty($datos['distrito'])) {
                                        $corregimientos = mysqli_query($conexion, "SELECT codigo_corregimiento, nombre_corregimiento FROM corregimiento WHERE codigo_distrito = '{$datos['distrito']}'");
                                        $corregimientos_options = '<option value="" disabled>Seleccione un corregimiento</option>';
                                        while ($corr = mysqli_fetch_assoc($corregimientos)) {
                                            $selected = (isset($datos['corregimiento']) && $datos['corregimiento'] == $corr['codigo_corregimiento']) ? 'selected' : '';
                                            $corregimientos_options .= "<option value='{$corr['codigo_corregimiento']}' $selected>{$corr['nombre_corregimiento']}</option>";
                                        }
                                    }
                                    echo $corregimientos_options;
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Calle</label>
                                <input type="text" class="form-control" name="calle" value="<?= $datos['calle'] ?? '' ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Casa</label>
                                <input type="text" class="form-control" name="casa" value="<?= $datos['casa'] ?? '' ?>" 
                                       oninput="this.value = validarSoloNumeros(this.value.slice(0, 10))" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Comunidad</label>
                                <input type="text" class="form-control" name="comunidad" value="<?= $datos['comunidad'] ?? '' ?>" 
                                       oninput="this.value = this.value.slice(0, 25)" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nacionalidad</label>
                                <select class="form-control" name="nacionalidad" disabled>
                                    <option value="" <?= empty($datos['nacionalidad']) ? 'selected disabled' : 'disabled' ?>>Seleccione una nacionalidad</option>
                                    <?php
                                    $sql = $conexion->query("SELECT codigo, pais FROM nacionalidad ORDER BY pais ASC");
                                    
                                    if ($sql && $sql->num_rows > 0) {
                                        while ($nacionalidad = $sql->fetch_assoc()) {
                                            $selected = (isset($datos['nacionalidad']) && $nacionalidad['codigo'] == $datos['nacionalidad']) ? 'selected' : '';
                                            echo "<option value='{$nacionalidad['codigo']}' $selected>{$nacionalidad['pais']}</option>";
                                        }
                                    } else {
                                        echo '<option value="" disabled>No hay nacionalidades disponibles</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Card Laboral -->
                    <div class="card shadow-sm">
                        <div class="card-header">💼 Información Laboral</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Fecha de Contratación</label>
                                <input type="date" class="form-control" name="f_contra" value="<?= $datos['f_contra'] ?? '' ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cargo</label>
                                <select class="form-control" name="cargo" disabled>
                                    <option value="" disabled>Seleccione un cargo</option>
                                    <?php
                                    $cargos = mysqli_query($conexion, "SELECT codigo, nombre FROM cargo");
                                    while ($cargo = mysqli_fetch_assoc($cargos)) {
                                        $selected = (isset($datos['cargo']) && $cargo['codigo'] == $datos['cargo']) ? 'selected' : '';
                                        echo "<option value='{$cargo['codigo']}' $selected>{$cargo['nombre']}</option>";
                                    }
                                    ?>
                                </select>  
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Departamento</label>
                                <select class="form-control" name="departamento" disabled>
                                    <option value="" disabled <?= empty($datos['departamento']) ? 'selected' : '' ?>>Seleccione un departamento</option>
                                    <?php
                                    $query = mysqli_query($conexion, "SELECT codigo, nombre FROM departamento ORDER BY nombre ASC");
                                    while ($dep = mysqli_fetch_assoc($query)) {
                                        $selected = (!empty($datos['departamento']) && $dep['codigo'] == $datos['departamento']) ? 'selected' : '';
                                        echo "<option value='{$dep['codigo']}' $selected>{$dep['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-control" name="estado" disabled>
                                    <option value="" disabled>Seleccione un estado</option>
                                    <option value="0" <?= isset($datos['estado']) && $datos['estado'] == "0" ? 'selected' : '' ?>>Inactivo</option>
                                    <option value="1" <?= isset($datos['estado']) && $datos['estado'] == "1" ? 'selected' : '' ?>>Activo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    
    <script src="../javascript/formateo_campos.js"></script>
    <script src="../javascript/genero.js"></script>
    <script src="../javascript/localidades.js"></script>
</body>
</html>