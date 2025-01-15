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

$query = "SELECT torneos.id, torneos.nombre, torneos.ciudad, superficies.nombre AS superficie
          FROM torneos
          JOIN superficies ON torneos.superficie_id = superficies.id";

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
    <title>Listado de Torneos</title>
</head>
<body>
<h1>Listado de Torneos</h1>
<div class="contenedor">

    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Superficie</th>
            <th>Editar</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($torneo = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $torneo['id'] ?></td>
                <td><?= htmlspecialchars($torneo['nombre']) ?></td>
                <td><?= htmlspecialchars($torneo['ciudad']) ?></td>
                <td><?= htmlspecialchars($torneo['superficie']) ?></td>
                <td>
                    <a href="modificar.php?id=<?= $torneo['id'] ?>"> &#9998; </a>

                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <br>

    <br>
    <form method="POST" action="../logout.php" style="display: inline;">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <button type="submit">Cerrar Sesión</button>
    </form>
</div>
</body>
</html>