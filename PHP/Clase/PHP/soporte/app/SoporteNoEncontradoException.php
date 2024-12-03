<?php

namespace Dwes\ProyectoVideoclub\Util;

class SoporteNoEncontradoException extends VideoclubException {
    public function __construct($message = "El soporte no estaba alquilado.", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}