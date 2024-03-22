<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error): ?>
    <div class="alert error">
        <?php echo $error ?>
    </div>
    <?php endforeach; ?>
    <form action="" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>

</main>