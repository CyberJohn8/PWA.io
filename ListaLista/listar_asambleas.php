<?php
// Configuración de conexión
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "asambleasvenezuela";

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los datos
$query = "SELECT nombre, estado, ID FROM asambleas_de_venezuela";
$resultado = $conexion->query($query);

if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['estado']) . "</td>";
            echo "<td><a href='detalles.php?ID=" . urlencode($fila['ID']) . "'>Detalles</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>Error en la consulta: " . $conexion->error . "</td></tr>";
}

// Cerrar conexión
$conexion->close();
?>
