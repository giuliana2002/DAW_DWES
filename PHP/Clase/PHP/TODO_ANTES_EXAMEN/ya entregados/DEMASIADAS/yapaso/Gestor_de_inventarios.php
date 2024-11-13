<html>

<hea</head>d>
    <title>Gestor de Inventario de Productos</title>
    <p>Giuliana Castillo 2ºDAW</p>
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

    h2 {
        color: #333;
        font-size: 20px;
        margin-top: 20px;
    }

    p {
        color: #49b669;
        font-size: 18px;
    }

    pre {
        color: red;
        font-size: 16px;
        background-color: #f4f4f4;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
</style>
<?php
// Definir los arrays de inventarios
$inventario_actual = [
    ['Producto' => 'Teclado', 'Precio' => 20, 'Categoría' => 'Electrónica', 'Cantidad' => 4],
    ['Producto' => 'Ratón', 'Precio' => 15, 'Categoría' => 'Electrónica', 'Cantidad' => 10],
    ['Producto' => 'Monitor', 'Precio' => 100, 'Categoría' => 'Electrónica', 'Cantidad' => 3],
    ['Producto' => 'Silla', 'Precio' => 80, 'Categoría' => 'Muebles', 'Cantidad' => 5],
];

$inventario_proveedor_a = [
    ['Producto' => 'Ratón', 'Precio' => 10, 'Categoría' => 'Electrónica', 'Cantidad' => 20],
    ['Producto' => 'Lámpara', 'Precio' => 25, 'Categoría' => 'Iluminación', 'Cantidad' => 15],
    ['Producto' => 'Escritorio', 'Precio' => 50, 'Categoría' => 'Muebles', 'Cantidad' => 2],
];

$inventario_proveedor_b = [
    ['Producto' => 'Monitor', 'Precio' => 92, 'Categoría' => 'Electrónica', 'Cantidad' => 8],
    ['Producto' => 'Auriculares', 'Precio' => 30, 'Categoría' => 'Electrónica', 'Cantidad' => 20],
    ['Producto' => 'Lámpara', 'Precio' => 20, 'Categoría' => 'Iluminación', 'Cantidad' => 5],
];

// Función para comparar inventarios y encontrar diferencias
function comparar_inventarios($inventario_actual, $inventario_proveedor_a, $inventario_proveedor_b)
{
    $diferencias = [];
    foreach ($inventario_actual as $producto) {
        $nombre_producto = $producto['Producto'];
        $precio_actual = $producto['Precio'];
        $cantidad_actual = $producto['Cantidad'];
        $encontrado_a = false;
        $encontrado_b = false;
        
        // Buscar el producto en el inventario del proveedor A
        foreach ($inventario_proveedor_a as $producto_a) {
            if ($producto_a['Producto'] === $nombre_producto) {
                $encontrado_a = true;
                $precio_a = $producto_a['Precio'];
                $cantidad_a = $producto_a['Cantidad'];
                break;
            }
        }
        
        // Buscar el producto en el inventario del proveedor B
        foreach ($inventario_proveedor_b as $producto_b) {
            if ($producto_b['Producto'] === $nombre_producto) {
                $encontrado_b = true;
                $precio_b = $producto_b['Precio'];
                $cantidad_b = $producto_b['Cantidad'];
                break;
            }
        }
        
        // Comparar precios y cantidades con el proveedor A
        if (!$encontrado_a) {
            $diferencias[] = "El producto '$nombre_producto' no se encuentra en el inventario del proveedor A.";
        } elseif ($precio_actual !== $precio_a) {
            $diferencias[] = "El precio del producto '$nombre_producto' es diferente en el inventario actual y el proveedor A.";
        } elseif ($cantidad_actual !== $cantidad_a) {
            $diferencias[] = "La cantidad del producto '$nombre_producto' es diferente en el inventario actual y el proveedor A.";
        }
        
        // Comparar precios y cantidades con el proveedor B
        if (!$encontrado_b) {
            $diferencias[] = "El producto '$nombre_producto' no se encuentra en el inventario del proveedor B.";
        } elseif ($precio_actual !== $precio_b) {
            $diferencias[] = "El precio del producto '$nombre_producto' es diferente en el inventario actual y el proveedor B.";
        } elseif ($cantidad_actual !== $cantidad_b) {
            $diferencias[] = "La cantidad del producto '$nombre_producto' es diferente en el inventario actual y el proveedor B.";
        }
    }
    return $diferencias;
}


// Función para unir inventarios
function unir_inventarios($inventario_actual, $inventario_proveedor_a, $inventario_proveedor_b) {
    // Combina los tres inventarios en uno solo
    return array_merge($inventario_actual, $inventario_proveedor_a, $inventario_proveedor_b);
}

// Función para contar productos por categorías
function contar_productos_por_categoria($inventario) {
    $categorias = array_column($inventario, 'Categoría');
    return array_count_values($categorias);
}

// Función para ordenar productos por precio
function ordenar_por_precio(&$inventario) {
    usort($inventario, function($a, $b) {
        return $a['Precio'] <=> $b['Precio'];
    });
}

// Función para eliminar productos duplicados
function eliminar_duplicados($inventario) {
    $productos = array_column($inventario, 'Producto');
    $unicos = array_unique($productos);
    return array_intersect_key($inventario, $unicos);
}

// Función para dividir en secciones
function dividir_en_secciones($inventario, $tamaño) {
    return array_chunk($inventario, $tamaño);
}

// Función para buscar un producto específico
function buscar_producto($inventario, $nombre_producto) {
    return array_filter($inventario, function($producto) use ($nombre_producto) {
        return $producto['Producto'] === $nombre_producto;
    });
}

// Rellenar el inventario con nuevos productos
$nuevos_productos = array_map(function($i) {
    return [
        'Producto' => ['Impresora', 'Altavoces', 'Mesa', 'Lámpara', 'Cámara'][array_rand(['Impresora', 'Altavoces', 'Mesa', 'Lámpara', 'Cámara'])],
        'Precio' => rand(10, 100),
        'Categoría' => ['Electrónica', 'Muebles', 'Iluminación'][array_rand(['Electrónica', 'Muebles', 'Iluminación'])],
        'Cantidad' => rand(1, 20)
    ];
}, range(1, 5));

$inventario_actual = array_merge($inventario_actual, $nuevos_productos);

// Función para reindexar inventario
function reindexar_inventario($inventario) {
    return array_values($inventario);
}

// Función para generar informe estadístico
function generar_informe($inventario) {
    $informe = [];
    foreach ($inventario as $producto) {
        $informe[$producto['Producto']] = [
            'Precio' => $producto['Precio'],
            'Categoría' => $producto['Categoría'],
            'Cantidad' => $producto['Cantidad']
        ];
    }
    return $informe;
}

// Unir y organizar las listas de productos
$inventario_unido = unir_inventarios($inventario_actual, $inventario_proveedor_a, $inventario_proveedor_b);

// Eliminar productos duplicados
$inventario_unido = eliminar_duplicados($inventario_unido);

// Contar productos por categorías
$conteo_categorias = contar_productos_por_categoria($inventario_unido);

// Ordenar productos por precio
ordenar_por_precio($inventario_unido);

// Dividir el inventario en secciones de 2 elementos cada uno
$secciones = dividir_en_secciones($inventario_unido, 2);

// Buscar y contar elementos en los arrays
$producto_buscado = buscar_producto($inventario_unido, 'Ratón');

// Reindexar inventario y mostrar los nuevos índices
$inventario_reindexado = reindexar_inventario($inventario_unido);

// Generar informe estadístico del inventario actual
$informe = generar_informe($inventario_unido);

// Mostrar resultados
echo "<h1>Gestor de Inventario de Productos</h1>";

echo "<h2>Inventario Comparado de los proveedores</h2>";
echo "<pre>" . print_r(comparar_inventarios($inventario_actual, $inventario_proveedor_a, $inventario_proveedor_b), true) . "</pre>";

echo "<h2>Inventario Unido</h2>";
echo "<pre>" . print_r($inventario_unido, true) . "</pre>";

echo "<h2>Conteo por Categorías</h2>";
echo "<pre>" . print_r($conteo_categorias, true) . "</pre>";

echo "<h2>Eliminar productos duplicados</h2>";
echo "<pre>" . print_r(eliminar_duplicados($inventario_unido), true) . "</pre>";

echo "<h2>Ordenar por Precio</h2>";
echo "<pre>" . print_r($inventario_unido, true) . "</pre>";

echo"<h2>Rellenar con nuevos Productos</h2>";
echo "<pre>" . print_r($nuevos_productos, true) . "</pre>";

echo "<h2>Dividir las secciones en 2</h2>";
echo "<pre>" . print_r($secciones, true) . "</pre>";

echo "<h2>Producto Buscado</h2>";
echo "<pre>" . print_r($producto_buscado, true) . "</pre>";

echo "<h2>Inventario Reindexado</h2>";
echo "<pre>" . print_r($inventario_reindexado, true) . "</pre>";


echo "<h2>Informe Estadístico</h2>";
foreach ($informe as $producto => $detalles) {
    echo "<h3>Producto: $producto</h3>";
    echo "<p>Precio: {$detalles['Precio']}</p>";
    echo "<p>Categoría: {$detalles['Categoría']}</p>";
    echo "<p>Cantidad: {$detalles['Cantidad']}</p>";
}
?>

</html>