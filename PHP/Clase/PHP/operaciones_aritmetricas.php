<!DOCTYPE html>
<html>
<head>
    <title>EJERCICIO_Operaciones Aritméticas</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h1 {
        color: blue;
        font-size: 24px;
        
    }
    p {
        color: green;
        font-size: 18px;
    }
    pre {
        color: red;
        font-size: 16px;
    }

</style>
<body>
    <h1>EJERCICIO_Operaciones Aritméticas</h1>
    <p>Giuliana Castillo 2ºDAW</p>

</html>
<?php 

//-------------------------------------------------------------------------------------------------------------
// Ejercicio 1

// Escribe un script que calcule el área y el perímetro de un rectángulo dados el ancho y el alto.
echo"<h1>Ejercicio 1</h1>";
$ancho = 10;
$alto = 20;
$area = $ancho * $alto;
$perimetro = 2 * ($ancho + $alto);
echo "<p>El área del rectángulo es: $area</p>";
echo "<p>El perímetro del rectángulo es: $perimetro</p>";



//-------------------------------------------------------------------------------------------------------------
//Ejercicio 2

// Dado dos números enteros, calcula el cociente y el resto de la división.
echo "<h1>Ejercicio 2</h1>";
$dividendo = 10;
$divisor = 3;
$cociente = (int)($dividendo / $divisor);
$resto = $dividendo % $divisor;
echo "<p>El cociente de la división es: $cociente</p>";
echo "<p>El resto de la división es: $resto</p>";




//-------------------------------------------------------------------------------------------------------------
//Ejercicio 3

// Crea un script que muestre la diferencia entre el pre-incremento y el post-incremento.
echo "<h1>Ejercicio 3</h1>";
$numero = 10;
echo "<p>Pre-incremento: " . ++$numero . "</p>";
echo "<p>Post-incremento: " . $numero++ . "</p>";

//-------------------------------------------------------------------------------------------------------------
//Ejercicio 4

// Utiliza la función round() para redondear un número a 2 decimales.

echo "<h1>Ejercicio 4</h1>";
$numero = 10.123456;
$redondeado = round($numero, 2);
echo "<p>El número redondeado es: $redondeado</p>";



//-------------------------------------------------------------------------------------------------------------
//Ejercicio 5

// Escribe un script que calcule y muestre el valor de 3 elevado a la 4ta potencia usando el operador **.

echo"<h1>Ejercicio 5</h1>";
$base = 3;
$exponente = 4;
$resultado = $base ** $exponente;
echo "<p>3 elevado a la 4ta potencia es: $resultado</p>";


//-------------------------------------------------------------------------------------------------------------
//Ejercicio 6

// Genera un número aleatorio entre 1 y 50 usando mt_rand(
echo"<h1>Ejercicio 6</h1>";
$numeroAleatorio = mt_rand(1, 50);
echo "<p>Número aleatorio entre 1 y 50: $numeroAleatorio</p>";



//-------------------------------------------------------------------------------------------------------------
//Ejercicio 7

// Compara un número entero con una cadena de texto usando === y == para mostrar la diferencia.
echo "<h1>Ejercicio 7</h1>";
$numero = 10;
$texto = "10";
if ($numero === $texto) {
    echo "<p>Los dos valores son iguales en valor y tipo.</p>";
} elseif ($numero == $texto) {
    echo "<p>Los dos valores son iguales en valor pero no en tipo.</p>";
} else {
    echo "<p>Los dos valores no son iguales en valor ni en tipo.</p>";
}



//-------------------------------------------------------------------------------------------------------------
//Ejercicio 8

// Usa number_format() para mostrar un número con separador de miles y 3 decimales.
echo"<h1>Ejercicio 8</h1>";
$numero = 1234567.891234;
$numeroFormateado = number_format($numero, 3, ",", ".");
echo "<p>Número formateado: $numeroFormateado</p>";

//-------------------------------------------------------------------------------------------------------------
//Ejercicio 9

// Usa operadores lógicos para determinar si un número está entre 10 y 20.
echo "<h1>Ejercicio 9</h1>";
$numero = 15;
if ($numero >= 10 && $numero <= 20) {
    echo "<p>El número está entre 10 y 20.</p>";
} else {
    echo "<p>El número no está entre 10 y 20.</p>";
}


//-------------------------------------------------------------------------------------------------------------
// Ejercicio 10

//Muestra cómo se comporta el incremento en caracteres con el operador ++
echo "<h1>Ejercicio 10</h1>";
$letra = 'A';
echo "<p>Carácter original: $letra</p>";
$letra++;
echo "<p>Carácter incrementado: $letra</p>";


//-------------------------------------------------------------------------------------------------------------

?>