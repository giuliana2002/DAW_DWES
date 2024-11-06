<?php
session_start();

// Definición de las películas, filas, columnas y horarios
$peliculas = [
    1 => ['nombre' => 'Venom', 'precio' => 5.5],
    2 => ['nombre' => 'Spiderman No way Home', 'precio' => 5.5],
    3 => ['nombre' => 'Five night`s and Freddy', 'precio' => 5.5],
];

$filas = 5;
$columnas = 6;
$horarios = ["10:00", "14:00", "18:00", "21:00"];

// Inicializar las reservas en la sesión si no existen
if (!isset($_SESSION['reservas'])) {
    $_SESSION['reservas'] = [];
}

// Inicializar el carrito en la sesión si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Leer las reservas actuales desde la sesión
$reservas = $_SESSION['reservas'];

// Procesar la reserva al enviar el formulario
if (isset($_POST['pelicula_id'], $_POST['fila'], $_POST['asiento'], $_POST['horario'], $_POST['sid'])) {
    $pelicula_id = (int)$_POST['pelicula_id'];
    $fila = (int)$_POST['fila'];
    $asiento = (int)$_POST['asiento'];
    $horario = $_POST['horario'];
    $sid = $_POST['sid'];

    if (!isset($reservas[$pelicula_id])) {
        $reservas[$pelicula_id] = [];
    }

    if (!isset($reservas[$pelicula_id][$horario])) {
        $reservas[$pelicula_id][$horario] = [];
    }

    $asiento_str = "F{$fila}A{$asiento}";

    if (!in_array($asiento_str, $reservas[$pelicula_id][$horario])) {
        $_SESSION['carrito'][] = [
            'pelicula_id' => $pelicula_id,
            'fila' => $fila,
            'asiento' => $asiento,
            'horario' => $horario,
            'sid' => $sid
        ];
    } else {
        echo "<p>El asiento $asiento_str ya está reservado para la película seleccionada en el horario $horario.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reserva de Películas</title>
    <link rel="stylesheet" href="CSS1.css">
</head>

<body>
    <h2>Reserva de Películas</h2>
    <form method="post" action="">
        <label for="pelicula_id">Película:</label>
        <select name="pelicula_id" id="pelicula_id">
            <?php foreach ($peliculas as $id => $pelicula): ?>
                <option value="<?= $id; ?>"><?= $pelicula['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="fila">Fila:</label>
        <select name="fila" id="fila">
            <?php for ($i = 1; $i <= $filas; $i++): ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php endfor; ?>
        </select>
        <label for="asiento">Asiento:</label>
        <select name="asiento" id="asiento">
            <?php for ($i = 1; $i <= $columnas; $i++): ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php endfor; ?>
        </select>
        <label for="horario">Horario:</label>
        <select name="horario" id="horario">
            <?php foreach ($horarios as $horario): ?>
                <option value="<?= $horario; ?>"><?= $horario; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="sid" value="<?= session_id(); ?>">
        <button type="submit">Reservar</button>
    </form>
    <a href="carrito.php">Ver Carrito</a>
</body>

</html>