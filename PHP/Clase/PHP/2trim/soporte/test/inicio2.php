<?php
include_once __DIR__ . '/../autoload.php';

use Dwes\ProyectoVideoclub\CintaVideo;
use Dwes\ProyectoVideoclub\Dvd;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Cliente;

$cliente1 = new Cliente("Bruce Wayne", 23, 3);
$cliente2 = new Cliente("Clark Kent", 33, 3);

echo "<br>El identificador del cliente 1 es: " . $cliente1->getNumero();
echo "<br>El identificador del cliente 2 es: " . $cliente2->getNumero();

$soporte1 = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
$soporte2 = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
$soporte3 = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
$soporte4 = new Dvd("El Imperio Contraataca", 4, 3, "es,en","16:9");

$cliente1->alquilar($soporte1)
    ->alquilar($soporte2)
    ->alquilar($soporte3)
    ->alquilar($soporte1)
    ->alquilar($soporte4)
    ->devolver(4)
    ->devolver(26)
    ->alquilar($soporte4)
    ->listaAlquileres();

$cliente2->devolver(2);
