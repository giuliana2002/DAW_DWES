<?php
header('Content-Type: application/json');

// Usamos la función correcta para la conexión a la base de datos
$conn = conectar2("ajax", "root", "");

// Obtenemos los datos enviados como JSON desde el cliente
$datos = file_get_contents('php://input');
$objeto = json_decode($datos);

if ($objeto != null) {
	switch ($objeto->servicio) {
		case "listar":
			print json_encode(listadoPersonas());
			break;
		case "insertar":
			insertarPersona($objeto);
			print json_encode(listadoPersonas());
			break;
		case "borrar":
			borrarPersona($objeto->id);
			print json_encode(listadoPersonas());
			break;
		case "modificar":
			modificarPersona($objeto);
			print json_encode(listadoPersonas());
			break;

		case "selPersonaID":
			print json_encode(selPersonaID($objeto->id));
			break;
	}
}

function listadoPersonas()
{
	global $conn;
	try {
		$sc = "SELECT * FROM personas ORDER BY ID";
		$stm = $conn->prepare($sc);
		$stm->execute();
		return ($stm->fetchAll(PDO::FETCH_ASSOC));
	} catch (Exception $e) {
		die($e->getMessage());
	}
}


function insertarPersona($objeto)
{
	global $conn;
	try {
		$sql = "INSERT INTO personas(DNI, NOMBRE, APELLIDOS) VALUES (?, ?, ?)";
		$conn->prepare($sql)->execute(
			array(
				$objeto->dni,
				$objeto->nombre,
				$objeto->apellidos
			)
		);
		return true;
	} catch (Exception $e) {
		die($e->getMessage());
	}
}


function borrarPersona($id)
{
	global $conn;
	try {
		$sql = "DELETE FROM personas WHERE ID = ?";
		$conn->prepare($sql)->execute(array($id));
		return true;
	} catch (Exception $e) {
		die($e->getMessage());
	}
}


function modificarPersona($objeto)
{
	global $conn;
	try {
		$sql = "UPDATE personas SET 
				DNI = ?,
				NOMBRE = ?, 
				APELLIDOS = ?
				WHERE ID = ?";
		$conn->prepare($sql)->execute(
			array(
				$objeto->dni,
				$objeto->nombre,
				$objeto->apellidos,
				$objeto->id
			)
		);
		return true;
	} catch (Exception $e) {
		die($e->getMessage());
	}
}


function selPersonaID($id)
{
	global $conn;
	try {
		$sc = "SELECT * FROM personas WHERE ID = ?";
		$stm = $conn->prepare($sc);
		$stm->execute(array($id));
		return ($stm->fetch(PDO::FETCH_ASSOC));
	} catch (Exception $e) {
		die($e->getMessage());
	}
}

function conectar2($bd, $usuario, $clave)
{
	try {
		$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		@$bd = new PDO('mysql:host=localhost;dbname=' . $bd, $usuario, $clave, $opciones);
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de errores
		return $bd;
	} catch (PDOException $e) {
		echo ("No se ha podido conectar a la base de datos. Código de error: " . $e->getMessage());
	}
}
