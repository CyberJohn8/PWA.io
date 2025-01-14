<?php
try {
    // Conexión a la base de datos
    $pdo = new PDO('mysql:host=localhost;dbname=asambleasvenezuela', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los anuncios
    $sql = "SELECT Titulo, Descripcion, Vocero, Asamblea, Estado, Ciudad, Fecha_creacion, Documento 
            FROM anuncios 
            ORDER BY Fecha_creacion DESC"; 
    $stmt = $pdo->query($sql);

    // Comienza el HTML
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cartelera</title>
        <link rel="stylesheet" href="CSS/cartelera.css">
    </head>
    <body>
        <header>
            <a href="../index.html" class="dropdown-button">&#8592; Menu</a>
            <h1>Cartelera de Anuncios</h1>
            <div class="header-right">
                <a href="Cartelera/crud.php" class="crud-button">Gestión de Anuncios</a>
            </div>
        </header>
        <main>';

    // Iterar sobre los anuncios
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="anuncio">
                <h2>' . htmlspecialchars($row['Titulo']) . '</h2>
                <p>' . htmlspecialchars($row['Descripcion']) . '</p>
                <p><strong>Vocero:</strong> ' . htmlspecialchars($row['Vocero']) . '</p>
                <p><strong>Asamblea:</strong> ' . htmlspecialchars($row['Asamblea']) . '</p>
                <p><strong>Ubicación:</strong> ' . htmlspecialchars($row['Ciudad']) . ', ' . htmlspecialchars($row['Estado']) . '</p>
                <p><small>Publicado el: ' . htmlspecialchars($row['Fecha_creacion']) . '</small></p>';

            // Mostrar enlace para descargar el documento si existe
            $nombreArchivo = basename($row['Documento']);
            if (!empty($nombreArchivo) && file_exists(__DIR__ . '/../uploads/' . $nombreArchivo)) {
                echo '<p><a href="../uploads/' . htmlspecialchars($nombreArchivo) . '" download="' . htmlspecialchars($nombreArchivo) . '">Descargar Documento</a></p>';
            } else {
                echo '<p>No hay documento adjunto o el archivo no está disponible.</p>';
            }

            echo '</div>';
        }
    } else {
        echo '<p>No hay anuncios disponibles.</p>';
    }

    echo '</main>
    <footer>
        <p>© 2024 Directorio de Iglesias. Todos los derechos reservados.</p>
    </footer>
    </body>
    </html>';
} catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
}
?>
