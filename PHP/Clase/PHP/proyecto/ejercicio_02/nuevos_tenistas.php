<?php
require '../utiles/config.php';
require '../utiles/funciones.php';

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $altura = $_POST['altura'] ?? '';
    $mano = $_POST['mano'] ?? '';
    $anno_nacimiento = $_POST['anno_nacimiento'] ?? '';

    if ($nombre && $apellidos && $altura && $mano && $anno_nacimiento) {
        $stmt = $conexion->prepare("INSERT INTO tenistas (nombre, apellidos, altura, mano, anno_nacimiento) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $nombre, $apellidos, $altura, $mano, $anno_nacimiento);

        if ($stmt->execute()) {
            header('Location: ../ejercicio_01/listado_tenistas.php');
            exit;
        } else {
            $error = "Error al agregar el tenista.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Nuevo Tenista</title>
</head>
<body>
<div class="contenedor">
    <h1>Añadir Nuevo Tenista</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="altura">Altura (en cm):</label>
        <input type="number" id="altura" name="altura" required>

        <label for="mano">Mano:</label>
        <select id="mano" name="mano" required>
            <option value="">Seleccionar</option>
            <option value="Diestro">Diestro</option>
            <option value="Zurdo">Zurdo</option>
        </select>

        <label for="anno_nacimiento">Año de Nacimiento:</label>
        <input type="number" id="anno_nacimiento" name="anno_nacimiento" required>

        <button type="submit">Agregar Tenista</button>
    </form>
    <br>
    <a href="../ejercicio_01/listado_tenistas.php" class="estilo_enlace">Volver al listado</a>
</div>
</body>
</html>
