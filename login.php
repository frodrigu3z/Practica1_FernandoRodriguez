<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inicio de sesion</title>
    <link rel='stylesheet' type='text/css' href='css/estilos.css'>
</head>
<body>
    <h1 id="titulo">Inicio de sesión</h1>
    <!-- Formulario de inicio de sesión -->
    <form method="post" action="autenticacion.php">
        <label>Usuario:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br><br>
        <input type="submit" value="Iniciar sesión">
        <?php
        // Si el usuario está identificado saldrá un enlace para cerrar la sesión
        if (isset($_SESSION['usuario'])) {
            echo '<a id="cierreSesion" href="cerrar_sesion.php">Cerrar sesión</a>';
        }
        ?>
    </form>
</body>
</html>