<?php
require_once '../utiles/auth.php';
verificarSesion();
if (!esAdministrador()) {
    echo 'Acceso denegado';
    exit();
}

// Aquí procesaríamos el formulario para agregar un nuevo tenista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $pais = $_POST['pais'];
    // Lógica para insertar el nuevo tenista en la base de datos
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agregar Tenista</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <h1>Agregar Tenista</h1>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" required><br>
        <button type="submit">Agregar</button>
    </form>
</div>
</body>
</html>