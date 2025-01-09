<?php
session_start();

$usuarios = array(
    'admin' => 'admin',
    'usuario' => 'usuario',
    'maxigiu' => 'maxigiu'
);

if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $contrasena) {
        $_SESSION['usuario'] = $usuario;
        header('Location: main.php');
        exit;
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
