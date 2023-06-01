const buttons = document.querySelectorAll('.button');

buttons.forEach(button => {
  button.addEventListener('click', function () {
    buttons.forEach(btn => btn.classList.remove('selected'));
    this.classList.add('selected');
  });
});


/***
 * Este bloque de código funciona y muestra los datos en el select
 */
function obtenerDatosYCrearOptions() {
  const url = '../index.php';

  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.estado) {
        const datos = data.datos;
        const select = document.createElement('select');
        select.id = 'actividad';
        select.name = 'actividad';
        select.required = true;

        // Crear un option para cada objeto en datos
        datos.forEach(objeto => {
          const option = document.createElement('option');
          option.value = objeto.id_producto;
          option.textContent = objeto.nombre_producto;
          select.appendChild(option);
        });

        const searchContainer = document.querySelector('.search-container');
        searchContainer.innerHTML = '';
        searchContainer.appendChild(select);

        console.log('Options creados con éxito');
      } else {
        console.log('Error en la respuesta del servidor');
      }
    })
    .catch(error => {
      console.log('Error en la petición Fetch:', error);
    });
}

// Llamar a la función cuando se carga la página
document.addEventListener('DOMContentLoaded', function () {
  const container = document.createElement('div');
  container.classList.add('search-container');

  document.body.appendChild(container);

  obtenerDatosYCrearOptions();
});

document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');

  form.addEventListener('submit', function (event) {
    if (!validarObjeto() || !validarDescripcion() || !validarMoneda() || !validarPresupuesto()) {
      event.preventDefault();
    }
  });

  function validarObjeto() {
    const objetoInput = document.getElementById('objeto');
    const valor = objetoInput.value.trim();

    if (valor === '') {
      mostrarError(objetoInput, 'Este campo es obligatorio');
      return false;
    }

    limpiarError(objetoInput);
    return true;
  }

  function validarDescripcion() {
    const descripcionInput = document.getElementById('descripcion');
    const valor = descripcionInput.value.trim();

    if (valor === '') {
      mostrarError(descripcionInput, 'Este campo es obligatorio');
      return false;
    }

    limpiarError(descripcionInput);
    return true;
  }

  function validarMoneda() {
    const monedaInput = document.getElementById('moneda');
    const valor = monedaInput.value.trim();

    if (valor === '') {
      mostrarError(monedaInput, 'Seleccione una opción');
      return false;
    }

    limpiarError(monedaInput);
    return true;
  }

  function validarPresupuesto() {
    const presupuestoInput = document.getElementById('presupuesto');
    const valor = presupuestoInput.value.trim();

    if (valor === '') {
      mostrarError(presupuestoInput, 'Este campo es obligatorio');
      return false;
    }

    // Validar si el valor es un número válido
    if (isNaN(parseFloat(valor))) {
      mostrarError(presupuestoInput, 'Ingrese un valor numérico válido');
      return false;
    }

    limpiarError(presupuestoInput);
    return true;
  }

  function mostrarError(input, mensaje) {
    const errorContainer = input.nextElementSibling;
    errorContainer.textContent = mensaje;
  }

  function limpiarError(input) {
    const errorContainer = input.nextElementSibling;
    errorContainer.textContent = '';
  }
});


document.getElementById("myForm").addEventListener("submit", function () {
  // Redirigir y refrescar la página después de enviar el formulario
  location.reload();
});



