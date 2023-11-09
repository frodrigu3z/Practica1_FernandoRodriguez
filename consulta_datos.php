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
    <title>Consulta de datos</title>
    <link rel='stylesheet' type='text/css' href='css/estilos.css'>
</head>
<body>
    <?php
    // Establecemos conexión con la base de datos
    try {
        $conexion = new PDO("mysql:host=localhost; dbname=fernandobd", "root", "");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    // Realizamos la consulta SQL para posteriormente mostrar los datos
    $sql = "SELECT cod, stock, color, nom_imagen, imagen FROM gorras";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $gorras = $consulta->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php
        // Si el usuario está identificado saldrá un enlace para cerrar la sesión
        if (isset($_SESSION['usuario'])) {
            echo '<a id="cierreSesion" href="cerrar_sesion.php">Cerrar sesion</a>';
        }
    ?>
    <h1 id="titulo">Consulta de datos</h1>
    <!-- Tabla para visualizar los datos -->
    <table>
        <tr>
            <th>Código</th>
            <th>Stock</th>
            <th>Color</th>
            <th>Nombre de la imagen</th>
            <th>Imagen</th>
            <th>Ver información</th>
            <th>Ver imagen</th>
        </tr>
        <?php 
        // Recorremos y mostramos los resultados de la consulta SQL
        foreach ($gorras as $gorra): 
        ?>
        <tr>
            <td><?php echo $gorra['cod'];?></td>
            <td><?php echo $gorra['stock'];?></td>
            <td><?php echo $gorra['color'];?></td>
            <td><?php echo $gorra['nom_imagen'];?></td>
            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($gorra['imagen']);?>" width="100" height="100"></td>
            <td><a href='gorra/<?php echo $gorra['cod'];?>'>Ver información</a></td>
            <td><a href="img/<?php echo $gorra['nom_imagen'];?>">Ver imagen</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>