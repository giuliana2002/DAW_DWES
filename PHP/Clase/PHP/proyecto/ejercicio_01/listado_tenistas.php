<?php
require '../utiles/init.php';

if (!verificarSesionActiva()) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$conexion = conectarDB();
$query = "SELECT * FROM tenistas";
$resultado = $conexion->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {
    $id = $_POST['id'] ?? null;
    $token = $_POST['csrf_token'] ?? null;

    if (!$id) {
        echo "Error: ID no proporcionado.";
    } elseif (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        echo "Error: Token CSRF no coincide.";
    } else {
        $stmtTitulos = $conexion->prepare("DELETE FROM titulos WHERE tenista_id = ?");
        $stmtTitulos->bind_param("i", $id);

        if ($stmtTitulos->execute()) {
            $stmtTenistas = $conexion->prepare("DELETE FROM tenistas WHERE id = ?");
            $stmtTenistas->bind_param("i", $id);

            if ($stmtTenistas->execute()) {
                header("Location: listado_tenistas.php");
                exit;
            } else {
                echo "Error al eliminar el tenista: " . $stmtTenistas->error;
            }
        } else {
            echo "Error al eliminar los títulos asociados: " . $stmtTitulos->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Listado de Tenistas</title>
</head>
<body>
<div class="contenedor">
    <h1>Listado de Tenistas</h1>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Altura</th>
            <th>Mano</th>
            <th>Año de Nacimiento</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($tenista = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $tenista['id'] ?></td>
                <td><?= htmlspecialchars($tenista['nombre']) ?></td>
                <td><?= htmlspecialchars($tenista['apellidos']) ?></td>
                <td><?= $tenista['altura'] ?> cm</td>
                <td><?= htmlspecialchars($tenista['mano']) ?></td>
                <td><?= $tenista['anno_nacimiento'] ?></td>
                <td>
                    <a href="editar_tenista.php?id=<?= $tenista['id'] ?>">Editar</a>
                </td>
                <td>
                    <form method="POST" action="" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $tenista['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <button type="submit" name="borrar" onclick="return confirm('¿Seguro que deseas borrar este tenista?');" class="boton-eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <form method="POST" action="../logout.php" style="display: inline;">
        <button type="submit">Cerrar Sesión</button>
    </form>
</div>
</body>
</html>
