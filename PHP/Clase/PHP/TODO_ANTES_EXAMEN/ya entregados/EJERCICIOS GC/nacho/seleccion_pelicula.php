<?php
include 'funciones.php';

if (!isset($_GET['pelicula_id'])) {
    echo "No se ha seleccionado una película. Regresa a la página principal.";
    exit();
}

$pelicula_id = $_GET['pelicula_id'];  // Obtener el ID de la película seleccionada
// Obtener las sesiones disponibles para la película seleccionada
$sesiones = obtenerSesiones($pelicula_id);

// Mostrar las sesiones disponibles
echo "<h1>Selecciona una sesión para la película</h1>";
foreach ($sesiones as $sesion) {
    echo "<p><a href='seleccion_asientos.php?pelicula_id=$pelicula_id&sesion_id=" . $sesion['id'] . "'>Sesión " . $sesion['hora'] . "</a></p>";
}
?>
