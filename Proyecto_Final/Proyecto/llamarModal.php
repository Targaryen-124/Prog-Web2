<?php
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

include("conexion.php");

$con = new conexion();

while(true){
    $result = $con->consulta("SELECT   tr.codigo, m.descripcion
    FROM tickect t
    JOIN mesas m ON t.idmesa = m.idmesa
    JOIN transaccion tr ON t.idtransaccion = tr.idtransaccion
    WHERE  estado='Mostrando' AND DATE(tr.fecha) = CURDATE() LIMIT 1");
    if(!empty($result)){
        $cod = $result[0]['codigo'];
        $descripcion = $result[0]['descripcion'];
        echo "data: $cod,$descripcion\n\n";
    }
    ob_flush();
    flush();
    sleep(5);
}
?>
