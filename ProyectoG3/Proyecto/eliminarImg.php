<?php
session_start();
require("conexion.php");

$con = new conexion();

$id = $_POST['idpublicidad'];

$sql3 = "DELETE FROM publicidad WHERE idpublicidad = '$id'";

$resultado = $con->actualizar($sql3);

if ($resultado) {
  $_SESSION['toastr_success'] = 'Registro Eliminado Exitosamente';
  header("Location: Publicidad.php");
  exit();

} else {
  $_SESSION['toastr_error'] = 'Error al eliminar la imagen';
}


?>
