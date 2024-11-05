<!-- Ejercicio3.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo</title>
</head>

<body>
    <h2>Subir Archivo</h2>
    <form action="subir.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecciona un archivo:</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <input type="submit" value="Subir Archivo">
    </form>
</body>

</html>