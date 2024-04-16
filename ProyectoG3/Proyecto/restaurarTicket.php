<?php
session_start();
require("conexion.php");

$con = new conexion();

$codigo = $_POST['codigo'];

$sql2 = "UPDATE transaccion SET estado = 'Pendiente' WHERE codigo = '$codigo' AND DATE(fecha) = CURDATE()";
$sql3 = "DELETE FROM tickect WHERE idtransaccion = (SELECT idtransaccion FROM transaccion WHERE codigo = '$codigo' AND DATE(fecha) = CURDATE())";

$resultadoEmp = $con->actualizar($sql2);
$resultado= $con->actualizar($sql3);

if ($resultadoEmp) {
    $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
    header("Location: llamarTicket.php");
    exit();

} else {
    $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}

?>