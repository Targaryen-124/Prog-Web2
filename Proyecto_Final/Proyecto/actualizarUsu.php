<?php
session_start();
require("conexion.php");

$con = new conexion();

$idempleado = $_POST['idempleado'];
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];
$idrol = $_POST['rol'];

$sql2 = "UPDATE usuarios SET usuario = '$usuario', contrasenia = '$contrasenia', idrol = '$idrol' WHERE idempleado = '$idempleado'";

$resultadoUsu = $con->actualizar($sql2);

if ($resultadoUsu) {
    $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
    header("Location: usuario.php");
    exit();

} else {
    $_SESSION['toastr_error'] = 'Error al actualizar el Usuario';
    header("Location: usuario.php"); // Agregado para redirigir en caso de error
    exit();
}
?>


