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
        $stmt = $conexion->prepare("INSERT INTO tenistas (nombre, apellidos, altura, mano, anno_nacimiento) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $stmt->bind_param("ssiss", $nombre, $apellidos, $altura, $mano, $anno_nacimiento);

        if ($stmt->execute()) {
            $tenista_id = $stmt->insert_id;
            foreach ($titulos as $titulo) {
                $anno = $titulo['anno'] ?? null;
                $torneo_id = $titulo['torneo_id'] ?? null;
                if ($anno && $torneo_id) {
                    $stmtTitulo = $conexion->prepare("INSERT INTO titulos (anno, tenista_id, torneo_id) VALUES (?, ?, ?)");
                    $stmtTitulo->bind_param("iii", $anno, $tenista_id, $torneo_id);
                    $stmtTitulo->execute();
                }
            }
            header('Location: ../ejercicio_01/listado_tenistas.php');
            exit;
        } else {
            $error = "Error al agregar el tenista: " . $stmt->error;
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
    <title>Nuevo Tenista</title>
</head>
<body>
<h1>Añadir Nuevo Tenista</h1>
<div class="contenedor">
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($apellidos ?? '') ?>" required>
        <label for="altura">Altura (en cm):</label>
        <input type="number" id="altura" name="altura" value="<?= htmlspecialchars($altura ?? '') ?>" required>
        <label for="mano">Mano:</label>
        <select id="mano" name="mano" required>
            <option value="Diestro" <?= (isset($mano) && $mano === 'Diestro') ? 'selected' : '' ?>>Diestro</option>
            <option value="Zurdo" <?= (isset($mano) && $mano === 'Zurdo') ? 'selected' : '' ?>>Zurdo</option>
        </select>
        <label for="anno_nacimiento">Año de Nacimiento:</label>
        <input type="date" id="anno_nacimiento" name="anno_nacimiento" value="<?= htmlspecialchars($anno_nacimiento ?? '') ?>" required>
        <h2>Títulos</h2>
        <div id="titulos">
            <div class="titulo">
                <label for="anno">Año:</label>
                <input type="number" name="titulos[0][anno]" required>
                <label for="torneo_id">Torneo:</label>
                <select name="titulos[0][torneo_id]" required>
                    <?php foreach ($torneos as $torneo): ?>
                        <option value="<?= $torneo['id'] ?>"><?= htmlspecialchars($torneo['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="button" onclick="agregarTitulo()">Agregar Título</button>
        <button type="submit">Agregar Tenista</button>
    </form>
    <br>
    <form method="POST" action="../logout.php" style="display: inline;">
        <button type="submit">Cerrar Sesión</button>
    </form>
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