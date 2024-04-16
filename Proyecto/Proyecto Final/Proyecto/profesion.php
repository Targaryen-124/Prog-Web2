<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesión - Empleados</title>
    <link rel="stylesheet" href="estiloprofesion.css">
    <link rel="icon" href="logoUTH.png" type="img/png">
</head>

<body>
    <img src="UTH2.png" alt="" class="uth">
    <div class="contenedor">
        <h1>Profesión de Empleados</h1>
        <form id="formProfesion">
            <label for="profession">Profesión:</label>
            <input type="text" id="profession" name="profession" required><br><br>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required></textarea><br><br>
            <button type="submit">Generar</button>
        </form>
    </div>
    <script src="jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
