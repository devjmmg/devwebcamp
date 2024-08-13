<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__description">Conoce sobre la conferencia más importante de latinoamérica</p>

    <div class="devwebcamp__grid">
        <div <?php echo aos_efectos(); ?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="300" height="200" src="build/img/sobre_devwebcamp.jpg" alt="Sobre DevWebCamp">
            </picture>
        </div>

        <div <?php echo aos_efectos(); ?> class="devwebcamp__contenido">
            <p class="devwebcamp__texto">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor corporis nihil assumenda aperiam veniam exercitationem voluptatem necessitatibus amet eos magni ea, quis et inventore incidunt quam? Tempore reprehenderit amet nesciunt!
            </p>
            <p class="devwebcamp__texto">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus nam fugiat temporibus eaque ad. Dignissimos enim ab repudiandae mollitia. Nulla ut, odio quod suscipit dolor animi accusantium iusto sunt mollitia.
            </p>
        </div>
    </div>
</main>