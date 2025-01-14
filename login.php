<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT id, nombre, rol FROM usuarios WHERE correo = ?");
    $query->execute([$correo]);
    $usuario = $query->fetch();

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol'];
        header("Location: cartelera.php");
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link rel="stylesheet" href="../PWA/CSS/style.css">
    <style>
        .menu-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .menu-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <form action="procesar_login.php" method="POST">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Iniciar Sesión</button>
    </form>

    <footer>
        <!-- Botón para volver al menú -->
        <a href="../PWA/index.html" class="menu-button">Volver al Menú</a>
    </footer>
</body>
</html>

