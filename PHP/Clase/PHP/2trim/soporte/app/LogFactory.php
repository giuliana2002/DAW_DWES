<?php

namespace Dwes\ProyectoVideoclub\Util;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

class LogFactory {
    public static function createLogger(): LoggerInterface {
        $logger = new Logger('VideoclubLogger');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/videoclub.log', Logger::DEBUG));
        return $logger;
    }
}