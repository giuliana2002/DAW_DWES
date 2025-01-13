<?php
echo  "<H1> Probando las clases en PHP GC</H1>";

class Usuario
{
    private $nombre = "";
    private $contrasena = "";
    private $email = "";

    public function __construct($nombre, $contrasena, $email)
    {
        $this->nombre = $nombre;
        $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $this->email = $email;
    }

    public static function getSampleUsers()
    {
        return [
            new Usuario("Manolo", "contraseña1", "asdad@gmil.com"),
            new Usuario("Felipe", "contraseña2", "asdad@gmil.com"),
            new Usuario("Antonio", "contraseña3", "asdad@gmil.com")
        ];
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function cambiarContrasena($nuevaContrasena)
    {
        $this->contrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }
}

// Imprime los usuarios de la función
$usuarios = Usuario::getSampleUsers();
foreach ($usuarios as $usuario) {
    echo "<div class='usuario'>Nombre de usuario: " . $usuario->getNombre() . "</div><br>";
}

// Registrar un nuevo usuario
$nuevoUsuario = new Usuario("Manoloelnuevo", "nuevaContrasena", "nuevo@correo.com");
echo "<div class='usuario'>Nuevo usuario registrado: " . $nuevoUsuario->getNombre() . "<br>Contraseña que va a ser cambiada: " . $nuevoUsuario->getContrasena() . "</div><br>";

// Cambiar la contraseña del nuevo usuario
$nuevoUsuario->cambiarContrasena("otraContrasena");
echo "<div class='usuario'>Contraseña cambiada para el usuario: " . $nuevoUsuario->getNombre() . "<br>Contraseña nueva: " . $nuevoUsuario->getContrasena() . "</div><br>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases PHP GC</title>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .usuario {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>


</body>

</html>