<?php
try {
    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'root';
    $password = '';

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
        $dificultad = filter_input(INPUT_POST, 'dificultad', FILTER_SANITIZE_STRING);
        $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);


        if ($nombre && $rol && $dificultad && $descripcion) {
            $sql = "INSERT INTO campeon (nombre, rol, dificultad, descripcion) VALUES (:nombre, :rol, :dificultad, :descripcion)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':rol' => $rol,
                ':dificultad' => $dificultad,
                ':descripcion' => $descripcion,
            ]);

            echo "El personaje se ha insertado correctamente.";
        } else {
            echo "Por favor, completa todos los campos del formulario.";
        }
    }

    echo '<form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required><br>

            <label for="rol">Rol:</label>
            <input type="text" name="rol" id="rol" required><br>

            <label for="dificultad">Dificultad:</label>
            <select name="dificultad" id="dificultad" required>
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required></textarea><br>

            <button type="submit">Insertar Personaje</button>
        </form>';
} catch (PDOException $e) {
    die("Error al insertar los personajes: " . $e->getMessage());
}
