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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenido al Gimnasio</h1>
    <a href="main.php">Ir a la Página Principal</a>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Principal - Gimnasio</title>
</head>
<body>
    <h1>Bienvenido a la Gestión de Clases</h1>
    <a href="clases.php">Seleccionar Clases</a>
    <a href="index.php">Volver al Inicio</a>
</body>
</html>
<?php
// Matriz global de clases y horarios
$horario_clases = [
    'yoga' => [
        'lunes' => ['hora' => '19:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
        'miércoles' => ['hora' => '08:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
        'viernes' => ['hora' => '10:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
    ],
    'zumba' => [
        'martes' => ['hora' => '18:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
        'jueves' => ['hora' => '19:30', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
    ],
    'crossfit' => [
        'lunes' => ['hora' => '18:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
        'miércoles' => ['hora' => '14:30', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
        'viernes' => ['hora' => '20:30', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0],
    ],
];

// Función para reservar plaza
function reservar_plaza($clase, $dia) {
    global $horario_clases;
    if ($horario_clases[$clase][$dia]['plazas_disponibles'] > 0) {
        $horario_clases[$clase][$dia]['plazas_disponibles']--;
        $horario_clases[$clase][$dia]['plazas_reservadas']++;
        return true;
    }
    return false;
}

// Función para liberar plaza
function liberar_plaza($clase, $dia) {
    global $horario_clases;
    if ($horario_clases[$clase][$dia]['plazas_reservadas'] > 0) {
        $horario_clases[$clase][$dia]['plazas_disponibles']++;
        $horario_clases[$clase][$dia]['plazas_reservadas']--;
        return true;
    }
    return false;
}
?>
<?php
include 'horario.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clases - Gimnasio</title>
</head>
<body>
    <h1>Reservar o Cancelar Clase</h1>
    <form action="procesar_formulario.php" method="post">
        <label>Clase:
            <select name="clase">
                <option value="yoga">Yoga</option>
                <option value="zumba">Zumba</option>
                <option value="crossfit">CrossFit</option>
            </select>
        </label>
        <label>Día:
            <select name="dia">
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miércoles">Miércoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
            </select>
        </label>
        <input type="submit" name="accion" value="Reservar">
        <input type="submit" name="accion" value="Liberar">
    </form>
    <p>Para más información sobre las clases, consulta el <a href="catalogo.html">Catálogo de Actividades</a>.</p>
</body>
</html>
<?php
include 'horario.php';

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

    // Generar archivo de confirmación
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
</head>
<body>
    <h1>Resultado de la Operación</h1>
    <p><?php echo nl2br(htmlspecialchars($resultado)); ?></p>
    <a href="main.php">Volver a la Página Principal</a> |
    <a href="confirmacion.txt" download>Descargar Confirmación</a>
</body>
</html>
