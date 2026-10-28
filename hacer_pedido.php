<?php
session_start();
include 'conexion.php';

// Verificar que haya sesión iniciada
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $producto   = $_POST['producto'];
    $cantidad   = intval($_POST['cantidad']);

    // Asignar el nombre del producto y el precio unitario
    if ($producto == 'iphone') {
        $nombre_prod = "iPhone 15 Pro (Apple)";
        $precio_unitario = 999.00;
    } elseif ($producto == 'samsung') {
        $nombre_prod = "Galaxy S24 Ultra (Samsung)";
        $precio_unitario = 1199.00;
    } elseif ($producto == 'tenis_nike') {
        $nombre_prod = "Tenis Air Max (Nike)";
        $precio_unitario = 130.00;
    } elseif ($producto == 'playera_nike') {
        $nombre_prod = "Playera Casual (Nike)";
        $precio_unitario = 35.00;
    } elseif ($producto == 'sudadera_adidas') {
        $nombre_prod = "Sudadera Trefoil (Adidas)";
        $precio_unitario = 65.00;
    } elseif ($producto == 'labial') {
        $nombre_prod = "Labial Matte Red (L'Oréal)";
        $precio_unitario = 18.00;
    }

    $total = $precio_unitario * $cantidad;

    // Guardar en la tabla 'pedidos' de la base de datos
    $sql = "INSERT INTO pedidos (usuario_id, producto_nombre, cantidad, total) 
            VALUES ('$usuario_id', '$nombre_prod', '$cantidad', '$total')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p style='color: #04d361;'>¡Pedido realizado con éxito! Total: $$total USD</p>";
    } else {
        $mensaje = "<p style='color: red;'>Error al registrar pedido: " . $conexion->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pedido</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="card">
        <h2>Hacer un Pedido</h2>
        <?php if(isset($mensaje)) echo $mensaje; ?>

        <form method="POST" action="hacer_pedido.php">
            
            <label>Selecciona el Producto:</label>
            <select name="producto" required>
                <option value="iphone">iPhone 15 Pro ($999 USD)</option>
                <option value="samsung">Galaxy S24 Ultra ($1199 USD)</option>
                <option value="tenis_nike">Tenis Air Max ($130 USD)</option>
                <option value="playera_nike">Playera Casual ($35 USD)</option>
                <option value="sudadera_adidas">Sudadera Trefoil ($65 USD)</option>
                <option value="labial">Labial Matte Red ($18 USD)</option>
            </select>

            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="1" min="1" max="20" required>

            <button type="submit">Confirmar Pedido</button>
        </form>

        <br>
        <a href="tienda.php">← Volver al Catálogo</a>
    </div>
    <footer>
    <p>Victor Didier Rivera Sánchez</p>
    <p>5ºI | Programación</p>
</footer>
</body>
</html>
