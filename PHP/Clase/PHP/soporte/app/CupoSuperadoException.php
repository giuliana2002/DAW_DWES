<?php

namespace Dwes\ProyectoVideoclub\Util;

class CupoSuperadoException extends VideoclubException {
    public function __construct($message = "No se puede alquilar más soportes. Límite alcanzado.", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}