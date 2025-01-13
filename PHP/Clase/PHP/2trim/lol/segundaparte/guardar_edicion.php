<?php
try {
    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'root';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['id'], $_POST['nombre'], $_POST['rol'], $_POST['dificultad'], $_POST['descripcion'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $rol = $_POST['rol'];
        $dificultad = $_POST['dificultad'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE campeon SET nombre = :nombre, rol = :rol, dificultad = :dificultad, descripcion = :descripcion WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':rol' => $rol,
            ':dificultad' => $dificultad,
            ':descripcion' => $descripcion,
            ':id' => $id
        ]);


        header('Location: campeones_2.php');
        exit;
    } else {
        echo "Datos incompletos.";
    }

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

