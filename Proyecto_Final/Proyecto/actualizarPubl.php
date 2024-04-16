<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formato'])) {
    $formato = $_POST['formato'];
    $estado_mostrando = ($formato === 'Imagen') ? 'Mostrando' : 'Oculto';
    $estado_oculto = ($formato === 'Imagen') ? 'Oculto' : 'Mostrando';

    $con = new conexion();
    $sqlUpdateMostrando = "UPDATE publicidad SET estado_TV = '$estado_mostrando' WHERE formato = '$formato'";
    $sqlUpdateOculto = "UPDATE publicidad SET estado_TV = '$estado_oculto' WHERE formato != '$formato'";

    $con->consulta($sqlUpdateMostrando);
    $con->consulta($sqlUpdateOculto);

    echo "Actualización exitosa";
}
?>
