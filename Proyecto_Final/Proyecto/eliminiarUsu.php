<?php
session_start();
require("conexion.php");

$con = new conexion();

$idempleado = $_POST['idempleado'];

$sql3 = "DELETE FROM usuarios WHERE idempleado = '$idempleado'";

$resultadoUsu = $con->actualizar($sql3);

if ($resultadoUsu) {
  $_SESSION['toastr_success'] = 'Registro Eliminado Exitosamente';
} else {
  $_SESSION['toastr_error'] = 'Error al eliminar el Usuario';
}

header("Location: usuario.php");
exit();
?>







