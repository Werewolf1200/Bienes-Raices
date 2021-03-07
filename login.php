<?php 
    // Conectar a Base de datos

    require 'includes/config/database.php';
    $db = conectarDB();

    // Autenticar al Usuario

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //echo "<pre>";
        //var_dump($_POST);
        //echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) );
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        } 
        if(!$password) {
            $errores[] = "El password es obligatorio o incorrecto";
        }

        if(empty($errores)) {
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado->num_rows ) { // Comprobar que haya resultados en la consulta a la base de datos
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                //var_dump($usuario);
                $auth = password_verify($password, $usuario['password']);
                
                if($auth) {
                    // El usuario está autenticado
                    session_start();

                    // Llenar el arreglo de sesión
                     $_SESSION['usuario'] = $usuario['email'];
                     $_SESSION['login'] = true;
                     
                } else {
                    $errores[] = "El password es incorrecto";
                }
                
            } else {
                $errores[] = "El Usuario no existe";
            }
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

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>

    </main>

    <?php // La funcion ya fue incluida en el header
    incluirTemplate('footer');
    ?>
    
    
    