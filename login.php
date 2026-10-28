<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conexion->query("SELECT * FROM usuarios WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($password, $usuario['password'])) {
            // Guardamos el ID y el nombre en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            header("Location: tienda.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Tienda Online</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="card">
        <h2>Iniciar Sesión</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>

</body>
</html>
