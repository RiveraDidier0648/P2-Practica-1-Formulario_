<?php
$host = "localhost";
$usuario = "root";
$password = "";
$bd = "mi_tienda";

$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
<footer>
    <p>Victor Didier Rivera Sánchez</p>
    <p>5ºI | Programación</p>
</footer>