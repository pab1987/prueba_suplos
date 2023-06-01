
const procesosEventosBtn = document.getElementById('procesosEventosBtn');
const botonesContainer = document.getElementById('botonesContainer');
const footer = document.querySelector('.footer');

procesosEventosBtn.addEventListener('click', function () {
  botonesContainer.style.display = 'block';
  footer.style.display = 'none';
  document.body.style.overflow = 'hidden'; // Evita el desplazamiento de la pantalla
});

// Obtener una referencia al botón "Crear"
var crearBtn = document.getElementById('crearBtn');

// Agregar un evento de clic al botón
crearBtn.addEventListener('click', function () {
  // Redirigir al archivo form.html
  window.location.href = 'form.html';
});


