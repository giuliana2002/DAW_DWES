<h1>CINES NACHO</h1>

<?php
include 'funciones.php';
// Simulación de las películas y sesiones disponibles
$peliculas = [
    ['id' => 1, 'nombre' => 'Piratas del caribe'],
    ['id' => 2, 'nombre' => 'Toy story'],
    ['id' => 3, 'nombre' => 'Sharknado']
];

// Mostrar las películas
echo "<h1>Bienvenido al Cine</h1>";
echo "<h2>Selecciona una película</h2>";
foreach ($peliculas as $pelicula) {
    echo "<p><a href='seleccion_pelicula.php?pelicula_id=" . $pelicula['id'] . "'>" . $pelicula['nombre'] . "</a></p>";
}
?>

