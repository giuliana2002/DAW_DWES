<?php
session_start();

function verificarSesion() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../login.php');
        exit;
    }
}

function iniciarSesion($usuario) {
    $_SESSION['usuario'] = $usuario;
}

function cerrarSesion() {
    session_destroy();
    header('Location: ../login.php');
    exit;
}