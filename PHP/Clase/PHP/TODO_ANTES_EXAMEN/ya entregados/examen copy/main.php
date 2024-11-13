<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Página Principal - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Bienvenido al Gimnasio</h1>
    <a href="clases.php">Seleccionar Clases</a>
    <a href="logout.php">Cerrar Sesión</a>
</body>

</html>