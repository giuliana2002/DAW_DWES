<?php
// Inicia la sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir archivos esenciales
require_once 'config.php';
require_once 'funciones.php';
require_once 'auth.php';
?>
