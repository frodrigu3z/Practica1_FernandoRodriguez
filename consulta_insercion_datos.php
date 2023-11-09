<?php
    // Verificamos si el usuario ha iniciado sesión
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }
    // Si el usuario no tiene rol administrador no podrá acceder
    // a la página de inserción de datos
    $usuario = $_SESSION['usuario'];
    if ($usuario['rol'] != 'administrador') {
        header("Location: consulta_datos.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta + insercion de datos</title>
    <link rel='stylesheet' type='text/css' href='css/estilos.css'>
    <!-- Script para validar la inserción de datos -->
    <script>
        function validacion() {
            var stock = document.getElementById("stock").value;
            var color = document.getElementById("color").value;
            var nom_imagen = document.getElementById("nom_imagen").value;
            var imagen = document.getElementById("imagen").value;
            // Validación para el campo stock
            if (stock < 0) {
                alert("Stock no puede ser un número menor que 0");
                return false;
            }

            // Si hay algún campo sin rellenar nos saltará una alerta
            if (stock === "" || color === "" || nom_imagen === "" || imagen === "") {
                alert("Rellena todos los campos");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php
    // Establecemos conexión con la base de datos
    try {
        $conexion = new PDO("mysql:host=localhost; dbname=fernandobd", "root", "");
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    // Recogemos los datos del formulario para posteriormente insertarlos en la bbdd
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stock = $_POST["stock"];
        $color = $_POST["color"];
        $nom_imagen = $_POST["nom_imagen"];
        $imagenSubida = $_FILES["imagen"]["tmp_name"];
        // Ruta donde se almacenará la imagen
        $rutaImagen = "img/" . $nom_imagen;
    
        if (move_uploaded_file($imagenSubida, $rutaImagen)) {
            $imagen = file_get_contents($rutaImagen);
            // Insertamos los campos que se han recogido
            $sql = "INSERT INTO gorras (stock, color, nom_imagen, imagen) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$stock, $color, $nom_imagen, $imagen]);
        } else {
            echo "Error al subir la imagen";
        }
    }
    // Realizamos la consulta SQL para posteriormente mostrar los datos
    $sql = "SELECT cod, stock, color, nom_imagen, imagen FROM gorras";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $gorras = $consulta->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!-- Formulario para insertar datos -->
    <form method="post" enctype="multipart/form-data" onsubmit="return validacion();">
        <label>Stock:</label>
        <input type="number" name="stock" id="stock"><br><br>
        <label>Color:</label>
        <input type="text" name="color" id="color"><br><br>
        <label>Nombre de la imagen:</label>
        <input type="text" name="nom_imagen" id="nom_imagen"><br><br>
        <label>Imagen:</label>
        <input type="file" name="imagen" id="imagen"><br><br>
        <input type="submit" value="Insertar"><br><br>
        <?php
        // Si el usuario está identificado saldrá un enlace para cerrar la sesión
        if (isset($_SESSION['usuario'])) {
            echo '<a id="cierreSesion" href="cerrar_sesion.php">Cerrar sesión</a>';
        }
        ?>
    </form>
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