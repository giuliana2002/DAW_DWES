<?php
abstract class Empleado
{
    protected $nombre;
    protected $apellido;
    protected $salario;

    public function __construct($nombre, $apellido, $salario)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->salario = $salario;
    }

    abstract public function calcularSueldo();

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}

class EmpleadoPorHora extends Empleado
{
    private $horasTrabajadas;
    private $valorHora;

    public function __construct($nombre, $apellido, $salario, $horasTrabajadas, $valorHora)
    {
        parent::__construct($nombre, $apellido, $salario);
        $this->horasTrabajadas = $horasTrabajadas;
        $this->valorHora = $valorHora;
    }

    public function calcularSueldo()
    {
        return $this->horasTrabajadas * $this->valorHora;
    }

    public function getHorasTrabajadas()
    {
        return $this->horasTrabajadas;
    }

    public function getValorHora()
    {
        return $this->valorHora;
    }

    public function setHorasTrabajadas($horasTrabajadas)
    {
        $this->horasTrabajadas = $horasTrabajadas;
    }

    public function setValorHora($valorHora)
    {
        $this->valorHora = $valorHora;
    }
}
class EmpleadoFijo extends Empleado{
    private $descuento;

    public function __construct($nombre, $apellido, $salario, $descuento)
    {
        parent::__construct($nombre, $apellido, $salario);
        $this->descuento = $descuento;
    }

    public function calcularSueldo()
    {
        return $this->salario - $this->descuento;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }
}


function obtenerInformacionClase($empleado)
{
    $clase = get_class($empleado);
    $metodos = get_class_methods($empleado);
    $propiedades = get_object_vars($empleado);

    return [
        'clase' => $clase,
        'metodos' => $metodos,
        'propiedades' => $propiedades
    ];
}


$empleadoTiempoCompleto = new EmpleadoTiempoCompleto("Juan", "Perez", 3000, 500);
$informacion = obtenerInformacionClase($empleadoTiempoCompleto);
print_r($informacion);






