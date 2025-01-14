<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

require '../utiles/config.php';
require '../utiles/funciones.php';

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

$query = "SELECT tenistas.nombre AS tenista, torneos.nombre AS torneo, titulos.anno AS anio
          FROM titulos
          JOIN tenistas ON titulos.tenista_id = tenistas.id
          JOIN torneos ON titulos.torneo_id = torneos.id";
$resultado = $conexion->query($query);

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
                <td><?= $titulo['anio'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <form method="POST" action="logout.php" style="display: inline;">
        <button type="submit">Cerrar Sesión</button>
    </form>
</div>
</body>
</html>
