<?php

namespace Dwes\ProyectoVideoclub\Util;

class SoporteYaAlquiladoException extends VideoclubException {
    public function __construct($message = "El soporte ya está alquilado.", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}