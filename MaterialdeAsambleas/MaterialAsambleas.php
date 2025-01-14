<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$base_datos = "asambleasvenezuela";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los datos
$query = "SELECT * FROM enlacematerial";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material de las Asambleas</title>
    <link rel="stylesheet" href="/CSS/material.css">
</head>

<body>
    <header>
        <a href="/index.html" class="menu-button">&#8592; Menu</a>
        <h1>Material en las Redes de las Asambleas</h1>
    </header>

    <main>
    <p>Aquí puedes ver el <strong>Material en las Redes</strong> de las Asambleas.</p>
    
    <div id="search-container">
        <input type="text" id="search-bar" placeholder="Buscar noticias..." onkeyup="filterTable()">
        <!-- Botón de búsqueda opcional -->
        <button id="search-button">Buscar</button>
    </div>

        <div id="table-container">
            <table id="events-table">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Enlace</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila['Titulo']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['Descripcion']) . "</td>";
                            echo "<td><a href='" . htmlspecialchars($fila['Enlace']) . "' target='_blank'>Enlace</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay materiales disponibles.</td></tr>";
                    }
                    $conexion->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function filterTable() {
            const searchInput = document.getElementById("search-bar").value.toLowerCase();
            const table = document.getElementById("events-table");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Ignorar la cabecera
                const cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(searchInput)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? "" : "none"; // Mostrar u ocultar la fila
            }
        }
    </script>

    <footer>
        <p>© 2024 Directorio de Iglesias. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
