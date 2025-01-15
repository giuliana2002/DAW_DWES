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

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listado_tenistas.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM tenistas WHERE id = ?";
$stmt = $conexion->prepare($query);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Tenista no encontrado.";
    exit;
}

$tenista = $resultado->fetch_assoc();

$queryTitulos = "SELECT * FROM titulos WHERE tenista_id = ?";
$stmtTitulos = $conexion->prepare($queryTitulos);
$stmtTitulos->bind_param("i", $id);
$stmtTitulos->execute();
$resultadoTitulos = $stmtTitulos->get_result();
$titulos = $resultadoTitulos->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $apellidos = limpiarEntrada($_POST['apellidos'] ?? '');
    $altura = $_POST['altura'] ?? '';
    $mano = $_POST['mano'] ?? '';
    $anno_nacimiento = $_POST['anno_nacimiento'] ?? '';
    $titulos = $_POST['titulos'] ?? [];
    $token = $_POST['csrf_token'] ?? '';

    if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        $error = "Token CSRF no válido.";
    } elseif (strlen($nombre) < 3 || strlen($nombre) > 50) {
        $error = "El nombre debe tener entre 3 y 50 caracteres.";
    } elseif (strlen($apellidos) < 5 || strlen($apellidos) > 100) {
        $error = "El apellido debe tener entre 5 y 100 caracteres.";
    } elseif ($altura < 120 || $altura > 250) {
        $error = "La altura debe estar entre 120 y 250 cm.";
    } elseif ($nombre && $apellidos && $altura && $mano && $anno_nacimiento) {
        $updateQuery = "UPDATE tenistas SET nombre = ?, apellidos = ?, altura = ?, mano = ?, anno_nacimiento = ? WHERE id = ?";
        $updateStmt = $conexion->prepare($updateQuery);

        if (!$updateStmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $updateStmt->bind_param("ssissi", $nombre, $apellidos, $altura, $mano, $anno_nacimiento, $id);

        if ($updateStmt->execute()) {
            $deleteQuery = "DELETE FROM titulos WHERE tenista_id = ?";
            $deleteStmt = $conexion->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $id);
            $deleteStmt->execute();

            foreach ($titulos as $titulo) {
                $insertQuery = "INSERT INTO titulos (anno, tenista_id, torneo_id) VALUES (?, ?, ?)";
                $insertStmt = $conexion->prepare($insertQuery);
                $insertStmt->bind_param("iii", $titulo['anno'], $id, $titulo['torneo_id']);
                $insertStmt->execute();
            }

            header("Location: listado_tenistas.php");
            exit;
        } else {
            $error = "Error al actualizar el tenista: " . $updateStmt->error;
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}

$queryTorneos = "SELECT id, nombre FROM torneos";
$resultadoTorneos = $conexion->query($queryTorneos);
$torneos = $resultadoTorneos->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Editar Tenista</title>
</head>
<body>
<div class="contenedor">
    <h1>Editar Tenista</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($tenista['nombre']) ?>" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($tenista['apellidos']) ?>" required>
        <label for="altura">Altura (en cm):</label>
        <input type="number" id="altura" name="altura" value="<?= $tenista['altura'] ?>" required>
        <label for="mano">Mano:</label>
        <select id="mano" name="mano" required>
            <option value="Diestro" <?= $tenista['mano'] === 'Diestro' ? 'selected' : '' ?>>Diestro</option>
            <option value="Zurdo" <?= $tenista['mano'] === 'Zurdo' ? 'selected' : '' ?>>Zurdo</option>
        </select>
        <label for="anno_nacimiento">Año de Nacimiento:</label>
        <input type="number" id="anno_nacimiento" name="anno_nacimiento" value="<?= $tenista['anno_nacimiento'] ?>" required>
        <h2>Títulos</h2>
        <div id="titulos">
            <?php foreach ($titulos as $index => $titulo): ?>
                <div class="titulo">
                    <label for="anno">Año:</label>
                    <input type="number" name="titulos[<?= $index ?>][anno]" value="<?= $titulo['anno'] ?>" required>
                    <label for="torneo_id">Torneo:</label>
                    <select name="titulos[<?= $index ?>][torneo_id]" required>
                        <?php foreach ($torneos as $torneo): ?>
                            <option value="<?= $torneo['id'] ?>" <?= $torneo['id'] == $titulo['torneo_id'] ? 'selected' : '' ?>><?= htmlspecialchars($torneo['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" onclick="agregarTitulo()">Agregar Título</button>
        <button type="submit">Actualizar Tenista</button>
    </form>
    <br>
    <a href="listado_tenistas.php" class="estilo_enlace">Volver al Listado</a>
</div>
<script>
    function agregarTitulo() {
        const titulosDiv = document.getElementById('titulos');
        const index = titulosDiv.children.length;
        const nuevoTitulo = document.createElement('div');
        nuevoTitulo.classList.add('titulo');
        nuevoTitulo.innerHTML = `
            <label for="anno">Año:</label>
            <input type="number" name="titulos[${index}][anno]" required>
            <label for="torneo_id">Torneo:</label>
            <select name="titulos[${index}][torneo_id]" required>
                <?php foreach ($torneos as $torneo): ?>
                    <option value="<?= $torneo['id'] ?>"><?= htmlspecialchars($torneo['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        `;
        titulosDiv.appendChild(nuevoTitulo);
    }
</script>
</body>
</html>