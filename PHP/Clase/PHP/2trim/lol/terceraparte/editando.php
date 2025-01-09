<?php
try {
    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'root';
    $password = '';

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        $sql = "SELECT * FROM campeon WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $campeon = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($campeon) {
            echo '<h1>Editar Campeón</h1>';
            echo '<form method="POST" action="guardar_edicion.php">';
            echo '<input type="hidden" name="id" value="' . $campeon['id'] . '">';
            echo '<label for="nombre">Nombre:</label>';
            echo '<input type="text" name="nombre" value="' . htmlspecialchars($campeon['nombre']) . '" required><br>';
            echo '<label for="rol">Rol:</label>';
            echo '<input type="text" name="rol" value="' . htmlspecialchars($campeon['rol']) . '" required><br>';
            echo '<label for="dificultad">Dificultad:</label>';
            echo '<select name="dificultad" required>';
            echo '<option value="Baja" ' . ($campeon['dificultad'] == 'Baja' ? 'selected' : '') . '>Baja</option>';
            echo '<option value="Media" ' . ($campeon['dificultad'] == 'Media' ? 'selected' : '') . '>Media</option>';
            echo '<option value="Alta" ' . ($campeon['dificultad'] == 'Alta' ? 'selected' : '') . '>Alta</option>';
            echo '</select><br>';
            echo '<label for="descripcion">Descripción:</label>';
            echo '<textarea name="descripcion" required>' . htmlspecialchars($campeon['descripcion']) . '</textarea><br>';
            echo '<button type="submit">Guardar Cambios</button>';
            echo '</form>';
        } else {
            echo "Campeón no encontrado.";
        }
    } else {
        echo "ID no proporcionado.";
    }

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

