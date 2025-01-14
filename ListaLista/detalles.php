<?php
// Activar el reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir conexión a la base de datos
include 'conexion.php';

// Validar el ID recibido
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $id = intval($_GET['ID']);

    // Consulta a la base de datos
    $query = "SELECT * FROM asambleas_de_venezuela WHERE ID = $id";
    $resultado = $conexion->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $detalle = $resultado->fetch_assoc();

        // Enviar los datos como JSON
        echo json_encode([
            "success" => true,
            //Asamblea
            "nombre" => $detalle['nombre'] ?? "No disponible",
            "numero" => $detalle['numero'] ?? "No disponible",
            "estado" => $detalle['estado'] ?? "No disponible",
            "ciudad" => $detalle['ciudad'] ?? "No disponible",
            "direccion" => $detalle['direccion'] ?? "No disponible",
            //Horario
            "domingo" => $detalle['domingo'] ?? "No disponible",
            "lunes" => $detalle['lunes'] ?? "No disponible",
            "martes" => $detalle['martes'] ?? "No disponible",
            "miercoles" => $detalle['miercoles'] ?? "No disponible",
            "jueves" => $detalle['jueves'] ?? "No disponible",
            "viernes" => $detalle['viernes'] ?? "No disponible",
            "sabado" => $detalle['sabado'] ?? "No disponible",
            //Extras
            "obras" => $detalle['obras'] ?? "No disponible",
            "googlemaps" => $detalle['googlemaps'] ?? "No disponible"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No se encontraron detalles para la asamblea seleccionada."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "ID inválido."
    ]);
}
?>
