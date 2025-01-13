<?php
include_once __DIR__ . '/../autoload.php';
use Dwes\ProyectoVideoclub\login;
use Dwes\ProyectoVideoclub\logout;
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] === 'admin') {
    header('Location: index.php');
    exit();
}

$clientes = $_SESSION['clientes'] ?? [];
$cliente = null;

foreach ($clientes as $c) {
    if ($c['user'] === $_SESSION['user']) {
        $cliente = $c;
        break;
    }
}

if (!$cliente) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cliente</title>
</head>
<body>
<h1>Bienvenido, <?php echo $cliente['nombre']; ?></h1>
<a href="../app/logout.php">Cerrar sesión</a>
<h2>Listado de alquileres</h2>
<ul>
    <?php
    // Aquí deberías obtener los alquileres del cliente y listarlos

    ?>
</ul>
</body>
</html>