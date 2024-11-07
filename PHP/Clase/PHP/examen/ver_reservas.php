<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
include 'horario.php';
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
    <a href="index.php">Volver al Inicio</a>
</body>

</html>