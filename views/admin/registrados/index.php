<h2 class="auth__heading"><?php echo $titulo; ?></h2>


<div class="dashboard__contenedor">

    <?php if(!empty($registrados)) : ?>

    <table class="table">
        <thead class="table__head">
            <tr>
                <th scope="col" class="table__th">Nombre</th>
                <th scope="col" class="table__th">Correo electrónico</th>
                <th scope="col" class="table__th">Plan</th>
            </tr>
        </thead>
        <tbody class="table__body">
            <?php foreach($registrados as $registro): ?>
            <tr class="table__tr">
                <td class="table__td"><?php echo $registro->usuario->nombre . ' ' . $registro->usuario->apellido; ?></td>
                <td class="table__td"><?php echo $registro->usuario->email; ?></td>
                <td class="table__td"><?php echo $registro->paquete->nombre; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else: ?>
    <p class="text-center">No hay registros aún.</p>
    <?php endif; ?>

</div>

<?php echo $paginacion; ?>