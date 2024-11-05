<?php

session_start();

if (isset($_POST['finalizar_compra'])) {
    unset($_SESSION['carrito']);
    echo "<p>Compra realizada con éxito. Gracias por su compra.</p>";
    echo "<a href='index.php'>Volver a la tienda</a>";
    exit();
}

if (isset($_POST['vaciar_carrito'])) {
    unset($_SESSION['carrito']);
    echo "<p>Carrito vaciado.</p>";
    echo "<a href='index.php'>Volver a la tienda</a>";
    exit();
}

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row {
            font-weight: bold;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .empty-cart {
            background-color: #dc3545;
        }

        .empty-cart:hover {
            background-color: #c82333;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .volver {
            background-color: #007bff;
        }

        .volver:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Carrito de Compras</h1>

        <?php if (empty($carrito)): ?>
            <p>Tu carrito está vacío.</p>
            <a href="index.php">Volver a la tienda</a>
        <?php else: ?>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
                <?php $total = 0; ?>
                <?php foreach ($carrito as $producto): ?>
                    <tr>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo number_format($producto['precio'], 2, ',', '.') . ' €'; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td><?php echo number_format($producto['precio'] * $producto['cantidad'], 2, ',', '.') . ' €'; ?></td>
                    </tr>
                    <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td><?php echo number_format($total, 2, ',', '.') . ' €'; ?></td>
                </tr>
            </table>

            <div class="buttons">
                <form method="POST">
                    <button type="submit" name="vaciar_carrito" class="empty-cart">Vaciar Carrito</button>
                    <button type="submit" name="finalizar_compra">Finalizar Compra</button>
                    <button type="submit" href="index.php">Volver a la tienda</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>