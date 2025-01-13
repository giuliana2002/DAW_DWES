<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$archivo_reservas = "reservas_{$usuario}.json";

// Leer el estado actualizado de las reservas desde el archivo del usuario
if (file_exists($archivo_reservas)) {
    $horario_clases = json_decode(file_get_contents($archivo_reservas), true);
} else {
    $horario_clases = [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Reservas - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Reservas Actuales</h1>
    <?php if (!empty($horario_clases)): ?>
        <?php foreach ($horario_clases as $clase => $dias): ?>
            <h2><?php echo ucfirst($clase); ?></h2>
            <ul>
                <?php foreach ($dias as $dia => $detalles): ?>
                    <li>
                        <?php echo ucfirst($dia) . " - " . $detalles['hora'] . " (Reservadas: " . $detalles['plazas_reservadas'] . ", Disponibles: " . $detalles['plazas_disponibles'] . ")"; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay reservas actuales.</p>
    <?php endif; ?>
    <a href="index.php">Volver al Inicio</a>
</body>

</html>