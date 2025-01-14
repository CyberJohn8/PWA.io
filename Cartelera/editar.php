<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Conexión a la base de datos
        $pdo = new PDO('mysql:host=localhost;dbname=asambleasvenezuela', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Comprobamos si se subió un nuevo archivo
        $fileName = $_POST['DocumentoActual'];
        if (isset($_POST['EliminarDocumento']) && $_POST['EliminarDocumento'] === '1') {
            // Eliminar documento actual
            if ($fileName) {
                unlink("ruta_donde_se_guardan_los_archivos/" . $fileName);
            }
            $fileName = null;
        } elseif (!empty($_FILES['Documento']['name'])) {
            // Reemplazar el documento actual con uno nuevo
            if ($fileName) {
                unlink("ruta_donde_se_guardan_los_archivos/" . $fileName);
            }
            $fileName = time() . "_" . $_FILES['Documento']['name'];
            move_uploaded_file($_FILES['Documento']['tmp_name'], "ruta_donde_se_guardan_los_archivos/" . $fileName);
        }

        // Actualización de datos
        $sql = "UPDATE anuncios SET Titulo = :Titulo, Descripcion = :Descripcion, Vocero = :Vocero, 
                Asamblea = :Asamblea, Estado = :Estado, Ciudad = :Ciudad, Documento = :Documento WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':Titulo' => $_POST['Titulo'],
            ':Descripcion' => $_POST['Descripcion'],
            ':Vocero' => $_POST['Vocero'],
            ':Asamblea' => $_POST['Asamblea'],
            ':Estado' => $_POST['Estado'],
            ':Ciudad' => $_POST['Ciudad'],
            ':Documento' => $fileName,
            ':ID' => $_POST['ID']
        ]);

        echo "Anuncio actualizado. <a href='crud.php'>Volver</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    try {
        // Conexión a la base de datos
        $pdo = new PDO('mysql:host=localhost;dbname=asambleasvenezuela', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM anuncios WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ID' => $_GET['id']]);
        $anuncio = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    // Mostrar formulario
    echo '
        <div>
            <a href="crud.php" class="btn">Volver</a>
            <form action="editar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="' . htmlspecialchars($anuncio['ID']) . '">
                <input type="hidden" name="DocumentoActual" value="' . htmlspecialchars($anuncio['Documento']) . '">

                <label for="Titulo">Título:</label>
                <input type="text" name="Titulo" value="' . htmlspecialchars($anuncio['Titulo']) . '" required>

                <label for="Descripcion">Descripción:</label>
                <input type="text" name="Descripcion" value="' . htmlspecialchars($anuncio['Descripcion']) . '" required>
                
                <label for="Vocero">Vocero:</label>
                <input type="text" name="Vocero" value="' . htmlspecialchars($anuncio['Vocero']) . '" required>
                
                <label for="Asamblea">Asamblea:</label>
                <input type="text" name="Asamblea" value="' . htmlspecialchars($anuncio['Asamblea']) . '" required>
                
                <label for="Estado">Estado:</label>
                <input type="text" name="Estado" value="' . htmlspecialchars($anuncio['Estado']) . '" required>
                
                <label for="Ciudad">Ciudad:</label>
                <input type="text" name="Ciudad" value="' . htmlspecialchars($anuncio['Ciudad']) . '" required>

                <label for="Documento">Documento Actual:</label>
                ' . ($anuncio['Documento'] ? '<a href="ruta_donde_se_guardan_los_archivos/' . htmlspecialchars($anuncio['Documento']) . '" target="_blank">' . htmlspecialchars($anuncio['Documento']) . '</a>' : 'No hay documento cargado') . '
                
                <label for="Documento">Nuevo Documento:</label>
                <input type="file" name="Documento">
                
                <label>
                    <input type="checkbox" name="EliminarDocumento" value="1"> Eliminar documento actual
                </label>

                <button type="submit">Actualizar</button>
            </form>
        </div>
    ';
}
?>



<style>
/* Contenedor principal */
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px;
}

/* Botón Volver */
.btn {
    display: block;
    width: 50%; /* Ajusta el ancho del botón según sea necesario */
    padding: 10px;
    font-size: 18px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20px; /* Espacio entre el botón y el formulario */
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

/* Formulario */
form {
    width: 100%;
    max-width: 500px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form label {
    font-size: 16px;
    color: #555;
    display: block;
    margin-bottom: 5px;
}

form input, form select, form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

form input:focus, form select:focus, form textarea:focus {
    border-color: #007bff;
    outline: none;
    background-color: #fff;
}

form button {
    width: 100%;
    padding: 10px;
    font-size: 18px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}
</style>
