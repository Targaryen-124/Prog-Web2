<?php
session_start();
require("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idempleado = $_POST['empleado'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $idrol = $_POST['rol'];
    $estado = 'Activo';


    $con = new conexion();
    $sql_check = "SELECT idempleado FROM usuarios WHERE idempleado = '$idempleado'";
    $result_check = $con->consultaUsuarios($sql_check);

    if ($result_check && count($result_check) > 0) {
        $_SESSION['toastr_error'] = 'El empleado ya está registrado como usuario.';
        header("Location: usuario.php");
        exit();
    }

    $sql_insert = "INSERT INTO usuarios (idempleado, usuario, contrasenia, idrol) VALUES ('$idempleado', '$usuario', '$contrasenia', '$idrol')";
    $result_insert = $con->escribir($sql_insert);

    if ($result_insert) {
        $_SESSION['toastr_success'] = 'Usuario creado exitosamente';
        header("Location: usuario.php");
        exit();
    } else {
        $_SESSION['toastr_error'] = 'Error al crear el usuario';
        header("Location: usuario.php");
        exit();
    }
}
?>




