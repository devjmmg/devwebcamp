<main class="paquetes">
    <h2 class="paquetes__heading"><?php echo $titulo; ?></h2>
    <p class="paquetes__description">Compara los paquetes de DevWebCamp</p>

    <div class="paquetes__grid">
        <div <?php echo aos_efectos(); ?> class="paquete">
            <h3 class="paquete__titulo">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>
        </div>

        <div <?php echo aos_efectos(); ?> class="paquete">
            <h3 class="paquete__titulo">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">$3000</p>
        </div>

        <div <?php echo aos_efectos(); ?> class="paquete">
            <h3 class="paquete__titulo">Pase virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Enlace a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>
            <p class="paquete__precio">$2000</p>
        </div>
    </div>

</main>