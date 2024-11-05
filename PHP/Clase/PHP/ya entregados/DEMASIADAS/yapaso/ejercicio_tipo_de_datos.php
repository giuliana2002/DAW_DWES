<?php

// Giuliana Castillo 2ºDAW
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 1 

// Declaración de diferentes tipos de datos
echo"<h1>Ejercicio 1</h1>";
$entero = 42;
$flotante = 3.14;
$cadena = "Hola, mundo!";
$booleano = true;

// Mostrar los valores y tipos de datos
echo "Conceptos basicos de PHP";
echo "<p>Entero:  $entero </p>";
echo "<p>Flotante: $flotante</p>";
echo "<p>Cadena: $cadena </p>";
echo "<p>Booleano: $booleano</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 2

// Declara una cadena y realiza operaciones básicas como obtener su longitud, convertirla a mayúsculas y concatenarla con otra cadena.
echo"<h1>Ejercicio 2</h1>";
$cadena = "Hola, mundo!";
echo "<p>La longitud de la cadena es: " . strlen($cadena) . "</p>";
echo "<p>La cadena en mayúsculas es: " . strtoupper($cadena) . "</p>";
echo "<p>La concatenación de la cadena es: " . $cadena . " desde mi casa</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 3

// Crea una cadena en la que incluyas comillas simples y dobles.
echo"<h1>Ejercicio 3</h1>";
$cadena = "Esto es una cadena con 'comillas simples' y \"comillas dobles\"";
echo "<p>$cadena</p>";
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 4

// Escribe dos cadenas, una con comillas simples y otra con comillas dobles, que incluyan una variable. Observa la diferencia
echo"<h1>Ejercicio 4</h1>";
$nombre = "Giuliana";
echo "<p>Con comillas simples: Hola, $nombre</p>";
echo '<p>Con comillas dobles: Hola, $nombre</p>';

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 5

// Crea una cadena que incluya código HTML y CSS, utilizando comillas correctamente.
echo"<h1>Ejercicio 5</h1>";
$cadena = "<p style='color: red;'> Colorcito Rojito</p>";
echo $cadena;

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 6

// Usa caracteres especiales como saltos de línea, tabulaciones o barras invertidas dentro de una cadena.
echo"<h1>Ejercicio 6</h1>";
$cadena = "Hola\nMundo!";
echo "<p>$cadena</p>";
echo    chop($cadena) .",  ". chop($cadena) . "," . chop($cadena) . ",". chop($cadena);

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 7

// Concatenar dos cadenas y mostrar el resultado.
echo"<h1>Ejercicio 7</h1>";
$cadena1 = "Hola, ";
$cadena2 = "mundo!";
echo "<p>" . $cadena1 . $cadena2 . "</p>";


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 8

// Modifica el script anterior para que el texto concatenado se muestre en líneas separadas.
echo"<h1>Ejercicio 8</h1>";

echo "<p>" . $cadena1 . "<br>" . $cadena2 . "</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 9

// Declara una variable y asígnale un valor. Luego, imprímela en pantalla.
echo"<h1>Ejercicio 9</h1>";
$variable = "Hola, mundo!";
echo "<p>$variable</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 10

// Usa varias variables en un cálculo simple y muestra el resultado.
echo"<h1>Ejercicio 10</h1>";
$numero1 = 10;
$numero2 = 20;
$suma = $numero1 + $numero2;
echo"<p>La suma de $numero1 y $numero2 es: $suma</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 11

// Concatenar una variable y una cadena en una sola línea de texto.
echo"<h1>Ejercicio 11</h1>";	
$var = "Que haces aqui compañerooo";
echo "<p> Perooo Madre mia Willy: $var</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 12

// Incluye una variable dentro de una cadena usando comillas dobles.
echo"<h1>Ejercicio 12</h1>";
$var2 = "Hola, mundo!";
echo "<p> \"$var2\" </p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 13

// Declara variables de diferentes tipos (entero, flotante, booleano) y muéstralas.
echo"<h1>Ejercicio 13</h1>";
$entero = 42;
$flotante = 3.14;
$booleano = true;
echo "<p>Entero: $entero</p>";
echo "<p>Flotante: $flotante</p>";
echo "<p>Booleano: $booleano</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 14

