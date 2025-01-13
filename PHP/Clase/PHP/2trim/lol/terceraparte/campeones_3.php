<?php
try {
    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'root';
    $password = '';

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $order = 'ASC';
    if (isset($_GET['order']) && $_GET['order'] == 'desc') {
        $order = 'DESC';
    }

    $sql = "SELECT * FROM campeon ORDER BY nombre $order";
    $stmt = $pdo->query($sql);

    echo '<h1>Listado de Campeones de League of Legends</h1>';
    echo '<a href="lol.php"><button>Insertar</button></a>';
    echo '<table border="1">';
    echo '<tr>';

    echo '<th>Nombre <a href="?columna=nombre&order=asc">˄</a> <a href="?columna=nombre&order=desc">˅</a></th>';
    echo '<th>Rol <a href="?columna=rol&order=asc">˄</a> <a href="?columna=rol&order=desc">˅</a></th>';
    echo '<th>Dificultad <a href="?columna=dificultad&order=asc">˄</a> <a href="?columna=dificultad&order=desc">˅</a></th>';
    echo '<th>Descripción <a href="?columna=descripcion&order=asc">˄</a> <a href="?columna=descripcion&order=desc">˅</a></th>';
    echo '<th>Acciones</th>';

    echo '</tr>';

    while ($campeon = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($campeon['nombre'])  .  '</td>';
        echo '<td>' . htmlspecialchars($campeon['rol']) . '</td>';
        echo '<td>' . htmlspecialchars($campeon['dificultad']) . '</td>';
        echo '<td>' . htmlspecialchars($campeon['descripcion']) . '</td>';
        echo '<td>';
        echo '<a href="editando.php?id=' . $campeon['id'] . '"><button>Editar</button></a> ';
        echo '<a href="borrar.php?id=' . $campeon['id'] . '" onclick="return confirm(\'¿Estás seguro de que quieres borrar a ' . htmlspecialchars($campeon['nombre']) . '?\');"><button>Borrar</button></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}