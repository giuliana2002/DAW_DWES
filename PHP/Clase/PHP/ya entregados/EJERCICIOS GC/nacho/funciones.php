<?php
// Elimina session_start() de este archivo. 
// Ya se llama en el archivo principal de cada página que lo necesite.
 
// Inicializar los asientos ocupados si no están ya definidos en la sesión
if (!isset($_SESSION['asientos_ocupados'])) {
    $_SESSION['asientos_ocupados'] = [
        1 => [],  // Sesión 1
        2 => [],  // Sesión 2
        3 => [],  // Sesión 3
        4 => [],  // Sesión 4
        5 => [],  // Sesión 5
        6 => [],  // Sesión 6
        7 => [],  // Sesión 7
        8 => [],  // Sesión 8
        9 => []   // Sesión 9
    ];
}

// Función para obtener las sesiones de una película
function obtenerSesiones($pelicula_id) {
    $sesiones = [
        1 => [['id' => 1, 'hora' => '10:00 AM'], ['id' => 2, 'hora' => '1:00 PM'], ['id' => 3, 'hora' => '5:00 PM']],
        2 => [['id' => 4, 'hora' => '11:00 AM'], ['id' => 5, 'hora' => '2:00 PM'], ['id' => 6, 'hora' => '6:00 PM']],
        3 => [['id' => 7, 'hora' => '12:00 PM'], ['id' => 8, 'hora' => '3:00 PM'], ['id' => 9, 'hora' => '7:00 PM']],
    ];
    return $sesiones[$pelicula_id];
}

// Función para obtener los asientos ocupados para una sesión
function obtenerAsientosOcupados($sesion_id) {
    return isset($_SESSION['asientos_ocupados'][$sesion_id]) ? $_SESSION['asientos_ocupados'][$sesion_id] : [];
}

// Función para obtener los asientos disponibles para una sesión
function obtenerAsientosDisponibles($pelicula_id, $sesion_id) {
    $asientos = [];
    // Creamos una lista de 30 asientos (5 filas de 6 asientos)
    for ($i = 1; $i <= 30; $i++) {
        $asientos[] = $i;
    }

    // Obtenemos los asientos ocupados para la sesión seleccionada
    $ocupados = obtenerAsientosOcupados($sesion_id);

    // Filtramos los asientos ocupados
    return array_diff($asientos, $ocupados);
}

// Función para calcular el total
function calcularTotal($asientos) {
    return count($asientos) * 10;  // 10 por asiento
}

// Función para obtener el nombre de una película
function obtenerPelicula($pelicula_id): string {
    $peliculas = [
        'Piratas del caribe',
        'Toy story',
        'Sharknado'
    ];
    return $peliculas[$pelicula_id - 1];  // Ajustamos el índice para acceder correctamente
}

// Función para obtener una sesión
function obtenerSesion($sesion_id) {
    $sesiones = [
        1 => '10:00 AM',
        2 => '1:00 PM',
        3 => '5:00 PM',
        4 => '11:00 AM',
        5 => '2:00 PM',
        6 => '6:00 PM',
        7 => '12:00 PM',
        8 => '3:00 PM',
        9 => '7:00 PM',
    ];
    return $sesiones[$sesion_id];
}

// Función para actualizar los asientos ocupados después de una compra
function actualizarAsientosOcupados($sesion_id, $asientos_seleccionados) {
    // Actualizamos los asientos ocupados en la sesión actual
    $_SESSION['asientos_ocupados'][$sesion_id] = array_merge(
        $_SESSION['asientos_ocupados'][$sesion_id],
        $asientos_seleccionados
    );
}
?>
