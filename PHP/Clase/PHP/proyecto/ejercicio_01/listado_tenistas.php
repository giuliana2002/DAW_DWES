<?php
require '../utiles/config.php';
require '../utiles/funciones.php';

$conexion = conectarDB();
if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

$query = "SELECT * FROM tenistas";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error al obtener los datos de jugadores.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Listado de Jugadores</title>
</head>
<body>
<div class="contenedor">
    <h1>Listado de Jugadores</h1>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Altura</th>
            <th>Mano</th>
            <th>Año de Nacimiento</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($jugador = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $jugador['id'] ?></td>
                <td><?= htmlspecialchars($jugador['nombre']) ?></td>
                <td><?= htmlspecialchars($jugador['apellidos']) ?></td>
                <td><?= $jugador['altura'] ?> cm</td>
                <td><?= htmlspecialchars($jugador['mano']) ?></td>
                <td><?= $jugador['anno_nacimiento'] ?></td>
            </tr>
            <td>
                <a class="estilo_enlace" href="modificar_tenista.php?id=<?= $jugador['id'] ?>">Modificar</a>
                <a class="estilo_enlace confirmacion_borrar" href="borrar_tenista.php?id=<?= $jugador['id'] ?>">Borrar</a>
                <a class="estilo_enlace" href="../ejercicio_02/nuevos_tenistas.php">Nuevo</a>
            </td>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
    document.querySelectorAll('.confirmacion_borrar').forEach(enlace => {
        enlace.addEventListener('click', function(e) {
            if (!confirm('¿Estás seguro de que deseas borrar este tenista?')) {
                e.preventDefault();
            }
        });
    });
</script>
</body>
</html>
