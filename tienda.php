<?php
session_start();
include 'conexion.php';

// Verificar que el usuario esté logueado y tenga ID de sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Filtrar según lo que seleccione el usuario
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
$marca = isset($_GET['marca']) ? $_GET['marca'] : 'todas';

$query = "SELECT * FROM productos WHERE 1=1";

if ($categoria != 'todas') {
    $query .= " AND categoria = '$categoria'";
}
if ($marca != 'todas') {
    $query .= " AND marca = '$marca'";
}

$productos = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Productos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?> 👋</h1>
    
    <!-- Botones de Navegación -->
    <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 10px;">
        <a href="hacer_pedido.php" style="background-color: #8257e5; color: white; padding: 10px 18px; border-radius: 6px; font-weight: bold; text-decoration: none;">+ Hacer Pedido</a>
        <a href="logout.php" style="color: #ff5555;">Cerrar Sesión</a>
    </div>

    <div class="card" style="width: 100%; max-width: 850px; margin-top: 20px;">
        <h2>Filtrar Productos</h2>
        <form method="GET" action="tienda.php" style="display: flex; gap: 10px;">
            <select name="categoria">
                <option value="todas">Todas las categorías</option>
                <option value="Ropa" <?php if($categoria=='Ropa') echo 'selected'; ?>>Ropa</option>
                <option value="Cosmeticos" <?php if($categoria=='Cosmeticos') echo 'selected'; ?>>Cosméticos</option>
                <option value="Calzado" <?php if($categoria=='Calzado') echo 'selected'; ?>>Calzado</option>
                <option value="Celulares" <?php if($categoria=='Celulares') echo 'selected'; ?>>Celulares</option>
            </select>

            <select name="marca">
                <option value="todas">Todas las marcas</option>
                <option value="Nike" <?php if($marca=='Nike') echo 'selected'; ?>>Nike</option>
                <option value="Adidas" <?php if($marca=='Adidas') echo 'selected'; ?>>Adidas</option>
                <option value="Apple" <?php if($marca=='Apple') echo 'selected'; ?>>Apple</option>
                <option value="Samsung" <?php if($marca=='Samsung') echo 'selected'; ?>>Samsung</option>
                <option value="Loreal" <?php if($marca=='Loreal') echo 'selected'; ?>>L'Oréal</option>
            </select>

            <button type="submit">Buscar</button>
        </form>
    </div>

    <h2>Catálogo</h2>
    <div class="grid-productos">
        <?php if ($productos->num_rows > 0): ?>
            <?php while($p = $productos->fetch_assoc()): ?>
                <div class="producto-card">
                    <img src="<?php echo $p['imagen_url']; ?>" alt="<?php echo $p['nombre']; ?>">
                    <h3><?php echo $p['nombre']; ?></h3>
                    <p><?php echo $p['marca']; ?> | <?php echo $p['categoria']; ?></p>
                    <p class="precio">$<?php echo $p['precio']; ?> USD</p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se encontraron productos con ese filtro.</p>
        <?php endif; ?>
    </div>
    <footer>
    <p>Victor Didier Rivera Sánchez</p>
    <p>5ºI | Programación</p>
</footer>
</body>
</html>
