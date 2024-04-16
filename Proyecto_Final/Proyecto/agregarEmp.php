
<?php        
    session_start();
    require("conexion.php");
    $con = new conexion();
    $identidad = $_POST['identidad'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $idProfesion = $_POST['profesion'];

    $sql1 = "INSERT INTO empleado (identidad,nombre, direccion, telefono, idProfesion) VALUES ('$identidad','$nombre', '$direccion', '$telefono', '$idProfesion')";

    $resultadoEmp = $con->escribir($sql1);

    if ($resultadoEmp) {
        $_SESSION['toastr_success'] = 'Registro Guardado Exitosamente';
        header("Location: RegistroEmpleados.php");
        exit();

    } else {
        $_SESSION['toastr_error'] = 'Error al Agregar el Empleado';
    }

?>    


