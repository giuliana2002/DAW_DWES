<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Página Principal - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #333;
        }

        .container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .class-option {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            width: 200px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .class-option img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .class-option a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .logout {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #FF0000;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Bienvenido al Gimnasio, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
    <div class="container">
        <div class="class-option">
            <img src="imagenes/yoga.jpg" alt="Yoga">
            <a href="yoga.php">Reservar Clase de Yoga</a>
        </div>
        <div class="class-option">
            <img src="imagenes/zumba.jpg" alt="Zumba">
            <a href="zumba.php">Reservar Clase de Zumba</a>
        </div>
        <div class="class-option">
            <img src="imagenes/crossfit.jpg" alt="CrossFit">
            <a href="crossfit.php">Reservar Clase de CrossFit</a>
        </div>
    </div>
    <a class="logout" href="index.php">Cerrar Sesión</a>
</body>

</html>
</div>
</body>