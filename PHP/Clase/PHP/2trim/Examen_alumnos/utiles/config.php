<?php
$database = [
    "host" => "localhost",
    "username" => "dwes_manana",
    "password" => "dwes_2024",
    "db" => "dwes_manana_tenistas"
];

function conectarDB() {
    global $database;

    $conexion = new mysqli(
        $database['host'], 
        $database['username'], 
        $database['password'], 
        $database['db']
    );

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

