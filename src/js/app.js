document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    };
};

// Dark Mode 
function darkMode() {
    const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)');//detecta si el usuario tiene activado el modo oscuro en su sistema operativo
    const botonDarkMode = document.querySelector('.dark-mode-boton');//boton para activar el modo oscuro
    let isDarkMode = localStorage.getItem('darkMode') === 'true';//detecta si el usuario tiene activado el modo oscuro en la pagina web, get item es para obtener el valor de la clave darkMode

    function setDarkMode() {//funcion para activar el modo oscuro
        isDarkMode = !isDarkMode;
        document.body.classList.toggle('dark-mode', isDarkMode);
        localStorage.setItem('darkMode', isDarkMode);
    }

    function updateDarkMode() {//funcion para actualizar el modo oscuro
        document.body.classList.toggle('dark-mode', prefersDarkMode.matches || isDarkMode);//si el usuario tiene activado el modo oscuro en su sistema operativo o en la pagina web, se activa el modo oscuro
    }

    botonDarkMode.removeEventListener('click', setDarkMode);//remueve el evento para evitar que se duplique
    botonDarkMode.addEventListener('click', setDarkMode);//evento para activar el modo oscuro

    updateDarkMode(); //actualiza el modo oscuro

    prefersDarkMode.addEventListener('change', updateDarkMode);//evento para actualizar el modo oscuro
}

function mostrarMetodosContacto() {
    const contactoDiv = document.querySelector('#contacto');

    if (this.value === 'telefono') {
        contactoDiv.innerHTML = `
         <label for="telefono">Número de Teléfono</label>
         <input type="tel" id="telefono" name="contacto[telefono]" placeholder="Tu Teléfono">

         <p>Si eligió teléfono, elija la fecha y la hora:</p>

         <label for="fecha">Fecha</label>
         <input type="date" id="fecha" name="contacto[fecha]">

         <label for="hora">Hora</label>
         <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" id="email" name="contacto[email]" placeholder="Tu Email">
    `;
    }
}