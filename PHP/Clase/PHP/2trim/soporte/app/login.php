<?php
namespace Dwes\ProyectoVideoclub;
session_start();

$users = [
    'admin' => 'admin',
    'usuario' => 'usuario'
];

$user = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';

if (isset($users[$user]) && $users[$user] === $password) {
    $_SESSION['user'] = $user;
    if ($user === 'admin') {
        header('Location: ../test/mainAdmin.php');
        exit();
    } else {
        header('Location: ../test/mainCliente.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Usuario o contraseña incorrectos';
    header('Location: ../test/indexx.php');
}
exit();
