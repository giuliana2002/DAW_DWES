<?php
session_start();
require_once 'utiles/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Aquí va la lógica para validar el usuario desde la base de datos
    // Ejemplo básico (ajustar para tu entorno)
    if ($usuario === 'admin' && $password === 'adminpass') {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = 'admin';
        header('Location: /ejercicio_01/listado_tenistas.php');
    } elseif ($usuario === 'user' && $password === 'userpass') {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = 'user';
        header('Location: /ejercicio_01/listado_tenistas.php');
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <form method="post" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar sesión</button>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</div>
</body>
</html>