<?php

require("conexion.php");

$con = new conexion();

$idtexto = $_POST['idtexto'];
$descripcion = $_POST['descripcion'];
$idus = $_SESSION['idus'];
$estado = $_POST['estado'];


$sql2 = "UPDATE texto SET descripcion = '$descripcion',idusuario = '$idus', estado = '$estado' WHERE idtexto = '$idtexto'";

$resultadoEmp = $con->actualizar($sql2);

if ($resultadoEmp) {
    $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
    header("Location: publicidad.php");
    exit();

} else {
    $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}

?>
