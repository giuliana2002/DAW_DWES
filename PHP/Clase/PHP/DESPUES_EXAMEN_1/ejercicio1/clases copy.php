<?php
session_start();

echo "<H1> Probando las clases en PHP GC</H1>";

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

    public function getEmail()
    {
        return $this->email;
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

// Manejar el registro del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $nuevoUsuario = new Usuario($nombre, $contrasena, $email);
    // Guardar el nuevo usuario en la sesión
    if (!isset($_SESSION['usuarios'])) {
        $_SESSION['usuarios'] = [];
    }

    $usuarioExistente = false;
    foreach ($_SESSION['usuarios'] as $usuario) {
        if ($usuario->getNombre() == $nombre && $usuario->getEmail() == $email) {
            $usuarioExistente = true;
            break;
        }
    }
    if (!$usuarioExistente) {
        $_SESSION['usuarios'][] = $nuevoUsuario;
    }
}

// Mostrar los usuarios registrados
if (isset($_SESSION['usuarios'])) {
    foreach ($_SESSION['usuarios'] as $usuario) {
        echo "<div class='usuario'>Nombre de usuario: " . $usuario->getNombre() . "</div><br>";
    }
}
