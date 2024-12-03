<?php

namespace Dwes\ProyectoVideoclub;

class Videoclub {
    private $nombre;
    private $productos = [];
    private $socios = [];

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function incluirJuego($titulo, $precio, $consola, $minJugadores, $maxJugadores) {
        $juego = new Juego($titulo, count($this->productos), $precio, $consola, $minJugadores, $maxJugadores);
        $this->incluirProducto($juego);
    }

    public function incluirDvd($titulo, $precio, $idiomas, $formatoPantalla) {
        $dvd = new Dvd($titulo, count($this->productos), $precio, $idiomas, $formatoPantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirCintaVideo($titulo, $precio, $duracion) {
        $cinta = new CintaVideo($titulo, count($this->productos), $precio, $duracion);
        $this->incluirProducto($cinta);
    }

    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
        echo "Incluido soporte " . (count($this->productos) - 1) . "<br>";
    }

    public function listarProductos() {
        echo "Listado de los " . count($this->productos) . " productos disponibles:<br>";
        foreach ($this->productos as $producto) {
            echo ($producto->numero + 1) . ".- ";
            $producto->muestraResumen();
            echo "<br>";
        }
    }

    public function incluirSocio($nombre, $maxAlquileres = 3) {
        $socio = new Cliente($nombre, count($this->socios), $maxAlquileres);
        $this->socios[] = $socio;
        echo "Incluido socio " . (count($this->socios) - 1) . "<br>";
    }

    public function alquilaSocioProducto($numSocio, $numProducto) {
        if (isset($this->socios[$numSocio]) && isset($this->productos[$numProducto])) {
            $this->socios[$numSocio]->alquilar($this->productos[$numProducto]);
        } else {
            echo "Socio o producto no encontrado.<br>";
        }
    }

    public function listarSocios() {
        echo "Listado de " . count($this->socios) . " socios del videoclub:<br>";
        foreach ($this->socios as $socio) {
            echo ($socio->getNumero() + 1) . ".- Cliente " . $socio->getNumero() . ": " . $socio->nombre . "<br>";
            echo "Alquileres actuales: " . $socio->getNumSoportesAlquilados() . "<br>";
        }
    }
}