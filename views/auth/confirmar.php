<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>

    <?php require_once __DIR__  . "/../templates/alertas.php"; ?>

    <?php if(isset($alertas['exito'])): ?>


    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Tienes una cuenta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>

    <?php endif; ?>

</main>