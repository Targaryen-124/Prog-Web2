<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso Empleado</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="logoUTH.png" type="img/png">
</head>
<body>
    <img src="UTH2.png" alt="" class="uth">
    <div class="uth-container">
        <h1>Ingreso de Empleado</h1>
        <form id="employee-form" class="form-container">
            <label for="name" class="arial-black">Identidad:</label>
            <input type="text" id="name" name="name" required>

            <label for="name" class="arial-black">Nombre:</label>
            <input type="text" id="name" name="name" required>

            <label for="address" class="arial-black">Dirección:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone" class="arial-black">Teléfono:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="position" class="arial-black">Profesión:</label>
            <select name="" id="Profesión">
                <option value="Informatica">Seleccione una profesión</option>
                <option value="Informatica">Computación</option>
                <option value="Informatica">Robotica</option>
                <option value="Informatica">Licenciatura en Matematicas</option>
            </select>
            
            <div class="button-container">
                <button type="submit">Enviar</button>
                <button type="button">Regresar</button>
            </div>
        </form>
    </div>
</body>
</html>

