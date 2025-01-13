<?php
try {
    $dsn = 'mysql:host=localhost;dbname=lol;charset=utf8mb4';
    $username = 'root';
    $password = '';

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $users = [
        ['nombre' => 'Usuario1', 'usuario' => 'user1', 'password' => password_hash('password1', PASSWORD_DEFAULT), 'email' => 'user1@example.com'],
        ['nombre' => 'Usuario2', 'usuario' => 'user2', 'password' => password_hash('password2', PASSWORD_DEFAULT), 'email' => 'user2@example.com'],
        ['nombre' => 'Usuario3', 'usuario' => 'user3', 'password' => password_hash('password3', PASSWORD_DEFAULT), 'email' => 'user3@example.com']
    ];

    $sql = "INSERT INTO usuario (nombre, usuario, password, email) VALUES (:nombre, :usuario, :password, :email)";
    $stmt = $pdo->prepare($sql);

    foreach ($users as $user) {
        $stmt->execute($user);
    }

    echo "Usuarios insertados correctamente.";

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>