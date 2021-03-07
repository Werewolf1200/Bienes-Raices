<?php 
    // Conectar a Base de datos

    require 'includes/config/database.php';
    $db = conectarDB();

    // Autenticar al Usuario

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) );
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        } 
        if(!$password) {
            $errores[] = "El password es obligatorio o incorrecto";
        }
    }

    // Incluir Header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Nombre</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>

    </main>

    <?php // La funcion ya fue incluida en el header
    incluirTemplate('footer');
    ?>
    
    
    