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

$tenista_id = $_GET['tenista_id'] ?? null;
if (!$tenista_id) {
    die("ID de tenista no proporcionado.");
}

$query = "SELECT tenistas.nombre AS tenista, torneos.nombre AS torneo, titulos.anno AS anio
          FROM titulos
          JOIN tenistas ON titulos.tenista_id = tenistas.id
          JOIN torneos ON titulos.torneo_id = torneos.id
          WHERE tenistas.id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $tenista_id);
$stmt->execute();
$resultado = $stmt->get_result();

if (!$resultado) {
    die("Error en la consulta SQL: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Listado de Títulos Ganados</title>
</head>
<body>
<div class="contenedor">
    <h1>Listado de Títulos Ganados</h1>
    <table border="1">
        <thead>
        <tr>
            <th>Tenista</th>
            <th>Torneo</th>
            <th>Año</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($titulo = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($titulo['tenista']) ?></td>
                <td><?= htmlspecialchars($titulo['torneo']) ?></td>
                <td><?= htmlspecialchars($titulo['anio']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <form method="POST" action="../logout.php" style="display: inline;">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <button type="submit">Cerrar Sesión</button>
    </form>
</div>
</body>
</html>