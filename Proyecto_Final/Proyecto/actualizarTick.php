<?php
    include("conexion.php");

    $con = new conexion();
    $codigo = $_POST['codigo'];

    $sql2 = "UPDATE transaccion SET estado = 'LLamado' WHERE codigo = '$codigo' AND DATE(fecha) = CURDATE()";
    $resultadoEmp = $con->actualizar($sql2);


?>