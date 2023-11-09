<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    // Si el rol del usuario es administrador, lo redirigimos a la página de consulta e inserción
    if ($usuario['rol'] == 'administrador') {
        header("Location: consulta_insercion_datos.php");
    } else {
         // Si el rol del usuario es limitado, lo redirigimos a la página de consulta de datos
        header("Location: consulta_datos.php");
    }
} else {
    header("Location: login.php");
}
?>