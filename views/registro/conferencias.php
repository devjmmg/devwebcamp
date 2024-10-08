<h2 class="eventos-registro__heading"><?php echo $titulo; ?></h2>
<p class="eventos-registro__description">Elige hasta 5 eventos para asistir de forma presencial</p>


<main class="eventos-registro">

    <div class="eventos-registro__listado">

        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias/></h3>

        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid">

            <?php foreach($eventos['c_viernes'] as $evento): ?>

            <?php include __DIR__ . "/evento.php" ?>

            <?php endforeach; ?>

        </div>

        <p class="eventos-registro__fecha">Sábado 6 de Octubre</p>

        <div class="eventos-registro__grid">

            <?php foreach($eventos['c_sabado'] as $evento): ?>

            <?php include __DIR__ . "/evento.php" ?>

            <?php endforeach; ?>

        </div>

        <h3 class="eventos-registro__heading--workshops">&lt;Workshops/></h3>

        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">

            <?php foreach($eventos['w_viernes'] as $evento): ?>

            <?php include __DIR__ . "/evento.php" ?>

            <?php endforeach; ?>

        </div>

        <p class="eventos-registro__fecha">Sábado 6 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">

            <?php foreach($eventos['w_sabado'] as $evento): ?>

            <?php include __DIR__ . "/evento.php" ?>

            <?php endforeach; ?>

        </div>

    </div>

    <aside class="registro">

        <h2 class="registro__heading">Tu registro</h2>

        <div id="registro-resumen" class="registro__resumen"></div>

        <div class="registro__regalo">

            <label for="regalo" class="registro__label">Selecciona un regalo</label>
            <select id="regalo" class="registro__select">
                <option value="">Seleccionar</option>
                <?php foreach($regalos as $regalo): ?>
                    <option value="<?php echo $regalo->id; ?>"><?php echo $regalo->nombre; ?></option>
                <?php endforeach; ?>
            </select>

        </div>

        <form id="registro" class="formulario">
            <div class="formulario__campo">
                <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarse">
            </div>
        </form>

    </aside>

</main>