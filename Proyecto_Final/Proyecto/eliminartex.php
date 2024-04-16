<?php
session_start();
require("conexion.php");

$con = new conexion();

$idtexto = $_POST['idtexto'];

$sql3 = "DELETE FROM texto WHERE idtexto = '$idtexto'";

$resultadoEmp = $con->escribir($sql3);

if ($resultadoEmp) {
  $_SESSION['toastr_success'] = 'Registro Eliminado Exitosamente';
} else {
  $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}

header("Location: publicidad.php");
exit();
?>
