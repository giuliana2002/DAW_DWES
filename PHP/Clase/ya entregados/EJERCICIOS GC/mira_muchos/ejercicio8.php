<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8 - Validación con funciones ctype_</title>
</head>

<body>
    <form method="post" action="">
        <label for="inputValue">Ingrese un valor:</label>
        <input type="text" id="inputValue" name="inputValue" required>
        <button type="submit">Validar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputValue = $_POST['inputValue'];

        if (ctype_alpha($inputValue)) {
            echo "<p>El valor ingresado es alfabético.</p>";
        } elseif (ctype_alnum($inputValue)) {
            echo "<p>El valor ingresado es alfanumérico.</p>";
        } elseif (ctype_digit($inputValue)) {
            echo "<p>El valor ingresado solo contiene dígitos.</p>";
        } else {
            echo "<p>El valor ingresado no es válido.</p>";
        }
    }
    ?>
</body>

</html>