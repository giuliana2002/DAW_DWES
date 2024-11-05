<?php

session_start();

$productos = [
    1 => ['nombre' => 'Teclado mecanico', 'precio' => 200],
    2 => ['nombre' => 'Monitor 24 pulgadas 4k', 'precio' => 250],
    3 => ['nombre' => 'Raton Razer', 'precio' => 70],
];

if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = [
            'nombre' => $productos[$producto_id]['nombre'],
            'precio' => $productos[$producto_id]['precio'],
            'cantidad' => $cantidad,
        ];
    }

    echo "<p>Producto añadido al carrito</p>";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="styleindex.css">
</head>

<body>

    <div class="container">
        <h1>Lista de Productos</h1>

        <?php foreach ($productos as $id => $producto): ?>
            <div class="product">
                <p><strong><?php echo $producto['nombre']; ?></strong> - <?php echo number_format($producto['precio'], 2, ',', '.') . ' €'; ?></p>
                <form method="POST">
                    <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" value="1" min="1">
                    <button type="submit">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; ?>

        <hr>

        <a class="cart-link" href="carrito.php">Ver Carrito</a>
    </div>

</body>

</html>