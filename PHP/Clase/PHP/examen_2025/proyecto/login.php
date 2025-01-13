<?php
session_start();
$database = [
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "db" => "dwes_manana_tenistas"
];
// Conexión a la base de datos
$conn = new mysqli($database['host'], $database['username'], $database['password'], $database['db']);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Preparar y ejecutar la consulta para buscar al usuario
    $stmt = $conn->prepare("SELECT password, rol FROM usuarios WHERE user = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $rol);
    $stmt->fetch();
    $stmt->close();

    // Verificar si se encontró el usuario
    if ($hashed_password) {
        // Comparar el hash de la contraseña ingresada con la almacenada
        if (hash('sha1', $password) === trim($hashed_password, '*')) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $rol;
            header('Location: ../proyecto/ejercicio_01/listado_tenistas.php');
            exit();
        } else {
            $error = 'Usuario o contraseña incorrectos';
        }
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h2>Iniciar Sesión</h2>
<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form method="POST" action="login.php">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Ingresar</button>
</form>
</body>
</html>
