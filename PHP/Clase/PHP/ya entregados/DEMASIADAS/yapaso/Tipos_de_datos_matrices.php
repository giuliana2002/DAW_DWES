<!DOCTYPE html>
<html>
<head>
    <title>Tipos de datos: Matrices</title>
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
    <h1>Tipos de datos: Matrices</h1>
    <p>Giuliana Castillo 2ºDAW</p>

</html>
<?php 

//-------------------------------------------------------------------------------------------------------------
// Ejercicio 1

// Crea una matriz que contenga los nombres de cinco colores y luego imprime el tercer color en la matriz.

echo"<h1>Ejercicio 1</h1>";
$colores = array("Rojo", "Azul", "Verde", "Amarillo", "Negro");
echo("<p> El tercer color es: $colores[2]");



//-------------------------------------------------------------------------------------------------------------
//Ejercicio 2

// Crea una matriz asociativa para almacenar información de un coche(marca, modelo, año) y luego imprime el valor del modelo

echo "<h1>Ejercicio 2</h1>";
$coche = array(
    "marca" => "Toyota",
    "modelo" => "Corolla",
    "año" => 2020
);
echo "<p>Modelo: " . $coche["modelo"] . "</p>";




//-------------------------------------------------------------------------------------------------------------
//Ejercicio 3

// Crea una matriz multidimensional que contenga información de tres estudiantes (nombre, edad, nota). Imprime el nombre del segundo estudiante.
echo "<h1>Ejercicio 3</h1>";
$estudiantes = array(
    array(
        "nombre" => "Juan",
        "edad" => 20,
        "nota" => 8.5
    ),
    array(
        "nombre" => "María",
        "edad" => 22,
        "nota" => 9.0
    ),
    array(
        "nombre" => "Pedro",
        "edad" => 21,
        "nota" => 7.5
    )
);
echo "<p>Nombre del segundo estudiante: " . $estudiantes[1]["nombre"] . "</p>";

//-------------------------------------------------------------------------------------------------------------
//Ejercicio 4

// Crea una matriz con los días de la semana y usa la función print_r() para imprimirla.

echo "<h1>Ejercicio 4</h1>";
echo "<pre>";
$semana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
echo "<p>Matriz de días de la semana:</p>";
print_r($semana);


//-------------------------------------------------------------------------------------------------------------
//Ejercicio 5

// Crea una matriz con tres números y añade dos números más a la matriz
echo"<h1>Ejercicio 5</h1>";
$numeros = array(1, 2, 3);
array_push($numeros, 4, 5);
echo "<p>Matriz con cinco números:</p>";
echo "<pre>";
print_r($numeros);
echo "</pre>";

//-------------------------------------------------------------------------------------------------------------
//Ejercicio 6

// Crea dos matrices, una con los nombres de tres frutas y otra con tres verduras. Únelas en una sola matriz.
echo"<h1>Ejercicio 6</h1>";
$frutas = array("Manzana", "Banana", "Cereza");
$verduras = array("Zanahoria", "Lechuga", "Tomate");
$alimentos = array_merge($frutas, $verduras);
echo "<p>Matriz de frutas y verduras unidas:</p>";
echo "<pre>";
print_r($alimentos);
echo "</pre>";


//-------------------------------------------------------------------------------------------------------------
//Ejercicio 7

// Crea una matriz con tres valores, utiliza count() para mostrar cuántos elementos tiene.
echo "<h1>Ejercicio 7</h1>";
$numer = array(1, 2, 3);
echo "<pre>";
echo "<p>Matriz con tres valores:</p>";
echo "<pre>";
echo "<p>La matriz tiene " . count($numer) . " elementos.</p>";
echo"</pre>";

//-------------------------------------------------------------------------------------------------------------
//Ejercicio 8

// Crea una matriz con cinco números y elimina el tercer número usando unset().
echo"<h1>Ejercicio 8</h1>";
$numeros = array(10, 20, 30, 40, 50);
unset($numeros[2]);
echo "<p>Matriz después de eliminar el tercer número:</p>";
echo "<pre>";
print_r($numeros);
echo "</pre>";

//-------------------------------------------------------------------------------------------------------------
//Ejercicio 9

// Crea una matriz y luego copia sus valores a otra variable.
echo "<h1>Ejercicio 9</h1>";
$numeross = array(10, 20, 30, 50);
$numeros_copia = $numeross;

echo "<p>Matriz original:</p>";
echo "<pre>";
print_r($numeross);
echo "</pre>";

echo "<p>Matriz copiada:</p>";
echo "<pre>";
print_r($numeros_copia);
echo "</pre>";

//-------------------------------------------------------------------------------------------------------------
// Ejercicio 10

// Define una constante con el valor de la velocidad de la luz en metros porsegundo y úsala para mostrarla en pantalla.
echo "<h1>Ejercicio 10</h1>";

$velocidad_luz = 299792458;
echo "<p>La velocidad de la luz es de " . $velocidad_luz . " metros por segundo.</p>";


//-------------------------------------------------------------------------------------------------------------
// Ejercicio 11

// Crea una constante para el nombre de una aplicación web y muestra su valor en un mensaje.
echo "<h1>Ejercicio 11</h1>";

define("APP_NAME", "MiAplicacionWeb");
echo "<p>El nombre de la aplicación es: " . APP_NAME . "</p>";


//-------------------------------------------------------------------------------------------------------------
// Ejercicio 12

// Usa la constante predefinida PHP_VERSION para mostrar la versión actual de PHP en la que se está ejecutando el script
echo"<h1>Ejercicio 12</h1>";
echo "<p>La versión de PHP actual es: " . PHP_VERSION . "</p>";



//-------------------------------------------------------------------------------------------------------------
// Ejercicio 13

// Crea un script que use get_defined_constants() para mostrar todas las constantes predefinidas disponibles en tu entorno PHP.
echo"<h1>Ejercicio 13</h1>";
echo "<p>Constantes predefinidas en PHP:</p>";

echo "<pre>";
print_r(get_defined_constants());
echo "</pre>";




// Uso de matrices para almacenar al menos tres productos y sus datos: nombre, cantidad y precio unitario.Constantes: define las constantes DESCUENTO_PEQUENO, LIMITE_DESCUENTO y LIMITE_COMPRA_GRANDE para almacenar valores fijos, como los límites y el porcentaje de descuento. Operaciones aritméticas: sigue realizando las operaciones de multiplicación entre cantidad y precio unitario para calcular el total sin descuento, y luego se aplica un descuento del 10% si el total supera las 50 unidades.



?>