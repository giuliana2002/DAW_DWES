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

$query = "SELECT * FROM tenistas";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error al obtener los datos de tenistas.");
}

// Procesar la acción de borrar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {
    $id = $_POST['id'];
    if ($id && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $stmt = $conexion->prepare("DELETE FROM tenistas WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirigir al listado para evitar reenvíos del formulario
            header("Location: listado_tenistas.php");
            exit;
        } else {
            $error = "Error al borrar el tenista.";
        }
    } else {
        $error = "Token CSRF inválido o falta el ID.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Listado de Tenistas</title>
</head>
<body>
<div class="contenedor">
    <h1>Listado de Tenistas</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
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
                    <a href="editar_tenista.php?id=<?= $tenista['id'] ?>" class="boton-editar">Editar</a>
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
