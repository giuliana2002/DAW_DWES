<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Ejemplo GC</title>
</head>

<body>
    <form action="procesar.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="comentarios">Comentarios:</label>
        <textarea id="comentarios" name="comentarios"></textarea><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>

        <label>Intereses:</label><br>
        <input type="checkbox" id="interes1" name="intereses[]" value="Deporte">
        <label for="interes1">Deporte</label><br>
        <input type="checkbox" id="interes2" name="intereses[]" value="Música">
        <label for="interes2">Música</label><br>
        <input type="checkbox" id="interes3" name="intereses[]" value="Lectura">
        <label for="interes3">Lectura</label><br><br>

        <label>Género:</label><br>
        <input type="radio" id="masculino" name="genero" value="Masculino">
        <label for="masculino">Masculino</label><br>
        <input type="radio" id="femenino" name="genero" value="Femenino">
        <label for="femenino">Femenino</label><br><br>

        <label for="pais">País:</label>
        <select id="pais" name="pais">
            <option value="España">España</option>
            <option value="México">México</option>
            <option value="Argentina">Argentina</option>
            <option value="Colombia">Colombia</option>
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>