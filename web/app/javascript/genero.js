document.getElementById('genero').addEventListener('change', function() {
    const genero = this.value;
    const acField = document.getElementById('ac');
    
    if (genero === '1') { // Femenino (habilitar A/C - Apellido de casada)
        acField.disabled = false;
    } else { // Masculino (deshabilitar A/C)
        acField.disabled = true;
        acField.value = ""; // Resetea la selección
    }
});

// Permite solo números (0-9)
function validarSoloNumeros(valor) {
    return valor.replace(/[^0-9]/g, '');
}


function validarSoloLetras(valor) {
    // Expresión regular que solo permite letras (incluyendo acentos) y espacios
    return valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
}