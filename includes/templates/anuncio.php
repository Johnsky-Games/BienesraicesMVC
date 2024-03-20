<?php

    use App\Propiedad;
    // se obtiene el id de la propiedad a mostrar en la url y se filtra para que sea un entero y no se pueda inyectar codigo malicioso en la base de datos

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) { // Si el id no es un entero
        header('Location: /');
    }

    // Se importa la conexion a la base de datos

    $propiedad= Propiedad::find($id);


?>



<h1><?php echo $propiedad->titulo ?></h1>
    <picture>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la Propiedad">

    <div class="resumen-propiedad">
        <p class="precio">$ <?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="/build/img/icono_estacionamiento.svg"
                    alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion; ?> </p>
    </div>

