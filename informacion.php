<?php
    // Verificamos si el usuario ha iniciado sesión
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Información</title>  
        <link rel='stylesheet' type='text/css' href='css/estilos.css'>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            #cierreSesion {
                border: 2px solid black;
                background-color: white;
                color: black;
                padding: 3px;
                border-radius: 10px;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <?php
        // Obtenemos el parámetro cod
        $cod = $_GET['cod'];
        $info = obtenerInformacion($cod);

        function obtenerInformacion($cod) {
            // Establecemos conexión con la base de datos
            try {
                $conexion = new PDO("mysql:host=localhost; dbname=fernandobd", "root", "");
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            // Consulta SQL para obtener toda la información de la gorra
            $stmt = $conexion->prepare('SELECT * FROM gorras WHERE cod = :cod');
            $stmt->execute(array(':cod' => $cod));
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            // Devolvemos la información
            return $info;   
            }
        ?>
        <?php
        // Si el usuario está identificado saldrá un enlace para cerrar la sesión
        if (isset($_SESSION['usuario'])) {
            echo '<a id="cierreSesion" href="cerrar_sesion.php">Cerrar sesión</a>';
        }
        ?>
        <h1>Información de la gorra</h1>
        <!-- Mostramos la información de la gorra obtenida -->
        <p>Codigo: <b><?php echo $info['cod'];?></b></p>
        <p>Stock: <b><?php echo $info['stock'];?></b></p>      
        <p>Color: <b><?php echo $info['color'];?></b></p>
        <p>Nombre de la imagen: <b><?php echo $info['nom_imagen'];?></b></p>
        <!-- Mostramos la imagen de la gorra que está codificada en base64 -->
        <p>Imagen: </p><img src="data:image/jpeg;base64,<?php echo base64_encode($info['imagen']);?>" width="200" height="200">
    </body>
</html>