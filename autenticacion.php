<?php
session_start();
// Establecemos conexión con la base de datos
try {
    $conexion = new PDO("mysql:host=localhost; dbname=fernandobd", "root", "");
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos los datos de usuario y contraseña enviados a través del login.php
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    // Consulta SQL para saber si el usuario y la contraseña se encuentran en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario, $contrasena]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Si se encuentra un usuario que coincide, se almacena en la sesión y redirigimos a la
        // página de autenticacion de rol
        $_SESSION['usuario'] = $usuario;
        header("Location: autenticacion_rol.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>