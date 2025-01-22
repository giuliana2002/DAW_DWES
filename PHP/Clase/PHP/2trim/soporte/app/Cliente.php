<?php

namespace Dwes\ProyectoVideoclub;


use Dwes\ProyectoVideoclub\Util\LogFactory;

class Cliente {
    private $nombre;
    private $numero;
    private $maxAlquilerConcurrente;
    private $logger;

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        $this->logger = LogFactory::createLogger();
    }

    public function alquilar(Soporte $soporte) {
        $this->logger->info("Producto alquilado", ['cliente' => $this->nombre, 'producto' => $soporte->titulo]);
    }

    public function devolver($numProducto) {

        $this->logger->info("Producto devuelto", ['cliente' => $this->nombre, 'producto' => $numProducto]);
    }

    public function muestraResumen() {
        echo "Cliente: $this->nombre, Número: $this->numero, Máximo alquiler concurrente: $this->maxAlquilerConcurrente\n";
    }
}