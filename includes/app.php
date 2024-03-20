<?php

require 'funciones.php';
require 'config/db.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectar a la base de datos
$db = conectarDB();

use App\activeRecord;
// Setear la base de datos a la clase Propiedad para que pueda acceder a ella
activeRecord::setDB($db);