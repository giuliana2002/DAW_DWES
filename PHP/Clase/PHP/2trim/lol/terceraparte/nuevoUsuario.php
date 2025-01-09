<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        try {
            $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
            $username = 'root';
            $password = '';

            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];

            $sql = "INSERT INTO usuario (nombre, usuario, password, email) VALUES (:nombre, :usuario, :password, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':nombre' => $nombre, ':usuario' => $usuario, ':password' => $password, ':email' => $email]);

            echo "El usuario $usuario ha sido introducido en el sistema con la contraseña {$_POST['password']}.";
            echo "<br><a href='campeones_3.php'>Aqui puedes mirar los campeones</a>";

        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    } else {
        die("Todos los campos son obligatorios.");
    }
} else {
    die("Acceso prohibido.");
}
?>