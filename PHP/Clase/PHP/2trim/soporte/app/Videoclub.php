<?php

namespace Dwes\ProyectoVideoclub;


use Dwes\ProyectoVideoclub\Util\LogFactory;

class Videoclub {
    private $nombre;
    private $productos = [];
    private $socios = [];
    private $numProductosAlquilados = 0;
    private $numTotalAlquileres = 0;
    private $logger;

    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->logger = LogFactory::createLogger();
    }

    public function incluirJuego($titulo, $numero, $precio, $consola, $minJ, $maxJ) {
        $this->productos[] = new Juego($titulo, $numero, $precio, $consola, $minJ, $maxJ);
        $this->logger->info("Juego incluido", ['titulo' => $titulo]);
    }

    public function incluirDvd($titulo, $numero, $precio, $idiomas, $pantalla) {
        $this->productos[] = new Dvd($titulo, $numero, $precio, $idiomas, $pantalla);
        $this->logger->info("DVD incluido", ['titulo' => $titulo]);
    }

    public function incluirCintaVideo($titulo, $numero, $precio, $duracion) {
        $this->productos[] = new CintaVideo($titulo, $numero, $precio, $duracion);
        $this->logger->info("Cinta de video incluida", ['titulo' => $titulo]);
    }

    public function incluirSocio($nombre, $maxAlquilerConcurrente = 3) {
        $this->socios[] = new Cliente($nombre, count($this->socios) + 1, $maxAlquilerConcurrente);
        $this->logger->info("Socio incluido", ['nombre' => $nombre]);
    }

    public function alquilarSocioProductos($numSocio, $numerosProductos) {
        $socio = $this->socios[$numSocio - 1] ?? null;
        if (!$socio) {
            $this->logger->warning("Cliente no encontrado", ['numSocio' => $numSocio]);
            throw new ClienteNoEncontradoException("Cliente no encontrado.");
        }

        foreach ($numerosProductos as $numProducto) {
            $producto = $this->productos[$numProducto - 1] ?? null;
            if (!$producto || $producto->alquilado) {
                $this->logger->warning("Producto no disponible", ['numProducto' => $numProducto]);
                throw new SoporteYaAlquiladoException("Uno o más productos no están disponibles.");
            }
        }

        foreach ($numerosProductos as $numProducto) {
            $producto = $this->productos[$numProducto - 1];
            $socio->alquilar($producto);
            $producto->alquilado = true;
            $this->numProductosAlquilados++;
            $this->numTotalAlquileres++;
            $this->logger->info("Producto alquilado", ['numSocio' => $numSocio, 'numProducto' => $numProducto]);
        }
    }

    public function devolverSocioProducto($numSocio, $numProducto) {
        $socio = $this->socios[$numSocio - 1] ?? null;
        if (!$socio) {
            $this->logger->warning("Cliente no encontrado", ['numSocio' => $numSocio]);
            throw new ClienteNoEncontradoException("Cliente no encontrado.");
        }

        $producto = $this->productos[$numProducto - 1] ?? null;
        if (!$producto || !$producto->alquilado) {
            $this->logger->warning("Producto no estaba alquilado", ['numProducto' => $numProducto]);
            throw new SoporteNoEncontradoException("El soporte no estaba alquilado.");
        }

        $socio->devolver($numProducto);
        $producto->alquilado = false;
        $this->numProductosAlquilados--;
        $this->logger->info("Producto devuelto", ['numSocio' => $numSocio, 'numProducto' => $numProducto]);
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