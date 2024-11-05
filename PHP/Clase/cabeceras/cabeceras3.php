<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Formato de Imagen</title>
</head>
<body>
    <form action="cabeceras.php" method="get">
        <label for="format">Selecciona el formato de la imagen:</label>
        <?php
        if (isset($_GET['format'])) {
            $format = $_GET['format'];
            header('Content-Disposition: attachment; filename="imagen.' . $format . '"');
            header('Content-Type: image/' . $format);
            readfile('ruta/a/tu/imagen.' . $format);
            exit;
        }
        ?>
        <select name="format" id="format">
            <option value="jpeg">JPEG</option>
            <option value="png">PNG</option>
            <option value="gif">GIF</option>
        </select>
        <button type="submit">Descargar Imagen</button>
    </form>
</body>
</html>
