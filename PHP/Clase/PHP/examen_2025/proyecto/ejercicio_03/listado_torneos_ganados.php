<?php
require_once '../utiles/auth.php';
verificarSesion();

// Aquí se obtendrían los torneos ganados desde la base de datos
$torneos = [
    ['tenista' => 'Roger Federer', 'torneo' => 'Wimbledon', 'año' => 2017],
    ['tenista' => 'Rafael Nadal', 'torneo' => 'Roland Garros', 'año' => 2020],
];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Listado de Torneos Ganados</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <h1>Listado de Torneos Ganados</h1>
    <table>
        <tr>
            <th>Tenista</th>
            <th>Torneo</th>
            <th>Año</th>
        </tr>
        <?php foreach ($torneos as $torneo): ?>
            <tr>
                <td><?= $torneo['tenista'] ?></td>
                <td><?= $torneo['torneo'] ?></td>
                <td><?= $torneo['año'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>