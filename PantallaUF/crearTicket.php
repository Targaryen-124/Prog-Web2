<?php
session_start();
    require("conexion.php");
    $con = new conexion();
    $nt = $_SESSION['ticket'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Verificar si se ha enviado el formulario y se ha presionado el botón "Generar"

    // Capturar el valor seleccionado del select
    $opcionSeleccionada = $_POST['transac'];
    

    $query = "INSERT INTO `transaccion` (`idtransaccion`, `codigo`, `idtipotransaccion`, `fecha`,`estado`) VALUES (NULL, '$nt', '$opcionSeleccionada', now(), 'Pendiente');";
    $agregar = $con->escribirTicket($query);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket | UTH</title>
    <link rel="stylesheet" href="styleUF.css">
    <script src="logicaUF.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="imagenes/logoUTH.png" type="img/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
</head>

<body onload="ticket('<?php echo $nt;?>'); capture()" >
    <div class="logoUTH">
        <img src="imagenes/UTH2.png" alt="logouth" width="200px" height="150px">
    </div>
    <div class="wrapper2" id="content">
        <h2 id="rotulo">Su ticket Generado es</h2>
        <h1 id="ticket"></h1>
        <label id="fecha"></label>
    </div>

    <script>
        function capture() {
            html2canvas(document.getElementById('content')).then(function(canvas) {
                var img = canvas.toDataURL('image/jpeg');
                // Crea un enlace para descargar la imagen
                var link = document.createElement('a');
                link.download = '<?php echo $nt;?>'+'.jpg';
                link.href = img;
                link.click();
            });
        }
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>