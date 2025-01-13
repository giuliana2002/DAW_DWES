<?php
try {

    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'root';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM campeon WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        header('Location: campeones_2.php');
        exit;
    } else {
        echo "ID no proporcionado.";
    }

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
