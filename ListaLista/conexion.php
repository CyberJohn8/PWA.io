

<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "asambleasvenezuela";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
