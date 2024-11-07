<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
include 'horario.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Clases - Gimnasio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Reservar o Cancelar Clase</h1>
    <form action="procesar_formulario.php" method="post">
        <label>Clase:
            <select name="clase" id="clase" onchange="actualizarDias()">
                <option value="yoga">Yoga</option>
                <option value="zumba">Zumba</option>
                <option value="crossfit">CrossFit</option>
            </select>
        </label>
        <label>Día:
            <select name="dia" id="dia">
                <!-- Los días se actualizarán dinámicamente con JavaScript -->
            </select>
        </label>
        <input type="submit" name="accion" value="Reservar">
        <input type="submit" name="accion" value="Liberar">
    </form>
    <p>Para más información sobre las clases, consulta el <a href="catalogo.html">Catálogo de Actividades</a>.</p>

    <script>
        const horarioClases = <?php echo json_encode($horario_clases); ?>;

        function actualizarDias() {
            const clase = document.getElementById('clase').value;
            const diaSelect = document.getElementById('dia');
            diaSelect.innerHTML = '';

            for (const dia in horarioClases[clase]) {
                const option = document.createElement('option');
                option.value = dia;
                option.textContent = `${dia.charAt(0).toUpperCase() + dia.slice(1)} - ${horarioClases[clase][dia].hora} (Plazas disponibles: ${horarioClases[clase][dia].plazas_disponibles})`;
                diaSelect.appendChild(option);
            }
        }

        // Inicializar los días al cargar la página
        document.addEventListener('DOMContentLoaded', actualizarDias);
    </script>
</body>

</html>