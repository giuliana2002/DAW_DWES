<?php
session_start();
require '../utiles/config.php';
require '../utiles/auth.php';
require '../utiles/funciones.php';

if (!verificarSesionActiva()) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listado.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM torneos WHERE id = ?";
$stmt = $conexion->prepare($query);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Torneo no encontrado.";
    exit;
}

$torneo = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $ciudad = limpiarEntrada($_POST['ciudad'] ?? '');
    $superficie_id = $_POST['superficie_id'] ?? '';
    $token = $_POST['csrf_token'] ?? '';

    if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        $error = "Token CSRF no válido.";
    } elseif ($nombre && $ciudad && $superficie_id) {
        $updateQuery = "UPDATE torneos SET nombre = ?, ciudad = ?, superficie_id = ? WHERE id = ?";
        $updateStmt = $conexion->prepare($updateQuery);

        if (!$updateStmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $updateStmt->bind_param("ssii", $nombre, $ciudad, $superficie_id, $id);

        if ($updateStmt->execute()) {
            header("Location: listado.php");
            exit;
        } else {
            $error = "Error al actualizar el torneo: " . $updateStmt->error;
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}

$querySuperficies = "SELECT id, nombre FROM superficies";
$resultadoSuperficies = $conexion->query($querySuperficies);
$superficies = $resultadoSuperficies->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Editar Torneo</title>
</head>
<body>
<div class="contenedor">
    <h1>Modificar una Torneo</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($torneo['nombre']) ?>" required>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($torneo['ciudad']) ?>" required>
        <label for="superficie_id">Superficie:</label>
        <select id="superficie_id" name="superficie_id" required>
            <?php foreach ($superficies as $superficie): ?>
                <option value="<?= $superficie['id'] ?>" <?= $superficie['id'] == $torneo['superficie_id'] ? 'selected' : '' ?>><?= htmlspecialchars($superficie['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Actualizar Torneo</button>
    </form>
    <br>
    <a href="listado.php" class="estilo_enlace">Volver al Listado</a>
</div>
</body>
</html>