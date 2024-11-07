<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
include 'horario.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CrossFit - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Reservar o Cancelar Clase de CrossFit</h1>
    <form action="procesar_formulario.php" method="post">
        <input type="hidden" name="clase" value="crossfit">
        <label>Día:
            <select name="dia" id="dia"></select>
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

            const dias = Object.keys(horarioClases['crossfit']);
            dias.forEach(dia => {
                const option = document.createElement('option');
                option.value = dia;
                option.textContent = `${dia.charAt(0).toUpperCase() + dia.slice(1)} - ${horarioClases['crossfit'][dia].hora} (Plazas disponibles: ${horarioClases['crossfit'][dia].plazas_disponibles})`;
                diaSelect.appendChild(option);
            });
        }

        document.addEventListener('DOMContentLoaded', actualizarDias);
    </script>
</body>

</html>