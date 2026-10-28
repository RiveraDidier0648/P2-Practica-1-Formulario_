<?php
// Define el nombre o la dirección IP del servidor donde se hospeda la base de datos (generalmente "localhost" en entorno local)
$host = "localhost";

// Define el nombre de usuario de MySQL para autenticarse (en servidores locales como XAMPP o WAMP suele ser "root")
$usuario = "root";

// Define la contraseña del usuario de MySQL (vacía por defecto en la mayoría de instalaciones locales)
$password = "";

// Define el nombre de la base de datos específica a la que deseas conectarte
$bd = "mi_tienda";

// Crea una nueva conexión a la base de datos MySQL creando una instancia del objeto mysqli con los parámetros definidos
$conexion = new mysqli($host, $usuario, $password, $bd);

// Evalúa si ocurrió algún problema durante el intento de conexión a la base de datos
if ($conexion->connect_error) {
    // Si hubo un error, detiene la ejecución del script por completo y muestra el mensaje con el error específico recibido
    die("Error de conexión: " . $conexion->connect_error);
}
?>
