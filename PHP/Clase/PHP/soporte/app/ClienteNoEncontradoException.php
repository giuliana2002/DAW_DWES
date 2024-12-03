<?php

namespace Dwes\ProyectoVideoclub\Util;

class ClienteNoEncontradoException extends VideoclubException {
    public function __construct($message = "Cliente no encontrado.", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}