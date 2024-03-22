<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php

    foreach ($errores as $error): ?>
    <div class="alert error">
        <?php echo $error; ?>
    </div>

    <?php endforeach; ?>

    <form method="POST" class="formulario" novalidate action="/login">

        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu e-mail" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password">

        </fieldset>

        <input type="submit" class="boton boton-verde" value="Iniciar Sesión">
    </form>

</main>