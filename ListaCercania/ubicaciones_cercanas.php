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

// Validar si los datos POST están disponibles
if (isset($_POST['estado'])) {
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
        echo "<h2>Resultados:</h2>";
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

    $stmt->close();
} else {
    // Manejar acceso directo sin POST
    //echo "<p>Por favor, completa el formulario para buscar iglesias.</p>";
}

$conexion->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Iglesias</title>

    <link rel="stylesheet" href="/CSS/cercania.css">
</head> 

<body>
    <header>
        <a href="/index.html" class="menu-button">&#8592; Menu</a>
        <h1>Búsqueda de Iglesias por Estado y Ciudad</h1>
    </header>

    

    <form method="POST" action="buscar_ubicaciones.php">
        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Amazonas">Amazonas</option>
            <option value="Anzoátegui">Anzoátegui</option>
            <option value="Apure">Apure</option>
            <option value="Aragua">Aragua</option>
            <!-- Agrega más estados aquí -->
        </select>
        <br><br>

        <label for="ciudad">Ciudad (opcional):</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ingrese la ciudad...">
        <br><br>

        <button type="submit">Buscar</button>
    </form>

    <!--<div id="resultado"></div>-->

    <footer>
        <p>&copy; 2024 Directorio de Locales</p>
    </footer>
</body>
</html>