// Realiza operaciones aritméticas básicas (suma, resta, multiplicación, división).
echo"<h1>Ejercicio 14</h1>";
$numero1 = 10;
$numero2 = 20;

$suma = $numero1 + $numero2;
$resta = $numero1 - $numero2;
$multiplicacion = $numero1 * $numero2;
$division = $numero1 / $numero2;  

echo "<p>La suma de $numero1 y $numero2 es: $suma</p>";
echo "<p>La resta de $numero1 y $numero2 es: $resta</p>";
echo "<p>La multiplicación de $numero1 y $numero2 es: $multiplicacion</p>";
echo "<p>La división de $numero1 y $numero2 es: $division</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 15

// Declara variables con nombres significativos y utiliza buenas prácticas para nombrarlas.
echo"<h1>Ejercicio 15</h1>";
$numero_de_alumnos = 20;
$precio_del_pan = 0.50;
$es_de_dia = true;
$es_de_dia = false;
$manolo = "Manolo";
echo "<p>Numero de alumnos: $numero_de_alumnos, el precio del pan es: $precio_del_pan , y si es de dia de que $manolo compre pan</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 16

// Une variables y texto dentro de un echo.
echo"<h1>Ejercicio 16</h1>";
$pregunta = "que tas achendo?";
echo "<p> Perdone que te pregunte, $pregunta &#128568</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 17

//Declara una variable booleana y usa un if para mostrar un mensaje dependiendo de su valor.
echo"<h1>Ejercicio 17</h1>";
$es_de_dia = false;
echo"Es de dia o es de noche? $es_de_dia";
if ($es_de_dia) {
    echo "<p>Es de día</p>";
} else {
    echo "<p>Es de noche</p>";
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 18

// Declara una variable entera y úsala en una operación.
echo"<h1>Ejercicio 18</h1>";
$numero = 10;
$resultado = $numero * 2;
echo "<p>Al multipicar $numero x2 es: $resultado</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 19

// Realiza una operación binaria y muestra el resultado.
echo"<h1>Ejercicio 19</h1>";
$numero1 = 10;
$numero2 = 20;
$binario = $numero1 & $numero2;
echo "<p>El binario de entre $numero1 y $numero2 es: $binario</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 20

// Usa una variable de tipo flotante y realiza una operación con ella.
echo"<h1>Ejercicio 20</h1>";
$flotante = 3.14;
$operacion = $flotante * 2;
echo "<p>Al multiplicar $flotante x2 es: $operacion</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 21

// Declara una variable de cadena y manipúlala (mayúsculas, minúsculas).
echo"<h1>Ejercicio 21</h1>";
$cadena = "Hola, mundo!";
$cadenna2 = "HOLA, MUNDO!";
echo "<p>La cadena en mayúsculas es: " . strtoupper($cadena) . "</p>";
echo "<p>La cadena en minúsculas es: " . strtolower($cadenna2) . "</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 22

// Convierte un número en una cadena y una cadena en un número.
echo"<h1>Ejercicio 22</h1>";
$numero = 42;
$cadena = "42";
echo "<p>El número convertido a cadena es: " . strval($numero) . "</p>";
echo "<p>La cadena convertida a número es: " . intval($cadena) . "</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 23

// Convierte explícitamente una variable flotante en entera.
echo"<h1>Ejercicio 23</h1>";
$flotante = 3.14;
$entero = (int)$flotante;
echo "<p>El flotante convertido a entero es: $entero</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 24

//: Realiza una operación entre diferentes tipos de datos (flotante y entero) y observa la conversión automática.
echo"<h1>Ejercicio 24</h1>";
$flotante = 3.14;
$entero = 2;
$resultado = $flotante * $entero;
echo "<p>Al $flotante x $entero es: $resultado</p>";

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Ejercicio 25

//Usa una variable como condicional lógica.
echo"<h1>Ejercicio 25</h1>";
$flotante = 3.14;
$resultado = $flotante * $flotante;
echo "<p>El resultado es: $resultado</p>";


?>