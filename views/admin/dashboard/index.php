<h2 class="auth__heading"><?php echo $titulo; ?></h2>

<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos registros</h3>

            <?php foreach($registros as $registro): ?>
            <div class="bloque__contenido">
                <p class="bloque__texto">
                    <?php echo $registro->usuario->nombre . ' ' . $registro->usuario->apellido; ?>
                </p>
            </div>
            <?php endforeach; ?>

        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Ingresos</h3>

            <p class="bloque__texto--cantidad">
                $<?php echo $ingresos; ?>
            </p>

        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos con menos lugares disponibles</h3>

            <?php foreach($min as $m): ?>
                <div class="bloque__contenido">
                    <div class="bloque__texto">
                        <?php echo $m->nombre . ' - ' . $m->disponibles; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos con más lugares disponibles</h3>

            <?php foreach($max as $m): ?>
                <div class="bloque__contenido">
                    <div class="bloque__texto">
                        <?php echo $m->nombre . ' - ' . $m->disponibles; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>