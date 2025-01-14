<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicializar variables del formulario
    $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($correo && $nombre && $password) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=asambleasvenezuela', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO usuarios (nombre, correo, rol) VALUES (:nombre, :correo, 'usuario')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nombre' => $nombre, 'correo' => $correo]);

            echo "Registro exitoso. Bienvenido, $nombre.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "Error: El correo ya está registrado.";
            } else {
                echo "Error en la base de datos: " . $e->getMessage();
            }
        }
    } else {
        //echo "Por favor, completa todos los campos.";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link rel="stylesheet" href="../PWA/CSS/style.css">
    <style>
        .menu-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .menu-button:hover {
            background-color: #1e7e34;
        }
    </style>
</head>

<body>
    <h1>Registro</h1>
    <form action="procesar_registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <footer>
        <!-- Botón para volver al menú -->
        <a href="../PWA/index.html" class="menu-button">Volver al Menú</a>
    </footer>

    
</body>
</html>
