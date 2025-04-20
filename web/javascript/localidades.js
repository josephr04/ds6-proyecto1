function cargarDistritos(codigo_provincia) {
  fetch(`localidades.php?tipo=distrito&provincia_id=${codigo_provincia}`)
      .then(res => res.json())
      .then(data => {
          let distritoSelect = document.getElementById("distrito");
          distritoSelect.innerHTML = '<option value="" disabled selected>Seleccione un distrito</option>';
          data.forEach(d => {
              distritoSelect.innerHTML += `<option value="${d.codigo_distrito}">${d.nombre_distrito}</option>`;
          });

          // Limpiar corregimientos si cambia la provincia
          document.getElementById("corregimiento").innerHTML = '<option value="" disabled selected>Seleccione un distrito primero</option>';
      });
}

function cargarCorregimientos(codigo_distrito) {
  fetch(`localidades.php?tipo=corregimiento&distrito_id=${codigo_distrito}`)
      .then(res => res.json())
      .then(data => {
          let corregimientoSelect = document.getElementById("corregimiento");
          corregimientoSelect.innerHTML = '<option value="" disabled selected>Seleccione un corregimiento</option>';
          data.forEach(d => {
            corregimientoSelect.innerHTML += `<option value="${d.codigo_corregimiento}">${d.nombre_corregimiento}</option>`;
          });
      });
}

