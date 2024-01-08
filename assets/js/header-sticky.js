document.addEventListener('DOMContentLoaded', function () {
    // Obtener el contenedor principal que contiene los elementos .heart
    var container = document.querySelector('.container');

    // Verificar si el contenedor existe
    if (container) {
        // Agregar un solo manejador de eventos al contenedor
        container.addEventListener('click', function (event) {
            // Verificar si el clic ocurrió en un elemento con la clase .heart
            if (event.target.classList.contains('heart')) {
                // Cambiar la clase del elemento clicado
                event.target.classList.toggle('is-active');
            }
        });
    }
});
