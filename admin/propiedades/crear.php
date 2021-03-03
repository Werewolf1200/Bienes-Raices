<?php 
    // Base de Datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Arreglo con mensaje de errores
    $errores = [];

    // Ejecutar el código despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*echo "<pre>";
         var_dump($_POST);
        echo "</pre>";*/

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];

        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }

        if( strlen( $descripcion ) < 50) {
            $errores[] = "La descripcion es obligatoria y debe tener almenos 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc) {
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamiento) {
            $errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$vendedorId) {
            $errores[] = "Elige un vendedor";
        }

      /*  echo "<pre>";
         var_dump($errores);
        echo "</pre>"; */

        // Revisar que el Array de errores esté vacio

        if(empty($errores)) {
            // Insertar en la Base de Datos
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ('$titulo', '$precio', '$descripcion','$habitaciones', '$wc', '$estacionamiento', '$vendedorId' ) ";

            //echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                echo "Insertado Correctamente";
            }
        }


    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error;   ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" > <!-- name => permitirá leer con PHP lo que el usuario escribe-->

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" >

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" >

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" ></textarea>
                
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" >

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" >

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" >

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Seleccione --</option>
                    <option value="1">Juan</option>
                    <option value="2">Karen</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde" >
        </form>
    </main>

    <?php // La funcion ya fue incluida en el header
    incluirTemplate('footer');
    ?>