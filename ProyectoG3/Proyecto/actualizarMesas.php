<?php
session_start();
require("conexion.php");

$con = new conexion();

$idMesa = $_POST['idmesa'];
$descripcion = $_POST['descripcion'];


$sql2 = "UPDATE mesas SET descripcion = '$descripcion' WHERE idmesa = '$idMesa'";

$resultadoEmp = $con->actualizar($sql2);

if ($resultadoEmp) {
    $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
    header("Location: mesas.php");
    exit();

} else {
    $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}

?>
