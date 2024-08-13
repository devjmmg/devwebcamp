<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__description">¿Tienes problemas para iniciar sesión?</p>

    <?php require_once __DIR__  . "/../templates/alertas.php"; ?>

    <form action="" class="formulario" method="POST">

        <div class="formulario__campo">

            <label for="email" class="formulario__label">Correo electrónico:</label>
            <input type="email" name="email" id="email" class="formulario__input" placeholder="Ej. correo@correo.com">

        </div>

        <input type="submit" value="Enviar enlace de inicio de sesión" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Tienes una cuenta? Inicia sesión</a>
        <a href="/registro" class="acciones__enlace">¿No tienes una cuenta? Regístrate</a>
    </div>
</main>