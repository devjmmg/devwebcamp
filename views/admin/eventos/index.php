<h2 class="auth__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/eventos/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir evento
    </a>
</div>

<div class="dashboard__contenedor">

    <?php if(!empty($eventos)) : ?>

    <table class="table">
        <thead class="table__head">
            <tr>
                <th scope="col" class="table__th">Evento</th>
                <th scope="col" class="table__th">Categoría</th>
                <th scope="col" class="table__th">Día y Hora</th>
                <th scope="col" class="table__th">Ponente</th>
                <th scope="col" class="table__th"></th>
            </tr>
        </thead>
        <tbody class="table__body">
            <?php foreach($eventos as $evento): ?>
            <tr class="table__tr">
                <td class="table__td"><?php echo $evento->nombre; ?></td>
                <td class="table__td"><?php echo $evento->categoria->nombre; ?></td>
                <td class="table__td"><?php echo $evento->dia->nombre . ', ' . $evento->hora->hora;; ?></td>
                <td class="table__td"><?php echo $evento->ponente->nombre . ' ' . $evento->ponente->apellido; ?></td>
                <td class="table__td--acciones">

                    <a class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?php echo $evento->id; ?>">
                        <i class="fa-solid fa-pencil"></i>
                        Editar
                    </a>
                    <form method="POST" action="/admin/eventos/eliminar">
                        <input type="hidden" name="id" value="<?php echo $evento->id; ?>">
                        <button class="table__accion table__accion--eliminar" type="submit">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Eliminar
                        </button>
                    </form>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else: ?>
    <p class="text-center">No hay eventos aún.</p>
    <?php endif; ?>

</div>

<?php echo $paginacion; ?>