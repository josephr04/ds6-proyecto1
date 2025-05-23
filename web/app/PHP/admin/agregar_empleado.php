<?php
session_start();
include '../utils/conexion.php';
include '../utils/verificar_rol.php';

verificarRol(1); // Solo administrador
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
            <h1 class="text-center mb-5 text-dark">Registrar Empleado</h1>

            <?php if (isset($_GET['exito']) && $_GET['exito'] == '1'): ?>
                <div class="mt-3">
                    <div class="alert alert-success alert-dismissible fade show" style="max-width: 500px;" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i> ¡Empleado registrado correctamente!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                </div>
            <?php endif; ?>

            <form class="row g-4 mx-auto" style="max-width: 1200px;" action="../functions/registrar.php" method="POST">
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
                            <div class="col-md-6 mb-3">
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
                            <div class="col-md-6 mb-3">
                                <label for="usa_ac" class="form-label">¿Usa A/C?</label>
                                <select class="form-control" name="usa_ac" id="usa_ac" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="apellidoc" class="form-label">Apellido de Casada</label>
                                <input type="text" class="form-control" name="apellidoc" id="apellidoc" oninput="this.value = validarSoloLetras(this.value.slice(0, 25))">
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select class="form-select" name="estado_civil" id="estado_civil" required>
                                    <option value="" disabled selected>Seleccione su estado civil</option>
                                    <option value="1">Soltero/a</option>
                                    <option value="2">Casado/a</option>
                                    <option value="3">Divorciado/a</option>
                                    <option value="4">Viudo/a</option>
                                </select>
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
                                    echo "<option value='{$row['codigo']}'>{$row['pais']}</option>";
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
                <div class="text-center mt-4">
                     <button type="submit" name="btnregistrar" class="btn btn-primary px-4">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./../../javascript/formateo_campos.js"></script>
    <script src="./../../javascript/genero.js"></script>
    <script src="./../../javascript/localidades.js"></script>
    <script src="./../../javascript/form_advertencia.js"></script>
    
</body>
</html>