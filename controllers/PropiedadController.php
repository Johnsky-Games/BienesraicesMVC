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
        $resultado = $_GET['$resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
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
    public static function actualizar()
    {
        echo 'Actualizar Propiedad';
    }
}