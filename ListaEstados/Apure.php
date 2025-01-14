<?php
// Activar el reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión a la base de datos
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

// Obtener la ciudad seleccionada (si existe)
$ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';

// Consulta a la base de datos                      //Para mostrar solo por estado
$query = "SELECT nombre, estado, ciudad FROM asambleas_de_venezuela WHERE estado = 'Apure'";
if (!empty($ciudad)) {
    $query .= " AND ciudad = '" . $conexion->real_escape_string($ciudad) . "'";
}

$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazonas</title>
    <link rel="stylesheet" href="/CSS/estados.css">

    <style>
        .map-section {
            position: relative;
            text-align: center;
        }

        .map-section img {
            max-width: 100%;
            height: auto;
        }

        .location-button {
            position: absolute;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            font-size: 12px;
            transform: translate(-50%, -50%);
        }

        .location-button:hover {
            background-color: #0056b3;
        }

        /* Ajusta estas posiciones para que coincidan con tu mapa */
        #Cumana {
            top: 50%; /* Ajusta estas coordenadas según tu mapa */
            left: 60%;
        }

        #Palo_Negro {
            top: 70%;
            left: 40%;
        }
    </style>
</head>
<body>
    <header>
        <a href="Mapa.html" class="menu-button">&#8592; Mapa</a>
        <h1>Directorio de Locales - Apure</h1>
    </header>

    <main class="content">
        <section class="map-section">
            <h2>Estado Apure</h2>
            <img src="/assets/Apure.jpg" alt="Mapa del estado Apure">

            <!-- Botón marcador para Cumana -->
            <button class="location-button" id="Cumana" onclick="filterByCity('Cumana')">Cumana</button>

            <!-- Botón marcador para Palo Negro -->
            <button class="location-button" id="Palo_Negro" onclick="filterByCity('Palo Negro')">Palo Negro</button>

            <!-- Botones para seleccionar ciudades -->
            <div class="city-buttons">
                <form method="GET" action="">
                    <button type="submit" name="ciudad" value="">Mostrar todas</button>
                </form>
            </div>
        </section>

        <section class="table-section">
            <h2>Localidades</h2>
            <table>
                <thead>
                    <tr>
                        <th>Asamblea</th>
                        <th>Estado</th>
                        <th>Ciudad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['estado']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['ciudad']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <hr class="divider">

        <section id="detalle" class="grid-container"> 
            <h2>Detalles de la Asamblea</h2>
            <div id="detalle-content">
                <?php if ($detalle_asamblea): ?>
                    <h3>Asamblea</h3>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($detalle_asamblea['Nombre']) ?></p>
                    <p><strong>Numero:</strong> <?= htmlspecialchars($detalle_asamblea['Numero']) ?></p>
                    <p><strong>Estado:</strong> <?= htmlspecialchars($detalle_asamblea['Estado']) ?></p>
                    <p><strong>Ciudad:</strong> <?= htmlspecialchars($detalle_asamblea['Ciudad']) ?></p> <!-- Ejemplo -->
                    <p><strong>Dirección:</strong> <?= htmlspecialchars($detalle_asamblea['Direccion']) ?></p> <!-- Ejemplo -->

                    <h3>Horario</h3>
                    <p><strong>Domingo:</strong> <?= htmlspecialchars($detalle_asamblea['Domingo']) ?></p>
                    <p><strong>Lunes:</strong> <?= htmlspecialchars($detalle_asamblea['Lunes']) ?></p>
                    <p><strong>Martes:</strong> <?= htmlspecialchars($detalle_asamblea['Martes']) ?></p>
                    <p><strong>Miercoles:</strong> <?= htmlspecialchars($detalle_asamblea['Miercoles']) ?></p> 
                    <p><strong>Jueves:</strong> <?= htmlspecialchars($detalle_asamblea['Jueves']) ?></p>
                    <p><strong>Viernes:</strong> <?= htmlspecialchars($detalle_asamblea['Viernes']) ?></p>
                    <p><strong>Sábado:</strong> <?= htmlspecialchars($detalle_asamblea['Sabado']) ?></p>

                    <h3>Extra</h3>
                    <p><strong>Obras:</strong> <?= htmlspecialchars($detalle_asamblea['Obras']) ?></p>
                    <p><strong>GoogleMaps:</strong> <?= htmlspecialchars($detalle_asamblea['GoogleMaps']) ?></p>
                <?php else: ?>
                    <p>Selecciona una Asamblea para ver sus detalles.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        function filterByCity(city) {
            const url = new URL(window.location.href);
            url.searchParams.set('Ciudad', city);
            window.location.href = url;
        }
    </script>

    <footer>
        <p>&copy; 2024 Directorio de Locales</p>
    </footer>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
