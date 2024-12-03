<?php

namespace Dwes\ProyectoVideoclub;

class Juego extends Soporte {
    public $consola;
    public $minNumJugadores;
    public $maxNumJugadores;

    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores) {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraJugadoresPosibles() {
        if ($this->minNumJugadores == $this->maxNumJugadores) {
            if ($this->minNumJugadores == 1) {
                echo "Para un jugador";
            } else {
                echo "Para {$this->minNumJugadores} jugadores";
            }
        } else {
            echo "De {$this->minNumJugadores} a {$this->maxNumJugadores} jugadores";
        }
    }

    public function muestraResumen() {
        echo "<br><strong>{$this->titulo}</strong>";
        echo "<br>{$this->precio} € (IVA no incluido)";
        echo "<br>Juego para: {$this->consola}";
        echo "<br>";
        $this->muestraJugadoresPosibles();
    }
}