<?php
$database = [
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "db" => "dwes_manana_tenistas"
];

function conectarDB() {
    global $database; // Usar las configuraciones globales

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
?>
