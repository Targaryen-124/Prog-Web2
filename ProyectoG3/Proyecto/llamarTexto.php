<?php
error_reporting(0);
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");

include("conexion.php");

$con = new conexion();

$p = '';
while(true){
    $result = $con->consulta("SELECT descripcion FROM texto WHERE estado='Activo'");
    $r = array();
    foreach ($result as $row) {
        $r[] = $row;
    }

    $n = json_encode($r);
    if(strcmp($p, $n) !== 0){
        echo "data:" . $n . "\n\n";
        $p = $n;
    }

    ob_end_flush();
    flush();
    sleep(1);
}


?>
