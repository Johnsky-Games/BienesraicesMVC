document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
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