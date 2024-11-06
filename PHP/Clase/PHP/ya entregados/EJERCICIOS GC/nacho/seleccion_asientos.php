<?php
session_start();  // Aquí inicias la sesión

include 'funciones.php';

$pelicula_id = $_GET['pelicula_id'];
$sesion_id = $_GET['sesion_id'];

// Obtener los asientos disponibles para la película y sesión seleccionada
$asientos_disponibles = obtenerAsientosDisponibles($pelicula_id, $sesion_id);

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los asientos seleccionados
    $asientos_seleccionados = $_POST['asientos'];

    // Verificar que los asientos seleccionados estén disponibles
    foreach ($asientos_seleccionados as $asiento) {
        if (!in_array($asiento, $asientos_disponibles)) {
            echo "El asiento $asiento ya está ocupado o no es válido. Por favor, selecciona otros asientos.";
            exit();
        }
    }

    // Guardar los asientos seleccionados en la sesión
    $_SESSION['asientos_seleccionados'] = $asientos_seleccionados;

    // Redirigir al usuario a la página de pago (con headers, sin salida previa)
    header("Location: pago.php?pelicula_id=$pelicula_id&sesion_id=$sesion_id");
    exit();
}

// Mostrar asientos disponibles
echo "<h1>Selecciona tus asientos para la sesión</h1>";
echo "<form method='POST' action='seleccion_asientos.php?pelicula_id=$pelicula_id&sesion_id=$sesion_id'>";

// Mostrar los asientos disponibles como checkboxes
foreach ($asientos_disponibles as $asiento) {
    echo "<label><input type='checkbox' name='asientos[]' value='$asiento'> Asiento $asiento</label><br>";
}

echo "<button type='submit'>Confirmar selección de asientos</button>";
echo "</form>";
?>
