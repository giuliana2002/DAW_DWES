<?php
session_start();

$peliculas = [
    1 => ['nombre' => 'Venom', 'precio' => 5.5],
    2 => ['nombre' => 'Spiderman No way Home', 'precio' => 5.5],
    3 => ['nombre' => 'Five night`s and Freddy', 'precio' => 5.5],
];

$reservas = $_SESSION['reservas'] ?? [];
$carrito = $_SESSION['carrito'] ?? [];

if (!isset($_SESSION['carrito_timer'])) {
    $_SESSION['carrito_timer'] = time();
} elseif (time() - $_SESSION['carrito_timer'] > 6000) {
    unset($_SESSION['carrito']);
    unset($_SESSION['carrito_timer']);
    echo "<p>Tiempo de compra expirado. El carrito ha sido vaciado.</p>";
    echo "<a href='index.php'>Volver a la tienda</a>";
    exit();
}

if (isset($_POST['vaciar_carrito'])) {
    unset($_SESSION['carrito']);
    unset($_SESSION['carrito_timer']);
    echo "<p>Carrito vaciado.</p>";
    echo "<a href='index.php'>Volver a la tienda</a>";
    exit();
}

if (isset($_POST['finalizar_compra'])) {
    $asientos_txt = "Asientos reservados:\n";
    foreach ($carrito as $entrada) {
        $pelicula_id = $entrada['pelicula_id'];
        $asiento = $entrada['asiento'];
        $horario = $entrada['horario'];

        if (!isset($reservas[$pelicula_id])) {
            $reservas[$pelicula_id] = [];
        }

        if (!isset($reservas[$pelicula_id][$horario])) {
            $reservas[$pelicula_id][$horario] = [];
        }

        if (!in_array($asiento, $reservas[$pelicula_id][$horario])) {
            $reservas[$pelicula_id][$horario][] = $asiento;
            $asientos_txt .= "Película: {$peliculas[$pelicula_id]['nombre']}, Asiento: $asiento, Horario: $horario\n";
        }
    }

    $_SESSION['reservas'] = $reservas;
    unset($_SESSION['carrito']);
    unset($_SESSION['carrito_timer']);

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="entradas.txt"');
    echo $asientos_txt;
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>

<body>
    <h2>Carrito de Compras</h2>
    <?php if (empty($carrito)): ?>
        <p>El carrito está vacío.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($carrito as $entrada): ?>
                <li>
                    Película: <?= $peliculas[$entrada['pelicula_id']]['nombre']; ?>,
                    Asiento: <?= $entrada['asiento']; ?>,
                    Horario: <?= $entrada['horario']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" action="">
            <button type="submit" name="vaciar_carrito">Vaciar Carrito</button>
            <button type="submit" name="finalizar_compra">Finalizar Compra</button>
        </form>
    <?php endif; ?>
    <a href="index.php">Volver a la tienda</a>
</body>

</html>