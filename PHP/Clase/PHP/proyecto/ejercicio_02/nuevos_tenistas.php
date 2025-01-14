<?php
session_start();
require '../utiles/config.php';
require '../utiles/auth.php';
require '../utiles/funciones.php';

if (!verificarSesionActiva()) {
    header('Location: login.php');
    exit;
}

// Generar token CSRF solo si no existe
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $apellidos = limpiarEntrada($_POST['apellidos'] ?? '');
    $altura = $_POST['altura'] ?? '';
    $mano = $_POST['mano'] ?? '';
    $anno_nacimiento = $_POST['anno_nacimiento'] ?? '';
    $token = $_POST['csrf_token'] ?? '';

    if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        $error = "Token CSRF no válido.";
    } elseif ($nombre && $apellidos && $altura && $mano && $anno_nacimiento) {
        $stmt = $conexion->prepare("INSERT INTO tenistas (nombre, apellidos, altura, mano, anno_nacimiento) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $stmt->bind_param("ssiss", $nombre, $apellidos, $altura, $mano, $anno_nacimiento);

        if ($stmt->execute()) {
            header('Location: listado_tenistas.php');
            exit;
        } else {
            $error = "Error al agregar el tenista: " . $stmt->error;
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
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($apellidos ?? '') ?>" required>
        <label for="altura">Altura (en cm):</label>
        <input type="number" id="altura" name="altura" value="<?= htmlspecialchars($altura ?? '') ?>" required>
        <label for="mano">Mano:</label>
        <select id="mano" name="mano" required>
            <option value="Diestro" <?= (isset($mano) && $mano === 'Diestro') ? 'selected' : '' ?>>Diestro</option>
            <option value="Zurdo" <?= (isset($mano) && $mano === 'Zurdo') ? 'selected' : '' ?>>Zurdo</option>
        </select>
        <label for="anno_nacimiento">Año de Nacimiento:</label>
        <input type="number" id="anno_nacimiento" name="anno_nacimiento" value="<?= htmlspecialchars($anno_nacimiento ?? '') ?>" required>
        <button type="submit">Agregar Tenista</button>
    </form>
    <br>
    <form method="POST" action="logout.php" style="display: inline;">
        <button type="submit">Cerrar Sesión</button>
    </form>
</div>
</body>
</html>
