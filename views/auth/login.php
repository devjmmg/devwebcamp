<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__description">Inicia sesión en DevWebCamp</p>

    <?php require_once __DIR__  . "/../templates/alertas.php"; ?>

    <form action="" class="formulario" method="POST">

        <div class="formulario__campo">

            <label for="email" class="formulario__label">Correo electrónico:</label>
            <input type="email" name="email" id="email" class="formulario__input" placeholder="Ej. correo@correo.com">

        </div>

        <div class="formulario__campo">

            <label for="password" class="formulario__label">Contraseña:</label>
            <input type="password" name="password" id="password" class="formulario__input" placeholder="********">

        </div>

        <input type="submit" value="Iniciar sesión" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿No tienes una cuenta? Regístrate</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>