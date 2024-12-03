<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
include 'horario.php';

$usuario = $_SESSION['usuario'];
$archivo_reservas = "reservas_{$usuario}.json";

// Leer el estado actual de las reservas del archivo del usuario
if (file_exists($archivo_reservas)) {
    $horario_clases = json_decode(file_get_contents($archivo_reservas), true);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Zumba - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Reservar o Cancelar Clase de Zumba</h1>
    <form action="procesar_formulario.php" method="post">
        <input type="hidden" name="clase" value="zumba">
        <label>Día:
            <select name="dia" id="dia">
                <!-- Los días se actualizarán dinámicamente con JavaScript -->
            </select>
        </label>
        <input type="submit" name="accion" value="Reservar">
        <input type="submit" name="accion" value="Liberar">
        <button type="button" onclick="window.history.back();">Volver</button>
    </form>
    <p>Para más información sobre las clases, consulta el <a href="catalogo.html">Catálogo de Actividades</a>.</p>

    <script>
        const horarioClases = <?php echo json_encode($horario_clases); ?>;

        function actualizarDias() {
            const diaSelect = document.getElementById('dia');
            diaSelect.innerHTML = '';

            const dias = Object.keys(horarioClases['zumba']);
            dias.forEach(dia => {
                const option = document.createElement('option');
                option.value = dia;
                option.textContent = `${dia.charAt(0).toUpperCase() + dia.slice(1)} - ${horarioClases['zumba'][dia].hora} (Plazas disponibles: ${horarioClases['zumba'][dia].plazas_disponibles})`;
                diaSelect.appendChild(option);
            });
        }

        document.addEventListener('DOMContentLoaded', actualizarDias);
    </script>
</body>

</html>