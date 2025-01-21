<?php
include __DIR__ ."/vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;

$log = new Logger('MiAplicacion');


$log->pushHandler(new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG));


$mailHandler = new NativeMailerHandler(
    'admin@example.com',
    'Error crítico en la app',
    'from@example.com',
    Logger::ERROR
);
$log->pushHandler($mailHandler);

// Ejemplo de mensajes de log
$log->info('Esta es una información general.');
$log->error('Ha ocurrido un error grave.');
