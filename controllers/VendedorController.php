<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
            //Validar que no haya campos vacios
            $errores = $vendedor->validar();

            // Revisar que el arreglo de errores esté vacío

            if (empty ($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los valores
            $args = $_POST['vendedor'];
            //Sincronizar el objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            //Validacion
            $errores = $vendedor->validar();
            if (empty ($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si se envia un formulario por el metodo POST se ejecuta el siguiente codigo
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // Filtra el id para que sea un entero y no se pueda inyectar codigo malicioso en la base de datos
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    // Comprobar si el tipo es vendedor o propiedad para eliminar el registro de la base de datos segun sea el caso 
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}