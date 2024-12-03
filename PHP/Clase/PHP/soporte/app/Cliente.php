<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;

class Cliente {
    public $nombre;
    private $numero;
    private $maxAlquilerConcurrente;
    private $numSoportesAlquilados = 0;
    private $soportesAlquilados = [];

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getNumSoportesAlquilados() {
        return $this->numSoportesAlquilados;
    }

    public function tieneAlquilado(Soporte $s) {
        return in_array($s, $this->soportesAlquilados, true);
    }

    public function alquilar(Soporte $s) {
        if ($this->tieneAlquilado($s)) {
            throw new SoporteYaAlquiladoException("El soporte ya está alquilado.");
        }
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("No se puede alquilar más soportes. Límite alcanzado.");
        }
        $this->soportesAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        return $this;
    }

    public function devolver($numSoporte) {
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->numero == $numSoporte) {
                unset($this->soportesAlquilados[$key]);
                $this->numSoportesAlquilados--;
                return $this;
            }
        }
        throw new SoporteNoEncontradoException("El soporte no estaba alquilado.");
    }

    public function listaAlquileres() {
        echo "El cliente {$this->nombre} tiene {$this->numSoportesAlquilados} alquileres:<br>";
        foreach ($this->soportesAlquilados as $soporte) {
            echo "- {$soporte->titulo}<br>";
        }
    }

    public function muestraResumen() {
        echo "Cliente: {$this->nombre}<br>";
        echo "Cantidad de alquileres: {$this->numSoportesAlquilados}<br>";
    }
}