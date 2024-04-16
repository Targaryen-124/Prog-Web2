<?php
  $conexion=mysqli_connect("localhost","root","","r_user");

$imagen=$_FILES["imagen"]["name"];
$ruta=$_FILES["imagen"]["tmp_name"];
$destino="img/".$foto;
copy($ruta,$destino);
mysql_query("INSERT INTO user (foto) values('$destino')");
header("Location: ./index.php");
?>
