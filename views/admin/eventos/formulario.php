<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información evento</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre evento</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre evento" class="formulario__input"
            value="<?php

use Model\Evento;

 echo $evento->nombre ?? ""; ?>" >
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="10" placeholder="Descripción del evento"
            class="formulario__input"><?php echo $evento->descripcion ?? ""; ?>
</textarea>
    </div>

    <div class="formulario__campo">
        <label for="categoria_id" class="formulario__label">Categoría</label>
        <select name="categoria_id" id="categoria_id" class="formulario__select">
            <option value="">Seleccionar</option>
            <?php foreach($categorias as $categoria): ?>
            <option <?php echo $evento->categoria_id === $categoria->id ? 'selected' : '' ?> value="<?php echo $categoria->id; ?>"> <?php echo $categoria->nombre; ?> </option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="viernes" class="formulario__label">Seleccionar día</label>

        <div class="formulario__radio">
            <?php foreach($dias as $dia): ?>
            <div>
                <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                <input type="radio" id="<?php echo strtolower($dia->nombre); ?>" name="dia"
                    value="<?php echo $dia->id; ?>" <?php echo $evento->dia_id === $dia->id ? 'checked' : ''; ?>>
            </div>
            <?php endforeach; ?>
        </div>

        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id ?? ''; ?>">

    </div>

    <div id="horas" class="formulario__campo">
        <label class="formulario__label">Seleccionar hora</label>
        <ul id="horas" class="horas">
            <?php foreach($horas as $hora): ?>
            <li data-hora-id="<?php echo $hora->id; ?>" class="horas__hora horas__hora--inactivo"><?php echo $hora->hora; ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id ?? ''; ?>">
    </div>

    <fieldset class="formulario__fieldset">
        <legend class="formulario__legend">Información extra</legend>

        <div class="formulario__campo">
            <label for="ponentes" class="formulario__label">Ponentes</label>
            <input type="text" id="ponentes" placeholder="Buscar ponente" class="formulario__input">
        </div>

        <ul id="listado-ponentes" class="listado-ponentes"></ul>

        <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id; ?>">

        <div class="formulario__campo">
            <label for="disponibles" class="formulario__label">Lugares disponibles</label>
            <input type="number" min="1" name="disponibles" id="disponibles" placeholder="Ej. 20" class="formulario__input"
                value="<?php echo $evento->disponibles ?? ""; ?>">
        </div>

    </fieldset>

</fieldset>