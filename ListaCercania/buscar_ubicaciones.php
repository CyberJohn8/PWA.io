<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambiar según tu configuración
$password = ""; // Cambiar según tu configuración
$base_datos = "asambleasvenezuela";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Capturar datos del formulario
$estado = $_POST['estado'];
$ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : "";

// Crear la consulta SQL
$query = "SELECT * FROM asambleas_de_venezuela WHERE Estado = ?";
if (!empty($ciudad)) {
    $query .= " AND Ciudad LIKE ?";
}

$stmt = $conexion->prepare($query);

if (!empty($ciudad)) {
    $ciudad_param = "%" . $ciudad . "%";
    $stmt->bind_param("ss", $estado, $ciudad_param);
} else {
    $stmt->bind_param("s", $estado);
}

$stmt->execute();
$resultado = $stmt->get_result();




// Mostrar resultados
if ($resultado->num_rows > 0) {
    echo '<a href="/ListaCercania/ubicaciones_cercanas.php" class="back-button">&#8592; Volver</a>'; // Botón para regresar 
    echo "<h2>Resultados:</h2>"; //ListaCercania/ubicaciones_cercanas.php

    echo "<div class='resultados-container'>"; // Contenedor principal
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='card'>"; // Tarjeta individual
        echo "<div class='card-header'><h3>" . htmlspecialchars($fila['Nombre']) . "</h3></div>";
        echo "<div class='card-body'>";
        echo "<p><strong>Número:</strong> " . (!empty($fila['Numero']) ? htmlspecialchars($fila['Numero']) : "No disponible") . "</p>";
        echo "<p><strong>Estado:</strong> " . htmlspecialchars($fila['Estado']) . "</p>";
        echo "<p><strong>Ciudad:</strong> " . htmlspecialchars($fila['Ciudad']) . "</p>";
        echo "<p><strong>Dirección:</strong> " . htmlspecialchars($fila['Direccion']) . "</p>";
        echo "</div>";

        echo "<div class='card-body'>";
            echo "<p><strong>Domingo:</strong> " . (!empty($fila['Domingo']) ? htmlspecialchars($fila['Domingo']) : "No disponible") . "</p>";
            echo "<p><strong>Lunes:</strong> " . htmlspecialchars($fila['Lunes']) . "</p>";
            echo "<p><strong>Martes:</strong> " . htmlspecialchars($fila['Martes']) . "</p>";
            echo "<p><strong>Miercoles:</strong> " . htmlspecialchars($fila['Miercoles']) . "</p>";
            echo "<p><strong>Jueves:</strong> " . htmlspecialchars($fila['Jueves']) . "</p>";
            echo "<p><strong>Viernes:</strong> " . htmlspecialchars($fila['Viernes']) . "</p>";
            echo "<p><strong>Sabado:</strong> " . htmlspecialchars($fila['Sabado']) . "</p>";
        echo "</div>";

        echo "<div class='card-footer'>";
        echo "<p><strong>Google Maps:</strong> <a href='" . (!empty($fila['GoogleMaps']) ? htmlspecialchars($fila['GoogleMaps']) : "#") . "' target='_blank'>Ver ubicación</a></p>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>"; // Fin contenedor principal
} else {
    echo "<p>No se encontraron iglesias para los filtros seleccionados.</p>";
}

// Cerrar conexión
$stmt->close();
$conexion->close();
?>

<style>
/* Estilo para el botón de regreso */
h2 {
    text-align: center;
    align-items: center;
}

.back-button {
    display: inline-block;
    margin: 10px 0;
    padding: 10px 15px;
    font-size: 16px;
    color: white;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #0056b3;
}


/* Contenedor principal */
.resultados-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

/* Tarjeta individual */
.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 300px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    background-color: #fff;
    overflow: hidden;
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: scale(1.03);
}

/* Encabezado de la tarjeta */
.card-header {
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 1.2em;
}

/* Cuerpo de la tarjeta */
.card-body {
    padding: 15px;
    font-size: 0.95em;
    color: #333;
}

.card-body p {
    margin: 5px 0;
}

/* Footer de la tarjeta */
.card-footer {
    background-color: #f9f9f9;
    padding: 10px;
    text-align: center;
    font-size: 0.9em;
}

.card-footer a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.card-footer a:hover {
    text-decoration: underline;
}


</style>
