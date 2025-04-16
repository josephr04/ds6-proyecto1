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