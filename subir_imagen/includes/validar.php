<?php

$conexion=mysqli_connect("localhost","root","","r_user"); 

if (
    isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
    isset($_POST["correo"]) && !empty($_POST["correo"]) &&
    isset($_POST["telefono"]) && !empty($_POST["telefono"])&&
    isset($_POST["password"]) && !empty($_POST["password"])&& 
    isset($_POST["rol"]) && !empty($_POST["rol"]) 
) {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];


    if (isset($_POST["selImg"]) && !empty($_POST["selImg"])) {
		$imagen = $_POST["selImg"];
	} else {
		$imagen = '';
	}

    $sql = "INSERT INTO user (nombre, correo, telefono, password, rol, imagen)
    VALUES (?, ?, ?, ?, ?,?)";

    if ($statement = mysqli_prepare($conexion, $sql)) {

        mysqli_stmt_bind_param($statement, "ssssss", $nombre, $correo, $telefono, $password, $rol, $imagen);

        if (mysqli_stmt_execute($statement)) {
      header('Location: ../views/user.php');

        } else {
            echo "No se pudo realizar la accion";
        }
        mysqli_stmt_close($statement);
    }

    mysqli_close($conexion);
} else {
?>
<?php  } ?>
