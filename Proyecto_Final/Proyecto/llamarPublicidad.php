<?php

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

include("conexion.php");

$con = new conexion();

while(true){
    $result = $con->consulta("SELECT imagen, formato FROM publicidad WHERE estado='Activo' AND estado_TV='Mostrando'");
    $r = array();
    foreach ($result as $row) {
        $tipo = $row['formato'] === 'Video' ? 'Video' : 'Imagen';
        $contenido = $row['imagen'];
        $r[] = array('tipo' => $tipo, 'contenido' => $contenido);
    }

    $n = json_encode($r);
    echo "data: $n\n\n";
    

    ob_end_flush();
    flush();
    sleep(1);
}
?>