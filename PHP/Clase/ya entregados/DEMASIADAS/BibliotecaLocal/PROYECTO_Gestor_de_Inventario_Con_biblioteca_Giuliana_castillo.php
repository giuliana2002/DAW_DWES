<?php

// Definir arrays para el inventario actual, proveedor A y proveedor B
$inventario_actual = [
    ["producto" => "Teclado", "precio" => 20, "categoria" => "Electrónica", "cantidad" => 4],
    ["producto" => "Ratón", "precio" => 15, "categoria" => "Electrónica", "cantidad" => 10],
    ["producto" => "Monitor", "precio" => 100, "categoria" => "Electrónica", "cantidad" => 3],
    ["producto" => "Silla", "precio" => 80, "categoria" => "Muebles", "cantidad" => 5],
];

$proveedor_a = [
    ["producto" => "Ratón", "precio" => 10, "categoria" => "Electrónica", "cantidad" => 20],
    ["producto" => "Lámpara", "precio" => 25, "categoria" => "Iluminación", "cantidad" => 15],
    ["producto" => "Escritorio", "precio" => 50, "categoria" => "Muebles", "cantidad" => 2],
];

$proveedor_b = [
    ["producto" => "Monitor", "precio" => 92, "categoria" => "Electrónica", "cantidad" => 8],
    ["producto" => "Auriculares", "precio" => 30, "categoria" => "Electrónica", "cantidad" => 20],
    ["producto" => "Lámpara", "precio" => 20, "categoria" => "Iluminación", "cantidad" => 5],
];

function obtenerDiferencias($inventario_actual, $proveedor)
{
    $productos_actual = array_column($inventario_actual, 'producto');
    $productos_proveedor = array_column($proveedor, 'producto');
    return array_diff($productos_actual, $productos_proveedor);
}

function unirInventarios($inventario_actual, $proveedor_a, $proveedor_b)
{
    return array_merge($inventario_actual, $proveedor_a, $proveedor_b);
}

function contarCategorias($inventario_unido)
{
    $categorias = array_column($inventario_unido, 'categoria');
    return array_count_values($categorias);
}

function ordenarPorPrecio($inventario_unido)
{
    $precios = array_column($inventario_unido, 'precio');
    sort($precios);
    $array_ordenado = array();
    foreach ($precios as $precio) {
        foreach ($inventario_unido as $elemento) {
            if ($elemento['precio'] == $precio) {
                $array_ordenado[] = $elemento;
                break;
            }
        }
    }
    return $array_ordenado;
}

function eliminarDuplicados($inventario_unido)
{
    $resultadoProductosEliminados = [];
    foreach ($inventario_unido as $item) {
        $clave = $item['producto'] . '|' . $item['categoria'];

        if (!isset($resultadoProductosEliminados[$clave])) {
            $resultadoProductosEliminados[$clave] = [
                'producto' => $item['producto'],
                'categoria' => $item['categoria'],
                'total_precio' => 0,
                'total_cantidad' => 0,
            ];
        }

        $resultadoProductosEliminados[$clave]['total_precio'] += $item['precio'] * $item['cantidad'];
        $resultadoProductosEliminados[$clave]['total_cantidad'] += $item['cantidad'];
    }
    foreach ($resultadoProductosEliminados as $clave => $datos) {
        $resultadoProductosEliminados[$clave]['precio_promedio'] = $datos['total_precio'] / $datos['total_cantidad'];
        unset($resultadoProductosEliminados[$clave]['total_precio']);
    }
    return array_values($resultadoProductosEliminados);
}

function dividirEnSecciones($resultadoProductosEliminados, $tamaño)
{
    return array_chunk($resultadoProductosEliminados, $tamaño);
}

function generarInforme($resultadoProductosEliminados)
{
    $informe_inventario = [];
    foreach ($resultadoProductosEliminados as $item) {
        $informe_inventario[$item['producto']] = [
            "precio" => $item['precio_promedio'],
            "cantidad" => $item['total_cantidad'],
            "categoria" => $item['categoria'],
        ];
    }
    return $informe_inventario;
}



// Comparar inventarios con proveedor A y B
$diferencias_proveedor_a = obtenerDiferencias($inventario_actual, $proveedor_a);
$diferencias_proveedor_b = obtenerDiferencias($inventario_actual, $proveedor_b);

// Unir inventarios
$inventario_unido = unirInventarios($inventario_actual, $proveedor_a, $proveedor_b);

// Contar productos por categorías
$conteo_categorias = contarCategorias($inventario_unido);

// Ordenar los precios y aplicar ese orden al array de productos unidos
$array_ordenado = ordenarPorPrecio($inventario_unido);

// Eliminar productos duplicados
$resultadoProductosEliminados = eliminarDuplicados($inventario_unido);

// Dividir en secciones
$secciones_inventario = dividirEnSecciones($resultadoProductosEliminados, 2);

// Generar informe
$informe_inventario = generarInforme($resultadoProductosEliminados);

// Mostrar resultados
echo "<pre>Diferencias con Proveedor A: ";
print_r($diferencias_proveedor_a);
echo "</pre>";

echo "<pre>Diferencias con Proveedor B: ";
print_r($diferencias_proveedor_b);
echo "</pre>";

echo "<pre>Inventario Unido sin eliminar duplicados: ";
print_r($inventario_unido);
echo "</pre>";

echo "<pre>Conteo de productos por categoría: ";
print_r($conteo_categorias);
echo "</pre>";

echo "<pre>Inventario Único eliminando duplicados , sumando cantidades y promediando precios: ";
print_r($resultadoProductosEliminados);
echo "</pre>";

echo "<pre>Secciones del Inventario: ";
print_r($secciones_inventario);
echo "</pre>";

echo "<pre>Informe del Inventario final: ";
print_r($informe_inventario);
echo "</pre>";
