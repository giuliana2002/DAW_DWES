<?php
// Ejercicio 1 "Hola Mundo"
echo "<p>Hola Mundo</p>";
echo '<a href="pruebas2.php">Segunda página</a>';

// Ejercicio 2 Escriba un programa que cada vez que se ejecute muestre un valor entre 1 y 6, al azar.
echo "<p>El número aleatorio es: ".rand(1,6)."</p>";

//Escriba un programa que cada vez que se ejecute muestre un código de color RGB elegido al azar
echo "<p style='color:rgb(".rand(0,255).",".rand(0,255).",".rand(0,255).")'>Soy un camaleon</p>";

//Escriba un programa que cada vez que se ejecute muestre un emoticono elegido al azar entre los caracteres Unicode 128512 y 128586
echo "<p>&#".rand(128512,128586).";</p>";



