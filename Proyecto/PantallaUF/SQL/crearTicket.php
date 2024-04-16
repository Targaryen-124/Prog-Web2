<?php
session_start();
    require("conexion.php");
    $con = new conexion();
    $nt = $_SESSION['ticket'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Verificar si se ha enviado el formulario y se ha presionado el botón "Generar"

    // Capturar el valor seleccionado del select
    $opcionSeleccionada = $_POST['transaccion'];
    
    // Hacer algo con el valor seleccionado, como imprimirlo
    echo "La opción seleccionada es: " . $opcionSeleccionada;


    $sql = "INSERT INTO `transaccion` (`idtransaccion`, `codigo`, `idtipotransaccion`, `fecha`) VALUES (NULL, $nt, $opcionSeleccionada, now());";
    $transacciones = $con->escribir($sql);
}
?>