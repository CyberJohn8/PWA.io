<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=asambleasvenezuela", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
