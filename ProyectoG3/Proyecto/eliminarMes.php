<?php
session_start();
require("conexion.php");

$con = new conexion();

$id = $_POST['idmesa'];

$sql3 = "DELETE FROM mesas WHERE idmesa = '$id'";

$resultado = $con->actualizar($sql3);

if ($resultado) {
  $_SESSION['toastr_success'] = 'Registro Eliminado Exitosamente';
  header("Location: mesas.php");
  exit();

} else {
  $_SESSION['toastr_error'] = 'Error al eliminar la imagen';
}


?>
