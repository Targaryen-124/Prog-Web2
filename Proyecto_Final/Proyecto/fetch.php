<?php
error_reporting(0);
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");

include("conexion.php");

$con = new conexion();

$p = '';
while(true){
    $result = $con->consulta("SELECT  m.descripcion, tr.codigo
        FROM tickect t
        JOIN mesas m ON t.idmesa = m.idmesa
        JOIN transaccion tr ON t.idtransaccion = tr.idtransaccion
        WHERE DATE(tr.fecha) = CURDATE() AND estado='Finalizado' OR estado='Atendiendo' OR estado='Llamado'
        ORDER BY t.idticket DESC
        LIMIT 5;");
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
