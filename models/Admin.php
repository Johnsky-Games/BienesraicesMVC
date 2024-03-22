<?php

namespace Model;

class Admin extends activeRecord
{

    // Base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($arg)
    {
        $this->id = $arg['id'] ?? null;
        $this->email = $arg['email'] ?? '';
        $this->password = $arg['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "Debes añadir tu email";
        }
        if (!$this->password) {
            self::$errores[] = "Debes añadir tu password";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return;
        }
        return $resultado;
    }
}