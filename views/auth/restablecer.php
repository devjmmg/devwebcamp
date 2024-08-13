<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__description">Nueva contraseña</p>

    <?php require_once __DIR__  . "/../templates/alertas.php"; ?>

    <?php if($token_valido): ?>
    
    <form class="formulario" method="POST">

        <div class="formulario__campo">

            <label for="password" class="formulario__label">Contraseña:</label>
            <input type="password" name="password" id="password" class="formulario__input" placeholder="********">

        </div>

        <input type="submit" value="Guardar" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Tienes una cuenta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>

    <?php endif; ?>

</main>