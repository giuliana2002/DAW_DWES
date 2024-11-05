<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comprobación de Números</title>
</head>

<body>
    <form method="post" action="">
        <label for="number">Introduce un valor:</label>
        <input type="text" id="number" name="number">
        <input type="submit" value="Comprobar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $value = $_POST['number'];

        if (is_numeric($value)) {
            echo "<p>El valor '$value' es un número (is_numeric).</p>";
        } else {
            echo "<p>El valor '$value' no es un número (is_numeric).</p>";
        }

        if (ctype_digit($value)) {
            echo "<p>El valor '$value' es un número entero positivo (ctype_digit).</p>";
        } else {
            echo "<p>El valor '$value' no es un número entero positivo (ctype_digit).</p>";
        }
    }
    ?>
</body>

</html>