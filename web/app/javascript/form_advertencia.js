let formChanged = false;

// Marca como "cambiado" si se modifica algún input, select o textarea
window.addEventListener('DOMContentLoaded', () => {
  const formElements = document.querySelectorAll('input, select, textarea');
  formElements.forEach(el => {
    el.addEventListener('input', () => {
      formChanged = true;
    });
  });
});

// Confirma antes de abandonar la página si hay cambios sin guardar
window.addEventListener('beforeunload', function (e) {
  if (formChanged) {
    e.preventDefault();
    e.returnValue = '';
  }
});

// Si se envía el formulario, desactiva la advertencia
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', () => {
      formChanged = false;
    });
  }
});
