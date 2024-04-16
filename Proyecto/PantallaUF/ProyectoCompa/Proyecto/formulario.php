<?php include 'encabezado.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Tickets</title>
    <link rel="stylesheet" href="estilo_formulario.css">
    <link rel="icon" href="logoUTH.png" type="img/png">

</head>

<body>

    <img src="UTH2.png" alt="" class="uth">
    <div class="contenedor">
        <h1>Generador de Tickets</h1>
        <form id="formTicket">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="type">Tipo de Gestión:</label>
            <select id="type" name="type" required>
                <option value="Consulta">Matricula</option>
                <option value="Cambio">Cambio de Horario</option>
                <option value="Otro">Otro</option>
            </select><br><br>
            <button type="submit">Generar Ticket</button>
        </form>
    </div>
    <script src="jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
