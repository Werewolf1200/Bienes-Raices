<?php 

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    // Validar la URL por Id válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    // Base de Datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Obtener los datos de la Propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    //Consulta para obtener a los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);



    // Arreglo con mensaje de errores
    $errores = [];

    // Iniciamos las variables vacias para poder guardar los valores con Value
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    // Ejecutar el código despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
       /* echo "<pre>";
         var_dump($_POST);
        echo "</pre>";

        echo "<pre>";
         var_dump($_FILES);
        echo "</pre>";*/
  

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);// Funcion PHP para sanitizar los datos que ingresa el usuario
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];


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

        // VAlidar por tamaño (100 kb máximo)
        $medida = 1000 * 100;

        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }

        // Revisar que el Array de errores esté vacio

        if(empty($errores)) {

             // Crear Carpeta
             $carpetaImagenes = '../../imagenes/';

             if(!is_dir($carpetaImagenes)) {
                 mkdir($carpetaImagenes);
             }

             $nombreImagen = '';

            // SUBIR ARCHIVOS

            if($imagen['name']) {
                // Eliminar la imagen Previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar un nombre unico para cada archivo
                $nombreImagen = md5( uniqid(rand(), true ) ) . ".jpg";

                // Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            }  else {
                $nombreImagen = $propiedad['imagen'];
            }

            // Actualizar en la Base de Datos
            $query = " UPDATE propiedades SET 
            titulo = '${titulo}',
            precio = '${precio}',
            imagen = '$nombreImagen',
            descripcion = '${descripcion}',
            habitaciones = ${habitaciones},
            wc = ${wc},
            estacionamiento = ${estacionamiento},
            vendedorId = ${vendedorId}
            WHERE id = ${id} ";

            //echo $query;


            $resultado = mysqli_query($db, $query);

            if($resultado) {

            //Redireccionar al usuario
               header('Location: /admin?resultado=2');
            }
        }


    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error;   ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data" >
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>" > <!-- name => permitirá leer con PHP lo que el usuario escribe-->

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>" >

                <label for="imagen">Imagen;</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" >

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" ><?php echo $descripcion; ?></textarea>
                
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>" >

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>" >

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>" >

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                    <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>
                    <?php endwhile; ?>
              
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde" >
        </form>
    </main>

    <?php // La funcion ya fue incluida en el header
    incluirTemplate('footer');
    ?>