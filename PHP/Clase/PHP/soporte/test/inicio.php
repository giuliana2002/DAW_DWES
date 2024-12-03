<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Videoclub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Detalles del Soporte</h1>
    <?php
    include_once __DIR__ . '/../autoload.php';

    use Dwes\ProyectoVideoclub\CintaVideo;
    use Dwes\ProyectoVideoclub\Dvd;
    use Dwes\ProyectoVideoclub\Juego;
    use Dwes\ProyectoVideoclub\Cliente;

    $miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
    echo "<p><strong>" . $miCinta->titulo . "</strong></p>";
    echo "<p>Precio: " . $miCinta->getPrecio() . " euros</p>";
    echo "<p>Precio IVA incluido: " . $miCinta->getPrecioConIVA() . " euros</p>";
    $miCinta->muestraResumen();

    $miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
    echo "<p><strong>" . $miDvd->titulo . "</strong></p>";
    echo "<p>Precio: " . $miDvd->getPrecio() . " euros</p>";
    echo "<p>Precio IVA incluido: " . $miDvd->getPrecioConIVA() . " euros</p>";
    $miDvd->muestraResumen();

    $miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
    echo "<p><strong>" . $miJuego->titulo . "</strong></p>";
    echo "<p>Precio: " . $miJuego->getPrecio() . " euros</p>";
    echo "<p>Precio IVA incluido: " . $miJuego->getPrecioConIVA() . " euros</p>";
    $miJuego->muestraResumen();

    $cliente1 = new Cliente("Bruce Wayne", 23);
    $cliente2 = new Cliente("Clark Kent", 33);

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
    ?>
</div>
</body>
</html>