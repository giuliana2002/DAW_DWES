<?php

namespace Dwes\ProyectoVideoclub;

abstract class Soporte implements Resumible {
    public $titulo;
    public $numero;
    public $precio;
    private static $IVA = 0.21;
    public $alquilado = false;

    public function __construct($titulo, $numero, $precio) {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPrecioConIVA() {
        return $this->precio * (1 + self::$IVA);
    }

    abstract public function muestraResumen();
}