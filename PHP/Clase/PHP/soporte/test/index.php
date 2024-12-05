<?php
include_once __DIR__ . '/../autoload.php';

use Dwes\ProyectoVideoclub\login;
use Dwes\ProyectoVideoclub\logout;
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<form action="../app/login.php" method="post">
    <label for="user">Usuario:</label>
    <input type="text" id="user" name="user" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>
</body>
</html>