<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "¡Registro exitoso! <a href='login.php'>Iniciar sesión</a>";
    } else {
        $mensaje = "Error: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Tienda Online</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="card">
        <h2>Crear Cuenta</h2>
        <?php if(isset($mensaje)) echo "<p>$mensaje</p>"; ?>
        <form method="POST" action="registro.php">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>


</body>
</html>
