<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
require '../utiles/config.php';
require '../utiles/funciones.php';

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

// Verificar si se pasó el ID del tenista
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listado_tenistas.php");
    exit;
}

$id = $_GET['id'];

// Obtener los datos del tenista
$query = "SELECT * FROM tenistas WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Tenista no encontrado.";
    exit;
}

$tenista = $resultado->fetch_assoc();

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $altura = $_POST['altura'] ?? '';
    $mano = $_POST['mano'] ?? '';
    $anno_nacimiento = $_POST['anno_nacimiento'] ?? '';

    if ($nombre && $apellidos && $altura && $mano && $anno_nacimiento) {
        $updateQuery = "UPDATE tenistas SET nombre = ?, apellidos = ?, altura = ?, mano = ?, anno_nacimiento = ? WHERE id = ?";
        $updateStmt = $conexion->prepare($updateQuery);
        $updateStmt->bind_param("ssissi", $nombre, $apellidos, $altura, $mano, $anno_nacimiento, $id);

        if ($updateStmt->execute()) {
            header("Location: listado_tenistas.php");
            exit;
        } else {
            $error = "Error al actualizar el tenista.";
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
    <title>Editar Tenista</title>
</head>
<body>
<div class="contenedor">
    <h1>Editar Tenista</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($tenista['nombre']) ?>" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($tenista['apellidos']) ?>" required>
        <label for="altura">Altura (en cm):</label>
        <input type="number" id="altura" name="altura" value="<?= $tenista['altura'] ?>" required>
        <label for="mano">Mano:</label>
        <select id="mano" name="mano" required>
            <option value="Diestro" <?= $tenista['mano'] === 'Diestro' ? 'selected' : '' ?>>Diestro</option>
            <option value="Zurdo" <?= $tenista['mano'] === 'Zurdo' ? 'selected' : '' ?>>Zurdo</option>
        </select>
        <label for="anno_nacimiento">Año de Nacimiento:</label>
        <input type="number" id="anno_nacimiento" name="anno_nacimiento" value="<?= $tenista['anno_nacimiento'] ?>" required>
        <button type="submit">Actualizar Tenista</button>
    </form>
    <br>
    <a href="listado_tenistas.php" class="estilo_enlace">Volver al Listado</a>
</div>
</body>
</html>
