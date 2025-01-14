<?php
// Activar el reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir conexión a la base de datos
include 'conexion.php';

// Consulta para obtener las asambleas
$query = "SELECT ID, nombre, estado FROM asambleas_de_venezuela";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera</title>
    <link rel="stylesheet" href="/CSS/listado.css">
</head>
<body>

<header>
    <a href="/index.html" class="menu-button">&#8592; Menu</a>
    <h1>Lista de las Asambleas de Venezuela</h1>
</header>

<main>
    <section id="listado" class="grid-container">
        <h2>Listado de Asambleas</h2>
        <table id="events-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Consultar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr data-id='{$fila['ID']}'>";
                        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['estado']) . "</td>";
                        echo "<td><button class='detalles-btn'>Ver detalles</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>

    <hr class="divider">

    <section id="detalle" class="grid-container"> 
        <h2>Detalles de la Asamblea</h2>
        <div id="detalle-content">
            <p>Selecciona una asamblea para ver sus detalles.</p>
        </div>
    </section>
</main>


<script>
    // Capturar clics en los botones de detalles
    document.addEventListener("DOMContentLoaded", () => {
        const table = document.getElementById("events-table");

        table.addEventListener("click", (e) => {
            if (e.target.classList.contains("detalles-btn")) {
                const row = e.target.closest("tr");
                const id = row.dataset.id; // Asegúrate de que sea en minúsculas

                cargarDetalles(id); // Llamar función para cargar detalles
            }
        });
    });

    // Función para cargar detalles dinámicamente
    function cargarDetalles(id) {
    fetch(`detalles.php?ID=${id}`)
        .then(response => response.json())
        .then(data => {
            const detalleContent = document.getElementById("detalle-content");

            if (data.success) {
                detalleContent.innerHTML = `
                    <div>
                        <h3>Asamblea</h3>
                        <p><strong>Nombre:</strong> ${data.nombre}</p>
                        <p><strong>Número:</strong> ${data.numero}</p>
                        <p><strong>Estado:</strong> ${data.estado}</p>
                        <p><strong>Ciudad:</strong> ${data.ciudad}</p>
                        <p><strong>Dirección:</strong> ${data.direccion}</p>
                    </div>

                    <div>
                        <h3>Horario</h3>
                        <p><strong>Domingo:</strong> ${data.domingo}</p>
                        <p><strong>Lunes:</strong> ${data.lunes}</p>
                        <p><strong>Martes:</strong> ${data.martes}</p>
                        <p><strong>Miércoles:</strong> ${data.miercoles}</p>
                        <p><strong>Jueves:</strong> ${data.jueves}</p>
                        <p><strong>Viernes:</strong> ${data.viernes}</p>
                        <p><strong>Sábado:</strong> ${data.sabado}</p>
                    </div>

                    <div>
                        <h3>Extra</h3>
                        <p><strong>Obras:</strong> ${data.obras}</p>
                        <p><strong>Google Maps:</strong> <a href="${data.googlemaps}" target="_blank">${data.googlemaps}</a></p>
                    </div>
                `;
            } else {
                detalleContent.innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error("Error al cargar los detalles:", error);
            document.getElementById("detalle-content").innerHTML = `<p>Ocurrió un error al cargar los detalles.</p>`;
        });
}

</script>

<footer>
    <p>© 2024 Directorio de Iglesias. Todos los derechos reservados.</p>
</footer>
</body>
</html>
