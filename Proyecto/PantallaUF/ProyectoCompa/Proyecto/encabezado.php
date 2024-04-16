
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="menustyle.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/cb5c02b589.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>>

<?php

    
session_start();

if(isset($_SESSION['idrol'])) {
    $idrol = $_SESSION['idrol'];

   
    
    if($idrol == 1) {
        include('menu.php');
    } elseif($idrol == 2) {
        include('menuEmpleado.php');
    }
}
require("conexion.php");
$con = new conexion();   


$usuario = $_SESSION['usuario'];
$pass = $_SESSION['passw'];

if(isset($usuario) == "")
    header("location: Login.php");



?>


