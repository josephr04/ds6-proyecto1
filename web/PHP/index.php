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
            <h3 class="text-center text-secondary">Formulario de Registro</h3>
            <!-- Cedula -->
            <!-- Cédula -->
<div class="mb-3">
    <label class="form-label">Cédula</label>
    <div class="d-flex align-items-center gap-2">
        <!-- Prefijo como select -->
        <select class="form-control text-center" name="prefijo" id="prefijo" required style="max-width: 80px;">
            <option value="" disabled selected></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8" selected>8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="PE">PE</option>
            <option value="PN">PN</option>
            <option value="E">E</option>
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
                <input type="text" class="form-control" name="nombre1" id="nombre1" required>
            </div>

            <!-- Segundo Nombre -->
            <div class="mb-3">
                <label for="nombre2" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="nombre2" id="nombre2" required>
            </div>

            <!-- Primer Apellido -->
            <div class="mb-3">
                <label for="apellido1" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="apellido1" id="apellido1" required>
            </div>

            <!-- Segundo Apellido -->
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="apellido2" id="apellido2" required>
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
                <input type="text" class="form-control" name="apellidoc" id="apellidoc">
            </div>

            <!-- Estado Civil -->
            <div class="mb-3">
                <label for="estado_civil" class="form-label">Estado Civil</label>
                <select class="form-control" name="estado_civil" id="estado_civil">
                    <option value="" disabled selected>Selecciona un estado civil</option>
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="divorciado">Divorciado</option>
                    <option value="viudo">Viudo</option>
                </select>
            </div>

            <!-- Tipo de Sangre -->
            <div class="mb-3">
                <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                <select class="form-control" name="tipo_sangre" id="tipo_sangre" required>
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
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
                <input type="text" class="form-control" name="celular" id="celular" >
            </div>

            <!-- Teléfono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" >
            </div>

            <!-- Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" >
            </div>


  
            <!-- Calle -->
            <div class="mb-3">
                <label for="calle" class="form-label">Calle</label>
                <input type="text" class="form-control" name="calle" id="calle" >
            </div>

            <!-- Casa -->
            <div class="mb-3">
                <label for="casa" class="form-label">Casa</label>
                <input type="text" class="form-control" name="casa" id="casa" >
            </div>

            <!-- Comunidad -->
            <div class="mb-3">
                <label for="comunidad" class="form-label">Comunidad</label>
                <input type="text" class="form-control" name="comunidad" id="comunidad" >
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
                <input type="text" class="form-control" name="cargo" id="cargo" >
            </div>

            <!-- Departamento -->
            <div class="mb-3">
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" name="departamento" id="departamento" >
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" name="estado" id="estado" >
            </div>

            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>

        <script src="../javascript/formateo_campos.js"></script>
        <script src="../javascript/genero.js"></script>
    </div>
</body>
</html>
