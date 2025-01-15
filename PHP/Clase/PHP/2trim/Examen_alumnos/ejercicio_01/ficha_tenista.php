<?php
require '../utiles/init.php';

if (!verificarSesionActiva()) {
    header('Location: login.php');
    exit;
}

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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Ficha del Tenista</title>
</head>
<body>
<div class="contenedor">
    <h1>Ficha del Tenista</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($tenista['nombre']) ?></p>
    <p><strong>Apellidos:</strong> <?= htmlspecialchars($tenista['apellidos']) ?></p>
    <p><strong>Altura:</strong> <?= $tenista['altura'] ?> cm</p>
    <p><strong>Mano:</strong> <?= htmlspecialchars($tenista['mano']) ?></p>
    <p><strong>Año de Nacimiento:</strong> <?= $tenista['anno_nacimiento'] ?></p>
    <a href="listado_tenistas.php" class="estilo_enlace">Volver al Listado</a>
</div>
</body>
</html>