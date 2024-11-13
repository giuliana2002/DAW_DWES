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

// Leer las reservas actuales desde la sesión
$reservas = $_SESSION['reservas'];

// Procesar la reserva al enviar el formulario
if (isset($_POST['pelicula_id']) && isset($_POST['asiento']) && isset($_POST['horario'])) {
    $pelicula_id = $_POST['pelicula_id'];
    $asiento = $_POST['asiento'];
    $horario = $_POST['horario'];

    if (!isset($reservas[$pelicula_id])) {
        $reservas[$pelicula_id] = [];
    }

    if (!isset($reservas[$pelicula_id][$horario])) {
        $reservas[$pelicula_id][$horario] = [];
    }

    if (!in_array($asiento, $reservas[$pelicula_id][$horario])) {
        $_SESSION['carrito'][] = [
            'pelicula_id' => $pelicula_id,
            'asiento' => $asiento,
            'horario' => $horario
        ];
        $reservas[$pelicula_id][$horario][] = $asiento;
        $_SESSION['reservas'] = $reservas;
        echo "<p>Reserva agregada al carrito: Película {$peliculas[$pelicula_id]['nombre']}, Asiento $asiento, Horario $horario.</p>";
    } else {
        echo "<p>Error: El asiento $asiento en el horario $horario ya está reservado para esta película.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda de Películas</title>
</head>

<body>
    <h2>Selecciona tu Película, Horario y Asiento</h2>
    <form method="post" action="">

        <!-- Selección de Película -->
        <label for="pelicula_id">Película:</label>
        <select name="pelicula_id" id="pelicula_id" required>
            <option value="">Selecciona una película</option>
            <?php foreach ($peliculas as $id => $pelicula): ?>
                <option value="<?= $id; ?>" <?= (isset($_POST['pelicula_id']) && $_POST['pelicula_id'] == $id) ? 'selected' : ''; ?>>
                    <?= $pelicula['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Selección de Horario -->
        <label for="horario">Horario:</label>
        <select name="horario" id="horario" required>
            <option value="">Selecciona un horario</option>
            <?php foreach ($horarios as $hora): ?>
                <option value="<?= $hora; ?>" <?= (isset($_POST['horario']) && $_POST['horario'] == $hora) ? 'selected' : ''; ?>>
                    <?= $hora; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Selección de Asiento -->
        <label for="asiento">Asiento (Fila-Asiento):</label>
        <select name="asiento" id="asiento" required>
            <?php
            // Obtener asientos reservados para la película y horario seleccionados
            $pelicula_id_seleccionada = $_POST['pelicula_id'] ?? null;
            $horario_seleccionado = $_POST['horario'] ?? null;
            $reservas_pelicula_horario = $reservas[$pelicula_id_seleccionada][$horario_seleccionado] ?? [];

            for ($fila = 1; $fila <= $filas; $fila++) {
                for ($asiento_num = 1; $asiento_num <= $columnas; $asiento_num++) {
                    $asiento_combo = "$fila-$asiento_num";
                    // Deshabilitar el asiento si está reservado para la película y horario seleccionados
                    $disabled = in_array($asiento_combo, $reservas_pelicula_horario) ? 'disabled' : '';
            ?>
                    <option value="<?= $asiento_combo; ?>" <?= $disabled; ?>>
                        <?= "Fila $fila - Asiento $asiento_num" . ($disabled ? " (Reservado)" : ""); ?>
                    </option>
            <?php
                }
            }
            ?>
        </select>

        <!-- Botón de reserva -->
        <button type="submit">Reservar Asiento</button>

    </form>

    <a href="carrito.php">Ver Carrito</a>
</body>

</html>