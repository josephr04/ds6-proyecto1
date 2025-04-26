<?php
session_start();

// Duración de la sesión (15 minutos)
$timeout = 900; // 900 segundos = 15 minutos

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
$_SESSION['last_activity'] = time();

if (empty($_SESSION['correo_institucional'])) {
    echo "Session is set: " . $_SESSION['correo_institucional'];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid row">
        <form class="col-4 p-3 mx-auto" action="conexion.php" method="POST">
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <h3 class="text-center text-secondary">Formulario de Registro</h3>
            
            <!-- Cédula -->
            <div class="mb-3">
                <label class="form-label">Cédula</label>
                <div class="d-flex align-items-center gap-2">
                    <!-- Prefijo como select -->
                    <select class="form-control text-center" name="prefijo" id="prefijo" required style="max-width: 80px;">
                        <option value="" disabled selected></option>
                        <?php
                        // Array de prefijos            
                        $prefijos = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'PE', 'PN', 'E'];
                        foreach ($prefijos as $prefijo) {
                            echo "<option value='$prefijo'>$prefijo</option>";
                        }
                        ?>
                    </select>
                    <span>-</span>

                    <!-- Tomo -->
                    <input type="number" class="form-control text-center" name="tomo" id="tomo" required style="max-width: 90px;" oninput="this.value = this.value.slice(0, 4)">
                    <span>-</span>

                    <!-- Asiento -->
                    <input type="number" class="form-control text-center" name="asiento" id="asiento" required style="max-width: 100px;" oninput="this.value = this.value.slice(0, 5)">
                </div>
            </div>

            <!-- Primer Nombre -->
            <div class="mb-3">
                <label for="nombre1" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="nombre1" id="nombre1" required  oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
            </div>

            <!-- Segundo Nombre -->
            <div class="mb-3">
                <label for="nombre2" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="nombre2" id="nombre2" required  oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
            </div>

            <!-- Primer Apellido -->
            <div class="mb-3">
                <label for="apellido1" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="apellido1" id="apellido1" required  oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
            </div>

            <!-- Segundo Apellido -->
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="apellido2" id="apellido2" required oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
            </div>

            <!-- Género -->
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-control" name="genero" id="genero" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="0">Masculino (M)</option>
                    <option value="1">Femenino (F)</option>
                </select>
            </div>

            <!-- Usa A/C -->
            <div class="mb-3">
                <label for="usa_ac" class="form-label">¿Usa A/C?</label>
                <select class="form-control" name="usa_ac" id="usa_ac" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>

            <!-- Apellido de Casada -->
            <div class="mb-3">
                <label for="apellidoc" class="form-label">Apellido de Casada</label>
                <input type="text" class="form-control" name="apellidoc" id="apellidoc" oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
            </div>

            <!-- Estado Civil -->
            <div class="mb-3">
                <label for="estado_civil" class="form-label">Estado Civil</label>
                <select class="form-control" name="estado_civil" id="estado_civil">
                    <option value="" disabled selected>Selecciona un estado civil</option>
                    <option value="1">Soltero(a)</option>
                    <option value="2">Casado(a)</option>
                    <option value="3">Divorciado(a)</option>
                    <option value="4">Viudo(a)</option>
                </select>
            </div>

            <!-- Tipo de Sangre -->
            <div class="mb-3">
                <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                <select class="form-control" name="tipo_sangre" id="tipo_sangre" required>
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <?php
                        // Array de tipos de sangre        
                        $tipos_sangre  = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                        foreach ($tipos_sangre as $tipo) {
                            echo "<option value='$tipo'>$tipo</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="mb-3">
                <label for="f_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="f_nacimiento" id="f_nacimiento" >
            </div>

            <!-- Celular -->
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" name="celular" id="celular" required oninput="this.value = validarSoloNumeros(this.value.slice(0, 8))">
            </div>

            <!-- Teléfono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" required oninput="this.value = validarSoloNumeros(this.value.slice(0, 7))">
            </div>

            <!-- Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" required oninput="this.value = this.value.slice(0, 40)">
            </div>

            <!-- Provincia -->
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <select class="form-control" name="provincia" id="provincia" onchange="cargarDistritos(this.value)" required>
                    <option value="" disabled selected>Seleccione una provincia</option>
                    <?php
                    include 'conexion.php';
                    $provincias = mysqli_query($conexion, "SELECT codigo_provincia, nombre_provincia FROM provincia");
                    while ($prov = mysqli_fetch_assoc($provincias)) {
                        echo "<option value='{$prov['codigo_provincia']}'>{$prov['nombre_provincia']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Distrito -->
            <div class="mb-3">
                <label for="Distrito" class="form-label">Distrito</label>
                <select class="form-control" name="distrito" id="distrito" onchange="cargarCorregimientos(this.value)" required>
                    <option value="" disabled selected>Seleccione una provincia primero</option>
                </select>
            </div>

            <!-- Corregimiento -->
            <div class="mb-3">
                <label for="Corregimiento" class="form-label">Corregimiento</label>
                <select class="form-control" name="corregimiento" id="corregimiento" required>
                    <option value="" disabled selected>Seleccione una provincia primero</option>
                </select>
            </div>
  
            <!-- Calle -->
            <div class="mb-3">
                <label for="calle" class="form-label">Calle</label>
                <input type="text" class="form-control" name="calle" id="calle" >
            </div>

            <!-- Casa -->
            <div class="mb-3">
                <label for="casa" class="form-label">Casa</label>
                <input type="text" class="form-control" name="casa" id="casa" oninput="this.value = validarSoloNumeros(this.value.slice(0, 10))">
            </div>

            <!-- Comunidad -->
            <div class="mb-3">
                <label for="comunidad" class="form-label">Comunidad</label>
                <input type="text" class="form-control" name="comunidad" id="comunidad" oninput="this.value = this.value.slice(0, 25)">
            </div>

            <!-- Nacionalidad -->
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <select class="form-control" name="nacionalidad" id="nacionalidad">
                    <option value="" disabled selected>Selecciona una nacionalidad</option>
                </select>
            </div>

            <!-- Fecha de Contratación -->
            <div class="mb-3">
                <label for="f_contra" class="form-label">Fecha de Contratación</label>
                <input type="date" class="form-control" name="f_contra" id="f_contra" >
            </div>

            <!-- Cargo -->
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <select class="form-control" name="cargo" id="cargo" required>
                    <option value="" disabled selected>Seleccione un cargo</option>
                    <?php
                    include 'conexion.php';
                    $cargos = mysqli_query($conexion, "SELECT codigo, nombre FROM cargo");
                    while ($cargo = mysqli_fetch_assoc($cargos)) {
                        echo "<option value='{$cargo['codigo']}'>{$cargo['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Departamento -->
            <div class="mb-3">
                <label for="departamento" class="form-label">Departamento</label>
                <select class="form-control" name="departamento" id="departamento" required>
                    <option value="" disabled selected> seleccione un departamento</option>
                    <?php
                    include 'conexion.php';
                    $departamentos = mysqli_query($conexion, "SELECT codigo, nombre FROM departamento");
                    while ($dep = mysqli_fetch_assoc($departamentos)) {
                        echo "<option value='{$dep['codigo']}'>{$dep['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="" disabled selected>Seleccione un estado</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>

        <script src="../javascript/formateo_campos.js"></script>
        <script src="../javascript/genero.js"></script>
        <script src="../javascript/localidades.js"></script>
    </div>
</body>
</html>