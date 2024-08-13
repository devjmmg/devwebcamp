<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if(isAuth()): ?>
            <a href="<?php echo isAdmin() ? '/admin/dashboard' : '/finalizar-registro'; ?>" class="header__enlace">Administrar</a>
            <form action="/logout" class="header__form" method="POST">
                <input type="submit" value="Cerrar sesión" class="header__submit">
            </form>
            <?php else: ?>
            <a href="/login" class="header__enlace">Iniciar sesión</a>
            <a href="/registro" class="header__enlace">Regístrate</a>
            <?php endif; ?>

        </nav>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DevWebCamp/>
                </h1>
            </a>
            <p class="header__texto">Junio 7-13 - 2024</p>
            <p class="header__texto header__texto--modalidad">En línea - Presencial</p>
            <a href="" class="header__boton">Comprar Pase</a>
        </div>
    </div>
</header>

<nav class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">
                &#60;DevWebCamp/>
            </h2>
        </a>
        <nav class="navegacion">
            <a href="/devwebcamp"
                class="navegacion__enlace <?php echo paginaActual('devwebcamp') ? 'navegacion__enlace--activo' : ''; ?>">Eventos</a>
            <a href="/paquetes"
                class="navegacion__enlace <?php echo paginaActual('paquetes') ? 'navegacion__enlace--activo' : ''; ?>">Paquetes</a>
            <a href="/workshops-conferencias"
                class="navegacion__enlace <?php echo paginaActual('workshops-conferencias') ? 'navegacion__enlace--activo' : ''; ?>">Workshops
                / Conferencias</a>
            <a href="/registro"
                class="navegacion__enlace <?php echo paginaActual('registro') ? 'navegacion__enlace--activo' : ''; ?>">Comprar
                pase</a>
        </nav>
    </div>
</nav>