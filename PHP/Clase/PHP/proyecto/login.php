<?php
require 'utiles/init.php'; // Centraliza `session_start` y las inclusiones de archivos esenciales

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = limpiarEntrada($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario && $password) {
        // Consulta para verificar el usuario
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE user = ?");
        if (!$stmt) {
            die("Error en la consulta: " . $conexion->error);
        }

        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuarioData = $resultado->fetch_assoc();

            // Comparación en texto plano
            if ($password === $usuarioData['password']) {
                iniciarSesion($usuario);
                header('Location: ejercicio_01/listado_tenistas.php');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Iniciar Sesión</title>
</head>
<body>
<div class="contenedor">
    <h1>Iniciar Sesión</h1>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>
