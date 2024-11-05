<?php

// Definir arrays para el inventario actual, proveedor A y proveedor B

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
