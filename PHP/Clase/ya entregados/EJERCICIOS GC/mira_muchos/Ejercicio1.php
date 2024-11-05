<!DOCTYPE html>
<html>

<head>
    <title>EJERCICIOS Formularios Básicos_GC</title>
</head>
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

<body>
    <h1>EJERCICIOS Formularios Básicos_GC</h1>
    <p>Giuliana Castillo 2ºDAW</p>


</html>
<?php

//-------------------------------------------------------------------------------------------------------------
// Ejercicio 1

// COMENTA EL QUE VAYAS A NO USAR POR QUE 
// Crea un formulario básico en HTML que envíe información de usuario (nombre,email y edad) a un archivo PHP (procesar.php) usando el método GET.
echo "<h1>Ejercicio 1</h1>";
echo '<form action="procesar.php" method="get">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad"><br><br>
    <input type="submit" value="Enviar">
</form>';

echo '<h1>Ejercicio 1.2 con POST</h1>';

// Crea un formulario básico en HTML que envíe información de usuario (nombre,email y edad) a un archivo PHP (procesar.php) usando el método POST.
echo '';
echo '<form action="procesar.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad"><br><br>
    <input type="submit" value="Enviar">
</form>';

