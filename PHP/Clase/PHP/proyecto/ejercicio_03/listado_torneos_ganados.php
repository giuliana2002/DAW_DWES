<?php
require '../utiles/config.php';
require '../utiles/funciones.php';

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

$query = "SELECT t.nombre AS tenista, tg.torneo, tg.anio FROM torneos_ganados tg JOIN tenistas t ON tg.tenista_id = t.id";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error al obtener los datos de torneos ganados.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Listado de Torneos Ganados</title>
</head>
<body>
<div class="contenedor">
    <h1>Listado de Torneos Ganados</h1>
    <table border="1">
        <thead>
        <tr>
            <th>Tenista</th>
            <th>Torneo</th>
            <th>Año</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($torneo = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($torneo['tenista']) ?></td>
                <td><?= htmlspecialchars($torneo['torneo']) ?></td>
                <td><?= $torneo['anio'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="../ejercicio_01/listado_tenistas.php" class="estilo_enlace">Volver al listado de tenistas</a>
</div>
</body>
</html>