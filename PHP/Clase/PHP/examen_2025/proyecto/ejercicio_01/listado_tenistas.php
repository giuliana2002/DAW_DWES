<?php
require_once '../utiles/auth.php';
require_once '../utiles/config.php';
require_once '../utiles/funciones.php';
verificarSesion();

// Conexión a la base de datos
$conn = obtenerConexion();

// Consulta para obtener los tenistas
$query = "SELECT id, nombre, pais FROM tenistas";
$result = $conn->query($query);

// Verificar errores en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listado de Tenistas</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <h1>Listado de Tenistas</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>País</th>
            <?php if (esAdministrador()) echo '<th>Acciones</th>'; ?>
        </tr>
        <?php while ($tenista = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($tenista['id']) ?></td>
                <td><?= htmlspecialchars($tenista['nombre']) ?></td>
                <td><?= htmlspecialchars($tenista['pais']) ?></td>
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