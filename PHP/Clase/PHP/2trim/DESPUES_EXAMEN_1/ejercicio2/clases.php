<?php

class Producto
{
    private $id;
    private $nombre;
    private $precio;
    private $stock;

    public function __construct($id, $nombre, $precio, $stock = 0)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    public function disminuirStock($cantidad)
    {
        if ($this->stock >= $cantidad) {
            $this->stock -= $cantidad;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }
}

// Crear un nuevo producto
$producto1 = new Producto(1, "Camiseta", 19.99, 10);

// Mostrar información del producto
echo "ID: " . $producto1->getId() . "<br>";
echo "Nombre: " . $producto1->getNombre() . "<br>";
echo "Precio: $" . $producto1->getPrecio() . "<br>";
echo "Stock: " . $producto1->getStock() . "<br>";


// Intentar vender 5 unidades
if ($producto1->disminuirStock(5)) {
    echo "Venta realizada con éxito.<br>";
} else {
    echo "No hay suficiente stock.<br>";
}

// Mostrar información del producto después de la venta
echo "Stock después de la venta: " . $producto1->getStock() . "<br>";
