<?php
session_start();
require("conexion.php");

$con = new conexion();

$identidad = $_POST['identidad'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$idProfesion = $_POST['profesion'];

$sql2 = "UPDATE empleado SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', idProfesion = '$idProfesion' WHERE identidad = '$identidad'";

$resultadoEmp = $con->actualizar($sql2);

if ($resultadoEmp) {
    $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
    header("Location: RegistroEmpleados.php");
    exit();

} else {
    $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}

?>
