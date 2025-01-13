<?php
require_once '../utiles/auth.php';
require_once '../utiles/config.php';
require_once '../utiles/funciones.php';
verificarSesion();

if (!esAdministrador()) {
    echo 'Acceso denegado';
    exit();
}

$conn = obtenerConexion();

// Procesar formulario para agregar nuevo tenista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $pais = $conn->real_escape_string($_POST['pais']);

    $query = "INSERT INTO tenistas (nombre, pais) VALUES ('$nombre', '$pais')";
    if ($conn->query($query)) {
        echo "Tenista agregado correctamente.";
    } else {
        echo "Error al agregar tenista: " . $conn->error;
    }
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