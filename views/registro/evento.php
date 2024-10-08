<div class="evento">

    <p class="evento__hora"><?php echo $evento->hora->hora; ?></p>

    <div class="evento__informacion">
        <h4 class="evento__nombre"> <?php echo $evento->nombre; ?></h4>

        <p class="evento__introduccion"><?php echo $evento->descripcion; ?></p>

        <div class="evento__autor-info">

            <picture>
                <source srcset="<?php echo $_ENV["HOST"].'/img/speakers/'.$evento->ponente->imagen;?>.webp"
                    type="image/webp">
                <source srcset="<?php echo $_ENV["HOST"].'/img/speakers/'.$evento->ponente->imagen;?>.png"
                    type="image/png">
                <img class="evento__autor-imagen" loading="lazy" width="150" height="80"
                    src="<?php echo $_ENV["HOST"].'/img/speakers/'.$evento->ponente->imagen;?>.png"
                    alt="Imagen ponente">
            </picture>

            <p class="evento__autor-nombre">
                <?php echo $evento->ponente->nombre . ' ' . $evento->ponente->apellido; ?> </p>

        </div>

        <button <?php echo ($evento->disponibles <= 0) ? 'disabled' : ''; ?> class="evento__agregar" type="button" data-id="<?php echo $evento->id; ?>"> <?php echo ($evento->disponibles <= 0) ? 'Agotado' : 'Agregar - ' . $evento->disponibles . " Disponibles"; ?> </button>

    </div>

</div>