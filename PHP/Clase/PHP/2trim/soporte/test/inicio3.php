<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dwes\ProyectoVideoclub\Videoclub;

$vc = new Videoclub("Severo 8A");

$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1, 4);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1, 34);
$vc->incluirDvd("Torrente", 4.5, "es", "16:9", 23);
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9", 24);
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en", "16:9", 4);
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107, 23);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140, 25);

$vc->listarProductos();

$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);

try {
    $vc->alquilarSocioProductos(1, [2]);
    $vc->alquilarSocioProductos(1, [3]);
    $vc->alquilarSocioProductos(1, [2]);
    $vc->alquilarSocioProductos(1, [6]);

    $vc->devolverSocioProducto(1, 1);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

$vc->listarSocios();