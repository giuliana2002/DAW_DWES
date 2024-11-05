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
        } else {
            echo "<p>Error: El asiento $asiento en el horario $horario ya está reservado para la película {$peliculas[$pelicula_id]['nombre']}.</p>";
            echo "<a href='index.php'>Volver a la tienda</a>";
            exit();
        }
    }

    $_SESSION['reservas'] = $reservas;
    unset($_SESSION['carrito']);
    unset($_SESSION['carrito_timer']);

    file_put_contents('asientos_reservados.txt', $asientos_txt);

    echo "<p>Compra realizada con éxito. Gracias por su compra.</p>";
    echo "<a href='index.php'>Volver a la tienda</a>";
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
    <?php if (!empty($carrito)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Película</th>
                    <th>Asiento (Fila-Asiento)</th>
                    <th>Horario</th>
                    <th>Precio (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $entrada): ?>
                    <tr>
                        <td><?= $peliculas[$entrada['pelicula_id']]['nombre']; ?></td>
                        <td><?= $entrada['asiento']; ?></td>
                        <td><?= $entrada['horario']; ?></td>
                        <td><?= $peliculas[$entrada['pelicula_id']]['precio']; ?>€</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form method="post">
            <button type="submit" name="finalizar_compra">Finalizar Compra</button>
            <button type="submit" name="vaciar_carrito">Vaciar Carrito</button>
        </form>
    <?php else: ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>
    <a href="index.php">Volver a la tienda</a>
</body>

</html>