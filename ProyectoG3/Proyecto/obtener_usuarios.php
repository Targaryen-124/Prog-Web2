<?php

require_once "conexion.php";

$con = new conexion();


$sql = "SELECT DISTINCT usuario FROM usuarios";


$statement = $con->getConnection()->prepare($sql);


$statement->execute();

$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


$usuarios = array();

foreach ($rows as $row) {
    $usuarios[] = $row["usuario"];
}

echo json_encode($usuarios);
?>
