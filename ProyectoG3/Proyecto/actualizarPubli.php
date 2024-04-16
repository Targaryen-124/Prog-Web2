<?php
session_start();
require("conexion.php");

$con = new conexion();

$idpublicidad = $_POST['idpublicidad'];
$estado = $_POST['estado'];
$imagen;

        if($_FILES['archivoAct']['name'] != "")
        {
            $imagen = "imagenes/" . $_FILES['archivoAct']['name'];
            $sql2 = "UPDATE publicidad SET estado = '$estado', imagen = '$imagen' WHERE idpublicidad = '$idpublicidad'";
        }
        else
        {
            $sql2 = "UPDATE publicidad SET estado = '$estado' WHERE idpublicidad = '$idpublicidad'";
        }

        move_uploaded_file($_FILES['archivoAct']['tmp_name'], $imagen);
        

$resultadoEmp = $con->actualizar($sql2);

if ($resultadoEmp) {
    $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
    header("Location: Publicidad.php");
    exit();

} else {
    $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
}

?>
