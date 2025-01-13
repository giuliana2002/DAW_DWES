<?php
require_once '../utiles/auth.php';
require_once '../utiles/config.php';
require_once '../utiles/funciones.php';
verificarSesion();

$conn = obtenerConexion();

// Consulta para obtener los torneos
$query = "SELECT id, nombre, ciudad, superficie FROM torneos";
$result = $conn->query($query);

// Verificar errores en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listado de Torneos</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <h1>Listado de Torneos</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Superficie</th>
            <?php if (esAdministrador()) echo '<th>Acciones</th>'; ?>
        </tr>
        <?php while ($torneo = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($torneo['nombre']) ?></td>
                <td><?= htmlspecialchars($torneo['ciudad']) ?></td>
                <td><?= htmlspecialchars($torneo['superficie']) ?></td>
                <?php if (esAdministrador()): ?>
                    <td>
                        <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>