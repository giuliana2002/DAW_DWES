<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Daw\prueba\Test;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('C:/Users/DAW_M/Documents/DAW_DWES/PHP/Clase/ya entregados/prueba/your.log', Level::Warning));

// add records to the log
$log->warning('Foo');
$log->error('Bar');
