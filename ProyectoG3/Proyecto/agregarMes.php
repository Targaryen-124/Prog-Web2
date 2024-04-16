
<?php        
    session_start();
    require("conexion.php");
    $con = new conexion();
    $descipcion = $_POST['descipcion'];

    $sql1 = "INSERT INTO mesas (descripcion) VALUES ('$descipcion')";

    $resultadoEmp = $con->escribir($sql1);

    if ($resultadoEmp) {
        $_SESSION['toastr_success'] = 'Registro Guardado Exitosamente';
        header("Location: mesas.php");
        exit();

    } else {
        $_SESSION['toastr_error'] = 'Error al Agregar el Empleado';
    }

?>    


