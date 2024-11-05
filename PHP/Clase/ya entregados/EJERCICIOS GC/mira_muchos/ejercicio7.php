<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comprobación de Tipos de Datos</title>
</head>

<body>
    <form method="post" action="">
        <label for="data">Introduce un dato:</label>
        <input type="text" id="data" name="data">
        <input type="submit" value="Comprobar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['data'];

        echo "<p>El dato introducido es: $data</p>";

        if (is_numeric($data)) {
            if (strpos($data, '.') !== false) {
                echo "<p>El dato es de tipo float.</p>";
            } else {
                echo "<p>El dato es de tipo int.</p>";
            }
        } elseif (is_bool($data)) {
            echo "<p>El dato es de tipo boolean.</p>";
        } elseif (is_string($data)) {
            echo "<p>El dato es de tipo string.</p>";
        } else {
            echo "<p>El dato es de un tipo desconocido.</p>";
        }
    }
    ?>
</body>

</html>