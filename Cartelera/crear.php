<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=asambleasvenezuela', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $fileName = null;

        // Validar y guardar archivo si se proporciona
        if (!empty($_FILES['Documento']['name'])) {
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'];
            $fileType = mime_content_type($_FILES['Documento']['tmp_name']);

            if (in_array($fileType, $allowedTypes)) {
                $fileName = time() . "_" . basename($_FILES['Documento']['name']);
                $uploadPath = __DIR__ . "/uploads/" . $fileName;

                if (!move_uploaded_file($_FILES['Documento']['tmp_name'], $uploadPath)) {
                    throw new Exception("Error al mover el archivo al directorio de destino.");
                }
            } else {
                throw new Exception("Tipo de archivo no permitido. Solo se aceptan PDF, DOCX, DOC y TXT.");
            }
        }

        // Insertar en la base de datos
        $sql = "INSERT INTO anuncios (Titulo, Descripcion, Vocero, Asamblea, Estado, Ciudad, Documento) 
                VALUES (:Titulo, :Descripcion, :Vocero, :Asamblea, :Estado, :Ciudad, :Documento)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':Titulo' => $_POST['Titulo'],
            ':Descripcion' => $_POST['Descripcion'],
            ':Vocero' => $_POST['Vocero'],
            ':Asamblea' => $_POST['Asamblea'],
            ':Estado' => $_POST['Estado'],
            ':Ciudad' => $_POST['Ciudad'],
            ':Documento' => $fileName
        ]);

        echo "Anuncio creado con éxito. <a href='crud.php'>Volver</a>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
else {
    echo '
        <div class="container">
            <a href="crud.php" class="btn">Volver</a>
            <form action="crear.php" method="POST" enctype="multipart/form-data">
                <label for="Titulo">Título:</label>
                <input type="text" name="Titulo" required>
                
                <label for="Descripcion">Descripción:</label>
                <textarea name="Descripcion" required></textarea>
                
                <label for="Vocero">Vocero:</label>
                <input type="text" name="Vocero" required>
                
                <label for="Asamblea">Asamblea:</label>
                <input type="text" name="Asamblea" required>
                
                <label for="Estado">Estado:</label>
                <input type="text" name="Estado" required>
                
                <label for="Ciudad">Ciudad:</label>
                <input type="text" name="Ciudad" required>
                
                <label for="Documento">Documento:</label>
                <input type="file" name="Documento">
                
                <button type="submit">Guardar</button>
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
