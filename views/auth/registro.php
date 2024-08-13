<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__description">Registrate en DevWebCamp para asistir a conferencias y workshops</p>

    <?php require_once __DIR__  . "/../templates/alertas.php"; ?>

    <form action="/registro" class="formulario" method="POST">

        <div class="formulario__campo">

            <label for="nombre" class="formulario__label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="formulario__input" placeholder="Ej. Juan Manuel" value="<?php echo s($usuario->nombre); ?>">

        </div>

        <div class="formulario__campo">

            <label for="apellido" class="formulario__label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="formulario__input" placeholder="Ej. Martínez García" value="<?php echo s($usuario->apellido); ?>">

        </div>

        <div class="formulario__campo">

            <label for="email" class="formulario__label">Correo electrónico:</label>
            <input type="email" name="email" id="email" class="formulario__input" placeholder="Ej. correo@correo.com" value="<?php echo s($usuario->email); ?>">

        </div>

        <div class="formulario__campo">

            <label for="password" class="formulario__label">Contraseña:</label>
            <input type="password" name="password" id="password" class="formulario__input" placeholder="********">

        </div>

        <div class="formulario__campo">

            <label for="password2" class="formulario__label">Confirmar contraseña:</label>
            <input type="password" name="password2" id="password2" class="formulario__input" placeholder="********">

        </div>

        <input type="submit" id="registrate" value="Registrate" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Tienes una cuenta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>