<?php

namespace Dwes\ProyectoVideoclub;

class Dvd extends Soporte {
    public $idiomas;
    public $formatoPantalla;

    public function __construct($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen() {
        echo "<br><strong>{$this->titulo}</strong>";
        echo "<br>{$this->precio} € (IVA no incluido)";
        echo "<br>Idiomas: {$this->idiomas}";
        echo "<br>Formato Pantalla: {$this->formatoPantalla}";
    }
}