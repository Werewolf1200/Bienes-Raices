<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp" >
            <source srcset="build/img/destacada2.jpg" type="image/jpeg" > 
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la Propiedad">
        </picture>

        <p class="informacion-meta">
            Escrito el: <span> 20/10/2020 </span> por: <span>Admin</span>
        </p>

        <div class="resumen-propiedad">
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam dignissimos magnam harum quas distinctio ab voluptatibus, corporis fugiat eaque aspernatur totam, temporibus non accusamus cupiditate amet, ea quisquam sunt numquam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum atque deserunt aliquid facere porro quo, autem nesciunt minus consequuntur nostrum aspernatur maiores repellendus, labore adipisci iure beatae quod, eveniet laboriosam.
            </p>
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam dignissimos magnam harum quas distinctio ab voluptatibus, corporis fugiat eaque aspernatur totam, temporibus non accusamus cupiditate amet, ea quisquam sunt numquam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum atque deserunt aliquid facere porro quo, autem nesciunt minus consequuntur nostrum aspernatur maiores repellendus, labore adipisci iure beatae quod, eveniet laboriosam.
            </p>
        </div>
    </main>

    <?php // La funcion ya fue incluida en el header
    incluirTemplate('footer');
    ?>