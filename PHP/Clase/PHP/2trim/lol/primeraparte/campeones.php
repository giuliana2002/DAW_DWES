<?php
try {

    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'dwes_manana';
    $password = 'dwes_2024';

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM campeon";
    $stmt = $pdo->query($sql);


    echo '<h1>Listado de Campeones de League of Legends</h1>';
    echo '<table border="1">';
    echo '<tr><th>Nombre</th><th>Rol</th><th>Dificultad</th><th>Descripción</th></tr>';


    while ($campeon = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($campeon['nombre']) . '</td>';
        echo '<td>' . htmlspecialchars($campeon['rol']) . '</td>';
        echo '<td>' . htmlspecialchars($campeon['dificultad']) . '</td>';
        echo '<td>' . htmlspecialchars($campeon['descripcion']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

