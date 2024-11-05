<?php
if (isset($_GET['download']) && $_GET['download'] == 'true') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="archivo.txt"');
    echo "Buenos dias, buenas tardes y buenas noches segun cuando leas esto.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO CABECERAS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #2299f5;
            font-size: 24px;
        }

        p {
            color: #49b669;
            font-size: 18px;
        }

        pre {
            color: red;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h1>EJERCICIO CABECERAS_GC</h1>
    <p>Giuliana Castillo 2ºDAW</p>

    <h1>Ejercicio 1</h1>
    <p>1.1 Descarga de un archivo de texto plano MIME básicos y cómo indicar al navegador que descargue un archivo.</p>
    <p>ACTIVIDAD → El usuario hace clic en un enlace y se descarga un archivo de texto con contenido predefinido.</p>
    <a href="?download=true">Descargar archivo de texto</a>
</body>

</html>