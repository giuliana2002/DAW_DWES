<?php
require_once '../utiles/auth.php';
verificarSesion();
require_once '../utiles/config.php';
require_once '../utiles/funciones.php';

// Aquí se obtendrían los tenistas desde la base de datos
$tenistas = [
    ['id' => 1, 'nombre' => 'Roger Federer', 'pais' => 'Suiza'],
    ['id' => 2, 'nombre' => 'Rafael Nadal', 'pais' => 'España'],
];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Listado de Tenistas</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <h1>Listado de Tenistas</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>País</th>
            <?php if (esAdministrador()) echo '<th>Acciones</th>'; ?>
        </tr>
        <?php foreach ($tenistas as $tenista): ?>
            <tr>
                <td><?= $tenista['id'] ?></td>
                <td><?= $tenista['nombre'] ?></td>
                <td><?= $tenista['pais'] ?></td>
                <?php if (esAdministrador()): ?>
                    <td>
                        <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>