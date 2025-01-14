<?php
$servidor = 'localhost';
$usuario = 'root';
$contraseña = ''; // Déjalo vacío si no configuraste contraseña
$base_datos = 'asambleasvenezuela';

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
echo 'Conexión exitosa';
?>
