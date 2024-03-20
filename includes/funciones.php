<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{ // Path: includes/funciones.php
    include TEMPLATES_URL . "/" . $nombre . ".php"; // Path: includes/funciones.php/ Path: includes/funciones.php
}

/**
 * Se autentica el usuario en el sistema para permitir el acceso a las diferentes secciones.
 * Si el usuario está autenticado, se le permite el acceso a las secciones del sistema.
 * Si el usuario no está autenticado, se le redirecciona al index del sistema.
 */
function usuarioAutenticado()
{ // Se crea una funcion para saber si el usuario esta autenticado o no
    session_start(); // Se inicia la sesion

    if (!$_SESSION['login']) { // Si el usuario no esta autenticado
        header('Location: /'); // Se retorna verdadero
    }
} // Path: includes/funciones.php

function debugear($variable)
{
    /**
     * Imprime una etiqueta de apertura de preformateado en el navegador.
     */
    echo "<pre>";
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}


// Escapa / sanitiza el HTML

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

//Muestra las alertas
function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}
