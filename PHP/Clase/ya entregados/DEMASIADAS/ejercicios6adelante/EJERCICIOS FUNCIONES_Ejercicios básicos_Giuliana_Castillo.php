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

// Crear una función en PHP que reciba como parámetros la altura (h) de un cilindro y el radio de la base (r), y que nos devuelva el volumen del cilindro. La fórmula del volumen es: V=л2 * r2 * h
echo "<h1>Ejercicio 1</h1>";
function volumenCilindro($h, $r)
{
    $volumen = M_PI * pow($r, 2) * $h;
    return $volumen;
}
echo "<p>El volumen del cilindro es: " . volumenCilindro(5, 3) . "</p>";





//-------------------------------------------------------------------------------------------------------------
//Ejercicio 2

// Crea 2 funciones PHP que, dado 3 números, una función los sume y la otra haga el producto de los 3 números.
echo "<h1>Ejercicio 2</h1>";

function suma($num1, $num2, $num3)
{
    $suma = $num1 + $num2 + $num3;
    return $suma;
}
echo "<p>La suma de los números es: " . suma(5, 3, 2) . "</p>";

function producto($num1, $num2, $num3)
{
    $producto = $num1 * $num2 * $num3;
    return $producto;
}
echo "<p>El producto de los números es: " . producto(5, 3, 2) . "</p>";


//-------------------------------------------------------------------------------------------------------------
//Ejercicio 3
/*
Crea una función con la sintaxis moderna que
● Reciba un array de números.
● Un número de elementos a eliminar de dicho array, por defecto uno.
● Se elimina del array el número de elementos recibidos de forma aleatoria dentro del array.
Devuelve un booleano indicando si la acción se realizó correctamente
o no.
*/
echo "<h1>Ejercicio 3</h1>";
function elim_alea(array &$numeros, int $cantidad = 1): bool
{
    if ($cantidad > count($numeros)) {
        return false;
    }

    $numeros = array_diff_key($numeros, array_flip(array_rand($numeros, $cantidad)));
    return true;
}

$arrayNumeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$cantidadEliminar = 3;

if (elim_alea($arrayNumeros, $cantidadEliminar)) {
    echo "<p>Se eliminaron $cantidadEliminar elementos del array correctamente.</p>";
    echo "<pre>" . print_r($arrayNumeros, true) . "</pre>";
} else {
    echo "<p>No se pudieron eliminar $cantidadEliminar elementos del array.</p>";
}






//-------------------------------------------------------------------------------------------------------------


?>