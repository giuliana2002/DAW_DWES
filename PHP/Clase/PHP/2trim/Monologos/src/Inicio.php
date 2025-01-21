<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/HolaMonolog.php';

$logger = new HolaMonolog(10);
$logger->saludar();
$logger->despedir();

$logger = new HolaMonolog(15);
$logger->saludar();
$logger->despedir();

$logger = new HolaMonolog(22);
$logger->saludar();
$logger->despedir();

$logger = new HolaMonolog(25);