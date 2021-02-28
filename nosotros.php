<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg" >
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui odit eius libero quisquam sint ipsa dicta vel, ullam, nisi eum quod beatae aliquam voluptates aspernatur. Perferendis, laudantium. Voluptatibus, nemo repellat. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui odit eius libero quisquam sint ipsa dicta vel, ullam, nisi eum quod beatae aliquam voluptates aspernatur. Perferendis, laudantium. Voluptatibus, nemo repellat. </p>

                <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui odit eius libero quisquam sint ipsa dicta vel, ullam, nisi eum quod beatae aliquam voluptates aspernatur. Perferendis, laudantium. Voluptatibus, nemo repellat.  </p>

            </div>

        </div>

    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quas laudantium commodi, aperiam error, doloribus est, esse vero veniam delectus modi omnis architecto temporibus deserunt ipsam. </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Non quas laudantium commodi, aperiam error, doloribus est, esse vero veniam delectus modi omnis architecto temporibus deserunt ipsam. Voluptatem inventore accusamus tempore?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A tiempo</h3>
                <p>Voluptatem inventore accusamus tempore? Non quas laudantium commodi, aperiam error, doloribus est, esse vero veniam delectus modi omnis architecto temporibus deserunt ipsam.</p>
            </div>
        </div>
    </section>

    <?php // La funcion ya fue incluida en el header
    incluirTemplate('footer');
    ?>