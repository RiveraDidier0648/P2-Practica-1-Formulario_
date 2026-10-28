<?php
session_start();
include 'conexion.php';

// Verificar que haya sesión iniciada
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

// Si se presiona el botón de guardar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_seleccionado = $_POST['producto'];
    $cantidad              = $_POST['cantidad'];

    // Determinar Nombre, Categoría, Marca, Precio e Imagen según la opción elegida
    if ($producto_seleccionado == 'iphone') {
        $nombre     = "iPhone 15 Pro";
        $categoria  = "Celulares";
        $marca      = "Apple";
        $precio_base = 999.00;
        $imagen_url = "https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=400";
    } elseif ($producto_seleccionado == 'samsung') {
        $nombre     = "Galaxy S24 Ultra";
        $categoria  = "Celulares";
        $marca      = "Samsung";
        $precio_base = 1199.00;
        $imagen_url = "https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=400";
    } elseif ($producto_seleccionado == 'tenis_nike') {
        $nombre     = "Tenis Air Max";
        $categoria  = "Calzado";
        $marca      = "Nike";
        $precio_base = 130.00;
        $imagen_url = "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400";
    } elseif ($producto_seleccionado == 'playera_nike') {
        $nombre     = "Playera Casual";
        $categoria  = "Ropa";
        $marca      = "Nike";
        $precio_base = 35.00;
        $imagen_url = "https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=400";
    } elseif ($producto_seleccionado == 'sudadera_adidas') {
        $nombre     = "Sudadera Trefoil";
        $categoria  = "Ropa";
        $marca      = "Adidas";
        $precio_base = 65.00;
        $imagen_url = "https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=400";
    } elseif ($producto_seleccionado == 'labial') {
        $nombre     = "Labial Matte Red";
        $categoria  = "Cosmeticos";
        $marca      = "Loreal";
        $precio_base = 18.00;
        $imagen_url = "https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400";
    }

    // Calcular el precio total según la cantidad
    $precio_total = $precio_base * $cantidad;
    $nombre_final = "$nombre (x$cantidad)";

    // Guardar en la tabla de productos en MySQL
    $sql = "INSERT INTO productos (nombre, categoria, marca, precio, imagen_url) 
            VALUES ('$nombre_final', '$categoria', '$marca', '$precio_total', '$imagen_url')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p style='color: #04d361;'>¡Se registraron $cantidad unidad(es) de $nombre por $$precio_total USD!</p>";
    } else {
        $mensaje = "<p style='color: red;'>Error: " . $conexion->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="card">
        <h2>¿Qué producto deseas agregar?</h2>
        <?php if(isset($mensaje)) echo $mensaje; ?>

        <form method="POST" action="agregar_producto.php">
            
            <label>Selecciona el Producto:</label>
            <select name="producto" required>
                <option value="iphone">iPhone 15 Pro (Apple - Celulares)</option>
                <option value="samsung">Galaxy S24 Ultra (Samsung - Celulares)</option>
                <option value="tenis_nike">Tenis Air Max (Nike - Calzado)</option>
                <option value="playera_nike">Playera Casual (Nike - Ropa)</option>
                <option value="sudadera_adidas">Sudadera Trefoil (Adidas - Ropa)</option>
                <option value="labial">Labial Matte Red (L'Oréal - Cosméticos)</option>
            </select>

            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="1" min="1" max="50" required>

            <button type="submit">Agregar al Catálogo</button>
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
