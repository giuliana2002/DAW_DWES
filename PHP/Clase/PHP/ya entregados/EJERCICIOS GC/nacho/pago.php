<?php
session_start();  // Iniciar la sesión

include 'funciones.php';

// Verificar el temporizador de inactividad
if (!isset($_SESSION['pago_timer'])) {
    $_SESSION['pago_timer'] = time();
} elseif (time() - $_SESSION['pago_timer'] > 60) { // 60 segundos de inactividad
    unset($_SESSION['carrito']);
    unset($_SESSION['pago_timer']);
    echo "<p>Tiempo de compra expirado. El carrito ha sido vaciado.</p>";
    echo "<a href='index.php'>Volver a la tienda</a>";
    exit();
} else {
    // Actualizar el temporizador de inactividad
    $_SESSION['pago_timer'] = time();
}

// Obtener los datos de la película y sesión seleccionada
$pelicula_id = $_GET['pelicula_id'];
$sesion_id = $_GET['sesion_id'];
$asientos_seleccionados = $_SESSION['asientos_seleccionados'] ?? [];

// Calcular el total a pagar
$total = calcularTotal($asientos_seleccionados);

// Verificar si el formulario de pago fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el pago (simulación)
    echo "<p>Pago realizado con éxito. Gracias por su compra.</p>";
    unset($_SESSION['carrito']);
    unset($_SESSION['pago_timer']);
    exit();
}

// Mostrar el formulario de pago
echo "<h1>Pagar</h1>";
echo "<p>Película: " . obtenerPelicula($pelicula_id) . "</p>";
echo "<p>Sesión: " . obtenerSesion($sesion_id) . "</p>";
echo "<p>Asientos: " . implode(', ', $asientos_seleccionados) . "</p>";
echo "<p>Total a pagar: $total €</p>";
echo "<form method='POST' action='pago.php?pelicula_id=$pelicula_id&sesion_id=$sesion_id'>";
echo "<button type='submit'>Realizar Pago</button>";
echo "</form>";
?>