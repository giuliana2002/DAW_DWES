<?php
require_once '../utiles/auth.php';
require_once '../utiles/config.php';
require_once '../utiles/funciones.php';
verificarSesion();

$conn = obtenerConexion();

// Consulta para obtener los torneos ganados
$query = "SELECT tenistas.nombre AS tenista, torneos.nombre AS torneo, torneos.anio 
          FROM torneos 
          JOIN tenistas ON torneos.tenista_id = tenistas.id";
$result = $conn->query($query);

// Verificar errores en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listado de Torneos Ganados</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <h1>Listado de Torneos Ganados</h1>
    <table>
        <tr>
            <th>Tenista</th>
            <th>Torneo</th>
            <th>Año</th>
        </tr>
        <?php while ($torneo = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($torneo['tenista']) ?></td>
                <td><?= htmlspecialchars($torneo['torneo']) ?></td>
                <td><?= htmlspecialchars($torneo['anio']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>