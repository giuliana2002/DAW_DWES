<!DOCTYPE html>
<html>

<head>
    <title>EJERCICIOS ESTRUCTURAS DE CONTROL_GC</title>
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
    <h1>EJERCICIOS ESTRUCTURAS DE CONTROL_GC</h1>
    <p>Giuliana Castillo 2ºDAW</p>

</html>
<?php

//-------------------------------------------------------------------------------------------------------------
// Ejercicio 1

// Hacer un código con bucles anidados de variables independientes, donde la variable del bucle exterior ($i) tome valores numéricos entre 1 y 3, y la del bucle interior ($j) valores entre a y d. 
echo "<h1>Ejercicio 1</h1>";

for ($i = 1; $i <= 3; $i++) {
    for ($j = 'a'; $j <= 'd'; $j++) {
        echo "<p>Valor de i: $i, Valor de j: $j</p>";
    }
}


//-------------------------------------------------------------------------------------------------------------
//Ejercicio 2

/*Hacer un código con bucles anidados de variables dependientes que simule lo siguiente:
- Tienes 2 dados
- Tiras el primero.
- Tiras el segundo tantas veces como el valor obtenido del dado 1.
- Vuelves a tirar el primer dado y repetimos la operación.
- El primer dado, lo tiramos 3 veces.
*/
echo "<h1>Ejercicio 2</h1>";

echo "<p>Simulación de tirada de dados</p>";
for ($i = 1; $i <= 3; $i++) {
    $dado1 = rand(1, 6);
    echo "<h1>Sentencia del primer dado incluyendo el valor en la tirada $i: $dado1</h1>";
    for ($j = 1; $j <= $dado1; $j++) {
        $dado2 = rand(1, 6);
        echo "<h2>Sentencia del segundo dado incluyendo el valor: $dado2</h2>";
    }
}



//-------------------------------------------------------------------------------------------------------------
//Ejercicio 3

// Crear un código para calcular el factorial de un número, usando la función FOR.
echo "<h1>Ejercicio 3</h1>";
echo "<p>Factorial de un número</p>";
for ($i = 1; $i <= 3; $i++) {
    $factorial = 1;
    for ($j = 1; $j <= $i; $j++) {
        $factorial = $factorial * $j;
    }
    echo "<p>El factorial de $i es $factorial</p>";
}
//-------------------------------------------------------------------------------------------------------------


?>