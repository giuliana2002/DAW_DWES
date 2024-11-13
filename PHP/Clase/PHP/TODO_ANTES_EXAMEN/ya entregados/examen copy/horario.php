<?php
session_start();

function inicializar_horarios()
{
    $_SESSION['horarios_clases'] = [
        'yoga' => [
            'lunes' => ['hora' => '19:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
            'miércoles' => ['hora' => '08:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
            'viernes' => ['hora' => '10:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
        ],
        'zumba' => [
            'martes' => ['hora' => '18:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
            'jueves' => ['hora' => '19:30', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
        ],
        'crossfit' => [
            'lunes' => ['hora' => '18:00', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
            'miércoles' => ['hora' => '14:30', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
            'viernes' => ['hora' => '20:30', 'plazas_totales' => 20, 'plazas_disponibles' => 20, 'plazas_reservadas' => 0, 'reservado' => 0],
        ],
    ];
}
function reservar_plaza($clase, $dia)
{
    if (isset($_SESSION['horarios_clase'][$clase][$dia]) && $_SESSION['horarios_clase'][$clase][$dia]['plazas_disponibles'] > 0) {
        --$_SESSION['horarios_clase'][$clase][$dia]['plazas_disponibles'];
        ++$_SESSION['horarios_clase'][$clase][$dia]['plazas_reservadas'];
        $_SESSION['horarios_clase'][$clase][$dia]['reservado'] = 1;
        return true;
    } else {
        return false;
    }
}

function liberar_plaza($clase, $dia)
{
    if (isset($_SESSION['horarios_clase'][$clase][$dia])) {
        ++$_SESSION['horarios_clase'][$clase][$dia]['plazas_disponibles'];
        --$_SESSION['horarios_clase'][$clase][$dia]['plazas_reservadas'];
        $_SESSION['horarios_clase'][$clase][$dia]['reservado'] = 0;
        return true;
    } else {
        return false;
    }
}
