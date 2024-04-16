<?php
include("conexion.php");

$con = new conexion();
$tipo = $_POST['formato'];

if($tipo=="Video"){
    $sql1="UPDATE publicidad SET estado_TV = 'Mostrando' WHERE formato = 'Video'";
    $sql2="UPDATE publicidad SET estado_TV = 'Oculto' WHERE formato = 'Imagen'"; 
}else{
    $sql1="UPDATE publicidad SET estado_TV = 'Mostrando' WHERE formato = 'Imagen'";
    $sql2="UPDATE publicidad SET estado_TV = 'Oculto' WHERE formato = 'Video'"; 
}

$resultadoEmp1 = $con->actualizar($sql1);
$resultadoEmp2 = $con->actualizar($sql2);

if ($resultadoEmp1 && $resultadoEmp2) {
    echo "Actualización exitosa";
} else {
    echo "Error al actualizar";
}
?>
