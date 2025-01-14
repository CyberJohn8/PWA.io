<?php
if (isset($_GET['id'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=asambleasvenezuela', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recuperar el archivo adjunto asociado
        $sqlSelect = "SELECT Documento FROM anuncios WHERE ID = :id";
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->execute([':id' => $_GET['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Eliminar el archivo físico si existe
        if ($row && !empty($row['Documento'])) {
            $filePath = "ruta_donde_se_guardan_los_archivos/" . $row['Documento'];
            if (file_exists($filePath)) {  
                unlink($filePath);
            }
        }
//Warning: file_exists() expects parameter 1 to be a valid path, string given 
//in C:\xampp\htdocs\PWA\Cartelera\eliminar.php on line 16
        // Eliminar el anuncio de la base de datos
        $sqlDelete = "DELETE FROM anuncios WHERE ID = :id";
        $stmt = $pdo->prepare($sqlDelete);
        $stmt->execute([':id' => $_GET['id']]);

        echo "Anuncio eliminado con éxito. <a href='crud.php'>Volver</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID no proporcionado. <a href='crud.php'>Volver</a>";
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
