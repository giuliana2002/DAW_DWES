<?php
include_once __DIR__ . '/../autoload.php';
use Dwes\ProyectoVideoclub\login;
use Dwes\ProyectoVideoclub\logout;
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: indexx.php');
    exit();
}

$clientes = [
    ['nombre' => 'Amancio Ortega', 'user' => 'amancio', 'password' => '1234'],
    ['nombre' => 'Pablo Picasso', 'user' => 'pablo', 'password' => '5678']
];

$soportes = [
    ['titulo' => 'God of War', 'tipo' => 'Juego'],
    ['titulo' => 'The Last of Us Part II', 'tipo' => 'Juego'],
    ['titulo' => 'Torrente', 'tipo' => 'DVD'],
    ['titulo' => 'Origen', 'tipo' => 'DVD'],
    ['titulo' => 'El Imperio Contraataca', 'tipo' => 'DVD'],
    ['titulo' => 'Los cazafantasmas', 'tipo' => 'CintaVideo'],
    ['titulo' => 'El nombre de la Rosa', 'tipo' => 'CintaVideo']
];

$_SESSION['clientes'] = $clientes;
$_SESSION['soportes'] = $soportes;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
<h1>Bienvenido, <?php echo $_SESSION['user']; ?></h1>
<a href="../app/logout.php">Cerrar sesión</a>
<h2>Listado de clientes</h2>
<ul>
    <?php foreach ($clientes as $cliente): ?>
        <li><?php echo $cliente['nombre'] . ' (Usuario: ' . $cliente['user'] . ')'; ?></li>
    <?php endforeach; ?>
</ul>
<h2>Listado de soportes</h2>
<ul>
    <?php foreach ($soportes as $soporte): ?>
        <li><?php echo $soporte['titulo'] . ' (' . $soporte['tipo'] . ')'; ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>