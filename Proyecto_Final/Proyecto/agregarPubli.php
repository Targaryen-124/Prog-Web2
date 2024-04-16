<?php
session_start();
require("conexion.php");

$con = new conexion();
$estado = $_POST['estado'];
$idus = $_SESSION['idus'];
$imagen;
$estadoTv;
$formato;

    if ($_FILES['archivo']['name'] != "") {
        
        $imagen = "imagenes/" . $_FILES['archivo']['name'];

        $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);

        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $formato = 'Imagen';
        } else if (in_array($extension, ['mp4', 'mpeg', 'quicktime'])) {
            $formato = 'Video';
        } else {
            $formato = 'Error';
        }

        move_uploaded_file($_FILES['archivo']['tmp_name'], $imagen);
    } else {
        $imagen = "";
    }

    $sql = "SELECT estado_TV FROM publicidad WHERE formato='$formato' LIMIT 1";

    $resultado = $con->consulta($sql);

    foreach ($resultado as $dato) {
        $estadoTv = $dato['estado_TV'];
    }

    $sql2 = "INSERT INTO publicidad (imagen,idUsuario,formato,estado, estado_TV) VALUES ('$imagen','$idus','$formato','$estado','$estadoTv')";

    $resultadoEmp = $con->actualizar($sql2);

        if ($resultadoEmp) {
        $_SESSION['toastr_success'] = 'Registro Actualizado Exitosamente';
        header("Location: Publicidad.php");
        exit();

        } else {
        $_SESSION['toastr_error'] = 'Error al agregar imagen';
        }

?>
