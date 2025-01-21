<?php

use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;

class HolaMonolog {
    private $miLog;
    private $hora;

    public function __construct($hora) {
        // Creamos un logger llamado 'miLog' donde guardaremos los mensajes
        $this->miLog = new Logger('miLog');
        $this->miLog->pushHandler(new RotatingFileHandler(__DIR__ . '/../logs/miLog.log', 10, 300));
        $this->miLog->pushHandler(new StreamHandler('php://stderr', 100));
        $this->miLog->pushProcessor(new IntrospectionProcessor());

        $this->hora = $hora;
        if ($hora < 0 || $hora > 24) {
            $this->miLog->warning('Hora no válida: ' . $hora);
        }
    }

    // Funcion para saludar segun hora
    public function saludar() {
        if ($this->hora >= 0 && $this->hora < 12) {
            $this->miLog->info('Buenos días');
        } elseif ($this->hora >= 12 && $this->hora < 18) {
            $this->miLog->info('Buenas tardes');
        } else {
            $this->miLog->info('Buenas noches');
        }
    }

    // Funcion para despedir segun hora
    public function despedir() {
        if ($this->hora >= 0 && $this->hora < 12) {
            $this->miLog->info('Hasta luego, que tengas un buen día');
        } elseif ($this->hora >= 12 && $this->hora < 18) {
            $this->miLog->info('Hasta luego, que tengas una buena tarde');
        } else {
            $this->miLog->info('Hasta mañana, que tengas una buena noche');
        }
    }
}