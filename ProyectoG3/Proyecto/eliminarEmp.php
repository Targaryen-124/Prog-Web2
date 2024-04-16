<?php
session_start();
require("conexion.php");

$con = new conexion();

$identidad = $_POST['identidad'];

$sql3 = "DELETE FROM empleado WHERE identidad = '$identidad'";

$resultadoEmp = $con->actualizar($sql3);

if ($resultadoEmp) {
  $_SESSION['toastr_success'] = 'Registro Eliminado Exitosamente';
  header("Location: RegistroEmpleados.php");
  exit();

} else {
  $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}


?>
