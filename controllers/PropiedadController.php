<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /** Crea una nueva Instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            /** SUBIDA DE ARCHIVOS */

            // Generar un nombre unico

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Setear la imagen

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::gd()->read($_FILES['propiedad']['tmp_name']['imagen']);
                $image->resize(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar

            $errores = $propiedad->validar();

            // Insertar en la base de datos
            if (empty ($errores)) { // Si el arreglo de errores esta vacio entonces se inserta en la base de datos

                // Crear una carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar en la base de datos
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        // Ejecuta el codigo despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos

            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            //Asignar files hacia una variable
            $errores = $propiedad->validar();
            // Generar un nombre unico

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Setear la imagen
            // Validación subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::gd()->read($_FILES['propiedad']['tmp_name']['imagen']);
                $image->resize(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Insertar en la base de datos
            if (empty ($errores)) { // Si el arreglo de errores esta vacio entonces se inserta en la base de datos
                //Almacenar la imagen

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si se envia un formulario por el metodo POST se ejecuta el siguiente codigo
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // Filtra el id para que sea un entero y no se pueda inyectar codigo malicioso en la base de datos
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    // Comprobar si el tipo es vendedor o propiedad para eliminar el registro de la base de datos segun sea el caso 
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}