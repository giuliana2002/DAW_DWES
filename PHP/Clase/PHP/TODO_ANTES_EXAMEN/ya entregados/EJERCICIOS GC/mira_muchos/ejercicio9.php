<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9 - Validación con filter_var()</title>
</head>

<body>
    <h2>Formulario de Validación</h2>
    <form method="post" action="">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="url">URL:</label>
        <input type="url" id="url" name="url" required>
        <br><br>
        <input type="submit" value="Validar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $url = $_POST['url'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>El correo electrónico es válido.</p>";
        } else {
            echo "<p>El correo electrónico no es válido.</p>";
        }

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            echo "<p>La URL es válida.</p>";
        } else {
            echo "<p>La URL no es válida.</p>";
        }
    }
    ?>
</body>

</html>