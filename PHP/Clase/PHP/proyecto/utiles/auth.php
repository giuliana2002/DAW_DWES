<?php
function verificarSesionActiva()
{
    return isset($_SESSION['usuario']);
}

function cerrarSesion()
{
    session_unset();
    session_destroy();
}

function iniciarSesion($usuario)
{
    $_SESSION['usuario'] = $usuario;
}
?>
