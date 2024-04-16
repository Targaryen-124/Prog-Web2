<?php include 'encabezado.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesión - Empleados</title>
    <link rel="stylesheet" href="estiloprofesion.css">
</head>

<body>

    <img src="imagenes/UTH2.png" alt="" class="uth">
    <div class="contenedor">
        <h1>Profesión de Empleados</h1>
        <form id="formProfesion" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="description">Ingrese la profesion</label>
            <textarea id="description" name="description" required></textarea><br><br>
            <button type="submit" name="submit">Generar</button>
        </form>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once'conexion.php';


        if (isset($_POST["description"]) && !empty($_POST["description"])) {
           
            $description = $_POST["description"]; 
            $conexion = new Conexion();
            $conexion->insertarProfesion($description);
        } else {

        }
    }
    ?>

</body>

</html>
