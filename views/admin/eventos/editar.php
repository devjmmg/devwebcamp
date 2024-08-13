<h2 class="auth__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/eventos" class="dashboard__boton">
    <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . "/../../templates/alertas.php" ?>

    <form class="formulario" method="POST">

    <?php include_once __DIR__ . "/formulario.php"; ?>

    <input type="submit" value="Editar evento" class="formulario__submit">

    </form>

</div>