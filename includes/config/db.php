<?php
function conectarDB(): mysqli
{ // Función para conectar a la base de datos
    $db = mysqli_connect('localhost', 'root', '74183', 'bienesraices_crud'); // Conexión a la base de datos

    if (!$db) { // Si no se conecta
        echo 'Error No Conectado'; // Imprime un mensaje
        exit; // Detiene el código
    }

    return $db;
}