<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException;

class Videoclub {
    private $nombre;
    private $productos = [];
    private $socios = [];
    private $numProductosAlquilados = 0;
    private $numTotalAlquileres = 0;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function getNumProductosAlquilados() {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres() {
        return $this->numTotalAlquileres;
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ) {
        $this->productos[] = new Juego($titulo, $numero, $precio, $consola, $minJ, $maxJ);
    }

    public function incluirDvd($titulo, $precio, $idiomas, $pantalla) {
        $this->productos[] = new Dvd($titulo, $numero, $precio, $idiomas, $pantalla);
    }

    public function incluirCintaVideo($titulo, $precio, $duracion) {
        $this->productos[] = new CintaVideo($titulo, $numero, $precio, $duracion);
    }

    public function incluirSocio($nombre, $maxAlquilerConcurrente = 3) {
        $this->socios[] = new Cliente($nombre, count($this->socios) + 1, $maxAlquilerConcurrente);
    }

    public function alquilarSocioProductos($numSocio, $numerosProductos) {
        $socio = $this->socios[$numSocio - 1] ?? null;
        if (!$socio) {
            throw new ClienteNoEncontradoException("Cliente no encontrado.");
        }

        foreach ($numerosProductos as $numProducto) {
            $producto = $this->productos[$numProducto - 1] ?? null;
            if (!$producto || $producto->alquilado) {
                throw new SoporteYaAlquiladoException("Uno o más productos no están disponibles.");
            }
        }

        foreach ($numerosProductos as $numProducto) {
            $producto = $this->productos[$numProducto - 1];
            $socio->alquilar($producto);
            $producto->alquilado = true;
            $this->numProductosAlquilados++;
            $this->numTotalAlquileres++;
        }
    }

    public function listarProductos() {
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
        }
    }

    public function listarSocios() {
        foreach ($this->socios as $socio) {
            $socio->muestraResumen();
        }
    }
}