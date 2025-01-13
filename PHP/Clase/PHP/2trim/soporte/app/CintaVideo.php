<?php

namespace Dwes\ProyectoVideoclub;

class CintaVideo extends Soporte {
    public $duracion;

    public function __construct($titulo, $numero, $precio, $duracion) {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    public function muestraResumen() {
        echo "<br><strong>{$this->titulo}</strong>";
        echo "<br>{$this->precio} € (IVA no incluido)";
        echo "<br>Duración: {$this->duracion} minutos";
    }
}