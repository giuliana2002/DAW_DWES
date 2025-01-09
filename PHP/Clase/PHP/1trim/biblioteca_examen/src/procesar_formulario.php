<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
include 'horario.php';

$usuario = $_SESSION['usuario'];
$archivo_reservas = "reservas_{$usuario}.json";

// Leer el estado actual de las reservas del archivo del usuario
if (file_exists($archivo_reservas)) {
    $horario_clases = json_decode(file_get_contents($archivo_reservas), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clase'], $_POST['dia'], $_POST['accion'])) {
    $clase = $_POST['clase'];
    $dia = $_POST['dia'];
    $accion = $_POST['accion'];
    $resultado = "";

    if ($accion === "Reservar") {
        if (reservar_plaza($clase, $dia)) {
            $resultado = "Reserva confirmada para $clase el $dia a las " . $horario_clases[$clase][$dia]['hora'] . ".";
        } else {
            $resultado = "No hay plazas disponibles para $clase el $dia.";
        }
    } elseif ($accion === "Liberar") {
        if (liberar_plaza($clase, $dia)) {
            $resultado = "Reserva cancelada para $clase el $dia.";
        } else {
            $resultado = "No hay reservas activas para $clase el $dia.";
        }
    }

    // Guardar el estado actualizado de las reservas en el archivo del usuario
    file_put_contents($archivo_reservas, json_encode($horario_clases));

    $confirmacion = "Clase: $clase\nDía: $dia\nHora: " . $horario_clases[$clase][$dia]['hora'] . "\nPlazas Totales: " . $horario_clases[$clase][$dia]['plazas_totales'] . "\nPlazas Disponibles: " . $horario_clases[$clase][$dia]['plazas_disponibles'] . "\nPlazas Reservadas: " . $horario_clases[$clase][$dia]['plazas_reservadas'];
    file_put_contents("confirmacion.txt", $confirmacion);
} else {
    $resultado = "Por favor, seleccione una clase y un día.";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Procesar Selección - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Resultado de la Operación</h1>
    <p><?php echo nl2br(htmlspecialchars($resultado)); ?></p>
    <a href="main.php">Volver a la Página Principal</a> |
    <a href="confirmacion.txt" download>Descargar Confirmación</a>
</body>

</html>