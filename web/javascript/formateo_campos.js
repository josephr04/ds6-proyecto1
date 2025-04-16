document.addEventListener("DOMContentLoaded", function () {
    const genero = document.getElementById("genero");
    const usaAC = document.getElementById("usa_ac");
    const apellidoc = document.getElementById("apellidoc");

    function actualizarCampos() {
        const valorGenero = genero.value;
        const valorUsaAC = usaAC.value;

        if (valorGenero === "0") { // Masculino
            // Si es masculino, deshabilitamos los campos relacionados con A/C
            usaAC.value = "";
            usaAC.disabled = true;

            apellidoc.value = "";
            apellidoc.disabled = true;
        } else if (valorGenero === "1") { // Femenino
            // Si es femenino, habilitamos el campo de "Usa A/C"
            usaAC.disabled = false;

            // Si selecciona "Sí" en Usa A/C (valor "1"), habilitamos "Apellido de casada"
            if (valorUsaAC === "1") {
                apellidoc.disabled = false;
            } else {
                // Si selecciona "No" en Usa A/C (valor "0"), deshabilitamos "Apellido de casada"
                apellidoc.value = ""; // Reseteamos el valor
                apellidoc.disabled = true;
            }
        } else {
            // Si no se selecciona ni masculino ni femenino, deshabilitamos ambos campos
            usaAC.disabled = true;
            apellidoc.disabled = true;
        }
    }

    // Se añaden los eventos para que se actualicen los campos cuando cambian los select
    genero.addEventListener("change", actualizarCampos);
    usaAC.addEventListener("change", actualizarCampos);

    // Llamamos a actualizarCampos al cargar la página para establecer el estado inicial de los campos
    actualizarCampos();
});
