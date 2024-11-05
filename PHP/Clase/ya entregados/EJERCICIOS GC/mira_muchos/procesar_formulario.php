<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['boton1'])) {
        echo "Has presionado el Botón 1. ";
    } elseif (isset($_POST['boton2'])) {
        echo "Has presionado el Botón 2. ";
    } else {
        echo "No se ha presionado ningún botón.";
    }
} else {
    echo "Método de solicitud inválido.";
}
