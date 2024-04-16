
<?php        
    session_start();
    require("conexion.php");
    $con = new conexion();
    $idtexto = $_POST['idtexto'];
    $descripcion = $_POST['descripcion'];
    $idus = $_SESSION['idus'];
    $estado = $_POST['estado'];
   

    $sql1 = "INSERT INTO texto (idtexto,descripcion, idusuario, estado) VALUES ('$idtexto','$descripcion', '$idus', '$estado')";

    $resultadoEmp = $con->escribir($sql1);

    if ($resultadoEmp) {
        $_SESSION['toastr_success'] = 'Registro Guardado Exitosamente';
        header("Location: publicidad.php");
        exit();

    } else {
        $_SESSION['toastr_error'] = 'Error al eliminar el Empleado';
    }

?>    


