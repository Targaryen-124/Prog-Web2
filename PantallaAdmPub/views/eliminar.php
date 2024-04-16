<?php

    $id= $_GET['idpublicidad'];
    require("conexion.php");
    $con = new conexion();  
    $sql = "DELETE FROM publicidad WHERE id= '$id'";
    $resultado = $con->eliminarRegistro($sql);

    if($resultado > 0) {
        echo "Record deleted successfully"; // Debugging statement
    } else {
        echo "Error deleting record"; // Debugging statement
    }

// Debugging statement
echo "Redirecting...";

// Redirect to AdmPub.php
header('Location: ../AdmPub.php');

?>